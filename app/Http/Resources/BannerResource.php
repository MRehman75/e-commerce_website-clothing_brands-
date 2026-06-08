<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'subtitle'       => $this->subtitle,
          
// ✅ Yeh karo
'image' => $this->image ? asset('storage/' . $this->image) : null,
            'link'           => $this->link,
            'open_in_new_tab'=> $this->open_in_new_tab,
            'position'       => $this->position,
            'position_label' => $this->position_label,
            'starts_at'      => $this->starts_at?->toDateString(),
            'ends_at'        => $this->ends_at?->toDateString(),
            'sort_order'     => $this->sort_order,
            'is_active'      => $this->is_active,
            'is_running'     => $this->is_running,
            'created_at'     => $this->created_at?->toDateTimeString(),
            'updated_at'     => $this->updated_at?->toDateTimeString(),
        ];
    }
}