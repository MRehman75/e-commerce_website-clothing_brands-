<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'amount'         => 'sometimes|numeric|min:0',
            'payment_method' => 'sometimes|string|max:100',
            'status'         => 'sometimes|in:pending,completed,failed,refunded',
            'currency'       => 'nullable|string|max:10',
            'notes'          => 'nullable|string|max:500',
        ];
    }
}