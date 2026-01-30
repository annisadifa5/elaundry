@extends('layouts.dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/promo.css') }}">
@endpush

@section('title', 'Daftar Outlet')

@section('content')

<h3 class="page-title">Daftar Outlet</h3>

<div class="card">

    {{-- HEADER DALAM CARD --}}
    <div class="promo-header">
        <h4>Daftar Outlet</h4>

        <a href="{{ route('outlet.create') }}" class="btn btn-sm">
            + Tambah Outlet
        </a>
    </div>

    {{-- LIST OUTLET --}}
    <div class="outlet-list">

        <div class="outlet-card">
            <div class="outlet-info">
                <div class="outlet-title">
                    📍 Laundry C24 Puri Anjasmoro
                </div>

                <div class="outlet-address">
                    Jl. Anjasmoro Raya No.1a, Karangayu, Kec. Semarang Barat,<br>
                    Kota Semarang, Jawa Tengah, Indonesia 50149
                </div>

                <div class="outlet-phone">
                    +628 xxx xxx
                </div>
            </div>
            <div class="outlet-action">
                <a href="{{ route('outlet.show', 1) }}" class="promo-btn">
                    Lihat Detail
                </a>
            </div>
        </div>

        {{-- DUPLIKASI CARD --}}
        <div class="outlet-list">

            <div class="outlet-card">
                <div class="outlet-info">
                    <div class="outlet-title">
                        📍 Laundry C24 Puri Anjasmoro
                    </div>

                    <div class="outlet-address">
                        Jl. Anjasmoro Raya No.1a, Karangayu, Kec. Semarang Barat,<br>
                        Kota Semarang, Jawa Tengah, Indonesia 50149
                    </div>

                    <div class="outlet-phone">
                        +628 xxx xxx
                    </div>
                </div>

                <div class="outlet-action">
                    <a href="{{ route('outlet.show', 1) }}" class="promo-btn">
                        Lihat Detail
                    </a>
                </div>
        </div>

    </div>
</div>

@endsection
