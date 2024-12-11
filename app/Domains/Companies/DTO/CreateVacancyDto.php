<?php

namespace App\Domains\Companies\DTO;

use App\Contracts\DataObjectContract;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Companies\Http\Requests\CreateVacancyRequest;
use App\Helper;

final class CreateVacancyDto implements DataObjectContract
{

    public $title;
    public $job_category_id;
    public $salary_from;
    public $description;

    public function __construct(CreateVacancyRequest $request)
    {
        $this->title = $request->title;
        $this->job_category_id = $request->job_category_id;
        $this->salary_from = $request->salary_from;
        $this->description = $request->description;
    }

    public function getDTO():CreateVacancyDto
    {
        Helper::checkElementExistense(JobCategories::class, $this->job_category_id);

        return $this;
    }
}
