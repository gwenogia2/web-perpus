@extends('layouts.app')

@section('content')

<div class="container-fluid">

   
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Dashboard Siswa
            </h3>

            <p class="text-muted mb-0">
                Selamat datang, {{ session('username') }}
            </p>
        </div>

        <div>
            <span class="badge bg-danger p-2 px-3">
                SISWA
            </span>
        </div>

    </div>


  
    <div class="row">

        
        <div class="col-md-6 mb-4">

            <div class="card p-4 h-100">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <p class="text-muted mb-1">
                            Total Buku
                        </p>

                        <h2 class="fw-bold">
                            {{ $totalBuku }}
                        </h2>
                    </div>

                    <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center"
                         style="width:70px; height:70px;">

                        <i class="bi bi-book fs-3"></i>

                    </div>

                </div>

            </div>

        </div>


        
        <div class="col-md-6 mb-4">

            <div class="card p-4 h-100">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <p class="text-muted mb-1">
                            Buku Dipinjam
                        </p>

                        <h2 class="fw-bold text-danger">
                            {{ $dipinjam }}
                        </h2>
                    </div>

                    <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center"
                         style="width:70px; height:70px;">

                        <i class="bi bi-journal-check fs-3"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- QUICK MENU -->
    <div class="card p-4">

        <h5 class="fw-bold mb-4">
            Menu Cepat
        </h5>

        <div class="row">

          
            <div class="col-md-6 mb-3">

                <a href="/list-buku"
                   class="text-decoration-none">

                    <div class="card p-4 border-0 shadow-sm h-100 hover-card">

                        <div class="d-flex align-items-center">

                            <div class="bg-dark text-white rounded p-3 me-3">
                                <i class="bi bi-book fs-4"></i>
                            </div>

                            <div>
                                <h6 class="mb-1 text-dark">
                                    List Buku
                                </h6>

                                <small class="text-muted">
                                    Lihat semua buku perpustakaan
                                </small>
                            </div>

                        </div>

                    </div>

                </a>

            </div>


         
            <div class="col-md-6 mb-3">

                <a href="/pinjam"
                   class="text-decoration-none">

                    <div class="card p-4 border-0 shadow-sm h-100 hover-card">

                        <div class="d-flex align-items-center">

                            <div class="bg-danger text-white rounded p-3 me-3">
                                <i class="bi bi-journal-plus fs-4"></i>
                            </div>

                            <div>
                                <h6 class="mb-1 text-dark">
                                    Pinjam Buku
                                </h6>

                                <small class="text-muted">
                                    Lakukan peminjaman buku
                                </small>
                            </div>

                        </div>

                    </div>

                </a>

            </div>

        </div>

    </div>

</div>


<style>

.hover-card {
    transition: 0.2s;
}

.hover-card:hover {
    transform: translateY(-4px);
}

</style>

@endsection