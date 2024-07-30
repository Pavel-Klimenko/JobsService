<?php
namespace App\Domains\Candidates\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Candidates\Models\CandidateLevels;
use App\User;
use App\Constants;

use App\Domains\Vacancies\Models\Vacancies;

//TODO переименовать в Candidate

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

    protected $fillable = [
        'NAME',
        'EMAIL',
        'PHONE',
        'password',
        'role_id'
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
}
