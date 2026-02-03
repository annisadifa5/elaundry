@extends('layouts.dashboard')

@section('title', 'Edit Outlet')

@section('content')
<div class="page-title">Edit Outlet</div>

<div class="card">
<form method="POST" action="{{ route('outlet.update', $outlet->id_outlet) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <input type="text" name="nama_outlet" value="{{ $outlet->nama_outlet }}">
    </div>

    <div class="form-group">
        <input type="text" name="jalan" value="{{ $outlet->jalan }}">
    </div>

    <div class="form-group">
        <input type="text" name="kecamatan" value="{{ $outlet->kecamatan }}">
    </div>

    <div class="form-group">
        <input type="text" name="kota_kab" value="{{ $outlet->kota_kab }}">
    </div>

    <div class="form-group">
        <input type="text" name="provinsi" value="{{ $outlet->provinsi }}">
    </div>

    <div class="form-group">
        <input type="text" name="kode_pos" value="{{ $outlet->kode_pos }}">
    </div>

    <div class="form-group">
        <input type="text" name="no_telp" value="{{ $outlet->no_telp }}">
    </div>

    <div class="form-group">
        <input type="email" name="email" value="{{ $outlet->email }}">
    </div>

    <div class="form-group">
        <input type="text" name="website" value="{{ $outlet->website }}">
    </div>

    <button class="btn">Update</button>
</form>
</div>
@endsection
