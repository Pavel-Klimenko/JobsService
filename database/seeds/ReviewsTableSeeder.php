<?php

//namespace Database\Seeders;

use App\Constants;
use App\Models\Reviews;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Domains\Candidates\Models\JobCategories;


class ReviewsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        Reviews::create([
            'NAME' => 'Igor',
            'PHOTO' => Constants::DEMO_IMAGES['review-igor'],
            'REVIEW' => 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'ACTIVE' => 1,
        ]);

        Reviews::create([
            'NAME' => 'Alex',
            'PHOTO' => Constants::DEMO_IMAGES['review-alex'],
            'REVIEW' => 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'ACTIVE' => 1,
        ]);

        Reviews::create([
            'NAME' => 'Bob',
            'PHOTO' => Constants::DEMO_IMAGES['review-bob'],
            'REVIEW' => 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'ACTIVE' => 1,
        ]);

        Reviews::create([
            'NAME' => 'Pavel',
            'PHOTO' => Constants::DEMO_IMAGES['review-pavel'],
            'REVIEW' => 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'ACTIVE' => 1,
        ]);
    }
}
