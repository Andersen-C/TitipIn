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
        if (session()->has('locale') && in_array(session('locale'), $this->supportedLocales)) {
            App::setLocale(session('locale'));
        }
        elseif (Cookie::has('locale') && in_array(Cookie::get('locale'), $this->supportedLocales)) {
            App::setLocale(Cookie::get('locale'));
            session(['locale' => Cookie::get('locale')]);
        }
        else {
            $browserLocale = substr($request->server('HTTP_ACCEPT_LANGUAGE') ?? '', 0, 2);

            if (in_array($browserLocale, $this->supportedLocales)) {
                App::setLocale($browserLocale);
                session(['locale' => $browserLocale]);
            } else {
                App::setLocale(config('app.fallback_locale'));
                session(['locale' => config('app.fallback_locale')]);
            }
        }

        return $next($request);
    }
}
