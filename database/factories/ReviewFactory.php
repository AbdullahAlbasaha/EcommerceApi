<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Api\Review::class, function (Faker $faker) {
    return [
        'product_id' => function () {
            return \App\Model\Api\Product::all()->random();
        },
        'customer' => $faker->name,
        'review' => $faker->paragraph,
        'rate' => $faker->numberBetween(0, 5),
    ];
});
