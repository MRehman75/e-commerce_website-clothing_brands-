<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingMethodResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'name'                => $this->name,
            'carrier'             => $this->carrier,
            'rate_type'           => $this->rate_type,
            'rate'                => (float) $this->rate,
            'min_order_amount'    => (float) $this->min_order_amount,
            'estimated_days_min'  => $this->estimated_days_min,
            'estimated_days_max'  => $this->estimated_days_max,
            'estimated_delivery'  => $this->getEstimatedDelivery(),
            'is_active'           => $this->is_active,

            'shipping_zone' => $this->whenLoaded('shippingZone', fn() => [
                'id'     => $this->shippingZone->id,
                'name'   => $this->shippingZone->name,
                'region' => $this->shippingZone->region,
            ]),

            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}