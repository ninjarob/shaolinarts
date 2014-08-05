-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 29, 2014 at 03:33 AM
-- Server version: 5.6.19
-- PHP Version: 5.5.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shaolin`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_infos`
--

CREATE TABLE IF NOT EXISTS `user_infos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(32) NOT NULL,
  `lname` varchar(32) NOT NULL,
  `homephone` varchar(32) DEFAULT NULL,
  `cellphone` varchar(32) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `spouseguardian` varchar(64) DEFAULT NULL,
  `sgphone` varchar(32) DEFAULT NULL,
  `sgcellphone` varchar(32) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `user_infos`
--

INSERT INTO `user_infos` (`id`, `fname`, `lname`, `homephone`, `cellphone`, `address`, `birthdate`, `spouseguardian`, `sgphone`, `sgcellphone`, `user_id`) VALUES
(16, 'Robert', 'Kevan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 62),
(17, 'Joe', 'Montana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63),
(18, 'A', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 64),
(19, 'B', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65),
(20, 'C', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66),
(21, 'E', 'E', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67),
(22, 'F', 'F', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68),
(23, 'G', 'G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69),
(24, 'H', 'H', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70),
(25, 'I', 'I', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 71),
(26, 'k', 'k', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72);





INSERT INTO `roles` (`name`, `role_type_id`) VALUES
('Youth White', 8),
('Youth Yellow', 8),
('Youth Orange', 8),
('Youth Purple', 8),
('Youth Blue', 8),
('Youth Advanced Blue', 8),
('Youth Green', 9),
('Youth Advanced Green', 9),
('Youth Red', 9),
('Youth Brown', 9),
('Youth Advanced Brown', 9),
('White', 2),
('Yellow', 2),
('Orange', 2),
('Purple', 2),
('Blue', 2),
('Advanced Blue', 2),
('Green', 3),
('Advanced Green', 3),
('Red', 3),
('Brown', 3),
('Advanced Brown', 3),
('Sidi', 4),
('Sidi Dai Lao', 4),
('Si Hing', 4),
('Si Hing Dai Lao', 4),
('Sisuk', 4),
('Sisuk Dai Lao', 4),
('Sifu', 4),
('Si Bok', 4),
('Si Gung', 4),
('Si Tai Gung', 4),
('Si Jo', 4),
('Youth White Sash', 10),
('Youth Blue Sash', 10),
('Youth Gold Sash', 11),
('Youth Red Sash', 11),
('White Sash', 5),
('Blue Sash', 5),
('Gold Sash', 6),
('Red Sash', 6),
('Sidi', 7),
('Sidi Dai Lao', 7),
('Si Hing', 7),
('Si Hing Dai Lao', 7),
('Sisuk', 7),
('Sisuk Dai Lao', 7),
('Sifu', 7),
('Si Bok', 7),
('Si Gung', 7),
('Si Tai Gung', 7),
('Si Jo', 7);
