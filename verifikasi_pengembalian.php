<?php
include 'koneksi.php';
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: dashboard_admin.php");
    exit;
}

// Pastikan ID peminjaman tersedia di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update status peminjaman menjadi 'dikembalikan'
    $update_sql = "UPDATE peminjaman SET status = 'dikembalikan' WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Pengembalian lab berhasil diverifikasi.";
    } else {
        $_SESSION['message'] = "Terjadi kesalahan saat memverifikasi pengembalian lab.";
    }

    $stmt->close();
} else {
    $_SESSION['message'] = "ID peminjaman tidak ditemukan.";
}

$conn->close();
header("Location: dashboard_admin.php");
exit;
?>