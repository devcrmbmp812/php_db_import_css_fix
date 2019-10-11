-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 06, 2015 at 07:59 PM
-- Server version: 5.5.42-37.1
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zerodrop_pet`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_users`
--

CREATE TABLE IF NOT EXISTS `client_users` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `terms` tinyint(1) NOT NULL DEFAULT '0',
  `reset` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `client_users`
--

INSERT INTO `client_users` (`ID`, `username`, `name`, `pwd`, `email`, `terms`, `reset`) VALUES
(3, 'mdumas', 'Martin Dumas', '8f95ca25c395d75bc5e9de2f820fb400', 'mdumas@resthavenfuneral.com', 1, 0),
(4, 'ldumas', 'Linda Dumas', '8f95ca25c395d75bc5e9de2f820fb400', 'martinkdumas@hotmail.com', 1, 0),
(7, 'pjarvis', 'Paul Jarvis', '8f95ca25c395d75bc5e9de2f820fb400', 'mkdumas72@yahoo.com', 1, 0),
(8, 'ghume', 'Glenda Hume', '8f95ca25c395d75bc5e9de2f820fb400', 'glendahume@aol.com', 1, 0),
(9, 'vcannon', 'Vhea Cannon', '8f95ca25c395d75bc5e9de2f820fb400', 'martinkdumas@gmail.com', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `logging`
--

CREATE TABLE IF NOT EXISTS `logging` (
  `ID` int(11) NOT NULL,
  `serviceID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `action` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `modifiedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `detail` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `obituaries`
--

CREATE TABLE IF NOT EXISTS `obituaries` (
  `ID` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `petName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `familyName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passed` date DEFAULT NULL,
  `bio` longtext COLLATE utf8_unicode_ci NOT NULL,
  `profile` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo1` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo2` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdOn` datetime NOT NULL,
  `modifiedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approvedOn` datetime DEFAULT NULL,
  `approvedBy` int(11) DEFAULT NULL,
  `status` set('Active','Archive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `obituaries`
--

INSERT INTO `obituaries` (`ID`, `client`, `petName`, `familyName`, `passed`, `bio`, `profile`, `photo1`, `photo2`, `createdOn`, `modifiedOn`, `approvedOn`, `approvedBy`, `status`) VALUES
(13, 7, 'Cuervo', 'Jarvis', '2014-01-09', 'Cuervo was abandoned by her original owner who moved and left her in the backyard to fend for herself. Fortunately she was found and adopted to her forever home where she lived for 12 years. \r\nCuervo was the matriarch of her home.  Doing her own thing, but occasionally having to put up with the humiliation of wearing a costume of two.  She would always take it in stride knowing she would eventually get a treat. \r\nShe enjoyed being by herself, but loved affection and making sure everything was as it should be. \r\n', 'jpg', 'jpg', NULL, '2015-03-16 14:45:16', '2015-03-16 21:43:35', '2015-03-16 15:00:49', 2, 'Archive'),
(12, 4, 'Lucky', 'Dumas', '2014-12-13', 'Lucky was truly a gift from God for my husband and I.  He was a loyal, faithful companion that will always be missed.  We only had him in our life for 8 years as we rescued him as an adult dog, but the memories will last a lifetime.  We miss you and love you Lucky!\r\n\r\nLove,\r\nMom and Dad', 'jpg', 'jpg', 'jpg', '2015-01-26 12:51:48', '2015-03-16 21:37:02', '2015-01-28 09:54:54', 2, 'Archive'),
(14, 8, 'Sophie', 'Hume', '2015-02-09', 'Sophie was one of those sweet little dogs that just melted your heart.  Just 3 months old when we got her, she was happy and playful and loved everyone.  We loved and cherished her all her life.   She was only 10 years old when cancer took her from us.  I hope we were worthy of her total love and devotion. She was our baby and our hearts are broken. We gave her all the loving care we could.  We miss you sweet Sophie and we always will. ', 'jpg', NULL, NULL, '2015-03-16 15:30:00', '2015-04-14 13:30:07', '2015-03-16 16:32:47', 2, 'Active'),
(15, 9, 'Jasper', 'Roberts', '2014-03-04', 'Jasper was 10 and had inoperable throat cancer. He left us way too young.  He was such a love!  He was your typical border collie.  So smart, incredibly spirited and an amazing dog.  He only wanted to please and keep the peace in his pack.  He''s missed so much everyday.  The memories he left behind keep us laughing and smiling all the time.  ', 'JPG', 'JPG', 'JPG', '2015-03-16 16:34:31', '2015-03-16 21:41:44', '2015-03-16 16:41:44', 2, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `name`, `pwd`, `level`) VALUES
(2, 'admin', 'Super Admin', '9283a03246ef2dacdc21a9b137817ec1', 7),
(5, 'sford', 'Sally Ford', '21232f297a57a5a743894a0e4a801fc3', 3),
(7, 'fthompson', 'Frank Thompson', '21232f297a57a5a743894a0e4a801fc3', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_users`
--
ALTER TABLE `client_users`
  ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `logging`
--
ALTER TABLE `logging`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `obituaries`
--
ALTER TABLE `obituaries`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_users`
--
ALTER TABLE `client_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `logging`
--
ALTER TABLE `logging`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `obituaries`
--
ALTER TABLE `obituaries`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
