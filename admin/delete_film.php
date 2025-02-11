<?php
include ('../koneksi/connection.php');

$id_film = mysqli_real_escape_string($koneksi, $_GET['id_film']);
$queryDelete     ="DELETE FROM film WHERE id_film='$id_film'";
$resultFilm =mysqli_query($koneksi,$queryDelete);

if($resultFilm){
    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>alert('Film berhasil dihapus!'); window.location='view_film.php';</script>";
    } else {
        echo "<script>alert('Film tidak ditemukan atau sudah dihapus!'); window.location='view_film.php';</script>";
    }
}else {
    echo "Error: " . mysqli_error($koneksi);
    }
?>