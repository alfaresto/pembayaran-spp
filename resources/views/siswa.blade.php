@extends('layouts.main')

@section('content')

    <h2 class=" w-25 px-2 py-1 border-3 text-primary ">Data Siswa</h2>

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
                <th>Nisn</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>SPP</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @php $no = 1; @endphp
            @foreach ( $siswa as $sw )
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $sw->nisn }}</td>
                    <td>{{ $sw->nama }}</td>
                    <td>{{ $sw->nama_kelas }}</td>
                    <td>{{ $sw->alamat }}</td>
                    <td>{{ $sw->no_telp }}</td>
                    <td>{{ $sw->tahun }}: Rp. <i>{{ number_format($sw->nominal) }}</i></td>
                    <td>
                        <a href="edit{{ $sw->nisn }}" data-bs-toggle="modal" data-bs-target="#edit{{ $sw->nisn }}" class="m-2 btn btn-secondary btn-sm text-white">
                            edit <i class="fas fa-edit"></i>
                        </a>

                        <a href="hapus{{ $sw->nisn }}" data-bs-toggle="modal" data-bs-target="#hapus{{ $sw->nisn }}" class="m-2 btn btn-danger btn-sm text-white">
                            hapus <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>

                <!-- Modal TAMBAH -->
                <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h3 class="modal-title text-success" id="exampleModalLabel">Tambah Murid <i class="fas fa-plus"></i></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                        <form action="{{ url('siswa') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>NISN</b></label>
                                    <input type="text" class="form-control mt-2" name="nisn">
                                </div>
                                <span class="text-danger">
                                    @error('nisn')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>NIS</b></label>
                                    <input type="text" class="form-control mt-2" name="nis">
                                </div>
                                <span class="text-danger">
                                    @error('nis')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Nama siswa</b></label>
                                    <input type="text" class="form-control mt-2" name="nama">
                                </div>
                                <span class="text-danger">
                                    @error('nama')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2 ">
                                    <label name="form-label"><b>Kelas</b></label>
                                    <select class="form-select" name="id_kelas">
                                        @foreach ( $kelas as $kls )
                                            <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">
                                    @error('id_kelas')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Alamat</b></label>
                                    <textarea  class="form-control mt-2" name="alamat"></textarea>
                                </div>
                                <span class="text-danger">
                                    @error('alamat')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>No Telephone</b></label>
                                    <input type="text" class="form-control mt-2" name="no_telp">
                                </div>
                                <span class="text-danger">
                                    @error('no_telp')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2 ">
                                    <label name="form-label"><b>SPP</b></label>
                                    <select class="form-select" name="id_spp">
                                        @foreach ( $spp as $sp )
                                            <option value="{{ $sp->id }}">{{ $sp->tahun }}: Rp. <i>{{ number_format($sp->nominal) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">
                                    @error('id_kelas')
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
                <div class="modal fade" id="edit{{ $sw->nisn }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h3 class="modal-title text-secondary" id="exampleModalLabel">Edit Murid <i class="fas fa-edit"></i></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                        <form action="{{ url('siswa/' . $sw->nisn ) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>NISN</b></label>
                                    <input type="text" class="form-control mt-2" name="nisn" value="{{ $sw->nisn }}">
                                </div>
                                <span class="text-danger">
                                    @error('nisn')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>NIS</b></label>
                                    <input type="text" class="form-control mt-2" name="nis" value="{{ $sw->nis }}">
                                </div>
                                <span class="text-danger">
                                    @error('nis')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Nama siswa</b></label>
                                    <input type="text" class="form-control mt-2" name="nama" value="{{ $sw->nama }}">
                                </div>
                                <span class="text-danger">
                                    @error('nama')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2 ">
                                    <label name="form-label"><b>Kelas</b></label>
                                    <select class="form-select" name="id_kelas">
                                        @foreach ( $kelas as $kls )
                                            <option value="{{ $kls->id }}" {{ $sw->id_kelas == $kls->id ? 'selected' : '' }}>
                                                {{ $kls->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">
                                    @error('id_kelas')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Alamat</b></label>
                                    <textarea  class="form-control mt-2" name="alamat">{{ $sw->alamat }}</textarea>
                                </div>
                                <span class="text-danger">
                                    @error('alamat')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>No Telephone</b></label>
                                    <input type="text" class="form-control mt-2" name="no_telp" value="{{ $sw->no_telp }}">
                                </div>
                                <span class="text-danger">
                                    @error('no_telp')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2 ">
                                    <label name="form-label"><b>SPP</b></label>
                                    <select class="form-select" name="id_spp">
                                        @foreach ( $spp as $sp )
                                            <option value="{{ $sp->id }}" {{ $sw->id_spp == $sp->id ? 'selected' : '' }}>
                                                {{ $sp->tahun }}: Rp. <i>{{ number_format($sp->nominal) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">
                                    @error('id_kelas')
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

                 <!-- Modal EDIT -->
                <div class="modal fade" id="edit{{ $sw->nisn }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h3 class="modal-title text-secondary" id="exampleModalLabel">Edit Murid</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                        <form action="{{ url('siswa/' . $sw->nisn ) }}" method="post">
                            @csrf
                            @method('PUT')

                            
                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>NISN</b></label>
                                    <input type="text" class="form-control mt-2" value="{{ $sw->nisn }}" name="nisn">
                                </div>
                                <span class="text-danger">
                                    @error('nisn')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            </div>

                            <div class="modal-footer mt-5">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Modal HAPUS -->

                <div class="modal fade" id="hapus{{ $sw->nisn }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h3 class="modal-title text-danger fw-bold" id="exampleModalLabel">Hapus Murid <i class="fas fa-trash"></i></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                        <p>Benar ingin menghapus data <b class="text-danger fw-italic">{{ $sw->nama }}?</b></p>
                        <form action="{{ url('siswa/' . $sw->nisn ) }}" method="post">
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
        {{ $siswa->links("pagination::bootstrap-4") }}
    </div>

@endsection