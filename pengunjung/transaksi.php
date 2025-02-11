<?php 
session_start();
include "../koneksi/connection.php";

// Pastikan pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location.href='../auth/login.php';</script>";
    exit();
}

$id_user = $_SESSION['id_user']; // Ambil ID user dari session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_jadwal = $_POST['id_jadwal'];
    $jumlah_tiket = $_POST['jumlah_tiket'];

    // Ambil harga tiket berdasarkan ID jadwal
    $queryHarga = "SELECT harga_tiket FROM jadwal_tayang WHERE id_jadwal = '$id_jadwal'";
    $resultHarga = mysqli_query($koneksi, $queryHarga);
    $rowHarga = mysqli_fetch_assoc($resultHarga);
    $total_harga = $rowHarga['harga_tiket'] * $jumlah_tiket;

    // Simpan transaksi dengan ID user
    $queryInsert = "INSERT INTO transaksi_tiket (id_user, id_jadwal, jumlah_tiket, total_harga) 
                    VALUES ('$id_user', '$id_jadwal', '$jumlah_tiket', '$total_harga')";
    
    if (mysqli_query($koneksi, $queryInsert)) {
        echo "<script>alert('Transaksi berhasil!'); window.location.href='view_transaksi.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Ambil jadwal film yang tersedia
$queryJadwal = "SELECT j.id_jadwal, f.judul, j.lokasi, j.tanggal, j.jam_mulai, j.harga_tiket 
                FROM jadwal_tayang j 
                JOIN film f ON j.id_film = f.id_film 
                ORDER BY j.tanggal, j.jam_mulai";
$resultJadwal = mysqli_query($koneksi, $queryJadwal);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Transaksi</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background-color: #1a1a2e;
            color: white;
            font-family: Arial, sans-serif;
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
        input, select {
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
        nav {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<header>
    <h1>Transaksi</h1>
</header>

<nav class="navbar">
    <div class="menu-center">
    <a href="../dashboard.php" class="btn-menu">Home</a>
    <a href="../pengunjung/view_film.php" class="btn-menu">Film</a>
    <a href="../pengunjung/view_jadwal.php" class="btn-menu">Jadwal Tayang</a>
    <a href="../pengunjung/view_transaksi.php" class="btn-menu">Riwayat Transaksi</a>
    </div>
</nav>

<main>
    <form method="POST">
        <label>Pilih Jadwal Film:</label>
        <select name="id_jadwal" required>
            <?php while ($row = mysqli_fetch_assoc($resultJadwal)): ?>
                <option value="<?= $row['id_jadwal'] ?>">
                    <?= $row['judul'] ?> - <?= $row['lokasi'] ?> - <?= $row['tanggal'] ?> - <?= $row['jam_mulai'] ?> (Rp<?= $row['harga_tiket'] ?>)
                </option>
            <?php endwhile; ?>
        </select>

        <label>Jumlah Tiket:</label>
        <input type="number" name="jumlah_tiket" min="1" required>

        <button type="submit">Pesan</button>
    </form>
</main>
</body>
<footer class="footer">
<font color=#> Copyright &copy; 2025 - Spectrailer <br/>
Developed By <a href="#"> Rima Tumaya, Kayla Azzahra, Aliefia Puan Ghifari</font>
</footer>
</html>
