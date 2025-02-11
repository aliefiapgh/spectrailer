<?php
    include "../koneksi/connection.php";

    // Ambil data film untuk dropdown
    $queryFilm = "SELECT * FROM film";
    $resultFilm = mysqli_query($koneksi, $queryFilm);

    // Jika form disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_film = isset($_POST['id_film']) ? trim($_POST['id_film']) : null;
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $komentar = isset($_POST['komentar']) ? trim($_POST['komentar']) : '';

        if (!empty($id_film) && !empty($username) && !empty($komentar)) {
            // Gunakan prepared statement untuk keamanan
            $queryInsert = "INSERT INTO review (id_film, username, komentar) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($koneksi, $queryInsert);
            mysqli_stmt_bind_param($stmt, "sss", $id_film, $username, $komentar);
            
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Review berhasil ditambahkan!'); window.location.href='view_reviews.php?id_film=$id_film';</script>";
            } else {
                echo "<p style='color: red; text-align: center;'>Gagal menambahkan review.</p>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<p style='color: red; text-align: center;'>Mohon lengkapi semua data!</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Film</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background-color: #1a1a2e;
            color: white;
            text-align: center;
        }
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        form {
            background: #16213e;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            text-align: left;
        }
        label {
            display: block;
            width: 100%;
            margin-bottom: 5px;
            color: white;
            font-weight: bold;
        }
        input, select, textarea {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 5px;
            border: none;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #e94560;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        .menu {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<header>
    <h1>Tambah Film</h1>
</header>
<nav class="navbar">
<div class="menu">
    <a href="../admin/view_film.php" class="btn-menu">Film</a>
    <a href="../admin/view_jadwal.php" class="btn-menu">Jadwal Tayang</a>
    <a href="../admin/view_reviews.php" class="btn-menu">Reviews</a>
</div>
</nav>
<main>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="poster">Pilih Gambar untuk Diunggah:</label>
        <input type="file" name="poster" accept="image/*" required>
        
        <label for="judul">Judul:</label>
        <input type="text" name="judul" placeholder="Judul" required>
        
        <label for="tahun_rilis">Tahun Rilis:</label>
        <input type="text" name="tahun_rilis" placeholder="Tahun Rilis" required>
        
        <label for="genre">Genre:</label>
        <input type="text" name="genre" placeholder="Genre" required>
        
        <label for="rating">Rating (0-10):</label>
        <input type="number" name="rating" min="0" max="10" step="0.1" required>
        
        <button type="submit">Tambah</button>
    </form>
</main>
</body>
<footer class="footer">
    <font color=#000> Copyright &copy; 2025 - Spectrailer <br/>
    Developed By <a href="#"> Rima Tumaya, Kayla Azzahra, Aliefia Puan Ghifari</a></font>
</footer>
</html>
