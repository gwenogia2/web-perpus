@extends('layouts.app')

@section('content')

<div class="card p-4" style="max-width:500px;">
    <h4>Tambah Anggota</h4>

    <form method="POST" action="/anggota/store">
        @csrf

        <label>Nama</label>
        <input type="text" name="nama" class="form-control mb-2">

        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control mb-2">

        <label>No HP</label>
        <input type="text" name="no_hp" class="form-control mb-3">

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>

@endsection