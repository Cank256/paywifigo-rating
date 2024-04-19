-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 11, 2024 at 04:22 PM
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
-- Table structure for table `billing_plans`
--

CREATE TABLE `billing_plans` (
  `bp_id` int NOT NULL,
  `planName` varchar(128) DEFAULT NULL,
  `planId` varchar(128) DEFAULT NULL,
  `planType` varchar(128) DEFAULT NULL,
  `planTimeBank` varchar(128) DEFAULT NULL,
  `planTimeType` varchar(128) DEFAULT NULL,
  `planTimeRefillCost` varchar(128) DEFAULT NULL,
  `planBandwidthUp` varchar(128) DEFAULT NULL,
  `planBandwidthDown` varchar(128) DEFAULT NULL,
  `planTrafficTotal` varchar(128) DEFAULT NULL,
  `planTrafficUp` varchar(128) DEFAULT NULL,
  `planTrafficDown` varchar(128) DEFAULT NULL,
  `planTrafficRefillCost` varchar(128) DEFAULT NULL,
  `planRecurring` varchar(128) DEFAULT NULL,
  `planRecurringPeriod` varchar(128) DEFAULT NULL,
  `planRecurringBillingSchedule` varchar(128) NOT NULL DEFAULT 'Fixed',
  `planCost` varchar(128) DEFAULT NULL,
  `planSetupCost` varchar(128) DEFAULT NULL,
  `planTax` varchar(128) DEFAULT NULL,
  `planCurrency` varchar(128) DEFAULT NULL,
  `planGroup` varchar(128) DEFAULT NULL,
  `planActive` varchar(32) NOT NULL DEFAULT 'yes',
  `creationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creationby` varchar(128) DEFAULT NULL,
  `updatedate` datetime DEFAULT '1996-05-21 23:00:00',
  `updateby` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_plans`
--

INSERT INTO `billing_plans` (`bp_id`, `planName`, `planId`, `planType`, `planTimeBank`, `planTimeType`, `planTimeRefillCost`, `planBandwidthUp`, `planBandwidthDown`, `planTrafficTotal`, `planTrafficUp`, `planTrafficDown`, `planTrafficRefillCost`, `planRecurring`, `planRecurringPeriod`, `planRecurringBillingSchedule`, `planCost`, `planSetupCost`, `planTax`, `planCurrency`, `planGroup`, `planActive`, `creationdate`, `creationby`, `updatedate`, `updateby`) VALUES
(2, 'Buy 10 MBs', 'buy 10 mbs', 'Prepaid', '', 'Accumulative', '10', '2000000', '2000000', '10000000', '2000000', '2000000', '', 'No', 'Daily', 'Fixed', '1', '0', '.6', 'KSH', '', 'yes', '2022-12-24 23:01:47', 'administrator', '2023-12-16 16:01:10', 'administrator'),
(3, 'Power Hour 3GB', 'power Hour', 'Prepaid', '', 'Time-To-Finish', '', '2000000', '2000000', '', '', '', '', 'Yes', 'Daily', 'Fixed', '15', '0', '4', 'KSH', '', 'yes', '2022-12-25 08:10:22', 'administrator', '2023-12-16 15:56:51', 'administrator'),
(4, 'sesstimeout2mins', 'Session Timeout', 'Prepaid', '', 'Accumulative', '', '', '', '', '', '', '', 'No', 'Never', 'Fixed', '50', '0', '.4', 'KSH', '', 'no', '2023-01-12 11:39:43', 'administrator', '2023-12-16 16:02:46', 'administrator'),
(5, 'Unliminet in 30 minutes', 'AccessPeriod5mins', 'PayPal', '', 'Accumulative', '', '', '', '', '', '', '', 'No', 'Never', 'Fixed', '10', '0', '.4', 'KSH', '', 'yes', '2023-01-12 13:59:29', 'administrator', '2023-12-16 15:59:33', 'administrator'),
(6, 'Unliminet 30 minutes', 'maxallsess2mins', 'PayPal', '', 'Accumulative', '', '', '', '', '', '', '', 'No', 'Semi-Yearly', 'Fixed', '20', '.2', '.1', 'KSH', '', 'yes', '2023-01-12 16:44:50', 'administrator', '2023-12-16 16:00:35', 'administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_plans`
--
ALTER TABLE `billing_plans`
  ADD PRIMARY KEY (`bp_id`),
  ADD KEY `planName` (`planName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_plans`
--
ALTER TABLE `billing_plans`
  MODIFY `bp_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
