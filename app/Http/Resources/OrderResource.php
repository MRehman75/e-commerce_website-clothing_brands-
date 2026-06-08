<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'order_number'     => $this->order_number,
            'status'           => $this->status,
            'status_color'     => $this->status_color,   // Model accessor
            'payment_status'   => $this->payment_status,
            'payment_method'   => $this->payment_method,

            // Customer info
            'customer' => [
                'name'  => $this->customer_name,
                'email' => $this->customer_email,
                'phone' => $this->customer_phone,
            ],

            // Addresses
            'shipping_address' => $this->shipping_address,
            'billing_address'  => $this->billing_address,

            // Pricing
            'pricing' => [
                'subtotal'      => (float) $this->subtotal,
                'tax'           => (float) $this->tax,
                'shipping_cost' => (float) $this->shipping_cost,
                'discount'      => (float) $this->discount,
                'total'         => (float) $this->total,
            ],

            'notes' => $this->notes,

            // Related user (agar load ho)
            'user' => $this->whenLoaded('user', fn() => [
                'id'    => $this->user->id,
                'name'  => $this->user->name,
                'email' => $this->user->email,
            ]),

            // Order items
            'items' => $this->whenLoaded('items', fn() =>
                $this->items->map(fn($item) => [
                    'id'           => $item->id,
                    'product_id'   => $item->product_id,
                    'product_name' => $item->product_name,
                    'product_sku'  => $item->product_sku,
                    'quantity'     => $item->quantity,
                    'price'        => (float) $item->price,
                    'total'        => (float) $item->total,
                ])
            ),

            'items_count' => $this->whenLoaded('items', fn() => $this->items->count()),

            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}