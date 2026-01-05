<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Register</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-6 mx-auto">
                <div class="card p-4">
                    <form action="{{ route('postdaftar') }}" method="POST">
                        @csrf
                        <h1>Form Pendaftaran</h1>
                        <hr>
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="name"> Nama </label>
                            <input type="text" name="name" id="name" placeholder="Masukan Nama" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="username"> Username </label>
                            <input type="text" name="username" id="username" placeholder="Masukan Username" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="password"> Password </label>
                            <input type="password" name="password" id="password" placeholder="Masukan password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('login') }}" class="btn btn-dark"> Kembali </a>
                            <button class="btn" style="background-color:#003b6d; color:white "> Daftar </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>