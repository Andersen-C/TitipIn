<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Location;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ManageMenuController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q', null);

        $menus = Menu::with(['category', 'location'])
            ->when($q, fn($qb) => $qb->where('name', 'like', "%{$q}%"))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.menus.manageMenu', compact('menus', 'q'));
    }

    public function create()
    {
        // pass locations & categories untuk dropdown di form
        $locations = Location::where('name', 'NOT LIKE', '%Kelas%')->orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        return view('admin.menus.createMenu', compact('locations', 'categories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:4|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            // ubah jadi required di store -> gambar wajib saat CREATE
            'image' => 'required|image|max:2048',
        ];

        $messages = [
            'name.required' => __('validation.ManageMenu.name.required'),
            'name.string' => __('validation.ManageMenu.name.string'),
            'name.min' => __('validation.ManageMenu.name.min'),
            'name.max' => __('validation.ManageMenu.name.max'),
            'description.string' => __('validation.ManageMenu.desc.string'),
            'price.required' => __('validation.ManageMenu.price.required'),
            'price.numeric' => __('validation.ManageMenu.price.numeric'),
            'price.min' => __('validation.ManageMenu.price.min'),
            'category_id.required' => __('validation.ManageMenu.category_id.required'),
            'category_id.exists' => __('validation.ManageMenu.category_id.exists'),

            'location_id.required' => __('validation.ManageMenu.location_id.required'),
            'location_id.exists' => __('validation.ManageMenu.location_id.exists'),

            // pesan untuk gambar wajib
            'image.required' => __('validation.ManageMenu.image.required'),
            'image.image' => __('validation.ManageMenu.image.image'),
            'image.max' => __('validation.ManageMenu.image.max'),
        ];

        $data = $request->validate($rules, $messages);

        // handle upload -> save path to `image` column in DB
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menus', 'public');
        } else {
            $data['image'] = null;
        }

        // normalize nullable foreign keys (store null instead of empty string) - but they are required now
        $data['location_id'] = $request->input('location_id') ?: null;
        $data['category_id'] = $request->input('category_id') ?: null;

        Menu::create($data);

        return redirect()->route('menus.index')->with('success', __('admin.AddMenuSuccessTitle'));
    }

    public function show($id)
    {
        $menu = Menu::with(['category', 'location'])->findOrFail($id);
        return view('admin.menus.menuDetail', compact('menu'));
    }

    public function edit($id)
    {
        $menu = Menu::with(['location', 'category'])->findOrFail($id);
        $locations = Location::where('name', 'NOT LIKE', '%Kelas%')->orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        return view('admin.menus.editMenu', compact('menu', 'locations', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $rules = [
            'name' => 'required|string|min:4|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            // tetap nullable di update
            'image' => 'nullable|image|max:2048',
        ];

        $messages = [
            'name.required' => __('validation.ManageMenu.name.required'),
            'name.min' => __('validation.ManageMenu.name.min'),
            'name.max' => __('validation.ManageMenu.name.max'),
            'description.string' => __('validation.ManageMenu.desc.string'),
            'price.required' => __('validation.ManageMenu.price.required'),
            'price.numeric' => __('validation.ManageMenu.price.numeric'),
            'price.min' => __('validation.ManageMenu.price.min'),
            'category_id.required' => __('validation.ManageMenu.category_id.required'),
            'category_id.exists' => __('validation.ManageMenu.category_id.exists'),
            'location_id.required' => __('validation.ManageMenu.location_id.required'),
            'location_id.exists' =>  __('validation.ManageMenu.location_id.exists'),
            'image.image' =>  __('validation.ManageMenu.image.image'),
            'image.max' => __('validation.ManageMenu.image.max'),
        ];

        $data = $request->validate($rules, $messages);

        if ($request->hasFile('image')) {
            // delete old file if exists
            if ($menu->image && Storage::disk('public')->exists($menu->image)) {
                Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('menus', 'public');
        } else {
            // if no new upload, keep existing image (don't overwrite to null)
            unset($data['image']);
        }

        // normalize foreign keys (should be present since required)
        $data['location_id'] = $request->input('location_id') ?: null;
        $data['category_id'] = $request->input('category_id') ?: null;

        $menu->update($data);

        return redirect()->route('menus.index')->with('success', __('admin.UpdateMenuSuccessTitle'));
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->image && Storage::disk('public')->exists($menu->image)) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect()->route('menus.index')->with('success', __('admin.DeleteMenuSuccessTitle'));
    }
}
