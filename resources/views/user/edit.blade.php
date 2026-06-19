@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> Terjadi kesalahan input! Silakan cek kembali.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0"><i class="fas fa-user-edit"></i> Edit Data Pengguna</h3>
                </div>

                <div class="card-body p-4">
                    <form action="{{ url('/user/update/'.$user->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Password Baru</label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin diubah">
                            <small class="text-muted d-block mt-1">
                                <i class="fas fa-info-circle"></i> Jika diisi, password baru akan otomatis dienkripsi menggunakan XOR.
                            </small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Role / Hak Akses</label>
                            <select name="role" class="form-select" required>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ url('/user') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary fw-bold">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
