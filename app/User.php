<?php
namespace App;

use App\Domains\Candidates\Models\Candidate;
use App\Domains\Personal\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Domains\Personal\Models\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';
    protected $fillable = ['name','email','phone','image','country','city','role_id','password'];

    const TABLE_NAME = 'users';


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

    public function role(): belongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function candidate(): HasOne
    {
        return $this->hasOne(Candidate::class);
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class)
            ->with('user');
    }
}
