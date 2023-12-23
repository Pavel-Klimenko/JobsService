<?php

use Illuminate\Http\Request;

use App\Domains\Vacancies\Http\Controllers\VacancyController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/vacancies-list', [VacancyController::class, 'getVacancies']);
Route::post('/vacancy', [VacancyController::class, 'getVacancy']);