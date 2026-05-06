@extends('layouts.app')

@section('content')

<div class="card p-4" style="max-width:500px;">
    <h4>Tambah Buku</h4>

    <form method="POST" action="/buku/store">
        @csrf

        <label>Judul</label>
        <input type="text" name="judul" class="form-control mb-2">

        <label>Penulis</label>
        <input type="text" name="penulis" class="form-control mb-2">

        <label>Stok</label>
        <input type="number" name="stok" class="form-control mb-3">

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>

@endsection