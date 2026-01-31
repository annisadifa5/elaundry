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
    <h4>{{ $promo->nama_promo }}</h4>

    <p style="color:#64748b;">
        Berlaku :
        {{ $promo->tanggal_mulai }} -
        {{ $promo->tanggal_selesai }}
    </p>

    <div>
        <h4>Deskripsi Promo</h4>
        <p>{{ $promo->deskripsi_promo }}</p>
    </div>

    <div>
        <h4>Skema Promo</h4>
        <p>{{ $promo->skema }}</p>
    </div>

    <div class="btn-row">
        <a href="{{ route('manajemen.indexpromo') }}"
        class="btn btn-secondary btn-sm">Kembali</a>

        @if($promo->status === 'aktif')
            <button class="btn">Nonaktifkan</button>
        @endif
    </div>


</div>
@endsection
