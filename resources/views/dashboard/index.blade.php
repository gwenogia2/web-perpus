@extends('layouts.app')

@section('content')

<style>

    .dashboard-title {
        font-size: 32px;
        font-weight: 700;
        color: #111;
    }

    .dashboard-subtitle {
        color: #777;
        font-size: 15px;
    }

    .dashboard-card {
        border: none;
        border-radius: 18px;
        padding: 28px;
        background: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: 0.2s;
        height: 100%;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
    }

    .dashboard-label {
        color: #777;
        font-size: 15px;
        margin-bottom: 8px;
    }

    .dashboard-number {
        font-size: 38px;
        font-weight: 700;
        color: #111;
    }

    .dashboard-icon {
        width: 70px;
        height: 70px;
        border-radius: 16px;

        display: flex;
        align-items: center;
        justify-content: center;

        color: white;
        font-size: 30px;
    }

    .bg-red {
        background: #dc3545;
    }

    .bg-black {
        background: #111;
    }

</style>


<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-5">

        <h2 class="dashboard-title">
            Dashboard
        </h2>

        <p class="dashboard-subtitle">
            Selamat datang kembali
        </p>

    </div>


    <!-- CARD -->
    <div class="row g-4">

        <!-- TOTAL ANGGOTA -->
        <div class="col-lg-4 col-md-6">

            <div class="dashboard-card">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="dashboard-label">
                            Total Anggota
                        </div>

                        <div class="dashboard-number">
                            {{ $totalAnggota }}
                        </div>

                    </div>

                    <div class="dashboard-icon bg-red">
                        <i class="bi bi-people"></i>
                    </div>

                </div>

            </div>

        </div>


        <!-- TOTAL BUKU -->
        <div class="col-lg-4 col-md-6">

            <div class="dashboard-card">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="dashboard-label">
                            Total Buku
                        </div>

                        <div class="dashboard-number">
                            {{ $totalBuku }}
                        </div>

                    </div>

                    <div class="dashboard-icon bg-black">
                        <i class="bi bi-book"></i>
                    </div>

                </div>

            </div>

        </div>


        <!-- DIPINJAM -->
        <div class="col-lg-4 col-md-6">

            <div class="dashboard-card">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="dashboard-label">
                            Dipinjam
                        </div>

                        <div class="dashboard-number">
                            {{ $dipinjam }}
                        </div>

                    </div>

                    <div class="dashboard-icon bg-red">
                        <i class="bi bi-journal-text"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
