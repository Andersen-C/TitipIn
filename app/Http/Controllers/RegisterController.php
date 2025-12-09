<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class RegisterController extends Controller
{
    public function show() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->merge([
            'name' => trim($request->name),
            'email' => trim($request->email),
            'phone_number' => preg_replace('/\D/', '', $request->phone_number),
        ]);

        $fields = [
            'name' => 'required|string|min:5|max:50',
            'phone_number' => 'required|regex:/^08[0-9]{8,13}$/|unique:users,phone_number',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ];
        
        $messages = [
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama harus berupa teks yang valid.',
            'name.min' => 'Nama minimal memiliki 5 karakter',
            'name.max' => 'Nama maksimal memiliki 50 karakter',
            'phone_number.required' => 'Nomor telepon harus diisi',
            'phone_number.regex' => 'Nomor telepon harus mengikuti format 08xxxxxxxxxx',
            'phone_number.unique' => 'Nomor telepon sudah dipakai oleh akun lain',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah dipakai oleh akun lain',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal memiliki 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai'
        ];

        $validated = $request->validate($fields, $messages);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'role' => 'user',
            'mode' => 'titiper',
            'avg_rating' => 0,
            'password' => Hash::make($validated['password']),
            'profile_pic' => null
        ]);

        Auth::login($user);
        return redirect()->route('titiper.home');
    }
}
