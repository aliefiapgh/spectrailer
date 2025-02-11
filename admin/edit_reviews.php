<?php
include "../koneksi/connection.php";

if (!isset($_GET['id_review']) || empty($_GET['id_review'])) {
    echo "<script>alert('Review tidak ditemukan!'); window.location='view_reviews.php';</script>";
    exit;
}

$id_review = mysqli_real_escape_string($koneksi, $_GET['id_review']);


$queryReview = "SELECT * FROM review WHERE id_review = '$id_review'";
$resultReview = mysqli_query($koneksi, $queryReview);

if (mysqli_num_rows($resultReview) == 0) {
    echo "<script>alert('Film tidak ditemukan!'); window.location='view_review.php';</script>";
    exit;
}

$review = mysqli_fetch_assoc($resultReview);


if (isset($_POST['update'])) {
    $id_film = mysqli_real_escape_string($koneksi, $_POST['id_film']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $komentar = mysqli_real_escape_string($koneksi, $_POST['komentar']);

    $queryUpdate = "UPDATE review SET 
                    id_film='$id_film', 
                    username='$username', 
                    komentar='$komentar', 
                    WHERE id_review = '$id_review'";

    if (mysqli_query($koneksi, $queryUpdate)) {
        echo "<script>alert('Review berhasil diperbarui!'); window.location='view_film.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui review!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header><h1>Edit Review</h1></header>
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
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $film['username']; ?>" required>

        <label>Komentar:</label>
        <input type="text" name="komentar" value="<?php echo $film['komentar']; ?>" required>

        <button type="submit" name="update">Update</button>
    </form>
</main>

<footer class="footer">
<font color=#000> Copyright &copy; 2025 - Spectrailer <br/>
Developed By <a href="#"> Rima Tumaya, Kayla Azzahra, Aliefia Puan Ghifari</font>
</footer>

</body>
</html>