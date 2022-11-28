-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2022 at 09:22 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
  `email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `infoID`, `superuser`, `email`) VALUES
(9, 'sah', '$2y$10$bMSruq6wAuO86zuDAHpPHO/rDS8Rhj4S1aO6SicoVLM8mJ.ujGqvm', NULL, 1, 'sahibjot@gmail.com'),
(10, 'user', '$2y$10$/djP8sqf9NuTYnIEltUiqu6n4ZEJRyKdeNRkx8m8cPsMIPfvZYYSO', NULL, 0, 'sahibjotsc@gmail.com');

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
('1', 1, 'inc', 'z', 45, '2022-11-28', 'sah');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `changes`
--
ALTER TABLE `changes`
  MODIFY `changesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
