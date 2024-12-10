<?php

namespace App\Domains\Vacancies\DTO;

use App\Contracts\DataObjectContract;
use App\Domains\Companies\Http\Requests\UpdateVacancyRequest;

final class UpdateVacancyDto implements DataObjectContract
{
    public $title;
    public $job_category_id;
    public $salary_from;
    public $description;
    public $vacancy_id;

    public function __construct(UpdateVacancyRequest $request)
    {
        $this->title = $request->title;
        $this->job_category_id = $request->job_category_id;
        $this->salary_from = $request->salary_from;
        $this->description = $request->description;
        $this->vacancy_id = $request->vacancy_id;
    }

    public function getDTO():UpdateVacancyDto
    {
        return $this;
    }
}
