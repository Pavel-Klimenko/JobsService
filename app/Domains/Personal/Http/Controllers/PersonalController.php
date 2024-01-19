<?php
namespace App\Domains\Personal\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use App\Domains\Personal\Actions;

class PersonalController extends BaseController
{
    public function getPersonalInfo($id)
    {
        return app(Actions\getPersonalInfo::class)->run($id);
    }

    public function getCompanyVacancies($id)
    {
        return app(Actions\getCompanyVacancies::class)->run($id);
    }

    public function createInterviewInvitation(Request $request)
    {
        return app(Actions\createInterviewInvitation::class)->run($request);
    }

    public function changeInvitationStatus($id, $status)
    {
        return app(Actions\changeInvitationStatus::class)->run($id, $status);
    }

    public function getInterviewInvitations($id, $status)
    {
        return app(Actions\getInterviewInvitations::class)->run($id, $status);
    }

    public function updateUserInfo(Request $request)
    {
        return app(Actions\updateUserInfo::class)->run($request);
    }
}
