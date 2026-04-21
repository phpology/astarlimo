<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use App\Console\Kernel;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(
            except: ['allocate/webhook']
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withBindings([
        ConsoleKernelContract::class => Kernel::class,
    ])->create();
