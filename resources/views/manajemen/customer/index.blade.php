@extends('layouts.dashboard')

@section('title', 'Data Customer')

@section('content')
{{-- <h3 class="page-title">Data Customer</h3> --}}
    <div class="card">
    <h3 class="page-title">Daftar Customer</h3>

        {{-- TOP ACTION --}}
        <div class="top-action">
            <div></div>

            <a href="{{ route('manajemen.customer.create') }}" class="btn btn-sm">
                + Tambah Customer 
            </a>
        </div>

        {{-- TABLE --}}
        <div style="margin-top: 20px; overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. WhatsApp</th>
                        <th>Titik Lokasi</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $customer->nama_lengkap }}</td>
                            <td>{{ $customer->alamat }}</td>
                            <td>{{ $customer->no_telp }}</td>
                            <td>
                                @if ($customer->lokasi)
                                    <a href="{{ $customer->lokasi }}" target="_blank" class="link-lokasi">
                                         Lihat
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="aksi">
                                {{-- EDIT --}}
                                <a href="{{ route('manajemen.customer.edit', $customer->id_cust) }}" title="Edit">✎</a>

                                {{-- HAPUS --}}
                                <form action="{{ route('manajemen.customer.destroy', $customer->id_cust) }}"
                                      method="POST"
                                      style="display:inline;"
                                      onsubmit="return confirm('Yakin ingin menghapus customer ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus">🗑</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; color:#64748b;">
                                Belum ada data customer
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- STYLE (SAMA PERSIS DENGAN KARYAWAN) --}}
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

        .btn {
            background: #ff8a00;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            align-self: flex-end;
            margin-top: 15px;
            text-decoration: none;
            display: inline-flex;
            line-height: 1;
        }

        /* 🔥 BUTTON TAMBAH CUSTOMER - ORANGE */
        .btn-sm {
            padding: 10px 16px;
            font-size: 14px;
        }

        .btn-sm:hover {
            background: #e67800; /* orange lebih gelap dikit */
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

        /* ✏️ EDIT POLLOSAN */
        .aksi {
            display: flex;
            justify-content: center;
            align-items: center;     
            gap: 8px;
        }

        .aksi form {
            margin: 0;
        }

        .aksi a {
            text-decoration: none;
            color: inherit; /* ikut warna teks default */
            font-size: 16px;
            margin: 0 4px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .aksi button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin: 0 4px;
        }

        .aksi a:hover,
        .aksi button:hover {
            opacity: 0.7;
        }

                /* 🔗 LINK TITIK LOKASI */
        .link-lokasi {
            color: #f97316; /* biru default */
            text-decoration: underline;
        }

        .link-lokasi:hover {
            color: #f97316;
        }

    </style>
@endsection
