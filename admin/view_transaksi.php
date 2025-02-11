<?php
session_start();
include('../koneksi/connection.php');

// Pastikan pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location.href='../auth/login.php';</script>";
    exit();
}

$id_user = $_SESSION['id_user']; // Ambil ID user dari session

// Ambil transaksi user
$queryTransaksi = "SELECT 
                        t.id AS id_transaksi, 
                        f.judul, 
                        j.lokasi, 
                        j.tanggal, 
                        j.jam_mulai, 
                        j.jam_selesai, 
                        t.jumlah_tiket, 
                        t.total_harga 
                   FROM transaksi_tiket t
                   JOIN jadwal_tayang j ON t.id_jadwal = j.id_jadwal
                   JOIN film f ON j.id_film = f.id_film
                   WHERE t.id_user = '$id_user'
                   ORDER BY j.tanggal, j.jam_mulai";

$resultTransaksi = mysqli_query($koneksi, $queryTransaksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background-color: #1a1a2e;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #16213e;
            border-radius: 10px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background: rgb(90, 47, 54);
            color: white;
        }
    </style>
</head>
<body>

<header>
    <h1>Riwayat Transaksi Tiket</h1>
</header>

<nav class="navbar">
    <div class="menu">
        <a href="../admin/view_film.php" class="btn-menu">Film</a>
        <a href="../admin/view_jadwal.php" class="btn-menu">Jadwal Tayang</a>
        <a href="../admin/view_reviews.php" class="btn-menu">Reviews</a>
    </div>
    
</nav>
<main>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Film</th>
                <th>Lokasi</th>
                <th>Tanggal</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Jumlah Tiket</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($resultTransaksi)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['judul']); ?></td>
                    <td><?= htmlspecialchars($row['lokasi']); ?></td>
                    <td><?= htmlspecialchars($row['tanggal']); ?></td>
                    <td><?= htmlspecialchars($row['jam_mulai']); ?></td>
                    <td><?= htmlspecialchars($row['jam_selesai']); ?></td>
                    <td><?= htmlspecialchars($row['jumlah_tiket']); ?></td>
                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>
<footer class="footer">
<font color=#000> Copyright &copy; 2025 - Spectrailer <br/>
Developed By <a href="#"> Rima Tumaya, Kayla Azzahra, Aliefia Puan Ghifari</font>
</footer>
</body>
</html>
