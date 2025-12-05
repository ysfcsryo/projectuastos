<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROJECT PWEB</title>
    <link rel="stylesheet" href="css/beranda.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<?php
session_start();
require 'message.php';
require 'navbar.php';

// Mengecek apakah pengguna sudah login
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Ambil nama pengguna dari sesi
} else {
    $username = null; // Jika tidak ada sesi pengguna, set null
}?>
     <main class=".container-fluid">
       <div id="carouselExampleIndicators" class="carousel slide mt-0" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="foto/tempat/fakultas.jpg" class="d-block w-100" alt="Slide 1">
                    <div class="carousel-caption">
                        <h5>Selamat Datang</h5>
                        <p>Sistem Informasi Peminjaman Laboratorium</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="foto/tempat/lobi1.jpg" class="d-block w-100" alt="Slide 2">
                    <div class="carousel-caption">
                        <h5>Laboratorium</h5>
                        <p>Fasilitas lengkap untuk mendukung pembelajaran</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="foto/tempat/lobi2.jpg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption">
                        <h5>Jurusan Teknik Informatika</h5>
                        <p>Program studi <br>Sistem informasi & Pendidikan teknologi informasi</p>
                    </div>
                </div>
            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    <section class="team-section" id="aslab">
    <h2>Ketua Lab & Asisten Lab</h2>
    <div class="team-cards">
    <a href="admin.php"><div class="team-box">
            <img src="foto/admin/ketualab.jpg" alt="Ketua Lab">
            <div class="name">Ahmad Azhar Kadim, S.Kom., M.Kom</div>
            <div class="description">Ketua Laboratorium</div>
    </div></a>
    <a href="admin.php"><div class="team-box">
            <img src="foto/admin/pakriri.jpg" alt="Laboran">
            <div class="name">Rifandy Ismail</div>
            <div class="description">Laboran</div>
        </div>
    </div></a>

    <a href="admin.php"><div class="team-cards">
        <div class="team-box">
            <img src="foto/admin/krahma.jpg" alt="Asisten Lab 1">
            <div class="name">Nur Rahma Akuba</div>
            <div class="description">Asisten Lab</div>
        </div></a>

        <a href="admin.php"><div class="team-box">
            <img src="foto/admin/mita.jpg" alt="Asisten Lab 2">
            <div class="name">Ma'arifatul S. Kusuma</div>
            <div class="description">Asisten Lab</div>
        </div></a>

        <a href="admin.php"><div class="team-box">
            <img src="foto/admin/nafla.png" alt="Asisten Lab 3">
            <div class="name">Nafla Almalikal P. Zalni</div>
            <div class="description">Asisten Lab</div>
        </div></a>

        <a href="admin.php"><div class="team-box">
            <img src="foto/admin/abi.jpg" alt="Asisten Lab 4">
            <div class="name">Hafiyudin Ilham Binol</div>
            <div class="description">Asisten Lab</div>
        </div></a>

        <a href="admin.php"><div class="team-box">
            <img src="foto/admin/kaabay.jpg" alt="Asisten Lab 5">
            <div class="name">Taufik Abay</div>
            <div class="description">Asisten Lab</div>
        </div></a>
    </div>
</section>
    </main>
<?php
    require 'footer.php';
?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>