-- phpMyAdmin SQL Dump
-- version 4.6.5.2deb1+deb.cihar.com~xenial.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 14, 2017 at 08:31 PM
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
  `admin_name` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `admin_is_active` varchar(10) COLLATE utf8_polish_ci DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_is_active`) VALUES
(1, 'mail1@gmsail.elo', '$2y$10$7OsDf99FJ8eNFa1RHjVyZ.D86KKBOCnqW3l43aytYOtvOg9hQro0K', 'admin1', 'yes'),
(2, 'mail2@gmsail.elo', '$2y$10$BTdA5JEMV7tZUVt0rrdKWeultztIVsOQ9vVLEuU9BFyEx5u5lBPK2', 'admin2', 'no'),
(3, 'mail3332@gm.elo', '$2y$10$T4G7d5Z6aLvY1xR3c8SvGe0x.mQ6Cal/vqXbuXuBmuYRFdyWNaV4W', 'admin233', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`category_id`, `category_name`) VALUES
(4, 'heble'),
(1, 'kierowcy'),
(3, 'kierownice'),
(2, 'pojazdy, klasa 1600');

-- --------------------------------------------------------

--
-- Table structure for table `Item`
--

CREATE TABLE `Item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `item_description` blob NOT NULL,
  `item_price` decimal(12,2) NOT NULL,
  `item_quantity` int(11) NOT NULL DEFAULT '0',
  `item_category_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `Item`
--

INSERT INTO `Item` (`item_id`, `item_name`, `item_description`, `item_price`, `item_quantity`, `item_category_id`) VALUES
(1, '4towar1', 0x31207a77796bc582792073616473616466706f69, '11.00', 9029, 1),
(3, '1towar1', 0x31207a656577796bc582792073616473616466706f69, '11.00', 9029, 22),
(7, '2towar1', 0x7a656577796bc582792073616473616466706f69, '11.19', 9029, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Photo`
--

CREATE TABLE `Photo` (
  `photo_id` int(11) NOT NULL,
  `photo_path` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `photo_item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `Photo`
--

INSERT INTO `Photo` (`photo_id`, `photo_path`, `photo_item_id`) VALUES
(1, 'zwyklasciezkado obrazka', 1);

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
(4, 'name1', 'surname1', 'mail1@elo.gmail', '$2y$10$ppC3u0BXjZOzVEyfrBzSfuNnYYVZ98JU5bknp.Erc/2KEc6oLLvIK', 0x61647265732031),
(5, 'name1', 'surname1', 'mail2@elo.gmail', '$2y$10$0c8JJA8bwfm2cdfTqs/J.uLtb.rO3SjBrMdyulPK86D.3QUfUVusi', 0x61647265732031),
(6, 'name1', 'surname1', 'mail3@elo.gmail', '$2y$10$4JtxuwQdN2a82C4aJUkF4uQq.BktKp9GOP0isYrlZu/L.yxfKOJV2', 0x61647265732031),
(7, 'name1', 'surname1', 'mail4@elo.gmail', '$2y$10$U5Me2v9ue1Ce6/bG.mdUTOt9vg9UbDdx4mlIQ2XCmKda/Fzmbux72', 0x61647265732031),
(8, 'name1', 'surname1', 'mail5@elo.gmail', '$2y$10$jhb5N2iNJweWOLUgFgCHP.pf2tqXtsjy1bRjy8yW5QdLn6/4OHDdW', 0x61647265732031),
(9, 'name1', 'surname1', 'mail7@elo.gmail', '$2y$10$Mh3A8f9eqX1Uck1hAuwJnu1nLPFDWjGyBxP3JHoHNrvydgvZZFhjy', 0x61647265732031);

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
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `Item`
--
ALTER TABLE `Item`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `item_name` (`item_name`);

--
-- Indexes for table `Photo`
--
ALTER TABLE `Photo`
  ADD PRIMARY KEY (`photo_id`),
  ADD KEY `photo_item_id` (`photo_item_id`);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Item`
--
ALTER TABLE `Item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `Photo`
--
ALTER TABLE `Photo`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Photo`
--
ALTER TABLE `Photo`
  ADD CONSTRAINT `Photo_ibfk_1` FOREIGN KEY (`photo_item_id`) REFERENCES `Item` (`item_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
