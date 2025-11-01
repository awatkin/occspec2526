-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2025 at 02:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `primaryoaks`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `joindate` int(11) NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adminaudit`
--

CREATE TABLE `adminaudit` (
  `autidid` int(11) NOT NULL,
  `adminid` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `longdesc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `auditid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  `code` text NOT NULL,
  `auditdescrip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`auditid`, `date`, `userid`, `code`, `auditdescrip`) VALUES
(1, '2025-11-01 00:00:00', 2, 'REG', 'Registration of new user'),
(2, '2025-11-01 00:00:00', 2, 'LGI', 'User has successfully logged in'),
(3, '2025-11-01 00:00:00', 2, 'LGO', 'User has successfully logged out'),
(4, '2025-11-01 00:00:00', 2, 'LGI', 'User has successfully logged in'),
(5, '2025-11-01 00:00:00', 2, 'APB', 'Updated their booking for a new time / date'),
(6, '2025-11-01 00:00:00', 2, 'UPB', 'Updated their booking for a new time / date');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `bookid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `appointmentdate` int(11) NOT NULL,
  `bookedon` int(11) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bookid`, `userid`, `staffid`, `appointmentdate`, `bookedon`, `status`) VALUES
(1, 2, 1, 1762729800, 1762002338, 'BKD');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` int(11) NOT NULL,
  `role` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `fname` text NOT NULL,
  `sname` text NOT NULL,
  `room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `role`, `email`, `password`, `fname`, `sname`, `room`) VALUES
(1, 'doc', 'a.w@g.com', '$2y$10$eTruWQMvHdi0/XyMbCgxt.LK42pipIrx4rdkSqd2b2daawoA10qHW', 'A', 'W', 3),
(2, 'nur', 'g.h@gh.com', '$2y$10$sDUFVLKdhDYvmwNfoXSEVeHHU1sJRmdsFURbkoKX3SlBvtvw6xASG', 'H', 'J', 2),
(3, 'adm', 'g.l@po.com', '$2y$10$b9xyQ24bPQIWKqcLkT7GjetJqXS4CB2CJ0X60tgyejh7/Pyr2vvS.', 'Y', 'T', 4);

-- --------------------------------------------------------

--
-- Table structure for table `staffaudit`
--

CREATE TABLE `staffaudit` (
  `sauditid` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `code` text NOT NULL,
  `auditdescrip` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `fname` text NOT NULL,
  `sname` text NOT NULL,
  `dob` date NOT NULL,
  `sign_up` date NOT NULL,
  `addressln1` text NOT NULL,
  `addressln2` text NOT NULL,
  `postcode` text NOT NULL,
  `county` text NOT NULL,
  `phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `email`, `password`, `fname`, `sname`, `dob`, `sign_up`, `addressln1`, `addressln2`, `postcode`, `county`, `phone`) VALUES
(1, 'a.w@g.com', '$2y$10$05z4fzEMf6SbXBpx/ohm1edqVA4aoVTXUVZxAnB9BqKyFUT1G70fK', 'A', 'W', '2025-10-06', '2025-10-06', '23sfgwev', '', 'wfw', 'wcowe', '9877'),
(2, 'adam.watkin@gmail.com', '$2y$10$/wzw3mNBzPClqw9mNRdW0OVAuEgtk2zbe7AIZ0BqMlcPVqD80/v8K', 'A', 'W', '2025-11-01', '2025-11-01', 'j', 'hg', 'hg', 'hg', 'yg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `adminaudit`
--
ALTER TABLE `adminaudit`
  ADD PRIMARY KEY (`autidid`);

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`auditid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bookid`),
  ADD KEY `userid` (`userid`,`staffid`),
  ADD KEY `staffid` (`staffid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`);

--
-- Indexes for table `staffaudit`
--
ALTER TABLE `staffaudit`
  ADD PRIMARY KEY (`sauditid`),
  ADD KEY `staffid` (`staffid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adminaudit`
--
ALTER TABLE `adminaudit`
  MODIFY `autidid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `auditid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staffaudit`
--
ALTER TABLE `staffaudit`
  MODIFY `sauditid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `audit_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`staffid`) REFERENCES `staff` (`staffid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staffaudit`
--
ALTER TABLE `staffaudit`
  ADD CONSTRAINT `staffaudit_ibfk_1` FOREIGN KEY (`staffid`) REFERENCES `staff` (`staffid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
