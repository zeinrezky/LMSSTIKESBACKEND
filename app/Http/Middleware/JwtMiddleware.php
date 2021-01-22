<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JwtMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->header('token');
        
        if(!$token) {
            // Unauthorized response if token not there
            return response()->json([
                'status' => false,
                'msg' => 'Token not provided.',
                'code' => 501
            ], 200);
        }

        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch(ExpiredException $e) {
            return response()->json([
                'status' => false,
                'msg' => 'Provided token is expired.',
                'code' => 501
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'An error while decoding token.',
                'code' => 501
            ], 200);
        }

        // $user = User::find($credentials->sub);

        // Now let's put the user in the request class so that you can grab it from there
        $request->auth = $credentials->sub;

        return $next($request);
    }
}