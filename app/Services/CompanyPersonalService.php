<?php declare(strict_types = 1);

namespace App\Services;

use App\Contracts\PersonalDataContract;
use App\Domains\Companies\DTO\UpdateCompanyDto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class CompanyPersonalService implements PersonalDataContract
{
    private $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function updatePersonalInfo($request):void {
        DB::beginTransaction();
        $currentUser = $request->user();
        $updateCompanyDto = new UpdateCompanyDto($request);
        $this->companyService->updateCompany($currentUser, $updateCompanyDto->getDTO());
        Cache::flush();
        DB::commit();
    }

}
