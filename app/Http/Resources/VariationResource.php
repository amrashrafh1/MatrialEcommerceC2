<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VariationResource extends JsonResource
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
            'sku'            => $this->sku,
            'sale_price'     => $this->sale_price,
            'purchase_price' => $this->purchase_price,
            'stock'          => $this->stock,
            'in_stock'       => $this->in_stock,
            'visible'        => $this->visible,
            'attributes'       => AttributeResource::collection($this->attributes),
        ];
    }
}
