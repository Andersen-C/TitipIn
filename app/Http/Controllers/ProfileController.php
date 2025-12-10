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
            'phone_number.numeric'    => 'Nomor telepon harus berupa angka.',
            'phone_number.min_digits' => 'Nomor telepon minimal 10 digit.',
            'phone_number.required'   => 'Nomor telepon wajib diisi.',
            'name.required'           => 'Nama wajib diisi.',
            'email.required'          => 'Email wajib diisi.',
            'email.email'             => 'Format email tidak valid.',
        ]);

        /** @var \App\Models\User $user */
        $user->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function managePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        /** @var \App\Models\User $user */
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diubah.');
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
            'photo.required' => 'Anda belum memilih foto untuk diunggah.',
            'photo.image' => 'File yang diunggah harus berupa gambar.',
            'photo.mimes' => 'Format foto harus berupa PNG, JPG, atau JPEG.',
            'photo.max' => 'Ukuran foto maksimal adalah 2MB.',
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

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function switch($target)
    {
        if (!in_array($target, ['runner', 'titiper'])) {
            return back();
        }

        /** @var \App\Models\User $user */
        $user = \Illuminate\Support\Facades\Auth::user();
        $user->update(['mode' => $target]);

        return redirect()->route($target . '.home');
    }
}
