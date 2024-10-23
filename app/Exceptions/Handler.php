<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (ModelNotFoundException $e, $request) {
            return response()->json([
                'error' => 'Model not found'
            ], JsonResponse::HTTP_NOT_FOUND);
        });
    }

    /**
     * Customize the response for generic exceptions in JSON format.
     */
    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson()) { //Check if the request expects JSON
            if ($exception instanceof ValidationException) {
                return response()->json([
                    'error' => 'Validation failed',
                    'messages' => $exception->errors()
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }

            if ($exception instanceof NotFoundHttpException) {
                return response()->json([
                    'error' => 'Route not found'
                ], JsonResponse::HTTP_NOT_FOUND);
            }

            if ($exception instanceof AuthenticationException) {
                return response()->json([
                    'error' => 'Unauthenticated'
                ], JsonResponse::HTTP_UNAUTHORIZED);
            }

            // Generic response for unhandled exceptions.
            return response()->json([
                'error' => 'Server error',
                'message' => $exception->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        // If JSON is not expected, use the default logic.
        return parent::render($request, $exception);
    }
}
