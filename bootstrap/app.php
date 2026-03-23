<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\QueryException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['admin' => AdminMiddleware::class, 'user' => UserMiddleware::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (QueryException $e, $request) {
            if (str_contains($e->getMessage(), '1040') || str_contains($e->getMessage(), 'Too many connections')) {
                if ($request->expectsJson()) {
                    return response()->json(['message' => 'The server is temporarily busy. Please try again in a moment.'], 503);
                }
                return redirect()->back()->withErrors(['error' => 'The server is temporarily busy. Please try again in a moment.']);
            }
        });
    })->create();
