-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2024 at 04:27 PM
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
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cust_id` varchar(36) NOT NULL,
  `user_total__session_bandwidth_GiB` decimal(10,6) DEFAULT NULL,
  `user_total__session_time_hrs` decimal(10,4) NOT NULL,
  `hotspot_to_owner_id` int DEFAULT NULL,
  `prod_id` int NOT NULL,
  `rating` tinyint NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `posted`, `cust_id`, `user_total__session_bandwidth_GiB`, `user_total__session_time_hrs`, `hotspot_to_owner_id`, `prod_id`, `rating`, `message`) VALUES
(1, '2024-04-11 13:11:40', '55a645b7-3395-4d6b-8594-b628f1cd4ce0', NULL, '0.0000', NULL, 2, 4, 'Hello to the world');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `hotspot_owner_id` (`hotspot_to_owner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `billing_plans` (`bp_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`cust_id`) REFERENCES `USER_ENTITY` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `ratings_ibfk_3` FOREIGN KEY (`hotspot_to_owner_id`) REFERENCES `Hotspots_To_Owners` (`hotspot_owner_pk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
