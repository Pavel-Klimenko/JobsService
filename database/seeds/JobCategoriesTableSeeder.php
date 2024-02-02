<?php
//namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Domains\Candidates\Models\JobCategories;


class JobCategoriesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $arLangs = [
            'java', 'c', 'c++', 'c#', 'python',
            'php', 'javascript', 'perl', 'ruby', 'assembler',
            'delphi', 'swift', 'go', 'scala', 'haskell'
        ];

        foreach ($arLangs as $lang) {
            JobCategories::create(['NAME' => $lang]);
        }
    }
}
