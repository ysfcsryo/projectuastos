<?php
include 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $action = $_POST['verifikasi'];

    

    if ($action === 'approved') {
        // Update status peminjaman menjadi 'approved'
        $sql = "UPDATE peminjaman SET status='approved' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Peminjaman berhasil diverifikasi.";
            header("Location: dashboard_admin.php");
        } else {
            $_SESSION['message'] = "Error: " . $conn->error;
        }

    } elseif ($action === 'rejected') {
        // Update status peminjaman menjadi 'rejected' (peminjaman ditolak)
        $sql = "UPDATE peminjaman SET status='rejected' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "ditolak.";
            header("Location: dashboard_admin.php");
        } else {
            $_SESSION['message'] = "Error: " . $conn->error;
        }

    } elseif ($action === 'verifikasi pengembalian') {
        // Update status peminjaman menjadi 'returned' (pengembalian diterima)
        $sql = "UPDATE peminjaman SET status='returned' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Pengembalian berhasil.";
            header("Location: dashboard_admin.php");
        } else {
            $_SESSION['message'] = "Error: " . $conn->error;
        }
   
    } elseif ($action === 'rejected_pengembalian') {
        // Update status peminjaman menjadi 'rejected_pengembalian' (pengembalian ditolak)
        $sql = "UPDATE peminjaman SET status='rejected_pengembalian' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "ditolak.";  // Pesan ini untuk penolakan pengembalian
            header("Location: dashboard_admin.php");
        } else {
            $_SESSION['message'] = "Error: " . $conn->error;
        }
    }
}
?>
