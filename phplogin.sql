-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2022 at 05:07 AM
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
  `superuser` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `infoID`, `superuser`) VALUES
(1, 'test', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', NULL, 1),
(2, 'sahhh', '$2y$10$pP3k8A8bNB5q1mQvykcmTextFBBk9ZAGHdoDeLpQH6NT9i.IM7uCC', NULL, 0),
(3, 'asdfg', '$2y$10$9lSeW0Ecn6Nmxye5irf54eXIm.Qq577F/AhxgWsvzZyRDRsY68Dte', NULL, 0),
(4, '12345', '$2y$10$LIiC5R.3piwUU2ayEnXt6OF/6qkPYEIVAGTzHYzkFuHt3dBNkMZaG', NULL, 0),
(5, 'sah', '$2y$10$y6bXt5VBkuPGIBvIW0ab8.cj/nJdCdmQg3tD3qSFivWNgehRYhxYu', NULL, 0),
(6, 'fsdfsd', '$2y$10$S2Qm2ZeXdhhICJm9VDKH9euuDQiMcXbSpF/6FCBvVVAJKEEiwa8U6', NULL, 1),
(7, 'superuser', '$2y$10$OhkWeX0NUWgZOfH8cIX.vO45Bb3LXgF71C50M7gYBBUemjyt2x.YO', NULL, 1),
(8, 'notsuperuser', '$2y$10$YWWRxdXZGVS3ErhoncG/n.WnFoqyBp6TvaJdV7IWnDEJEBTplsJEe', NULL, 0);

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
('Initial Budget', 123, 'inc', 'None', 33, '2022-11-27', NULL),
('trrfdsf', 344, 'inc', 'z', 34, '2022-11-27', NULL),
('123', 123, 'inc', 'z', 35, '2022-11-27', 'test');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `changes`
--
ALTER TABLE `changes`
  MODIFY `changesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
