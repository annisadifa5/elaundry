@extends('layouts.dashboard')

@section('title', 'Input Promo')

@section('content')
<div class="page-title">Input Promo</div>

<div class="card" style="max-width: 100%;">
    <h4>Input Promo</h4>

    <form>
        <!-- Baris 1 -->
        <div class="row">
            <input type="text" placeholder="Deskripsi Promo">
            <input type="text" placeholder="Skema">
        </div>

        <!-- Baris 2 -->
        <div class="row">
            <select>
                <option value="">Status</option>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Non Aktif</option>
            </select>

            <input type="date">
            <input type="date">
        </div>

        <!-- BUTTON -->
        <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
            <a href="{{ route('manajemen.indexpromo') }}" class="btn btn-secondary btn-sm">
                Kembali
            </a>

            <button type="submit" class="btn">
                Simpan Promo
            </button>
        </div>

    </form>
</div>
@endsection
