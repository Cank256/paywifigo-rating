-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2024 at 04:26 PM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `radius`
--

-- --------------------------------------------------------

--
-- Table structure for table `Hotspot_Owners_Administrators`
--

CREATE TABLE `Hotspot_Owners_Administrators` (
  `hotspot_owner_id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Hotspot_Owners_Administrators`
--

INSERT INTO `Hotspot_Owners_Administrators` (`hotspot_owner_id`, `username`, `password`) VALUES
(1, '+254720595663', '$2y$10$pLPzCGhZh7mpwtuHM/rvPOAiiRy/taFEcxBwrbx/JCBgnGDbMPL3m'),
(2, '+254720595664', '$2y$10$ADB19kfRdPdLn42oT2yCYeDZPQyhC0g2T./Po40rJLgHtjLe9gcum'),
(3, '+254720595667', '$2y$10$EwxpvnHNMZ53toyAzbGNfue1i5ieoN3x6D1KNPxdb4awCKKiLj3BS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Hotspot_Owners_Administrators`
--
ALTER TABLE `Hotspot_Owners_Administrators`
  ADD PRIMARY KEY (`hotspot_owner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Hotspot_Owners_Administrators`
--
ALTER TABLE `Hotspot_Owners_Administrators`
  MODIFY `hotspot_owner_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
