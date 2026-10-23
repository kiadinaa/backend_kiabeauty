@extends('layout')

@section('title', 'Keranjang Belanja - KiaBeauty')

@section('styles')
<style>
    .cart-header-title {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--pink-dark);
        margin-bottom: 4px;
    }

    .cart-main-title {
        font-size: 32px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 4px;
    }

    .cart-subtitle {
        font-size: 14px;
        color: var(--text-muted);
        margin-bottom: 24px;
    }

    .cart-split-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        align-items: start;
    }

    /* ITEM CARD matching ReactBasic Cart.jsx */
    .cart-item-card {
        border-radius: 20px;
        border: 1px solid #fce7ef;
        background: #ffffff;
        padding: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: box-shadow 0.2s;
    }

    .cart-item-card:hover {
        box-shadow: 0 4px 12px rgba(168, 77, 112, 0.08);
    }

    .cart-img-box {
        width: 100px;
        height: 100px;
        border-radius: 14px;
        background: #FFF8FA;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        padding: 10px;
    }

    .cart-img-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .cart-item-info {
        flex: 1;
        min-width: 0;
    }

    .cart-item-brand {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--pink-dark);
        margin-bottom: 2px;
    }

    .cart-item-name {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 6px;
        line-height: 1.3;
    }

    .cart-item-price {
        font-size: 15px;
        font-weight: 700;
        color: var(--pink-dark);
        margin-bottom: 8px;
    }

    .cart-qty-inline {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .cart-qty-input-box {
        width: 70px;
        padding: 6px 10px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        text-align: center;
        font-weight: 700;
        font-size: 14px;
        outline: none;
    }

    .cart-item-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-between;
        gap: 16px;
        flex-shrink: 0;
    }

    .cart-item-subtotal {
        font-size: 17px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .btn-delete-item {
        background: transparent;
        border: none;
        color: #ef4444;
        font-size: 13px;
        font-weight: 600;
        padding: 6px 10px;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.15s;
    }

    .btn-delete-item:hover {
        background: #fee2e2;
    }

    /* SUMMARY CARD matching ReactBasic Cart.jsx */
    .cart-summary-panel {
        background: #ffffff;
        border: 1px solid #fce7ef;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        position: sticky;
        top: 90px;
    }

    .summary-heading {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 20px;
    }

    .summary-line {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 14px;
        color: var(--text-muted);
    }

    .summary-line strong {
        color: var(--text-dark);
    }

    .summary-divider {
        border-top: 1px solid #f1f5f9;
        padding-top: 16px;
        margin-top: 16px;
    }

    .btn-checkout-full {
        width: 100%;
        background-color: var(--pink-dark);
        color: #ffffff;
        font-size: 15px;
        font-weight: 600;
        padding: 14px;
        border-radius: 14px;
        border: none;
        cursor: pointer;
        display: block;
        text-align: center;
        margin-top: 20px;
        box-shadow: 0 4px 12px rgba(168, 77, 112, 0.25);
        transition: background-color 0.2s;
    }

    .btn-checkout-full:hover {
        background-color: var(--pink-darker);
    }

    /* Empty state matching ReactBasic */
    .empty-cart-wrap {
        min-height: 50vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 40px 20px;
    }

    @media (max-width: 768px) {
        .cart-split-grid {
            grid-template-columns: 1fr;
        }
        .cart-item-card {
            flex-direction: column;
            align-items: flex-start;
        }
        .cart-item-right {
            flex-direction: row;
            width: 100%;
            align-items: center;
            border-top: 1px solid #f1f5f9;
            padding-top: 10px;
        }
    }
</style>
@endsection

@section('content')

    @if(!empty($cart) && count($cart) > 0)
        <!-- Cart Header matching ReactBasic -->
        <div>
            <p class="cart-header-title">KiaBeauty Shopping Bag</p>
            <h1 class="cart-main-title">Keranjang Belanja</h1>
            <p class="cart-subtitle">{{ array_sum(array_column($cart, 'quantity')) }} produk ada di keranjangmu.</p>
        </div>

        <div class="cart-split-grid">
            <!-- Items Column -->
            <div>
                @foreach($cart as $id => $item)
                    <div class="cart-item-card">
                        <!-- Image -->
                        <div class="cart-img-box">
                            <img src="{{ str_starts_with($item['img'], 'http') ? $item['img'] : asset($item['img']) }}" alt="{{ $item['name'] }}">
                        </div>

                        <!-- Info -->
                        <div class="cart-item-info">
                            <p class="cart-item-brand">{{ $item['brand'] ?? 'KIABEAUTY' }}</p>
                            <h2 class="cart-item-name">
                                <a href="{{ route('shop.detail', $item['slug']) }}">{{ $item['name'] }}</a>
                            </h2>
                            <p class="cart-item-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>

                            <!-- Qty update form -->
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="cart-qty-inline">
                                @csrf
                                @method('PATCH')
                                <span style="font-size: 13px; color: var(--text-muted);">Jumlah:</span>
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="cart-qty-input-box" onchange="this.form.submit()">
                            </form>
                        </div>

                        <!-- Right subtotal & delete -->
                        <div class="cart-item-right">
                            <span class="cart-item-subtotal">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                            <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Hapus item ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete-item">
                                    🗑 Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summary Column matching ReactBasic -->
            <div class="cart-summary-panel">
                <h2 class="summary-heading">Ringkasan Pesanan</h2>

                <div class="summary-line">
                    <span>Total Produk</span>
                    <strong>{{ array_sum(array_column($cart, 'quantity')) }}</strong>
                </div>

                <div class="summary-line">
                    <span>Subtotal</span>
                    <strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
                </div>

                <div class="summary-line">
                    <span>Pengiriman</span>
                    <strong style="color: #16a34a;">GRATIS</strong>
                </div>

                <div class="summary-divider">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 16px; font-weight: 700; color: var(--text-dark);">Total</span>
                        <span style="font-size: 22px; font-weight: 800; color: var(--pink-dark);">
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <a href="{{ route('checkout.index') }}" class="btn-checkout-full">
                    Checkout &rarr;
                </a>

                <p style="text-align: center; font-size: 11px; color: var(--text-muted); margin-top: 14px;">
                    Secure & easy shopping with KiaBeauty
                </p>
            </div>
        </div>
    @else
        <!-- EMPTY CART matching ReactBasic Cart.jsx -->
        <div class="empty-cart-wrap">
            <div>
                <div style="font-size: 56px; margin-bottom: 12px;">🛍️</div>
                <h1 style="font-size: 24px; font-weight: 700; color: var(--text-dark); margin-bottom: 6px;">
                    Keranjangmu masih kosong
                </h1>
                <p style="font-size: 14px; color: var(--text-muted); margin-bottom: 24px;">
                    Yuk temukan produk beauty favoritmu!
                </p>
                <a href="{{ route('shop.index') }}" class="btn-pink" style="padding: 12px 28px; font-size: 14px; border-radius: 12px;">
                    Mulai Belanja
                </a>
            </div>
        </div>
    @endif

@endsection
