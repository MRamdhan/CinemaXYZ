<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>

    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 40px;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            letter-spacing: 1px;
            border-bottom: 2px solid #3498db;
            display: inline-block;
            padding-bottom: 5px;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto 30px;
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: 600;
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 13px;
        }

        td {
            border: 1px solid #ddd;
            padding: 10px;
            vertical-align: middle;
            font-size: 13px;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .total-row td {
            border-top: 2px solid #3498db;
            font-weight: bold;
            background-color: #fdfdfd;
        }

        .label-total {
            text-align: right;
            padding-right: 10px;
        }

        .value-total {
            color: #e74c3c;
            font-weight: bold;
        }

        .footer {
            text-align: right;
            font-size: 12px;
            color: #666;
            margin-top: 40px;
        }

        .btn {
            display: inline-block;
            padding: 5px 10px;
            color: #fff;
            background-color: #3498db;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <h1>REPORTS</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Movie Title</th>
                <th>Waktu</th>
                <th>Jam</th>
                <th>Seats</th>
                <th>Total</th>
                <th>Uang</th>
                <th>Kembalian</th>
                <th>Print</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPendapatan = 0;
            @endphp

            @foreach ($data as $item)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td>{{ $item->movie->name }}</td>
                    <td style="text-align: center;">{{ $item->date }}</td>
                    <td style="text-align: center;">{{ $item->time }}</td>
                    <td style="text-align: center;">{{ $item->seats }}</td>
                    <td style="text-align: right;">Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp. {{ number_format($item->cash, 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp. {{ number_format($item->change, 0, ',', '.') }}</td>
                    <td style="text-align: center;">
                        <a href="{{ route('inv', ['id_movie' => $item->movie->id, 'seats' => $item->seats, 'time' => $item->time]) }}" class="btn">Print</a>
                    </td>
                </tr>
                @php
                    $totalPendapatan += $item->total;
                @endphp
            @endforeach

            {{-- Baris Total Pendapatan --}}
            <tr class="total-row">
                <td colspan="5" class="label-total">Total Pendapatan :</td>
                <td colspan="4" class="value-total">Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>

</body>

</html>