<?php
namespace App\Domains\EntityDirectories\Http\Controllers;

use App\Domains\Candidates\Models\CandidateLevels;
use App\Domains\Candidates\Models\InvitationsStatus;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Personal\Models\Role;
use App\Services\VacancyService;
use Illuminate\Routing\Controller as BaseController;
use App\Helper;
use Illuminate\Support\Facades\Cache;


class EntityDirectoriesController extends BaseController
{
    protected $vacancyService;

    public function __construct(VacancyService $vacancyService)
    {
        $this->vacancyService = $vacancyService;
    }

    public function getUserRoles() {
        try {
            $userRoles = Cache::rememberForever('roles:all', function () {
                 return Role::select('id', 'name')->get();
            });

            return Helper::successResponse($userRoles, 'User`s roles');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function getJobCategories()
    {
        try {
            $jobCategories = Cache::rememberForever('job_categories:all', function () {
                return JobCategories::select('id', 'name')->get();
            });

            return Helper::successResponse($jobCategories, 'Job`s categories');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function getCandidateLevels()
    {
        try {
            $candidateLevels = Cache::rememberForever('candidate_levels:all', function () {
                return CandidateLevels::select('id', 'code')->get();
            });
            return Helper::successResponse($candidateLevels, 'Candidate`s levels');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function getCandidateResponseStatuses()
    {
        try {
            $candidateResponseStatuses = Cache::rememberForever('invitation_statuses:all', function () {
                return InvitationsStatus::select('id', 'code')->get();
            });
            return Helper::successResponse($candidateResponseStatuses, 'Candidate`s response statuses');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

}
