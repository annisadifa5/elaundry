@extends('layouts.dashboard')

@section('title', 'Input Promo')

@section('content')
<div class="page-title">Input Promo</div>

<div class="card" style="max-width: 100%;">
    <h4>Input Promo</h4>

    <form method="POST" action="{{ route('manajemen.storepromo') }}">
    @csrf

    <div class="row">
        <input type="text" name="nama_promo" placeholder="Nama Promo" required>
        <input type="text" name="skema" placeholder="Skema Promo" required>
    </div>

    <div class="row">
        <select name="status" required>
            <option value="">Status</option>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Non Aktif</option>
        </select>

        <input type="date" name="tanggal_mulai" required>
        <input type="date" name="tanggal_selesai" required>
    </div>

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
