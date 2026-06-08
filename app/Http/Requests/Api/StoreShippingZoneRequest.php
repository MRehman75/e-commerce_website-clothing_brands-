<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreShippingMethodRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'shipping_zone_id'    => 'required|exists:shipping_zones,id',
            'name'                => 'required|string|max:255',
            'carrier'             => 'nullable|string|max:100',
            'rate_type'           => 'required|in:flat,free,percentage',
            'rate'                => 'required|numeric|min:0',
            'min_order_amount'    => 'nullable|numeric|min:0',
            'estimated_days_min'  => 'nullable|integer|min:0',
            'estimated_days_max'  => 'nullable|integer|min:0|gte:estimated_days_min',
            'is_active'           => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'shipping_zone_id.required' => 'Shipping zone zaroori hai.',
            'shipping_zone_id.exists'   => 'Yeh shipping zone exist nahi karta.',
            'name.required'             => 'Method ka naam zaroori hai.',
            'rate_type.required'        => 'Rate type zaroori hai (flat, free, percentage).',
            'rate.required'             => 'Rate zaroori hai.',
            'estimated_days_max.gte'    => 'Max days, min days se kam nahi ho sakta.',
        ];
    }
}