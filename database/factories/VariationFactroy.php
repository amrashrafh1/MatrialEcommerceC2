<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Variation;
use Faker\Generator as Faker;
$autoIncrement = autoIncrement();

$factory->define(Variation::class, function (Faker $faker) use ($autoIncrement) {
    $autoIncrement->next();
    return [
        'sku'            => \Str::random(10),
        'sale_price'     => $faker->randomFloat(2,1,10),
        'purchase_price' => $faker->randomFloat(2,1,10),
        'stock'          => $faker->randomNumber(3),
        'in_stock'       => $faker->randomElement(['in_stock','out_stock']),
        'visible'        => $faker->randomElement(['visible','hidden']),
        'product_id'     => $autoIncrement->current(),
    ];

});

function autoIncrement()
{
    for ($i = 1; $i < 1000; $i++) {
        yield $i;
    }
}

$factory->afterCreating(App\Variation::class, function ($variation, $faker) {
    $variation->attributes()->attach([rand(1,4),rand(5,8),rand(9,12),rand(13,16)]);
});
