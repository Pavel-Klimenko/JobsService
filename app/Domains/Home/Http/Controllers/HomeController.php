<?php
namespace App\Domains\Home\Http\Controllers;

use App\Domains\Home\Actions;
use App\Helper;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function getHomePageData(Request $request)
    {
        try {
            $response = app(Actions\getHomePageData::class)->run($request);

            return Helper::successResponse($response, 'Homepage data');
        } catch(\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
