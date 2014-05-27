-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tt`
--

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `A_user` varchar(255) NOT NULL,
  `A_pass` varchar(255) NOT NULL,
  `A_name` varchar(255) NOT NULL,
  `R_name` varchar(255) NOT NULL,
  PRIMARY KEY (`A_user`),
  UNIQUE KEY `User` (`A_user`),
  KEY `Login` (`R_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- dump ตาราง `account`
--

INSERT INTO `account` (`A_user`, `A_pass`, `A_name`, `R_name`) VALUES
('admin', '62f04a011fbb80030bb0a13701c20b41', 'admin', 'qq'),
('demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo', 'qq'),
('demo1', 'e368b9938746fa090d6afd3628355133', 'demo1', 'qq'),
('test', '7c5aa15456f96b3907647add0e0278e9', 'test', 'qq'),
('test1', '098f6bcd4621d373cade4e832627b4f6', 'test', 'qq');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `callqueue`
--

CREATE TABLE IF NOT EXISTS `callqueue` (
  `call_id` int(11) NOT NULL,
  `R_name` varchar(255) NOT NULL,
  `PIN` varchar(4) NOT NULL DEFAULT '',
  PRIMARY KEY (`call_id`),
  KEY `Restaurant` (`R_name`),
  KEY `Call_Queue` (`PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `Q_number` int(11) NOT NULL,
  `PIN` varchar(4) NOT NULL DEFAULT '',
  `C_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `C_seats` varchar(255) NOT NULL,
  `C_time` datetime NOT NULL,
  `C_active` tinyint(1) NOT NULL DEFAULT '0',
  `C_call` tinyint(1) DEFAULT '0',
  `C_service` tinyint(1) DEFAULT '0',
  `R_name` varchar(255) NOT NULL,
  PRIMARY KEY (`PIN`),
  UNIQUE KEY `PIN` (`PIN`),
  UNIQUE KEY `Q_number` (`Q_number`),
  KEY `Book` (`R_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `restaurant`
--

CREATE TABLE IF NOT EXISTS `restaurant` (
  `R_name` varchar(255) NOT NULL,
  `R_logo` varchar(255) NOT NULL,
  `R_open` time NOT NULL,
  `R_close` time NOT NULL,
  `R_service` time NOT NULL DEFAULT '00:01:30',
  PRIMARY KEY (`R_name`),
  UNIQUE KEY `R_name` (`R_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- dump ตาราง `restaurant`
--

INSERT INTO `restaurant` (`R_name`, `R_logo`, `R_open`, `R_close`, `R_service`) VALUES
('qq', 'aa', '09:30:00', '18:30:00', '01:30:00');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `r_details`
--

CREATE TABLE IF NOT EXISTS `r_details` (
  `details_id` int(11) NOT NULL AUTO_INCREMENT,
  `R_seats` int(11) NOT NULL,
  `R_tables` varchar(255) NOT NULL,
  `R_name` varchar(255) NOT NULL,
  `Z_id` int(4) NOT NULL,
  PRIMARY KEY (`details_id`),
  KEY `Restaurant_Details` (`R_name`),
  KEY `Zone_Details` (`Z_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- dump ตาราง `r_details`
--

INSERT INTO `r_details` (`details_id`, `R_seats`, `R_tables`, `R_name`, `Z_id`) VALUES
(1, 2, '1,2,3,4,5,6', 'qq', 1),
(2, 3, '7,8,9', 'qq', 1),
(3, 2, '1,2,3,4,5,6', 'qq', 2),
(4, 2, '1,2,3,4,5,6,7,8,9,10,11', 'qq', 3),
(5, 3, '12,13,14', 'qq', 3);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `r_zone`
--

CREATE TABLE IF NOT EXISTS `r_zone` (
  `Z_id` int(4) NOT NULL AUTO_INCREMENT,
  `zone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `zone_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `R_name` varchar(255) NOT NULL,
  PRIMARY KEY (`Z_id`),
  KEY `Zone_Details` (`R_name`),
  KEY `zone` (`zone`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- dump ตาราง `r_zone`
--

INSERT INTO `r_zone` (`Z_id`, `zone`, `zone_img`, `R_name`) VALUES
(1, 'ชั้น 1', '1.gif', 'qq'),
(2, 'ชั้น 2', '2.gif', 'qq'),
(3, 'ชั้น 3', '3.gif', 'qq');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `Login` FOREIGN KEY (`R_name`) REFERENCES `restaurant` (`R_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `callqueue`
--
ALTER TABLE `callqueue`
  ADD CONSTRAINT `Call_Queue` FOREIGN KEY (`PIN`) REFERENCES `customers` (`PIN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `Book` FOREIGN KEY (`R_name`) REFERENCES `restaurant` (`R_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_details`
--
ALTER TABLE `r_details`
  ADD CONSTRAINT `Restaurent` FOREIGN KEY (`R_name`) REFERENCES `restaurant` (`R_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Zone_Details` FOREIGN KEY (`Z_id`) REFERENCES `r_zone` (`Z_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_zone`
--
ALTER TABLE `r_zone`
  ADD CONSTRAINT `Restaurant_Zone` FOREIGN KEY (`R_name`) REFERENCES `restaurant` (`R_name`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- เหตุการณ์
--
CREATE DEFINER=`root`@`localhost` EVENT `delete` ON SCHEDULE EVERY 1 MINUTE STARTS '2014-04-02 14:08:02' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM customers WHERE `C_time` < NOW()$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
