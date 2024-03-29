<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;
use App\Country;
use App\Tradmark;
class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ' All in One PC','TV & Audio','Smart Phones & Tablets','Computers & Laptops',
            'Desktop PCs','Cameras & Photo','Video Games & Consoles'
        ];
        foreach($categories as $index => $category) {
            $num = $index + 1;
            Category::create([
                'name'        => $category,
                'slug'        => Str::random(10),
                'description' => Str::random(190),
                'image'       => 'public/categories/thumbnail/sm-'. $num .'.png',
                'parent_id'   => null
                ]);
        }

        $brands = ['Codecanyon','Themforest','3docean','videohive','graphicriver','activeden','photodune'];
        foreach($brands as $index => $brand) {
            $num = $index + 1;
            Tradmark::create([
                'name' => $brand,
                'slug' => Str::random(10),
                'logo' => 'public/tradmarks/thumbnail/'. $num .'.png',
                ]);
        }
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

        \App\SellerInfo::create([
            'approved'    => 1,
            'type'        => rand(0,1),
            'business'    => Str::random(100),
            'name'        => 'Beta market',
            'email'       => 'super@app.com',
            'slug'        => Str::slug('seller-website'),
            'address1'    => 'CHRIS NISWANDEE,SMALLSYS INC,795 E DRAGRAM,TUCSON AZ 85705,USA',
            'address2'    => 'CHRIS NISWANDEE,SMALLSYS INC,795 E DRAGRAM,TUCSON AZ 85705,USA',
            'address3'    => 'CHRIS NISWANDEE,SMALLSYS INC,795 E DRAGRAM,TUCSON AZ 85705,USA',
            'phone1'      => '(555) 555-1234',
            'phone2'      => '(555) 555-1234',
            'phone3'      => '(555) 555-1234',
            'city'        => Str::random(20),
            'state'       => Str::random(20),
            'country_id'  => rand(1, 100),
            'description' => Str::random(200),
            'seller_id'   => 4,
            ]);
        foreach(['size', 'color', 'length','width'] as $family) {

            $attribute_family = \App\Attribute_Family::create([
                'name'       => $family,
            ]);
            $attributes = [];
            if($family == 'size') {
                $attributes = ['XXL','XL','L','M'];
            } elseif($family == 'color') {
                $attributes = ['Red','Yellow','Black','Blue'];
            }elseif($family == 'length') {
                $attributes = ['100Cm','50Cm','75Cm','25Cm'];
            } elseif($family == 'width') {
                $attributes = ['250Cm','500Cm','750Cm','125Cm'];
            }
                foreach($attributes as $attribute) {
                    $attribute_family->attributes()->create([
                        'name' => $attribute
                    ]);
                }

        }
    }
}
