<?php
namespace App\Domains\Vacancies\Models;

use Illuminate\Database\Eloquent\Model;


class Vacancies extends Model
{
    protected $guarded = [];
    protected $table = 'vacancies';
    protected $primaryKey = 'ID';

    public static $arrJsonFields = ['RESPONSIBILITY', 'QUALIFICATIONS'];

    public static function getVacancyFields() {
        return [
            'NAME', 'COUNTRY' , 'CITY', 'ACTIVE',
            'CATEGORY_ID', 'SALARY_FROM', 'DESCRIPTION',
            'RESPONSIBILITY', 'QUALIFICATIONS', 'BENEFITS'
        ];
    }

}
