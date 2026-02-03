@extends('layouts.dashboard')

@section('title', 'Tambah Outlet')

@section('content')
<div class="page-title">Form Tambah Outlet</div>

<div class="card" style="max-width: 100%;">
    <h4>DATA OUTLET</h4>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin:0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('outlet.store') }}">
        @csrf

        <div class="form-group">
            <input type="text" name="nama_outlet" placeholder="Nama">
        </div>

        <h4>ALAMAT</h4>

        <div class="form-group">
            <input type="text" name="jalan" placeholder="Jalan">
        </div>
        <div class="form-group">
            <input type="text" name="kelurahan" placeholder="Desa / Kelurahan">
        </div>
        <div class="form-group">
            <input type="text" name="kecamatan" placeholder="Kecamatan">
        </div>
        <div class="form-group">
           <input type="text" name="kota_kab" placeholder="Kota / Kabupaten">
        </div>
        <div class="form-group">
            <input type="text" name="provinsi" placeholder="Provinsi">
        </div>
        <div class="form-group">
            <input type="text" name="kode_pos" placeholder="Kode Pos">
        </div>

        <h4>KONTAK</h4>

        <div class="form-group">
            <input type="text" name="no_telp" placeholder="Telepon">
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
