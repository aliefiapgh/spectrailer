<?php
session_start(); 

include "../koneksi/connection.php";


$queryReview = "SELECT * FROM review";
$resultReview = mysqli_query($koneksi, $queryReview);
$countReview = mysqli_num_rows($resultReview);
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
<?php if ($countReview > 0) { ?>
        <div class="film-container">
            <?php while ($row = $resultReview->fetch_assoc()) { ?>
                <div class="film-card">
                    <p>🖼️ Film    : <?php echo $row['id_film']; ?></p>
                    <p>👤 Username: <?php echo $row['username']; ?></p>
                    <p>📃 Komentar: <?php echo $row['komentar']; ?>/10</p>

                    <a href="edit_reviews.php?id_review=<?php echo $row['id_review']; ?>" class="btn-edit">Edit</a>
                    <a href="delete_reviews.php?id_review=<?php echo $row['id_review']; ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus review ini?');">Hapus</a>

                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p style="text-align: center; padding: 20px;">Belum ada review yang tersedia. <a href="add_reviews.php">Tambah Review</a>.</p>
    <?php } ?>

    <div align="center">
        <a href="../admin/add_reviews.php">Tambah Reviews</a>
    </div>
</main>

<footer class="footer">
<font color=#000> Copyright &copy; 2025 - Spectrailer <br/>
Developed By <a href="#"> Rima Tumaya, Kayla Azzahra, Aliefia Puan Ghifari</font>
</footer>

</body>
</html>
