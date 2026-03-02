@extends('layouts.dashboard')

@section('title', 'Data Karyawan')

@section('content')
    <h3 class="page-title">Data Karyawan</h3>

    <div class="card">

        {{-- TOP ACTION --}}
        <div class="top-action">
            <div class="export-btn">
                <a href="{{ route('karyawan.export.pdf') }}" class="btn pdf">
                    Unduh PDF
                </a>
                <a href="{{ route('karyawan.export.csv') }}" class="btn csv">
                    Unduh CSV
                </a>
            </div>

            <a href="{{ route('karyawan.create') }}" class="btn tambah">Tambah Karyawan +</a>
        </div>

        {{-- TABLE --}}
        <div style="margin-top: 20px; overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th style="text-align:center;">No.</th>
                        <th style="text-align:center;">Nama Karyawan</th>
                        <th style="text-align:center;">ID Karyawan</th>
                        <th style="text-align:center;">JK</th>
                        <th style="text-align:center;">Outlet</th>
                        <th style="text-align:center;">Status</th>
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
                            <td>{{ $karyawan->outlet->nama_outlet ?? '-' }}</td>
                            <td style="text-align:center;">
                                @php
                                    $status = strtolower(trim($karyawan->status));
                                @endphp

                                @if ($status == 'aktif')
                                    <span class="badge aktif">Aktif</span>
                                @elseif ($status == 'tidak_aktif')
                                    <span class="badge nonaktif">Tidak Aktif</span>
                                @else
                                    <span class="badge nonaktif">Tidak Diketahui</span>
                                @endif
                            </td>
                            <td class="aksi">
                                {{-- DETAIL --}}
                                <a href="{{ route('karyawan.show', $karyawan->id_karyawan) }}" title="Detail" class="icon-detail">👁</a>

                                {{-- HAPUS --}}
                                <form action="{{ route('karyawan.destroy', $karyawan->id_karyawan) }}"
                                    method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus karyawan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus">🗑</button>
                                </form>
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

                /* 🔥 BUTTON TAMBAH KARYAWAN - ORANGE */
        .btn.tambah {
            background: #fb923c;
            color: white;
            text-decoration: none;
            border: none;
        }

        .btn.tambah:hover {
            background: #f97316; /* orange lebih gelap dikit */
        }

        .btn.pdf {
            background: #fb923c;
            color: white;
        }

        .btn.csv {
            background: #fb923c;
            color: white;
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
            background: rgba(22,163,154,0.15);
            color: #16a39a;
        }

        .badge.nonaktif {
            background: rgba(230,120,0,0.15);
            color: #e67800;
        }

        .aksi a.icon-detail {
            text-decoration: none;
            font-size: 16px;
            margin: 0 4px;
            color: #64748b; /* abu-abu */
        }

        .aksi a.icon-detail:hover {
            opacity: 0.7;
        }
    </style>
@endsection
