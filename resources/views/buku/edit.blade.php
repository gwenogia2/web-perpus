@extends('layouts.app')

@section('content')

<div class="card p-4" style="max-width:500px;">
    <h4>Edit Buku</h4>

    <form method="POST" action="/buku/update/{{ $buku->id }}">
        @csrf

        <label>Judul</label>
        <input type="text" name="judul" value="{{ $buku->judul }}" class="form-control mb-2">

        <label>Penulis</label>
        <input type="text" name="penulis" value="{{ $buku->penulis }}" class="form-control mb-2">

        <label>Stok</label>
        <input type="number" name="stok" value="{{ $buku->stok }}" class="form-control mb-3">

        <button class="btn btn-primary">Update</button>
    </form>
</div>

@endsection