<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name'        => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'slug'        => $faker->slug,
        'description' => $faker->randomHtml(2,3),
        'image'       => $faker->imageUrl(660, 720),
    ];
});
