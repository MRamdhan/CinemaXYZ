<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Order</title>

    {{-- Bootstrap --}}
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
        }

        .card {
            max-width: 420px;
            width: 100%;
            background-color: #fff;
            border: none;
            border-radius: 12px;
        }

        .btn-info {
            background-color: #0dcaf0;
            border: none;
        }

        .btn-info:hover {
            background-color: #0bb0d4;
        }

        @media (max-width: 576px) {
            .card {
                padding: 1rem !important;
            }

            h3 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>

<main class="content py-4">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow p-4">

            <h3 class="text-center mb-4">Konfirmasi Pemesanan</h3>

            <form action="{{ route('createOrder') }}" id="createOrder" method="POST">
                @csrf

                {{-- Hidden data --}}
                <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                <input type="hidden" name="movie_name" value="{{ $movie->name }}">
                <input type="hidden" name="time" value="{{ $time }}">
                <input type="hidden" name="total" value="{{ $total }}">
                <input type="hidden" name="seats" value="{{ $seats }}">

                <div class="row mb-2">
                    <div class="col-6 fw-semibold">Film</div>
                    <div class="col">{{ $movie->name }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-6 fw-semibold">Waktu</div>
                    <div class="col">{{ $time }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-6 fw-semibold">Tempat Duduk</div>
                    <div class="col">{{ $seats }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-6 fw-semibold">Studio</div>
                    <div class="col">{{ $movie->studio_name }}</div>
                </div>

                <hr>

                <div class="row mb-2">
                    <div class="col-6">Harga Tiket</div>
                    <div class="col">
                        Rp {{ number_format($ticketPrice, 0, ',', '.') }} x {{ $count }}
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-6">Biaya Layanan</div>
                    <div class="col">Rp 2.000</div>
                </div>

                <hr>

                <div class="row mb-2">
                    <div class="col-6 fw-bold">Total Bayar</div>
                    <div class="col text-danger fw-bold">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </div>
                </div>

                <hr>

                <div class="row align-items-center mb-4">
                    <div class="col-6 fw-semibold">Jumlah Uang</div>
                    <div class="col">
                        <input id="uangBayar"
                               type="number"
                               name="cash"
                               class="form-control"
                               placeholder="Masukkan nominal..."
                               autofocus>
                    </div>
                </div>
            </form>

            <div id="alertContainer"></div>

            <button type="button"
                    class="btn btn-info text-light w-100 py-2 fw-semibold"
                    onclick="cekBayar()">
                Bayar
            </button>

        </div>
    </div>
</main>

<script>
    let uangBayar = document.getElementById('uangBayar');
    let createOrder = document.getElementById('createOrder');
    let totalBayar = {{ $total }};

    uangBayar.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            cekBayar();
        }
    });

    function cekBayar() {
        let uang = parseFloat(uangBayar.value);

        if (uang >= totalBayar) {
            createOrder.submit();
        } else {
            document.getElementById('alertContainer').innerHTML =
                '<div class="alert alert-dark mt-3 text-center">💸 Uang Anda Kurang</div>';
        }
    }
</script>

</body>
</html>
