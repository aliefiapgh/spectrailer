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
    <a href="../dashboard.php" class="btn-menu">Home</a>
    <a href="../pengunjung/view_film.php" class="btn-menu">Film</a>
    <a href="../pengunjung/view_jadwal.php" class="btn-menu">Jadwal Tayang</a>
    <a href="../pengunjung/view_reviews.php" class="btn-menu">Reviews</a>
    </div>

    <div class="menu-right">
            <a href="../user/profile.php">
                <img src="../assets/images/profile.jpg" alt="Profil" class="login-icon">
            </a>
            <a href="../auth/logout.php" class="btn-menu">Logout</a>
            <a href="../auth/login.php">
                <img src="../assets/images/profile.jpg" alt="Login" class="login-icon">
            </a>
    </div>
</nav>

<main>
        <h2>Selamat Datang di Dashboard Administrator</h2>
        <p>Kelola data film dan jadwal tayang dengan mudah</p>
        <p style="text-align: center; padding: 20px;">Belum ada film yang tersedia.</p>
</main>

<footer class="footer">
<font color=#000> Copyright &copy; 2025 - Spectrailer <br/>
Developed By <a href="#"> Rima Tumaya, Kayla Azzahra, Aliefia Puan Ghifari</font>
</footer>

</body>
</html>
