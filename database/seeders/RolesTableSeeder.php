<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Personal\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        if (Role::count() == 0) {
            Role::create(['name' => 'admin']);
            Role::create(['name' => 'company']);
            Role::create(['name' => 'candidate']);
        }
    }
}


