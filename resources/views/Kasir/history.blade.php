<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
        }

        .card {
            border-radius: 12px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        h1 {
            font-size: 1.8rem;
        }

        @media (max-width: 576px) {
            h1 {
                font-size: 1.4rem;
                text-align: center;
            }
        }
    </style>
</head>
<body>

@include('Template.nav')

<div class="container mt-4 mb-5">

    @if (session('message'))
        <div class="alert alert-dark text-center">
            {{ session('message') }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">

            <h1 class="mb-3">Riwayat Transaksi</h1>

            {{-- Chart --}}
            {!! $chart->container() !!}

            {{-- Filter --}}
            <div class="row g-3 mt-4">
                <div class="col-lg-6 col-md-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <form action="{{ route('filteredChart') }}" method="get">
                                <h5 class="text-center mb-3">Filter Tanggal</h5>
                                <label>Tanggal Awal</label>
                                <input type="date" name="start_date" class="form-control mb-2">
                                <label>Tanggal Akhir</label>
                                <input type="date" name="end_date" class="form-control mb-3">
                                <button type="submit" class="btn btn-primary w-100">Cari Data</button>
                            </form>
                        </div>
                    </div>
                </div>

                @if (auth()->user()->role == 'owner')
                <div class="col-lg-6 col-md-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <form action="{{ route('filter') }}" method="get">
                                <h5 class="text-center mb-3">Filter Download</h5>
                                <label>Tanggal Awal</label>
                                <input type="date" name="start_date" class="form-control mb-2">
                                <label>Tanggal Akhir</label>
                                <input type="date" name="end_date" class="form-control mb-3">
                                <button type="submit" class="btn btn-danger w-100">Download Data</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Total --}}
            <p class="mt-4 fw-semibold">
                Total Pendapatan :
                <b>Rp {{ number_format($total, 0, ',', '.') }}</b>
            </p>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center mt-3" id="example">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Movie Title</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Seats</th>
                            <th>Total</th>
                            <th>Uang</th>
                            <th>Kembalian</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $history)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $history->movie->name }}</td>
                            <td>{{ $history->date }}</td>
                            <td>{{ $history->time }}</td>
                            <td>{{ $history->seats }}</td>
                            <td>Rp {{ number_format($history->total, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($history->cash, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($history->change, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('inv', [
                                    'id_movie' => $history->movie->id,
                                    'seats' => $history->seats,
                                    'time' => $history->time
                                ]) }}" class="btn btn-sm btn-primary">
                                    Print Tiket
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="8" class="fw-bold text-center">DOWNLOAD SEMUA DATA</td>
                            <td class="text-center">
                                <a href="{{ route('exportPdf') }}" class="btn btn-success btn-sm">
                                    Download
                                </a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- Chart --}}
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}

{{-- DataTable --}}
<script src="{{ asset('js/jquery-3.7.0.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    new DataTable('#example');
</script>

</body>
</html>
