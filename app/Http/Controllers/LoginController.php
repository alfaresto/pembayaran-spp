<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Petugas;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( session()->has('login') ) {
            return redirect('/');
        }

        return view('login_admin');
    }

    public function index2()
    {
        if( session()->has('login') ) {
            return redirect('/');
        }

        return view('login_siswa');
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
            'username' => 'min:5 | max: 32',
            'password' => 'min:5 | max: 25'
        ]);

        $admin = Petugas::where('username', $data['username'])->first();

        if( $admin ) {
            if( md5($data['password']) == $admin['password'] ) {
                $data_admin = [
                    "username" => $admin['username'],
                    "nama_petugas" => $admin['nama_petugas'],
                    "level" => $admin['level']
                ];

                $request->session()->put('login', $data_admin);
                return redirect('/');
            } else {
                return back()->with('pesan', 'password salah!');
            }
        } else {
            return back()->with('pesan', 'akun tidak ditemukan!');
        }
    }

    public function store2(Request $request)
    {
        $data = $request->validate([
            'nisn' => 'min:10',
            'nis' => 'min:8'
        ]);

        $siswa = Siswa::where('nisn', $data['nisn'])->first();
        $kelas = Kelas::where('id', $siswa['id_kelas'])->first();

        if( $siswa ) {
            if( $data['nis'] == $siswa['nis'] ) {
                $data_siswa = [
                    "nisn" => $siswa['nisn'],
                    "nama" => $siswa['nama'],
                    "kelas" => $kelas['nama_kelas'],
                    "level" => 'siswa',
                ];

                // var_dump($data_siswa);die;

                $request->session()->put('login', $data_siswa);
                return redirect('/');
            } else {
                return back()->with('pesan', 'nis salah!');
            }
        } else {
            return back()->with('pesan', 'akun tidak ditemukan!');
        }
    }

    public function logout() {
        session()->flush();

        return redirect('login-siswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
}
