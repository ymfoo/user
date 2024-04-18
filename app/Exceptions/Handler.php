<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param  Exception  $exception
     * @return Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson()) {
            return $this->handleApiException($exception);
        }

        return parent::render($request, $exception);
    }

    /**
     * Handle an API exception.
     *
     * @param  Exception  $exception
     * @return JsonResponse
     */
    private function handleApiException(Exception $exception): JsonResponse
    {
        $statusCode = $this->getStatusCode($exception);
        $response = [
            'message' => $this->getMessage($statusCode, $exception),
            'status' => $statusCode,
        ];

        if (config('app.debug')) {
            $response['trace'] = $exception->getTrace();
            $response['code'] = $exception->getCode();
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Get the status code of the exception.
     *
     * @param  Exception  $exception
     * @return int
     */
    private function getStatusCode(Exception $exception): int
    {
        if ($exception instanceof AuthenticationException) {
            return 401;
        }

        if ($exception instanceof ValidationException) {
            return 400;
        }

        return $exception->getStatusCode() ?: 500;
    }

    /**
     * Get the message for the given status code and exception.
     *
     * @param  int  $statusCode
     * @param  Exception  $exception
     * @return string
     */
    private function getMessage(int $statusCode, Exception $exception): string
    {
        switch ($statusCode) {
            case 401:
                return 'Unauthorized';
            case 403:
                return 'Forbidden';
            case 404:
                return 'Not Found';
            case 405:
                return 'Method Not Allowed';
            case 422:
                return $exception->getMessage() ?: 'Unprocessable Entity';
            default:
                return ($statusCode == 500) ? 'Whoops, looks like something went wrong' : $exception->getMessage();
        }
    }
}
