<!DOCTYPE html>
<html>
<head>
    <title>Lab yang Sedang Terpakai</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            position: relative; /* Pastikan body memiliki posisi relatif */
            margin: 0; /* Hapus margin default */
            height: 100vh; /* Pastikan body memiliki tinggi penuh */
            overflow: hidden; /* Menghindari overflow */
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('foto/lab/lab5.jpg'); /* Ganti dengan gambar latar belakang */
            background-size: cover;
            background-position: center;
            opacity: 50%; /* Atur opacity di sini (0.0 - 1.0) */
            z-index: -1; /* Pastikan berada di belakang konten */
        }

        .container {
            position: relative; /* Pastikan kontainer memiliki posisi relatif */
            z-index: 1; /* Pastikan konten berada di atas gambar latar belakang */
            color: black; /* Warna teks agar kontras dengan latar belakang */
            text-align: center;
            padding: 20px;
            height: 100%; /* Pastikan kontainer mengisi tinggi penuh */
            display: flex; /* Gunakan flexbox untuk tata letak */
            flex-direction: column; /* Atur arah kolom */
            align-items: center;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            grid-gap: 20px;
            padding: 20px;
        }

        .grid-item {
            background-color: rgba(227, 242, 253); 
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s;
        }

        .grid-item:hover {
            transform: scale(1.05); /* Efek zoom saat hover */
        }

        .no-lab-card {
            background-color: rgba(227, 242, 253); 
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            color: white; /* Warna teks putih */
            margin-top: 20px; /* Jarak atas */
            width: 300px; /* Lebar card */
            display: inline-block; /* Agar card tidak mengambil seluruh lebar */
        }

        .no-lab-card h2 {
            margin: 0; /* Hapus margin */
            font-size: 1.5em; /* Ukuran font */
        }



    </style>
</head>
<body>
    <div class="container">
        <h1>Lab Yang Sedang Terpakai Saat Ini Sampai 1 Jam Mendatang</h1>
        <div class="grid-container" id="grid-container">
            <?php
            $conn = mysqli_connect("localhost", "root", "", "projekuas");

            if (!$conn) {
                die("Koneksi gagal: " . mysqli_connect_error());
            }

            $query = "SELECT * FROM peminjaman WHERE start_time <= NOW() AND end_time >= NOW() OR start_time <= DATE_ADD(NOW(), INTERVAL 1 HOUR) AND end_time >= DATE_ADD(NOW(), INTERVAL 1 HOUR)";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="grid-item">
                        <div class="lab-info">
                            <h2><?php echo $row['lab']; ?></h2>
                            <p>Tanggal Pinjam: <?php echo $row['tanggal_pinjam']; ?></p>
                            <p>Waktu Mulai: <?php echo $row['start_time']; ?></p>
                            <p>Waktu Selesai: <?php echo $row['end_time']; ?></p>
                        </div>
                        <div class="lab-status">
                            <p>Status: Sedang Terpakai</p>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="no-lab-card">
                    <h1>Tidak Ada Lab yang Sedang Terpakai</h1>
                </div>
                <?php
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>        
    
    setInterval(function() {
        $.ajax({

            type: "POST",
            url: "update.php",
            success: function(data) {
                $("#grid-container").html(data); // Masukkan hasil ke elemen #grid-container
            },
            error: function() {
                console.error("Gagal memuat data dari server.");
            }
        });
    }, 5000); // Update setiap 5 detik

        

    </script>
</body>
</html>
