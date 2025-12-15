<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'name.required' => __('validation.name.required'),
            'name.string' => __('validation.name.string'),
            'name.min' => __('validation.name.min'),
            'name.max' => __('validation.name.max'),
            'phone_number.required' => __('validation.phone_number.required'),
            'phone_number.regex' => __('validation.phone_number.regex'),
            'phone_number.unique' => __('validation.phone_number.unique'),
            'email.required' => __('validation.email.required'),
            'email.email' => __('validation.email.email'),
            'email.unique' => __('validation.email.unique'),
            'password.required' => __('validation.password.required'),
            'password.min' => __('validation.password.min'),
            'password.confirmed' => __('validation.password.confirmed')
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
