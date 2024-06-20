<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Home\Actions;

use App\Constants;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Vacancies\Models\Vacancies;
use App\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class getHomePageData
{
    public function run() {
        try {

            //TODO сделать через получение связанных данных with или через joins

            //TODO проверку авторизации. Ларавел пасспорт или санктум

            $cities = DB::table('vacancies')->select('CITY')->distinct()->where('CITY', '<>', '')->where('ACTIVE', 1)->get();

            $jobCategories = DB::table('job_categories')->get();
            foreach ($jobCategories as $category) {
                $category->QUANTITY_OF_VACANCIES = Helper::countTableRow(Vacancies::class, 'job_category_id', $category->id);
            }

            $vacancyCategories = DB::table('vacancies')->select('job_category_id')->distinct()->where('ACTIVE', 1)->limit(8)->get();
            $vacancies = DB::table('vacancies')->where('ACTIVE', 1)->limit(6)->get();


            $candidates = DB::table('users')->where('ACTIVE', 1)
                ->where('role_id', Constants::USER_ROLES_IDS['candidate'])
                ->limit(15)->get();

            $companies = DB::table('users')->where('ACTIVE', 1)->where('role_id', Constants::USER_ROLES_IDS['company'])->limit(4)->get();
            foreach ($companies as $company) {
                $company->QUANTITY_OF_VACANCIES = Helper::countTableRow(Vacancies::class, 'COMPANY_ID', $company->id);
            }

            $reviews = DB::table('reviews')->where('ACTIVE', 1)->limit(10)->get();


            return [
                'cities' => $cities,
                'job_categories' => $jobCategories,
                'vacancy_categories' => $vacancyCategories,
                'vacancies' => $vacancies,
                'candidates' => $candidates,
                'companies' => $companies,
                'reviews' => $reviews,
            ];

        } catch(\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
