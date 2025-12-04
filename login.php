<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<?php
session_start();
require 'message.php';
?>
    <div class="container mt-5">
        <h1 class="text-center">Login</h1>
        <form action="dblogin.php" method="post">
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" required>
                </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
        </form>
        <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger mt-3" role="alert">
            Email atau password Anda salah.
        </div>
        <?php endif; ?>
    <div class="text-center mt-3">
            <span>Belum punya akun?</span>
            <a href="register.php">Daftar di sini</a><br>
            <a href="beranda.php">Kembali ke Beranda</a>
        </div>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>