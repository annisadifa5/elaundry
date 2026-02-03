@extends('layouts.dashboard')

@section('title', 'Detail Karyawan')

@section('content')
<div class="page-title">Detail Karyawan</div>

<div class="card" style="max-width: 100%;">

    {{-- DATA PRIBADI --}}
    <h4>DATA PRIBADI</h4>

    <p><strong>Nama:</strong> {{ $karyawan->nama_karyawan }}</p>
    <p><strong>Jenis Kelamin:</strong>
        {{ $karyawan->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
    </p>
    <p><strong>Tempat Lahir:</strong> {{ $karyawan->tempat_lahir }}</p>
    <p><strong>Agama:</strong> {{ $karyawan->agama }}</p>
    <p><strong>Tanggal Lahir:</strong>
        {{ \Carbon\Carbon::parse($karyawan->tanggal_lahir)->format('d M Y') }}
    </p>
    <p><strong>NIK:</strong> {{ $karyawan->nik }}</p>

    {{-- DATA PEKERJAAN --}}
    <h4 style="margin-top:20px;">DATA PEKERJAAN</h4>

    <p><strong>Jabatan:</strong> {{ $karyawan->jabatan }}</p>
    @php
    $status = strtolower(trim($karyawan->status));
    @endphp

    <p><strong>Status:</strong>
        @if ($status == 'aktif')
            <span class="badge aktif">Aktif</span>
        @elseif ($status == 'tidak_aktif')
            <span class="badge nonaktif">Tidak Aktif</span>
        @else
            <span class="badge nonaktif">Tidak Diketahui</span>
        @endif
    </p>
    <p><strong>Tanggal Masuk:</strong>
        {{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->format('d M Y') }}
    </p>

    {{-- KONTAK --}}
    <h4 style="margin-top:20px;">KONTAK</h4>

    <p>No HP: {{ $karyawan->no_hp }}</p>
    <p>Email: {{ $karyawan->email }}</p>
    <p>Alamat:</p>
    <p>{{ $karyawan->alamat }}</p>

    {{-- AKSI --}}
    <div style="margin-top:30px; display:flex; gap:10px;">
        <a href="{{ route('karyawan.index') }}" class="btn" style="background:#e2e8f0;">
            Kembali
        </a>
        <a href="{{ route('karyawan.edit', $karyawan->id_karyawan) }}" class="btn">
            Edit
        </a>
    </div>

</div>
@endsection
