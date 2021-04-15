-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 15, 2021 lúc 12:46 PM
-- Phiên bản máy phục vụ: 10.4.13-MariaDB
-- Phiên bản PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ecommerce`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `CateID` int(11) NOT NULL,
  `CateName` varchar(150) NOT NULL,
  `CateDescription` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`CateID`, `CateName`, `CateDescription`) VALUES
(1, 'Điện thoại', 'Mô tả Điện thoại'),
(2, 'Máy tính bảng', 'Mô tả Máy tính bảng'),
(3, 'Laptop', 'Mô tả Laptop');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetail`
--

CREATE TABLE `orderdetail` (
  `Quantity` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderproduct`
--

CREATE TABLE `orderproduct` (
  `OrderID` int(11) NOT NULL,
  `OrderDate` datetime NOT NULL,
  `ShipDate` datetime NOT NULL,
  `ShipName` varchar(150) NOT NULL,
  `ShipAddress` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(150) NOT NULL,
  `CateID` int(11) NOT NULL,
  `PriceProduct` double NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Picture` varchar(200) NOT NULL,
  `productBrand` varchar(50) DEFAULT NULL,
  `productRam` varchar(25) DEFAULT NULL,
  `productStorage` varchar(25) DEFAULT NULL,
  `productCamera` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `CateID`, `PriceProduct`, `Quantity`, `Description`, `Picture`, `productBrand`, `productRam`, `productStorage`, `productCamera`) VALUES
(6, 'Sp1', 1, 300000, 4, 'hi', '20210326051740Screenshot.png', NULL, NULL, NULL, NULL),
(7, 'Sp2', 2, 200000, 4, 'hi', '20210326051740Screenshot.png', NULL, NULL, NULL, NULL),
(8, 'Sp3', 3, 150000, 4, 'hi', '20210326051740Screenshot.png', NULL, NULL, NULL, NULL),
(9, 'Sp7', 2, 100000, 4, '123', '20210330032630secondarytile.png', NULL, NULL, NULL, NULL),
(10, 'dien thoai rac', 1, 700000, 6, 'haha', '20210330045621secondarytile.png', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `Password`) VALUES
(2, 'bearof', 'bear1@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, 'asddas', '213@gmail.com', '202cb962ac59075b964b07152d234b70');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CateID`);

--
-- Chỉ mục cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`OrderID`,`ProductID`),
  ADD KEY `Quantity` (`Quantity`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Chỉ mục cho bảng `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD PRIMARY KEY (`OrderID`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CateID` (`CateID`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `CateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `orderproduct`
--
ALTER TABLE `orderproduct`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orderproduct` (`OrderID`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CateID`) REFERENCES `category` (`CateID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
