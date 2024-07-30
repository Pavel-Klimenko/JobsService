<?php
namespace App\Domains\Candidates\Http\Controllers;

use App\Domains\Candidates\Actions;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Helper;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Mail;



class CandidateController extends BaseController
{
    public function getCandidate($id)
    {
        return app(Actions\getCandidate::class)->run($id);
    }

    public function getCandidates(Request $request)
    {
        $paginationParams = Helper::getPaginationParams($request);

        return app(Actions\getCandidates::class)->run($paginationParams['page'], $paginationParams['limit_page']);
    }

//    public function createInterviewInvitation(Request $request) {
//        app(Actions\createInterviewInvitation::class)->run($request);
//
//        Mail::send(new UserNotification([
//            'TYPE' => 'interview_invitation',
//            'COMPANY_ID' => $request->COMPANY_ID,
//            'VACANCY_ID' => $request->VACANCY_ID,
//            'CANDIDATE_COVERING_LETTER' => $request->CANDIDATE_COVERING_LETTER,
//        ]));
//    }
}
