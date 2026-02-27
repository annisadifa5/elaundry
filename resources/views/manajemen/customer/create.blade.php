@extends('layouts.dashboard')

@section('title', 'Tambah Customer')

@section('content')
<div class="page-title">Form Tambah Customer</div>

<div class="card" style="max-width: 100%; order: 1px solid #93c5fd;">
    <form method="POST" action="{{ route('manajemen.customer.store') }}">
        @csrf

        {{-- DATA CUSTOMER --}}
        <h4>DATA CUSTOMER</h4>

        <input
            type="text"
            name="nama_lengkap"
            placeholder="Nama Lengkap"
            value="{{ old('nama_lengkap') }}"
        >

        <textarea
            name="alamat"
            rows="3"
            placeholder="Alamat"
        >{{ old('alamat') }}</textarea>

        <input
            type="text"
            name="no_telp"
            placeholder="No WhatsApp"
            value="{{ old('no_telp') }}"
        >

        <button type="button" onclick="ambilLokasi()" class="btn" style="background:#16a39a; color:white; margin-top:10px;">
            📍 Ambil Titik Lokasi
        </button>

        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">

        <small id="lokasiStatus" style="display:block; margin-top:5px; color:#64748b;"></small>

        <div class="toggle-wrapper">
            <span>Aktifkan Member</span>

            <label class="switch">
                <input type="hidden" name="is_member" value="0">

                <input type="checkbox"
                    name="is_member"
                    value="1"
                    {{ old('is_member') ? 'checked' : '' }}>

                <span class="slider"></span>
            </label>
        </div>

        {{-- ACTION --}}
        <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:20px;">
            <a href="{{ route('manajemen.customer.index') }}" class="btn" style="background:#e2e8f0;">
                Batal
            </a>
            <button class="btn" style="background:#fb923c; color:white;">
                + Tambah
            </button>
        </div>
    </form>

<script>
    function ambilLokasi() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {

                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;

                document.getElementById('lokasiStatus').innerHTML =
                    "Lokasi berhasil diambil ✔";

            }, function(error) {
                alert("Gagal mengambil lokasi. Pastikan GPS aktif.");
            });
        } else {
            alert("Browser tidak mendukung GPS.");
        }
    }
</script>

</div>

{{-- STYLE (KONSISTEN DENGAN HALAMAN KARYAWAN) --}}
<style>
    .page-title {
        font-weight: 600;
        margin-bottom: 16px;
    }

    input, textarea {
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

    input[type="text"]:placeholder-shown,
    input[type="url"]:placeholder-shown {
        color: #9ca3af;
    }

    input:not(:placeholder-shown),
    textarea:not(:placeholder-shown) {
        color: #000;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: 13px;
        text-decoration: none;
    }

    .btn:hover {
        opacity: 0.9;
    }

    /* ========================= */
    /* 🍏 TOGGLE SWITCH STYLE */
    /* ========================= */

    .toggle-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 15px;
        max-width: 300px;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 26px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        inset: 0;
        background-color: #e2e8f0;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        content: "";
        position: absolute;
        height: 20px;
        width: 20px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    .switch input:checked + .slider {
        background-color: #16a39a; /* warna ON */
    }

    .switch input:checked + .slider:before {
        transform: translateX(24px);
    }
</style>
@endsection
