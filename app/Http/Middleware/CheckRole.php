<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // If they aren't logged in, OR their role isn't in the allowed list...
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            // Kick them out with a 403 Forbidden error!
            abort(403, 'Unauthorized access. Staff only.');
        }

        return $next($request);
    }
}
