<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFlashSaleRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title'               => 'sometimes|string|max:255',
            'description'         => 'nullable|string|max:1000',
            'discount_percentage' => 'sometimes|numeric|min:1|max:100',
            'start_time'          => 'sometimes|date',
            'end_time'            => 'sometimes|date|after:start_time',
            'is_active'           => 'boolean',
        ];
    }
}