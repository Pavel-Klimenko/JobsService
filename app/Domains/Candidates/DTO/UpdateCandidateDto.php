<?php

namespace App\Domains\Candidates\DTO;

use App\Domains\Candidates\Http\Requests\UpdateCandidateInfoRequest;

final class UpdateCandidateDto
{
    public $name;
    public $country;
    public $city;
    public $phone;
    public $job_category_id;
    public $level_id;
    public $years_experience;
    public $salary;
    public $experience;
    public $education;
    public $about_me;

    public function __construct(UpdateCandidateInfoRequest $request)
    {
        $this->name = $request->name;
        $this->country = $request->country;
        $this->city = $request->city;
        $this->phone = $request->phone;
        $this->job_category_id = $request->job_category_id;
        $this->level_id = $request->level_id;
        $this->years_experience = $request->years_experience;
        $this->salary = $request->salary;
        $this->experience = $request->experience;
        $this->education = $request->education;
        $this->about_me = $request->about_me;
    }

    public function getCandidateDTO()
    {
        return [
            'job_category_id' => $this->job_category_id,
            'level_id' => $this->level_id,
            'years_experience' => $this->years_experience,
            'salary' => $this->salary,
            'experience' => $this->experience,
            'education' => $this->education,
            'about_me' => $this->about_me,
        ];
    }

    public function getCandidateUserDTO()
    {
        return [
            'name' => $this->name,
            'country' => $this->country,
            'city' => $this->city,
            'phone' => $this->phone,
        ];
    }
}
