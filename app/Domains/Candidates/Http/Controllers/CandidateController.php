<?php

declare(strict_types = 1);

namespace App\Domains\Candidates\Http\Controllers;

use App\Domains\Candidates\Http\Requests\UpdateCandidateInfoRequest;
use App\Jobs\CreateVacancyRequestJob;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Helper;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Candidates\Models\CandidateLevels;
use App\Domains\Candidates\Http\Requests\GetCandidatesRequest;
use App\Domains\Candidates\Http\Requests\createVacancyInvitationRequest;

use App\Domains\Candidates\QueryFilters\JobCategoryId as FilterByJobCategory;
use App\Domains\Candidates\QueryFilters\LevelId as FilterByLevel;

use App\Domains\Candidates\Models\Candidate;
use App\QueryFilters\Filter;


use App\Services\CandidateService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Domains\Candidates\DTO\UpdateCandidateDto;

class CandidateController extends BaseController
{

    private $candidateService;

    public function __construct(
        CandidateService $candidateService
    )
    {
        $this->candidateService = $candidateService;
    }

    public function getCandidate(int $id)
    {
        try {
            $candidate = Cache::rememberForever('candidate:'.$id, function () use ($id) {
                return $this->candidateService->getCandidate($id);
            });
            return Helper::successResponse(['candidate' => $candidate]);
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function getCandidates(GetCandidatesRequest $request)
    {
        try {
            Helper::checkElementExistense(JobCategories::class, $request->job_category_id);
            Helper::checkElementExistense(CandidateLevels::class, $request->level_id);

            $paginationParams = Helper::getPaginationParams($request);

            $candidates = Filter::getByFilter(Candidate::class, [FilterByJobCategory::class, FilterByLevel::class]);
            $candidates = $candidates
                ->with('user', 'job_category', 'level')
                ->paginate($paginationParams['limit_page'], ['*'], 'page', $paginationParams['page']);

            return Helper::successResponse(["candidates" => $candidates], 'Candidates list');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function updatePersonalInfo(UpdateCandidateInfoRequest $request) {
        try {
            DB::beginTransaction();

            Helper::checkElementExistense(JobCategories::class, $request->job_category_id);
            Helper::checkElementExistense(CandidateLevels::class, $request->level_id);

            $user = $request->user();
            $candidate = $request->user()->candidate;

            $updateCandidateDto = new UpdateCandidateDto($request);
            $arCandidateParams = $updateCandidateDto->getCandidateDTO();
            $arUserParams = $updateCandidateDto->getCandidateUserDTO();

            $candidate->update($arCandidateParams);
            $user->update($arUserParams);

            DB::commit();
            return Helper::successResponse([], 'Candidate updated and related user updated');
        } catch(\Exception $exception) {
            DB::rollBack();
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function createVacancyRequest(createVacancyInvitationRequest $request) {
        try {

           CreateVacancyRequestJob::dispatch($request);

            return Helper::successResponse([], 'New vacancy request created');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function getMyVacancyRequests(Request $request) {
        try {
            $candidate = $request->user()->candidate;
            return Helper::successResponse($candidate->vacancyRequests, 'My vacancy requests');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function isThereVacancyRequest(Request $request) {
        try {
            $request->validate(['vacancy_id' => 'required|integer']);
            $currentCandidate = $request->user()->candidate;
            $vacancyId = (int)$request->vacancy_id;
            $isThereVacancyRequest = $this->candidateService->isThereVacancyRequest($currentCandidate, $vacancyId);

            return Helper::successResponse([
                'vacancy_id' => $vacancyId,
                'is_there_vacancy_request' => $isThereVacancyRequest,
            ]);
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }
}
