<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Constants;
//use App\Ship\Helpers\Helper;
//use App\Containers\Vacancies\Models\InterviewInvitations;

class User
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


/*    //only companies
    public function vacancies()
    {
        return $this->hasMany(Vacancies::class, 'COMPANY_ID');
    }

    //INTERVIEW REQUESTS
    public function allAdvices()
    {
        $foreingKey = $this->foreignKey();
        return $this->hasMany(InterviewInvitations::class, $foreingKey);
    }

    //подтвержденные
    public function acceptedAdvices()
    {
        $foreingKey = $this->foreignKey();
        return $this->hasMany(InterviewInvitations::class, $foreingKey)
            ->where('invitations_to_interview.STATUS', Constants::INTERVIEW_ADVICES_STATUSES['ACCEPTED']);
    }

    public function rejectedAdvices()
    {
        $foreingKey = $this->foreignKey();
        return $this->hasMany(InterviewInvitations::class, $foreingKey)
            ->where('invitations_to_interview.STATUS', Constants::INTERVIEW_ADVICES_STATUSES['REJECTED']);
    }


    protected function foreignKey()
    {
        if (Helper::isCompany()) {
            return 'COMPANY_ID';
        } elseif (Helper::isCandidate()) {
            return 'CANDIDATE_ID';
        }
    }

    public function scopeCandidates($query)
    {
        $roleName = Constants::USER_ROLE_NAMES['candidate'];
        $roleId = Helper::getRoleIdByName($roleName);
        return $query->where('role_id', $roleId);
    }

    public function scopeCompanies($query)
    {
        $roleName = Constants::USER_ROLE_NAMES['company'];
        $roleId = Helper::getRoleIdByName($roleName);
        return $query->where('role_id', $roleId);
    }

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
    }*/



}
