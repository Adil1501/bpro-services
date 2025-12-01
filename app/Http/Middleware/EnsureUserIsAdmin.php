<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Je moet ingelogd zijn.');
        }

        if (!auth()->user()->isAdmin()) {
            abort(403, 'Geen toegang. Alleen admins mogen deze pagina zien.');
        }

        return $next($request);
    }
}
