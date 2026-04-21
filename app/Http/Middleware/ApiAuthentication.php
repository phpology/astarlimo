<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\APIKey;

class ApiAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        $authorizationHeader = $request->header('Authorization');
        if (!$authorizationHeader || !str_starts_with($authorizationHeader, 'Bearer ')) {
            return sendError('Unauthorized');
        }

        // Extract the token from the Authorization header
        $token = substr($authorizationHeader, 7);

        // Retrieve the apiKey by token
        $apiKey = ApiKey::where('token', $token)->first();

        if (!$apiKey) {
            return sendError('Unauthorized');
        }

        // Log the client IP address for debugging
        \Illuminate\Support\Facades\Log::info('Client IP: ' . $request->getClientIp());

        // Log the client IP address using the custom log channel 'api_access_ip_log'
        //logger()->channel('api_access_ip_log')->info('Client IP: ' . $request->getClientIp());
        //logger()->channel('api_access_ip_log')->info('Client IP: ' . $request->getClientIp() . ', Token Name: ' . $apiKey->name);
        // Check if the IP matches any of the IPs in the database
        $requestIp = $request->ip();
        $allowedIps = explode(',',$apiKey->ip);
        $allowedIps[] = '::1';
        $allowedIps[] = '0.0.0.0';
        // If the allowed IPs array contains '0.0.0.0', allow all IPs
        if (in_array('0.0.0.0', $allowedIps)) {
            return $next($request);
        }
        // Check if the request IP is in the allowed IPs array
        $matchingIps = array_intersect([$requestIp], $allowedIps);

        if (empty($matchingIps)) {
            return sendError('Unauthorized');
        }
        return $next($request);
    }
}
