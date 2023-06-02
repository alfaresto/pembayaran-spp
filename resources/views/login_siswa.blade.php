<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <style>

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="col-4">
        <div class="card border-primary h-50 p-4 border-0">
            <h2 class="mb-4 text-center">Login</h2>

            <form action="{{ url('login-siswa') }}" method="POST">
                @csrf

                    @if ( Session::has('pesan') )
                    <div class="alert alert-danger">
                        {{ Session::get('pesan') }}
                    </div>
                    @endif

                    <div class="mb-3">
                        <input class="form-control" type="text" placeholder="Masukkan nisn" name="nisn">
                        <span>
                            @error('nisn')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <input class="form-control" type="text" placeholder="Masukkan nis" name="nis">
                        <span>
                            @error('nis')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="col-8 border border-primary mb-3"></div>

                    <button class="btn btn-primary d-inline-block" type="submit">Login</button>
                    <a href="{{ url('login-admin') }}" class="d-flex justify-content-end">Login admin</a>
            </form>
        </div>
        </div>
    </div>
    
</body>
</html>