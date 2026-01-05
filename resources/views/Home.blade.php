<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CinemaXYZ</title>

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <style>
        body {
            background-color: #ebedf3;
        }

        footer {
            background-color: #a6d2ff;
        }

        .card img {
            height: 400px;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .card img {
                height: 300px;
            }
        }

        @media (max-width: 576px) {
            .card img {
                height: 250px;
            }
        }
    </style>
</head>

<body>
    @include('Template.nav')

    <div class="container my-5">
        <h1 class="text-center mb-4">List Movie</h1>

        <!-- SEARCH -->
        <div class="row mb-4 justify-content-end">
            <div class="col-12 col-md-6 col-lg-4">
                <form action="{{ route('cari') }}" method="get" class="d-flex">
                    <input type="text" name="cari" placeholder="Cari Movie...." class="form-control me-2">
                    <button type="submit" class="btn btn-dark">Cari</button>
                </form>
            </div>
        </div>

        <!-- MOVIE ONGOING -->
        <div class="mb-5">
            <h5 class="mb-3">Movie Yang Sedang Tayang</h5>

            @if (session('message'))
                <div class="alert alert-dark">
                    {{ session('message') }}
                </div>
            @endif

            <div class="row g-4">
                @foreach ($ongoing as $cinema)
                    @if ($cinema->status == 'ongoing')
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="card shadow text-center h-100">

                                @guest
                                    <a href="{{ route('login') }}"
                                       onclick="return confirm('Anda belum login, ingin login?')"
                                       style="text-decoration:none; color:black">
                                @else
                                    @if(auth()->user()->role === 'kasir')
                                        <a href="{{ route('detailmovie', $cinema->id) }}"
                                           style="text-decoration:none; color:black">
                                    @else
                                        <div class="p-3 text-danger">
                                            Hanya kasir yang dapat mengakses fitur ini.
                                        </div>
                                    @endif
                                @endguest

                                    <img src="{{ asset('storage/' . $cinema->image) }}" class="card-img-top">
                                    <div class="card-body">
                                        <h3 class="card-title">{{ $cinema->name }}</h3>
                                        <h5 class="text-muted">{{ $cinema->genre->name }}</h5>
                                    </div>
                                </a>

                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- MOVIE UPCOMING -->
        <div class="mb-5">
            <h5 class="mb-3">Movie Yang Akan Datang</h5>

            <div class="row g-4">
                @foreach ($upcoming as $cinema)
                    @if ($cinema->status == 'upcoming')
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="card shadow text-center h-100">
                                <div style="pointer-events:none">
                                    <img src="{{ asset('storage/' . $cinema->image) }}" class="card-img-top">
                                    <div class="card-body">
                                        <h3 class="card-title">{{ $cinema->name }}</h3>
                                        <h5 class="text-muted">{{ $cinema->genre->name }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
