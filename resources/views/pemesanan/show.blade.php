@extends('layouts.dashboard')

@section('content')
<h3>Pemesanan Berhasil 🎉</h3>

<p>No Order: {{ $pemesanan->no_order }}</p>
<p>Customer: {{ $pemesanan->customer->nama_lengkap }}</p>
<p>Status: {{ $pemesanan->trackPemesanan->proses }}</p>

@if(session('success'))
    <div style="color: green">{{ session('success') }}</div>
@endif
@endsection
