<?php
session_start();
include 'koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Ambil username dari sesi
$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Query untuk menghapus akun dari tabel 'regis'
    $delete_user_query = $conn->prepare("DELETE FROM regis WHERE username = ?");
    $delete_user_query->bind_param("s", $username);

    // Query untuk menghapus riwayat peminjaman terkait
    $delete_peminjaman_query = $conn->prepare("DELETE FROM peminjaman WHERE nim = (SELECT nim FROM regis WHERE username = ?)");
    $delete_peminjaman_query->bind_param("s", $username);

    if ($delete_user_query->execute() && $delete_peminjaman_query->execute()) {
        // Hapus sesi pengguna
        session_destroy();
        // Redirect ke halaman login setelah akun dihapus
        header("Location: beranda.php");
        exit;
    }
} else {
    header("Location: profil.php");
    exit;
}
