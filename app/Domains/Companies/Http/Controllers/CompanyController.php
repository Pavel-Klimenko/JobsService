<?php
namespace App\Domains\Companies\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Helper;
use RuntimeException;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Candidates\Models\CandidateLevels;

use App\Domains\Candidates\QueryFilters\JobCategoryId as FilterByJobCategory;
use App\Domains\Candidates\QueryFilters\LevelId as FilterByLevel;

use App\Domains\Candidates\Models\Candidate;
use App\QueryFilters\Filter;

class CompanyController extends BaseController
{
    public function getPersonalData($id)
    {
        try {

            dd(3333333333);

            //TODO сделать репозитории и DTO!
            if (!$candidate = Candidate::with('user', 'job_category', 'level')->find($id)) {
                throw new RuntimeException("Candidate with id = $id not found");
            }
            return Helper::successResponse(["candidate" => $candidate]);
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }
}
