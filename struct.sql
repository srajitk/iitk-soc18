-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2018 at 06:27 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

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

CREATE TABLE `buyer_tbl` (
 `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `joinDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `salt` varchar(255) DEFAULT NULL,
 `salt1` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=8193 DEFAULT CHARSET=latin1

CREATE TABLE `farmer_tbl` (
 `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `joinDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `salt` varchar(255) DEFAULT NULL,
 `salt1` varchar(255) DEFAULT NULL,
 `password_hash` varchar(255) DEFAULT NULL,
 `first_name` varchar(255) NOT NULL,
 `last_name` varchar(255) NOT NULL,
 `mobile_no` varchar(255) NOT NULL,
 `dob` date NOT NULL,
 `email` varchar(255) DEFAULT NULL,
 `pickup_address` varchar(255) DEFAULT NULL,
 `sellcontracts` int(11) NOT NULL DEFAULT '0',
 `tm00` float NOT NULL DEFAULT '1',
 `tm01` float NOT NULL DEFAULT '0',
 `tm02` float NOT NULL DEFAULT '0',
 `tm10` float NOT NULL DEFAULT '0',
 `tm11` float NOT NULL DEFAULT '1',
 `tm12` float NOT NULL DEFAULT '0',
 `tm20` float NOT NULL DEFAULT '0',
 `tm21` float NOT NULL DEFAULT '0',
 `tm22` float NOT NULL DEFAULT '1',
 `tm30` int(11) NOT NULL DEFAULT '0',
 `tm31` int(11) NOT NULL DEFAULT '0',
 `tm32` int(11) NOT NULL DEFAULT '0',
 `value` int(11) NOT NULL DEFAULT '1',
 PRIMARY KEY (`user_id`),
 UNIQUE KEY `mobile_no` (`mobile_no`),
 UNIQUE KEY `username` (`user_id`),
 UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4096 DEFAULT CHARSET=latin1

CREATE TABLE `item_details_tbl` (
 `item_no` smallint(3) unsigned NOT NULL,
 `file_name` varchar(33) NOT NULL,
 `image_name` varchar(29) NOT NULL,
 `name_line1` varchar(18) NOT NULL,
 `name_line2` varchar(18) DEFAULT NULL,
 `tab_no` int(1) NOT NULL,
 `tab_name` varchar(32) DEFAULT NULL,
 `size` decimal(3,2) DEFAULT NULL,
 `avlbl` int(1) DEFAULT NULL,
 `avlbl_1wk` int(1) DEFAULT NULL,
 `qty_slab_no` int(1) DEFAULT NULL,
 `qty_slab_name` varchar(32) DEFAULT NULL,
 `price_q1` int(3) DEFAULT NULL,
 `q2` decimal(3,1) DEFAULT NULL,
 `price_q2` int(3) DEFAULT NULL,
 `default_qty` int(1) DEFAULT NULL,
 `m_qty` int(1) DEFAULT NULL,
 PRIMARY KEY (`item_no`),
 UNIQUE KEY `file_name` (`file_name`),
 UNIQUE KEY `image_name` (`image_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

CREATE TABLE `orders_placed` (
 `orderid` int(11) NOT NULL AUTO_INCREMENT,
 `farmer_id` int(10) unsigned NOT NULL,
 `food` varchar(32) NOT NULL,
 `Cost` int(11) NOT NULL,
 `transport` tinyint(1) NOT NULL DEFAULT '0',
 `A` int(11) NOT NULL,
 `B` int(11) NOT NULL,
 `C` int(11) NOT NULL,
 `date_harvest` datetime NOT NULL,
 `date_deliver` datetime NOT NULL,
 `image_path` varchar(255) DEFAULT NULL,
 `pre_img_val` tinyint(3) unsigned DEFAULT NULL,
 `rank_in_q` int(11) DEFAULT NULL,
 PRIMARY KEY (`orderid`),
 KEY `farmer_id` (`farmer_id`),
 CONSTRAINT `orders_placed_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `farmer_tbl` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16384 DEFAULT CHARSET=latin1

CREATE TABLE `buy_contracts_tbl` (
 `contract_id` int(11) NOT NULL AUTO_INCREMENT,
 `buyer_id` int(10) unsigned NOT NULL,
 `fv_id` smallint(3) unsigned NOT NULL,
 `Date` date NOT NULL,
 `qty` int(11) NOT NULL,
 `category` set('a','b','c') NOT NULL DEFAULT 'b',
 `Amount` int(11) NOT NULL,
 `delivered` tinyint(1) NOT NULL DEFAULT '0',
 PRIMARY KEY (`contract_id`),
 KEY `buyer_withdrawal` (`buyer_id`),
 KEY `item_withdrawal` (`fv_id`),
 CONSTRAINT `buyer_withdrawal` FOREIGN KEY (`buyer_id`) REFERENCES `buyer_tbl` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `item_withdrawal` FOREIGN KEY (`fv_id`) REFERENCES `item_details_tbl` (`item_no`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1

