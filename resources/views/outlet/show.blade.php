@extends('layouts.dashboard')

@section('title', 'Detail Outlet')

@section('content')
<div class="page-title">Detail Outlet</div>

<div class="card" style="max-width: 100%;">
    <a href="{{ route('outlet.index') }}" class="btn btn-secondary btn-sm">
            ←
    </a>
    <h4>DATA OUTLET</h4>

    <p><strong>Nama:</strong> {{ $outlet->nama_outlet }}</p>

    <h4 style="margin-top:20px;">ALAMAT</h4>
    <p>{{ $outlet->jalan }}</p>
    <p>{{ $outlet->kelurahan }}, {{ $outlet->kecamatan }}</p>
    <p>{{ $outlet->kota_kab }}, {{ $outlet->provinsi }}</p>
    <p>Kode Pos: {{ $outlet->kode_pos }}</p>

    <h4 style="margin-top:20px;">KONTAK</h4>
    <p>Telepon: {{ $outlet->no_telp }}</p>
    <p>Email: {{ $outlet->email }}</p>
    <p>Website: {{ $outlet->website }}</p>

    <div style="margin-top:15px; display:flex; gap:10px;">
        <a href="{{ route('outlet.edit', $outlet->id_outlet) }}"
        class="btn btn-sm">
            Edit Outlet
        </a>

        <form action="{{ route('outlet.destroy', $outlet->id_outlet) }}"
            method="POST"
            onsubmit="return confirm('Yakin ingin menghapus outlet ini?')">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger btn-sm">
                Hapus Outlet
            </button>
        </form>
    </div>

    {{-- <h4 style="margin-top:20px;">PENANGGUNG JAWAB</h4>
    <p>Nama: {{ $outlet->pj_nama }}</p>
    <p>Kontak: {{ $outlet->pj_kontak }}</p> --}}
</div>

@endsection
