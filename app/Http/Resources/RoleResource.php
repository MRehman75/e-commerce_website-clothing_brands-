<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'description' => $this->description,
            'permissions' => $this->whenLoaded('permissions', fn() =>
                $this->permissions->map(fn($p) => [
                    'id'     => $p->id,
                    'name'   => $p->name,
                    'slug'   => $p->slug,
                    'module' => $p->module,
                ])
            ),
            'users_count' => $this->whenLoaded('users', fn() => $this->users->count()),
            'created_at'  => $this->created_at?->toDateTimeString(),
            'updated_at'  => $this->updated_at?->toDateTimeString(),
        ];
    }
}