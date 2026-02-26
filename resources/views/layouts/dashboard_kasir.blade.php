<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Kasir')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { margin: 0; background: #f7fbfc; }
        body {
            overflow-x: hidden;
        }

        /* ================= NAVBAR ================= */
        .navbar {
            background: #16a39a;
            color: white;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-title {
            font-size: 20px;
            font-weight: 700;
        }

        .nav-menu {
            display: flex;
            gap: 30px;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            position: relative;
        }

        .nav-menu a:hover {
            opacity: 0.85;
        }

        .nav-menu a.active {
            border-bottom: 2px solid white;
            padding-bottom: 4px;
        }

        .logout {
            background: #e67800;
            border: none;
            color: white;
            padding: 8px 18px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
        }

        /* ================= CONTENT ================= */
        .content {
            padding: 30px;
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

        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }
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

        .btn {
            background: #e67800;
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
            .nav-menu {
                gap: 15px;
                font-size: 13px;
            }

            .logout {
                padding: 6px 12px;
                font-size: 13px;
            }
        }

        .menu-toggle {
            display: none;
            font-size: 22px;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
        }

        /* ===== MOBILE ===== */
        @media (max-width: 768px) {

            .menu-toggle {
                display: block;
            }

            .nav-menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 65px;
                right: 0;
                background: #16a39a;
                width: 100%;
                padding: 15px;
            }

            .nav-menu a {
                padding: 10px 0;
            }

            .nav-menu.show {
                display: flex;
            }
        }

        @media (max-width: 768px) {
            .table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        
    </style>

    @stack('styles')
</head>

<body>

<div class="navbar">

    <div class="nav-left">
            <button class="menu-toggle" onclick="toggleMenu()">
            ☰
        </button>    
    
        <span class="nav-title">Kasir</span>
    </div>

    <div class="nav-menu" id="navMenu">
        <a href="{{ route('kasir.dashboard') }}" 
           class="{{ request()->routeIs('kasir.dashboard') ? 'active' : '' }}">
           Beranda
        </a>

        <a href="{{ route('reservasi.create') }}" 
           class="{{ request()->routeIs('reservasi.create') ? 'active' : '' }}">
           Reservasi
        </a>

        <a href="{{ route('pemesanan.create') }}" 
           class="{{ request()->routeIs('pemesanan.create') ? 'active' : '' }}">
           Pemesanan
        </a>

        <a href="{{ route('kasir.lacak.index') }}" 
           class="{{ request()->routeIs('kasir.lacak.*') ? 'active' : '' }}">
           Update Status
        </a>

        <a href="{{ route('kasir.riwayat.index') }}" 
           class="{{ request()->routeIs('kasir.riwayat.*') ? 'active' : '' }}">
           Riwayat
        </a>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="logout">Logout</button>
    </form>
</div>

<div class="content">
    @yield('content')
</div>

<script>
function toggleMenu() {
    document.getElementById("navMenu").classList.toggle("show");
}
</script>
</body>
</html>