<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{

    protected $supportedLocales = ['en', 'id'];
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Cookie::has('locale')) {
            $locale = Cookie::get('locale');
        } elseif (session()->has('locale')) {
            $locale = session('locale');
        } else {
            $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            $locale = in_array($locale, ['en', 'id'])
                ? $locale
                : config('app.fallback_locale');
        }

        App::setlocale($locale);
        session(['locale' => $locale]);
        
        return $next($request);
    }
}
