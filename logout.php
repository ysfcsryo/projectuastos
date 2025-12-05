<?php
// Memulai sesi jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hapus semua variabel sesi dan hancurkan sesi
session_unset();
session_destroy();

// Redirect ke halaman beranda
header("Location: beranda.php");
exit();
?>
