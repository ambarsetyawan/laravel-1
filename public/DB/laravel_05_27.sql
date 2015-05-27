-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 27, 2015 at 05:23 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'PHP', '2015-05-14 14:34:40', '0000-00-00 00:00:00'),
(2, 'JAVA', '2015-05-14 14:34:40', '0000-00-00 00:00:00'),
(3, 'C#', '2015-05-14 14:34:56', '0000-00-00 00:00:00'),
(4, 'ANDROID', '2015-05-14 14:34:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `delete_status` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `content`, `delete_status`, `created_at`, `updated_at`) VALUES
(1, 13, 1, '1. install composer', 1, '2015-05-27 07:14:57', '2015-05-27 07:14:57'),
(2, 13, 1, 'You can install composer in link: https://getcomposer.org/  after install laravel 5 with this command line:  php composer.phar create-project laravel/laravel --prefer-dist (http://laravel.com/docs/5.0/installation)', 0, '2015-05-27 07:18:51', '2015-05-27 07:18:51'),
(3, 13, 1, ':D', 0, '2015-05-27 07:20:14', '2015-05-27 07:20:14'),
(4, 13, 2, 'http://docs.spring.io/spring/docs/current/spring-framework-reference/htmlsingle/ i feal it is very good :v', 0, '2015-05-27 07:21:29', '2015-05-27 07:21:29'),
(5, 13, 3, 'here: https://github.com/Codeception/Codeception/tree/2.0/docs =))', 0, '2015-05-27 07:21:59', '2015-05-27 07:21:59'),
(6, 13, 4, 'https://developer.android.com/sdk/installing/index.html  B-)', 0, '2015-05-27 07:22:28', '2015-05-27 07:22:28'),
(7, 3, 4, 'It is ok thanks you so much (y)', 0, '2015-05-27 07:23:04', '2015-05-27 07:23:04'),
(8, 3, 3, '(y)', 0, '2015-05-27 07:23:14', '2015-05-27 07:23:14'),
(9, 3, 2, 'Not bad :((', 1, '2015-05-27 07:23:47', '2015-05-27 07:23:47'),
(10, 3, 2, '(y)', 0, '2015-05-27 07:23:51', '2015-05-27 07:23:51'),
(11, 3, 1, 'I installed it. thanks you! :)', 0, '2015-05-27 07:24:16', '2015-05-27 07:24:16'),
(12, 19, 4, 'Google search  =))', 0, '2015-05-27 07:24:44', '2015-05-27 07:24:44'),
(13, 19, 5, 'someone plz help me :(', 0, '2015-05-27 07:27:11', '2015-05-27 07:27:11'),
(14, 3, 4, ':(( not bad', 0, '2015-05-27 07:27:35', '2015-05-27 07:27:35'),
(15, 3, 5, 'you can use: date("d/m/Y")', 0, '2015-05-27 07:29:23', '2015-05-27 07:29:23'),
(16, 19, 5, '(y) good thanks you  :^o', 0, '2015-05-27 07:29:59', '2015-05-27 07:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `user_id`, `name`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'LARAVEL', 1, '2015-05-14 14:35:21', '0000-00-00 00:00:00'),
(2, 2, 'FUELPHP', 1, '2015-05-14 14:35:31', '0000-00-00 00:00:00'),
(3, 2, 'SPRING', 2, '2015-05-15 07:05:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `comment_id`, `created_at`, `updated_at`) VALUES
(1, 13, 1, NULL, '2015-05-27 14:19:37', '2015-05-27 14:19:37'),
(2, 13, 2, NULL, '2015-05-27 14:19:39', '2015-05-27 14:19:39'),
(3, 13, 3, NULL, '2015-05-27 14:19:41', '2015-05-27 14:19:41'),
(4, 13, 4, NULL, '2015-05-27 14:19:42', '2015-05-27 14:19:42'),
(5, 3, 4, NULL, '2015-05-27 14:23:07', '2015-05-27 14:23:07'),
(6, 19, 4, NULL, '2015-05-27 14:25:02', '2015-05-27 14:25:02'),
(7, 19, 3, NULL, '2015-05-27 14:25:04', '2015-05-27 14:25:04'),
(8, 19, 1, NULL, '2015-05-27 14:25:06', '2015-05-27 14:25:06'),
(9, 3, 5, NULL, '2015-05-27 14:43:46', '2015-05-27 14:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_05_12_033324_entrust_setup_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('funny.fool1992@gmail.com', '322e38dfbcebf46ab742745d5d27f35f33fcbff4e450381671b998df099fff3e', '2015-05-26 02:15:14'),
('moitran92@gmail.com', '1bb3168f7fefa8aa479cd9257eddbb1c785701be6d9ecc66cb9ada98ba9ea10a', '2015-05-26 02:16:04');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'create-user', 'Create a new user', 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'edit-user', 'Edit infomation of user', 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'delete-user', 'Delete a user', 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'create-post', 'Create a new post', 'admin - owner', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'edit-post', 'Edit a post', 'admin - owner', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'delete-post', 'Delete a post', 'admin - owner', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 2),
(5, 2),
(6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delete_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `content`, `image`, `delete_status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Laravel 5 Framework', 'Plz help me install laravel 5 in windows 7!', '', 0, '2015-05-27 07:07:13', '2015-05-27 07:07:13'),
(2, 3, 2, 'Spring Framwork', 'Somebody send me some docs about spring framework. Thanks all!\r\nEmail: user@gmail.com :)', '', 0, '2015-05-27 07:08:59', '2015-05-27 07:08:59'),
(3, 3, 1, 'Codeception', 'Can you help  me install codeception in laravel 5? :(', '', 0, '2015-05-27 07:10:33', '2015-05-27 07:10:33'),
(4, 3, 4, 'Install android studio', 'Plz help me install android studio on ubuntu... :((', 'KSfGrG6E.png', 0, '2015-05-27 10:19:54', '2015-05-27 10:19:54'),
(5, 19, 1, 'Datetime in PHP', 'Plz help me convert timestamp to dd/mm/yy :((', '', 0, '2015-05-27 07:26:47', '2015-05-27 07:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin of website with highest role', '2015-05-11 17:00:00', '0000-00-00 00:00:00'),
(2, 'owner', 'Owner', 'Owner is user with second of role', '2015-05-11 17:00:00', '0000-00-00 00:00:00'),
(3, 'user', 'User', 'User is user with third of role', '2015-05-11 17:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(8, 3),
(13, 3),
(15, 3),
(19, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `delete_status` int(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uid`, `name`, `email`, `birthday`, `address`, `image`, `password`, `delete_status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '', 'admin', 'admin@gmail.com', '0000-00-00', NULL, 'uid8.jpg', '$2y$10$Ouwco24NPTLsOg2CfAm8BuyS3e5yqaldxXiGEPdGYL3GGbQvKcYLa', 0, 'zux2wnJT6RI2u2BMd2isiuTM00UaBZH3hTdnqAU6h0u8saAQxc1IYSoWDQET', '2015-05-11 20:49:19', '2015-05-15 02:53:15'),
(2, '', 'owner', 'owner@gmail.com', '0000-00-00', NULL, 'uid8.jpg', '$2y$10$Ouwco24NPTLsOg2CfAm8BuyS3e5yqaldxXiGEPdGYL3GGbQvKcYLa', 0, '91FCfwKAr3FS8TwQWQ6ODjW6t1iaD22qtIcf1WH2YOGznIZjBVMNwMrx6sib', '2015-05-11 21:30:02', '2015-05-15 02:56:40'),
(3, '', 'Trần Văn Mội', 'user@gmail.com', '1992-06-24', 'Vinh Binh Bac-Vinh Thuan-Kien Giang-Viet Nam', 'hOGrnaQY.jpg', '$2y$10$Ouwco24NPTLsOg2CfAm8BuyS3e5yqaldxXiGEPdGYL3GGbQvKcYLa', 0, 'pLH3axxRmozcip3dRqADlVQ1Q4h5za4fTOpiVJPsSyJLx5IyxYAUSGhgfYD3', '2015-05-11 21:31:17', '2015-05-27 09:50:46'),
(8, '108100510662264482822', 'Mội Trần', 'moitran92@gmail.com1', '0000-00-00', NULL, 'https://lh4.googleusercontent.com/-3DPfp1Coecc/AAAAAAAAAAI/AAAAAAAAACg/fnY2jxWBNwA/photo.jpg?sz=50', '$2y$10$Ouwco24NPTLsOg2CfAm8BuyS3e5yqaldxXiGEPdGYL3GGbQvKcYLa', 0, 'SOdcZ2uS1P65CKJqZ4Kk2TgGB2swYRL6k0kj8H734jz8kYMD9C6xa87h2Wk3', '2015-05-13 06:13:47', '2015-05-19 10:25:35'),
(13, '811775872263138', 'Seven Mội', 'funny.fool1992@gmail.com', '1992-06-24', 'Viet Nam', 'fsQ9dUag.jpg', '$2y$10$Ouwco24NPTLsOg2CfAm8BuyS3e5yqaldxXiGEPdGYL3GGbQvKcYLa', 0, 'bxnFNnbXe3TX2ylacBrT0gHvvBCpaMwUr6eSmJSZHt44oBt3obEEvVMnQP2o', '2015-05-15 00:05:29', '2015-05-27 07:22:47'),
(15, 'res_local', 'annh1892', 'hoai.an@mulodo.com', '0000-00-00', NULL, 'default.jpg', '$2y$10$Ouwco24NPTLsOg2CfAm8BuyS3e5yqaldxXiGEPdGYL3GGbQvKcYLa', 0, NULL, '2015-05-19 10:45:31', '2015-05-19 10:45:31'),
(19, '108100510662264482822', 'Mội Trần', 'moitran92@gmail.com', '1992-05-26', 'Ho Chi Minh', 'ltvXsA9j.jpg', '$2y$10$Ouwco24NPTLsOg2CfAm8BuyS3e5yqaldxXiGEPdGYL3GGbQvKcYLa', 0, '06EHi8DqoPMjmYsMcpEedpnZD5vY7GyqIc7Et6GB8RMnZERtlUPugkvIVjtc', '2015-05-26 02:57:54', '2015-05-27 07:38:11');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
