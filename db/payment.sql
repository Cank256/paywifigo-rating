-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2025 at 02:58 PM
-- Server version: 10.11.13-MariaDB-0ubuntu0.24.04.1
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `radius_D6hAtY`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL COMMENT 'invoice id of the invoices table',
  `amount` decimal(10,2) NOT NULL COMMENT 'the amount paid',
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `type_id` int(11) NOT NULL DEFAULT 1 COMMENT 'the type of the payment from payment_type',
  `notes` varchar(128) NOT NULL COMMENT 'general notes/description',
  `creationdate` datetime DEFAULT current_timestamp(),
  `creationby` varchar(128) DEFAULT NULL,
  `updatedate` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updateby` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `invoice_id`, `amount`, `date`, `type_id`, `notes`, `creationdate`, `creationby`, `updatedate`, `updateby`) VALUES
(39, 47, 499.00, '2025-07-25 15:57:43', 4, 'System initialized entry', '2025-07-25 15:57:43', 'system', '2025-07-25 16:00:07', 'administrator'),
(40, 48, 499.00, '2025-08-03 11:12:26', 4, 'System initialized entry', '2025-08-03 11:12:26', 'system', '2025-08-03 11:14:11', 'administrator');

--
-- Triggers `payment`
--
DELIMITER $$
CREATE TRIGGER `activate_radius_account_membership_on_cleared_bill` AFTER UPDATE ON `payment` FOR EACH ROW BEGIN
    DECLARE totalpayed DECIMAL(10, 2)$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
