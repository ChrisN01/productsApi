<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;

trait ExceptionTrait
{
    public function apiException($request,$e)
    {

        if ($this->isModel($e)) {
          return $this->modelResponse($e);
        }


        if ($this->isValidation($e)) {
            return $this->validationResponse($e);
        }

        if ($this->isHttp($e)) {
            return $this->httpResponse($e);
        }

        if ($this->isAuthentication($e)) {
            return $this->authenticationResponse($e);
        }

        // Generic response for unhandled exceptions.
        return response()->json([
            'error' => 'Server error',
            'message' => $e->getMessage()
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }


    protected function isModel($e)
    {
        return $e instanceof ModelNotFoundException;

    }

    protected function isValidation($e)
    {
        return $e instanceof ValidationException;

    }

    protected function isHttp($e)
    {
        return $e instanceof NotFoundHttpException;

    }

    protected function isAuthentication($e)
    {
        return $e instanceof AuthenticationException;

    }


    protected function modelResponse($e)
    {
        return response()->json([
            'error' => 'Model not found'
        ], JsonResponse::HTTP_NOT_FOUND);
    }

    protected function validationResponse($e)
    {
        return response()->json([
            'error' => 'Validation failed',
            'messages' => $e->errors()
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    protected function httpResponse($e)
    {
        return response()->json([
            'error' => 'Route not found'
        ], JsonResponse::HTTP_NOT_FOUND);
    }

    protected function authenticationResponse($e)
    {
        return response()->json([
            'error' => 'Unauthenticated'
        ], JsonResponse::HTTP_UNAUTHORIZED);
    }
}