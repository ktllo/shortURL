-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2015 at 08:21 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `su_entry`
--
ALTER TABLE `su_entry`
  ADD PRIMARY KEY (`id`);

