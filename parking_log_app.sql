-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2018 at 12:19 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `parking_lot_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `parking_lots`
--

CREATE TABLE `parking_lots` (
  `pl_uid` int(10) unsigned NOT NULL,
  `pl_name` varchar(50) NOT NULL,
  `dtc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parking_lots`
--

INSERT INTO `parking_lots` (`pl_uid`, `pl_name`, `dtc`) VALUES
(1, 'Jimmy''s Parking Lot', '2018-06-09 19:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `parking_lot_levels`
--

CREATE TABLE `parking_lot_levels` (
  `pll_uid` int(10) unsigned NOT NULL,
  `pll_parking_lot_id` int(10) unsigned NOT NULL,
  `pll_name` varchar(50) NOT NULL,
  `pll_order` int(10) unsigned NOT NULL,
  `dtc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parking_lot_levels`
--

INSERT INTO `parking_lot_levels` (`pll_uid`, `pll_parking_lot_id`, `pll_name`, `pll_order`, `dtc`) VALUES
(1, 1, 'Ground Level', 1, '2018-06-09 19:36:09'),
(2, 1, 'Second Level', 2, '2018-06-09 19:36:34'),
(3, 1, 'Top Level', 3, '2018-06-09 19:36:34');

-- --------------------------------------------------------

--
-- Table structure for table `parking_lot_spaces`
--

CREATE TABLE `parking_lot_spaces` (
  `pls_uid` int(10) unsigned NOT NULL,
  `pls_level_id` int(10) unsigned NOT NULL,
  `pls_size_id` int(10) unsigned NOT NULL,
  `pls_available` tinyint(4) NOT NULL DEFAULT '1',
  `pls_name` varchar(50) DEFAULT NULL,
  `pls_order` int(10) unsigned NOT NULL,
  `dtc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parking_lot_spaces`
--

INSERT INTO `parking_lot_spaces` (`pls_uid`, `pls_level_id`, `pls_size_id`, `pls_available`, `pls_name`, `pls_order`, `dtc`) VALUES
(1, 1, 3, 0, NULL, 1, '2018-06-09 19:38:01'),
(2, 1, 5, 1, 'Tommy''s Space', 2, '2018-06-09 19:39:32'),
(3, 1, 6, 1, NULL, 3, '2018-06-09 19:39:32'),
(7, 2, 7, 1, NULL, 1, '2018-06-09 19:41:41'),
(8, 2, 7, 0, NULL, 2, '2018-06-09 19:41:41'),
(9, 2, 2, 1, NULL, 3, '2018-06-09 19:41:41'),
(10, 2, 10, 0, NULL, 4, '2018-06-09 19:41:41'),
(11, 2, 9, 1, NULL, 5, '2018-06-09 19:41:41'),
(12, 3, 5, 0, NULL, 1, '2018-06-09 19:43:20'),
(13, 3, 1, 1, NULL, 2, '2018-06-09 19:43:20'),
(14, 3, 4, 0, NULL, 3, '2018-06-09 19:43:20'),
(15, 3, 9, 1, NULL, 4, '2018-06-09 19:43:20'),
(16, 3, 10, 1, NULL, 5, '2018-06-09 19:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `parking_lot_space_sizes`
--

CREATE TABLE `parking_lot_space_sizes` (
  `plss_uid` int(10) unsigned NOT NULL,
  `plss_size` int(10) NOT NULL,
  `plss_name` varchar(50) NOT NULL,
  `dtc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parking_lot_space_sizes`
--

INSERT INTO `parking_lot_space_sizes` (`plss_uid`, `plss_size`, `plss_name`, `dtc`) VALUES
(1, 1, 'Skateboard', '2018-06-09 19:33:59'),
(2, 2, 'Scooter', '2018-06-09 19:33:59'),
(3, 3, 'Tricycle', '2018-06-09 19:34:22'),
(4, 4, 'Bicycle', '2018-06-09 19:35:02'),
(5, 5, 'Moped', '2018-06-09 19:35:02'),
(6, 6, 'Motorcycle', '2018-06-09 19:35:02'),
(7, 7, '2 Door Sedan', '2018-06-09 19:35:02'),
(8, 8, '4 Door Sedan', '2018-06-09 19:35:02'),
(9, 9, 'SUV', '2018-06-09 19:35:02'),
(10, 10, 'Truck', '2018-06-09 19:35:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parking_lots`
--
ALTER TABLE `parking_lots`
  ADD PRIMARY KEY (`pl_uid`);

--
-- Indexes for table `parking_lot_levels`
--
ALTER TABLE `parking_lot_levels`
  ADD PRIMARY KEY (`pll_uid`),
  ADD UNIQUE KEY `pll_parking_lot_id` (`pll_parking_lot_id`,`pll_order`);

--
-- Indexes for table `parking_lot_spaces`
--
ALTER TABLE `parking_lot_spaces`
  ADD PRIMARY KEY (`pls_uid`),
  ADD UNIQUE KEY `pls_level_id` (`pls_level_id`,`pls_order`),
  ADD KEY `pls_size_id` (`pls_size_id`);

--
-- Indexes for table `parking_lot_space_sizes`
--
ALTER TABLE `parking_lot_space_sizes`
  ADD PRIMARY KEY (`plss_uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parking_lots`
--
ALTER TABLE `parking_lots`
  MODIFY `pl_uid` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `parking_lot_levels`
--
ALTER TABLE `parking_lot_levels`
  MODIFY `pll_uid` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `parking_lot_spaces`
--
ALTER TABLE `parking_lot_spaces`
  MODIFY `pls_uid` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `parking_lot_space_sizes`
--
ALTER TABLE `parking_lot_space_sizes`
  MODIFY `plss_uid` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `parking_lot_levels`
--
ALTER TABLE `parking_lot_levels`
  ADD CONSTRAINT `pll_parking_lot_id_fk` FOREIGN KEY (`pll_parking_lot_id`) REFERENCES `parking_lots` (`pl_uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parking_lot_spaces`
--
ALTER TABLE `parking_lot_spaces`
  ADD CONSTRAINT `pls_size_id_fk` FOREIGN KEY (`pls_size_id`) REFERENCES `parking_lot_space_sizes` (`plss_uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pls_level_id_fk` FOREIGN KEY (`pls_level_id`) REFERENCES `parking_lot_levels` (`pll_uid`) ON DELETE CASCADE ON UPDATE CASCADE;
