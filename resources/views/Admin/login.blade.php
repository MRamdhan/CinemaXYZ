<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
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
    <div class="container mt-5 col-8">
        <form action="{{ route('postLogin') }}" method="POST" class="form-gorup">
            @csrf
            <div class="card shadow">
                <div class="row">
                    <div class="col-md-6 p-5" style="background-color: #BFE4F6;">
                        <img src="{{ asset('img/logo.png') }}" class="card-img" alt="" style="width: 100%;">
                    </div>
                    <div class="col-md-6">
                        <h1 style="text-align: center" class="mt-4"> AniPlex Cinema </h1>
                        <hr>
                        <div class="card-body p-4 border-2 text-black rounded-4">
                            <h3> Login </h3>
                            @if (session('message'))
                                <div class="alert alert-dark">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-info text-light w-100"> Login </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>