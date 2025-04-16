<?php
namespace Database\Factories;

use App\Constants;
use App\Domains\Personal\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomRole = Role::where('name','!=', 'admin')->inRandomOrder()->first();

        return [
            'name' => fake()->name,
            'email' => fake()->unique()->safeEmail,
            'email_verified_at' => now(),
            'phone' => fake()->phoneNumber,
            'country' => fake()->country,
            'city' => fake()->city,
            'role_id' => $randomRole->id,
            'image' => Constants::DEMO_IMAGES['candidate-pavel'],
            'password' => bcrypt('almaz'),
            'remember_token' => Str::random(10),
            'active' => 1,
        ];
    }
}
