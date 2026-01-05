<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail | CinemaXYZ</title>

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <style>
        body {
            background-color: #f5f6fa;
        }

        .movie-img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.6rem;
                text-align: center;
            }

            .btn-jam {
                flex: 1 1 45%;
            }

            .jam-tayang {
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            h1 {
                font-size: 1.4rem;
            }

            .card-text {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="card shadow">
            <div class="card-body">

                <div class="row align-items-center">
                    <!-- POSTER -->
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <img src="{{ asset('storage/' . $movie->image) }}"
                             alt="{{ $movie_name }}"
                             class="movie-img">
                    </div>

                    <!-- DETAIL -->
                    <div class="col-12 col-md-8">
                        <div class="card border-0">
                            <div class="card-body">

                                <h1 class="fw-bold">{{ $movie_name }}</h1>

                                <p class="text-dark mb-1">
                                    Genre : <b class="text-danger">{{ $movie->genre->name }}</b>
                                </p>
                                <p class="text-dark mb-1">
                                    Studio : <b class="text-danger">{{ $movie->studio_name }}</b>
                                </p>
                                <p class="text-dark mb-1">
                                    Direktur : <b class="text-danger">{{ $movie->director }}</b>
                                </p>
                                <p class="text-dark mb-3">
                                    Waktu Film : <b class="text-danger">{{ $movie->minutes }} Menit</b>
                                </p>

                                <b class="card-title">Sinopsis :</b>
                                <p class="card-text">{{ $movie->deskripsi }}</p>

                                <hr class="my-4">

                                <!-- JAM TAYANG -->
                                <div class="d-flex flex-wrap gap-2 jam-tayang">
                                    @forelse ($showtimes as $time)
                                        <a href="{{ route('seatSelection', ['movie_id' => $movie->id, 'time' => $time]) }}"
                                           class="btn btn-info text-light btn-jam">
                                            {{ $time }}
                                        </a>
                                    @empty
                                        <p class="text-muted">
                                            Belum ada jadwal tayang untuk film ini.
                                        </p>
                                    @endforelse
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">
                Kembali
            </a>
        </div>
    </div>
</body>

</html>
