<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // Search
        $q = $request->query('q', null);

        // Filter kategori
        $category = $request->query('category', null);

        // Base query menu
        $menusQuery = Menu::query();

        if ($q) {
            $menusQuery->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%");
            });
        }

        if ($category) {
            $menusQuery->where('category', $category);
        }

        // Ambil daftar menu
        $menus = $menusQuery->orderBy('created_at', 'desc')
                            ->paginate(12)
                            ->withQueryString();

        // Ambil kategori (fallback jika tidak ada table category)
        if (class_exists(\App\Models\Category::class)) {
            $categories = Category::orderBy('name')->get();
        } else {
            $categories = Menu::select('category')
                              ->distinct()
                              ->pluck('category')
                              ->filter()
                              ->values();
        }

        return view('titiper.menu.index', [
            'menus' => $menus,
            'categories' => $categories,
            'q' => $q,
            'category' => $category
        ]);
    }
}
