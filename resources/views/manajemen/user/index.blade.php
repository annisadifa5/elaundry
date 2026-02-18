@extends('layouts.dashboard')

@section('title', 'Manajemen User')

@section('content')
<h3 class="page-title">Manajemen User</h3>

<div class="card">
    <div style="display:flex; justify-content:space-between; margin-bottom:20px;">
        <h4>Daftar Pengguna</h4>
        <a href="{{ route('manajemen.user.create') }}" class="btn btn-sm">
            + Tambah User
        </a>
    </div>

    <div style="overflow-x:auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th style="text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge {{ $user->role === 'admin' ? 'selesai' : '' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="aksi">
                        <a href="{{ route('manajemen.user.edit', $user) }}"
                           class="icon-btn" title="Edit">
                            ✎
                        </a>

                        <form method="POST"
                              action="{{ route('manajemen.user.destroy', $user) }}"
                              class="inline"
                              onsubmit="return confirm('Hapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="icon-btn danger" title="Hapus">
                                🗑
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Tidak ada user</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
