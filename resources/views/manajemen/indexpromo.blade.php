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
    @foreach($promos as $promo)
        <div class="promo-card">
            <div class="promo-icon">🏷️</div>

            <div class="promo-title">
                {{ $promo->nama_promo }}
            </div>

            <div class="promo-desc">
                {{ Str::limit($promo->deskripsi_promo, 100) }}
            </div>

            <div class="promo-footer">
                <span>
                    Berlaku :
                    {{ $promo->tanggal_mulai }} -
                    {{ $promo->tanggal_selesai }}
                </span>

                <a href="{{ route('manajemen.showpromo', $promo->id_promo) }}"
                class="promo-btn">
                    Lihat Detail
                </a>
            </div>
        </div>
    @endforeach
    </div>

</div>
@endsection
