<?php
// ============================================================
// FILE 1: app/Http/Requests/Api/StoreTransactionRequest.php
// ============================================================
namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'transaction_id' => 'nullable|string|unique:transactions,transaction_id',
            'order_id'       => 'required|exists:orders,id',
            'user_id'        => 'nullable|exists:users,id',
            'amount'         => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:100',
            'status'         => 'nullable|in:pending,completed,failed,refunded',
            'currency'       => 'nullable|string|max:10',
            'notes'          => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'order_id.required'  => 'Order ID zaroori hai.',
            'order_id.exists'    => 'Yeh order exist nahi karta.',
            'amount.required'    => 'Amount zaroori hai.',
            'payment_method.required' => 'Payment method zaroori hai.',
        ];
    }
}