<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url = 'https://restcountries.eu/rest/v2/all';
        $json = file_get_contents($url);
        $countries = json_decode($json);
        foreach($countries as $country) {
            \App\Country::create([
                'country_name' => $country->name,
                'nativeName'   => $country->nativeName,
                'callingCodes' => json_encode($country->callingCodes),
                'currencies'   => json_encode($country->currencies),
                'alpha3Code'   => $country->alpha3Code,
                'region'       => $country->region,
                'languages'    => json_encode($country->languages),
                'subregion'    => $country->subregion,
                'latlng'       => json_encode($country->latlng),
                'timezones'    => json_encode($country->timezones),
                'flag'         => $country->flag,
                'population'   => $country->population,
                'capital'      => $country->capital,
            ]);
        }

    }
}
