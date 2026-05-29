<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(
            fn ($request) => $request->is('admin/*') ? route('admin.login') : route('login')
        );

        $middleware->redirectUsersTo(
            fn ($request) => $request->is('admin/*') ? route('admin.dashboard') : route('welcome')
        );

        $middleware->alias([
            'superadmin' => \App\Http\Middleware\CheckSuperAdmin::class,
        ]);

    })

    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->respond(function ($response) {
            if ($response->getStatusCode() === 419) {
                return redirect()->route(
                    request()->is('admin/*') ? 'admin.login' : 'login'
                );
            }

            return $response;
        });
    })
    ->create();
