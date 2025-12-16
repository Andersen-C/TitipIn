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
            'name.required' => __('validation.ManageUser.name.required'),
            'name.min'      => __('validation.ManageUser.name.min'),
            'name.max'      => __('validation.ManageUser.name.max'),
            'email.required'    => __('validation.ManageUser.email.required'),
            'email.email'       => __('validation.ManageUser.email.email'),
            'email.unique'      => __('validation.ManageUser.email.unique'),
            'role.required'     => __('validation.ManageUser.role.required'),
            'role.in'           => __('validation.ManageUser.role.in'),
            'mode.required'     => __('validation.ManageUser.mode.required'),
            'mode.in'           => __('validation.ManageUser.mode.in'),
            'profile_pic.image'      => __('validation.ManageUser.profile_pic.image'),
            'profile_pic.mimes'      => __('validation.ManageUser.profile_pic.mimes'),
            'profile_pic.max'        => __('validation.ManageUser.profile_pic.max'),
            'password.required' => __('validation.ManageUser.password.required'),
            'password.min' => __('validation.ManageUser.password.min'),
            'password.confirmed' => __('validation.ManageUser.password.confirmed'),
            'password_confirmation.required' => __('validation.ManageUser.password_confirmation.required')
        ];

        // menyimpan data baru
        $validated = $request->validate($rules, $messages);

        if($request->hasFile('profile_pic')) {
            $validated['profile_pic'] = $request->file('profile_pic')->store('profile-pictures', 'public');
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

        return redirect()->route('users.index')->with('success', __('admin.CreateUserSuccess'));
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
            'name.required' => __('validation.ManageUser.name.required'),
            'name.min'      => __('validation.ManageUser.name.min'),
            'name.max'      =>  __('validation.ManageUser.name.max'),
            'email.required'    => __('validation.ManageUser.email.required'),
            'email.email'       => __('validation.ManageUser.email.email'),
            'email.unique'      => __('validation.ManageUser.email.unique'),
            'role.required'     => __('validation.ManageUser.role.required'),
            'role.in'           => __('validation.ManageUser.role.in'),
            'mode.required'     => __('validation.ManageUser.mode.required'),
            'mode.in'           => __('validation.ManageUser.mode.in'),
            'profile_pic.image' => __('validation.ManageUser.profile_pic.image'),
            'profile_pic.mimes' => __('validation.ManageUser.profile_pic.mimes'),
            'profile_pic.max'   => __('validation.ManageUser.profile_pic.max'),
            'password.min'      => __('validation.ManageUser.password.required'),
            'password.confirmed' => __('validation.ManageUser.password.confirmed'),
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

           $user->profile_pic = $request->file('profile_pic')->store('profile-pictures', 'public');
        }
        $user->save();

        return redirect()->route('users.index')->with('success', __('admin.UpdateUserSuccess'));
    }

    public function destroy($id)
    {
        // hapus data
        $user = User::findOrFail($id);

        if($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)) {
            Storage::disk('public')->delete($user->profile_pic);
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', __('admin.DeleteUserSuccess'));
    }
}
