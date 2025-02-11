<?php
    include('../koneksi/connection.php');

    // Pastikan ada id_transaksi yang dikirim
    if (isset($_GET['id_transaksi'])) {
        $id_transaksi = $_GET['id_transaksi'];

        // Query hapus transaksi
        $queryDelete = "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'";
        if (mysqli_query($koneksi, $queryDelete)) {
            echo "<script>alert('Transaksi berhasil dihapus!'); window.location.href='view_transaksi.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus transaksi!'); window.location.href='view_transaksi.php';</script>";
        }
    } else {
        echo "<script>alert('ID transaksi tidak ditemukan!'); window.location.href='view_transaksi.php';</script>";
    }
?>
