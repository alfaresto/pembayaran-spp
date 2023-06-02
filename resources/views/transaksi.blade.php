@extends('layouts.main')

@section('content')

@php
    // foreach( $pembayaran as $pmb ) {
    //     var_dump($pmb->nama_kelas);
    // }die;

    // foreach( $total_bayar as $tb ) {
    //     var_dump($tb);
    // }die;
@endphp

    <h2 class=" w-50 px-2 py-1 border-3 text-primary ">TRANSAKSI PEMBAYARAN</h2>

    <table class="table">
        <div class="row justify-content-end mb-3">
            <div class="col-2">
                <a href="{{ url('cetak-laporan') }}" class="btn btn-info btn-sm text-white" target="_blank">
                    Cetak Laporan <i class="fas fa-edit"></i>
                </a>
            </div>
        </div>

        <thead>
            <tr class="border-primary">
                <th class="text-primary">#</th>
                <th>Nisn</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>SPP</th>
                <th>Tanggungan</th>
                <th>Dibayar</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @php $no = 1; @endphp
            @php $index = 0; @endphp
            @foreach ( $pembayaran as $pmb )
                <tr>
                    <td class="text-primary">{{ $no++ }}</td>
                    <td>{{ $pmb->nisn }}</td>
                    <td>{{ $pmb->nama }}</td>
                    <td>{{ $pmb->nama_kelas }}</td>
                    <td>{{ $pmb->tahun }}: Rp. <i>{{ number_format($pmb->nominal) }}</i></td>
                    
                    <td>{{ number_format($kurang[$index]) }}</td>
                    <td>{{ number_format($total_bayar[$index]) }}</td>
                    @php $index = $index + 1; @endphp
                    <td>
                        <a href="bayar{{ $pmb->nisn }}" data-bs-toggle="modal" data-bs-target="#bayar{{ $pmb->nisn }}" class="m-2 btn btn-success btn-sm text-white">
                            Bayar <i class="fas fa-computer"></i>
                        </a>
                    </td>
                </tr>

                <!-- Modal TAMBAH -->
                <div class="modal fade" id="bayar{{ $pmb->nisn }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h3 class="modal-title text-success" id="exampleModalLabel">Bayarkan <i class="fas fa-computer"></i></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                        <form action="{{ url('transaksi/' . $pmb->nisn) }}" method="post">
                            @csrf
                            @method('PUT')

                            <input type="number" class="form-control mt-2" name="id_spp" value="{{ $pmb->id_spp }}" hidden>

                            <div class="mb-3">
                                <div class="col-10 mb-2">
                                    <label name="form-label"><b>Nominal Pembayaran</b></label>
                                    <input type="number" class="form-control mt-2" name="jumlah_bayar">
                                </div>
                                <span class="text-danger">
                                    @error('jumlah_bayar')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="modal-footer mt-5">
                                <button type="submit" class="btn btn-success">Bayarkan</button>
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
        {{ $pembayaran->links("pagination::bootstrap-4") }}
    </div>
@endsection