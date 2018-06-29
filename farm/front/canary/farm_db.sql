-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 28, 2018 at 04:27 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyer_tbl`
--

/*DROP TABLE IF EXISTS `buyer_tbl`;*/
/*CREATE TABLE IF NOT EXISTS `buyer_tbl` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `joinDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `salt` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `mobile_no` (`mobile_no`),
  UNIQUE KEY `username` (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=100008 DEFAULT CHARSET=latin1;*/

--
-- Dumping data for table `buyer_tbl`
--
/*
INSERT INTO `buyer_tbl` (`user_id`, `joinDate`, `salt`, `password_hash`, `first_name`, `last_name`, `mobile_no`, `dob`, `email`, `delivery_address`) VALUES
(100003, '2018-06-08 07:57:08', '27376c0418d38758a63e363ddbe7f5f91e8448587699f499cd9f5b3285574779', 'e6809fb9698ec5150a38a2298d3f69a64ff72f425957ed4241efd9fa8b0fe6b6', 'Beta', 'B', '9834274891', '2016-03-02', 'beta@gmail.sample', 'beta home'),
(100004, '2018-06-08 08:22:48', '32f503b772c84d8dacf621f38cc5dbf601fb3d48a30e84844423cee1a10ed35a', '2b6516ce478a7aeb75f27320ae3ed0167e82878393dd325693c3bd2ce86a6d67', 'Epsilon', 'E', '9028389230', '2016-03-06', 'epsilon@tired.of.this', 'epsilons home'),
(100005, '2018-06-15 06:50:21', '9522ba0e97461bb6f4ad1bdd3dd1bb903387c983427a03f413e6c7ae271606ae', 'caf92aa4822fed4006575f66f005c1e4088bed35a5cc645f5fb13fa4dea1ab51', 'Eta', 'H', '9832477433', '2018-06-15', 'eta@rand.gov', 'some random place,\nsome random street-123213'),
(100006, '2018-06-15 14:14:22', '39f4b28ab815cb1a50a9d6760f22280a5f4d28d7617fafa9617ac125bee1a40b', '2cbb09fe9a24ae152a2e18e22054a7ec4cfbce0bdbf40b86c917ae52a30796a8', 'Theta', 'Th', '9821188757', '1997-03-12', 'theta@greek', 'what does it matter now?'),
(100007, '2018-06-15 15:16:51', '21ac15500aceae3b432cdf942f6250dfad61139ef6330bd49d1dd0a90db9c176', 'f5224175e5c774c1b2dddbd68c0af1e8adb4d0532ab267f45d7690b3cc49aba8', 'Iota', 'I', '8932489324', '2015-11-15', 'iota@buy', 'some rand loc2');
*/
-- --------------------------------------------------------

--
-- Table structure for table `farmer_data_tbl`
--

/*DROP TABLE IF EXISTS `farmer_data_tbl`;
CREATE TABLE IF NOT EXISTS `farmer_data_tbl` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `tm00` float NOT NULL DEFAULT '1',
  `tm01` float NOT NULL DEFAULT '0',
  `tm02` float NOT NULL DEFAULT '0',
  `tm10` float NOT NULL DEFAULT '0',
  `tm11` float NOT NULL DEFAULT '1',
  `tm12` float NOT NULL DEFAULT '0',
  `tm20` float NOT NULL DEFAULT '0',
  `tm21` float NOT NULL DEFAULT '0',
  `tm22` float NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
*/
--
-- Dumping data for table `farmer_data_tbl`
--
/*
INSERT INTO `farmer_data_tbl` (`user_id`, `tm00`, `tm01`, `tm02`, `tm10`, `tm11`, `tm12`, `tm20`, `tm21`, `tm22`) VALUES
(100007, 1, 0, 0, 0, 1, 0, 0, 0, 1),
(100009, 1, 0, 0, 0, 1, 0, 0, 0, 1);
*/
-- --------------------------------------------------------

--
-- Table structure for table `farmer_tbl`
--

/*DROP TABLE IF EXISTS `farmer_tbl`;*/
/*CREATE TABLE IF NOT EXISTS `farmer_tbl` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `joinDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `salt` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pickup_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `mobile_no` (`mobile_no`),
  UNIQUE KEY `username` (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=100014 DEFAULT CHARSET=latin1;
*/
--
-- Dumping data for table `farmer_tbl`
--
/*
INSERT INTO `farmer_tbl` (`user_id`, `joinDate`, `salt`, `password_hash`, `first_name`, `last_name`, `mobile_no`, `dob`, `email`, `pickup_address`) VALUES
(100007, '2018-06-07 10:36:01', '5174d572ccf86ecd96e10ca10350f4eee83f6b6142ef079c54ca22b6272cfb70', '598010732d91b34027a340acec49df003c1e60b001628f0cef2f235b941acf75', 'Alpha', 'A', '8293470345', '1995-02-01', 'alpha@farm', 'Alpha farm,\nDistrict A - x01'),
(100008, '2018-06-08 08:18:22', 'cd9f0102ac14aecf0dcd88cd90f9f71abf3f856db403d72bda6f3c14590e41bf', '7facb13330f4f9f661e5f856fe6f5e536500f4469500b43519107186b40a1c1d', 'Gamma', 'C', '9218379182', '2015-04-06', 'gamma@sample.org', 'gamma farm'),
(100009, '2018-06-08 08:20:57', '52441f976e3f7c4c08342e16b348ecb8d3587c4ab1132e85aaf389f92a1883aa', '1b4702c328a7210b5cef5db2e10b50e9af143bd70b08b9c46824c59e8dcaa9f2', 'Delta', 'D', '0938012212', '2016-04-06', 'delta@gov.rand', 'delta@farm'),
(100011, '2018-06-14 23:59:28', '3d9bddba8691b5f3aca0f28c7aa2cfcca661b00db09227a1c391769b4d7cedc7', '8ab9abe7dd3798d370d599031faa0473a0da46894e233bd2e51b6316f9d87ab8', 'Phi', 'F', '9821188757', '2018-06-14', 'phi@farm.org', 'farm@phi'),
(100013, '2018-06-15 15:25:19', '507281a6f34bae86d44a2ef69a29fb7ae9c35fd0e26769785ced74b91c692eaf', '41f42e4867318fa22927c3fdf5a0180e8c3788289106725b91d1d52d5da2f548', 'Kappa', 'K', '9876543219', '0000-00-00', '', 'k farm');
*/
-- --------------------------------------------------------

--
-- Table structure for table `orders_placed`
--

DROP TABLE IF EXISTS `orders_placed`;
CREATE TABLE IF NOT EXISTS `orders_placed` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT,
  `food` text NOT NULL,
  `category` text NOT NULL,
  `Cost` int(11) NOT NULL,
  `A` int(11) NOT NULL,
  `B` int(11) NOT NULL,
  `C` int(11) NOT NULL,
  `date_harvest` date NOT NULL,
  `date_deliver` date NOT NULL,
  `image_path` text NOT NULL,
  PRIMARY KEY (`orderid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_placed`
--
/*
INSERT INTO `orders_placed` (`orderid`, `food`, `category`, `Cost`, `A`, `B`, `C`, `date_harvest`, `date_deliver`, `image_path`) VALUES
(1, 'kela', 'fruits', 1, 2, 4, 5, '2018-06-19', '2018-06-07', 'skoo7'),
(2, 'kela', 'fruits', 4, 1, 2, 3, '2018-01-02', '2018-01-03', 'sk007'),
(3, 'kela', 'fruits', 4, 1, 2, 3, '2018-01-02', '2018-01-03', 'sk127'),
(4, 'kela', 'fruits', 4, 1, 2, 3, '2018-01-02', '2018-01-03', 'sk127'),
(5, 'kela', 'fruits', 4, 1, 2, 3, '2018-01-02', '2018-01-03', 'sk127'),
(6, 'kela', 'fruits', 4, 1, 2, 3, '1970-01-01', '1970-01-01', 'sk127'),
(7, '', '', 5, 1, 2, 34, '1970-01-01', '1970-01-01', 'sk127'),
(8, '', '', 5, 1, 2, 34, '1970-01-01', '1970-01-01', 'sk127'),
(9, '', '', 5, 1, 3, 4, '1970-01-01', '1970-01-01', ''),
(10, '', '', 5, 1, 3, 4, '1970-01-01', '1970-01-01', ''),
(11, '', '', 5, 1, 3, 4, '1970-01-01', '1970-01-01', ''),
(12, '', '', 5, 1, 3, 4, '2018-06-11', '2018-06-14', ''),
(13, '', 'fruits', 5, 1, 3, 4, '2018-06-11', '2018-06-14', ''),
(14, '', '', 5, 1, 2, 34, '1970-01-01', '1970-01-01', 'sk127'),
(15, 'kela', 'fruits', 5, 1, 3, 4, '2018-06-11', '2018-06-14', ''),
(16, 'kela', 'fruits', 5, 1, 3, 4, '2018-06-11', '2018-06-14', 'vlcsnap-2018-01-01-22h31m48s417.png'),
(17, 'kela', 'fruits', 5, 1, 3, 4, '2018-06-11', '2018-06-14', 'IMG_20171013_160951714_HDR.jpg');
*/
--
-- Constraints for dumped tables
--

--
-- Constraints for table `farmer_data_tbl`
--
/*
ALTER TABLE `farmer_data_tbl`
  ADD CONSTRAINT `farmer_data_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `farmer_tbl` (`user_id`);*/
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
