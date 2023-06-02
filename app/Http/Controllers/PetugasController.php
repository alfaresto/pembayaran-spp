<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( session()->missing('login') ) {
            return redirect('login-admin');
        }
        
        $petugas = Petugas::orderBy('id', 'DESC')->select(['petugas.*'])->paginate(4);

        return view('petugas', 
        [
        'title' => 'Data Petugas',
        'petugas' => $petugas
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
            'username' => 'max: 25',
            'password' => 'max: 32',
            'nama_petugas' => 'max: 35',
            'level' => ''
        ]);

        Petugas::create([
            'username' => $data['username'],
            'password' => md5($data['password']),
            'nama_petugas' => $data['nama_petugas'],
            'level' => $data['level']
        ]);

        return redirect('petugas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function show(Petugas $petugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function edit(Petugas $petugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'username' => 'max: 25',
            'password' => 'max: 32',
            'nama_petugas' => 'max: 35',
            'level' => ''
        ]);

        Petugas::where('id', $id)->update([
            'username' => $data['username'],
            'password' => md5($data['password']),
            'nama_petugas' => $data['nama_petugas'],
            'level' => $data['level']
        ]);

        return redirect('petugas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Petugas::where('id', $id)->delete();

        return redirect('petugas');
    }
}
