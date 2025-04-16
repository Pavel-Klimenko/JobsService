<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Personal\Models\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        if (Company::count() == 0) {
            Company::factory()->count(8)->create();
        }
    }
}


