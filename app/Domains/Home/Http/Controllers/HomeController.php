<?php
namespace App\Domains\Home\Http\Controllers;

use App\Domains\Home\Actions;
//use App\Events\NewEntityCreated;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{

    public function getHomePageData(Request $request)
    {
        $response = app(Actions\getHomePageData::class)->run($request);
        return $response;
        //event(new NewEntityCreated($date));
    }
}
