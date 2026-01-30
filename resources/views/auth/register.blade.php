@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="left">
        <h1>Laundio</h1>
        <p>
            Buat akun baru di Laundio <br>
            Isi data di bawah untuk melanjutkan:
        </p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <div class="input-wrapper">
                    <input type="text" name="name" placeholder="Nama Lengkap" required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-wrapper">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-wrapper">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-wrapper">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-wrapper">
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>
            </div>

            <div class="btn-center">
                <button type="submit" class="btn">Sign up</button>
            </div>
        </form>

        <div class="footer-text">
            Sudah punya akun?
            <a href="{{ route('login') }}">Sign in</a>
        </div>
    </div>

    <div class="right"></div>
@endsection
