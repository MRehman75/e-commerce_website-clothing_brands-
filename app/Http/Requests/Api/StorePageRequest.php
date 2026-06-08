<?php
namespace App\Http\Requests\Api;
use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255|unique:pages,slug',
            'content'          => 'required|string',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_fixed'         => 'boolean',
            'is_active'        => 'boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required'   => 'Page ka title zaroori hai.',
            'content.required' => 'Content zaroori hai.',
        ];
    }
}