@extends('layouts.app')

@section('content')

<div class="card p-4">

    <h4 class="mb-4">
        Peminjaman Buku
    </h4>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <form method="POST" action="/pinjam/store">

        @csrf

        <!-- ANGGOTA -->
        <label class="mb-2">
            Anggota
        </label>

        <select name="anggota_id"
                class="form-control mb-4">

            @foreach($anggota as $a)

                <option value="{{ $a->id }}">
                    {{ $a->nama }}
                </option>

            @endforeach

        </select>


        <!-- BUKU -->
        <h6 class="mb-3">
            Pilih Buku
        </h6>

        @foreach($buku as $b)

        <div class="d-flex align-items-center mb-3">

            <input type="checkbox"
                   name="buku_id[]"
                   value="{{ $b->id }}">

            <span class="ms-3"
                  style="width:250px;">

                {{ $b->judul }}

            </span>

            <span class="badge bg-dark me-3">

                stok: {{ $b->stok }}

            </span>

            <input type="number"
                   name="jumlah[{{ $b->id }}]"
                   value="1"
                   min="1"
                   class="form-control"
                   style="width:90px;">

        </div>

        @endforeach


        <button class="btn btn-primary mt-3">

            Pinjam

        </button>

    </form>

</div>

@endsection