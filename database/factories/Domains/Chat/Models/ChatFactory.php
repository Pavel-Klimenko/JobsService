<?php
namespace Database\Factories\Domains\Chat\Models;

use App\Domains\Chat\Models\Chat;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class ChatFactory extends Factory
{
    protected $model = Chat::class;

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

        $randomCompany = User::whereHas('role', function($q){
            $q->where('name', 'company');
        })->inRandomOrder()->first();

        return [
            'candidate_id' => $randomCandidate->id,
            'company_id' => $randomCompany->id,
        ];
    }
}
