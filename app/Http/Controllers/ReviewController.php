<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:3|max:1000',
            'user_name' => 'nullable|string|max:100',
        ]);

        $userName = auth()->check()
            ? auth()->user()->name
            : ($validated['user_name'] ?? 'Pelanggan KiaBeauty');

        Review::create([
            'product_id' => $validated['product_id'],
            'user_id' => auth()->id(),
            'user_name' => $userName,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Terima kasih atas rating dan ulasan Anda!');
    }
}
