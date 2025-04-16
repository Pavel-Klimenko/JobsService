<?php
namespace Database\Factories\Domains\Personal\Models;

use App\Domains\Personal\Models\Company;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class CompanyFactory extends Factory
{
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomCompany = User::whereHas('role', function($q){
            $q->where('name', 'company');
        })->inRandomOrder()->first();

        return [
            'user_id' => $randomCompany->id,
            'employee_cnt' => fake()->numberBetween(5, 500),
            'web_site' => 'https:/test-company-soft.com',
            'description' => fake()->text(150),
        ];
    }
}
