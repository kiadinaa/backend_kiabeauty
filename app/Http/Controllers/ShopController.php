<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function show(string $slug): View
    {
        $product = Product::with(['category', 'reviews' => function ($q) {
            $q->latest();
        }])
            ->where('slug', $slug)
            ->orWhere('product_id', $slug)
            ->firstOrFail();

        // Produk terkait berdasarkan kategori
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('product_id', '!=', $product->product_id)
            ->take(4)
            ->get();

        return view('shop.detail', compact('product', 'relatedProducts'));
    }
}
