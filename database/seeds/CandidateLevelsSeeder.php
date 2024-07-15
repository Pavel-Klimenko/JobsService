<?php

//namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Candidates\Models\CandidateLevels;

class CandidateLevelsSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        CandidateLevels::create(['code' => 'junior']);
        CandidateLevels::create(['code' => 'middle']);
        CandidateLevels::create(['code' => 'senior']);
    }
}


