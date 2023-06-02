<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
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
        
        $siswa = Siswa::join('kelas', 'siswas.id_kelas', '=', 'kelas.id')->join('spps', 'siswas.id_spp', '=', 'spps.id')->orderBy('nisn', 'DESC')->select(['siswas.*', 'kelas.*', 'spps.*'])->paginate(4);
        $kelas = Kelas::all();
        $spp = Spp::all();

        return view('siswa', 
        [
        'title' => 'Data Siswa',
        'siswa' => $siswa,
        'kelas' => $kelas,
        'spp' => $spp
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nisn' => 'max: 10',
            'nis' => 'max: 8',
            'nama' => 'max: 35',
            'id_kelas' => 'max: 11',
            'alamat' => '',
            'no_telp' => 'max: 13',
            'id_spp' => 'max: 11',
        ]);

        Siswa::create([
            'nisn' => $data['nisn'],
            'nis' => $data['nis'],
            'nama' => $data['nama'],
            'id_kelas' => $data['id_kelas'],
            'alamat' => $data['alamat'],
            'no_telp' => $data['no_telp'],
            'id_spp' => $data['id_spp'],
        ]);

        return redirect('siswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nisn)
    {
        $data = $request->validate([
            'nisn' => 'max: 10',
            'nis' => 'max: 8',
            'nama' => 'max: 35',
            'id_kelas' => 'max: 11',
            'alamat' => '',
            'no_telp' => 'max: 13',
            'id_spp' => 'max: 11',
        ]);

        Siswa::where('nisn', $nisn)->update([
            'nisn' => $data['nisn'],
            'nis' => $data['nis'],
            'nama' => $data['nama'],
            'id_kelas' => $data['id_kelas'],
            'alamat' => $data['alamat'],
            'no_telp' => $data['no_telp'],
            'id_spp' => $data['id_spp'],
        ]);

        return redirect('siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($nisn)
    {
        Siswa::where('nisn', $nisn)->delete();

        return redirect('siswa');
    }
}