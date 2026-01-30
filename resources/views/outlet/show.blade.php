@extends('layouts.dashboard')

@section('title', 'Detail Outlet')

@section('content')
<div class="page-title">Detail Outlet</div>

<div class="card" style="max-width: 760px;">
    <h4>DATA OUTLET</h4>

    <p><strong>Nama:</strong> {{ $outlet->nama }}</p>

    <h4 style="margin-top:20px;">ALAMAT</h4>
    <p>{{ $outlet->jalan }}</p>
    <p>{{ $outlet->desa }}, {{ $outlet->kecamatan }}</p>
    <p>{{ $outlet->kota }}, {{ $outlet->provinsi }}</p>
    <p>Kode Pos: {{ $outlet->kode_pos }}</p>

    <h4 style="margin-top:20px;">KONTAK</h4>
    <p>Telepon: {{ $outlet->telepon }}</p>
    <p>Email: {{ $outlet->email }}</p>
    <p>Website: {{ $outlet->website }}</p>

    <h4 style="margin-top:20px;">PENANGGUNG JAWAB</h4>
    <p>Nama: {{ $outlet->pj_nama }}</p>
    <p>Kontak: {{ $outlet->pj_kontak }}</p>
</div>
@endsection
