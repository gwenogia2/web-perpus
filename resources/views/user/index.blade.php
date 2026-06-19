@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">

            @if(session('sukses'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('sukses') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0"><i class="fas fa-users"></i> Data Pengguna Sistem (User)</h3>
                    <a href="{{ url('/user/create') }}" class="btn btn-light btn-sm text-primary fw-bold">
                        <i class="fas fa-user-plus"></i> Tambah User Baru
                    </a>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped text-nowrap mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data_user as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <span class="badge bg-secondary p-2">{{ $row->username }}</span>
                                </td>
                                <td>
                                    <code class="text-danger" title="{{ $row->password }}">
                                        {{ Str::limit($row->password, 20, '...') }}
                                    </code>
                                </td>
                                <td>
                                    @if($row->role == 'admin')
                                        <span class="badge bg-success"><i class="fas fa-user-shield"></i> Admin</span>
                                    @else
                                        <span class="badge bg-info text-dark"><i class="fas fa-user"></i> Siswa</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/user/edit/'.$row->id) }}" class="btn btn-warning btn-sm fw-bold text-dark me-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ url('/user/delete/'.$row->id) }}" class="btn btn-danger btn-sm fw-bold" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </a>
                                </td>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                                    Belum ada data user dalam database.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
