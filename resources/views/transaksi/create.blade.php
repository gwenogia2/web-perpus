@extends('layouts.app')

@section('content')

<div class="card p-4">

    <h4 class="mb-4">
        Peminjaman Buku
    </h4>

    @if(session('sukses'))
        <div class="alert alert-success">
            {{ session('sukses') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/transaksi/store">
        @csrf

        <label class="mb-2">
            Anggota
        </label>

        <select name="anggota_id" class="form-control mb-4" required>
            <option value="">-- Pilih Anggota --</option>
            @foreach($anggota as $a)
                <option value="{{ $a->id }}">
                    {{ $a->nama }}
                </option>
            @endforeach
        </select>

        <h6 class="mb-3">
            Pilih Buku
        </h6>

        @foreach($buku as $b)
        <div class="d-flex align-items-center mb-3">
            <input type="radio"
                   name="buku_id"
                   value="{{ $b->id_buku }}"
                   required>

            <span class="ms-3" style="width:250px;">
                {{ $b->judul }}
            </span>

            <span class="badge bg-dark me-3">
                stok: {{ $b->stok }}
            </span>
        </div>
        @endforeach

        <button class="btn btn-primary mt-3">
            Pinjam
        </button>
    </form>

</div>

@endsection
