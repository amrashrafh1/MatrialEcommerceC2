<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponsResource extends JsonResource
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
            'code'       => $this->code,
            'is_USD'     => ($this->is_usd)?'USD':'Percentage',
            'reward'     => $this->reward,
            'expires_at' => $this->expires_at,
        ];
    }
}
