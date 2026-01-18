-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2026 at 12:32 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kamekverse2`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `username` text NOT NULL,
  `password` text NOT NULL,
  `displayname` text NOT NULL,
  `id_old` text NOT NULL,
  `ip` text NOT NULL,
  `banned` int(1) NOT NULL,
  `bantype` text NOT NULL,
  `description` text NOT NULL,
  `fav_communities` text NOT NULL,
  `follower_list` text NOT NULL,
  `followers` int(11) NOT NULL,
  `miidata` text NOT NULL DEFAULT '0800400308040402020c0301060406020a0000000000000804000a0100214004000214031304170d04000a040109',
  `skill` text NOT NULL DEFAULT 'beginner',
  `discord` text NOT NULL,
  `friends` int(11) NOT NULL,
  `friend_list` text NOT NULL,
  `friend_request_list` text NOT NULL,
  `banreason` text NOT NULL,
  `admin` int(1) NOT NULL,
  `badge` text NOT NULL,
  `strikes_adm` int(11) NOT NULL DEFAULT 3,
  `nickname_color` text NOT NULL,
  `following` text NOT NULL,
  `PasswordID` int(11) NOT NULL DEFAULT 1,
  `blockList` text NOT NULL,
  `fav_post` text NOT NULL,
  `karma` int(11) NOT NULL,
  `id` text NOT NULL,
  `pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `creator_id` text NOT NULL,
  `post_id` text NOT NULL,
  `id` text NOT NULL,
  `body` text NOT NULL,
  `yeahs` int(11) NOT NULL,
  `yeahlist` text NOT NULL,
  `creation_date` date NOT NULL DEFAULT current_timestamp(),
  `feeling` text NOT NULL,
  `nahs` int(11) NOT NULL,
  `nahlist` text NOT NULL,
  `pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `community`
--

CREATE TABLE `community` (
  `name` text NOT NULL,
  `creator_id` text NOT NULL,
  `id` text NOT NULL,
  `description` text NOT NULL,
  `pk` int(11) NOT NULL,
  `usergenerated` int(11) NOT NULL,
  `special` int(11) NOT NULL,
  `private` int(11) NOT NULL,
  `allowed_userlist` text NOT NULL,
  `community_flair_id` text NOT NULL,
  `flair_name` text NOT NULL,
  `locked` tinyint(1) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `blue_badges` text NOT NULL,
  `golden_badges` text NOT NULL,
  `is_swearblocked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `group_chs`
--

CREATE TABLE `group_chs` (
  `name` text NOT NULL,
  `id` text NOT NULL,
  `member_list` text NOT NULL,
  `invite` text NOT NULL,
  `pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `id_from` text NOT NULL,
  `id_to` text NOT NULL,
  `content` text NOT NULL,
  `feeling` text NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp(),
  `mode` text NOT NULL,
  `pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `creator_id` text NOT NULL,
  `community_id` text NOT NULL,
  `feeling` text NOT NULL,
  `body` text NOT NULL,
  `id_old` text NOT NULL,
  `yeahs` int(11) NOT NULL,
  `yeahlist` text NOT NULL,
  `replies` int(11) NOT NULL,
  `creation_date` date NOT NULL DEFAULT current_timestamp(),
  `has_image` tinyint(1) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `nahs` int(11) NOT NULL,
  `nahlist` text NOT NULL,
  `id` text NOT NULL,
  `is_old` tinyint(1) NOT NULL,
  `pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`pk`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`pk`);

--
-- Indexes for table `community`
--
ALTER TABLE `community`
  ADD PRIMARY KEY (`pk`);

--
-- Indexes for table `group_chs`
--
ALTER TABLE `group_chs`
  ADD PRIMARY KEY (`pk`);

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`pk`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`pk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `community`
--
ALTER TABLE `community`
  MODIFY `pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `group_chs`
--
ALTER TABLE `group_chs`
  MODIFY `pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `msg`
--
ALTER TABLE `msg`
  MODIFY `pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
