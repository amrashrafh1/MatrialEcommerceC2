<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdzResource extends JsonResource
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
            'id'        => $this->id,
            'header'    => $this->header,
            'image'     => $this->image,
            'body'      => $this->body,
            'link'      => $this->link,
            'start_at'  => $this->start_at,
            'expire_at' => $this->expire_at,
            'status'    => $this->status,
        ];
    }
}
