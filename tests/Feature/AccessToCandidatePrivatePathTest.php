<?php

namespace Tests\Feature;

use App\Domains\Candidates\Models\CandidateLevels;
use App\Domains\Candidates\Models\JobCategories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AccessToCandidatePrivatePathTest extends TestCase
{
    use RefreshDatabase;

    private $randomLevelId;
    private $randomJobCategoryId;
    private $randomCandidateUser;
    private $randomCompanyUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->randomLevelId = CandidateLevels::inRandomOrder()->first()->id;
        $this->randomJobCategoryId = JobCategories::inRandomOrder()->first()->id;
        $this->randomCandidateUser = $this->getRandomCandidateUser();
        $this->randomCompanyUser = $this->getRandomCompanyUser();
    }

    public function testCanCandidateAccessHisProfileData()
    {
        Sanctum::actingAs($this->randomCandidateUser, ['candidate_rules']);
        $responseFromPersonalPage = $this->get('/api/personal/candidate/get-personal-data');
        $responseFromPersonalPage->assertStatus(Response::HTTP_OK);
    }

    public function testCanCandidateAccessHisVacancyRequests()
    {
        Sanctum::actingAs($this->randomCandidateUser, ['candidate_rules']);
        $responseFromVacancyRequestsPage = $this->get('/api/personal/candidate/vacancy-requests');
        $responseFromVacancyRequestsPage->assertStatus(Response::HTTP_OK);
    }

    public function testCanCandidateUpdateHisProfile() {
        Sanctum::actingAs($this->randomCandidateUser, ['candidate_rules']);
        $responseFromUpdatingMethod = $this->post('/api/personal/candidate/update', [
            'name' => self::TEST_USER_NAME,
            'country' => self::TEST_USER_COUNTRY,
            'city' => self::TEST_USER_CITY,
            'phone' => self::TEST_USER_PHONE,
            'job_category_id' => $this->randomJobCategoryId,
            'level_id' => $this->randomLevelId,
            'years_experience' => 3,
            'salary' => self::TEST_USER_SALARY,
            'experience' => 'is simply dummy text of the printing and typesetting industry',
            'education' => 'is simply dummy text of the printing and typesetting industry',
            'about_me' => 'is simply dummy text of the printing and typesetting industry',
        ]);

        $responseFromUpdatingMethod->assertStatus(Response::HTTP_OK);
    }

    public function testCannotCompanyAccessCandidateProfileData()
    {
        Sanctum::actingAs($this->randomCompanyUser, ['company_rules']);
        $responseFromPersonalPage = $this->get('/api/personal/candidate/get-personal-data');
        $responseFromPersonalPage->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testCannotCompanyAccessCandidateVacancyRequests()
    {
        Sanctum::actingAs($this->randomCompanyUser, ['company_rules']);
        $responseFromVacancyRequestsPage = $this->get('/api/personal/candidate/vacancy-requests');
        $responseFromVacancyRequestsPage->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testCannotCompanyUpdateCandidateProfile()
    {
        Sanctum::actingAs($this->randomCompanyUser, ['company_rules']);
        $responseFromUpdatingMethod = $this->post('/api/personal/candidate/update', [
            'name' => self::TEST_USER_NAME,
            'country' => self::TEST_USER_COUNTRY,
            'city' => self::TEST_USER_CITY,
            'phone' => self::TEST_USER_PHONE,
            'job_category_id' => $this->randomJobCategoryId,
            'level_id' => $this->randomLevelId,
            'years_experience' => 3,
            'salary' => self::TEST_USER_SALARY,
            'experience' => 'is simply dummy text of the printing and typesetting industry',
            'education' => 'is simply dummy text of the printing and typesetting industry',
            'about_me' => 'is simply dummy text of the printing and typesetting industry',
        ]);

        $responseFromUpdatingMethod->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
