<?php
    include "../koneksi/connection.php";

    if (isset($_GET['id_jadwal'])) {
        $id_jadwal = $_GET['id_jadwal'];

        $queryDelete = "DELETE FROM jadwal_tayang WHERE id_jadwal = '$id_jadwal'";
        if (mysqli_query($koneksi, $queryDelete)) {
            echo "<script>alert('Jadwal berhasil dihapus!'); window.location.href='view_jadwal.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus jadwal!'); window.location.href='view_jadwal.php';</script>";
        }
    } else {
        echo "<script>alert('ID jadwal tidak ditemukan!'); window.location.href='view_jadwal.php';</script>";
    }
?>