<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Laboratorium</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/infolab.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<?php
session_start();
require 'message.php';
require 'navbar.php';

?>

<div class="container mt-5">
    <?php
        // Mendapatkan parameter lab dari URL
        $lab = filter_var($_GET['lab'] ?? 1, FILTER_VALIDATE_INT, ["options" => ["default" => 1]]);

        // Validasi NIM pengguna
        $nim = htmlspecialchars($_SESSION['nim'] ?? "NIM tidak ditemukan");

    // Informasi laboratorium berdasarkan parameter
    $labs = [
        1 => [
            "nama" => "LABORATORIUM 1",
            "deskripsi" =>  '<div class="card-deck">

                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">desktop_mac</i>
                                        <div class="name"> 0 Monitor</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">keyboard</i>
                                        <div class="name">0 Keyboard</div>
                                        <div class="description">TIDAK ADA SPESIFIKASI</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">mouse</i>
                                        <div class="name">0 Mouse</div>
                                        <div class="description">TIDAK ADA SPESIFIKASI</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="name">Spesifikasi PC</div>
                                        <div class="description">TIDAK ADA SPESIFIKASI</div>
                                    </div>
                                </div>
                            </div>',
            "gambar" => ["foto/lab/lab1.1.jpg", "foto/lab/lab1.jpg"]
        ],
        2 => [
            "nama" => "LABORATOURIUM 2",
            "deskripsi" =>  '<div class="card-deck">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">desktop_mac</i>
                                        <div class="name"> 0 Monitor</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">keyboard</i>
                                        <div class="name">0 Keyboard</div>
                                        <div class="description">TIDAK ADA SPESIFIKASI</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">mouse</i>
                                        <div class="name">0 Mouse</div>
                                        <div class="description">TIDAK ADA SPESIFIKASI</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="name">Spesifikasi PC</div>
                                        <div class="description">TIDAK ADA SPESIFIKASI</div>
                                    </div>
                                </div>
                            </div>',
            "gambar" => ["foto/lab/lab2.1.jpg", "foto/lab/lab2.jpg"]
        ],
        3 => [
            "nama" => "LABORATORIUM 3",
            "deskripsi" => '<div class="card-deck">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">desktop_mac</i>
                                        <div class="name"> 25Monitor</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">keyboard</i>
                                        <div class="name">25 Keyboard</div>
                                        <div class="description">(23 wireless, 2 kabel)</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">mouse</i>
                                        <div class="name">25 Mouse</div>
                                        <div class="description">(23 wireless, 2 kabel)</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="name">Spesifikasi PC</div>
                                        <div class="description">Intel(R) Core(TM) i7-8700 CPU @3.20GHz (12CPUs), ~3.2GHz</div>
                                    </div>
                                </div>
                            </div>',
            "gambar" => ["foto/lab/lab3.1.jpg", "foto/lab/lab3.jpg"]
        ],
        4 => [
            "nama" => "LABORATORIUM 4",
            "deskripsi" => '<div class="card-deck">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">desktop_mac</i>
                                        <div class="name"> 25 Monitor</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">keyboard</i>
                                        <div class="name">25 Keyboard</div>
                                        <div class="description">(kabel)</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">mouse</i>
                                        <div class="name">25 Mouse</div>
                                        <div class="description">(kabel)</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="name">Spesifikasi PC</div>
                                        <div class="description">Intel(R) Core(TM) i3-3220 CPU @3.20GHz (4CPUs), ~3.2GHz</div>
                                    </div>
                                </div>
                            </div>',
            "gambar" => ["foto/lab/lab4.1.jpg", "foto/lab/lab4.jpg"]
        ],
        5 => [
            "nama" => "LABORATORIUM 5",
            "deskripsi" => '<div class="card-deck">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">desktop_mac</i>
                                        <div class="name"> 23 Monitor</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">keyboard</i>
                                        <div class="name">25 Keyboard</div>
                                        <div class="description">(23 wireless, 2 kabel)</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">mouse</i>
                                        <div class="name">24 Mouse</div>
                                        <div class="description">(21 wireless, 3 kabel)</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="name">Spesifikasi PC</div>
                                        <div class="description">Intel(R) Core(TM) i7-8700 CPU @3.20GHz (12CPUs), ~3.2GHz</div>
                                    </div>
                                </div>
                            </div>',
            "gambar" => ["foto/lab/lab5.1.jpg", "foto/lab/lab5.jpg"]
        ],
        6 => [
            "nama" => "Lab Mandiri",
            "deskripsi" =>  '<div class="card-deck">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">desktop_mac</i>
                                        <div class="name"> 0 Monitor</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">keyboard</i>
                                        <div class="name">0 Keyboard</div>
                                        <div class="description">TIDAK ADA SPESIFIKASI</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">mouse</i>
                                        <div class="name">0 Mouse</div>
                                        <div class="description">TIDAK ADA SPESIFIKASI</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="name">Spesifikasi PC</div>
                                        <div class="description">TIDAK ADA SPESIFIKASI</div>
                                    </div>
                                </div>
                            </div>',
            "gambar" => ["foto/lab/labmandiri1.jpg", "foto/lab/labmandiri1.1.jpg"]
        ],
        7 => [
            "nama" => "Lab Studio",
            "deskripsi" => '<div class="card-deck">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">desktop_mac</i>
                                        <div class="name"> 0 Monitor</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">keyboard</i>
                                        <div class="name">0 Keyboard</div>
                                        <div class="description">TIDAK ADA SPESIFIKASI</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="material-icons">mouse</i>
                                        <div class="name">0 Mouse</div>
                                        <div class="description">TIDAK ADA SPESIFIKASI</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="name">Spesifikasi PC</div>
                                        <div class="description">TIDAK ADA SPESIFIKASI</div>
                                    </div>
                                </div>
                            </div>',
            "gambar" => ["foto/lab/labstudio1.jpg", "foto/lab/labstudio.jpg"]
        ],
    ];

    $infolab = $labs[$lab] ?? null; // Mengatur $infolab berdasarkan validasi
    ?>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <!-- Carousel Gambar -->
                <div id="carouselImages" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($infolab['gambar'] as $index => $image): ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <!-- Menambahkan kelas lab-image ke gambar -->
                                <img src="<?php echo $image; ?>" class="d-block w-100 lab-image" alt="<?php echo $infolab['nama']; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselImages" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselImages" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            
            <div class="col-md-6">
                    <h1><?php echo $infolab['nama']; ?></h1>
                    <p><?php echo $infolab['deskripsi']; ?></p>
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="#" class="btn btn-primary custom-btn" data-toggle="modal" data-target="#peminjamanModal">Pinjam Lab</a>
                    </div>
            </div>
        </div>
    </div>
    <?php

    ?>
</div>
    <?php
    require 'footer.php'
    ?>
<div class="modal fade" id="peminjamanModal" tabindex="-1" role="dialog" aria-labelledby="peminjamanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="peminjamanModalLabel">Form Peminjaman Lab</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="peminjaman.php" method="POST">
                    <div class="form-group">
                        <label for="nim">NIM:</label>
                        <?php if (isset($_SESSION['nim'])): ?>
                            <input type="text" class="form-control" id="nim" name="nim" value="<?php echo htmlspecialchars($_SESSION['nim']); ?>" readonly>
                        <?php else: ?>
                            <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM tidak ditemukan" readonly>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="lab">Laboratorium:</label>
                        <input type="text" class="form-control" id="lab" name="lab" value="<?php echo $infolab['nama']; ?>" readonly>
                    </div>
                        <div class="form-group">
                            <label for="tanggal_pinjam">Tanggal Pinjam:</label>
                            <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" required>
                        </div>
                        <?php
                        date_default_timezone_set('asia/Makassar'); // Atur sesuai zona waktu Anda
                        $currentTime = date('H:i');
                        ?>
                        <div class="form-group">
                            <label for="start-time">Waktu Mulai Peminjaman:</label>
                            <input type="time" id="start-time" name="start_time" class="form-control" required min="<?php echo $currentTime; ?>">
                        </div>
                        <div class="form-group">
                            <label for="end-time">Waktu Selesai Peminjaman:</label>
                            <input type="time" id="end-time" name="end_time" class="form-control" required>
                        </div> 
                        <div class="form-group">
                        <label for="alasan_peminjaman">Alasan Peminjaman:</label>
                        <select id="alasan_peminjaman" name="alasan_peminjaman" class="form-control" required>
                            <option value="">-- Pilih Alasan --</option>
                            <option value="Mata Kuliah">Mata Kuliah</option>
                            <option value="Alasan Lain">Alasan Lain</option>
                        </select>
                    </div>
                    
                    <div id="form-mata-kuliah" style="display: none;">
                        <div class="form-group">
                            <label for="dosen">Dosen:</label>
                            <input type="text" id="dosen" name="dosen" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="mk">Mata Kuliah:</label>
                            <input type="text" id="mk" name="mk" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas:</label>
                            <input type="text" id="kelas" name="kelas" class="form-control">
                        </div>
                    </div>
                    
                    <div id="form-alasan-lain" style="display: none;">
                        <div class="form-group">
                            <label for="alasan_lain">Alasan Lain:</label>
                            <input type="text" id="alasan_lain" name="alasan_lain" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim Peminjaman</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('alasan_peminjaman').addEventListener('change', function () {
        const selectedValue = this.value;
        const formMataKuliah = document.getElementById('form-mata-kuliah');
        const formAlasanLain = document.getElementById('form-alasan-lain');

        if (selectedValue === 'Mata Kuliah') {
            formMataKuliah.style.display = 'block';
            formAlasanLain.style.display = 'none';
        } else if (selectedValue === 'Alasan Lain') {
            formMataKuliah.style.display = 'none';
            formAlasanLain.style.display = 'block';
        } else {
            formMataKuliah.style.display = 'none';
            formAlasanLain.style.display = 'none';
        }
    });
</script>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script> 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<!-- Memastikan jQuery dan Bootstrap JS dimuat dengan benar -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</html>