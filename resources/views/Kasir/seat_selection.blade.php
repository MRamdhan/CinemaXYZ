<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seat Selection | CinemaXYZ</title>

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <style>
        body {
            background-color: #f5f6fa;
        }

        .card.bg-secondary {
            background-color: #003b6d !important;
        }

        /* Seat style */
        .seat input[type="checkbox"] {
            display: none;
        }

        .seat {
            width: 35px;
            height: 35px;
            border-radius: 6px;
            position: relative;
        }

        .seat label {
            width: 100%;
            height: 100%;
            background-color: #d9d9d9;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .seat label:hover {
            background-color: #b0b0b0;
        }

        .seat input[type="checkbox"]:checked + label {
            background-color: #0d6efd;
            color: white;
        }

        .seat input[type="checkbox"]:disabled + label {
            background-color: #dc3545;
            cursor: not-allowed;
        }

        /* Scroll container */
        .seat-scroll-container {
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .seat-row {
            flex-wrap: nowrap !important;
            min-width: max-content;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .seat {
                width: 28px;
                height: 28px;
            }

            .seat label {
                font-size: 10px;
            }

            h5 {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .seat {
                width: 24px;
                height: 24px;
            }

            .seat label {
                font-size: 9px;
            }
        }
    </style>
</head>

<body>
    <main class="content py-4">
        <div class="container text-center">

            <p class="text-muted mb-2">
                {{ $movie[0]->name }} ({{ $movie[0]->studio_name }})
            </p>
            <h5 class="text-muted mb-4">
                {{ $date }} <span class="mx-2">|</span> {{ $time_choose }}
            </h5>

            <!-- LAYAR -->
            <div class="card bg-secondary text-light shadow mx-auto mb-5" style="max-width:600px;">
                <div class="card-body py-3">
                    <h2 class="mb-0">LAYAR UTAMA</h2>
                </div>
            </div>

            <!-- FORM -->
            <form action="{{ route('confirmOrder', [
                'movie' => $movie[0]->id,
                'time_choose' => $time_choose
            ]) }}" method="POST">
                @csrf

                @php
                    $seatType = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
                @endphp

                <div class="seat-scroll-container mb-4">
                    @for ($i = 0; $i < 7; $i++)
                        <div class="d-flex align-items-center seat-row gap-2 mb-3 justify-content-center">

                            @for ($j = 0; $j < 12; $j++)
                                @php
                                    $seatId = $seatType[$i] . sprintf('%02d', ($j + 1));
                                @endphp

                                @if ($j == 6)
                                    <!-- Lorong -->
                                    <div style="width:30px"></div>
                                @endif

                                <div class="seat">
                                    <input
                                        onclick="getCheckedBoxes('seats[]')"
                                        type="checkbox"
                                        name="seats[]"
                                        id="checkbox-{{ $seatId }}"
                                        value="{{ $seatId }}"
                                        {{ in_array($seatId, $seats_sold) ? 'disabled' : '' }}
                                    >
                                    <label for="checkbox-{{ $seatId }}">
                                        {{ $seatId }}
                                    </label>
                                </div>
                            @endfor

                        </div>
                    @endfor
                </div>

                <input type="hidden" name="seats" id="seats_selected">

                <div class="text-center my-4">
                    <button type="submit" class="btn btn-info text-light px-4 py-2">
                        Selesai Memilih
                    </button>
                </div>

            </form>
        </div>
    </main>

    <script>
        function getCheckedBoxes(chkboxName) {
            const checkboxes = document.getElementsByName(chkboxName);
            const seats = [];

            for (let i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    seats.push(checkboxes[i].id.replace('checkbox-', ''));
                }
            }

            document.getElementById('seats_selected').value = seats.join(',');
        }
    </script>
</body>

</html>
