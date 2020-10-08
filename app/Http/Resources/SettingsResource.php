<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\ShippingMethodResource;

class SettingsResource extends JsonResource
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
            'sitename'            => $this->sitename,
            'mobile'              => $this->mobile,
            'location'            => $this->location,
            'email'               => $this->email,
            'logo'                => $this->logo,
            'icon'                => $this->icon,
            'system_status'       => $this->system_status,
            'system_message'      => $this->system_message,
            'fees'                => $this->fees,
            'paypal'              => $this->paypal,
            'stripe'              => $this->stripe,
            'facebook'            => $this->facebook,
            'twitter'             => $this->twitter,
            'login_with_facebook' => $this->facebook_login,
            'login_with_twitter'  => $this->twitter_login,
            'login_with_google'   => $this->google_login,
            'login_with_github'   => $this->github,
            'default_shipping'    => $this->default_shipping,
            'shipping_method'     => new ShippingMethodResource($this->shipping),
            'seller_countries'    => CountryResource::collection($this->seller_countries),
        ];
    }
}
