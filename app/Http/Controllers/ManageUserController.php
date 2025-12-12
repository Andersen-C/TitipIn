<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ManageUserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        return view('admin.users.manageUser', compact('users'));
    }

    public function create()
    {
        // menampilkan form create
        return view('admin.users.createUser');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5|max:50',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|regex:/^08[0-9]{8,13}$/|unique:users,phone_number',
            'role' => 'required|in:admin,user',
            'mode' => 'required|in:titiper,runner',
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ];

        $messages = [
            'name.required' => 'Username wajib diisi',
            'name.min'      => 'Username minimal memiliki 5 karakter',
            'name.max'      => 'Username maksimal memiliki 50 karakter',
            'email.required'    => 'Email harus diisi',
            'email.email'       => 'Format email tidak valid',
            'email.unique'      => 'Email sudah dipakai oleh akun lain',
            'role.required'     => 'Role harus dipilih',
            'role.in'           => 'Role yang dipilih tidak valid',
            'mode.required'     => 'Mode harus dipilih',
            'mode.in'           => 'Mode yang dipilih tidak valid',
            'profile_pic.image'      => 'File harus berupa gambar',
            'profile_pic.mimes'      => 'Format gambar harus JPG, JPEG, atau PNG',
            'profile_pic.max'        => 'Ukuran gambar maksimal 2MB',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal memiliki 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'password_confirmation.required' => 'Konfirmasi password harus diisi'
        ];

        // menyimpan data baru
        $validated = $request->validate($rules, $messages);

        if($request->hasFile('profile_pic')) {
            $validated['profile_pic'] = $request->file('profile_pic')->store('profiles', 'public');
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'role' => $validated['role'],
            'mode' => $validated['mode'],
            'profile_pic' => $validated['profile_pic'] ?? null,
            'password' => Hash::make($validated['password']),
            'avg_rating' => 0  
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil dibuat!');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.userdetail', compact('user'));    
    }

    public function edit($id)
    {
        // menampilkan form edit
        $user = User::findOrFail($id);
        return view('admin.users.updateUser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:5|max:50',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone_number' => 'required|regex:/^08[0-9]{8,13}$/|unique:users,phone_number,' . $id,
            'role' => 'required|in:admin,user',
            'mode' => 'required|in:titiper,runner',
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|min:8|confirmed',
            'password_confirmation' => 'nullable'
        ];

        $messages = [
            'name.required' => 'Username wajib diisi',
            'name.min'      => 'Username minimal memiliki 5 karakter',
            'name.max'      => 'Username maksimal memiliki 50 karakter',
            'email.required'    => 'Email harus diisi',
            'email.email'       => 'Format email tidak valid',
            'email.unique'      => 'Email sudah dipakai oleh akun lain',
            'role.required'     => 'Role harus dipilih',
            'role.in'           => 'Role yang dipilih tidak valid',
            'mode.required'     => 'Mode harus dipilih',
            'mode.in'           => 'Mode yang dipilih tidak valid',
            'profile_pic.image' => 'File harus berupa gambar',
            'profile_pic.mimes' => 'Format gambar harus JPG, JPEG, atau PNG',
            'profile_pic.max'   => 'Ukuran gambar maksimal 2MB',
            'password.min'      => 'Password minimal memiliki 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
        ];

        $request->validate($rules, $messages);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->role = $request->role;
        $user->mode = $request->mode;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_pic')) {
            if ($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)){
                Storage::disk('public')->delete($user->profile_pic);
            }

           $user->profile_pic = $request->file('profile_pic')->store('profiles', 'public');
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // hapus data
        $user = User::findOrFail($id);

        if($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)) {
            Storage::disk('public')->delete($user->profile_pic);
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User Berhasil Dihapus!');
    }
}
