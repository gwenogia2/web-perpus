@extends('layouts.app')

@section('content')

<div class="card p-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Data Transaksi</h4>
        <a href="/transaksi/create" class="btn btn-primary">+ Pinjam</a>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Buku</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        @foreach($transaksi as $t)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $t->nama }}</td>
            <td>{{ $t->buku }}</td>
            <td>
                @if($t->status == 'pinjam')
                    <span class="badge bg-warning text-dark">Dipinjam</span>
                @else
                    <span class="badge bg-success">Kembali</span>
                @endif
            </td>
            <td>
                <!-- tombol detail selalu ada -->
                <a href="/transaksi/detail/{{ $t->id }}" class="btn btn-dark btn-sm">
                    Detail
                </a>

                <!-- tombol kembali hanya kalau masih dipinjam -->
                @if($t->status == 'pinjam')
                    <a href="/transaksi/kembali/{{ $t->id }}" class="btn btn-success btn-sm">
                        Kembalikan
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection