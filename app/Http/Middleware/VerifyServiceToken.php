<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class VerifyServiceToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        try {
            $key = env('API_SERVICE_SECRET');
            
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            
            // Opcional: Validar que sea el rol admin
            if ($decoded->role !== 'admin') {
                throw new Exception('Invalid role');
            }

        } catch (Exception $e) {
            return response()->json(['error' => 'Unauthorized Access'], 401);
        }

        return $next($request);
    }
}