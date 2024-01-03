<?php

namespace App\Domains\Personal\Actions;

use App\Helper;
use App\Domains\Candidates\Models\User;


class getIterviewInvitations
{
    public function run($request) {
/*       if (Helper::isAdmin()) {
            return redirect()->route('admin-main');
        }*/

       //$user = auth()->user();
/*        $isCompanyFlag = Helper::isCompany();
        $isCandidateFlag = Helper::isCandidate();*/


        $itemsOnPage = 2;
        switch ($request->status) {
            case 'accepted':
                //$title = 'Accepted interview requests';
                $candidatesRequests = User::find($request->user_id)
                    ->acceptedInvitations($request->user_id)
                    ->paginate($itemsOnPage)
                   ->withQueryString();
                break;
            case 'rejected':
                //$title = 'Rejected interview requests';
               $candidatesRequests = User::find($request->user_id)
                    ->rejectedInvitations($request->user_id)
                    ->paginate($itemsOnPage)
                   ->withQueryString();
                break;

            default:
                //$title = 'All interview requests';
                $candidatesRequests = User::find($request->user_id)
                    ->allInvitations($request->user_id)
                    ->paginate($itemsOnPage)
                    ->withQueryString();
                break;
        }

        return $candidatesRequests;


/*       return view('personal.InterviewRequests',
            compact('candidatesRequests', 'title', 'isCompanyFlag', 'isCandidateFlag'));*/
    }
}
