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
        <div class="promo-card {{ $promo->status === 'aktif' ? 'aktif' : 'nonaktif' }}">
            <div class="promo-icon">🏷️</div>

            {{-- NAMA PROMO --}}
            <div class="promo-title">
                {{ $promo->nama_promo }}
            </div>

            {{-- JENIS PROMO --}}
            <div class="promo-desc">
                @if($promo->basis_promo === 'nominal')
                    <strong>Potongan :</strong>
                    Rp{{ number_format($promo->nilai_promo, 0, ',', '.') }}
                @else
                    <strong>Diskon :</strong>
                    {{ $promo->nilai_promo }}%
                @endif
            </div>

            {{-- DESKRIPSI --}}
            <div class="promo-desc">
                {{ Str::limit($promo->deskripsi_promo, 80) }}
            </div>

            {{-- STATUS --}}
            <div class="promo-desc">
                <strong>Status :</strong>
                {{ ucfirst($promo->status) }}
            </div>

            <div class="promo-footer">
                <span>
                    Berlaku :
                    {{ $promo->tanggal_mulai }} -
                    {{ $promo->tanggal_selesai }}
                </span>

                @if($promo->status === 'aktif')
                <a href="{{ route('manajemen.showpromo', $promo->id_promo) }}"
                   class="promo-btn">
                    Lihat Detail
                </a>
                @else
                <span class="promo-btn promo-disabled">
                    Promo Nonaktif
                </span>
                @endif
            </div>
        </div>
    @endforeach
    </div>

</div>
<style>
    .promo-card.aktif {
    background: linear-gradient(135deg, #14b8a6, #0d9488);
}

.promo-card.nonaktif {
    background: linear-gradient(
        to right,
        #8e8e8e,
        #6f6f6f
    );
    color: #f1f5f9;
    opacity: 0.85;
}

.btn-detail.disabled {
    background: #cbd5e1;
    cursor: not-allowed;
}

</style>
@endsection
