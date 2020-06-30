-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2020 at 08:40 AM
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
-- Table structure for table `nationality`
--

CREATE TABLE `nationality` (
  `ID` int(11) NOT NULL,
  `Code` varchar(50) COLLATE utf8_bin NOT NULL,
  `Description` varchar(128) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `nationality`
--

INSERT INTO `nationality` (`ID`, `Code`, `Description`) VALUES
(1, 'AIS', 'Asian countries'),
(2, 'ANG', 'Angola'),
(3, 'AUS', 'Australia Oceania countries'),
(4, 'BOT', 'Botswana'),
(5, 'EUR', 'European countries'),
(6, 'LES', 'Lesotho'),
(7, 'MAL', 'Malawi'),
(8, 'MAU', 'Mauritius'),
(9, 'MOZ', 'Mozambique'),
(10, 'NAM', 'Namibia'),
(11, 'NOR', 'North American countries'),
(12, 'NOT', 'N/A: Institution'),
(13, 'OOC', 'Other & rest of Oceania'),
(14, 'ROA', 'Rest of Africa'),
(15, 'SA', 'South Africa'),
(16, 'SDC', 'SADC except SA'),
(17, 'SEY', 'Seychelles'),
(18, 'SOU', 'South / Central American c'),
(19, 'SWA', 'Swaziland'),
(20, 'TAN', 'Tanzania'),
(21, 'U', 'Unspecified'),
(22, 'ZAI', 'Zaire'),
(23, 'ZAM', 'Zambia'),
(24, 'ZIM', 'Zimbabwe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nationality`
--
ALTER TABLE `nationality`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nationality`
--
ALTER TABLE `nationality`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
