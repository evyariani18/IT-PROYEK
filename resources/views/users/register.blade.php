<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Menambahkan link ke Bootstrap untuk styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menambahkan custom CSS jika diperlukan -->
    <style>
        body {
            background-color: #E7E8D8; /* Warna latar belakang halaman */
            font-family: 'Arial', sans-serif;
        }
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            color: #BC9F8B; /* Warna untuk judul */
            font-weight: bold;
            margin-bottom: 30px;
        }
        .form-container label {
            font-weight: bold;
        }
        .form-container .btn {
            background-color: #BC9F8B; /* Tombol dengan warna utama */
            color: white;
            border: none;
            font-weight: bold;
        }
        .form-container .btn:hover {
            background-color: #a17e6a; /* Warna tombol saat hover */
        }
        .form-container .form-group input {
            border-radius: 5px;
            border: 1px solid #BC9F8B; /* Border input sesuai dengan warna utama */
        }
        .form-container .hr-custom {
            border: 0;
            border-top: 1px solid #BC9F8B; /* Garis pemisah dengan warna utama */
            margin: 20px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <!-- Judul Form -->
        <h2 class="text-center">Register</h2>
        
        <!-- Form Register -->
        <form action="{{ route('register.submit') }}" method="POST">
            @csrf

            <!-- Input Nama -->
            <div class="form-group mb-3">
                <label for="name">Nama:</label>
                <input name="name" id="name" type="text" class="form-control" placeholder="Masukkan nama" required>
            </div>

            <!-- Input Username -->
            <div class="form-group mb-3">
                <label for="username">Username:</label>
                <input name="username" id="username" type="text" class="form-control" placeholder="Masukkan username" required>
            </div>

            <!-- Input Email -->
            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input name="email" id="email" type="email" class="form-control" placeholder="Masukkan email" required>
            </div>

            <!-- Input Password -->
            <div class="form-group mb-3">
                <label for="password">Password:</label>
                <input name="password" id="password" type="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn w-100">Register</button>
        </form>

        <!-- Garis Pemisah -->
        <hr class="hr-custom">

        <!-- Link ke Login -->
        <p class="text-center">Sudah punya akun? <a href="{{ route('login') }}">Login disini</a></p>
    </div>
</div>

<!-- Tambahkan script untuk Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
