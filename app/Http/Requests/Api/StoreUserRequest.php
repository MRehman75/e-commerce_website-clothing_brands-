<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'roles'    => 'nullable|array',
            'roles.*'  => 'exists:roles,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Naam zaroori hai.',
            'email.required'    => 'Email zaroori hai.',
            'email.unique'      => 'Yeh email pehle se registered hai.',
            'password.required' => 'Password zaroori hai.',
            'password.min'      => 'Password kam az kam 8 characters ka hona chahiye.',
            'password.confirmed'=> 'Password confirm nahi hua.',
        ];
    }
}