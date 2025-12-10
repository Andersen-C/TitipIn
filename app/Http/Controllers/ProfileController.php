<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman Profil untuk Mode TITIPER
     * Route: GET /titiper/profile
     */
    public function showTitiper()
    {
        return view('profile.show', [
            'user'   => Auth::user(),
            // Mengirim layout Titiper ke View
            'layout' => 'template.afterLogin.TitiperAfterLogin',
            'mode'   => 'titiper'
        ]);
    }

    /**
     * Menampilkan halaman Profil untuk Mode RUNNER
     * Route: GET /runner/profile
     */
    public function showRunner()
    {
        return view('profile.show', [
            'user'   => Auth::user(),
            // Mengirim layout Runner ke View
            'layout' => 'template.afterLogin.RunnerAfterLogin',
            'mode'   => 'runner'
        ]);
    }

    /**
     * Mengupdate Informasi Dasar (Nama, Email, No HP)
     * Route: POST /profile/update
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // VALIDASI DIPERKETAT DI SINI
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'required|numeric|min_digits:10',
        ], [
            'phone_number.numeric' => 'Nomor telepon harus berupa angka.',
            'phone_number.min_digits' => 'Nomor telepon minimal 10 digit.',
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        /** @var \App\Models\User $user */
        $user->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Mengganti Password
     * Route: POST /profile/password
     */
    public function managePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        // Update password baru
        /** @var \App\Models\User $user */
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diubah.');
    }

    /**
     * Mengganti Foto Profil
     * Route: POST /profile/photo
     */
    public function managePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada (opsional, jika bukan placeholder)
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Simpan foto baru
            $path = $request->file('photo')->store('profile-photos', 'public');

            /** @var \App\Models\User $user */
            $user->update(['profile_photo_path' => $path]);
        }

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    /**
     * Switch Mode Logic (Opsional)
     * Route: POST /profile/switch-mode
     * * Catatan: Karena kita menggunakan direct link di View (href="route"),
     * fungsi ini mungkin tidak terpakai kecuali Anda ingin menyimpan
     * "last_active_mode" di database.
     */
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
