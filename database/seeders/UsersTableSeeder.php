<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Personal\Models\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            $roleAdmin = Role::where('name', 'admin')->firstOrFail();

            User::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'role_id' => $roleAdmin->id,
                'password' => bcrypt('almaz_admin'),
            ]);

            User::factory()->count(5)->create();
        }
    }
}
