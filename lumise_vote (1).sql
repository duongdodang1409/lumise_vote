-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2021 at 02:50 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lumise_vote`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `comment_id` bigint(20) NOT NULL,
  `post_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `comment_parent` bigint(20) DEFAULT 0,
  `comment_status` varchar(255) DEFAULT 'none',
  `comment_content` text DEFAULT NULL,
  `comment_images` text DEFAULT NULL,
  `comment_create` datetime DEFAULT current_timestamp(),
  `comment_status_int` int(1) DEFAULT 1,
  `comment_updated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`comment_id`, `post_id`, `user_id`, `comment_parent`, `comment_status`, `comment_content`, `comment_images`, `comment_create`, `comment_status_int`, `comment_updated`) VALUES
(1, 1, 1, 0, 'none', 'com 1', NULL, '2020-10-27 15:13:46', 1, '2020-10-27 15:13:46'),
(2, 1, 1, 1, 'none', 'com 2', NULL, '2020-10-27 15:13:52', 1, '2020-10-27 15:13:52'),
(3, 1, 1, 1, 'none', 'com 3', NULL, '2020-10-27 15:14:04', 1, '2020-10-27 15:14:04'),
(4, 1, 1, 3, 'none', 'com 4', NULL, '2020-10-27 15:14:14', 1, '2020-10-27 15:14:14'),
(5, 1, 1, 3, 'none', 'com 5', '[\"1603786595.jpg\"]', '2020-10-27 15:16:34', 1, '2020-10-27 15:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_options`
--

CREATE TABLE `tbl_options` (
  `option_id` int(11) NOT NULL,
  `option_name` text DEFAULT NULL,
  `option_value` text DEFAULT NULL,
  `option_status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE `tbl_post` (
  `post_id` bigint(20) NOT NULL,
  `tag_id` bigint(20) DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_content` text DEFAULT NULL,
  `post_image` text DEFAULT NULL,
  `post_vote_ids` text DEFAULT NULL,
  `post_vote_count` int(11) DEFAULT 1,
  `post_status` varchar(255) DEFAULT 'unreview',
  `post_create` datetime DEFAULT current_timestamp(),
  `post_status_int` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`post_id`, `tag_id`, `user_create`, `post_title`, `post_content`, `post_image`, `post_vote_ids`, `post_vote_count`, `post_status`, `post_create`, `post_status_int`) VALUES
(1, 1, 1, 'post 1', 'content 1', '[\"1603786417.jpg\"]', '1', 1, 'open', '2020-10-27 15:13:36', 1),
(2, 1, 1, 'RNG', '', NULL, '1', 1, 'open', '2021-05-23 16:27:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rank`
--

CREATE TABLE `tbl_rank` (
  `rank_id` bigint(20) NOT NULL,
  `rank_name` varchar(255) DEFAULT NULL,
  `rank_avatar` varchar(255) DEFAULT NULL,
  `rank_color` varchar(255) DEFAULT NULL,
  `rank_effect` varchar(255) DEFAULT 'none',
  `rank_status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tags`
--

CREATE TABLE `tbl_tags` (
  `tag_id` bigint(20) NOT NULL,
  `tag_name` varchar(255) DEFAULT NULL,
  `tag_url` varchar(255) DEFAULT NULL,
  `tag_create` datetime DEFAULT current_timestamp(),
  `tag_status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tags`
--

INSERT INTO `tbl_tags` (`tag_id`, `tag_name`, `tag_url`, `tag_create`, `tag_status`) VALUES
(1, 'features', 'features', '2020-10-27 15:11:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` bigint(20) NOT NULL,
  `rank_id` int(11) DEFAULT NULL,
  `user_nickname` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_avatar` varchar(255) DEFAULT NULL,
  `user_create` datetime DEFAULT current_timestamp(),
  `user_status` int(1) DEFAULT 1,
  `user_actived` int(1) DEFAULT 0,
  `user_permission` int(1) DEFAULT 2 COMMENT '2 - customer, 1 - admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `rank_id`, `user_nickname`, `user_email`, `user_password`, `user_avatar`, `user_create`, `user_status`, `user_actived`, `user_permission`) VALUES
(1, NULL, 'admin', 'admin@gmail.com', 'b24331b1a138cde62aa1f679164fc62f', NULL, '2020-10-27 15:13:06', 1, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `tbl_options`
--
ALTER TABLE `tbl_options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `tbl_rank`
--
ALTER TABLE `tbl_rank`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `tbl_tags`
--
ALTER TABLE `tbl_tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `comment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_options`
--
ALTER TABLE `tbl_options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `post_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_rank`
--
ALTER TABLE `tbl_rank`
  MODIFY `rank_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tags`
--
ALTER TABLE `tbl_tags`
  MODIFY `tag_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
