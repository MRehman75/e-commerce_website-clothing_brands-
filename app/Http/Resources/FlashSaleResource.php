<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlashSaleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $now = now();
        $timeRemaining = null;

        if ($this->end_time && $this->end_time->isFuture()) {
            $diff = $now->diff($this->end_time);
            $timeRemaining = [
                'hours'   => $diff->h + ($diff->days * 24),
                'minutes' => $diff->i,
                'seconds' => $diff->s,
            ];
        }

        return [
            'id'                  => $this->id,
            'title'               => $this->title,
            'description'         => $this->description,
            'discount_percentage' => (float) $this->discount_percentage,
            'start_time'          => $this->start_time?->toDateTimeString(),
            'end_time'            => $this->end_time?->toDateTimeString(),
            'is_active'           => $this->is_active,
            'status'              => $this->status,
            'status_color'        => $this->status_color,
            'time_remaining'      => $timeRemaining,
            'created_at'          => $this->created_at?->toDateTimeString(),
            'updated_at'          => $this->updated_at?->toDateTimeString(),
        ];
    }
}