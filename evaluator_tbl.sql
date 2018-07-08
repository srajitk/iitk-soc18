-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 08, 2018 at 02:27 AM
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
-- Table structure for table `evaluator_tbl`
--

DROP TABLE IF EXISTS `evaluator_tbl`;
CREATE TABLE IF NOT EXISTS `evaluator_tbl` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `joinDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `salt` varchar(255) DEFAULT NULL,
  `salt1` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `reside_address` varchar(255) DEFAULT NULL,
  `img_mean` int(11) DEFAULT NULL,
  `img_sd` int(11) DEFAULT NULL,
  `eval_val` int(11) DEFAULT NULL,
  `no_eval` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `mobile_no` (`mobile_no`),
  UNIQUE KEY `username` (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluator_tbl`
--

INSERT INTO `evaluator_tbl` (`user_id`, `joinDate`, `salt`, `salt1`, `password_hash`, `first_name`, `last_name`, `mobile_no`, `dob`, `email`, `reside_address`, `img_mean`, `img_sd`, `eval_val`, `no_eval`) VALUES
(1, '2018-07-07 13:09:50', 'aa9404274ae7665fb6944aa33b7703192a5e88daef4a9dafdde8759b2b644645', NULL, NULL, 'Alpha', 'Zeta', '1234567890', '1997-07-23', 'alpha@alpha', 'Aas, addf, afag', 0, 0, NULL, NULL),
(2, '2018-07-07 13:12:10', '980ef4ba93062b81b05333f3be0417013e2fc0cec0149a44546ae68767986ea7', '7b5313d90cf4ba95ab170765350c5a3e0b0213e05c44830c4e094113f4043c27', '2d88d92699e00ad808db282e95c438f8066827a2d9e2a0637ae89186194893e9', 'Shobhit ', 'Jagga', '9213454321', '1997-07-22', 'jagga@iitk', 'asd,kijc,sdijci', 0, 0, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
