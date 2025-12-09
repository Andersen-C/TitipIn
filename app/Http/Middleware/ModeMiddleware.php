<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ModeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $modes): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'user') {
            return abort(403, 'Unauthorized Role Access');
        }

        if (is_string($modes)) {
            $modes = explode(',', $modes);
        }

        if(!in_array(Auth::user()->mode, $modes)) {
            return abort(403, 'Unauthorized Mode Access');
        }

        return $next($request);
    }
}
