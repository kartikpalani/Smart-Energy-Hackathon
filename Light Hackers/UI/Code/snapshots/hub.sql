-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2014 at 02:53 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smartlight`
--

-- --------------------------------------------------------

--
-- Table structure for table `hub`
--

CREATE TABLE IF NOT EXISTS `hub` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `location` varchar(50) NOT NULL,
  `installdate` date NOT NULL,
  `node` int(5) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `hub`
--

INSERT INTO `hub` (`id`, `location`, `installdate`, `node`, `status`) VALUES
(1, 'Mumbai', '2014-03-27', 5, 1),
(2, 'Mumbai', '2014-03-27', 6, 1),
(3, 'Mumbai', '2014-03-27', 5, 1),
(20, '43.3333N:72.6666E', '2004-01-04', 4, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
