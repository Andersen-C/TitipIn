<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\RateLimiter\RequestRateLimiterInterface;

class LanguageController extends Controller
{
    protected $supported = ['en', 'id'];

    public function switch($locale, Request $request) {
        if (!in_array($locale, $this->supported)) {
            $locale = config('app.fallback_locale');
        }

        session(['locale' => $locale]);
        Cookie::queue('locale', $locale, 60 * 24 * 30);
        
        return redirect()->back();
    }
}
