<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker){
    return [
        'name'              => 'Smart Watches 3 SWR50',
        'slug'              => $faker->slug,
        'sku'               => \Str::random(10),
        'product_type'      => 'simple',//$faker->randomElement(['simple','variable']),
        'sale_price'        => $faker->randomFloat(2,1,10),
        'purchase_price'    => $faker->randomFloat(2,1,10),
        'stock'             => $faker->randomNumber(3),
        'size'              => '40″',
        'color'             => 'Red',
        'description'       => $faker->text,
        'short_description' => $faker->text,
        'image'             => 'public/products/thumbnail/'.rand(1, 17).'.jpg',
        'tradmark_id'       => rand(1,7),
        'user_id'           => $faker->randomElement([1, 4]),
        'seller_id'         => 1,
        'owner'             => $faker->randomElement(['for_seller','for_site_owner']),
        'approved'          => 1,
        'category_id'       => rand(1,7),
        'length'            => $faker->randomNumber(2),
        'width'             => $faker->randomNumber(2),
        'height'            => $faker->randomNumber(2),
        'weight'            => $faker->randomNumber(2),
        'in_stock'          => $faker->randomElement(['in_stock','out_stock']),
        'visible'           => $faker->randomElement(['visible','hidden']),
        'tax'               => $faker->randomNumber(2),
        'has_accessories'   => $faker->randomElement(['yes','no']),
        'section'           => $faker->randomElement(['hot_new_arrivals','trending_now','make_dreams_your_reality','none'])
    ];

});

/* $factory->afterCreating(App\Product::class, function ($product, $faker) {
    $product->variations()->save(factory(App\Variation::class)->make());
}); */
/* $factory->afterCreating(App\Product::class, function ($product, $faker) {
    for($i = 1; $i <= 16; $i++) {
        $product->attributes()->attach($i);
    }
}); */
