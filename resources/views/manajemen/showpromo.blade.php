@extends('layouts.dashboard')

@section('title', 'Detail Promo')

@section('content')
<h3 class="page-title">Detail Promo</h3>

<div class="card" style="max-width: 100%;">

    {{-- BUTTON KEMBALI --}}
    <div style="margin-bottom:20px;">
        <a href="{{ route('manajemen.indexpromo') }}" class="btn btn-secondary btn-sm">
            ←
        </a>
    </div>

    {{-- JUDUL --}}
    <h4>Laundry 10 KG Gratis 1 KG</h4>
    <p style="color:#64748b; margin-bottom:20px;">
        Berlaku: 26 Januari - 30 Januari
    </p>

    {{-- DESKRIPSI --}}
    <div style="margin-bottom:24px;">
        <h4>Deskripsi Promo</h4>
        <p>
            Cuci minimal 10 kg akan mendapatkan bonus 1 kg gratis.
            Promo berlaku kelipatan dan dihitung otomatis oleh sistem.
        </p>
    </div>

    {{-- CARA REDEEM --}}
    <div style="margin-bottom:24px;">
        <h4>Cara Redeem</h4>
        <ol>
            <li>Lakukan transaksi laundry minimal 10 kg</li>
            <li>Sistem otomatis menghitung bonus</li>
            <li>Bonus langsung masuk ke nota</li>
        </ol>
    </div>

    {{-- SYARAT --}}
    <div style="margin-bottom:24px;">
        <h4>Syarat & Ketentuan</h4>
        <ul>
            <li>Promo tidak dapat digabung</li>
            <li>Berlaku untuk semua outlet</li>
            <li>Promo aktif selama periode berlaku</li>
        </ul>
    </div>

    {{-- AKSI --}}
    <div class="btn-row" style="gap:10px;">
        <a href="#" class="btn btn-secondary btn-sm">Edit Promo</a>
        <button class="btn">Nonaktifkan</button>
    </div>

</div>
@endsection
