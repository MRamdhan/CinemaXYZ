<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm Order</title>
    <link href={{ asset('css/bootstrap.css') }} rel="stylesheet">
    <link href={{ asset('css/style.css') }} rel="stylesheet">
    <script src={{ asset('js/jquery.js') }}></script>
    <script src={{ asset('js/bootstrap.js') }}></script>
    <script src="{{ asset('js/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap5.min.js') }}"></script>
</head>
<body>
    <main class="content py-4">
        <div class="container">
            <div class="card rounded col-4 mx-auto shadow p-4 mt-5 mb-5">
                <h3 class="text-center mb-3">Konfirmasi Pemesanan</h3>
                <form action="{{ route('createOrder') }}" id="createOrder" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="movie_id" id="movie" value="{{ $movie->id }}">
                    <input type="hidden" name="movie_name" value="{{ $movie->name }}">
                    <input type="hidden" name="time" id="time" value="{{ $time }}">
                    <input type="hidden" name="total" value="{{ $total }}">
                    <input type="hidden" name="seats" value="{{ $seats }}">
                    <div class="row py-1" style="max-width: 400px">
                        <div class="col-6">Film</div>
                        <div class="col text-start">{{ $movie->name }}</div>
                    </div>
                    <div class="row py-1" style="max-width: 400px">
                        <div class="col-6">Waktu</div>
                        <div class="col text-start">{{ $time }}</div>
                    </div>
                    <div class="row py-1" style="max-width: 400px">
                        <div class="col-6">Tempat Duduk</div>
                        <div class="col text-start">{{ $seats }}</div>
                    </div>
                    <div class="row py-1" style="max-width: 400px">
                        <div class="col-6">Studio</div>
                        <div class="col text-start">{{ $movie->studio_name }}</div>
                    </div>
                    <hr style="max-width: 400px" />
                    <div class="row py-1" style="max-width: 400px">
                        <div class="col-6 text-start">Harga Tiket</div>
                        <div class="col text-start">Rp.{{ number_format($ticketPrice, 0, ',', '.') }} x {{ $count }}</div>
                    </div>
                    <div class="row py-1" style="max-width: 400px">
                        <div class="col-6 text-start">Biaya Layanan</div>
                        <div class="col text-start">Rp.2.000</div>
                    </div>
                    <hr style="max-width: 400px" />
                    <div class="row py-1" style="max-width: 400px">
                        <div class="col-6 text-start"><b>Total Bayar</b></div>
                        <div class="col text-start text-danger"><b>Rp.{{ number_format($total, 0, ',', '.') }}</b></div>
                    </div>
                    <hr style="max-width: 400px" />
                    <div class="row py-1 d-flex align-items-center mb-4" style="max-width: 400px">
                        <div class="col-6 text-start"><b>Jumlah Uang</b></div>
                        <div class="col text-start">
                            <input id="uangBayar" type="number" name="cash" class="form-control" autofocus />
                        </div>
                    </div>
                </form>
                <div id="alertContainer"></div>
                <button type="submit" class="btn btn-info text-light" onclick="cekBayar()">Bayar</button>
            </div>
        </div>
    </main>
    
    <script>
        let uangBayar = document.getElementById('uangBayar');
        let createOrder = document.getElementById('createOrder');
        let totalBayar = {{ $total }}

        document.getElementById("uangBayar").addEventListener("keydown", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                cekBayar();
            }
        });

        function cekBayar() {

            let uangBayarValue = parseFloat(uangBayar.value);

            if (uangBayarValue >= totalBayar) {
                createOrder.submit();
            } else {
                document.getElementById('alertContainer').innerHTML =
                '<div class="alert alert-dark">Uang Anda Kurang</div>';
                return false;
            }
        }
    </script>
</body>
</html>