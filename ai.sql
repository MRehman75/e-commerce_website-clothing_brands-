-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2026 at 10:56 AM
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
-- Database: `ai`
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
(10, 'default', 'User updated', 'App\\Models\\User', 'updated', 2, NULL, NULL, '{\"attributes\":[],\"old\":[]}', NULL, '2026-07-01 00:10:56', '2026-07-01 00:10:56');

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
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `logo`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Redmi', 'redmi', 'brands/0dHcHtTSht9uMguTXyajtVkqOlFQSLorh6STh5KJ.jpg', '<p><span style=\"font-size:26px\">Redmi - Best budget smartphones by Xiaomi</span></p>\n', 'active', '2026-06-16 04:26:28', '2026-06-16 04:26:28'),
(2, 'hp', 'hp', 'brands/2qoVmPcD8KJT8MeaDCKp9zNzPSGvNZA2XWtAdl4b.jpg', '<p><span style=\"font-size:36px\">hp grate best Laptops .</span></p>\n', 'active', '2026-06-16 07:02:47', '2026-06-16 07:02:47'),
(3, 'Hamdrad', 'hamdrad', 'brands/eS3ConNqunnqI434tlqfBO38dXS9wY24ArxpYXG0.jpg', '', 'active', '2026-06-17 02:13:29', '2026-06-17 02:13:29'),
(4, 'Service', 'service', 'brands/albyyzZD7qdXnwrwLQysDO8LrFbXBRHmuvjTSMnm.jpg', '', 'active', '2026-06-17 02:45:56', '2026-06-17 02:45:56');

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
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

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `parent_id`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mobail', 'mobail', '<p><span style=\"font-size:24px\">Best mobile phones and tablets at best prices.</span></p>\n', 'categories/BGfwSbj6dFvUTL4su72McQDe3iDjYaMHPvvzM1tO.jpg', NULL, 1, 'active', '2026-06-16 04:02:57', '2026-06-16 04:21:13'),
(2, 'Laptop', 'laptop', '<p><span style=\"font-size:48px\">Laptops best website use.</span></p>\n', 'categories/12R6I7h8v6lFtb5DrqFacpdcGOA5XH1YEacmcGwb.jpg', NULL, 5, 'active', '2026-06-16 07:00:44', '2026-06-16 07:00:44'),
(3, 'Books', 'books', '', 'categories/mUvCPQEZjxs4mTPatpa4hbS9BrlCowPZ0jG6kWT5.jpg', NULL, 20, 'active', '2026-06-17 02:11:48', '2026-06-17 02:11:48'),
(4, 'Shoes', 'shoes', '', 'categories/XHJm3EMRz69IVbKV97eVgEzzMEdow0WfhwV9TQZj.jpg', NULL, 50, 'active', '2026-06-17 02:45:04', '2026-06-17 03:04:23');

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
  `email` varchar(255) NOT NULL,
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

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `city`, `address`, `status`, `total_spent`, `total_orders`, `last_order_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Saleem Webster', 'fogys@mailinator.com', '+923248573797', 'Lahore', '5#No Stop Khana nau Lahore', 'active', 0.00, 0, NULL, '2026-06-18 06:34:17', '2026-06-18 06:34:17', NULL),
(2, 'Abuhaira', 'Abuhaira@gmail.com', '03006278955', '', '5#No Stop Khana nau Lahore', 'active', 0.00, 0, NULL, '2026-06-18 06:38:05', '2026-06-18 06:38:05', NULL),
(3, 'Ameerullah', 'ameerullahmayo@gmail.com', '03248573797', '', '5#No Stop Khana nau Lahore', 'active', 0.00, 0, NULL, '2026-06-18 06:42:58', '2026-06-18 06:42:58', NULL),
(4, 'Huzifa', 'huzifa@gmail.com', '0300-4815397', 'Lahore', '5#No Stop Khana nau Lahore', 'active', 0.00, 0, NULL, '2026-06-18 07:13:59', '2026-06-18 07:16:53', '2026-06-18 07:16:53'),
(5, 'Anas Tariq', 'anastariq@gmail.com', '03454815398', 'Lahore', '5#No Stop Khana nau Lahore', 'active', 0.00, 0, NULL, '2026-06-18 07:19:15', '2026-06-18 07:19:15', NULL),
(6, 'Test User', 'test123@gmail.com', NULL, NULL, NULL, 'active', 0.00, 0, NULL, '2026-06-18 07:21:54', '2026-06-18 07:21:54', NULL),
(7, 'ansir', 'ansir@gmail.com', '03096060838', NULL, '5#No Stop Khana nau Lahore', 'active', 650.00, 1, '2026-06-18 07:26:53', '2026-06-18 07:26:53', '2026-06-18 07:26:53', NULL),
(8, 'ahmed', 'ahmed@gmail.com', '+923001234567', 'Lahore', '5#No Stop Khana nau Lahore', 'active', 0.00, 0, NULL, '2026-06-23 02:29:38', '2026-06-23 02:29:38', NULL),
(9, 'Ab officia ducimus ', 'qugenav@mailinator.com', '+12214288478', 'Sed quod dolore ad e', 'Sit alias anim offi', 'active', 0.00, 0, NULL, '2026-06-23 02:59:18', '2026-06-23 03:00:00', NULL),
(10, 'Esse magnam omnis ex', 'qogaqa@mailinator.com', '+9216724539854', 'Dolore ut sit ut lib', 'Deleniti quia anim n', 'active', 0.00, 0, NULL, '2026-06-23 03:05:34', '2026-06-23 03:05:34', NULL),
(11, 'Voluptate voluptatem', 'bijin@mailinator.com', '+9216724539854', 'Dolore ut sit ut lib', 'Deleniti quia anim n', 'active', 0.00, 0, NULL, '2026-06-23 03:12:07', '2026-06-23 03:12:07', NULL),
(12, 'Possimus dolorum si', 'xihege@mailinator.com', '+17296216345', 'Totam enim veniam q', 'Est est nulla minim ', 'active', 0.00, 0, NULL, '2026-06-23 04:15:52', '2026-06-23 04:15:52', NULL),
(13, 'Ameer Hussain', 'ameerullahmayo1866@gmail.com', '+923248573797', 'Lahore', '5#No Stop Khana nau Lahore', 'active', 900.00, 1, '2026-06-30 00:04:06', '2026-06-29 23:46:05', '2026-06-30 00:04:06', NULL),
(14, 'Anas Tariq', 'anastariq030@gmail.com', '03454815398', NULL, '5#No Stop Khana nau Lahore', 'active', 650.00, 1, '2026-06-29 23:51:17', '2026-06-29 23:51:17', '2026-06-29 23:51:17', NULL);

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
(1, 'Summer Sale 2025', 'Up to 50% off on all items', 'Shop Now', '/products', 'sliders/dHkRdxFDyuUftwNUjymWad33Y90YvBpAtFU9gBPc.jpg', 'primary', 1, 1, '2026-06-24 00:31:21', '2026-06-24 00:31:21'),
(2, 'Books Sales', '50% off', 'Shop Now', 'https://google.com', 'sliders/Wvuk0OJ3v1CKr03dLSSVEeKl8YoEaDgDtkufJnJK.jpg', 'primary', 1, 1, '2026-06-24 01:05:11', '2026-06-24 01:05:11');

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
(36, '2026_06_17_121121_add_batch_uuid_column_to_activity_log_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
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
(7, 'ORD-32JB8MNY', 2, 'Ameer Hussain', 'ameerullahmayo1866@gmail.com', '03248573797', '5#No Stop Khana nau Lahore', '5#No Stop Khana nau Lahore', 1000.00, 0.00, 150.00, 250.00, 900.00, 'cod', 'paid', 'delivered', 0.00, '', '2026-06-30 00:04:06', '2026-06-30 00:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
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

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `product_sku`, `quantity`, `price`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Redmi Note 13', 'RED-NOT-13-1DB3', 1, 45000.00, 45000.00, '2026-06-16 04:35:56', '2026-06-16 04:35:56'),
(2, 2, 1, 'Redmi Note 13', 'RED-NOT-13-1DB3', 1, 45000.00, 45000.00, '2026-06-16 05:17:12', '2026-06-16 05:17:12'),
(3, 3, 1, 'Redmi Note 13', 'RED-NOT-13-1DB3', 1, 45000.00, 45000.00, '2026-06-16 06:09:50', '2026-06-16 06:09:50'),
(4, 4, 3, 'Books', 'BO-EC55', 1, 50.00, 50.00, '2026-06-17 02:52:05', '2026-06-17 02:52:05'),
(5, 4, 4, 'Shoes', 'SH-D95A', 1, 500.00, 500.00, '2026-06-17 02:52:05', '2026-06-17 02:52:05'),
(6, 5, 4, 'Shoes', 'SH-D95A', 1, 500.00, 500.00, '2026-06-18 07:26:53', '2026-06-18 07:26:53'),
(7, 6, 4, 'Shoes', 'SH-D95A', 1, 500.00, 500.00, '2026-06-29 23:51:17', '2026-06-29 23:51:17'),
(8, 7, 4, 'Shoes', 'SH-D95A', 2, 500.00, 1000.00, '2026-06-30 00:04:06', '2026-06-30 00:04:06');

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
(1, 'About Us', 'about-us', '<p>Welcome to MyShop! We are a leading e-commerce store providing quality products at affordable prices. Our mission is to deliver the best shopping experience to our customers.</p>\n', 'About Us - MyShop', 'Learn more about MyShop, your trusted online shopping destination in Pakistan.', 0, 1, '2026-06-24 01:11:17', '2026-06-24 01:11:17', NULL);

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
(1, 'Redmi Note 13', 'redmi-note-13', 'RED-NOT-13-1DB3', '', 45000.00, 52000.00, 50, 'products/kAZCWdjOogNYinhYQ3BsRA5K9bkhQRcsxDSViEtq.jpg', '[\"products\\/gallery\\/TXMKe0p1cGIJ53HlXW1522EK29Iw0TJYZKH5MOnd.jpg\"]', 1, 1, 'active', 1, NULL, 'Redmi Note 13 - Best Budget Phone', 'Buy Redmi Note 13 at best price in Pakistan', '2026-06-16 04:32:42', '2026-06-16 04:32:42'),
(2, 'hp', 'laptop', 'LAP-85E1', '', 35000.00, 48000.00, 12, 'products/gH0BDAfoQujNHLyEEmCIHcsCYcfxfYTvYvpfBYxj.jpg', '[\"products\\/gallery\\/PLnqDaes0T1zf3LIHVLqqwTUHgfRBBnN6Qzt4ylW.jpg\"]', 2, 2, 'active', 1, NULL, 'hp 1.7cor - Best Price in Pakistan | Omni Tech', 'hp buy online at best price in Pakistan. \n6GB RAM, 128GB Storage. Free delivery in Lahore. \nCash on Delivery available.', '2026-06-16 07:09:10', '2026-06-17 03:05:18'),
(3, 'Books', 'books', 'BO-EC55', '<p><span style=\"font-size:18px\">Best choice Books.</span></p>\n', 50.00, 74.99, 14, 'products/Z2mcI1SD4dvQU47bT7E9lbUzZVGfpnpgz39TI8hY.jpg', '[\"products\\/gallery\\/UjEbEapmHyPFE1yeKQzFqOMXYQ8o31yAmjIJTJBv.jpg\"]', 3, 3, 'active', 0, NULL, 'Books Hamdrad', 'Books Hamdrad ', '2026-06-17 02:17:03', '2026-06-17 02:22:04'),
(4, 'Shoes', 'shoes', 'SH-D95A', '', 500.00, 650.00, 50, 'products/jLsVtMwbQJO1NEhhGDrgWNxBZYof4HQ25q9L9Bwy.jpg', '[]', 4, 4, 'active', 1, NULL, 'shoes', 'shoes service', '2026-06-17 02:47:55', '2026-06-17 02:48:14');

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
(1, 'home', 'Online Shopping in Pakistan - Best Deals | YourStore', 'Shop the latest products online in Pakistan with fast delivery, secure payment, and amazing discounts. Cash on delivery available across Punjab.', 'online shopping pakistan, ecommerce lahore, buy online pakistan, cash on delivery', 'YourStore - Shop Online in Pakistan', 'Discover amazing deals on electronics, fashion, and more. Fast delivery across Pakistan with Cash on Delivery option.', 'seo/frz2zB0Oz8lHGBv3hF8talaYQM8eSGjM95zP77Cl.jpg', 'https://chatgpt.com/', 0, 0, '<head>\n    <title>{{ $seo->meta_title ?? \'Default Title\' }}</title>\n    <meta name=\"description\" content=\"{{ $seo->meta_description ?? \'\' }}\">\n    <meta name=\"keywords\" content=\"{{ $seo->meta_keywords ?? \'\' }}\">\n    <meta property=\"og:title\" content=\"{{ $seo->og_title ?? \'\' }}\">\n    <meta property=\"og:description\" content=\"{{ $seo->og_description ?? \'\' }}\">\n    <meta property=\"og:image\" content=\"{{ $seo->og_image ? asset(\'storage/\'.$seo->og_image) : \'\' }}\">\n    <link rel=\"canonical\" href=\"{{ $seo->canonical_url ?? url()->current() }}\">\n</head>', '2026-06-28 23:46:09', '2026-06-29 00:40:40'),
(2, 'about', '', '', '', '', '', NULL, '', 0, 0, '', '2026-06-28 23:46:33', '2026-06-28 23:46:33'),
(3, 'contact', '', '', '', '', '', NULL, '', 0, 0, '', '2026-06-28 23:46:34', '2026-06-28 23:46:34'),
(4, 'blog', '', '', '', '', '', NULL, '', 0, 0, '', '2026-06-28 23:46:39', '2026-06-28 23:46:39');

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
(5, 'Anas Tariq', 'anastariq030@gmail.com', NULL, '$2y$12$oShOvAD52aVLAJop7JIWdewdJT1qIczhL8Gtq85vG0yMXjzMmT.sO', NULL, '2026-06-30 00:13:06', '2026-06-30 00:13:06');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `footer_links`
--
ALTER TABLE `footer_links`
  ADD CONSTRAINT `footer_links_footer_column_id_foreign` FOREIGN KEY (`footer_column_id`) REFERENCES `footer_columns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
