-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2026 at 08:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommercesolution`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'User deleted', 'App\\Models\\User', 'deleted', 3, 'App\\Models\\User', 2, '{\"old\":{\"name\":\"Admin\",\"email\":\"admin@gmail.com\"}}', NULL, '2026-06-23 00:34:34', '2026-06-23 00:34:34'),
(2, 'default', 'User created', 'App\\Models\\User', 'created', 4, 'App\\Models\\User', 2, '{\"attributes\":{\"name\":\"Anas\",\"email\":\"anas@gmail.com\"}}', NULL, '2026-06-23 00:36:19', '2026-06-23 00:36:19'),
(3, 'default', 'Customer created', 'App\\Models\\Customer', 'created', 8, 'App\\Models\\User', 2, '{\"attributes\":{\"name\":\"ahmed\",\"email\":\"ahmed@gmail.com\",\"status\":\"active\",\"total_orders\":0,\"total_spent\":\"0.00\"}}', NULL, '2026-06-23 02:29:38', '2026-06-23 02:29:38'),
(4, 'default', 'Customer created', 'App\\Models\\Customer', 'created', 9, 'App\\Models\\User', 2, '{\"attributes\":{\"name\":\"Ab officia ducimus \",\"email\":\"qugenav@mailinator.com\",\"status\":\"blocked\",\"total_orders\":0,\"total_spent\":\"0.00\"}}', NULL, '2026-06-23 02:59:18', '2026-06-23 02:59:18'),
(5, 'default', 'Customer updated', 'App\\Models\\Customer', 'updated', 9, 'App\\Models\\User', 2, '{\"attributes\":{\"status\":\"active\"},\"old\":{\"status\":\"blocked\"}}', NULL, '2026-06-23 03:00:00', '2026-06-23 03:00:00'),
(6, 'default', 'Customer created', 'App\\Models\\Customer', 'created', 10, 'App\\Models\\User', 2, '{\"attributes\":{\"name\":\"Esse magnam omnis ex\",\"email\":\"qogaqa@mailinator.com\",\"status\":\"active\",\"total_orders\":0,\"total_spent\":\"0.00\"}}', NULL, '2026-06-23 03:05:34', '2026-06-23 03:05:34'),
(7, 'default', 'User deleted', 'App\\Models\\User', 'deleted', 4, 'App\\Models\\User', 2, '{\"old\":{\"name\":\"Anas\",\"email\":\"anas@gmail.com\"}}', NULL, '2026-06-30 00:11:31', '2026-06-30 00:11:31'),
(8, 'default', 'User created', 'App\\Models\\User', 'created', 5, 'App\\Models\\User', 2, '{\"attributes\":{\"name\":\"Anas Tariq\",\"email\":\"anastariq030@gmail.com\"}}', NULL, '2026-06-30 00:13:06', '2026-06-30 00:13:06'),
(9, 'default', 'User updated', 'App\\Models\\User', 'updated', 2, NULL, NULL, '{\"attributes\":[],\"old\":[]}', NULL, '2026-06-30 07:56:22', '2026-06-30 07:56:22'),
(10, 'default', 'User updated', 'App\\Models\\User', 'updated', 2, NULL, NULL, '{\"attributes\":[],\"old\":[]}', NULL, '2026-07-01 00:10:56', '2026-07-01 00:10:56'),
(11, 'default', 'User created', 'App\\Models\\User', 'created', 6, NULL, NULL, '{\"attributes\":{\"name\":\"Asad Mukhtar\",\"email\":\"hello@webeinventorz.com\"}}', NULL, '2026-07-17 14:58:16', '2026-07-17 14:58:16'),
(12, 'default', 'User created', 'App\\Models\\User', 'created', 7, NULL, NULL, '{\"attributes\":{\"name\":\"Rehman\",\"email\":\"mrehman75767778@gmail.com\"}}', NULL, '2026-07-25 19:28:00', '2026-07-25 19:28:00'),
(13, 'default', 'User created', 'App\\Models\\User', 'created', 8, NULL, NULL, '{\"attributes\":{\"name\":\"Rehman\",\"email\":\"mrehman7576777@gmail.com\"}}', NULL, '2026-07-25 19:33:00', '2026-07-25 19:33:00'),
(14, 'default', 'User created', 'App\\Models\\User', 'created', 9, NULL, NULL, '{\"attributes\":{\"name\":\"rehman123\",\"email\":\"rehman7576@gmail.com\"}}', NULL, '2026-07-26 01:35:52', '2026-07-26 01:35:52'),
(15, 'default', 'User created', 'App\\Models\\User', 'created', 10, NULL, NULL, '{\"attributes\":{\"name\":\"Rehman\",\"email\":\"rehman757677@gmail.com\"}}', NULL, '2026-07-27 12:40:33', '2026-07-27 12:40:33'),
(16, 'default', 'User created', 'App\\Models\\User', 'created', 11, NULL, NULL, '{\"attributes\":{\"name\":\"Rehman5\",\"email\":\"rehman75@gmail.com\"}}', NULL, '2026-07-27 13:47:50', '2026-07-27 13:47:50'),
(17, 'default', 'User created', 'App\\Models\\User', 'created', 12, NULL, NULL, '{\"attributes\":{\"name\":\"Ahmad\",\"email\":\"ahmad@gmail.com\"}}', NULL, '2026-07-29 16:34:16', '2026-07-29 16:34:16'),
(18, 'default', 'User created', 'App\\Models\\User', 'created', 13, 'App\\Models\\User', 12, '{\"attributes\":{\"name\":\"Ahmad\",\"email\":\"ahmad1@gmail.com\"}}', NULL, '2026-07-29 18:39:51', '2026-07-29 18:39:51'),
(19, 'default', 'User created', 'App\\Models\\User', 'created', 14, NULL, NULL, '{\"attributes\":{\"name\":\"mrehman\",\"email\":\"rehman75767778@gmail.com\"}}', NULL, '2026-08-03 16:02:17', '2026-08-03 16:02:17'),
(20, 'default', 'User created', 'App\\Models\\User', 'created', 15, NULL, NULL, '{\"attributes\":{\"name\":\"rehman\",\"email\":\"rehman@gmail.com\"}}', NULL, '2026-08-03 16:32:58', '2026-08-03 16:32:58'),
(21, 'default', 'User created', 'App\\Models\\User', 'created', 16, NULL, NULL, '{\"attributes\":{\"name\":\"ali\",\"email\":\"ali@gmail.com\"}}', NULL, '2026-08-05 20:55:34', '2026-08-05 20:55:34'),
(22, 'default', 'User updated', 'App\\Models\\User', 'updated', 13, 'App\\Models\\User', 13, '{\"attributes\":[],\"old\":[]}', NULL, '2026-08-07 12:40:18', '2026-08-07 12:40:18'),
(23, 'default', 'User updated', 'App\\Models\\User', 'updated', 13, 'App\\Models\\User', 13, '{\"attributes\":[],\"old\":[]}', NULL, '2026-08-07 19:25:28', '2026-08-07 19:25:28'),
(24, 'default', 'User updated', 'App\\Models\\User', 'updated', 13, 'App\\Models\\User', 13, '{\"attributes\":[],\"old\":[]}', NULL, '2026-08-07 19:26:08', '2026-08-07 19:26:08'),
(25, 'default', 'User updated', 'App\\Models\\User', 'updated', 13, 'App\\Models\\User', 13, '{\"attributes\":[],\"old\":[]}', NULL, '2026-08-07 19:29:37', '2026-08-07 19:29:37'),
(26, 'default', 'User updated', 'App\\Models\\User', 'updated', 13, 'App\\Models\\User', 13, '{\"attributes\":[],\"old\":[]}', NULL, '2026-08-07 20:29:18', '2026-08-07 20:29:18'),
(27, 'default', 'User updated', 'App\\Models\\User', 'updated', 13, 'App\\Models\\User', 13, '{\"attributes\":[],\"old\":[]}', NULL, '2026-08-10 13:43:34', '2026-08-10 13:43:34'),
(28, 'default', 'User created', 'App\\Models\\User', 'created', 17, NULL, NULL, '{\"attributes\":{\"name\":\"muhammad rehman\",\"email\":\"aliahmad@gmail.com\"}}', NULL, '2026-08-10 13:44:53', '2026-08-10 13:44:53'),
(29, 'default', 'User updated', 'App\\Models\\User', 'updated', 13, 'App\\Models\\User', 13, '{\"attributes\":[],\"old\":[]}', NULL, '2026-08-10 17:07:55', '2026-08-10 17:07:55'),
(30, 'default', 'User updated', 'App\\Models\\User', 'updated', 13, 'App\\Models\\User', 13, '{\"attributes\":[],\"old\":[]}', NULL, '2026-08-10 17:23:34', '2026-08-10 17:23:34'),
(31, 'default', 'User created', 'App\\Models\\User', 'created', 18, NULL, NULL, '{\"attributes\":{\"name\":\"abc2\",\"email\":\"abc2@gmail.com\"}}', NULL, '2026-08-10 18:07:07', '2026-08-10 18:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `model_type` varchar(255) DEFAULT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `old_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`old_values`)),
  `new_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`new_values`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ahmad', 'ahmad@gmail.com', '$2y$12$AvsM451gpl1yfEQ7a3l/AOd3eB2p.tQEQDBrYQL4pX1kYq4U69rLC', 1, NULL, '2026-08-03 16:27:30', '2026-08-03 16:27:30'),
(2, 'rehman', 'rehman75767778@gmail.com', '$2y$12$muj3.BZY5yulDWv9Vec/5egBYmXBBZMTGayPhzjM1kU3ObLeQVlQ2', 1, NULL, '2026-08-03 18:37:29', '2026-08-03 18:37:29'),
(3, 'rehman', 'rehman@gmail.com', '$2y$12$ffhYpFfWBh8sWkIPp0/iu.wfHROFnSSTn.xPXex01LiUlaIGc7OBS', 1, NULL, '2026-08-04 14:38:54', '2026-08-04 14:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `open_in_new_tab` tinyint(1) NOT NULL DEFAULT 0,
  `position` enum('homepage_top','homepage_middle','homepage_bottom','category_top','sidebar','popup') NOT NULL DEFAULT 'homepage_top',
  `starts_at` date DEFAULT NULL,
  `ends_at` date DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `subtitle`, `image`, `link`, `open_in_new_tab`, `position`, `starts_at`, `ends_at`, `sort_order`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Summer Sale 2026', 'Up to 50% off on all items', 'banners/HFKshA7u6w0KucUBPmnmAYDCRb1B38wlENoawFE7.jpg', 'https://chatgpt.com/', 0, 'popup', '2026-06-24', '2026-06-30', 1, 1, '2026-06-24 01:26:30', '2026-06-24 04:59:30', NULL),
(2, 'Mobail Sale', '50% off', 'banners/xL8oSysF1YpRfnkhkHcmNgrF4WSaNVVQMXhz1eI0.jpg', '', 0, 'homepage_top', '2026-06-24', '2026-06-25', 1, 1, '2026-06-24 01:44:16', '2026-06-24 02:11:42', '2026-06-24 02:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `status` enum('draft','published','scheduled') NOT NULL DEFAULT 'draft',
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `allow_comments` tinyint(1) NOT NULL DEFAULT 1,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `status`, `is_featured`, `allow_comments`, `meta_title`, `meta_description`, `meta_keywords`, `views`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Fuga Sequi eu dolor', 'fuga-sequi-eu-dolor', 'A aliqua Nostrum qu', '', '', 'draft', 1, 0, 'Qui minima ut sint f', 'Eius dolore sit ut ', 'Natus voluptate volu', 0, '2021-11-20 19:00:00', '2026-06-24 05:57:36', '2026-06-24 05:58:23', '2026-06-24 05:58:23'),
(2, 'Getting Started with Laravel: A Complete PHP Framework Guide', 'getting-started-with-laravel-a-complete-php-framework-guide', 'Learn Laravel from scratch — the most popular PHP framework for building modern web applications with MVC architecture, Eloquent ORM, and Blade templating.', '<p>Laravel is one of the most powerful PHP frameworks available today.&nbsp;<br />\nIt follows the MVC (Model-View-Controller) pattern which makes code&nbsp;<br />\nclean and organized.</p>\n\n<p>Key Features of Laravel:</p>\n\n<p>1. Eloquent ORM<br />\nLaravel&#39;s ORM makes database operations simple and intuitive.&nbsp;<br />\nInstead of writing raw SQL, you write clean PHP code.</p>\n\n<p>2. Blade Templating<br />\nBlade is Laravel&#39;s built-in template engine that allows you to&nbsp;<br />\nwrite dynamic HTML with simple syntax like @foreach, @if, and @extends.</p>\n\n<p>3. Artisan CLI<br />\nLaravel comes with a powerful command-line tool called Artisan&nbsp;<br />\nthat helps you generate code, run migrations, and manage your app.</p>\n\n<p>4. Middleware<br />\nMiddleware acts as a filter for HTTP requests, perfect for&nbsp;<br />\nauthentication and authorization.</p>\n\n<p>5. Migration System<br />\nDatabase version control made easy &mdash; create and modify tables&nbsp;<br />\nusing PHP code instead of SQL.</p>\n\n<p>Getting started is simple:<br />\ncomposer create-project laravel/laravel myapp<br />\ncd myapp<br />\nphp artisan serve</p>\n', 'blog/vAyqu8PhA0nrByghyqDjxlQrEgk0jopO8KcoLHUO.jpg', 'published', 1, 1, 'Laravel PHP Framework Guide — Learn MVC, ORM & Blade', 'Complete guide to Laravel PHP framework. Learn MVC pattern, \nEloquent ORM, Blade templating, Middleware and Artisan CLI \nwith practical examples.\n', 'Laravel, PHP, Framework, MVC, Eloquent ORM, Blade, Artisan,  Web Development, PHP Tutorial', 2, '2026-06-23 19:00:00', '2026-06-24 06:00:17', '2026-06-30 00:26:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `logo`, `description`, `meta_title`, `meta_description`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Al karam', 'al-karam', '', '', NULL, NULL, 'active', '2026-07-30 16:07:35', '2026-07-30 16:07:35'),
(6, 'Jazim', 'jazim', '', '', NULL, NULL, 'active', '2026-07-30 16:09:10', '2026-07-30 16:09:10'),
(7, 'AFRAZZ', 'afrazz', '', '', NULL, NULL, 'active', '2026-07-30 16:13:10', '2026-07-30 16:13:10'),
(8, 'Oxford', 'oxford', '', '', NULL, NULL, 'active', '2026-07-30 20:01:33', '2026-07-30 20:01:33'),
(9, 'Velenza', 'velenza', 'brands/TfBNR4CnTX7tsaV4gsw4SLLovFZBsVH9q7DYRHK3.png', '<p>Luxury brand</p>\n', NULL, NULL, 'active', '2026-08-05 13:04:22', '2026-08-05 13:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `meta_title`, `meta_description`, `og_image`, `image`, `parent_id`, `order`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Embroidered', 'embroidered', '', NULL, NULL, NULL, 'categories/dJEbK5bIdQbbVm6EgT4xHFvZ2V68tOFTgRg2rfKy.png', NULL, 2, 'active', '2026-07-30 15:14:05', '2026-08-11 13:23:51'),
(7, 'Kids', 'kids', '', NULL, NULL, NULL, 'categories/zfk9Bm4vExO8PySXZA3WtD8YPTDMrZc9id53GQK2.jpg', NULL, 7, 'active', '2026-07-30 15:15:32', '2026-08-05 13:57:29'),
(10, 'Sale', 'sale', '', NULL, NULL, NULL, 'categories/L4y8QJPfcGjHBERUBSj8RLXJthvv9hqOKbtpiVp5.png', NULL, 5, 'active', '2026-07-30 15:53:17', '2026-08-11 13:25:26'),
(12, 'Luxury', 'luxury', '', NULL, NULL, NULL, 'categories/dOERIvYTEeoFaU6YFwx6VucyUUboVG6brAZ9INfP.png', NULL, 1, 'active', '2026-08-05 13:52:12', '2026-08-11 13:24:28'),
(13, 'Lawn', 'lawn', '', NULL, NULL, NULL, 'categories/2uvLuzfE8Hjqp72DMvUeFPMRTRinZw0uJN6EIqfP.png', NULL, 3, 'active', '2026-08-05 13:55:00', '2026-08-11 13:24:57'),
(17, 'New Arrivals', 'new-arrivals', '', NULL, NULL, NULL, 'categories/6wbeASwyIE8rCJi06ohICRwG4I7OewKApAoxNG3g.png', NULL, 4, 'active', '2026-08-05 14:01:57', '2026-08-10 20:42:07'),
(18, 'Casual Wear', 'casual-wear', '', NULL, NULL, NULL, 'categories/nhmDNpJ6NKWVw2VaQsldqYip1tTnuD2U5qtDBQUj.png', NULL, 6, 'active', '2026-08-05 14:08:50', '2026-08-05 14:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'percentage',
  `value` decimal(10,2) NOT NULL,
  `min_order_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `max_discount` decimal(10,2) DEFAULT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `used_count` int(11) NOT NULL DEFAULT 0,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `min_order_amount`, `max_discount`, `usage_limit`, `used_count`, `start_date`, `end_date`, `is_active`, `description`, `created_at`, `updated_at`) VALUES
(1, 'SH-D95A', 'percentage', 50.00, 500.00, 250.00, 1, 1, '2026-06-17', '2026-07-01', 1, 'Eid special discount - 50% off on orders above Rs. 1000', '2026-06-17 03:11:07', '2026-06-30 00:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','blocked') NOT NULL DEFAULT 'active',
  `total_spent` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_orders` int(11) NOT NULL DEFAULT 0,
  `last_order_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `remember_token`, `phone`, `city`, `address`, `status`, `total_spent`, `total_orders`, `last_order_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Saleem Webster', 'fogys@mailinator.com', '$2y$12$63LrAg1MGwCHrZJ/x8iUjuKYICLsW.GKGQnSBk5VJpUpxar7N3lze', NULL, '+923248573797', 'Lahore', '5#No Stop Khana nau Lahore', 'active', 0.00, 0, NULL, '2026-06-18 06:34:17', '2026-08-10 15:55:37', NULL),
(2, 'Abuhaira', 'Abuhaira@gmail.com', '$2y$12$63LrAg1MGwCHrZJ/x8iUjuKYICLsW.GKGQnSBk5VJpUpxar7N3lze', NULL, '03006278955', '', '5#No Stop Khana nau Lahore', 'active', 0.00, 0, NULL, '2026-06-18 06:38:05', '2026-08-10 15:55:37', NULL),
(3, 'Ameerullah', 'ameerullahmayo@gmail.com', '$2y$12$63LrAg1MGwCHrZJ/x8iUjuKYICLsW.GKGQnSBk5VJpUpxar7N3lze', NULL, '03248573797', '', '5#No Stop Khana nau Lahore', 'active', 0.00, 0, NULL, '2026-06-18 06:42:58', '2026-08-10 15:55:37', NULL),
(5, 'Anas Tariq', 'anastariq@gmail.com', '$2y$12$63LrAg1MGwCHrZJ/x8iUjuKYICLsW.GKGQnSBk5VJpUpxar7N3lze', NULL, '03454815398', 'Lahore', '5#No Stop Khana nau Lahore', 'active', 0.00, 0, NULL, '2026-06-18 07:19:15', '2026-08-10 15:55:37', NULL),
(6, 'Test User', 'test123@gmail.com', '$2y$12$63LrAg1MGwCHrZJ/x8iUjuKYICLsW.GKGQnSBk5VJpUpxar7N3lze', NULL, NULL, NULL, NULL, 'active', 0.00, 0, NULL, '2026-06-18 07:21:54', '2026-08-10 15:55:37', NULL),
(7, 'ansir', 'ansir@gmail.com', '$2y$12$63LrAg1MGwCHrZJ/x8iUjuKYICLsW.GKGQnSBk5VJpUpxar7N3lze', NULL, '03096060838', NULL, '5#No Stop Khana nau Lahore', 'active', 650.00, 1, '2026-06-18 07:26:53', '2026-06-18 07:26:53', '2026-08-10 15:55:37', NULL),
(8, 'ahmed', 'ahmed@gmail.com', '$2y$12$63LrAg1MGwCHrZJ/x8iUjuKYICLsW.GKGQnSBk5VJpUpxar7N3lze', NULL, '+923001234567', 'Lahore', '5#No Stop Khana nau Lahore', 'active', 0.00, 0, NULL, '2026-06-23 02:29:38', '2026-08-10 15:55:37', NULL),
(9, 'Ab officia ducimus ', 'qugenav@mailinator.com', '$2y$12$63LrAg1MGwCHrZJ/x8iUjuKYICLsW.GKGQnSBk5VJpUpxar7N3lze', NULL, '+12214288478', 'Sed quod dolore ad e', 'Sit alias anim offi', 'active', 0.00, 0, NULL, '2026-06-23 02:59:18', '2026-08-10 15:55:37', NULL),
(10, 'Esse magnam omnis ex', 'qogaqa@mailinator.com', '$2y$12$63LrAg1MGwCHrZJ/x8iUjuKYICLsW.GKGQnSBk5VJpUpxar7N3lze', NULL, '+9216724539854', 'Dolore ut sit ut lib', 'Deleniti quia anim n', 'active', 0.00, 0, NULL, '2026-06-23 03:05:34', '2026-08-10 15:55:37', NULL),
(11, 'Voluptate voluptatem', 'bijin@mailinator.com', '$2y$12$63LrAg1MGwCHrZJ/x8iUjuKYICLsW.GKGQnSBk5VJpUpxar7N3lze', NULL, '+9216724539854', 'Dolore ut sit ut lib', 'Deleniti quia anim n', 'active', 0.00, 0, NULL, '2026-06-23 03:12:07', '2026-08-10 15:55:37', NULL),
(12, 'Possimus dolorum si', 'xihege@mailinator.com', '$2y$12$63LrAg1MGwCHrZJ/x8iUjuKYICLsW.GKGQnSBk5VJpUpxar7N3lze', NULL, '+17296216345', 'Totam enim veniam q', 'Est est nulla minim ', 'active', 0.00, 0, NULL, '2026-06-23 04:15:52', '2026-08-10 15:55:37', NULL),
(13, 'Ameer Hussain', 'ameerullahmayo1866@gmail.com', '$2y$12$63LrAg1MGwCHrZJ/x8iUjuKYICLsW.GKGQnSBk5VJpUpxar7N3lze', NULL, '+923248573797', 'Lahore', '5#No Stop Khana nau Lahore', 'active', 900.00, 1, '2026-06-30 00:04:06', '2026-06-29 23:46:05', '2026-08-10 15:55:37', NULL),
(14, 'Anas Tariq', 'anastariq030@gmail.com', '$2y$12$63LrAg1MGwCHrZJ/x8iUjuKYICLsW.GKGQnSBk5VJpUpxar7N3lze', NULL, '03454815398', NULL, '5#No Stop Khana nau Lahore', 'active', 650.00, 1, '2026-06-29 23:51:17', '2026-06-29 23:51:17', '2026-08-10 15:55:37', NULL),
(15, 'adhiss', 'umer@gmail.com', '$2y$12$CWiTJu5KxK9xfYPUs7YhjeHJdJLkpwW1exLC4C6MiVdutCRg5ox1u', NULL, NULL, NULL, NULL, 'active', 0.00, 0, NULL, '2026-08-10 15:36:46', '2026-08-10 15:55:39', NULL),
(16, 'adhiss', 'umeradhiss@gmail.com', '$2y$12$63LrAg1MGwCHrZJ/x8iUjuKYICLsW.GKGQnSBk5VJpUpxar7N3lze', NULL, NULL, NULL, NULL, 'active', 0.00, 0, NULL, '2026-08-10 15:40:18', '2026-08-10 15:55:37', NULL),
(17, 'adhiss', 'adhiss@gmail.com', '$2y$12$63LrAg1MGwCHrZJ/x8iUjuKYICLsW.GKGQnSBk5VJpUpxar7N3lze', NULL, NULL, NULL, NULL, 'active', 0.00, 0, NULL, '2026-08-10 15:46:20', '2026-08-10 15:55:37', NULL),
(18, 'abc', 'abc@gmail.com', '$2y$12$JfDsXm0/jjn.l.cpjuw3MOJIxlD6vdvg0IKX3httxxC0xrCY95uvO', NULL, NULL, NULL, NULL, 'active', 0.00, 0, NULL, '2026-08-10 16:09:51', '2026-08-10 16:09:51', NULL),
(19, 'abc1', 'abc1@gmail.com', '$2y$12$JwlklRnid..8b7RQ9KqFtOcVpeONFty.IoZF9T3pToAnuB9GPmzou', NULL, NULL, NULL, NULL, 'active', 0.00, 0, NULL, '2026-08-10 16:25:35', '2026-08-10 16:25:35', NULL),
(20, 'abc2', 'abc2@gmail.com', NULL, NULL, NULL, NULL, NULL, 'active', 0.00, 0, NULL, '2026-08-10 18:07:07', '2026-08-10 18:07:07', NULL),
(21, 'mr ali', NULL, NULL, NULL, '03011213145', 'Lahore', 'hashim street 44 ali town lahore', 'active', 0.00, 0, NULL, '2026-08-10 20:00:12', '2026-08-10 20:00:12', NULL),
(22, 'mr ali 2', NULL, NULL, NULL, '03012233445', 'Dhirkot', 'fh jfsj fdkj , lahore', 'active', 0.00, 0, NULL, '2026-08-10 20:27:59', '2026-08-10 20:27:59', NULL),
(23, 'me hamza', NULL, NULL, NULL, '03077787678', 'Lahore', 'johar town lahore', 'active', 0.00, 0, NULL, '2026-08-18 16:40:52', '2026-08-18 16:40:52', NULL),
(24, 'me  hamza 2', NULL, NULL, NULL, '03078383432', 'Lahore', 'johar town lahore', 'active', 0.00, 0, NULL, '2026-08-18 17:53:57', '2026-08-18 17:53:57', NULL),
(25, 'abc abc', NULL, NULL, NULL, '03237888199', 'Lahore', 'johar town loahore', 'active', 0.00, 0, NULL, '2026-08-18 18:01:02', '2026-08-18 18:01:02', NULL),
(26, 'ksjdf sd,vn', NULL, NULL, NULL, '03333333333', 'Matiari', 'wkqrfkjf', 'active', 0.00, 0, NULL, '2026-08-18 18:26:41', '2026-08-18 19:08:41', NULL),
(27, 'adfc ytf', NULL, NULL, NULL, '03333000000', 'Matiari', 'lahore', 'active', 0.00, 0, NULL, '2026-08-25 18:04:02', '2026-08-25 18:04:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_payment_methods`
--

CREATE TABLE `customer_payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `card_type` varchar(255) NOT NULL,
  `card_last4` varchar(4) NOT NULL,
  `expiry_month` int(11) NOT NULL,
  `expiry_year` int(11) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flash_sales`
--

CREATE TABLE `flash_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `discount_percentage` decimal(5,2) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flash_sales`
--

INSERT INTO `flash_sales` (`id`, `title`, `description`, `discount_percentage`, `start_time`, `end_time`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Eid Special Sale', 'Special Eid discount on all products - 30% off limited time offer!', 90.00, '2026-06-17 09:00:00', '2026-06-21 12:00:00', 1, '2026-06-17 04:04:36', '2026-06-22 05:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `footer_columns`
--

CREATE TABLE `footer_columns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_columns`
--

INSERT INTO `footer_columns` (`id`, `title`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Mart', 1, 1, '2026-06-29 01:33:36', '2026-06-29 01:33:36');

-- --------------------------------------------------------

--
-- Table structure for table `footer_links`
--

CREATE TABLE `footer_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `footer_column_id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `open_in_new_tab` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_links`
--

INSERT INTO `footer_links` (`id`, `footer_column_id`, `label`, `url`, `open_in_new_tab`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 2, 'About Us', 'https://web.whatsapp.com/', 0, 1, 1, '2026-06-29 01:34:23', '2026-06-29 01:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `footer_settings`
--

CREATE TABLE `footer_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `about_text` text DEFAULT NULL,
  `copyright_text` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `show_newsletter` tinyint(1) NOT NULL DEFAULT 1,
  `newsletter_title` varchar(255) DEFAULT NULL,
  `newsletter_subtitle` varchar(255) DEFAULT NULL,
  `playstore_link` varchar(255) DEFAULT NULL,
  `appstore_link` varchar(255) DEFAULT NULL,
  `payment_methods` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_methods`)),
  `show_bottom_bar` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_settings`
--

INSERT INTO `footer_settings` (`id`, `logo`, `company_name`, `about_text`, `copyright_text`, `email`, `phone`, `address`, `facebook`, `instagram`, `twitter`, `youtube`, `tiktok`, `whatsapp`, `show_newsletter`, `newsletter_title`, `newsletter_subtitle`, `playstore_link`, `appstore_link`, `payment_methods`, `show_bottom_bar`, `created_at`, `updated_at`) VALUES
(1, 'footer/E6OsdZbz7TUlv3rbZEY4c8TlV3biOODxXbdUI83f.jpg', 'My Shop online Mart', NULL, '© 2026 Mart. All rights reserved.', 'ameerullahmayo1866@gmail.com', '+92 3248573797', '5 No# stop khana nau Lahore.', 'https://www.facebook.com/', 'https://www.instagram.com/?hl=en', 'https://x.com/downdetector?lang=en', 'https://www.youtube.com/watch?v', 'https://www.tiktok.com/foryou?lang=en', '+92 3248573797', 1, 'Subscribe to our Newsletter', 'Get the latest deals and offers.', 'https://play.google.com/store/games?hl=en&pli=1', 'https://www.apple.com/app-store/', '[\"visa\",\"mastercard\",\"easypaisa\",\"jazzcash\",\"bank\",\"cod\"]', 1, '2026-06-22 07:59:45', '2026-06-29 01:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `site_tagline` varchar(255) DEFAULT NULL,
  `site_logo` varchar(255) DEFAULT NULL,
  `site_favicon` varchar(255) DEFAULT NULL,
  `site_email` varchar(255) DEFAULT NULL,
  `site_phone` varchar(255) DEFAULT NULL,
  `site_address` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `google_analytics_id` varchar(255) DEFAULT NULL,
  `header_scripts` text DEFAULT NULL,
  `footer_scripts` text DEFAULT NULL,
  `currency_code` varchar(10) NOT NULL DEFAULT 'USD',
  `currency_symbol` varchar(10) NOT NULL DEFAULT '$',
  `currency_position` enum('before','after') NOT NULL DEFAULT 'before',
  `timezone` varchar(255) NOT NULL DEFAULT 'UTC',
  `date_format` varchar(255) NOT NULL DEFAULT 'd M Y',
  `language` varchar(10) NOT NULL DEFAULT 'en',
  `mail_driver` varchar(255) NOT NULL DEFAULT 'smtp',
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT NULL,
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL,
  `mail_encryption` enum('tls','ssl','none') NOT NULL DEFAULT 'tls',
  `mail_from_address` varchar(255) DEFAULT NULL,
  `mail_from_name` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT 0,
  `maintenance_message` text DEFAULT NULL,
  `maintenance_allowed_ips` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `site_tagline`, `site_logo`, `site_favicon`, `site_email`, `site_phone`, `site_address`, `meta_title`, `meta_description`, `meta_keywords`, `og_image`, `google_analytics_id`, `header_scripts`, `footer_scripts`, `currency_code`, `currency_symbol`, `currency_position`, `timezone`, `date_format`, `language`, `mail_driver`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encryption`, `mail_from_address`, `mail_from_name`, `facebook`, `instagram`, `twitter`, `youtube`, `tiktok`, `linkedin`, `whatsapp`, `maintenance_mode`, `maintenance_message`, `maintenance_allowed_ips`, `created_at`, `updated_at`) VALUES
(1, 'My Shop Online Mart', 'Pakistan ki behtareen online shopping destination', 'settings/SHtffDNjanelOfkFfWXaT4AOxNrut4eQlDIarpso.jpg', 'settings/DY9JHEuZPk9u383vUDIVSbf3FIdy00tvZO6uVfHl.jpg', 'ameerullahmayo1866@gmail.com', '+92 324 8573797', '5 No# stop khana nau Lahore, Pakistan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'before', 'Asia/Karachi', 'd M Y', 'en', 'smtp', 'smtp.gmail.com', '587', 'ameerullahmayo1866@gmail.com', 'dhypptzrpqvsdyzz', 'tls', 'ameerullahmayo1866@gmail.com', 'My Shop online Mart', NULL, NULL, NULL, NULL, NULL, NULL, '+923248573797', 0, '<p>We are under maintenance. Please check back soon.</p>\n', '127.0.0.1', '2026-06-15 05:01:08', '2026-06-29 07:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `home_sliders`
--

CREATE TABLE `home_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `badge_color` enum('primary','success','danger','warning','info') NOT NULL DEFAULT 'primary',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_sliders`
--

INSERT INTO `home_sliders` (`id`, `title`, `subtitle`, `button_text`, `button_link`, `image`, `badge_color`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Perfectly Your\'s', '.', 'Shop Now', '/products', 'sliders/QMW9DLitPrtvgawTg8greJBY8A7bdEr5MeRwzwIe.png', 'danger', 1, 1, '2026-06-24 00:31:21', '2026-09-01 23:04:40'),
(3, 'Effortless Summer Style', 'Flowy Linens and Lightweight Fabrics', 'EXPLORE LINEN', 'http://127.0.0.1:8000/products', 'sliders/FpoHlCPx21lWEdrGGDWisk2OiA6HeycIZBFkngCw.png', 'success', 2, 0, '2026-08-01 18:49:36', '2026-08-04 19:17:39'),
(4, 'ELEVATE YOUR EVERYDAY ', 'Discover Our New Sustainable Wool Design ', 'Shop New Arrivals', 'http://127.0.0.1:8000/products/', 'sliders/6X4fymV5HxeiL3YIrw6tZqcWUVZEyBuIdnxRfJwL.png', 'info', 2, 0, '2026-08-01 20:46:31', '2026-08-04 19:17:43'),
(5, 'ENJOY EVERY SEASON SALE', 'Stay Happy & Buy price off cloth.', 'SHOP KNITWEAR', 'http://127.0.0.1:8000/products/', 'sliders/b0LFZG8UedH8SrZn4DvaGJPA5Ga3YetACrz5bIYn.png', 'primary', 6, 1, '2026-08-01 21:02:23', '2026-08-04 19:20:55'),
(6, 'Timeless Elegance, Crafted For You', 'Discover Velenza\'s latest collection', 'Shop Elegency', 'http://127.0.0.1:8000/products', 'sliders/AANpvhIOPzFvTwEanu0mMhreTgLBlseJC8mvqhFv.png', 'warning', 4, 1, '2026-08-04 17:14:30', '2026-08-05 14:44:22'),
(7, 'A Celebration Of Feminine Grace', 'Explore exquisite designs where delicate details, premium fabrics, and modern elegance come together.', 'Buy Now', 'http://127.0.0.1:8000/products/', 'sliders/o7PwTt15KgChrwDMkcSl9HrxXnQoZa14PK7a65IZ.png', 'success', 2, 1, '2026-08-04 17:24:05', '2026-08-04 19:18:43'),
(8, 'Luxury For Every Generation', 'Experience refined fashion crafted for every member of the family.', 'Join Fashion', 'http://127.0.0.1:8000/products/', 'sliders/LzBIk4NKqgkMCCr5EFeLdNPtaujm8VrjSD1yNrsp.png', 'primary', 4, 1, '2026-08-04 17:29:36', '2026-08-04 19:05:45'),
(9, 'Where Tradition Meets Luxury', 'Experience carefully crafted fashion that celebrates heritage, quality, and modern style', 'Join Luxury', 'http://127.0.0.1:8000/products/', 'sliders/A8oZEfYAShf4OR3sEmTYXDOPQ9Aa1QycTlBO2KwS.png', 'primary', 3, 1, '2026-08-04 17:34:06', '2026-08-05 15:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `device` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `location`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Header Menu', 'header', 1, '2026-06-24 03:13:44', '2026-06-24 03:13:44');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `open_in_new_tab` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `parent_id`, `label`, `url`, `icon`, `open_in_new_tab`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Home', '/', 'fas fa-home', 0, 1, 1, '2026-06-24 03:15:53', '2026-06-24 03:15:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_13_144801_create_products_table', 1),
(5, '2026_05_13_144803_create_sliders_table', 1),
(6, '2026_05_13_145712_create_orders_table', 1),
(7, '2026_05_13_150056_create_order_items_table', 1),
(8, '2026_05_13_150313_create_categories_table', 1),
(9, '2026_05_13_150514_create_brands_table', 1),
(10, '2026_05_14_175144_add_missing_columns_to_orders_table', 1),
(11, '2026_05_15_074857_create_coupons_table', 1),
(12, '2026_05_15_074900_create_flash_sales_table', 1),
(13, '2026_05_15_080557_create_transactions_table', 1),
(14, '2026_05_15_080559_create_payment_methods_table', 1),
(15, '2026_05_15_081820_create_shipping_zones_table', 1),
(16, '2026_05_15_081822_create_shipping_methods_table', 1),
(17, '2026_05_15_114201_add_columns_to_products_table', 1),
(18, '2026_05_15_124804_create_customers_table', 1),
(19, '2026_05_18_120621_create_home_sliders_table', 1),
(20, '2026_05_19_020411_create_pages_table', 1),
(21, '2026_05_19_022608_create_banners_table', 1),
(22, '2026_05_19_080947_create_footer_settings_table', 1),
(23, '2026_05_19_080949_create_footer_columns_table', 1),
(24, '2026_05_19_080951_create_footer_links_table', 1),
(25, '2026_05_19_091149_create_menus_table', 1),
(26, '2026_05_19_091151_create_menu_items_table', 1),
(27, '2026_05_19_093354_create_blog_posts_table', 1),
(28, '2026_05_19_100402_create_seo_settings_table', 1),
(29, '2026_05_20_175257_create_payment_gateways_table', 1),
(30, '2026_05_21_072940_create_general_settings_table', 1),
(31, '2026_06_11_083201_create_roles_table', 1),
(32, '2026_06_11_090025_create_permissions_table', 1),
(33, '2026_06_11_091551_create_activity_logs_table', 1),
(34, '2026_06_17_121119_create_activity_log_table', 2),
(35, '2026_06_17_121120_add_event_column_to_activity_log_table', 2),
(36, '2026_06_17_121121_add_batch_uuid_column_to_activity_log_table', 2),
(37, '2026_08_01_093359_create_carts_table', 3),
(38, '2026_08_03_064952_create_admins_table', 4),
(39, '2026_08_03_090626_create_wishlists_table', 5),
(42, '2026_08_03_133835_add_is_admin_to_admins_table', 6),
(43, '2026_08_03_135647_add_is_admin_column_to_admins_table', 7),
(44, '2026_08_05_100911_create_notifications_table', 8),
(45, '2026_08_05_100913_create_rewards_table', 8),
(46, '2026_08_05_100927_create_addresses_table', 8),
(47, '2026_08_05_110108_add_dashboard_columns_to_orders_table', 9),
(48, '2026_08_05_120000_add_columns_to_notifications_table', 10),
(49, '2026_08_06_073131_create_user_addresses_table', 11),
(50, '2026_08_06_092347_add_data_to_notifications_table', 12),
(51, '2026_08_06_093902_create_reviews_table', 13),
(52, '2026_08_06_094039_create_customer_payment_methods_table', 14),
(53, '2026_08_06_094157_create_login_history_table', 15),
(54, '2026_08_06_094307_create_order_statuses_table', 16),
(55, '2026_08_10_084244_add_password_to_customers_table', 17),
(56, '2026_08_10_125845_make_email_nullable_in_customers', 18),
(57, '2026_08_10_130535_make_customer_email_nullable_in_orders', 19),
(58, '2026_08_10_130934_change_user_id_foreign_key_in_orders', 20),
(59, '2026_08_18_090027_create_product_sizes_table', 21),
(60, '2026_08_18_090029_create_product_colors_table', 21),
(61, '2026_08_18_095236_add_size_color_to_order_items_table', 22),
(62, '2026_08_22_055216_add_seo_fields_to_categories', 23),
(63, '2026_08_22_055221_add_seo_fields_to_brands', 23),
(64, '2026_08_24_134636_create_social_links_table', 24);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'general',
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `icon` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `shipping_address` text NOT NULL,
  `billing_address` text DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'cod',
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `customer_name`, `customer_email`, `customer_phone`, `shipping_address`, `billing_address`, `subtotal`, `tax`, `shipping_cost`, `discount`, `total`, `payment_method`, `payment_status`, `status`, `total_amount`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'ORD-MNHYKQ3R', 2, 'Ameerullah', 'ameerullahmayo@gmail.com', '03248573797', '5#No Stop Khana nau Lahore', '5#No Stop Khana nau Lahore', 45000.00, 0.00, 150.00, 0.00, 45150.00, 'cod', 'paid', 'delivered', 0.00, '', '2026-06-16 04:35:56', '2026-06-16 04:50:06'),
(2, 'ORD-IZXLKVST', 2, 'Huzifa', 'huzifa@gmail.com', '0300-4815397', '5#No Stop Khana nau Lahore', '5#No Stop Khana nau Lahore', 45000.00, 0.00, 150.00, 0.00, 45150.00, 'cod', 'paid', 'delivered', 0.00, '', '2026-06-16 05:17:12', '2026-06-16 06:01:36'),
(3, 'ORD-KXDGQIYY', 2, 'Anas Tariq', 'anastariq@gmail.com', '03454815398', '5#No Stop Khana nau Lahore', '5#No Stop Khana nau Lahore', 45000.00, 0.00, 150.00, 0.00, 45150.00, 'bank_transfer', 'paid', 'delivered', 0.00, '', '2026-06-16 06:09:50', '2026-06-16 06:12:24'),
(4, 'ORD-3BYN1CUQ', 2, 'Abuhaira', 'Abuhaira@gmail.com', '03006278955', '5#No Stop Khana nau Lahore', '5#No Stop Khana nau Lahore', 550.00, 0.00, 150.00, 0.00, 700.00, 'easypaisa', 'paid', 'delivered', 0.00, '', '2026-06-17 02:52:05', '2026-06-22 06:02:44'),
(5, 'ORD-DTR1FO6O', 2, 'ansir', 'ansir@gmail.com', '03096060838', '5#No Stop Khana nau Lahore', '5#No Stop Khana nau Lahore', 500.00, 0.00, 150.00, 0.00, 650.00, 'cod', 'paid', 'delivered', 0.00, '', '2026-06-18 07:26:53', '2026-06-22 05:57:09'),
(6, 'ORD-HVN3TGN8', 2, 'Anas Tariq', 'anastariq030@gmail.com', '03454815398', '5#No Stop Khana nau Lahore', '5#No Stop Khana nau Lahore', 500.00, 0.00, 150.00, 0.00, 650.00, 'cod', 'paid', 'delivered', 0.00, '', '2026-06-29 23:51:17', '2026-06-29 23:54:34'),
(7, 'ORD-32JB8MNY', 2, 'Ameer Hussain', 'ameerullahmayo1866@gmail.com', '03248573797', '5#No Stop Khana nau Lahore', '5#No Stop Khana nau Lahore', 1000.00, 0.00, 150.00, 250.00, 900.00, 'cod', 'paid', 'delivered', 0.00, '', '2026-06-30 00:04:06', '2026-06-30 00:04:22'),
(8, 'ORD-000033', 13, 'Ahmad ali', 'ahmad1@gmail.com', '03000000000', 'abc aieuurduhi iufhwuefh n, lahore, punjab - 57000', 'abc aieuurduhi iufhwuefh n, lahore, punjab - 57000', 15980.00, 1598.00, 0.00, 0.00, 17578.00, 'cash_on_delivery', 'pending', 'pending', 0.00, NULL, '2026-08-08 15:50:50', '2026-08-08 15:50:50'),
(9, 'ORD-000034', 13, 'Ahmad ali', 'ahmad1@gmail.com', '03000000000', 'abc aieuurduhi iufhwuefh n, lahore, punjab - 57000', 'abc aieuurduhi iufhwuefh n, lahore, punjab - 57000', 15980.00, 1598.00, 0.00, 0.00, 17578.00, 'cash_on_delivery', 'pending', 'pending', 0.00, NULL, '2026-08-08 15:50:52', '2026-08-08 15:50:52'),
(10, 'ORD-000035', 13, 'Ahmad ali', 'ahmad1@gmail.com', '03004040565', 'dflnaknkfdv ddvfjvnfvjn fkvjnfvk;jjb, Bahawalpur, Punjab - 547483', 'dflnaknkfdv ddvfjvnfvjn fkvjnfvk;jjb, Bahawalpur, Punjab - 547483', 7990.00, 799.00, 0.00, 0.00, 8789.00, 'cash_on_delivery', 'pending', 'delivered', 0.00, NULL, '2026-08-08 16:20:02', '2026-08-10 13:54:31'),
(11, 'ORD-000036', 13, 'Ahmad ali', 'ahmad1@gmail.com', '0330924239u8y', 'kfdjbkf fkfbsdfjjfb dkjbjffjkjb , Lahore, Punjab - 57000', 'kfdjbkf fkfbsdfjjfb dkjbjffjkjb , Lahore, Punjab - 57000', 8990.00, 899.00, 0.00, 0.00, 9889.00, 'cash_on_delivery', 'pending', 'pending', 0.00, NULL, '2026-08-08 16:41:30', '2026-08-08 16:41:30'),
(12, 'ORD-000037', 13, 'Ahmad ali', 'ahmad1@gmail.com', '03013456789', 'fioewhf jkfekejfjhf fkjekfjh, Lahore, Punjab - 57000', 'fioewhf jkfekejfjhf fkjekfjh, Lahore, Punjab - 57000', 7990.00, 799.00, 0.00, 0.00, 8789.00, 'cash_on_delivery', 'pending', 'shipped', 0.00, NULL, '2026-08-08 16:57:08', '2026-08-10 17:25:58'),
(13, 'ORD-000038', 13, 'Ahmad ali', 'ahmad1@gmail.com', '03010214879', 'wahdat road station lahore, Lahore, Punjab - 57000', 'wahdat road station lahore, Lahore, Punjab - 57000', 2499.00, 249.90, 0.00, 0.00, 2748.90, 'cash_on_delivery', 'pending', 'pending', 0.00, NULL, '2026-08-08 17:07:37', '2026-08-08 17:07:37'),
(14, 'ORD-000039', 13, 'Ahmad ali', 'ahmad1@gmail.com', '03012345678', 'samdbckasbb asd,mnansskjn , Lahore, Punjab - 57000', 'samdbckasbb asd,mnansskjn , Lahore, Punjab - 57000', 10990.00, 1099.00, 0.00, 0.00, 12089.00, 'cash_on_delivery', 'pending', 'cancelled', 0.00, NULL, '2026-08-08 17:30:08', '2026-08-08 17:37:17'),
(15, 'ORD-000040', 13, 'Ahmad ali', 'ahmad1@gmail.com', '03092939398', 'wahdat road station lahore, Lahore, Punjab - 57000', 'wahdat road station lahore, Lahore, Punjab - 57000', 33960.00, 3396.00, 0.00, 0.00, 37356.00, 'cash_on_delivery', 'pending', 'shipped', 0.00, NULL, '2026-08-08 18:58:07', '2026-08-10 17:01:23'),
(16, 'ORD-000041', 17, 'muhammad rehman', 'aliahmad@gmail.com', '03012526277', 'dkvjdsv hscn;skjjbdn dvkjbh, Lahore, Punjab - 57000', 'dkvjdsv hscn;skjjbdn dvkjbh, Lahore, Punjab - 57000', 15980.00, 1598.00, 0.00, 0.00, 17578.00, 'cash_on_delivery', 'pending', 'delivered', 0.00, NULL, '2026-08-10 13:48:21', '2026-08-10 17:26:16'),
(17, 'ORD-000042', 13, 'Ahmad ali', 'ahmad1@gmail.com', '03024567890', 'jdfs fdfjks dfdkhs, Lahore, Punjab - 5700', 'jdfs fdfjks dfdkhs, Lahore, Punjab - 5700', 15980.00, 1598.00, 0.00, 0.00, 17578.00, 'cash_on_delivery', 'pending', 'pending', 0.00, NULL, '2026-08-10 16:56:54', '2026-08-10 16:56:54'),
(18, 'ORD-000043', 13, 'Ahmad ali', 'ahmad1@gmail.com', '03024536789', 'kzfhhd sfkhsdj fdskhs, Lahore, Punjab - 57000', 'kzfhhd sfkhsdj fdskhs, Lahore, Punjab - 57000', 7990.00, 799.00, 0.00, 0.00, 8789.00, 'cash_on_delivery', 'pending', 'pending', 0.00, NULL, '2026-08-10 17:20:05', '2026-08-10 17:20:05'),
(20, 'ORD-000044', 21, 'mr ali', NULL, '03011213145', 'hashim street 44 ali town lahore, Lahore, Punjab - 57000', 'hashim street 44 ali town lahore, Lahore, Punjab - 57000', 7990.00, 799.00, 0.00, 0.00, 8789.00, 'cash_on_delivery', 'pending', 'pending', 0.00, NULL, '2026-08-10 20:11:07', '2026-08-10 20:11:07'),
(21, 'ORD-000045', 22, 'mr ali 2', NULL, '03012233445', 'fh jfsj fdkj , lahore, Lahore, Punjab - 57000', 'fh jfsj fdkj , lahore, Lahore, Punjab - 57000', 7990.00, 799.00, 0.00, 0.00, 8789.00, 'cash_on_delivery', 'pending', 'pending', 0.00, NULL, '2026-08-10 20:27:59', '2026-08-18 18:58:28'),
(22, 'ORD-000046', 23, 'me hamza', '', '03077787678', 'johar town lahore, Lahore, Punjab - 54000', 'johar town lahore, Lahore, Punjab - 54000', 7990.00, 799.00, 0.00, 0.00, 8789.00, 'cash_on_delivery', 'pending', 'pending', 0.00, NULL, '2026-08-18 16:40:53', '2026-08-18 16:40:53'),
(23, 'ORD-000047', 24, 'me  hamza 2', NULL, '03078383432', 'johar town lahore, Lahore, Punjab - 57000', 'johar town lahore, Lahore, Punjab - 57000', 7990.00, 799.00, 0.00, 0.00, 8789.00, 'cash_on_delivery', 'pending', 'pending', 0.00, NULL, '2026-08-18 17:53:57', '2026-08-18 17:53:57'),
(24, 'ORD-000048', 25, 'abc abc', NULL, '03237888199', 'johar town loahore, Lahore, Punjab - 57000', 'johar town loahore, Lahore, Punjab - 57000', 7990.00, 799.00, 0.00, 0.00, 8789.00, 'cash_on_delivery', 'pending', 'pending', 0.00, NULL, '2026-08-18 18:01:02', '2026-08-18 18:01:02'),
(25, 'ORD-000049', 26, 'me hamza 3', NULL, '03333333333', 'johar town lahore, Larkana, Punjab - 57000', 'johar town lahore, Larkana, Punjab - 57000', 7990.00, 799.00, 0.00, 0.00, 8789.00, 'cash_on_delivery', 'pending', 'pending', 0.00, NULL, '2026-08-18 18:26:41', '2026-08-18 18:26:41'),
(26, 'ORD-000050', 26, 'ksjdf sd,vn', NULL, '03333333333', 'wkqrfkjf, Matiari, Punjab - 57000', 'wkqrfkjf, Matiari, Punjab - 57000', 7990.00, 799.00, 0.00, 0.00, 8789.00, 'cash_on_delivery', 'pending', 'pending', 0.00, NULL, '2026-08-18 19:08:42', '2026-08-18 19:08:42'),
(27, 'ORD-000051', 27, 'adfc ytf', NULL, '03333000000', 'lahore, Matiari, Punjab - 54000', 'lahore, Matiari, Punjab - 54000', 8990.00, 899.00, 0.00, 0.00, 9889.00, 'cash_on_delivery', 'pending', 'pending', 0.00, NULL, '2026-08-25 18:04:02', '2026-08-25 18:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `product_sku` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `size`, `color`, `product_sku`, `quantity`, `price`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Redmi Note 13', NULL, NULL, 'RED-NOT-13-1DB3', 1, 45000.00, 45000.00, '2026-06-16 04:35:56', '2026-06-16 04:35:56'),
(2, 2, NULL, 'Redmi Note 13', NULL, NULL, 'RED-NOT-13-1DB3', 1, 45000.00, 45000.00, '2026-06-16 05:17:12', '2026-06-16 05:17:12'),
(3, 3, NULL, 'Redmi Note 13', NULL, NULL, 'RED-NOT-13-1DB3', 1, 45000.00, 45000.00, '2026-06-16 06:09:50', '2026-06-16 06:09:50'),
(4, 4, NULL, 'Books', NULL, NULL, 'BO-EC55', 1, 50.00, 50.00, '2026-06-17 02:52:05', '2026-06-17 02:52:05'),
(5, 4, NULL, 'Shoes', NULL, NULL, 'SH-D95A', 1, 500.00, 500.00, '2026-06-17 02:52:05', '2026-06-17 02:52:05'),
(6, 5, NULL, 'Shoes', NULL, NULL, 'SH-D95A', 1, 500.00, 500.00, '2026-06-18 07:26:53', '2026-06-18 07:26:53'),
(7, 6, NULL, 'Shoes', NULL, NULL, 'SH-D95A', 1, 500.00, 500.00, '2026-06-29 23:51:17', '2026-06-29 23:51:17'),
(8, 7, NULL, 'Shoes', NULL, NULL, 'SH-D95A', 2, 500.00, 1000.00, '2026-06-30 00:04:06', '2026-06-30 00:04:06'),
(9, 8, 21, 'Luxury Embroidered 3-piece suit', NULL, NULL, NULL, 2, 7990.00, 15980.00, '2026-08-08 15:50:50', '2026-08-08 15:50:50'),
(10, 9, 21, 'Luxury Embroidered 3-piece suit', NULL, NULL, NULL, 2, 7990.00, 15980.00, '2026-08-08 15:50:53', '2026-08-08 15:50:53'),
(11, 10, 20, 'New Arrivals Luxury Women\'s Suits Collection', NULL, NULL, NULL, 1, 7990.00, 7990.00, '2026-08-08 16:20:02', '2026-08-08 16:20:02'),
(12, 11, 17, 'Luxury Embroidered Suit – Emerald Grace', NULL, NULL, NULL, 1, 8990.00, 8990.00, '2026-08-08 16:41:30', '2026-08-08 16:41:30'),
(13, 12, 20, 'New Arrivals Luxury Women\'s Suits Collection', NULL, NULL, NULL, 1, 7990.00, 7990.00, '2026-08-08 16:57:08', '2026-08-08 16:57:08'),
(14, 13, 9, 'Women\'s Summer Dress', NULL, NULL, NULL, 1, 2499.00, 2499.00, '2026-08-08 17:07:37', '2026-08-08 17:07:37'),
(15, 14, 18, 'Luxury Green Embroidered 3 Piece Suit', NULL, NULL, NULL, 1, 10990.00, 10990.00, '2026-08-08 17:30:08', '2026-08-08 17:30:08'),
(16, 15, 19, 'Luxury Cream Embroidered 3 Piece Suit', NULL, NULL, NULL, 2, 8990.00, 17980.00, '2026-08-08 18:58:07', '2026-08-08 18:58:07'),
(17, 15, 20, 'New Arrivals Luxury Women\'s Suits Collection', NULL, NULL, NULL, 1, 7990.00, 7990.00, '2026-08-08 18:58:07', '2026-08-08 18:58:07'),
(18, 15, 21, 'Luxury Embroidered 3-piece suit', NULL, NULL, NULL, 1, 7990.00, 7990.00, '2026-08-08 18:58:07', '2026-08-08 18:58:07'),
(19, 16, 21, 'Luxury Embroidered 3-piece suit', NULL, NULL, NULL, 2, 7990.00, 15980.00, '2026-08-10 13:48:21', '2026-08-10 13:48:21'),
(20, 17, 21, 'Luxury Embroidered 3-piece suit', NULL, NULL, NULL, 2, 7990.00, 15980.00, '2026-08-10 16:56:54', '2026-08-10 16:56:54'),
(21, 18, 21, 'Luxury Embroidered 3-piece suit', NULL, NULL, NULL, 1, 7990.00, 7990.00, '2026-08-10 17:20:05', '2026-08-10 17:20:05'),
(22, 20, 20, 'New Arrivals Luxury Women\'s Suits Collection', NULL, NULL, NULL, 1, 7990.00, 7990.00, '2026-08-10 20:11:07', '2026-08-10 20:11:07'),
(23, 21, 21, 'Luxury Embroidered 3-piece suit', NULL, NULL, NULL, 1, 7990.00, 7990.00, '2026-08-10 20:27:59', '2026-08-10 20:27:59'),
(24, 22, 21, 'Luxury Embroidered 3-piece suit', NULL, NULL, NULL, 1, 7990.00, 7990.00, '2026-08-18 16:40:53', '2026-08-18 16:40:53'),
(25, 23, 21, 'Luxury Embroidered 3-piece suit', NULL, NULL, NULL, 1, 7990.00, 7990.00, '2026-08-18 17:53:58', '2026-08-18 17:53:58'),
(26, 24, 21, 'Luxury Embroidered 3-piece suit', NULL, NULL, NULL, 1, 7990.00, 7990.00, '2026-08-18 18:01:02', '2026-08-18 18:01:02'),
(27, 25, 21, 'Luxury Embroidered 3-piece suit', 'small', 'light purple', NULL, 1, 7990.00, 7990.00, '2026-08-18 18:26:41', '2026-08-18 18:26:41'),
(28, 26, 21, 'Luxury Embroidered 3-piece suit', 'medeium', 'dark green', NULL, 1, 7990.00, 7990.00, '2026-08-18 19:08:42', '2026-08-18 19:08:42'),
(29, 27, 19, 'Luxury Cream Embroidered 3 Piece Suit', NULL, NULL, NULL, 1, 8990.00, 8990.00, '2026-08-25 18:04:02', '2026-08-25 18:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `order_id`, `status`, `note`, `created_at`, `updated_at`) VALUES
(1, 14, 'cancelled', 'Order cancelled by customer', '2026-08-08 17:37:17', '2026-08-08 17:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `is_fixed` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `meta_title`, `meta_description`, `is_fixed`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'About Us', 'about-us', '<p>Welcome to MyShop! We are a leading e-commerce store providing quality products at affordable prices. Our mission is to deliver the best shopping experience to our customers.</p>\n', 'About Us - MyShop', 'Learn more about MyShop, your trusted online shopping destination in Pakistan.', 0, 1, '2026-06-24 01:11:17', '2026-06-24 01:11:17', NULL),
(2, 'About VELENZA', 'about', '<h1>About VELENZA</h1><p>Your about page content here...</p>', 'About VELENZA  Luxury Pakistani Fashion', 'Learn about VELENZA - your destination for luxury Pakistani fashion.', 1, 1, '2026-08-24 23:29:02', '2026-08-24 23:29:02', NULL),
(3, 'Contact Us', 'contact', '<h1>Contact Us</h1><p>Your contact page content here...</p>', 'Contact VELENZA  Luxury Pakistani Fashion', 'Get in touch with VELENZA for support and inquiries.', 1, 1, '2026-08-24 23:30:23', '2026-08-24 23:30:23', NULL),
(4, 'Privacy Policy', 'privacy', '<h1>Privacy Policy</h1><p>Your privacy matters to us...</p>', 'Privacy Policy  VELENZA', 'Read our privacy policy.', 1, 1, '2026-08-24 23:32:02', '2026-08-24 23:32:02', NULL),
(5, 'Terms & Conditions', 'terms', '<h1>Terms & Conditions</h1><p>Read our terms and conditions...</p>', 'Terms & Conditions  VELENZA', 'Read our terms and conditions.', 1, 1, '2026-08-24 23:32:02', '2026-08-24 23:32:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `merchant_id` varchar(255) DEFAULT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `api_secret` varchar(255) DEFAULT NULL,
  `webhook_url` varchar(255) DEFAULT NULL,
  `extra_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extra_fields`)),
  `mode` enum('test','live') NOT NULL DEFAULT 'test',
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `name`, `slug`, `logo`, `description`, `merchant_id`, `api_key`, `api_secret`, `webhook_url`, `extra_fields`, `mode`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'JazzCash', 'jazzcash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 0, 1, '2026-06-15 05:01:08', '2026-06-15 05:01:08'),
(2, 'Easypaisa', 'easypaisa', NULL, NULL, NULL, 'ameerullahmayo1866@gmail.com', '12345678', NULL, NULL, 'test', 1, 2, '2026-06-15 05:01:08', '2026-06-22 05:55:31'),
(4, 'PayPal', 'paypal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 0, 4, '2026-06-15 05:01:08', '2026-06-15 05:01:08'),
(6, 'Bank Transfer', 'bank_transfer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 0, 6, '2026-06-15 05:01:08', '2026-06-15 05:01:08'),
(7, 'UNION', 'union', NULL, '', '', 'ameerullahmayo1866@gmail.com', '12345678', '', NULL, 'live', 1, 1, '2026-06-29 06:39:32', '2026-06-29 06:41:19');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `code`, `icon`, `description`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 'Anas tariq', 'txn-kqsdijps', 'fas fa-university', '', 1, 1, '2026-06-16 06:19:31', '2026-06-16 06:25:04');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `module`, `created_at`, `updated_at`) VALUES
(1, 'View Orders', 'View Orders', 'Orders dekhne ki ijazat', 'Orders', '2026-06-17 05:16:32', '2026-06-17 05:16:32'),
(2, 'View Payments', 'View Payments', '', 'Payments', '2026-06-23 00:42:15', '2026-06-23 00:42:15'),
(3, 'View Reports', 'View Reports', '', 'Reports', '2026-06-23 00:43:09', '2026-06-23 00:43:09'),
(4, 'Edit Settings ', 'Edit Settings ', '', 'Settings', '2026-06-23 00:43:46', '2026-06-23 00:43:46'),
(5, 'View Customers', 'View Customers', '', 'Customers', '2026-06-23 00:44:58', '2026-06-23 00:44:58'),
(6, 'Edit Customers', 'Edit Customers', '', 'Customers', '2026-06-23 00:45:30', '2026-06-23 00:45:30'),
(7, 'View Products', 'View Products', '', 'Products', '2026-06-23 00:46:17', '2026-06-23 00:46:17'),
(8, 'Add Products', 'Add Products', '', 'Products', '2026-06-23 00:46:47', '2026-06-23 00:46:47'),
(9, ' Edit Products', ' Edit Products', '', 'Products', '2026-06-23 00:47:21', '2026-06-23 00:47:21'),
(10, 'Delete Products', 'Delete Products', '', 'Products', '2026-06-23 00:47:52', '2026-06-23 00:47:52'),
(11, 'Edit Orders', 'Edit Orders', '', 'Orders', '2026-06-23 00:48:40', '2026-06-23 00:48:40'),
(12, 'Delete Orders', 'Delete Orders', '', 'Orders', '2026-06-23 00:49:12', '2026-06-23 00:49:12'),
(13, 'Reports', 'sale', 'sale reports', 'sale', '2026-06-30 00:15:33', '2026-06-30 00:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(2, 5, 2, NULL, NULL),
(3, 6, 2, NULL, NULL),
(4, 1, 2, NULL, NULL),
(5, 11, 2, NULL, NULL),
(6, 12, 2, NULL, NULL),
(7, 2, 2, NULL, NULL),
(8, 7, 2, NULL, NULL),
(9, 8, 2, NULL, NULL),
(10, 9, 2, NULL, NULL),
(11, 10, 2, NULL, NULL),
(12, 3, 2, NULL, NULL),
(13, 4, 2, NULL, NULL),
(14, 3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `compare_price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attributes`)),
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `sku`, `description`, `price`, `compare_price`, `stock`, `image`, `gallery`, `category_id`, `brand_id`, `status`, `featured`, `attributes`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(8, 'Women\'s Floral Kurti', 'womens-floral-kurti', 'WOM-FLO-KUR-6CAE', '<p>Add timeless elegance to your ethnic wardrobe with the Women&#39;s Floral Kurti. Crafted from premium-quality fabric, it showcases beautiful floral prints with a comfortable straight-cut design. Pair it with trousers, leggings, or jeans for festivals, office wear, or casual gatherings.</p>\n\n<p><strong>Features:</strong></p>\n\n<ul>\n	<li>Premium breathable fabric</li>\n	<li>Elegant floral print</li>\n	<li>Comfortable straight fit</li>\n	<li>Lightweight construction</li>\n	<li>Easy to style</li>\n	<li>Suitable for festive and casual wear</li>\n	<li>Machine washable</li>\n</ul>\n', 1599.00, 2099.00, 20, 'products/ynVtRL046eSJdJRTDmclmZBZbHVqVTnLZnTXvHki.jpg', '[]', 6, 6, 'active', 0, NULL, 'Women\'s Floral Kurti', 'Elegant floral printed kurti perfect for casual and festive wear.', '2026-07-30 16:19:30', '2026-08-07 18:08:02'),
(9, 'Women\'s Summer Dress', 'womens-summer-dress', 'WOM-SUM-DRE-46C0', '<p>Stay cool and fashionable with the Women&#39;s Summer Dress. Designed with lightweight breathable fabric, this dress offers maximum comfort during warm weather while maintaining an elegant appearance. Its flattering silhouette makes it suitable for casual outings, vacations, brunches, and summer parties.</p>\n\n<p><strong>Features:</strong></p>\n\n<ul>\n	<li>Lightweight summer fabric</li>\n	<li>Breathable and soft</li>\n	<li>Elegant modern design</li>\n	<li>Comfortable relaxed fit</li>\n	<li>Easy-care material</li>\n	<li>Suitable for daily and vacation wear</li>\n	<li>Fade-resistant colors</li>\n</ul>\n', 2499.00, 2599.00, 33, 'products/x5G1KIeb6EnSbxKvXjfxb2jsYZ2O2Rq3DM938typ.jpg', '[\"products\\/gallery\\/LDxz5JVKAjod2bT9PDHU7WvYCHYmU2ZOeWsMvVwN.jpg\"]', 10, 6, 'active', 0, NULL, 'Women\'s Summer Dress', 'Lightweight and fashionable summer dress with premium fabric.', '2026-07-30 16:23:42', '2026-08-11 16:42:35'),
(10, 'Kids Casual Wear Set', 'kids-casual-wear-set', 'KID-CAS-WEA-1F09', '<p>Give your child all-day comfort with this stylish Kids Casual Wear Set. Made from soft, breathable cotton, the matching top and bottom provide unrestricted movement for active kids. Perfect for school, playtime, vacations, and everyday adventures.</p>\n\n<p><strong>Features:</strong></p>\n\n<ul>\n	<li>Soft cotton fabric</li>\n	<li>Comfortable two-piece set</li>\n	<li>Lightweight and breathable</li>\n	<li>Skin-friendly material</li>\n	<li>Durable stitching</li>\n	<li>Easy to wash</li>\n	<li>Perfect for daily wear</li>\n</ul>\n', 1499.00, 1999.00, 50, 'products/f8c6YiVw8jKjSLbaKC15kW35YMvDWACgJvvKZNoS.jpg', '[\"products\\/gallery\\/2TgK8nDjw3tqicsvmaxxOhCQgY0NctvGTczbKMN8.jpg\"]', 7, 5, 'active', 0, NULL, 'Kids Casual Wear Set', '\nComfortable clothing set designed for kids daily wear.', '2026-07-30 16:25:11', '2026-08-07 18:07:54'),
(13, 'Women\'s Floral Maxi Dress', 'womens-floral-maxi-dress', 'WOM-FLO-MAX-6D80', '<p>A beautifully designed floral maxi dress made from lightweight, breathable fabric. Featuring a flattering silhouette, soft lining, and elegant print, it&#39;s perfect for parties, vacations, and everyday fashion.Designed to make every occasion special, the Women&#39;s Floral Maxi Dress combines elegance with everyday comfort. Crafted from lightweight premium fabric, it features a graceful floral print, flowing silhouette, and flattering waistline. Whether you&#39;re attending a party, dinner, or weekend getaway, this dress delivers effortless sophistication.</p>\n\n<p><strong>Features:</strong></p>\n\n<ul>\n	<li>Soft breathable fabric</li>\n	<li>Elegant floral print</li>\n	<li>Full-length maxi design</li>\n	<li>Comfortable regular fit</li>\n	<li>Lightweight and airy</li>\n	<li>Perfect for casual and formal occasions</li>\n	<li>Easy-care fabric</li>\n</ul>\n', 3999.00, 4599.00, 16, 'products/EFCvvNNv964nUtI5bGqqy1GkwlkE4P6rsaJZ8lwN.jpg', '[\"products\\/gallery\\/dAsxJdThzB3Dj08F8IWJ1Y2RpmF1zDhuOHOh8mW4.jpg\"]', 6, 7, 'active', 0, NULL, ' Floral Maxi Dress', 'Featuring a flattering silhouette, soft lining, and elegant print, it\'s perfect for parties, vacations, and everyday fashion.', '2026-07-30 20:07:59', '2026-08-07 18:07:57'),
(17, 'Luxury Embroidered Suit – Emerald Grace', 'luxury-embroidered-suit-emerald-grace', 'LUX-EMB-LAW-0622', '<h2>Product Description</h2>\n\n<p>Experience elegance with this beautifully crafted luxury women&#39;s suit, designed for women who appreciate premium quality, timeless style, and exceptional comfort. Made from high-quality fabric, this outfit offers a graceful silhouette while ensuring all-day ease of wear. The intricate embroidery and refined finishing enhance its luxurious appeal, making it a perfect choice for festive occasions, family gatherings, formal events, dinners, and celebrations.</p>\n\n<h3>Product Features</h3>\n\n<ul>\n	<li>\n	<p>Premium-quality luxury fabric</p>\n	</li>\n	<li>\n	<p>Elegant embroidered design</p>\n	</li>\n	<li>\n	<p>Three-piece complete suit</p>\n	</li>\n	<li>\n	<p>Soft, breathable, and comfortable material</p>\n	</li>\n	<li>\n	<p>Beautifully finished neckline and sleeves</p>\n	</li>\n	<li>\n	<p>Matching trousers included</p>\n	</li>\n	<li>\n	<p>Coordinating dupatta included</p>\n	</li>\n	<li>\n	<p>Ideal for festive, formal, and semi-formal occasions</p>\n	</li>\n	<li>\n	<p>Lightweight and easy to wear</p>\n	</li>\n	<li>\n	<p>Durable stitching for long-lasting quality</p>\n	</li>\n	<li>\n	<p>Comfortable fit for extended wear</p>\n	</li>\n	<li>\n	<p>Perfect for Eid, weddings, parties, and family gatherings</p>\n	</li>\n	<li>\n	<p>Easy to accessorize with heels and jewelry</p>\n	</li>\n</ul>\n\n<h3>Package Includes</h3>\n\n<ul>\n	<li>\n	<p>1 Embroidered Shirt</p>\n	</li>\n	<li>\n	<p>1 Matching Trouser</p>\n	</li>\n	<li>\n	<p>1 Coordinating Dupatta</p>\n	</li>\n</ul>\n\n<h3>Fabric Details</h3>\n\n<ul>\n	<li>\n	<p>Shirt: Premium Fabric</p>\n	</li>\n	<li>\n	<p>Trouser: Matching Fabric</p>\n	</li>\n	<li>\n	<p>Dupatta: Coordinating Fabric</p>\n	</li>\n</ul>\n\n<h3>Care Instructions</h3>\n\n<ul>\n	<li>\n	<p>Hand wash separately in cold water or dry clean.</p>\n	</li>\n	<li>\n	<p>Do not use bleach.</p>\n	</li>\n	<li>\n	<p>Iron on low heat from the reverse side.</p>\n	</li>\n	<li>\n	<p>Avoid direct sunlight for prolonged periods while drying.</p>\n	</li>\n	<li>\n	<p>Store in a cool, dry place to preserve fabric quality and embroidery.</p>\n	</li>\n</ul>\n\n<h3>Note</h3>\n\n<ul>\n	<li>\n	<p>Actual product color may vary slightly due to lighting and screen settings.</p>\n	</li>\n	<li>\n	<p>Measurements may vary slightly due to manual production.</p>\n	</li>\n</ul>\n', 8990.00, 10990.00, 20, 'products/fw8xhWYRcNQvFIoju9sE4F8DgmxhRqGf7JMn1nmr.png', '[\"products\\/gallery\\/rCRv1j5fZl9rL17Khn2UPqeqtyCUTFam0PpVTlLU.png\"]', 6, 9, 'active', 1, NULL, 'Luxury Embroidered Lawn Suit for Women | Premium 3-Piece Collection', 'Shop premium luxury embroidered lawn suits featuring elegant designs, breathable fabrics, and stylish 3-piece sets for festive and formal occasions.', '2026-08-05 13:18:00', '2026-08-05 13:42:50'),
(18, 'Luxury Green Embroidered 3 Piece Suit', 'luxury-green-embroidered-3-piece-suit', 'LUX-GRE-EMB-EAC9', '<h2>Product Description</h2>\n\n<p>Refresh your wardrobe with this stunning Luxury Green Women&#39;s Suit, a perfect blend of sophistication, elegance, and timeless fashion. Designed with meticulous attention to detail, this beautiful ensemble is crafted from premium-quality fabric that offers exceptional comfort while maintaining a luxurious appearance. The rich green shade symbolizes freshness and grace, making it an ideal choice for festive occasions, weddings, Eid celebrations, family gatherings, formal dinners, and special events.</p>\n\n<h3>Product Features</h3>\n\n<ul>\n	<li>\n	<p>Premium luxury-quality fabric</p>\n	</li>\n	<li>\n	<p>Elegant green color with a sophisticated finish</p>\n	</li>\n	<li>\n	<p>Beautiful embroidered detailing</p>\n	</li>\n	<li>\n	<p>Three-piece complete outfit</p>\n	</li>\n	<li>\n	<p>Soft, breathable, and lightweight fabric</p>\n	</li>\n	<li>\n	<p>Comfortable fit for all-day wear</p>\n	</li>\n	<li>\n	<p>Matching trousers included</p>\n	</li>\n	<li>\n	<p>Coordinating dupatta included</p>\n	</li>\n	<li>\n	<p>Premium stitching and durable craftsmanship</p>\n	</li>\n	<li>\n	<p>Suitable for festive, formal, and semi-formal occasions</p>\n	</li>\n	<li>\n	<p>Perfect for Eid, weddings, parties, dinners, and family events</p>\n	</li>\n	<li>\n	<p>Timeless design that never goes out of style</p>\n	</li>\n	<li>\n	<p>Easy to pair with heels, handbags, and statement jewelry</p>\n	</li>\n</ul>\n\n<h3>Package Includes</h3>\n\n<ul>\n	<li>\n	<p>1 Embroidered Shirt</p>\n	</li>\n	<li>\n	<p>1 Matching Trouser</p>\n	</li>\n	<li>\n	<p>1 Coordinating Dupatta</p>\n	</li>\n</ul>\n\n<h3>Fabric Details</h3>\n\n<ul>\n	<li>\n	<p>Shirt: Premium Luxury Fabric</p>\n	</li>\n	<li>\n	<p>Trouser: Matching Premium Fabric</p>\n	</li>\n	<li>\n	<p>Dupatta: Coordinating Premium Fabric</p>\n	</li>\n</ul>\n\n<h3>Care Instructions</h3>\n\n<ul>\n	<li>\n	<p>Hand wash separately or dry clean for best results.</p>\n	</li>\n	<li>\n	<p>Do not bleach.</p>\n	</li>\n	<li>\n	<p>Iron on low heat from the reverse side.</p>\n	</li>\n	<li>\n	<p>Dry in shade to preserve the richness of the green color.</p>\n	</li>\n	<li>\n	<p>Store folded in a cool, dry place.</p>\n	</li>\n</ul>\n\n<h3>Note</h3>\n\n<ul>\n	<li>\n	<p>Actual product color may vary slightly due to photography lighting and screen settings.</p>\n	</li>\n	<li>\n	<p>Slight variations in embroidery or measurements may occur due to the handcrafted nature of the product.</p>\n	</li>\n</ul>\n', 10990.00, 12990.00, 20, 'products/uoZ9IMcsL7CiOJ8jVg3yFYfNZUzjbsAcjIMSgary.png', '[]', 6, 9, 'active', 1, NULL, 'Luxury Green Embroidered 3 Piece Suit for Women | Premium Collection', 'Shop the Luxury Green Embroidered 3 Piece Suit featuring premium fabric, elegant embroidery, matching trousers, and a graceful dupatta. Perfect for Eid, weddings, festive occasions, and formal events.', '2026-08-05 13:24:20', '2026-08-05 13:41:31'),
(19, 'Luxury Cream Embroidered 3 Piece Suit', 'luxury-cream-embroidered-3-piece-suit', 'LUX-CRE-EMB-BA51', '<h2>Product Description</h2>\n\n<p>Embrace timeless elegance with this Luxury Cream Embroidered 3 Piece Suit, designed for women who appreciate sophisticated style and premium craftsmanship. The graceful cream color offers a refined and versatile look, making this outfit an excellent choice for weddings, Eid celebrations, festive gatherings, formal dinners, and special occasions.</p>\n\n<p>Key Features</p>\n\n<ul>\n	<li>Premium luxury-quality fabric</li>\n	<li>Elegant cream color with a timeless appeal</li>\n	<li>Intricate embroidered detailing</li>\n	<li>Complete 3-piece suit</li>\n	<li>Soft, breathable, and lightweight material</li>\n	<li>Matching trousers included</li>\n	<li>Coordinating dupatta included</li>\n	<li>Premium stitching and fine finishing</li>\n	<li>Comfortable fit for extended wear</li>\n	<li>Ideal for weddings, Eid, parties, festive occasions, and formal events</li>\n	<li>Easy to style with heels, handbags, and statement jewelry</li>\n	<li>Durable fabric designed for long-lasting beauty</li>\n	<li>Classic design suitable for every season</li>\n</ul>\n\n<h3>Package Includes</h3>\n\n<ul>\n	<li>1 Embroidered Shirt</li>\n	<li>1 Matching Trouser</li>\n	<li>1 Coordinating Dupatta</li>\n</ul>\n\n<h3>Care Instructions</h3>\n\n<ul>\n	<li>Hand wash separately in cold water or dry clean.</li>\n	<li>Do not bleach.</li>\n	<li>Iron on low heat from the reverse side.</li>\n	<li>Dry in shade to preserve the fabric and embroidery.</li>\n	<li>Store in a cool, dry place.</li>\n</ul>\n\n<h3>Note</h3>\n\n<ul>\n	<li>Actual product color may vary slightly due to photography lighting and screen settings.</li>\n	<li>Slight variations in embroidery and measurements may occur due to the handcrafted nature of the product.</li>\n</ul>\n', 8990.00, 10990.00, 20, 'products/TbFVmpXr6xMDSP2Rxsd8wIDAAgmzb3U3TP9FN4HV.png', '[\"products\\/gallery\\/oBHgOR1RqeEYhv4VBeuZWV6GBiFl2M9BkjE1skp5.png\"]', 6, 9, 'active', 1, NULL, 'Luxury Cream Embroidered 3 Piece Suit for Women | Elegant Premium Collection', 'SEO Description: Elevate your wardrobe with our Luxury Cream Embroidered 3 Piece Suit. Crafted from premium-quality fabric with elegant embroidery, matching trousers, and a graceful dupatta, this ensemble is perfect for weddings, Eid, festive celebrations, and formal occasions.', '2026-08-05 13:28:38', '2026-08-05 13:35:56'),
(20, 'New Arrivals Luxury Women\'s Suits Collection', 'new-arrivals-luxury-womens-suits-collection', 'PRO-NAM-NEW-BAB0', '<p>Discover the latest trends with our New Arrivals Luxury Women&#39;s Suits Collection, featuring elegant designs, premium fabrics, and sophisticated craftsmanship. This collection is specially curated for modern women who love stylish, comfortable, and timeless fashion.</p>\n\n<h3>Product Features</h3>\n\n<ul>\n	<li>Latest women&#39;s fashion collection</li>\n	<li>Premium quality fabrics</li>\n	<li>Elegant embroidered and designer patterns</li>\n	<li>Modern and stylish designs</li>\n	<li>Comfortable and breathable material</li>\n	<li>Sophisticated color combinations</li>\n	<li>High-quality stitching and finishing</li>\n	<li>Suitable for festive, formal, and casual occasions</li>\n	<li>Perfect for Eid, weddings, parties, and family gatherings</li>\n	<li>Exclusive designs added regularly</li>\n</ul>\n', 7990.00, 9990.00, 28, 'products/Gf1RuK9VdHSorFbpGdzKpdzKQueR0A3JUPtgDWcI.png', '[]', 17, 9, 'active', 1, NULL, 'New Arrivals Women\'s Suits | Latest Luxury Fashion Collection', 'Explore our latest New Arrivals women\'s suits featuring luxury fabrics, elegant embroidery, and modern designs. Shop premium Pakistani suits for festive, formal, and everyday wear.', '2026-08-05 14:19:01', '2026-08-05 14:19:32'),
(21, 'Luxury Embroidered 3-piece suit', 'luxury-embroidered-3-piece-suit', 'LUX-EMB-3-P-3DF2', '<p>Whether styled with traditional jewelry for a festive appearance or paired with minimal accessories for a sophisticated look, this embroidered 3-piece suit is a must-have addition to every luxury wardrobe.</p>\n\n<h3>Product Features</h3>\n\n<ul>\n	<li>Premium luxury quality fabric</li>\n	<li>Elegant embroidered shirt design</li>\n	<li>Complete 3-piece suit collection</li>\n	<li>Beautiful embroidery with fine detailing</li>\n	<li>Soft, comfortable, and breathable fabric</li>\n	<li>Matching trouser included</li>\n	<li>Coordinated luxury dupatta included</li>\n	<li>Premium stitching and finishing</li>\n	<li>Graceful and flattering silhouette</li>\n	<li>Suitable for weddings, Eid, parties, and festive occasions</li>\n	<li>Perfect blend of traditional and modern fashion</li>\n	<li>Long-lasting fabric quality</li>\n	<li>Easy to style with jewelry and accessories</li>\n</ul>\n\n<h3>Package Includes</h3>\n\n<ul>\n	<li>1 Embroidered Shirt</li>\n	<li>1 Matching Trouser</li>\n	<li>1 Embroidered/Printed Dupatta</li>\n</ul>\n', 7990.00, 9990.00, 20, 'products/quBykdFoUP9hFNMgK1ClijR6nxQFq2hmdwYbIekd.png', '[]', 12, 9, 'active', 1, NULL, 'Luxury Embroidered 3 Piece Suit for Women | Premium Collection', 'Shop luxury embroidered 3-piece suits for women featuring premium fabrics, elegant embroidery, and sophisticated designs. Perfect for weddings, Eid, festive events, and formal occasions.', '2026-08-05 14:25:21', '2026-08-05 14:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_name` varchar(255) NOT NULL,
  `color_code` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id`, `product_id`, `color_name`, `color_code`, `stock`, `created_at`, `updated_at`) VALUES
(2, 21, 'purpul sky', '#26d4f7', 1, '2026-08-18 16:23:00', '2026-08-18 16:23:00'),
(3, 21, 'light purple', '#d39bed', 1, '2026-08-18 16:23:00', '2026-08-18 16:23:00'),
(4, 21, 'dark green', '#047654', 1, '2026-08-18 16:23:01', '2026-08-18 16:23:01'),
(5, 20, 'dark green', '#054226', 1, '2026-08-18 16:24:47', '2026-08-18 16:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_name` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size_name`, `stock`, `created_at`, `updated_at`) VALUES
(2, 21, 'medeium', 1, '2026-08-18 16:23:00', '2026-08-18 16:23:00'),
(3, 21, 'small', 1, '2026-08-18 16:23:00', '2026-08-18 16:23:00'),
(4, 21, 'large', 1, '2026-08-18 16:23:00', '2026-08-18 16:23:00'),
(5, 20, 'small', 1, '2026-08-18 16:24:47', '2026-08-18 16:24:47'),
(6, 20, 'medium', 1, '2026-08-18 16:24:47', '2026-08-18 16:24:47'),
(7, 20, 'large', 1, '2026-08-18 16:24:47', '2026-08-18 16:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Super Admin', 'super-admin', 'Full access to all modules', '2026-06-23 00:52:52', '2026-06-23 00:52:52'),
(3, 'Anas Tariq', 'anas tariq', 'anas tariq mayo branch', '2026-06-30 00:18:00', '2026-06-30 00:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(2, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `og_title` varchar(255) DEFAULT NULL,
  `og_description` varchar(255) DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `canonical_url` varchar(255) DEFAULT NULL,
  `no_index` tinyint(1) NOT NULL DEFAULT 0,
  `no_follow` tinyint(1) NOT NULL DEFAULT 0,
  `custom_scripts` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `page`, `meta_title`, `meta_description`, `meta_keywords`, `og_title`, `og_description`, `og_image`, `canonical_url`, `no_index`, `no_follow`, `custom_scripts`, `created_at`, `updated_at`) VALUES
(1, 'home', 'VELENZA  Luxury Pakistani Fashion', 'Discover timeless luxury fashion at VELENZA. Shop premium embroidered suits, contemporary clothing, and accessories for men and women. Free shipping across Pakistan.', 'online shopping pakistan, ecommerce lahore, buy online pakistan, cash on delivery', 'VELENZA  Luxury Fashion', 'Shop premium Pakistani fashion at VELENZA. Free shipping across Pakistan.', 'seo/frz2zB0Oz8lHGBv3hF8talaYQM8eSGjM95zP77Cl.jpg', 'https://chatgpt.com/', 0, 0, '<head>\n    <title>{{ $seo->meta_title ?? \'Default Title\' }}</title>\n    <meta name=\"description\" content=\"{{ $seo->meta_description ?? \'\' }}\">\n    <meta name=\"keywords\" content=\"{{ $seo->meta_keywords ?? \'\' }}\">\n    <meta property=\"og:title\" content=\"{{ $seo->og_title ?? \'\' }}\">\n    <meta property=\"og:description\" content=\"{{ $seo->og_description ?? \'\' }}\">\n    <meta property=\"og:image\" content=\"{{ $seo->og_image ? asset(\'storage/\'.$seo->og_image) : \'\' }}\">\n    <link rel=\"canonical\" href=\"{{ $seo->canonical_url ?? url()->current() }}\">\n</head>', '2026-06-28 23:46:09', '2026-08-22 13:35:21'),
(2, 'about', 'About VELENZA  Luxury Pakistani Fashion', 'Learn about VELENZA - your destination for luxury Pakistani fashion. Quality craftsmanship, ethical practices, and timeless style.', '', '', '', NULL, '', 0, 0, '', '2026-06-28 23:46:33', '2026-08-22 13:35:22'),
(3, 'contact', 'Contact VELENZA  Luxury Pakistani Fashion', 'Get in touch with VELENZA. Customer support, order inquiries, and fashion consultations.', '', '', '', NULL, '', 0, 0, '', '2026-06-28 23:46:34', '2026-08-22 13:35:23'),
(4, 'blog', '', '', '', '', '', NULL, '', 0, 0, '', '2026-06-28 23:46:39', '2026-06-28 23:46:39'),
(5, 'products', '', '', '', '', '', NULL, '', 0, 0, '', '2026-07-27 12:49:15', '2026-07-27 12:49:15'),
(6, 'shipping-policy', '', '', '', '', '', NULL, '', 0, 0, '', '2026-07-27 12:49:17', '2026-07-27 12:49:17'),
(7, 'return-policy', '', '', '', '', '', NULL, '', 0, 0, '', '2026-07-27 12:49:20', '2026-07-27 12:49:20'),
(8, 'privacy-policy', '', '', '', '', '', NULL, '', 0, 0, '', '2026-07-27 12:49:22', '2026-07-27 12:49:22'),
(9, 'terms', '', '', '', '', '', NULL, '', 0, 0, '', '2026-07-27 12:49:24', '2026-07-27 12:49:24'),
(10, 'category', '', '', '', '', '', NULL, '', 0, 0, '', '2026-08-24 23:03:13', '2026-08-24 23:03:13'),
(11, 'privacy', '', '', '', '', '', NULL, '', 0, 0, '', '2026-08-24 23:40:30', '2026-08-24 23:40:30'),
(12, 'product', '', '', '', '', '', NULL, '', 0, 0, '', '2026-08-25 18:00:50', '2026-08-25 18:00:50');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FEOmyKBTw1QnuwK8mSCMTW6JDUNa8ocYsDhjrxwQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU0hmS2l2QklsNFBnNkR3N0hDQlA2MTdSSUpRV2NCUkJQOWVIdExiQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mLWEtcSI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788341363);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shipping_zone_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `carrier` varchar(255) DEFAULT NULL,
  `rate_type` enum('flat','weight_based','price_based') NOT NULL DEFAULT 'flat',
  `rate` decimal(10,2) NOT NULL DEFAULT 0.00,
  `min_order_amount` decimal(10,2) DEFAULT NULL,
  `estimated_days_min` int(11) DEFAULT NULL,
  `estimated_days_max` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `shipping_zone_id`, `name`, `carrier`, `rate_type`, `rate`, `min_order_amount`, `estimated_days_min`, `estimated_days_max`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Soluta modi exercita', 'Nulla vitae praesent', 'flat', 40.00, 17.00, 61, 88, 1, '2026-06-22 06:58:41', '2026-06-22 06:58:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_zones`
--

CREATE TABLE `shipping_zones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `countries` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`countries`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_zones`
--

INSERT INTO `shipping_zones` (`id`, `name`, `region`, `countries`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pakistan -  khana nau Lahore city. 5 No stop  ', 'Punjab', '[\"Pakistan\"]', 1, '2026-06-22 06:43:31', '2026-06-22 06:48:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `platform` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon_class` varchar(255) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `platform`, `url`, `icon_class`, `label`, `is_active`, `display_order`, `created_at`, `updated_at`) VALUES
(1, 'instagram', 'https://instagram.com/yourpage', 'bi bi-instagram', 'Instagram', 1, 1, '2026-08-24 23:02:02', '2026-08-24 23:02:02'),
(2, 'facebook', 'https://facebook.com/yourpage', 'bi bi-facebook', 'Facebook', 1, 2, '2026-08-24 23:02:02', '2026-08-24 23:02:02'),
(3, 'pinterest', 'https://pinterest.com/yourpage', 'bi bi-pinterest', 'Pinterest', 1, 3, '2026-08-24 23:02:02', '2026-08-24 23:02:02');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `currency` varchar(255) NOT NULL DEFAULT 'USD',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_id`, `order_id`, `user_id`, `amount`, `payment_method`, `status`, `currency`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'TXN-RZPIAGNQ', 2, 2, 45150.00, 'cod', 'completed', 'PKR', '', '2026-06-16 05:17:12', '2026-06-16 05:56:28'),
(2, 'TXN-FYNJDE9C', 1, 2, 45150.00, 'cod', 'completed', 'PKR', NULL, '2026-06-16 06:05:35', '2026-06-16 06:05:35'),
(3, 'TXN-KQSDIJPS', 3, 2, 45150.00, 'bank_transfer', 'pending', 'PKR', '', '2026-06-16 06:09:50', '2026-06-16 06:09:50'),
(4, 'TXN-NQBKIB4Y', 4, 2, 700.00, 'easypaisa', 'pending', 'PKR', '', '2026-06-17 02:52:05', '2026-06-17 02:52:05'),
(5, 'TXN-QPGRB45Z', 5, 2, 650.00, 'cod', 'completed', 'PKR', '', '2026-06-18 07:26:53', '2026-06-18 07:26:53'),
(6, 'TXN-KQXGTFL4', 6, 2, 650.00, 'cod', 'completed', 'PKR', '', '2026-06-29 23:51:17', '2026-06-29 23:51:17'),
(7, 'TXN-TQ0ZXKEK', 7, 2, 900.00, 'cod', 'completed', 'PKR', '', '2026-06-30 00:04:06', '2026-06-30 00:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2026-06-15 05:01:09', '$2y$12$UOvj0s8x4mo8f4RNWliCqeDLPTdLfP1n3b5WnkIOtS5EVDqZilsia', '4MwBlM9yFM', '2026-06-15 05:01:10', '2026-06-15 05:01:10'),
(2, 'Ameer Hussain', 'ameerullahmayo1866@gmail.com', NULL, '$2y$12$0KBzNO8TqLboiam3QbbkgeGd7Jq8OS0OitjQopI7gixCOkUMjl1aW', NULL, '2026-06-15 05:03:22', '2026-07-01 00:10:55'),
(5, 'Asad Mukhtar', 'contact@asadmukhtar.online', NULL, '\\$2y\\$12\\$2r3DZwiehwtTs3nBQa3M5uJ33g.cGGkx8roevqdYACEcgtq8aNPdS', NULL, '2026-06-30 00:13:06', '2026-06-30 00:13:06'),
(6, 'Asad Mukhtar', 'hello@webeinventorz.com', NULL, '$2y$12$BmWh/NoZlwDFCsKBQk9MV.nZU7Xa8XSQKenw2CwVXFk/e2gIrG9bi', NULL, '2026-07-17 14:58:15', '2026-07-17 14:58:15'),
(7, 'Rehman', 'mrehman75767778@gmail.com', NULL, '$2y$12$yBoxkYCjHyhkdLq42IDRnu0JfTVlvMsf1py64zkb3c0liqn7AqDfC', NULL, '2026-07-25 19:27:58', '2026-07-25 19:27:58'),
(8, 'Rehman', 'mrehman7576777@gmail.com', NULL, '$2y$12$s4JEVEkXnTdcEIDxHFoLeORoOcuE8r8yhb1gkXfbXx4Q9KEM8z1LG', NULL, '2026-07-25 19:33:00', '2026-07-25 19:33:00'),
(9, 'rehman123', 'rehman7576@gmail.com', NULL, '$2y$12$X.xRPr05MhOPdLQ4jOUF5OrY9GCqKy/r41HBSjuhNGcIwzPj1oeIK', NULL, '2026-07-26 01:35:52', '2026-07-26 01:35:52'),
(10, 'Rehman', 'rehman757677@gmail.com', NULL, '$2y$12$wj4xdQ2nPJIqwdCjCelpQuv0ovDB48wmpK/S6wZFkf1H2wtmPvGP.', NULL, '2026-07-27 12:40:32', '2026-07-27 12:40:32'),
(11, 'Rehman5', 'rehman75@gmail.com', NULL, '$2y$12$7lkDGhE4sV35tsTzLSADi.eKhQcr9r7wBxodXYfImB58c7gndHzsC', NULL, '2026-07-27 13:47:49', '2026-07-27 13:47:49'),
(12, 'Ahmad', 'ahmad@gmail.com', NULL, '$2y$12$vswqGA.EI6dcynm3sF5VL.8.m4/pTNspNaFnkyNWHGrx50WQSb/X.', NULL, '2026-07-29 16:34:15', '2026-07-29 16:34:15'),
(13, 'Ahmad', 'ahmad1@gmail.com', NULL, '$2y$12$TgP7mA9O7O5HBxHIERDUquUKKAGmwznP1WNHDVQAc8ygeKmBsfqgi', 'H6Nih8NCT1mjp7H0DFr8LVULL9rSyIHlfNxAQKJMfE6BVrKr2d7YlW3Nt6vl', '2026-07-29 18:39:50', '2026-08-07 12:40:17'),
(14, 'mrehman', 'rehman75767778@gmail.com', NULL, '$2y$12$zcGBGKMjp55zt2ZagEzxWeO33wUTNxLvh/bgdRCGlaHimn6eHusJ.', NULL, '2026-08-03 16:02:15', '2026-08-03 16:02:15'),
(15, 'rehman', 'rehman@gmail.com', NULL, '$2y$12$YVDmf1UQRs/6oAoHc86dx.nQ01WaG1R.bamYwPi4oP/1nikXT4oQK', NULL, '2026-08-03 16:32:58', '2026-08-03 16:32:58'),
(16, 'ali', 'ali@gmail.com', NULL, '$2y$12$wuJddw107ZYm/oQz2oI1outkwVz7ex2M2DN6mW79c/9vJx/anGMMq', NULL, '2026-08-05 20:55:26', '2026-08-05 20:55:26'),
(17, 'muhammad rehman', 'aliahmad@gmail.com', NULL, '$2y$12$uAMriuaqWdO/ODsH34Z4aOeKejBiaQlJuYLRYPVpVz8YRtFIR1R4K', NULL, '2026-08-10 13:44:53', '2026-08-10 13:44:53'),
(18, 'abc2', 'abc2@gmail.com', NULL, '$2y$12$RtyFCxN01y4yp6d1ZdJwNuKKxI.HB1p0q8pEluGXtvp5Izm8iHjCu', NULL, '2026-08-10 18:07:07', '2026-08-10 18:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(3, 13, 19, '2026-08-08 17:33:46', '2026-08-08 17:33:46'),
(4, 13, 20, '2026-08-08 18:42:22', '2026-08-08 18:42:22'),
(6, 13, 21, '2026-08-08 18:56:13', '2026-08-08 18:56:13'),
(7, 17, 21, '2026-08-10 13:47:20', '2026-08-10 13:47:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_posts_slug_unique` (`slug`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `customer_payment_methods`
--
ALTER TABLE `customer_payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_payment_methods_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `flash_sales`
--
ALTER TABLE `flash_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_columns`
--
ALTER TABLE `footer_columns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_links`
--
ALTER TABLE `footer_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `footer_links_footer_column_id_foreign` (`footer_column_id`);

--
-- Indexes for table `footer_settings`
--
ALTER TABLE `footer_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_sliders`
--
ALTER TABLE `home_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_history_user_id_foreign` (`user_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_location_unique` (`location`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`),
  ADD KEY `menu_items_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_status_index` (`status`),
  ADD KEY `orders_order_number_index` (`order_number`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_statuses_order_id_foreign` (`order_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_gateways_slug_unique` (`slug`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_methods_code_unique` (`code`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_slug_index` (`slug`),
  ADD KEY `products_sku_index` (`sku`),
  ADD KEY `products_status_index` (`status`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_colors_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_sizes_product_id_foreign` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_order_id_foreign` (`order_id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seo_settings_page_unique` (`page`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_methods_shipping_zone_id_foreign` (`shipping_zone_id`);

--
-- Indexes for table `shipping_zones`
--
ALTER TABLE `shipping_zones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_transaction_id_unique` (`transaction_id`),
  ADD KEY `transactions_order_id_foreign` (`order_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `customer_payment_methods`
--
ALTER TABLE `customer_payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flash_sales`
--
ALTER TABLE `flash_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `footer_columns`
--
ALTER TABLE `footer_columns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `footer_links`
--
ALTER TABLE `footer_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `footer_settings`
--
ALTER TABLE `footer_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_sliders`
--
ALTER TABLE `home_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping_zones`
--
ALTER TABLE `shipping_zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_payment_methods`
--
ALTER TABLE `customer_payment_methods`
  ADD CONSTRAINT `customer_payment_methods_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `footer_links`
--
ALTER TABLE `footer_links`
  ADD CONSTRAINT `footer_links_footer_column_id_foreign` FOREIGN KEY (`footer_column_id`) REFERENCES `footer_columns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `login_history`
--
ALTER TABLE `login_history`
  ADD CONSTRAINT `login_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD CONSTRAINT `order_statuses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD CONSTRAINT `product_colors_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD CONSTRAINT `shipping_methods_shipping_zone_id_foreign` FOREIGN KEY (`shipping_zone_id`) REFERENCES `shipping_zones` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
