@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    {{-- LEFT --}}
    <div class="auth-left">
        <h1>Laundio</h1>
        <p>
            Selamat datang di sistem manajemen laundry.<br>
        </p>
    </div>

    {{-- RIGHT --}}
    <div class="auth-right">
        <div class="auth-title">Login</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="btn">Sign In</button>
        </form>

        <div class="auth-footer">
            Belum punya akun?
            <a href="{{ route('register') }}">Sign up</a>
        </div>
    </div>
@endsection
