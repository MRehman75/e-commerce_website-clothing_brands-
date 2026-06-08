<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreFlashSaleRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title'               => 'required|string|max:255',
            'description'         => 'nullable|string|max:1000',
            'discount_percentage' => 'required|numeric|min:1|max:100',
            'start_time'          => 'required|date',
            'end_time'            => 'required|date|after:start_time',
            'is_active'           => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'               => 'Flash Sale ka title zaroori hai.',
            'discount_percentage.required' => 'Discount percentage zaroori hai.',
            'discount_percentage.max'      => 'Discount 100% se zyada nahi ho sakta.',
            'start_time.required'          => 'Start time zaroori hai.',
            'end_time.required'            => 'End time zaroori hai.',
            'end_time.after'               => 'End time, start time ke baad honi chahiye.',
        ];
    }
}