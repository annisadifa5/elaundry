@extends('layouts.dashboard')

@section('title', 'Edit Karyawan')

@section('content')
<div class="page-title">Edit Karyawan</div>

<div class="card" style="max-width: 100%;">

<form method="POST" action="{{ route('karyawan.update', $karyawan->id_karyawan) }}">
@csrf
@method('PUT')

@if ($errors->any())
    <div style="background:#fee2e2; padding:12px; margin-bottom:15px; border-radius:6px;">
        <ul style="margin:0; padding-left:18px; color:#991b1b;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    {{-- DATA PRIBADI --}}
    <h4>DATA PRIBADI</h4>

    <p>
        <strong>Nama:</strong><br>
        <input type="text" name="nama_karyawan" value="{{ $karyawan->nama_karyawan }}">
    </p>

    <p>
        <strong>Jenis Kelamin:</strong><br>
        <select name="jenis_kelamin">
            <option value="L" {{ $karyawan->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ $karyawan->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </p>

    <p>
    <strong>Tempat Lahir:</strong><br>
    <input type="text" name="tempat_lahir" value="{{ $karyawan->tempat_lahir }}">
    </p>

    <p>
        <strong>Agama:</strong><br>
        <select name="agama">
            <option value="">Pilih Agama</option>
            <option value="Islam" {{ $karyawan->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
            <option value="Kristen" {{ $karyawan->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
            <option value="Katolik" {{ $karyawan->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
            <option value="Hindu" {{ $karyawan->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
            <option value="Buddha" {{ $karyawan->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
            <option value="Konghucu" {{ $karyawan->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
            <option value="Kepercayaan Lain" {{ $karyawan->agama == 'Kepercayaan Lain' ? 'selected' : '' }}>Kepercayaan Lain</option>
        </select>
    </p>

    <p>
        <strong>Tanggal Lahir:</strong><br>
        <input type="date"
       name="tanggal_lahir"
       value="{{ optional($karyawan->tanggal_lahir)->format('Y-m-d') }}">
    </p>

    <p>
        <strong>NIK:</strong><br>
        <input type="text" name="nik" value="{{ $karyawan->nik }}">
    </p>

    {{-- DATA PEKERJAAN --}}
    <h4 style="margin-top:20px;">DATA PEKERJAAN</h4>

    <p>
        <strong>Jabatan:</strong><br>
        <input type="text" name="jabatan" value="{{ $karyawan->jabatan }}">
    </p>

    <p>
    <strong>Outlet:</strong><br>
    <select name="id_outlet" required>
        <option value="">Pilih Outlet</option>
        @foreach($outlets as $outlet)
            <option value="{{ $outlet->id_outlet }}"
                {{ old('id_outlet', $karyawan->id_outlet) == $outlet->id_outlet ? 'selected' : '' }}>
                {{ $outlet->nama_outlet }}
            </option>
        @endforeach
    </select>
    </p>

    <p>
        <strong>Status:</strong><br>
        <select name="status">
            <option value="Aktif" {{ $karyawan->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Tidak Aktif" {{ $karyawan->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
    </p>

    <p>
        <strong>Tanggal Masuk:</strong><br>
        <input type="date"
       name="tanggal_masuk"
       value="{{ optional($karyawan->tanggal_masuk)->format('Y-m-d') }}">
    </p>

    {{-- KONTAK --}}
    <h4 style="margin-top:20px;">KONTAK</h4>

    <p>
        No HP:<br>
        <input type="text" name="no_hp" value="{{ $karyawan->no_hp }}">
    </p>

    <p>
        Email:<br>
        <input type="email" name="email" value="{{ $karyawan->email }}">
    </p>

    <p>
        Alamat:<br>
        <textarea name="alamat">{{ $karyawan->alamat }}</textarea>
    </p>

    {{-- AKSI --}}
    <div style="margin-top:30px; display:flex; gap:10px;">
        <a href="{{ route('karyawan.show', $karyawan->id_karyawan) }}"
           class="btn"
           style="background:#e2e8f0;">
            Batal
        </a>

        <button class="btn">
            Simpan
        </button>
    </div>

</form>
</div>
@endsection
