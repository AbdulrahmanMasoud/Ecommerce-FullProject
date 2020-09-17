-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2020 at 07:38 AM
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
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

CREATE TABLE `categorys` (
  `ID` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_desc` text NOT NULL,
  `parent` int(11) NOT NULL,
  `ordering` int(11) DEFAULT NULL,
  `cat_visibilty` tinyint(4) NOT NULL DEFAULT 0,
  `allow_comments` tinyint(4) NOT NULL DEFAULT 0,
  `allow_ads` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorys`
--

INSERT INTO `categorys` (`ID`, `cat_name`, `cat_desc`, `parent`, `ordering`, `cat_visibilty`, `allow_comments`, `allow_ads`) VALUES
(5, 'Labtop', 'This Is Labtop Category', 0, 1, 0, 0, 1),
(6, 'Smart phone', 'This is Smart Phone Category', 0, 2, 0, 1, 1),
(7, 'camera', '', 0, 3, 0, 1, 1),
(8, 'accessories', 'This Is accessories Section', 0, 4, 0, 0, 0),
(10, 'Iphone', '', 6, 0, 0, 0, 0),
(11, 'Samsung', '', 6, 0, 0, 0, 0),
(13, 'lenova', '', 5, 0, 0, 0, 0),
(14, 'hp', '', 5, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_ID` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `c_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_ID` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_disc` text NOT NULL,
  `item_img` varchar(255) NOT NULL,
  `item_price` varchar(255) NOT NULL,
  `add_date` date NOT NULL,
  `rating` smallint(11) NOT NULL,
  `approve` tinyint(4) NOT NULL DEFAULT 0,
  `country_made` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `cat_ID` int(11) NOT NULL,
  `member_ID` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_ID`, `item_name`, `item_disc`, `item_img`, `item_price`, `add_date`, `rating`, `approve`, `country_made`, `status`, `cat_ID`, `member_ID`, `tags`) VALUES
(11, 'Iphon S6 Pluse', '                                        This Mobile is Iphon S6 Plus                                        ', '', '500', '2020-08-17', 0, 1, 'Tywan', '3', 6, 14, 'phone, nokia, discount'),
(13, 'Camera Nikon XS10', '                    This is Camera Nikon XS10 And This IS description For It                    ', '', '100', '2020-08-22', 0, 1, 'Japan', '2', 7, 16, 'nokia, discount, camera'),
(14, 'BlackBery New Mobile', '                                                            This Is a New Mobile From BlackBery New Mobile                                                            ', '', '225', '2020-08-24', 0, 1, 'Tiwan', '1', 6, 8, 'Mobile, nokia, used,');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL COMMENT 'this is user id',
  `Username` varchar(255) NOT NULL COMMENT 'this is user name',
  `Pasword` varchar(255) CHARACTER SET utf8mb4 NOT NULL COMMENT 'this is password',
  `Email` varchar(255) NOT NULL COMMENT 'this is email',
  `FullName` varchar(255) NOT NULL COMMENT 'this is fullname',
  `GroupID` int(11) NOT NULL DEFAULT 0 COMMENT 'identfiy user gruop',
  `Date` date NOT NULL,
  `TrustStatues` int(11) NOT NULL DEFAULT 0 COMMENT 'saller rank',
  `RegStatues` int(11) NOT NULL DEFAULT 0 COMMENT 'user upproval',
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Pasword`, `Email`, `FullName`, `GroupID`, `Date`, `TrustStatues`, `RegStatues`, `avatar`) VALUES
(2, 'abdo', 'ec7117851c0e5dbaad4effdb7cd17c050cea88cb', 'abdo@gmail.com', 'Abdulrahman Masoud', 1, '0000-00-00', 0, 1, ''),
(6, 'Ibrahim', 'ec7117851c0e5dbaad4effdb7cd17c050cea88cb', 'ibrahm@gmail.com', 'Ibrahime', 0, '0000-00-00', 0, 1, ''),
(8, 'Medo', 'ec7117851c0e5dbaad4effdb7cd17c050cea88cb', 'ahmed@gmail.com', 'Ahmed Mohamed', 0, '0000-00-00', 0, 1, ''),
(13, 'Salah', 'ec7117851c0e5dbaad4effdb7cd17c050cea88cb', 'salsh@gmail.com', 'Salah Masoud', 0, '2020-08-14', 0, 1, ''),
(14, 'كريم', 'ec7117851c0e5dbaad4effdb7cd17c050cea88cb', 'abdo@meso.com', 'كريم احمد', 0, '2020-08-14', 0, 1, ''),
(15, 'boda', 'ec7117851c0e5dbaad4effdb7cd17c050cea88cb', 'boad@gmai.com', 'Boda Masoud', 0, '2020-08-18', 0, 1, ''),
(16, 'Abdulrahman', 'ec7117851c0e5dbaad4effdb7cd17c050cea88cb', 'abdo@abdo.com', '', 0, '2020-08-20', 0, 1, ''),
(18, 'safasf', '65577a3ca3edba13a8b8b9958a654fdeded81d81', 'asdfsa@adf.dsf', 'fasfadfasfsdf', 0, '2020-08-24', 0, 1, ''),
(19, 'Body', 'ec7117851c0e5dbaad4effdb7cd17c050cea88cb', 'body@gmail.com', 'Body Mesdo', 0, '2020-08-24', 0, 1, '10056_'),
(20, 'Bobs', '90c70fbb74f9ff46906ccb1ccbedea1a35fabf9d', 'bobs@bo.s', 'bobo shda', 0, '2020-08-24', 0, 1, '55892_2.png'),
(21, 'Adss', 'ec7117851c0e5dbaad4effdb7cd17c050cea88cb', 'ads@ads.ads', 'AsdAsd', 0, '2020-08-24', 0, 1, '35309_117865339_2793561074253233_4660255434606244123_n.jpg'),
(22, 'asdasdasd', '82379017a05706e4f8b0ea9a4f000825675b4a65', 'asda@asa.asa', 'asasasasasa', 0, '2020-08-24', 0, 1, '9959_WhatsApp Image 2020-07-02 at 4.00.41 PM.jpeg'),
(23, 'gxdhdfgh', 'c55adca8b9c8658d080e0eded7c05aa316e2db78', 'dgh@saf.asf', 'asfsdfsdfs', 0, '2020-08-24', 0, 1, '10572_73243265_145444550102623_7379328103195082752_n.jpg'),
(24, 'asdfadf', 'fc01c59606db425236f1849c059386dab9208b91', 'asdf@asdf.safd', 'asdfasgafdgdfg', 0, '2020-08-24', 0, 1, '96796_109838963_735904470593724_2455158307352683355_n.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `cat_name` (`cat_name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_ID`),
  ADD KEY `items_comment` (`item_id`),
  ADD KEY `user_comment` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_ID`),
  ADD KEY `member_ID` (`member_ID`),
  ADD KEY `cat_ID` (`cat_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this is user id', AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `items_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_comment` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`member_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`cat_ID`) REFERENCES `categorys` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
