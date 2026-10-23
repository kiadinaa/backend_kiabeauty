@extends('layout')

@section('title', 'Masuk ke Akun - KiaBeauty')

@section('styles')
<style>
    .login-wrapper {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 40px 16px;
    }

    .circle-deco-1 {
        position: absolute;
        top: -40px;
        right: -40px;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        background: #FCE8EF;
        opacity: 0.6;
        pointer-events: none;
    }

    .circle-deco-2 {
        position: absolute;
        bottom: -50px;
        left: -40px;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: #FCE8EF;
        opacity: 0.5;
        pointer-events: none;
    }

    /* CARD matching ReactBasic LoginPage.jsx */
    .login-card {
        position: relative;
        z-index: 10;
        width: 100%;
        max-width: 440px;
        overflow: hidden;
        border-radius: 24px;
        border: 1px solid #F0E4E9;
        background: #ffffff;
        box-shadow: 0 12px 30px rgba(168, 77, 112, 0.1);
    }

    .card-top-stripe {
        height: 8px;
        background-color: var(--pink-dark);
    }

    .card-inner-pad {
        padding: 36px 32px;
    }

    .heart-badge-icon {
        margin: 0 auto 16px;
        display: flex;
        height: 56px;
        width: 56px;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        background-color: #FCE8EF;
        font-size: 24px;
        color: var(--pink-dark);
    }

    .field-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .field-input {
        width: 100%;
        border-radius: 12px;
        border: 1px solid #F0E4E9;
        background: #FFFAFC;
        padding: 12px 16px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-family: inherit;
    }

    .field-input:focus {
        border-color: var(--pink-dark);
        box-shadow: 0 0 0 3px rgba(168, 77, 112, 0.15);
    }

    .btn-login-submit {
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background-color: var(--pink-dark);
        padding: 14px;
        font-size: 14px;
        font-weight: 600;
        color: #ffffff;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(168, 77, 112, 0.25);
        transition: background-color 0.2s;
        margin-top: 10px;
    }

    .btn-login-submit:hover {
        background-color: var(--pink-darker);
    }
</style>
@endsection

@section('content')

    <div class="login-wrapper">
        <div class="circle-deco-1"></div>
        <div class="circle-deco-2"></div>

        <section class="login-card">
            <div class="card-top-stripe"></div>

            <div class="card-inner-pad">
                <!-- Brand Center -->
                <div style="text-align: center; margin-bottom: 24px;">
                    <span style="font-size: 28px; font-weight: 700; color: var(--pink-dark); display: block;">KiaBeauty</span>
                    <span style="font-size: 10px; letter-spacing: 0.2em; color: var(--text-muted); text-transform: uppercase;">BEAUTY, MADE SIMPLE</span>
                </div>

                <!-- Heart Icon & Heading -->
                <div style="text-align: center; margin-bottom: 28px;">
                    <div class="heart-badge-icon">♡</div>
                    <h1 style="font-size: 26px; font-weight: 700; color: var(--text-dark);">Selamat Datang!</h1>
                    <p style="font-size: 14px; color: var(--text-muted); margin-top: 6px; line-height: 1.5;">
                        Masuk ke akunmu dan temukan produk kecantikan favoritmu.
                    </p>
                </div>

                <form action="{{ route('login') }}" method="POST" style="display: flex; flex-direction: column; gap: 18px;">
                    @csrf

                    <div>
                        <label for="email" class="field-label">Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required placeholder="nama@email.com" value="{{ old('email', 'pelanggan@kiabeauty.com') }}" class="field-input">
                        @error('email')
                            <span style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="field-label">Password</label>
                        <div style="position: relative;">
                            <input id="password" name="password" type="password" autocomplete="current-password" required value="password123" placeholder="Masukkan password" class="field-input">
                        </div>
                        @error('password')
                            <span style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn-login-submit">
                        Masuk ke Akun
                    </button>
                </form>

                <!-- Demo Hint Box -->
                <div style="margin-top: 20px; background: #FFF8FA; border: 1px dashed #fce7ef; border-radius: 12px; padding: 12px; font-size: 12px; color: var(--text-muted); text-align: center;">
                    💡 Akun Demo: <strong>pelanggan@kiabeauty.com</strong> | Password: <strong>password123</strong>
                </div>

                <div style="margin-top: 24px; padding-top: 18px; border-top: 1px solid #F0E4E9; text-align: center;">
                    <a href="{{ route('home') }}" style="font-size: 13px; font-weight: 600; color: var(--pink-dark);">
                        &larr; Kembali ke KiaBeauty
                    </a>
                </div>
            </div>
        </section>
    </div>

@endsection
