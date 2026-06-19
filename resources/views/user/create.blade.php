@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            @if(session('sukses'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('sukses') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card card-primary shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0"><i class="fas fa-user-plus"></i> Tambah User Baru</h3>
                </div>

                <form action="{{ url('/user/store') }}" method="POST">
                    @csrf
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Masukkan username baru" value="{{ old('username') }}">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukan Password">

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="role" class="form-label">Role / Hak Akses</label>
                            <select name="role" class="form-control @error('role') is-invalid @enderror" id="role">
                                <option value="">-- Pilih Hak Akses --</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa (Anggota)</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer bg-light d-flex justify-content-between">
                        <a href="{{ url('/user') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan & Enkripsi
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
