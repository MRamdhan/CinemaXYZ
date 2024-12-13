<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Owner</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap5.min.css') }}">
    <script src="{{ asset('js/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap5.min.js') }}"></script>
    
</head>
<body>
    <div class="container mt-2 mb-4">
        <div class="card shadow mt-3">
            @if (session('message'))
            <div class="alert alert-dark">
                {{ session('message') }}
            </div>
        @endif
            <div class="card-body">
                <h1 class="card-title">Aktivitas</h1>
                <a href="{{ route('homeOwner') }}" class="btn btn-dark mb-4"> Back</a>

                <table class="table table-bordered mt-3" id="example">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col">Aktivitas</th>
                            <th scope="col">Jam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $log->user->username }}</td>
                                <td>{{ $log->activity }}</td>
                                <td>{{ \Carbon\Carbon::parse($log->created_at)->format('Y-m-d H-i-s') }}</td>
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
</body>
</html>