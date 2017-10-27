<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'category_id' => $faker->numberBetween($min = 1, $max = 10),
        'description' => $faker->sentence,
        'price' => $faker->numberBetween($min = 10000, $max = 100000),
        'image' => $faker->imageUrl,
    ];
});