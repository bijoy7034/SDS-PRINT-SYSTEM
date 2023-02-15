-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 01, 2023 at 05:08 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sds`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `adm_no` varchar(255) NOT NULL,
  `balance` int NOT NULL,
  PRIMARY KEY (`adm_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`adm_no`, `balance`) VALUES
('INMCA-19-037', 4),
('INMCA-19-033', 308),
('INMCA-19-004', 1250),
('INMCA-19-003', 195),
('INMCA-23-032', 221),
('INMCA-19-007', 800),
('INMCA-22-09', 1000),
('IMCA-19-029', 450),
('INMCA-19-032', 494),
('INMCA-19-02', 450);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `name` varchar(255) NOT NULL,
  `rate` int NOT NULL,
  `type` varchar(28) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`name`, `rate`, `type`) VALUES
('Color (A3)', 40, 'paper'),
('Hard Bind', 100, 'addon'),
('Soft Bind', 30, 'addon'),
('Spiral Bind', 50, 'addon'),
('Color (A4)', 7, 'paper'),
('Black and White (A4)', 1, 'paper'),
('Black and White (A3)', 20, 'paper');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int NOT NULL,
  `b&w` int NOT NULL,
  `color` int NOT NULL,
  `bw&a4` int NOT NULL,
  `col&a4` int NOT NULL,
  `hardbind` int NOT NULL,
  `softbind` int NOT NULL,
  `spiral` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `b&w`, `color`, `bw&a4`, `col&a4`, `hardbind`, `softbind`, `spiral`) VALUES
(1, 1, 7, 20, 40, 100, 30, 50);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `adm_no` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `semester` int NOT NULL,
  `balance` int NOT NULL,
  `batch` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`adm_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`adm_no`, `name`, `semester`, `balance`, `batch`, `email`) VALUES
('INMCA-19-037', 'Bijoy Anil', 3, 0, 'Design', 'bijoy@gmail.com'),
('INMCA-19-033', 'Aparna Gopan', 5, 0, 'Design', 'aparna@gmail.com'),
('INMCA-19-004', 'Akshay Anil', 3, 0, 'Design', 'akshay@gmail.com'),
('INMCA-19-003', 'Tom V', 2, 0, 'Design', 'tom@gmail.com'),
('INMCA-23-032', 'Aravind R', 3, 0, 'Design', 'ara@gmail.com'),
('INMCA-19-007', 'Anu Alex', 3, 0, 'Design', 'anu@gmail.com'),
('INMCA-22-09', 'Alin Mariya', 2, 0, 'Design', 'alin@gmail.com'),
('IMCA-19-029', 'Abhimaneu N S', 8, 0, 'MCA', 'abhimaneu2001@gmail.com'),
('INMCA-19-032', 'Swathy', 4, 0, 'MCA', 'bijoy@gmail.com'),
('INMCA-19-02', 'abc', 1, 0, 'Design', 'bijoy@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `t_id` int NOT NULL AUTO_INCREMENT,
  `amt` int NOT NULL,
  `time` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `adm_no` varchar(255) NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`t_id`, `amt`, `time`, `date`, `adm_no`) VALUES
(3, 50, '10:51:14 pm', '2023-01-03', 'INMCA-19-037'),
(4, 125, '11:04:36 pm', '2023-01-07', 'INMCA-19-033'),
(5, 264, '11:05:15 pm', '2023-01-07', 'INMCA-19-037'),
(6, 90, '11:06:57 pm', '2023-01-07', 'INMCA-19-033'),
(7, 100, '11:08:38 pm', '2023-01-07', 'INMCA-19-037'),
(8, 675, '11:31:58 pm', '2023-01-07', 'INMCA-19-037'),
(9, 20, '11:13:24 am', '2023-01-09', 'INMCA-19-037'),
(10, 2, '11:15:28 am', '2023-01-09', 'INMCA-19-003'),
(11, 33, '11:30:19 am', '2023-01-09', 'INMCA-19-037'),
(12, 168, '07:47:45 pm', '2023-01-09', 'INMCA-19-037'),
(13, 169, '08:17:52 pm', '2023-01-09', 'INMCA-19-037'),
(14, 135, '11:24:46 pm', '2023-01-09', 'INMCA-19-037'),
(15, 100, '11:26:13 pm', '2023-01-09', 'INMCA-19-007'),
(16, 2, '11:09:54 pm', '2023-01-10', 'INMCA-19-037'),
(17, 400, '11:16:03 pm', '2023-01-10', 'INMCA-19-007'),
(18, -6, '11:16:55 pm', '2023-01-10', 'INMCA-19-037'),
(19, 500, '11:21:13 pm', '2023-01-10', 'INMCA-19-037'),
(20, -50, '11:23:34 pm', '2023-01-10', 'INMCA-19-037'),
(21, -40, '11:24:52 pm', '2023-01-10', 'INMCA-19-033'),
(22, 500, '11:35:55 pm', '2023-01-10', 'INMCA-22-09'),
(23, -22, '11:10:32 am', '2023-01-14', 'INMCA-19-037'),
(24, -330, '11:14:54 am', '2023-01-14', 'INMCA-19-037'),
(25, -225, '11:19:16 am', '2023-01-14', 'INMCA-23-032'),
(26, -58, '11:22:11 am', '2023-01-14', 'INMCA-19-037'),
(27, -50, '11:27:03 am', '2023-01-14', 'INMCA-23-032'),
(28, -2, '11:29:51 am', '2023-01-14', 'INMCA-19-037'),
(29, 100, '11:31:50 am', '2023-01-14', 'INMCA-19-037'),
(30, -50, '11:58:41 am', '2023-01-14', 'INMCA-19-037'),
(31, -50, '11:17:55 pm', '2023-01-15', 'INMCA-19-037'),
(32, -3, '11:18:12 pm', '2023-01-15', 'INMCA-19-003'),
(33, -106, '09:21:51 pm', '2023-01-16', 'INMCA-19-037'),
(34, -3, '10:40:41 pm', '2023-01-16', 'INMCA-19-033'),
(35, 500, '01:20:55 pm', '2023-01-17', 'IMCA-19-029'),
(36, -50, '01:22:04 pm', '2023-01-17', 'IMCA-19-029'),
(37, -5, '01:26:03 pm', '2023-01-17', 'INMCA-19-033'),
(38, 500, '02:08:01 pm', '2023-01-17', 'INMCA-19-037'),
(39, 500, '02:08:15 pm', '2023-01-17', 'INMCA-22-09'),
(40, 500, '02:08:40 pm', '2023-01-17', 'INMCA-19-032'),
(41, -5, '02:09:04 pm', '2023-01-17', 'INMCA-19-032'),
(42, 500, '02:22:54 pm', '2023-01-17', 'INMCA-19-02'),
(43, -50, '02:23:30 pm', '2023-01-17', 'INMCA-19-02'),
(44, -3, '05:53:55 pm', '2023-01-19', 'INMCA-19-037'),
(45, -5, '06:08:12 pm', '2023-01-19', 'INMCA-19-037'),
(46, -4, '06:21:19 pm', '2023-01-19', 'INMCA-23-032'),
(47, -473, '06:30:16 pm', '2023-01-19', 'INMCA-19-037'),
(48, -2, '06:31:04 pm', '2023-01-19', 'INMCA-19-037'),
(49, 20, '06:37:15 pm', '2023-01-19', 'INMCA-19-037'),
(50, 20, '09:00:35 pm', '2023-01-19', 'INMCA-19-037'),
(51, -5, '10:45:22 pm', '2023-01-19', 'INMCA-19-037'),
(52, -11, '11:26:10 pm', '2023-01-19', 'INMCA-19-037'),
(53, -4, '11:26:48 pm', '2023-01-19', 'INMCA-19-037'),
(54, -4, '11:26:58 pm', '2023-01-19', 'INMCA-19-033'),
(55, -3, '11:27:15 pm', '2023-01-19', 'INMCA-19-037'),
(56, -4, '11:27:36 pm', '2023-01-19', 'INMCA-19-033'),
(57, -1, '11:30:43 pm', '2023-01-19', 'INMCA-19-037'),
(58, -3, '12:04:37 am', '2023-01-19', 'INMCA-19-033'),
(59, -5, '12:17:20 am', '2023-01-19', 'INMCA-19-037'),
(60, -5, '12:29:06 am', '2023-01-19', 'INMCA-19-033'),
(61, -1, '06:40:07 pm', '2023-01-26', 'INMCA-19-032'),
(62, -103, '08:05:48 pm', '2023-01-27', 'INMCA-19-033');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `password`) VALUES
('BijoyAnil', '$2y$10$gLOsfnPLan1bzmCniK1jSOS7cGwp/Fgu2kn3tC2ZSF/DpTwZ5de5u'),
('USER123', '$2y$10$EqnC1KiPBdnPcrmhz4s2zuUMBwdWeghQRRZcCHPjGlQS.0eZ.WLsu');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
