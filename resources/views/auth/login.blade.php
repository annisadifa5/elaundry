@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="left">
        <h1>Laundio</h1>
        <p>
            Selamat Datang di Laundio! <br>
            Buat akun baru atau Sign in
        </p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <div class="input-wrapper">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-wrapper">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
            </div>

            <!-- 👇 WRAPPER -->
            <div class="btn-center">
                <button type="submit" class="btn">Sign in</button>
            </div>
        </form>


        <div class="footer-text">
            Belum punya akun?
            <a href="{{ route('register') }}">Sign up</a>
        </div>
    </div>

    <div class="right"></div>
@endsection
