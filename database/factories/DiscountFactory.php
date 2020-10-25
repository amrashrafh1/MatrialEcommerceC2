<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Discount;
use Faker\Generator as Faker;

$factory->define(Discount::class, function (Faker $faker) {
    return [
        'condition'      => $faker->randomElement([
            'percentage_of_product_price',
            'fixed_amount',
            'buy_x_and_get_y_free'
            ]),
        'start_at'       => \Carbon\Carbon::now()->subDay()->toDateTimeString(),
        'expire_at'      => \Carbon\Carbon::now()->addDays(30)->toDateTimeString(),
        'amount'         => $faker->randomFloat(2,1,10),
        'daily'          => $faker->randomElement(['daily_deals', 'special_offers']),
        'max_quantity'   => $faker->randomNumber(2),
        'buy_x_quantity' => $faker->randomNumber(2),
        'y_quantity'     => $faker->randomNumber(2),
        'product_id'     => rand(1,10000),
        'product_y'      => rand(1,10000)
    ];
});
