@extends('layouts.dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/promo.css') }}">
@endpush

@section('title', 'Daftar Outlet')

@section('content')

<h3 class="page-title">Daftar Outlet</h3>

{{-- NOTIFIKASI --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card">

    {{-- HEADER DALAM CARD --}}
    <div class="promo-header">
        <h4>Daftar Outlet</h4>

        <a href="{{ route('outlet.create') }}" class="btn btn-sm">
            + Tambah Outlet
        </a>
    </div>

    {{-- LIST OUTLET --}}
    <div class="outlet-list">
    @foreach($outlets as $outlet)
        <div class="outlet-card">
            <div class="outlet-info">
                <div class="outlet-title">
                    📍 {{ $outlet->nama_outlet }}
                </div>

                <div class="outlet-address">
                    {{ $outlet->jalan }}, {{ $outlet->kecamatan }},
                    {{ $outlet->kota_kab }}, {{ $outlet->provinsi }}
                </div>

                <div class="outlet-phone">
                    {{ $outlet->no_telp }}
                </div>
            </div>

            <div class="outlet-action">
                <a href="{{ route('outlet.show', $outlet->id_outlet) }}" class="promo-btn">
                    Lihat Detail
                </a>
            </div>
        </div>
    @endforeach
    </div>

</div>

@endsection
