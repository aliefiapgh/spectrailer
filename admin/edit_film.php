<?php
include "../koneksi/connection.php";


if (!isset($_GET['id_film']) || empty($_GET['id_film'])) {
    echo "<script>alert('Film tidak ditemukan!'); window.location='view_film.php';</script>";
    exit;
}

$id_film = mysqli_real_escape_string($koneksi, $_GET['id_film']);


$queryFilm = "SELECT * FROM film WHERE id_film = '$id_film'";
$resultFilm = mysqli_query($koneksi, $queryFilm);

if (mysqli_num_rows($resultFilm) == 0) {
    echo "<script>alert('Film tidak ditemukan!'); window.location='view_film.php';</script>";
    exit;
}

$film = mysqli_fetch_assoc($resultFilm);


if (isset($_POST['update'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $genre = mysqli_real_escape_string($koneksi, $_POST['genre']);
    $tahun_rilis = mysqli_real_escape_string($koneksi, $_POST['tahun_rilis']);
    $rating = mysqli_real_escape_string($koneksi, $_POST['rating']);
    $poster = mysqli_real_escape_string($koneksi, $_POST['poster']); 

    $queryUpdate = "UPDATE film SET 
                    judul='$judul', 
                    genre='$genre', 
                    tahun_rilis='$tahun_rilis', 
                    rating='$rating', 
                    poster='$poster' 
                    WHERE id_film = '$id_film'";

    if (mysqli_query($koneksi, $queryUpdate)) {
        echo "<script>alert('Data film berhasil diperbarui!'); window.location='view_film.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui film!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Film</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header><h1>Edit Film</h1></header>
<div class="menu-center">
        <a href="../admin/view_film.php" class="btn-menu">Film</a>
        <a href="../admin/view_jadwal.php" class="btn-menu">Jadwal Tayang</a>
        <a href="../admin/view_reviews.php" class="btn-menu">Reviews</a>
    </div>


<main>
    <form method="POST">
        <label>Judul:</label>
        <input type="text" name="judul" value="<?php echo $film['judul']; ?>" required>

        <label>Genre:</label>
        <input type="text" name="genre" value="<?php echo $film['genre']; ?>" required>

        <label>Tahun Rilis:</label>
        <input type="number" name="tahun_rilis" value="<?php echo $film['tahun_rilis']; ?>" required>

        <label>Rating:</label>
        <input type="number" step="0.1" name="rating" value="<?php echo $film['rating']; ?>" required>

        <label>Poster (URL):</label>
        <input type="text" name="poster" value="<?php echo $film['poster']; ?>">

        <button type="submit" name="update">Update</button>
    </form>
</main>

<footer class="footer">
<font color=#000> Copyright &copy; 2025 - Spectrailer <br/>
Developed By <a href="#"> Rima Tumaya, Kayla Azzahra, Aliefia Puan Ghifari</font>
</footer>

</body>
</html>