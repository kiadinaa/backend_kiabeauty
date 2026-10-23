<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(Request $request): View
    {
        $categories = Category::all();

        // 4 Produk Pilihan untuk section "Pilihan untukmu" di Dashboard
        $featuredProducts = Product::with('category')->take(4)->get();

        // Produk diskon untuk flash sale
        $discountedProducts = Product::with('category')
            ->where('discount_percent', '>', 0)
            ->take(4)
            ->get();

        // Semua produk untuk katalog
        $allProducts = Product::with('category')->latest()->get();

        return view('home', compact(
            'categories',
            'featuredProducts',
            'discountedProducts',
            'allProducts'
        ));
    }

    public function products(Request $request): View
    {
        $categories = Category::all();

        $query = Product::with('category');

        $search = $request->input('q', $request->input('search', ''));
        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $category = $request->input('category', 'All');
        if ($category !== 'All' && ! empty($category)) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('category', $category);
            });
        }

        if ($request->boolean('discount_only')) {
            $query->where('discount_percent', '>', 0);
        }

        // Sorting matching ReactBasic: 'low', 'high', 'rating', 'discount', 'default'
        $sort = $request->input('sort', 'default');
        if ($sort === 'low') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'rating') {
            $query->orderByDesc('product_id'); // high rated
        } elseif ($sort === 'discount') {
            $query->orderByDesc('discount_percent');
        } else {
            $query->orderBy('product_id', 'asc');
        }

        $products = $query->paginate(12)->withQueryString();

        return view('shop.products', compact('products', 'categories', 'category', 'sort', 'search'));
    }

    public function about(): View
    {
        return view('about');
    }

    public function contact(): View
    {
        return view('contact');
    }
}
