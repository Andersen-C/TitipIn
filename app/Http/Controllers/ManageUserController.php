<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {
        // menampilkan form create
    }

    public function store(Request $request)
    {
        // menyimpan data baru
    }

    public function show($id)
    {
        // menampilkan detail data
    }

    public function edit($id)
    {
        // menampilkan form edit
    }

    public function update(Request $request, $id)
    {
        // update data
    }

    public function destroy($id)
    {
        // hapus data
    }
}
