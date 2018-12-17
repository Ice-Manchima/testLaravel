<?php

use Faker\Generator as Faker;
use Faker\Factory as Factory;

$factory->define(App\Loan::class, function (Faker $faker) {

    $faker = Factory::create();
    $start_date = $faker->dateTimeBetween($startDate = 'now', $endDate = '+15 years');

    return [
        'amount' => random_int(10000,100000),
        'term' => random_int(1,10),
        'interest_rate' => random_int(1,15),
        'start_date' => date_format($start_date, 'Y-m-d')
    ];
});
