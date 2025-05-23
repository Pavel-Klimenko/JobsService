<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //TODO применить фабрики для Seeders
        $this->call([
            RolesTableSeeder::class,
            InvitationStatusesSeeder::class,
            CandidateLevelsSeeder::class,
            JobCategoriesTableSeeder::class,
            UsersTableSeeder::class,
            CompaniesTableSeeder::class,
            CandidatesTableSeeder::class,
            VacanciesTableSeeder::class,
            ChatsTableSeeder::class,
        ]);
    }
}
