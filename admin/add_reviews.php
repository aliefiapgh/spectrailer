<?php
    include "../koneksi/connection.php";

    
    $queryFilm = "SELECT * FROM film";
    $resultFilm = mysqli_query($koneksi, $queryFilm);

   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_film = isset($_POST['id_film']) ? trim($_POST['id_film']) : null;
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $komentar = isset($_POST['komentar']) ? trim($_POST['komentar']) : '';

        if (!empty($id_film) && !empty($username) && !empty($komentar)) {
            
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
    <h1>Tambah Review</h1>
</header>
<nav class="navbar">
<div class="menu">
    <a href="../pengunjung/view_film.php" class="btn-menu">Film</a>
    <a href="../pengunjung/view_jadwal.php" class="btn-menu">Jadwal Tayang</a>
    <a href="../pengunjung/view_reviews.php" class="btn-menu">Reviews</a>
</div>
</nav>
<main>
    <form action="" method="POST">
        <label for="id_film">Pilih Film:</label>
        <select id="id_film" name="id_film" required>
            <option value="">-- Pilih Film --</option>
            <?php while ($film = mysqli_fetch_assoc($resultFilm)) { ?>
                <option value="<?php echo htmlspecialchars($film['id_film']); ?>">
                    <?php echo htmlspecialchars($film['judul']); ?>
                </option>
            <?php } ?>
        </select>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="komentar">Komentar:</label>
        <textarea id="komentar" name="komentar" required></textarea>

        <button type="submit">Kirim Review</button>
    </form>
</main>
</body>
<footer class="footer">
    <font color=#000> Copyright &copy; 2025 - Spectrailer <br/>
    Developed By <a href="#"> Rima Tumaya, Kayla Azzahra, Aliefia Puan Ghifari</a></font>
</footer>
</html>
