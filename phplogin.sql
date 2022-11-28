-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 12:14 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phplogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `infoID` int(11) DEFAULT NULL,
  `superuser` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(64) NOT NULL,
  `phone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `infoID`, `superuser`, `email`, `phone`) VALUES
(9, 'sah', '$2y$10$bMSruq6wAuO86zuDAHpPHO/rDS8Rhj4S1aO6SicoVLM8mJ.ujGqvm', NULL, 1, 'sahibjot@gmail.com', NULL),
(10, 'user', '$2y$10$/djP8sqf9NuTYnIEltUiqu6n4ZEJRyKdeNRkx8m8cPsMIPfvZYYSO', NULL, 0, 'sahibjotsc@gmail.com', NULL),
(11, 'nipung', '$2y$10$abJIEPUVR.gpMs1BvEN.iO8JRWKNLoHSAGcrlZiNRGOZpYCGRN5FW', NULL, 1, '123@gmail.com', NULL),
(12, 'nipun', '$2y$10$pjLae2Ed6G6yR/XBzcnqkeaWoy6HcBD7eVF11X9l9XyUC2LzbtBKS', NULL, 0, 'nipun@gmail.com', NULL),
(13, '123', '$2y$10$PpIIzQHQRqLLpP1xQxsq/.bvXe3/TxxdJWZ/ZV3ojmvdhAL1ry6V6', NULL, 0, '123@gmail.com', NULL),
(14, '456', '$2y$10$ChBQ6GCT53GU.KvxDPz1m.kSA514Hsi.mGykRigmj3xcOhsCnYfU2', NULL, 1, '456@gmail.com', NULL),
(15, 'n', '$2y$10$fm.8ZQ1PSUDnHXNCtgJu7ufchX3K8YkWI1iNFZTgTMHfzz//AN3ce', NULL, 127, 'n@n.com', 0),
(16, '789', '$2y$10$0RJY3WR0icNspLGV3e.QUeKe91NbqyDN./zL4uYPPzb/rvU./PEdy', NULL, 127, '789@gmail.com', 0),
(17, '987', '$2y$10$1vVKi3scPtao6vLm.2VL1eCQtAxGIThL3.ip0Gghcsg7NAdxnNCha', NULL, 127, '987@gmail.com', 0),
(18, '604', '$2y$10$aGWdjb5mQrefUB.aTLVTYuJklPDBY3jNGzVckpImz7MSOTI6unn1W', NULL, 127, '604@604.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`name`, `description`) VALUES
('CustomCategoryyyyyy', ''),
('dasd', ''),
('fdgg', 'gfdgfg'),
('fds', '2323233232'),
('fdsfds', ''),
('fsdfds', '45rfgdsfg'),
('fsdfsd', '34fesdfds'),
('gdffdg', 'gfdgfd'),
('None', ''),
('OOOOOOOOOOOOOOOOOOOOOOOOOOOO', ''),
('OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO', ''),
('rrewrew', 'rewrewrewrew'),
('z', 'z');

-- --------------------------------------------------------

--
-- Table structure for table `changes`
--

CREATE TABLE `changes` (
  `description` varchar(32) NOT NULL,
  `value` double NOT NULL,
  `type` varchar(4) NOT NULL,
  `category` varchar(32) NOT NULL,
  `changesID` int(11) NOT NULL,
  `dateOf` date DEFAULT curdate(),
  `accountName` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `changes`
--

INSERT INTO `changes` (`description`, `value`, `type`, `category`, `changesID`, `dateOf`, `accountName`) VALUES
('Initial Budget', 123, 'inc', 'None', 38, '2022-11-28', 'sah'),
('121', 121, 'exp', 'z', 41, '2022-11-28', 'sah'),
('1', 1, 'exp', 'z', 42, '2022-11-28', 'sah'),
('23', 12345, 'inc', 'z', 43, '2022-11-28', 'sah'),
('2133', 12345, 'exp', 'z', 44, '2022-11-28', 'sah'),
('1', 1, 'inc', 'z', 45, '2022-11-28', 'sah'),
('go', 12, 'exp', 'z', 46, '2022-11-28', 'nipung'),
('go', 12, 'exp', 'z', 47, '2022-11-28', 'nipung'),
('ok', 69, 'inc', 'z', 48, '2022-11-28', 'nipun'),
('g', 47, 'inc', 'z', 53, '2022-11-28', 'nipun'),
('gg', 47, 'exp', 'z', 54, '2022-11-28', 'nipun');

-- --------------------------------------------------------

--
-- Table structure for table `personal_information`
--

CREATE TABLE `personal_information` (
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `nickname` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `phone_number` varchar(32) NOT NULL,
  `birthday` date NOT NULL,
  `infoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `infoIDPK` (`infoID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `changes`
--
ALTER TABLE `changes`
  ADD PRIMARY KEY (`changesID`),
  ADD KEY `catagory` (`category`);

--
-- Indexes for table `personal_information`
--
ALTER TABLE `personal_information`
  ADD PRIMARY KEY (`infoID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `changes`
--
ALTER TABLE `changes`
  MODIFY `changesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `personal_information`
--
ALTER TABLE `personal_information`
  MODIFY `infoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `infoIDPK` FOREIGN KEY (`infoID`) REFERENCES `personal_information` (`infoID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
