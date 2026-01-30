@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    {{-- LEFT --}}
    <div class="auth-left">
        <h1>Laundio</h1>
        <p>
            Buat akun baru di Laundio.<br>
        </p>
    </div>

    {{-- RIGHT --}}
    <div class="auth-right">
        <div class="auth-title">Register</div>

        @if ($errors->any())
            <div style="color:red; margin-bottom:10px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf

            <div class="form-group">
                <input type="text" name="nama" placeholder="Nama Lengkap" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <input type="text" name="no_telp" placeholder="No Telepon" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
            </div>

            <button type="submit" class="btn">Sign Up</button>
        </form>

        <div class="auth-footer">
            Sudah punya akun?
            <a href="{{ route('login') }}">Sign in</a>
        </div>
    </div>
@endsection
