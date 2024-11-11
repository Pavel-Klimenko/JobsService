<?php

namespace App\Domains\Candidates\Models;

use App\Domains\Vacancies\Models\Vacancies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InterviewInvitations extends Model
{

    protected $guarded = [];

    protected $table = 'invitations_to_interview';
    const TABLE_NAME = 'invitations_to_interview';

    public function vacancy(): belongsTo
    {
        return $this->belongsTo(Vacancies::class);
    }

    public function status(): belongsTo
    {
        return $this->belongsTo(InvitationsStatus::class);
    }

    public function candidate(): belongsTo
    {
        return $this->belongsTo(Candidate::class)
            ->with('user', 'level');
    }

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
