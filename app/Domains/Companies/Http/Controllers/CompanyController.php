<?php
namespace App\Domains\Companies\Http\Controllers;

use App\Domains\Candidates\Models\InterviewInvitations;
use App\Domains\Candidates\Models\InvitationsStatus;
use App\Domains\Personal\Models\Company;
use App\Domains\Vacancies\DTO\UpdateVacancyDto;
use App\Domains\Vacancies\Models\Vacancies;
use App\Services\CandidateService;
use App\Services\FileService;
use App\Services\VacancyService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Helper;
use RuntimeException;
use App\User;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Candidates\Models\CandidateLevels;
use App\Domains\Companies\Http\Requests\CreateVacancyRequest;
use App\Domains\Companies\Http\Requests\UpdateVacancyRequest;
use App\Domains\Vacancies\DTO\CreateVacancyDto;

use App\Domains\Candidates\QueryFilters\JobCategoryId as FilterByJobCategory;
use App\Domains\Candidates\QueryFilters\LevelId as FilterByLevel;
use Illuminate\Support\Facades\DB;

use App\Domains\Candidates\Models\Candidate;
use App\QueryFilters\Filter;

class CompanyController extends BaseController
{

    private $vacancyService;

    public function __construct(VacancyService $vacancyService)
    {
        $this->vacancyService = $vacancyService;
    }

    public function getPersonalData(Request $request)
    {
        try {
            $currentCompany = $request->user()->company;
            //TODO сделать сервисы и DTO!
            return Helper::successResponse($currentCompany, 'My company info');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function updatePersonalInfo(Request $request) {
        try {
            DB::beginTransaction();
            //TODO делать валидацию в Respons ах
            //TODO использовать Spatie DTO библиотеку

            $request->validate([
                'employee_cnt' => 'required|integer',
                'web_site' => 'required|string',
                'description' => 'required|string',

                'name' => 'required|string',
                'country' => 'required|string',
                'city' => 'required|string',
                'phone' =>  'required|string',
            ]);


            $currentUser = $request->user();
            $currentCompany = $currentUser->company;


            //обновляем кандидата
            $arCompanyParams = [
                'employee_cnt' => $request->employee_cnt,
                'web_site' => $request->web_site,
                'description' => $request->description,
            ];

            $arUserParams = [
                'name' => $request->name,
                'country' => $request->country,
                'city' => $request->city,
                'phone' => $request->phone,
            ];

            $currentCompany->update($arCompanyParams);
            $currentUser->update($arUserParams);


            DB::commit();
            return Helper::successResponse(['$arUserParams' => $arUserParams], 'Company updated');
        } catch(\Exception $exception) {
            DB::rollBack();
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function answerToVacancyRequest(Request $request) {
        try {
            $request->validate([
                'vacancy_request_id' => 'required|integer',
                'answer_status_id' => 'required|integer',
            ]);

            $vacancyRequest = Helper::checkElementExistense(InterviewInvitations::class, $request->vacancy_request_id);

            $currentUser = $request->user();

            if ($currentUser->company->id != $vacancyRequest->vacancy->company_id) {
                throw new RuntimeException("Vacancy doesn`t relate to this company");
            }

            $answerStatus = Helper::checkElementExistense(InvitationsStatus::class, $request->answer_status_id);
            $this->vacancyService->answerToVacancyRequest($vacancyRequest, $answerStatus);

            return Helper::successResponse([
                'vacancy' => $vacancyRequest->vacancy,
                'answer_status' => $answerStatus->code
            ], 'Vacancy request status changed');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function getMyVacancies(Request $request) {
        try {
            $myVacancies = $request->user()->company->vacancies;

            return Helper::successResponse($myVacancies, 'My vacancies');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function getMyVacancy($id, Request $request) {
        try {
            $currentCompany = $request->user()->company;
            //TODO проверить что это моя вакансия
            $vacancy = $this->vacancyService->getVacancyById($id);

            if ($vacancy->company_id != $currentCompany->id) {
                throw new RuntimeException("Vacancy doesn`t relate to this company");
            }

            return Helper::successResponse($vacancy, 'My vacancy');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function createVacancy(CreateVacancyRequest $request) {
        try {
            $currentCompany = $request->user()->company;

            $createVacancyDto = new CreateVacancyDto($request);
            $dto = $createVacancyDto->getDTO();
            $newVacancy = $this->vacancyService->createVacancy($currentCompany, $dto);

            return Helper::successResponse($newVacancy, 'Created new vacancy');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function updateVacancy(UpdateVacancyRequest $request)
    {
        try {
            $currentCompany = $request->user()->company;

            Helper::checkElementExistense(JobCategories::class, $request->job_category_id);
            $vacancy = Helper::checkElementExistense(Vacancies::class, $request->vacancy_id);
            if ($currentCompany->id != $vacancy->company_id) {
                throw new RuntimeException("Vacancy doesn`t relate to this company");
            }

            $createVacancyDto = new UpdateVacancyDto($request);
            $dto = $createVacancyDto->getDTO();
            $this->vacancyService->updateVacancy($vacancy, $dto);

            return Helper::successResponse(['vacancy_id' => $vacancy->id], 'Vacancy successfully updated');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }

    }
}
