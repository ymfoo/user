<?php

namespace App\Http\Middleware;

use Closure;

class ApiResponseFormatter
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Check if the response is JSON
        if ($response->headers->get('Content-Type') === 'application/json') {
            // Get the response data
            $responseData = $response->original;

            // Define the standard response format
            $standardResponse = [
                'data' => $responseData['data'] ?? null,
                'code' => $responseData['code'] ?? 200,
                'message' => $responseData['message'] ?? 'Success',
                'success' => isset($responseData['success']) ? (bool) $responseData['success'] : true,
            ];

            // Replace the response data with the standard format
            $response->setContent(json_encode($standardResponse));
        }

        return $response;
    }
}
