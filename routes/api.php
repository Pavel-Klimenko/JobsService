<?php

use Illuminate\Http\Request;

use App\Domains\Vacancies\Http\Controllers\VacancyController;
use App\Domains\Candidates\Http\Controllers\CandidateController;

use App\Domains\Home\Http\Controllers\HomeController;
use App\Domains\Personal\Http\Controllers\PersonalController;
use App\Http\Controllers\Auth\AuthAPIController;

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


Route::group(['prefix' => 'homepage'], function () {
    Route::get('/', [HomeController::class, 'getHomePageData']);
    //Route::get('/reviews', [HomeController::class, 'getReviews']);
    //Route::post('/add-review', [HomeController::class, 'addReview']);
});

Route::group(['prefix' => 'vacancies'], function () {
    Route::post('/', [VacancyController::class, 'getVacancies']);
    Route::get('/{id}', [VacancyController::class, 'getVacancy']);

    Route::post('/create', [VacancyController::class, 'createVacancy']);
    Route::delete('/delete/{id}', [VacancyController::class, 'deleteVacancy']);
    Route::post('/update/{id}', [VacancyController::class, 'updateVacancy']);
});


Route::group(['prefix' => 'candidates'], function () {
    Route::post('/', [CandidateController::class, 'getCandidates']);
    Route::get('/{id}', [CandidateController::class, 'getCandidate']);

    //Route::post('/create-invitation', [CandidateController::class, 'createInterviewInvitation']);
});


//
////TODO этот раздел после очередей и авторизации и фронта!
//Route::group(['prefix' => 'personal'], function () {
//    Route::get('/{id}', [PersonalController::class, 'getPersonalInfo']);
//    Route::get('/company-vacancies/{id}', [PersonalController::class, 'getCompanyVacancies']);
//    Route::post('/create-interview-invitation', [PersonalController::class, 'createInterviewInvitation']);
//    Route::put('/change-invitation-status/{id}/{status}', [PersonalController::class, 'changeInvitationStatus']);
////    Route::get('/get-interview-invitations/{id}/{status}', [PersonalController::class, 'getInterviewInvitations']);
////    Route::post('/update-user-info', [PersonalController::class, 'updateUserInfo']);
//});


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthAPIController::class, 'login']);
    Route::post('/logout', [AuthAPIController::class, 'logout']);
    Route::post('/register', [AuthAPIController::class, 'register']);
    //Route::post('/is_authorised', [AuthAPIController::class, 'isAuthorised']);
});
