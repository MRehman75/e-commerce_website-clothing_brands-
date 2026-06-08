<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'transaction_id' => $this->transaction_id,
            'amount'         => (float) $this->amount,
            'currency'       => $this->currency ?? 'PKR',
            'payment_method' => $this->payment_method,
            'status'         => $this->status,
            'status_color'   => $this->status_color,
            'notes'          => $this->notes,

            // Related order
            'order' => $this->whenLoaded('order', fn() => [
                'id'           => $this->order->id,
                'order_number' => $this->order->order_number,
                'total'        => (float) $this->order->total,
            ]),

            // Related user
            'user' => $this->whenLoaded('user', fn() => [
                'id'    => $this->user->id,
                'name'  => $this->user->name,
                'email' => $this->user->email,
            ]),

            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}