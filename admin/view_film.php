<?php
    include "../koneksi/connection.php";

    $queryFilm   ="SELECT * FROM film";
    $resultFilm  =mysqli_query ($koneksi, $queryFilm);
    $countFilm   =mysqli_num_rows ($resultFilm);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Film</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h1>HEADER</h1>
</header>

<nav class="navbar">
    <div class="menu">
        <a href="../admin/view_film.php" class="btn-menu">Film</a>
        <a href="../admin/view_jadwal.php" class="btn-menu">Jadwal Tayang</a>
        <a href="../admin/view_reviews.php" class="btn-menu">Reviews</a>
    </div>

    <div class="menu-right">
            <a href="logout.php" class="btn-menu">Logout</a>
                <img src="../assets/images/profile.jpg" alt="Profil" class="login-icon">
    </div>
</nav>

<main>
<?php if ($countFilm > 0) { ?>
        <div class="film-container">
            <?php while ($row = $resultFilm->fetch_assoc()) { ?>
                <div class="film-card">
                    <img src="../<?php echo $row['poster']; ?>" alt="<?php echo $row['judul']; ?>">
                    <h3><?php echo $row['judul']; ?></h3>
                    <p>🎬 Genre: <?php echo $row['genre']; ?></p>
                    <p>📅 Tahun: <?php echo $row['tahun_rilis']; ?></p>
                    <p>⭐ Rating: <?php echo $row['rating']; ?>/10</p>

                    <a href="view_reviews.php" class="btn-review">Review</a>
                    <a href="edit_film.php?id_film=<?php echo $row['id_film']; ?>" class="btn-edit">Edit</a>
                    <a href="delete_film.php?id_film=<?php echo $row['id_film']; ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus film ini?');">Hapus</a>

                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p style="text-align: center; padding: 20px;">Belum ada film yang tersedia. </p>
    <?php } ?>

    <div align="center">
        <a href="../admin/add_film.php">Tambah Film</a>
    </div>
</main>

<footer class="footer">
<font color=#000> Copyright &copy; 2025 - Spectrailer <br/>
Developed By <a href="#"> Rima Tumaya, Kayla Azzahra, Aliefia Puan Ghifari</font>
</footer>

</body>
</html>
