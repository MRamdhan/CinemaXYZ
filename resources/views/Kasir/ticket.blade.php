<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
</head>
<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
    }

    .invoice-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .invoice-card {
        border: 1px solid black;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 400px;
        padding: 20px;
        margin-bottom: 100px;
    }

    .invoice-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .invoice-header img {
        width: 25%;
        vertical-align: middle;
        margin-right: 10px;
    }

    .invoice-header h2 {
        display: inline-block;
        vertical-align: middle;
    }

    .invoice-header b {
        color: red
    }

    hr {
        margin-bottom: 20px;
    }

    .invoice-details p {
        margin: 0;
        padding: 5px 0;
    }

    .invoice-details strong {
        margin-right: 5px;
        width: 130px;
        display: inline-block;
    }
    .page-break {
    page-break-after: always;
}   
</style>

<body>
    <div class="invoice-container">
        @foreach ($tickets as $ticket)
            <div class="invoice-card">
                <div class="invoice-header">
                    <table>
                        <tr>
                            <td>
                                <h2>Cinema XYZ | <b>{{ $ticket->seat }}</b></h2>
                            </td>
                        </tr>
                    </table>
                </div>
                <hr>
                <div class="invoice-details">
                    <p><strong>Tanggal</strong>: {{ $ticket->created_at->format('Y-m-d') }}</p>
                    <p><strong>Film</strong>: {{ $purchase->movie->name }}</p>
                    <p><strong>Waktu</strong>: {{ $purchase->time }}</p>
                    <p><strong>Seats</strong>: {{ $ticket->seat }}</p>
                    <p><strong>Invoice</strong>: {{ $ticket->code }}</p>
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>