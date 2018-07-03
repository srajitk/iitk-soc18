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
  `user_id` int(10) UNSIGNED NOT NULL,
  `joinDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `salt` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyer_tbl`
--

INSERT INTO `buyer_tbl` (`user_id`, `joinDate`, `salt`, `password_hash`, `first_name`, `last_name`, `mobile_no`, `dob`, `email`, `delivery_address`) VALUES
(100003, '2018-06-08 07:57:08', '27376c0418d38758a63e363ddbe7f5f91e8448587699f499cd9f5b3285574779', 'e6809fb9698ec5150a38a2298d3f69a64ff72f425957ed4241efd9fa8b0fe6b6', 'Beta', 'B', '9834274891', '2016-03-02', 'beta@gmail.sample', 'beta home'),
(100004, '2018-06-08 08:22:48', '32f503b772c84d8dacf621f38cc5dbf601fb3d48a30e84844423cee1a10ed35a', '2b6516ce478a7aeb75f27320ae3ed0167e82878393dd325693c3bd2ce86a6d67', 'Epsilon', 'E', '9028389230', '2016-03-06', 'epsilon@tired.of.this', 'epsilons home'),
(100005, '2018-06-15 06:50:21', '9522ba0e97461bb6f4ad1bdd3dd1bb903387c983427a03f413e6c7ae271606ae', 'caf92aa4822fed4006575f66f005c1e4088bed35a5cc645f5fb13fa4dea1ab51', 'Eta', 'H', '9832477433', '2018-06-15', 'eta@rand.gov', 'some random place,\nsome random street-123213'),
(100007, '2018-06-15 15:16:51', '21ac15500aceae3b432cdf942f6250dfad61139ef6330bd49d1dd0a90db9c176', 'f5224175e5c774c1b2dddbd68c0af1e8adb4d0532ab267f45d7690b3cc49aba8', 'Iota', 'I', '8932489324', '2015-11-15', 'iota@buy', 'some rand loc2');

-- --------------------------------------------------------

--
-- Table structure for table `buy_contracts_tbl`
--

CREATE TABLE `buy_contracts_tbl` (
  `contract_id` int(11) NOT NULL,
  `buyer_id` int(10) UNSIGNED NOT NULL,
  `fv_id` smallint(3) UNSIGNED NOT NULL,
  `Date` date NOT NULL,
  `qty` int(11) NOT NULL,
  `category` set('a','b','c') NOT NULL DEFAULT 'b',
  `Amount` int(11) NOT NULL,
  `delivered` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buy_contracts_tbl`
--

INSERT INTO `buy_contracts_tbl` (`contract_id`, `buyer_id`, `fv_id`, `Date`, `qty`, `category`, `Amount`, `delivered`) VALUES
(1, 100003, 4, '2018-07-17', 1, 'a', 0, 0),
(2, 100003, 56, '2018-07-17', 1, 'a', 0, 0),
(3, 100003, 104, '2018-07-17', 1, 'a', 0, 0),
(4, 100003, 192, '2018-07-17', 500, 'a', 0, 0),
(5, 100003, 195, '2018-07-17', 500, 'a', 0, 0),
(6, 100007, 21, '2018-07-18', 500, 'b', 0, 0),
(7, 100007, 55, '2018-07-18', 500, 'b', 0, 0),
(8, 100007, 118, '2018-07-18', 500, 'b', 0, 0),
(9, 100005, 180, '2018-07-09', 5, 'a', 0, 0),
(10, 100005, 197, '2018-07-09', 3, 'a', 0, 0),
(11, 100005, 196, '2018-07-09', 1, 'a', 0, 0),
(12, 100005, 195, '2018-07-09', 500, 'a', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `farmer_tbl`
--

CREATE TABLE `farmer_tbl` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `joinDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `salt` varchar(255) DEFAULT NULL,
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
  `value` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmer_tbl`
--

INSERT INTO `farmer_tbl` (`user_id`, `joinDate`, `salt`, `password_hash`, `first_name`, `last_name`, `mobile_no`, `dob`, `email`, `pickup_address`, `sellcontracts`, `tm00`, `tm01`, `tm02`, `tm10`, `tm11`, `tm12`, `tm20`, `tm21`, `tm22`, `value`) VALUES
(100007, '2018-06-07 10:36:01', '5174d572ccf86ecd96e10ca10350f4eee83f6b6142ef079c54ca22b6272cfb70', '598010732d91b34027a340acec49df003c1e60b001628f0cef2f235b941acf75', 'Alpha', 'A', '8293470345', '1995-02-01', 'alpha@farm', 'Alpha farm,\nDistrict A - x01', 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 1),
(100008, '2018-06-08 08:18:22', 'cd9f0102ac14aecf0dcd88cd90f9f71abf3f856db403d72bda6f3c14590e41bf', '7facb13330f4f9f661e5f856fe6f5e536500f4469500b43519107186b40a1c1d', 'Gamma', 'C', '9218379182', '2015-04-06', 'gamma@sample.org', 'gamma farm', 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 1),
(100009, '2018-06-08 08:20:57', '52441f976e3f7c4c08342e16b348ecb8d3587c4ab1132e85aaf389f92a1883aa', '1b4702c328a7210b5cef5db2e10b50e9af143bd70b08b9c46824c59e8dcaa9f2', 'Delta', 'D', '0938012212', '2016-04-06', 'delta@gov.rand', 'delta@farm', 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 1),
(100011, '2018-06-14 23:59:28', '3d9bddba8691b5f3aca0f28c7aa2cfcca661b00db09227a1c391769b4d7cedc7', '8ab9abe7dd3798d370d599031faa0473a0da46894e233bd2e51b6316f9d87ab8', 'Phi', 'F', '9821188757', '2018-06-14', 'phi@farm.org', 'farm@phi', 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 1),
(100015, '2018-06-25 08:38:44', '6f21bb831b9eac4de7add0eb40a54189e9ba8e61dc59e3f364ef95ca3462d938', '028b823d1af7dd153f7021f0b7aa2d0a89746e5188d0c55100b368703e4d5e6a', 'Kappa', 'K', '9868110215', '1988-12-23', 'kappa@farm', 'kappa farm', 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_details_tbl`
--

CREATE TABLE `item_details_tbl` (
  `item_no` smallint(3) UNSIGNED NOT NULL,
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
  `m_qty` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_details_tbl`
--

INSERT INTO `item_details_tbl` (`item_no`, `file_name`, `image_name`, `name_line1`, `name_line2`, `tab_no`, `tab_name`, `size`, `avlbl`, `avlbl_1wk`, `qty_slab_no`, `qty_slab_name`, `price_q1`, `q2`, `price_q2`, `default_qty`, `m_qty`) VALUES
(1, 'fv_f_anar.jpg', 'fv_f_anar', 'Pomegranate', 'Anar', 2, 'fruitsMedium', '1.30', 1, 1, 0, 'kg', 120, '5.0', 500, 1, 0),
(2, 'fv_f_apple_american.jpg', 'fv_f_apple_american', 'Apple', 'American', 2, 'fruitsMedium', '1.05', 1, 1, 0, 'kg', 160, '5.0', 750, 1, 0),
(3, 'fv_f_apple_chaubattiya_anupam.jpg', 'fv_f_apple_chaubattiya_anupam', 'Apple', 'Chaubattiya Anupam', 2, 'fruitsMedium', '1.20', 0, 1, 0, 'kg', 80, '5.0', 320, 1, 0),
(4, 'fv_f_apple_chinese.jpg', 'fv_f_apple_chinese', 'Apple', 'Chinese', 2, 'fruitsMedium', '1.00', 1, 1, 0, 'kg', 190, '5.0', 850, 1, 0),
(5, 'fv_f_apple_golden.jpg', 'fv_f_apple_golden', 'Apple', 'Golden', 2, 'fruitsMedium', '1.00', 0, 1, 0, 'kg', 140, '5.0', 600, 1, 0),
(6, 'fv_f_apple_green.jpg', 'fv_f_apple_green', 'Apple', 'Green', 2, 'fruitsMedium', '1.00', 0, 1, 0, 'kg', 140, '5.0', 600, 1, 0),
(7, 'fv_f_apple_kinnaur.jpg', 'fv_f_apple_kinnaur', 'Apple', 'Kinnaur', 2, 'fruitsMedium', '1.00', 1, 1, 0, 'kg', 100, '5.0', 450, 1, 0),
(8, 'fv_f_apple_lal_ambri.jpg', 'fv_f_apple_lal_ambri', 'Apple', 'Lalambri', 2, 'fruitsMedium', '1.00', 0, 1, 0, 'kg', 90, '5.0', 400, 1, 0),
(9, 'fv_f_apple_mcintosh.jpg', 'fv_f_apple_mcintosh', 'Apple', 'Mcintosh', 2, 'fruitsMedium', '1.00', 0, 1, 0, 'kg', 110, '5.0', 500, 1, 0),
(10, 'fv_f_apricot.jpg', 'fv_f_apricot', 'Apricot', '', 3, 'fruitsSmall', '1.00', 0, 1, 2, 'g', 100, '4.0', 360, 1, 0),
(11, 'fv_f_avocado.jpg', 'fv_f_avocado', 'Avocado', '', 2, 'fruitsMedium', '1.20', 0, 1, 2, 'g', 80, '4.0', 300, 1, 0),
(12, 'fv_f_banana.jpg', 'fv_f_banana', 'Banana', '', 1, 'fruitsLarge', '2.00', 1, 1, 3, 'dz', 50, '5.0', 225, 1, 0),
(13, 'fv_f_banana_red.jpg', 'fv_f_banana_red', 'Banana', 'Red', 2, 'fruitsMedium', '1.50', 0, 1, 3, 'dz', 60, '5.0', 250, 1, 0),
(14, 'fv_f_banana_small.jpg', 'fv_f_banana_small', 'Banana', 'Small', 3, 'fruitsSmall', '2.00', 1, 1, 3, 'dz', 30, '5.0', 130, 1, 0),
(15, 'fv_f_bel.jpg', 'fv_f_bel', 'Bel', '', 1, 'fruitsLarge', '2.00', 0, 0, 0, 'kg', 40, '5.0', 160, 1, 0),
(16, 'fv_f_ber.jpg', 'fv_f_ber', 'Ber', '', 3, 'fruitsSmall', '1.20', 1, 0, 2, 'g', 30, '4.0', 100, 1, 0),
(17, 'fv_f_chiku.jpg', 'fv_f_chiku', 'Chiku', '', 3, 'fruitsSmall', '1.00', 1, 1, 0, 'kg', 60, '5.0', 250, 1, 0),
(18, 'fv_f_coconut.jpg', 'fv_f_coconut', 'Coconut', '', 1, 'fruitsLarge', '1.70', 1, 1, 4, 'pc', 35, '5.0', 150, 1, 0),
(19, 'fv_f_dab.jpg', 'fv_f_dab', 'Dab', '', 1, 'fruitsLarge', '1.80', 1, 1, 4, 'pc', 35, '10.0', 300, 1, 0),
(20, 'fv_f_dates.jpg', 'fv_f_dates', 'Dates', '', 3, 'fruitsSmall', '1.00', 1, 1, 6, 'pkt', 150, '4.0', 520, 1, 0),
(21, 'fv_f_gooseberry_cape.jpg', 'fv_f_gooseberry_cape', 'Gooseberry Cape', 'Rasbhari', 3, 'fruitsSmall', '1.21', 1, 1, 2, 'g', 50, '4.0', 160, 1, 0),
(22, 'fv_f_grapefruit.jpg', 'fv_f_grapefruit', 'Grape Fruit', '', 2, 'fruitsMedium', '1.60', 0, 1, 0, 'kg', 250, '2.0', 450, 1, 0),
(23, 'fv_f_grapes_black.jpg', 'fv_f_grapes_black', 'Grapes', 'Black', 3, 'fruitsSmall', '1.50', 0, 1, 0, 'kg', 150, '2.5', 300, 1, 0),
(24, 'fv_f_grapes_green.jpg', 'fv_f_grapes_green', 'Grapes', 'Green', 3, 'fruitsSmall', '1.50', 1, 1, 0, 'kg', 120, '2.5', 225, 1, 0),
(25, 'fv_f_grapes_red.jpg', 'fv_f_grapes_red', 'Grapes', 'Red - Small', 3, 'fruitsSmall', '1.35', 1, 1, 0, 'kg', 140, '2.5', 300, 1, 0),
(26, 'fv_f_grapes_red_big.jpg', 'fv_f_grapes_red_big', 'Grapes', 'Red - Big', 3, 'fruitsSmall', '1.80', 1, 1, 0, 'kg', 280, '2.5', 575, 1, 0),
(27, 'fv_f_guava.jpg', 'fv_f_guava', 'Guava', '', 2, 'fruitsMedium', '1.12', 1, 1, 0, 'kg', 80, '5.0', 325, 1, 0),
(28, 'fv_f_keenu_orange.jpg', 'fv_f_keenu_orange', 'Keenu Orange', '', 2, 'fruitsMedium', '1.60', 1, 1, 0, 'kg', 120, '5.0', 500, 1, 0),
(29, 'fv_f_kiwi.jpg', 'fv_f_kiwi', 'Kiwi', '', 3, 'fruitsSmall', '1.00', 1, 1, 0, 'kg', 100, '2.0', 180, 1, 0),
(30, 'fv_f_litchi.jpg', 'fv_f_litchi', 'Litchi', '', 3, 'fruitsSmall', '0.63', 0, 0, 0, 'kg', 120, '2.5', 240, 1, 0),
(31, 'fv_f_mango_alphonso_ratnagiri.jpg', 'fv_f_mango_alphonso_ratnagiri', 'Mango', 'Alphonso Ratnagiri', 1, 'fruitsLarge', '1.10', 0, 0, 0, 'kg', 180, '5.0', 800, 1, 0),
(32, 'fv_f_mango_badami_karnataka.jpg', 'fv_f_mango_badami_karnataka', 'Mango', 'Badami Karnataka', 1, 'fruitsLarge', '1.10', 0, 0, 0, 'kg', 60, '5.0', 225, 1, 0),
(33, 'fv_f_mango_chausa.jpg', 'fv_f_mango_chausa', 'Mango', 'Chausa', 1, 'fruitsLarge', '1.68', 0, 0, 0, 'kg', 100, '5.0', 425, 1, 0),
(34, 'fv_f_mango_dusheri.jpg', 'fv_f_mango_dusheri', 'Mango', 'Dusheri', 1, 'fruitsLarge', '2.00', 0, 0, 0, 'kg', 80, '5.0', 350, 1, 0),
(35, 'fv_f_mango_himsagar.jpg', 'fv_f_mango_himsagar', 'Mango', 'Himsagar', 1, 'fruitsLarge', '1.85', 0, 0, 0, 'kg', 60, '5.0', 250, 1, 0),
(36, 'fv_f_mango_kesar_gujarat.jpg', 'fv_f_mango_kesar_gujarat', 'Mango', 'Kesar Gujarat', 1, 'fruitsLarge', '1.50', 0, 0, 0, 'kg', 50, '5.0', 200, 1, 0),
(37, 'fv_f_mango_langra_malda.jpg', 'fv_f_mango_langra_malda', 'Mango', 'Langra / Malda', 1, 'fruitsLarge', '1.40', 0, 0, 0, 'kg', 70, '5.0', 300, 1, 0),
(38, 'fv_f_mango_neelam.jpg', 'fv_f_mango_neelam', 'Mango', 'Neelam', 1, 'fruitsLarge', '1.80', 0, 0, 0, 'kg', 60, '5.0', 240, 1, 0),
(39, 'fv_f_mango_raspuri_karnataka.jpg', 'fv_f_mango_raspuri_karnataka', 'Mango', 'Raspuri Karnataka', 1, 'fruitsLarge', '1.80', 0, 0, 0, 'kg', 40, '5.0', 160, 1, 0),
(40, 'fv_f_mango_safeda.jpg', 'fv_f_mango_safeda', 'Mango', 'Safeda', 1, 'fruitsLarge', '1.36', 0, 0, 0, 'kg', 70, '5.0', 300, 1, 0),
(41, 'fv_f_mango_totapuri.jpg', 'fv_f_mango_totapuri', 'Mango', 'Totapuri', 1, 'fruitsLarge', '1.50', 0, 0, 0, 'kg', 40, '5.0', 180, 1, 0),
(42, 'fv_f_melon_cantaloupe.jpg', 'fv_f_melon_cantaloupe', 'Melon', 'Cantaloupe', 1, 'fruitsLarge', '2.00', 1, 1, 0, 'kg', 70, '5.0', 300, 1, 0),
(43, 'fv_f_melon_honeydew.jpg', 'fv_f_melon_honeydew', 'Melon', 'Honeydew', 1, 'fruitsLarge', '2.00', 1, 1, 0, 'kg', 80, '5.0', 340, 1, 0),
(44, 'fv_f_melon_kajari.jpg', 'fv_f_melon_kajari', 'Melon', 'Kajari', 1, 'fruitsLarge', '1.80', 1, 1, 0, 'kg', 60, '5.0', 250, 1, 0),
(45, 'fv_f_melon_sharada.jpg', 'fv_f_melon_sharada', 'Melon', 'Sharada', 1, 'fruitsLarge', '2.00', 1, 1, 0, 'kg', 60, '5.0', 250, 1, 0),
(46, 'fv_f_mosambi.jpg', 'fv_f_mosambi', 'Mosambi', '', 2, 'fruitsMedium', '1.00', 1, 1, 0, 'kg', 40, '5.0', 175, 1, 0),
(47, 'fv_f_naak.jpg', 'fv_f_naak', 'Naak', '', 3, 'fruitsSmall', '1.15', 1, 1, 0, 'kg', 70, '5.0', 300, 1, 0),
(48, 'fv_f_orange.jpg', 'fv_f_orange', 'Orange', '', 2, 'fruitsMedium', '0.95', 1, 1, 0, 'kg', 100, '5.0', 440, 1, 0),
(49, 'fv_f_orange_indian.jpg', 'fv_f_orange_indian', 'Orange', 'Nagpur', 2, 'fruitsMedium', '1.40', 1, 1, 0, 'kg', 60, '5.0', 250, 1, 0),
(50, 'fv_f_papaya.jpg', 'fv_f_papaya', 'Papaya', '', 1, 'fruitsLarge', '2.00', 1, 1, 0, 'kg', 40, '5.0', 150, 1, 0),
(51, 'fv_f_peach.jpg', 'fv_f_peach', 'Peach', '', 2, 'fruitsMedium', '0.75', 1, 1, 0, 'kg', 100, '2.0', 180, 1, 0),
(52, 'fv_f_pear.jpg', 'fv_f_pear', 'Pear', '', 2, 'fruitsMedium', '1.00', 1, 1, 0, 'kg', 180, '2.5', 375, 1, 0),
(53, 'fv_f_pear_golden.jpg', 'fv_f_pear_golden', 'Pear', 'Golden', 2, 'fruitsMedium', '1.10', 1, 1, 0, 'kg', 140, '2.5', 300, 1, 0),
(54, 'fv_f_pineapple.jpg', 'fv_f_pineapple', 'Pineapple', '', 1, 'fruitsLarge', '2.00', 1, 1, 4, 'pc', 100, '5.0', 400, 1, 0),
(55, 'fv_f_redcherry.jpg', 'fv_f_redcherry', 'Cherry', '', 3, 'fruitsSmall', '2.00', 0, 1, 2, 'g', 60, '4.0', 200, 1, 0),
(56, 'fv_f_sharifa.jpg', 'fv_f_sharifa', 'Sharifa', '', 2, 'fruitsMedium', '1.00', 0, 1, 0, 'kg', 100, '5.0', 400, 1, 0),
(57, 'fv_f_strawberry.jpg', 'fv_f_strawberry', 'Strawberry', '', 3, 'fruitsSmall', '1.50', 0, 1, 2, 'g', 60, '4.0', 200, 1, 0),
(58, 'fv_f_watermelon.jpg', 'fv_f_watermelon', 'Watermelon', '', 1, 'fruitsLarge', '2.00', 1, 1, 0, 'kg', 30, '10.0', 250, 1, 0),
(81, 'fv_v_african_yam.jpg', 'fv_v_african_yam', 'African Yam', '', 4, 'potatoGourds', '1.80', 1, 1, 0, 'kg', 40, '2.5', 90, 1, 0),
(82, 'fv_v_ambada.jpg', 'fv_v_ambada', 'Ambada', '', 9, 'flavourVeg', '1.30', 1, 1, 2, 'g', 20, '4.0', 60, 1, 0),
(83, 'fv_v_arbi.jpg', 'fv_v_arbi', 'Arbi', '', 4, 'potatoGourds', '0.80', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(84, 'fv_v_arbi_leaves.jpg', 'fv_v_arbi_leaves', 'Arbi Leaves', '', 7, 'leafyVeg', '2.00', 0, 1, 5, 'bndl', 30, '4.0', 100, 1, 0),
(85, 'fv_v_banana_flower.jpg', 'fv_v_banana_flower', 'Banana Flower', '', 6, 'generalVeg', '1.74', 0, 1, 4, 'pc', 30, '4.0', 100, 1, 0),
(86, 'fv_v_banana_stem.jpg', 'fv_v_banana_stem', 'Banana Stem', '', 6, 'generalVeg', '2.00', 1, 1, 0, 'kg', 60, '5.0', 240, 1, 0),
(87, 'fv_v_bathua.jpg', 'fv_v_bathua', 'Bathua', '', 7, 'leafyVeg', '2.00', 1, 1, 2, 'g', 20, '4.0', 60, 1, 0),
(88, 'fv_v_bean_fava.jpg', 'fv_v_bean_fava', 'Bean', 'Fava', 5, 'greenVeg', '1.50', 0, 1, 0, 'kg', 40, '2.5', 90, 1, 0),
(89, 'fv_v_bean_indian.jpg', 'fv_v_bean_indian', 'Bean', 'Indian', 5, 'greenVeg', '1.80', 1, 1, 0, 'kg', 35, '2.5', 75, 1, 0),
(90, 'fv_v_bean_yardlong.jpg', 'fv_v_bean_yardlong', 'Bean', 'Yardlong', 5, 'greenVeg', '2.00', 0, 1, 0, 'kg', 50, '2.5', 100, 1, 0),
(91, 'fv_v_beans_cluster.jpg', 'fv_v_beans_cluster', 'Bean', 'Cluster', 5, 'greenVeg', '2.00', 0, 1, 0, 'kg', 50, '2.5', 110, 1, 0),
(92, 'fv_v_beans_french.jpg', 'fv_v_beans_french', 'Bean', 'French', 5, 'greenVeg', '1.80', 1, 1, 0, 'kg', 70, '2.5', 150, 1, 0),
(93, 'fv_v_beetroot.jpg', 'fv_v_beetroot', 'Beetroot', '', 8, 'saladChinese', '1.10', 1, 1, 0, 'kg', 40, '2.5', 75, 1, 0),
(94, 'fv_v_brinjal_green.jpg', 'fv_v_brinjal_green', 'Brinjal', 'Green', 6, 'generalVeg', '2.00', 1, 1, 0, 'kg', 45, '2.5', 90, 1, 0),
(95, 'fv_v_brinjal_green_long.jpg', 'fv_v_brinjal_green_long', 'Brinjal', 'Green Long', 6, 'generalVeg', '2.00', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(96, 'fv_v_brinjal_long.jpg', 'fv_v_brinjal_long', 'Brinjal', 'Long', 6, 'generalVeg', '1.60', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(97, 'fv_v_brinjal_purple.jpg', 'fv_v_brinjal_purple', 'Brinjal', 'Purple', 6, 'generalVeg', '1.45', 1, 1, 0, 'kg', 50, '2.5', 90, 1, 0),
(98, 'fv_v_brinjal_small.jpg', 'fv_v_brinjal_small', 'Brinjal', 'Small', 6, 'generalVeg', '1.33', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(99, 'fv_v_brinjal_varikateri.jpg', 'fv_v_brinjal_varikateri', 'Brinjal', 'Varikateri', 6, 'generalVeg', '1.50', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(100, 'fv_v_broccoli.jpg', 'fv_v_broccoli', 'Broccoli', '', 5, 'greenVeg', '1.90', 1, 1, 0, 'kg', 100, '2.5', 200, 1, 0),
(101, 'fv_v_cabbage.jpg', 'fv_v_cabbage', 'Cabbage', '', 5, 'greenVeg', '1.80', 1, 1, 0, 'kg', 20, '2.5', 40, 1, 0),
(102, 'fv_v_cabbage_red.jpg', 'fv_v_cabbage_red', 'Cabbage', 'Red', 6, 'generalVeg', '1.72', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(103, 'fv_v_capsicum_green.jpg', 'fv_v_capsicum_green', 'Capsicum', 'Green', 6, 'generalVeg', '1.45', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(104, 'fv_v_capsicum_red.jpg', 'fv_v_capsicum_red', 'Capsicum', 'Red', 6, 'generalVeg', '1.45', 1, 1, 0, 'kg', 100, '2.5', 200, 1, 0),
(105, 'fv_v_capsicum_yellow.jpg', 'fv_v_capsicum_yellow', 'Capsicum', 'Yellow', 6, 'generalVeg', '1.45', 1, 1, 0, 'kg', 100, '2.5', 200, 1, 0),
(106, 'fv_v_carrot_black.jpg', 'fv_v_carrot_black', 'Carrot', 'Black', 8, 'saladChinese', '1.50', 0, 1, 0, 'kg', 30, '2.5', 60, 1, 0),
(107, 'fv_v_carrot_orange.jpg', 'fv_v_carrot_orange', 'Carrot', 'Orange', 8, 'saladChinese', '1.75', 0, 1, 0, 'kg', 30, '2.5', 60, 1, 0),
(108, 'fv_v_carrot_purple.jpg', 'fv_v_carrot_purple', 'Carrot', 'Purple', 8, 'saladChinese', '2.00', 1, 1, 0, 'kg', 30, '2.5', 60, 1, 0),
(109, 'fv_v_carrot_red.jpg', 'fv_v_carrot_red', 'Carrot', 'Red', 8, 'saladChinese', '2.00', 1, 1, 0, 'kg', 25, '2.5', 50, 1, 0),
(110, 'fv_v_cauliflower.jpg', 'fv_v_cauliflower', 'Cauliflower', '', 6, 'generalVeg', '1.50', 1, 1, 0, 'kg', 30, '5.0', 120, 1, 0),
(111, 'fv_v_chaulai.jpg', 'fv_v_chaulai', 'Chaulai', '', 7, 'leafyVeg', '2.00', 1, 1, 5, 'bndl', 20, '5.0', 80, 1, 0),
(112, 'fv_v_chaulai_red.jpg', 'fv_v_chaulai_red', 'Chaulai', 'Red', 7, 'leafyVeg', '2.00', 1, 1, 5, 'bndl', 20, '5.0', 80, 1, 0),
(113, 'fv_v_chilli_green.jpg', 'fv_v_chilli_green', 'Chilli', 'Green', 9, 'flavourVeg', '1.20', 1, 1, 1, 'g', 10, '5.0', 40, 1, 0),
(114, 'fv_v_chilli_green_long.jpg', 'fv_v_chilli_green_long', 'Chilli', 'Green Long', 9, 'flavourVeg', '1.10', 1, 1, 2, 'g', 20, '4.0', 60, 1, 0),
(115, 'fv_v_chilli_green_round.jpg', 'fv_v_chilli_green_round', 'Chilli', 'Green Round', 9, 'flavourVeg', '1.10', 1, 1, 1, 'g', 12, '5.0', 50, 1, 0),
(116, 'fv_v_chilli_green2.jpg', 'fv_v_chilli_green2', 'Chilli', 'Green Thick', 9, 'flavourVeg', '1.20', 1, 1, 1, 'g', 10, '5.0', 40, 1, 0),
(117, 'fv_v_chilli_mundu.jpg', 'fv_v_chilli_mundu', 'Chilli', 'Mundu', 9, 'flavourVeg', '0.85', 1, 1, 1, 'g', 10, '5.0', 40, 1, 0),
(118, 'fv_v_chilli_red_dried.jpg', 'fv_v_chilli_red_dried', 'Chilli', 'Red Dried', 9, 'flavourVeg', '1.70', 1, 1, 1, 'g', 20, '5.0', 80, 1, 0),
(119, 'fv_v_chillired_long.jpg', 'fv_v_chillired_long', 'Chilli', 'Red Long', 9, 'flavourVeg', '1.40', 1, 1, 2, 'g', 20, '4.0', 60, 1, 0),
(120, 'fv_v_coriander.jpg', 'fv_v_coriander', 'Coriander', 'Dhania', 9, 'flavourVeg', '1.67', 1, 1, 2, 'g', 20, '4.0', 60, 1, 0),
(121, 'fv_v_corn.jpg', 'fv_v_corn', 'Corn', '', 8, 'saladChinese', '2.00', 0, 1, 4, 'pc', 10, '5.0', 40, 1, 0),
(122, 'fv_v_corn_baby.jpg', 'fv_v_corn_baby', 'Babycorn', '', 8, 'saladChinese', '1.46', 1, 1, 2, 'g', 40, '4.0', 120, 1, 0),
(123, 'fv_v_cucumber_burpless.jpg', 'fv_v_cucumber_burpless', 'Cucumber', 'Burpless', 8, 'saladChinese', '2.00', 0, 1, 0, 'kg', 30, '5.0', 120, 1, 0),
(124, 'fv_v_cucumber_pickling.jpg', 'fv_v_cucumber_pickling', 'Cucumber', 'Pickling', 8, 'saladChinese', '1.70', 1, 1, 0, 'kg', 40, '5.0', 160, 1, 0),
(125, 'fv_v_cucumber_slicing.jpg', 'fv_v_cucumber_slicing', 'Cucumber', 'Slicing', 8, 'saladChinese', '2.00', 1, 1, 0, 'kg', 30, '5.0', 120, 1, 0),
(126, 'fv_v_curry_leaves.jpg', 'fv_v_curry_leaves', 'Curry Leaves', '', 9, 'flavourVeg', '2.00', 1, 1, 5, 'bndl', 10, '5.0', 40, 1, 0),
(127, 'fv_v_desi_alu.jpg', 'fv_v_desi_alu', 'Desi Alu', '', 4, 'potatoGourds', '2.00', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(128, 'fv_v_dill.jpg', 'fv_v_dill', 'Dill', '', 7, 'leafyVeg', '1.53', 1, 1, 5, 'bndl', 20, '5.0', 80, 1, 0),
(129, 'fv_v_drumstick.jpg', 'fv_v_drumstick', 'Drumstick', '', 5, 'greenVeg', '3.25', 1, 1, 0, 'kg', 40, '5.0', 160, 1, 0),
(130, 'fv_v_elephant_apple.jpg', 'fv_v_elephant_apple', 'Elephant Apple', 'Chulta / Ouu', 9, 'flavourVeg', '2.00', 1, 1, 0, 'kg', 40, '5.0', 150, 1, 0),
(131, 'fv_v_elephant_yam.jpg', 'fv_v_elephant_yam', 'Elephant Yam', 'Jimikand', 5, 'greenVeg', '2.00', 0, 1, 0, 'kg', 40, '5.0', 150, 1, 0),
(132, 'fv_v_garlic.jpg', 'fv_v_garlic', 'Garlic', '', 9, 'flavourVeg', '1.00', 1, 1, 2, 'g', 50, '4.0', 160, 1, 0),
(133, 'fv_v_ginger.jpg', 'fv_v_ginger', 'Ginger', '', 9, 'flavourVeg', '1.22', 1, 1, 2, 'g', 30, '4.0', 100, 1, 0),
(134, 'fv_v_ginger_mango.jpg', 'fv_v_ginger_mango', 'Ginger Mango', '', 9, 'flavourVeg', '1.00', 1, 1, 2, 'g', 60, '4.0', 200, 1, 0),
(135, 'fv_v_gongura.jpg', 'fv_v_gongura', 'Gongura', '', 7, 'leafyVeg', '2.00', 1, 1, 5, 'bndl', 20, '5.0', 80, 1, 0),
(136, 'fv_v_gooseberry.jpg', 'fv_v_gooseberry', 'Gooseberry', 'Amla', 9, 'flavourVeg', '0.84', 1, 1, 0, 'kg', 50, '2.5', 100, 1, 0),
(137, 'fv_v_gourd_ivy.jpg', 'fv_v_gourd_ivy', 'Ivy Gourd', 'Kundru', 5, 'greenVeg', '1.05', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(138, 'fv_v_gourd_pointed.jpg', 'fv_v_gourd_pointed', 'Pointed Gourd', 'Parwal', 5, 'greenVeg', '1.30', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(139, 'fv_v_gourd_ridge.jpg', 'fv_v_gourd_ridge', 'Ridge Gourd', 'Torai', 5, 'greenVeg', '2.00', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(140, 'fv_v_gourd_snake.jpg', 'fv_v_gourd_snake', 'Snake Gourd', 'Chichinda', 4, 'potatoGourds', '3.00', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(141, 'fv_v_gourd_spiny.jpg', 'fv_v_gourd_spiny', 'Spiny Gourd', 'Kankoda', 5, 'greenVeg', '1.00', 1, 1, 0, 'kg', 60, '2.5', 120, 1, 0),
(142, 'fv_v_gourd_sponge.jpg', 'fv_v_gourd_sponge', 'Sponge Gourd', 'Nenua', 5, 'greenVeg', '2.00', 1, 1, 0, 'kg', 35, '2.5', 70, 1, 0),
(143, 'fv_v_gourdapple.jpg', 'fv_v_gourdapple', 'Apple Gourd', 'Tinda', 5, 'greenVeg', '1.10', 1, 1, 0, 'kg', 50, '2.5', 100, 1, 0),
(144, 'fv_v_gourdapple_1.jpg', 'fv_v_gourdapple_1', 'Apple Gourd', 'Chappal Tinda', 5, 'greenVeg', '1.10', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(145, 'fv_v_gourdash.jpg', 'fv_v_gourdash', 'Ash Gourd', 'Petha', 4, 'potatoGourds', '2.00', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(146, 'fv_v_gourdbitter.jpg', 'fv_v_gourdbitter', 'Bitter Gourd', 'Karela', 5, 'greenVeg', '1.80', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(147, 'fv_v_gourdbottle.jpg', 'fv_v_gourdbottle', 'Bottle Gourd', 'Lauki', 4, 'potatoGourds', '2.00', 1, 1, 0, 'kg', 30, '5.0', 100, 1, 0),
(148, 'fv_v_gourdbottle_1.jpg', 'fv_v_gourdbottle_1', 'Bottle Gourd Round', 'Lauki Round', 4, 'potatoGourds', '2.00', 1, 1, 0, 'kg', 30, '5.0', 100, 1, 0),
(149, 'fv_v_jackfruit.jpg', 'fv_v_jackfruit', 'Jackfruit', '', 6, 'generalVeg', '2.00', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(150, 'fv_v_jackfruit_seeds.jpg', 'fv_v_jackfruit_seeds', 'Jackfruit Seeds', '', 6, 'generalVeg', '1.00', 0, 1, 2, 'g', 20, '4.0', 60, 1, 0),
(151, 'fv_v_kakdi.jpg', 'fv_v_kakdi', 'Kakdi', '', 8, 'saladChinese', '2.00', 0, 0, 0, 'kg', 40, '5.0', 150, 1, 0),
(152, 'fv_v_karamanga.jpg', 'fv_v_karamanga', 'Star Fruit', 'Kamrakh', 9, 'flavourVeg', '0.93', 0, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(153, 'fv_v_ladys_finger.jpg', 'fv_v_ladys_finger', 'Lady\'s finger', '', 5, 'greenVeg', '1.47', 1, 1, 0, 'kg', 50, '2.5', 100, 1, 0),
(154, 'fv_v_lasoda.jpg', 'fv_v_lasoda', 'Lasoda', '', 9, 'flavourVeg', '0.81', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(155, 'fv_v_lemon_green.jpg', 'fv_v_lemon_green', 'Green Lemon', '', 9, 'flavourVeg', '1.45', 1, 1, 0, 'kg', 60, '2.5', 120, 1, 0),
(156, 'fv_v_lemon_yellow.jpg', 'fv_v_lemon_yellow', 'Yellow Lemon', '', 9, 'flavourVeg', '0.85', 0, 1, 0, 'kg', 60, '2.5', 120, 1, 0),
(157, 'fv_v_lettuce.jpg', 'fv_v_lettuce', 'Lettuce', '', 8, 'saladChinese', '2.00', 0, 1, 2, 'g', 40, '4.0', 120, 1, 0),
(158, 'fv_v_lotus_stem.jpg', 'fv_v_lotus_stem', 'Lotus Stem', '', 6, 'generalVeg', '2.00', 1, 1, 0, 'kg', 60, '2.5', 125, 1, 0),
(159, 'fv_v_malabar_spinach.jpg', 'fv_v_malabar_spinach', 'Malabar Spinach', '', 7, 'leafyVeg', '2.00', 1, 1, 0, 'kg', 60, '2.5', 120, 1, 0),
(160, 'fv_v_methi.jpg', 'fv_v_methi', 'Methi', '', 7, 'leafyVeg', '2.00', 1, 1, 0, 'kg', 60, '2.5', 120, 1, 0),
(161, 'fv_v_mint.jpg', 'fv_v_mint', 'Mint', '', 9, 'flavourVeg', '1.30', 1, 1, 5, 'bndl', 4, '12.0', 40, 1, 0),
(162, 'fv_v_mushroom_button.jpg', 'fv_v_mushroom_button', 'Button Mushroom', '', 8, 'saladChinese', '1.00', 0, 1, 2, 'g', 40, '4.0', 120, 1, 0),
(163, 'fv_v_mushroom_milky.jpg', 'fv_v_mushroom_milky', 'Milky Mushroom', '', 8, 'saladChinese', '1.50', 1, 1, 2, 'g', 50, '4.0', 150, 1, 0),
(164, 'fv_v_mushroom_oyster.jpg', 'fv_v_mushroom_oyster', 'Oyster Mushroom', '', 8, 'saladChinese', '1.60', 1, 1, 0, 'kg', 40, '4.0', 120, 1, 0),
(165, 'fv_v_mushroom_straw.jpg', 'fv_v_mushroom_straw', 'Straw Mushroom', '', 8, 'saladChinese', '2.00', 0, 0, 0, 'kg', 60, '4.0', 200, 1, 0),
(166, 'fv_v_mustard_greens.jpg', 'fv_v_mustard_greens', 'Mustard Greens', '', 7, 'leafyVeg', '2.00', 1, 1, 0, 'kg', 50, '2.5', 100, 1, 0),
(167, 'fv_v_onion_red.jpg', 'fv_v_onion_red', 'Onion', 'Red', 4, 'potatoGourds', '0.82', 1, 1, 0, 'kg', 40, '5.0', 120, 1, 0),
(168, 'fv_v_onion_shallot.jpg', 'fv_v_onion_shallot', 'Onion', 'Shallot', 4, 'potatoGourds', '0.90', 0, 1, 0, 'kg', 60, '2.5', 120, 1, 0),
(169, 'fv_v_onion_spring.jpg', 'fv_v_onion_spring', 'Spring Onion', '', 4, 'potatoGourds', '2.00', 0, 1, 2, 'g', 20, '4.0', 60, 1, 0),
(170, 'fv_v_onion_spring1.jpg', 'fv_v_onion_spring1', 'Spring Onion', 'Bulb', 4, 'potatoGourds', '2.00', 1, 1, 0, 'kg', 20, '4.0', 60, 1, 0),
(171, 'fv_v_onion_white.jpg', 'fv_v_onion_white', 'Onion', 'White', 4, 'potatoGourds', '1.00', 1, 1, 0, 'kg', 50, '5.0', 200, 1, 0),
(172, 'fv_v_onion_yellow.jpg', 'fv_v_onion_yellow', 'Onion', 'Yellow', 4, 'potatoGourds', '0.70', 1, 1, 0, 'kg', 40, '5.0', 120, 1, 0),
(173, 'fv_v_peas_green.jpg', 'fv_v_peas_green', 'Green Peas', '', 5, 'greenVeg', '1.50', 0, 1, 0, 'kg', 100, '2.5', 200, 1, 0),
(174, 'fv_v_peas_snap.jpg', 'fv_v_peas_snap', 'Snap Peas', '', 5, 'greenVeg', '1.30', 0, 1, 2, 'g', 120, '2.5', 240, 1, 0),
(175, 'fv_v_peas_snow.jpg', 'fv_v_peas_snow', 'Snow Peas', '', 8, 'saladChinese', '1.00', 1, 1, 0, 'kg', 60, '4.0', 200, 1, 0),
(176, 'fv_v_potato_sweet.jpg', 'fv_v_potato_sweet', 'Sweet Potato', '', 4, 'potatoGourds', '1.42', 1, 1, 0, 'kg', 30, '5.0', 120, 1, 0),
(177, 'fv_v_potato1.jpg', 'fv_v_potato1', 'Potato', 'Old', 4, 'potatoGourds', '2.00', 1, 1, 0, 'kg', 25, '5.0', 100, 1, 0),
(178, 'fv_v_potato2.jpg', 'fv_v_potato2', 'Potato', 'Black', 4, 'potatoGourds', '1.98', 1, 1, 0, 'kg', 30, '5.0', 100, 1, 0),
(179, 'fv_v_potato3.jpg', 'fv_v_potato3', 'Potato', 'Red', 4, 'potatoGourds', '1.50', 0, 1, 0, 'kg', 30, '5.0', 100, 1, 0),
(180, 'fv_v_potato4.jpg', 'fv_v_potato4', 'Potato', 'New', 4, 'potatoGourds', '2.00', 1, 1, 0, 'kg', 25, '5.0', 80, 1, 0),
(181, 'fv_v_potatoes_baby.jpg', 'fv_v_potatoes_baby', 'Baby Potato', '', 4, 'potatoGourds', '1.44', 1, 1, 0, 'kg', 25, '5.0', 100, 1, 0),
(182, 'fv_v_pumpkin_flower.jpg', 'fv_v_pumpkin_flower', 'Pumpkin Flower', '', 7, 'leafyVeg', '1.40', 0, 1, 5, 'bndl', 25, '4.0', 80, 1, 0),
(183, 'fv_v_pumpkin1.jpg', 'fv_v_pumpkin1', 'Pumpkin', 'Green', 4, 'potatoGourds', '1.85', 1, 1, 0, 'kg', 30, '5.0', 120, 1, 0),
(184, 'fv_v_pumpkin2.jpg', 'fv_v_pumpkin2', 'Pumpkin', 'Orange', 4, 'potatoGourds', '2.00', 1, 1, 0, 'kg', 30, '5.0', 120, 1, 0),
(185, 'fv_v_radish_red.jpg', 'fv_v_radish_red', 'Radish', 'Red', 8, 'saladChinese', '1.00', 0, 1, 2, 'g', 25, '4.0', 80, 1, 0),
(186, 'fv_v_radish_white.jpg', 'fv_v_radish_white', 'Radish', 'White', 8, 'saladChinese', '2.00', 0, 1, 0, 'kg', 25, '5.0', 80, 1, 0),
(187, 'fv_v_raw_banana.jpg', 'fv_v_raw_banana', 'Raw Banana', '', 6, 'generalVeg', '1.80', 1, 1, 0, 'kg', 50, '2.5', 100, 1, 0),
(188, 'fv_v_raw_mango.jpg', 'fv_v_raw_mango', 'Raw Mango', '', 9, 'flavourVeg', '1.43', 0, 0, 0, 'kg', 50, '2.5', 100, 1, 0),
(189, 'fv_v_raw_papaya.jpg', 'fv_v_raw_papaya', 'Raw Papaya', '', 6, 'generalVeg', '2.20', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(190, 'fv_v_rutabaga.jpg', 'fv_v_rutabaga', 'Rutabaga', '', 6, 'generalVeg', '1.00', 1, 1, 5, 'bndl', 25, '4.0', 80, 1, 0),
(191, 'fv_v_spinach.jpg', 'fv_v_spinach', 'Spinach', '', 7, 'leafyVeg', '2.00', 1, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(192, 'fv_v_spring_garlic.jpg', 'fv_v_spring_garlic', 'Spring Garlic', '', 7, 'leafyVeg', '2.00', 1, 1, 2, 'g', 20, '4.0', 60, 1, 0),
(193, 'fv_v_tamarind.jpg', 'fv_v_tamarind', 'Tamarind', '', 9, 'flavourVeg', '1.60', 1, 1, 0, 'kg', 60, '2.5', 120, 1, 0),
(194, 'fv_v_tomato.jpg', 'fv_v_tomato', 'Tomato', '', 8, 'saladChinese', '1.20', 1, 1, 0, 'kg', 50, '5.0', 200, 1, 0),
(195, 'fv_v_tomato_cherry.jpg', 'fv_v_tomato_cherry', 'Tomato', 'Cherry', 8, 'saladChinese', '1.40', 1, 1, 2, 'g', 30, '4.0', 100, 1, 0),
(196, 'fv_v_tomato_green.jpg', 'fv_v_tomato_green', 'Tomato', 'Green', 8, 'saladChinese', '1.00', 1, 1, 0, 'kg', 60, '2.5', 120, 1, 0),
(197, 'fv_v_tomato_round.jpg', 'fv_v_tomato_round', 'Tomato', 'Round', 8, 'saladChinese', '1.00', 1, 1, 0, 'kg', 50, '5.0', 200, 1, 0),
(198, 'fv_v_turmeric.jpg', 'fv_v_turmeric', 'Turmeric', '', 9, 'flavourVeg', '1.20', 1, 1, 2, 'g', 40, '4.0', 120, 1, 0),
(199, 'fv_v_turmeric_leaves.jpg', 'fv_v_turmeric_leaves', 'Turmeric Leaves', '', 7, 'leafyVeg', '3.00', 1, 1, 5, 'bndl', 20, '10.0', 150, 1, 0),
(200, 'fv_v_turnip.jpg', 'fv_v_turnip', 'Turnip', '', 6, 'generalVeg', '1.00', 0, 1, 0, 'kg', 40, '2.5', 80, 1, 0),
(201, 'fv_v_water_spinach.jpg', 'fv_v_water_spinach', 'Water Spinach', '', 7, 'leafyVeg', '2.50', 1, 1, 0, 'kg', 50, '2.5', 100, 1, 0),
(202, 'fv_v_zucchini.jpg', 'fv_v_zucchini', 'Zucchini', '', 4, 'potatoGourds', '2.00', 0, 1, 0, 'kg', 40, '5.0', 160, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders_placed`
--

CREATE TABLE `orders_placed` (
  `orderid` int(11) NOT NULL,
  `farmer_id` int(10) UNSIGNED NOT NULL,
  `food` varchar(32) NOT NULL,
  `Cost` int(11) NOT NULL,
  `transport` tinyint(1) NOT NULL DEFAULT '0',
  `A` int(11) NOT NULL,
  `B` int(11) NOT NULL,
  `C` int(11) NOT NULL,
  `date_harvest` datetime NOT NULL,
  `date_deliver` datetime NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyer_tbl`
--
ALTER TABLE `buyer_tbl`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `mobile_no` (`mobile_no`),
  ADD UNIQUE KEY `username` (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `buy_contracts_tbl`
--
ALTER TABLE `buy_contracts_tbl`
  ADD PRIMARY KEY (`contract_id`),
  ADD KEY `buyer_withdrawal` (`buyer_id`),
  ADD KEY `item_withdrawal` (`fv_id`);

--
-- Indexes for table `farmer_tbl`
--
ALTER TABLE `farmer_tbl`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `mobile_no` (`mobile_no`),
  ADD UNIQUE KEY `username` (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `item_details_tbl`
--
ALTER TABLE `item_details_tbl`
  ADD PRIMARY KEY (`item_no`),
  ADD UNIQUE KEY `file_name` (`file_name`),
  ADD UNIQUE KEY `image_name` (`image_name`);

--
-- Indexes for table `orders_placed`
--
ALTER TABLE `orders_placed`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `farmer_id` (`farmer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyer_tbl`
--
ALTER TABLE `buyer_tbl`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100008;

--
-- AUTO_INCREMENT for table `buy_contracts_tbl`
--
ALTER TABLE `buy_contracts_tbl`
  MODIFY `contract_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `farmer_tbl`
--
ALTER TABLE `farmer_tbl`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100016;

--
-- AUTO_INCREMENT for table `orders_placed`
--
ALTER TABLE `orders_placed`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buy_contracts_tbl`
--
ALTER TABLE `buy_contracts_tbl`
  ADD CONSTRAINT `buyer_withdrawal` FOREIGN KEY (`buyer_id`) REFERENCES `buyer_tbl` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_withdrawal` FOREIGN KEY (`fv_id`) REFERENCES `item_details_tbl` (`item_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders_placed`
--
ALTER TABLE `orders_placed`
  ADD CONSTRAINT `orders_placed_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `farmer_tbl` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
