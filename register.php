<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
<?php
session_start();
            if (isset($_SESSION['error'])) {
                echo "<div class='alert alert-danger floating-alert'>" . $_SESSION['error'] . "</div>";
                unset($_SESSION['error']); // Hapus pesan setelah ditampilkan
            }
            ?>
    <div class="container mt-5">
        <h1 class="text-center">Registrasi</h1>
        <form action="dbregister.php" method="post">
            <div class="form-group">
                <label for="NIM">NIM</label>
                <input type="number" class="form-control" id="nim" name="nim" required>
            </div>
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="program_studi">Program Studi</label>
                <select class="form-control" id="program_studi" name="program_studi" required>
                    <option value="">-- Pilih Program Studi --</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Pendidikan Teknologi Informasi">Pendidikan Teknologi Informasi</option>
                </select>
            </div>

            <div class="form-group">
                <label for="kontak">Kontak</label>
                <input type="number" class="form-control" id="kontak" name="kontak" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
        </form>
        <div class="text-center mt-3">
            <span>Sudah punya akun? </span>
            <a href="login.php">Login di sini</a><br>
            <a href="beranda.php">Kembali ke Beranda</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>