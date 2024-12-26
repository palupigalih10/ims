<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MenuCollection extends ResourceCollection
{
    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public $preserveKeys = true;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $data =  $this->collection->transform(function ($menu) {
            return new MenuResource($menu);
        });

        return $data;
    }

    public  function childrenCollection()
    {
        return $this->collection ? collect($this->collection)->transform(function ($menu) {
            return new MenuResource($menu);
        }) : null;
    }
}
