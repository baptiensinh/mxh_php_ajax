-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2019 at 05:43 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpimages`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `pass`) VALUES
(1, 'admin', 'admin@admin.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `deleteuser`
--

CREATE TABLE `deleteuser` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `deltime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deleteuser`
--

INSERT INTO `deleteuser` (`id`, `email`, `deltime`) VALUES
(1, 'userTest@admin.com', '2019-06-13 20:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_photo` int(11) DEFAULT NULL,
  `images_description` varchar(500) DEFAULT NULL,
  `images_url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `title`, `id_user`, `status_photo`, `images_description`, `images_url`) VALUES
(1, 'tieu de 1', 1, 1, 'images_description', '1559617279.jpg'),
(2, 'tieu de 2', 1, 0, 'mo ta 2', '1559617428.jpg'),
(3, 'tieu de 3', 1, 1, 'mo ta 3', '1559619269.jpg'),
(4, 'tieu de 4', 1, 0, 'mo ta 4', '1559619293.jpg'),
(5, 'tieu de 5', 1, 1, 'mo ta 5', '1559619320.jpg'),
(6, 'tieu de 6', 1, 0, 'mo ta 6', '1559619347.jpg'),
(7, 'tieu de 7', 2, 1, 'mo ta 7', '1559619894.jpg'),
(8, 'tieu de 8', 2, 0, 'mo ta 8', '1559619919.jpg'),
(9, 'tieu de 9', 2, 1, 'mo ta 9', '1559619938.jpg'),
(10, 'tieu de 10', 2, 0, 'mo ta 10', '1559619957.jpg'),
(11, 'tieu de 11', 2, 1, 'mo ta 11', '1559619977.jpg'),
(12, 'tieu de 12', 2, 0, 'mo ta 12', '1559619993.jpg'),
(13, 'tieu de 13', 3, 1, 'mo ta 13', '1559620058.jpg'),
(14, 'tieu de 14', 3, 0, 'mo ta 14', '1559620074.jpg'),
(15, 'tieu de 15', 3, 1, 'mo ta 15', '1559620091.jpg'),
(16, 'tieu de 16', 3, 0, 'mo ta 16', '1559620108.jpg'),
(17, 'tieu de 17', 3, 1, 'mo ta 17', '1559620134.jpg'),
(18, 'tieu de 18', 3, 0, 'mo ta 18', '1559620166.jpg'),
(19, 'tieu de 19', 4, 1, 'mo ta 19', '1559620207.jpg'),
(20, 'tieu de 20', 4, 0, 'mo ta 20', '1559620241.jpg'),
(21, 'tieu de 21', 4, 1, 'mo ta 21', '1559620260.jpg'),
(22, 'tieu de 22', 4, 0, 'mo ta 22', '1559620301.jpg'),
(23, 'tieu de 23', 4, 1, 'mo ta 23', '1559620339.jpg'),
(24, 'tieu de 24', 4, 0, 'mo ta 24', '1559620364.jpg'),
(25, 'tieu de 25', 5, 1, 'mo ta 25', '1559620418.jpg'),
(26, 'tieu de 26', 5, 0, 'mo ta 26', '1559620464.jpg'),
(27, 'tieu de 27', 5, 1, 'mo ta 27', '1559620485.jpg'),
(28, 'tieu de 28', 5, 0, 'mo ta 28', '1559620507.jpg'),
(29, 'tieu de 29', 5, 1, 'mo ta 29', '1559620529.jpg'),
(30, 'tieu de 30', 5, 0, 'mo ta 30', '1559620586.jpg'),
(31, 'tieu de 31', 6, 1, 'mo ta 31', '1559622106.jpg'),
(32, 'tieu de 32', 6, 0, 'mo ta 32', '1559622128.jpg'),
(33, 'tieu de 33', 6, 1, 'mo ta 33', '1559622154.jpg'),
(34, 'tieu de 34', 6, 0, 'mo ta 34', '1559622173.jpg'),
(35, 'tieu de 35', 6, 1, 'mo ta 35', '1559622205.jpg'),
(36, 'tieu de 36', 6, 0, 'mo ta 36', '1559622233.jpg'),
(37, 'tieu de 37', 7, 1, 'mo ta 37', '1559622330.jpg'),
(38, 'tieu de 38', 7, 0, 'mo ta 38', '1559622350.jpg'),
(39, 'tieu de 39', 7, 1, 'mo ta 39', '1559622369.jpg'),
(40, 'tieu de 40', 7, 0, 'mo ta 40', '1559622405.jpg'),
(41, 'tieu de 41', 7, 1, 'mo ta 41', '1559622427.jpg'),
(42, 'tieu de 42', 7, 0, 'mo ta 42', '1559622462.jpg'),
(43, 'tieu de 43', 8, 1, 'mo ta 43', '1559622569.jpg'),
(44, 'tieu de 44', 8, 0, 'mo ta 44', '1559622596.jpg'),
(45, 'tieu de 45', 8, 1, 'mo ta 45', '1559622629.jpg'),
(46, 'tieu de 46', 8, 1, 'mo ta 46', '1559622664.jpg'),
(47, 'tieu de 47', 8, 1, 'mo ta 47', '1559622686.jpg'),
(48, 'tieu de 48', 8, 1, 'mo ta 48\r\n', '1559622722.jpg'),
(49, 'sai cho nao', 1, 1, 'sai cho nay', '1560433335.jpg'),
(50, 'test1', 9, 2, 'test2', '1560440764.jpg'),
(51, 'test3', 9, 2, 'test4', '1560440781.jpg'),
(52, 'test5', 9, 2, 'test6', '1560440805.jpg'),
(53, 'test7', 9, 2, 'test8', '1560440833.jpg'),
(54, 'test7', 9, 2, 'testttt', '1560441208.jpg'),
(55, 'test11', 9, 2, 'test12', '1560441244.jpg'),
(56, '1', 1, 1, '1', '1560485337.jpg'),
(57, 'hihi', 1, 1, 'hihi', '1560488645.jpg'),
(58, '57 ne', 1, 0, 'mo ta 57', '1560488724.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `photos_any`
--

CREATE TABLE `photos_any` (
  `id` int(11) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `status_photo` int(11) DEFAULT NULL,
  `images_url` varchar(500) NOT NULL,
  `images_description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos_any`
--

INSERT INTO `photos_any` (`id`, `title`, `status_photo`, `images_url`, `images_description`) VALUES
(1, 'Tieu de 1 any', 1, '1560431861.jpg', 'mota 1 any'),
(2, 'tieu de 2 chac duoc roi', 0, '1560433479.jpg', 'ok chua'),
(3, 'td 3 any', 2, '1560433630.jpg', 'mt 3 any'),
(4, 'td 4 any', 0, '1560433657.jpg', 'mt 4 any'),
(5, 'td 5 any', 0, '1560433682.jpg', 'mt 5 nay'),
(6, 'td 6 ny', 0, '1560433708.jpg', 'mt 6 any'),
(7, 'td 7 any', 0, '1560433731.jpg', 'mt 7 any'),
(8, 'td 8 any', 0, '1560433758.jpg', 'mt 8 any'),
(9, 'yd 9 any', 0, '1560433785.jpg', 'mt 9 any'),
(10, 'lll', 1, '1560494268.jpg', 'llll');

-- --------------------------------------------------------

--
-- Table structure for table `status_photos`
--

CREATE TABLE `status_photos` (
  `id` int(11) NOT NULL,
  `id_photo` int(11) DEFAULT NULL,
  `cmt` varchar(500) DEFAULT NULL,
  `likes` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` nvarchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `status_user` int(11) DEFAULT NULL,
  `point_user` int(11) DEFAULT NULL,
  `avatar_url` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `email`, `pass`, `status_user`, `point_user`, `avatar_url`) VALUES
(1, 'admin', 'admin@admin.com', '1', NULL, NULL, '1559652895.jpg'),
(2, 'admin 2', 'admin2@admin.com', '1', NULL, NULL, 'user.png'),
(3, 'admin 3', 'admin3@admin.com', '1', NULL, NULL, 'user.png'),
(4, 'admin 4', 'admin4@admin.com', '1', NULL, NULL, 'user.png'),
(5, 'admin 5', 'admin5@admin.com', '1', NULL, NULL, 'user.png'),
(6, 'admin 6', 'admin6@admin.com', '1', NULL, NULL, 'user.png'),
(7, 'admin 7', 'admin7@admin.com', '1', NULL, NULL, 'user.png'),
(8, 'admin 8', 'admin8@admin.com', '1', NULL, NULL, 'user.png'),
(9, 'userTest', 'userTest@admin.com', '1', 1, 0, '1560440712.jpg');

ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleteuser`
--
ALTER TABLE `deleteuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `photos_any`
--
ALTER TABLE `photos_any`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_photos`
--
ALTER TABLE `status_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_photo` (`id_photo`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deleteuser`
--
ALTER TABLE `deleteuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `photos_any`
--
ALTER TABLE `photos_any`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `status_photos`
--
ALTER TABLE `status_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `status_photos`
--
ALTER TABLE `status_photos`
  ADD CONSTRAINT `status_photos_ibfk_1` FOREIGN KEY (`id_photo`) REFERENCES `photos` (`id`);