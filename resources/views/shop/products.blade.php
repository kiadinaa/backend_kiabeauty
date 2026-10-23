@extends('layout')

@section('title', 'Kategori Produk - KiaBeauty Marketplace')

@section('styles')
<style>
    .catalog-header {
        margin-bottom: 28px;
    }

    .catalog-tag {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--pink-dark);
        margin-bottom: 6px;
        display: block;
    }

    .catalog-title {
        font-size: 32px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 6px;
    }

    .catalog-subtitle {
        font-size: 14px;
        color: var(--text-muted);
    }

    /* Filter Box matching ReactBasic Products.jsx */
    .filter-box-wrap {
        border-radius: 18px;
        border: 1px solid #fce7ef;
        background: #FFF8FA;
        padding: 16px;
        margin-bottom: 24px;
    }

    .filter-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .filter-select {
        width: 100%;
        border-radius: 12px;
        border: 1px solid #fce7ef;
        background: #ffffff;
        padding: 12px 16px;
        font-size: 14px;
        font-family: inherit;
        color: var(--text-dark);
        outline: none;
        cursor: pointer;
        transition: border-color 0.2s;
    }

    .filter-select:focus {
        border-color: var(--pink-dark);
    }

    .results-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 24px;
        font-size: 14px;
        color: var(--text-muted);
        flex-wrap: wrap;
    }

    .results-count {
        font-weight: 700;
        color: var(--pink-dark);
    }

    .btn-reset-filter {
        font-size: 13px;
        font-weight: 700;
        color: var(--pink-dark);
        background: transparent;
        border: none;
        cursor: pointer;
        text-decoration: underline;
    }

    /* Product Grid & Cards */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .product-item-card {
        border-radius: 20px;
        border: 1px solid #fce7ef;
        background: #ffffff;
        box-shadow: 0 1px 4px rgba(0,0,0,0.03);
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        display: flex;
        flex-direction: column;
    }

    .product-item-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 28px rgba(168, 77, 112, 0.12);
        border-color: #f5c5d6;
    }

    .product-img-box {
        position: relative;
        height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #FFF8FA;
        padding: 20px;
    }

    .product-img-box img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.4s;
    }

    .product-item-card:hover .product-img-box img {
        transform: scale(1.06);
    }

    .badge-cat-tag {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #ffffff;
        color: var(--pink-dark);
        font-size: 11px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 999px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        z-index: 2;
    }

    .badge-stock-tag {
        position: absolute;
        top: 12px;
        right: 12px;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 999px;
        z-index: 2;
    }

    .badge-stock-low {
        background: #FDE68A;
        color: #92400E;
    }

    .badge-discount-promo {
        background: #e11d48;
        color: #ffffff;
    }

    .product-content-box {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .product-brand {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--pink-dark);
        margin-bottom: 4px;
    }

    .product-name {
        font-size: 15px;
        font-weight: 600;
        color: var(--text-dark);
        line-height: 1.4;
        min-height: 44px;
        margin-bottom: 8px;
    }

    .product-name a:hover {
        color: var(--pink-dark);
    }

    .rating-row {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 12px;
    }

    .rating-stars {
        color: #eab308;
        font-size: 13px;
        letter-spacing: 1px;
    }

    .rating-num {
        font-size: 12px;
        color: var(--text-muted);
    }

    .price-row {
        margin-top: auto;
        margin-bottom: 14px;
    }

    .original-price {
        font-size: 12px;
        color: #9ca3af;
        text-decoration: line-through;
        margin-bottom: 2px;
    }

    .final-price {
        font-size: 20px;
        font-weight: 800;
        color: var(--pink-dark);
    }

    .stock-info {
        font-size: 12px;
        color: var(--text-muted);
        margin-bottom: 14px;
    }

    .card-actions-row {
        display: flex;
        gap: 8px;
    }

    .btn-card-detail {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #D98BA7;
        border-radius: 12px;
        padding: 9px 12px;
        font-size: 13px;
        font-weight: 600;
        color: var(--pink-dark);
        background: transparent;
        transition: background 0.2s;
    }

    .btn-card-detail:hover {
        background: #FFF1F5;
    }

    .btn-card-cart {
        border-radius: 12px;
        background-color: var(--pink-dark);
        color: #ffffff;
        border: none;
        padding: 9px 14px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-card-cart:hover {
        background-color: var(--pink-darker);
    }

    /* Empty State */
    .empty-state-box {
        border-radius: 20px;
        border: 2px dashed #fce7ef;
        background: #FFF8FA;
        padding: 64px 20px;
        text-align: center;
    }

    @media (max-width: 640px) {
        .filter-grid-2 {
            grid-template-columns: 1fr;
        }
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .product-img-box {
            height: 180px;
            padding: 12px;
        }
        .product-content-box {
            padding: 14px;
        }
        .product-name {
            font-size: 13px;
            min-height: 38px;
        }
        .final-price {
            font-size: 17px;
        }
    }
</style>
@endsection

@section('content')

    <!-- Header Section -->
    <div class="catalog-header">
        <span class="catalog-tag">KiaBeauty Marketplace</span>
        <h1 class="catalog-title">Kategori Produk</h1>
        <p class="catalog-subtitle">Cari dan temukan makeup serta skincare yang sesuai kebutuhanmu.</p>
    </div>

    <!-- Filter Box matching ReactBasic -->
    <div class="filter-box-wrap">
        <form action="{{ route('shop.index') }}" method="GET" id="filterForm" class="filter-grid-2">
            @if(request('q'))
                <input type="hidden" name="q" value="{{ request('q') }}">
            @endif

            <select name="category" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="All" {{ $category === 'All' ? 'selected' : '' }}>Semua Kategori</option>
                <option value="Makeup" {{ $category === 'Makeup' ? 'selected' : '' }}>Makeup</option>
                <option value="Skincare" {{ $category === 'Skincare' ? 'selected' : '' }}>Skincare</option>
            </select>

            <select name="sort" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="default" {{ $sort === 'default' ? 'selected' : '' }}>Urutan Default</option>
                <option value="low" {{ $sort === 'low' ? 'selected' : '' }}>Harga Terendah</option>
                <option value="high" {{ $sort === 'high' ? 'selected' : '' }}>Harga Tertinggi</option>
                <option value="rating" {{ $sort === 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                <option value="discount" {{ $sort === 'discount' ? 'selected' : '' }}>Diskon Terbesar</option>
            </select>
        </form>
    </div>

    <!-- Results Status Bar -->
    <div class="results-bar">
        <p>
            Menampilkan <span class="results-count">{{ $products->total() }}</span> produk
            @if(!empty($search))
                untuk pencarian <strong style="color: var(--text-dark);">"{{ $search }}"</strong>
            @endif
            @if($category !== 'All')
                dalam kategori <strong style="color: var(--pink-dark);">{{ $category }}</strong>
            @endif
        </p>

        @if(!empty($search) || $category !== 'All' || $sort !== 'default' || request('discount_only'))
            <a href="{{ route('shop.index') }}" class="btn-reset-filter">
                Reset Filter
            </a>
        @endif
    </div>

    <!-- Product Grid -->
    @if($products->count() > 0)
        <div class="products-grid">
            @foreach($products as $product)
                <div class="product-item-card">
                    <!-- Image -->
                    <div class="product-img-box">
                        <span class="badge-cat-tag">{{ $product->category->category ?? 'Beauty' }}</span>

                        @if($product->has_discount)
                            <span class="badge-stock-tag badge-discount-promo">-{{ $product->discount_percent }}%</span>
                        @elseif($product->stock <= 5 && $product->stock > 0)
                            <span class="badge-stock-tag badge-stock-low">Stok Terbatas</span>
                        @elseif($product->stock <= 0)
                            <span class="badge-stock-tag" style="background: #1f2937; color: white;">Habis</span>
                        @endif

                        <a href="{{ route('shop.detail', $product->slug) }}" style="display: flex; height: 100%; width: 100%; align-items: center; justify-content: center;">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy">
                        </a>
                    </div>

                    <!-- Content -->
                    <div class="product-content-box">
                        <p class="product-brand">{{ $product->brand ?: 'KIABEAUTY' }}</p>
                        <h3 class="product-name">
                            <a href="{{ route('shop.detail', $product->slug) }}">{{ $product->name }}</a>
                        </h3>

                        <div class="rating-row">
                            <span class="rating-stars">★★★★★</span>
                            <span class="rating-num">{{ $product->rating_average }} ({{ $product->reviews_count }})</span>
                        </div>

                        <div class="price-row">
                            @if($product->has_discount)
                                <div class="original-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            @endif
                            <div class="final-price">Rp {{ number_format($product->final_price, 0, ',', '.') }}</div>
                        </div>

                        <p class="stock-info">
                            {{ $product->stock <= 0 ? 'Produk sedang tidak tersedia' : $product->stock . ' produk tersisa' }}
                        </p>

                        <div class="card-actions-row">
                            <a href="{{ route('shop.detail', $product->slug) }}" class="btn-card-detail">
                                Lihat Detail
                            </a>

                            @if($product->stock > 0)
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-card-cart" title="Tambah ke Keranjang">
                                        🛍️
                                    </button>
                                </form>
                            @else
                                <button disabled class="btn-card-cart" style="background: #d1d5db; cursor: not-allowed;">
                                    Habis
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="margin-top: 24px; display: flex; justify-content: center;">
            {{ $products->links() }}
        </div>
    @else
        <!-- Empty State matching ReactBasic -->
        <div class="empty-state-box">
            <div style="font-size: 40px; color: var(--pink-dark); margin-bottom: 8px;">⌕</div>
            <h2 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 6px;">
                Produk tidak ditemukan
            </h2>
            <p style="font-size: 14px; color: var(--text-muted); margin-bottom: 20px;">
                Coba kata kunci atau kategori lainnya.
            </p>
            <a href="{{ route('shop.index') }}" class="btn-pink">
                Tampilkan Semua Produk
            </a>
        </div>
    @endif

@endsection
