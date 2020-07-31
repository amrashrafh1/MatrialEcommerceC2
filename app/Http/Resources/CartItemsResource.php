<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AccessoriesResource;

class CartItemsResource extends JsonResource
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
            'product'  => new AccessoriesResource(\App\Product::where('id',$this->buyable_id)->first()),
            'quantity' => $this->quantity,
            'options' => $this->options,
        ];
    }
}
