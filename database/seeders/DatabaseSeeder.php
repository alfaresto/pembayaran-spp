<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\Spp;
use App\Models\Pembayaran;
use App\Models\Kelas;
use App\Models\Petugas;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        Kelas::create([
            'nama_kelas' => 'XII-ACP',
            'kompetensi_keahlian' => 'Rekayasa Perangkat Lunak'
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-TPM A',
            'kompetensi_keahlian' => 'Tekhnik Permesinan'
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-TKR A',
            'kompetensi_keahlian' => 'Tekhnik Kendaraan Ringan'
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-KI',
            'kompetensi_keahlian' => 'Kimi Industri'
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-APL',
            'kompetensi_keahlian' => 'Analisis Pengujian Laboratorium'
        ]);

        Spp::create([
            'tahun' => 2020,
            'nominal' => 3000000
        ]);

        Spp::create([
            'tahun' => 2021,
            'nominal' => 4000000
        ]);

        Siswa::create([
            'nisn' => '0000000001',
            'nis' => '00000001',
            'nama' => "Mumro'atun salamah",
            'id_kelas' => 5,
            'alamat' => 'Kebayoran',
            'no_telp' => '0881-881-881',
            'id_spp' => 1
        ]);

        Siswa::create([
            'nisn' => '0000000002',
            'nis' => '00000002',
            'nama' => "Yunika Rahmawati",
            'id_kelas' => 5,
            'alamat' => 'Bon Jeruk',
            'no_telp' => '0882-882-882',
            'id_spp' => 1
        ]);

        Siswa::create([
            'nisn' => '0000000003',
            'nis' => '00000003',
            'nama' => "Ari Dwi Yulianto",
            'id_kelas' => 1,
            'alamat' => 'Gang Asem',
            'no_telp' => '0883-883-883',
            'id_spp' => 1
        ]);

        Siswa::create([
            'nisn' => '0000000004',
            'nis' => '00000004',
            'nama' => "Aditya Junior",
            'id_kelas' => 2,
            'alamat' => 'Gang Kamboja',
            'no_telp' => '0884-884-884',
            'id_spp' => 1
        ]);

        Siswa::create([
            'nisn' => '0000000005',
            'nis' => '00000005',
            'nama' => "Salma Nur Sa'diyah",
            'id_kelas' => 4,
            'alamat' => 'Blok M',
            'no_telp' => '0885-885-885',
            'id_spp' => 1
        ]);

        Petugas::create([
            'username' => "silvatria",
            'password' => md5("silvatria"),
            'nama_petugas' => "Silva Tria Alfares",
            'level' => "admin"
        ]);

        Petugas::create([
            'username' => "rickyardhi",
            'password' => md5("rickyardhi"),
            'nama_petugas' => "Ricky Ardhi Saputra",
            'level' => "petugas"
        ]);

        Petugas::create([
            'username' => "ghetsariska",
            'password' => md5("ghetsariska"),
            'nama_petugas' => "Ghetsa Riska Ramadhani",
            'level' => "petugas"
        ]);

        // Pembayaran::create([
        //     'tahun' => 2020,
        //     'nominal' => 3000000,
        // ]);
    }
}