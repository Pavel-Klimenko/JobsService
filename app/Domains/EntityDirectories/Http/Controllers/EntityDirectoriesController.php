<?php
namespace App\Domains\EntityDirectories\Http\Controllers;

use App\Domains\Candidates\Models\CandidateLevels;
use App\Domains\Candidates\Models\InvitationsStatus;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Personal\Models\Role;
use App\Services\VacancyService;
use Illuminate\Routing\Controller as BaseController;
use App\Helper;

class EntityDirectoriesController extends BaseController
{
    protected $vacancyService;

    public function __construct(VacancyService $vacancyService)
    {
        $this->vacancyService = $vacancyService;
    }

    public function getUserRoles() {
        try {
            $userRoles = Role::select('id', 'name')->get();
            return Helper::successResponse($userRoles, 'User`s roles');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function getJobCategories()
    {
        try {
            $jobCategories = JobCategories::select('id', 'name')->get();
            return Helper::successResponse($jobCategories, 'Job`s categories');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function getCandidateLevels()
    {
        try {
            $candidateLevels = CandidateLevels::select('id', 'code')->get();
            return Helper::successResponse($candidateLevels, 'Candidate`s levels');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function getCandidateResponseStatuses()
    {
        try {
            $candidateResponseStatuses = InvitationsStatus::select('id', 'code')->get();
            return Helper::successResponse($candidateResponseStatuses, 'Candidate`s response statuses');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

}
