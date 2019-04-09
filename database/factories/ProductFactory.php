<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Api\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->numberBetween(100, 1000),
        'details' => $faker->paragraph(5),
        'discount' => $faker->numberBetween(0, 50),
        'stock' => $faker->numberBetween(0, 10),
        'user_id' => function () {
            return \App\User::all()->random();
        }
    ];
});
