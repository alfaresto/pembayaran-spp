@extends('layouts.main')

@section('content')
    <h2 class=" w-25 px-2 py-1 text-primary">DASHBOARD</h2>
    <span class="text-success fw-bold font-monospace px-3">
        @if ( session()->get('login')['level'] == 'siswa' )
        Halo {{ session()->get('login')['nama'] }}!
        @else
        Halo {{ session()->get('login')['nama_petugas'] }}!
        @endif
    </span>


    <div class="row mt-4">
        @if ( session()->get('login')['level'] == 'siswa' )
            <div class="col-3">
                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header" style="background: yellow;">KARTU NAMA</div>
                    <div class="card-body">
                        <div class="nisn">
                            <h5 class="d-inline-block" style="font-size: .9rem;">Nisn :</h5>
                            <span style="font-size: .8rem;">{{ session()->get('login')['nisn'] }}</span>
                        </div>

                        <div class="nisn">
                            <h5 class="d-inline-block" style="font-size: .9rem;">Nama :</h5>
                            <span style="font-size: .8rem;">{{ session()->get('login')['nama'] }}</span>
                        </div>

                        <div class="nisn">
                            <h5 class="d-inline-block" style="font-size: .9em;">Kelas :</h5>
                            <span style="font-size: .8rem;">{{ session()->get('login')['kelas'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-3">
                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header bg-info text-white">LUNAS</div>
                    <div class="card-body">
                    <h2 class="card-title text-center">{{ $lunas }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header bg-info text-white">BELUM LUNAS</div>
                    <div class="card-body">
                        <h2 class="card-title text-center">{{ $belum_lunas }}</h2>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection