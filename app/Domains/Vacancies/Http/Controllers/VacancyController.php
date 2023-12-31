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

    public function createVacancy(Request $request):Vacancies
    {
        //sleep(1);

/*        $request->validate([
            'NAME' => 'required|max:255',
            'COUNTRY' => 'required|max:255',
            'CITY' => 'required|max:255',
            'CATEGORY_ID' => 'required|not_in:0',
            'SALARY_FROM' => 'required|max:255',
            'DESCRIPTION' => 'required|max:2500',
            'RESPONSIBILITY' => 'required|max:2500',
            'QUALIFICATIONS' => 'required|max:2500',
            'BENEFITS' => 'required|max:2500',
        ]);*/

        return app(Actions\createVacancy::class)->run($request);

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

    public function updateVacancy(Request $request)
    {
        //sleep(1);

        return app(Actions\updateVacancy::class)->run($request);

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
