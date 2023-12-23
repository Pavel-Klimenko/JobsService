<?php
namespace App\Domains\Vacancies\Http\Controllers;


/*use App\Containers\Vacancies\Actions;
use App\Contracts\CacheContract;
use App\Events\NewEntityCreated;
use App\Ship\Helpers\Helper;*/


use App\Domains\Vacancies\Models\Vacancies;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use App\Domains\Vacancies\Actions;

/*use App\Containers\Vacancies\Models\Vacancies;*/


class VacancyController extends BaseController
{
    public function getVacancies(Request $request)
    {
        return app(Actions\getVacancies::class)->run($request);
    }


    public function getVacancy(Request $request): Vacancies
    {
        return app(Actions\getVacancy::class)->run($request->id);
    }

}
