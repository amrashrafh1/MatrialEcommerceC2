<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamsResource extends JsonResource
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
            'image'            => $this->image,
            'job_title'        => $this->job_title,
            'linkdin_account'  => $this->linkdin_account,
            'facebook_account' => $this->facebook_account,
        ];    }
}
