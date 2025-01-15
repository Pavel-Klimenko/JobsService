<?php

namespace Tests\Unit;

use App\Domains\Vacancies\Models\Vacancies;
use App\Services\VacancyService;
use PHPUnit\Framework\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testHomePageResponseStructure()
    {

        $vacancyService = \Mockery::mock(VacancyService::class);

        $vacancy = $vacancyService->getVacancyById(20);
        $this->assertInstanceOf(Vacancies::class, $vacancy);

//        spl_autoload_call('App\Domains\Vacancies\Models\Vacancies');
//
//        $vacancies = \Mockery::mock(Vacancies::class);
//
//        $vacancies = $vacancies->with('job_category', 'company')
//            ->where('active', true)
//            ->get();
//
//        dd($vacancies);
//
//
//        $this->assertTrue(true);
    }
}
