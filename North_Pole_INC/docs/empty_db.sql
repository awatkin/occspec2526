-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 15, 2025 at 03:53 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `northpoleinc`
--

-- --------------------------------------------------------

--
-- Table structure for table `deed`
--

CREATE TABLE `deed` (
  `deedid` int NOT NULL,
  `deed` text NOT NULL,
  `description` text NOT NULL,
  `points` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `does`
--

CREATE TABLE `does` (
  `doesid` int NOT NULL,
  `userid` int NOT NULL,
  `deedid` int NOT NULL,
  `addedon` int NOT NULL,
  `doneon` int NOT NULL,
  `staffid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gift`
--

CREATE TABLE `gift` (
  `giftid` int NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `addedon` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` int NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `joinedon` int NOT NULL,
  `role` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staffaudit`
--

CREATE TABLE `staffaudit` (
  `auditid` int NOT NULL,
  `staffid` int NOT NULL,
  `short` text NOT NULL,
  `longdesc` text NOT NULL,
  `addedon` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int NOT NULL,
  `fname` text NOT NULL,
  `sname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `signupdate` int NOT NULL,
  `addressln1` text NOT NULL,
  `addressln2` text NOT NULL,
  `addressln3` text NOT NULL,
  `city / town` text NOT NULL,
  `County / staff` text NOT NULL,
  `post/zip code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `useraudit`
--

CREATE TABLE `useraudit` (
  `auditid` int NOT NULL,
  `userid` int NOT NULL,
  `short` text NOT NULL,
  `longdesc` text NOT NULL,
  `addedon` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wish`
--

CREATE TABLE `wish` (
  `wishid` int NOT NULL,
  `userid` int NOT NULL,
  `giftid` int NOT NULL,
  `addedon` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deed`
--
ALTER TABLE `deed`
  ADD PRIMARY KEY (`deedid`);

--
-- Indexes for table `does`
--
ALTER TABLE `does`
  ADD PRIMARY KEY (`doesid`),
  ADD KEY `userid` (`userid`,`deedid`),
  ADD KEY `deedid` (`deedid`),
  ADD KEY `staffid` (`staffid`);

--
-- Indexes for table `gift`
--
ALTER TABLE `gift`
  ADD PRIMARY KEY (`giftid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`);

--
-- Indexes for table `staffaudit`
--
ALTER TABLE `staffaudit`
  ADD PRIMARY KEY (`auditid`),
  ADD KEY `staffid` (`staffid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `useraudit`
--
ALTER TABLE `useraudit`
  ADD PRIMARY KEY (`auditid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `wish`
--
ALTER TABLE `wish`
  ADD PRIMARY KEY (`wishid`),
  ADD KEY `userid` (`userid`,`giftid`),
  ADD KEY `giftid` (`giftid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deed`
--
ALTER TABLE `deed`
  MODIFY `deedid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `does`
--
ALTER TABLE `does`
  MODIFY `doesid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gift`
--
ALTER TABLE `gift`
  MODIFY `giftid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffaudit`
--
ALTER TABLE `staffaudit`
  MODIFY `auditid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useraudit`
--
ALTER TABLE `useraudit`
  MODIFY `auditid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wish`
--
ALTER TABLE `wish`
  MODIFY `wishid` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `does`
--
ALTER TABLE `does`
  ADD CONSTRAINT `does_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `does_ibfk_2` FOREIGN KEY (`deedid`) REFERENCES `deed` (`deedid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `does_ibfk_3` FOREIGN KEY (`staffid`) REFERENCES `staff` (`staffid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staffaudit`
--
ALTER TABLE `staffaudit`
  ADD CONSTRAINT `staffaudit_ibfk_1` FOREIGN KEY (`staffid`) REFERENCES `staff` (`staffid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `useraudit`
--
ALTER TABLE `useraudit`
  ADD CONSTRAINT `useraudit_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wish`
--
ALTER TABLE `wish`
  ADD CONSTRAINT `wish_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wish_ibfk_2` FOREIGN KEY (`giftid`) REFERENCES `gift` (`giftid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
