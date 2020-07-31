<?php

namespace App\Http\Resources;

use App\Attribute_Family;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AttributeFamilyResource;
class AttributeResource extends JsonResource
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
          'id'     => $this->id,
          'name'   => $this->name,
          'parent' => \App\Attribute_Family::where('id',$this->family_id)->select('name', 'id')->get(),
        ];
    }
}
