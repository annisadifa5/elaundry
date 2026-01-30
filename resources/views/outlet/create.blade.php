@extends('layouts.dashboard')

@section('title', 'Tambah Outlet')

@section('content')
<div class="page-title">Form Tambah Outlet</div>

<div class="card" style="max-width: 760px; border: 2px solid #3b82f6;">
    <h4>DATA OUTLET</h4>

    <form method="POST" action="{{ route('outlet.store') }}">
        @csrf

        <input type="text" name="nama" placeholder="Nama">

        <h4 style="margin-top:20px;">ALAMAT</h4>
        <input type="text" name="jalan" placeholder="Jalan">
        <input type="text" name="desa" placeholder="Desa / Kelurahan">
        <input type="text" name="kecamatan" placeholder="Kecamatan">
        <input type="text" name="kota" placeholder="Kota / Kabupaten">
        <input type="text" name="provinsi" placeholder="Provinsi">
        <input type="text" name="kode_pos" placeholder="Kode Pos">

        <h4 style="margin-top:20px;">KONTAK</h4>
        <input type="text" name="telepon" placeholder="Telepon">
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="website" placeholder="Website">

        <h4 style="margin-top:20px;">PENANGGUNG JAWAB</h4>
        <input type="text" name="pj_nama" placeholder="Nama">
        <input type="text" name="pj_kontak" placeholder="Kontak">

        <div style="display:flex; justify-content:flex-end; margin-top:20px;">
            <button class="btn">+ Tambah</button>
        </div>
    </form>
</div>
@endsection
