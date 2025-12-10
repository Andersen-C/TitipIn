<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Collection;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q', null);
        $group = $request->query('group', null);          // optional: 'Makanan', 'Minuman', dll
        $categoryParam = $request->query('category', null); // bisa berupa category_id (int) atau nama/slug (string)

        // Ambil semua kategori jika model ada, else fallback ke daftar nama kategori dari table menus
        if (class_exists(\App\Models\Category::class)) {
            $allCategories = Category::orderBy('name')->get();
            // groups berdasarkan kolom 'group' di tabel categories (null safe)
            $groups = $allCategories->pluck('group')->unique()->filter()->values();
        } else {
            // fallback: ambil distinct category string dari tabel menus
            $names = Menu::select('category')->distinct()->pluck('category')->filter()->values();
            // buat collection objek sederhana supaya view tetap konsisten (id = name)
            $allCategories = $names->map(function ($n) {
                return (object) ['id' => $n, 'name' => $n, 'group' => null];
            });
            $groups = collect();
        }

        // Tentukan sub-categories yang akan ditampilkan (berdasarkan group jika dipilih)
        // IMPORTANT: hanya tampilkan subCategories ketika user memilih group (menghindari duplikat)
        if ($group && $groups->isNotEmpty()) {
            $subCategories = $allCategories->filter(function ($c) use ($group) {
                return isset($c->group) && $c->group == $group;
            })->values();
        } else {
            // jika tidak memilih group -> jangan tampilkan subkategori
            $subCategories = collect();
        }

        // Query menu
        $menusQuery = Menu::query();

        // optional: eager load category relation jika Model Menu punya relation category()
        if (method_exists(new Menu(), 'category')) {
            $menusQuery = $menusQuery->with('category');
        }

        // Search
        if ($q) {
            $menusQuery->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%");
            });
        }

        // Filtering logic:
        if (class_exists(\App\Models\Category::class)) {
            // Prefer filter by category_id (recommended)
            if ($categoryParam) {
                if (is_numeric($categoryParam)) {
                    // kalau numeric, anggap id
                    $menusQuery->where('category_id', (int) $categoryParam);
                } else {
                    // kalau string: coba cari category by slug atau name
                    $cat = Category::where('slug', $categoryParam)
                                   ->orWhere('name', $categoryParam)
                                   ->first();
                    if ($cat) {
                        $menusQuery->where('category_id', $cat->id);
                    } else {
                        // fallback: tidak ada filter jika category tidak ditemukan
                    }
                }
            } elseif ($group) {
                // jika memilih group tapi belum pilih subcategory -> filter semua category_id di group tersebut
                $idsInGroup = $allCategories->filter(function ($c) use ($group) {
                    return isset($c->group) && $c->group == $group;
                })->pluck('id')->toArray();

                if (!empty($idsInGroup)) {
                    $menusQuery->whereIn('category_id', $idsInGroup);
                }
            }
        } else {
            // fallback lama: filter by menu.category (string)
            if ($categoryParam) {
                $menusQuery->where('category', $categoryParam);
            }
            // NOTE: group tidak didukung di fallback karena tidak ada kolom group di categories
        }

        // Ambil menu (paginate dan pertahankan query string)
        $menus = $menusQuery->orderBy('created_at', 'desc')
                            ->paginate(12)
                            ->withQueryString();

        return view('titiper.menu.index', [
            'menus' => $menus,
            'categories' => $allCategories,
            'groups' => $groups,
            'subCategories' => $subCategories,
            'q' => $q,
            'group' => $group,
            'category' => $categoryParam,
        ]);
    }
}
