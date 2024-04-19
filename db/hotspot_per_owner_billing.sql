-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2024 at 03:52 PM
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
-- Table structure for table `hotspot_per_owner_billing`
--

CREATE TABLE `hotspot_per_owner_billing` (
  `hotspot_per_owner_bill_id` int NOT NULL,
  `hotspot_per_owner_id_fk` int NOT NULL,
  `billing_plan_id` int NOT NULL,
  `wifigo_sales_fk_id` int NOT NULL,
  `planCost` int NOT NULL,
  `planTax` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hotspot_per_owner_billing`
--

INSERT INTO `hotspot_per_owner_billing` (`hotspot_per_owner_bill_id`, `hotspot_per_owner_id_fk`, `billing_plan_id`, `wifigo_sales_fk_id`, `planCost`, `planTax`) VALUES
(1, 1, 2, 1, 5, '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotspot_per_owner_billing`
--
ALTER TABLE `hotspot_per_owner_billing`
  ADD PRIMARY KEY (`hotspot_per_owner_bill_id`),
  ADD KEY `hotspot_per_owner_id_fk` (`hotspot_per_owner_id_fk`),
  ADD KEY `billing_plan_id` (`billing_plan_id`),
  ADD KEY `wifigo_sales_fk_id` (`wifigo_sales_fk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotspot_per_owner_billing`
--
ALTER TABLE `hotspot_per_owner_billing`
  MODIFY `hotspot_per_owner_bill_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotspot_per_owner_billing`
--
ALTER TABLE `hotspot_per_owner_billing`
  ADD CONSTRAINT `hotspot_per_owner_billing_ibfk_2` FOREIGN KEY (`billing_plan_id`) REFERENCES `billing_plans` (`bp_id`),
  ADD CONSTRAINT `hotspot_per_owner_billing_ibfk_3` FOREIGN KEY (`hotspot_per_owner_id_fk`) REFERENCES `Hotspots_To_Owners` (`hotspot_owner_pk`),
  ADD CONSTRAINT `hotspot_per_owner_billing_ibfk_4` FOREIGN KEY (`wifigo_sales_fk_id`) REFERENCES `WiFiGo_Sales` (`wifigo_sales_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
