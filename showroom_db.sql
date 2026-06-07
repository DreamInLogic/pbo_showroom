-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2026 at 01:52 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `showroom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_kendaraan` int NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `tahun` int NOT NULL,
  `harga_dasar` decimal(15,2) NOT NULL,
  `jenis_kendaraan` enum('konvensional','listrik','motor_besar') NOT NULL,
  `status_pajak` enum('aktif','mati') NOT NULL DEFAULT 'aktif',
  `lama_menunggak_tahun` int NOT NULL DEFAULT '0',
  `kapasitas_mesin` int DEFAULT NULL,
  `jenis_bahan_bakar` varchar(20) DEFAULT NULL,
  `kapasitas_baterai` int DEFAULT NULL,
  `jarak_tempuh` int DEFAULT NULL,
  `tipe_rantai` varchar(30) DEFAULT NULL,
  `mode_berkendara` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `brand`, `model`, `tahun`, `harga_dasar`, `jenis_kendaraan`, `status_pajak`, `lama_menunggak_tahun`, `kapasitas_mesin`, `jenis_bahan_bakar`, `kapasitas_baterai`, `jarak_tempuh`, `tipe_rantai`, `mode_berkendara`) VALUES
(1, 'Toyota', 'Kijang Innova Zenix', 2023, 450000000.00, 'konvensional', 'aktif', 0, 2000, 'Bensin', NULL, NULL, NULL, NULL),
(2, 'Honda', 'Civic Turbo', 2019, 380000000.00, 'konvensional', 'mati', 3, 1500, 'Bensin', NULL, NULL, NULL, NULL),
(3, 'Hyundai', 'Ioniq 5', 2024, 750000000.00, 'listrik', 'aktif', 0, NULL, NULL, 72, 480, NULL, NULL),
(4, 'Wuling', 'Air EV', 2022, 200000000.00, 'listrik', 'mati', 2, NULL, NULL, 26, 300, NULL, NULL),
(5, 'Kawasaki', 'Ninja ZX-10R', 2022, 550000000.00, 'motor_besar', 'aktif', 0, NULL, NULL, NULL, NULL, 'O-Ring Seal', 'Sport/Track'),
(6, 'Harley', 'Fat Boy', 2018, 650000000.00, 'motor_besar', 'mati', 5, NULL, NULL, NULL, NULL, 'Belt Drive', 'Cruise');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id_kendaraan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
