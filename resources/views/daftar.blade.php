<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Cinema XYZ</title>

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <style>
        body {
            background-color: #ebedf3;
            font-family: 'Poppins', sans-serif;
        }

        .login-container {
            max-width: 900px;
            margin: 50px auto;
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .left-side {
            background-color: #003b6d;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .left-side img {
            max-width: 250px;
            width: 100%;
            height: auto;
        }

        .right-side {
            padding: 2rem;
            background-color: #fff;
        }

        .btn-login {
            background-color: #003b6d;
            color: white;
        }

        .btn-login:hover {
            background-color: #0057a3;
            color: white;

        }

        @media (max-width: 768px) {
            .left-side img {
                max-width: 180px;
            }
        }

        @media (max-width: 576px) {
            .login-container {
                margin: 20px auto;
            }

            .card {
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <div class="container login-container">
        <form action="{{ route('postdaftar') }}" method="POST">
            @csrf

            <div class="card shadow-lg">
                <div class="row g-0">

                    <div class="col-md-6 left-side">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo Cinema XYZ">
                    </div>

                    <div class="col-md-6 right-side">
                        <h1 class="text-center mb-3">Cinema XYZ</h1>
                        <hr>

                        <h3 class="mb-4">Form Pendaftaran</h3>

                        @if (session('message'))
                            <div class="alert alert-dark">
                                {{ session('message') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama</label>
                            <input type="text" name="name" id="name" placeholder="Masukan Nama" class="form-control"
                                   placeholder="Masukkan Nama"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">Username</label>
                            <input type="text" name="username" id="username" placeholder="Masukan Username" class="form-control"
                                   placeholder="Masukkan Username"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" id="password"
                                   class="form-control"
                                   placeholder="Masukkan password"
                                   required>
                        </div>
                            <div class="mb-3 row g-2">
                                <div class="col-3">
                                    <a href="{{ route('login') }}" class="btn btn-dark w-100">
                                        Kembali
                                    </a>
                                </div>
                                <div class="col-9">
                                    <button type="submit" class="btn btn-login w-100 fw-bold py-2">
                                        Daftar
                                    </button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
