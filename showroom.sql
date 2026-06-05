-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2026 at 03:49 AM
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
-- Database: `showroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int NOT NULL,
  `brand` varchar(50) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `type` varchar(50) NOT NULL,
  `warna` varchar(30) NOT NULL,
  `tahun_manufaktur` year NOT NULL,
  `harga` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `brand`, `jenis`, `type`, `warna`, `tahun_manufaktur`, `harga`) VALUES
(1, 'Toyota', 'MPV', 'Avanza G', 'Hitam', '2023', 265000000.00),
(2, 'Toyota', 'SUV', 'Rush S', 'Putih', '2024', 315000000.00),
(3, 'Toyota', 'Sedan', 'Camry Hybrid', 'Silver', '2024', 850000000.00),
(4, 'Honda', 'SUV', 'HR-V RS', 'Merah', '2024', 395500000.00),
(5, 'Honda', 'MPV', 'Mobilio E', 'Hitam', '2022', 255000000.00),
(6, 'Honda', 'Sedan', 'Civic Turbo', 'Putih', '2024', 620000000.00),
(7, 'Mitsubishi', 'MPV', 'Xpander Ultimate', 'Abu-abu', '2023', 320000000.00),
(8, 'Mitsubishi', 'SUV', 'Pajero Sport Dakar', 'Hitam', '2024', 620000000.00),
(9, 'Suzuki', 'MPV', 'Ertiga GX', 'Silver', '2023', 280000000.00),
(10, 'Suzuki', 'SUV', 'XL7 Beta', 'Putih', '2024', 315000000.00),
(11, 'Daihatsu', 'MPV', 'Xenia R', 'Merah', '2023', 250000000.00),
(12, 'Daihatsu', 'SUV', 'Terios X', 'Hitam', '2024', 295000000.00),
(13, 'Nissan', 'SUV', 'Magnite Premium', 'Kuning', '2024', 310000000.00),
(14, 'Nissan', 'Sedan', 'Almera VL', 'Putih', '2023', 340000000.00),
(15, 'Hyundai', 'SUV', 'Creta Prime', 'Biru', '2024', 420000000.00),
(16, 'Hyundai', 'MPV', 'Stargazer X', 'Hitam', '2024', 335000000.00),
(17, 'Kia', 'SUV', 'Seltos EX', 'Merah', '2024', 430000000.00),
(18, 'Wuling', 'SUV', 'Alvez EX', 'Putih', '2024', 305000000.00),
(19, 'Mazda', 'SUV', 'CX-5 Elite', 'Abu-abu', '2024', 650000000.00),
(20, 'BMW', 'Sedan', '320i Sport', 'Hitam', '2024', 950000000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
