-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2020 at 08:42 AM
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
-- Table structure for table `socioeconomicstatus`
--

CREATE TABLE `socioeconomicstatus` (
  `ID` int(11) NOT NULL,
  `Code` varchar(50) COLLATE utf8_bin NOT NULL,
  `Description` varchar(128) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `socioeconomicstatus`
--

INSERT INTO `socioeconomicstatus` (`ID`, `Code`, `Description`) VALUES
(1, '01', 'Employed'),
(2, '02', 'Unemployed, seeking work'),
(3, '03', 'Not working, not looking'),
(4, '04', 'Home-maker (not working)'),
(5, '06', 'Scholar/student (not w.)'),
(6, '07', 'Pensioner/retired (not w.)'),
(7, '08', 'Not working - disabled'),
(8, '09', 'Not working - no wish to w'),
(9, '10', 'Not working - N.E.C.'),
(10, '97', 'N/A: aged <15'),
(11, '98', 'N/A: Institution'),
(12, 'U', 'Unspecified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `socioeconomicstatus`
--
ALTER TABLE `socioeconomicstatus`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `socioeconomicstatus`
--
ALTER TABLE `socioeconomicstatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
