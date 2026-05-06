<!DOCTYPE html>
<html>
<head>
    <title>Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background-color: #f5f5f5;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            background-color: #000;
            padding-top: 20px;
        }

        .sidebar h4 {
            color: white;
        }

        .sidebar a {
            display: block;
            color: #bbb;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #dc3545;
            color: white;
        }

        .sidebar .active {
            background-color: #dc3545;
            color: white;
        }

        .content {
            margin-left: 240px;
            padding: 20px;
        }

        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .table thead {
            background-color: #000;
            color: white;
        }

        .btn-primary {
            background-color: #dc3545;
            border: none;
        }

        .btn-primary:hover {
            background-color: #bb2d3b;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h4 class="text-center mb-4">PERPUSKU</h4>

    <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="/anggota" class="{{ request()->is('anggota*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Anggota
    </a>

    <a href="/buku" class="{{ request()->is('buku*') ? 'active' : '' }}">
        <i class="bi bi-book"></i> Buku
    </a>

    <a href="/transaksi" class="{{ request()->is('transaksi*') ? 'active' : '' }}">
        <i class="bi bi-journal-text"></i> Transaksi
    </a>

    <hr class="text-secondary">

    <a href="/logout" class="text-danger">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>