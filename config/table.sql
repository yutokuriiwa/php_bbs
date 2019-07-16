-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: 2019 年 7 月 11 日 05:03
-- サーバのバージョン： 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbs`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `thread_id` int(11) DEFAULT NULL,
  `comment_num` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text,
  `delflag` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `comments`
--

INSERT INTO `comments` (`id`, `thread_id`, `comment_num`, `user_id`, `content`, `delflag`, `created`, `modified`) VALUES
(45, 14, 1, 21, '教えてください〜！', 0, '2019-06-07 16:48:22', '2019-06-07 16:48:22'),
(46, 14, 2, 21, 'だれか〜', 0, '2019-06-07 18:42:33', '2019-06-07 18:42:33'),
(47, 14, 3, 21, 's', 0, '2019-06-10 15:58:12', '2019-06-10 15:58:12'),
(48, 14, 4, 21, 'aaa', 0, '2019-06-10 15:58:25', '2019-06-10 15:58:25'),
(49, 14, 5, 21, 'aaa', 0, '2019-06-10 15:58:40', '2019-06-10 15:58:40'),
(50, 15, 1, 21, 'aa', 0, '2019-06-10 16:03:01', '2019-06-10 16:03:01'),
(51, 15, 2, 21, 'aa', 0, '2019-06-10 16:03:05', '2019-06-10 16:03:05'),
(52, 15, 3, 21, 'aa', 0, '2019-06-10 23:01:57', '2019-06-10 23:01:57'),
(53, 15, 4, 21, 'bb', 0, '2019-06-11 10:12:15', '2019-06-11 10:12:15'),
(54, 14, 6, 21, 'ｖっっｂ\r\n', 0, '2019-06-11 10:36:48', '2019-06-11 10:36:48'),
(55, 15, 5, 21, 'aaa', 0, '2019-06-27 05:39:33', '2019-06-27 05:39:33'),
(56, 16, 1, 21, 'aaaaaaああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ', 0, '2019-06-27 05:52:57', '2019-06-27 05:52:57'),
(57, 15, 6, 21, 'aqqq', 0, '2019-07-06 03:33:25', '2019-07-06 03:33:25');

-- --------------------------------------------------------

--
-- テーブルの構造 `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `thread_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `favorites`
--

INSERT INTO `favorites` (`id`, `thread_id`, `user_id`, `created`) VALUES
(2, 16, 21, '2019-06-27 05:53:07');

-- --------------------------------------------------------

--
-- テーブルの構造 `threads`
--

CREATE TABLE `threads` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` text,
  `delflag` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `threads`
--

INSERT INTO `threads` (`id`, `user_id`, `title`, `delflag`, `created`, `modified`) VALUES
(14, 21, 'プログラミングおすすめの勉強法', 0, '2019-06-07 16:48:22', '2019-06-07 16:48:22'),
(15, 21, 'test', 0, '2019-06-10 16:03:01', '2019-06-10 16:03:01'),
(16, 21, 'aaaaaaaaaa', 0, '2019-06-27 05:52:57', '2019-06-27 05:52:57');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `delflag` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `image`, `delflag`, `created`, `modified`) VALUES
(21, 'hanai2', 'hanaiyu22@gmail.com', '$2y$10$yzVfGsIbD7lREGPPos4C2.s3kkJfCNJNRzVQ7ulWXw9XhGzn3DQ7K', 'img_5cfa2e5c0c60e.jpg', 0, '2019-06-07 16:40:12', '2019-06-27 07:22:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
