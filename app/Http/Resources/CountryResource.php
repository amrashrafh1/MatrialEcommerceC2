<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'id'           => $this->id,
            'country_name' => $this->country_name,
            'nativeName'   => $this->nativeName,
            'callingCodes' => $this->callingCodes,
            'currencies'   => $this->currencies,
            'alpha3Code'   => $this->alpha3Code,
            'region'       => $this->region,
            'languages'    => $this->languages,
            'subregion'    => $this->subregion,
            'latlng'       => $this->latlng,
            'timezones'    => $this->timezones,
            'flag'         => $this->flag,
            'population'   => $this->population,
            'capital'      => $this->capital,
        ];
    }
}
