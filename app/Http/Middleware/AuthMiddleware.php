<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $accessToken = $request->header('Authorization');
        $user= Auth::user();
       /*  compare the accestoken of user connected with accestoken in request */
        if($user && $accessToken == $user->tokens->first()){
            return $next($request);
        }else{
            return response()->json(['message' => 'Unauthorized user'], 401);
        }

    }
}
