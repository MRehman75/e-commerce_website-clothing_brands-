<?php
namespace App\Http\Requests\Api;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'title'          => 'sometimes|string|max:255',
            'subtitle'       => 'nullable|string|max:500',
            'image'          => 'sometimes|string|max:500',
            'link'           => 'nullable|string|max:500',
            'open_in_new_tab'=> 'boolean',
            'position'       => 'sometimes|in:homepage_top,homepage_middle,homepage_bottom,category_top,sidebar,popup',
            'starts_at'      => 'nullable|date',
            'ends_at'        => 'nullable|date|after_or_equal:starts_at',
            'sort_order'     => 'nullable|integer|min:0',
            'is_active'      => 'boolean',
        ];
    }
}