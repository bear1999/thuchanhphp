-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2021 at 06:13 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ecommerce`
--
CREATE DATABASE IF NOT EXISTS `ecommerce` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ecommerce`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `CateID` int(11) NOT NULL AUTO_INCREMENT,
  `CateName` varchar(150) NOT NULL,
  `CateDescription` varchar(500) NOT NULL,
  PRIMARY KEY (`CateID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CateID`, `CateName`, `CateDescription`) VALUES
(1, 'Điện thoại', 'Mô tả Điện thoại'),
(2, 'Máy tính bảng', 'Mô tả Máy tính bảng'),
(3, 'Laptop', 'Mô tả Laptop');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE IF NOT EXISTS `orderdetail` (
  `Quantity` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  PRIMARY KEY (`OrderID`,`ProductID`),
  KEY `Quantity` (`Quantity`),
  KEY `ProductID` (`ProductID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orderproduct`
--

CREATE TABLE IF NOT EXISTS `orderproduct` (
  `OrderID` int(11) NOT NULL AUTO_INCREMENT,
  `OrderDate` datetime NOT NULL,
  `ShipDate` datetime NOT NULL,
  `ShipName` varchar(150) NOT NULL,
  `ShipAddress` varchar(200) NOT NULL,
  PRIMARY KEY (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `ProductID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(150) NOT NULL,
  `CateID` int(11) NOT NULL,
  `PriceProduct` double NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Picture` varchar(200) NOT NULL,
  PRIMARY KEY (`ProductID`),
  KEY `CateID` (`CateID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `CateID`, `PriceProduct`, `Quantity`, `Description`, `Picture`) VALUES
(6, 'Sp1', 1, 300000, 4, 'hi', '20210326051740Screenshot.png'),
(7, 'Sp2', 2, 200000, 4, 'hi', '20210326051740Screenshot.png'),
(8, 'Sp3', 3, 150000, 4, 'hi', '20210326051740Screenshot.png'),
(9, 'Sp7', 2, 100000, 4, '123', '20210330032630secondarytile.png'),
(10, 'dien thoai rac', 1, 700000, 6, 'haha', '20210330045621secondarytile.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(32) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `Password`) VALUES
(2, 'bearof', 'bear1@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, 'asddas', '213@gmail.com', '202cb962ac59075b964b07152d234b70');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orderproduct` (`OrderID`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CateID`) REFERENCES `category` (`CateID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
