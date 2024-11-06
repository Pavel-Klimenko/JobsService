<?php
namespace App\Domains\Vacancies\Http\Controllers;

use App\Domains\Vacancies\Models\Vacancies;

use App\Helper;
use App\Services\VacancyService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use App\Domains\Vacancies\Actions;
use App\QueryFilters\Filter;
use RuntimeException;

use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Vacancies\QueryFilters\JobCategoryId as FilterByJobCategory;
use App\Domains\Vacancies\QueryFilters\SalaryFrom as FilterBySalaryFrom;


class VacancyController extends BaseController
{

    protected $vacancyService;

    public function __construct(VacancyService $vacancyService)
    {
        $this->vacancyService = $vacancyService;
    }



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
        try {
            if (!$vacancy = Vacancies::with('job_category', 'company.user')->find($id)) {
                throw new RuntimeException("Vacancy with id = $id not found");
            }
            return Helper::successResponse(["vacancy" => $vacancy]);
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function createVacancy(Request $request)
    {
        try {
            //TODO DTO SPATIE + REQUEST VALIDATION!
            $request->validate([
                'title' => 'required|string',
                'job_category_id' => 'required|integer',
                'salary_from' => 'required|numeric',
                'description' => 'required|string',
            ]);

            //dd($request->all());

            Helper::checkElementExistense(JobCategories::class, $request->job_category_id);
            $company = $request->user()->company;


            $arParams = [
                'title' => $request->title,
                'job_category_id' => $request->job_category_id,
                'company_id' => $company->id,
                'salary_from' => $request->salary_from,
                'description' => $request->description,
            ];
            $newVacancy = $this->vacancyService->createVacancy($arParams);

            return Helper::successResponse(["new_vacancy" => $newVacancy], 'New vacancy created');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function deleteVacancy(Request $request)
    {
        return app(Actions\deleteVacancy::class)->run($request->id);
    }

    public function updateVacancy(Request $request)
    {
        try {
            //TODO DTO SPATIE + REQUEST VALIDATION!
            $request->validate([
                'vacancy_id' => 'required|integer',
                'title' => 'string',
                'job_category_id' => 'integer',
                'salary_from' => 'numeric',
                'description' => 'string',
            ]);

            $currentCompany = $request->user()->company->id;

            $vacancy = Helper::checkElementExistense(Vacancies::class, $request->vacancy_id);
            if ($currentCompany->id != $vacancy->company_id) {
                throw new RuntimeException("Vacancy doesn`t relate to this company");
            }

            $arParams = [
                'title' => $request->title,
                'job_category_id' => $request->job_category_id,
                'company_id' => $currentCompany->id,
                'salary_from' => $request->salary_from,
                'description' => $request->description,
            ];

            $arParams = Helper::onlyExistedValues($arParams);

            dd($arParams);

            $newVacancy = $this->vacancyService->updateVacancy($vacancy, $arParams);

            return Helper::successResponse(["new_vacancy" => $newVacancy], 'New vacancy created');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }

    }


}
