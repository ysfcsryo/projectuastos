<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $program_studi = $_POST['program_studi'];
    $kontak = $_POST['kontak'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Periksa apakah NIM sudah ada
    $check_sql = $conn->prepare("SELECT nim FROM regis WHERE nim = ?");
    $check_sql->bind_param("s", $nim);
    $check_sql->execute();
    $result = $check_sql->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "NIM sudah terdaftar. Silakan gunakan NIM lain.";
        header("Location: register.php");
        exit;
    }

        // Periksa apakah username sudah ada
    $check_username_sql = $conn->prepare("SELECT username FROM regis WHERE username = ?");
    $check_username_sql->bind_param("s", $username);
    $check_username_sql->execute();
    $username_result = $check_username_sql->get_result();
    
    if ($username_result->num_rows > 0) {
        $_SESSION['error'] = "Username sudah digunakan. Silakan pilih username lain.";
        header("Location: register.php");
        exit;
    }
    
    $sql = $conn->prepare("INSERT INTO regis (nim, nama_lengkap, email, program_studi, kontak, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("sssssss", $nim, $nama_lengkap, $email, $program_studi, $kontak, $username, $password);

    if ($sql->execute()) {
         $_SESSION['message'] = "Registrasi berhasil. Silakan login.";
        header("Location: login.php");
        exit;
    } else {
            echo "Error saat registrasi: " . $sql->error;
        }
    }

    $conn->close();

?>
