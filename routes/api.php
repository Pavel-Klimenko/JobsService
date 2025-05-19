<?php

use Illuminate\Http\Request;

use App\Domains\Vacancies\Http\Controllers\VacancyController;
use App\Domains\Candidates\Http\Controllers\CandidateController;
use App\Domains\Companies\Http\Controllers\CompanyController;

use App\Domains\Home\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'chat',
    'controller' => \App\Domains\Chat\Http\Controllers\ChatController::class,
    'middleware' => ['auth:sanctum']], function () {
        Route::get('/', 'index');
        Route::get('/messages', 'messages');
        Route::post('/send', 'send');
});

Route::group(['prefix' => 'entity-directories', 'controller' => \App\Domains\EntityDirectories\Http\Controllers\EntityDirectoriesController::class], function () {
    Route::get('/user-roles', 'getUserRoles');
    Route::get('/job-categories', 'getJobCategories');
    Route::get('/candidate-levels', 'getCandidateLevels');
    Route::get('/candidate-response-statuses', 'getCandidateResponseStatuses');
});

Route::group(['prefix' => 'vacancies', 'controller' => VacancyController::class], function () {
    Route::get('/', 'getVacancies');
    Route::get('/{id}', 'getVacancy');
});

Route::group(['prefix' => 'candidates', 'controller' => CandidateController::class], function () {
    Route::get('/', 'getCandidates');
    Route::get('/{id}', 'getCandidate');
});

Route::group(['prefix' => 'personal'], function () {
    Route::group(['prefix' => 'candidate',  'middleware' => ['auth:sanctum','ability:candidate_rules']], function () {
        Route::get('/is-there-vacancy-request', [CandidateController::class, 'isThereVacancyRequest']);
        Route::post('/create-vacancy-request',
            [\App\Domains\VacancyInvitations\Http\Controllers\VacancyInvitationController::class, 'createVacancyRequest']);

        Route::get('/vacancy-requests',
            [\App\Domains\VacancyInvitations\Http\Controllers\VacancyInvitationController::class, 'getMyVacancyRequests']);
        Route::get('/get-personal-data', [CandidateController::class, 'getCandidateData']);
        Route::post('/update', [CandidateController::class, 'updatePersonalInfo']);
    });
    Route::group(['prefix' => 'company', 'controller' => CompanyController::class,  'middleware' => ['auth:sanctum','ability:company_rules']], function () {
        Route::get('/my-personal-info', 'getPersonalData');
        Route::post('/update-personal-info', 'updatePersonalInfo');
        Route::post('/answer-to-vacancy-request', 'answerToVacancyRequest');
        Route::get('/my/vacancies', 'getMyVacancies');
        Route::get('/my/vacancies/{id}', 'getMyVacancy');
        Route::post('/create-vacancy', 'createVacancy');
        Route::post('/update-vacancy', 'updateVacancy');
        Route::delete('/delete-vacancy/{id}', 'deleteVacancy');
    });
});

Route::group(['prefix' => 'auth', 'controller' => \App\Http\Controllers\Auth\AuthAPIController::class], function () {
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
    Route::post('/register', 'register');
});
