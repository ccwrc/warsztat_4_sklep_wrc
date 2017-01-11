-- phpMyAdmin SQL Dump
-- version 4.6.5.2deb1+deb.cihar.com~xenial.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 11, 2017 at 05:36 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wrcshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `admin_password` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `admin_name` varchar(250) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`) VALUES
(2, 'admin2@gmail.elo', '$2y$10$QKAIfgZCDToqEKF6bXJppe.p2Q7VnX3rLI6q7gl5zwp2QQpaITTJG', 'admin2'),
(4, 'admin4@gmail.elo', '$2y$10$omrwh.JeNo/n/ENMdfvrJeoEk3ph5FzzkPurnJGpp//MrtPgWtg9y', 'admin4');

-- --------------------------------------------------------

--
-- Table structure for table `Item`
--

CREATE TABLE `Item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `item_description` blob NOT NULL,
  `item_price` decimal(12,2) NOT NULL,
  `item_quantity` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `Item`
--

INSERT INTO `Item` (`item_id`, `item_name`, `item_description`, `item_price`, `item_quantity`) VALUES
(1, 'nazawa itemmmu', 0x626c6120626c61206f706973, '11.00', 12),
(2, 'nazawa itemmmu', 0x626c6120626c61206f706973, '11.22', 12);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `user_surname` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `user_email` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `user_password` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `user_address` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `user_name`, `user_surname`, `user_email`, `user_password`, `user_address`) VALUES
(1, 'Janek', 'kovalsy', 'mail@mail.celo', '$2y$10$F.IkYmWPmYZ.HdHaImirwuV8hYcEgKCPC4nvaIfnIQTjCRXB3Ymrq', 0x646f6c696e6961726b6120733131),
(3, 'Jjanek', 'kojalsy', 'maildd@mail.celo', '$2y$10$oLzPl08xNX1Yci6Do8rYd./0kn20lasqAx992sv0Apn7k2zrbfzIW', 0x6431316f64646c696e6961726b6120733131);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `Item`
--
ALTER TABLE `Item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Item`
--
ALTER TABLE `Item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
