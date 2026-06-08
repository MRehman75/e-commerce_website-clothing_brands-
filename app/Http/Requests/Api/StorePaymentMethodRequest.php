<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentMethodRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:100',
            'code'        => 'required|string|max:50|unique:payment_methods,code',
            'icon'        => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'is_active'   => 'boolean',
            'sort_order'  => 'nullable|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Payment method ka naam zaroori hai.',
            'code.required' => 'Payment method ka code zaroori hai.',
            'code.unique'   => 'Yeh code pehle se exist karta hai.',
        ];
    }
}