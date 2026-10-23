@extends('layout')

@section('title', 'Tentang KiaBeauty - Beauty, Made Simple')

@section('styles')
<style>
    .about-box-card {
        max-width: 860px;
        margin: 20px auto;
        background: #ffffff;
        border: 1px solid #fce7ef;
        border-radius: 24px;
        padding: 48px 36px;
        box-shadow: 0 2px 10px rgba(168, 77, 112, 0.05);
    }

    .about-head-tag {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: var(--pink-dark);
        margin-bottom: 6px;
        text-align: center;
        display: block;
    }

    .about-main-head {
        font-size: 36px;
        font-weight: 700;
        color: var(--text-dark);
        text-align: center;
        margin-bottom: 24px;
    }

    .about-paragraph {
        font-size: 15px;
        color: var(--text-sub);
        line-height: 1.8;
        margin-bottom: 20px;
    }

    .values-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-top: 36px;
    }

    .value-box {
        background: #FFF8FA;
        border: 1px solid #fce7ef;
        border-radius: 16px;
        padding: 20px;
        text-align: center;
    }

    @media (max-width: 640px) {
        .values-row {
            grid-template-columns: 1fr;
        }
        .about-box-card {
            padding: 28px 20px;
        }
    }
</style>
@endsection

@section('content')

    <div class="about-box-card">
        <span class="about-head-tag">Our Story</span>
        <h1 class="about-main-head">Tentang KiaBeauty</h1>

        <p class="about-paragraph">
            <strong>KiaBeauty</strong> adalah platform e-commerce produk kecantikan yang mengusung filosofi <em>"Beauty, Made Simple"</em>. Kami berdedikasi untuk memudahkan pencinta skincare dan makeup menemukan produk-produk berkualitas tinggi dari brand terkemuka seperti Make Over, Wardah, Somethinc, Skintific, dan Azarine.
        </p>

        <p class="about-paragraph">
            Kami berkomitmen menghadirkan produk 100% original, aman, teruji klinis, dan bersertifikasi BPOM dengan penawaran harga terbaik dan pengalaman belanja yang mulus mulai dari pemilihan produk hingga paket tiba di depan pintu rumah Anda.
        </p>

        <div class="values-row">
            <div class="value-box">
                <div style="font-size: 32px; margin-bottom: 8px;">✨</div>
                <h3 style="font-size: 15px; font-weight: 700; color: var(--text-dark); margin-bottom: 4px;">100% Original</h3>
                <p style="font-size: 12px; color: var(--text-muted); line-height: 1.5;">Seluruh produk dijamin keasliannya dan terdaftar resmi BPOM.</p>
            </div>

            <div class="value-box">
                <div style="font-size: 32px; margin-bottom: 8px;">🚚</div>
                <h3 style="font-size: 15px; font-weight: 700; color: var(--text-dark); margin-bottom: 4px;">Gratis Ongkir</h3>
                <p style="font-size: 12px; color: var(--text-muted); line-height: 1.5;">Nikmati promo gratis pengiriman untuk setiap pesananmu.</p>
            </div>

            <div class="value-box">
                <div style="font-size: 32px; margin-bottom: 8px;">💖</div>
                <h3 style="font-size: 15px; font-weight: 700; color: var(--text-dark); margin-bottom: 4px;">Beauty for All</h3>
                <p style="font-size: 12px; color: var(--text-muted); line-height: 1.5;">Solusi kecantikan praktis yang aman untuk berbagai tipe kulit.</p>
            </div>
        </div>
    </div>

@endsection
