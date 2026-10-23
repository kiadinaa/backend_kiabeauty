@extends('layout')

@section('title', $product->name . ' - KiaBeauty')

@section('styles')
<style>
    /* BREADCRUMB matching ReactBasic ProductDetail.jsx */
    .breadcrumb-row {
        font-size: 13px;
        color: var(--text-muted);
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .breadcrumb-row a:hover {
        color: var(--pink-dark);
    }

    /* MAIN DETAIL GRID */
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 36px;
        margin-bottom: 48px;
        align-items: center;
    }

    .detail-img-wrapper {
        min-height: 480px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 24px;
        background: #FFF8FA;
        border: 1px solid #fce7ef;
        padding: 32px;
        position: relative;
    }

    .detail-img-wrapper img {
        max-height: 420px;
        max-width: 100%;
        object-fit: contain;
    }

    .detail-badge-discount {
        position: absolute;
        top: 16px;
        left: 16px;
        background: #e11d48;
        color: #ffffff;
        font-size: 12px;
        font-weight: 800;
        padding: 6px 14px;
        border-radius: 999px;
    }

    .detail-info-block {
        display: flex;
        flex-direction: column;
    }

    .brand-title-tag {
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: var(--pink-dark);
        margin-bottom: 8px;
    }

    .product-headline {
        font-size: 34px;
        font-weight: 700;
        line-height: 1.25;
        color: var(--text-dark);
        margin-bottom: 14px;
    }

    .detail-rating-strip {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .rating-stars-lg {
        color: #eab308;
        font-size: 18px;
        letter-spacing: 2px;
    }

    .rating-score-text {
        font-size: 14px;
        color: var(--text-muted);
    }

    .detail-price-text {
        font-size: 32px;
        font-weight: 700;
        color: var(--pink-dark);
        margin-bottom: 4px;
    }

    .original-price-strike {
        font-size: 15px;
        color: #9ca3af;
        text-decoration: line-through;
        margin-bottom: 8px;
    }

    .stock-status-pill {
        margin-top: 12px;
        margin-bottom: 24px;
        font-size: 14px;
    }

    .stock-available {
        color: #16a34a;
        font-weight: 600;
    }

    .stock-warning {
        color: #ea580c;
        font-weight: 600;
    }

    .stock-empty {
        color: #dc2626;
        font-weight: 600;
    }

    .about-product-box {
        border-top: 1px solid #f1f5f9;
        padding-top: 20px;
        margin-bottom: 24px;
    }

    .about-heading {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .about-text {
        font-size: 14px;
        line-height: 1.7;
        color: var(--text-sub);
    }

    /* Qty Stepper matching ReactBasic */
    .qty-stepper-wrap {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
    }

    .qty-stepper-box {
        display: flex;
        align-items: center;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        background: #ffffff;
    }

    .btn-step {
        background: #ffffff;
        border: none;
        padding: 8px 16px;
        font-size: 18px;
        cursor: pointer;
        color: var(--text-dark);
        transition: background 0.15s;
    }

    .btn-step:hover {
        background: #f8fafc;
    }

    .qty-display-input {
        width: 50px;
        text-align: center;
        border: none;
        font-size: 15px;
        font-weight: 700;
        outline: none;
    }

    .btn-add-to-cart-large {
        width: 100%;
        background-color: var(--pink-dark);
        color: #ffffff;
        font-size: 16px;
        font-weight: 600;
        padding: 16px 24px;
        border-radius: 14px;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s, transform 0.15s;
        box-shadow: 0 4px 14px rgba(168, 77, 112, 0.25);
    }

    .btn-add-to-cart-large:hover {
        background-color: var(--pink-darker);
        transform: translateY(-1px);
    }

    /* REVIEWS SECTION GRID matching ReactBasic ProductDetail.jsx */
    .reviews-split-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-top: 16px;
    }

    .review-card-panel {
        background: #ffffff;
        border: 1px solid #fce7ef;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }

    .panel-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 4px;
    }

    .panel-subtitle {
        font-size: 13px;
        color: var(--text-muted);
        margin-bottom: 20px;
    }

    .star-picker {
        display: flex;
        gap: 6px;
        margin-top: 8px;
        margin-bottom: 18px;
    }

    .star-btn {
        background: none;
        border: none;
        font-size: 32px;
        color: #d1d5db;
        cursor: pointer;
        padding: 0;
        line-height: 1;
        transition: color 0.15s, transform 0.15s;
    }

    .star-btn.active, .star-btn:hover {
        color: #eab308;
        transform: scale(1.1);
    }

    .review-textarea {
        width: 100%;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        padding: 12px 14px;
        font-size: 14px;
        font-family: inherit;
        outline: none;
        resize: vertical;
        transition: border-color 0.2s, box-shadow 0.2s;
        margin-top: 6px;
        margin-bottom: 16px;
    }

    .review-textarea:focus {
        border-color: var(--pink-dark);
        box-shadow: 0 0 0 3px rgba(168, 77, 112, 0.15);
    }

    .review-item-box {
        border: 1px solid #f1f5f9;
        border-radius: 14px;
        padding: 16px;
        margin-bottom: 12px;
        background: #ffffff;
    }

    .review-item-author {
        font-size: 13px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 4px;
        display: flex;
        justify-content: space-between;
    }

    @media (max-width: 768px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
        .detail-img-wrapper {
            min-height: 320px;
            padding: 20px;
        }
        .product-headline {
            font-size: 24px;
        }
        .reviews-split-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

    <!-- BREADCRUMB matching ReactBasic -->
    <div class="breadcrumb-row">
        <a href="{{ route('home') }}">Home</a>
        <span>/</span>
        <a href="{{ route('shop.index', ['category' => $product->category->category ?? '']) }}">{{ $product->category->category ?? 'Produk' }}</a>
        <span>/</span>
        <span style="color: var(--pink-dark); font-weight: 600;">{{ $product->name }}</span>
    </div>

    <!-- MAIN PRODUCT DETAIL -->
    <section class="detail-grid">
        <!-- Image Box -->
        <div class="detail-img-wrapper">
            @if($product->has_discount)
                <span class="detail-badge-discount">-{{ $product->discount_percent }}% Promo</span>
            @endif
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
        </div>

        <!-- Info Block -->
        <div class="detail-info-block">
            <span class="brand-title-tag">{{ $product->brand ?: 'KIABEAUTY' }}</span>
            <h1 class="product-headline">{{ $product->name }}</h1>

            <div class="detail-rating-strip">
                <span class="rating-stars-lg">★★★★★</span>
                <span class="rating-score-text">{{ $product->rating_average }} / 5 ({{ $product->reviews_count }} ulasan)</span>
            </div>

            @if($product->has_discount)
                <div class="original-price-strike">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
            @endif
            <div class="detail-price-text">Rp {{ number_format($product->final_price, 0, ',', '.') }}</div>

            <!-- Stock Status -->
            <div class="stock-status-pill">
                @if($product->stock > 5)
                    <span class="stock-available">✓ Stok tersedia ({{ $product->stock }} produk)</span>
                @elseif($product->stock > 0)
                    <span class="stock-warning">⚠ Stok terbatas — tersisa {{ $product->stock }} produk</span>
                @else
                    <span class="stock-empty">✕ Produk habis</span>
                @endif
            </div>

            <!-- Description -->
            <div class="about-product-box">
                <h2 class="about-heading">Tentang Produk</h2>
                <p class="about-text">
                    {{ $product->description ?: $product->name . ' dari ' . ($product->brand ?: 'KiaBeauty') . ' merupakan salah satu pilihan produk kecantikan terbaik yang tersedia di KiaBeauty. Diformulasikan secara aman dan terdaftar resmi BPOM.' }}
                </p>
            </div>

            <!-- Form Add to Cart with Stepper -->
            @if($product->stock > 0)
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">

                    <div class="qty-stepper-wrap">
                        <span style="font-size: 14px; font-weight: 600; color: #475569;">Jumlah</span>
                        <div class="qty-stepper-box">
                            <button type="button" class="btn-step" onclick="var q = document.getElementById('qtyInput'); if(parseInt(q.value) > 1) q.value = parseInt(q.value) - 1;">−</button>
                            <input type="number" id="qtyInput" name="quantity" class="qty-display-input" value="1" min="1" max="{{ $product->stock }}" readonly>
                            <button type="button" class="btn-step" onclick="var q = document.getElementById('qtyInput'); if(parseInt(q.value) < {{ $product->stock }}) q.value = parseInt(q.value) + 1;">+</button>
                        </div>
                    </div>

                    <button type="submit" class="btn-add-to-cart-large">
                        🛍️ Tambah ke Keranjang
                    </button>
                </form>
            @else
                <button disabled class="btn-add-to-cart-large" style="background: #9ca3af; cursor: not-allowed; box-shadow: none;">
                    Produk Habis
                </button>
            @endif
        </div>
    </section>

    <!-- REVIEWS SECTION matching ReactBasic ProductDetail.jsx -->
    <section class="reviews-split-grid">
        <!-- Customer Reviews List -->
        <div class="review-card-panel">
            <h2 class="panel-title">Customer Reviews</h2>
            <p class="panel-subtitle">Pengalaman pembeli yang telah menggunakan produk ini.</p>

            @if($product->reviews->count() > 0)
                <div style="max-height: 400px; overflow-y: auto;">
                    @foreach($product->reviews as $rev)
                        <div class="review-item-box">
                            <div class="review-item-author">
                                <span>{{ $rev->user_name }}</span>
                                <span style="font-size: 11px; font-weight: 400; color: var(--text-muted);">{{ $rev->created_at->diffForHumans() }}</span>
                            </div>
                            <div style="color: #eab308; font-size: 13px; margin-bottom: 6px;">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $rev->rating ? '★' : '☆' }}
                                @endfor
                            </div>
                            <p style="font-size: 13px; color: var(--text-sub); line-height: 1.6;">
                                {{ $rev->comment }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="background: #FFF8FA; border-radius: 14px; padding: 32px 16px; text-align: center;">
                    <div style="font-size: 32px; margin-bottom: 8px;">💬</div>
                    <p style="font-size: 14px; font-weight: 600; color: var(--text-dark);">Belum ada review.</p>
                    <p style="font-size: 12px; color: var(--text-muted); margin-top: 2px;">Jadilah orang pertama yang memberikan review.</p>
                </div>
            @endif
        </div>

        <!-- Review Form -->
        <div class="review-card-panel">
            <h2 class="panel-title">Tulis Review</h2>
            <p class="panel-subtitle">Bagikan pengalamanmu menggunakan produk ini.</p>

            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                <input type="hidden" name="rating" id="selectedRating" value="5">

                <!-- Interactive Star Picker matching ReactBasic -->
                <label style="font-size: 13px; font-weight: 600; color: #374151; display: block;">Rating</label>
                <div class="star-picker" id="starPicker">
                    <button type="button" class="star-btn active" data-val="1">★</button>
                    <button type="button" class="star-btn active" data-val="2">★</button>
                    <button type="button" class="star-btn active" data-val="3">★</button>
                    <button type="button" class="star-btn active" data-val="4">★</button>
                    <button type="button" class="star-btn active" data-val="5">★</button>
                </div>

                @guest
                    <div style="margin-bottom: 12px;">
                        <label for="user_name" style="font-size: 13px; font-weight: 600; color: #374151; display: block; margin-bottom: 4px;">Nama Anda</label>
                        <input type="text" id="user_name" name="user_name" placeholder="Masukkan nama Anda" required style="width: 100%; padding: 10px 14px; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 14px; outline: none;">
                    </div>
                @endguest

                <label for="reviewComment" style="font-size: 13px; font-weight: 600; color: #374151; display: block;">Review</label>
                <textarea id="reviewComment" name="comment" rows="4" class="review-textarea" placeholder="Tulis pengalaman kamu menggunakan produk ini..." required></textarea>

                <button type="submit" class="btn-pink" style="padding: 12px 24px;">
                    Kirim Review
                </button>
            </form>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    // Interactive 5-star selector matching ReactBasic
    const stars = document.querySelectorAll('#starPicker .star-btn');
    const inputRating = document.getElementById('selectedRating');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const val = parseInt(this.getAttribute('data-val'));
            inputRating.value = val;
            stars.forEach(s => {
                if (parseInt(s.getAttribute('data-val')) <= val) {
                    s.classList.add('active');
                } else {
                    s.classList.remove('active');
                }
            });
        });
    });
</script>
@endsection
