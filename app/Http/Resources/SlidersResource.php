<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SlidersResource extends JsonResource
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
            'header' => $this->header,
            'image'  => $this->image,
            'body'   => $this->body,
            'link'   => $this->link,
            'status' => $this->status,
        ];
    }
}
