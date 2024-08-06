<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Home\Actions;

use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Home\Models\Review;
use App\Domains\Personal\Models\Company;
use App\Domains\Vacancies\Models\Vacancies;
use App\Domains\Candidates\Models\Candidate;
use App\User;

class getHomePageData
{
    public function run() {
        try {
            $cities = $this->getAllUsersCities();
            $vacancies = Vacancies::with('job_category', 'company')
                ->where('active', true)
                ->get();

            $companies = Company::with('user')->get();
            $candidates = Candidate::with('user', 'job_category')->get();
            $reviews = Review::with('user')->where('active', true)->get();
            $jobCategories = JobCategories::has('vacancies')->get();

            $arResponse = [
                'cities' => $cities,
                'job_categories' => $jobCategories,
                'vacancies' => $vacancies,
                'candidates' => $candidates,
                'companies' => $companies,
                'reviews' => $reviews,
            ];

            return collect($arResponse);

        } catch(\Exception $exception) {
            return $exception->getMessage();
        }
    }


    private function getAllUsersCities()
    {
        $users = User::where('city', '<>', '')->where('active', 1)->get()->toArray();
        $cities = array_column($users, 'city');
        return array_unique($cities);
    }
}
