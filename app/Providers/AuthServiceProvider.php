<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Registration of all authentication/authorization services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->registerPolicies();
//        Passport::routes();

//        Passport::tokensExpireIn(Carbon::now()->addDays(15));
//        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));

//        Passport::tokensCan([
//            'candidate' => 'Using JobBoard like a job applicant',
//            'company' => 'Using Job Board like company which hiring people',
//        ]);

    }
}
