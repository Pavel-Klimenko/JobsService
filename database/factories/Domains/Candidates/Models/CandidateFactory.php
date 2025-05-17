<?php
namespace Database\Factories\Domains\Candidates\Models;

use App\Domains\Candidates\Models\Candidate;
use App\Domains\Candidates\Models\CandidateLevels;
use App\Domains\Candidates\Models\JobCategories;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class CandidateFactory extends Factory
{
    protected $model = Candidate::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomCandidate = User::whereHas('role', function($q){
            $q->where('name', 'candidate');
        })->inRandomOrder()->first();

        $randomJobCategory = JobCategories::inRandomOrder()->first();
        $randomLevel = CandidateLevels::inRandomOrder()->first();

        return [
            'user_id' => $randomCandidate->id,
            'job_category_id' => $randomJobCategory->id,
            'level_id' => $randomLevel->id,
            'years_experience' => rand(1, 4),
            'salary' => rand(1000, 2500),
            'experience' => fake()->text(120),
            'education' => fake()->text(),
            'about_me' => fake()->text(300),
        ];
    }
}
