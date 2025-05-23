<?php

namespace Database\Seeders;

use App\Domains\Vacancies\Models\Vacancies;
use Illuminate\Database\Seeder;

class VacanciesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (Vacancies::count() == 0) {
            Vacancies::factory()->count(3)->create();
        }
    }
}
