<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archived Admin Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap5.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .navbar {
            background-color: #003b6d;
        }

        .navbar-brand img {
            width: 50px;
            height: auto;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #d6e8ff !important;
        }

        .dropdown-menu a:hover {
            background-color: #003b6d;
            color: white !important;
        }

        .table-responsive {
            overflow-x: auto;
        }

        @media (max-width: 576px) {
            .d-flex.gap-1 {
                flex-direction: column;
                gap: 0.5rem;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    @include('Template.nav')

    <div class="container mt-4">
        <h2 class="text-center mb-4">Archived Movies</h2>

        @if (session('message'))
            <div class="alert alert-dark">
                {{ session('message') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered nowrap" id="example" style="width:100%">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Durasi</th>
                            <th>Director</th>
                            <th>Studio</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center align-middle">
                        @foreach ($movie->where('status', 'archived') as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $d->image) }}"
                                         width="70" height="90"
                                         class="img-fluid rounded">
                                </td>
                                <td>{{ $d->name }}</td>
                                <td>{{ ucfirst($d->status) }}</td>
                                <td>{{ $d->minutes }} Menit</td>
                                <td>{{ $d->director }}</td>
                                <td>{{ $d->studio_name }}</td>
                                <td>
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('edit', $d->id) }}" class="btn btn-info text-white">
                                            Edit
                                        </a>
                                        <a href="{{ route('masuk', $d->id) }}"
                                           class="btn btn-secondary"
                                           onclick="return confirm('Yakin mau memasukan data ini?')">
                                            Masukan
                                        </a>
                                        <a href="{{ route('hapus', $d->id) }}"
                                           class="btn btn-danger"
                                           onclick="return confirm('Yakin mau menghapus data ini?')">
                                            Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JS (URUTAN WAJIB) -->
    <script src="{{ asset('js/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- DataTables -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap5.min.js') }}"></script>

    <script>
        new DataTable('#example', {
            responsive: true,
            scrollX: true
        });
    </script>

</body>
</html>
