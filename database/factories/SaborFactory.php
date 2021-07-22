<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(saparicio\Sabor::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence,
        'estado' => $faker->sentence,
    ];
});
