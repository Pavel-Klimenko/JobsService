<?php
namespace App\Domains\Vacancies\Http\Controllers;


/*use App\Containers\Vacancies\Actions;
use App\Contracts\CacheContract;
use App\Events\NewEntityCreated;
use App\Ship\Helpers\Helper;*/


use App\Domains\Vacancies\Models\Vacancies;

use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use App\Domains\Vacancies\Actions;
use App\QueryFilters\Filter;

use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Vacancies\QueryFilters\JobCategoryId as FilterByJobCategory;
use App\Domains\Vacancies\QueryFilters\SalaryFrom as FilterBySalaryFrom;


class VacancyController extends BaseController
{
    public function getVacancies(Request $request)
    {
        try {
            $request->validate([
                'job_category_id' => 'integer',
                'salary_from' => 'numeric',
            ]);

            $paginationParams = Helper::getPaginationParams($request);
            Helper::checkElementExistense(JobCategories::class, $request->job_category_id);

            $vacancies = Filter::getByFilter(Vacancies::class, [FilterByJobCategory::class, FilterBySalaryFrom::class]);

            $vacancies = $vacancies->with('job_category', 'company.user')
                ->paginate($paginationParams['limit_page'], ['*'], 'page', $paginationParams['page']);

            return Helper::successResponse(["vacancies" => $vacancies], 'Vacancies list');
        } catch(\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function getVacancy($id)
    {
        return app(Actions\getVacancy::class)->run($id);
    }

    public function createVacancy(Request $request)
    {
        return app(Actions\createVacancy::class)->run($request->all());

        //sending notification to admin
/*        $date = (object) [
            'entity' => 'vacancy',
            'message' =>  'Added new vacancy',
            'entity_id' => $newVacancy->ID,
        ];

        event(new NewEntityCreated($date));*/
    }

    public function deleteVacancy(Request $request)
    {
        return app(Actions\deleteVacancy::class)->run($request->id);
    }

    public function updateVacancy($id, Request $request)
    {
        return app(Actions\updateVacancy::class)->run($id, $request);

        //$this->cacheService->deleteKeyFromCache('vacancy_'.$request->VACANCY_ID);
        //sending notification to admin
/*        $date = (object) [
            'entity' => 'vacancy',
            'message' =>  'Updated new vacancy',
            'entity_id' => $request->VACANCY_ID,
        ];
        event(new NewEntityCreated($date));*/
        //return back();
    }


}
