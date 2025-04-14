<?php declare(strict_types = 1);

namespace App\Services;

use App\Contracts\PersonalDataContract;
use App\Domains\Candidates\DTO\UpdateCandidateDto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class CandidatePersonalService implements PersonalDataContract
{
    public function updatePersonalInfo($request):void {
        DB::beginTransaction();

        $user = $request->user();
        $candidate = $request->user()->candidate;

        $updateCandidateDto = new UpdateCandidateDto($request);
        $arCandidateParams = $updateCandidateDto->getCandidateDTO();
        $arUserParams = $updateCandidateDto->getCandidateUserDTO();

        $candidate->update($arCandidateParams);
        $user->update($arUserParams);

        Cache::flush();
        DB::commit();
    }
}
