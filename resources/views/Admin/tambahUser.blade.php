<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f5f6fa;
        }

        .card {
            border-radius: 12px;
        }

        /* Tombol form */
        .form-buttons {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 25px;
        }

        @media (max-width: 576px) {
            .form-buttons {
                flex-direction: column;
            }

            .form-buttons .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

@include('Template.nav')

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-12">
            <div class="card shadow-sm">
                <div class="card-header text-center text-white"
                     style="background-color: #003b6d;">
                    <h3 class="mb-0">Tambah User</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('postTambahUser') }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <label class="mt-2">Nama</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               required>

                        <label class="mt-2">Username</label>
                        <input type="text"
                               name="username"
                               class="form-control"
                               required>

                        <label class="mt-2">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               required>

                        <label class="mt-2">Role</label>
                        <select name="role" class="form-control">
                            <option value="kasir">Kasir</option>
                            <option value="owner">Owner</option>
                        </select>

                        @if (session('message'))
                            <div class="alert alert-dark mt-3">
                                {{ session('message') }}
                            </div>
                        @endif

                        <div class="form-buttons">
                            <a href="{{ route('kelolaUser') }}"
                               class="btn btn-secondary">
                                Cancel (Back)
                            </a>
                            <button type="submit"
                                    class="btn text-white"
                                    style="background-color: #003b6d;">
                                Tambahkan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JS --}}
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
