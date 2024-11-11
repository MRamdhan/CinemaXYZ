<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seat Selection</title>
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
            <p class="text-center text-muted mb-2">
                {{ $movie[0]->name }} ({{ $movie[0]->studio_name }})
            </p>
            <h5 class="text-center text-muted mb-4">
                {{ $date }}<span class="mx-3">|</span> {{ $time_choose }}
            </h5>
            <div class="card bg-secondary text-light shadow m-5 p-2">
                <div class="card-body">
                    <h2 class="text-center">Layar Utama</h2>
                </div>
            </div>
            <form action="{{ route('confirmOrder', [
                'movie' => $movie[0]->id,
                'time_choose' => $time_choose
            ]) }}" method="POST">
            @csrf
                @php
                    $seatType = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
                @endphp
                @for ($i = 0; $i < 7; $i++) 
                <div class="row d-flex justify-content-around mb-4">
                    <div class="col-5 d-flex justify-content-around">
                        @for ($j = 0; $j < 6; $j++)
                        <div class="seat">
                            <input
                                onclick="getCheckedBoxes('seats[]')"
                                type="checkbox"
                                name="seats[]"
                                id="checkbox-{{$seatType[$i].sprintf( "%02d", ($j + 1))}}"
                                value="{{$seatType[$i].sprintf( "%02d", ($j + 1))}}"
    
                                {{ in_array($seatType[$i].sprintf( "%02d", ($j + 1)), $seats_sold) ? 'disabled' : '' }}
                            />
                            <label for="checkbox-{{$seatType[$i].sprintf( "%02d", ($j + 1))}}" class="btn {{ in_array($seatType[$i].sprintf( "%02d", ($j + 1)), $seats_sold) ? 'btn-danger' : 'btn-dark' }}">{{$seatType[$i].sprintf( "%02d", ($j + 1))}}</label>
                        </div>
                        @endfor
                    </div>
                    <div class="col-5 d-flex justify-content-around">
                        @for ($j = 6; $j < 12; $j++)
                        <div class="seat">
                            <input
                                onclick="getCheckedBoxes('seats[]')"
                                type="checkbox"
                                name="seats[]"
                                id="checkbox-{{$seatType[$i].sprintf( "%02d", ($j + 1))}}"
                                value="{{$seatType[$i].sprintf( "%02d", ($j + 1))}}"
    
                                {{ in_array($seatType[$i].sprintf( "%02d", ($j + 1)), $seats_sold) ? 'disabled' : '' }}
                            />
                            <label for="checkbox-{{$seatType[$i].sprintf( "%02d", ($j + 1))}}" class="btn {{ in_array($seatType[$i].sprintf( "%02d", ($j + 1)), $seats_sold) ? 'btn-danger' : 'btn-dark' }}">{{$seatType[$i].sprintf( "%02d", ($j + 1))}}</label>
                        </div>
                        @endfor
                    </div>
                </div>
                @endfor
                {{-- <input type="hidden" name="token" value="{{ csrf_token() }}"> --}}
                <input type="hidden" name ="seats" id="seats_selected">
                <div class="text-center my-5">  
                    <button type="submit" class="btn btn-info text-light" value="button">
                        Selesai memilih
                    </button>
                </div>
            </form>
        </div>
    </main>
    <script>
        function getCheckedBoxes(chkboxName) {
            var checkboxes = document.getElementsByName(chkboxName);
            var checkboxesChecked = [];
            for (var i=0; i<checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    checkboxesChecked.push(checkboxes[i]);
                }
            }
    
            let seats = [];
            for (let i = 0; i < checkboxesChecked.length; i++) {
                const element = checkboxesChecked[i];
                seats.push(element.id.replace('checkbox-', ''))
            }
    
            document.getElementById('seats_selected').value = seats;
        }
    </script>
</body>
</html>