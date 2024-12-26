<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MenuCollection;

class MenuResource extends JsonResource
{

    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $childCollection = new MenuCollection($this->whenLoaded('childrens'));

        return [
            'id' => $this->id,
            'name' => $this->name,
            'route' => $this->route,
            'icon' => $this->icon,
            'type' => $this->type,
            'parent_id' => $this->parent_id,
            'sort' => $this->sort,
            'parent' => new self($this->whenLoaded('parent')),
            'childrens' => $childCollection->childrenCollection(),
            'roles' => $this->whenLoaded('roles')
        ];
    }
}
