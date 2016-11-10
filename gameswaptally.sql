-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2016 at 09:18 PM
-- Server version: 5.5.52-0+deb8u1
-- PHP Version: 5.6.27-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gameswaptally`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobkiller42_games`
--

CREATE TABLE IF NOT EXISTS `bobkiller42_games` (
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

CREATE TABLE IF NOT EXISTS `games` (
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

CREATE TABLE IF NOT EXISTS `h00pslamerjamer_games` (
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

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `signup` datetime NOT NULL,
  `lastlogin` datetime NOT NULL,
  `activated` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `ip`, `signup`, `lastlogin`, `activated`) VALUES
(1, 'garrettschmitt', 'garr.schm@gmail.com', 'test', NULL, '68.59.125.59', '2016-11-09 18:36:16', '2016-11-09 18:37:36', '1');

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
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
