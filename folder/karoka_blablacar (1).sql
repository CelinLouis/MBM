-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 26, 2020 at 01:05 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karoka_blablacar`
--

-- --------------------------------------------------------

--
-- Table structure for table `an_encadrees`
--

DROP TABLE IF EXISTS `an_encadrees`;
CREATE TABLE IF NOT EXISTS `an_encadrees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_annonce` int(11) NOT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `an_encadrees`
--

INSERT INTO `an_encadrees` (`id`, `id_annonce`, `start_at`, `end_at`) VALUES
(1, 6, '2020-03-25 00:13:46', '2020-04-24 00:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `an_entetes`
--

DROP TABLE IF EXISTS `an_entetes`;
CREATE TABLE IF NOT EXISTS `an_entetes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_annonce` int(11) NOT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `an_entetes`
--

INSERT INTO `an_entetes` (`id`, `id_annonce`, `start_at`, `end_at`) VALUES
(1, 6, '2020-03-24 23:24:11', '2020-03-31 23:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `an_premiums`
--

DROP TABLE IF EXISTS `an_premiums`;
CREATE TABLE IF NOT EXISTS `an_premiums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_annonce` int(11) NOT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `an_premiums`
--

INSERT INTO `an_premiums` (`id`, `id_annonce`, `start_at`, `end_at`) VALUES
(1, 6, '2020-03-25 00:08:25', '2020-04-01 00:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `an_urgentes`
--

DROP TABLE IF EXISTS `an_urgentes`;
CREATE TABLE IF NOT EXISTS `an_urgentes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_annonce` int(11) NOT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `an_urgentes`
--

INSERT INTO `an_urgentes` (`id`, `id_annonce`, `start_at`, `end_at`) VALUES
(1, 6, '2020-03-25 00:13:17', '2020-04-01 00:13:17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
