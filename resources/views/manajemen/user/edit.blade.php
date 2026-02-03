@extends('layouts.dashboard')

@section('title','Edit User')

@section('content')
<h2 class="page-title">Edit User</h2>

<div class="card">
<form method="POST" action="{{ route('manajemen.user.update', $user) }}">
@csrf @method('PUT')

<div class="row">
    <input name="nama" value="{{ $user->nama }}">
    <input name="email" value="{{ $user->email }}">
</div>

<div class="row">
    <input name="no_telp" value="{{ $user->no_telp }}">
    <select name="role">
        <option value="admin" @selected($user->role=='admin')>Admin</option>
        <option value="kasir" @selected($user->role=='kasir')>Kasir</option>
    </select>
</div>

<div class="btn-row">
    <button class="btn">Update</button>
</div>
</form>
</div>
@endsection
