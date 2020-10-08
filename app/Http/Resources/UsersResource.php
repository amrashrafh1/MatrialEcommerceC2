<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CartResource;

class UsersResource extends JsonResource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'role'              => $this->roles->last()->display_name,
            'last_name'         => $this->last_name,
            'email'             => $this->email,
            'image'             => $this->image,
            'phone'             => $this->phone,
            'email_verified_at' => $this->email_verified_at,
            'address'           => $this->address,
            'city'              => $this->city,
            'state'             => $this->state,
            'postcode'          => $this->postcode,
            'chat_status'       => $this->chat_status,
            'country'           => new CountryResource($this->country),
            'carts'             => CartResource::collection(\DB::table('carts')->where('user_id',$this->id)->get()),
        ];
    }
}
