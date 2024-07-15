<?php

//namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Candidates\Models\Candidate;
use App\Domains\Candidates\Models\CandidateLevels;
use App\Domains\Candidates\Models\JobCategories;
use App\User;

class CandidatesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $testCandidatePavel = User::where('email', 'Pavel@test.com')->firstOrFail();
        $testCandidateOlga = User::where('email', 'Olga@test.com')->firstOrFail();

        $juniorLevel = CandidateLevels::where('code', 'junior')->firstOrFail();
        $middleLevel = CandidateLevels::where('code', 'middle')->firstOrFail();
        $seniorLevel = CandidateLevels::where('code', 'senior')->firstOrFail();

        $categoryPHP = JobCategories::where('name', 'php')->firstOrFail();
        $categoryJava = JobCategories::where('name', 'java')->firstOrFail();

        Candidate::create([
                'user_id' => $testCandidatePavel->id,
                'job_category_id' => $categoryPHP->id,
                'level_id' => $juniorLevel->id,
                'years_experience' => 1,
                'education' => 'Branch of the Computer Academy "STEP", Donetsk (Ukraine)',
                'experience' => 'PHP Development of websites',
                'about_me' => 'Responsible, sociable, I easily find a common language with people, easy to learn, analytical and creative approach to work.',
            ]);

        Candidate::create([
                'user_id' => $testCandidateOlga->id,
                'job_category_id' => $categoryJava->id,
                'level_id' => $middleLevel->id,
                'years_experience' => 4,
                'education' => 'BSUIR University Computer science degree',
                'experience' => 'Development of complex java applications',
                'about_me' => 'Main development language is Java 8/11, also has experience in Erlang, Kotlin, Spring Framework.
                                I am developing and implementing services implemented on Spring boot
                                I tried myself in machine learning, I have experience in developing mathematical problems
                                Always ready to learn and gain new knowledge, I can work in a team',
        ]);
    }
}


