@extends('layout')

@section('title', 'Checkout Pesanan - KiaBeauty')

@section('styles')
<style>
    .checkout-split {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 28px;
        align-items: start;
    }

    .checkout-card {
        background: #ffffff;
        border: 1px solid #fce7ef;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        margin-bottom: 24px;
    }

    .card-title-head {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-row {
        margin-bottom: 16px;
    }

    .form-row label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }

    .form-input {
        width: 100%;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        padding: 12px 14px;
        font-size: 14px;
        font-family: inherit;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-input:focus {
        border-color: var(--pink-dark);
        box-shadow: 0 0 0 3px rgba(168, 77, 112, 0.15);
    }

    .payment-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .payment-option-pill {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
    }

    .payment-option-pill:hover {
        border-color: var(--pink-dark);
        background: #FFF8FA;
    }

    .payment-option-pill input[type="radio"] {
        accent-color: var(--pink-dark);
    }

    .item-mini-row {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f8fafc;
    }

    .item-mini-thumb {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        background: #FFF8FA;
        padding: 4px;
        object-fit: contain;
    }

    @media (max-width: 768px) {
        .checkout-split {
            grid-template-columns: 1fr;
        }
        .payment-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

    <div style="margin-bottom: 24px;">
        <p style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.15em; color: var(--pink-dark); margin-bottom: 4px;">
            KiaBeauty Checkout
        </p>
        <h1 style="font-size: 30px; font-weight: 700; color: var(--text-dark);">
            Selesaikan Pesanan
        </h1>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="checkout-split">
            <!-- Left Info Column -->
            <div>
                <!-- Shipping Address -->
                <div class="checkout-card">
                    <h2 class="card-title-head">
                        📍 Alamat & Kontak Penerima
                    </h2>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <div class="form-row">
                            <label for="customer_name">Nama Lengkap *</label>
                            <input type="text" id="customer_name" name="customer_name" class="form-input" value="{{ Auth::check() ? Auth::user()->name : old('customer_name') }}" placeholder="Contoh: Kiara Cantika" required>
                            @error('customer_name') <span style="color: #ef4444; font-size: 12px;">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-row">
                            <label for="customer_phone">No. WhatsApp / HP *</label>
                            <input type="text" id="customer_phone" name="customer_phone" class="form-input" value="{{ old('customer_phone', '081234567890') }}" placeholder="08xxxxxxxxxx" required>
                            @error('customer_phone') <span style="color: #ef4444; font-size: 12px;">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="shipping_address">Alamat Pengiriman Lengkap *</label>
                        <textarea id="shipping_address" name="shipping_address" rows="3" class="form-input" placeholder="Jalan, nomor rumah/kos, RT/RW, kelurahan, kecamatan, kota/kabupaten" required>{{ old('shipping_address') }}</textarea>
                        @error('shipping_address') <span style="color: #ef4444; font-size: 12px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-row" style="margin-bottom: 0;">
                        <label for="notes">Catatan Pesanan (Opsional)</label>
                        <input type="text" id="notes" name="notes" class="form-input" value="{{ old('notes') }}" placeholder="Contoh: Titipkan di satpam jika tidak ada orang di rumah">
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="checkout-card">
                    <h2 class="card-title-head">
                        💳 Metode Pembayaran
                    </h2>

                    <div class="payment-grid">
                        <label class="payment-option-pill">
                            <input type="radio" name="payment_method" value="Transfer BCA" checked>
                            <div>
                                <strong style="font-size: 13px; color: var(--text-dark); display: block;">Transfer BCA</strong>
                                <span style="font-size: 11px; color: var(--text-muted);">Virtual Account / Rekening</span>
                            </div>
                        </label>

                        <label class="payment-option-pill">
                            <input type="radio" name="payment_method" value="Transfer Mandiri">
                            <div>
                                <strong style="font-size: 13px; color: var(--text-dark); display: block;">Transfer Mandiri</strong>
                                <span style="font-size: 11px; color: var(--text-muted);">Livin / Mandiri VA</span>
                            </div>
                        </label>

                        <label class="payment-option-pill">
                            <input type="radio" name="payment_method" value="ShopeePay">
                            <div>
                                <strong style="font-size: 13px; color: var(--text-dark); display: block;">ShopeePay</strong>
                                <span style="font-size: 11px; color: var(--text-muted);">QRIS & Saldo Shopee</span>
                            </div>
                        </label>

                        <label class="payment-option-pill">
                            <input type="radio" name="payment_method" value="COD (Bayar di Tempat)">
                            <div>
                                <strong style="font-size: 13px; color: var(--text-dark); display: block;">COD (Bayar di Tempat)</strong>
                                <span style="font-size: 11px; color: var(--text-muted);">Bayar tunai saat kurir tiba</span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Right Summary Column -->
            <div class="checkout-card" style="position: sticky; top: 90px;">
                <h2 class="card-title-head">
                    🛍️ Rincian Pesanan
                </h2>

                <div style="max-height: 220px; overflow-y: auto; margin-bottom: 16px;">
                    @foreach($cart as $item)
                        <div class="item-mini-row">
                            <img src="{{ str_starts_with($item['img'], 'http') ? $item['img'] : asset($item['img']) }}" class="item-mini-thumb" alt="{{ $item['name'] }}">
                            <div style="flex: 1; min-width: 0;">
                                <div style="font-size: 13px; font-weight: 600; color: var(--text-dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $item['name'] }}</div>
                                <div style="font-size: 12px; color: var(--text-muted);">{{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                            </div>
                            <div style="font-size: 13px; font-weight: 700; color: var(--pink-dark);">
                                Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="border-top: 1px solid #f1f5f9; padding-top: 14px;">
                    <div style="display: flex; justify-content: space-between; font-size: 13px; color: var(--text-muted); margin-bottom: 8px;">
                        <span>Subtotal Produk</span>
                        <strong style="color: var(--text-dark);">Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; font-size: 13px; color: var(--text-muted); margin-bottom: 12px;">
                        <span>Pengiriman</span>
                        <strong style="color: #16a34a;">GRATIS</strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px dashed #fce7ef; padding-top: 14px; margin-top: 10px;">
                        <span style="font-size: 15px; font-weight: 700; color: var(--text-dark);">Total Bayar</span>
                        <span style="font-size: 20px; font-weight: 800; color: var(--pink-dark);">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn-pink" style="width: 100%; padding: 14px; border-radius: 14px; font-size: 15px; margin-top: 20px; box-shadow: 0 4px 14px rgba(168, 77, 112, 0.25);">
                    ✓ Konfirmasi Pesanan
                </button>
            </div>
        </div>
    </form>

@endsection
