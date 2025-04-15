<?php

declare(strict_types = 1);

namespace App\Services;

use App\Domains\Candidates\Models\Candidate;
use Illuminate\Support\Facades\Cache;

class CandidateService
{
    public function getCandidate(int $id):Candidate
    {
        return Cache::rememberForever('candidate:'.$id, function () use ($id) {
            return $this->getCandidateData($id);
        });
    }

    private function getCandidateData(int $id):Candidate
    {
        return Candidate::with('user', 'job_category', 'level')->findOrFail($id);
    }
}
