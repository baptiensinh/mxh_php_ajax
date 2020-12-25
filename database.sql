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

--
-- Database: `php_mxh`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

-- Table structure for table `admin`

CREATE TABLE `admin` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `admin` (`id`, `username`, `email`, `pass`) VALUES
(1, 'admin', 'admin@admin.com', 'admin');


-- Table structure for table `users`

CREATE TABLE `users` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,AUTO_INCREMENT=11;
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `status_user` int(11) NOT NULL DEFAULT 0,
  `avatar_url` varchar(500) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- status_user = 0 ---> hoạt động
-- status_user = 1 ---> chặn đăng bài

-- INSERT INTO `users` (`id`, `username`, `email`, `pass`, `status_user`, `avatar_url`) VALUES
-- (1, 'admin', 'admin1@admin.com', '1', 0, '1559652895.jpg'),
-- (2, 'admin 2', 'admin2@admin.com', '1', 0, NULL),
-- (3, 'admin 3', 'admin3@admin.com', '1', 0, NULL),
-- (4, 'admin 4', 'admin4@admin.com', '1', 0, NULL),
-- (5, 'admin 5', 'admin5@admin.com', '1', 0, NULL),
-- (6, 'admin 6', 'admin6@admin.com', '1', 0, NULL),
-- (7, 'admin 7', 'admin7@admin.com', '1', 0, NULL),
-- (8, 'admin 8', 'admin8@admin.com', '1', 0, NULL),
-- (9, 'userTest', 'userTest@admin.com', '1', 1, '1560440712.jpg')


-- Table structure for table `posts`

CREATE TABLE `posts` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status_post` int(11) NOT NULL DEFAULT 0,
  `description` varchar(500) DEFAULT NULL,
  `images_url` varchar(500) NOT NULL
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- status_post = 0 ---> private
-- status_post = 1 ---> public
-- status_post = 2 ---> ban
-- status_post = 3 ---> video private
-- status_post = 4 ---> video public

-- INSERT INTO `posts` (`id`, `user_id`, `status_post`, `description`, `images_url`) VALUES
-- (1, 1, 1, 'mota 1 any', '1560431861.jpg'),
-- (2, 2, 0, 'ok chua', '1560433479.jpg'),
-- (3, 3, 2, 'mt 3 any', '1560433630.jpg'),
-- (4, 4, 0, 'mt 4 any', '1560433657.jpg'),
-- (5, 1, 0, 'mt 5 nay', '1560433682.jpg'),
-- (6, 5, 0, 'mt 6 any', '1560433708.jpg'),
-- (7, 2, 0, 'mt 7 any', '1560433731.jpg'),
-- (8, 3, 0, 'mt 8 any', '1560433758.jpg'),
-- (9, 6, 0, 'mt 9 any', '1560433785.jpg'),
-- (10, 3, 1, 'llll', '1560494268.jpg')


-- Table structure for table `comments`

CREATE TABLE `comments` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content_cmt` varchar(500) NOT NULL
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Table structure for table `icons`

CREATE TABLE `icons` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_icon` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- type_icon = -1 ---> xóa
-- type_icon = 0 ---> like
-- type_icon = 1 ---> heart 
-- type_icon = 2 ---> haha
-- type_icon = 3 ---> wow
-- type_icon = 4 ---> sad
-- type_icon = 5 ---> angry 



CREATE TABLE `relationships` (
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `friend_stt` int(1) NOT NULL,
  'user_invite'int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE relationship add primary key(user1,user2);


CREATE TABLE `mxh_post`.`post_group` ( 
  `id_group` INT(11) NOT NULL ,
  `id_post` INT(11) NOT NULL , 
  `stt_group` INT(1) NOT NULL ,
  PRIMARY KEY (`id_group`, `id_post`)
  ) ENGINE = InnoDB;





ALTER TABLE `posts` ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `post_group` ADD CONSTRAINT `group_posts_fk` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`)

ALTER TABLE `comments` ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
ALTER TABLE `comments` ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

ALTER TABLE `relationship` ADD CONSTRAINT `re_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `users` (`id`)
ALTER TABLE `relationship` ADD CONSTRAINT `re_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `users` (`id`)


ALTER TABLE `icons` ADD CONSTRAINT `icons_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
ALTER TABLE `icons` ADD CONSTRAINT `icons_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);


