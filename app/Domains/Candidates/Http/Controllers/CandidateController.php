<?php

declare(strict_types = 1);

namespace App\Domains\Candidates\Http\Controllers;

use App\Domains\Vacancies\Models\Vacancies;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Helper;
use RuntimeException;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Candidates\Models\CandidateLevels;

use App\Domains\Candidates\QueryFilters\JobCategoryId as FilterByJobCategory;
use App\Domains\Candidates\QueryFilters\LevelId as FilterByLevel;

use App\Domains\Candidates\Models\Candidate;
use App\User;
use App\QueryFilters\Filter;
use App\Services\FileService;

use App\Services\CandidateService;
use Illuminate\Support\Facades\DB;

class CandidateController extends BaseController
{

    private $candidateService;
    private $fileService;

    public function __construct(CandidateService $candidateService, FileService $fileService)
    {
        $this->candidateService = $candidateService;
        $this->fileService = $fileService;
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

    public function updatePersonalInfo(Request $request) {
        try {
            DB::beginTransaction();
            //TODO делать валидацию в Respons ах
            //TODO использовать Spatie DTO библиотеку

            $request->validate([
                'candidate_id' => 'required|integer',
                'user_id' => 'required|integer',

                'name' => 'required|string',
                'country' => 'required|string',
                'city' => 'required|string',
                'phone' =>  'required|string',

                'job_category_id' =>  'required|integer',
                'level_id' =>  'required|integer',
                'years_experience' =>  'required|integer',
                'salary' =>  'required|numeric',
                'experience' =>  'required|string',
                'education' =>  'required|string',
                'about_me' =>  'required|string',
            ]);



            Helper::checkElementExistense(JobCategories::class, $request->job_category_id);
            Helper::checkElementExistense(CandidateLevels::class, $request->level_id);

            $candidate = Helper::checkElementExistense(Candidate::class, $request->candidate_id);
            $user = Helper::checkElementExistense(User::class, $request->user_id);

            //обновляем кандидата
            $arCandidateParams = [
                'job_category_id' => $request->job_category_id,
                'level_id' => $request->level_id,
                'years_experience' => $request->years_experience,
                'salary' => $request->salary,
                'experience' => $request->experience,
                'education' => $request->education,
                'about_me' => $request->about_me,
            ];

            $arUserParams = [
                'name' => $request->name,
                'country' => $request->country,
                'city' => $request->city,
                'phone' => $request->phone,
                'education' => $request->education,
                'about_me' => $request->about_me,
            ];

            $candidate->update($arCandidateParams);
            $user->update($arUserParams);

            //dd($updatedCandidate);



            DB::commit();
            return Helper::successResponse(['$path' => $arUserParams], 'Candidate updated');
        } catch(\Exception $exception) {
            DB::rollBack();
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function createVacancyRequest(Request $request) {
        try {
            $request->validate([
                'vacancy_id' => 'required|integer',
                'candidate_covering_letter' => 'string',
            ]);

            $candidate = $request->user()->candidate;
            $vacancy = Helper::checkElementExistense(Vacancies::class, $request->vacancy_id);

            $newVacancyRequest = $this->candidateService->createVacancyRequest($candidate, $vacancy, $request->candidate_covering_letter);

            return Helper::successResponse($newVacancyRequest, 'New vacancy request created');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
        //TODO сделать отдельный сервис
//        Mail::send(new UserNotification([
//            'TYPE' => 'interview_invitation',
//            'COMPANY_ID' => $request->COMPANY_ID,
//            'VACANCY_ID' => $request->VACANCY_ID,
//            'CANDIDATE_COVERING_LETTER' => $request->CANDIDATE_COVERING_LETTER,
//        ]));
    }

    public function getMyVacancyRequests(Request $request) {
        try {
            //$candidate = $request->user()->candidate;

            $candidate = Candidate::find(1);

            return Helper::successResponse($candidate->vacancyRequests, 'My vacancy requests');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }



}
