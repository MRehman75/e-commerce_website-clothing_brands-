<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'location'  => $this->location,
            'is_active' => $this->is_active,
            'items'     => $this->whenLoaded('rootItems', fn() =>
                $this->rootItems->map(fn($item) => [
                    'id'             => $item->id,
                    'label'          => $item->label,
                    'url'            => $item->url,
                    'icon'           => $item->icon,
                    'open_in_new_tab'=> $item->open_in_new_tab,
                    'sort_order'     => $item->sort_order,
                    'is_active'      => $item->is_active,
                    'children'       => $item->children->map(fn($child) => [
                        'id'             => $child->id,
                        'label'          => $child->label,
                        'url'            => $child->url,
                        'icon'           => $child->icon,
                        'open_in_new_tab'=> $child->open_in_new_tab,
                        'sort_order'     => $child->sort_order,
                        'is_active'      => $child->is_active,
                    ]),
                ])
            ),
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}