<?php
namespace App\Domains\Candidates\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use App\User;


class Candidate extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'candidates';
    const TABLE_NAME = 'candidates';

    protected $guarded = [];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function job_category(): belongsTo
    {
        return $this->belongsTo(JobCategories::class);
    }

    public function level(): belongsTo
    {
        return $this->belongsTo(CandidateLevels::class);
    }

    public function vacancyRequests(): HasMany
    {
        return $this->hasMany(InterviewInvitations::class)
            ->with('vacancy', 'status');
    }
}
