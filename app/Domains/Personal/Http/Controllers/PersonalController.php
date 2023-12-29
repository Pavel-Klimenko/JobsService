<?php
namespace App\Domains\Personal\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use App\Domains\Personal\Actions;

class PersonalController extends BaseController
{
    public function getPersonalInfo(Request $request)
    {
        return app(Actions\getPersonalInfo::class)->run($request);
    }

    public function getCompanyVacancies(Request $request)
    {
        return app(Actions\getCompanyVacancies::class)->run($request);
    }

//    public function createInterviewInviteFromCandidate(Request $request)
//    {
//        return app(Actions\createInterviewInviteFromCandidate::class)->run($request);
//    }

    public function createInterviewInvitation(Request $request)
    {
        return app(Actions\createInterviewInvitation::class)->run($request);
    }










}
