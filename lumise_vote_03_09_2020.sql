-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 03, 2020 lúc 04:02 AM
-- Phiên bản máy phục vụ: 10.4.8-MariaDB
-- Phiên bản PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `lumise_vote`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_comment`
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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_options`
--

CREATE TABLE `tbl_options` (
  `option_id` int(11) NOT NULL,
  `option_name` text DEFAULT NULL,
  `option_value` text DEFAULT NULL,
  `option_status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_post`
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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_rank`
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
-- Cấu trúc bảng cho bảng `tbl_tags`
--

CREATE TABLE `tbl_tags` (
  `tag_id` bigint(20) NOT NULL,
  `tag_name` varchar(255) DEFAULT NULL,
  `tag_url` varchar(255) DEFAULT NULL,
  `tag_create` datetime DEFAULT current_timestamp(),
  `tag_status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_users`
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
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Chỉ mục cho bảng `tbl_options`
--
ALTER TABLE `tbl_options`
  ADD PRIMARY KEY (`option_id`);

--
-- Chỉ mục cho bảng `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`post_id`);

--
-- Chỉ mục cho bảng `tbl_rank`
--
ALTER TABLE `tbl_rank`
  ADD PRIMARY KEY (`rank_id`);

--
-- Chỉ mục cho bảng `tbl_tags`
--
ALTER TABLE `tbl_tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Chỉ mục cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `comment_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_options`
--
ALTER TABLE `tbl_options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `post_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_rank`
--
ALTER TABLE `tbl_rank`
  MODIFY `rank_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_tags`
--
ALTER TABLE `tbl_tags`
  MODIFY `tag_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
