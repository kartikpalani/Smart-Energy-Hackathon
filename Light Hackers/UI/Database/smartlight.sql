-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2014 at 02:31 PM
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
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `teamId` int(100) NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `dateb` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1275 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `date`, `start`, `teamId`, `comments`, `dateb`) VALUES
(1, '2013-09-21', '18:00:00', 1140, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `collegelist`
--

CREATE TABLE IF NOT EXISTS `collegelist` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `collegeName` varchar(200) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `pincode` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `eyrclogin`
--

CREATE TABLE IF NOT EXISTS `eyrclogin` (
  `id` int(3) DEFAULT NULL,
  `teamId` int(4) DEFAULT NULL,
  `username` varchar(36) DEFAULT NULL,
  `password` varchar(29) DEFAULT NULL,
  `user` int(1) DEFAULT NULL,
  `hash` varchar(32) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `timestamp` varchar(19) DEFAULT NULL,
  `survey` int(1) DEFAULT NULL,
  `eyrc` int(1) DEFAULT NULL,
  `theme` varchar(2) DEFAULT NULL,
  `feedbackPoints` int(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eyrclogin`
--

INSERT INTO `eyrclogin` (`id`, `teamId`, `username`, `password`, `user`, `hash`, `active`, `timestamp`, `survey`, `eyrc`, `theme`, `feedbackPoints`) VALUES
(1, 1, 'admin', 'admin', 1, '8ad675d4bf58b7b5823be37a8791c27c', 1, '2013-07-22 00:00:01', 2, 1, 'BB', 0);

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
(1, '43.3333N:72.6666E ', '2014-03-27', 5, 1),
(2, '63.3333N:72.6666E ', '2014-03-27', 6, 0),
(3, '53.3333N:42.6666E ', '2014-03-27', 5, 0),
(20, '43.3333N:72.6666E', '2004-01-04', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user` int(1) NOT NULL DEFAULT '0',
  `hash` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `survey` int(1) NOT NULL DEFAULT '0',
  `eyrc` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `user`, `hash`, `active`, `timestamp`, `survey`, `eyrc`) VALUES
(1, 'eyrcadmin', '12345', 1, '8ad675d4bf58b7b5823be37a8791c27c', 1, '2014-03-24 13:04:11', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `node`
--

CREATE TABLE IF NOT EXISTS `node` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `hubid` int(5) NOT NULL,
  `location` varchar(50) NOT NULL,
  `orient` int(1) NOT NULL,
  `installdate` date NOT NULL,
  `expecteddate` date NOT NULL,
  `ldrstatus` int(5) NOT NULL,
  `lightstatus` int(5) NOT NULL,
  `emergencylight` int(5) NOT NULL,
  `pirstatus` int(5) NOT NULL,
  `current` double NOT NULL,
  `voltage` double NOT NULL,
  `nodestatus` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `node`
--

INSERT INTO `node` (`id`, `hubid`, `location`, `orient`, `installdate`, `expecteddate`, `ldrstatus`, `lightstatus`, `emergencylight`, `pirstatus`, `current`, `voltage`, `nodestatus`) VALUES
(1, 1, '42.22E:71.45N', 0, '2004-08-01', '2006-02-08', 1, 1, 0, 1, 12.23, 14.2, 0),
(2, 1, '42.22E:71.45N', 1, '2004-08-01', '2006-02-08', 1, 1, 0, 1, 12.23, 14.2, 0),
(3, 1, '42.22E:71.45N', 0, '2005-08-01', '2008-02-08', 1, 1, 0, 1, 12.23, 14.2, 0),
(4, 1, '42.22E:71.45N', 1, '2002-08-01', '2002-05-08', 1, 1, 0, 1, 1.33, 4.2, 0),
(5, 1, '42.22E:71.45N', 0, '2002-08-01', '2002-05-08', 1, 1, 0, 1, 1.33, 4.2, 1),
(6, 1, '42.22E:73.45N', 1, '2002-08-01', '2002-05-08', 1, 1, 0, 1, 2.5, 4.2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teamdetail`
--

CREATE TABLE IF NOT EXISTS `teamdetail` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `loginId` int(5) unsigned NOT NULL,
  `state` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `collegeName` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pincode` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `teammemberdetail`
--

CREATE TABLE IF NOT EXISTS `teammemberdetail` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `teamId` int(5) unsigned NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `branch` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(32) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `testattempt` int(1) NOT NULL DEFAULT '0',
  `postonlinetest` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `uploadflagstatus`
--

CREATE TABLE IF NOT EXISTS `uploadflagstatus` (
  `id` int(3) DEFAULT NULL,
  `teamId` int(4) DEFAULT NULL,
  `theme` varchar(2) DEFAULT NULL,
  `task0Flag` int(1) DEFAULT NULL,
  `robotDelivery` int(1) NOT NULL DEFAULT '0',
  `task1Flag` int(1) DEFAULT NULL,
  `task2Flag` int(1) DEFAULT NULL,
  `task3Flag` int(1) NOT NULL DEFAULT '0',
  `task3link` varchar(500) DEFAULT NULL,
  `task4Flag` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
