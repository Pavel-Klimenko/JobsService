<?php

use Illuminate\Http\Request;

use App\Domains\Vacancies\Http\Controllers\VacancyController;
use App\Domains\Candidates\Http\Controllers\CandidateController;
use App\Domains\Companies\Http\Controllers\CompanyController;

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
    Route::get('/', [VacancyController::class, 'getVacancies']);
    Route::get('/{id}', [VacancyController::class, 'getVacancy']);


//    Route::delete('/delete/{id}', [VacancyController::class, 'deleteVacancy']);

});


Route::group(['prefix' => 'company', /*'middleware' => ['auth:sanctum','ability:company_rules']*/], function () {
    Route::get('/my-personal-info', [CompanyController::class, 'getPersonalData']);
    Route::post('/update-personal-info', [CompanyController::class, 'updatePersonalInfo']);

    Route::post('/answer-to-vacancy-request', [CompanyController::class, 'answerToVacancyRequest']);

    Route::get('/my/vacancy/{id}', [CompanyController::class, 'getMyVacancy']);
    Route::get('/my/vacancies', [CompanyController::class, 'getMyVacancies']);
    Route::post('/my/vacancies/create', [CompanyController::class, 'createVacancy']);
    Route::post('/my/vacancies/update', [CompanyController::class, 'updateVacancy']);
});



Route::group(['prefix' => 'candidates', /*'middleware' => ['auth:sanctum','ability:candidate_rules']*/], function () {
    Route::get('/', [CandidateController::class, 'getCandidates']);
    Route::get('/{id}', [CandidateController::class, 'getCandidate']);
    Route::get('/my/vacancy-requests', [CandidateController::class, 'getMyVacancyRequests']);

    Route::post('/vacancy-request', [CandidateController::class, 'createVacancyRequest']);
});


Route::group(['prefix' => 'personal'], function () {
    //TODO разобраться с нерабочими запросами sanctum

    Route::group(['prefix' => 'candidate',  /*'middleware' => ['auth:sanctum','ability:candidate_rules']*/], function () {
        Route::get('/{id}', [CandidateController::class, 'getCandidate']);
        Route::post('/update', [CandidateController::class, 'updatePersonalInfo']);
    });
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
