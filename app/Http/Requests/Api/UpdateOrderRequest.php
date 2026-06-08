<?php

use App\Http\Requests\Api\UpdateOrderRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name'   => 'sometimes|string|max:255',
            'customer_email'  => 'sometimes|email|max:255',
            'customer_phone'  => 'nullable|string|max:20',
            'shipping_address'=> 'sometimes|string',
            'billing_address' => 'nullable|string',
            'subtotal'        => 'sometimes|numeric|min:0',
            'tax'             => 'nullable|numeric|min:0',
            'shipping_cost'   => 'nullable|numeric|min:0',
            'discount'        => 'nullable|numeric|min:0',
            'total'           => 'sometimes|numeric|min:0',
            'payment_method'  => 'sometimes|string|max:100',
            'payment_status'  => 'sometimes|in:pending,paid,failed,refunded',
            'status'          => 'sometimes|in:pending,processing,shipped,delivered,cancelled',
            'notes'           => 'nullable|string',
        ];
    }
}