-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2020 at 03:25 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banking`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `creation_date` datetime NOT NULL,
  `balance` decimal(10,0) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `type`, `creation_date`, `balance`) VALUES
(1, 9, 1, '2020-03-11 17:59:26', '1158202'),
(3, 10, 1, '2020-03-12 11:25:46', '1157497'),
(11, 9, 3, '2020-03-13 10:51:50', '0'),
(12, 9, 3, '2020-03-13 10:51:51', '15000');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `type` varchar(8) NOT NULL,
  `recipient_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `timestamp`, `amount`, `type`, `recipient_id`, `account_id`) VALUES
(1, 5, '2020-03-11 00:30:07', '114', 'withdraw', NULL, NULL),
(2, 5, '2020-03-11 00:30:14', '103', 'withdraw', NULL, NULL),
(3, 5, '2020-03-11 00:30:19', '0', 'withdraw', NULL, NULL),
(4, 5, '2020-03-11 00:30:28', '111', 'deposit', NULL, NULL),
(5, 5, '2020-03-11 00:30:29', '110', 'withdraw', NULL, NULL),
(6, 5, '2020-03-11 00:30:33', '11221', 'deposit', NULL, NULL),
(7, 5, '2020-03-11 00:30:36', '22332', 'deposit', NULL, NULL),
(8, 5, '2020-03-11 00:30:39', '23443', 'deposit', NULL, NULL),
(9, 5, '2020-03-11 00:30:42', '23432', 'withdraw', NULL, NULL),
(10, 5, '2020-03-11 14:19:29', '23553', 'deposit', NULL, NULL),
(11, 5, '2020-03-11 14:19:30', '23674', 'deposit', NULL, NULL),
(12, 5, '2020-03-11 14:19:31', '23795', 'deposit', NULL, NULL),
(13, 5, '2020-03-11 14:19:31', '23916', 'deposit', NULL, NULL),
(14, 5, '2020-03-11 14:19:37', '46916', 'deposit', NULL, NULL),
(15, 5, '2020-03-11 14:19:49', '56916', 'deposit', NULL, NULL),
(16, 5, '2020-03-11 14:19:50', '66916', 'deposit', NULL, NULL),
(17, 5, '2020-03-11 14:19:50', '76916', 'deposit', NULL, NULL),
(18, 5, '2020-03-11 14:19:50', '86916', 'deposit', NULL, NULL),
(19, 5, '2020-03-11 14:19:50', '96916', 'deposit', NULL, NULL),
(20, 5, '2020-03-11 14:19:50', '106916', 'deposit', NULL, NULL),
(21, 5, '2020-03-11 14:19:51', '116916', 'deposit', NULL, NULL),
(22, 5, '2020-03-11 14:19:51', '126916', 'deposit', NULL, NULL),
(23, 5, '2020-03-11 14:19:51', '136916', 'deposit', NULL, NULL),
(24, 5, '2020-03-11 14:19:51', '146916', 'deposit', NULL, NULL),
(25, 5, '2020-03-11 14:19:51', '156916', 'deposit', NULL, NULL),
(26, 5, '2020-03-11 14:19:51', '166916', 'deposit', NULL, NULL),
(27, 5, '2020-03-11 14:19:52', '176916', 'deposit', NULL, NULL),
(28, 5, '2020-03-11 14:19:52', '186916', 'deposit', NULL, NULL),
(29, 5, '2020-03-11 14:19:52', '196916', 'deposit', NULL, NULL),
(30, 5, '2020-03-11 14:19:52', '206916', 'deposit', NULL, NULL),
(31, 6, '2020-03-11 15:10:22', '10000', 'deposit', NULL, NULL),
(32, 6, '2020-03-11 15:10:27', '9500', 'withdraw', NULL, NULL),
(33, 6, '2020-03-11 15:13:53', '9505', 'transfer', 5, NULL),
(34, 6, '2020-03-11 15:14:21', '111', 'deposit', NULL, NULL),
(35, 6, '2020-03-11 15:14:23', '116', 'transfer', 5, NULL),
(36, 6, '2020-03-11 15:15:44', '111', 'deposit', NULL, NULL),
(37, 6, '2020-03-11 15:15:45', '116', 'transfer', 5, NULL),
(38, 6, '2020-03-11 15:16:04', '111', 'deposit', NULL, NULL),
(39, 6, '2020-03-11 15:16:05', '116', 'transfer', 5, NULL),
(40, 6, '2020-03-11 15:16:19', '111', 'deposit', NULL, NULL),
(41, 6, '2020-03-11 15:16:20', '116', 'transfer', 5, NULL),
(42, 6, '2020-03-11 15:17:01', '111', 'deposit', NULL, NULL),
(43, 6, '2020-03-11 15:17:02', '227', 'transfer', 5, NULL),
(44, 6, '2020-03-11 15:17:08', '111', 'deposit', NULL, NULL),
(45, 6, '2020-03-11 15:17:09', '338', 'transfer', 5, NULL),
(46, 6, '2020-03-11 15:17:19', '111', 'deposit', NULL, NULL),
(47, 6, '2020-03-11 15:17:20', '449', 'transfer', 5, NULL),
(48, 6, '2020-03-11 15:19:22', '111', 'deposit', NULL, NULL),
(49, 6, '2020-03-11 15:19:23', '111', 'transfer', 5, NULL),
(50, 5, '2020-03-11 16:41:09', '571', 'deposit', NULL, NULL),
(51, 5, '2020-03-11 16:41:47', '560', 'withdraw', NULL, NULL),
(52, 7, '2020-03-11 17:30:06', '11', 'deposit', NULL, NULL),
(53, 7, '2020-03-11 17:49:05', '0', 'withdraw', NULL, NULL),
(54, 7, '2020-03-11 17:49:09', '1111', 'deposit', NULL, NULL),
(55, 7, '2020-03-11 17:49:12', '1100', 'withdraw', NULL, NULL),
(56, 9, '2020-03-11 18:09:27', '111', 'deposit', NULL, NULL),
(57, 9, '2020-03-11 22:58:20', '222', 'deposit', NULL, NULL),
(58, 9, '2020-03-11 22:58:26', '333', 'deposit', NULL, NULL),
(59, 9, '2020-03-11 22:59:29', '444', 'deposit', NULL, NULL),
(60, 9, '2020-03-11 22:59:34', '555', 'deposit', NULL, NULL),
(61, 9, '2020-03-11 22:59:34', '666', 'deposit', NULL, NULL),
(62, 9, '2020-03-11 22:59:35', '777', 'deposit', NULL, NULL),
(63, 9, '2020-03-11 22:59:35', '888', 'deposit', NULL, NULL),
(64, 9, '2020-03-11 22:59:36', '999', 'deposit', NULL, NULL),
(65, 9, '2020-03-11 22:59:36', '1110', 'deposit', NULL, NULL),
(66, 9, '2020-03-11 23:00:07', '1121', 'deposit', NULL, NULL),
(67, 9, '2020-03-11 23:00:08', '1132', 'deposit', NULL, NULL),
(68, 9, '2020-03-11 23:00:20', '1133', 'deposit', NULL, NULL),
(69, 9, '2020-03-11 23:00:52', '1144', 'deposit', NULL, NULL),
(70, 9, '2020-03-11 23:00:53', '1255', 'deposit', NULL, NULL),
(71, 9, '2020-03-11 23:00:59', '1256', 'deposit', NULL, NULL),
(72, 9, '2020-03-11 23:01:00', '1267', 'deposit', NULL, NULL),
(73, 9, '2020-03-11 23:01:36', '1289', 'deposit', NULL, NULL),
(74, 9, '2020-03-11 23:02:05', '1400', 'deposit', NULL, NULL),
(75, 9, '2020-03-11 23:02:13', '2500', 'deposit', NULL, NULL),
(76, 9, '2020-03-11 23:02:14', '3600', 'deposit', NULL, NULL),
(77, 9, '2020-03-11 23:02:15', '4700', 'deposit', NULL, NULL),
(78, 9, '2020-03-11 23:02:15', '5800', 'deposit', NULL, NULL),
(79, 9, '2020-03-11 23:02:15', '6900', 'deposit', NULL, NULL),
(80, 9, '2020-03-11 23:02:15', '8000', 'deposit', NULL, NULL),
(81, 9, '2020-03-11 23:02:15', '9100', 'deposit', NULL, NULL),
(82, 9, '2020-03-11 23:02:15', '10200', 'deposit', NULL, NULL),
(83, 9, '2020-03-11 23:02:15', '11300', 'deposit', NULL, NULL),
(84, 9, '2020-03-11 23:02:16', '12400', 'deposit', NULL, NULL),
(85, 9, '2020-03-11 23:02:20', '12289', 'withdraw', NULL, NULL),
(86, 9, '2020-03-11 23:02:21', '11178', 'withdraw', NULL, NULL),
(87, 9, '2020-03-11 23:02:22', '10067', 'withdraw', NULL, NULL),
(88, 9, '2020-03-11 23:02:22', '8956', 'withdraw', NULL, NULL),
(89, 9, '2020-03-11 23:02:22', '7845', 'withdraw', NULL, NULL),
(90, 9, '2020-03-11 23:02:23', '6734', 'withdraw', NULL, NULL),
(91, 9, '2020-03-11 23:02:23', '5623', 'withdraw', NULL, NULL),
(92, 9, '2020-03-11 23:02:24', '4512', 'withdraw', NULL, NULL),
(93, 9, '2020-03-11 23:02:24', '3401', 'withdraw', NULL, NULL),
(94, 9, '2020-03-11 23:02:24', '2290', 'withdraw', NULL, NULL),
(95, 9, '2020-03-11 23:02:24', '1179', 'withdraw', NULL, NULL),
(96, 9, '2020-03-11 23:02:25', '68', 'withdraw', NULL, NULL),
(97, 9, '2020-03-11 23:02:49', '1', 'withdraw', NULL, NULL),
(98, 9, '2020-03-11 23:02:56', '0', 'withdraw', NULL, NULL),
(99, 9, '2020-03-11 23:03:02', '50000', 'deposit', NULL, NULL),
(100, 9, '2020-03-11 23:03:02', '100000', 'deposit', NULL, NULL),
(101, 9, '2020-03-11 23:03:03', '150000', 'deposit', NULL, NULL),
(102, 9, '2020-03-11 23:03:03', '200000', 'deposit', NULL, NULL),
(103, 9, '2020-03-11 23:03:03', '250000', 'deposit', NULL, NULL),
(104, 9, '2020-03-11 23:03:04', '300000', 'deposit', NULL, NULL),
(105, 9, '2020-03-11 23:03:04', '350000', 'deposit', NULL, NULL),
(106, 9, '2020-03-11 23:03:04', '400000', 'deposit', NULL, NULL),
(107, 9, '2020-03-11 23:03:04', '450000', 'deposit', NULL, NULL),
(108, 9, '2020-03-11 23:03:04', '500000', 'deposit', NULL, NULL),
(109, 9, '2020-03-11 23:03:05', '550000', 'deposit', NULL, NULL),
(110, 9, '2020-03-11 23:03:05', '600000', 'deposit', NULL, NULL),
(111, 9, '2020-03-11 23:03:05', '650000', 'deposit', NULL, NULL),
(112, 9, '2020-03-11 23:03:05', '700000', 'deposit', NULL, NULL),
(113, 9, '2020-03-11 23:03:05', '750000', 'deposit', NULL, NULL),
(114, 9, '2020-03-11 23:03:05', '800000', 'deposit', NULL, NULL),
(115, 9, '2020-03-11 23:03:06', '850000', 'deposit', NULL, NULL),
(116, 9, '2020-03-11 23:03:06', '900000', 'deposit', NULL, NULL),
(117, 9, '2020-03-11 23:03:06', '950000', 'deposit', NULL, NULL),
(118, 9, '2020-03-11 23:03:06', '1000000', 'deposit', NULL, NULL),
(119, 9, '2020-03-11 23:03:06', '1050000', 'deposit', NULL, NULL),
(120, 9, '2020-03-11 23:03:06', '1100000', 'deposit', NULL, NULL),
(121, 9, '2020-03-11 23:03:07', '1150000', 'deposit', NULL, NULL),
(122, 9, '2020-03-11 23:03:07', '1200000', 'deposit', NULL, NULL),
(123, 9, '2020-03-11 23:03:07', '1250000', 'deposit', NULL, NULL),
(124, 9, '2020-03-11 23:03:07', '1300000', 'deposit', NULL, NULL),
(125, 9, '2020-03-11 23:03:07', '1350000', 'deposit', NULL, NULL),
(126, 9, '2020-03-11 23:03:07', '1400000', 'deposit', NULL, NULL),
(127, 9, '2020-03-11 23:03:08', '1450000', 'deposit', NULL, NULL),
(128, 9, '2020-03-11 23:03:08', '1500000', 'deposit', NULL, NULL),
(129, 9, '2020-03-11 23:03:08', '1550000', 'deposit', NULL, NULL),
(130, 9, '2020-03-11 23:03:08', '1600000', 'deposit', NULL, NULL),
(131, 9, '2020-03-11 23:03:09', '1650000', 'deposit', NULL, NULL),
(132, 9, '2020-03-11 23:03:09', '1700000', 'deposit', NULL, NULL),
(133, 9, '2020-03-11 23:03:09', '1750000', 'deposit', NULL, NULL),
(134, 9, '2020-03-11 23:03:09', '1800000', 'deposit', NULL, NULL),
(135, 9, '2020-03-11 23:03:09', '1850000', 'deposit', NULL, NULL),
(136, 9, '2020-03-11 23:03:09', '1900000', 'deposit', NULL, NULL),
(137, 9, '2020-03-11 23:03:09', '1950000', 'deposit', NULL, NULL),
(138, 9, '2020-03-11 23:03:10', '2000000', 'deposit', NULL, NULL),
(139, 9, '2020-03-11 23:03:10', '2050000', 'deposit', NULL, NULL),
(140, 9, '2020-03-11 23:03:10', '2100000', 'deposit', NULL, NULL),
(141, 9, '2020-03-11 23:03:10', '2150000', 'deposit', NULL, NULL),
(142, 9, '2020-03-11 23:03:10', '2200000', 'deposit', NULL, NULL),
(143, 9, '2020-03-11 23:03:10', '2250000', 'deposit', NULL, NULL),
(144, 9, '2020-03-11 23:03:11', '2300000', 'deposit', NULL, NULL),
(145, 9, '2020-03-11 23:03:11', '2350000', 'deposit', NULL, NULL),
(146, 9, '2020-03-11 23:03:11', '2400000', 'deposit', NULL, NULL),
(147, 9, '2020-03-11 23:03:11', '2450000', 'deposit', NULL, NULL),
(148, 9, '2020-03-11 23:03:11', '2500000', 'deposit', NULL, NULL),
(149, 9, '2020-03-11 23:03:12', '2550000', 'deposit', NULL, NULL),
(150, 9, '2020-03-11 23:03:12', '2600000', 'deposit', NULL, NULL),
(151, 9, '2020-03-11 23:03:12', '2650000', 'deposit', NULL, NULL),
(152, 9, '2020-03-11 23:03:13', '2700000', 'deposit', NULL, NULL),
(153, 9, '2020-03-11 23:03:13', '2750000', 'deposit', NULL, NULL),
(154, 9, '2020-03-11 23:03:13', '2800000', 'deposit', NULL, NULL),
(155, 9, '2020-03-11 23:03:13', '2850000', 'deposit', NULL, NULL),
(156, 9, '2020-03-11 23:03:13', '2900000', 'deposit', NULL, NULL),
(157, 9, '2020-03-11 23:03:14', '2950000', 'deposit', NULL, NULL),
(158, 9, '2020-03-11 23:03:14', '3000000', 'deposit', NULL, NULL),
(159, 9, '2020-03-11 23:03:14', '3050000', 'deposit', NULL, NULL),
(160, 9, '2020-03-11 23:03:14', '3100000', 'deposit', NULL, NULL),
(161, 9, '2020-03-11 23:03:14', '3150000', 'deposit', NULL, NULL),
(162, 9, '2020-03-11 23:03:15', '3200000', 'deposit', NULL, NULL),
(163, 9, '2020-03-11 23:03:15', '3250000', 'deposit', NULL, NULL),
(164, 9, '2020-03-11 23:03:15', '3300000', 'deposit', NULL, NULL),
(165, 9, '2020-03-11 23:03:16', '3350000', 'deposit', NULL, NULL),
(166, 9, '2020-03-11 23:03:16', '3400000', 'deposit', NULL, NULL),
(167, 9, '2020-03-11 23:03:16', '3450000', 'deposit', NULL, NULL),
(168, 9, '2020-03-11 23:03:17', '3500000', 'deposit', NULL, NULL),
(169, 9, '2020-03-11 23:03:17', '3550000', 'deposit', NULL, NULL),
(170, 9, '2020-03-11 23:03:17', '3600000', 'deposit', NULL, NULL),
(171, 9, '2020-03-11 23:03:22', '3593212', 'withdraw', NULL, NULL),
(172, 9, '2020-03-11 23:03:23', '3586424', 'withdraw', NULL, NULL),
(173, 9, '2020-03-11 23:03:23', '3579636', 'withdraw', NULL, NULL),
(174, 9, '2020-03-11 23:03:23', '3572848', 'withdraw', NULL, NULL),
(175, 9, '2020-03-11 23:03:23', '3566060', 'withdraw', NULL, NULL),
(176, 9, '2020-03-11 23:03:23', '3559272', 'withdraw', NULL, NULL),
(177, 9, '2020-03-11 23:03:23', '3552484', 'withdraw', NULL, NULL),
(178, 9, '2020-03-11 23:03:23', '3545696', 'withdraw', NULL, NULL),
(179, 9, '2020-03-11 23:03:24', '3538908', 'withdraw', NULL, NULL),
(180, 9, '2020-03-11 23:03:24', '3532120', 'withdraw', NULL, NULL),
(181, 9, '2020-03-11 23:03:24', '3525332', 'withdraw', NULL, NULL),
(182, 9, '2020-03-11 23:03:24', '3518544', 'withdraw', NULL, NULL),
(183, 9, '2020-03-11 23:03:24', '3511756', 'withdraw', NULL, NULL),
(184, 9, '2020-03-11 23:03:25', '3504968', 'withdraw', NULL, NULL),
(185, 9, '2020-03-11 23:25:34', '3504959', 'withdraw', NULL, NULL),
(186, 9, '2020-03-11 23:25:55', '3504948', 'withdraw', NULL, NULL),
(187, 9, '2020-03-11 23:25:56', '3504937', 'withdraw', NULL, NULL),
(188, 9, '2020-03-11 23:26:09', '3504936', 'withdraw', NULL, NULL),
(189, 9, '2020-03-11 23:26:09', '3504935', 'withdraw', NULL, NULL),
(190, 9, '2020-03-11 23:26:09', '3504934', 'withdraw', NULL, NULL),
(191, 9, '2020-03-11 23:47:44', '11', 'deposit', NULL, 1),
(192, 9, '2020-03-11 23:47:46', '11', 'deposit', NULL, 1),
(193, 9, '2020-03-11 23:47:46', '11', 'deposit', NULL, 1),
(194, 9, '2020-03-11 23:47:50', '11', 'deposit', NULL, 1),
(195, 9, '2020-03-11 23:48:44', '11', 'deposit', NULL, 1),
(196, 9, '2020-03-11 23:48:45', '11', 'deposit', NULL, 1),
(197, 9, '2020-03-11 23:48:46', '11', 'deposit', NULL, 1),
(198, 9, '2020-03-11 23:48:46', '11', 'deposit', NULL, 1),
(199, 9, '2020-03-11 23:50:58', '11', 'deposit', NULL, 1),
(200, 9, '2020-03-11 23:50:59', '11', 'deposit', NULL, 1),
(201, 9, '2020-03-11 23:51:00', '11', 'deposit', NULL, 1),
(202, 9, '2020-03-11 23:51:00', '11', 'deposit', NULL, 1),
(203, 9, '2020-03-11 23:51:01', '11', 'deposit', NULL, 1),
(204, 9, '2020-03-11 23:51:02', '11', 'deposit', NULL, 1),
(205, 9, '2020-03-11 23:51:02', '11', 'deposit', NULL, 1),
(206, 9, '2020-03-11 23:51:03', '11', 'deposit', NULL, 1),
(207, 9, '2020-03-11 23:51:03', '11', 'deposit', NULL, 1),
(208, 9, '2020-03-11 23:51:03', '11', 'deposit', NULL, 1),
(209, 9, '2020-03-11 23:51:14', '11', 'deposit', NULL, 1),
(210, 9, '2020-03-11 23:51:15', '11', 'deposit', NULL, 1),
(211, 9, '2020-03-11 23:51:37', '12', 'deposit', NULL, 1),
(212, 9, '2020-03-11 23:51:38', '12', 'deposit', NULL, 1),
(213, 9, '2020-03-11 23:51:38', '12', 'deposit', NULL, 1),
(214, 9, '2020-03-11 23:51:38', '12', 'deposit', NULL, 1),
(215, 9, '2020-03-11 23:51:40', '12', 'deposit', NULL, 1),
(216, 9, '2020-03-11 23:51:42', '12', 'deposit', NULL, 1),
(217, 9, '2020-03-11 23:51:43', '12', 'deposit', NULL, 1),
(218, 9, '2020-03-11 23:56:29', '1', 'deposit', NULL, 1),
(219, 9, '2020-03-11 23:56:30', '1', 'deposit', NULL, 1),
(220, 9, '2020-03-11 23:56:34', '1', 'deposit', NULL, 1),
(221, 9, '2020-03-11 23:56:34', '1', 'deposit', NULL, 1),
(222, 9, '2020-03-11 23:56:35', '1', 'deposit', NULL, 1),
(223, 9, '2020-03-11 23:56:39', '1', 'deposit', NULL, 1),
(224, 9, '2020-03-11 23:56:42', '1', 'deposit', NULL, 1),
(225, 9, '2020-03-11 23:56:53', '11', 'deposit', NULL, 1),
(226, 9, '2020-03-11 23:56:53', '11', 'deposit', NULL, 1),
(227, 9, '2020-03-11 23:56:55', '11', 'deposit', NULL, 1),
(228, 9, '2020-03-11 23:57:03', '11', 'deposit', NULL, 1),
(229, 9, '2020-03-11 23:57:26', '11', 'deposit', NULL, 1),
(230, 9, '2020-03-11 23:57:35', '11', 'deposit', NULL, 1),
(231, 9, '2020-03-11 23:57:40', '12', 'deposit', NULL, 1),
(232, 9, '2020-03-11 23:59:10', '11', 'deposit', NULL, 1),
(233, 9, '2020-03-11 23:59:46', '11', 'deposit', NULL, 1),
(234, 9, '2020-03-12 00:00:20', '11', 'deposit', NULL, 1),
(235, 9, '2020-03-12 00:00:43', '0', 'deposit', NULL, 1),
(236, 9, '2020-03-12 00:00:55', '1', 'deposit', NULL, 1),
(237, 9, '2020-03-12 00:02:45', '1', 'deposit', NULL, 1),
(238, 9, '2020-03-12 00:02:55', '1', 'deposit', NULL, 1),
(239, 9, '2020-03-12 00:04:15', '22', 'deposit', NULL, 1),
(240, 9, '2020-03-12 00:04:19', '44', 'deposit', NULL, 1),
(241, 9, '2020-03-12 00:04:26', '11', 'deposit', NULL, 1),
(242, 9, '2020-03-12 00:04:31', '10', 'deposit', NULL, 1),
(243, 9, '2020-03-12 00:07:18', '11', 'deposit', NULL, 1),
(244, 9, '2020-03-12 00:07:27', '11', 'deposit', NULL, 1),
(245, 9, '2020-03-12 00:09:41', '22', 'deposit', NULL, 1),
(246, 9, '2020-03-12 00:10:04', '11', 'deposit', NULL, 1),
(247, 9, '2020-03-12 00:10:06', '11', 'deposit', NULL, 1),
(248, 9, '2020-03-12 00:10:07', '11', 'deposit', NULL, 1),
(249, 9, '2020-03-12 00:10:08', '111', 'deposit', NULL, 1),
(250, 9, '2020-03-12 00:10:09', '111', 'deposit', NULL, 1),
(251, 9, '2020-03-12 00:10:10', '111', 'deposit', NULL, 1),
(252, 9, '2020-03-12 00:10:11', '111', 'deposit', NULL, 1),
(253, 9, '2020-03-12 00:10:11', '111', 'deposit', NULL, 1),
(254, 9, '2020-03-12 00:10:11', '111', 'deposit', NULL, 1),
(255, 9, '2020-03-12 00:10:11', '111', 'deposit', NULL, 1),
(256, 9, '2020-03-12 00:10:11', '111', 'deposit', NULL, 1),
(257, 9, '2020-03-12 00:10:16', '11', 'deposit', NULL, 2),
(258, 9, '2020-03-12 00:10:16', '11', 'deposit', NULL, 2),
(259, 9, '2020-03-12 00:10:16', '11', 'deposit', NULL, 2),
(260, 9, '2020-03-12 00:10:17', '11', 'deposit', NULL, 2),
(261, 9, '2020-03-12 00:10:58', '11', 'withdraw', NULL, 1),
(262, 9, '2020-03-12 00:11:00', '11', 'withdraw', NULL, 1),
(263, 9, '2020-03-12 00:11:08', '1400', 'withdraw', NULL, 1),
(264, 9, '2020-03-12 00:11:16', '1400', 'withdraw', NULL, 1),
(265, 9, '2020-03-12 00:12:13', '11', 'withdraw', NULL, 1),
(266, 9, '2020-03-12 00:12:19', '11', 'withdraw', NULL, 2),
(267, 9, '2020-03-12 00:12:27', '44', 'withdraw', NULL, 2),
(268, 9, '2020-03-12 00:12:28', '44', 'withdraw', NULL, 2),
(269, 9, '2020-03-12 00:12:36', '44', 'withdraw', NULL, 2),
(270, 9, '2020-03-12 00:13:36', '11', 'withdraw', NULL, 1),
(271, 9, '2020-03-12 00:13:39', '11', 'withdraw', NULL, 1),
(272, 9, '2020-03-12 00:13:40', '11', 'withdraw', NULL, 1),
(273, 9, '2020-03-12 00:15:09', '11', 'withdraw', NULL, 1),
(274, 9, '2020-03-12 00:15:11', '11', 'withdraw', NULL, 1),
(275, 9, '2020-03-12 00:15:14', '11', 'withdraw', NULL, 1),
(276, 9, '2020-03-12 00:15:14', '11', 'withdraw', NULL, 1),
(277, 9, '2020-03-12 00:15:15', '11', 'withdraw', NULL, 1),
(278, 9, '2020-03-12 00:15:15', '11', 'withdraw', NULL, 1),
(279, 9, '2020-03-12 00:15:15', '11', 'withdraw', NULL, 1),
(280, 9, '2020-03-12 00:15:20', '1400', 'withdraw', NULL, 1),
(281, 9, '2020-03-12 00:15:26', '11', 'withdraw', NULL, 2),
(282, 9, '2020-03-12 00:15:26', '11', 'withdraw', NULL, 2),
(283, 9, '2020-03-12 00:15:27', '11', 'withdraw', NULL, 2),
(284, 9, '2020-03-12 00:15:27', '11', 'withdraw', NULL, 2),
(285, 9, '2020-03-12 00:16:31', '11', 'deposit', NULL, 1),
(286, 9, '2020-03-12 00:16:31', '11', 'deposit', NULL, 1),
(287, 9, '2020-03-12 00:16:31', '11', 'deposit', NULL, 1),
(288, 9, '2020-03-12 00:16:36', '11', 'deposit', NULL, 1),
(289, 9, '2020-03-12 00:16:36', '11', 'deposit', NULL, 1),
(290, 9, '2020-03-12 00:16:36', '11', 'deposit', NULL, 1),
(291, 9, '2020-03-12 00:16:48', '1000', 'deposit', NULL, 1),
(292, 10, '2020-03-12 11:25:58', '50000', 'deposit', NULL, 3),
(293, 10, '2020-03-12 11:26:38', '10000', 'transfer', 0, 3),
(294, 10, '2020-03-12 11:33:56', '10000', 'deposit', NULL, 3),
(295, 10, '2020-03-12 11:34:00', '100', 'transfer', 9, 3),
(296, 10, '2020-03-12 11:34:13', '1000', 'transfer', 9, 3),
(297, 10, '2020-03-12 11:35:31', '100', 'transfer', 9, 3),
(298, 10, '2020-03-12 11:35:47', '800', 'transfer', 9, 3),
(299, 10, '2020-03-12 11:35:57', '100', 'transfer', 9, 3),
(300, 10, '2020-03-12 11:36:57', '100', 'transfer', 9, 3),
(301, 9, '2020-03-12 11:37:41', '1000', 'transfer', 10, 1),
(302, 9, '2020-03-12 11:37:56', '50000', 'deposit', NULL, 2),
(303, 9, '2020-03-12 11:38:08', '50000', 'transfer', 10, 2),
(304, 9, '2020-03-12 22:24:51', '11', 'deposit', NULL, 1),
(305, 9, '2020-03-12 22:24:51', '11', 'deposit', NULL, 1),
(306, 9, '2020-03-12 22:24:56', '11', 'deposit', NULL, 1),
(307, 9, '2020-03-12 22:24:57', '11', 'deposit', NULL, 1),
(308, 9, '2020-03-12 22:24:57', '11', 'deposit', NULL, 1),
(309, 9, '2020-03-12 22:24:57', '11', 'deposit', NULL, 1),
(310, 9, '2020-03-12 22:24:57', '11', 'deposit', NULL, 1),
(311, 9, '2020-03-12 23:19:38', '50000', 'deposit', NULL, 7),
(312, 9, '2020-03-12 23:34:45', '100', 'deposit', NULL, 7),
(313, 9, '2020-03-12 23:34:46', '100', 'deposit', NULL, 7),
(314, 9, '2020-03-12 23:34:47', '100', 'deposit', NULL, 7),
(315, 9, '2020-03-12 23:37:24', '100', 'deposit', NULL, 7),
(316, 9, '2020-03-12 23:37:37', '100', 'deposit', NULL, 1),
(317, 9, '2020-03-12 23:37:38', '100', 'deposit', NULL, 1),
(318, 9, '2020-03-12 23:37:39', '100', 'deposit', NULL, 1),
(319, 9, '2020-03-12 23:37:39', '100', 'deposit', NULL, 1),
(320, 9, '2020-03-13 10:52:08', '10000', 'deposit', NULL, 12),
(321, 9, '2020-03-13 10:52:09', '10000', 'deposit', NULL, 12),
(322, 9, '2020-03-13 10:52:20', '1000', 'withdraw', NULL, 12),
(323, 9, '2020-03-13 10:52:21', '1000', 'withdraw', NULL, 12),
(324, 9, '2020-03-13 10:52:21', '1000', 'withdraw', NULL, 12),
(325, 9, '2020-03-13 10:52:21', '1000', 'withdraw', NULL, 12),
(326, 9, '2020-03-13 10:52:21', '1000', 'withdraw', NULL, 12),
(327, 9, '2020-03-13 10:55:19', '100', 'deposit', NULL, 1),
(328, 9, '2020-03-13 10:56:32', '5', 'deposit', NULL, 1),
(329, 9, '2020-03-13 10:59:36', '100', 'deposit', NULL, 1),
(330, 9, '2020-03-13 11:01:56', '100', 'deposit', NULL, 1),
(331, 9, '2020-03-13 11:01:57', '100', 'deposit', NULL, 1),
(332, 9, '2020-03-13 11:02:25', '100', 'deposit', NULL, 1),
(333, 9, '2020-03-13 11:03:35', '100', 'deposit', NULL, 1),
(334, 9, '2020-03-13 11:03:51', '100', 'deposit', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(125) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pin` int(11) NOT NULL,
  `join_date` datetime NOT NULL,
  `balance` decimal(10,0) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `pin`, `join_date`, `balance`) VALUES
(9, 'Test187@c.com', '$2y$10$qwiFiDFaoJla/DjWe8ZIYeepEtGAvMLLubMSIL25C/g6iFV8EOaE2', 9, '2020-03-11 17:59:26', '1173202'),
(10, 'Test187@a.com', '$2y$10$kDU1KPK41b5cMb8KXjLdleTgFXbKI/NiRNApPVG59AwGeYk.kY2Sm', 9, '2020-03-12 11:25:45', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=335;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
