<?php

use Illuminate\Support\Facades\DB;

use App\Http\Controllers;

//Route::get('/', function() {
//    return view('welcome');
//});


Route::get('/', [Controllers\TestController::class, 'test']);


//Route::get('/', function () {
/*  $visited = DB::select('select * from places where visited = ?', [1]);
  $togo = DB::select('select * from places where visited = ?', [0]);

  return view('travel_list', ['visited' => $visited, 'togo' => $togo ] );*/
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
