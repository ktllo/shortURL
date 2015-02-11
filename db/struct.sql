-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2015 at 08:43 AM
-- Server version: 5.6.13-log
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `surl`
--

-- --------------------------------------------------------

--
-- Table structure for table `su_entry`
--

DROP TABLE IF EXISTS `su_entry`;
CREATE TABLE IF NOT EXISTS `su_entry` (
  `id` varchar(200) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `url` text NOT NULL,
  `flags` int(10) unsigned NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `owner` int(10) unsigned NOT NULL,
  `source` varchar(200) DEFAULT '::0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `su_entry` (`id`, `url`, `flags`, `created`, `owner`) VALUES
('IKkWM', 'https://www.github.com', 1, '2015-02-04 22:54:07', 1),
('LsIUK', 'http://www.facebook.com', 1, '2015-02-04 22:53:42', 0),
('RwOPE', 'irc://chat.freenode.net/#freenode', 1, '2015-02-04 22:54:29', 1);

--
-- Table structure for table `su_log`
--

DROP TABLE IF EXISTS `su_log`;
CREATE TABLE IF NOT EXISTS `su_log` (
  `id` varchar(200) NOT NULL,
  `num` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `source` varchar(200) NOT NULL,
  `refer` varchar(200) DEFAULT NULL,
  `country` char(2) NOT NULL DEFAULT 'XA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `su_user`
--

DROP TABLE IF EXISTS `su_user`;
CREATE TABLE IF NOT EXISTS `su_user` (
  `uid` int(10) unsigned NOT NULL,
  `uname` varchar(40) NOT NULL,
  `password` varchar(200) NOT NULL,
  `flags` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `su_user` VALUES (1,'demo','$2y$10$TbhxWoSdYgM2RN.94G0jP.IAsCLhNHC2w6Qy1B9iHLCJZ.UCe7t5K', 31);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `su_entry`
--
ALTER TABLE `su_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `su_log`
--
ALTER TABLE `su_log`
  ADD PRIMARY KEY (`id`,`num`,`datetime`);

--
-- Indexes for table `su_user`
--
ALTER TABLE `su_user`
  ADD PRIMARY KEY (`uid`), ADD UNIQUE KEY `uname` (`uname`);

