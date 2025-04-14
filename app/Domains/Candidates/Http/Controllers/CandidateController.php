<?php

declare(strict_types = 1);

namespace App\Domains\Candidates\Http\Controllers;

use App\Domains\Candidates\Http\Requests\UpdateCandidateInfoRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Helper;
use App\Domains\Candidates\Http\Requests\GetCandidatesRequest;

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
            $candidate = $this->candidateService->getCandidate($id);
            return Helper::successResponse(['candidate' => $candidate]);
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    //TODO вынести в интерфейс и применить паттерн стратегия
    public function getCandidateData(Request $request)
    {
        $candidate = $this->candidateService->getCandidate($request->user()->candidate->id);
        return Helper::successResponse(['candidate' => $candidate], 'Candidate`s personal data');
    }

    public function updatePersonalInfo(UpdateCandidateInfoRequest $request) {
        try {
            DB::beginTransaction();

            $user = $request->user();
            $candidate = $request->user()->candidate;

            $updateCandidateDto = new UpdateCandidateDto($request);
            $arCandidateParams = $updateCandidateDto->getCandidateDTO();
            $arUserParams = $updateCandidateDto->getCandidateUserDTO();

            $candidate->update($arCandidateParams);
            $user->update($arUserParams);

            Cache::flush();
            DB::commit();
            return Helper::successResponse([], 'Candidate and related user updated');
        } catch(\Exception $exception) {
            DB::rollBack();
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function getCandidates(GetCandidatesRequest $request)
    {
        try {
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
}
