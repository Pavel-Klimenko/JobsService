<?php

namespace Tests\Feature;

use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Vacancies\Models\Vacancies;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CompanyActionsTest extends TestCase
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
        $this->randomJobCategoryId = JobCategories::inRandomOrder()->first()->id;
        $this->randomCompanyUser = $this->getRandomCompanyUser();
    }

    public function testCanCompanyAccessToProfileData()
    {
        Sanctum::actingAs($this->randomCompanyUser, ['company_rules']);
        $response = $this->get('/api/personal/company/my-personal-info');
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testCanCompanyAccessToCreatedVacancy()
    {
        Sanctum::actingAs($this->randomCompanyUser, ['company_rules']);
        $createdTestVacancy = $this->createCompanyVacancy($this->randomCompanyUser->company->id);
        $response = $this->get('/api/personal/company/my/vacancies/'.$createdTestVacancy->id);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testCanCompanyAccessToCreatedVacancyList()
    {
        Sanctum::actingAs($this->randomCompanyUser, ['company_rules']);

        $createdTestVacancyOne = $this->createCompanyVacancy($this->randomCompanyUser->company->id);
        $createdTestVacancyTwo = $this->createCompanyVacancy($this->randomCompanyUser->company->id);

        $response = $this->get('/api/personal/company/my/vacancies');
        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('vacancies', ['title' => $createdTestVacancyOne->title]);
        $this->assertDatabaseHas('vacancies', ['title' => $createdTestVacancyTwo->title]);


    }

    public function testCanCompanyCreateVacancy()
    {
        Sanctum::actingAs($this->randomCompanyUser, ['company_rules']);

        $newVacancy = [
            'title' => self::TEST_VACANCY_NAME,
            'job_category_id' => $this->randomJobCategoryId,
            'salary_from' => self::TEST_USER_SALARY,
            'description' => self::TEST_VACANCY_DESCRIPTION,
        ];

        $response = $this->post('/api/personal/company/create-vacancy', $newVacancy);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('vacancies', $newVacancy);
    }

    public function testCanCompanyUpdateVacancy()
    {
        Sanctum::actingAs($this->randomCompanyUser, ['company_rules']);
        $createdTestVacancy = $this->createCompanyVacancy($this->randomCompanyUser->company->id);

        $newTitle = 'NEW TEST TITLE';
        $newDescription = 'NEW TEST DESCRIPTION';

        $updatedVacancyField = [
            'vacancy_id' => $createdTestVacancy->id,
            'title' => $newTitle,
            'job_category_id' => $this->randomJobCategoryId,
            'salary_from' => 5413,
            'description' => $newDescription,
        ];

        $response = $this->post('/api/personal/company/update-vacancy', $updatedVacancyField);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('vacancies', [
            'title' => $newTitle,
            'description' => $newDescription,
        ]);
    }

    public function testCanCompanyDeleteVacancy()
    {
        Sanctum::actingAs($this->randomCompanyUser, ['company_rules']);
        $createdTestVacancy = $this->createCompanyVacancy($this->randomCompanyUser->company->id);

        $createdTestVacancyTitle = $createdTestVacancy->title;

        $response = $this->delete('/api/personal/company/delete-vacancy/'.$createdTestVacancy->id);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDeleted('vacancies', [
            'title' => $createdTestVacancyTitle,
        ]);
    }

    private function createCompanyVacancy(int $companyId):Vacancies
    {
        return Vacancies::create([
            'title' => self::TEST_VACANCY_NAME,
            'job_category_id' => $this->randomJobCategoryId,
            'salary_from' => self::TEST_USER_SALARY,
            'description' => self::TEST_VACANCY_DESCRIPTION,
            'company_id' => $companyId,
        ]);
    }
}
