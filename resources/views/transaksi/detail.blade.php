@extends('layouts.app')

@section('content')

<div class="card p-4">
    <h4>Detail Transaksi</h4>

    <hr>

    <p><b>Nama:</b> {{ $transaksi->nama }}</p>
    <p><b>Tanggal Pinjam:</b> {{ $transaksi->tanggal_pinjam }}</p>
    <p><b>Status:</b> 
        @if($transaksi->status == 'pinjam')
            <span class="badge bg-warning text-dark">Dipinjam</span>
        @else
            <span class="badge bg-success">Kembali</span>
        @endif
    </p>

    <hr>

    <h5>Daftar Buku</h5>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Jumlah</th>
            </tr>
        </thead>

        <tbody>
            @foreach($detail as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->judul }}</td>
                <td>{{ $d->jumlah }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="/transaksi" class="btn btn-secondary mt-3">Kembali</a>
</div>

@endsection