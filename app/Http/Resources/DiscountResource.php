<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AccessoriesResource;

class DiscountResource extends JsonResource
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
            'condition'      => $this->condition,
            'start_at'       => $this->start_at,
            'expire_at'      => $this->expire_at,
            'amount'         => $this->amount,
            'daily'          => $this->daily,
            'max_quantity'   => $this->max_quantity,
            'buy_x_quantity' => $this->buy_x_quantity,
            'y_quantity'     => $this->y_quantity,
            'product_y'      => ($this->condition === 'buy_x_and_get_y_free')? new AccessoriesResource($this->productY):null,
        ];
    }
}
