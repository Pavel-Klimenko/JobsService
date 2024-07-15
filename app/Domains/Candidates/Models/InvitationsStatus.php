<?php

namespace App\Domains\Candidates\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationsStatus extends Model
{

    protected $fillable = ['code'];

    protected $table = 'invitation_statuses';
    const TABLE_NAME = 'invitation_statuses';
}
