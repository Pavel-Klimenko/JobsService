<?php

//namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Home\Models\Review;
use App\User;


class ReviewsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {

        $testCompanyABCsoft = User::where('email', 'ABCsoft@test.com')->firstOrFail();
        $testCompanyUdemyDev = User::where('email', 'UdemyDev@test.com')->firstOrFail();

        Review::create([
            'title' => 'Great platform!',
            'review' => 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'user_id' => $testCompanyABCsoft->id,
            'active' => 1,
        ]);

        Review::create([
                'title' => 'Thank you for your job!',
                'review' => 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'user_id' => $testCompanyUdemyDev->id,
                'active' => 1,
        ]);
    }
}
