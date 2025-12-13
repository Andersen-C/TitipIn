<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ManageLocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('admin.locations.manageLocations', compact('locations'));
    }

    public function create()
    {
        // menampilkan form create
    }

    public function store(Request $request)
    {
        // menyimpan data baru
        $rules = [
            'name' => 'required|string|min:1|max:255',
            'floor_number' => 'required|integer|min:0'
        ];

        $messages = [
            'name.required' => 'Nama lokasi wajib diisi',
            'name.string' => 'Nama lokasi harus berupa teks',
            'name.min' => 'Nama lokasi minimal memiliki 1 karakter',
            'name.max' => 'Nama lokasi maksimal memiliki 255 karakter',
            'floor_number.required' => 'Nomor lantai wajib diisi',
            'floor_number.integer' => 'Nomor lantai harus berupa angka',
            'floor_number.min' => 'Nomor lantai tidak boleh kurang dari 0 (basement memiliki nomor lantai 0).'
        ];

        try {
            $validated = $request->validate($rules, $messages);
        } catch (ValidationException $e) {
            $e->errorBag = "add";
            throw $e;
        }

        Location::create([
            'name' => $validated['name'],
            'floor_number' => $validated['floor_number']
        ]);

        return redirect()->route('locations.index')->with('success', 'Lokasi Berhasil Ditambahkan!');
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
        $rules = [
            'name' => 'required|string|min:1|max:255',
            'floor_number' => 'required|integer|min:0'
        ];

        $messages = [
            'name.required' => 'Nama lokasi wajib diisi',
            'name.string' => 'Nama lokasi harus berupa teks',
            'name.min' => 'Nama lokasi minimal memiliki 1 karakter',
            'name.max' => 'Nama lokasi maksimal memiliki 255 karakter',
            'floor_number.required' => 'Nomor lantai wajib diisi',
            'floor_number.integer' => 'Nomor lantai harus berupa angka',
            'floor_number.min' => 'Nomor lantai tidak boleh kurang dari 0 (basement memiliki nomor lantai 0).'
        ];

        try {
            $validated = $request->validate($rules, $messages);
        } catch (ValidationException $e) {
            $e->errorBag = "update-$id";
            throw $e;
        }

        $location = Location::findOrFail($id);

        $location->update([
            'name' => $validated['name'],
            'floor_number' => $validated['floor_number']
        ]);

        return redirect()->route('locations.index')->with('success', 'Lokasi Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        // hapus data
        $location = Location::findOrFail($id);

        $location->delete();
        return redirect()->route('locations.index')->with('success', 'Lokasi Berhasil Dihapus!');
    }
}
