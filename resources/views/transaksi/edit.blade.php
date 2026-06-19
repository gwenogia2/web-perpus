@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Data Transaksi</h5>
                    <a href="{{ url('/transaksi') }}" class="btn btn-light btn-sm text-primary fw-bold">Kembali</a>
                </div>
                <div class="card-body p-4">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ url('/transaksi/update/'.$transaksi->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Anggota</label>
                            <select name="anggota_id" class="form-select" required>
                                @foreach($anggota as $a)
                                    <option value="{{ $a->id }}" {{ $transaksi->anggota_id == $a->id ? 'selected' : '' }}>
                                        {{ $a->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Buku</label>
                            <select name="buku_id" class="form-select" required>
                                @foreach($buku as $b)
                                    <option value="{{ $b->id }}" {{ $transaksi->buku_id == $b->id ? 'selected' : '' }}>
                                        {{ $b->judul }} (Stok: {{ $b->stok }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Status Transaksi</label>
                            <select name="status" class="form-select" required>
                                <option value="pinjam" {{ $transaksi->status == 'pinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="kembali" {{ $transaksi->status == 'kembali' ? 'selected' : '' }}>Kembali</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-bold">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
