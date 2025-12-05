<?php
include 'koneksi.php'; // Include database connection

session_start();

// Memeriksa apakah sesi username ada
if (!isset($_SESSION['username'])) {
    header("Location: beranda.php");
    exit();
}

$username = htmlspecialchars($_SESSION['username']); // Ambil nama pengguna dari sesi

// Memeriksa apakah role sudah ada di sesi, dan jika bukan 'admin', redirect ke beranda
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: beranda.php");
    exit();
}

// Ambil data peminjaman dan pengembalian dari database
$sql = "SELECT * FROM peminjaman ORDER BY tanggal_pinjam DESC, id DESC";
$result = $conn->query($sql);

// Menampilkan pesan session jika ada
$message = isset($_SESSION['message']) ? htmlspecialchars($_SESSION['message']) : '';
unset($_SESSION['message']); // Menghapus pesan setelah ditampilkan
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="infolab.css">
    <style>
        body {
            background-color: #f8f9fa;
            margin-top: 100px
        }

        .container {
            margin-top: 30px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            color: #343a40;
        }

        table {
            margin-top: 20px;
            width: 100%;
            table-layout: fixed;
        }

        th,
        td {
            text-align: center;
            vertical-align: middle;
            width: 12.5%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php require 'navbar.php'; ?>
    <header>
        <h2 class="text-center">Dashboard Admin - Informasi Peminjaman dan Pengembalian Lab</h2>
    </header>
    <div class="container">
        <!-- Menampilkan pesan jika ada -->
        <?php if ($message): ?>
            <div class="alert alert-info" role="alert">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <h2 class="text-center">Welcome, <?= $username ?> <a href="beranda.php">Go to Beranda</a></h2>
        <table class="table table-bordered table-striped table-responsive">
            <thead class="thead-dark">
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Laboratorium</th>
                    <th>Tanggal Pinjam</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Alasan Peminjaman</th>
                    <th>Alasan Lain</th>
                    <th>Dosen</th>
                    <th>Mata Kuliah</th>
                    <th>Kelas</th>
                    <th>Status</th>
                    <th>Bukti Pengembalian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td><?= htmlspecialchars($row['lab']) ?></td>
                            <td><?= htmlspecialchars($row['tanggal_pinjam']) ?></td>
                            <td><?= htmlspecialchars(date('H:i', strtotime($row['start_time']))) ?></td>
                            <td><?= htmlspecialchars(date('H:i', strtotime($row['end_time']))) ?></td>
                            <td><?= htmlspecialchars($row['alasan_peminjaman']) ?></td>
                            <td><?= htmlspecialchars($row['alasan_lain']) ?></td>
                            <td><?= htmlspecialchars($row['dosen']) ?></td>
                            <td><?= htmlspecialchars($row['mk']) ?></td>
                            <td><?= htmlspecialchars($row['kelas']) ?></td>
                            <td><?= htmlspecialchars($row['status']) ?></td>
                            <td>
                                <?php if ($row['status'] === 'approved'): ?>
                                    Lab sedang digunakan
                                <?php elseif ($row['status'] === 'pending'): ?>
                                    Belum disetujui
                                <?php elseif (!empty($row['bukti_pengembalian'])): ?>
                                    <a href="<?= htmlspecialchars($row['bukti_pengembalian']) ?>" target="_blank">Lihat Bukti</a>
                                <?php else: ?>
                                    Tidak ada bukti
                                <?php endif; ?>
                            </td>
                            <td>
                                <form method="post" action="verifikasi.php">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                                    <?php if ($row['status'] === 'pending'): ?>
                                        <button type="submit" name="verifikasi" value="approved" class="btn btn-success">Approve</button>
                                        <button type="submit" name="verifikasi" value="rejected" class="btn btn-danger">Reject</button>
                                    <?php elseif ($row['status'] === 'verifikasi pengembalian'): ?>
                                        <button type="submit" name="verifikasi" value="verifikasi pengembalian" class="btn btn-info">Verifikasi</button>
                                        <button type="submit" name="verifikasi" value="rejected" class="btn btn-danger">Reject</button>
                                    <?php elseif ($row['status'] === 'returned'): ?>
                                        lab sudah dikembalikan
                                    <?php endif; ?>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data peminjaman atau pengembalian.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
<!-- Memastikan jQuery dan Bootstrap JS dimuat dengan benar -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>