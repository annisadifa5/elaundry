@extends('layouts.dashboard')

@section('title', 'Input Promo')

@section('content')
<div class="page-title">Input Promo</div>

<div class="card" style="max-width: 100%;">
    <h4>Input Promo</h4>

    <form method="POST" action="{{ route('manajemen.storepromo') }}">
    @csrf

    {{-- NAMA & SKEMA --}}
    <div class="row">
        <input type="text" name="nama_promo" placeholder="Nama Promo" required>
        <input type="text" name="skema" placeholder="Skema Promo" required>
    </div>

    {{-- BASIS PROMO --}}
    <div class="row">
        <select name="basis_promo" required>
            <option value="">Basis Promo</option>
            <option value="nominal">Promo Nominal (Rp)</option>
            <option value="persentase">Promo Persentase (%)</option>
        </select>

        <input type="number" name="nilai_promo"
               placeholder="Nilai Promo (Rp / %)"
               min="0"
               required>
    </div>

    {{-- STATUS & TANGGAL --}}
    <div class="row">
        <select name="status" required>
            <option value="">Status</option>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Non Aktif</option>
        </select>

        <input type="date" name="tanggal_mulai" required>
        <input type="date" name="tanggal_selesai" required>
    </div>

    {{-- MINIMAL TRANSAKSI --}}
    <div class="row">
        <input type="number" name="minimal_transaksi"
               placeholder="Minimal Transaksi (Rp)"
               min="0">
    </div>

    {{-- DESKRIPSI --}}
    <div class="row">
        <textarea name="deskripsi_promo"
                  placeholder="Deskripsi Promo"
                  required></textarea>
    </div>

    <div class="btn-row">
        <a href="{{ route('manajemen.indexpromo') }}"
           class="btn btn-secondary btn-sm">Kembali</a>

        <button class="btn">Simpan Promo</button>
    </div>
    </form>

</div>
@endsection
