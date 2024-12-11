<?php

declare(strict_types = 1);

namespace App\Services;

use App\Domains\Companies\DTO\UpdateCompanyDto;
use App\User;

class CompanyService
{
    public function updateCompany(User $ownerOfCompany, UpdateCompanyDto $companyDto):void
    {
        $company = $ownerOfCompany->company;

        $company->update([
            'employee_cnt' => $companyDto->employee_cnt,
            'web_site' => $companyDto->web_site,
            'description' => $companyDto->description,
        ]);

        $ownerOfCompany->update([
            'name' => $companyDto->name,
            'country' => $companyDto->country,
            'city' => $companyDto->city,
            'phone' => $companyDto->phone,
        ]);
    }
}
