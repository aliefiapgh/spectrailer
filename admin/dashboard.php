<?php
include "../koneksi/connection.php";
session_start();

// Pastikan pengguna sudah login
$isLoggedIn = isset($_SESSION['user']);
$role = $isLoggedIn ? $_SESSION['user']['role'] : null;

// Query untuk mendapatkan daftar film
$queryFilm = "SELECT * FROM film";
$resultFilm = mysqli_query($koneksi, $queryFilm);
$countFilm = mysqli_num_rows($resultFilm);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spectrailer</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h1>Spectrailer</h1>
</header>

<nav class="navbar">
    <div class="menu-center">
    <a href="../admin/dashboard.php" class="btn-menu">Film</a>
    <a href="../admin/view_film.php" class="btn-menu">Film</a>
    <a href="../admin/view_jadwal.php" class="btn-menu">Jadwal Tayang</a>
    <a href="../admin/view_reviews.php" class="btn-menu">Reviews</a>
    </div>

    <div class="menu-right">
        <?php if ($isLoggedIn): ?>
            <a href="../user/profile.php">
                <img src="../assets/images/profile.jpg" alt="Profil" class="login-icon">
            </a>
            <a href="../auth/logout.php" class="btn-menu">Logout</a>
        <?php else: ?>
            <a href="../auth/login.php">
                <img src="../assets/images/profile.jpg" alt="Login" class="login-icon">
            </a>
        <?php endif; ?>
    </div>
</nav>

<main>
    <?php if ($countFilm > 0): ?>
        <div class="film-container">
            <?php while ($row = $resultFilm->fetch_assoc()): ?>
                <div class="film-card">
                <img src="../<?php echo $row['poster']; ?>" alt="<?php echo $row['judul']; ?>">
                    <h3><?php echo $row['judul']; ?></h3>
                    <p>🎬 Genre: <?php echo $row['genre']; ?></p>
                    <p>📅 Tahun: <?php echo $row['tahun_rilis']; ?></p>
                    <p>⭐ Rating: <?php echo $row['rating']; ?>/10</p>

                    <!-- Tombol Review (Tersedia untuk semua pengguna) -->
                    <a href="../pengunjung/view_reviews.php" class="btn-review">Review</a>

                    <!-- Tombol Edit dan Hapus hanya untuk Admin -->
                        <a href="../admin/edit_film.php?id_film=<?php echo $row['id_film']; ?>" class="btn-edit">Edit</a>
                        <a href="../admin/delete_film.php?id_film=<?php echo $row['id_film']; ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus film ini?');">Hapus</a>
                    
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p style="text-align: center; padding: 20px;">Belum ada film yang tersedia.</p>
    <?php endif; ?>
</main>

<footer class="footer">
<font color=#000> Copyright &copy; 2025 - Spectrailer <br/>
Developed By <a href="#"> Rima Tumaya, Kayla Azzahra, Aliefia Puan Ghifari</font>
</footer>

</body>
</html>
