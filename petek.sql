-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2020 at 10:28 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petek`
--

-- --------------------------------------------------------

--
-- Table structure for table `fadmin`
--

CREATE TABLE `fadmin` (
  `id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fadmin`
--

INSERT INTO `fadmin` (`id`) VALUES
(0),
(1),
(2),
(3);

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `adminId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`id`, `name`, `adminId`) VALUES
(1, 'Smith', 1),
(2, 'Williams', 0),
(3, 'Hassan', 2),
(6, 'Butto', 3);

-- --------------------------------------------------------

--
-- Table structure for table `familylists`
--

CREATE TABLE `familylists` (
  `listId` int(6) NOT NULL,
  `familyId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `familylists`
--

INSERT INTO `familylists` (`listId`, `familyId`) VALUES
(2, 1),
(3, 2),
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `invites`
--

CREATE TABLE `invites` (
  `senderId` int(6) NOT NULL,
  `sendedToId` int(6) NOT NULL,
  `familyId` int(6) NOT NULL,
  `approved` char(1) NOT NULL DEFAULT 'W' CHECK (`approved` in ('Y','N','W'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invites`
--

INSERT INTO `invites` (`senderId`, `sendedToId`, `familyId`, `approved`) VALUES
(2, 3, 1, 'W'),
(3, 3, 2, 'W');

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `creteTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`id`, `name`, `creteTime`) VALUES
(1, 'list1', '2020-09-03 21:25:46'),
(2, 'List2', '2020-09-03 22:14:57'),
(3, 'List3', '2020-09-03 22:47:05'),
(4, 'List3', '2020-09-03 22:47:08'),
(5, 'List4', '2020-09-03 23:10:09'),
(6, 'List5', '2020-09-03 23:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `listproducts`
--

CREATE TABLE `listproducts` (
  `ListId` int(6) NOT NULL,
  `ProductId` int(6) NOT NULL,
  `amount` int(6) DEFAULT NULL CHECK (`amount` >= 0),
  `done` char(1) NOT NULL CHECK (`done` = 'Y' or `done` = 'N')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `listproducts`
--

INSERT INTO `listproducts` (`ListId`, `ProductId`, `amount`, `done`) VALUES
(1, 1, 0, 'N'),
(1, 2, 0, 'N'),
(1, 6, 0, 'N'),
(2, 4, 0, 'N'),
(3, 5, 0, 'N'),
(4, 3, 1, 'n'),
(4, 7, 3, 'n'),
(5, 9, 10, 'n');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`) VALUES
(4, 'Apple'),
(6, 'Banana'),
(10, 'cola'),
(5, 'icecream'),
(2, 'Meat'),
(1, 'Milk'),
(7, 'pineaplle'),
(3, 'Salad'),
(9, 'water');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(6) UNSIGNED NOT NULL,
  `userId` int(6) NOT NULL,
  `adminId` int(6) NOT NULL,
  `approved` char(1) NOT NULL DEFAULT 'W' CHECK (`approved` in ('Y','N','W')),
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `userId`, `adminId`, `approved`, `date`) VALUES
(1, 1, 1, 'W', '2020-09-03 22:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `userlists`
--

CREATE TABLE `userlists` (
  `listId` int(6) NOT NULL,
  `userId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlists`
--

INSERT INTO `userlists` (`listId`, `userId`) VALUES
(1, 1),
(2, 1),
(3, 2),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `Email` varchar(50) NOT NULL CHECK (`Email` like '_%@_%._%'),
  `pswrd` varchar(20) NOT NULL CHECK (octet_length(`pswrd`) >= 5),
  `Nickname` varchar(30) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `lostKeyPass` varchar(10) DEFAULT NULL,
  `familyId` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Email`, `pswrd`, `Nickname`, `phone`, `lostKeyPass`, `familyId`) VALUES
(1, 'admin@admin.com', '12345', NULL, NULL, NULL, NULL),
(2, 'amneh.hassan@gmail.com', '12345678', NULL, NULL, '\"!_hOyOSlB', 3),
(3, 'amneh.hassan@hotmail.com', '123456', 'Amneh', '0528184457', 'NULL', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fadmin`
--
ALTER TABLE `fadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `adminId` (`adminId`);

--
-- Indexes for table `familylists`
--
ALTER TABLE `familylists`
  ADD PRIMARY KEY (`listId`,`familyId`);

--
-- Indexes for table `invites`
--
ALTER TABLE `invites`
  ADD PRIMARY KEY (`senderId`,`sendedToId`,`familyId`);

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listproducts`
--
ALTER TABLE `listproducts`
  ADD PRIMARY KEY (`ListId`,`ProductId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- Indexes for table `userlists`
--
ALTER TABLE `userlists`
  ADD PRIMARY KEY (`listId`,`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `lostKeyPass` (`lostKeyPass`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `list`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
