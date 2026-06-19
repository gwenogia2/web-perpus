@extends('layouts.app')

@section('content')

<div class="card p-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Data Transaksi</h4>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        @foreach($transaksi as $t)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $t->nama_anggota ?? '' }}</td>
            <td>{{ $t->judul_buku ?? '' }}</td>
            <td>
                @if($t->status == 'pinjam')
                    <span class="badge bg-warning text-dark">Dipinjam</span>
                @else
                    <span class="badge bg-success">Kembali</span>
                @endif
            </td>
            <td>
                <a href="{{ url('/transaksi/edit/'.$t->id) }}" class="btn btn-primary btn-sm">
                    Edit
                </a>

                @if($t->status == 'pinjam')
                    <a href="{{ url('/transaksi/kembali/'.$t->id) }}" class="btn btn-success btn-sm">
                        Kembalikan
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection
