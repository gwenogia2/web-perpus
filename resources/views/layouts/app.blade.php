<!DOCTYPE html>
<html lang="en">

<head>

    <title>Perpustakaan</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>

        body {
            margin: 0;
            background-color: #f5f5f5;
            font-family: Arial, Helvetica, sans-serif;
        }

        /* ================= SIDEBAR ================= */

        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #000;
            padding-top: 20px;
            overflow-y: auto;
        }

        .sidebar-title {
            color: white;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
            font-size: 20px;
        }

        .sidebar-user {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar-user .username {
            color: white;
            font-weight: 600;
        }

        .sidebar-user .role {
            color: #999;
            font-size: 14px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;

            color: #bbb;
            padding: 14px 18px;
            text-decoration: none;

            margin: 8px 12px;
            border-radius: 12px;

            transition: 0.2s;
            font-size: 15px;
        }

        .sidebar a:hover {
            background-color: #dc3545;
            color: white;
            transform: translateX(4px);
        }

        .sidebar .active {
            background-color: #dc3545;
            color: white;
        }

        .logout-btn {
            color: #ff4d5a !important;
        }

        /* ================= CONTENT ================= */

        .content {
            margin-left: 240px;
            padding: 40px;
            width: calc(100% - 240px);
            min-height: 100vh;
        }

        .container-fluid {
            width: 100%;
        }

        /* ================= CARD ================= */

        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        /* ================= TABLE ================= */

        .table {
            background: white;
            border-radius: 14px;
            overflow: hidden;
        }

        .table thead {
            background-color: #111;
            color: white;
        }

        .table th,
        .table td {
            vertical-align: middle;
            padding: 14px;
        }

        /* ================= BUTTON ================= */

        .btn-primary {
            background-color: #dc3545;
            border: none;
            border-radius: 10px;
            padding: 10px 18px;
        }

        .btn-primary:hover {
            background-color: #bb2d3b;
        }

        .btn-danger {
            border-radius: 10px;
        }

        .btn-warning {
            border-radius: 10px;
        }

        .btn-success {
            border-radius: 10px;
        }

        /* ================= FORM ================= */

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 10px;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width: 768px) {

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

        }

    </style>

</head>

<body>

<!-- ================= SIDEBAR ================= -->

<div class="sidebar">

    <div class="sidebar-title">
        PERPUSKU
    </div>


    {{-- ================= ADMIN ================= --}}
    @if(session('role') == 'admin')

        <a href="/dashboard"
           class="{{ request()->is('dashboard') ? 'active' : '' }}">

            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <a href="/anggota"
           class="{{ request()->is('anggota*') ? 'active' : '' }}">

            <i class="bi bi-people"></i>
            Anggota
        </a>

        <a href="/buku"
           class="{{ request()->is('buku*') ? 'active' : '' }}">

            <i class="bi bi-book"></i>
            Buku
        </a>

        <a href="/transaksi"
           class="{{ request()->is('transaksi*') ? 'active' : '' }}">

            <i class="bi bi-journal-text"></i>
            Transaksi
        </a>

    @endif


    {{-- ================= SISWA ================= --}}
    @if(session('role') == 'siswa')

        <a href="/dashboard-siswa"
           class="{{ request()->is('dashboard-siswa') ? 'active' : '' }}">

            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <a href="/list-buku"
           class="{{ request()->is('list-buku') ? 'active' : '' }}">

            <i class="bi bi-book"></i>
            List Buku
        </a>

        <a href="/pinjam"
           class="{{ request()->is('pinjam*') ? 'active' : '' }}">

            <i class="bi bi-journal-plus"></i>
            Pinjam Buku
        </a>

    @endif

    <hr class="text-secondary">

    <a href="/logout" class="logout-btn">
        <i class="bi bi-box-arrow-right"></i>
        Logout
    </a>

</div>

<!-- ================= CONTENT ================= -->

<div class="content">

    @yield('content')

</div>

</body>
</html>