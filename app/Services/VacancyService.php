<?php

declare(strict_types = 1);

namespace App\Services;

use App\Domains\Candidates\Models\InterviewInvitations;
use App\Domains\Candidates\Models\InvitationsStatus;
use App\Domains\Vacancies\Models\Vacancies;
use RuntimeException;

class VacancyService
{
    public function answerToVacancyRequest(InterviewInvitations $vacancyRequest, InvitationsStatus $answerStatus):void
    {
        $vacancyRequest->status_id = $answerStatus->id;
        $vacancyRequest->save();
    }

    public function createVacancy(array $arParams): Vacancies
    {
        return Vacancies::create($arParams);
    }

    public function updateVacancy(Vacancies $vacancy, array $arParams) {
        return $vacancy->update($arParams);
    }
}
