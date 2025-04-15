<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Candidates\Models\JobCategories;


class JobCategoriesTableSeeder extends Seeder
{
    private const PROGRAMMING_LANGUAGES = [
        'java', 'c', 'c++', 'c#', 'python',
        'php', 'javascript', 'perl', 'ruby', 'assembler',
        'delphi', 'swift', 'go', 'scala', 'haskell'
    ];

    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (JobCategories::count() == 0) {
            foreach (self::PROGRAMMING_LANGUAGES as $lang) {
                JobCategories::create(['name' => $lang]);
            }
        }
    }
}
