<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ParameterValue;
use Faker\Generator as Faker;

$factory->define(ParameterValue::class, function (Faker $faker) {
    return [
        'name'=>$faker->name(),
        'description'=>$faker->text(),
    ];
});
