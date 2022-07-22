-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2022 at 02:54 PM
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
-- Table structure for table `up_analyses`
--

CREATE TABLE `up_analyses` (
  `id` int(10) UNSIGNED NOT NULL,
  `analysis_season_id` int(11) DEFAULT NULL COMMENT 'Id from analysis_seasons table',
  `distribution_area_id` int(11) DEFAULT NULL COMMENT 'Id from distribution_areas table',
  `distributor_id` int(11) DEFAULT NULL COMMENT 'Id from users table',
  `store_id` int(11) DEFAULT NULL COMMENT 'Id from stores table',
  `beat_id` int(11) DEFAULT NULL COMMENT 'beat_id foreign key from stores table',
  `analysis_date` timestamp NULL DEFAULT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active, 2=>Blocked',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_analyses`
--

INSERT INTO `up_analyses` (`id`, `analysis_season_id`, `distribution_area_id`, `distributor_id`, `store_id`, `beat_id`, `analysis_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 5, 4, 2, '2022-07-17 18:30:00', '1', '2022-07-20 02:33:28', '2022-07-22 00:13:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_analyses_details`
--

CREATE TABLE `up_analyses_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `analyses_id` int(11) DEFAULT NULL COMMENT 'Id from analyses table',
  `category_id` int(11) DEFAULT NULL COMMENT 'Id from categories table',
  `product_id` int(11) DEFAULT NULL COMMENT 'Id from products table',
  `target_monthly_sales` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_analysis` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_analyses_details`
--

INSERT INTO `up_analyses_details` (`id`, `analyses_id`, `category_id`, `product_id`, `target_monthly_sales`, `type_of_analysis`, `action`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '1000', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2022-07-20 08:03:28', '2022-07-22 00:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `up_analysis_seasons`
--

CREATE TABLE `up_analysis_seasons` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_analysis_seasons`
--

INSERT INTO `up_analysis_seasons` (`id`, `title`, `slug`, `year`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Season 1', 'season-1', 2022, 0, '1', '2022-06-23 05:14:25', '2022-06-23 05:22:24', NULL),
(2, 'Season 2', 'season-2', 2022, 1, '1', '2022-06-27 04:21:06', '2022-06-28 05:02:54', NULL);

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
(4, 3, 2022, '2022-05-24 18:30:00', 1, 3, 1, 5, 21, '1200', 'Test Type of Analysis', 'Test Analysis Action', 'Test Result', 'Test Why', 'Test Comment', '1', '2022-05-25 07:09:15', '2022-06-17 07:03:22', NULL);

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
(1, 4, 3, 'Test result', 'Test Why', 'D', 'N', '1', '2022-05-27 06:46:10', '2022-05-27 06:46:10', NULL),
(2, 4, 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'D', 'N', '1', '2022-06-15 23:45:23', '2022-06-15 23:45:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_beats`
--

CREATE TABLE `up_beats` (
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
-- Dumping data for table `up_beats`
--

INSERT INTO `up_beats` (`id`, `title`, `slug`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Katulpur', 'katulpur', 0, '1', '2022-07-10 23:51:42', '2022-07-10 23:57:44', NULL),
(2, 'Jirat', 'jirat', 1, '1', '2022-07-10 23:56:56', '2022-07-10 23:57:44', NULL);

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
(17, 'Stitch Graph', 'stitch-graph', 16, '1', '2022-05-16 07:37:32', '2022-05-17 07:04:11', NULL),
(18, 'Test cate', 'test-cate', 17, '0', '2022-06-17 06:32:56', '2022-06-17 06:33:57', '2022-06-17 06:33:57'),
(19, 'Testing', 'testing', 17, '1', '2022-06-24 05:26:34', '2022-06-24 05:26:34', NULL);

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
(1, 'Bagnan', 'Test1', 'bagnan', 0, '1', '2022-05-09 04:14:38', '2022-06-28 01:55:28', NULL),
(3, 'Barasat', 'Test Definition', 'barasat', 1, '1', '2022-05-09 06:33:21', '2022-06-28 06:45:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_grades`
--

CREATE TABLE `up_grades` (
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
-- Dumping data for table `up_grades`
--

INSERT INTO `up_grades` (`id`, `title`, `slug`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'A', 'a', 0, '1', '2022-07-13 07:36:28', '2022-07-13 07:36:28', NULL),
(2, 'B', 'b', 1, '1', '2022-07-13 07:36:28', '2022-07-13 07:36:28', NULL),
(3, 'C', 'c', 2, '1', '2022-07-13 07:39:44', '2022-07-13 07:39:44', NULL),
(4, 'D', 'd', 3, '1', '2022-07-13 07:39:44', '2022-07-13 07:39:44', NULL);

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
(14, '2022_05_20_103233_create_seasons_table', 8),
(15, '2022_06_23_101751_create_analysis_seasons_table', 9),
(16, '2022_06_24_095547_create_analyses_table', 10),
(17, '2022_06_24_100134_create_analyses_details_table', 10),
(18, '2022_07_11_045625_create_beats_table', 11),
(19, '2022_07_13_073334_create_grades_table', 12),
(20, '2022_07_14_073113_create_user_distribution_areas_table', 13),
(21, '2022_07_19_061036_create_orders_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `up_orders`
--

CREATE TABLE `up_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(11) DEFAULT NULL COMMENT 'Id from users table',
  `analysis_season_id` int(11) DEFAULT NULL COMMENT 'Id from analysis_seasons table',
  `distribution_area_id` int(11) DEFAULT NULL COMMENT 'Id from distribution_areas table',
  `distributor_id` int(11) DEFAULT NULL COMMENT 'Id from users table',
  `beat_id` int(11) DEFAULT NULL COMMENT 'beat_id foreign key from stores table',
  `store_id` int(11) DEFAULT NULL COMMENT 'Id from stores table',
  `analysis_date` timestamp NULL DEFAULT NULL,
  `analyses_id` int(11) DEFAULT NULL COMMENT 'Id from analyses table',
  `category_id` int(11) DEFAULT NULL COMMENT 'Id from analyses_details table',
  `product_id` int(11) DEFAULT NULL COMMENT 'Id from analyses_details table',
  `qty` int(11) DEFAULT NULL,
  `why` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_orders`
--

INSERT INTO `up_orders` (`id`, `seller_id`, `analysis_season_id`, `distribution_area_id`, `distributor_id`, `beat_id`, `store_id`, `analysis_date`, `analyses_id`, `category_id`, `product_id`, `qty`, `why`, `result`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 1, 3, 5, 2, 4, '2022-07-17 18:30:00', 1, 1, 1, 2, 'Why 1', 'Result 1', '1', '2022-07-22 04:59:27', '2022-07-22 04:59:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_products`
--

CREATE TABLE `up_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL COMMENT 'Id from categories table',
  `grade_id` int(11) DEFAULT NULL COMMENT 'Id from grades table',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate_per_pcs` double(10,2) NOT NULL DEFAULT 0.00,
  `mrp` double(10,2) DEFAULT NULL,
  `retailer_price` double(10,2) DEFAULT NULL,
  `pack_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_products`
--

INSERT INTO `up_products` (`id`, `category_id`, `grade_id`, `title`, `slug`, `rate_per_pcs`, `mrp`, `retailer_price`, `pack_size`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 'Pioneer 100 Page A4', 'pioneer-100-page-a4', 27.00, 40.00, 30.00, '6', 0, '1', '2022-05-17 04:24:55', '2022-07-22 00:14:58', NULL),
(2, 1, 1, 'Pioneer 144 Page A4', 'pioneer-144-page-a4', 36.00, 58.00, 40.00, NULL, 1, '1', '2022-05-17 05:01:00', '2022-07-13 06:11:13', NULL),
(3, 1, 2, 'Pioneer 200 Page A4', 'pioneer-200-page-a4', 45.00, 75.00, 50.00, NULL, 2, '1', '2022-05-17 05:01:13', '2022-07-13 06:10:48', NULL),
(4, 2, NULL, 'G.B. 28 Page Drawing', 'gb-28-page-drawing', 8.00, NULL, 10.00, NULL, 3, '1', '2022-05-17 05:02:06', '2022-07-13 06:09:55', NULL),
(5, 2, NULL, 'G.B. 4 No Drawing', 'gb-4-no-drawing', 17.00, 34.00, 20.00, '10', 4, '1', '2022-05-17 05:02:21', '2022-07-13 06:09:00', NULL),
(6, 3, 2, 'Pioneer 4 No Drawing', 'pioneer-4-no-drawing', 24.83, 43.00, 30.00, NULL, 5, '1', '2022-05-17 05:02:41', '2022-07-13 06:15:42', NULL),
(7, 3, 1, 'Pioneer 40 Page 11x15 Drawing', 'pioneer-40-page-11x15-drawing', 36.00, 60.00, 40.00, NULL, 6, '1', '2022-05-17 05:02:55', '2022-07-13 06:15:32', NULL),
(8, 3, 4, 'Pioneer 40 Page Spiral Drawing 120 GSM', 'pioneer-40-page-spiral-drawing-120-gsm', 43.08, NULL, 45.00, NULL, 7, '1', '2022-05-17 05:03:09', '2022-07-13 06:15:25', NULL),
(9, 3, 1, 'Pioneer 40 Page Spiral Drawing 140 GSM', 'pioneer-40-page-spiral-drawing-140-gsm', 55.00, NULL, 60.00, NULL, 8, '1', '2022-05-17 05:03:21', '2022-07-13 06:15:17', NULL),
(10, 3, 2, 'Pioneer 48 Page Drawing', 'pioneer-48-page-drawing', 17.50, 29.00, 20.00, NULL, 9, '1', '2022-05-17 05:03:35', '2022-07-13 06:15:10', NULL),
(11, 3, 2, 'Pioneer 4no 11x15 Drawing', 'pioneer-4no-11x15-drawing', 57.75, 90.00, 70.00, NULL, 10, '1', '2022-05-17 05:04:00', '2022-07-13 06:15:03', NULL),
(12, 3, 3, 'Pioneer 6 No Drawing', 'pioneer-6-no-drawing', 38.08, 55.00, 40.00, NULL, 11, '1', '2022-05-17 05:04:17', '2022-07-13 06:14:56', NULL),
(13, 3, 2, 'Pioneer 6no 11x15 Drawing', 'pioneer-6no-11x15-drawing', 87.75, 135.00, 90.00, NULL, 12, '1', '2022-05-17 05:04:35', '2022-07-13 06:14:42', NULL),
(14, 3, 3, 'Pioneer 8 No Drawing', 'pioneer-8-no-drawing', 49.67, 71.00, 60.00, NULL, 13, '1', '2022-05-17 05:04:53', '2022-07-13 06:14:35', NULL),
(15, 4, 1, 'G.B. Lab Board', 'gb-lab-board', 14.58, 25.00, 15.00, NULL, 14, '1', '2022-05-17 05:05:17', '2022-07-13 06:14:28', NULL),
(16, 4, 3, 'G.B. Loose Sheet', 'gb-loose-sheet', 12.08, NULL, 15.00, NULL, 15, '1', '2022-05-17 05:05:30', '2022-07-13 06:14:20', NULL),
(17, 5, 3, 'Pioneer 10 No long Bound', 'pioneer-10-no-long-bound', 113.00, 160.00, 150.00, NULL, 16, '1', '2022-05-17 05:05:50', '2022-07-13 06:14:13', NULL),
(18, 5, 2, 'Pioneer 10 no SPL Long Bound (Case Binding)', 'pioneer-10-no-spl-long-bound-case-binding', 121.75, 208.00, 150.00, NULL, 17, '1', '2022-05-17 05:06:10', '2022-07-13 06:14:05', NULL),
(19, 5, 3, 'Pioneer 12 No Long Bound', 'pioneer-12-no-long-bound', 133.50, 200.00, 150.00, NULL, 18, '1', '2022-05-17 05:06:27', '2022-07-13 06:13:58', NULL),
(20, 5, 2, 'Pioneer 12 No SPL Long Bound (Case Binding)', 'pioneer-12-no-spl-long-bound-case-binding', 141.25, NULL, 145.00, NULL, 19, '1', '2022-05-17 05:06:45', '2022-07-13 06:13:51', NULL),
(21, 5, 2, 'Pioneer 4 No Long Bound', 'pioneer-4-no-long-bound', 51.33, 80.00, 60.00, NULL, 20, '1', '2022-05-17 05:07:05', '2022-07-13 06:13:43', NULL),
(22, 5, 3, 'Pioneer 6 No Long Bound', 'pioneer-6-no-long-bound', 71.92, 112.00, 80.00, NULL, 21, '1', '2022-05-17 05:07:26', '2022-07-13 06:13:36', NULL),
(23, 5, 1, 'Pioneer 8 No Long Bound', 'pioneer-8-no-long-bound', 92.42, 124.00, 100.00, NULL, 22, '1', '2022-05-17 05:07:48', '2022-07-13 06:13:30', NULL),
(24, 6, 3, 'Pioneer 240 Page 17x27', 'pioneer-240-page-17x27', 65.50, 105.00, 70.00, NULL, 23, '1', '2022-05-17 05:08:05', '2022-07-13 06:13:23', NULL),
(25, 6, 1, 'Pioneer 320 Page 17x27', 'pioneer-320-page-17x27', 90.17, 140.00, 100.00, NULL, 24, '1', '2022-05-17 05:08:24', '2022-07-13 06:13:16', NULL),
(26, 7, 2, 'G.B. 120 Page (15x25)', 'gb-120-page-15x25', 18.00, 35.00, 20.00, NULL, 25, '1', '2022-05-17 05:08:39', '2022-07-13 06:13:06', NULL),
(27, 7, 3, 'G.B. 120 Page (17x27)', 'gb-120-page-17x27', 26.00, 37.00, 30.00, NULL, 26, '1', '2022-05-17 05:09:05', '2022-07-13 06:12:55', NULL),
(28, 7, 4, 'G.B. 152 Page ( 15x25)', 'gb-152-page-15x25', 20.00, 45.00, 30.00, NULL, 27, '1', '2022-05-17 05:09:18', '2022-07-13 06:12:46', NULL),
(29, 7, 2, 'G.B. 160 Page (17x27)', 'gb-160-page-17x27', 30.00, 53.00, 40.00, NULL, 28, '1', '2022-05-17 05:09:31', '2022-07-13 06:12:37', NULL),
(30, 7, 1, 'G.B. 240 Page (17x27)', 'gb-240-page-17x27', 55.00, 80.00, 60.00, NULL, 29, '1', '2022-05-17 05:09:45', '2022-07-13 06:12:29', NULL),
(31, 7, 1, 'G.B. 60 Page Long ( 15x25)', 'gb-60-page-long-15x25', 8.33, NULL, 10.00, NULL, 30, '1', '2022-05-17 05:09:59', '2022-07-13 06:23:49', NULL),
(32, 7, 3, 'G.B. 80 Page (17x27)', 'gb-80-page-17x27', 17.58, 30.00, 25.00, NULL, 31, '1', '2022-05-17 05:10:12', '2022-07-13 06:23:40', NULL),
(33, 7, 1, 'Pioneer 100 Page Long Book(17x27)', 'pioneer-100-page-long-book17x27', 27.00, 45.00, 35.00, NULL, 32, '1', '2022-05-17 05:10:26', '2022-07-13 06:23:30', NULL),
(34, 7, 2, 'Pioneer 132 Page Long Book (15x25)', 'pioneer-132-page-long-book-15x25', 27.00, 42.00, 35.50, NULL, 33, '1', '2022-05-17 05:10:44', '2022-07-13 06:23:20', NULL),
(35, 7, 3, 'Pioneer 132 Page Long Book(17x27)', 'pioneer-132-page-long-book17x27', 36.50, 57.00, 40.50, NULL, 34, '1', '2022-05-17 05:11:04', '2022-07-13 06:23:12', NULL),
(36, 7, 3, 'Pioneer 160 Page Long Book (17x27)', 'pioneer-160-page-long-book-17x27', 43.75, 70.00, 45.80, NULL, 35, '1', '2022-05-17 05:11:23', '2022-07-13 06:22:17', NULL),
(37, 7, 3, 'Pioneer 80 Page Long Book (17x27)', 'pioneer-80-page-long-book-17x27', 26.00, 40.00, 29.80, NULL, 36, '1', '2022-05-17 05:11:49', '2022-07-13 06:22:08', NULL),
(38, 8, 3, 'Pioneer 10 No Note Book', 'pioneer-10-no-note-book', 26.08, 43.00, 39.80, NULL, 37, '1', '2022-05-17 05:12:05', '2022-07-13 06:21:59', NULL),
(39, 8, 1, 'Pioneer 12 No Note Book', 'pioneer-12-no-note-book', 30.58, 52.00, 35.30, NULL, 38, '1', '2022-05-17 05:12:23', '2022-07-13 06:21:50', NULL),
(40, 8, 3, 'Pioneer 4 No Note Book', 'pioneer-4-no-note-book', 10.83, 20.00, 15.80, NULL, 39, '1', '2022-05-17 05:12:39', '2022-07-13 06:21:43', NULL),
(41, 8, 3, 'Pioneer 6 No Note Book', 'pioneer-6-no-note-book', 15.67, 27.00, 19.50, NULL, 40, '1', '2022-05-17 05:12:55', '2022-07-13 06:21:36', NULL),
(42, 8, 2, 'Pioneer 8 No Note Book', 'pioneer-8-no-note-book', 21.08, 35.00, 25.50, NULL, 41, '1', '2022-05-17 05:13:12', '2022-07-13 06:21:28', NULL),
(43, 9, 1, 'Pioneer 112 Page Practical', 'pioneer-112-page-practical', 47.83, 80.00, 50.50, NULL, 42, '1', '2022-05-17 05:13:40', '2022-07-13 06:21:20', NULL),
(44, 9, 2, 'Pioneer 160 Page Practical', 'pioneer-160-page-practical', 64.83, 110.00, 69.52, NULL, 43, '1', '2022-05-17 05:13:58', '2022-07-13 06:21:12', NULL),
(45, 9, 1, 'Pioneer 192 Page Practical', 'pioneer-192-page-practical', 70.58, NULL, 75.50, NULL, 44, '1', '2022-05-17 05:14:12', '2022-07-13 06:21:03', NULL),
(46, 9, 2, 'Pioneer 256 Page Practical', 'pioneer-256-page-practical', 93.75, NULL, 95.20, NULL, 45, '1', '2022-05-17 05:14:31', '2022-07-13 06:20:56', NULL),
(47, 9, 1, 'Pioneer 80 Page Practical', 'pioneer-80-page-practical', 37.83, 63.00, 40.58, NULL, 46, '1', '2022-05-17 05:14:51', '2022-07-13 06:20:47', NULL),
(48, 10, 2, 'Dista 16x26', 'dista-16x26', 13.50, NULL, 15.00, NULL, 47, '1', '2022-05-17 05:16:33', '2022-07-13 06:20:39', NULL),
(49, 10, 1, 'Pioneer Dista Ream (17x27)', 'pioneer-dista-ream-17x27', 24.60, NULL, 30.56, NULL, 48, '1', '2022-05-17 05:16:47', '2022-07-13 06:20:28', NULL),
(50, 11, 2, 'Pioneer 10 No Small Bound', 'pioneer-10-no-small-bound', 59.00, 105.00, 90.00, NULL, 49, '1', '2022-05-17 05:17:19', '2022-07-13 06:17:12', NULL),
(51, 11, 2, 'Pioneer 12 No Small Bound', 'pioneer-12-no-small-bound', 69.67, 125.00, 70.89, NULL, 50, '1', '2022-05-17 05:17:55', '2022-07-13 06:17:03', NULL),
(52, 11, 3, 'Pioneer 4 No Small Bound', 'pioneer-4-no-small-bound', 27.08, 47.00, 30.60, NULL, 51, '1', '2022-05-17 05:18:18', '2022-07-13 06:16:54', NULL),
(53, 11, 3, 'Pioneer 4 No Small Bound Prac', 'pioneer-4-no-small-bound-prac', 29.92, NULL, 35.50, NULL, 52, '1', '2022-05-17 05:18:34', '2022-07-13 06:16:46', NULL),
(54, 11, 2, 'Pioneer 6 No Small Bound', 'pioneer-6-no-small-bound', 37.75, 63.00, 40.89, NULL, 53, '1', '2022-05-17 05:18:51', '2022-07-13 06:16:37', NULL),
(55, 11, 1, 'Pioneer 8 No Small Bound', 'pioneer-8-no-small-bound', 48.42, 90.00, 50.85, NULL, 54, '1', '2022-05-17 05:19:07', '2022-07-13 06:16:29', NULL),
(56, 12, 2, 'G.B. 100 Page Stitch', 'gb-100-page-stitch', 11.33, 21.00, 15.50, NULL, 55, '1', '2022-05-17 05:19:23', '2022-07-13 06:27:17', NULL),
(57, 12, 1, 'G.B. 128 Page Stitch', 'gb-128-page-stitch', 15.50, 28.00, 20.00, NULL, 56, '1', '2022-05-17 05:19:41', '2022-07-13 06:27:09', NULL),
(58, 12, 2, 'G.B. 60 Page stitch', 'gb-60-page-stitch', 6.50, 10.00, 8.00, NULL, 57, '1', '2022-05-17 05:20:03', '2022-07-13 06:27:03', NULL),
(59, 12, 1, 'Pioneer 100 Page Stitch', 'pioneer-100-page-stitch', 15.92, 29.00, 17.00, NULL, 58, '1', '2022-05-17 05:20:17', '2022-07-13 06:26:56', NULL),
(60, 12, 3, 'Pioneer 132 Page Stitch', 'pioneer-132-page-stitch', 20.75, 37.00, 25.00, NULL, 59, '1', '2022-05-17 05:20:39', '2022-07-13 06:26:49', NULL),
(61, 12, 2, 'Pioneer 68 Page Stitch', 'pioneer-68-page-stitch', 10.00, 19.00, 15.00, NULL, 60, '1', '2022-05-17 05:20:51', '2022-07-13 06:26:43', NULL),
(62, 13, 1, 'A4-Bright Craft Paper', 'a4-bright-craft-paper', 87.00, NULL, 90.00, NULL, 61, '1', '2022-05-17 05:21:12', '2022-07-13 06:26:38', NULL),
(63, 13, 2, 'A5 Five Subject Note Book', 'a5-five-subject-note-book', 100.00, NULL, 105.00, NULL, 62, '1', '2022-05-17 05:21:25', '2022-07-13 06:26:31', NULL),
(64, 13, 3, 'A5 One Subject Note Book', 'a5-one-subject-note-book', 61.00, NULL, 65.00, NULL, 63, '1', '2022-05-17 05:21:35', '2022-07-13 06:26:23', NULL),
(65, 13, 2, 'B5 One Subject NoteBook', 'b5-one-subject-notebook', 78.00, NULL, 80.00, NULL, 64, '1', '2022-05-17 05:21:46', '2022-07-13 06:26:18', NULL),
(66, 13, 1, 'Colour Paper ( 22 x 30)', 'colour-paper-22-x-30', 776.00, NULL, 780.00, NULL, 65, '1', '2022-05-17 05:21:59', '2022-07-13 06:26:11', NULL),
(67, 14, 1, 'Pioneer Lab Note Book SPL', 'pioneer-lab-note-book-spl', 19.83, 32.00, 25.50, NULL, 66, '1', '2022-05-17 05:22:15', '2022-07-13 06:26:04', NULL),
(68, 14, 2, 'Pioneer Lab Note Book T.P.', 'pioneer-lab-note-book-tp', 34.58, 53.00, 39.20, NULL, 67, '1', '2022-05-17 05:22:35', '2022-07-13 06:25:53', NULL),
(69, 14, 2, 'Pioneer Loose Sheet', 'pioneer-loose-sheet', 16.67, NULL, 20.50, NULL, 68, '1', '2022-05-17 05:22:48', '2022-07-13 06:25:44', NULL),
(70, 14, 1, 'Pioneer Loose Sheet T.P.  & S.P.', 'pioneer-loose-sheet-tp-sp', 16.67, NULL, 20.00, NULL, 69, '1', '2022-05-17 05:23:01', '2022-07-13 06:25:36', NULL),
(71, 15, 2, 'G.B. 120 Page D.C. Power', 'gb-120-page-dc-power', 15.00, NULL, 18.00, NULL, 70, '1', '2022-05-17 05:23:19', '2022-07-13 06:25:31', NULL),
(72, 15, 1, 'G.B. 60 Page D.C. Power', 'gb-60-page-dc-power', 8.17, 15.00, 12.00, NULL, 71, '1', '2022-05-17 05:23:34', '2022-07-13 06:25:24', NULL),
(73, 16, 1, 'Pioneer 100 Page D.C.', 'pioneer-100-page-dc', 18.00, 33.00, 25.00, NULL, 72, '1', '2022-05-17 05:23:49', '2022-07-13 06:25:17', NULL),
(74, 16, 3, 'Pioneer 120 Page D.C.', 'pioneer-120-page-dc', 22.50, 38.00, 25.00, NULL, 73, '1', '2022-05-17 05:24:02', '2022-07-13 06:25:10', NULL),
(75, 16, 1, 'Pioneer 180 Page D.C.', 'pioneer-180-page-dc', 35.00, 55.00, 40.00, NULL, 74, '1', '2022-05-17 05:24:31', '2022-07-13 06:25:03', NULL),
(76, 16, 1, 'Pioneer 36 Page Scrap', 'pioneer-36-page-scrap', 36.08, 70.00, 50.00, NULL, 75, '1', '2022-05-17 05:24:55', '2022-07-13 06:24:56', NULL),
(77, 17, 3, 'Pioneer 2No St. Graph', 'pioneer-2no-st-graph', 9.50, 14.00, 12.00, NULL, 76, '1', '2022-05-17 05:25:10', '2022-07-13 06:24:49', NULL),
(78, 17, 2, 'Pioneer 44Page Big Graph', 'pioneer-44page-big-graph', 22.42, 38.00, 25.00, NULL, 77, '1', '2022-05-17 05:25:31', '2022-07-13 06:24:43', NULL),
(79, 17, 1, 'Pioneer 4No. St. Graph', 'pioneer-4no-st-graph', 13.42, 20.00, 15.00, '10', 78, '1', '2022-05-17 05:25:47', '2022-07-13 06:31:29', NULL),
(80, 1, 2, 'Test Pro', 'test-pro', 105.55, 106.66, 107.78, '100', 79, '1', '2022-07-13 05:46:29', '2022-07-13 06:31:16', NULL);

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
(1, 'Super Admin', 'super-admin', '1', '1', '2022-05-06 07:39:45', '2022-06-24 08:27:38', NULL),
(2, 'Distributor', 'distributor-1', '1', '1', '2022-05-25 23:52:00', '2022-07-13 23:54:08', NULL),
(3, 'Seller', 'seller', '1', '1', '2022-07-13 23:51:50', '2022-07-22 04:59:05', NULL);

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
(41, 'analyses.details-edit'),
(42, 'seller.list'),
(43, 'seller.add'),
(44, 'seller.edit'),
(45, 'seller.change-status'),
(46, 'seller.delete'),
(47, 'beat.list'),
(48, 'beat.add'),
(49, 'beat.edit'),
(50, 'beat.change-status'),
(51, 'beat.delete'),
(52, 'areaAnalysis.details-list'),
(53, 'areaAnalysis.details-view'),
(54, 'analyses.details-view'),
(55, 'analysisSeason.list'),
(56, 'analysisSeason.add'),
(57, 'analysisSeason.edit'),
(58, 'analysisSeason.change-status'),
(59, 'analysisSeason.distribution-area-list'),
(60, 'analysisSeason.distributor-list'),
(61, 'analysisSeason.store-list'),
(62, 'analysisSeason.analysis'),
(66, 'sellerAnalyses.distribution-area-list'),
(67, 'sellerAnalyses.beat-list'),
(68, 'sellerAnalyses.store-list'),
(69, 'sellerAnalyses.category-list'),
(70, 'sellerAnalyses.product-list'),
(71, 'sellerAnalyses.analysis'),
(72, 'order.list'),
(73, 'order.edit'),
(74, 'order.delete');

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
(2, 63),
(2, 64),
(3, 66),
(3, 67),
(3, 68),
(3, 69),
(3, 70),
(3, 71),
(3, 72),
(3, 73),
(3, 74);

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
  `beat_id` int(11) DEFAULT NULL COMMENT 'Id from beats table',
  `grade_id` int(11) DEFAULT NULL COMMENT 'Id from grades table',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_size_category` enum('S','M','L') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S' COMMENT 'S=>Small, M=>Medium, L=>Large',
  `integrity` enum('A+','A','B','B-','C') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A+' COMMENT 'A+=>A+, A=>A, B=>B, B-=>B-, C=>C',
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `progress_status` enum('IP','CP') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'IP' COMMENT 'IP=>In-Progress, CP=>Complete',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_stores`
--

INSERT INTO `up_stores` (`id`, `distribution_area_id`, `name_1`, `name_2`, `store_name`, `slug`, `phone_no_1`, `whatsapp_no_1`, `phone_no_2`, `whatsapp_no_2`, `street`, `district_region`, `zip`, `beat_name`, `beat_id`, `grade_id`, `email`, `sale_size_category`, `integrity`, `notes`, `sort`, `status`, `progress_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Store Name 11', 'Store Name 2', 'Dipankar Stores', 'dipankar-stores', '987543210', '9876543211', '9876543212', '9876543213', 'M.G. Road', 'Kolkata', '700033', NULL, 1, 2, 'dipankarstores@yopmail.com', 'L', 'A', 'Test notes.', 0, '1', 'IP', '2022-05-13 04:39:17', '2022-07-13 02:30:26', NULL),
(2, 3, 'Dealer', NULL, 'Maa Laxmi Bhandar', 'maa-laxmi-bhandar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 'M', 'B', NULL, 1, '1', 'CP', '2022-06-27 04:22:59', '2022-07-13 01:44:22', NULL),
(3, 1, 'Test Name 1', NULL, 'Test Store Name 1', 'test-store-name-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 'S', 'A+', NULL, 2, '1', 'IP', '2022-07-13 01:40:04', '2022-07-13 01:40:04', NULL),
(4, 3, 'Sanjoy Kayal', NULL, 'Sanjoy Stores', 'sanjoy-stores', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 4, NULL, 'S', 'B', NULL, 3, '1', 'IP', '2022-07-13 02:50:09', '2022-07-13 02:50:46', NULL);

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
  `type` enum('SA','A','U','D','S') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'U' COMMENT 'SA=>Super Admin, A=>Sub Admin, U=>User, D=>Distributor, S=>Seller',
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
(1, NULL, NULL, NULL, 'John', 'Doe', 'John Doe', 'johndoe', 'admin@admin.com', NULL, '9876543210', '$2y$10$RFGYQLaP8sI212TKj0CY0uxRR2OENt.2PsiFKxQedSbUXSmPANeQq', '', 'M', NULL, NULL, 1, NULL, NULL, 'SA', 'Y', '1', 1658482881, 'Y', '2022-05-06 07:39:45', '2022-07-22 04:11:21', NULL),
(3, 'Owner', NULL, NULL, 'Tibrewalla', 'Agarwal', 'Tibrewalla Agarwal', 'tibrewalla', 'info@lionsbbdbagbloodbank.org', 'Marwari Relief Society', '2274 5675', '$2y$10$0hd/hA0IA0zRWkIOP6gG1uaYK27jdvAnWNaf7XbMavBBah7r9Ld8y', 'admin_user_1653979426.png', 'M', NULL, 1, NULL, NULL, NULL, 'D', 'Y', '1', 1655357183, 'N', '2022-05-09 06:16:32', '2022-06-15 23:56:23', NULL),
(4, 'Owner', NULL, NULL, 'Mahendra', 'Agarwal', 'Mahendra Agarwal', 'mahendra', 'mahendra@yopmail.com', 'Marwari Relief Society', '9876543210', '$2y$10$QmoJYggTN670P.nJKSQxC..MdbtEEw2DLtw7RmDfnExZxjzSJsB5C', 'admin_user_1653979471.png', 'M', NULL, 3, NULL, NULL, NULL, 'D', 'Y', '1', 1653979441, 'N', '2022-05-26 05:32:09', '2022-06-28 04:21:35', NULL),
(5, 'My Job Title', NULL, NULL, 'My', 'Job', 'My Job Title New', 'dev', 'dev@yopmail.com', 'Vishi Prem Workz', NULL, '$2y$10$Ks26Ofv37EMqNgZZ7lr61OCZfUqMxTe27S2SGgoovbEJ7pyZpW.3m', '', 'M', NULL, 3, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-06-27 04:20:38', '2022-06-28 04:00:02', NULL),
(6, NULL, NULL, NULL, 'Sanjoy', 'Kayal', 'Sanjoy Kayal', 'sanjoykayal', 'sanjoykayal@yopmail.com', NULL, '9876543210', '$2y$10$3zk0NqEBvS.4ai30L/RQJOG.c.QHWbRsUue9OKBH5deDvfHlvcvp2', 'seller_1657779221.png', 'M', NULL, NULL, NULL, NULL, NULL, 'S', 'Y', '1', 1658477504, 'N', '2022-07-14 00:43:42', '2022-07-22 02:41:44', NULL),
(7, NULL, NULL, NULL, 'Soubhik', 'Paul', 'Soubhik Paul', 'soubhikpaul', 'soubhikpaul@yopmail.com', NULL, NULL, '$2y$10$0PWEImztEZMoA0AvRgdV5untgyY.V4Qt7xoQ28FCwvcpPAWKGPdXq', 'seller_1657785389.png', 'M', NULL, NULL, NULL, NULL, NULL, 'S', 'Y', '1', 1657886407, 'N', '2022-07-14 02:26:29', '2022-07-15 06:30:07', NULL);

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
(2, 4, NULL, NULL, NULL, NULL, '225/227,  Rabindra Sarani Barabazar H.O.', 'Kolkata', 'South 24 Parganas', 'West Bengal', '700007', 'Testing'),
(3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 6, NULL, NULL, NULL, '9876543210', 'G.P. Maitra Road', 'Kolkata', 'South 24 Parganas', 'West Bengal', '700143', NULL),
(5, 7, NULL, NULL, NULL, '9876543210', 'Tollygunge', 'Kolkata', 'South 24 Parganas', 'West Bengal', '700033', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_user_distribution_areas`
--

CREATE TABLE `up_user_distribution_areas` (
  `user_id` int(11) NOT NULL,
  `distribution_area_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_user_distribution_areas`
--

INSERT INTO `up_user_distribution_areas` (`user_id`, `distribution_area_id`) VALUES
(7, 3),
(6, 3);

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
(5, 2),
(4, 2),
(6, 3),
(7, 3);

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
-- Indexes for table `up_analyses`
--
ALTER TABLE `up_analyses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_analyses_details`
--
ALTER TABLE `up_analyses_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_analysis_seasons`
--
ALTER TABLE `up_analysis_seasons`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `up_beats`
--
ALTER TABLE `up_beats`
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
-- Indexes for table `up_grades`
--
ALTER TABLE `up_grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_migrations`
--
ALTER TABLE `up_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_orders`
--
ALTER TABLE `up_orders`
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
-- AUTO_INCREMENT for table `up_analyses`
--
ALTER TABLE `up_analyses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `up_analyses_details`
--
ALTER TABLE `up_analyses_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `up_analysis_seasons`
--
ALTER TABLE `up_analysis_seasons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `up_area_analyses`
--
ALTER TABLE `up_area_analyses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `up_area_analysis_details`
--
ALTER TABLE `up_area_analysis_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `up_beats`
--
ALTER TABLE `up_beats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `up_categories`
--
ALTER TABLE `up_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `up_distribution_areas`
--
ALTER TABLE `up_distribution_areas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `up_grades`
--
ALTER TABLE `up_grades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `up_migrations`
--
ALTER TABLE `up_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `up_orders`
--
ALTER TABLE `up_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `up_products`
--
ALTER TABLE `up_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `up_roles`
--
ALTER TABLE `up_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `up_role_pages`
--
ALTER TABLE `up_role_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `up_seasons`
--
ALTER TABLE `up_seasons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `up_stores`
--
ALTER TABLE `up_stores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `up_users`
--
ALTER TABLE `up_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `up_user_details`
--
ALTER TABLE `up_user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `up_website_settings`
--
ALTER TABLE `up_website_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
