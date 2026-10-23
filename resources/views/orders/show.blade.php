@extends('layout')

@section('title', 'Rincian Pesanan #' . $order->order_number . ' - KiaBeauty')

@section('styles')
<style>
    .order-invoice-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid #fce7ef;
        padding: 32px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.03);
    }

    .invoice-top-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 20px;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .tracker-steps {
        display: flex;
        justify-content: space-between;
        background: #FFF8FA;
        border: 1px solid #fce7ef;
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 32px;
    }

    .tracker-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        text-align: center;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-muted);
        flex: 1;
    }

    .tracker-step.active {
        color: var(--pink-dark);
        font-weight: 700;
    }

    .tracker-icon-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .tracker-step.active .tracker-icon-circle {
        background: var(--pink-dark);
        color: #ffffff;
    }

    .invoice-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 28px;
    }

    .invoice-info-box {
        background: #FFF8FA;
        border: 1px solid #fce7ef;
        border-radius: 16px;
        padding: 20px;
    }

    .table-clean {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 24px;
    }

    .table-clean th {
        text-align: left;
        padding: 12px;
        background: #FFF8FA;
        color: var(--text-dark);
        font-size: 13px;
        font-weight: 700;
        border-bottom: 1px solid #fce7ef;
    }

    .table-clean td {
        padding: 14px 12px;
        border-bottom: 1px solid #f8fafc;
        font-size: 14px;
    }

    @media (max-width: 640px) {
        .invoice-grid {
            grid-template-columns: 1fr;
        }
        .tracker-steps {
            flex-direction: column;
            gap: 16px;
        }
    }
</style>
@endsection

@section('content')

    <div style="font-size: 13px; color: var(--text-muted); margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
        <a href="{{ route('home') }}">Home</a> &rsaquo;
        <a href="{{ route('orders.index') }}">Daftar Belanja</a> &rsaquo;
        <span style="color: var(--pink-dark); font-weight: 600;">#{{ $order->order_number }}</span>
    </div>

    <div class="order-invoice-card">
        <div class="invoice-top-bar">
            <div>
                <h1 style="font-size: 24px; font-weight: 700; color: var(--text-dark);">
                    Pesanan #{{ $order->order_number }}
                </h1>
                <p style="font-size: 13px; color: var(--text-muted); margin-top: 2px;">
                    Dibuat pada {{ $order->created_at->format('d F Y, H:i') }} WIB
                </p>
            </div>
            <div>
                <span style="font-size: 13px; font-weight: 700; padding: 6px 14px; border-radius: 999px; background: #dcfce7; color: #15803d; text-transform: uppercase;">
                    Status: {{ $order->status }}
                </span>
            </div>
        </div>

        <!-- Tracking Tracker -->
        <div class="tracker-steps">
            <div class="tracker-step active">
                <div class="tracker-icon-circle">✓</div>
                <span>Pesanan Dibuat</span>
            </div>
            <div class="tracker-step active">
                <div class="tracker-icon-circle">💳</div>
                <span>Pembayaran Sukses</span>
            </div>
            <div class="tracker-step {{ in_array($order->status, ['diproses', 'dikirim', 'selesai']) ? 'active' : '' }}">
                <div class="tracker-icon-circle">📦</div>
                <span>Sedang Dikemas</span>
            </div>
            <div class="tracker-step {{ in_array($order->status, ['dikirim', 'selesai']) ? 'active' : '' }}">
                <div class="tracker-icon-circle">🚚</div>
                <span>Dalam Pengiriman</span>
            </div>
            <div class="tracker-step {{ $order->status === 'selesai' ? 'active' : '' }}">
                <div class="tracker-icon-circle">✨</div>
                <span>Selesai</span>
            </div>
        </div>

        <!-- Info Grid -->
        <div class="invoice-grid">
            <div class="invoice-info-box">
                <h3 style="font-size: 14px; font-weight: 700; color: var(--text-dark); margin-bottom: 10px;">📍 Alamat Penerima</h3>
                <p style="font-size: 13px; color: var(--text-dark); margin-bottom: 4px;"><strong>{{ $order->customer_name }}</strong> ({{ $order->customer_phone }})</p>
                <p style="font-size: 13px; color: var(--text-sub); line-height: 1.6;">{{ $order->shipping_address }}</p>
                @if($order->notes)
                    <p style="font-size: 12px; color: #b45309; margin-top: 8px;"><strong>Catatan:</strong> {{ $order->notes }}</p>
                @endif
            </div>

            <div class="invoice-info-box">
                <h3 style="font-size: 14px; font-weight: 700; color: var(--text-dark); margin-bottom: 10px;">💳 Rincian Pembayaran</h3>
                <p style="font-size: 13px; color: var(--text-dark); margin-bottom: 4px;">Metode: <strong>{{ $order->payment_method }}</strong></p>
                <p style="font-size: 13px; color: #16a34a; font-weight: 600;">Status: Lunas / Terverifikasi</p>
                <p style="font-size: 12px; color: var(--text-muted); margin-top: 8px;">Biaya Pengiriman: <strong>GRATIS</strong></p>
            </div>
        </div>

        <!-- Table of Items -->
        <table class="table-clean">
            <thead>
                <tr>
                    <th>PRODUK</th>
                    <th style="text-align: center;">HARGA SATUAN</th>
                    <th style="text-align: center;">JUMLAH</th>
                    <th style="text-align: right;">SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>
                            <strong style="color: var(--text-dark);">{{ $item->product_name }}</strong>
                        </td>
                        <td style="text-align: center;">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </td>
                        <td style="text-align: center;">
                            {{ $item->quantity }}
                        </td>
                        <td style="text-align: right; font-weight: 700; color: var(--pink-dark);">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Box -->
        <div style="display: flex; justify-content: flex-end; margin-bottom: 28px;">
            <div style="width: 280px; background: #FFF8FA; border: 1px solid #fce7ef; border-radius: 14px; padding: 18px;">
                <div style="display: flex; justify-content: space-between; font-size: 13px; color: var(--text-muted); margin-bottom: 8px;">
                    <span>Total Produk:</span>
                    <span>Rp {{ number_format($order->items->sum('subtotal'), 0, ',', '.') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 13px; color: var(--text-muted); margin-bottom: 8px;">
                    <span>Pengiriman:</span>
                    <span style="color: #16a34a; font-weight: 700;">GRATIS</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: 800; color: var(--pink-dark); border-top: 1px dashed #fce7ef; padding-top: 10px; margin-top: 8px;">
                    <span>Total Bayar:</span>
                    <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 20px;">
            <a href="{{ route('orders.index') }}" class="btn-pink-outline" style="font-size: 13px; border-radius: 12px;">
                &larr; Kembali ke Daftar Belanja
            </a>
            <a href="{{ route('shop.index') }}" class="btn-pink" style="font-size: 13px; border-radius: 12px;">
                Belanja Lagi &rarr;
            </a>
        </div>
    </div>

@endsection
