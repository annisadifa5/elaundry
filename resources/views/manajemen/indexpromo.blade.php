@extends('layouts.dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/promo.css') }}">
@endpush

@section('title', 'Promo & Loyalty')

@section('content')
<h3 class="page-title">Promo & Loyalty</h3>

<div class="card">

    {{-- HEADER CARD --}}
    <div class="promo-header">
        <h4>Daftar Promo</h4>
        <a href="{{ route('manajemen.createpromo') }}" class="promo-add-btn">
            + Tambah Promo
        </a>
    </div>


    {{-- GRID PROMO --}}
    <div class="promo-grid">

        <div class="promo-card">
            <div class="promo-icon">🎁</div>

            <div class="promo-title">
                Laundry 10 KG Gratis 1 KG
            </div>

            <div class="promo-desc">
                Cuci minimal 10 kg, dapat bonus 1 kg gratis.
                Berlaku kelipatan dan hitung otomatis oleh sistem.
            </div>

            <div class="promo-footer">
                <span>Berlaku : 26 Januari - 30 Januari</span>
                <button class="promo-btn">Lihat Detail</button>
            </div>
        </div>

        <div class="promo-card">
            <div class="promo-icon">🏷️</div>

            <div class="promo-title">
                Kumpulkan 10 Nota, Gratis 1x Laundry
            </div>

            <div class="promo-desc">
                Kumpulkan 10 transaksi dan dapatkan laundry gratis.
            </div>

            <div class="promo-footer">
                <span>Berlaku : 26 Januari - 30 Januari</span>
                <button class="promo-btn">Lihat Detail</button>
            </div>
        </div>

    </div>
</div>
@endsection
