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

    public function createInterviewInvitation(Request $request)
    {
        return app(Actions\createInterviewInvitation::class)->run($request);
    }

    public function changeInvitationStatus(Request $request)
    {
        return app(Actions\changeInvitationStatus::class)->run($request);
    }

    public function getIterviewInvitations(Request $request)
    {
        return app(Actions\getIterviewInvitations::class)->run($request);
    }

    public function updateUserInfo(Request $request)
    {
        return app(Actions\updateUserInfo::class)->run($request);
    }
}
