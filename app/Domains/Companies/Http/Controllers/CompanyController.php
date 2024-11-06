<?php
namespace App\Domains\Companies\Http\Controllers;

use App\Domains\Candidates\Models\InterviewInvitations;
use App\Domains\Candidates\Models\InvitationsStatus;
use App\Domains\Vacancies\Models\Vacancies;
use App\Services\CandidateService;
use App\Services\FileService;
use App\Services\VacancyService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Helper;
use RuntimeException;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Candidates\Models\CandidateLevels;

use App\Domains\Candidates\QueryFilters\JobCategoryId as FilterByJobCategory;
use App\Domains\Candidates\QueryFilters\LevelId as FilterByLevel;

use App\Domains\Candidates\Models\Candidate;
use App\QueryFilters\Filter;

class CompanyController extends BaseController
{

    protected $vacancyService;

    public function __construct(VacancyService $vacancyService)
    {
        $this->vacancyService = $vacancyService;
    }

    public function getPersonalData($id)
    {
        try {
            //TODO сделать сервисы и DTO!
            if (!$candidate = Candidate::with('user', 'job_category', 'level')->find($id)) {
                throw new RuntimeException("Candidate with id = $id not found");
            }
            return Helper::successResponse(["candidate" => $candidate]);
        } catch(\Exception $exception) {
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
            if ($request->user()->company->id != $vacancyRequest->vacancy->company_id) {
                throw new RuntimeException("Vacancy doesn`t relate to this company");
            }

            $answerStatus = Helper::checkElementExistense(InvitationsStatus::class, $request->answer_status_id);
            $this->vacancyService->answerToVacancyRequest($vacancyRequest, $answerStatus);

            return Helper::successResponse([
                'vacancy' => $vacancyRequest->vacancy,
                'answer_status' => $answerStatus->code
            ]);
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function getMyVacancies(Request $request) {
        try {
            $myVacancies = $request->user()->company->vacancies;
            return Helper::successResponse($myVacancies);
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }
}
