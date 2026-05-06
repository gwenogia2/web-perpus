@extends('layouts.app')

@section('content')

<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Anggota</h4>
        <a href="/anggota/create" class="btn btn-primary">+ Tambah</a>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($anggota as $a)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $a->nama }}</td>
                <td>{{ $a->alamat }}</td>
                <td>{{ $a->no_hp }}</td>
                <td>
                    <a href="/anggota/edit/{{ $a->id }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="/anggota/delete/{{ $a->id }}" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection