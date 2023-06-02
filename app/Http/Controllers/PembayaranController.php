<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( session()->missing('login') ) {
            return redirect('login-siswa');
        }
        
        $pembayaran = Siswa::join('kelas', 'siswas.id_kelas', '=', 'kelas.id')->join('spps', 'siswas.id_spp', '=', 'spps.id')->orderBy('nisn', 'DESC')->select(['siswas.*', 'kelas.*', 'spps.*'])->paginate(4);

        // $kelas = Kelas::all();
        // $spp = Spp::all();
        $tb = [];
        $kr = [];

        foreach( $pembayaran as $pmb ) {
            $total_bayar = Pembayaran::where('pembayarans.nisn', $pmb->nisn)->sum('jumlah_bayar');
            $kurang = $pmb->nominal - $total_bayar;

            $tb[] = $total_bayar;
            $kr[] = $kurang;
        }

        // var_dump($tb);die;

        return view('transaksi', 
        [
        'title' => 'Data Transaksi',
        'pembayaran' => $pembayaran,
        'total_bayar' => $tb,
        'kurang' => $kr
        ]);
    }

    public function index2()
    {   
        $pembayaran = Siswa::join('kelas', 'siswas.id_kelas', '=', 'kelas.id')->join('spps', 'siswas.id_spp', '=', 'spps.id')->orderBy('nisn', 'DESC')->select(['siswas.*', 'kelas.*', 'spps.*'])->paginate(4);

        // $kelas = Kelas::all();
        // $spp = Spp::all();

        $tb = [];
        $kr = [];

        foreach( $pembayaran as $pmb ) {
            $total_bayar = Pembayaran::where('pembayarans.nisn', $pmb->nisn)->sum('jumlah_bayar');
            $kurang = $pmb->nominal - $total_bayar;

            $tb[] = $total_bayar;
            $kr[] = $kurang;
        }

        return view('history', 
        [
        'title' => 'History',
        'pembayaran' => $pembayaran,
        'total_bayar' => $tb,
        'kurang' => $kr
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nisn, $nominal)
    {
        // echo $nisn;die;
        $history = Pembayaran::where('pembayarans.nisn', $nisn)->join('siswas', 'pembayarans.nisn', '=', 'siswas.nisn')->join('spps', 'pembayarans.id_spp', '=', 'spps.id')->orderBy('pembayarans.id', 'DESC')->select(['pembayarans.*', 'siswas.*', 'spps.*'])->get();
        $siswa = Siswa::where('nisn', $nisn)->get();

        $total_bayar = Pembayaran::where('pembayarans.nisn', $nisn)->sum('jumlah_bayar');
        $kurang = $nominal - $total_bayar;

        return view('history_siswa', 
        [
        'title' => 'History Siswa',
        'history' => $history,
        'siswa' => $siswa,
        'total_bayar' => $total_bayar,
        'kurang' => $kurang
        ]);
    }

    public function show2()
    {
        // echo $nisn;die;
        $nisn = session()->get('login')['nisn'];
        $nominal = Siswa::where('nisn', $nisn)->join('spps', 'siswas.id_spp', '=', 'spps.id')->select([
            'spps.nominal'
        ])->first();
        // var_dump($nominal['nominal']);die;
        $history = Pembayaran::where('pembayarans.nisn', $nisn)->join('siswas', 'pembayarans.nisn', '=', 'siswas.nisn')->join('spps', 'pembayarans.id_spp', '=', 'spps.id')->orderBy('pembayarans.id', 'DESC')->select(['pembayarans.*', 'siswas.*', 'spps.*'])->get();
        $siswa = Siswa::where('nisn', $nisn)->get();

        $total_bayar = Pembayaran::where('pembayarans.nisn', $nisn)->sum('jumlah_bayar');
        $kurang = $nominal['nominal'] - $total_bayar;

        return view('history_siswa', 
        [
        'title' => 'History Siswa',
        'history' => $history,
        'siswa' => $siswa,
        'total_bayar' => $total_bayar,
        'kurang' => $kurang
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nisn)
    {
        $transaksi = Siswa::where('siswas.nisn', $nisn)->join('spps', 'siswas.id_spp', '=', 'spps.id')->orderBy('siswas.nisn', 'DESC')->select(['siswas.*', 'spps.*'])->paginate(4);

        $data = $request->validate([
            'id_spp' => 'max: 11',
            'jumlah_bayar' => 'max: 11',
        ]);

        $bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        $tgl_bayar = date('Y-m-d');
        $bulan_dibayar = $bulan[date('m')];
        $tahun_dibayar = date('Y');

        Pembayaran::create([
            'id_petugas' => 1,
            'nisn' => $nisn,
            'tgl_bayar' => $tgl_bayar,
            'bulan_dibayar' => $bulan_dibayar,
            'tahun_dibayar' => $tahun_dibayar,
            'id_spp' => $data['id_spp'],
            'jumlah_bayar' => $data['jumlah_bayar'],
        ]);

        return redirect('transaksi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cetak_laporan() {
        $pembayaran = Pembayaran::join('siswas', 'pembayarans.nisn', '=', 'siswas.nisn')->join('spps', 'pembayarans.id_spp', '=', 'spps.id')->orderBy('pembayarans.id', 'DESC')->select(['pembayarans.*', 'siswas.*', 'spps.*'])->get();

        $kas = Pembayaran::sum('jumlah_bayar');

        return view('all_history', 
        [
        'title' => 'History Siswa',
        'pembayaran' => $pembayaran,
        'kas' => $kas
        ]);
    }
}
