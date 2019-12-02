-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 02, 2019 at 01:07 AM
-- Server version: 5.5.53
-- PHP Version: 5.6.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `rid` int(11) DEFAULT NULL COMMENT '关联id',
  `nr` varchar(255) DEFAULT NULL COMMENT '内容',
  `rq` datetime DEFAULT NULL,
  `uid` int(11) DEFAULT NULL COMMENT '人员id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `restaurantid`
--

CREATE TABLE IF NOT EXISTS `restaurantid` (
  `restaurantID` int(11) NOT NULL AUTO_INCREMENT,
  `restaurantName` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `phoneNumber` varchar(45) NOT NULL,
  `description` varchar(2550) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `bz` varchar(255) DEFAULT NULL,
  `file` varchar(2550) DEFAULT NULL,
  PRIMARY KEY (`restaurantID`),
  KEY `Address_UNIQUE` (`address`) USING BTREE,
  KEY `PhoneNumber_UNIQUE` (`phoneNumber`) USING BTREE,
  KEY `restaurantName_UNIQUE` (`restaurantName`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `restaurantid`
--

INSERT INTO `restaurantid` (`restaurantID`, `restaurantName`, `address`, `phoneNumber`, `description`, `latitude`, `longitude`, `bz`, `file`) VALUES
(1, 'Ajio Sushi', '161 King St E, Hamilton, ON, L8N 1B1', '(905) 526-8888', 'Ajio Sushi invites you to their dining room. Their atmosphere has been described as casual. They are reachable by public transit and car. The neighboring location is remarkable for its restaurants, merchants and parks.', NULL, NULL, NULL, NULL),
(2, 'August 8', '1 wilson street, Hamilton, ON L8R 1C4', '(905) 524-3838', 'August 8 was originally established in 2008 where its first location opened in downtown Hamilton, Ontario.  As a new concept of dining, it was recognized as the first restaurant of its kind in the area to bring the finest aspects of both Cantonese-style dim sum and Japanese cuisine.', NULL, NULL, NULL, NULL),
(3, 'Saigon House', '27 John Street S, Hamilton, ON, L8N 2B7', '(905) 521-8880', 'SAIGON HOUSE is a large upscale Korean resto with traditional grilles in the tables so that you cook your own food. For a moderate ($25.99 dinner) price, we had All You Can Eat orders of beef, short ribs, chicken, lamb, sausage, mussels, fish, shrimp, squid, onions, mushrooms, green peppers.', NULL, NULL, NULL, NULL),
(4, 'Teahut', '100 main st E, Hamilton, ON L8N 3W4', '(905) 521-6451', 'One of the best places to eat in Hamilton, enjoy a wicked experience and a\r\n                    friendly staff. TEA HUT Bubble Tea is the perfect place for families to experience appetizing\r\n                    asian\r\n                    food, like specialty chicken.', NULL, NULL, NULL, NULL),
(5, 'Wass Ethiopian', '207 James St S, Hamilton, ON, L8P 3A8', '(289) 389-5294', 'Opening in the fall of 2009, The WASS is pleased to bring you the best in Ethiopian cuisine. With vegetarian, vegan and meat lover''s dishes, there is something for everyone at The WASS!', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rq` datetime DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
