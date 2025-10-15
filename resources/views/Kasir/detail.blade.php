<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href={{ asset('css/bootstrap.css') }} rel="stylesheet">
    <link href={{ asset('css/style.css') }} rel="stylesheet">
    <script src={{ asset('js/jquery.js') }}></script>
    <script src={{ asset('js/bootstrap.js') }}></script>
    <script src="{{ asset('js/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap5.min.js') }}"></script>
    <title>Detail</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset('storage/' . $movie->image) }}" width="300">
                    </div>
                    <div class="col-9">
                        <div class="card">
                            <div class="card-body">
                                <h1>{{ $movie_name }}</h1>
                                <p class="text-dark">Genre : <b class="text-danger">{{ $movie->genre->name }}</b></p>
                                <p class="text-dark">Studio : <b class="text-danger">{{ $movie->studio_name }}</b></p>
                                <p class="text-dark">Direktur : <b class="text-danger">{{ $movie->director }}</b></p>
                                <p class="text-dark">Waktu Film : <b class="text-danger">{{ $movie->minutes }} Menit</b></p>
                                <b class="card-title">Sinopsis : </b>
                                <p class="card-text">{{ $movie->deskripsi }}</p>
                                <hr class="mt-5">
                                <div class="d-flex flex-wrap gap-2">
                                    @forelse ($showtimes as $time)
                                        <a href="{{ route('seatSelection', ['movie_id' => $movie->id, 'time' => $time]) }}"
                                            class="btn btn-info text-light">
                                            {{ $time }}
                                        </a>
                                    @empty
                                        <p class="text-muted">Belum ada jadwal tayang untuk film ini.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>