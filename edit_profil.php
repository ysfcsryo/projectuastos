<?php
session_start();
include 'koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Ambil data pengguna berdasarkan sesi
$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $program_studi = $_POST['program_studi'];
    $kontak = $_POST['kontak'];

    // Update data pengguna
    $sql = $conn->prepare("UPDATE regis SET nama_lengkap = ?, email = ?, program_studi = ?, kontak = ? WHERE username = ?");
    $sql->bind_param("sssss", $nama_lengkap, $email, $program_studi, $kontak, $username);

    if ($sql->execute()) {
        $_SESSION['success_message'] = "Profil berhasil diperbarui.";
        header("Location: profile.php");
        exit;
    } else {
        echo "Error saat memperbarui profil: " . $sql->error;
    }

    $conn->close();
} else {
    // Ambil data pengguna untuk mengisi form
    $sql = $conn->prepare("SELECT nama_lengkap, email, program_studi, kontak FROM regis WHERE username = ?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
    } else {
        echo "Data pengguna tidak ditemukan.";
        exit;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Profil</h1>
        <form method="POST" action="edit_profil.php">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= htmlspecialchars($user_data['nama_lengkap']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user_data['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="program_studi">Program Studi</label>
                <input type="text" class="form-control" id="program_studi" name="program_studi" value="<?= htmlspecialchars($user_data['program_studi']); ?>" required>
            </div>
            <div class="form-group">
                <label for="kontak">Kontak</label>
                <input type="text" class="form-control" id="kontak" name="kontak" value="<?= htmlspecialchars($user_data['kontak']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="profile.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
