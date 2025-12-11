<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        // menyimpan data baru
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.userdetail', compact('user'));    
    }

    public function edit($id)
    {
        // menampilkan form edit

    }

    public function update(Request $request, $id)
    {
        // update data
        $rules = [];
        $message = [];

        $user = User::findOrFail($id);
    }

    public function destroy($id)
    {
        // hapus data
        $user = User::findOrFail($id);

        if($user->profile_pic && Storage::exists('public/', $user->profile_pic)) {
            Storage::delete('public/', $user->profile_pic);
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User Deleted Successfully!');
    }
}
