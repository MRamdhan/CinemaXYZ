<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    {{-- CSS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap5.min.css') }}">

    <style>
        body {
            background-color: #f5f6fa;
        }

        .card {
            border-radius: 12px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        @media (max-width: 576px) {
            .d-flex.gap-1 {
                flex-direction: column;
                gap: .5rem;
            }

            .btn {
                width: 100%;
            }

            h2 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>

<body>

@include('Template.nav')

<div class="container mt-4">
    <h2 class="text-center mb-3">Home Admin</h2>

    @if (session('message'))
        <div class="alert alert-dark text-center">
            {{ session('message') }}
        </div>
    @endif

    <div class="text-center mb-3">
        <a href="{{ route('tambah') }}" class="btn btn-primary">
            Tambah Movie
        </a>
    </div>
</div>

<div class="container mb-5">
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered nowrap align-middle text-center" id="example" style="width:100%">
                <thead class="table-dark">
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
                <tbody>
                    @foreach ($movie->where('status', 'ongoing') as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $d->image) }}"
                                     class="img-fluid rounded"
                                     width="70" height="90"
                                     alt="Movie Image">
                            </td>
                            <td>{{ $d->name }}</td>
                            <td>
                                <span class="badge bg-success">
                                    {{ $d->status }}
                                </span>
                            </td>
                            <td>{{ $d->minutes }} Menit</td>
                            <td>{{ $d->director }}</td>
                            <td>{{ $d->studio_name }}</td>
                            <td>
                                <div class="d-flex gap-1 justify-content-center">
                                    <a href="{{ route('edit', $d->id) }}" class="btn btn-info text-white btn-sm">
                                        Edit
                                    </a>
                                    <a href="{{ route('trashArchived', $d->id) }}"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Yakin mau Archived data ini ?')">
                                        Archived
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

{{-- JS (URUTAN WAJIB) --}}
<script src="{{ asset('js/jquery-3.7.0.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/responsive.bootstrap5.min.js') }}"></script>

<script>W
    new DataTable('#example', {
        responsive: true,
        scrollX: true
    });
</script>

</body>
</html>
