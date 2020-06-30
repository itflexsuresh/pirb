-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2020 at 08:35 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pirb1`
--

-- --------------------------------------------------------

--
-- Table structure for table `disabilitystatus`
--

CREATE TABLE `disabilitystatus` (
  `ID` int(11) NOT NULL,
  `Code` varchar(50) COLLATE utf8_bin NOT NULL,
  `Description` varchar(128) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `disabilitystatus`
--

INSERT INTO `disabilitystatus` (`ID`, `Code`, `Description`) VALUES
(1, '01', 'Sight (even with glasses)'),
(2, '02', 'Hearing (even with h. aid)'),
(3, '03', 'Communication(talk/listen)'),
(4, '04', 'Physical (move/stand etc)'),
(5, '05', 'Intellectual (learn etc)'),
(6, '06', 'Emotional (behav/psych)'),
(7, '07', 'Multiple'),
(8, '09', 'Disabled but unspecified'),
(9, 'N', 'None'),
(10, 'N - was 01', 'None now - was Sight'),
(11, 'N - was 02', 'None now - was Hearing'),
(12, 'N - was 03', 'None now - was Communic'),
(13, 'N - was 04', 'None now - was Physical'),
(14, 'N - was 05', 'None now - was Intellect'),
(15, 'N - was 06', 'None now - was Emotional'),
(16, 'N - was 07', 'None now - was Multiple'),
(17, 'N - was 09', 'None now - was Disabled but unspecified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disabilitystatus`
--
ALTER TABLE `disabilitystatus`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disabilitystatus`
--
ALTER TABLE `disabilitystatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
