<?php

namespace App\Domains\Personal\Actions;

use App\Helper;
use App\Domains\Candidates\Models\Candidate;


class getInterviewInvitations
{
    public function run($id, $status) {
/*       if (Helper::isAdmin()) {
            return redirect()->route('admin-main');
        }*/

       //$user = auth()->user();
/*        $isCompanyFlag = Helper::isCompany();
        $isCandidateFlag = Helper::isCandidate();*/


        $itemsOnPage = 2;
        switch ($status) {
            case 'accepted':
                //$title = 'Accepted interview requests';
                $candidatesRequests = Candidate::find($id)
                    ->acceptedInvitations($id)
                    ->paginate($itemsOnPage)
                   ->withQueryString();
                break;
            case 'rejected':
                //$title = 'Rejected interview requests';
               $candidatesRequests = Candidate::find($id)
                    ->rejectedInvitations($id)
                    ->paginate($itemsOnPage)
                   ->withQueryString();
                break;
            case 'all':
                //$title = 'All interview requests';
                $candidatesRequests = Candidate::find($id)
                    ->allInvitations($id)
                    ->paginate($itemsOnPage)
                    ->withQueryString();
                break;
        }

        return $candidatesRequests;
    }
}
