<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingZoneResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'region'    => $this->region,
            'countries' => $this->countries ?? [],
            'is_active' => $this->is_active,

            'shipping_methods' => $this->whenLoaded('shippingMethods', fn() =>
                ShippingMethodResource::collection($this->shippingMethods)
            ),

            'methods_count' => $this->whenLoaded('shippingMethods',
                fn() => $this->shippingMethods->count()
            ),

            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}