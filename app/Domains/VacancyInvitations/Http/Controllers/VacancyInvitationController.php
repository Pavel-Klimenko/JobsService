<?php

declare(strict_types = 1);

namespace App\Domains\VacancyInvitations\Http\Controllers;

use App\Jobs\CreateVacancyRequestJob;
use App\Services\VacancyInvitationsService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Helper;
use App\Domains\VacancyInvitations\Http\Requests\createVacancyInvitationRequest;

class VacancyInvitationController extends BaseController
{
    private $vacancyInvitationsService;

    public function __construct(
        VacancyInvitationsService $vacancyInvitationsService
    )
    {
        $this->vacancyInvitationsService = $vacancyInvitationsService;
    }

    //методы для работы с откликами
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
            $isThereVacancyRequest = $this->vacancyInvitationsService->isThereVacancyRequest($currentCandidate, $vacancyId);

            return Helper::successResponse([
                'vacancy_id' => $vacancyId,
                'is_there_vacancy_request' => $isThereVacancyRequest,
            ]);
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }
}
