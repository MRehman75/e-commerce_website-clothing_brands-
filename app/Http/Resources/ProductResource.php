<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'slug'          => $this->slug,
            'sku'           => $this->sku,
            'description'   => $this->description,
            'price'         => $this->price,
            'compare_price' => $this->compare_price,
            'stock'         => $this->stock,
           'image' => $this->image ? asset('storage/' . $this->image) : null,
            'image_url'     => $this->image_url,
            'gallery'       => $this->gallery,
            'status'        => $this->status,
            'featured'      => $this->featured,
            'category'      => [
                'id'   => $this->category?->id,
                'name' => $this->category?->name,
                'image'=> $this->category?->image,
            ],
            'brand' => [
                'id'   => $this->brand?->id,
                'name' => $this->brand?->name,
                'logo' => $this->brand?->logo,
            ],
           'created_at' => $this->created_at?->format('d M Y h:i A'),
'updated_at' => $this->updated_at?->format('d M Y h:i A'),
        ];
    }
}