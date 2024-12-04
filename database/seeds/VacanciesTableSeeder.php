<?php

//namespace Database\Seeders;

use App\Domains\Vacancies\Models\Vacancies;
use Illuminate\Database\Seeder;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Personal\Models\Company;

class VacanciesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (Vacancies::count() == 0) {
            $categoryPHP = JobCategories::where('name', 'php')->firstOrFail();
            $categoryJava = JobCategories::where('name', 'java')->firstOrFail();
            $categoryPython= JobCategories::where('name', 'python')->firstOrFail();
            $categoryJavascript = JobCategories::where('name', 'javascript')->firstOrFail();

            $companyABC = Company::where('web_site', 'https://abc-soft.com')->firstOrFail();
            $companyUdemy = Company::where('web_site', 'https://udemy-dev.com')->firstOrFail();

            Vacancies::create([
                'title' => 'PHP Developer',
                'job_category_id' => $categoryPHP->id,
                'company_id' => $companyABC->id,
                'salary_from' => 400,
                'description' => 'Our customer is a leading international tobacco company headquartered in Switzerland. Its 400 offices, 27 factories, 5 research centers, and 5 tobacco processing
                            enterprises are located across the globe. Over the past 7 years, the company has been certified
                            as the best employer in the world, and in 2021, it received regional
                            certifications in the Asia-Pacific region, Europe, North America, Africa,
                            the Middle East, and Latin America.',
                'active' => 1,
            ]);
            Vacancies::create([
                'title' => 'Middle Java developer',
                'job_category_id' => $categoryJava->id,
                'company_id' => $companyUdemy->id,
                'salary_from' => 2100,
                'description' => 'Our customer is a leading international tobacco company headquartered in Switzerland. Its 400 offices, 27 factories, 5 research centers, and 5 tobacco processing enterprises are located across the globe. Over the past 7 years, the company has been certified as the best employer in the world, and in 2021, it received regional certifications in the Asia-Pacific region, Europe, North America, Africa, the Middle East, and Latin America.',
                'active' => 1,
            ]);
            Vacancies::create([
                'title' => 'Python Developer',
                'job_category_id' => $categoryPython->id,
                'company_id' => $companyABC->id,
                'salary_from' => 1400,
                'description' => 'Our customer is a leading international tobacco company headquartered in Switzerland. Its 400 offices, 27 factories, 5 research centers, and 5 tobacco processing
                            enterprises are located across the globe. Over the past 7 years, the company has been certified
                            as the best employer in the world, and in 2021, it received regional
                            certifications in the Asia-Pacific region, Europe, North America, Africa,
                            the Middle East, and Latin America.',
                'active' => 1,
            ]);
            Vacancies::create([
                'title' => 'Front-end Developer',
                'job_category_id' => $categoryJavascript->id,
                'company_id' => $companyABC->id,
                'salary_from' => 2400,
                'description' => 'Our customer is a leading international tobacco company headquartered in Switzerland. Its 400 offices, 27 factories, 5 research centers, and 5 tobacco processing
                            enterprises are located across the globe. Over the past 7 years, the company has been certified
                            as the best employer in the world, and in 2021, it received regional
                            certifications in the Asia-Pacific region, Europe, North America, Africa,
                            the Middle East, and Latin America.',
                'active' => 1,
            ]);
        }
    }
}
