<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap5.min.css') }}">

    <script src="{{ asset('js/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap5.min.js') }}"></script>
    <title>Tambah User</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <h3 class="text-center mt-2">Tambah User</h3>
            <div class="card-body">
                <form action="{{ route('postTambahUser') }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="">Nama</label>
                    <input type="text" name="name"class="form-control" required>
                    <label for="">Username</label>
                    <input type="text" name="username"class="form-control" required>
                    <label for="">Password</label>
                    <input type="password" name="password"class="form-control" required>
                    <label for="">Role</label>
                    <select name="role" id="" class="form-control">
                        <option value="kasir">Kasir</option>
                        <option value="owner">Owner</option>
                    </select>
                    @if (session('message'))
                        <div class="alert alert-dark">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="mt-4">
                        <button class="btn btn-info">Tambahkan Data</button>
                        <a href="{{ route('kelolaUser') }}" class="btn btn-secondary">Cancel (back)</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        new DataTable('#example');
    </script>
    <script src={{ asset('js/jquery.js') }}></script>
    <script src={{ asset('js/bootstrap.js') }}></script>
    <script src="{{ asset('js/jquery-3.7.0.js') }}"></script>
</body>
</html>