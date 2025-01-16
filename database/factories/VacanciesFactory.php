<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domains\Vacancies\Models\Vacancies;

use Faker\Generator as Faker;

$factory->define(Vacancies::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'job_category_id' => $faker->numberBetween(1, 10),
        'company_id' => $faker->numberBetween(1, 5),
        'salary_from' => $faker->numberBetween(300, 3000),
        'description' => $faker->paragraph,
        'active' => 1,
    ];
});
