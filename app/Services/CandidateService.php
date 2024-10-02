<?php

declare(strict_types = 1);

namespace App\Services;

use App\Domains\Candidates\Models\Candidate;

class CandidateService
{
    public function getCandidate(int $id):Candidate
    {
        return Candidate::with('user', 'job_category', 'level')->findOrFail($id);
    }

}
