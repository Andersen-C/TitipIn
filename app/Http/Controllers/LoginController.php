<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $fields = [
            'email' => 'required|email',
            'password' => 'required' 
        ];
        $messages = [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak sesuai',
            'password.required' => 'Password harus diisi',
        ];

        $credentials = $request->validate($fields, $messages); 

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if($user->mode === 'titiper') {
                return redirect()->route('titiper.home');
            }
            if($user->mode === 'runner') {
                return redirect()->route('runner.home');
            }
        
            return redirect('/');
        }
        else {
             return back()->with('failed', 'Login Gagal')->withInput();
        }
    }
}
