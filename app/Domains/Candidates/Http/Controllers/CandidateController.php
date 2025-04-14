<?php declare(strict_types = 1);

namespace App\Domains\Candidates\Http\Controllers;

use App\Domains\Candidates\Http\Requests\UpdateCandidateInfoRequest;

use App\Services\CandidatePersonalService;
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

class CandidateController extends BaseController
{

    private $candidateService;
    private $candidatePersonalService;

    public function __construct(
        CandidateService $candidateService,
        CandidatePersonalService $candidatePersonalService
    )
    {
        $this->candidateService = $candidateService;
        $this->candidatePersonalService = $candidatePersonalService;
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
            $this->candidatePersonalService->updatePersonalInfo($request);
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
