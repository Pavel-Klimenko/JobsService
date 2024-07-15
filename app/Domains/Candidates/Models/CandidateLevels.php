<?php

namespace App\Domains\Candidates\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateLevels extends Model
{

    protected $fillable = ['code'];

    protected $table = 'candidate_levels';
    const TABLE_NAME = 'candidate_levels';
}
