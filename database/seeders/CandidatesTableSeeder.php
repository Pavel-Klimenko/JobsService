<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Candidates\Models\Candidate;


class CandidatesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        if (Candidate::count() == 0) {
            Candidate::factory()->count(8)->create();
        }
    }
}


