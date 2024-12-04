<?php

//namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Candidates\Models\InvitationsStatus;

class InvitationStatusesSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        if (InvitationsStatus::count() == 0) {
            InvitationsStatus::create(['code' => 'accepted']);
            InvitationsStatus::create(['code' => 'rejected']);
            InvitationsStatus::create(['code' => 'no_status']);
        }
    }
}


