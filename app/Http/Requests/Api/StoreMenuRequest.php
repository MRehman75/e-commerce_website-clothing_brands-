<?php
namespace App\Http\Requests\Api;
use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:100',
            'location'  => 'required|in:header,footer,mobile',
            'is_active' => 'boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'     => 'Menu ka naam zaroori hai.',
            'location.required' => 'Menu ki location zaroori hai.',
            'location.in'       => 'Location sirf header, footer, ya mobile ho sakti hai.',
        ];
    }
}