-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2022 at 08:47 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_pioneer_analysis_software`
--

-- --------------------------------------------------------

--
-- Table structure for table `up_area_analyses`
--

CREATE TABLE `up_area_analyses` (
  `id` int(10) UNSIGNED NOT NULL,
  `season_id` int(11) DEFAULT NULL COMMENT 'Id from seasons table',
  `year` int(11) DEFAULT NULL,
  `analysis_date` timestamp NULL DEFAULT NULL,
  `distribution_area_id` int(11) DEFAULT NULL COMMENT 'Id from distribution_areas table',
  `distributor_id` int(11) DEFAULT NULL COMMENT 'Id from distributors table',
  `store_id` int(11) DEFAULT NULL COMMENT 'Id from stores table',
  `category_id` int(11) DEFAULT NULL COMMENT 'Id from categories table',
  `product_id` int(11) DEFAULT NULL COMMENT 'Id from products table',
  `target_monthly_sales` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_analysis` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_area_analyses`
--

INSERT INTO `up_area_analyses` (`id`, `season_id`, `year`, `analysis_date`, `distribution_area_id`, `distributor_id`, `store_id`, `category_id`, `product_id`, `target_monthly_sales`, `type_of_analysis`, `action`, `result`, `why`, `comment`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 3, 2022, '2022-05-24 18:30:00', 1, 3, 1, 5, 21, '1200', 'T', 'A', 'R', 'W', 'C', '1', '2022-05-25 07:09:15', '2022-05-25 07:09:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_area_analysis_details`
--

CREATE TABLE `up_area_analysis_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `area_analysis_id` int(11) DEFAULT NULL COMMENT 'Id from area_analyses table',
  `distributor_id` int(11) DEFAULT NULL COMMENT 'Id from distributors table',
  `result` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commented_by` enum('D','SA','A','S') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'D' COMMENT 'D=>Distributor, SA=>Super Admin, A=>Admin, S=>Store Manager',
  `is_viewed` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'N=>No, Y=>Yes',
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active, 2=>Blocked',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_area_analysis_details`
--

INSERT INTO `up_area_analysis_details` (`id`, `area_analysis_id`, `distributor_id`, `result`, `why`, `commented_by`, `is_viewed`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 3, 'Test result', 'Test Why', 'D', 'N', '1', '2022-05-27 06:46:10', '2022-05-27 06:46:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_categories`
--

CREATE TABLE `up_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_categories`
--

INSERT INTO `up_categories` (`id`, `title`, `slug`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'A4 Size Note Book', 'a4-size-note-book', 0, '1', '2022-05-16 07:32:40', '2022-05-16 07:34:37', NULL),
(2, 'Drawing Book', 'drawing-book', 1, '1', '2022-05-16 07:35:35', '2022-05-16 07:35:35', NULL),
(3, 'Drwaing & Sketch Book', 'drwaing-sketch-book', 2, '1', '2022-05-16 07:35:43', '2022-05-16 07:35:43', NULL),
(4, 'Lab Note Book  & Loose Sheet', 'lab-note-book-loose-sheet', 3, '1', '2022-05-16 07:35:52', '2022-05-16 07:35:52', NULL),
(5, 'Long Bound Exercise Book', 'long-bound-exercise-book', 4, '1', '2022-05-16 07:35:59', '2022-05-16 07:35:59', NULL),
(6, 'Long Perfect Bound', 'long-perfect-bound', 5, '1', '2022-05-16 07:36:07', '2022-05-16 07:36:07', NULL),
(7, 'Long Stitch Exercise Books', 'long-stitch-exercise-books', 6, '1', '2022-05-16 07:36:13', '2022-05-16 07:36:13', NULL),
(8, 'Pocket Note Book', 'pocket-note-book', 7, '1', '2022-05-16 07:36:22', '2022-05-16 07:49:36', NULL),
(9, 'Practical Note Book', 'practical-note-book', 8, '1', '2022-05-16 07:36:30', '2022-05-16 07:49:36', NULL),
(10, 'Ream Paper ( 20 Quires)', 'ream-paper-20-quires', 9, '1', '2022-05-16 07:36:39', '2022-05-16 07:49:36', NULL),
(11, 'Small Bound', 'small-bound', 10, '1', '2022-05-16 07:36:46', '2022-05-16 07:49:36', NULL),
(12, 'Small Stitch', 'small-stitch', 11, '1', '2022-05-16 07:36:53', '2022-05-16 07:49:36', NULL),
(13, 'Spiral Note Book & Craft Paper', 'spiral-note-book-craft-paper', 12, '1', '2022-05-16 07:37:01', '2022-05-16 07:49:36', NULL),
(14, 'Spl Note Book & Loose Sheet', 'spl-note-book-loose-sheet', 13, '1', '2022-05-16 07:37:09', '2022-05-16 07:49:36', NULL),
(15, 'Stitch D.C. Exercise Book', 'stitch-dc-exercise-book', 14, '1', '2022-05-16 07:37:17', '2022-05-16 07:49:36', NULL),
(16, 'Stitch D.C. Exercise Book & Scrap Book', 'stitch-dc-exercise-book-scrap-book', 15, '1', '2022-05-16 07:37:23', '2022-05-16 07:49:36', NULL),
(17, 'Stitch Graph', 'stitch-graph', 16, '1', '2022-05-16 07:37:32', '2022-05-17 07:04:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_distribution_areas`
--

CREATE TABLE `up_distribution_areas` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `definition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_distribution_areas`
--

INSERT INTO `up_distribution_areas` (`id`, `title`, `definition`, `slug`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bagnan', NULL, 'bagnan', 0, '1', '2022-05-09 04:14:38', '2022-05-17 06:39:08', NULL),
(3, 'Barasat', NULL, 'barasat', 1, '1', '2022-05-09 06:33:21', '2022-05-17 12:08:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_migrations`
--

CREATE TABLE `up_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_migrations`
--

INSERT INTO `up_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_12_27_000000_create_users_table', 1),
(2, '2021_12_27_064801_create_roles_table', 1),
(3, '2021_12_27_064917_create_role_permissions_table', 1),
(4, '2021_12_27_065108_create_user_roles_table', 1),
(5, '2021_12_27_065206_create_role_pages_table', 1),
(6, '2021_12_27_071814_create_website_settings_table', 1),
(7, '2022_01_03_081035_craete_distribution_areas_table', 1),
(8, '2022_05_09_111152_create_user_details_table', 2),
(9, '2022_05_13_065830_create_stores_table', 3),
(10, '2022_05_16_125023_create_categories_table', 4),
(11, '2022_05_16_131654_create_products_table', 5),
(12, '2022_05_20_092726_create_area_analyses_table', 6),
(13, '2022_05_20_095527_create_area_analysis_details_table', 7),
(14, '2022_05_20_103233_create_seasons_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `up_products`
--

CREATE TABLE `up_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL COMMENT 'Id from categories table',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate_per_pcs` double(10,2) NOT NULL DEFAULT 0.00,
  `mrp` double(10,2) DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_products`
--

INSERT INTO `up_products` (`id`, `category_id`, `title`, `slug`, `rate_per_pcs`, `mrp`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Pioneer 100 Page A4', 'pioneer-100-page-a4', 27.00, 40.00, 0, '1', '2022-05-17 04:24:55', '2022-05-17 05:00:24', NULL),
(2, 1, 'Pioneer 144 Page A4', '', 36.00, 58.00, 1, '1', '2022-05-17 05:01:00', '2022-05-17 05:01:00', NULL),
(3, 1, 'Pioneer 200 Page A4', '-1', 45.00, 75.00, 2, '1', '2022-05-17 05:01:13', '2022-05-17 05:01:13', NULL),
(4, 2, 'G.B. 28 Page Drawing', '-2', 8.00, NULL, 3, '1', '2022-05-17 05:02:06', '2022-05-17 05:02:06', NULL),
(5, 2, 'G.B. 4 No Drawing', '-3', 17.00, 34.00, 4, '1', '2022-05-17 05:02:21', '2022-05-17 05:02:21', NULL),
(6, 3, 'Pioneer 4 No Drawing', '-4', 24.83, 43.00, 5, '1', '2022-05-17 05:02:41', '2022-05-17 05:02:41', NULL),
(7, 3, 'Pioneer 40 Page 11x15 Drawing', '-5', 36.00, 60.00, 6, '1', '2022-05-17 05:02:55', '2022-05-17 05:02:55', NULL),
(8, 3, 'Pioneer 40 Page Spiral Drawing 120 GSM', '-6', 43.08, NULL, 7, '1', '2022-05-17 05:03:09', '2022-05-17 05:03:09', NULL),
(9, 3, 'Pioneer 40 Page Spiral Drawing 140 GSM', '-7', 55.00, NULL, 8, '1', '2022-05-17 05:03:21', '2022-05-17 05:03:21', NULL),
(10, 3, 'Pioneer 48 Page Drawing', '-8', 17.50, 29.00, 9, '1', '2022-05-17 05:03:35', '2022-05-17 05:03:35', NULL),
(11, 3, 'Pioneer 4no 11x15 Drawing', '-9', 57.75, 90.00, 10, '1', '2022-05-17 05:04:00', '2022-05-17 05:04:00', NULL),
(12, 3, 'Pioneer 6 No Drawing', '-10', 38.08, 55.00, 11, '1', '2022-05-17 05:04:17', '2022-05-17 05:04:17', NULL),
(13, 3, 'Pioneer 6no 11x15 Drawing', '-11', 87.75, 135.00, 12, '1', '2022-05-17 05:04:35', '2022-05-17 05:04:35', NULL),
(14, 3, 'Pioneer 8 No Drawing', '-12', 49.67, 71.00, 13, '1', '2022-05-17 05:04:53', '2022-05-17 05:04:53', NULL),
(15, 4, 'G.B. Lab Board', '-13', 14.58, 25.00, 14, '1', '2022-05-17 05:05:17', '2022-05-17 05:05:17', NULL),
(16, 4, 'G.B. Loose Sheet', '-14', 12.08, NULL, 15, '1', '2022-05-17 05:05:30', '2022-05-17 05:05:30', NULL),
(17, 5, 'Pioneer 10 No long Bound', '-15', 113.00, 160.00, 16, '1', '2022-05-17 05:05:50', '2022-05-17 05:05:50', NULL),
(18, 5, 'Pioneer 10 no SPL Long Bound (Case Binding)', '-16', 121.75, 208.00, 17, '1', '2022-05-17 05:06:10', '2022-05-17 05:06:10', NULL),
(19, 5, 'Pioneer 12 No Long Bound', '-17', 133.50, 200.00, 18, '1', '2022-05-17 05:06:27', '2022-05-17 05:06:27', NULL),
(20, 5, 'Pioneer 12 No SPL Long Bound (Case Binding)', '-18', 141.25, NULL, 19, '1', '2022-05-17 05:06:45', '2022-05-17 05:06:45', NULL),
(21, 5, 'Pioneer 4 No Long Bound', '-19', 51.33, 80.00, 20, '1', '2022-05-17 05:07:05', '2022-05-17 05:07:05', NULL),
(22, 5, 'Pioneer 6 No Long Bound', '-20', 71.92, 112.00, 21, '1', '2022-05-17 05:07:26', '2022-05-17 05:07:26', NULL),
(23, 5, 'Pioneer 8 No Long Bound', '-21', 92.42, 124.00, 22, '1', '2022-05-17 05:07:48', '2022-05-17 05:07:48', NULL),
(24, 6, 'Pioneer 240 Page 17x27', '-22', 65.50, 105.00, 23, '1', '2022-05-17 05:08:05', '2022-05-17 05:08:05', NULL),
(25, 6, 'Pioneer 320 Page 17x27', '-23', 90.17, 140.00, 24, '1', '2022-05-17 05:08:24', '2022-05-17 05:08:24', NULL),
(26, 7, 'G.B. 120 Page (15x25)', 'gb-120-page-15x25', 18.00, 35.00, 25, '1', '2022-05-17 05:08:39', '2022-05-17 05:08:46', NULL),
(27, 7, 'G.B. 120 Page (17x27)', '-24', 26.00, 37.00, 26, '1', '2022-05-17 05:09:05', '2022-05-17 05:09:05', NULL),
(28, 7, 'G.B. 152 Page ( 15x25)', '-25', 20.00, 45.00, 27, '1', '2022-05-17 05:09:18', '2022-05-17 05:09:18', NULL),
(29, 7, 'G.B. 160 Page (17x27)', '-26', 30.00, 53.00, 28, '1', '2022-05-17 05:09:31', '2022-05-17 05:09:31', NULL),
(30, 7, 'G.B. 240 Page (17x27)', '-27', 55.00, 80.00, 29, '1', '2022-05-17 05:09:45', '2022-05-17 05:09:45', NULL),
(31, 7, 'G.B. 60 Page Long ( 15x25)', '-28', 8.33, NULL, 30, '1', '2022-05-17 05:09:59', '2022-05-17 05:09:59', NULL),
(32, 7, 'G.B. 80 Page (17x27)', '-29', 17.58, 30.00, 31, '1', '2022-05-17 05:10:12', '2022-05-17 05:10:12', NULL),
(33, 7, 'Pioneer 100 Page Long Book(17x27)', '-30', 27.00, 45.00, 32, '1', '2022-05-17 05:10:26', '2022-05-17 05:10:26', NULL),
(34, 7, 'Pioneer 132 Page Long Book (15x25)', '-31', 27.00, 42.00, 33, '1', '2022-05-17 05:10:44', '2022-05-17 05:10:44', NULL),
(35, 7, 'Pioneer 132 Page Long Book(17x27)', '-32', 36.50, 57.00, 34, '1', '2022-05-17 05:11:04', '2022-05-17 05:11:04', NULL),
(36, 7, 'Pioneer 160 Page Long Book (17x27)', '-33', 43.75, 70.00, 35, '1', '2022-05-17 05:11:23', '2022-05-17 05:11:23', NULL),
(37, 7, 'Pioneer 80 Page Long Book (17x27)', '-34', 26.00, 40.00, 36, '1', '2022-05-17 05:11:49', '2022-05-17 05:11:49', NULL),
(38, 8, 'Pioneer 10 No Note Book', '-35', 26.08, 43.00, 37, '1', '2022-05-17 05:12:05', '2022-05-17 05:12:05', NULL),
(39, 8, 'Pioneer 12 No Note Book', '-36', 30.58, 52.00, 38, '1', '2022-05-17 05:12:23', '2022-05-17 05:12:23', NULL),
(40, 8, 'Pioneer 4 No Note Book', '-37', 10.83, 20.00, 39, '1', '2022-05-17 05:12:39', '2022-05-17 05:12:39', NULL),
(41, 8, 'Pioneer 6 No Note Book', '-38', 15.67, 27.00, 40, '1', '2022-05-17 05:12:55', '2022-05-17 05:12:55', NULL),
(42, 8, 'Pioneer 8 No Note Book', '-39', 21.08, 35.00, 41, '1', '2022-05-17 05:13:12', '2022-05-17 05:13:12', NULL),
(43, 9, 'Pioneer 112 Page Practical', '-40', 47.83, 80.00, 42, '1', '2022-05-17 05:13:40', '2022-05-17 05:13:40', NULL),
(44, 9, 'Pioneer 160 Page Practical', '-41', 64.83, 110.00, 43, '1', '2022-05-17 05:13:58', '2022-05-17 05:13:58', NULL),
(45, 9, 'Pioneer 192 Page Practical', '-42', 70.58, NULL, 44, '1', '2022-05-17 05:14:12', '2022-05-17 05:14:12', NULL),
(46, 9, 'Pioneer 256 Page Practical', '-43', 93.75, NULL, 45, '1', '2022-05-17 05:14:31', '2022-05-17 05:14:31', NULL),
(47, 9, 'Pioneer 80 Page Practical', '-44', 37.83, 63.00, 46, '1', '2022-05-17 05:14:51', '2022-05-17 05:14:51', NULL),
(48, 10, 'Dista 16x26', '-45', 13.50, NULL, 47, '1', '2022-05-17 05:16:33', '2022-05-17 05:16:33', NULL),
(49, 10, 'Pioneer Dista Ream (17x27)', '-46', 24.60, NULL, 48, '1', '2022-05-17 05:16:47', '2022-05-17 05:16:47', NULL),
(50, 11, 'Pioneer 10 No Small Bound', 'pioneer-10-no-small-bound', 59.00, 105.00, 49, '1', '2022-05-17 05:17:19', '2022-05-17 05:17:36', NULL),
(51, 11, 'Pioneer 12 No Small Bound', '-47', 69.67, 125.00, 50, '1', '2022-05-17 05:17:55', '2022-05-17 05:17:55', NULL),
(52, 11, 'Pioneer 4 No Small Bound', '-48', 27.08, 47.00, 51, '1', '2022-05-17 05:18:18', '2022-05-17 05:18:18', NULL),
(53, 11, 'Pioneer 4 No Small Bound Prac', '-49', 29.92, NULL, 52, '1', '2022-05-17 05:18:34', '2022-05-17 05:18:34', NULL),
(54, 11, 'Pioneer 6 No Small Bound', '-50', 37.75, 63.00, 53, '1', '2022-05-17 05:18:51', '2022-05-17 05:18:51', NULL),
(55, 11, 'Pioneer 8 No Small Bound', '-51', 48.42, 90.00, 54, '1', '2022-05-17 05:19:07', '2022-05-17 05:19:07', NULL),
(56, 12, 'G.B. 100 Page Stitch', 'gb-100-page-stitch', 11.33, 21.00, 55, '1', '2022-05-17 05:19:23', '2022-05-17 05:19:50', NULL),
(57, 12, 'G.B. 128 Page Stitch', '-53', 15.50, 28.00, 56, '1', '2022-05-17 05:19:41', '2022-05-17 05:19:41', NULL),
(58, 12, 'G.B. 60 Page stitch', '-52', 6.50, 10.00, 57, '1', '2022-05-17 05:20:03', '2022-05-17 05:20:03', NULL),
(59, 12, 'Pioneer 100 Page Stitch', '-54', 15.92, 29.00, 58, '1', '2022-05-17 05:20:17', '2022-05-17 05:20:17', NULL),
(60, 12, 'Pioneer 132 Page Stitch', '-55', 20.75, 37.00, 59, '1', '2022-05-17 05:20:39', '2022-05-17 05:20:39', NULL),
(61, 12, 'Pioneer 68 Page Stitch', '-56', 10.00, 19.00, 60, '1', '2022-05-17 05:20:51', '2022-05-17 05:20:51', NULL),
(62, 13, 'A4-Bright Craft Paper', '-57', 87.00, NULL, 61, '1', '2022-05-17 05:21:12', '2022-05-17 05:21:12', NULL),
(63, 13, 'A5 Five Subject Note Book', '-58', 100.00, NULL, 62, '1', '2022-05-17 05:21:25', '2022-05-17 05:21:25', NULL),
(64, 13, 'A5 One Subject Note Book', '-59', 61.00, NULL, 63, '1', '2022-05-17 05:21:35', '2022-05-17 05:21:35', NULL),
(65, 13, 'B5 One Subject NoteBook', '-60', 78.00, NULL, 64, '1', '2022-05-17 05:21:46', '2022-05-17 05:21:46', NULL),
(66, 13, 'Colour Paper ( 22 x 30)', '-61', 776.00, NULL, 65, '1', '2022-05-17 05:21:59', '2022-05-17 05:21:59', NULL),
(67, 14, 'Pioneer Lab Note Book SPL', '-62', 19.83, 32.00, 66, '1', '2022-05-17 05:22:15', '2022-05-17 05:22:15', NULL),
(68, 14, 'Pioneer Lab Note Book T.P.', '-63', 34.58, 53.00, 67, '1', '2022-05-17 05:22:35', '2022-05-17 05:22:35', NULL),
(69, 14, 'Pioneer Loose Sheet', '-64', 16.67, NULL, 68, '1', '2022-05-17 05:22:48', '2022-05-17 05:22:48', NULL),
(70, 14, 'Pioneer Loose Sheet T.P.  & S.P.', '-65', 16.67, NULL, 69, '1', '2022-05-17 05:23:01', '2022-05-17 05:23:01', NULL),
(71, 15, 'G.B. 120 Page D.C. Power', '-66', 15.00, NULL, 70, '1', '2022-05-17 05:23:19', '2022-05-17 05:23:19', NULL),
(72, 15, 'G.B. 60 Page D.C. Power', '-67', 8.17, 15.00, 71, '1', '2022-05-17 05:23:34', '2022-05-17 05:23:34', NULL),
(73, 16, 'Pioneer 100 Page D.C.', '-68', 18.00, 33.00, 72, '1', '2022-05-17 05:23:49', '2022-05-17 05:23:49', NULL),
(74, 16, 'Pioneer 120 Page D.C.', '-69', 22.50, 38.00, 73, '1', '2022-05-17 05:24:02', '2022-05-17 05:24:02', NULL),
(75, 16, 'Pioneer 180 Page D.C.', '-70', 35.00, 55.00, 74, '1', '2022-05-17 05:24:31', '2022-05-17 05:24:31', NULL),
(76, 16, 'Pioneer 36 Page Scrap', '-71', 36.08, 70.00, 75, '1', '2022-05-17 05:24:55', '2022-05-17 05:24:55', NULL),
(77, 17, 'Pioneer 2No St. Graph', '-72', 9.50, 14.00, 76, '1', '2022-05-17 05:25:10', '2022-05-17 07:04:01', NULL),
(78, 17, 'Pioneer 44Page Big Graph', '-73', 22.42, 38.00, 77, '1', '2022-05-17 05:25:31', '2022-05-17 07:04:01', NULL),
(79, 17, 'Pioneer 4No. St. Graph', '-74', 13.42, 20.00, 78, '1', '2022-05-17 05:25:47', '2022-05-17 07:04:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_roles`
--

CREATE TABLE `up_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_roles`
--

INSERT INTO `up_roles` (`id`, `name`, `slug`, `is_admin`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'super-admin', '1', '1', '2022-05-06 07:39:45', '2022-05-06 07:39:45', NULL),
(2, 'Distributor Role', 'distributor-role-1', '1', '1', '2022-05-25 23:52:00', '2022-05-27 06:58:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_role_pages`
--

CREATE TABLE `up_role_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `routeName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_role_pages`
--

INSERT INTO `up_role_pages` (`id`, `routeName`) VALUES
(1, 'distributionArea.list'),
(2, 'distributionArea.add'),
(3, 'distributionArea.edit'),
(4, 'distributionArea.change-status'),
(5, 'distributionArea.delete'),
(6, 'distributionArea.sort'),
(7, 'distributor.list'),
(8, 'distributor.add'),
(9, 'distributor.edit'),
(10, 'distributor.change-status'),
(11, 'distributor.delete'),
(12, 'store.list'),
(13, 'store.add'),
(14, 'store.edit'),
(15, 'store.change-status'),
(16, 'store.delete'),
(17, 'category.list'),
(18, 'category.add'),
(19, 'category.edit'),
(20, 'category.change-status'),
(21, 'category.delete'),
(22, 'product.list'),
(23, 'product.add'),
(24, 'product.edit'),
(25, 'product.change-status'),
(26, 'product.delete'),
(27, 'areaAnalysis.list'),
(28, 'areaAnalysis.add'),
(29, 'areaAnalysis.edit'),
(30, 'areaAnalysis.change-status'),
(31, 'areaAnalysis.delete'),
(32, 'roleAssignment.list'),
(33, 'roleAssignment.add'),
(34, 'roleAssignment.edit'),
(35, 'roleAssignment.change-status'),
(36, 'roleAssignment.delete'),
(37, 'analyses.list'),
(38, 'analyses.view'),
(39, 'analyses.details-list'),
(40, 'analyses.details-add'),
(41, 'analyses.details-edit');

-- --------------------------------------------------------

--
-- Table structure for table `up_role_permissions`
--

CREATE TABLE `up_role_permissions` (
  `role_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_role_permissions`
--

INSERT INTO `up_role_permissions` (`role_id`, `page_id`) VALUES
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41);

-- --------------------------------------------------------

--
-- Table structure for table `up_seasons`
--

CREATE TABLE `up_seasons` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_seasons`
--

INSERT INTO `up_seasons` (`id`, `title`, `slug`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'High Season', 'high-season', 0, '1', '2022-05-20 10:34:40', '2022-05-20 10:34:40', NULL),
(2, 'Incentive Season', 'incentive-season', 1, '1', '2022-05-20 10:34:40', '2022-05-20 10:34:40', NULL),
(3, 'Mid Season', 'mid-season', 2, '1', '2022-05-20 10:34:56', '2022-05-20 10:34:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_stores`
--

CREATE TABLE `up_stores` (
  `id` int(10) UNSIGNED NOT NULL,
  `distribution_area_id` int(11) DEFAULT NULL COMMENT 'Id from distribution_areas table',
  `name_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_no_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_no_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `beat_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_size_category` enum('S','M','L') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S' COMMENT 'S=>Small, M=>Medium, L=>Large',
  `integrity` enum('A+','A','B','B-','C') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A+' COMMENT 'A+=>A+, A=>A, B=>B, B-=>B-, C=>C',
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_stores`
--

INSERT INTO `up_stores` (`id`, `distribution_area_id`, `name_1`, `name_2`, `store_name`, `slug`, `phone_no_1`, `whatsapp_no_1`, `phone_no_2`, `whatsapp_no_2`, `street`, `district_region`, `zip`, `beat_name`, `email`, `sale_size_category`, `integrity`, `notes`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Store Name 11', 'Store Name 2', 'Dipankar Stores', 'dipankar-stores', '987543210', '9876543211', '9876543212', '9876543213', 'M.G. Road', 'Kolkata', '700033', 'Beat name', 'dipankarstores@yopmail.com', 'L', 'A', 'Test notes.', 0, '1', '2022-05-13 04:39:17', '2022-05-20 07:12:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_users`
--

CREATE TABLE `up_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_title_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Job title 1',
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Name 1',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Company',
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Phone 1',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'M' COMMENT 'M=>Male, F=>Female',
  `dob` datetime DEFAULT NULL COMMENT 'Date of birth',
  `distribution_area_id` int(11) DEFAULT NULL COMMENT 'Id from distribution_areas table',
  `role_id` int(11) DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('SA','A','U','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'U' COMMENT 'SA=>Super Admin, A=>Sub Admin, U=>User, D=>Distributor',
  `agree` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y' COMMENT 'N=>No, Y=>Yes',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `lastlogintime` int(11) DEFAULT NULL,
  `sample_login_show` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=>Yes, N=>No',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_users`
--

INSERT INTO `up_users` (`id`, `job_title_1`, `nickname`, `title`, `first_name`, `last_name`, `full_name`, `username`, `email`, `company`, `phone_no`, `password`, `profile_pic`, `gender`, `dob`, `distribution_area_id`, `role_id`, `remember_token`, `auth_token`, `type`, `agree`, `status`, `lastlogintime`, `sample_login_show`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, NULL, 'John', 'Doe', 'John Doe', 'johndoe', 'admin@admin.com', NULL, '9876543210', '$2y$10$RFGYQLaP8sI212TKj0CY0uxRR2OENt.2PsiFKxQedSbUXSmPANeQq', '', 'M', NULL, NULL, 1, NULL, NULL, 'SA', 'Y', '1', 1653978494, 'Y', '2022-05-06 07:39:45', '2022-05-31 01:04:17', NULL),
(3, 'Owner', NULL, NULL, 'Tibrewalla', 'Agarwal', 'Tibrewalla Agarwal', 'tibrewalla', 'info@lionsbbdbagbloodbank.org', 'Marwari Relief Society', '2274 5675', '$2y$10$0hd/hA0IA0zRWkIOP6gG1uaYK27jdvAnWNaf7XbMavBBah7r9Ld8y', 'admin_user_1653979426.png', 'M', NULL, 1, NULL, NULL, NULL, 'D', 'Y', '1', 1653978892, 'N', '2022-05-09 06:16:32', '2022-05-31 01:13:46', NULL),
(4, 'Owner', NULL, NULL, 'Mahendra', 'Agarwal', 'Mahendra Agarwal', 'mahendra', 'mahendra@yopmail.com', 'Marwari Relief Society', '9876543210', '$2y$10$QmoJYggTN670P.nJKSQxC..MdbtEEw2DLtw7RmDfnExZxjzSJsB5C', 'admin_user_1653979471.png', 'M', NULL, 3, NULL, NULL, NULL, 'D', 'Y', '1', 1653979441, 'N', '2022-05-26 05:32:09', '2022-05-31 01:14:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_user_details`
--

CREATE TABLE `up_user_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'Id from users table',
  `job_title_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Job title 2',
  `full_name_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Full name 2',
  `phone_no_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Phone 2',
  `whatsapp_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Whats App',
  `street` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'City',
  `district_region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'District/Region',
  `state_province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'State/Province',
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Zip',
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_user_details`
--

INSERT INTO `up_user_details` (`id`, `user_id`, `job_title_2`, `full_name_2`, `phone_no_2`, `whatsapp_no`, `street`, `city`, `district_region`, `state_province`, `zip`, `notes`) VALUES
(1, 3, 'Job Title 2', 'Pawan', NULL, '9876543210', '225/227,  Rabindra Sarani Barabazar H.O.', 'Kolkata', 'South 24 Parganas', 'West Bengal', '700007', 'Test Notes'),
(2, 4, NULL, NULL, NULL, NULL, '225/227,  Rabindra Sarani Barabazar H.O.', 'Kolkata', 'South 24 Parganas', 'West Bengal', '700007', 'Testing');

-- --------------------------------------------------------

--
-- Table structure for table `up_user_roles`
--

CREATE TABLE `up_user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_user_roles`
--

INSERT INTO `up_user_roles` (`user_id`, `role_id`) VALUES
(3, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `up_website_settings`
--

CREATE TABLE `up_website_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `from_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `googleplus_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rss_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dribble_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tumblr_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_line` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_website_settings`
--

INSERT INTO `up_website_settings` (`id`, `from_email`, `to_email`, `website_title`, `phone_no`, `fax`, `facebook_link`, `twitter_link`, `instagram_link`, `linkedin_link`, `pinterest_link`, `googleplus_link`, `youtube_link`, `rss_link`, `dribble_link`, `tumblr_link`, `default_meta_title`, `default_meta_keywords`, `default_meta_description`, `address`, `map`, `footer_address`, `copyright_text`, `tag_line`, `logo`, `logo_title`, `logo_alt`, `footer_logo`, `footer_logo_title`, `footer_logo_alt`) VALUES
(1, 'admin@admin.com', 'admin@admin.com', 'Pioneer Analysis Software', '9876543210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `up_area_analyses`
--
ALTER TABLE `up_area_analyses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_area_analysis_details`
--
ALTER TABLE `up_area_analysis_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_categories`
--
ALTER TABLE `up_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_distribution_areas`
--
ALTER TABLE `up_distribution_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_migrations`
--
ALTER TABLE `up_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_products`
--
ALTER TABLE `up_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_roles`
--
ALTER TABLE `up_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_role_pages`
--
ALTER TABLE `up_role_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_seasons`
--
ALTER TABLE `up_seasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_stores`
--
ALTER TABLE `up_stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_users`
--
ALTER TABLE `up_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_user_details`
--
ALTER TABLE `up_user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_website_settings`
--
ALTER TABLE `up_website_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `up_area_analyses`
--
ALTER TABLE `up_area_analyses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `up_area_analysis_details`
--
ALTER TABLE `up_area_analysis_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `up_categories`
--
ALTER TABLE `up_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `up_distribution_areas`
--
ALTER TABLE `up_distribution_areas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `up_migrations`
--
ALTER TABLE `up_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `up_products`
--
ALTER TABLE `up_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `up_roles`
--
ALTER TABLE `up_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `up_role_pages`
--
ALTER TABLE `up_role_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `up_seasons`
--
ALTER TABLE `up_seasons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `up_stores`
--
ALTER TABLE `up_stores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `up_users`
--
ALTER TABLE `up_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `up_user_details`
--
ALTER TABLE `up_user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `up_website_settings`
--
ALTER TABLE `up_website_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
