<?php

declare(strict_types = 1);

namespace App\Services;

use App\Domains\Candidates\Models\InterviewInvitations;
use App\Domains\Candidates\Models\InvitationsStatus;
use App\Domains\Vacancies\DTO\CreateVacancyDto;
use App\Domains\Vacancies\DTO\UpdateVacancyDto;
use App\Domains\Vacancies\Models\Vacancies;
use App\Domains\Personal\Models\Company;
use RuntimeException;

class VacancyService
{
    public function answerToVacancyRequest(InterviewInvitations $vacancyRequest, InvitationsStatus $answerStatus):void
    {
        $vacancyRequest->status_id = $answerStatus->id;
        $vacancyRequest->save();
    }

    public function createVacancy(Company $company, CreateVacancyDto $createVacancyDto): Vacancies
    {
        return Vacancies::create([
            'title' => $createVacancyDto->title,
            'job_category_id' => $createVacancyDto->job_category_id,
            'salary_from' => $createVacancyDto->salary_from,
            'description' => $createVacancyDto->description,
            'company_id' => $company->id,
        ]);
    }

    public function updateVacancy(Vacancies $vacancy, UpdateVacancyDto $updateVacancyDto) {
        return $vacancy->update([
            'title' => $updateVacancyDto->title,
            'job_category_id' => $updateVacancyDto->job_category_id,
            'salary_from' => $updateVacancyDto->salary_from,
            'description' => $updateVacancyDto->description,
        ]);
    }

    public function getVacancyById(int $id) {
        return Vacancies::with('job_category', 'company.user')->findOrFail($id);
    }
}
