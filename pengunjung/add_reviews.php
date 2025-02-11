

<?php
    include "../koneksi/connection.php";

   
    $id_film = $_GET['id_film'] ?? '';

    
    $queryFilm = "SELECT * FROM film WHERE id_film = '$id_film'";
    var_dump($queryFilm);
    $resultFilm = mysqli_query($koneksi, $queryFilm);
    var_dump(mysqli_error($koneksi));
    $film = mysqli_fetch_assoc($resultFilm);

    
    if (empty($id_film)) {
        echo "<p style='color: red; text-align: center;'>ID film tidak ditemukan di URL!</p>";
        exit;
    }
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $komentar = $_POST['komentar'];

        if (!empty($username) && !empty($komentar)) {
            $queryInsert = "INSERT INTO review (id_film, username, komentar) VALUES ('$id_film', '$username', '$komentar')";
            if (mysqli_query($koneksi, $queryInsert)) {
                echo "<script>alert('Review berhasil ditambahkan!'); window.location.href='view_reviews.php?id_film=$id_film';</script>";
            } else {
                echo "<p style='color: red; text-align: center;'>Gagal menambahkan review.</p>";
            }
        } else {
            echo "<p style='color: red; text-align: center;'>Mohon lengkapi semua data!</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Review</title>
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
        }
        input, select, textarea {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 5px;
            border: none;
        }
        button {
            width: 100%;
            padding: 10px;
            background:rgb(90, 47, 54);
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
    <h1>Spectrailer</h1>
</header>

<main>
    <div class="menu-center">
        <a href="../pengunjung/view_film.php" class="btn-menu">Film</a>
        <a href="../pengunjung/view_jadwal.php" class="btn-menu">Jadwal Tayang</a>
        <a href="../pengunjung/view_reviews.php" class="btn-menu">Reviews</a>
    </div>

    <div class="film-detail">
        <img src="<?php echo $film['poster']; ?>" alt="<?php echo $film['judul']; ?>" width="150">
        <h2><?php echo $film['judul']; ?></h2>
        <p>🎬 Genre: <?php echo $film['genre']; ?></p>
        <p>📅 Tahun: <?php echo $film['tahun_rilis']; ?></p>
        <p>⭐ Rating: <?php echo $film['rating']; ?>/10</p>
    </div>

    <!-- Form tambah review -->
    <form action="" method="POST">
        <label for="username">Nama Anda:</label>
        <input type="text" id="username" name="username" required>

        <label for="komentar">Komentar:</label>
        <textarea id="komentar" name="komentar" required></textarea>

        <button type="submit">Kirim Review</button>
    </form>
</main>

</body>
</html>
