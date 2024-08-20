<?php

namespace App\Http\Middleware;

use App\Exceptions\AccessDeniedException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws AccessDeniedException
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated using Sanctum
        if (!Auth::guard('sanctum')->check()) {
            return throw new AccessDeniedException();
        }

        // Proceed to the next middleware or controller
        return $next($request);
    }
}
