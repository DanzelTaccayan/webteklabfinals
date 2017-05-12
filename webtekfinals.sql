-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2017 at 02:37 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webtekfinals`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `sender` int(11) NOT NULL,
  `recepient` int(11) NOT NULL,
  `content` text NOT NULL,
  `feedback_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`sender`, `recepient`, `content`, `feedback_id`) VALUES
(6, 8, 'ULUL', 3),
(6, 4, 'PANGET WALANG KWENTA', 4),
(6, 9, 'MAITITM KA', 5),
(6, 7, 'ANO TO?', 6),
(8, 9, 'BASURA', 7),
(4, 4, 'VERY VERy BAAAAD', 8);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `evaluator` int(11) NOT NULL,
  `evaluatee` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `evaluator`, `evaluatee`, `rating`) VALUES
(1, 4, 5, 4),
(2, 6, 5, 5),
(3, 7, 5, 3),
(4, 5, 6, 4),
(5, 4, 6, 2),
(6, 4, 7, 5),
(7, 5, 7, 2),
(8, 4, 8, 5),
(9, 5, 8, 4),
(10, 4, 9, 5),
(11, 5, 9, 4),
(12, 6, 9, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `recipient`
--
CREATE TABLE `recipient` (
`recepient` int(11)
,`recName` text
);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `idrequest` int(11) NOT NULL,
  `status` enum('approve','reject','pending') NOT NULL DEFAULT 'pending',
  `requested_by` int(11) NOT NULL,
  `requested_to` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='	';

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`idrequest`, `status`, `requested_by`, `requested_to`, `service_id`, `request_date`, `updated_at`) VALUES
(1, 'pending', 6, 7, 8, '2017-05-10 16:13:08', '2017-01-03 16:00:00'),
(2, 'pending', 6, 4, 4, '2017-05-10 16:02:16', '2017-01-03 16:00:00'),
(3, 'pending', 6, 8, 9, '2017-05-10 16:15:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `sender`
--
CREATE TABLE `sender` (
`sender` int(11)
,`senderName` text
);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `time_needed` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `created_at`, `time_needed`) VALUES
(4, 'bundok susong dalaga', '2017-01-03 16:00:00', NULL),
(7, 'chupa', '2017-05-10 15:20:36', NULL),
(8, 'mulmol tite', '2017-05-10 15:20:40', NULL),
(9, 'supsop suso', '2017-05-10 15:20:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `servicesp`
--

CREATE TABLE `servicesp` (
  `idServiceSp` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `transaction_status` enum('ongoing','done') DEFAULT 'ongoing',
  `sp_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `service_id`, `transaction_status`, `sp_id`, `cust_id`, `created_at`, `updated_at`) VALUES
(1, 4, 'ongoing', 4, 6, '2017-01-03 16:00:00', '2017-01-03 16:00:00'),
(2, 9, 'done', 7, 6, '2017-05-10 16:08:37', '0000-00-00 00:00:00'),
(3, 8, 'ongoing', 8, 6, '2017-05-10 16:08:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` enum('Active','Disabled','pending') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `UserName`, `Password`, `Status`) VALUES
(4, 'galo', '$2y$10$.VnMQXvYbrEQyM3dyRUC3.YnydaDhAO295Ki68y/XbqjoWkExYGYm', 'Active'),
(5, 'galo123', '$2y$10$kSvMVPukBXrwowUItl.Ne.m11pMK9R/6JFdCYJ4uM9.aKizk1vEt.', 'Active'),
(6, 'etheldawn', 'wooden', 'Active'),
(7, 'dasdas', '$2y$10$jACl6i2Dxmtiw.NaJPxs.OOdgzY77LUmwuwa8ZRYL9FZ7WGqHlrFy', 'Active'),
(8, 'burat', '$2y$10$Rj1fSB88l.ZCXDRkak2nkucU9P6CU4v34DbAbypb/mzbfTrM.fObq', 'Active'),
(9, 'yuki', '$2y$10$gx/AZWXciIUVd/rnxtBQLevlHPrWEHUyaPl3cMcrHuqoFumud1z1u', 'pending'),
(10, 'test', '$2y$10$Y6I.Y0NnQKDdUBDu7EnpTulI5GvwNhx/8aftolpmZl390umiLCzW2', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `idUser` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactNumber` int(11) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UserType` enum('SP','customer','admin','guest') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`idUser`, `firstName`, `middleName`, `lastName`, `address`, `email`, `contactNumber`, `company`, `created_at`, `updated_at`, `UserType`) VALUES
(4, 'Galo Berlyn', 'Dullas', 'Garlejo', '123 bonifaceio', 'test@yahoo.com', 123456789, 'IBM', '2017-05-10 15:12:13', '2017-04-28 12:13:38', 'SP'),
(5, 'asdas', 'asdasdas', 'asdasda', 'aaa', 'asdasdas@asdasda.com', 222, 'aaa', '2017-05-10 15:12:40', '2017-04-28 12:15:55', 'admin'),
(6, 'Ethel Dawn', 'Tufay', 'Mejala', 'Camp Dangwa, La Trinidad, Benguet', 'mademoiselle@gmail.com', 222, 'd', '2017-05-10 15:12:47', '2017-04-28 12:36:17', 'customer'),
(7, 'sadas', 'sadas', 'sdas', 'sadas', 'asdasdas@asdasda.com', 22, '', '2017-05-10 15:12:24', '2017-04-28 12:36:40', 'SP'),
(8, 'Kobe', 'wv', 'Miguel', 'qwf', '2153820@slu.edu.ph', 32131, 'BOTAS', '2017-05-04 03:49:20', '2017-05-04 03:49:20', 'SP'),
(9, 'Yuki', 'Pogi', 'Marfil', 'jan sa gilid', 'yukipogi@gmail.com', 98457847, 'Apple', '2017-05-08 03:49:20', '2017-05-08 04:49:20', 'SP'),
(10, 'test', 'test', 'test', 'dg', 'tset@ff.com', 3414, 'fswq', '2017-05-12 03:14:58', '2017-05-12 03:14:58', 'SP');

-- --------------------------------------------------------

--
-- Structure for view `recipient`
--
DROP TABLE IF EXISTS `recipient`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `recipient`  AS  select `feedback`.`recepient` AS `recepient`,concat(`user_details`.`firstName`,`user_details`.`middleName`,`user_details`.`lastName`) AS `recName` from (`feedback` join `user_details`) where (`user_details`.`idUser` = `feedback`.`recepient`) ;

-- --------------------------------------------------------

--
-- Structure for view `sender`
--
DROP TABLE IF EXISTS `sender`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sender`  AS  select `feedback`.`sender` AS `sender`,concat(`user_details`.`firstName`,`user_details`.`middleName`,`user_details`.`lastName`) AS `senderName` from (`feedback` join `user_details`) where (`user_details`.`idUser` = `feedback`.`sender`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `sender_idx` (`sender`),
  ADD KEY `recipient_idx` (`recepient`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `evaluator _idx` (`evaluator`),
  ADD KEY `evaluatee_idx` (`evaluatee`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`idrequest`),
  ADD UNIQUE KEY `idrequest_UNIQUE` (`idrequest`),
  ADD KEY `requested_by_idx` (`requested_by`),
  ADD KEY `requested_to_idx` (`requested_to`),
  ADD KEY `service_id_idx` (`service_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD UNIQUE KEY `service_id_UNIQUE` (`service_id`),
  ADD UNIQUE KEY `service_name_UNIQUE` (`service_name`);

--
-- Indexes for table `servicesp`
--
ALTER TABLE `servicesp`
  ADD PRIMARY KEY (`idServiceSp`),
  ADD UNIQUE KEY `idServiceSp_UNIQUE` (`idServiceSp`),
  ADD KEY `fk_service_idx` (`service_id`),
  ADD KEY `fk_sp_idx` (`sp_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `sp_id_idx` (`sp_id`),
  ADD KEY `cust_id_idx` (`cust_id`),
  ADD KEY `service_id_idx` (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`),
  ADD UNIQUE KEY `idUsers_UNIQUE` (`idUsers`),
  ADD UNIQUE KEY `UserName_UNIQUE` (`UserName`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `idUser_UNIQUE` (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `idrequest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `servicesp`
--
ALTER TABLE `servicesp`
  MODIFY `idServiceSp` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `recipient` FOREIGN KEY (`recepient`) REFERENCES `user_details` (`idUser`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sender` FOREIGN KEY (`sender`) REFERENCES `user_details` (`idUser`) ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `evaluatee` FOREIGN KEY (`evaluatee`) REFERENCES `user_details` (`idUser`) ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluator ` FOREIGN KEY (`evaluator`) REFERENCES `user_details` (`idUser`) ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `requested_by` FOREIGN KEY (`requested_by`) REFERENCES `user_details` (`idUser`) ON UPDATE CASCADE,
  ADD CONSTRAINT `requested_to` FOREIGN KEY (`requested_to`) REFERENCES `user_details` (`idUser`) ON UPDATE CASCADE,
  ADD CONSTRAINT `service_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `cust_fk` FOREIGN KEY (`cust_id`) REFERENCES `user_details` (`idUser`),
  ADD CONSTRAINT `service_fk` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sp_fk` FOREIGN KEY (`sp_id`) REFERENCES `user_details` (`idUser`) ON UPDATE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `fk_reqid_reqslip` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
