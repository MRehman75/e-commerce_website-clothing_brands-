<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    public function toArray(Request $request): array
{
    return [
        'id'          => $this->id,
        'title'       => $this->title,
        'subtitle'    => $this->subtitle,
        'button_text' => $this->button_text,
        'button_link' => $this->button_link,
      'image' => $this->image ? asset('storage/' . $this->image) : null,
        'badge_color' => $this->badge_color,
        'sort_order'  => $this->sort_order,
        'is_active'   => $this->is_active,
        'created_at'  => $this->created_at?->toDateTimeString(),
        'updated_at'  => $this->updated_at?->toDateTimeString(),
    ];
}
}