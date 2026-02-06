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

    {{-- STATUS --}}
    <p>
        <strong>Status :</strong>
        {{ ucfirst($promo->status) }}
    </p>

    {{-- BASIS PROMO --}}
    <div>
        <h4>Jenis Promo</h4>
        <p>
            @if($promo->basis_promo === 'nominal')
                Potongan Nominal (Rp{{ number_format($promo->nilai_promo, 0, ',', '.') }})
            @else
                Potongan Persentase ({{ $promo->nilai_promo }}%)
            @endif
        </p>
    </div>

    {{-- MINIMAL TRANSAKSI --}}
    <div>
        <h4>Minimal Transaksi</h4>
        <p>
            Rp{{ number_format($promo->minimal_transaksi, 0, ',', '.') }}
        </p>
    </div>

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
        <form method="POST" action="{{ route('manajemen.promo.nonaktifkan', $promo->id_promo) }}">
            @csrf
            <button class="btn btn-danger btn-sm">
                Nonaktifkan
            </button>
        </form>
        @endif

    </div>

</div>
@endsection
