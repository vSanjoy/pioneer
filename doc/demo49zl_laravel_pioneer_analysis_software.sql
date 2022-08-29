-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 22, 2022 at 07:30 AM
-- Server version: 5.7.23-23
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo49zl_laravel_pioneer_analysis_software`
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_analyses`
--

INSERT INTO `up_analyses` (`id`, `analysis_season_id`, `distribution_area_id`, `distributor_id`, `store_id`, `beat_id`, `analysis_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 6, 6, 15, NULL, '2022-06-28 00:00:00', '1', '2022-06-28 11:59:09', '2022-06-28 11:59:09', NULL),
(2, 1, 5, 7, 3, 3, '2022-07-25 00:00:00', '1', '2022-07-26 09:43:29', '2022-07-26 09:44:34', NULL),
(3, 1, 5, 7, 20, 6, '2022-08-10 00:00:00', '1', '2022-08-11 10:56:07', '2022-08-11 10:56:07', NULL),
(4, 1, 18, 14, 21, 11, '2022-08-09 00:00:00', '1', '2022-08-11 11:30:51', '2022-08-13 12:24:24', NULL),
(5, 1, 6, 6, 23, 16, '2022-08-12 00:00:00', '1', '2022-08-13 11:55:06', '2022-08-13 11:55:06', NULL);

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
  `type_of_analysis` text COLLATE utf8mb4_unicode_ci,
  `action` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_analyses_details`
--

INSERT INTO `up_analyses_details` (`id`, `analyses_id`, `category_id`, `product_id`, `target_monthly_sales`, `type_of_analysis`, `action`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '1000', 'Type of analysis', 'Analysis action', '2022-06-28 11:59:09', NULL),
(2, 2, 2, 4, '1000', 'Test 1 Analysis', 'Test 1 Analysis Action', '2022-07-26 09:43:29', '2022-07-26 09:44:34'),
(3, 2, 4, 15, '20000', 'Test 2 Analysis', 'Test 2 Analysis Action', '2022-07-26 09:43:29', '2022-07-26 09:44:34'),
(4, 2, 4, 16, '50000', 'Test 3 Analysis', 'Test 3 Analysis Action', '2022-07-26 09:44:34', NULL),
(5, 3, 1, 1, '10000', 'Test 1', 'Test 2', '2022-08-11 10:56:07', NULL),
(6, 3, 1, 2, '2000', 'Test 3', 'Test 4', '2022-08-11 10:56:07', NULL),
(7, 4, 20, 82, '10000', 'Test 1', 'Test 2', '2022-08-11 11:30:51', '2022-08-13 12:24:24'),
(8, 5, 1, 1, '36', NULL, NULL, '2022-08-13 11:55:06', NULL),
(9, 4, 1, 1, '36', NULL, NULL, '2022-08-13 11:58:23', '2022-08-13 12:24:24'),
(10, 4, 1, 2, '36', NULL, NULL, '2022-08-13 12:24:24', NULL),
(11, 4, 1, 3, '36', NULL, NULL, '2022-08-13 12:24:24', NULL),
(12, 4, 2, 81, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(13, 4, 2, 4, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(14, 4, 2, 5, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(15, 4, 3, 6, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(16, 4, 3, 7, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(17, 4, 3, 8, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(18, 4, 3, 9, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(19, 4, 3, 10, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(20, 4, 3, 11, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(21, 4, 3, 12, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(22, 4, 3, 13, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(23, 4, 3, 14, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(24, 4, 4, 15, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(25, 4, 4, 16, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(26, 4, 12, 61, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(27, 4, 13, 62, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(28, 4, 13, 63, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(29, 4, 13, 64, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(30, 4, 13, 65, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(31, 4, 13, 66, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(32, 4, 14, 67, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(33, 4, 14, 68, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(34, 4, 14, 69, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(35, 4, 14, 70, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(36, 4, 15, 71, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(37, 4, 15, 72, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(38, 4, 16, 73, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(39, 4, 16, 74, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(40, 4, 16, 75, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(41, 4, 16, 76, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(42, 4, 17, 77, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(43, 4, 17, 78, '100', NULL, NULL, '2022-08-13 12:24:24', NULL),
(44, 4, 17, 79, '100', NULL, NULL, '2022-08-13 12:24:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_analysis_seasons`
--

CREATE TABLE `up_analysis_seasons` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_analysis_seasons`
--

INSERT INTO `up_analysis_seasons` (`id`, `title`, `slug`, `year`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Season 1', 'season-1', 2022, 0, '1', '2022-06-28 11:56:52', '2022-06-28 11:56:52', NULL);

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
  `type_of_analysis` text COLLATE utf8mb4_unicode_ci,
  `action` text COLLATE utf8mb4_unicode_ci,
  `result` text COLLATE utf8mb4_unicode_ci,
  `why` text COLLATE utf8mb4_unicode_ci,
  `comment` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `up_area_analysis_details`
--

CREATE TABLE `up_area_analysis_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `area_analysis_id` int(11) DEFAULT NULL COMMENT 'Id from area_analyses table',
  `distributor_id` int(11) DEFAULT NULL COMMENT 'Id from distributors table',
  `result` text COLLATE utf8mb4_unicode_ci,
  `why` text COLLATE utf8mb4_unicode_ci,
  `commented_by` enum('D','SA','A','S') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'D' COMMENT 'D=>Distributor, SA=>Super Admin, A=>Admin, S=>Store Manager',
  `is_viewed` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'N=>No, Y=>Yes',
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active, 2=>Blocked',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `up_beats`
--

CREATE TABLE `up_beats` (
  `id` int(10) UNSIGNED NOT NULL,
  `distribution_area_id` int(11) DEFAULT NULL COMMENT 'Id from distribution_areas table',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_beats`
--

INSERT INTO `up_beats` (`id`, `distribution_area_id`, `title`, `slug`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 'Kalna', 'kalna', 0, '1', '2022-07-10 23:51:42', '2022-07-29 09:40:46', NULL),
(2, 5, 'Jirat', 'jirat', 1, '1', '2022-07-10 23:56:56', '2022-07-29 09:41:09', NULL),
(3, 5, 'Gupti Para', 'gupti-para', 2, '1', '2022-07-26 07:23:06', '2022-07-29 09:41:32', NULL),
(4, 5, 'Nawadip Dham', 'nawadip-dham', 3, '1', '2022-07-26 07:23:45', '2022-07-29 09:41:51', NULL),
(5, 6, 'Champadanga', 'champadanga', 4, '1', '2022-07-26 07:23:54', '2022-07-29 09:42:13', NULL),
(6, 5, 'Satgachiya', 'satgachiya', 5, '1', '2022-07-26 07:24:14', '2022-07-29 09:42:37', NULL),
(7, 5, 'Memari', 'memari', 6, '1', '2022-07-26 07:24:35', '2022-07-29 09:42:55', NULL),
(8, 11, 'Test 1', 'test-1', 7, '1', '2022-08-11 10:42:34', '2022-08-11 10:42:34', NULL),
(9, 17, 'Beat 1', 'beat-1', 8, '1', '2022-08-11 10:44:18', '2022-08-11 10:44:18', NULL),
(10, 17, 'Tolly Beat', 'tolly-beat', 9, '1', '2022-08-11 11:13:49', '2022-08-11 11:13:49', NULL),
(11, 18, 'MG Road', 'mg-road', 10, '1', '2022-08-11 11:23:03', '2022-08-11 11:23:03', NULL),
(12, 19, 'BABON ROAD', 'babon-road', 11, '1', '2022-08-11 12:11:29', '2022-08-11 12:11:29', NULL),
(13, 3, 'Habra', 'habra', 12, '1', '2022-08-12 10:56:56', '2022-08-12 10:56:56', NULL),
(14, 3, 'Maddhyamgham', 'maddhyamgham', 13, '1', '2022-08-12 10:59:08', '2022-08-12 10:59:08', NULL),
(15, 3, 'STATION ROAD', 'station-road', 14, '1', '2022-08-13 11:40:34', '2022-08-13 11:40:34', NULL),
(16, 6, 'HOSPITAL MORE', 'hospital-more', 15, '1', '2022-08-13 11:44:02', '2022-08-13 11:44:02', NULL),
(17, 6, 'GOURHATI MORE', 'gourhati-more', 16, '1', '2022-08-13 11:44:25', '2022-08-13 11:44:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_categories`
--

CREATE TABLE `up_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
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
(17, 'Stitch Graph', 'stitch-graph', 16, '1', '2022-05-16 07:37:32', '2022-06-01 11:42:28', NULL),
(18, 'test cat 1', 'test-cat-1', 17, '1', '2022-06-01 11:42:38', '2022-06-01 11:42:53', '2022-06-01 11:42:53'),
(19, 'Stitch Graph', 'stitch-graph-1', 17, '1', '2022-06-13 06:59:38', '2022-06-13 06:59:45', '2022-06-13 06:59:45'),
(20, 'Binding Book', 'binding-book', 17, '1', '2022-08-11 11:27:24', '2022-08-11 11:27:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_distribution_areas`
--

CREATE TABLE `up_distribution_areas` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `definition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_distribution_areas`
--

INSERT INTO `up_distribution_areas` (`id`, `title`, `definition`, `slug`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bagnan', NULL, 'bagnan', 0, '1', '2022-05-09 04:14:38', '2022-05-17 06:39:08', NULL),
(3, 'Barasat', NULL, 'barasat', 1, '1', '2022-05-09 06:33:21', '2022-05-17 12:08:41', NULL),
(4, 'Test Area 1', 'This is a test', 'test-area-1', 2, '1', '2022-06-01 11:37:30', '2022-06-01 11:49:42', '2022-06-01 11:49:42'),
(5, 'Kalna', 'Kalna', 'kalna', 2, '1', '2022-06-13 06:53:23', '2022-06-18 10:12:32', NULL),
(6, 'Arambagh', 'Champadanga to Bankura', 'arambagh', 3, '1', '2022-06-13 07:23:33', '2022-06-13 07:23:33', NULL),
(7, 'SRIRAMPUR', 'DEEPNARAYAN ENTERPRISE', 'srirampur', 4, '1', '2022-06-18 10:13:45', '2022-06-18 10:13:45', NULL),
(8, 'ANDUL', 'G.K. ENTERPRISE', 'andul', 5, '1', '2022-06-18 10:14:08', '2022-06-18 10:14:08', NULL),
(9, 'Dharsha', 'A.K. ENTERPRISE', 'dharsha', 6, '1', '2022-06-18 10:25:19', '2022-06-18 10:25:19', NULL),
(10, 'CHANDANNAGAR', 'R.D. TRADERS', 'chandannagar', 7, '1', '2022-06-18 10:25:44', '2022-06-18 10:25:44', NULL),
(11, 'KOLKATA CENTRAL', 'ALLIED STATIONERS', 'kolkata-central', 8, '1', '2022-06-18 10:26:11', '2022-06-18 10:26:11', NULL),
(12, 'BARANAGAR', 'DEY ENTERPRISE', 'baranagar', 9, '1', '2022-06-18 10:26:44', '2022-06-18 10:26:44', NULL),
(13, 'SAJIRHAT', 'SAYAN ENTERPRISE', 'sajirhat', 10, '1', '2022-06-18 10:27:18', '2022-06-18 10:27:18', NULL),
(14, 'DANKUNI ( CHANDITALLA)', 'NEW R.K. STORES', 'dankuni-chanditalla', 11, '1', '2022-06-18 10:28:16', '2022-06-18 10:28:16', NULL),
(15, 'Barrckpore', 'Asmita Traders', 'barrckpore', 12, '1', '2022-06-18 10:32:27', '2022-06-18 10:32:27', NULL),
(16, 'KANLA', 'DEEP ENTERPRISE', 'kanla', 13, '1', '2022-06-18 10:44:23', '2022-06-18 10:44:23', NULL),
(17, 'Tollygunge', 'Test1', 'tollygunge', 14, '1', '2022-08-11 10:26:41', '2022-08-11 11:51:55', NULL),
(18, 'College Street', 'Allied Stationary', 'college-street', 15, '1', '2022-08-11 11:18:28', '2022-08-11 11:18:28', NULL),
(19, 'BARABAZAR', 'BEGWANI DISTRIBUTORS', 'barabazar', 16, '1', '2022-08-11 12:03:37', '2022-08-11 12:03:37', NULL),
(20, 'BEHALA', 'BEHALA PAPER HOUSE', 'behala', 17, '1', '2022-08-12 10:47:45', '2022-08-12 10:47:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_grades`
--

CREATE TABLE `up_grades` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
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
  `why` text COLLATE utf8mb4_unicode_ci,
  `result` text COLLATE utf8mb4_unicode_ci,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_orders`
--

INSERT INTO `up_orders` (`id`, `seller_id`, `analysis_season_id`, `distribution_area_id`, `distributor_id`, `beat_id`, `store_id`, `analysis_date`, `analyses_id`, `category_id`, `product_id`, `qty`, `why`, `result`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 1, 3, 5, 2, 4, '2022-07-17 18:30:00', 1, 1, 1, 4, 'Test Why', 'Test Result', '1', '2022-07-22 04:59:27', '2022-07-25 01:36:16', NULL),
(3, 6, 1, 1, 3, 2, 3, '2022-07-24 18:30:00', 2, 1, 1, 5, 'This is why', 'This is result', '1', '2022-07-26 00:31:21', '2022-07-26 00:31:21', NULL),
(4, 9, 1, 5, 7, 3, 3, '2022-07-25 00:00:00', 2, 2, 4, 500, 'Test 1 Why 11', 'Test 1 Result 11', '1', '2022-07-26 09:46:17', '2022-07-26 10:00:43', NULL),
(5, 15, 1, 18, 14, 11, 21, '2022-08-09 00:00:00', 4, 20, 82, 6, 'Test 3', 'Test 4', '1', '2022-08-11 11:40:04', '2022-08-11 11:42:43', NULL),
(6, 15, 1, 18, 14, 11, 21, '2022-08-09 00:00:00', 4, 20, 82, 8, 'Test 5', 'Test 6', '1', '2022-08-11 11:41:40', '2022-08-11 11:41:40', NULL),
(7, 15, 1, 18, 14, 11, 21, '2022-08-09 00:00:00', 4, 20, 82, 10, 'dsfsdf', 'sdfsdfds', '1', '2022-08-11 12:48:46', '2022-08-11 12:48:46', NULL),
(10, 15, 1, 18, 14, 11, 21, '2022-08-09 00:00:00', 4, 3, 14, 12, 'order', 'done', '1', '2022-08-13 12:26:50', '2022-08-13 12:26:50', NULL);

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
  `rate_per_pcs` double(10,2) NOT NULL DEFAULT '0.00',
  `mrp` double(10,2) DEFAULT NULL,
  `retailer_price` double(10,2) DEFAULT NULL,
  `pack_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_products`
--

INSERT INTO `up_products` (`id`, `category_id`, `grade_id`, `title`, `slug`, `rate_per_pcs`, `mrp`, `retailer_price`, `pack_size`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 'Pioneer 100 Page A4', 'pioneer-100-page-a4', 27.00, 40.00, 33.00, NULL, 0, '1', '2022-05-17 04:24:55', '2022-07-26 07:58:35', NULL),
(2, 1, 1, 'Pioneer 144 Page A4', 'pioneer-144-page-a4', 36.00, 58.00, 52.00, NULL, 1, '1', '2022-05-17 05:01:00', '2022-07-26 07:58:26', NULL),
(3, 1, 2, 'Pioneer 200 Page A4', 'pioneer-200-page-a4', 45.00, 75.00, 60.00, NULL, 2, '1', '2022-05-17 05:01:13', '2022-07-26 07:58:19', NULL),
(4, 2, 1, 'G.B. 28 Page Drawing', 'gb-28-page-drawing', 8.00, NULL, 15.00, NULL, 3, '1', '2022-05-17 05:02:06', '2022-07-26 07:58:42', NULL),
(5, 2, 2, 'G.B. 4 No Drawing', 'gb-4-no-drawing', 17.00, 34.00, 25.00, NULL, 4, '1', '2022-05-17 05:02:21', '2022-07-26 07:55:08', NULL),
(6, 3, 2, 'Pioneer 4 No Drawing', 'pioneer-4-no-drawing', 24.83, 43.00, 32.00, NULL, 5, '1', '2022-05-17 05:02:41', '2022-07-26 07:55:15', NULL),
(7, 3, 2, 'Pioneer 40 Page 11x15 Drawing', 'pioneer-40-page-11x15-drawing', 36.00, 60.00, 45.00, NULL, 6, '1', '2022-05-17 05:02:55', '2022-07-26 07:55:23', NULL),
(8, 3, 2, 'Pioneer 40 Page Spiral Drawing 120 GSM', 'pioneer-40-page-spiral-drawing-120-gsm', 43.08, NULL, 49.00, NULL, 7, '1', '2022-05-17 05:03:09', '2022-07-26 07:55:31', NULL),
(9, 3, 1, 'Pioneer 40 Page Spiral Drawing 140 GSM', 'pioneer-40-page-spiral-drawing-140-gsm', 55.00, NULL, 75.00, NULL, 8, '1', '2022-05-17 05:03:21', '2022-07-26 07:55:38', NULL),
(10, 3, 1, 'Pioneer 48 Page Drawing', 'pioneer-48-page-drawing', 17.50, 29.00, 25.00, NULL, 9, '1', '2022-05-17 05:03:35', '2022-07-26 07:55:45', NULL),
(11, 3, 2, 'Pioneer 4no 11x15 Drawing', 'pioneer-4no-11x15-drawing', 57.75, 90.00, 75.00, NULL, 10, '1', '2022-05-17 05:04:00', '2022-07-26 07:55:52', NULL),
(12, 3, 1, 'Pioneer 6 No Drawing', 'pioneer-6-no-drawing', 38.08, 55.00, 45.00, NULL, 11, '1', '2022-05-17 05:04:17', '2022-07-26 07:55:58', NULL),
(13, 3, 2, 'Pioneer 6no 11x15 Drawing', 'pioneer-6no-11x15-drawing', 87.75, 135.00, 95.00, NULL, 12, '1', '2022-05-17 05:04:35', '2022-07-26 07:56:07', NULL),
(14, 3, 2, 'Pioneer 8 No Drawing', 'pioneer-8-no-drawing', 49.67, 71.00, 65.00, NULL, 13, '1', '2022-05-17 05:04:53', '2022-07-26 07:56:14', NULL),
(15, 4, 1, 'G.B. Lab Board', 'gb-lab-board', 14.58, 25.00, 22.00, NULL, 14, '1', '2022-05-17 05:05:17', '2022-07-26 07:56:21', NULL),
(16, 4, 1, 'G.B. Loose Sheet', 'gb-loose-sheet', 12.08, NULL, 18.00, NULL, 15, '1', '2022-05-17 05:05:30', '2022-07-26 07:56:27', NULL),
(17, 5, 2, 'Pioneer 10 No long Bound', 'pioneer-10-no-long-bound', 113.00, 160.00, 135.00, NULL, 16, '1', '2022-05-17 05:05:50', '2022-07-26 07:56:36', NULL),
(18, 5, 3, 'Pioneer 10 no SPL Long Bound (Case Binding)', 'pioneer-10-no-spl-long-bound-case-binding', 121.75, 208.00, 180.00, NULL, 17, '1', '2022-05-17 05:06:10', '2022-07-26 07:56:43', NULL),
(19, 5, 2, 'Pioneer 12 No Long Bound', 'pioneer-12-no-long-bound', 133.50, 200.00, 175.00, NULL, 18, '1', '2022-05-17 05:06:27', '2022-07-26 07:56:50', NULL),
(20, 5, 1, 'Pioneer 12 No SPL Long Bound (Case Binding)', 'pioneer-12-no-spl-long-bound-case-binding', 141.25, NULL, 180.00, NULL, 19, '1', '2022-05-17 05:06:45', '2022-07-26 07:56:57', NULL),
(21, 5, 2, 'Pioneer 4 No Long Bound', 'pioneer-4-no-long-bound', 51.33, 80.00, 75.00, NULL, 20, '1', '2022-05-17 05:07:05', '2022-07-26 07:57:05', NULL),
(22, 5, 2, 'Pioneer 6 No Long Bound', 'pioneer-6-no-long-bound', 71.92, 112.00, 92.00, NULL, 21, '1', '2022-05-17 05:07:26', '2022-07-26 07:57:13', NULL),
(23, 5, 1, 'Pioneer 8 No Long Bound', 'pioneer-8-no-long-bound', 92.42, 124.00, 100.00, NULL, 22, '1', '2022-05-17 05:07:48', '2022-07-26 07:57:20', NULL),
(24, 6, 1, 'Pioneer 240 Page 17x27', 'pioneer-240-page-17x27', 65.50, 105.00, 85.00, NULL, 23, '1', '2022-05-17 05:08:05', '2022-07-26 07:57:30', NULL),
(25, 6, 1, 'Pioneer 320 Page 17x27', 'pioneer-320-page-17x27', 90.17, 140.00, 125.00, NULL, 24, '1', '2022-05-17 05:08:24', '2022-07-26 07:57:37', NULL),
(26, 7, 1, 'G.B. 120 Page (15x25)', 'gb-120-page-15x25', 18.00, 35.00, 28.00, NULL, 25, '1', '2022-05-17 05:08:39', '2022-07-26 07:57:44', NULL),
(27, 7, 2, 'G.B. 120 Page (17x27)', 'gb-120-page-17x27', 26.00, 37.00, 32.00, NULL, 26, '1', '2022-05-17 05:09:05', '2022-07-26 07:57:51', NULL),
(28, 7, 2, 'G.B. 152 Page ( 15x25)', 'gb-152-page-15x25', 20.00, 45.00, 33.00, NULL, 27, '1', '2022-05-17 05:09:18', '2022-07-26 07:57:57', NULL),
(29, 7, 2, 'G.B. 160 Page (17x27)', 'gb-160-page-17x27', 30.00, 53.00, 45.00, NULL, 28, '1', '2022-05-17 05:09:31', '2022-07-26 07:54:58', NULL),
(30, 7, 1, 'G.B. 240 Page (17x27)', 'gb-240-page-17x27', 55.00, 80.00, 75.00, NULL, 29, '1', '2022-05-17 05:09:45', '2022-07-26 07:53:45', NULL),
(31, 7, 2, 'G.B. 60 Page Long ( 15x25)', 'gb-60-page-long-15x25', 8.33, NULL, 15.50, NULL, 30, '1', '2022-05-17 05:09:59', '2022-07-26 07:53:37', NULL),
(32, 7, 2, 'G.B. 80 Page (17x27)', 'gb-80-page-17x27', 17.58, 30.00, 25.00, NULL, 31, '1', '2022-05-17 05:10:12', '2022-07-26 07:53:30', NULL),
(33, 7, 2, 'Pioneer 100 Page Long Book(17x27)', 'pioneer-100-page-long-book17x27', 27.00, 45.00, 34.00, NULL, 32, '1', '2022-05-17 05:10:26', '2022-07-26 07:53:22', NULL),
(34, 7, 2, 'Pioneer 132 Page Long Book (15x25)', 'pioneer-132-page-long-book-15x25', 27.00, 42.00, 35.00, NULL, 33, '1', '2022-05-17 05:10:44', '2022-07-26 07:53:13', NULL),
(35, 7, 3, 'Pioneer 132 Page Long Book(17x27)', 'pioneer-132-page-long-book17x27', 36.50, 57.00, 52.50, NULL, 34, '1', '2022-05-17 05:11:04', '2022-07-26 07:53:02', NULL),
(36, 7, 2, 'Pioneer 160 Page Long Book (17x27)', 'pioneer-160-page-long-book-17x27', 43.75, 70.00, 55.00, NULL, 35, '1', '2022-05-17 05:11:23', '2022-07-26 07:52:51', NULL),
(37, 7, 3, 'Pioneer 80 Page Long Book (17x27)', 'pioneer-80-page-long-book-17x27', 26.00, 40.00, 35.00, NULL, 36, '1', '2022-05-17 05:11:49', '2022-07-26 07:52:43', NULL),
(38, 8, 1, 'Pioneer 10 No Note Book', 'pioneer-10-no-note-book', 26.08, 43.00, 37.50, NULL, 37, '1', '2022-05-17 05:12:05', '2022-07-26 07:52:36', NULL),
(39, 8, 1, 'Pioneer 12 No Note Book', 'pioneer-12-no-note-book', 30.58, 52.00, 45.50, NULL, 38, '1', '2022-05-17 05:12:23', '2022-07-26 07:52:26', NULL),
(40, 8, 1, 'Pioneer 4 No Note Book', 'pioneer-4-no-note-book', 10.83, 20.00, 15.00, NULL, 39, '1', '2022-05-17 05:12:39', '2022-07-26 07:52:18', NULL),
(41, 8, 1, 'Pioneer 6 No Note Book', 'pioneer-6-no-note-book', 15.67, 27.00, 23.00, NULL, 40, '1', '2022-05-17 05:12:55', '2022-07-26 07:52:10', NULL),
(42, 8, 1, 'Pioneer 8 No Note Book', 'pioneer-8-no-note-book', 21.08, 35.00, 30.00, NULL, 41, '1', '2022-05-17 05:13:12', '2022-07-26 07:52:03', NULL),
(43, 9, 1, 'Pioneer 112 Page Practical', 'pioneer-112-page-practical', 47.83, 80.00, 60.50, NULL, 42, '1', '2022-05-17 05:13:40', '2022-07-26 07:51:56', NULL),
(44, 9, 2, 'Pioneer 160 Page Practical', 'pioneer-160-page-practical', 64.83, 110.00, 80.50, NULL, 43, '1', '2022-05-17 05:13:58', '2022-07-26 07:51:47', NULL),
(45, 9, 3, 'Pioneer 192 Page Practical', 'pioneer-192-page-practical', 70.58, NULL, 90.00, NULL, 44, '1', '2022-05-17 05:14:12', '2022-07-26 07:51:37', NULL),
(46, 9, 2, 'Pioneer 256 Page Practical', 'pioneer-256-page-practical', 93.75, NULL, 120.00, NULL, 45, '1', '2022-05-17 05:14:31', '2022-07-26 07:51:29', NULL),
(47, 9, 1, 'Pioneer 80 Page Practical', 'pioneer-80-page-practical', 37.83, 63.00, 50.00, NULL, 46, '1', '2022-05-17 05:14:51', '2022-07-26 07:51:17', NULL),
(48, 10, 1, 'Dista 16x26', 'dista-16x26', 13.50, NULL, 20.00, NULL, 47, '1', '2022-05-17 05:16:33', '2022-07-26 07:51:02', NULL),
(49, 10, 2, 'Pioneer Dista Ream (17x27)', 'pioneer-dista-ream-17x27', 24.60, NULL, 30.50, NULL, 48, '1', '2022-05-17 05:16:47', '2022-07-26 07:50:55', NULL),
(50, 11, 1, 'Pioneer 10 No Small Bound', 'pioneer-10-no-small-bound', 59.00, 105.00, 90.50, NULL, 49, '1', '2022-05-17 05:17:19', '2022-07-26 07:50:44', NULL),
(51, 11, 1, 'Pioneer 12 No Small Bound', 'pioneer-12-no-small-bound', 69.67, 125.00, 80.50, NULL, 50, '1', '2022-05-17 05:17:55', '2022-07-26 07:50:36', NULL),
(52, 11, 1, 'Pioneer 4 No Small Bound', 'pioneer-4-no-small-bound', 27.08, 47.00, 43.00, NULL, 51, '1', '2022-05-17 05:18:18', '2022-07-26 07:50:27', NULL),
(53, 11, 1, 'Pioneer 4 No Small Bound Prac', 'pioneer-4-no-small-bound-prac', 29.92, NULL, 45.50, NULL, 52, '1', '2022-05-17 05:18:34', '2022-07-26 07:50:14', NULL),
(54, 11, 1, 'Pioneer 6 No Small Bound', 'pioneer-6-no-small-bound', 37.75, 63.00, 55.50, NULL, 53, '1', '2022-05-17 05:18:51', '2022-07-26 07:50:04', NULL),
(55, 11, 1, 'Pioneer 8 No Small Bound', 'pioneer-8-no-small-bound', 48.42, 90.00, 60.00, NULL, 54, '1', '2022-05-17 05:19:07', '2022-07-26 07:48:29', NULL),
(56, 12, 1, 'G.B. 100 Page Stitch', 'gb-100-page-stitch', 11.33, 21.00, 18.50, NULL, 55, '1', '2022-05-17 05:19:23', '2022-07-26 07:48:06', NULL),
(57, 12, 2, 'G.B. 128 Page Stitch', 'gb-128-page-stitch', 15.50, 28.00, 23.00, NULL, 56, '1', '2022-05-17 05:19:41', '2022-07-26 07:47:58', NULL),
(58, 12, 2, 'G.B. 60 Page stitch', 'gb-60-page-stitch', 6.50, 10.00, 8.00, NULL, 57, '1', '2022-05-17 05:20:03', '2022-07-26 07:47:50', NULL),
(59, 12, 1, 'Pioneer 100 Page Stitch', 'pioneer-100-page-stitch', 15.92, 29.00, 25.00, NULL, 58, '1', '2022-05-17 05:20:17', '2022-07-26 07:47:41', NULL),
(60, 12, 1, 'Pioneer 132 Page Stitch', 'pioneer-132-page-stitch', 20.75, 37.00, 30.00, NULL, 59, '1', '2022-05-17 05:20:39', '2022-07-26 07:47:32', NULL),
(61, 12, 1, 'Pioneer 68 Page Stitch', 'pioneer-68-page-stitch', 10.00, 19.00, 15.00, NULL, 60, '1', '2022-05-17 05:20:51', '2022-07-26 07:47:26', NULL),
(62, 13, 1, 'A4-Bright Craft Paper', 'a4-bright-craft-paper', 87.00, NULL, 100.00, NULL, 61, '1', '2022-05-17 05:21:12', '2022-07-26 07:47:19', NULL),
(63, 13, 1, 'A5 Five Subject Note Book', 'a5-five-subject-note-book', 100.00, NULL, 120.00, NULL, 62, '1', '2022-05-17 05:21:25', '2022-07-26 07:47:13', NULL),
(64, 13, 1, 'A5 One Subject Note Book', 'a5-one-subject-note-book', 61.00, NULL, 70.00, NULL, 63, '1', '2022-05-17 05:21:35', '2022-07-26 07:47:06', NULL),
(65, 13, 1, 'B5 One Subject NoteBook', 'b5-one-subject-notebook', 78.00, NULL, 95.00, NULL, 64, '1', '2022-05-17 05:21:46', '2022-07-26 07:46:58', NULL),
(66, 13, 1, 'Colour Paper ( 22 x 30)', 'colour-paper-22-x-30', 776.00, NULL, 900.00, NULL, 65, '1', '2022-05-17 05:21:59', '2022-07-26 07:46:50', NULL),
(67, 14, 1, 'Pioneer Lab Note Book SPL', 'pioneer-lab-note-book-spl', 19.83, 32.00, 25.00, NULL, 66, '1', '2022-05-17 05:22:15', '2022-07-26 07:45:11', NULL),
(68, 14, 1, 'Pioneer Lab Note Book T.P.', 'pioneer-lab-note-book-tp', 34.58, 53.00, 45.00, NULL, 67, '1', '2022-05-17 05:22:35', '2022-07-26 07:45:02', NULL),
(69, 14, 1, 'Pioneer Loose Sheet', 'pioneer-loose-sheet', 16.67, NULL, 20.00, NULL, 68, '1', '2022-05-17 05:22:48', '2022-07-26 07:44:54', NULL),
(70, 14, 1, 'Pioneer Loose Sheet T.P.  & S.P.', 'pioneer-loose-sheet-tp-sp', 16.67, NULL, 20.00, NULL, 69, '1', '2022-05-17 05:23:01', '2022-07-26 07:44:41', NULL),
(71, 15, 1, 'G.B. 120 Page D.C. Power', 'gb-120-page-dc-power', 15.00, NULL, 18.00, NULL, 70, '1', '2022-05-17 05:23:19', '2022-07-26 07:44:34', NULL),
(72, 15, 1, 'G.B. 60 Page D.C. Power', 'gb-60-page-dc-power', 8.17, 15.00, 12.00, NULL, 71, '1', '2022-05-17 05:23:34', '2022-07-26 07:44:24', NULL),
(73, 16, 1, 'Pioneer 100 Page D.C.', 'pioneer-100-page-dc', 18.00, 33.00, 25.00, NULL, 72, '1', '2022-05-17 05:23:49', '2022-07-26 07:44:16', NULL),
(74, 16, 1, 'Pioneer 120 Page D.C.', 'pioneer-120-page-dc', 22.50, 38.00, 30.00, NULL, 73, '1', '2022-05-17 05:24:02', '2022-07-26 07:44:00', NULL),
(75, 16, 2, 'Pioneer 180 Page D.C.', 'pioneer-180-page-dc', 35.00, 55.00, 40.00, NULL, 74, '1', '2022-05-17 05:24:31', '2022-07-26 07:43:50', NULL),
(76, 16, 1, 'Pioneer 36 Page Scrap', 'pioneer-36-page-scrap', 36.08, 70.00, 50.00, NULL, 75, '1', '2022-05-17 05:24:55', '2022-07-26 07:43:43', NULL),
(77, 17, 2, 'Pioneer 2No St. Graph', 'pioneer-2no-st-graph', 9.50, 14.00, 12.00, NULL, 76, '1', '2022-05-17 05:25:10', '2022-07-26 07:43:36', NULL),
(78, 17, 3, 'Pioneer 44Page Big Graph', 'pioneer-44page-big-graph', 22.42, 38.00, 25.00, NULL, 77, '1', '2022-05-17 05:25:31', '2022-07-26 07:43:24', NULL),
(79, 17, 1, 'Pioneer 4No. St. Graph', 'pioneer-4no-st-graph', 13.42, 20.00, 15.00, NULL, 78, '1', '2022-05-17 05:25:47', '2022-08-11 12:14:16', NULL),
(80, 1, NULL, 'test note book', NULL, 7.50, 12.00, NULL, NULL, 79, '1', '2022-06-01 11:44:35', '2022-06-01 11:45:33', '2022-06-01 11:45:33'),
(81, 2, 1, '200 Pages Drawing Book', '200-pages-drawing-book', 250.00, 300.00, 280.00, '10', 79, '1', '2022-08-11 10:49:02', '2022-08-11 10:50:23', NULL),
(82, 20, 1, '100 Page Binding Book', '100-page-binding-book', 500.00, 600.00, 550.00, '12', 80, '1', '2022-08-11 11:28:00', '2022-08-11 11:28:00', NULL);

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_roles`
--

INSERT INTO `up_roles` (`id`, `name`, `slug`, `is_admin`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'super-admin', '1', '1', '2022-05-06 07:39:45', '2022-06-24 08:27:38', NULL),
(2, 'Distributor', 'distributor', '1', '1', '2022-05-25 23:52:00', '2022-07-25 23:46:29', NULL),
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
(74, 'order.delete'),
(75, 'order.view');

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
(2, 55),
(2, 56),
(2, 57),
(2, 58),
(2, 59),
(2, 60),
(2, 61),
(2, 62),
(2, 72),
(2, 73),
(2, 75),
(2, 74),
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
  `sort` int(11) NOT NULL DEFAULT '0',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
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
  `street` text COLLATE utf8mb4_unicode_ci,
  `district_region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `beat_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `beat_id` int(11) DEFAULT NULL COMMENT 'Id from beats table',
  `grade_id` int(11) DEFAULT NULL COMMENT 'Id from grades table',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_size_category` enum('S','M','L') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S' COMMENT 'S=>Small, M=>Medium, L=>Large',
  `integrity` enum('A+','A','B','B-','C') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A+' COMMENT 'A+=>A+, A=>A, B=>B, B-=>B-, C=>C',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `sort` int(11) NOT NULL DEFAULT '0',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `progress_status` enum('IP','CP') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'IP' COMMENT 'IP=>In-Progress, CP=>Complete',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_stores`
--

INSERT INTO `up_stores` (`id`, `distribution_area_id`, `name_1`, `name_2`, `store_name`, `slug`, `phone_no_1`, `whatsapp_no_1`, `phone_no_2`, `whatsapp_no_2`, `street`, `district_region`, `zip`, `beat_name`, `beat_id`, `grade_id`, `email`, `sale_size_category`, `integrity`, `notes`, `sort`, `status`, `progress_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 'Store Name 11', 'Store Name 2', 'Dipankar Stores', 'dipankar-stores', '987543210', '9876543211', '9876543212', '9876543213', 'M.G. Road', 'Kolkata', '700033', NULL, 1, 2, 'dipankarstores@yopmail.com', 'L', 'A', 'Test notes.', 0, '1', 'IP', '2022-05-13 04:39:17', '2022-08-01 05:58:29', NULL),
(3, 5, 'BABU', NULL, 'TWINKLE STORES', 'twinkle-stores', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, NULL, 'L', 'A', NULL, 1, '1', 'IP', '2022-06-18 10:47:06', '2022-07-26 07:27:12', NULL),
(4, 5, 'DADA', NULL, 'ACADEMY', 'academy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, 'M', 'B', NULL, 2, '1', 'IP', '2022-06-18 10:56:02', '2022-07-26 07:27:28', NULL),
(5, 6, 'Dipankar Dutta', NULL, 'Srijita Enterprise', 'srijita-enterprise', '7585016565', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, NULL, 'S', 'B', NULL, 3, '1', 'IP', '2022-06-18 10:57:38', '2022-07-26 07:28:49', NULL),
(6, 5, 'CHOUTU DA', NULL, 'BIDAMANDIR', 'bidamandir', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, NULL, 'M', 'A', NULL, 4, '1', 'IP', '2022-06-18 10:58:47', '2022-07-26 07:29:09', NULL),
(7, 6, 'Dasurathi Khanra', NULL, 'Kalimata Pustakalaya', 'kalimata-pustakalaya', '8145416694', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, NULL, 'M', 'A', NULL, 5, '1', 'IP', '2022-06-18 11:01:54', '2022-07-26 07:29:34', NULL),
(8, 5, 'BAPI', NULL, 'DEY PAPER &PRESATION CENTRE', 'dey-paper-presation-centre', NULL, '9333155088', NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, NULL, 'M', 'A', NULL, 6, '1', 'IP', '2022-06-18 11:02:59', '2022-07-26 07:29:50', NULL),
(9, 5, 'ALOK SAHA', NULL, 'PAPER HOUSE', 'paper-house', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NAWADIP DHAM', 4, 1, NULL, 'L', 'A+', NULL, 7, '1', 'IP', '2022-06-18 11:04:33', '2022-07-26 07:32:00', NULL),
(10, 6, 'Arun Pal', NULL, 'Arun Pal', 'arun-pal', '9434503994', NULL, NULL, NULL, NULL, NULL, NULL, 'Champaadanga', 5, 1, NULL, 'S', 'B', NULL, 8, '1', 'IP', '2022-06-18 11:06:34', '2022-07-26 07:32:14', NULL),
(11, 5, 'A', NULL, 'PAPER CORNER', 'paper-corner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NAWADIP DHAM', 4, 1, NULL, 'M', 'A', NULL, 9, '1', 'IP', '2022-06-18 11:07:37', '2022-07-26 07:32:36', NULL),
(12, 6, 'Dibakar Pal', NULL, 'Dibakar Pal', 'dibakar-pal', '9734681542', NULL, NULL, NULL, NULL, NULL, NULL, 'Champadanga', 5, 1, NULL, 'S', 'B', NULL, 10, '1', 'IP', '2022-06-18 11:09:10', '2022-07-26 07:32:54', NULL),
(13, 5, 'N', NULL, 'NETAJI LIABARY', 'netaji-liabary', '9800405520', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'M', 'A', NULL, 11, '1', 'IP', '2022-06-18 11:09:24', '2022-07-26 07:33:20', NULL),
(14, 5, 'KAMAL DA', NULL, 'CHATRABANDHU', 'chatrabandhu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MEMARI', 7, 1, NULL, 'S', 'A', NULL, 12, '1', 'IP', '2022-06-18 12:15:38', '2022-07-26 07:33:45', NULL),
(15, 6, 'Rajib Pal', NULL, 'Paul Paper House', 'paul-paper-house', '9474498798', NULL, NULL, NULL, NULL, NULL, NULL, 'Champadanga', 5, 1, NULL, 'S', 'B', NULL, 13, '1', 'IP', '2022-06-18 12:16:42', '2022-07-26 07:33:58', NULL),
(16, 5, 'JEEVAN KAKU', NULL, 'JEEVAN ENTERPRICE', 'jeevan-enterprice', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 1, NULL, 'S', 'B', NULL, 14, '1', 'IP', '2022-06-18 12:23:41', '2022-07-26 07:34:15', NULL),
(17, 5, 'LALJI', NULL, 'LALAJI PUSTAKLAY', 'lalaji-pustaklay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KALNA', 1, 1, NULL, 'L', 'A', NULL, 15, '1', 'IP', '2022-06-18 12:25:51', '2022-07-26 07:34:34', NULL),
(18, 5, 'B', NULL, 'MON', 'mon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, 'S', 'A+', NULL, 16, '1', 'IP', '2022-06-18 12:31:09', '2022-07-26 07:34:53', NULL),
(19, 6, 'Bechitra', NULL, 'Ujjwal Bera', 'ujjwal-bera', '9932486152', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, 'S', 'B', NULL, 17, '1', 'IP', '2022-06-18 12:33:55', '2022-07-26 07:35:11', NULL),
(20, 5, 'BABU. New', NULL, 'MONORAMA PUSTAKALAYA', 'monorama-pustakalaya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SATGACHIYA', 6, 2, NULL, 'M', 'A', NULL, 18, '1', 'IP', '2022-06-18 12:38:48', '2022-08-11 10:54:10', NULL),
(21, 18, 'Chaya', NULL, 'Chaya Store', 'chaya-store', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, 1, 'chaya@gmail.com', 'M', 'A+', NULL, 19, '1', 'IP', '2022-08-11 11:25:07', '2022-08-11 11:25:07', NULL),
(22, 3, 'LALAN SAHA', NULL, 'SAHA ENTERPRISE', 'saha-enterprise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, NULL, NULL, 'S', 'A+', NULL, 20, '1', 'IP', '2022-08-13 11:42:41', '2022-08-13 11:42:41', NULL),
(23, 6, 'SURAJIT NATH', NULL, 'SAKUNTALA', 'sakuntala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, NULL, NULL, 'S', 'A+', NULL, 21, '1', 'IP', '2022-08-13 11:46:21', '2022-08-13 11:46:21', NULL);

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_users`
--

INSERT INTO `up_users` (`id`, `job_title_1`, `nickname`, `title`, `first_name`, `last_name`, `full_name`, `username`, `email`, `company`, `phone_no`, `password`, `profile_pic`, `gender`, `dob`, `distribution_area_id`, `role_id`, `remember_token`, `auth_token`, `type`, `agree`, `status`, `lastlogintime`, `sample_login_show`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, NULL, 'John', 'Doe', 'John Doe', 'johndoe', 'admin@admin.com', NULL, '9876543210', '$2y$10$RFGYQLaP8sI212TKj0CY0uxRR2OENt.2PsiFKxQedSbUXSmPANeQq', '', 'M', NULL, NULL, 1, NULL, NULL, 'SA', 'Y', '1', 1661152612, 'Y', '2022-05-06 07:39:45', '2022-08-22 07:16:52', NULL),
(3, 'Owner', NULL, NULL, 'Tibrewalla', 'Agarwal', 'Tibrewalla Agarwal', 'tibrewalla', 'info@lionsbbdbagbloodbank.org', 'Marwari Relief Society', '2274 5675', '$2y$10$0hd/hA0IA0zRWkIOP6gG1uaYK27jdvAnWNaf7XbMavBBah7r9Ld8y', 'admin_user_1653979426.png', 'M', NULL, 1, NULL, NULL, NULL, 'D', 'Y', '1', 1655384811, 'N', '2022-05-09 06:16:32', '2022-06-22 09:06:37', '2022-06-22 09:06:37'),
(4, 'Owner', NULL, NULL, 'Rohan', 'Dhar', 'Rohan Dhar', 'mahendra', 'mahendra@yopmail.com', 'Dhar Distributor', '8777271379', '$2y$10$QmoJYggTN670P.nJKSQxC..MdbtEEw2DLtw7RmDfnExZxjzSJsB5C', 'admin_user_1653979471.png', 'M', NULL, 3, NULL, NULL, NULL, 'D', 'Y', '1', 1657267291, 'N', '2022-05-26 05:32:09', '2022-08-12 10:53:37', NULL),
(5, 'Wholesaler 1', NULL, NULL, 'Test', 'Seller', 'Test Seller 1', 'TestUser', 'testuser@yopmail.com', 'Test Company', NULL, '$2y$10$Z9aga2Ycwa6NBKW775OEFe4xuWAsccOd/kJedWsH.voH1OXftkSF6', '', 'M', NULL, 4, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-06-01 11:40:16', '2022-06-01 11:45:52', '2022-06-01 11:45:52'),
(6, 'Owner', NULL, NULL, 'SK', 'Abbash', 'SK Abbash Ahammed', 'ANIKA', 'anika@gmail.com', 'Anika Enterprise', NULL, '$2y$10$3yvc03ykb77.n9SPKPkHwuq6gJXg8xtO5OkaY9ce48Iw5W5xUGSK2', '', 'M', NULL, 6, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-06-13 07:27:21', '2022-08-13 11:48:18', NULL),
(7, 'Manager', NULL, NULL, 'Manish', 'Bera', 'Manish Bera', 'manishbera', 'manishbera@yopmail.com', 'VPW', NULL, '$2y$10$FUnvCn6w1SKEPjL0lInNoekDOMa2qsPwEcQGRvjFeSN2QSnsK/WV6', '', 'M', NULL, 5, NULL, NULL, NULL, 'D', 'Y', '1', 1660215674, 'N', '2022-07-26 09:34:48', '2022-08-11 11:01:14', NULL),
(8, NULL, NULL, NULL, 'Sanjoy', 'Kayal', 'Sanjoy Kayal', 'sanjoykayal', 'sanjoykayal@yopmail.com', NULL, NULL, '$2y$10$8oQRLOJxHWM2xhtcXJv4EOFPOEEUZw.8n5QC./62.Q/S6ptbtCkta', '', 'M', NULL, NULL, NULL, NULL, NULL, '', 'Y', '1', NULL, 'N', '2022-07-26 09:36:04', '2022-07-26 09:36:04', NULL),
(9, NULL, NULL, NULL, 'Joy', 'Paul', 'Joy Paul', 'joypaul', 'joypaul@yopmail.com', NULL, NULL, '$2y$10$LtgEjejpTWgjinzJ4s59kunYp3eG14FE5/lnUCfSH.CPGhZd4Cgaq', '', 'M', NULL, NULL, NULL, NULL, NULL, 'S', 'Y', '1', 1660215614, 'N', '2022-07-26 09:39:32', '2022-08-11 11:00:14', NULL),
(10, NULL, NULL, NULL, 'Joydip', 'Hazra', 'Joydip Hazra', 'joydip', 'joydip@yopmail.com', NULL, '8335845554', '$2y$10$qMCO0q0n6eDSeTI/TjwAwuu5/SQeOXrK3k3t1xf1mvOR3W8TeozDS', '', 'M', NULL, NULL, NULL, NULL, NULL, 'S', 'Y', '1', 1658996131, 'N', '2022-07-28 08:00:49', '2022-07-28 08:15:31', NULL),
(11, NULL, NULL, NULL, 'uttam', NULL, 'uttam', 'uttam123', 'uttam@gmail.com', NULL, NULL, '$2y$10$eTpZpPkDoHjxGaRWTPBSmuydYzxBIGodHzsHdbO3n/oY7J4PQKvmC', '', 'M', NULL, NULL, NULL, NULL, NULL, 'S', 'Y', '1', 1659595170, 'N', '2022-08-04 06:39:03', '2022-08-04 06:39:30', NULL),
(12, 'Director', NULL, NULL, 'Partha', 'Chopra', 'Partha Chopra', 'partha', 'partha@gmail.com', 'Pioneer', NULL, '$2y$10$1rxwyDT8aNab1mckPBnaGu.y46blYuPHVmJeseABXJAVqG7stgR9i', 'distributor_1660216139.jpg', 'M', NULL, 17, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-11 11:09:01', '2022-08-11 11:09:01', NULL),
(13, NULL, NULL, NULL, 'Kumar', 'Singh', 'Kumar Singh', 'kumar', 'kumar@gmail.com', NULL, '9876543210', '$2y$10$pJxn41bH8KIRB0uJw6Qzn.VWl8nnBi0EOSbW68yl9hyl1ynOusDDu', '', 'M', NULL, NULL, NULL, NULL, NULL, 'S', 'Y', '1', NULL, 'N', '2022-08-11 11:13:25', '2022-08-11 11:13:25', NULL),
(14, 'Owner', NULL, NULL, 'Kamlesh', 'Bera', 'Kamlesh Bera', 'kamlesh', 'kamlesh@gmail.com', 'Allied Stationary', NULL, '$2y$10$bbSR.hzSSibA90RvWBt.hecABEj9Sbhnuu5nc.6Nz6tg.bLhUZNpK', '', 'M', NULL, 18, NULL, NULL, NULL, 'D', 'Y', '1', 1660394007, 'N', '2022-08-11 11:20:01', '2022-08-13 12:33:27', NULL),
(15, NULL, NULL, NULL, 'Rajveer', 'Singh', 'Rajveer Singh', 'rajendra', 'rajveer@gmail.com', NULL, '8272927232', '$2y$10$RFGYQLaP8sI212TKj0CY0uxRR2OENt.2PsiFKxQedSbUXSmPANeQq', '', 'M', NULL, NULL, NULL, NULL, NULL, 'S', 'Y', '1', 1660393916, 'N', '2022-08-11 11:21:59', '2022-08-13 12:31:56', NULL),
(16, NULL, NULL, NULL, 'Jinia', 'Paul', 'Jinia Paul', 'jinia', 'jinia@yopmail.com', NULL, NULL, '$2y$10$sHAXmSMurNAqb8.cu9zb9O5h6iznZXOD95IMjU0RNaGc33fyYE6l6', '', 'M', NULL, NULL, NULL, NULL, NULL, 'S', 'Y', '1', 1660221999, 'N', '2022-08-11 11:53:27', '2022-08-11 12:46:39', NULL),
(17, 'OWNER', NULL, NULL, 'KAILASH', 'BEGWANI', 'KAILASH BEGWANI', 'KAILASH', 'kailash@gmail.com', 'BEGWANI DISTRIBUTOR', NULL, '$2y$10$HwSWK6VN7AqNxTL2i52ey.nh6G2jy6dNR5tnah6jLP3wQVM/ORUD.', '', 'M', NULL, 19, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-11 12:09:10', '2022-08-11 12:09:10', NULL);

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
  `street` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'City',
  `district_region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'District/Region',
  `state_province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'State/Province',
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Zip',
  `notes` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_user_details`
--

INSERT INTO `up_user_details` (`id`, `user_id`, `job_title_2`, `full_name_2`, `phone_no_2`, `whatsapp_no`, `street`, `city`, `district_region`, `state_province`, `zip`, `notes`) VALUES
(1, 3, 'Job Title 2', 'Pawan', NULL, '9876543210', '225/227,  Rabindra Sarani Barabazar H.O.', 'Kolkata', 'South 24 Parganas', 'West Bengal', '700007', 'Test Notes'),
(2, 4, NULL, NULL, NULL, NULL, '225/227,  Rabindra Sarani Barabazar H.O.', 'Kolkata', 'South 24 Parganas', 'West Bengal', '700007', 'Testing'),
(3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 17, NULL, NULL, '8910202348', '8910202348', NULL, 'KOLKATA', 'KOLKATA', 'WEST BENGAL', NULL, NULL);

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
(6, 1),
(6, 3),
(8, 1),
(8, 3),
(8, 15),
(9, 1),
(9, 3),
(9, 15),
(9, 5),
(9, 16),
(10, 6),
(11, 6),
(11, 7),
(13, 17),
(16, 6),
(15, 19),
(15, 18);

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
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 2),
(13, 3),
(14, 2),
(15, 3),
(16, 3),
(17, 2);

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
  `default_meta_title` text COLLATE utf8mb4_unicode_ci,
  `default_meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `default_meta_description` text COLLATE utf8mb4_unicode_ci,
  `address` text COLLATE utf8mb4_unicode_ci,
  `map` text COLLATE utf8mb4_unicode_ci,
  `footer_address` text COLLATE utf8mb4_unicode_ci,
  `copyright_text` text COLLATE utf8mb4_unicode_ci,
  `tag_line` text COLLATE utf8mb4_unicode_ci,
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `up_analyses_details`
--
ALTER TABLE `up_analyses_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `up_analysis_seasons`
--
ALTER TABLE `up_analysis_seasons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `up_area_analyses`
--
ALTER TABLE `up_area_analyses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `up_area_analysis_details`
--
ALTER TABLE `up_area_analysis_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `up_beats`
--
ALTER TABLE `up_beats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `up_categories`
--
ALTER TABLE `up_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `up_distribution_areas`
--
ALTER TABLE `up_distribution_areas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `up_products`
--
ALTER TABLE `up_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `up_roles`
--
ALTER TABLE `up_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `up_role_pages`
--
ALTER TABLE `up_role_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `up_seasons`
--
ALTER TABLE `up_seasons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `up_stores`
--
ALTER TABLE `up_stores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `up_users`
--
ALTER TABLE `up_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `up_user_details`
--
ALTER TABLE `up_user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `up_website_settings`
--
ALTER TABLE `up_website_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
