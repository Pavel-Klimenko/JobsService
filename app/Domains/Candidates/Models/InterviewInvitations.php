<?php

namespace App\Domains\Candidates\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewInvitations extends Model
{

    //protected $fillable = ['COMPANY_ID', 'CANDIDATE_ID', 'VACANCY_ID', 'CANDIDATE_COVERING_LETTER'];

    protected $table = 'invitations_to_interview';
    const TABLE_NAME = 'invitations_to_interview';

//    public function scopeAccepted($query) {
//        return $query->where('STATUS', 'accepted');
//    }
//
//    public function scopeRejected($query) {
//        return $query->where('STATUS', 'rejected');
//    }
//
//    public function scopeNostatus($query) {
//        return $query->where('STATUS', 'no_status');
//    }

}
