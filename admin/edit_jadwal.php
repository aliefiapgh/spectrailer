<?php
    include "../koneksi/connection.php";

    $id_jadwal = $_GET['id_jadwal'] ?? '';

    $queryJadwal = "SELECT * FROM jadwal_tayang WHERE id_jadwal = '$id_jadwal'";
    $resultJadwal = mysqli_query($koneksi, $queryJadwal);
    $jadwal = mysqli_fetch_assoc($resultJadwal);

   
    if (!$jadwal) {
        echo "<p style='color: red; text-align: center;'>Jadwal tidak ditemukan!</p>";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_film = $_POST['id_film'];
        $lokasi = $_POST['lokasi'];
        $tanggal = $_POST['tanggal'];
        $jam_mulai = $_POST['jam_mulai'];
        $jam_selesai = $_POST['jam_selesai'];

        $queryUpdate = "UPDATE jadwal_tayang SET id_film='$id_film', lokasi='$lokasi', tanggal='$tanggal', jam_mulai='$jam_mulai', jam_selesai='$jam_selesai' WHERE id_jadwal='$id_jadwal'";
        
        if (mysqli_query($koneksi, $queryUpdate)) {
            echo "<script>alert('Jadwal berhasil diperbarui!'); window.location.href='view_jadwal.php';</script>";
        } else {
            echo "<p style='color: red; text-align: center;'>Gagal memperbarui jadwal.</p>";
        }
    }

    $queryFilm = "SELECT * FROM film";
    $resultFilm = mysqli_query($koneksi, $queryFilm);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Jadwal</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h1>Edit Jadwal</h1>
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
    <form action="" method="POST">
        <label for="id_film">Film:</label>
        <select id="id_film" name="id_film" required>
            <?php while ($film = mysqli_fetch_assoc($resultFilm)) { ?>
                <option value="<?php echo $film['id_film']; ?>" <?php echo ($jadwal['id_film'] == $film['id_film']) ? 'selected' : ''; ?>>
                    <?php echo $film['judul']; ?>
                </option>
            <?php } ?>
        </select>

        <label for="lokasi">Lokasi:</label>
        <input type="text" id="lokasi" name="lokasi" value="<?php echo $jadwal['lokasi']; ?>" required>

        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="<?php echo $jadwal['tanggal']; ?>" required>

        <label for="jam_mulai">Jam Mulai:</label>
        <input type="time" id="jam_mulai" name="jam_mulai" value="<?php echo $jadwal['jam_mulai']; ?>" required>

        <label for="jam_selesai">Jam Selesai:</label>
        <input type="time" id="jam_selesai" name="jam_selesai" value="<?php echo $jadwal['jam_selesai']; ?>" required>

        <button type="submit">Simpan Perubahan</button>
    </form>
</main>

</body>
<footer class="footer">
    <font color=#000> Copyright &copy; 2025 - Spectrailer <br/>
    Developed By <a href="#"> Rima Tumaya, Kayla Azzahra, Aliefia Puan Ghifari</font>
</footer>
</html>
