@extends('layouts.main')

@section('content')
    <h2 class=" w-25 px-2 py-1 border-3 text-primary ">Data SPP</h2>

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
                <th>Nama Kelas</th>
                <th>Kompetensi Keahlian</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @php $no = 1; @endphp
            @foreach ( $spp as $sp )
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $sp->tahun }}</td>
                    <td>{{ number_format($sp->nominal) }}</td>
                    <td>
                        <a href="edit{{ $sp->id }}" data-bs-toggle="modal" data-bs-target="#edit{{ $sp->id }}" class="m-2 btn btn-secondary btn-sm text-white">
                            edit <i class="fas fa-edit"></i>
                        </a>

                        <a href="hapus{{ $sp->id }}" data-bs-toggle="modal" data-bs-target="#hapus{{ $sp->id }}" class="m-2 btn btn-danger btn-sm text-white">
                            hapus <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>

                <!-- Modal TAMBAH -->
                <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h3 class="modal-title text-success" id="exampleModalLabel">Tambah SPP <i class="fas fa-plus"></i></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                        <form action="{{ url('spp') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Tahun</b></label>
                                    <input type="text" class="form-control mt-2" name="tahun">
                                </div>
                                <span class="text-danger">
                                    @error('tahun')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Nominal</b></label>
                                    <input type="text" class="form-control mt-2" name="nominal">
                                </div>
                                <span class="text-danger">
                                    @error('nominal')
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
                <div class="modal fade" id="edit{{ $sp->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h3 class="modal-title text-secondary" id="exampleModalLabel">Edit SPP <i class="fas fa-edit"></i></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                        <form action="{{ url('spp/' . $sp->id ) }}" method="post">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Tahun</b></label>
                                    <input type="text" class="form-control mt-2" value="{{ $sp->tahun }}" name="tahun">
                                </div>
                                <span class="text-danger">
                                    @error('tahun')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Nominal</b></label>
                                    <input type="number" class="form-control mt-2" value="{{ $sp->nominal }}" name="nominal">
                                </div>
                                <span class="text-danger">
                                    @error('nominal')
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

                <div class="modal fade" id="hapus{{ $sp->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h3 class="modal-title text-danger fw-bold" id="exampleModalLabel">Hapus SPP <i class="fas fa-trash"></i></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                        <p>Benar ingin menghapus data SPP <b class="text-danger fw-italic">{{ $sp->tahun }}?</b></p>
                        <form action="{{ url('spp/' . $sp->id ) }}" method="post">
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
        {{-- {{ $spp->links("pagination::bootstrap-4") }} --}}
    </div>

@endsection