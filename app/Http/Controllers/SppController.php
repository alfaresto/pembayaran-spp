<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
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
        
        $spp = Spp::orderBy('id', 'DESC')->select(['spps.*'])->paginate(4);

        return view('spp', 
        [
        'title' => 'Data SPP',
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
            'tahun' => 'max: 11',
            'nominal' => 'max: 11'
        ]);

        Spp::create([
            'tahun' => $data['tahun'],
            'nominal' => $data['nominal']
        ]);

        return redirect('spp');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function show(Spp $spp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function edit(Spp $spp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'tahun' => 'max: 11',
            'nominal' => 'max: 11'
        ]);

        Spp::where('id', $id)->update([
            'tahun' => $data['tahun'],
            'nominal' => $data['nominal']
        ]);

        return redirect('spp');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Spp::where('id', $id)->delete();

        return redirect('spp');
    }
}
