<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewInvitations extends Model
{
    protected $table = 'invitations_to_interview';
    protected $primaryKey = 'ID';

    public function scopeAccepted($query) {
        return $query->where('STATUS', 'accepted');
    }

    public function scopeRejected($query) {
        return $query->where('STATUS', 'rejected');
    }

    public function scopeNostatus($query) {
        return $query->where('STATUS', 'no_status');
    }

}
