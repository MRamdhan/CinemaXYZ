<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Admin Dashboard</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap5.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f5f6fa;
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
        }
    </style>
</head>

<body>

@include('Template.nav')

<div class="container mt-4">
    <h2 class="text-center mb-4">Up Coming Dashboard</h2>

    @if (session('message'))
        <div class="alert alert-dark">
            {{ session('message') }}
        </div>
    @endif

    <div class="text-center mb-3">
        <a href="{{ route('tambah') }}" class="btn btn-primary text-white">
            Tambah Movie
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered nowrap align-middle text-center"
                   id="example"
                   style="width:100%">
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
                    @foreach ($movie->where('status', 'upcoming') as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $d->image) }}"
                                     width="70"
                                     height="90"
                                     class="img-fluid rounded">
                            </td>
                            <td>{{ $d->name }}</td>
                            <td>{{ ucfirst($d->status) }}</td>
                            <td>{{ $d->minutes }} Menit</td>
                            <td>{{ $d->director }}</td>
                            <td>{{ $d->studio_name }}</td>
                            <td>
                                <div class="d-flex gap-1 justify-content-center">
                                    <a href="{{ route('edit', $d->id) }}"
                                       class="btn btn-info text-white">
                                        Edit
                                    </a>
                                    <a href="{{ route('masuk', $d->id) }}"
                                       class="btn btn-secondary"
                                       onclick="return confirm('Yakin mau memasukan data ini ?')">
                                        Masukan
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

{{-- JS (URUTAN PENTING) --}}
<script src="{{ asset('js/jquery-3.7.0.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></cript>

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
