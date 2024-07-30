<?php
namespace App\Domains\Home\Http\Controllers;

use App\Domains\Home\Actions;
//use App\Events\NewEntityCreated;
use Illuminate\Http\Request;
use App\Helper;

use App\Domains\Home\Models\Review;

use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function getHomePageData(Request $request)
    {
        return app(Actions\getHomePageData::class)->run($request);
    }

    public function addReview(Request $request)
    {
        dd($request->all());

        //return app(Actions\getHomePageData::class)->run($request);
    }

    public function getReviews(Request $request)
    {
        $paginationParams = Helper::getPaginationParams($request);

        return Review::with('user')
            ->paginate($paginationParams['limit_page'], ['*'], 'page', $paginationParams['page']);
    }

}
