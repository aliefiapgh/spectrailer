<?php
    include('../koneksi/connection.php');

    if (!isset($_GET['id_transaksi'])) {
        echo "<script>alert('ID transaksi tidak ditemukan!'); window.location.href='view_transaksi.php';</script>";
        exit();
    }

    $id_transaksi = $_GET['id_transaksi'];

    $queryGet = "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'";
    $result = mysqli_query($koneksi, $queryGet);
    $transaksi = mysqli_fetch_assoc($result);

    if (!$transaksi) {
        echo "<script>alert('Transaksi tidak ditemukan!'); window.location.href='view_transaksi.php';</script>";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $jumlah_tiket = $_POST['jumlah_tiket'];
        $harga = $_POST['harga'];

        $queryUpdate = "UPDATE transaksi SET jumlah_tiket = '$jumlah_tiket', harga = '$harga' WHERE id_transaksi = '$id_transaksi'";
        
        if (mysqli_query($koneksi, $queryUpdate)) {
            echo "<script>alert('Transaksi berhasil diperbarui!'); window.location.href='view_transaksi.php';</script>";
        } else {
            echo "<script>alert('Gagal mengupdate transaksi!');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Transaksi</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h1>Edit Transaksi</h1>
</header>

<main>
    <form method="POST">
        <label>Jumlah Tiket:</label>
        <input type="number" name="jumlah_tiket" value="<?= $transaksi['jumlah_tiket']; ?>" required>

        <label>Harga:</label>
        <input type="number" name="harga" value="<?= $transaksi['harga']; ?>" required>

        <button type="submit">Simpan Perubahan</button>
        <a href="view_transaksi.php">Batal</a>
    </form>
</main>

</body>
</html>
