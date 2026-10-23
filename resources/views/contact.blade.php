@extends('layout')

@section('title', 'Pusat Bantuan & Kontak - KiaBeauty')

@section('styles')
<style>
    .contact-box-card {
        max-width: 860px;
        margin: 20px auto;
        background: #ffffff;
        border: 1px solid #fce7ef;
        border-radius: 24px;
        padding: 48px 36px;
        box-shadow: 0 2px 10px rgba(168, 77, 112, 0.05);
    }

    .contact-head-tag {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: var(--pink-dark);
        margin-bottom: 6px;
        text-align: center;
        display: block;
    }

    .contact-main-head {
        font-size: 34px;
        font-weight: 700;
        color: var(--text-dark);
        text-align: center;
        margin-bottom: 12px;
    }

    .contact-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-top: 36px;
    }

    .contact-card-item {
        background: #FFF8FA;
        border: 1px solid #fce7ef;
        border-radius: 18px;
        padding: 24px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }

    .contact-circle-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: #ffffff;
        color: var(--pink-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        flex-shrink: 0;
    }

    @media (max-width: 640px) {
        .contact-grid-2 {
            grid-template-columns: 1fr;
        }
        .contact-box-card {
            padding: 28px 20px;
        }
    }
</style>
@endsection

@section('content')

    <div class="contact-box-card">
        <span class="contact-head-tag">Customer Support</span>
        <h1 class="contact-main-head">Pusat Bantuan & Kontak</h1>
        <p style="text-align: center; font-size: 14px; color: var(--text-muted); max-width: 580px; margin: 0 auto;">
            Tim KiaBeauty siap menjawab pertanyaanmu mengenai produk kecantikan, konsultasi penggunaan, dan status pesanan.
        </p>

        <div class="contact-grid-2">
            <div class="contact-card-item">
                <div class="contact-circle-icon">💬</div>
                <div>
                    <h3 style="font-size: 15px; font-weight: 700; color: var(--text-dark); margin-bottom: 2px;">WhatsApp Resmi</h3>
                    <p style="font-size: 14px; font-weight: 600; color: var(--pink-dark);">0819-3566-5880</p>
                    <p style="font-size: 12px; color: var(--text-muted); margin-top: 4px;">Respon cepat setiap hari 08.00 - 21.00 WIB</p>
                </div>
            </div>

            <div class="contact-card-item">
                <div class="contact-circle-icon">✉️</div>
                <div>
                    <h3 style="font-size: 15px; font-weight: 700; color: var(--text-dark); margin-bottom: 2px;">Email Bantuan</h3>
                    <p style="font-size: 14px; font-weight: 600; color: var(--pink-dark);">kiara280306@gmail.com</p>
                    <p style="font-size: 12px; color: var(--text-muted); margin-top: 4px;">Untuk saran, kerjasama, dan keluhan</p>
                </div>
            </div>

            <div class="contact-card-item">
                <div class="contact-circle-icon">📍</div>
                <div>
                    <h3 style="font-size: 15px; font-weight: 700; color: var(--text-dark); margin-bottom: 2px;">Lokasi Gudang & Toko</h3>
                    <p style="font-size: 13px; color: var(--text-sub); line-height: 1.5;">Jl. Malioboro No. 45, Yogyakarta</p>
                    <p style="font-size: 12px; color: var(--text-muted); margin-top: 4px;">Pengiriman ke seluruh Indonesia</p>
                </div>
            </div>

            <div class="contact-card-item">
                <div class="contact-circle-icon">⏰</div>
                <div>
                    <h3 style="font-size: 15px; font-weight: 700; color: var(--text-dark); margin-bottom: 2px;">Jam Operasional</h3>
                    <p style="font-size: 13px; color: var(--text-sub);">Senin - Minggu: 08:00 - 21:00 WIB</p>
                    <p style="font-size: 12px; color: #16a34a; font-weight: 600; margin-top: 4px;">✓ Order sebelum 15:00 dikirim hari yang sama</p>
                </div>
            </div>
        </div>
    </div>

@endsection
