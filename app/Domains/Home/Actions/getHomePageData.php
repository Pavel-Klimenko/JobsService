<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Home\Actions;

use App\Constants;
use App\Domains\Vacancies\Models\Vacancies;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class getHomePageData
{
    public function run() {
        try {
            $cities = DB::table('vacancies')->select('CITY')->distinct()->where('CITY', '<>', '')->where('ACTIVE', 1)->get();
            $jobCategories = DB::table('job_categories')->get();
            $vacancyCategories = DB::table('vacancies')->select('CATEGORY_ID')->distinct()->where('ACTIVE', 1)->limit(8)->get();
            $vacancies = DB::table('vacancies')->where('ACTIVE', 1)->limit(6)->get();
            $candidates = DB::table('users')->where('ACTIVE', 1)->where('role_id', Constants::USER_ROLES_IDS['candidate'])->limit(15)->get();
            $companies = DB::table('users')->where('ACTIVE', 1)->where('role_id', Constants::USER_ROLES_IDS['company'])->limit(4)->get();
            $reviews = DB::table('reviews')->where('ACTIVE', 1)->limit(10)->get();

            $result = [
                'cities' => $cities, 'job_categories' => $jobCategories, 'vacancy_categories' => $vacancyCategories,
                'vacancies' => $vacancies, 'candidates' => $candidates, 'companies' => $companies, 'reviews' => $reviews,
            ];

            Log::info('getHomePageData()', ['response_data' => $result]);
            return $result;
        } catch(\Exception $exception) {
            Log::error('getHomePageData()', ['error_message' => $exception->getMessage()]);
            return $exception->getMessage();
        }
    }
}
