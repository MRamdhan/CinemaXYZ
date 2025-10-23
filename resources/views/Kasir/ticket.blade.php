<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tiket Bioskop</title>
  <style>
    body {
      font-family: 'Poppins', Arial, sans-serif;
      background: #f7f7f7;
      margin: 0;
      padding: 30px;
    }

    .ticket-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 40px;
    }

    .ticket {
      background: #fff;
      width: 420px;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      border: 2px solid #e0e0e0;
      position: relative;
    }

    /* header */
    .ticket-header {
      background: linear-gradient(90deg, #111, #333);
      color: white;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .ticket-header h2 {
      font-size: 18px;
      margin: 0;
    }

    .ticket-header span {
      font-weight: bold;
      color: #ff4d4d;
    }

    /* body */
    .ticket-body {
      padding: 20px;
      border-top: 2px dashed #ccc;
    }

    .ticket-body p {
      margin: 8px 0;
      font-size: 15px;
    }

    .ticket-body strong {
      display: inline-block;
      width: 100px;
      color: #333;
    }

    /* garis putus-putus seolah tiket */
    .cut-line {
      border-top: 2px dashed #aaa;
      margin: 0;
    }

    /* footer kode */
    .ticket-footer {
      background: #f3f3f3;
      padding: 10px 20px;
      font-size: 13px;
      text-align: right;
      color: #666;
    }

    @media print {
      body {
        background: none;
      }

      .ticket {
        box-shadow: none;
        margin-bottom: 20px;
      }
    }
  </style>
</head>

<body>
  <div class="ticket-container">
    @foreach ($tickets as $ticket)
      <div class="ticket">
        <div class="ticket-header">
          <h2>Cinema XYZ</h2>
          <span>{{ $ticket->seat }}</span>
        </div>

        <div class="ticket-body">
          <p><strong>Tanggal</strong>: {{ $ticket->created_at->format('Y-m-d') }}</p>
          <p><strong>Film</strong>: {{ $purchase->movie->name }}</p>
          <p><strong>Waktu</strong>: {{ $purchase->time }}</p>
          <p><strong>Seat</strong>: {{ $ticket->seat }}</p>
          <p><strong>Invoice</strong>: {{ $ticket->code }}</p>
        </div>

        <hr class="cut-line">

        <div class="ticket-footer">
          Kode unik: {{ strtoupper(substr($ticket->code, 0, 10)) }}
        </div>
      </div>
    @endforeach
  </div>
</body>

</html>
