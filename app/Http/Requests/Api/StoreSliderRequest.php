<?php
namespace App\Http\Requests\Api;
use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
       return [
        'title'       => 'nullable|string|max:255',
        'subtitle'    => 'nullable|string|max:255',
        'button_text' => 'nullable|string|max:100',
        'button_link' => 'nullable|string|max:500',
        'image'       => 'required|string|max:500',
        'badge_color' => 'nullable|in:primary,success,danger,warning,info',
        'sort_order'  => 'nullable|integer|min:0',
        'is_active'   => 'boolean',
    ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Slider ka title zaroori hai.',
            'image.required' => 'Slider ki image zaroori hai.',
        ];
    }
}