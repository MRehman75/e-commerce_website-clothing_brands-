<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            'phone'         => $this->phone ?? null,
            'address'       => $this->address ?? null,
            'verified'      => $this->email_verified_at ? true : false,
            'total_orders'  => $this->whenLoaded('orders', fn() => $this->orders->count(), 0),
            'joined_at'     => $this->created_at->format('d M Y h:i A'),
            'updated_at'    => $this->updated_at->format('d M Y h:i A'),
            
        ];
    }
}