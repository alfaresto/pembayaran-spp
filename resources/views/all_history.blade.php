<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan SPP</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>
<body>
    
    <div class="container mt-5">
        <h2 class=" w-50 px-2 py-1 border-3 text-primary ">Laporan pembayaran SPP</h2>

        <table class="table mt-3">

            <thead>
                <tr class="border-primary">
                    <th class="text-primary">#</th>
                    <th>Nama siswa</th>
                    <th>Tanggal</th>
                    <th>SPP</th>
                    <th>Bayaran masuk</th>
                </tr>
            </thead>

            <tbody>
                @php $no = 1; @endphp
                @foreach ( $pembayaran as $pmb )
                    <tr>
                        <td class="text-primary">{{ $no++ }}</td>
                        <td>{{ $pmb->nama }}</td>
                        <td>{{ $pmb->tgl_bayar }}</td>
                        <td><b>{{ $pmb->tahun }} : </b> Rp. {{ number_format($pmb->nominal) }}</td>
                        <td>{{ number_format($pmb->jumlah_bayar ) }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="4"><b>Total kas : </b> {{ number_format($kas) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="row mt-5 d-flex justify-content-space-around">
            <div class="col-4 text-center">
                <span class="mb-5 d-block text-center">Mengetahui,<br><u>Kepala Sekolah SMKN 3 Tuban</u></span>
                <br><br>
                <span><b>Pak Solahudin</b><br>NIP. .......</span>
            </div>

            <div class="col-4"></div>

            <div class="col-4 text-center">
                <span class="mb-5 d-block">Tuban, @php echo date('d-m-Y') @endphp<br><u>Bendahara sekolah</u></span>
                <br><br>
                <span><b>{{ session()->get('login')['nama_petugas'] }}</b><br>NIP. .......</span>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    window.print()
</script>