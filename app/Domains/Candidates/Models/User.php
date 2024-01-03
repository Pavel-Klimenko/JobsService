<?php
namespace App\Domains\Candidates\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Constants;
use App\Helper;
//use App\Ship\Helpers\Helper;
//use App\Containers\Vacancies\Models\InterviewInvitations;

use App\Domains\Vacancies\Models\Vacancies;

class User extends Model
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';



    protected $fillable = [
        'NAME',
        'EMAIL',
        'PHONE',
        'COUNTRY',
        'CITY',
        'ICON',

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

/*    public function scopeCandidates($query)
    {
        $roleName = Constants::USER_ROLE_NAMES['candidate'];
        $roleId = Helper::getRoleIdByName($roleName);
        return $query->where('role_id', $roleId);
    }*/


    //only companies
    public function vacancies()
    {
        return $this->hasMany(Vacancies::class, 'COMPANY_ID');
    }


    public function allInvitations($userId)
    {
        return $this->hasMany(InterviewInvitations::class, $this->foreignKey($userId));
    }


    public function acceptedInvitations($userId)
    {
        return $this->hasMany(InterviewInvitations::class, $this->foreignKey($userId))
            ->where('invitations_to_interview.STATUS', 'accepted');
    }

    public function rejectedInvitations($userId)
    {
        return $this->hasMany(InterviewInvitations::class, $this->foreignKey($userId))
            ->where('invitations_to_interview.STATUS', 'rejected');
    }


    protected function foreignKey($userId)
    {
        $user = User::find($userId);
        if ($user->role_id == Constants::USER_ROLES_IDS['company']) {
            return 'COMPANY_ID';
        } elseif ($user->role_id == Constants::USER_ROLES_IDS['candidate']) {
            return 'CANDIDATE_ID';
        }
    }



//
//    public function scopeCandidates($query)
//    {
//        $roleName = Constants::USER_ROLE_NAMES['candidate'];
//        $roleId = Helper::getRoleIdByName($roleName);
//        return $query->where('role_id', $roleId);
//    }
//
//    public function scopeCompanies($query)
//    {
//        $roleName = Constants::USER_ROLE_NAMES['company'];
//        $roleId = Helper::getRoleIdByName($roleName);
//        return $query->where('role_id', $roleId);
//    }
//

    public static function getCandidateFields() {
        return [
            'NAME', 'IMAGE' , 'COUNTRY',
            'CITY', 'PHONE', 'CATEGORY_ID',
            'LEVEL', 'YEARS_EXPERIENCE',
            'SALARY', 'EXPERIENCE',
            'EDUCATION', 'SKILLS',
            'LANGUAGES', 'ABOUT_ME', 'ACTIVE'
        ];
    }

    public static function getCompanyFields() {
        return [
            'NAME', 'IMAGE' , 'COUNTRY',
            'CITY', 'PHONE', 'EMPLOYEE_CNT',
            'WEB_SITE', 'DESCRIPTION', 'ACTIVE'
       ];
    }



}
