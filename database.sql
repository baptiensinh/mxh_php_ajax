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

-- Table structure for table `admin`

CREATE TABLE `admin` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `admin` (`id`, `username`, `email`, `pass`) VALUES
(1, 'admin', 'admin@admin.com', 'admin');


-- Table structure for table `users`

CREATE TABLE `users` (
  `id` int PRIMARY KEY not null AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `status_user` int(11) NOT NULL DEFAULT 0,
  `avatar_url` varchar(500) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- status_user = 0 ---> hoạt động
-- status_user = 1 ---> chặn đăng bài

-- INSERT INTO `users` (`id`, `username`, `email`, `pass`, `status_user`, `avatar_url`) VALUES
-- (1, 'user 1', 'user1@gmail.com', '1', 0, '1559652895.jpg'),
-- (2, 'user 2', 'user2@gmail.com', '1', 0, '1560440712.jpg'),
-- (3, 'user 3', 'user3@gmail.com', '1', 0, '1608633680.jpg'),
-- (4, 'user 4', 'user4@gmail.com', '1', 0, '1608690836.jpg'),
-- (5, 'user 5', 'user5@gmail.com', '1', 0, '1608868387.jpg'),
-- (6, 'user 6', 'user6@gmail.com', '1', 0, '1608967576.jpg'),
-- (7, 'user 7', 'user7@gmail.com', '1', 0, '1608970166.jpg'),
-- (8, 'user 8', 'user8@gmail.com', '1', 0, '1609150781.jpg'),
-- (9, 'user 9', 'user9@gmail.com', '1', 1, '1560440712.jpg')


-- Table structure for table `posts`

CREATE TABLE `photos` (
  `id` int(11) PRIMARY KEY  AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status_photo` int(11) NOT NULL DEFAULT 0,
  `description` varchar(500) DEFAULT NULL,
  `images_url` varchar(500) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- status_photo = 0 ---> private
-- status_photo = 1 ---> public
-- status_photo = 2 ---> delete

-- INSERT INTO `photos` (`id`, `user_id`, `status_photo`, `description`, `images_url`) VALUES
-- (1, 1, 1, 'des photo 1', '1608886704359.jpg'),
-- (2, 2, 0, 'des photo 2', '1608886704414.jpg'),
-- (3, 3, 2, 'des photo 3', '1608886770160.jpg'),
-- (4, 4, 1, 'des photo 4', '1608886806493.jpg'),
-- (5, 1, 1, 'des photo 5', '1608886806625.jpg'),
-- (6, 5, 1, 'des photo 6', '1608886898367.jpg')


CREATE TABLE `posts` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status_post` int(11) NOT NULL DEFAULT 0,
  `description` varchar(500) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- status_post=-1 ---> xóa post
-- status_post=0 ---> bình thường
-- status_post=1 ---> User bị chặn post

-- INSERT INTO `posts` (`id`, `user_id`, `status_post`, `description`, `create_time`) VALUES
-- (1, 1, 1, 'mota 1 any', ''),
-- (2, 2, 0, 'ok chua', ''),
-- (3, 3, 2, 'mt 3 any', ''),
-- (4, 4, 0, 'mt 4 any', ''),
-- (5, 1, 0, 'mt 5 nay', ''),
-- (6, 5, 0, 'mt 6 any', ''),
-- (7, 2, 0, 'mt 7 any', ''),
-- (8, 3, 0, 'mt 8 any', ''),
-- (9, 6, 0, 'mt 9 any', '')


-- Table structure for table `comments`

CREATE TABLE `comments` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content_cmt` varchar(500) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8_unicode_ci;


-- Table structure for table `icons`

CREATE TABLE `icons` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_icon` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `icons` ADD CONSTRAINT PK_icon PRIMARY KEY (post_id,user_id);

-- type_icon = -1 ---> xóa
-- type_icon = 0 ---> like
-- type_icon = 1 ---> heart 
-- type_icon = 2 ---> haha
-- type_icon = 3 ---> wow
-- type_icon = 4 ---> sad
-- type_icon = 5 ---> angry 

-- Table structure for table `relationships`

CREATE TABLE `relationships` (
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `friend_stt` int(1) NOT NULL,
  `user_invite` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `relationships` ADD CONSTRAINT PK_Relate PRIMARY KEY (user1,user2);

-- INSERT INTO `relationships` (`user1`, `user2`, `friend_stt`, `user_invite`) VALUES
-- (1, 2, 1, 2),
-- (1, 5, 1, 5),
-- (1, 3, 0, 3),
-- (3, 2, 1, 2),
-- (4, 1, 1, 4)

-- Table structure for table `posts_photos`

CREATE TABLE `posts_photos` ( 
  `photo_id` INT(11) NOT NULL ,
  `post_id` INT(11) NOT NULL , 
  `stt_group` INT(1)
  ) ENGINE = InnoDB;

  ALTER TABLE `posts_photos` ADD CONSTRAINT PK_PP PRIMARY KEY (photo_id,post_id);

-- INSERT INTO `posts_photos` (`photo_id`, `post_id`, `stt_group`) VALUES
-- (1, 1, 1),
-- (2, 2, 0),
-- (3, 3, 2),
-- (4, 4, 1),
-- (5, 1, 1),
-- (6, 5, 1)


-- Table structure for table `chat`

CREATE TABLE `chat` (
  `msg_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `f_user` int(11) NOT NULL,
  `t_user` int(11) NOT NULL,
  `f_message` varchar(999) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8_unicode_ci;


ALTER TABLE `chat` ADD CONSTRAINT `ch_ibfk_1` FOREIGN KEY (`f_user`) REFERENCES `users` (`id`);
ALTER TABLE `chat` ADD CONSTRAINT `ch_ibfk_2` FOREIGN KEY (`t_user`) REFERENCES `users` (`id`);

ALTER TABLE `photos` ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `posts_photos` ADD CONSTRAINT `group_posts_fk1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);
ALTER TABLE `posts_photos` ADD CONSTRAINT `group_posts_fk2` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`);

ALTER TABLE `comments` ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
ALTER TABLE `comments` ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

ALTER TABLE `relationships` ADD CONSTRAINT `re_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `users` (`id`);
ALTER TABLE `relationships` ADD CONSTRAINT `re_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `users` (`id`);

ALTER TABLE `icons` ADD CONSTRAINT `icons_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
ALTER TABLE `icons` ADD CONSTRAINT `icons_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);


