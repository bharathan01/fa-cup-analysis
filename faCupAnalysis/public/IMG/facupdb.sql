-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 08:59 PM
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
-- Database: `facupdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `fa_cup_teams`
--

CREATE TABLE `fa_cup_teams` (
  `team` varchar(50) DEFAULT NULL,
  `played` int(11) DEFAULT NULL,
  `won` int(11) DEFAULT NULL,
  `drawn` int(11) DEFAULT NULL,
  `lost` int(11) DEFAULT NULL,
  `gf` int(11) DEFAULT NULL,
  `ga` int(11) DEFAULT NULL,
  `gd` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `form` varchar(20) DEFAULT NULL,
  `manager` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fa_cup_teams`
--

INSERT INTO `fa_cup_teams` (`team`, `played`, `won`, `drawn`, `lost`, `gf`, `ga`, `gd`, `points`, `form`, `manager`) VALUES
('Manchester City', 7, 5, 1, 1, 19, 5, 14, 16, 'W, W, W, W, L, W', 'Pep Guardiola'),
('Manchester United', 7, 5, 1, 1, 15, 9, 6, 16, 'W, W, W, L, W, W', 'Erik ten Hag'),
('Coventry City', 7, 5, 0, 2, 16, 8, 8, 15, 'W, W, W, W, L, L', 'Mark Robins'),
('Chelsea FC', 7, 4, 2, 1, 17, 9, 8, 14, 'W, D, W, D, W, W', 'Mauricio Pochettino'),
('Wolverhampton Wanderers', 7, 4, 2, 1, 11, 8, 3, 14, 'D, W, W, D, W, W', 'Gary O\'Neil'),
('Liverpool FC', 7, 4, 1, 2, 17, 11, 6, 13, 'W, W, W, L, L, W', 'Jürgen Klopp'),
('Newcastle United', 7, 4, 0, 3, 11, 11, 0, 12, 'W, W, D, L, L, W', 'Eddie Howe'),
('Leicester City', 6, 3, 1, 2, 10, 8, 2, 10, 'W, D, W, L, W, L', 'Enzo Maresca'),
('Brighton & Hove Albion', 5, 3, 1, 1, 9, 5, 4, 10, 'W, W, L, D, W', 'Roberto De Zerbi'),
('Blackburn Rovers', 5, 3, 1, 1, 13, 6, 7, 10, 'W, W, D, W, L', 'Jon Dahl Tomasson'),
('Leeds United', 5, 3, 1, 1, 12, 8, 4, 10, 'W, W, L, W, D', 'Daniel Farke'),
('Southampton FC', 5, 3, 0, 2, 11, 5, 6, 9, 'W, W, L, W, L', 'Russell Martin'),
('AFC Wimbledon', 5, 3, 0, 2, 11, 8, 3, 9, 'W, W, L, L, W', 'Johnnie Jackson'),
('Luton Town', 6, 3, 0, 3, 8, 8, 0, 9, 'W, W, L, L, L, D', 'Rob Edwards'),
('West Bromwich Albion', 4, 2, 0, 2, 7, 6, 1, 6, 'W, L, L, W', 'Carlos Corberán'),
('Aston Villa', 4, 2, 0, 2, 5, 6, -1, 6, 'W, L, W, L', 'Unai Emery'),
('Sunderland AFC', 4, 2, 0, 2, 7, 9, -2, 6, 'L, W, L, W', 'Tony Mowbray'),
('Derby County', 5, 2, 1, 2, 7, 7, 0, 7, 'D, L, W, W, L', 'Paul Warne'),
('Wigan Athletic', 4, 2, 0, 2, 7, 6, 1, 6, 'W, L, W, L', 'Shaun Maloney'),
('Ipswich Town', 5, 2, 0, 3, 7, 12, -5, 6, 'L, W, W, L, L', 'Kieran McKenna'),
('Port Vale FC', 5, 1, 2, 2, 4, 7, -3, 5, 'L, D, D, W, L', 'Andy Crosby'),
('Eastleigh FC', 5, 1, 1, 3, 9, 14, -5, 4, 'L, W, L, L, L', 'Chris Todd'),
('Shrewsbury Town', 5, 1, 1, 3, 9, 12, -3, 4, 'L, W, L, L, L', 'Matt Taylor'),
('Barnet FC', 5, 1, 1, 3, 4, 9, -5, 4, 'L, L, W, L, D', 'Dean Brennan'),
('Morecambe FC', 4, 1, 1, 2, 4, 8, -4, 4, 'D, W, L, L', 'Derek Adams'),
('Notts County', 4, 1, 1, 2, 4, 7, -3, 4, 'W, L, L, D', 'Luke Williams'),
('Barnsley FC', 4, 1, 1, 2, 6, 10, -4, 4, 'L, D, W, L', 'Neill Collins'),
('Charlton Athletic', 4, 1, 1, 2, 4, 8, -4, 4, 'L, L, W, D', 'Dean Holden'),
('Cambridge United', 5, 1, 1, 3, 7, 12, -5, 4, 'L, D, L, W, L', 'Mark Bonner'),
('Bristol Rovers', 5, 1, 1, 3, 12, 14, -2, 4, 'L, W, L, D, L', 'Joey Barton'),
('Crewe Alexandra', 5, 1, 1, 3, 8, 11, -3, 4, 'D, W, L, L, L', 'Lee Bell'),
('Wycombe Wanderers', 4, 1, 1, 2, 4, 8, -4, 4, 'L, L, W, D', 'Matt Bloomfield'),
('Sheffield United', 3, 1, 1, 1, 4, 4, 0, 4, 'L, W, D', 'Paul Heckingbottom'),
('Fleetwood Town', 3, 1, 0, 2, 3, 5, -2, 3, 'L, W, L', 'Lee Johnson'),
('Walsall FC', 4, 1, 0, 3, 5, 9, -4, 3, 'L, W, L, L', 'Mat Sadler'),
('Harrogate Town', 2, 1, 0, 1, 5, 6, -1, 3, 'W, L', 'Simon Weaver'),
('Sutton United', 4, 1, 0, 3, 5, 11, -6, 3, 'L, W, L, L', 'Matt Gray'),
('Stockport County', 4, 1, 0, 3, 7, 11, -4, 3, 'W, L, L, L', 'Dave Challinor'),
('Maidstone United', 4, 1, 0, 3, 4, 7, -3, 3, 'W, L, L, L', 'George Elokobi'),
('Bromley FC', 1, 0, 0, 1, 0, 2, -2, 0, 'L', 'Andy Woodman');

-- --------------------------------------------------------

--
-- Table structure for table `userschema`
--

CREATE TABLE `userschema` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userschema`
--
ALTER TABLE `userschema`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userschema`
--
ALTER TABLE `userschema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
