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
    <title>Admin Dashboard</title>
    <style>
    </style>
</head>

<body>
    @include('Template.nav')

    <div class="container mt-4" style="align-items: center">
        <h2 class="text-center">Admin - kelola USER</h2>
        @if (session('message'))
            <div class="alert alert-dark">
                {{ session('message') }}
            </div>
        @endif
        <a href="{{ route('tambahUser') }}" class="btn bg-info mt-2" style="margin-left: 20px">Tambah user</a>
    </div>
    
    <div class="container mt-3 mb-5">
        <div class="card mt-1">
            <div class="card-body">
                <table class="table" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>username</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $d)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $d->username }}</td>
                                <td>{{ $d->role }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('editUser', $d->id) }}" class="btn btn-info ">Edit</a>
                                        <a href="{{ route('hapusUser', $d->id) }}" class="btn btn-secondary"
                                            onclick="return confirm('Yakin mau menghapus data ini ?')">hapus</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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