<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Carts;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

class Checkout extends Component
{
    public $cartItems = [];
    public $subtotal = 0;
    public $tax = 0;
    public $shipping = 0;
    public $grandTotal = 0;

    // Shipping Information
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $address;
    public $city = null;
    public $state;
    public $postal_code;

    public $showConfirmModal = false;
    public $orderSuccess = false;
    public $orderNumber = null;
    public $shakeFields = [];

    // Pakistani Cities
    public $cities = [
        'Karachi', 'Hyderabad', 'Sukkur', 'Larkana', 'Mirpur Khas',
        'Nawabshah', 'Khairpur', 'Jacobabad', 'Shikarpur', 'Dadu',
        'Tando Adam', 'Tando Allahyar', 'Badin', 'Thatta', 'Kotri',
        'Matiari', 'Umerkot', 'Sanghar', 'Ghotki',
        'Lahore', 'Rawalpindi', 'Faisalabad', 'Multan', 'Gujranwala',
        'Sialkot', 'Bahawalpur', 'Sargodha', 'Sheikhupura', 'Rahim Yar Khan',
        'Jhang', 'Dera Ghazi Khan', 'Gujrat', 'Sahiwal', 'Wah Cantonment',
        'Okara', 'Chiniot', 'Kasur', 'Mandi Bahauddin', 'Hafizabad',
        'Khanewal', 'Muzaffargarh', 'Vehari', 'Pakpattan', 'Attock',
        'Jhelum', 'Chakwal', 'Toba Tek Singh', 'Lodhran', 'Narowal',
        'Bhakkar', 'Mianwali', 'Layyah', 'Rajanpur',
        'Peshawar', 'Mardan', 'Mingora', 'Abbottabad', 'Mansehra',
        'Kohat', 'Dera Ismail Khan', 'Bannu', 'Nowshera', 'Charsadda',
        'Swabi', 'Haripur', 'Karak', 'Hangu', 'Chitral',
        'Dir', 'Timergara', 'Batkhela', 'Tank', 'Lakki Marwat',
        'Quetta', 'Gwadar', 'Turbat', 'Khuzdar', 'Chaman',
        'Sibi', 'Zhob', 'Loralai', 'Dera Murad Jamali', 'Hub',
        'Kalat', 'Mastung', 'Pishin', 'Nushki', 'Dalbandin',
        'Islamabad',
        'Gilgit', 'Skardu', 'Chilas', 'Hunza', 'Gahkuch',
        'Danyor', 'Khaplu', 'Shigar',
        'Muzaffarabad', 'Mirpur', 'Rawalakot', 'Kotli', 'Bagh',
        'Bhimber', 'Pallandri', 'Hattian Bala',  
    ];

    public $provinces = [
        'Punjab', 'Sindh', 'Khyber Pakhtunkhwa', 'Balochistan',
        'Islamabad Capital Territory', 'Gilgit-Baltistan', 'Azad Kashmir'
    ];

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'required|string|size:11|regex:/^03[0-9]{9}$/',
        'address' => 'required|string|max:500',
        'city' => 'required|string|max:100',
        'state' => 'required|string|max:100',
        'postal_code' => 'required|string|max:20',
    ];

    public function mount()
    {
        $this->loadCart();
        $this->loadUserData();
    }

    public function loadCart()
    {
        $this->cartItems = [];
        
        if (auth()->check()) {
            $userId = auth()->id();
            
            $dbCartItems = Carts::with('product')
                ->where('user_id', $userId)
                ->get();

            if ($dbCartItems->isNotEmpty()) {
                foreach ($dbCartItems as $item) {
                    if ($item->product) {
                        $this->cartItems[] = [
                            'id' => $item->id,
                            'product_id' => $item->product_id,
                            'name' => $item->product->name,
                            'price' => floatval($item->product->price),
                            'image' => $item->product->image,
                            'quantity' => $item->quantity,
                            'size' => $item->size,
                            'color' => $item->color,
                            'subtotal' => floatval($item->product->price) * $item->quantity,
                        ];
                    }
                }
            }
        }
        
        if (empty($this->cartItems)) {
            $sessionCart = session()->get('cart', []);
            
            foreach ($sessionCart as $key => $item) {
                if (isset($item['name']) && isset($item['price'])) {
                    $product = Product::find($item['id'] ?? null);
                    
                    $this->cartItems[] = [
                        'id' => $key,
                        'product_id' => $item['id'] ?? null,
                        'name' => $item['name'],
                        'price' => floatval($item['price']),
                        'image' => $item['image'] ?? null,
                        'quantity' => intval($item['quantity'] ?? 1),
                        'size' => $item['size'] ?? null,
                        'color' => $item['color'] ?? null,
                        'subtotal' => floatval($item['price']) * intval($item['quantity'] ?? 1),
                    ];
                }
            }
        }

        if (empty($this->cartItems)) {
            session()->flash('error', 'Your cart is empty.');
            return redirect()->route('cart');
        }

        $this->calculateTotals();
    }

    public function loadUserData()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $nameParts = explode(' ', $user->name, 2);

            $this->first_name = $nameParts[0] ?? '';
            $this->last_name = $nameParts[1] ?? '';
            $this->email = $user->email;
            $this->phone = $user->phone ?? '';
        }
    }

    public function calculateTotals()
    {
        $this->subtotal = collect($this->cartItems)->sum('subtotal');
        $this->tax = $this->subtotal * 0.10;
        $this->shipping = $this->subtotal > 100 ? 0 : 10;
        $this->grandTotal = $this->subtotal + $this->tax + $this->shipping;
    }

    public function generateOrderNumber()
    {
        $lastOrder = Order::orderBy('id', 'desc')->first();
        $nextNumber = $lastOrder ? intval(substr($lastOrder->order_number, 4)) + 1 : 1;
        return 'ORD-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }

    public function openConfirmModal()
    {
        $this->shakeFields = [];
        $this->validate();
        $this->showConfirmModal = true;
        $this->dispatch('modal-opened');
    }

    public function closeConfirmModal()
    {
        $this->showConfirmModal = false;
        $this->dispatch('modal-closed');
    }

    public function confirmOrder()
    {
        $this->validate();

        // ============================================================
        // 1. CUSTOMER CREATE/UPDATE (HAR USER KI ENTRY)
        // ============================================================
        
        // Agar email hai toh email se find karo, warna phone se
      if (!empty($this->email)) {
    $customer = Customer::updateOrCreate(
        ['email' => $this->email],
        [
            'name' => $this->first_name . ' ' . $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'address' => $this->address,
            'status' => 'active',
        ]
    );
} else {
    $customer = Customer::updateOrCreate(
        ['phone' => $this->phone],
        [
            'name' => $this->first_name . ' ' . $this->last_name,
            'email' => null,  // ✅ Explicitly set null
            'phone' => $this->phone,
            'city' => $this->city,
            'address' => $this->address,
            'status' => 'active',
        ]
    );
}

        // ✅ Ye customer ki ID hi user_id hogi
        $customerId = $customer->id;

        // ============================================================
        // 2. ORDER CREATE
        // ============================================================
        
        $order = Order::create([
            'order_number' => $this->generateOrderNumber(),
            'user_id' => $customerId,  // ← Customer ID as user_id
            'customer_name' => $this->first_name . ' ' . $this->last_name,
            'customer_email' => $this->email,
            'customer_phone' => $this->phone,
            'shipping_address' => $this->address . ', ' . $this->city . ', ' . $this->state . ' - ' . $this->postal_code,
            'billing_address' => $this->address . ', ' . $this->city . ', ' . $this->state . ' - ' . $this->postal_code,
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'shipping_cost' => $this->shipping,
            'discount' => 0,
            'total' => $this->grandTotal,
            'payment_method' => 'cash_on_delivery',
            'payment_status' => 'pending',
            'status' => 'pending',
        ]);

        // ============================================================
        // 3. ORDER ITEMS CREATE
        // ============================================================
        
        foreach ($this->cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['name'],
                'product_sku' => null,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['subtotal'],
                'size' => $item['size'] ?? null,   // ✅ Add this
                'color' => $item['color'] ?? null,
            ]);
        }

        // ============================================================
        // 4. CART CLEAR
        // ============================================================
        
        if (auth()->check()) {
            Carts::where('user_id', auth()->id())->delete();
        }
        session()->forget('cart');

        $this->showConfirmModal = false;
        $this->dispatch('cartUpdated');

        return redirect()->route('thankyou', ['orderId' => $order->id]);
    }

    public function render()
    {
        return view('livewire.checkout')
            ->layout('components.layouts.app');
    }
}