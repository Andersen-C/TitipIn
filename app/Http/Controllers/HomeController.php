<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function landing() {
        return view('beforeLogin.landing');
    }

    public function adminHome() {
        return view('admin.adminHome');
    }

    public function titiperHome() {
        return view('titiper.titiperHome');
    }

    public function runnerHome() {
        return view('runner.runnerHome');
    }
}
