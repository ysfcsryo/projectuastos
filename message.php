<link rel="stylesheet" href="css/message.css">
<?php
        if (isset($_SESSION['message'])) {
            echo "<div class='alert alert-info floating-alert'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']); // Hapus pesan setelah ditampilkan
        }
    ?>