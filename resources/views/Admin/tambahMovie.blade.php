<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Tambah Movie</title>
    <style>
        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }

        .form-group {
            flex: 1 1 calc(50% - 20px);
        }

        .form-group.full-width {
            flex: 1 1 100%;
        }

        .form-group img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            margin-top: 10px;
            border: 2px dashed #ddd;
            display: none;
        }

        .form-label {
            font-weight: bold;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-info {
            background-color: #003b6d;
            color: white;
            border: none;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn:hover {
            background-color: black;
            color: white;
        }

        @media (max-width: 768px) {
            .form-group {
                flex: 1 1 100%;
            }
        }
    </style>
</head>

<body>
    @include('Template.nav')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center text-white" style="background-color: #003b6d">
                <h3>Tambah Movie</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('postTambahMovie') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-container">
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Film</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama film" required>
                        </div>

                        <div class="form-group">
                            <label for="genre_id" class="form-label">Genre</label>
                            <select id="genre_id" name="genre_id" class="form-select" required>
                                @foreach ($genre as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="minutes" class="form-label">Durasi (Menit)</label>
                            <input type="number" id="minutes" name="minutes" class="form-control" placeholder="Masukkan durasi film" required>
                        </div>

                        <div class="form-group">
                            <label for="director" class="form-label">Sutradara</label>
                            <input type="text" id="director" name="director" class="form-control" placeholder="Masukkan nama sutradara" required>
                        </div>

                        <div class="form-group">
                            <label for="studio_name" class="form-label">Studio</label>
                            <input type="text" id="studio_name" name="studio_name" class="form-control" placeholder="Masukkan nama studio" required>
                        </div>

                        <div class="form-group">
                            <label for="studio_capacity" class="form-label">Kapasitas Studio</label>
                            <input type="number" id="studio_capacity" name="studio_capacity" class="form-control" placeholder="Masukkan kapasitas studio" required>
                        </div>

                        <div class="form-group full-width">
                            <label for="deskripsi" class="form-label">Sinopsis</label>
                            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" placeholder="Masukkan sinopsis film" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" id="image" name="image" class="form-control" accept="image/*" onchange="previewImage()" required>
                            <img id="preview" src="" alt="Preview Image">
                        </div>

                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="ongoing">On Going</option>
                                <option value="upcoming">Up Coming</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-info px-4">Tambah Data</button>
                        <a href="{{ route('homeAdmin') }}" class="btn btn-secondary px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const fileInput = document.getElementById('image');
            const preview = document.getElementById('preview');
            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
