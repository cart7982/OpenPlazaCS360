-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 10:53 PM
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
('Uncut carnelian', 3, 'D55DCAC5-3A28-41D1-90AC-334E313D9A56', 345, 'Red', 67, 'UncutCarnelian.png'),
('Uncut topaz', 4, 'D55DCAC5-3A28-41D1-90AC-334E313D9A56', 346, 'Yellow', 78, 'UncutTopaz.png'),
('Iron Ingots', 5, '05B4295E-45BF-4AFC-BC8E-6FAB2026E029', 550, 'Hard', 26, 'IronIngots.png'),
('Bronze Ingots', 6, '05B4295E-45BF-4AFC-BC8E-6FAB2026E029', 777, 'Pretty tough', 22, 'BronzeIngots.png'),
('Cows', 7, 'EC626EB6-CBB4-43F1-855C-06E26D827BD0', 435, 'Beefy', 78, 'Cows.png'),
('Sheep', 8, 'EC626EB6-CBB4-43F1-855C-06E26D827BD0', 653, 'Woolly', 45, 'SheepPicture.png');

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
(1, 'Uncut carnelian', 3, 'A1A77936-E143-41EE-8940-F07415B5618A', 35, 2345, 67, 0, 0);

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
('jj', 'jj@jj', '$2y$12$W0kVZ7wOe9Xrvxmgz9UJ8elxxxoh//Yl7t6YFB1MSheuFLGHuBsn.', '8B3E5076-21F7-47E0-807D-3A61C50D8530', '300E7956-2516-4D9C-A659-DACC159A7402', '0'),
('ww', 'ww@ww', '$2y$12$iFDomxtmHkJX2jJ46i5Mh.NSWDSeuF9ExopuiXZItcRICvOYplFru', 'ADD32435-F59F-4E12-BE95-A763C3B6F83A', '0', '0'),
('bb', 'bb@bb', '$2y$12$9BdJzsX38FEiZdkLjV3Fiu5egde4RsiXwOL4XiS/yGCg2KrRCw7aK', '3FA9DBBC-1126-4ADB-965D-A02B38B2ABEA', '0', '0'),
('cc', 'cc@cc', '$2y$12$zKuF6fctUAf84jjcIsdFte5EZ1XIIKQiu2sr2qDlHEjrebt3b4A56', 'D55DCAC5-3A28-41D1-90AC-334E313D9A56', 'A366ABEA-95F3-4FFE-A9C5-23F1F39E9E49', '0'),
('vv', 'vv@vv', '$2y$12$DCZTP7XhoXEqUfcJdAUxlOK1zYiw0140qzXgnT.qJQI97NQF3j51u', 'A1A77936-E143-41EE-8940-F07415B5618A', '0', '3A245ABE-4A71-479C-8A7E-5886F2FCDBAA'),
('aa', 'aa@aa', '$2y$12$fF9W8yKil9IvRHaGeXvilO/WgIRYOOQziZaSVSSGXY8rE30CQXnSq', '05B4295E-45BF-4AFC-BC8E-6FAB2026E029', '9BE7104C-1010-4015-A7E4-0E91690B82E5', '0'),
('dd', 'dd@dd', '$2y$12$RKubi4iBWJZHtLqblV99NeE7OK.smpfwZIewHwXsjRgvam/iT72zC', 'EC626EB6-CBB4-43F1-855C-06E26D827BD0', '00695346-BA6C-4910-A537-0E6766C236C6', '0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
