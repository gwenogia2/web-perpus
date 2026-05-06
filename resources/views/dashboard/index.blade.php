@extends('layouts.app')

@section('content')

<h3 class="mb-4">Dashboard</h3>

<div class="row">

    <div class="col-md-3">
        <div class="card p-3">
            <h6>Total Anggota</h6>
            <h3>{{ $totalAnggota }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3">
            <h6>Total Buku</h6>
            <h3>{{ $totalBuku }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3">
            <h6>Dipinjam</h6>
            <h3>{{ $dipinjam }}</h3>
        </div>
    </div>
</div>

@endsection