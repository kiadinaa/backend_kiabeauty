<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = session()->get('cart', []);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Promo Gratis Ongkir jika belanja di atas Rp 100.000
        $shipping = $subtotal >= 100000 || $subtotal === 0 ? 0 : 15000;
        $total = $subtotal + $shipping;

        return view('cart.index', compact('cart', 'subtotal', 'shipping', 'total'));
    }

    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = (int) ($request->input('quantity', 1));

        if ($product->stock < $quantity) {
            return back()->with('error', 'Maaf, stok produk tidak mencukupi (sisa '.$product->stock.').');
        }

        $cart = session()->get('cart', []);
        $id = $product->product_id;

        if (isset($cart[$id])) {
            $newQuantity = $cart[$id]['quantity'] + $quantity;
            if ($newQuantity > $product->stock) {
                return back()->with('error', 'Jumlah dalam keranjang melebihi stok yang tersedia (sisa '.$product->stock.').');
            }
            $cart[$id]['quantity'] = $newQuantity;
        } else {
            $cart[$id] = [
                'product_id' => $product->product_id,
                'name' => $product->name,
                'price' => $product->final_price,
                'original_price' => (float) $product->price,
                'discount_percent' => (int) $product->discount_percent,
                'img' => $product->img,
                'quantity' => $quantity,
                'slug' => $product->slug,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produk "'.$product->name.'" berhasil dimasukkan ke keranjang!');
    }

    public function update(Request $request, int|string $id): RedirectResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $qty = (int) $request->quantity;
            $product = Product::find($id);

            if ($qty <= 0) {
                unset($cart[$id]);
                session()->put('cart', $cart);

                return back()->with('success', 'Produk dihapus dari keranjang.');
            }

            if ($product && $qty > $product->stock) {
                return back()->with('error', 'Stok hanya tersisa '.$product->stock.'.');
            }

            $cart[$id]['quantity'] = $qty;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function remove(int|string $id): RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function clear(): RedirectResponse
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan.');
    }
}
