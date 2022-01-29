-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 29, 2022 at 09:18 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `box`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_image` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `color` text COLLATE utf8_bin NOT NULL,
  `product_name` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_image`, `color`, `product_name`, `price`) VALUES
(1, './product-imgs/bluebox.svg', 'blue-box', 'Travel Box', 50),
(2, './product-imgs/redbox.svg', 'red-box', 'Movie Box', 20),
(3, './product-imgs/purplebox.svg', 'purple-box', 'Tech box', 23),
(4, './product-imgs/redbox.svg', 'red-box', 'Spooky box', 60),
(5, './product-imgs/purplebox.svg', 'purple-box', 'Manga Box', 30),
(6, './product-imgs/bluebox.svg', 'blue-box', 'Gaming Box', 12),
(7, './product-imgs/bluebox.svg', 'blue-box', 'Retro Box', 35),
(8, './product-imgs/redbox.svg', 'red-box', 'Summer Box', 26),
(10, './product-imgs/61ed7941a33d77.19303315purplebox.svg', 'purple-box', 'product 011', 22),
(36, './product-imgs/61f58b72451771.90782585redbox.svg', 'red-box', 'test_again', 1),
(41, './product-imgs/61f58cca0981a9.83611518redbox.svg', 'red-box', 'testing', 2121),
(42, './product-imgs/61f58d1e6ef768.99042107bluebox.svg', 'blue-box', 'testing22', 4111);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstName` text COLLATE utf8_bin NOT NULL,
  `lastName` text COLLATE utf8_bin NOT NULL,
  `userName` text COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `pass` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `photo` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `userName`, `email`, `pass`, `photo`) VALUES
(1, 'Monochrome', 'Mono', 'Admin', 'admin@gmail.com', '123', './userProfileImages/61ec26688727c6.00736282face.jpg'),
(2, 'user1', 'user1', 'user1', 'user1@gmail.com', '123', './userProfileImages/61ec5e73ea9f50.79105613download.jpg'),
(3, 'user2', 'user2', 'user2', 'user2@gmail.com', '123', './userProfileImages/61e71bd2823505.09680817Capture4.PNG'),
(4, 'user3', 'user3', 'user3', 'user3@gmail.com', '123', './userProfileImages/61e71bfda97190.10593368Capture3.PNG'),
(6, 'user5', 'user5', 'user5', 'user5@gmail.com', '123', './userProfileImages/61ec2dd41c95d5.32291792Capture3.PNG'),
(7, 'testUser', 'testUser', 'testUser', 'testUser@gmail.com', '123', './userProfileImages/61ed82e4ec3ed3.21051946Capture4.PNG'),
(8, 'user2323', 'user2323', 'user4578985', 'user2323@gmail.com', '123', './userProfileImages/61f2b8680307a2.27424354Capture3.PNG');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
