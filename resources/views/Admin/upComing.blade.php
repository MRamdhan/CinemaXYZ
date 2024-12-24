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
    <title>Up Coming Dashboard</title>
    <style>
    </style>
</head>

<body>
    @include('Template.nav')
    <div class="container mt-4" style="align-items: center">
        <h2 class="text-center">Up Coming Dashboard</h2>
        @if (session('message'))
            <div class="alert alert-dark">
                {{ session('message') }}
            </div>
        @endif
        <a href="{{ route('tambah') }}" class="btn bg-info mt-2" style="margin-left: 20px">Tambah Movie</a>
    </div>
    <div class="container mt-3 mb-5">
        <div class="card mt-1">
            <div class="card-body">
                <table class="table" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Durasi</th>
                            <th>Director</th>
                            <th>Studio</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movie->where('status', 'upcoming') as $d)
                            <tr>
                                <td>
                                    {{ $loop->index + 1 }}
                                </td>
                                <td>{{ $d->name }}</td>
                                <td><img src="{{ asset('storage/' . $d->image) }}" alt="Movie Image" width="90" height="100"></td>
                                <td>{{ $d->status }}</td>
                                <td>{{ $d->minutes }} Menit</td>
                                <td>{{ $d->director }}</td>
                                <td>{{ $d->studio_name }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('edit', $d->id) }}" class="btn btn-info ">Edit</a>
                                        <a href="{{ route('masuk', $d->id) }}" class="btn btn-secondary"
                                            onclick="return confirm('Yakin mau Memasukan data ini ?')">Masukan</a>
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