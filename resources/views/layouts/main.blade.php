<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <style>

      .navbar-nav li {
        margin-right: 2rem;
      }

    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light p-3">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              @if ( session()->get('login')['level'] == 'admin' )
                <li>
                  <img class="d-inline" src="{{ asset('gambar/dashboard.png') }}" alt="" width="25">
                  <a class="nav-item nav-link d-inline active" href="{{ url('/dashboard') }}">Dashboard</a>
                </li>

                <li class="nav-item dropdown">
                    <img class="d-inline" src="{{ asset('gambar/tas.png') }}" alt="" width="25">
                    <a class="nav-link dropdown-toggle d-inline" href="" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Master Data
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <li><a class="dropdown-item" href="{{ url('/kelas') }}">Data Kelas</a></li>
                      <li><a class="dropdown-item" href="{{ url('/siswa') }}">Data Siswa</a></li>
                      <li><a class="dropdown-item" href="{{ url('/spp') }}">Data SPP</a></li>
                    </ul>
                </li>
                
                <li>
                  <img class="d-inline" src="{{ asset('gambar/petugas.png') }}" alt="" width="25">
                  <a class="nav-item nav-link d-inline" href="{{ url('/petugas') }}">Data petugas</a>
                </li>

                <li class="nav-item dropdown">
                  <img class="d-inline" src="{{ asset('gambar/pembayaran.png') }}" alt="" width="25">
                    <a class="nav-link dropdown-toggle d-inline" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Pembayaran
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <li><a class="dropdown-item" href="{{ url('transaksi') }}">Transaksi</a></li>
                      <li><a class="dropdown-item" href="{{ url('history') }}">History</a></li>
                </li>
              @endif

              @if ( session()->get('login')['level'] == 'petugas' )
                <li>
                  <img class="d-inline" src="{{ asset('gambar/dashboard.png') }}" alt="" width="25">
                  <a class="nav-item nav-link d-inline active" href="{{ url('/dashboard') }}">Dashboard</a>
                </li>

                <li class="nav-item dropdown">
                  <img class="d-inline" src="{{ asset('gambar/pembayaran.png') }}" alt="" width="25">
                    <a class="nav-link dropdown-toggle d-inline" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Pembayaran
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <li><a class="dropdown-item" href="{{ url('transaksi') }}">Transaksi</a></li>
                      <li><a class="dropdown-item" href="{{ url('history') }}">History</a></li>
                </li>
              @endif

              @if ( session()->get('login')['level'] == 'siswa' )
                <li>
                  <img class="d-inline" src="{{ asset('gambar/dashboard.png') }}" alt="" width="25">
                  <a class="nav-item nav-link d-inline active" href="{{ url('/dashboard') }}">Dashboard</a>
                </li>

                <li class="nav-item dropdown">
                  <img class="d-inline" src="{{ asset('gambar/pembayaran.png') }}" alt="" width="25">
                    <a class="nav-link dropdown-toggle d-inline" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Pembayaran
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <li><a class="dropdown-item" href="{{ url('history/' . session()->get('login')['nisn']) }}">History</a></li>
                    </li>
              @endif
            </div>
            </div>

            <div class="admin">
              
              <span class="text-white fw-bold font-monospace bg-secondary px-3">
                @if ( session()->get('login')['level'] == 'siswa' )
                {{ session()->get('login')['nama'] }}
                @else
                {{ session()->get('login')['nama_petugas'] }}
                @endif
              </span>

              <span class="text-white bg-info w-50 fw-bold font-monospace px-3 d-block" style="font-size: .7rem">
                @if ( session()->get('login')['level'] != 'siswa' )
                    {{ session()->get('login')['level'] }}
                @endif
              </span>
            </div>

            <a class="navbar-brand position-absolute" style="right:0; font-size: 1rem;" href="{{ url('logout') }}" style="left: 2%;">
              <span class="font-monospace">Logout <i class="fas fa-key"></i></span>
              <div class="col-12 border border-primary mb-3"></div>
            </a>
        </div>
      </nav>

      <div class="container mt-4">
        @yield('content')
      </div>
    
</body>
</html>