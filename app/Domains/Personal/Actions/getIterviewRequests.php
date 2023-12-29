<?php
///**
// * Created by PhpStorm.
// * User: pavel
// * Date: 14/05/23
// * Time: 23:58
// */
//
//namespace App\Containers\Personal\Actions;
//
//use App\Ship\Helpers\Helper;
//use App\Models\User;
//
//class getIterviewRequests
//{
//    public function run($requestsType) {
//        if (Helper::isAdmin()) {
//            return redirect()->route('admin-main');
//        }
//
//        $user = auth()->user();
//        $isCompanyFlag = Helper::isCompany();
//        $isCandidateFlag = Helper::isCandidate();
//
//        $itemsOnPage = 2;
//        switch ($requestsType) {
//            case 'all':
//                $title = 'All interview requests';
//                $candidatesRequests = User::find($user->id)
//                    ->allAdvices()
//                    ->paginate($itemsOnPage)
//                    ->withQueryString();
//                break;
//            case 'accepted':
//                $title = 'Accepted interview requests';
//                $candidatesRequests = User::find($user->id)
//                    ->acceptedAdvices()
//                    ->paginate($itemsOnPage)
//                    ->withQueryString();
//
//                break;
//            case 'rejected':
//                $title = 'Rejected interview requests';
//                $candidatesRequests = User::find($user->id)
//                    ->rejectedAdvices()
//                    ->paginate($itemsOnPage)
//                    ->withQueryString();
//                break;
//        }
//
//
//        return view('personal.InterviewRequests',
//            compact('candidatesRequests', 'title', 'isCompanyFlag', 'isCandidateFlag'));
//    }
//}
