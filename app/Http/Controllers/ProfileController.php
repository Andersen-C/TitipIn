<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function showTitiper()
    {
        return view('profile.show', [
            'user'   => Auth::user(),
            'layout' => 'template.afterLogin.TitiperAfterLogin',
            'mode'   => 'titiper'
        ]);
    }

    public function showRunner()
    {
        $user = Auth::user();
        $reviews = $user->reviewsGotten()->with('reviewer')->latest()->get();

        return view('profile.show', [
            'user'    => $user,
            'layout'  => 'template.afterLogin.RunnerAfterLogin',
            'mode'    => 'runner',
            'reviews' => $reviews
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'required|numeric|min_digits:10',
        ], [
            'name.required'           => __('validation.ManageProfile.name.required'),
            'name.string'             => __('validation.ManageProfile.name.string'),
            'name.max'                => __('validation.ManageProfile.name.max'),
            'email.required'          => __('validation.ManageProfile.email.required'),
            'email.email'             => __('validation.ManageProfile.email.email'),
            'email.max'               => __('validation.ManageProfile.email.max'),
            'email.unique'            => __('validation.ManageProfile.email.unique'),
            'phone_number.required'   => __('validation.ManageProfile.phone.required'),
            'phone_number.numeric'    => __('validation.ManageProfile.phone.numeric'),
            'phone_number.min_digits' => __('validation.ManageProfile.phone.min_digits'),
        ]);

        /** @var \App\Models\User $user */
        $user->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        return back()->with('success', __('profile.ProfileUpdated'));
    }

    public function managePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => __('profile.WrongPassword')]);
        }

        /** @var \App\Models\User $user */
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', __('profile.PasswordUpdated'));
    }

    public function managePhoto(Request $request)
    {
        $request->validate([
            'photo' => [
                'required',
                'image',
                'mimes:png,jpg,jpeg',
                'max:2048'
            ],
        ], [
            'photo.required' => __('validation.ManageProfile.photo.required'),
            'photo.image' => __('validation.ManageProfile.photo.image'),
            'photo.mimes' => __('validation.ManageProfile.photo.mimes'),
            'photo.max' => __('validation.ManageProfile.photo.max'),
        ]);

        $user = Auth::user();

        if ($request->hasFile('photo')) {
            if ($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)) {
                Storage::disk('public')->delete($user->profile_pic);
            }

            $path = $request->file('photo')->store('profile-photos', 'public');

            /** @var \App\Models\User $user */
            $user->update(['profile_pic' => $path]);
        }

        return back()->with('success', __('profile.ProfilePicUpdated'));
    }

    public function switch($target)
    {
        if (!in_array($target, ['runner', 'titiper'])) {
            return back();
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->update(['mode' => $target]);

        return redirect()->route($target . '.home');
    }
}
