@extends('layouts.dashboard')

@section('title', 'Tambah Outlet')

@section('content')
<div class="page-title">Form Tambah Outlet</div>

<div class="card" style="max-width: 100%; border: 2px solid #3b82f6;">
    <h4>DATA OUTLET</h4>

    <form method="POST" action="{{ route('outlet.store') }}">
        @csrf

        <div class="form-group">
            <input type="text" name="nama" placeholder="Nama">
        </div>

        <h4>ALAMAT</h4>

        <div class="form-group">
            <input type="text" name="jalan" placeholder="Jalan">
        </div>
        <div class="form-group">
            <input type="text" name="desa" placeholder="Desa / Kelurahan">
        </div>
        <div class="form-group">
            <input type="text" name="kecamatan" placeholder="Kecamatan">
        </div>
        <div class="form-group">
            <input type="text" name="kota" placeholder="Kota / Kabupaten">
        </div>
        <div class="form-group">
            <input type="text" name="provinsi" placeholder="Provinsi">
        </div>
        <div class="form-group">
            <input type="text" name="kode_pos" placeholder="Kode Pos">
        </div>

        <h4>KONTAK</h4>

        <div class="form-group">
            <input type="text" name="telepon" placeholder="Telepon">
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
        <input type="text" name="website" placeholder="Website">
        </div>

        <div class="btn-row" style="gap:10px;">
            <a href="{{ route('outlet.index') }}" class="btn btn-secondary btn-sm">
                Kembali
            </a>

            <button type="submit" class="btn">
                Tambah
            </button>
        </div>

    </form>

</div>
@endsection
