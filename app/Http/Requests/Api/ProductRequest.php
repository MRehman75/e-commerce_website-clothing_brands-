<?php
namespace App\Http\Requests\Api;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'stock'         => 'required|numeric|min:0',
            'category_id'   => 'required|exists:categories,id',
            'brand_id'      => 'required|exists:brands,id',
            'status'        => 'in:active,inactive',
            'description'   => 'nullable|string',
            'compare_price' => 'nullable|numeric',
            'image'         => 'nullable|string',
        ];
    }
}