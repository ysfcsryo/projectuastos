<?php
include 'koneksi.php';  // Pastikan file koneksi ada
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$id_admin = isset($_SESSION['id_admin']) ? $_SESSION['id_admin'] : null; // Memeriksa jika id_admin ada
$message = ""; // Variabel untuk menyimpan pesan

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $lab = $_POST['lab'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $alasan_peminjaman = $_POST['alasan_peminjaman'];
    $alasan_lain = $_POST['alasan_lain'];
    $dosen = $_POST['dosen'];
    $mk = $_POST['mk'];
    $kelas = $_POST['kelas'];
    $username = $_SESSION['username'];
    
    //periksa jika lab sedang digunakan
    $check_lab_sql = "SELECT COUNT(*) FROM peminjaman WHERE lab = ? AND status NOT IN ('returned','rejected')";
    $check_lab_stmt = $conn->prepare($check_lab_sql);
    $check_lab_stmt->bind_param("s", $lab);  
    $check_lab_stmt->execute();
    $check_lab_stmt->bind_result($lab_in_use);
    $check_lab_stmt->fetch();
    $check_lab_stmt->close();

    if ($lab_in_use > 0) {
        $_SESSION['message'] = "Lab ini sedang digunakan. Silakan pilih waktu atau lab lain.";
        header("Location: infolab.php?lab=$lab");
        exit;
    }


    // Periksa jika ada peminjaman aktif
    $check_sql = "SELECT COUNT(*) FROM peminjaman WHERE nim = ? AND status NOT IN ('returned', 'rejected')";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $nim);
    $check_stmt->execute();
    $check_stmt->bind_result($active_count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($active_count > 0) {
        $_SESSION['message'] = "Anda masih memiliki peminjaman aktif. Harap kembalikan sebelum meminjam lagi.";
        header("Location: infolab.php?lab=$lab");
    } else {
            // Melakukan insert data peminjaman
            $sql = "INSERT INTO peminjaman (username, nim, lab, tanggal_pinjam, start_time, end_time, alasan_peminjaman, alasan_lain, dosen, mk, kelas, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssssss", $username, $nim, $lab, $tanggal_pinjam, $start_time, $end_time, $alasan_peminjaman, $alasan_lain, $dosen, $mk, $kelas);

            // Ambil tanggal sekarang
        $currentDate = date('Y-m-d');

        // Validasi tanggal peminjaman
        if ($tanggal_pinjam < $currentDate) {
            $_SESSION['message'] = "Tanggal peminjaman tidak boleh di masa lalu.";
            header("Location: infolab.php?lab=$lab");
            exit();
        }

        // Validasi agar peminjaman tidak terlalu jauh di masa depan (misalnya 30 hari ke depan)
        $maxFutureDate = date('Y-m-d', strtotime('+7 days'));
        if ($tanggal_pinjam > $maxFutureDate) {
            $_SESSION['message'] = "Tanggal peminjaman tidak boleh lebih dari 7 hari ke depan.";
            header("Location: infolab.php?lab=$lab");
            exit();
        }

        // Contoh validasi di sisi server
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $startTime = $_POST['start_time'];
            $endTime = $_POST['end_time'];

            $currentTime = date('H:i');

            if ($startTime < $currentTime) {
                $_SESSION['message'] = "Waktu mulai tidak bisa kurang dari waktu saat ini.";
                header("Location: infolab.php?lab=$lab");
                exit();
            }

            if ($endTime <= $startTime) {
                $_SESSION['message'] = "Waktu selesai harus lebih besar dari waktu mulai.";
                header("Location: infolab.php?lab=$lab");
                exit();
            }
        }

        if ($stmt->execute()) {
            header("Location: profile.php");
             $_SESSION['message'] = "Peminjaman berhasil! Menunggu verifikasi.";
        } else {
            $_SESSION['message'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
$conn->close();
}
?>
