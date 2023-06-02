<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
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
        
        $kelas = Kelas::orderBy('id', 'DESC')->select(['kelas.*'])->paginate(4);

        return view('kelas', 
        [
        'title' => 'Data Kelas',
        'kelas' => $kelas
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
            'nama_kelas' => 'max: 10',
            'kompetensi_keahlian' => 'max: 50'
        ]);

        Kelas::create([
            'nama_kelas' => $data['nama_kelas'],
            'kompetensi_keahlian' => $data['kompetensi_keahlian']
        ]);

        return redirect('kelas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_kelas' => 'max: 10',
            'kompetensi_keahlian' => 'max: 50'
        ]);

        Kelas::where('id', $id)->update([
            'nama_kelas' => $data['nama_kelas'],
            'kompetensi_keahlian' => $data['kompetensi_keahlian']
        ]);

        return redirect('kelas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kelas::where('id', $id)->delete();

        return redirect('kelas');
    }
}
