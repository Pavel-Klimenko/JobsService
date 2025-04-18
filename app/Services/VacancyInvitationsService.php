<?php

declare(strict_types = 1);

namespace App\Services;

use App\Domains\Candidates\Models\Candidate;
use App\Domains\Candidates\Models\InvitationsStatus;
use App\Domains\Vacancies\Models\Vacancies;
use App\Domains\Candidates\Models\InterviewInvitations;
use RuntimeException;

class VacancyInvitationsService
{
    public function createVacancyRequest(Candidate $candidate, Vacancies $vacancy, $coveringLetter = NULL) {

        if (InterviewInvitations::where(['vacancy_id' => $vacancy->id, 'candidate_id' => $candidate->id])->exists()) {
            throw new RuntimeException('Candidate has already sent request to this vacancy');
        }

        return InterviewInvitations::create([
            'vacancy_id' => $vacancy->id,
            'candidate_id' => $candidate->id,
            'candidate_covering_letter' => $coveringLetter,
        ]);
    }

    public function getInvitationStatusByCode(string $code) {
        return InvitationsStatus::where('code', $code)->first();
    }
    public function isThereVacancyRequest(Candidate $candidate, int $vacancyId):bool
    {
        $arVacanciesImadeRequest = $candidate->vacancyRequests->toArray();
        $arVacanciesImadeRequestIds = array_column($arVacanciesImadeRequest, 'vacancy_id');

        return in_array($vacancyId, $arVacanciesImadeRequestIds);
    }

}
