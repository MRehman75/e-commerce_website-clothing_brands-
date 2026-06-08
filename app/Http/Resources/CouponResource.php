<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'code'             => $this->code,
            'type'             => $this->type,
            'value'            => (float) $this->value,
            'min_order_amount' => (float) $this->min_order_amount,
            'max_discount'     => (float) $this->max_discount,
            'usage_limit'      => $this->usage_limit,
            'used_count'       => $this->used_count,
            'remaining_uses'   => $this->usage_limit
                                    ? ($this->usage_limit - $this->used_count)
                                    : 'unlimited',
            'start_date'       => $this->start_date?->toDateString(),
            'end_date'         => $this->end_date?->toDateString(),
            'is_active'        => $this->is_active,
            'status'           => $this->status,
            'status_color'     => $this->status_color,
            'description'      => $this->description,
            'created_at'       => $this->created_at?->toDateTimeString(),
            'updated_at'       => $this->updated_at?->toDateTimeString(),
        ];
    }
}