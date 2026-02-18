<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Kasir')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body { margin: 0; background: #f7fbfc; }

        .wrapper { display: flex; min-height: 100vh; }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 250px;
            background: #16a39a;
            color: white;
            padding: 25px;
            display: flex;
            flex-direction: column;
            transition: all .3s ease;
            z-index: 2000;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 40px;
        }

        .hamburger-btn {
            background: none;
            border: none;
            color: white;
            font-size: 22px;
            cursor: pointer;
        }

        .sidebar-title {
            font-size: 20px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* ===== COLLAPSED MODE ===== */
        .sidebar.collapsed {
            width: 72px;
            padding: 20px 8px;
        }

        .sidebar.collapsed .sidebar-title,
        .sidebar.collapsed span,
        .sidebar.collapsed .submenu {
            display: none !important;
        }

        .sidebar.collapsed .menu a,
        .sidebar.collapsed .dropdown-toggle {
            justify-content: center;
        }

        .sidebar.collapsed svg {
            margin: 0 auto;
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
            font-size: 15px;
            font-weight: 600;
            color: white;
            text-decoration: none;
            margin-bottom: 14px;
            padding: 0 12px;
            height: 25px;
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

        .submenu {
            margin-left: 28px;
            margin-top: 6px;
            display: none;
            flex-direction: column;
        }

        .submenu.show { display: flex; }

        .submenu a {
            font-size: 14px;
            margin-bottom: 10px;
            opacity: .95;
        }

        .arrow {
            width: 14px;
            height: 14px;
            transition: transform .2s;
        }

        .arrow.rotate { transform: rotate(180deg); }

        .logout {
            margin-top: auto;
            background: #FE7F2D;
            border: none;
            color: white;
            padding: 12px;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 600;
            width: 80%;
        }

        /* ================= CONTENT ================= */
        .content {
            flex: 1;
            padding: 30px;
            transition: all .3s ease;
        }

        .page-title {
            font-weight: 600;
            color: #0b2c4d;
            margin-bottom: 20px;
        }

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

        .row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
             margin-bottom: 8px;
            gap: 6px;
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

        .btn {
            background: #ff8a00;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn:hover {
            background: #e67800;
        }

        .btn-secondary {
            background: #94a3b8;
        }

        .btn-secondary:hover {
            background: #7b8794;
        }

        .btn-sm {
            padding: 8px 14px;
            font-size: 14px;
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
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge.selesai {
            background: #16a39a;
            color: white;
        }


        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar { position: fixed; height: 100%; }
            .content { margin-left: 72px; }
        }
    </style>

    <!-- ================= TAMBAHKAN FONT AWESOME DI BAWAH INI ================= -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @stack('styles')
</head>

<body>
<div class="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-header">
            <button id="sidebarToggle" class="hamburger-btn">☰</button>
            <span class="sidebar-title">Kasir</span>
        </div>

        <div class="menu">
            <a href="{{ route('kasir.dashboard') }}">
                <div class="menu-left">
                    <svg fill="none" viewBox="0 0 24 24"><path d="M3 9.75L12 4.5l9 5.25v9.75H3z"/></svg>
                    <span>Beranda</span>
                </div>
            </a>

            <a href="{{ route('reservasi.create') }}">
                <div class="menu-left">
                    <svg fill="none" viewBox="0 0 24 24"><path d="M8 7h8M8 11h8M8 15h6"/><rect x="4" y="3" width="16" height="18" rx="2"/></svg>
                    <span>Reservasi</span>
                </div>
            </a>

            <a href="{{ route('pemesanan.create') }}">
                <div class="menu-left">
                    <svg fill="none" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 8h18"/></svg>
                    <span>Pemesanan</span>
                </div>
            </a>

            <div class="divider"></div>

            <a href="{{ route('kasir.lacak.index') }}">
                <div class="menu-left">
                    <svg fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                    <span>Update Status</span>
                </div>
            </a>

            <a href="{{ route('kasir.riwayat.index') }}">
                <div class="menu-left">
                    <svg fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 9v4l2 2"/></svg>
                    <span>Riwayat</span>
                </div>
            </a>
        </div>

        <form method="POST" action="{{ route('logout') }}" style="display:flex; justify-content:center;">
            @csrf
            <button class="logout"><span>Logout</span></button>
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

document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.querySelector('.sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');

    if (window.innerWidth <= 768) sidebar.classList.add('collapsed');

    toggleBtn.addEventListener('click', () => sidebar.classList.toggle('collapsed'));

    window.addEventListener('resize', () => {
        window.innerWidth <= 768
            ? sidebar.classList.add('collapsed')
            : sidebar.classList.remove('collapsed');
    });
});
</script>
</body>
</html>
