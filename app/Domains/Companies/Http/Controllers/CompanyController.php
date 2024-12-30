<?php
namespace App\Domains\Companies\Http\Controllers;

use App\Domains\Candidates\Models\InterviewInvitations;
use App\Domains\Candidates\Models\InvitationsStatus;
use App\Domains\Companies\DTO\UpdateCompanyDto;
use App\Domains\Companies\DTO\UpdateVacancyDto;
use App\Domains\Companies\Http\Requests\CreateVacancyRequest;
use App\Domains\Companies\DTO\CreateVacancyDto;
//use App\Domains\Companies\DTO\UpdateCandidateDto;
use App\Domains\Vacancies\Models\Vacancies;
use App\Mail\UserMailNotification;
use App\Services\CompanyService;
use App\Services\VacancyService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Helper;
use RuntimeException;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Companies\Http\Requests\UpdateVacancyRequest;
use App\Domains\Companies\Http\Requests\UpdatePersonalInfoRequest;
use App\Domains\Companies\Http\Requests\AnswerToVacancyInvitationRequest;
use App\Jobs\AnswerToVacancyRequestJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CompanyController extends BaseController
{

    private $vacancyService;
    private $companyService;

    public function __construct(VacancyService $vacancyService, CompanyService $companyService)
    {
        $this->vacancyService = $vacancyService;
        $this->companyService = $companyService;
    }

    public function getPersonalData(Request $request)
    {
        try {
            $currentCompany = $request->user()->company;
            return Helper::successResponse($currentCompany, 'My company info');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function updatePersonalInfo(UpdatePersonalInfoRequest $request) {
        try {
            DB::beginTransaction();
            $currentUser = $request->user();

            $updateCompanyDto = new UpdateCompanyDto($request);
            $this->companyService->updateCompany($currentUser, $updateCompanyDto->getDTO());

            DB::commit();
            return Helper::successResponse([], 'Company updated');
        } catch(\Exception $exception) {
            DB::rollBack();
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function answerToVacancyRequest(AnswerToVacancyInvitationRequest $request) {
        try {
            AnswerToVacancyRequestJob::dispatch($request);
            return Helper::successResponse([], 'Company replied to candidate`s vacancy request');
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
            $newVacancy = $this->vacancyService->createVacancy($currentCompany, $createVacancyDto->getDTO());

            //TODO в обсервер (то же самое для вакансий)
            //Cache::put('vacancy:'.$newVacancy->id, $newVacancy);

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
            $this->vacancyService->updateVacancy($vacancy, $createVacancyDto->getDTO());

            return Helper::successResponse(['vacancy_id' => $vacancy->id], 'Vacancy successfully updated');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function deleteVacancy($id, Request $request)
    {
        try {
            $currentCompany = $request->user()->company;
            $vacancy = Helper::checkElementExistense(Vacancies::class, $id);
            if ($currentCompany->id != $vacancy->company_id) {
                throw new RuntimeException("Vacancy doesn`t relate to this company");
            }

            $vacancy->delete();

            //TODO в обсервер (то же самое для вакансий)
            //Cache::forget('vacancy:'.$newVacancy->id, $newVacancy);

            return Helper::successResponse([], 'Vacancy successfully deleted');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }
}
