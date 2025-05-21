<?php

use App\Http\Middleware\EncryptCookies;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;



$application = Application::configure()
    ->withProviders()
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [], replace: [
            \Illuminate\Cookie\Middleware\EncryptCookies::class => EncryptCookies::class, // тут нужно заменить мидлвейр EncryptCookies если у вас какие-то cookies помечены как $except, или какие-то другие манипуляции с cookies
            // Вообще, этот механизм используется для подмены стандартных миддлвейров - они теперь лоадятся внутри ядра фреймворка, минуя Kernel.php
            // Прочитать можно тут https://laravel.com/docs/11.x/middleware#laravels-default-middleware-groups
            // И тут https://laravel.com/docs/11.x/middleware#laravels-default-middleware-groups
        ]);

        /*
        А вот так добавлять новые алиасы миддлвейров
        $middleware->alias([
            'check' => CheckMiddleware::class,
        ]);*/
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // тут же регистрируем свои Exceptions, которые описаны в app/Exceptions/Handler.php
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'abilities' => CheckAbilities::class,
            'ability' => CheckForAnyAbility::class,
        ]);
    })
    /*
    А вот так регистрируются кастомные команды
    ->withCommands([
        __DIR__.'/../app/Console/Commands/CreateAdminCommand.php',
    ])*/
    ->create();

return $application;
