<?php
include "../koneksi/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_film = $_POST['id_film'];
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $harga_tiket = $_POST['harga_tiket'];

    $query = "INSERT INTO jadwal_tayang (id_film, lokasi, tanggal, jam_mulai, jam_selesai, harga_tiket) 
              VALUES ('$id_film', '$lokasi', '$tanggal', '$jam_mulai', '$jam_selesai', '$harga_tiket')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Jadwal berhasil ditambahkan!'); window.location='view_jadwal.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal</title>
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
            width: 40%;
            text-align: left;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.1);
        }
        label {
            display: block;
            width: 100%;
            margin-bottom: 5px;
            color: white;
            font-weight: bold;
        }
        input, select {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #3a3a3c;
            background-color:rgb(255, 255, 255);
            color: black;
            font-size: 14px;
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
    </style>
</head>
<body>
<header>
    <h1>Tambah Jadwal Tayang</h1>
</header>
<nav class="navbar">
<div class="menu">
    <a href="../admin/view_film.php" class="btn-menu">Film</a>
    <a href="../admin/view_jadwal.php" class="btn-menu">Jadwal Tayang</a>
    <a href="../admin/view_reviews.php" class="btn-menu">Reviews</a>
</div>
</nav>
<main>
    <form method="POST">
        <label>Film:</label>
        <select name="id_film" required>
            <?php
            $filmQuery = mysqli_query($koneksi, "SELECT * FROM film");
            while ($film = mysqli_fetch_assoc($filmQuery)) {
                echo "<option value='{$film['id_film']}'>{$film['judul']}</option>";
            }
            ?>
        </select>

        <label>Lokasi:</label>
        <input type="text" name="lokasi" required>

        <label>Tanggal:</label>
        <input type="date" name="tanggal" required>

        <label>Jam Mulai:</label>
        <input type="time" name="jam_mulai" required>

        <label>Jam Selesai:</label>
        <input type="time" name="jam_selesai" required>

        <label>Harga Tiket:</label>
        <input type="number" name="harga_tiket" required>

        <button type="submit">Tambah Jadwal</button>
    </form>
</main>
</body>
<footer class="footer">
    <font color=#000> Copyright &copy; 2025 - Spectrailer <br/>
    Developed By <a href="#"> Rima Tumaya, Kayla Azzahra, Aliefia Puan Ghifari</a></font>
</footer>
</html>
