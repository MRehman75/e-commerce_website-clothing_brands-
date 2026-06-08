<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityLogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'action'      => $this->action,
            'module'      => $this->module,
            'description' => $this->description,
            'ip_address'  => $this->ip_address,
            'user_agent'  => $this->user_agent,
            'user'        => $this->whenLoaded('user', fn() => [
                'id'    => $this->user->id,
                'name'  => $this->user->name,
                'email' => $this->user->email,
            ]),
            'created_at'  => $this->created_at?->toDateTimeString(),
        ];
    }
}