<link rel="stylesheet" href="css/navbar.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<header class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #666666;">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <h1 style="margin: 0; font-size: 1.5rem; font-weight: bold; margin-right: 15px; color: white;">SIMPEL</h1>
            <div style="line-height: 1.2; color: white;">
                <p style="margin: 0; font-size: 0.9rem;">Sistem Informasi Peminjaman Laboratorium</p>
                <p style="margin: 0; font-size: 0.8rem; font-style: italic;">Jurusan Teknik Informatika UNG</p>
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="beranda.php" style="color: white;">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">Laboratorium</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="infolab.php?lab=1">LAB 1</a>
                        <a class="dropdown-item" href="infolab.php?lab=2">LAB 2</a>
                        <a class="dropdown-item" href="infolab.php?lab=3">LAB 3</a>
                        <a class="dropdown-item" href="infolab.php?lab=4">LAB 4</a>
                        <a class="dropdown-item" href="infolab.php?lab=5">LAB 5</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="infolab.php?lab=6">LAB MANDIRI</a>
                        <a class="dropdown-item" href="infolab.php?lab=7">LAB STUDIO</a>
                    </div>
                </li>
                
                <?php if (isset($_SESSION['username'])): ?>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] !== 'user'): ?>
                        <li class="nav-item"><a class="nav-link" href="dashboard_admin.php" style="color: white;">Dashboard</a> 
                            <?php endif; ?></li> 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                            <i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['username']); ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] !== 'admin'): ?>
                                <a class="dropdown-item" href="profile.php">Profil</a> <!-- Profil hanya muncul jika bukan admin -->
                            <?php endif; ?>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php" style="color: white;">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
</header>
