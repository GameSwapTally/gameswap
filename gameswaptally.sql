-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2016 at 02:11 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gameswaptally`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobkiller42_games`
--

CREATE TABLE `bobkiller42_games` (
  `Game` varchar(255) NOT NULL,
  `System` enum('XBOX ONE','XBOX 360','XBOX','PS4','PS3','PS2','PS1','PSP','PSVita','Wii U','Wii','PC','GameCube','3DS') NOT NULL,
  `wish/own` enum('Wished','Owned') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobkiller42_games`
--

INSERT INTO `bobkiller42_games` (`Game`, `System`, `wish/own`) VALUES
('Call of Duty: Black Ops 3', 'PS4', 'Wished'),
('Super Mario Strikers Charged', 'Wii', 'Owned');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `title` varchar(50) NOT NULL,
  `system` enum('XBOX ONE','XBOX 360','XBOX','PS4','PS3','PS2','PS1','PSP','PSVita','Wii U','Wii','PC','GameCube','3DS') NOT NULL,
  `year` int(255) NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `wish` int(50) NOT NULL DEFAULT '0',
  `own` int(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`title`, `system`, `year`, `publisher`, `wish`, `own`) VALUES
('Call of Duty: Black Ops 3', 'PS4', 2015, 'Activision', 0, 0),
('Super Mario Strikers Charged', 'Wii', 2007, 'Nintendo', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `h00pslamerjamer_games`
--

CREATE TABLE `h00pslamerjamer_games` (
  `Game` varchar(255) NOT NULL,
  `System` enum('XBOX ONE','XBOX 360','XBOX','PS4','PS3','PS2','PS1','PSP','PSVita','Wii U','Wii','PC','GameCube','3DS') NOT NULL,
  `wish/own` enum('Wished','Owned') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h00pslamerjamer_games`
--

INSERT INTO `h00pslamerjamer_games` (`Game`, `System`, `wish/own`) VALUES
('Call of Duty: Black Ops 3', 'PS4', 'Owned'),
('Super Mario Strikers Charged', 'Wii', 'Wished');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userName` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL,
  `location` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userName`, `email`, `password`, `location`) VALUES
('bobkiller42', 'yomama@gmail.com', 'yomamaish0t', 'Salley Hall'),
('h00pSlamerJamer', 'lakermaker@yahoo.com', 'kobelikesm3', 'Dirac');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`title`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userName`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
