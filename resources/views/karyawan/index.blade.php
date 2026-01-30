@extends('layouts.dashboard')

@section('title', 'Data Karyawan')

@section('content')
    <h3 class="page-title">Data Karyawan</h3>

    <div class="card">

        {{-- TOP ACTION --}}
        <div class="top-action">
            <div class="export-btn">
                <button class="btn pdf">PDF</button>
                <button class="btn csv">CSV</button>
            </div>

            <a href="{{ route('karyawan.create') }}" class="btn tambah">Tambah Karyawan +</a>
        </div>

        {{-- TABLE --}}
        <div style="margin-top: 20px; overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Karyawan</th>
                        <th>ID Karyawan</th>
                        <th>JK</th>
                        <th>Status</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($karyawans as $karyawan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $karyawan->nama_karyawan }}</td>
                            <td>{{ $karyawan->id_karyawan }}</td>
                            <td>{{ $karyawan->jenis_kelamin }}</td>
                            <td>
                                @if ($karyawan->status === 'aktif')
                                    <span class="badge aktif">Aktif</span>
                                @else
                                    <span class="badge nonaktif">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="aksi">
                                <a href="{{ route('karyawan.show', $karyawan->id_karyawan) }}" title="Detail">👁</a>
                                <a href="{{ route('karyawan.edit', $karyawan->id_karyawan) }}" title="Edit">✎</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; color:#64748b;">
                                Belum ada data karyawan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- STYLE KHUSUS DATA KARYAWAN --}}
    <style>
        .page-title {
            font-weight: 600;
            margin-bottom: 16px;
        }

        .top-action {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .export-btn .btn {
            margin-right: 6px;
        }

        .btn {
            padding: 8px 14px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 13px;
        }

        .btn.pdf {
            background: #fb923c;
            color: white;
        }

        .btn.csv {
            background: #fb923c;
            color: white;
        }

        .btn.tambah {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #334155;
            text-decoration: none;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .table thead {
            background: #16a39a;
            color: white;
        }

        .table th,
        .table td {
            padding: 10px 12px;
            text-align: left;
        }

        .table tbody tr {
            border-bottom: 1px solid #e2e8f0;
        }

        .table tbody tr:hover {
            background: #f1f9f9;
        }

        .aksi {
            text-align: center;
        }

        .aksi button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin: 0 4px;
        }

        .aksi button:hover {
            opacity: 0.7;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge.aktif {
            background: #dcfce7;
            color: #166534;
        }

        .badge.nonaktif {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
@endsection
