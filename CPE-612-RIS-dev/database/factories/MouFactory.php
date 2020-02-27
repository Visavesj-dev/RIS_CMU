<?php

use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use App\MouType;
use App\Department;

$factory->define(App\Mou::class, function (Faker $faker) {
    return [
        'detail' => $faker->text(),
        'made_agreement_at' => now(),
        'started_at' => now(),
        'ended_at' => now(),
    ];
});

$factory->afterCreating(App\Mou::class, function ($mou, $faker) {
    $mou->type()->associate(
        MouType::inRandomOrder()->first()->id
    );

    $mou->partners()->saveMany(
        factory(App\Partner::class, rand(1, 3))->make()
    );

    $mou->departments()->sync(
        array_map(
            function ($item) {
                return $item['id'];
            },
            Arr::random(Department::all()->toArray(), rand(1, 9))
        )
    );

    $mou->save();
});

$factory->state(App\Mou::class, 'expired', function ($faker) {
    $endedAt = $faker->dateTimeBetween('-4 years', 'now');
    $madeAgreementAt = $faker->dateTimeBetween('-8 years', $endedAt);
    $startedAt = $faker->dateTimeBetween($madeAgreementAt, $endedAt);

    return [
        'made_agreement_at' => $madeAgreementAt,
        'started_at' => $startedAt,
        'ended_at' => $endedAt,
    ];
});

$factory->state(App\Mou::class, 'active', function ($faker) {
    $madeAgreementAt = $faker->dateTimeBetween('-4 years', '-5 months');
    $endedAt = $faker->dateTimeBetween('+5 months', '+4 years');
    $startedAt = $faker->dateTimeBetween($madeAgreementAt, 'now');
    
    return [
        'made_agreement_at' => $madeAgreementAt,
        'started_at' => $startedAt,
        'ended_at' => $endedAt,
    ];
});

$factory->state(App\Mou::class, 'new', function ($faker) {
    $madeAgreementAt = $faker->dateTimeBetween('now', '+5 years');
    $endedAt = $faker->dateTimeBetween($madeAgreementAt, '+15 years');;
    $startedAt = $faker->dateTimeBetween($madeAgreementAt, $endedAt);
    
    return [
        'made_agreement_at' => $madeAgreementAt,
        'started_at' => $startedAt,
        'ended_at' => $endedAt,
    ];
});