<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $query = Order::with('items')->latest();

        if (auth()->check()) {
            $query->where('user_id', auth()->id());
        } else {
            // Jika tamu belum login, tampilkan berdasarkan session atau nomor pesanan
            $recentOrders = session()->get('recent_orders', []);
            if (! empty($recentOrders)) {
                $query->whereIn('order_number', $recentOrders);
            } else {
                $query->whereRaw('1 = 0'); // Belum ada riwayat pesanan
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                    ->orWhereHas('items', function ($iq) use ($search) {
                        $iq->where('product_name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10)->withQueryString();

        return view('orders.index', compact('orders'));
    }

    public function show(string $orderNumber): View
    {
        $order = Order::with('items.product')
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }
}
