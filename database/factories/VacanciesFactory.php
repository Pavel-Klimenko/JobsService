<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domains\Vacancies\Models\Vacancies;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Personal\Models\Company;

use Faker\Generator as Faker;

$factory->define(Vacancies::class, function (Faker $faker) {
    $randomCompany = Company::inRandomOrder()->first();
    $randomJobCategory = JobCategories::inRandomOrder()->first();

    return [
        'title' => $faker->name,
        'job_category_id' => $randomJobCategory,
        'company_id' => $randomCompany,
        'salary_from' => $faker->numberBetween(300, 3000),
        'description' => $faker->paragraph,
        'active' => 1,
    ];
});
