-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2025 at 01:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `katalog_film`
--

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id_film` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tahun_rilis` year(4) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `rating` float NOT NULL,
  `deksripsi` text NOT NULL,
  `poster` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id_film`, `judul`, `tahun_rilis`, `genre`, `rating`, `deksripsi`, `poster`) VALUES
(28, 'Foxtrot Six', '2019', 'Action', 8, '', 'assets/images/Foxtrot Six.jpg'),
(29, 'Hit & Run', '2019', 'Action', 8.7, '', 'assets/images/Hit & Run.jpg'),
(32, 'Mariposa', '2020', 'Romance', 9.7, '', 'assets/images/Mariposa.jpg'),
(33, 'Qodrat', '2022', 'Horor', 7.5, '', 'assets/images/Qodrat.jpg'),
(34, 'Rudy Habibie', '2016', 'Romance', 10, '', 'assets/images/Rudy Habibie.jpg'),
(35, 'Turning Red', '2022', 'Animasi', 8.5, '', 'assets/images/Turning Red.jpg'),
(36, 'Uglies', '2024', 'Action, Adventure, Drama', 9, '', 'assets/images/uglies.jpg'),
(37, 'Sumala', '2024', 'Horor, Thriller', 9, '', 'assets/images/Sumala.jpg'),
(38, 'Subservience', '2024', 'Thriller', 9.1, '', 'assets/images/subservience.jpg'),
(39, 'Mufasa The Lion King', '2024', 'Animasi, Adventure', 9.5, '', 'assets/images/mufasa the lion king.jpg'),
(40, 'Insidious Chapter 3', '2015', 'Horor, Thriller, Mystery', 9.4, '', 'assets/images/insidious chapter 3.jpg'),
(41, 'Bogota City Of The Lost', '2024', 'Crime, Drama, Thriller', 8.7, '', 'assets/images/bogota.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_tayang`
--

CREATE TABLE `jadwal_tayang` (
  `id_jadwal` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `harga_tiket` int(11) NOT NULL DEFAULT 50000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_tayang`
--

INSERT INTO `jadwal_tayang` (`id_jadwal`, `id_film`, `lokasi`, `tanggal`, `jam_mulai`, `jam_selesai`, `harga_tiket`) VALUES
(1, 28, 'PVJ Mall', '2025-02-11', '11:30:00', '12:30:00', 50000),
(2, 32, 'BEC Mall', '2025-02-13', '20:55:00', '21:50:00', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id_review` int(11) NOT NULL,
  `id_film` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `komentar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id_review`, `id_film`, `username`, `komentar`) VALUES
(1, 28, 'aliefia', 'Mantap'),
(2, 28, 'admin', 'Oke'),
(3, 33, 'aliefia', 'Serem bangett film nya'),
(4, 38, 'aliefia', 'OMG');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_tiket`
--

CREATE TABLE `transaksi_tiket` (
  `id_transaksi` int(11) NOT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `jumlah_tiket` int(11) DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `waktu_pemesanan` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_tiket`
--

INSERT INTO `transaksi_tiket` (`id_transaksi`, `id_jadwal`, `id`, `jumlah_tiket`, `total_harga`, `waktu_pemesanan`) VALUES
(1, 1, NULL, 1, 50000.00, '2025-02-11 16:50:12'),
(2, 2, NULL, 2, 100000.00, '2025-02-11 16:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pengunjung') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(6, 'kayla', '$2y$10$E3Q0H8QUpI3wNyUbXJf5xeG0/UtPAQAOi4N7w6z6/2HJzfbqXwGxO', 'admin'),
(7, 'rima', '$2y$10$hXKqG8mQfLlEVoOHsMtu3OJ7I1F6GkZPQsX9DkPY.tPpTxEDYOw7O', ''),
(8, 'budi', '$2y$10$abcdefghijABCDEFGHIJabcdefghijABCDEFGHIJabcdefghijABCDEFGHIJ', ''),
(9, 'siti', '$2y$10$klmnopqrstKLMNOPQRSTklmnopqrstKLMNOPQRSTklmnopqrstKLMNOPQRST', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id_film`);

--
-- Indexes for table `jadwal_tayang`
--
ALTER TABLE `jadwal_tayang`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_film` (`id_film`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `id_film` (`id_film`);

--
-- Indexes for table `transaksi_tiket`
--
ALTER TABLE `transaksi_tiket`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `jadwal_tayang`
--
ALTER TABLE `jadwal_tayang`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi_tiket`
--
ALTER TABLE `transaksi_tiket`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal_tayang`
--
ALTER TABLE `jadwal_tayang`
  ADD CONSTRAINT `jadwal_tayang_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`) ON DELETE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi_tiket`
--
ALTER TABLE `transaksi_tiket`
  ADD CONSTRAINT `transaksi_tiket_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_tayang` (`id_jadwal`),
  ADD CONSTRAINT `transaksi_tiket_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
