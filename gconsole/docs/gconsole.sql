-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2025 at 01:51 PM
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
-- Database: `gconsole`
--

-- --------------------------------------------------------

--
-- Table structure for table `console`
--

CREATE TABLE `console` (
  `console_id` int(11) NOT NULL,
  `manufacturer` text NOT NULL,
  `c_name` text NOT NULL,
  `release_date` text NOT NULL,
  `controller_no` int(11) NOT NULL,
  `bit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `console`
--

INSERT INTO `console` (`console_id`, `manufacturer`, `c_name`, `release_date`, `controller_no`, `bit`) VALUES
(1, 'Nintendo', 'Switch 2', '15/03/2025', 4, 64),
(2, 'Nintendo', 'Switch', '19/03/2007', 4, 64),
(3, 'Sega', 'Mega Drive', '23/05/1993', 2, 16),
(4, 'Microsoft', 'Xbox 360', '25/11/2005', 4, 64),
(5, 'Sony', 'Playstation 5', '14/10/2020', 4, 128),
(6, 'Masterrace', 'PC', '01/01/1970', 1, 64);

-- --------------------------------------------------------

--
-- Table structure for table `owns`
--

CREATE TABLE `owns` (
  `owns_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `console_id` int(11) NOT NULL,
  `buy_date` text NOT NULL,
  `link_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owns`
--

INSERT INTO `owns` (`owns_id`, `user_id`, `console_id`, `buy_date`, `link_date`) VALUES
(1, 1, 1, '25/09/2025', '25/09/2025'),
(2, 1, 2, '25/09/2025', '25/09/2025'),
(3, 1, 3, '25/09/2025', '25/09/2025'),
(4, 1, 4, '25/09/2025', '25/09/2025'),
(5, 1, 5, '25/09/2025', '25/09/2025'),
(6, 1, 6, '25/09/2025', '25/09/2025'),
(7, 2, 6, '25/09/2025', '25/09/2025'),
(8, 2, 3, '25/09/2025', '25/09/2025'),
(9, 3, 4, '25/09/2025', '25/09/2025'),
(10, 3, 5, '25/09/2025', '25/09/2025'),
(11, 4, 1, '25/09/2025', '25/09/2025'),
(12, 4, 2, '25/09/2025', '25/09/2025'),
(13, 5, 4, '25/09/2025', '25/09/2025'),
(14, 5, 6, '25/09/2025', '25/09/2025'),
(15, 6, 3, '25/09/2025', '25/09/2025'),
(16, 6, 4, '25/09/2025', '25/09/2025');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `signupdate` text NOT NULL,
  `dob` text NOT NULL,
  `country` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `signupdate`, `dob`, `country`) VALUES
(1, 'adwatkin', 'password', '25/09/2025', '22/02/1983', 'United Kingdom'),
(2, 'albert', 'password1', '25/09/2025', '18/05/2009', 'United Kingdom'),
(3, 'fred', 'password2', '25/08/2024', '13/08/1985', 'United Kingdom'),
(4, 'barry', 'password3', '12/02/2024', '23/12/2007', 'United Kingdom'),
(5, 'steve', 'password4', '23/05/2025', '22/05/2007', 'United Kingdom'),
(6, 'jeff', 'password5', '23/06/2023', '23/06/2000', 'United Kingdom');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `console`
--
ALTER TABLE `console`
  ADD PRIMARY KEY (`console_id`);

--
-- Indexes for table `owns`
--
ALTER TABLE `owns`
  ADD PRIMARY KEY (`owns_id`),
  ADD KEY `user_id` (`user_id`,`console_id`),
  ADD KEY `console_id` (`console_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `console`
--
ALTER TABLE `console`
  MODIFY `console_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `owns`
--
ALTER TABLE `owns`
  MODIFY `owns_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `owns`
--
ALTER TABLE `owns`
  ADD CONSTRAINT `owns_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owns_ibfk_2` FOREIGN KEY (`console_id`) REFERENCES `console` (`console_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
