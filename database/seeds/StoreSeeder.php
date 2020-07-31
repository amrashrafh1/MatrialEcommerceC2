<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;
use App\Country;
class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'        => Str::random(10),
            'slug'        => Str::random(10),
            'description' => Str::random(190),
            'slug'        => Str::random(10),
            'cat_id'      => null
        ]);
       $country =  Country::find(1);
        \App\City::create([
            'city_name'  => Str::random(10),
            'country_id' => $country->id
        ]);
        $shipping = \App\ShippingCompany::create([
            'name'         => 'TechMarket for shipping',
            'facebook'     => 'www.website.com',
            'twitter'      => 'www.website.com',
            'website'      => 'www.website.com',
            'contact_name' => 'shop',
            'address'      => Str::random(10),
            'mobile'       => '01159168022',
            'email'        => 'ac@app.com',
            'icon'         => 'as',
            'country_id'   => $country->id,
        ]);
        $zone = \App\Zone::create([
            'name' => 'Europe',
        ]);
        $zone->countries()->attach($shipping);
        $zone->shippingcompanies()->attach($country);

        \App\Shipping_methods::create([
            'name'       => 'TechMarket standard shipping',
            'rule'       => 'flat_rate_per_order',
            'value'      => 20,
            'status'     => 1,
            'company_id' => $shipping->id,
            'zone_id'    => $zone->id,
        ]);
    }
}
