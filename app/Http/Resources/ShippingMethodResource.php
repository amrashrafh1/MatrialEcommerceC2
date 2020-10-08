<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ShippingCompanyResource;
use App\Http\Resources\ShippingZoneResource;

class ShippingMethodResource extends JsonResource
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
            'rule'             => $this->rule,
            'weight'           => $this->weight,
            'value'            => $this->value,
            'status'           => $this->status,
            'display_text'     => $this->display_text,
            'range'            => $this->rates,
            'shipping_company' => new ShippingCompanyResource($this->shippingcompany),
            'zone'             => new ShippingZoneResource($this->zone),
        ];
    }
}
