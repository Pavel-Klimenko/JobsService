<?php

declare(strict_types = 1);

namespace App\Domains\Candidates\Http\Controllers;

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

use App\Services\CandidateService;

class CandidateController extends BaseController
{

    private $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    public function getCandidate(int $id)
    {
        try {
            $candidate = $this->candidateService->getCandidate($id);
            return Helper::successResponse(["candidate" => $candidate]);
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }


    public function getCandidates(Request $request)
    {
        try {
            $request->validate([
                'job_category_id' => 'integer',
                'level_id' => 'integer',
            ]);

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

    public function update(Request $request) {
        try {


//            $request->validate([
//                'job_category_id' => 'integer',
//                'level_id' => 'integer',
//            ]);

//            Helper::checkElementExistense(JobCategories::class, $request->job_category_id);
//            Helper::checkElementExistense(CandidateLevels::class, $request->level_id);
//
//            $paginationParams = Helper::getPaginationParams($request);
//
//            $candidates = Filter::getByFilter(Candidate::class, [FilterByJobCategory::class, FilterByLevel::class]);
//            $candidates = $candidates
//                ->with('user', 'job_category', 'level')
//                ->paginate($paginationParams['limit_page'], ['*'], 'page', $paginationParams['page']);

            return Helper::successResponse(["test" => $request->all()], 'TEST');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }



//    public function createInterviewInvitation(Request $request) {
//        app(Actions\createInterviewInvitation::class)->run($request);
//
//        Mail::send(new UserNotification([
//            'TYPE' => 'interview_invitation',
//            'COMPANY_ID' => $request->COMPANY_ID,
//            'VACANCY_ID' => $request->VACANCY_ID,
//            'CANDIDATE_COVERING_LETTER' => $request->CANDIDATE_COVERING_LETTER,
//        ]));
//    }
}
