@extends('layouts.dashboard')

<style>
    .section-title {
        margin-top: 30px;
        padding-bottom: 8px;
        border-bottom: 2px solid #e5e7eb;
        font-weight: 600;
    }

    .section {
        margin-bottom: 25px;
    }

    /* ============================= */
    /* 🎨 BADGE STATUS KARYAWAN */
    /* ============================= */

    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    /* Aktif = Hijau Tosca Soft */
    .badge-aktif {
        background: rgba(22,163,154,0.15);
        color: #16a39a;
    }

    /* Tidak Aktif = Orange Soft */
    .badge-nonaktif {
        background: rgba(230,120,0,0.15);
        color: #e67800;
    }
</style>

@section('title', 'Detail Karyawan')

@section('content')
<div class="page-title">Detail Karyawan</div>

<div class="card" style="max-width: 100%;">

    {{-- DATA PRIBADI --}}
    <h4 class="section-title">DATA PRIBADI</h4>
    <div class="section">

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
    </div>
    {{-- DATA PEKERJAAN --}}
    <h4 class="section-title">DATA PEKERJAAN</h4>
    <div class="section">

    <p><strong>Jabatan:</strong> {{ $karyawan->jabatan }}</p>
    <p><strong>Outlet:</strong> 
        {{ $karyawan->outlet->nama_outlet ?? '-' }}
    </p>

    @php
    $status = strtolower(trim($karyawan->status));
    @endphp

    <p><strong>Status:</strong>
        @if ($status == 'aktif')
            <span class="badge badge-aktif">Aktif</span>
        @elseif ($status == 'tidak_aktif')
            <span class="badge badge-nonaktif">Tidak Aktif</span>
        @else
            <span class="badge badge-nonaktif">Tidak Diketahui</span>
        @endif
    </p>
    <p><strong>Tanggal Masuk:</strong>
        {{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->format('d M Y') }}
    </p>
    </div>

    {{-- KONTAK --}}
    <h4 class="section-title">KONTAK</h4>
    <div class="section">

    <p>No HP: {{ $karyawan->no_hp }}</p>
    <p>Email: {{ $karyawan->email }}</p>
    <p>Alamat:</p>
    <p>{{ $karyawan->alamat }}</p>
    </div>

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
