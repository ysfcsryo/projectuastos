<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php
    session_start();
    include 'koneksi.php';

    // Cek apakah pengguna sudah login
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }

    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-info text-center'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']); // Hapus pesan setelah ditampilkan
    }

    // Ambil data pengguna berdasarkan username dari sesi
    $username = $_SESSION['username'];

    $sql = $conn->prepare("SELECT nim, nama_lengkap, email, program_studi, kontak FROM regis WHERE username = ?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
    } else {
        echo "Data pengguna tidak ditemukan.";
        exit;
    }

    // Ambil data peminjaman
    $peminjaman_query = "SELECT username, lab, tanggal_pinjam, start_time, end_time, id, alasan_peminjaman, alasan_lain, dosen, mk, kelas, status FROM peminjaman WHERE nim = ? ORDER BY tanggal_pinjam DESC, id DESC";
    $peminjaman_stmt = $conn->prepare($peminjaman_query);
    $peminjaman_stmt->bind_param("s", $user_data['nim']);
    $peminjaman_stmt->execute();
    $peminjaman_result = $peminjaman_stmt->get_result();
    $conn->close();

    ?>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-4">Profil Pengguna</h1>
            <a href="logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-left"></i></a> <!-- Tombol Logout di kanan atas -->
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($user_data['nama_lengkap']); ?></h5>
                <p class="card-text"><strong>NIM:</strong> <?= htmlspecialchars($user_data['nim']); ?></p>
                <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($user_data['email']); ?></p>
                <p class="card-text"><strong>Program Studi:</strong> <?= htmlspecialchars($user_data['program_studi']); ?></p>
                <p class="card-text"><strong>Kontak:</strong> <?= htmlspecialchars($user_data['kontak']); ?></p>
                <a href="edit_profil.php" class="btn btn-primary">Edit Profil</a>
                <a href="beranda.php" class="btn btn-secondary">Kembali</a>
                <form action="hapus_akun.php" method="POST" style="display:inline;">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus akun?');">Hapus Akun</button>
                </form>
            </div>
        </div>

        <h2 class="mt-5">Riwayat Peminjaman Laboratorium</h2>
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($peminjaman_result->num_rows > 0) {
                    $no = 1;
                    while ($row = $peminjaman_result->fetch_assoc()) {
                        echo "<tr>  
                        <td>{$no}</td>
                        <td>" . htmlspecialchars($row['username']) . "</td>
                        <td>" . htmlspecialchars($row['lab']) . "</td>
                        <td>" . htmlspecialchars($row['tanggal_pinjam']) . "</td>
                        <td>" . date('H:i', strtotime($row['start_time'])) . "</td>
                        <td>" . date('H:i', strtotime($row['end_time'])) . "</td>
                        <td>" . htmlspecialchars($row['alasan_peminjaman']) . "</td>
                        <td>" . htmlspecialchars($row['alasan_lain']) . "</td>
                        <td>" . htmlspecialchars($row['dosen']) . "</td>
                        <td>" . htmlspecialchars($row['mk']) . "</td>
                        <td>" . htmlspecialchars($row['kelas']) . "</td>
                        <td>" . htmlspecialchars($row['status']) . "</td>
                        <td>";

                        // Cek status peminjaman
                        if ($row['status'] == 'approved') {
                            $idPeminjaman = $row['id'];
                            echo "<a href='pengembalian.php?id={$row['id']}' class='btn btn-primary' data-toggle='modal' data-target='#pengembalianModal'>Kembalikan Lab</a>";
                        } elseif ($row['status'] == 'pending') {
                            echo "<span class='text-warning'>Menunggu Verifikasi</span>";
                        } elseif ($row['status'] == 'menunggu verifikasi') {
                            echo "<span class='badge text-bg-success'>Lab diverfikasi</span>";
                        } elseif ($row['status'] == 'returned') {
                            echo "<span class='text-success'>Lab Sudah Dikembalikan</span>";
                        } elseif ($row['status'] == 'verifikasi pengembalian') {
                            echo "<span class='text-warning'>Menunggu konfirmasi</span>";
                        } else {
                            echo "<span class='text-danger'>Permohonan Ditolak</span>";
                        }
                        echo "</td></tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Tidak ada riwayat peminjaman</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
  
    <div class="modal fade" id="pengembalianModal" tabindex="-1" role="dialog" aria-labelledby="pengembalianModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pengembalianModalLabel">Form Pengembalian Lab</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="pengembalian.php?id=<?php echo $idPeminjaman; ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($user_data['nama_lengkap']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nim">NIM:</label>
                            <?php if (isset($_SESSION['nim'])): ?>
                                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo htmlspecialchars($_SESSION['nim']); ?>" readonly>
                            <?php else: ?>
                                <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM tidak ditemukan" readonly>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="bukti_pengembalian">Bukti Pengembalian:</label>
                            <input type="file" class="form-control" id="bukti_pengembalian" accept="image/*" capture="camera" name="bukti_pengembalian" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Pengembalian</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Tambahkan jQuery dan Bootstrap JS sebelum penutup tag </body> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>