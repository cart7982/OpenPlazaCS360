-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2025 at 06:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `openplaza`
--

-- --------------------------------------------------------

--
-- Table structure for table `paymentinfo`
--

CREATE TABLE `paymentinfo` (
  `UserID` varchar(255) NOT NULL,
  `PaymentID` int(36) NOT NULL,
  `CardNumber` varchar(36) NOT NULL,
  `CSV` int(11) NOT NULL,
  `Date` date NOT NULL,
  `StreetAddress` varchar(36) NOT NULL,
  `Zipcode` int(11) NOT NULL,
  `City` text NOT NULL,
  `State` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymentinfo`
--

INSERT INTO `paymentinfo` (`UserID`, `PaymentID`, `CardNumber`, `CSV`, `Date`, `StreetAddress`, `Zipcode`, `City`, `State`) VALUES
('1', 1, '111', 111, '0000-00-00', '111', 111, '111', '111'),
('1', 2, '111', 111, '0000-00-00', '111', 111, '111', '111'),
('1', 3, '111', 111, '0000-00-00', '111', 111, '111', '111'),
('1', 4, '111', 111, '0000-00-00', '111', 111, '111', '111'),
('1', 5, '111', 111, '0000-00-00', '111', 111, '111', '111'),
('1', 6, '111', 111, '0000-00-00', '111', 111, '111', '111'),
('1', 7, '111', 111, '0000-00-00', '111', 111, '111', '111'),
('1', 8, '111', 111, '0000-00-00', '111', 111, '111', '111'),
('1', 9, '111', 111, '0000-00-00', '111', 111, '111', '111'),
('1', 10, '111', 111, '1111-11-11', '111', 111, '111', '111'),
('1', 11, '111', 111, '1111-11-11', '111', 111, '111', '111'),
('2', 12, '222', 222, '0000-00-00', '222', 222, '222', '222'),
('2', 13, '222', 222, '0000-00-00', '222', 222, '222', '222'),
('2', 14, '333', 333, '0000-00-00', '333', 333, '333', '333'),
('2', 15, '111', 111, '1111-11-11', '111', 111, '111', '111');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductName` text NOT NULL,
  `ProductID` int(11) NOT NULL,
  `UserID` varchar(255) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductName`, `ProductID`, `UserID`, `Amount`, `Description`, `Price`) VALUES
('vv', 8, '1', 19, 'vv', 77),
('gg', 9, '2', 10, 'gg', 44),
('mm', 16, '3', 9, 'mm', 55),
('cc', 17, '4', 23, 'cc', 55),
('Cotton', 19, '0', 130, 'Woolly', 55),
('Iron Ingots', 20, '1', 40, 'Pretty tough', 66),
('Copper Ingots', 21, '1', 135, 'Coppery', 35),
('Tin Ingots', 22, '2', 50, 'Whatever', 25),
('Green Opals', 23, '3', 100, 'Shiny green', 400);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `TransactionID` int(11) NOT NULL,
  `ProductName` text NOT NULL,
  `ProductID` int(11) NOT NULL,
  `UserID` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `TotalPrice` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `PaymentID` int(11) NOT NULL,
  `PAID` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`TransactionID`, `ProductName`, `ProductID`, `UserID`, `Quantity`, `TotalPrice`, `Price`, `PaymentID`, `PAID`) VALUES
(51, 'pp', 14, '1', 10, 550, 55, 6, 1),
(52, 'cc', 17, '1', 13, 715, 55, 6, 1),
(53, 'pp', 14, '1', 10, 550, 55, 8, 1),
(54, 'cc', 17, '1', 13, 715, 55, 8, 1),
(55, 'rr', 15, '1', 5, 330, 66, 9, 1),
(56, 'cc', 17, '1', 13, 715, 55, 9, 1),
(57, 'pp', 14, '1', 10, 550, 55, 10, 1),
(58, 'cc', 17, '1', 7, 385, 55, 10, 1),
(59, 'pp', 14, '1', 10, 550, 55, 11, 1),
(60, 'oo', 18, '1', 8, 616, 77, 11, 1),
(61, 'oo', 18, '2', 8, 616, 77, 12, 1),
(62, 'Cotton', 19, '2', 10, 550, 55, 12, 1),
(63, 'oo', 18, '2', 10, 770, 77, 13, 1),
(64, 'Cotton', 19, '2', 10, 550, 55, 13, 1),
(65, 'Cotton', 19, '3', 20, 1100, 55, 0, 0),
(66, 'Copper Ingots', 21, '2', 15, 525, 35, 14, 1),
(67, 'Iron Ingots', 20, '2', 10, 660, 66, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `UserID` varchar(36) NOT NULL,
  `isSeller` tinyint(1) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Email`, `Password`, `UserID`, `isSeller`, `isAdmin`) VALUES
('aa', 'aa@aa', 'aa', '1', 0, 0),
('bbb', 'bbb@bb', 'bbb', '2', 0, 0),
('cc', 'cc@cc', 'cc', '3', 0, 0),
('dd', 'dd@dd', 'dd', '4', 0, 0),
('tt', 'tt@tt', 'tt', '0', 0, 0),
('bbb', 'bbb@bb', 'bbb', '2', 0, 0),
('ll', 'll@ll', 'll', '37', 0, 0),
('ff', 'ff@ff', 'ff', 'EDB15DAB-ACE4-42CA-A3CC-337444736A7D', 0, 0),
('rr', 'rr@rr', 'rr', '08030BB3-7A10-4F3F-BAA6-6A1ABBDF34FB', 0, 0),
('hh', 'hh@hh', 'hh', '1B7C2249-207E-400B-8A9C-C12F5CCA0588', 0, 0),
('qq', 'qq@qq', 'qq', 'B0DC98E1-9A63-42A6-B9EB-9D06777F43CB', 0, 0),
('yy', 'yy@yy', 'yy', '6818B5EC-87D7-4C22-A474-4D0DC018E1C6', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
