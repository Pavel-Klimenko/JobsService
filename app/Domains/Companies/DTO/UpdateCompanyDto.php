<?php

namespace App\Domains\Companies\DTO;

use App\Contracts\DataObjectContract;
use App\Domains\Companies\Http\Requests\UpdatePersonalInfoRequest;

final class UpdateCompanyDto implements DataObjectContract
{
    public $employee_cnt;
    public $web_site;
    public $description;
    public $name;
    public $country;
    public $city;
    public $phone;

    public function __construct(UpdatePersonalInfoRequest $request)
    {
        $this->employee_cnt = $request->employee_cnt;
        $this->web_site = $request->web_site;
        $this->description = $request->description;
        $this->name = $request->name;
        $this->country = $request->country;
        $this->city = $request->city;
        $this->phone = $request->phone;
    }

    public function getDTO():UpdateCompanyDto
    {
        return $this;
    }
}
