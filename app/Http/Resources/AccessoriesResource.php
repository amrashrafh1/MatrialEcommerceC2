<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccessoriesResource extends JsonResource
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
            'id'               => $this->id,
            'name'             => $this->name,
            'slug'             => $this->slug,
            'sku'              => $this->sku,
            'product_type'     => $this->product_type,
            'sale_price'       => $this->sale_price,
            'stock'            => $this->stock,
            'size'             => $this->size,
            'color'            => $this->color,
            'description'      => $this->description,
            'image'            => $this->image,
            'owner'            => $this->owner,
            'length'           => $this->length,
            'width'            => $this->width,
            'height'           => $this->height,
            'weight'           => $this->weight,
            'in_stock'         => $this->in_stock,
            'visible'          => $this->visible,
            'tax'              => $this->tax,
            'variations'       => VariationResource::collection($this->variations),
            'attributes'       => AttributeResource::collection($this->attributes),
            'files'            => FileResource::collection($this->gallery),

        ];
    }
}
