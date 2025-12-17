<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ManageCategoryController extends Controller
{
    public function index()
    {
        // menampilkan semua data
        $categories = Category::all();
        return view('admin.categories.manageCategories', compact('categories'));
    }

    public function create()
    {
        // menampilkan form create
    }

    public function store(Request $request)
    {
        // menyimpan data baru
        $rules = [
            'name' => 'required|string|min:1|max:255|unique:categories,name',
            'group' => 'nullable|string|max:255'
        ];

        $messages = [
            'name.required' => __('validation.ManageCat.name.required'),
            'name.string' => __('validation.ManageCat.name.string'),
            'name.min' => __('validation.ManageCat.name.min'),
            'name.max' => __('validation.ManageCat.name.max'),
            'name.unique' => __('validation.ManageCat.name.unique'),
            'group.string' => __('validation.ManageCat.Group.string'),
            'group.max' => __('validation.ManageCat.Group.max')
        ];
        
        try {
            $validated = $request->validate($rules, $messages);
        } 
        catch(ValidationException $e) {
            $e->errorBag = 'add';
            throw $e;
        }

        Category::create([
            'name' => $validated['name'],
            'group' => $validated['group'] ? $validated['group'] : null
        ]);

        return redirect()->route('categories.index')->with('success', __('admin.AddCatSuccessTitle'));
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
        $rules = [
            'name' => 'required|string|min:1|max:255|unique:categories,name',
            'group' => 'nullable|string|max:255'
        ];

        $messages = [
            'name.required' => __('validation.ManageCat.name.required'),
            'name.string' => __('validation.ManageCat.name.string'),
            'name.min' => __('validation.ManageCat.name.min'),
            'name.max' => __('validation.ManageCat.name.max'),
            'name.unique' => __('validation.ManageCat.name.unique'),
            'group.string' => __('validation.ManageCat.Group.string'),
            'group.max' => __('validation.ManageCat.Group.max')
        ];
        
        try {
            $validated = $request->validate($rules, $messages);
        } 
        catch(ValidationException $e) {
            $e->errorBag = "update-$id";
            throw $e;
        }

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $validated['name'],
            'group' => $validated['group'] ? $validated['group'] : null
        ]);

        return redirect()->route('categories.index')->with('success', __('admin.UpdateCatSuccessTitle'));
    }

    public function destroy($id)
    {
        // hapus data
        $category = Category::findOrFail($id);

        $category->delete();
        return redirect()->route('categories.index')->with('success', __('admin.DeleteCatSuccessTitle'));
    }
}
