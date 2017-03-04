-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2017 at 10:22 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pcnijuan`
--
CREATE DATABASE IF NOT EXISTS `pcnijuan` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pcnijuan`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `empID` int(11) NOT NULL,
  `username` varchar(245) NOT NULL,
  `password` varchar(245) NOT NULL,
  `type` varchar(245) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `empID`, `username`, `password`, `type`, `flag`) VALUES
(1, 1, 'admin', '$2y$11$ULK/CFZJcYGM7vQVJqKEn.iEQtPRkAbOZr.6pDvVgaSUsAB5pWoqC', 'owner', 1),
(2, 2, 'employee', '$2y$11$.1HEQdu1/Cnwq1/EBjCakOzARHxfa9K54TMv2yB.LkSx1YC5IpL6.', 'employee', 1),
(3, 3, '', '$2y$11$0x7Q3bQn3Go7UGK88yZ3GuPkoPFUtDw1XkMJUA24Ff.73xOONn9d2', 'owner', 0),
(4, 4, 'mnats', '$2y$11$rw1gR1L6ulJICjeQKphvo.NZfa9bL3przd.T8nhjDBdy9Hc.NM73K', 'owner', 1),
(5, 5, 'user 1', '$2y$11$3dW2ryv9HhP4fCh7dPB2Regj0A5r/BWt7sgJXmXrnY3eYXK.m4y3q', 'owner', 0),
(6, 6, 'user', '$2y$11$8T0MmfN1.Ctoxlxf2Unfk.znZBayLHs/cur3KFPHFsTtA7xpmOb.a', 'owner', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custID` int(11) NOT NULL,
  `custName` varchar(245) NOT NULL,
  `custCN` varchar(255) NOT NULL,
  `custAddress` varchar(245) NOT NULL,
  `trans_num` varchar(255) NOT NULL DEFAULT '0',
  `flag` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custID`, `custName`, `custCN`, `custAddress`, `trans_num`, `flag`) VALUES
(1, 'Anonymous', '', '', '0', 1),
(2, 'Aldrin Agpaoa', '09124563141', '#041 Purok 2 Gibraltar Road, Baguio City', '24', 1),
(3, 'Hazel Dela Cruz', '09153585473', '#05, Unit F, Lower Phil-Am Barangay, Baguio City', '1', 1),
(4, 'Albert Natividad', '09074095703', '#66 Lower Dominican Hill, Baguio City', '2', 1),
(5, 'Joyce Natividad', '09226851354', '#66 Lower Dominican Hill, Baguio City', '0', 1),
(6, 'Yvonne Zabala', '09169801366', '#102 Simsim compound Maria Basa, Baguio City', '0', 1),
(7, 'Allan Alo', '09237116546', '#3 First road, Quezon Hill, Baguio City', '1', 1),
(8, 'asd', '1', 'da', '0', 0),
(9, 'ads', '1213141', 'das', '0', 0),
(10, 'sadsa', '12312', '1231', '0', 0),
(11, 'Sample Customer 1', '012323443561', 'Sample Address 1', '2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empID` int(11) NOT NULL,
  `firstName` varchar(245) NOT NULL,
  `lastName` varchar(245) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empID`, `firstName`, `lastName`) VALUES
(1, 'Juan', 'Dela Cruz'),
(2, 'Uncle', 'Sam'),
(3, '', ''),
(4, 'Michael', 'Natividad'),
(5, 'user 1', 'user'),
(6, 'user', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `or_num` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `user` varchar(255) NOT NULL,
  `itemNum` int(11) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `total_remaining` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `suppID` int(11) NOT NULL,
  `custID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ledger`
--

INSERT INTO `ledger` (`id`, `type`, `or_num`, `date`, `user`, `itemNum`, `qty`, `total_remaining`, `remarks`, `reason`, `suppID`, `custID`) VALUES
(1, 'checkin', '', '2016-11-24 00:00:00', 'Juan Dela Cruz', 4, '50', '173', 'Brand New / with box', 'order', 1, 0),
(2, 'checkin', '', '2016-11-24 00:00:00', 'Juan Dela Cruz', 9, '60', '92', 'None / all good', 'order', 1, 0),
(3, 'checkin', '', '2016-11-24 00:00:00', 'Juan Dela Cruz', 11, '2', '17', 'Brand New / with box and manuals', 'order', 1, 0),
(4, 'checkin', '', '2016-11-24 00:00:00', 'Juan Dela Cruz', 4, '40', '213', 'late delivery', 'order', 1, 0),
(5, 'checkout', 'CR2032-1123', '2016-11-24 00:00:00', 'Juan Dela Cruz', 10, '3', '60', 'Regular Customer', 'sale', 0, 2),
(6, 'checkout', 'CR2032-1123', '2016-11-24 00:00:00', 'Juan Dela Cruz', 8, '5', '30', 'Regular Customer', 'sale', 0, 2),
(13, 'checkout', 'CR2032-11442', '2016-11-19 00:00:00', 'Juan Dela Cruz', 1, '97', '900', 'Walk-In Customer', 'sale', 0, 2),
(15, 'checkout', 'GJH784521', '2016-11-20 00:00:00', 'Juan Dela Cruz', 4, '50', '150', 'Bulk order', 'sale', 0, 2),
(16, 'checkout', 'HGF895621', '2016-11-20 00:00:00', 'Juan Dela Cruz', 11, '1', '16', 'Secondhand', 'sale', 0, 2),
(19, 'checkin', '', '2016-11-20 00:00:00', 'Juan Dela Cruz', 4, '1', '151', '', 'warranty', 0, 2),
(20, 'checkin', '', '2016-11-21 00:00:00', 'Juan Dela Cruz', 9, '1', '102', '', 'refund', 0, 2),
(21, 'checkin', '', '2016-11-19 00:00:00', 'Juan Dela Cruz', 7, '2', '27', '', 'exchange', 0, 2),
(22, 'checkin', '', '2016-11-20 00:00:00', 'Juan Dela Cruz', 4, '15', '166', 'Brand New', 'order', 1, 0),
(23, 'checkin', '', '2016-11-20 00:00:00', 'Juan Dela Cruz', 9, '5', '107', 'Wireless', 'order', 1, 0),
(24, 'checkout', '1111111111111', '2016-12-03 00:00:00', 'Juan Dela Cruz', 4, '10', '156', 'remarks', 'sale', 0, 3),
(25, 'checkin', '', '2016-12-06 00:00:00', 'Juan Dela Cruz', 12, '100', '100', '', 'order', 1, 0),
(26, 'checkin', '', '2016-12-07 00:00:00', 'Juan Dela Cruz', 13, '100', '100', '', 'order', 1, 0),
(27, 'checkin', '', '2016-12-07 00:00:00', 'Juan Dela Cruz', 14, '100', '100', '', 'order', 1, 0),
(28, 'checkin', '', '2016-12-07 00:00:00', 'Juan Dela Cruz', 15, '100', '100', '', 'order', 1, 0),
(29, 'checkin', '', '2016-12-07 00:00:00', 'Juan Dela Cruz', 16, '100', '100', '', 'order', 1, 0),
(30, 'checkin', '', '2016-12-07 00:00:00', 'Juan Dela Cruz', 17, '10', '10', '', 'order', 1, 0),
(31, 'checkout', '', '2016-12-28 00:00:00', 'Juan Dela Cruz', 4, '2', '154', 'wala lang', 'warranty', 1, 0),
(32, 'checkin', '', '2016-12-07 00:00:00', 'Juan Dela Cruz', 4, '10', '164', 'remarks', 'order', 1, 0),
(33, 'checkout', '233242234', '2016-12-07 00:00:00', 'Juan Dela Cruz', 4, '10', '154', 'remarks', 'sale', 0, 11),
(34, 'checkout', '1111111111111111', '2016-12-07 00:00:00', 'Juan Dela Cruz', 4, '1', '153', 'Remarks 1', 'sale', 0, 11),
(35, 'checkin', '', '2016-12-13 00:00:00', 'Juan Dela Cruz', 4, '1', '154', '', 'warranty', 0, 11),
(36, 'checkin', '', '2016-12-07 00:00:00', 'Juan Dela Cruz', 18, '100', '100', '', 'order', 1, 0),
(37, 'checkout', '111111111111', '2016-12-07 00:00:00', 'Juan Dela Cruz', 18, '100', '0', 'remarks', 'sale', 0, 2),
(38, 'checkin', '', '2016-12-07 00:00:00', 'Juan Dela Cruz', 18, '10', '10', 'remarks', 'order', 1, 0),
(39, 'checkin', '', '2016-12-07 00:00:00', 'Juan Dela Cruz', 19, '111', '111', '', 'order', 1, 0),
(40, 'checkin', '', '2016-12-07 00:00:00', 'Juan Dela Cruz', 20, '100', '100', '', 'order', 1, 0),
(41, 'checkout', '', '2016-12-13 00:00:00', 'Anonymous', 0, '1', '110', '', 'sale', 0, 1),
(42, 'checkout', '', '2016-12-13 00:00:00', 'Anonymous', 19, '1', '110', '', 'sale', 0, 1),
(43, 'checkout', '', '2016-12-13 00:00:00', 'Anonymous', 4, '2', '152', '', 'sale', 0, 1),
(44, 'checkin', '', '2016-12-13 00:00:00', 'Juan Dela Cruz', 19, '1', '111', 'remarks', 'order', 1, 0),
(45, 'checkin', '', '2016-12-13 00:00:00', 'Juan Dela Cruz', 19, '2', '113', 'remarks', 'order', 1, 0),
(46, 'checkin', '', '2016-12-13 00:00:00', 'Juan Dela Cruz', 19, '2', '115', 'remarks', 'order', 1, 0),
(47, 'checkin', '', '2016-12-13 00:00:00', 'Juan Dela Cruz', 17, '2', '12', 'remarks', 'order', 1, 0),
(48, 'checkin', '', '2016-12-13 20:16:57', 'Juan Dela Cruz', 21, '100', '100', '', 'order', 5, 0),
(49, 'checkin', '', '2016-12-13 20:19:26', 'Juan Dela Cruz', 22, '100', '100', '', 'order', 1, 0),
(50, 'checkout', '', '2016-12-13 20:33:46', 'Anonymous', 22, '99', '1', '', 'sale', 0, 1),
(51, 'checkout', '', '2016-12-13 20:37:38', 'Anonymous', 20, '49', '51', '', 'sale', 0, 1),
(52, 'checkout', '', '2016-12-13 20:38:27', 'Anonymous', 20, '50', '1', '', 'sale', 0, 1),
(53, 'checkout', '', '2016-12-13 20:40:07', 'Anonymous', 19, '110', '5', '', 'sale', 0, 1),
(54, 'checkin', '', '2017-01-24 21:40:52', 'Juan Dela Cruz', 23, '22', '22', '', 'order', 1, 0),
(55, 'checkin', '', '2017-01-24 21:42:39', 'Michael Natividad', 24, '10', '10', '', 'order', 1, 0),
(56, 'checkin', '', '2017-03-04 19:51:02', 'mnats', 25, '100', '100', '', 'order', 1, 0),
(57, 'checkout', '', '0000-00-00 00:00:00', ' ', 25, '3', '103', 'return', 'return', 1, 0),
(58, 'checkout', '', '0000-00-00 00:00:00', 'Michael Natividad', 24, '3', '13', 'remarks', 'remarks', 1, 0),
(59, 'checkout', '', '0000-00-00 00:00:00', 'Michael Natividad', 24, '10', '20', 'remarks', 'remarks', 1, 0),
(60, 'checkout', '', '0000-00-00 00:00:00', 'Michael Natividad', 25, '10', '113', 'remarks', 'remarks', 1, 0),
(61, 'checkin', '', '2017-03-04 21:28:15', 'Michael Natividad', 26, '1', '1', '', 'order', 2, 0),
(62, 'checkin', '', '2017-03-04 21:34:02', 'Michael Natividad', 27, '1', '1', '', 'order', 1, 0),
(63, 'checkin', '', '2017-03-04 22:09:55', 'Michael Natividad', 28, '1', '1', '', 'order', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `itemNum` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `prodName` varchar(245) NOT NULL,
  `prodBrand` varchar(245) NOT NULL,
  `prodDesc` varchar(245) NOT NULL,
  `prodPrice` varchar(255) NOT NULL,
  `prodQty` varchar(255) NOT NULL,
  `prodOrderLvl` int(11) NOT NULL,
  `suppID` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '1',
  `date_deleted` date NOT NULL,
  `checkin_notif` int(11) NOT NULL DEFAULT '1',
  `reorder_notif` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`itemNum`, `image`, `prodName`, `prodBrand`, `prodDesc`, `prodPrice`, `prodQty`, `prodOrderLvl`, `suppID`, `date_added`, `flag`, `date_deleted`, `checkin_notif`, `reorder_notif`) VALUES
(4, 'A4Tech Mouse.jpg', 'A4Tech Mouse', 'A4Tech', 'USB', '150', '152', 50, 1, '0000-00-00', 1, '0000-00-00', 0, 0),
(5, '', '15 in 1 Memory card reader', 'Generic', 'USB', '35', '3', 5, 2, '0000-00-00', 1, '0000-00-00', 0, 0),
(6, '', 'DVI to VGA adapter', 'Generic', 'Gold plated', '100', '51', 25, 4, '0000-00-00', 1, '0000-00-00', 0, 0),
(7, '', 'Mini port to VGA adapter', 'Generic', 'For Mac', '280', '27', 10, 5, '0000-00-00', 1, '0000-00-00', 0, 0),
(8, '', 'Forev Gaming Mouse', 'Forev', 'PS/2', '150', '18', 15, 3, '0000-00-00', 1, '0000-00-00', 0, 0),
(9, '', 'Forev Gaming Keyboard', 'Forev', 'PS/2', '180', '107', 15, 1, '0000-00-00', 1, '0000-00-00', 0, 0),
(10, '', 'Kinbas Gaming Headset', 'Nubwo', 'With microphone', '150', '62', 25, 2, '0000-00-00', 1, '0000-00-00', 0, 0),
(11, '', 'Lenovo Laptop', 'Lenovo', '14 inch monitor', '14000', '16', 5, 1, '0000-00-00', 1, '0000-00-00', 0, 0),
(12, '', 'Sample 1', 'Brand 1', 'Desc 1', '20', '100', 50, 1, '0000-00-00', 1, '0000-00-00', 0, 0),
(13, '', 'Mouser', 'Mouse', 'optical', '50', '100', 10, 1, '0000-00-00', 1, '0000-00-00', 0, 0),
(14, '', 'MOUSER 2', 'Mouse', 'optical', '50', '100', 50, 1, '2016-12-07', 0, '0000-00-00', 0, 0),
(15, '', 'KEYBEY', 'KEYBEY', 'keyboard', '10', '100', 10, 1, '2016-12-07', 1, '0000-00-00', 0, 0),
(16, '', 'KEYBEY', 'KEYBEY', 'keyboard', '10', '100', 10, 1, '2016-12-07', 1, '0000-00-00', 0, 0),
(17, '', 'KEYBEY 2', 'KEYBEY 2', 'keyboard', '100', '12', 10, 1, '2016-12-07', 1, '0000-00-00', 0, 0),
(18, '', 'Keyboard 1', 'KEYBEY', 'keyboard', '100', '10', 10, 1, '2016-12-07', 1, '0000-00-00', 0, 0),
(19, '', 'SAMPLE IMAGE', 'IMAPM', 'IMAGAE', '111', '5', 11, 1, '2016-12-07', 1, '0000-00-00', 0, 0),
(20, '', 'AAA Mouse', 'MOUSE', 'MOUSE', '50', '1', 50, 1, '2016-12-07', 1, '0000-00-00', 0, 0),
(21, '', 'YDD Sample', 'YDD', 'YDD Sample', '100', '100', 10, 5, '2016-12-13', 1, '0000-00-00', 0, 0),
(22, '', 'PC Laptop', 'PC', 'Laptop', '100', '1', 10, 1, '2016-12-13', 1, '0000-00-00', 0, 0),
(23, '', 'A4 Tech Mouse', 'A4 Tech', 'USB', '200', '22', 5, 1, '2017-01-24', 1, '0000-00-00', 0, 0),
(24, '', 'Acer Laptop', 'Acer', '14', '20000', '23', 5, 1, '2017-01-24', 1, '0000-00-00', 0, 0),
(25, 'Product X.jpg', 'Product X', 'Brand X', 'Description here', '10', '113', 10, 1, '2017-03-04', 1, '0000-00-00', 1, 0),
(26, '', 'Product 1', 'Brand X 1', 'Description', '1', '1', 1, 2, '2017-03-04', 1, '0000-00-00', 1, 0),
(27, '', 'Prod 1', 'Brand X 1', 'Description 1', '1', '1', 2, 1, '2017-03-04', 1, '0000-00-00', 1, 0),
(28, '', '&#60;h1&#62;Product Y', 'Brand Y', 'Description', '1', '1', 11, 1, '2017-03-04', 1, '0000-00-00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prod_trans`
--

CREATE TABLE `prod_trans` (
  `prod_trans_id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `itemNum` int(11) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prod_trans`
--

INSERT INTO `prod_trans` (`prod_trans_id`, `trans_id`, `itemNum`, `qty`, `price`) VALUES
(1, 1, 1, '3', '450'),
(2, 7, 1, '0', '0'),
(3, 8, 4, '0', '0'),
(4, 10, 1, '0', '0'),
(5, 11, 1, '0', '0'),
(6, 11, 1, '00000', '0'),
(7, 12, 1, '0', '0'),
(8, 13, 1, '0', '0'),
(9, 14, 1, '0', '0'),
(10, 14, 1, '1', '150'),
(11, 1, 1, '5', '750'),
(12, 2, 1, '6', '900'),
(13, 1, 10, '3', '450'),
(14, 1, 8, '5', '750'),
(15, 2, 1, '3', '450'),
(16, 2, 5, '1', '35'),
(17, 4, 8, '12', '1800'),
(18, 5, 1, '2', '300'),
(19, 6, 1, '97', '14550'),
(20, 7, 4, '26', '3900'),
(21, 8, 4, '50', '7500'),
(22, 9, 11, '1', '14000'),
(23, 10, 4, '10', '1500'),
(24, 11, 4, '10', '1500'),
(25, 12, 4, '1', '150'),
(26, 13, 18, '100', '10000'),
(27, 14, 0, '1', '111'),
(28, 15, 19, '1', '111'),
(29, 16, 4, '2', '300'),
(30, 17, 22, '99', '9900'),
(31, 18, 20, '49', '2450'),
(32, 19, 20, '50', '2500'),
(33, 20, 19, '110', '12210');

-- --------------------------------------------------------

--
-- Table structure for table `reconciliation`
--

CREATE TABLE `reconciliation` (
  `recon_id` int(11) NOT NULL,
  `shortage_count` varchar(255) NOT NULL,
  `surplus_count` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reconciliation`
--

INSERT INTO `reconciliation` (`recon_id`, `shortage_count`, `surplus_count`, `date`) VALUES
(1, '3', '2', '2016-12-13 16:25:29'),
(2, '1', '1', '2017-01-24 21:56:05'),
(3, '1', '0', '2017-01-28 18:01:45'),
(4, '0', '1', '2017-01-28 18:16:32');

-- --------------------------------------------------------

--
-- Table structure for table `recon_details`
--

CREATE TABLE `recon_details` (
  `id` int(11) NOT NULL,
  `itemNum` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `logical_count` varchar(255) NOT NULL,
  `physical_count` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recon_details`
--

INSERT INTO `recon_details` (`id`, `itemNum`, `status`, `logical_count`, `physical_count`, `reason`, `remarks`, `date`, `recon_id`) VALUES
(1, 5, 'shortage', '3', '10', 'lost/stolen', 'missing last night', '2016-12-12 16:00:00', 1),
(2, 4, 'shortage', '152', '5', 'damaged', 'accidentally broken', '2016-12-12 16:00:00', 1),
(3, 6, 'shortage', '51', '3', 'damaged', '', '2016-12-12 16:00:00', 1),
(4, 24, 'surplus', '100', '12', 'clerical error', 'Magic', '2016-12-12 16:00:00', 1),
(5, 9, 'surplus', '107', '8', 'clerical error', '', '2016-12-12 16:00:00', 1),
(6, 23, 'shortage', '22', '', '', '', '2017-01-23 16:00:00', 2),
(7, 5, 'surplus', '3', '2', 'damaged', '', '2017-01-23 16:00:00', 2),
(8, 5, 'shortage', '3', '5', '', '', '2017-01-28 10:01:45', 3),
(9, 5, 'surplus', '', '314', '', '', '2017-01-28 10:16:32', 4);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `suppID` int(11) NOT NULL,
  `suppName` varchar(245) NOT NULL,
  `personToContact` varchar(245) NOT NULL,
  `contactNum` varchar(245) NOT NULL,
  `suppAddress` varchar(245) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`suppID`, `suppName`, `personToContact`, `contactNum`, `suppAddress`, `flag`) VALUES
(1, 'IPC Laptop Merchandize', 'Kerwin Lee', '09226749856', '#2000 New Antipolo Street, Tondo, Manila', 1),
(2, 'LC Corporation', 'Chester Chanbonpin', '09236569636', '#1200 San Andres Bukid, Makati', 1),
(3, 'Kinetics', 'Lander Tansekiao', '09064562189', '#55 Solis St. Tondoc Manila', 1),
(4, 'Rising Future', 'Andrew Cho', '09276589160', '#79 Bagong Silang St., Divisoria, Manila', 1),
(5, 'YDD ', 'Lance Han', '09244661666', '#89 Magallanes Ave. Manila', 1),
(6, 'Sample Supplier 1', 'Person 1', '11111111111', 'Address 1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `trans_id` int(11) NOT NULL,
  `empID` int(11) NOT NULL,
  `custID` int(11) NOT NULL,
  `or_num` varchar(255) NOT NULL,
  `trans_date` datetime NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `empID`, `custID`, `or_num`, `trans_date`, `total_amount`, `remarks`) VALUES
(1, 0, 2, 'CR2032-1123', '2016-11-16 00:00:00', '1200', 'Regular Customer'),
(2, 0, 2, '', '2016-11-25 00:00:00', '485', 'checkin'),
(3, 0, 4, '123a', '0000-00-00 00:00:00', '', 'new'),
(4, 0, 7, '12312', '0000-00-00 00:00:00', '1800', ''),
(5, 0, 2, '123', '0000-00-00 00:00:00', '300', ''),
(6, 0, 2, 'CR2032-11442', '2016-11-23 00:00:00', '14550', 'Walk-In Customer'),
(7, 0, 2, '', '0000-00-00 00:00:00', '3900', ''),
(8, 0, 2, 'GJH784521', '0000-00-00 00:00:00', '9000', 'Bulk order'),
(9, 0, 2, 'HGF895621', '0000-00-00 00:00:00', '14000', 'Secondhand'),
(10, 0, 3, '1111111111111', '2016-12-20 00:00:00', '1500', 'remarks'),
(11, 0, 11, '233242234', '2016-12-28 00:00:00', '3000', 'remarks'),
(12, 0, 11, '1111111111111111', '2016-12-15 00:00:00', '150', 'Remarks 1'),
(13, 0, 2, '111111111111', '2016-12-21 00:00:00', '10000', 'remarks'),
(14, 0, 1, '', '2016-12-12 00:00:00', '111', ''),
(15, 0, 1, '', '2016-12-12 00:00:00', '111', ''),
(16, 0, 1, '', '2016-12-12 00:00:00', '300', ''),
(17, 0, 1, '', '2016-12-13 00:00:00', '9900', ''),
(18, 0, 1, '', '2016-12-13 00:00:00', '2450', ''),
(19, 0, 1, '', '2016-12-13 00:00:00', '2500', ''),
(20, 0, 1, '', '2016-12-13 00:00:00', '12210', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empID`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`itemNum`);

--
-- Indexes for table `prod_trans`
--
ALTER TABLE `prod_trans`
  ADD PRIMARY KEY (`prod_trans_id`);

--
-- Indexes for table `reconciliation`
--
ALTER TABLE `reconciliation`
  ADD PRIMARY KEY (`recon_id`);

--
-- Indexes for table `recon_details`
--
ALTER TABLE `recon_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`suppID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `custID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `itemNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `prod_trans`
--
ALTER TABLE `prod_trans`
  MODIFY `prod_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `reconciliation`
--
ALTER TABLE `reconciliation`
  MODIFY `recon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `recon_details`
--
ALTER TABLE `recon_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `suppID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
