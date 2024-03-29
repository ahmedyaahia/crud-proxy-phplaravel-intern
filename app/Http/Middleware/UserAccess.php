<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $userType
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $userType)
    {
        Log::info('Requested User Type: ' . $userType);
        Log::info('Authenticated User Type: ' . auth()->user()->type);
    
        
        
        if (auth()->check()) {
            if (auth()->user()->type === $userType) {
                return $next($request);
            } else {
                return response()->json(['error' => 'You do not have permission to access this page.'], 403);
            }
        } else {
            return response()->json(['error' => 'You are not logged in. Please log in to access this page.'], 401);
        }

    }
}
