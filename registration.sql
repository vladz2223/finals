-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 07:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'csjp@gmail.com', '$2y$10$KFQ.Qh/IIAK9AbIbLHeEg.zKfHuJmzxdHyBmJnSWZL1ITjdJB1Xii'),
(8, 'vladimir@gmail.com', '$2y$10$yBNFv3zFe8d/kbL1wFr9c.e6GX.iXf1qY7z3kLEJrXCYrTABs8Ila');

-- --------------------------------------------------------

--
-- Table structure for table `cba`
--

CREATE TABLE `cba` (
  `cba_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `student` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cba`
--

INSERT INTO `cba` (`cba_id`, `user_id`, `fname`, `lname`, `student`) VALUES
(1, 2, 'John Carl', 'Ababag', 'S22-0336');

-- --------------------------------------------------------

--
-- Table structure for table `ccs`
--

CREATE TABLE `ccs` (
  `ccs_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `student` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ccs`
--

INSERT INTO `ccs` (`ccs_id`, `user_id`, `fname`, `lname`, `student`) VALUES
(1, 3, 'Marjorie', 'Ballesteros', 'S22-0059');

-- --------------------------------------------------------

--
-- Table structure for table `chtm`
--

CREATE TABLE `chtm` (
  `chtm_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `student` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chtm`
--

INSERT INTO `chtm` (`chtm_id`, `user_id`, `fname`, `lname`, `student`) VALUES
(1, 1, 'Jannah', 'Salazar', 'S22-0388');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `department` varchar(20) NOT NULL,
  `birthday` date NOT NULL,
  `student` varchar(120) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`user_id`, `fname`, `lname`, `department`, `birthday`, `student`, `password`) VALUES
(1, 'Jannah', 'Salazar', 'chtm', '2002-02-22', 'S22-0388', '$2y$10$MSo4X6/GQyIrZ2x/opVo0uP7uX9/YRYdq/7sFeaX4Ba'),
(2, 'John Carl', 'Ababag', 'cba', '2001-02-22', 'S22-0336', '$2y$10$reyABsbFo29lUlMseCDh8OpzEN26Hy4YVByRrOm8f/I'),
(3, 'Marjorie', 'Panogaling', 'ccs', '2001-07-22', 'S22-0059', '$2y$10$IA178qSr4SmkszTk9QmfhuC131KJqW/IdRJX8N.aIPz');

-- --------------------------------------------------------

--
-- Table structure for table `shs`
--

CREATE TABLE `shs` (
  `shs_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `student` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cba`
--
ALTER TABLE `cba`
  ADD PRIMARY KEY (`cba_id`),
  ADD KEY `cba_ibfk_1` (`user_id`);

--
-- Indexes for table `ccs`
--
ALTER TABLE `ccs`
  ADD PRIMARY KEY (`ccs_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `chtm`
--
ALTER TABLE `chtm`
  ADD PRIMARY KEY (`chtm_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `shs`
--
ALTER TABLE `shs`
  ADD PRIMARY KEY (`shs_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cba`
--
ALTER TABLE `cba`
  MODIFY `cba_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ccs`
--
ALTER TABLE `ccs`
  MODIFY `ccs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chtm`
--
ALTER TABLE `chtm`
  MODIFY `chtm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shs`
--
ALTER TABLE `shs`
  MODIFY `shs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cba`
--
ALTER TABLE `cba`
  ADD CONSTRAINT `cba_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `department` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ccs`
--
ALTER TABLE `ccs`
  ADD CONSTRAINT `ccs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `department` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chtm`
--
ALTER TABLE `chtm`
  ADD CONSTRAINT `chtm_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `department` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shs`
--
ALTER TABLE `shs`
  ADD CONSTRAINT `shs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `department` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
