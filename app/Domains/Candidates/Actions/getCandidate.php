<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Candidates\Actions;

use App\Domains\Candidates\Models\Candidate;

class getCandidate
{
    public function run($id) {
        try {
            return Candidate::with('user', 'job_category', 'level')->find($id);
        } catch(\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
