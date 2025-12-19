<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ManageLocationController extends Controller
{
    public function index()
    {
        $locations = Location::paginate(10)->onEachSide(1);
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
            'name.required' => __('validation.ManageLoc.name.required'),
            'name.string' => __('validation.ManageLoc.name.string'),
            'name.min' => __('validation.ManageLoc.name.min'),
            'name.max' => __('validation.ManageLoc.name.max'),
            'floor_number.required' => __('validation.ManageLoc.Floor.required'),
            'floor_number.integer' => __('validation.ManageLoc.Floor.integer'),
            'floor_number.min' => __('validation.ManageLoc.Floor.min')
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

        return redirect()->route('locations.index')->with('success', __('admin.AddLocSuccessTitle'));
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
            'name.required' => __('validation.ManageLoc.name.required'),
            'name.string' => __('validation.ManageLoc.name.string'),
            'name.min' => __('validation.ManageLoc.name.min'),
            'name.max' => __('validation.ManageLoc.name.max'),
            'floor_number.required' => __('validation.ManageLoc.Floor.required'),
            'floor_number.integer' => __('validation.ManageLoc.Floor.integer'),
            'floor_number.min' => __('validation.ManageLoc.Floor.min')
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

        return redirect()->route('locations.index')->with('success', __('admin.UpdateLocSuccessTitle'));
    }

    public function destroy($id)
    {
        // hapus data
        $location = Location::findOrFail($id);

        $location->delete();
        return redirect()->route('locations.index')->with('success', __('admin.DeleteLocSuccessTitle'));
    }
}
