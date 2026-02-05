<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            background: #f7fbfc;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
            align-items: stretch;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #16a39a;
            color: #ffffff;
            padding: 25px;
            display: flex;
            flex-direction: column;
        }

        .sidebar h3 {
            margin-bottom: 45px;
            font-size: 20px;
            font-weight: 700;
        }

        .divider {
            height: 1px;
            background: rgba(255,255,255,.35);
            margin: 18px 0;
        }

        .menu a,
        .dropdown-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 15.5px;
            font-weight: 600;
            color: #fff;
            text-decoration: none;
            margin-bottom: 14px;
            cursor: pointer;
        }

        .menu-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .menu svg {
            width: 16px;
            height: 16px;
            stroke: white;
            stroke-width: 1.6;
        }

        .menu a:hover,
        .dropdown-toggle:hover {
            transform: translateX(3px);
        }

        /* SUBMENU */
        .submenu {
            margin-left: 28px;
            margin-top: 6px;
            display: none;
            flex-direction: column;
        }

        .submenu a {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 10px;
            opacity: .95;
        }

        .submenu.show {
            display: flex;
        }

        /* ARROW */
        .arrow {
            width: 14px;
            height: 14px;
            transition: transform .2s ease;
        }

        .arrow.rotate {
            transform: rotate(180deg);
        }

        .logout {
            margin-top: auto;
            background: #FE7F2D;
            border: none;
            color: white;
            padding: 10px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 30px;
        }

        .page-title {
            font-weight: 600;
            color: #0b2c4d;
            margin-bottom: 20px;
        }

        /* CARD */
        .card {
            background: #f9fdff;
            border: 1px solid #dbeafe;
            border-radius: 10px;
            padding: 20px;
            max-width: 100%;
        }

        .card h4 {
            margin-bottom: 20px;
            color: #0b2c4d;
        }

        /* FORM */
        .row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            
        }

        input, select, textarea {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 14px;
        }

        textarea {
            resize: none;
            height: 90px;
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

        .btn-secondary {
            background: #94a3b8;
        }

        .btn-secondary:hover {
            background: #7b8794;
        }

        .btn-sm {
            padding: 10px 16px;
            font-size: 14px;
        }


        .btn:hover {
            background: #e67800;
        }

        .btn-row {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
        }

        /* OUTLET LIST */
        .outlet-list {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        /* OUTLET CARD */
        .outlet-card {
            background: linear-gradient(135deg, #1fc8b8 0%, #16a39a 100%);
            color: white;
            border-radius: 14px;
            padding: 18px 20px;
            box-shadow: 0 6px 14px rgba(0,0,0,.12);

            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        /* INFO */
        .outlet-title {
            font-weight: 700;
            font-size: 15.5px;
            margin-bottom: 6px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .card h4 {
            margin-top: 24px;
            margin-bottom: 14px;
        }

        .outlet-address {
            font-size: 13.5px;
            opacity: .95;
            margin-bottom: 6px;
            line-height: 1.5;
        }

        .outlet-phone {
            font-size: 13px;
            opacity: .9;
        }

        /* ACTION */
        .outlet-action {
            display: flex;
            align-items: flex-end;
        }

        /* ===== GLOBAL TABLE STYLE (RIWAYAT, USER, DLL) ===== */
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
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .icon-btn {
            background: none;
            border: none;
            padding: 4px;
            color: #475569;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
        }

        .icon-btn:hover {
            color: #16a39a;
        }

        .icon-btn.danger:hover {
            color: #dc2626;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge.selesai {
            background: #16a39a;
            color: #fff;
        }

        .form-group select,
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px 10px;
            font-size: 14px;
        }

        .layanan-flex {
            display: flex;
            flex-wrap: wrap;   /* 🔥 ini yang bikin ke samping lalu turun */
            gap: 8px;
        }

        .layanan-chip {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .layanan-chip select {
            width: 150px;      /* 🔥 ukuran kecil / compact */
            padding: 6px;
            font-size: 13px;
        }

        .layanan-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .layanan-row select {
            width: 220px;
            padding: 8px;
        }

        .chip-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .chip {
            background: #eef2ff;
            border-radius: 20px;
            padding: 6px 12px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .chip span {
            cursor: pointer;
            font-weight: bold;
        }


        .btn-add,
        .btn-remove {
            height: 34px;
            padding: 0 10px;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        .btn-add {
            background: #2ecc71;
            color: white;
        }

        .btn-remove {
            background: #e74c3c;
            color: white;
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="wrapper">
     <!-- SIDEBAR -->
    <div class="sidebar">
        <h3>Super Admin</h3>

        <div class="menu">
            <!-- BERANDA -->
            <a href="{{ route('admin.dashboard') }}">
                <div class="menu-left">
                    <svg fill="none" viewBox="0 0 24 24">
                        <path d="M3 9.75L12 4.5l9 5.25v9.75H3z"/>
                    </svg>
                    Beranda
                </div>
            </a>

            <!-- INPUT -->
            <a href="{{ route('reservasi.create') }}">
                <div class="menu-left">
                    <svg fill="none" viewBox="0 0 24 24">
                        <path d="M8 7h8M8 11h8M8 15h6"/>
                        <rect x="4" y="3" width="16" height="18" rx="2"/>
                    </svg>
                    Input Reservasi
                </div>
            </a>

            <a href="{{ route('pemesanan.create') }}">
                <div class="menu-left">
                    <svg fill="none" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="16" rx="2"/>
                        <path d="M3 8h18"/>
                    </svg>
                    Input Pemesanan
                </div>
            </a>

            <div class="divider"></div>

            <!-- TRACKING -->
            <a href="{{ route('lacak.index') }}">
                <div class="menu-left">
                    <svg fill="none" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 7v5l3 2"/>
                    </svg>
                    Update Status
                </div>
            </a>

            <a href="{{ route('riwayat.index') }}">
                <div class="menu-left">
                    <svg fill="none" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 9v4l2 2"/>
                    </svg>
                    Riwayat Pemesanan
                </div>
            </a>

            <div class="divider"></div>

            @if(auth()->user()->role === 'admin')
            <!-- MANAJEMEN -->
            <div class="dropdown-toggle" onclick="toggleMenu('manajemen-menu')">
                <div class="menu-left">
                    <svg fill="none" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    Manajemen
                </div>
                <svg class="arrow" fill="none" viewBox="0 0 24 24">
                    <path d="M6 9l6 6 6-6"/>
                </svg>
            </div>

            <div class="submenu" id="manajemen-menu">
                <a href="{{ route('manajemen.indexpromo') }}">Promo</a>
                <a href="{{ route('manajemen.customer.index') }}">Customer</a>
                <a href="{{ route('manajemen.harga.index') }}">Harga</a>
                <a href="{{ route('manajemen.user.index') }}">User</a>
            </div>


            <!-- PENGATURAN -->
            <div class="dropdown-toggle" onclick="toggleMenu('pengaturan-menu')">
                <div class="menu-left">
                    <svg fill="none" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 20c1.5-4 14.5-4 16 0"/>
                    </svg>
                    Pengaturan
                </div>
                <svg class="arrow" fill="none" viewBox="0 0 24 24">
                    <path d="M6 9l6 6 6-6"/>
                </svg>
            </div>

            <div class="submenu" id="pengaturan-menu">
                <a href="{{ route('outlet.index') }}">Outlet</a>
                <a href="{{ route('karyawan.index') }}">Karyawan</a>
            </div>
            @endif
        </div>

        <form method="POST" action="{{ route('logout') }}"
            style="margin-top:auto; display:flex; justify-content:center;">
            @csrf
            <button class="logout"
                    style="width:80%; border-radius:30px; padding:12px 0;">
                Log Out
            </button>
        </form>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>
</div>

<script>
function toggleMenu(id) {
    const submenu = document.getElementById(id);
    const arrow = submenu.previousElementSibling.querySelector('.arrow');
    submenu.classList.toggle('show');
    arrow.classList.toggle('rotate');
}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        title: 'Berhasil 🎉',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK',
        confirmButtonColor: '#22c55e',
        backdrop: true,
    });
</script>
@endif

</body>
</html>
