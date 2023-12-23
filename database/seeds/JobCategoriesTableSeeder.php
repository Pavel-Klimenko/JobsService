<?php
//namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\JobCategories;


class JobCategoriesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        JobCategories::create(['NAME' => 'java']);
        JobCategories::create(['NAME' => 'c']);
        JobCategories::create(['NAME' => 'c++']);
        JobCategories::create(['NAME' => 'c#']);
        JobCategories::create(['NAME' => 'python']);
        JobCategories::create(['NAME' => 'php']);
        JobCategories::create(['NAME' => 'javascript']);
        JobCategories::create(['NAME' => 'perl']);
        JobCategories::create(['NAME' => 'ruby']);
        JobCategories::create(['NAME' => 'assembler']);
        JobCategories::create(['NAME' => 'delphi']);
        JobCategories::create(['NAME' => 'swift']);
        JobCategories::create(['NAME' => 'groovy']);
        JobCategories::create(['NAME' => 'objective-C']);
        JobCategories::create(['NAME' => 'go']);
        JobCategories::create(['NAME' => 'scala']);
        JobCategories::create(['NAME' => 'haskell']);
    }
}
