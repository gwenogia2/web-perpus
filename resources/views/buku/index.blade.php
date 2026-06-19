@extends('layouts.app')

@section('content')

<div class="card p-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Data Buku</h4>
        <a href="/buku/create" class="btn btn-primary">+ Tambah</a>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        @foreach($buku as $b)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $b->judul }}</td>
            <td>{{ $b->penulis }}</td>
            <td>
                <span class="badge bg-dark">{{ $b->stok }}</span>
            </td>
            <td>
                <a href="/buku/edit/{{ $b->id_buku }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="/buku/delete/{{ $b->id_buku }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection
