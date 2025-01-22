<?php

use Illuminate\Http\Request;

use App\Domains\Vacancies\Http\Controllers\VacancyController;
use App\Domains\Candidates\Http\Controllers\CandidateController;
use App\Domains\Companies\Http\Controllers\CompanyController;

use App\Domains\Home\Http\Controllers\HomeController;
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
    Route::get('/', [HomeController::class, 'getHomePageData'])->name('home');
});


Route::group(['prefix' => 'entity-directories'], function () {
    Route::get('/user-roles', [\App\Domains\EntityDirectories\Http\Controllers\EntityDirectoriesController::class, 'getUserRoles']);
    Route::get('/job-categories', [\App\Domains\EntityDirectories\Http\Controllers\EntityDirectoriesController::class, 'getJobCategories']);
    Route::get('/candidate-levels', [\App\Domains\EntityDirectories\Http\Controllers\EntityDirectoriesController::class, 'getCandidateLevels']);
    Route::get('/candidate-response-statuses', [\App\Domains\EntityDirectories\Http\Controllers\EntityDirectoriesController::class, 'getCandidateResponseStatuses']);
});

Route::group(['prefix' => 'vacancies'], function () {
    Route::get('/', [VacancyController::class, 'getVacancies']);
    Route::get('/{id}', [VacancyController::class, 'getVacancy']);
});

Route::group(['prefix' => 'candidates'], function () {
    Route::get('/', [CandidateController::class, 'getCandidates']);
    Route::get('/{id}', [CandidateController::class, 'getCandidate']);
});

Route::group(['prefix' => 'personal'], function () {
    Route::group(['prefix' => 'candidate',  'middleware' => ['auth:sanctum','ability:candidate_rules']], function () {
        Route::get('/is-there-vacancy-request', [CandidateController::class, 'isThereVacancyRequest']);
        Route::post('/create-vacancy-request', [CandidateController::class, 'createVacancyRequest']);

        Route::get('/vacancy-requests', [CandidateController::class, 'getMyVacancyRequests']);
        Route::get('/get-personal-data', [CandidateController::class, 'getCandidateData']);
        Route::post('/update', [CandidateController::class, 'updatePersonalInfo']);
    });


    Route::group(['prefix' => 'company',  'middleware' => ['auth:sanctum','ability:company_rules']], function () {
        Route::get('/my-personal-info', [CompanyController::class, 'getPersonalData']);
        Route::post('/update-personal-info', [CompanyController::class, 'updatePersonalInfo']);
        Route::post('/answer-to-vacancy-request', [CompanyController::class, 'answerToVacancyRequest']);
        Route::get('/my/vacancies', [CompanyController::class, 'getMyVacancies']);
        Route::get('/my/vacancies/{id}', [CompanyController::class, 'getMyVacancy']);
        Route::post('/create-vacancy', [CompanyController::class, 'createVacancy']);
        Route::post('/update-vacancy', [CompanyController::class, 'updateVacancy']);
        Route::delete('/delete-vacancy/{id}', [CompanyController::class, 'deleteVacancy']);
    });
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthAPIController::class, 'login']);
    Route::post('/logout', [AuthAPIController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/register', [AuthAPIController::class, 'register']);
});
