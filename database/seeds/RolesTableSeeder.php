<?php

//namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $role = Role::firstOrNew(['name' => 'admin']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('voyager::seeders.roles.admin'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'company']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('Company'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'candidate']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('Candidate'),
            ])->save();
        }
    }
}


