-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2025 at 03:22 PM
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
-- Database: `concert_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `concerts`
--

CREATE TABLE `concerts` (
  `id` int(11) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `venue_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `concerts`
--

INSERT INTO `concerts` (`id`, `artist`, `venue_id`, `date`, `price`, `stock`) VALUES
(11, 'Taylor Swift - The Eras Tour', 11, '2025-02-21', 2500000.00, 50000),
(12, 'Coldplay - Music of the Spheres', 1, '2025-01-18', 2200000.00, 65000),
(14, 'BLACKPINK - BORN PINK Encore', 5, '2025-06-01', 3200000.00, 15000),
(15, 'aespa - SYNK : PARALLEL LINE', 1, '2025-07-13', 2700000.00, 50000),
(16, 'Tulus - Tur Manusia', 8, '2025-04-12', 750000.00, 8000),
(19, 'We The Fest 2025', 14, '2025-07-20', 1500000.00, 45000),
(20, 'Java Jazz Festival 2025', 12, '2025-03-01', 1300000.00, 50000),
(22, 'The 1975 - Still.. At Their Very Best tour', 3, '2026-06-17', 3450000.00, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `concert_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `concert_id`, `quantity`, `total_price`, `order_date`) VALUES
(5, 'Jessica', 15, 3, 8100000.00, '2025-11-11 13:25:38'),
(6, 'Jennifer', 12, 1, 2200000.00, '2025-11-11 13:26:03'),
(7, 'Veronica', 14, 4, 12800000.00, '2025-11-11 13:26:15'),
(8, 'Kitty', 11, 5, 12500000.00, '2025-11-11 13:27:11'),
(9, 'Ahmad Yani', 19, 1, 1500000.00, '2025-11-11 13:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `name`, `address`, `city`, `capacity`) VALUES
(1, 'Gelora Bung Karno Stadium', 'Jl. Pintu Satu Senayan', 'Jakarta', 80000),
(2, 'Jakarta International Stadium', 'Papanggo, Tj. Priok', 'Jakarta', 82000),
(3, 'Stadion Utama Gelora Bung Tomo', 'Benowo', 'Surabaya', 45000),
(4, 'Seoul Olympic Stadium', 'Jamsil', 'Seoul', 69000),
(5, 'Gocheok Sky Dome', 'Guro-gu', 'Seoul', 17000),
(6, 'ICE BSD Hall 5', 'Tangerang', 'Banten', 20000),
(7, 'KINTEX Exhibition Center', 'Goyang', 'Seoul', 15000),
(8, 'Istora Senayan', 'Jl. Pintu I Senayan', 'Jakarta', 10000),
(9, 'The Kasablanka Hall', 'Jl. Casablanca Raya', 'Jakarta', 5000),
(11, 'GBK Sports Complex', 'Senayan', 'Jakarta', 60000),
(12, 'JIExpo Kemayoran', 'Kemayoran', 'Jakarta', 50000),
(13, 'Gambir Expo', 'Kemayoran', 'Jakarta', 30000),
(14, 'Parkir Timur Senayan', 'Senayan', 'Jakarta', 45000),
(15, 'Gymnasium Universitas Pendidikan Indonesia', 'Kampus UPI Bumi Siliwangi', 'Bandung', 12000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `concerts`
--
ALTER TABLE `concerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venue_id` (`venue_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `concert_id` (`concert_id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `concerts`
--
ALTER TABLE `concerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `concerts`
--
ALTER TABLE `concerts`
  ADD CONSTRAINT `concerts_ibfk_1` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`concert_id`) REFERENCES `concerts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
