<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


//TODO перенести общий функционал в Ships

//use App\Models\Roles;

use App\Constants;

class Helper
{
    /**Удобный var_dump
     *
     * @param $data
     */
    public function vardump($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }

    public static function getTableRow($modelObject, $column, $value)
    {
        return $modelObject::where($column, $value)->firstOrFail();
    }


    public static function countTableRow($modelObject, $column, $value)
    {
        return $modelObject::where($column, $value)->count();
    }


    /**Check is current user is a company
     *
     * @return bool
     *
     */


    //TODO объединить эти функции в одну или использовать массив ROLERS_IDS
    public static function isCompany()
    {
        if (Auth::check()) {
            $currentRole = Auth::user()->role_id;
            $roleName = Constants::USER_ROLE_NAMES['company'];
            $companyRole = self::getRoleIdByName($roleName);
            return ($currentRole == $companyRole) ? true : false;
        } else {
            return false;
        }
    }

    /**Check is current user is a candidate
     *
     * @return bool
     *
     */
    public static function isCandidate()
    {
        if (Auth::check()) {
            $currentRole = Auth::user()->role_id;
            $roleName = Constants::USER_ROLE_NAMES['candidate'];
            $candidateRole = self::getRoleIdByName($roleName);
            return ($currentRole == $candidateRole) ? true : false;
        } else {
            return false;
        }
    }

    public static function isAdmin()
    {
        if (Auth::check()) {
            $currentRole = Auth::user()->role_id;
            $roleName = Constants::USER_ROLE_NAMES['admin'];
            $companyRole = self::getRoleIdByName($roleName);
            return ($currentRole == $companyRole) ? true : false;
        } else {
            return false;
        }
    }

    /**Convert text point (each on a new line) to json list
     *
     * @param $TEXT_POINTS
     * @return false|string
     */
    public static function convertTextPointsToJson($TEXT_POINTS)
    {
        //TODO need fixing
        $listOfPoints = preg_replace('/\s{3,}/', '', $TEXT_POINTS);
        $arrListOfPoints = explode(PHP_EOL, $listOfPoints);
        return json_encode($arrListOfPoints);
    }


    public static function isFilterSet() {
        $arrFilter = $_GET;
        $arrNotFilterParams = ['page'];

        foreach ($arrNotFilterParams as $param) {
            if (array_key_exists($param, $arrFilter)) unset($arrFilter[$param]);
        }

        return (!empty($arrFilter)) ? true : false;
    }


    public static function delEmptyArrKeys($oldArray) {
        $newArray = array_filter($oldArray, function($element) {
            return !empty($element);
        });

        return $newArray;
    }

    public static function getExtension($filename) {
        $fileExtension =  explode( '.', $filename);
        return array_pop($fileExtension);
    }


    /**Get data of selected year and month
     *
     * @param int $year
     * @param int $month
     * @return mixed
     */
    public static function getMonthlyData($model, int $year, int $month) {
        $data = $model::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();
        return $data;
    }

    public static function getQuantityMonthlyRows($model, int $month) {
        $countOfRows = $model::whereYear('created_at', self::getCurrentYear())
            ->whereMonth('created_at', $month)
            ->count();
        return ['MONTHS' => Constants::MONTHS[$month], 'CNT_ROWS' => $countOfRows];
    }



    public static function getCurrentYear() {
        return Carbon::now()->year;
    }

    public static function getCurrentMonth() {
        return Carbon::now()->month;
    }

}
