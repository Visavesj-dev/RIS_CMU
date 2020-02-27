<?php

use Faker\Generator as Faker;
use App\Country;
use Illuminate\Support\Arr;

$factory->define(App\Partner::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'country_id' => Arr::random(Country::all()->toArray())['id']
    ];
});
