<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title'       => (string) $this->title,
            'publish_at'  => $this->publish_at,
            'slug'        => (string) $this->slug,
            'content'     => $this->content,
            'image'       => $this->image,
            'commentable' => $this->commentable,
            'user_id'     => $this->user_id,
          ];
        }
}
