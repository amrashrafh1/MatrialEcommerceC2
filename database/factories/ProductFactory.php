<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'              => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'slug'              => $faker->slug,
        'sku'               => \Str::random(10),
        'product_type'      => 'simple',
        'sale_price'        => $faker->randomFloat(2,1,10),
        'purchase_price'    => $faker->randomFloat(2,1,10),
        'stock'             => $faker->randomNumber(),
        'size'              => \Str::random(6),
        'color'             => \Str::random(6),
        'description'       => $faker->text,
        'short_description' => $faker->text,
        'image'             => 'public/products/thumbnail/'.rand(1, 17).'.jpg',
        'tradmark_id'       => 1,
        'user_id'           => 4,
        'owner'             => 'for_seller',
        'approved'          => 1,
        'category_id'       => 1,
        'length'            => $faker->randomNumber(2),
        'width'             => $faker->randomNumber(2),
        'height'            => $faker->randomNumber(2),
        'weight'            => $faker->randomNumber(2),
        'in_stock'          => 'in_stock',
        'visible'           => 'visible',
        'tax'               => $faker->randomNumber(2),
        'section'           => $faker->randomElement(['hot_new_arrivals','trending_now','make_dreams_your_reality','none'])
    ];

});
