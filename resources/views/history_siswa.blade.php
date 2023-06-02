<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>History siswa</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>
<body>

    <div class="container mt-5">
        <h2 class=" w-50 px-2 py-1 border-3 text-primary ">Histori Pembayaran</h2>

        @foreach( $siswa as $sw )
            <div class="px-2">
                <h5>Nama : {{ $sw->nama }}</h5>
                <small>NISN : {{ $sw->nisn }}</small>
            </div>
        @endforeach

        <table class="table mt-3">

            <thead>
                <tr class="border-primary">
                    <th class="text-primary">#</th>
                    <th>Tanggal</th>
                    <th>SPP</th>
                    <th>Bayaran masuk</th>
                </tr>
            </thead>

            <tbody>
                @php $no = 1; @endphp
                @foreach ( $history as $hstr )
                    <tr>
                        <td class="text-primary">{{ $no++ }}</td>
                        <td>{{ $hstr->tgl_bayar}}</td>
                        <td><b>{{ $hstr->tahun }} : </b> Rp. {{ number_format($hstr->nominal) }}</td>
                        <td>{{ number_format($hstr->jumlah_bayar ) }}</td>
                    </tr>
                @endforeach

                @foreach( $siswa as $sw )
                    <tr>
                        <td colspan="4"><b>Total bayar : </b> {{ number_format($total_bayar) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"><b>Sisa bayar : </b>  {{ number_format($kurang) }}</td>
                    </tr>
                @endforeach  
            </tbody>
        </table>
    </div>
    
</body>
</html>