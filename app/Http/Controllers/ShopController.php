<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    /**
     * Halaman utama toko: hero banner, kategori, produk unggulan/terbaru.
     */
    public function home()
    {
        $banners = Banner::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $categories = Category::where('is_active', true)
            ->withCount(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('name')
            ->get();

        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        $latestProducts = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        return view('shop.home', compact(
            'banners',
            'categories',
            'featuredProducts',
            'latestProducts'
        ));
    }

    /**
     * Halaman katalog produk: pencarian, filter kategori, pagination.
     */
    public function products(\Illuminate\Http\Request $request)
    {
        $query = Product::with('category')
            ->where('is_active', true);

        if ($request->filled('q')) {
            $query->where('name', 'like', '%'.$request->input('q').'%');
        }

        $activeCategory = null;

        if ($request->filled('kategori')) {
            $activeCategory = Category::where('slug', $request->input('kategori'))
                ->where('is_active', true)
                ->first();

            if ($activeCategory) {
                $query->where('category_id', $activeCategory->id);
            }
        }

        $sort = $request->input('sort', 'terbaru');

        match ($sort) {
            'termurah' => $query->orderBy('price', 'asc'),
            'termahal' => $query->orderBy('price', 'desc'),
            default    => $query->latest(),
        };

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('shop.products', compact(
            'products',
            'categories',
            'activeCategory',
            'sort'
        ));
    }

    /**
     * Halaman detail produk + tombol pesan via WhatsApp.
     */
    public function show(string $slug)
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedProducts = Product::with('category')
            ->where('is_active', true)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }
}
