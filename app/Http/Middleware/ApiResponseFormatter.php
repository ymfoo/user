<?php

namespace App\Http\Middleware;

use Closure;

class ApiResponseFormatter
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->headers->get('Content-Type') === 'application/json') {
            $originalData = $response->original;

            $standardResponse = [
                'data' => $originalData['data'] ?? null,
                'code' => $originalData['code'] ?? $response->getStatusCode(),
                'message' => $originalData['message'] ?? $this->getDefaultMessage($response),
                'success' => isset($originalData['success']) ? (bool) $originalData['success'] : $this->isSuccessResponse($response),
            ];

            $response->setContent(json_encode($standardResponse));
        }
        return $response;
    }

    private function getDefaultMessage($response)
    {
        $statusCode = $response->getStatusCode();

        // Define default messages for common status codes
        $defaultMessages = [
            200 => 'Success',
            201 => 'Resource created',
            204 => 'No content',
            400 => 'Bad request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not found',
            500 => 'Internal server error',
        ];

        // Get the original response content as an array
        $originalData = $response->original;

        // Check if the response is JSON and contains a 'message' or 'error' key
        if ($response->headers->get('Content-Type') === 'application/json' && (isset($originalData['message']) || isset($originalData['error']))) {
            return $originalData['message'] ?? $originalData['error']; // Return the custom message from the response
        }


        return $defaultMessages[$statusCode] ?? 'Unknown error';
    }

    private function isSuccessResponse($response)
    {
        $statusCode = $response->getStatusCode();

        $successStatusCodes = [200, 201, 204];

        return in_array($statusCode, $successStatusCodes);
    }
}
