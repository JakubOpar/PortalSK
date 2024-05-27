<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withExceptions(function (Exceptions $exceptions) {
        $renderException = function ($e, Request $request, $view, $message, $statusCode) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $message,
                    'details' => $e->getMessage()
                ], $statusCode);
            }
            return response()->view($view, ['exception' => $e], $statusCode);
        };

        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) use ($renderException) {
            return $renderException($e, $request, 'errors.405', 'Method Not Allowed', 405);
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) use ($renderException) {
            return $renderException($e, $request, 'errors.404', 'Not Found', 404);
        });

        $exceptions->render(function (AuthorizationException $e, Request $request) use ($renderException) {
            return $renderException($e, $request, 'errors.403', 'Forbidden', 403);
        });

        $exceptions->render(function (UnauthorizedHttpException $e, Request $request) use ($renderException) {
            return $renderException($e, $request, 'errors.401', 'Unauthorized', 401);
        });

        $exceptions->render(function (QueryException $e, Request $request) use ($renderException) {
            return $renderException($e, $request, 'errors.500', 'Internal Server Error', 500);
        });

        $exceptions->render(function (BadRequestHttpException $e, Request $request) use ($renderException) {
            return $renderException($e, $request, 'errors.400', 'Bad request', 400);
        });

    })
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->create();
