<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "projekuas");

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mendapatkan data lab yang sedang terpakai
$query = "SELECT * FROM peminjaman 
          WHERE status = 'approved' 
          AND (start_time <= NOW() AND end_time >= NOW() 
               OR start_time <= DATE_ADD(NOW(), INTERVAL 1 HOUR) 
               AND end_time >= DATE_ADD(NOW(), INTERVAL 1 HOUR))";
$result = mysqli_query($conn, $query);

// Tampilkan hasil dalam bentuk HTML
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="grid-item">';
        echo '<div class="lab-info">';
        echo '<h2>' . $row['lab'] . '</h2>';
        echo '<p>Tanggal Pinjam: ' . $row['tanggal_pinjam'] . '</p>';
        echo '<p>Waktu Mulai: ' . $row['start_time'] . '</p>';
        echo '<p>Waktu Selesai: ' . $row['end_time'] . '</p>';
        echo '</div>';
        echo '<div class="lab-status">';
        echo '<p>Status: Sedang Terpakai</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>Tidak ada lab yang sedang terpakai.</p>';
}

mysqli_close($conn);
?>
