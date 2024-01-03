<?php

use Illuminate\Http\Request;

use App\Domains\Vacancies\Http\Controllers\VacancyController;
use App\Domains\Candidates\Http\Controllers\CandidateController;
use App\Domains\Home\Http\Controllers\HomeController;
use App\Domains\Personal\Http\Controllers\PersonalController;

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

Route::group(['prefix' => 'vacancies'], function () {
    Route::post('/list', [VacancyController::class, 'getVacancies']);
    Route::post('/read', [VacancyController::class, 'getVacancy']);
    Route::post('/create', [VacancyController::class, 'createVacancy']);
    Route::post('/delete', [VacancyController::class, 'deleteVacancy']);
    Route::post('/update', [VacancyController::class, 'updateVacancy']);
});

Route::group(['prefix' => 'candidates'], function () {
    Route::post('/list', [CandidateController::class, 'getCandidates']);
    Route::post('/read', [CandidateController::class, 'getCandidate']);
    Route::post('/create-interview-invitation',
        [CandidateController::class, 'createInterviewInvitation']);
});

Route::group(['prefix' => 'homepage'], function () {
    Route::post('/', [HomeController::class, 'getHomePageData']);
});

Route::group(['prefix' => 'personal'], function () {
    Route::post('/get-personal-info', [PersonalController::class, 'getPersonalInfo']);
    Route::post('/get-company-vacancies', [PersonalController::class, 'getCompanyVacancies']);
    Route::post('/create-interview-invitation', [PersonalController::class, 'createInterviewInvitation']);
});


//Route::post('/tokens/create', function (Request $request) {
//    $token = $request->user()->createToken($request->token_name);
//    return ['token' => $token->plainTextToken];
//});
