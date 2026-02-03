@extends('layouts.dashboard')

@section('title', 'Tambah Karyawan')

@section('content')
<div class="page-title">Form Tambah Karyawan</div>

<div class="card" style="max-width: 100%; border: 2px solid #3b82f6;">
    <form method="POST" action="{{ route('karyawan.store') }}">
        @csrf

        {{-- DATA PRIBADI --}}
        <h4>DATA PRIBADI</h4>

        <input type="text" name="nama_karyawan" placeholder="Nama Karyawan">

        <select name="jenis_kelamin">
            <option value="">Jenis Kelamin</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>

        <input type="text" name="tempat_lahir" placeholder="Tempat Lahir">

        <select name="agama">
            <option value="">Agama</option>
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Katolik">Katolik</option>
            <option value="Hindu">Hindu</option>
            <option value="Buddha">Buddha</option>
            <option value="Konghucu">Konghucu</option>
            <option value="Konghucu">Kepercayaan Lain</option>
        </select>

        <input
        type="text"
        name="tanggal_lahir"
        placeholder="Tanggal Lahir"
        onfocus="this.type='date'"
        onblur="if(!this.value)this.type='text'">

        <input type="text" name="nik" placeholder="NIK">

        {{-- DATA PEKERJAAN --}}
        <h4 style="margin-top:20px;">DATA PEKERJAAN</h4>

        <select name="jabatan">
            <option value="">Jabatan</option>
            <option value="Kasir">Kasir</option>
            <option value="Admin">Admin</option>
            <option value="Supervisor">Supervisor</option>
            <option value="Kurir">Kurir</option>
        </select>

        <select name="status">
            <option value="">Status Karyawan</option>
            <option value="aktif">Aktif</option>
            <option value="tidak_aktif">Tidak Aktif</option>
        </select>

        <input
        type="text"
        name="tanggal_masuk"
        placeholder="Tanggal Masuk"
        onfocus="this.type='date'"
        onblur="if(!this.value)this.type='text'">

        {{-- KONTAK --}}
        <h4 style="margin-top:20px;">KONTAK</h4>

        <input type="text" name="no_hp" placeholder="No HP">
        <input type="email" name="email" placeholder="Email">
        <textarea name="alamat" rows="3" placeholder="Alamat"></textarea>

        <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:20px;">
            <a href="{{ route('karyawan.index') }}" class="btn" style="background:#e2e8f0;">Batal</a>
            <button class="btn">+ Tambah</button>
        </div>
    </form>
</div>
<style>
    input, select, textarea {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        font-size: 14px;
        color: #000;
    }

    input::placeholder,
    textarea::placeholder {
        color: #9ca3af;
    }

    input[type="text"]:placeholder-shown {
        color: #9ca3af;
    }

    input:not(:placeholder-shown),
    textarea:not(:placeholder-shown),
    select {
        color: #000;
    }
</style>

@endsection
