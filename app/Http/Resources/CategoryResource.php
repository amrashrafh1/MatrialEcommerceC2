<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */



    public function toArray($request)
    {
        return [
            'name'        => $this->name,
            'slug'        => $this->slug,
            'image'       => $this->image,
            'description' => $this->description,
            'status'      => $this->status,
            'children'    => CategoryResource::collection($this->whenLoaded('categories')),
            'parent'      => new CategoryResource($this->whenLoaded('parent')),
        ];
    }
}
