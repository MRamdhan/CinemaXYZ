<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>History</title>
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
    @include('Template.nav')
    <div class="container mt-3 mb-5">
        @if (session('message'))
        <div class="alert alert-dark">
            {{ session('message') }}
        </div>
        @endif
        <div class="card shadow">
            <div class="card-body">
                <h1 class="my-2">Riwayat Transaksi</h1>
                
                {!! $chart->container() !!}
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('filteredChart') }}" method="get" class="form-group mt-4">
                                    @csrf
                                    <h5 class="text-center">Filter Tanggal</h3>
                                        <label for="" class="mt-2">Tanggal Awal</label>
                                        <input type="date" name="start_date" id="" class="form-control">
                                        <label for="" class="mt-2">Tanggal Akhir</label>
                                        <input type="date" name="end_date" id="" class="form-control">
                                        <button type="submit" href="" class="btn btn-primary w-100 mt-4 text-light">Cari Data</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        @if (auth()->user()->role == 'owner')
                        <div class="card">
                            <div class="card-body">
                                <form action="#" method="get" class="form-group mt-4">
                                    @csrf
                                    <h5 class="text-center">Filter Download</h3>
                                        <label for="" class="mt-2">Tanggal Awal</label>
                                        <input type="date" name="start_date" id="" class="form-control">
                                        <label for="" class="mt-2">Tanggal Akhir</label>
                                        <input type="date" name="end_date" id="" class="form-control">
                                        <button type="submit" href="" class="btn btn-danger w-100 mt-4">Download
                                            Data</button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="">
                    <p class="mt-4">Total Pendapatan :
                        <b>
                            Rp.{{ number_format($total, '0', ',', '.') }}
                        </b>
                    </p>
                </div>
                <table class="table table-bordered mt-3" id="example">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Movie Title</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Seats</th>
                            <th scope="col">Total</th>
                            <th scope="col">Uang</th>
                            <th scope="col">kembalian</th>
                            <th scope="col">Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $history)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $history->movie->name }}</td>
                                <td>{{ $history->date }}</td>
                                <td>{{ $history->time }}</td>
                                <td>{{ $history->seats }}</td>
                                <td>Rp. {{ number_format($history->total, '0', ',', '.') }}</td>
                                <td>Rp. {{ number_format($history->cash, '0', ',', '.') }}</td>
                                <td>Rp. {{ number_format($history->change, '0', ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('inv', ['id_movie' => $history->movie->id, 'seats' => $history->seats, 'time' => $history->time]) }}" class="btn btn-primary">Print Tiket</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>

    </div>
    <script src="{{ $chart->cdn() }}"></script>
    <script src="{{ asset('js/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap5.min.js') }}"></script>
    <script>
        new DataTable('#example');
    </script>

    {{ $chart->script() }}
</body>
</html>