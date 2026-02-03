@extends('layouts.dashboard')

@section('title','Tambah User')

@section('content')
<h2 class="page-title">Tambah User</h2>

<div class="card">
<form method="POST" action="{{ route('manajemen.user.store') }}">
@csrf

<div class="row">
    <input name="nama" placeholder="Nama">
    <input name="email" placeholder="Email">
</div>

<div class="row">
    <input name="no_telp" placeholder="No Telp">
    <select name="role">
        <option value="admin">Admin</option>
        <option value="kasir">Kasir</option>
    </select>
</div>

<input type="password" name="password" placeholder="Password">

<div class="btn-row">
    <button class="btn">Simpan</button>
</div>
</form>
</div>
@endsection
