<?php
session_start();
include "../koneksi/connection.php";

$isLoggedIn = isset($_SESSION['id']) ? true : false;
$query = "SELECT jadwal_tayang.*, film.judul 
          FROM jadwal_tayang 
          JOIN film ON jadwal_tayang.id_film = film.id_film 
          ORDER BY tanggal, jam_mulai";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
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

    <table border="1" width="100%">
        <tr>
            <th>Judul Film</th>
            <th>Lokasi</th>
            <th>Tanggal</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>Harga Tiket</th>
            <th>Aksi </th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['judul']; ?></td>
                <td><?= $row['lokasi']; ?></td>
                <td><?= $row['tanggal']; ?></td>
                <td><?= $row['jam_mulai']; ?></td>
                <td><?= $row['jam_selesai']; ?></td>
                <td><?= $row['harga_tiket']; ?></td>
                <td>
                <a href="edit_jadwal.php?id_jadwal=<?php echo $row['id_jadwal']; ?>" class="btn-edit">Edit</a> 
                <a href="delete_jadwal.php?id_jadwal=<?php echo $row['id_jadwal']; ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">Hapus</a>
                </td>
                
            </tr>
        <?php } ?>
    </table>
    <div align="center">
        <a href="../admin/add_jadwal.php">Tambah Jadwal</a>
    </div>
    
<footer class="footer">
<font color=#> Copyright &copy; 2025 - Spectrailer <br/>
Developed By <a href="#"> Rima Tumaya, Kayla Azzahra, Aliefia Puan Ghifari</font>
</footer>

</body>
</html>
