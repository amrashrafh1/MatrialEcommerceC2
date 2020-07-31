<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order_lines;
use Faker\Generator as Faker;

$factory->define(Order_lines::class, function (Faker $faker) {
    return [
        'order_id' =>1,
        'quantity' =>$faker->randomFloat(2,1,10),
        'total' =>$faker->randomFloat(2,1,8),
        'price'=>$faker->randomFloat(2,1,8),
        'tax'=>$faker->randomFloat(2,1,8),
        'shipping'=>$faker->randomFloat(2,1,8),
        'sku'=>$faker->randomLetter(),
        'product'=>$faker->name,
        'variant'=>$faker->name,
    ];
});
