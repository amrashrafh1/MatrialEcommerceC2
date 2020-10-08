<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
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
            'name'      => $this->name,
            'size'      => $this->size,
            'file'      => $this->file,
            'path'      => $this->path,
            'mime_type' => $this->mime_type,
        ];
    }
}
