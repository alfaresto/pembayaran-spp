@extends('layouts.main')

@section('content')
    <h2 class=" w-25 px-2 py-1 border-3 text-primary ">Data Petugas</h2>

    <table class="table">
        <div class="row justify-content-end mb-3">
        <div class="col-2">
                <a href="kelas/tambah" class="btn btn-success btn-sm text-white" data-bs-toggle="modal" data-bs-target="#tambah">
                    Tambah <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>

        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Nama petugas</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @php $no = 1; @endphp
            @foreach ( $petugas as $ptgs )
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $ptgs->username }}</td>
                    <td>{{ $ptgs->nama_petugas }}</td>
                    <td>{{ $ptgs->level }}</td>
                    <td>
                        <a href="edit{{ $ptgs->id }}" data-bs-toggle="modal" data-bs-target="#edit{{ $ptgs->id }}" class="m-2 btn btn-secondary btn-sm text-white">
                            edit <i class="fas fa-edit"></i>
                        </a>

                        <a href="hapus{{ $ptgs->id }}" data-bs-toggle="modal" data-bs-target="#hapus{{ $ptgs->id }}" class="m-2 btn btn-danger btn-sm text-white">
                            hapus <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>

                <!-- Modal TAMBAH -->
                <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h3 class="modal-title text-success" id="exampleModalLabel">Tambah Petugas <i class="fas fa-plus"></i></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                        <form action="{{ url('petugas') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Username</b></label>
                                    <input type="text" class="form-control mt-2" name="username">
                                </div>
                                <span class="text-danger">
                                    @error('username')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Password</b></label>
                                    <input type="password" class="form-control mt-2" name="password">
                                </div>
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Nama petugas</b></label>
                                    <input type="text" class="form-control mt-2" name="nama_petugas">
                                </div>
                                <span class="text-danger">
                                    @error('nama_petugas')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Level</b></label>
                                    <select name="level" class="form-select">
                                        <option value="admin">Admin</option>
                                        <option value="petugas">petugas</option>
                                    </select>
                                </div>
                                <span class="text-danger">
                                    @error('level')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="modal-footer mt-5">
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>

                 <!-- Modal EDIT -->
                <div class="modal fade" id="edit{{ $ptgs->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h3 class="modal-title text-secondary" id="exampleModalLabel">Edit Petugas <i class="fas fa-edit"></i></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                        <form action="{{ url('petugas/' . $ptgs->id ) }}" method="post">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Username</b></label>
                                    <input type="text" class="form-control mt-2" name="username" value="{{ $ptgs->username }}">
                                </div>
                                <span class="text-danger">
                                    @error('username')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Password</b></label>
                                    <input type="password" class="form-control mt-2" name="password" value="{{ $ptgs->password }}">
                                </div>
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Nama petugas</b></label>
                                    <input type="text" class="form-control mt-2" name="nama_petugas" value="{{ $ptgs->nama_petugas }}">
                                </div>
                                <span class="text-danger">
                                    @error('nama_petugas')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Level</b></label>
                                    <select name="level" class="form-select">
                                        <option value="admin" {{ $ptgs->level == 'admin' ? 'selected' : ''}} >
                                            Admin
                                        </option>
                                        <option value="petugas" {{ $ptgs->level == 'petugas' ? 'selected' : '' }} >petugas</option>
                                    </select>
                                </div>
                                <span class="text-danger">
                                    @error('level')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="modal-footer mt-5">
                                <button type="submit" class="btn btn-secondary">Ubah</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Modal HAPUS -->

                <div class="modal fade" id="hapus{{ $ptgs->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h3 class="modal-title text-danger fw-bold" id="exampleModalLabel">Hapus Petugas <i class="fas fa-trash"></i></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                        <p>Benar ingin menghapus data Petugas <b class="text-danger fw-italic">{{ $ptgs->nama_petugas }}?</b></p>
                        <form action="{{ url('petugas/' . $ptgs->id ) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <div class="modal-footer mt-5">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <div class="mt-5 d-flex justify-content-center">
        {{-- {{ $ptgsp->links("pagination::bootstrap-4") }} --}}
    </div>

@endsection