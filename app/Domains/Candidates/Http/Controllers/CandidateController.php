<?php
namespace App\Domains\Candidates\Http\Controllers;

use App\Domains\Candidates\Actions;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;



class CandidateController extends BaseController
{
    public function getCandidate($id)
    {
        return app(Actions\getCandidate::class)->run($id);
    }

    public function getCandidates(Request $request)
    {
        return app(Actions\getCandidates::class)->run($request);
    }

    public function createInterviewInvitation(Request $request) {
        return app(Actions\createInterviewInvitation::class)->run($request);
    }
}
