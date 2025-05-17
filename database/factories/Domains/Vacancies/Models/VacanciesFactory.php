<?php

namespace Database\Factories\Domains\Vacancies\Models;

use App\Domains\Personal\Models\Company;
use App\Domains\Vacancies\Models\Vacancies;
use App\Domains\Candidates\Models\JobCategories;
use Illuminate\Database\Eloquent\Factories\Factory;


class VacanciesFactory extends Factory
{
    protected $model = Vacancies::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomCompany = Company::inRandomOrder()->first();
        $randomJobCategory = JobCategories::inRandomOrder()->first();

        return [
            'title' =>  fake()->title(),
            'job_category_id' => $randomJobCategory->id,
            'company_id' => $randomCompany->id,
            'salary_from' => rand(700, 3000),
            'description' => fake()->text(270),
            'active' => 1,
        ];
    }
}

