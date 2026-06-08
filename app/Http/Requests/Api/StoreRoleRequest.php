<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:100',
            'slug'          => 'required|string|max:100|unique:roles,slug',
            'description'   => 'nullable|string|max:500',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Role ka naam zaroori hai.',
            'slug.required' => 'Role ka slug zaroori hai.',
            'slug.unique'   => 'Yeh slug pehle se exist karta hai.',
        ];
    }
}