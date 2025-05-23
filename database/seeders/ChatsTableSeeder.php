<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Chat\Models\Chat;

class ChatsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        if (Chat::count() == 0) {
            Chat::factory()->count(1)->create();
        }
    }
}


