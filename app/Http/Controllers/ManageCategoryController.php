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
            'name.required' => 'Nama kategori wajib diisi',
            'name.string' => 'Nama kategori harus berupa teks',
            'name.min' => 'Nama kategori minimal memiliki 1 karakter',
            'name.max' => 'Nama kategori maksimal memiliki 255 karakter',
            'name.unique' => 'Nama kategori sudah digunakan',
            'group.string' => 'Group harus berupa teks',
            'group.max' => "Group maksimal memiliki 255 kararkter"
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

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dibuat!');
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
            'name.required' => 'Nama kategori wajib diisi',
            'name.string' => 'Nama kategori harus berupa teks',
            'name.min' => 'Nama kategori minimal memiliki 1 karakter',
            'name.max' => 'Nama kategori maksimal memiliki 255 karakter',
            'name.unique' => 'Nama kategori sudah digunakan',
            'group.string' => 'Group harus berupa teks',
            'group.max' => "Group maksimal memiliki 255 kararkter"
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

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // hapus data
        $category = Category::findOrFail($id);

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori Berhasil Dihapus!');
    }
}
