-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 06:26 PM
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
  `Price` int(11) NOT NULL,
  `ImagePath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductName`, `ProductID`, `UserID`, `Amount`, `Description`, `Price`, `ImagePath`) VALUES
('Iron Ingots', 1, 'EDB15DAB-ACE4-42CA-A3CC-337444736A7D', 500, 'Hard', 35, '');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `UserID` varchar(36) NOT NULL,
  `VendorID` varchar(255) NOT NULL,
  `AdminID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Email`, `Password`, `UserID`, `VendorID`, `AdminID`) VALUES
('vv', 'vv@vv', '$2y$12$9Nf3Es.Yvzaf5foEJqGSfenP567repJoFQBk0itzIu7cbl8e8U7NW', '274DCB93-75B6-4418-90F9-B6EE56FBD231', '0', 'AE3B045C-8970-4E7A-B892-2671039871E1'),
('hj', 'hj@hj', '$2y$12$QSQDSEj.cW6R72UmaAMbZuD75UHPnJp.ULG0g0dNBKKM2Bbuy/iOm', '8B3E5076-21F7-47E0-807D-3A61C50D8530', '300E7956-2516-4D9C-A659-DACC159A7402', '0'),
('rt', 'rt@rt', '$2y$12$FT0NEAZ2nJ3nFDYX3wLuV.fPmZTgG6ZuTumazKjSjgI8E.HnQAxtK', '2AFFD3C0-BD8D-45E0-922C-48B47742EF23', '0', '0'),
('et', 'et@et', '$2y$12$qfDlp4n8v5jkx3lFVvEkwOUlCCGZtTy5tSadvgPWIZoEbiW4VYFqe', 'C1F92A4F-9C8D-474C-BA64-CBE73B5A2B7A', '0', '0'),
('aa', 'aa@aa', '$2y$12$d6G67EWK2ngbyJ3lA4Jvm.wtWLEqko2JG8J867vUUajRaHDc0QkKy', 'ADD32435-F59F-4E12-BE95-A763C3B6F83A', '0', '0'),
('bb', 'bb@bb', '$2y$12$9BdJzsX38FEiZdkLjV3Fiu5egde4RsiXwOL4XiS/yGCg2KrRCw7aK', '3FA9DBBC-1126-4ADB-965D-A02B38B2ABEA', '0', '0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
