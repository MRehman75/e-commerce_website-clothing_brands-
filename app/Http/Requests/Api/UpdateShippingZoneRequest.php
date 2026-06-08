<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShippingMethodRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'shipping_zone_id'   => 'sometimes|exists:shipping_zones,id',
            'name'               => 'sometimes|string|max:255',
            'carrier'            => 'nullable|string|max:100',
            'rate_type'          => 'sometimes|in:flat,free,percentage',
            'rate'               => 'sometimes|numeric|min:0',
            'min_order_amount'   => 'nullable|numeric|min:0',
            'estimated_days_min' => 'nullable|integer|min:0',
            'estimated_days_max' => 'nullable|integer|min:0',
            'is_active'          => 'boolean',
        ];
    }
}