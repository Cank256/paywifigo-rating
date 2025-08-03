-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2025 at 05:01 PM
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
-- Database: `radius`
--

-- --------------------------------------------------------

--
-- Table structure for table `radcheck`
--

CREATE TABLE `radcheck` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '==',
  `value` varchar(253) NOT NULL DEFAULT '',
  `bp_id` int(11) DEFAULT NULL COMMENT 'identifies profile attached to current rad user',
  `home_nas_id` varchar(255) DEFAULT NULL COMMENT 'saves Network provider ID',
  `home_nas_location` varchar(255) DEFAULT NULL COMMENT 'Saves Network Provider Purchase Location - both for roamops',
  `payment_id_fk` int(11) DEFAULT NULL,
  `profile_value` decimal(10,2) DEFAULT NULL,
  `rate_per_time` decimal(10,2) DEFAULT NULL,
  `rate_per_data` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `radcheck`
--

INSERT INTO `radcheck` (`id`, `username`, `attribute`, `op`, `value`, `bp_id`, `home_nas_id`, `home_nas_location`, `payment_id_fk`, `profile_value`, `rate_per_time`, `rate_per_data`) VALUES
(1, 'admin', 'Cleartext-Password', ':=', 'admin', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(2, 'jim', 'Cleartext-Password', ':=', 'jim', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(3, 'jim', 'Simultaneous-Use', ':=', '1', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(4, 'sam', 'Simultaneous-Use', ':=', '2', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(5, 'sam', 'Cleartext-Password', ':=', 'sam', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(9, 'ten', 'Cleartext-Password', ':=', 'ten', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(10, 'manu', 'Simultaneous-Use', ':=', '4', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(12, 'manu', 'Cleartext-Password', ':=', 'manu1234', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(21, 'kelvin', 'Cleartext-Password', ':=', 'user2', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(22, 'mukami', 'Simultaneous-Use', ':=', '1', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(26, 'mukami1', 'Simultaneous-Use', ':=', '2', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(29, 'cystar', 'Cleartext-Password', ':=', 'cystar', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(32, 'mukami2', 'Simultaneous-Use', ':=', '10', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(36, 'mukami3', 'ChilliSpot-Bandwidth-Max-Up', ':=', '512', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(40, 'manu', 'ChilliSpot-Max-Total-Octets', ':=', '100000000', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(41, 'kelly1', 'Cleartext-Password', ':=', 'kelly1', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(46, 'kelly4', 'Cleartext-Password', ':=', '202', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(47, 'mukami3', 'Acct-Interim-Interval', ':=', '600', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(48, 'mukami3', 'ChilliSpot-Bandwidth-Max-Down', ':=', '512', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(49, 'mukami3', 'Max-Monthly-Session', ':=', '43200', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(50, 'mukami4', 'Cleartext-Password', ':=', 'mukami4', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(51, 'mukami4', 'ChilliSpot-Bandwidth-Max-Down', ':=', '1000', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(53, 'manu1', 'Cleartext-Password', ':=', 'manu1', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(54, 'manu1', 'ChilliSpot-Max-Total-Octets', ':=', '15728640', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(56, 'mukami4', 'ChilliSpot-Bandwidth-Max-Up', ':=', '1000', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(57, 'mukami4', 'Max-Monthly-Session', ':=', '600', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(58, 'wiki', 'Cleartext-Password', ':=', 'wiki', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(60, 'felix', 'Cleartext-Password', ':=', 'pass', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(61, 'felix1', 'Cleartext-Password', ':=', 'pass1', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(62, 'sess', 'Cleartext-Password', ':=', 'sess', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(63, 'mukami', 'Cleartext-Password', ':=', 'mukami', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(64, 'mukami1', 'Cleartext-Password', ':=', 'mukami1', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(65, 'mukami2', 'Cleartext-Password', ':=', 'mukami2', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(66, 'mukami3', 'Cleartext-Password', ':=', 'mukami3', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(67, 'mukami4', 'Cleartext-Password', ':=', 'mukami4', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(68, 'mukami2', 'Login-Time', ':=', 'Wk1810-1813,Sa,Su1535-1540', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(69, 'manu2', 'Cleartext-Password', ':=', 'manu2', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(70, 'manu3', 'Cleartext-Password', ':=', 'manu3', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(71, 'kelly3', 'Cleartext-Password', ':=', '200', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(73, 'default', 'Cleartext-Password', ':=', 'default', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(74, 'manu4', 'Cleartext-Password', ':=', 'manu4', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(76, 'unlimiweek', 'Cleartext-Password', ':=', 'unlimiweek', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(77, 'mukami2', 'Login-Time', ':=', 'Wk1815-1816,Sa,Su1535-1540', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(80, 'felix3', 'Cleartext-Password', ':=', 'pass3', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(81, 'felix4', 'Cleartext-Password', ':=', 'pass4', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(82, '2222', 'Cleartext-Password', ':=', '2222', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(83, 'news', 'Cleartext-Password', ':=', 'news', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(85, 'timothy', 'Cleartext-Password', ':=', 'timothy', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(95, 'kim', 'Cleartext-Password', ':=', 'kim', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(103, 'mac', 'Cleartext-Password', ':=', 'mac', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(106, 'mac', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(107, 'mac', 'ChilliSpot-Max-Total-Octets', ':=', '2000000', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(108, 'titus', 'Cleartext-Password', ':=', 'titus', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(109, 'titus', 'ChilliSpot-Max-Total-Octets', ':=', '2097152 ', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(126, 'vxhYFNq3', 'Cleartext-Password', ':=', 'ymRrCbVq', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(218, 'mac', 'CoovaChilli-Inject-URL', ':=', 'https://10.1.0.1/coova_uam_service_portal/index.php', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(219, 'v4ZuY4nQ', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(220, 'v4ZuY4nQ', 'CoovaChilli-Inject-URL', ':=', 'https://10.1.0.1/coova_uam_service_portal/index.php', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(221, 'v4ZuY4nQ', 'CoovaChilli-Inject-URL', ':=', 'https://10.1.0.1/coova_uam_service_portal/index.php', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(222, 'ROPqksGx', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(223, 'tplIjNI4', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(224, 'qOAdh0AW', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(225, 'lFrcBppM', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(226, 'VQdcVvry', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(227, 'rABJVISI', 'Cleartext-Password', ':=', '3VidKcRT', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(228, '8OxskTRm', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(230, '5Uy0I53V', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(231, 'gmJ5cLh6', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(232, 'ASdClt0o', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(233, 'RlD3MNZ4', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(234, 'rr9tRU91', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(235, 'tXgxVJVw', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(236, 'LEvYAB3P', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(237, 'X6dlTsfV', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(238, 'lyndMsIF', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(239, 'sPtdEpMV', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(240, '1pvyVYhb', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(241, 'xUFD5NYu', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(242, 'hvpDmUjO', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(243, 'nMvo9Bbh', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(244, 'sO1jYehh', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(245, 'lh5oTsJS', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(246, 'GYELul6W', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(247, 'ZkEyRfa4', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(248, '9kJj1GYj', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(249, 'lbWI4QG5', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(250, 'GOfd0u0S', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(251, 'yYhsMaY6', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(252, 'yxZ1PKfl', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(253, 'DBB8NpIu', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(254, 'lgS7QuqQ', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(255, 'T3RxMCmM', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(256, 'dqQGg2q3', 'Cleartext-Password', ':=', 'YCKkYocU', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(257, 'JitTn5sB', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(258, 'SMX23kks', 'Auth-Type', ':=', 'Reject', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(259, 'manu1', 'Max-Daily-Session', ':=', '180', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(260, '2kLQOjdX', 'Cleartext-Password', ':=', 'jUkEVK1G', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(261, 'm9XO07t5', 'Cleartext-Password', ':=', 'Tnw9UOnA', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(262, 'MZeuMDla', 'Cleartext-Password', ':=', '5nFF8GmZ', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(263, 'tYJFNirl', 'Cleartext-Password', ':=', 'YlxlHeVp', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(264, 'PKSJSB63', 'Cleartext-Password', ':=', 'oRgShBZy', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(265, 'pM5EoCaV', 'Cleartext-Password', ':=', 'rXElIaBy', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00),
(266, 'O2lZQHHd', 'Cleartext-Password', ':=', 'xuTXdL8p', NULL, 'nas01', 'My HotSpot', NULL, 0.00, 0.00, 0.00),
(267, 'tfCZG85b', 'Cleartext-Password', ':=', 'SQQ0DTBi', NULL, 'nas01', 'undefined', NULL, 0.00, 0.00, 0.00),
(268, '9POmg6hO', 'Cleartext-Password', ':=', 'SZjXGJYi', NULL, 'nas01', 'My HotSpot', NULL, 0.00, 0.00, 0.00),
(269, 'Kjv0dpVM', 'Cleartext-Password', ':=', 'UDt89VjB', NULL, 'nas012', 'My HotSpot', NULL, NULL, NULL, NULL),
(270, 'tlAXVEm6', 'Cleartext-Password', ':=', '9ZVA8dnC', NULL, 'nas012', 'My HotSpot', NULL, NULL, NULL, NULL),
(271, 'c4vdMmzP', 'Cleartext-Password', ':=', 'zNZOpJYC', NULL, 'nas012', 'My HotSpot', NULL, NULL, NULL, NULL),
(272, 'PbpcDtVe', 'Cleartext-Password', ':=', 'Bu1nZkkL', NULL, 'nas012', 'My HotSpot', NULL, NULL, NULL, NULL),
(273, 'Kt9QJEJh', 'Cleartext-Password', ':=', 'cPq0BVjn', NULL, 'nas012', 'My HotSpot', NULL, NULL, NULL, NULL),
(274, 'VzvAgwQO', 'Cleartext-Password', ':=', 'heepal8Y', NULL, 'nas012', 'My HotSpot', NULL, NULL, NULL, NULL),
(275, 'jLjWIk5V', 'Cleartext-Password', ':=', '4DGkFlvo', NULL, 'nas012', 'My HotSpot', NULL, NULL, NULL, NULL),
(276, 'MsXKWGrc', 'Cleartext-Password', ':=', 'rClWb3D4', NULL, 'nas012', 'My HotSpot', NULL, NULL, NULL, NULL),
(277, 'a5EDmVyf', 'Cleartext-Password', ':=', 't07jTq7N', NULL, 'nas012', 'My HotSpot', NULL, NULL, NULL, NULL),
(278, 'expireafter', 'Cleartext-Password', ':=', 'expireafter', NULL, 'nas012', 'My HotSpot', NULL, NULL, NULL, NULL),
(279, 'expireafter', 'Expire-After', ':=', '120', NULL, 'nas012', 'My HotSpot', NULL, NULL, NULL, NULL),
(280, 'AWaQpJtQ', 'Cleartext-Password', ':=', 'sxZU7rWP', NULL, 'localnas01', 'undefined', NULL, NULL, NULL, NULL),
(281, 'LYbmwHTR', 'Cleartext-Password', ':=', 'h2evbhAQ', NULL, 'localnas01', 'undefined', NULL, NULL, NULL, NULL),
(282, 'tOJlkbK9', 'Cleartext-Password', ':=', 'zVIgOjzp', NULL, 'localnas01', 'undefined', NULL, NULL, NULL, NULL),
(283, 'KGi1N2D0', 'Cleartext-Password', ':=', 'XDnN7bHg', NULL, 'localnas01', 'undefined', NULL, NULL, NULL, NULL),
(284, 'ypEvcmpv', 'Cleartext-Password', ':=', 'BaywkSUy', NULL, 'localnas01', 'undefined', NULL, NULL, NULL, NULL),
(285, 'TwgNSifz', 'Cleartext-Password', ':=', 'b9LqgosQ', NULL, 'localnas01', 'undefined', NULL, NULL, NULL, NULL),
(286, 'RHHGtpDF', 'Cleartext-Password', ':=', '4EXnSoHX', 3, 'localnas01', 'undefined', NULL, NULL, NULL, NULL),
(287, 'HMajjOel', 'Cleartext-Password', ':=', '3g7HQOCs', 2, 'localnas01', 'undefined', NULL, NULL, NULL, NULL),
(288, 'ZgeseIEn', 'Cleartext-Password', ':=', 'N2XEDaFN', 2, 'localnas01', 'undefined', NULL, NULL, NULL, NULL),
(289, 'bPAtHMQl', 'Cleartext-Password', ':=', 'rTXUMAos', 2, 'localnas01', 'undefined', NULL, NULL, NULL, NULL),
(290, 'Ity30Prq', 'Cleartext-Password', ':=', 'YKbFvfq3', 2, 'roamnas01', 'undefined', 4, NULL, NULL, NULL),
(291, 'sDD9jVBA', 'Cleartext-Password', ':=', '2dE6d1kF', 2, 'roamnas01', 'undefined', 5, NULL, NULL, NULL),
(292, '2lWgLVe7', 'Cleartext-Password', ':=', 'D9exYwCq', 2, 'roamnas01', 'undefined', 6, NULL, NULL, NULL),
(293, 'NuDJYGDj', 'Cleartext-Password', ':=', 'vZfqftBV', 2, 'roamnas01', 'undefined', 7, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `radcheck`
--
ALTER TABLE `radcheck`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`(32)),
  ADD KEY `home_nas_id` (`home_nas_id`),
  ADD KEY `payment_id` (`payment_id_fk`),
  ADD KEY `bp_id` (`bp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `radcheck`
--
ALTER TABLE `radcheck`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `radcheck`
--
ALTER TABLE `radcheck`
  ADD CONSTRAINT `radcheck_ibfk_1` FOREIGN KEY (`bp_id`) REFERENCES `billing_plans` (`bp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
