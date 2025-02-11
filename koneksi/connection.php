<?php
    $host       ="localhost";
    $username   ="root";
    $password   ="";
    $nama_db    ="katalog_film";

    //mulai koneksi
    $koneksi=mysqli_connect($host, $username, $password, $nama_db) or die ("koneksi mysql gagal!");
?>