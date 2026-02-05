@extends('layouts.dashboard')

@section('title', 'Edit Customer')

@section('content')
<div class="page-title">Form Edit Customer</div>

<div class="card" style="max-width: 100%; border: 2px solid #fb923c;">
    <form method="POST" action="{{ route('manajemen.customer.update', $customer->id_cust) }}">
        @csrf
        @method('PUT')

        {{-- DATA CUSTOMER --}}
        <h4>DATA CUSTOMER</h4>

        <input
            type="text"
            name="nama_lengkap"
            placeholder="Nama Lengkap"
            value="{{ old('nama_lengkap', $customer->nama_lengkap) }}"
        >

        <textarea
            name="alamat"
            rows="3"
            placeholder="Alamat"
        >{{ old('alamat', $customer->alamat) }}</textarea>

        <input
            type="text"
            name="no_telp"
            placeholder="No WhatsApp"
            value="{{ old('no_telp', $customer->no_telp) }}"
        >

        <input
            type="url"
            name="lokasi"
            placeholder="Titik Lokasi (URL Google Maps)"
            value="{{ old('lokasi', $customer->lokasi) }}"
        >

        {{-- ACTION --}}
        <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:20px;">
            <a href="{{ route('manajemen.customer.index') }}" class="btn" style="background:#e2e8f0;">
                Batal
            </a>
            <button class="btn" style="background:#fb923c; color:white;">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

{{-- STYLE (KONSISTEN DENGAN CREATE) --}}
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
</style>
@endsection
