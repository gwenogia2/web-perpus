@extends('layouts.app')

@section('content')

<div class="card p-4">

    <h4 class="mb-3">Daftar Buku</h4>

    <table class="table table-hover">

        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Stok</th>
            </tr>
        </thead>

        <tbody>
            @foreach($buku as $b)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $b->judul }}</td>
                <td>{{ $b->penulis }}</td>
                <td>
                    <span class="badge bg-dark">
                        {{ $b->stok }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection