<?php

use App\Http\Requests\Api\StoreOrderRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Auth logic apne hisaab se lagao
    }

    public function rules(): array
    {
        return [
            'order_number'             => 'nullable|string|unique:orders,order_number',
            'user_id'                  => 'nullable|exists:users,id',
            'customer_name'            => 'required|string|max:255',
            'customer_email'           => 'required|email|max:255',
            'customer_phone'           => 'nullable|string|max:20',
            'shipping_address'         => 'required|string',
            'billing_address'          => 'nullable|string',
            'subtotal'                 => 'required|numeric|min:0',
            'tax'                      => 'nullable|numeric|min:0',
            'shipping_cost'            => 'nullable|numeric|min:0',
            'discount'                 => 'nullable|numeric|min:0',
            'total'                    => 'required|numeric|min:0',
            'payment_method'           => 'required|string|max:100',
            'payment_status'           => 'nullable|in:pending,paid,failed,refunded',
            'status'                   => 'nullable|in:pending,processing,shipped,delivered,cancelled',
            'notes'                    => 'nullable|string',

            // Items validation
            'items'                    => 'required|array|min:1',
            'items.*.product_id'       => 'nullable|exists:products,id',
            'items.*.product_name'     => 'required|string|max:255',
            'items.*.product_sku'      => 'nullable|string|max:100',
            'items.*.quantity'         => 'required|integer|min:1',
            'items.*.price'            => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required'   => 'Customer ka naam zaroori hai.',
            'customer_email.required'  => 'Customer ki email zaroori hai.',
            'customer_email.email'     => 'Sahi email format dalo.',
            'shipping_address.required'=> 'Shipping address zaroori hai.',
            'subtotal.required'        => 'Subtotal zaroori hai.',
            'total.required'           => 'Total amount zaroori hai.',
            'payment_method.required'  => 'Payment method batao.',
            'items.required'           => 'Kam se kam ek item zaroori hai.',
            'items.min'                => 'Kam se kam ek item zaroori hai.',
            'items.*.product_name.required' => 'Har item ka naam zaroori hai.',
            'items.*.quantity.required'=> 'Har item ki quantity zaroori hai.',
            'items.*.price.required'   => 'Har item ka price zaroori hai.',
        ];
    }
}