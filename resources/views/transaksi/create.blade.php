@extends('layouts.app')

@section('content')

<div class="card p-4">
    <h4>Peminjaman Buku</h4>

    <form method="POST" action="/transaksi/store">
        @csrf

        <label>Anggota</label>
        <select name="anggota_id" class="form-control mb-3">
            @foreach($anggota as $a)
                <option value="{{ $a->id }}">{{ $a->nama }}</option>
            @endforeach
        </select>

        <h6>Pilih Buku</h6>

        @foreach($buku as $b)
        <div class="d-flex align-items-center mb-2">
            <input type="checkbox" name="buku_id[]" value="{{ $b->id }}">

            <span class="ms-2" style="width:200px;">
                {{ $b->judul }}
            </span>

            <span class="badge bg-dark me-2">stok: {{ $b->stok }}</span>

            <input type="number"
                   name="jumlah[{{ $b->id }}]"
                   value="1"
                   min="1"
                   class="form-control"
                   style="width:80px;">
        </div>
        @endforeach

        <button class="btn btn-primary mt-3">Pinjam</button>
    </form>
</div>

@endsection