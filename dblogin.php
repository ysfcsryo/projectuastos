<?php
include 'koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim']; // Mengambil NIM dari form login
    $password = $_POST['password']; // Mengambil password dari form login

    // Query untuk mencari data berdasarkan NIM
    $sql = "SELECT * FROM regis WHERE nim = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nim);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifikasi password (gunakan password_verify jika password di-hash)
        if ($password === $row['password']) {
            // Simpan data ke sesi
            $_SESSION['username'] = $row['username'];
            $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
            $_SESSION['nim'] = $row['nim'];

            // Cek role dari database atau NIM
            if (strpos($nim, '53') !== false) {
                $_SESSION['role'] = 'user'; // Set role sebagai 'user' jika NIM mengandung '53'
                $_SESSION['message'] = "berhasil login";
                header("Location: beranda.php"); // Arahkan ke beranda
            } else {
                // Pastikan jika role tidak ada, set default 'user'
                $_SESSION['role'] = isset($row['role']) ? $row['role'] : 'user'; 
                header("Location: dashboard_admin.php"); // Arahkan ke dashboard admin
            }

            exit;
        } else {
            $error = "Username atau Password salah";
            header("Location: login.php?error");
            exit;
        }
    } else {
        $error = "Username atau Password salah";
        header("Location: login.php?error");
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>
