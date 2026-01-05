<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Berhasil</title>

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
        }

        .card {
            max-width: 500px;
            width: 100%;
            border: none;
            border-radius: 14px;
        }

        .btn-info {
            background-color: #0dcaf0;
            border: none;
        }

        .btn-info:hover {
            background-color: #0bb0d4;
        }

        .info-row {
            margin-bottom: 8px;
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>

<main class="content py-4">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow p-4">

            <div class="text-center mb-3">
                <img src="{{ asset('img/cinemaXYZ.jpg') }}" alt="Logo" style="max-width: 120px;">
            </div>

            <h2 class="text-center mb-3">🎉 Terima Kasih Sudah Memesan</h2>

            @if (session('message'))
                <div class="alert alert-dark text-center">
                    {{ session('message') }}
                </div>
            @endif

            <div class="info-row row">
                <div class="col-6 fw-semibold">ID Film</div>
                <div class="col">{{ $movie_id }}</div>
            </div>

            <div class="info-row row">
                <div class="col-6 fw-semibold">Nama Film</div>
                <div class="col">{{ $movie_name }}</div>
            </div>

            <div class="info-row row">
                <div class="col-6 fw-semibold">Waktu</div>
                <div class="col">{{ $time }}</div>
            </div>

            <div class="info-row row">
                <div class="col-6 fw-semibold">Tempat Duduk</div>
                <div class="col">{{ $seats }}</div>
            </div>

            <hr>

            <div class="row text-center mb-3">
                <div class="col-12 fw-bold">Kembalian</div>
                <div class="col-12 text-danger fw-bold fs-5">
                    Rp {{ number_format($kembalian, 0, ',', '.') }}
                </div>
            </div>

            <hr>

            <div class="d-flex gap-2">
                <a href="{{ route('showMovies') }}"
                   class="btn btn-info text-light w-100">
                    Kembali ke Menu
                </a>

                <a href="{{ route('ticket', [
                        'id_movie' => $movie_id,
                        'seats' => $seats,
                        'time' => $time
                    ]) }}"
                   class="btn btn-secondary w-100">
                    Print Tiket
                </a>
            </div>

        </div>
    </div>
</main>

</body>
</html>
