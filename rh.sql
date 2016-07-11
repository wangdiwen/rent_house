-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 11, 2016 at 08:42 PM
-- Server version: 10.0.23-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rh`
--
CREATE DATABASE IF NOT EXISTS `rh` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `rh`;

-- --------------------------------------------------------

--
-- Table structure for table `rh_advice`
--

DROP TABLE IF EXISTS `rh_advice`;
CREATE TABLE `rh_advice` (
  `id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `nick` varchar(20) NOT NULL,
  `popo` varchar(20) DEFAULT NULL,
  `say` varchar(140) NOT NULL,
  `pub_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rh_house`
--

DROP TABLE IF EXISTS `rh_house`;
CREATE TABLE `rh_house` (
  `id` int(10) UNSIGNED NOT NULL,
  `s_date` date NOT NULL DEFAULT '0000-00-00',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `pub_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ukey` bigint(20) UNSIGNED NOT NULL,
  `community` varchar(20) NOT NULL,
  `popo` varchar(20) NOT NULL DEFAULT '',
  `phone` bigint(20) UNSIGNED DEFAULT NULL,
  `room_num` tinyint(3) UNSIGNED NOT NULL,
  `room_type` enum('master','slave','single') NOT NULL DEFAULT 'slave',
  `rent_type` enum('short','long') NOT NULL DEFAULT 'long',
  `man` enum('girl','boy','no') NOT NULL DEFAULT 'girl',
  `animal` varchar(10) DEFAULT NULL,
  `price` smallint(5) UNSIGNED NOT NULL,
  `xy_point` varchar(30) NOT NULL,
  `other` varchar(140) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rh_advice`
--
ALTER TABLE `rh_advice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rh_house`
--
ALTER TABLE `rh_house`
  ADD PRIMARY KEY (`id`),
  ADD KEY `s_date` (`s_date`,`status`),
  ADD KEY `popo` (`popo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rh_advice`
--
ALTER TABLE `rh_advice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rh_house`
--
ALTER TABLE `rh_house`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
