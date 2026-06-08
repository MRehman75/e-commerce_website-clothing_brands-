<?php

// ============================================================
// StoreBannerRequest
// ============================================================
namespace App\Http\Requests\Api;
use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'title'          => 'required|string|max:255',
            'subtitle'       => 'nullable|string|max:500',
            'image'          => 'required|string|max:500',
            'link'           => 'nullable|string|max:500',
            'open_in_new_tab'=> 'boolean',
            'position'       => 'required|in:homepage_top,homepage_middle,homepage_bottom,category_top,sidebar,popup',
            'starts_at'      => 'nullable|date',
            'ends_at'        => 'nullable|date|after_or_equal:starts_at',
            'sort_order'     => 'nullable|integer|min:0',
            'is_active'      => 'boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required'    => 'Banner ka title zaroori hai.',
            'image.required'    => 'Banner ki image zaroori hai.',
            'position.required' => 'Banner ki position zaroori hai.',
            'position.in'       => 'Sahi position choose karo.',
        ];
    }
}