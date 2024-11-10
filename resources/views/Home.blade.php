<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CinemaXYZ</title>
    <link href={{ asset('css/bootstrap.css') }} rel="stylesheet">
    <link href={{ asset('css/style.css') }} rel="stylesheet">
    <script src={{ asset('js/jquery.js') }}></script>
    <script src={{ asset('js/bootstrap.js') }}></script>
    <script src="{{ asset('js/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap5.min.js') }}"></script>
    <style>
        body {
            background-color: #ebedf3;
        }

        footer {
            background-color: #a6d2ff
        }

    </style>
</head>

<body>
    @include('Template.nav')
    <div class="container">
        @if (session('message'))
        <div class="alert alert-dark">
            {{ session('message') }}
        </div>
        @endif
        <h3 class="text-center my-4">List Movie</h3>
        <div class="row">
            <div class="col-3 offset-9 text-right">
                <form class="form-inline">
                    <div class="input-group">
                        <input type="text" name="cari" placeholder="Cari Movie...." id="cari" class="form-control">
                        <button type="submit" class="btn btn-info">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <h5>Movie Yang Sedang Tayang</h5>
            @foreach ($movie as $cinema)
                @if ($cinema->status == 'ongoing')
                    <div class="col-4">
                        <div class="row d-flex mb-5">
                            <center>
                                @if (!auth()->user())
                                    <div class="card shadow">
                                        <a
                                            style="text-decoration: none; color: black" class="gagambar">
                                            <img src="{{ asset('storage/' . $cinema->image) }}" class="card-img-top" alt=""
                                                style="height: 500px; object-fit: cover; ">
                                                <h3 class="mt-2">{{ $cinema->name }}</h3>
                                            <h5 style="opacity:70%">{{ $cinema->genre->name }}</h5>
                                        </a>
                                    </div>
                                @endif
                                @if (auth()->user())
                                    <div class="card shadow">
                                        <a href="$"
                                            style="text-decoration: none; color:black" class="gagambar">
                                            <img src="{{ asset('storage/' . $cinema->image) }}" class="card-img-top" alt=""
                                                style="height: 500px; object-fit: cover; ">
                                            <h3 class="mt-2">{{ $cinema->name }}</h3>
                                            <h5 style="opacity:70%">{{ $cinema->genre->name }}</h5>
                                        </a>
                                    </div>
                                @endif
                            </center>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        @if (auth()->user())
            <div class="row">
                <h5>Movie Yang Akan Datang</h5>
                @foreach ($movie as $movie)
                    @if ($movie->status == 'upcoming')
                        <div class="col-4">
                            <div class="row d-flex mb-5">
                                <center>
                                    <div class="card shadow">
                                        <div style="pointer-events: none">
                                            <a href="#"
                                                style="text-decoration: none; color:black" class="gagambar">
                                                <img src="{{ asset('storage/' . $movie->image) }}" class="card-img-top" alt=""
                                                    style="height: 500px; object-fit: cover; ">
                                                <h3 class="mt-2">{{ $movie->name }}</h3>
                                                <h5 style="opacity:70%">{{ $movie->genre->name }}</h5>
                                            </a>
                                        </div>
                                    </div>
                                </center>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</body>

</html>