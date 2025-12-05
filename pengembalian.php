<?php
include 'koneksi.php';
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$peminjaman_query = "SELECT username, lab, tanggal_pinjam, start_time, end_time, id, status FROM peminjaman WHERE nim = ?";


// Pastikan ID peminjaman tersedia di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $_SESSION['message'] = "ID peminjaman tidak ditemukan.";
    header("Location: profile.php");
    exit;
}

// Cek jika form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil file yang diupload
    $file = $_FILES['bukti_pengembalian'];
    $target_dir = "uploads/"; // Pastikan folder ini ada dan dapat ditulis
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek ukuran file
    if ($file["size"] > 200000000) { // 200MB
        $_SESSION['message'] = "Maaf, ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Cek format file
    if ($imageFileType != "jpg" && $imageFileType != "jpeg") {
        $_SESSION['message'] = "Maaf, hanya file JPG & JPEG yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Cek apakah $uploadOk di-set ke 0 oleh kesalahan
    if ($uploadOk == 0) {
        $_SESSION['message'] = "Maaf, file tidak dapat diupload.";
        header("Location: profile.php");
    } else {
        // Jika semua cek lolos, coba upload file
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            // Simpan informasi pengembalian ke database
            $update_sql = "UPDATE peminjaman SET status = 'verifikasi pengembalian', bukti_pengembalian = ? WHERE id = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("si", $target_file, $id);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Lab berhasil dikembalikan! Menunggu verifikasi admin.";
            } else {
                $_SESSION['message'] = "Terjadi kesalahan saat mengembalikan lab.";
            }

            $stmt->close();
        } else {
            $_SESSION['message'] = "Maaf, terjadi kesalahan saat mengupload file.";
        }
    }

    header("Location: profile.php"); // Redirect ke halaman profil setelah upload
    exit;
}
