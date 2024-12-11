<?php
namespace App\Domains\Vacancies\Http\Controllers;

use App\Domains\Vacancies\Models\Vacancies;
use App\Helper;
use App\Services\VacancyService;
use App\Domains\Vacancies\Http\Requests\GetVacanciesRequest;
use Illuminate\Routing\Controller as BaseController;
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

    public function getVacancies(GetVacanciesRequest $request)
    {
        try {
            $paginationParams = Helper::getPaginationParams($request);
            Helper::checkElementExistense(JobCategories::class, $request->job_category_id);

            $vacancies = Filter::getByFilter(Vacancies::class, [FilterByJobCategory::class, FilterBySalaryFrom::class]);
            $vacancies->where('active', true);

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
            if (!$vacancy = $this->vacancyService->getVacancyById($id)) {
                throw new RuntimeException("Vacancy with id = $id not found");
            }
            return Helper::successResponse(["vacancy" => $vacancy]);
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }
}
