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

/*use App\Containers\Vacancies\Models\Vacancies;*/


class VacancyController extends BaseController
{
    public function getVacancies(Request $request)
    {
        $paginationParams = Helper::getPaginationParams($request);

        return app(Actions\getVacancies::class)->run($paginationParams['page'], $paginationParams['limit_page']);
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
