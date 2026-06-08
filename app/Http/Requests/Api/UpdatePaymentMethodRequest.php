<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentMethodRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'        => 'sometimes|string|max:100',
            'code'        => 'sometimes|string|max:50|unique:payment_methods,code,' . $this->paymentMethod?->id,
            'icon'        => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'is_active'   => 'boolean',
            'sort_order'  => 'nullable|integer|min:0',
        ];
    }
}