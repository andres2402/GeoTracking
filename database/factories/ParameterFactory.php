<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\parameter;
use Faker\Generator as Faker;

$factory->define(parameter::class, function (Faker $faker) {
    return [
        'name'=>$faker->name(),
        'description'=>$faker->text(),
    ];
});
