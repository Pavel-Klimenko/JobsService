<?php
namespace App\Domains\Personal\Http\Controllers;

use App\Mail\UserMailNotification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use App\Domains\Personal\Actions;
use Illuminate\Support\Facades\Mail;

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

    public function changeInvitationStatus($id, $status)
    {
        $response = app(Actions\changeInvitationStatus::class)->run($id, $status);

        Mail::send(new UserMailNotification([
            'TYPE' => 'answer_to_invitation',
            'INVITATION' => $response['invitation'],
            'CANDIDATE' => $response['candidate'],
            'COMPANY' => $response['company'],
            'VACANCY' => $response['vacancy'],
        ]));

        return $response;
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
