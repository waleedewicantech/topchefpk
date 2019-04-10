-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 10, 2019 at 09:19 PM
-- Server version: 10.2.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `topchef_master`
--
CREATE DATABASE IF NOT EXISTS `topchef_master` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `topchef_master`;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `_name` varchar(50) NOT NULL,
  `mobno` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  PRIMARY KEY (`cust_id`),
  UNIQUE KEY `mobno` (`mobno`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `pass` (`pass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `item_name` varchar(40) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `vendor_id`, `item_name`, `description`) VALUES(1, 1, 'tikka', 'chekcn tikka');
INSERT INTO `items` (`item_id`, `vendor_id`, `item_name`, `description`) VALUES(2, 1, 'seekh kabab', 'seekh kabab');
INSERT INTO `items` (`item_id`, `vendor_id`, `item_name`, `description`) VALUES(3, 1, 'malaiboti', 'malai boti');
INSERT INTO `items` (`item_id`, `vendor_id`, `item_name`, `description`) VALUES(4, 1, 'makhan handi', 'handi');
INSERT INTO `items` (`item_id`, `vendor_id`, `item_name`, `description`) VALUES(5, 1, 'rice', 'chiense rice');
INSERT INTO `items` (`item_id`, `vendor_id`, `item_name`, `description`) VALUES(6, 1, 'soup', 'hot n sour soup');
INSERT INTO `items` (`item_id`, `vendor_id`, `item_name`, `description`) VALUES(7, 1, 'chicken steak', 'chicken steak');
INSERT INTO `items` (`item_id`, `vendor_id`, `item_name`, `description`) VALUES(8, 1, 'beef steak', 'teaaka');
INSERT INTO `items` (`item_id`, `vendor_id`, `item_name`, `description`) VALUES(9, 1, 'noodles', 'odllldea');
INSERT INTO `items` (`item_id`, `vendor_id`, `item_name`, `description`) VALUES(10, 1, 'bf1', 'ssome bf item');
INSERT INTO `items` (`item_id`, `vendor_id`, `item_name`, `description`) VALUES(11, 1, 'bf2', 'some bf tem');
INSERT INTO `items` (`item_id`, `vendor_id`, `item_name`, `description`) VALUES(12, 1, 'bf3', 'some bf item');
INSERT INTO `items` (`item_id`, `vendor_id`, `item_name`, `description`) VALUES(13, 1, 'bf4', 'some bf item');
INSERT INTO `items` (`item_id`, `vendor_id`, `item_name`, `description`) VALUES(14, 1, 'bf5', 'some bf');
INSERT INTO `items` (`item_id`, `vendor_id`, `item_name`, `description`) VALUES(15, 1, 'bf6', 'some bf item');
INSERT INTO `items` (`item_id`, `vendor_id`, `item_name`, `description`) VALUES(16, 1, 'bf7', 'some bf iyrm');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `v_id` int(11) NOT NULL,
  `menu_cat` varchar(20) NOT NULL,
  `menu_title` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  `price` float NOT NULL,
  `_range` varchar(30) NOT NULL,
  `CT` varchar(2) DEFAULT 'NO',
  `DW` varchar(2) DEFAULT 'NO',
  `BEE_BF` varchar(2) DEFAULT 'NO',
  `LB` varchar(2) DEFAULT 'NO',
  `BEE_L` varchar(2) DEFAULT 'NO',
  `BEE_D` varchar(2) DEFAULT 'NO',
  `WMP_BF` varchar(2) DEFAULT 'NO',
  `WMP_L` varchar(2) DEFAULT 'NO',
  `WMP_D` varchar(2) DEFAULT 'NO',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `v_id`, `menu_cat`, `menu_title`, `description`, `price`, `_range`, `CT`, `DW`, `BEE_BF`, `LB`, `BEE_L`, `BEE_D`, `WMP_BF`, `WMP_L`, `WMP_D`) VALUES(1, 1, 'desi', 'desi tarka', 'some desi tarka items', 200, '10-50', 'YS', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO `menus` (`menu_id`, `v_id`, `menu_cat`, `menu_title`, `description`, `price`, `_range`, `CT`, `DW`, `BEE_BF`, `LB`, `BEE_L`, `BEE_D`, `WMP_BF`, `WMP_L`, `WMP_D`) VALUES(2, 1, 'chinese', 'chinese tarka', 'some chinese tarka', 200, '10-50', 'YS', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO `menus` (`menu_id`, `v_id`, `menu_cat`, `menu_title`, `description`, `price`, `_range`, `CT`, `DW`, `BEE_BF`, `LB`, `BEE_L`, `BEE_D`, `WMP_BF`, `WMP_L`, `WMP_D`) VALUES(3, 1, 'continental', 'cont tarka', 'some cintinetanl tarka	', 250, '10-500', 'YS', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO `menus` (`menu_id`, `v_id`, `menu_cat`, `menu_title`, `description`, `price`, `_range`, `CT`, `DW`, `BEE_BF`, `LB`, `BEE_L`, `BEE_D`, `WMP_BF`, `WMP_L`, `WMP_D`) VALUES(4, 1, 'paki', 'pakistani taarka', 'some apni dishes', 540, '10-200', 'YS', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO `menus` (`menu_id`, `v_id`, `menu_cat`, `menu_title`, `description`, `price`, `_range`, `CT`, `DW`, `BEE_BF`, `LB`, `BEE_L`, `BEE_D`, `WMP_BF`, `WMP_L`, `WMP_D`) VALUES(5, 1, 'steaks', 'steaks', 'some steaks taka	', 200, '10-20', 'YS', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO `menus` (`menu_id`, `v_id`, `menu_cat`, `menu_title`, `description`, `price`, `_range`, `CT`, `DW`, `BEE_BF`, `LB`, `BEE_L`, `BEE_D`, `WMP_BF`, `WMP_L`, `WMP_D`) VALUES(6, 1, 'ajeeb', 'some ajeeb', 'ssome ajeeb menu ', 140, '10-50', 'YS', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO `menus` (`menu_id`, `v_id`, `menu_cat`, `menu_title`, `description`, `price`, `_range`, `CT`, `DW`, `BEE_BF`, `LB`, `BEE_L`, `BEE_D`, `WMP_BF`, `WMP_L`, `WMP_D`) VALUES(7, 1, 'teatime', 'lunchbox1', 'some lunch box menu', 500, '10-50', 'NO', 'YS', 'NO', 'YS', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO `menus` (`menu_id`, `v_id`, `menu_cat`, `menu_title`, `description`, `price`, `_range`, `CT`, `DW`, `BEE_BF`, `LB`, `BEE_L`, `BEE_D`, `WMP_BF`, `WMP_L`, `WMP_D`) VALUES(8, 1, 'evening', 'lunchbox2', 'some lunchbox desc', 500, '10-50', 'NO', 'YS', 'NO', 'YS', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO `menus` (`menu_id`, `v_id`, `menu_cat`, `menu_title`, `description`, `price`, `_range`, `CT`, `DW`, `BEE_BF`, `LB`, `BEE_L`, `BEE_D`, `WMP_BF`, `WMP_L`, `WMP_D`) VALUES(9, 1, 'bruch', 'lunchbox3', 'some lunchbox desc', 200, '10-50', 'NO', 'YS', 'NO', 'YS', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO `menus` (`menu_id`, `v_id`, `menu_cat`, `menu_title`, `description`, `price`, `_range`, `CT`, `DW`, `BEE_BF`, `LB`, `BEE_L`, `BEE_D`, `WMP_BF`, `WMP_L`, `WMP_D`) VALUES(10, 1, 'breakfast', 'WP breakfast1', 'weekly pick 1', 200, '10-20', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'YS', 'NO', 'NO');
INSERT INTO `menus` (`menu_id`, `v_id`, `menu_cat`, `menu_title`, `description`, `price`, `_range`, `CT`, `DW`, `BEE_BF`, `LB`, `BEE_L`, `BEE_D`, `WMP_BF`, `WMP_L`, `WMP_D`) VALUES(11, 1, 'breakfast', 'WP_breakfast2', 'weekly pick 2', 120, '10-20', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'YS', 'NO', 'NO');
INSERT INTO `menus` (`menu_id`, `v_id`, `menu_cat`, `menu_title`, `description`, `price`, `_range`, `CT`, `DW`, `BEE_BF`, `LB`, `BEE_L`, `BEE_D`, `WMP_BF`, `WMP_L`, `WMP_D`) VALUES(12, 1, 'breakfast', 'WP_breakfast3', 'weekly pick 3', 120, '10-20', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'YS', 'NO', 'NO');
INSERT INTO `menus` (`menu_id`, `v_id`, `menu_cat`, `menu_title`, `description`, `price`, `_range`, `CT`, `DW`, `BEE_BF`, `LB`, `BEE_L`, `BEE_D`, `WMP_BF`, `WMP_L`, `WMP_D`) VALUES(13, 1, 'breakfast', 'WP_breakfast4', 'weekly pick 4', 120, '10-20', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'YS', 'NO', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `menu_details`
--

DROP TABLE IF EXISTS `menu_details`;
CREATE TABLE IF NOT EXISTS `menu_details` (
  `menu_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_details`
--

INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(1, 1);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(1, 7);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(1, 9);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(1, 6);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(2, 8);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(2, 6);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(2, 4);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(2, 3);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(3, 3);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(3, 1);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(3, 2);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(3, 5);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(4, 1);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(4, 5);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(4, 2);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(4, 6);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(7, 1);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(7, 4);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(7, 5);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(7, 2);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(8, 1);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(8, 3);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(8, 6);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(8, 4);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(9, 1);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(9, 3);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(9, 4);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(9, 5);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(9, 6);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(10, 10);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(10, 11);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(10, 12);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(10, 13);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(10, 14);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(10, 15);
INSERT INTO `menu_details` (`menu_id`, `item_id`) VALUES(10, 16);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_no` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `order_details` text DEFAULT NULL,
  `customer_no` int(11) NOT NULL,
  PRIMARY KEY (`order_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `v_id` int(11) NOT NULL,
  `C` varchar(2) NOT NULL DEFAULT 'NO',
  `LB` varchar(2) NOT NULL DEFAULT 'NO',
  `DW` varchar(2) NOT NULL DEFAULT 'NO',
  `B_BF` varchar(2) NOT NULL DEFAULT 'NO',
  `B_L` varchar(2) NOT NULL DEFAULT 'NO',
  `B_D` varchar(2) NOT NULL DEFAULT 'NO',
  `SP` varchar(2) NOT NULL DEFAULT 'NO',
  `WP_BF` varchar(2) NOT NULL DEFAULT 'NO',
  `WP_L` varchar(2) NOT NULL DEFAULT 'NO',
  `WP_D` varchar(2) NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`id`),
  UNIQUE KEY `v_id` (`v_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `v_id`, `C`, `LB`, `DW`, `B_BF`, `B_L`, `B_D`, `SP`, `WP_BF`, `WP_L`, `WP_D`) VALUES(1, 1, 'YS', 'YS', 'YS', 'YS', 'YS', 'YS', 'YS', 'YS', 'YS', 'YS');
INSERT INTO `services` (`id`, `v_id`, `C`, `LB`, `DW`, `B_BF`, `B_L`, `B_D`, `SP`, `WP_BF`, `WP_L`, `WP_D`) VALUES(2, 2, 'YS', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO `services` (`id`, `v_id`, `C`, `LB`, `DW`, `B_BF`, `B_L`, `B_D`, `SP`, `WP_BF`, `WP_L`, `WP_D`) VALUES(3, 3, 'YS', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO `services` (`id`, `v_id`, `C`, `LB`, `DW`, `B_BF`, `B_L`, `B_D`, `SP`, `WP_BF`, `WP_L`, `WP_D`) VALUES(4, 4, 'YS', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');
INSERT INTO `services` (`id`, `v_id`, `C`, `LB`, `DW`, `B_BF`, `B_L`, `B_D`, `SP`, `WP_BF`, `WP_L`, `WP_D`) VALUES(5, 5, 'YS', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `vendorinfo`
--

DROP TABLE IF EXISTS `vendorinfo`;
CREATE TABLE IF NOT EXISTS `vendorinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `businessname` varchar(55) NOT NULL,
  `username` varchar(55) NOT NULL,
  `contactno` varchar(22) NOT NULL,
  `address` varchar(250) NOT NULL,
  `_status` varchar(2) NOT NULL DEFAULT 'IN',
  `pass` varchar(20) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `businessname` (`businessname`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `contactno` (`contactno`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendorinfo`
--

INSERT INTO `vendorinfo` (`id`, `businessname`, `username`, `contactno`, `address`, `_status`, `pass`, `image`) VALUES(1, 'topchef.pk', 'topchefpk', '03318064767', 'R760 sector 10 north karachi', 'AC', 'waleed123', './../');
INSERT INTO `vendorinfo` (`id`, `businessname`, `username`, `contactno`, `address`, `_status`, `pass`, `image`) VALUES(2, 'alhabib', 'habib', '012222', 'adsda', 'AC', 'habib123', 'http://topchef.pk/assets/img/static/download.jpg');
INSERT INTO `vendorinfo` (`id`, `businessname`, `username`, `contactno`, `address`, `_status`, `pass`, `image`) VALUES(3, 'kababjees', 'kababjees', '23132123', 'we2434wewewe', 'AC', 'kabab123', 'http://topchef.pk/assets/img/static/download.jpg');
INSERT INTO `vendorinfo` (`id`, `businessname`, `username`, `contactno`, `address`, `_status`, `pass`, `image`) VALUES(4, 'ejaz pakwan', 'ejaz', '3232382', '3r442rrr32', 'AC', 'www222', 'http://topchef.pk/assets/img/static/download.jpg');
INSERT INTO `vendorinfo` (`id`, `businessname`, `username`, `contactno`, `address`, `_status`, `pass`, `image`) VALUES(5, 'Al Haj Akhtar', 'AlHaj', '2313810391', 'R4343 ewew 3323ed ', 'AC', 'alhaj123', 'http://topchef.pk/assets/img/static/download.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_menu_details`
--

DROP TABLE IF EXISTS `weekly_menu_details`;
CREATE TABLE IF NOT EXISTS `weekly_menu_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `mon` int(11) NOT NULL,
  `tues` int(11) NOT NULL,
  `wed` int(11) NOT NULL,
  `thurs` int(11) NOT NULL,
  `fri` int(11) NOT NULL,
  `sat` int(11) NOT NULL,
  `sun` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weekly_menu_details`
--

INSERT INTO `weekly_menu_details` (`id`, `menu_id`, `mon`, `tues`, `wed`, `thurs`, `fri`, `sat`, `sun`) VALUES(1, 10, 10, 11, 12, 13, 14, 15, 16);
INSERT INTO `weekly_menu_details` (`id`, `menu_id`, `mon`, `tues`, `wed`, `thurs`, `fri`, `sat`, `sun`) VALUES(2, 11, 11, 15, 14, 13, 12, 11, 11);
INSERT INTO `weekly_menu_details` (`id`, `menu_id`, `mon`, `tues`, `wed`, `thurs`, `fri`, `sat`, `sun`) VALUES(3, 12, 11, 13, 15, 12, 14, 16, 10);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
