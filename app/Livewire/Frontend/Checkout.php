<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Coupon;
use App\Models\Customer;  
use Illuminate\Support\Str;

class Checkout extends Component
{
    public string $customer_name    = '';
    public string $customer_email   = '';
    public string $customer_phone   = '';
    public string $shipping_address = '';
    public string $billing_address  = '';
    public bool   $same_address     = true;

    public string $payment_method = 'cod';

    public string $coupon_code    = '';
    public float  $discount       = 0;
    public ?array $appliedCoupon  = null;
    public string $coupon_message = '';
    public string $coupon_status  = '';

    public string $notes = '';
    public array  $cart  = [];

    public function mount()
    {
        $this->cart = session()->get('cart', []);

        if (auth()->check()) {
            $user = auth()->user();
            $this->customer_name  = $user->name;
            $this->customer_email = $user->email;
        }
    }

    public function updatedSameAddress()
    {
        if ($this->same_address) {
            $this->billing_address = $this->shipping_address;
        }
    }

    public function applyCoupon()
    {
        $this->coupon_message = '';
        $this->coupon_status  = '';
        $this->discount       = 0;
        $this->appliedCoupon  = null;

        if (empty($this->coupon_code)) {
            $this->coupon_message = 'Coupon code daalo.';
            $this->coupon_status  = 'error';
            return;
        }

      // ✅ Yeh karo - trim bhi add karo
$coupon = Coupon::where('code', strtoupper(trim($this->coupon_code)))
    ->where('is_active', true)
    ->first();

        if (!$coupon) {
            $this->coupon_message = 'Coupon nahi mila.';
            $this->coupon_status  = 'error';
            return;
        }

        if ($coupon->end_date && $coupon->end_date->isPast()) {
            $this->coupon_message = 'Coupon expire ho gaya.';
            $this->coupon_status  = 'error';
            return;
        }

        if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
            $this->coupon_message = 'Coupon limit khatam ho gayi.';
            $this->coupon_status  = 'error';
            return;
        }

        if ($coupon->min_order_amount && $this->subtotal < $coupon->min_order_amount) {
            $this->coupon_message = "Minimum order amount PKR {$coupon->min_order_amount} honi chahiye.";
            $this->coupon_status  = 'error';
            return;
        }

        if ($coupon->type === 'percentage') {
            $this->discount = ($this->subtotal * $coupon->value) / 100;
            if ($coupon->max_discount) {
                $this->discount = min($this->discount, $coupon->max_discount);
            }
        } else {
            $this->discount = min($coupon->value, $this->subtotal);
        }

        $this->appliedCoupon  = $coupon->toArray();
        $this->coupon_message = "Coupon apply ho gaya! PKR {$this->discount} discount mila.";
        $this->coupon_status  = 'success';
    }

    public function removeCoupon()
    {
        $this->coupon_code    = '';
        $this->discount       = 0;
        $this->appliedCoupon  = null;
        $this->coupon_message = '';
        $this->coupon_status  = '';
    }

    public function getSubtotalProperty(): float
    {
        return array_sum(array_column($this->cart, 'total'));
    }

    public function getShippingProperty(): float
    {
        return $this->subtotal > 0 ? 150 : 0;
    }

    public function getTotalProperty(): float
    {
        return $this->subtotal + $this->shipping - $this->discount;
    }

    protected function rules(): array
    {
        return [
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email',
            'customer_phone'   => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'billing_address'  => 'required|string',
            'payment_method'   => 'required|in:cod,bank_transfer,jazzcash,easypaisa',
        ];
    }

    protected function messages(): array
    {
        return [
            'customer_name.required'    => 'Naam zaroori hai.',
            'customer_email.required'   => 'Email zaroori hai.',
            'customer_phone.required'   => 'Phone number zaroori hai.',
            'shipping_address.required' => 'Shipping address zaroori hai.',
            'billing_address.required'  => 'Billing address zaroori hai.',
            'payment_method.required'   => 'Payment method choose karo.',
        ];
    }

    public function placeOrder()
    {
        if (empty($this->cart)) {
            $this->dispatch('notify', type: 'error', message: 'Cart khali hai!');
            return;
        }

        if ($this->same_address) {
            $this->billing_address = $this->shipping_address;
        }

        $this->validate();

        // COD ho to paid, warna pending
        $isCod          = $this->payment_method === 'cod';
        $paymentStatus  = $isCod ? 'paid'      : 'pending';
        $txnStatus      = $isCod ? 'completed' : 'pending';

        // Order create karo
        $order = Order::create([
            'order_number'     => 'ORD-' . strtoupper(Str::random(8)),
            'user_id'          => auth()->id(),
            'customer_name'    => $this->customer_name,
            'customer_email'   => $this->customer_email,
            'customer_phone'   => $this->customer_phone,
            'shipping_address' => $this->shipping_address,
            'billing_address'  => $this->billing_address,
            'subtotal'         => $this->subtotal,
            'tax'              => 0,
            'shipping_cost'    => $this->shipping,
            'discount'         => $this->discount,
            'total'            => $this->total,
            'payment_method'   => $this->payment_method,
            'payment_status'   => $paymentStatus,  // ✅ COD = paid
            'status'           => 'pending',
            'notes'            => $this->notes,
        ]);
        // ✅ NAYA CODE — Customer stats update
$customer = Customer::firstOrCreate(
    ['email' => $this->customer_email],
    [
        'name'    => $this->customer_name,
        'phone'   => $this->customer_phone,
        'address' => $this->shipping_address,
        'status'  => 'active',
    ]
);

$customer->increment('total_orders');
$customer->increment('total_spent', $this->total);
$customer->update(['last_order_at' => now()]);

        // Order items save karo
        foreach ($this->cart as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $item['product_id'],
                'product_name' => $item['name'],
                'product_sku'  => $item['sku'] ?? null,
                'quantity'     => $item['quantity'],
                'price'        => $item['price'],
                'total'        => $item['total'],
            ]);
        }

        // Transaction create karo
        \App\Models\Transaction::create([
            'transaction_id' => 'TXN-' . strtoupper(Str::random(8)),
            'order_id'       => $order->id,
            'user_id'        => auth()->id(),
            'amount'         => $this->total,
            'payment_method' => $this->payment_method,
            'status'         => $txnStatus,  // ✅ COD = completed
            'currency'       => 'PKR',
            'notes'          => $this->notes,
        ]);

        // Coupon use count update
        if ($this->appliedCoupon) {
            Coupon::find($this->appliedCoupon['id'])?->increment('used_count');
        }

        // Cart clear karo
        session()->forget('cart');

        return $this->redirect(route('order.success', $order->order_number), navigate: true);
    }

    public function render()
    {
        return view('livewire.frontend.checkout')
            ->layout('layouts.frontend');
    }
}