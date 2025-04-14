<?php

//namespace Database\Seeders;

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
        //TODO Фабрикой!!!

        if (User::count() == 0) {
            $roleAdmin = Role::where('name', 'admin')->firstOrFail();
            $roleCandidate = Role::where('name', 'candidate')->firstOrFail();
            $roleCompany = Role::where('name', 'company')->firstOrFail();

            User::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'role_id' => $roleAdmin->id,
                'password' => bcrypt('almaz_admin'),
            ]);
            User::create([
                'name' => 'Pavel',
                'email' => 'Pavel@test.com',
                'phone' => '+49722211155',
                'country' => 'USA',
                'city' => 'Boston',
                'role_id' => $roleCandidate->id,
                'image' => Constants::DEMO_IMAGES['candidate-pavel'],
                'password' => bcrypt('almaz'),
                'active' => 1,
            ]);
            User::create([
                'name' => 'Olga',
                'email' => 'Olga@test.com',
                'phone' => '+49722211315',
                'country' => 'Spain',
                'city' => 'Madrid',
                'role_id' => $roleCandidate->id,
                'image' => Constants::DEMO_IMAGES['candidate-olga'],
                'password' => bcrypt('almaz'),
                'active' => 1,
            ]);
            User::create([
                'name' => 'Alexander',
                'email' => 'Alexander@test.com',
                'phone' => '+49722215164',
                'country' => 'Italy',
                'city' => 'Milan',
                'role_id' => $roleCandidate->id,
                'image' => Constants::DEMO_IMAGES['candidate-alexander'],
                'password' => bcrypt('almaz'),
                'active' => 1,
            ]);
            User::create([
                'name' => 'Victor',
                'email' => 'Victor@test.com',
                'phone' => '+55522215164',
                'country' => 'Latvia',
                'city' => 'Riga',
                'role_id' => $roleCandidate->id,
                'image' => Constants::DEMO_IMAGES['candidate-victor'],
                'password' => bcrypt('almaz'),
                'active' => 1,
            ]);
            User::create([
                'name' => 'ABC Soft',
                'email' => 'ABCsoft@test.com',
                'phone' => '+49765821155',
                'country' => 'Belarus',
                'city' => 'Minsk',
                'role_id' => $roleCompany->id,
                'image' => Constants::DEMO_IMAGES['companies-belhard'],
                'password' => bcrypt('almaz'),
                'active' => 1,
            ]);
            User::create([
                'name' => 'Udemy Development',
                'email' => 'UdemyDev@test.com',
                'phone' => '+49765821155',
                'country' => 'Belarus',
                'city' => 'Minsk',
                'role_id' => $roleCompany->id,
                'image' => Constants::DEMO_IMAGES['companies-itechart'],
                'password' => bcrypt('almaz'),
                'active' => 1,
            ]);
        }
    }
}
