<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 02/12/23
 * Time: 22:40
 */

namespace App\Http\Controllers;


use App\Models\JobCategories;

use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test()
    {
       echo 'приложение работает1111111111113333';


/*        $category = JobCategories::where('NAME', 'PHP')->firstOrFail();

        dump($category);*/



        $category = DB::table('job_categories')->where('NAME', 'PHP')->first();

        dump($category->ID);



    }
}