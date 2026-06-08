<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShippingZoneRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'        => 'sometimes|string|max:255',
            'region'      => 'nullable|string|max:255',
            'countries'   => 'nullable|array',
            'countries.*' => 'string|max:5',
            'is_active'   => 'boolean',
        ];
    }
}