<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Owner Dashboard</title>

    <!-- CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap5.min.css') }}">

    <style>
        .table-responsive {
            overflow-x: auto;
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    @include('template.nav')

    <div class="container mt-4">
        @if (session('message'))
            <div class="alert alert-dark">
                {{ session('message') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header text-center text-white" style="background-color: #003b6d">
                <h3>Home Owner Activity</h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered nowrap" id="example" style="width:100%">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>User</th>
                            <th>Aktivitas</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="text-center align-middle">
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $log->user->username }}</td>
                                <td>{{ $log->activity }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($log->created_at)->format('Y-m-d H:i:s') }}
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
