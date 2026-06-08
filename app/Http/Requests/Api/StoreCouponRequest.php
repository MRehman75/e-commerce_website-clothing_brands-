<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code'             => 'required|string|max:50|unique:coupons,code',
            'type'             => 'required|in:percentage,fixed',
            'value'            => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_discount'     => 'nullable|numeric|min:0',
            'usage_limit'      => 'nullable|integer|min:1',
            'start_date'       => 'nullable|date',
            'end_date'         => 'nullable|date|after_or_equal:start_date',
            'is_active'        => 'boolean',
            'description'      => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required'  => 'Coupon code zaroori hai.',
            'code.unique'    => 'Yeh code pehle se exist karta hai.',
            'type.required'  => 'Coupon type zaroori hai (percentage ya fixed).',
            'type.in'        => 'Type sirf percentage ya fixed ho sakta hai.',
            'value.required' => 'Coupon ki value zaroori hai.',
            'end_date.after_or_equal' => 'End date, start date ke baad honi chahiye.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->code) {
            $this->merge(['code' => strtoupper($this->code)]);
        }
    }
}