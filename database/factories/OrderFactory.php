<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'status'          => 'pending',
        'currency'        => 'USD',
        'sub_total'       => $faker->randomFloat(2,1,10),
        'grand_total'     => $faker->randomFloat(2,1,10),
        'billing_phone'   => $faker->phoneNumber,
        'billing_name'    => $faker->streetName,
        'billing_email'   => $faker->email,
        'billing_address' => $faker->address,
        'billing_city'    => $faker->city,
        'billing_state'   => $faker->state,
        'billing_country' => $faker->country,
        'billing_zip'     => $faker->postcode
    ];
});
