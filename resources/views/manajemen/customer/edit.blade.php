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

        <div class="toggle-wrapper">
            <span>Aktifkan Member</span>

            <label class="switch">
                <input type="checkbox" name="is_member"
                    {{ $customer->is_member ? 'checked' : '' }}>
                <span class="slider"></span>
            </label>
        </div>

        @if($customer->is_member)
            <div style="margin-top:15px; padding:12px; background:#f8fafc; border-radius:8px; border:1px solid #e2e8f0;">
                <h5 style="margin-bottom:8px;">Detail Member</h5>

                <p><b>Kode Member:</b> {{ $customer->member_code ?? '-' }}</p>
                <p><b>Tanggal Bergabung:</b> {{ $customer->member_since ?? '-' }}</p>
                <p><b>Poin:</b> {{ $customer->member_points ?? 0 }}</p>
            </div>
        @endif

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
