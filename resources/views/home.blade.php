@extends('layout')

@section('title', 'KiaBeauty - Beauty, Made Simple')

@section('styles')
<style>
    /* HERO PROMO matching ReactBasic Dashboard.jsx */
    .hero-section {
        position: relative;
        overflow: hidden;
        border-radius: 24px;
        background: linear-gradient(135deg, #F8D7E2 0%, #FCE7EF 50%, #FFF5F8 100%);
        padding: 40px 32px;
        box-shadow: 0 2px 8px rgba(168, 77, 112, 0.08);
        margin-bottom: 32px;
        border: 1px solid #fecdd3;
    }

    .hero-content {
        position: relative;
        z-index: 10;
        max-width: 640px;
    }

    .hero-tag {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--pink-dark);
        margin-bottom: 12px;
        display: block;
    }

    .hero-title {
        font-size: 42px;
        font-weight: 700;
        line-height: 1.2;
        color: var(--text-dark);
        margin-bottom: 16px;
    }

    .hero-title span {
        display: block;
        color: var(--pink-dark);
        margin-top: 6px;
    }

    .hero-desc {
        font-size: 15px;
        line-height: 1.6;
        color: var(--text-sub);
        margin-bottom: 8px;
    }

    .hero-note {
        font-size: 12px;
        color: #8B6875;
        margin-bottom: 24px;
    }

    /* Decorative circles */
    .hero-circle-1 {
        position: absolute;
        top: -64px;
        right: -64px;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
        pointer-events: none;
    }

    .hero-circle-2 {
        position: absolute;
        bottom: -96px;
        right: 80px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(233, 175, 194, 0.3);
        pointer-events: none;
    }

    /* KATEGORI CEPAT */
    .quick-categories {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        background: #FFF8FA;
        border: 1px solid #fce7ef;
        border-radius: 20px;
        padding: 18px;
        margin-bottom: 40px;
    }

    .quick-cat-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        border-radius: 14px;
        padding: 10px;
        text-align: center;
        transition: background 0.2s;
    }

    .quick-cat-card:hover {
        background: #ffffff;
        box-shadow: 0 2px 6px rgba(168, 77, 112, 0.08);
    }

    .quick-cat-icon {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        background: #FCE7EF;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        transition: transform 0.2s;
    }

    .quick-cat-card:hover .quick-cat-icon {
        transform: scale(1.08);
    }

    .quick-cat-label {
        font-size: 13px;
        font-weight: 600;
        color: #4B3A40;
    }

    /* SECTION HEADERS */
    .section-head {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 20px;
        gap: 16px;
        flex-wrap: wrap;
    }

    .section-subtitle {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--pink-dark);
    }

    .section-main-title {
        font-size: 26px;
        font-weight: 700;
        color: var(--text-dark);
        margin-top: 4px;
    }

    .section-desc {
        font-size: 14px;
        color: var(--text-muted);
        margin-top: 2px;
    }

    .section-link {
        font-size: 14px;
        font-weight: 700;
        color: var(--pink-dark);
    }

    .section-link:hover {
        text-decoration: underline;
    }

    /* PRODUCT GRID */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 24px;
        margin-bottom: 48px;
    }

    /* PRODUCT CARD matching ProductCard.jsx */
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

    /* PROMO INFORMASI BANNER */
    .banner-routine {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        background: #FFF1F5;
        border: 1px solid #fce7ef;
        border-radius: 20px;
        padding: 28px 32px;
        margin-top: 16px;
        flex-wrap: wrap;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 30px;
        }
        .quick-categories {
            grid-template-columns: repeat(2, 1fr);
        }
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
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

    <!-- HERO PROMO matching ReactBasic Dashboard.jsx -->
    <section class="hero-section">
        <div class="hero-content">
            <span class="hero-tag">KiaBeauty Special</span>
            <h1 class="hero-title">
                Spesial Akhir Bulan
                <span>Diskon 15%</span>
            </h1>
            <p class="hero-desc">
                Saatnya manjakan dirimu! Temukan makeup dan skincare favoritmu dengan penawaran spesial dari KiaBeauty.
            </p>
            <p class="hero-note">
                Promo simulasi untuk demonstrasi aplikasi.
            </p>
            <a href="{{ route('shop.index') }}" class="btn-pink" style="padding: 12px 28px; font-size: 15px; border-radius: 14px;">
                Belanja Sekarang &rarr;
            </a>
        </div>

        <div class="hero-circle-1"></div>
        <div class="hero-circle-2"></div>
    </section>

    <!-- KATEGORI CEPAT matching ReactBasic Dashboard.jsx -->
    <section class="quick-categories">
        <a href="{{ route('shop.index', ['category' => 'Makeup']) }}" class="quick-cat-card">
            <div class="quick-cat-icon">✨</div>
            <span class="quick-cat-label">Makeup</span>
        </a>

        <a href="{{ route('shop.index', ['category' => 'Skincare']) }}" class="quick-cat-card">
            <div class="quick-cat-icon">💧</div>
            <span class="quick-cat-label">Skincare</span>
        </a>

        <a href="{{ route('shop.index', ['discount_only' => 1]) }}" class="quick-cat-card">
            <div class="quick-cat-icon">🏷️</div>
            <span class="quick-cat-label">Promo</span>
        </a>

        <a href="{{ route('contact') }}" class="quick-cat-card">
            <div class="quick-cat-icon">💬</div>
            <span class="quick-cat-label">Bantuan</span>
        </a>
    </section>

    <!-- PRODUK PILIHAN matching ReactBasic Dashboard.jsx -->
    <section>
        <div class="section-head">
            <div>
                <p class="section-subtitle">Pilihan untukmu</p>
                <h2 class="section-main-title">Produk Pilihan</h2>
                <p class="section-desc">Temukan produk kecantikan favoritmu.</p>
            </div>
            <a href="{{ route('shop.index') }}" class="section-link">
                Lihat Semua &rarr;
            </a>
        </div>

        <div class="products-grid">
            @foreach($featuredProducts as $product)
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
    </section>

    <!-- PROMO INFORMASI matching ReactBasic Dashboard.jsx -->
    <section class="banner-routine">
        <div>
            <p style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.15em; color: var(--pink-dark); margin-bottom: 4px;">
                Beauty Made Simple
            </p>
            <h2 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 4px;">
                Temukan rutinitas kecantikanmu
            </h2>
            <p style="font-size: 14px; color: var(--text-sub);">
                Jelajahi pilihan makeup dan skincare dalam satu tempat.
            </p>
        </div>

        <a href="{{ route('shop.index') }}" class="btn-pink-outline" style="border-radius: 14px; font-weight: 700;">
            Jelajahi Produk &rarr;
        </a>
    </section>

@endsection
