<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'code'             => 'sometimes|string|max:50|unique:coupons,code,' . $this->coupon->id,
            'type'             => 'sometimes|in:percentage,fixed',
            'value'            => 'sometimes|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_discount'     => 'nullable|numeric|min:0',
            'usage_limit'      => 'nullable|integer|min:1',
            'start_date'       => 'nullable|date',
            'end_date'         => 'nullable|date|after_or_equal:start_date',
            'is_active'        => 'boolean',
            'description'      => 'nullable|string|max:500',
        ];
    }
}