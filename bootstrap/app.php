<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
use App\Http\Middleware\AuthenticateAdmin;
use App\Http\Middleware\AuthenticateStudentApi;
use App\Http\Middleware\RoleSecretary;
use Illuminate\Support\Facades\Schedule;
use App\Console\Kernel;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
            'auth.admin' => AuthenticateAdmin::class,
            'auth.student' => AuthenticateStudentApi::class,
            'auth.scretary' => RoleSecretary::class
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create(Kernel::class);
