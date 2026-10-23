@extends('layout')

@section('title', 'Daftar Belanja - KiaBeauty')

@section('styles')
<style>
    .order-status-tabs {
        display: flex;
        background: #FFF8FA;
        border-radius: 16px;
        border: 1px solid #fce7ef;
        padding: 6px;
        gap: 6px;
        margin-bottom: 24px;
        overflow-x: auto;
    }

    .order-tab {
        flex: 1;
        text-align: center;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 700;
        color: var(--text-muted);
        border-radius: 12px;
        white-space: nowrap;
        transition: all 0.2s;
    }

    .order-tab:hover, .order-tab.active {
        background: var(--pink-dark);
        color: #ffffff;
    }

    /* Shopee-style Order Card matching React aesthetic */
    .shopee-order-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #fce7ef;
        padding: 22px;
        margin-bottom: 20px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.03);
        transition: box-shadow 0.2s;
    }

    .shopee-order-card:hover {
        box-shadow: 0 6px 18px rgba(168, 77, 112, 0.08);
    }

    .order-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 14px;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .order-num-text {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .status-badge-custom {
        font-size: 11px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 999px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .status-diproses {
        background: #fef3c7;
        color: #b45309;
    }

    .status-dikirim {
        background: #e0f2fe;
        color: #0369a1;
    }

    .status-selesai {
        background: #dcfce7;
        color: #15803d;
    }

    .order-item-strip {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 10px 0;
        border-bottom: 1px solid #f8fafc;
    }

    .order-item-strip:last-child {
        border-bottom: none;
    }

    .item-img-thumb {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background: #FFF8FA;
        padding: 6px;
        object-fit: contain;
        flex-shrink: 0;
    }

    .order-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
        margin-top: 12px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .total-price-text {
        font-size: 19px;
        font-weight: 800;
        color: var(--pink-dark);
    }
</style>
@endsection

@section('content')

    <div style="margin-bottom: 24px; display: flex; align-items: flex-end; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
        <div>
            <p style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.15em; color: var(--pink-dark); margin-bottom: 4px;">
                KiaBeauty Orders
            </p>
            <h1 style="font-size: 30px; font-weight: 700; color: var(--text-dark);">
                Daftar Belanja Saya
            </h1>
        </div>

        <a href="{{ route('shop.index') }}" class="btn-pink-outline" style="font-size: 13px; border-radius: 12px;">
            + Belanja Lagi
        </a>
    </div>

    <!-- Filter Tabs -->
    <div class="order-status-tabs">
        <a href="{{ route('orders.index') }}" class="order-tab {{ !request('status') ? 'active' : '' }}">
            Semua Pesanan
        </a>
        <a href="{{ route('orders.index', ['status' => 'diproses']) }}" class="order-tab {{ request('status') == 'diproses' ? 'active' : '' }}">
            ⏳ Sedang Diproses
        </a>
        <a href="{{ route('orders.index', ['status' => 'dikirim']) }}" class="order-tab {{ request('status') == 'dikirim' ? 'active' : '' }}">
            🚚 Sedang Dikirim
        </a>
        <a href="{{ route('orders.index', ['status' => 'selesai']) }}" class="order-tab {{ request('status') == 'selesai' ? 'active' : '' }}">
            ✅ Selesai
        </a>
    </div>

    @if($orders->count() > 0)
        <div>
            @foreach($orders as $order)
                <div class="shopee-order-card">
                    <div class="order-card-header">
                        <div>
                            <span class="order-num-text">Pesanan #{{ $order->order_number }}</span>
                            <span style="color: #cbd5e1; margin: 0 8px;">|</span>
                            <span style="font-size: 12px; color: var(--text-muted);">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                        </div>
                        <div>
                            @php
                                $badgeClass = match(strtolower($order->status)) {
                                    'selesai' => 'status-selesai',
                                    'dikirim' => 'status-dikirim',
                                    default => 'status-diproses',
                                };
                            @endphp
                            <span class="status-badge-custom {{ $badgeClass }}">
                                {{ strtoupper($order->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Items List -->
                    <div>
                        @foreach($order->items as $item)
                            <div class="order-item-strip">
                                <img src="{{ $item->product ? $item->product->image_url : asset('images/products/somethinc-cleanser.jpg') }}" class="item-img-thumb" alt="{{ $item->product_name }}">
                                <div style="flex: 1; min-width: 0;">
                                    <div style="font-size: 14px; font-weight: 600; color: var(--text-dark);">{{ $item->product_name }}</div>
                                    <div style="font-size: 12px; color: var(--text-muted); margin-top: 2px;">{{ $item->quantity }} barang x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                </div>
                                <div style="font-size: 14px; font-weight: 700; color: var(--text-dark);">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Footer -->
                    <div class="order-card-footer">
                        <div style="font-size: 14px; color: var(--text-muted);">
                            Total Pesanan: <span class="total-price-text">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            <span style="font-size: 12px; margin-left: 6px;">({{ $order->payment_method }})</span>
                        </div>

                        <a href="{{ route('orders.show', $order->order_number) }}" class="btn-pink" style="padding: 8px 18px; font-size: 13px; border-radius: 10px;">
                            Lihat Rincian &rarr;
                        </a>
                    </div>
                </div>
            @endforeach

            <div style="margin-top: 24px; display: flex; justify-content: center;">
                {{ $orders->links() }}
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div style="background: #ffffff; border-radius: 20px; border: 1px solid #fce7ef; padding: 60px 20px; text-align: center;">
            <div style="font-size: 54px; margin-bottom: 12px;">📦</div>
            <h2 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 6px;">
                Belum Ada Riwayat Belanja
            </h2>
            <p style="font-size: 14px; color: var(--text-muted); margin-bottom: 24px;">
                @if(Auth::check())
                    Kamu belum memiliki transaksi pesanan di KiaBeauty Store.
                @else
                    Silakan masuk ke akunmu untuk melihat seluruh riwayat belanja.
                @endif
            </p>
            <div style="display: flex; gap: 12px; justify-content: center;">
                @guest
                    <a href="{{ route('login') }}" class="btn-pink-outline" style="padding: 10px 24px; border-radius: 12px;">Masuk Akun</a>
                @endguest
                <a href="{{ route('shop.index') }}" class="btn-pink" style="padding: 10px 24px; border-radius: 12px;">Mulai Belanja</a>
            </div>
        </div>
    @endif

@endsection
