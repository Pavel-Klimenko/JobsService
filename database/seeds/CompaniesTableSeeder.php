<?php

//namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Personal\Models\Company;
use App\User;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $testCompanyABCsoft = User::where('email', 'ABCsoft@test.com')->firstOrFail();
        $testCompanyUdemyDev = User::where('email', 'UdemyDev@test.com')->firstOrFail();

        Company::create([
                'user_id' => $testCompanyABCsoft->id,
                'employee_cnt' => 50,
                'web_site' => 'https://abc-soft.com',
                'description' => 'Company ABC SOFTWARE works within information technology sphere for
                                the Latvian market. The services that we offer to the customers
                                are connected with development and implementation of information systems
                                and complete software solutions adaptable to each customer`s requirements.',
        ]);

        Company::create([
                'user_id' => $testCompanyUdemyDev->id,
                'employee_cnt' => 143,
                'web_site' => 'https://udemy-dev.com',
                'description' => 'Udemy Dev Company is an Global Oriented software outsourcing
                                 company that focuses on highly qualitative,
                                 timely delivered and cost-effective offshore software development',
        ]);
    }
}


