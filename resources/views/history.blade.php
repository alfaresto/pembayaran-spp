@extends('layouts.main')

@section('content')

    <h2 class=" w-50 px-2 py-1 border-3 text-primary ">Histori Pembayaran</h2>

    <table class="table">

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
                        <a href="history/{{ $pmb->nisn }}/{{ $pmb->nominal }}" class="m-2 btn btn-primary btn-sm text-white">
                            Lihat history <i class="fas fa-book"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-5 d-flex justify-content-center">
    {{ $pembayaran->links("pagination::bootstrap-4") }}
    </div>

@endsection