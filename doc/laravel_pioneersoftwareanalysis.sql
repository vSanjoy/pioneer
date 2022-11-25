-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2022 at 06:21 AM
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
-- Database: `laravel_pioneersoftwareanalysis`
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
(1, 1, 7, 15, 33, 27, '2022-10-13 00:00:00', '1', '2022-10-12 06:03:08', '2022-10-12 06:03:08', NULL),
(2, 1, 1, 13, 34, 18, '2022-10-13 00:00:00', '1', '2022-10-12 10:25:30', '2022-10-12 10:25:47', NULL),
(3, 1, 6, 8, 19, 12, '2022-10-12 00:00:00', '1', '2022-10-12 11:18:28', '2022-10-12 11:19:36', NULL);

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
(1, 1, 1, 1, '12', NULL, NULL, '2022-10-12 06:03:08', NULL),
(2, 1, 1, 2, '12', NULL, NULL, '2022-10-12 06:03:08', NULL),
(3, 1, 1, 3, '24', NULL, NULL, '2022-10-12 06:03:08', NULL),
(4, 1, 2, 4, '12', NULL, NULL, '2022-10-12 06:03:08', NULL),
(5, 1, 2, 5, '24', NULL, NULL, '2022-10-12 06:03:08', NULL),
(6, 1, 3, 6, '12', NULL, NULL, '2022-10-12 06:03:08', NULL),
(7, 1, 3, 7, '12', NULL, NULL, '2022-10-12 06:03:08', NULL),
(8, 2, 1, 1, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(9, 2, 1, 2, '4', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(10, 2, 1, 3, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(11, 2, 2, 4, '2', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(12, 2, 2, 5, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(13, 2, 3, 6, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(14, 2, 3, 7, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(15, 2, 3, 8, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(16, 2, 3, 9, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(17, 2, 3, 10, '2', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(18, 2, 3, 11, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(19, 2, 3, 12, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(20, 2, 3, 13, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(21, 2, 3, 14, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(22, 2, 4, 15, '6', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(23, 2, 4, 16, '56', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(24, 2, 5, 17, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(25, 2, 5, 18, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(26, 2, 5, 19, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(27, 2, 5, 20, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(28, 2, 5, 21, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(29, 2, 5, 22, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(30, 2, 5, 23, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(31, 2, 6, 24, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(32, 2, 6, 25, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(33, 2, 7, 26, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(34, 2, 7, 27, '20', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(35, 2, 7, 28, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(36, 2, 7, 29, '20', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(37, 2, 7, 30, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(38, 2, 7, 31, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(39, 2, 7, 32, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(40, 2, 7, 33, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(41, 2, 7, 34, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(42, 2, 7, 35, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(43, 2, 7, 36, '12', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(44, 2, 7, 37, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(45, 2, 8, 38, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(46, 2, 8, 39, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(47, 2, 8, 40, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(48, 2, 8, 41, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(49, 2, 8, 42, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(50, 2, 9, 43, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(51, 2, 9, 44, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(52, 2, 9, 45, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(53, 2, 9, 46, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(54, 2, 9, 47, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(55, 2, 10, 48, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(56, 2, 10, 49, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(57, 2, 11, 50, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(58, 2, 11, 51, '2', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(59, 2, 11, 52, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(60, 2, 11, 53, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(61, 2, 11, 54, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(62, 2, 11, 55, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(63, 2, 12, 56, '4', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(64, 2, 12, 57, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(65, 2, 12, 58, '6', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(66, 2, 12, 59, '4', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(67, 2, 12, 60, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(68, 2, 12, 61, '6', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(69, 2, 13, 62, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(70, 2, 13, 63, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(71, 2, 13, 64, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(72, 2, 13, 65, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(73, 2, 13, 66, '7', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(74, 2, 14, 67, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(75, 2, 14, 68, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(76, 2, 14, 69, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(77, 2, 14, 70, '100', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(78, 2, 15, 71, '3', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(79, 2, 15, 72, '12', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(80, 2, 16, 73, '58', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(81, 2, 16, 74, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(82, 2, 16, 75, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(83, 2, 16, 76, '1', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(84, 2, 17, 77, '3', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(85, 2, 17, 78, '2', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(86, 2, 17, 79, '2', NULL, NULL, '2022-10-12 10:25:30', '2022-10-12 10:25:47'),
(87, 3, 1, 2, '1000', 'Test 1', 'Test 2', '2022-10-12 11:18:28', '2022-10-12 11:19:36'),
(88, 3, 1, 3, '2000', 'Test 3', 'Test 4', '2022-10-12 11:19:29', NULL);

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
(1, 'OCT-MAR (22-23)', 'oct-mar-22-23', 2022, 0, '1', '2022-08-22 09:36:41', '2022-10-12 09:23:38', NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `up_beats`
--

CREATE TABLE `up_beats` (
  `id` int(10) UNSIGNED NOT NULL,
  `distribution_area_id` int(11) DEFAULT NULL COMMENT 'Id from distribution_areas table',
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

INSERT INTO `up_beats` (`id`, `distribution_area_id`, `title`, `slug`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Kalna', 'kalna', 0, '1', '2022-08-22 08:18:43', '2022-08-22 08:42:52', '2022-08-22 08:42:52'),
(2, 1, 'Guptipara', 'guptipara', 1, '1', '2022-08-22 08:42:43', '2022-08-22 08:42:43', NULL),
(3, 1, 'Nabadwip', 'nabadwip', 2, '1', '2022-08-22 08:43:07', '2022-08-22 08:43:07', NULL),
(4, 2, 'Nager Bazar', 'nager-bazar', 3, '1', '2022-08-22 08:43:39', '2022-08-22 08:43:39', NULL),
(5, 2, 'Kestopur', 'kestopur', 4, '1', '2022-08-22 08:44:53', '2022-08-22 08:44:53', NULL),
(6, 1, 'Memari', 'memari', 5, '1', '2022-08-22 09:16:47', '2022-08-22 09:16:47', NULL),
(7, 10, 'Sonarpur', 'sonarpur', 6, '1', '2022-08-25 12:10:49', '2022-08-25 12:10:49', NULL),
(8, 1, 'Dhatrigram', 'dhatrigram', 7, '1', '2022-08-25 12:28:20', '2022-08-25 12:28:20', NULL),
(9, 10, 'Baruipur', 'baruipur', 8, '1', '2022-08-25 12:28:57', '2022-08-25 12:28:57', NULL),
(10, 6, 'Bandel', 'bandel', 9, '1', '2022-08-25 12:29:11', '2022-08-25 12:29:11', NULL),
(11, 6, 'Chinsurah', 'chinsurah', 10, '1', '2022-08-25 12:29:25', '2022-08-25 12:29:25', NULL),
(12, 6, 'Hooghly', 'hooghly', 11, '1', '2022-08-25 12:29:44', '2022-08-25 12:29:44', NULL),
(13, 6, 'Chandannagar', 'chandannagar', 12, '1', '2022-08-25 12:30:05', '2022-08-25 12:30:05', NULL),
(14, 6, 'Mankundu jotir more', 'mankundu-jotir-more', 13, '1', '2022-08-25 12:30:18', '2022-08-25 12:37:50', NULL),
(15, 10, 'Rathtala', 'rathtala', 14, '1', '2022-08-25 12:30:40', '2022-08-25 12:30:40', NULL),
(16, 6, 'Bhadreswar', 'bhadreswar', 15, '1', '2022-08-25 12:30:41', '2022-08-25 12:30:41', NULL),
(17, 9, 'Ashok Garh', 'ashok-garh', 16, '1', '2022-08-25 12:30:47', '2022-08-25 12:30:47', NULL),
(18, 1, 'Samudragarh', 'samudragarh', 17, '1', '2022-08-25 12:30:58', '2022-08-25 12:30:58', NULL),
(19, 9, 'Lake View', 'lake-view', 18, '1', '2022-08-25 12:31:35', '2022-08-25 12:31:35', NULL),
(20, 1, 'Jirat', 'jirat', 19, '1', '2022-08-25 12:31:46', '2022-08-25 12:31:46', NULL),
(21, 1, 'Somrabazar', 'somrabazar', 20, '1', '2022-08-25 12:32:09', '2022-08-25 12:32:09', NULL),
(22, 20, 'Vicram super market', 'vicram-super-market', 21, '1', '2022-08-25 12:32:18', '2022-08-25 12:32:18', NULL),
(23, 11, 'Arambagh', 'arambagh', 22, '1', '2022-08-25 12:33:57', '2022-08-25 12:33:57', NULL),
(24, 1, 'Sathgachiya', 'sathgachiya', 23, '1', '2022-08-25 12:35:16', '2022-08-25 12:35:16', NULL),
(25, 18, 'Rajarhat panchayat', 'rajarhat-panchayat', 24, '1', '2022-08-25 12:35:41', '2022-08-25 12:35:41', NULL),
(26, 23, 'Gorabazer', 'gorabazer', 25, '1', '2022-08-27 07:08:22', '2022-08-27 07:08:22', NULL),
(27, 7, 'Habra', 'habra', 26, '1', '2022-08-27 07:51:57', '2022-08-27 07:51:57', NULL),
(28, 11, 'chapadanga', 'chapadanga', 27, '1', '2022-09-15 10:41:37', '2022-09-15 10:41:37', NULL);

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
(17, 'Stitch Graph', 'stitch-graph', 16, '1', '2022-05-16 07:37:32', '2022-06-01 11:42:28', NULL),
(18, 'test cat 1', 'test-cat-1', 17, '1', '2022-06-01 11:42:38', '2022-06-01 11:42:53', '2022-06-01 11:42:53'),
(19, 'Stitch Graph', 'stitch-graph-1', 17, '1', '2022-06-13 06:59:38', '2022-06-13 06:59:45', '2022-06-13 06:59:45');

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
(1, 'Kalna', 'Deep Enterprise', 'kalna', 0, '1', '2022-08-22 07:48:27', '2022-08-22 07:48:27', NULL),
(2, 'Baguiati', 'Shree Krishna Marketing', 'baguiati', 1, '1', '2022-08-22 08:06:35', '2022-08-22 08:06:35', NULL),
(3, 'Behala', 'Behala Paper House', 'behala', 2, '1', '2022-08-22 08:09:05', '2022-08-25 11:08:16', '2022-08-25 11:08:16'),
(4, 'Gupti Para', 'Deep Enterprise', 'gupti-para', 3, '1', '2022-08-22 08:12:54', '2022-08-22 08:42:03', '2022-08-22 08:42:03'),
(5, 'Nabadwip', 'Deep Enterprise', 'nabadwip', 4, '1', '2022-08-22 08:13:36', '2022-08-22 08:41:59', '2022-08-22 08:41:59'),
(6, 'MANKUNDU', 'R D TRADERS', 'mankundu', 3, '1', '2022-08-25 10:30:04', '2022-08-25 10:30:52', NULL),
(7, 'Barasat', 'Dhar Distributor', 'barasat', 4, '1', '2022-08-25 10:30:11', '2022-08-25 10:30:11', NULL),
(8, 'Sodpur', 'Sayan Enterprise', 'sodpur', 5, '1', '2022-08-25 10:30:39', '2022-08-25 10:30:39', NULL),
(9, 'Baranagar', 'Day Enterprise', 'baranagar', 6, '1', '2022-08-25 10:32:45', '2022-08-25 10:32:45', NULL),
(10, 'Rajpur', 'Samaddar Supplyer', 'rajpur', 7, '1', '2022-08-25 10:32:46', '2022-08-25 10:32:46', NULL),
(11, 'Arambagh', 'M/S Anika Enterprise', 'arambagh', 8, '1', '2022-08-25 10:32:56', '2022-08-25 10:32:56', NULL),
(12, 'Howrah', 'A.k Enterprise', 'howrah', 9, '1', '2022-08-25 11:09:11', '2022-08-25 11:09:11', NULL),
(13, 'Ramnagar', 'Jatindranath Enterprise', 'ramnagar', 10, '1', '2022-08-25 11:10:13', '2022-08-25 11:10:13', NULL),
(14, 'Kachrapara', 'Nobokumar Enterprise', 'kachrapara', 11, '1', '2022-08-25 11:25:11', '2022-08-25 11:25:11', NULL),
(15, 'Rajbolhat', 'Arun Enterprise', 'rajbolhat', 12, '1', '2022-08-25 11:34:45', '2022-08-25 11:34:45', NULL),
(16, 'Barrckpore', 'Asmita Traders', 'barrckpore', 13, '1', '2022-08-25 11:49:29', '2022-08-25 11:49:29', NULL),
(17, 'Srirampur', 'Deepnarayan Enterprise', 'srirampur', 14, '1', '2022-08-25 11:49:57', '2022-08-25 11:49:57', NULL),
(18, 'Rajarhat', 'Inderjeet Sel', 'rajarhat', 15, '1', '2022-08-25 11:55:34', '2022-08-25 11:55:34', NULL),
(19, 'Belguriya', 'Saha Traders', 'belguriya', 16, '1', '2022-08-25 11:55:47', '2022-08-25 11:55:47', NULL),
(20, 'Baranagar 2', 'Abhijit Guai', 'baranagar-2', 17, '1', '2022-08-25 11:56:54', '2022-08-25 12:25:54', NULL),
(21, 'Salkia', 'Nirmala Enterprise', 'salkia', 18, '1', '2022-08-25 11:59:20', '2022-08-25 11:59:20', NULL),
(22, 'Behala', 'Behala paper House', 'behala', 19, '1', '2022-08-25 12:33:22', '2022-08-27 08:02:47', '2022-08-27 08:02:47'),
(23, 'Dumdum', 'Chopra Enterprise', 'dumdum', 20, '1', '2022-08-27 06:47:05', '2022-08-27 06:47:05', NULL),
(24, 'Behala', 'Behala Paper House', 'behala', 21, '1', '2022-08-27 08:03:23', '2022-08-27 08:05:22', NULL);

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
(21, '2022_07_19_061036_create_orders_table', 14),
(22, '2022_10_06_061535_create_single_step_orders_table', 15),
(23, '2022_10_06_062117_create_single_step_order_details_table', 15);

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
(79, 17, 1, 'Pioneer 4No. St. Graph', 'pioneer-4no-st-graph', 13.42, 20.00, 15.00, NULL, 78, '1', '2022-05-17 05:25:47', '2022-08-11 12:14:16', NULL);

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
(2, 'Distributor', 'distributor-1', '1', '1', '2022-05-25 23:52:00', '2022-10-11 12:17:01', NULL),
(3, 'Seller', 'seller', '1', '1', '2022-07-13 23:51:50', '2022-10-11 12:16:14', NULL);

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
(75, 'order.view'),
(76, 'singleStepSellerAnalyses.distribution-area-list'),
(77, 'singleStepSellerAnalyses.beat-list'),
(78, 'singleStepSellerAnalyses.store-list'),
(79, 'singleStepSellerAnalyses.category-list'),
(80, 'singleStepSellerAnalyses.product-list'),
(81, 'singleStepSellerAnalyses.analysis'),
(82, 'singleStepOrder.list'),
(83, 'singleStepOrder.view'),
(84, 'singleStepOrder.delete'),
(85, 'singleStepSellerAnalyses.season-list');

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
(3, 66),
(3, 67),
(3, 68),
(3, 69),
(3, 70),
(3, 71),
(3, 72),
(3, 75),
(3, 74),
(3, 76),
(3, 77),
(3, 78),
(3, 85),
(3, 79),
(3, 81),
(3, 82),
(3, 83),
(3, 84),
(2, 55),
(2, 56),
(2, 57),
(2, 58),
(2, 59),
(2, 60),
(2, 61),
(2, 62),
(2, 72),
(2, 75),
(2, 74),
(2, 82),
(2, 83),
(2, 84);

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
-- Table structure for table `up_single_step_orders`
--

CREATE TABLE `up_single_step_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL COMMENT 'Id from users table',
  `analysis_season_id` int(11) DEFAULT NULL COMMENT 'Id from analysis_seasons table',
  `distribution_area_id` int(11) DEFAULT NULL COMMENT 'Id from distribution_areas table',
  `distributor_id` int(11) DEFAULT NULL COMMENT 'Id from users table',
  `beat_id` int(11) DEFAULT NULL COMMENT 'beat_id foreign key from stores table',
  `store_id` int(11) DEFAULT NULL COMMENT 'Id from stores table',
  `analysis_date` timestamp NULL DEFAULT current_timestamp(),
  `analyses_id` int(11) DEFAULT NULL COMMENT 'Id from analyses table',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_single_step_orders`
--

INSERT INTO `up_single_step_orders` (`id`, `unique_order_id`, `seller_id`, `analysis_season_id`, `distribution_area_id`, `distributor_id`, `beat_id`, `store_id`, `analysis_date`, `analyses_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'PSA10490498C7', 3, 1, 1, 13, 18, 34, '2022-10-12 10:49:04', 2, '1', '2022-10-12 10:49:04', '2022-10-12 10:49:04', NULL),
(6, 'PSA112403F86D', 26, 1, 6, 8, 12, 19, '2022-10-12 11:24:03', 3, '1', '2022-10-12 11:24:03', '2022-10-12 11:24:03', NULL),
(7, 'PSA1132135689', 26, 1, 6, 8, 12, 19, '2022-11-24 11:32:13', 3, '1', '2022-11-24 06:02:13', '2022-11-24 06:02:13', NULL),
(8, 'PSA113355169D', 26, 1, 6, 8, 12, 19, '2022-11-24 11:33:55', 3, '1', '2022-11-24 06:03:55', '2022-11-24 06:03:55', NULL),
(9, 'PSA1135533475', 26, 1, 6, 8, 12, 19, '2022-11-24 11:35:53', 3, '1', '2022-11-24 06:05:53', '2022-11-24 06:05:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_single_step_order_details`
--

CREATE TABLE `up_single_step_order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `single_step_order_id` int(11) DEFAULT NULL COMMENT 'Id from users table',
  `category_id` int(11) DEFAULT NULL COMMENT 'Id from analyses_details table',
  `product_id` int(11) DEFAULT NULL COMMENT 'Id from analyses_details table',
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `up_single_step_order_details`
--

INSERT INTO `up_single_step_order_details` (`id`, `single_step_order_id`, `category_id`, `product_id`, `qty`, `why`, `result`) VALUES
(1, 5, 1, 3, '1', 'LM', '50%'),
(2, 6, 1, 2, '250', 'have old stock', '25% achivement'),
(3, 6, 1, 3, '1000', 'have old stock', '505 achievement'),
(4, 9, 1, 2, '12', NULL, NULL),
(5, 9, 1, 3, '10', NULL, NULL);

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
(1, 1, 'Ujjal Chakraborty', NULL, 'Boro Maa Card Corner', 'boro-maa-card-corner', '6295759434', '6295759434', NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, 'S', 'A+', NULL, 0, '1', 'IP', '2022-08-22 09:19:17', '2022-08-22 09:19:17', NULL),
(2, 1, 'Joydip Manna', NULL, 'Memari Paper House', 'memari-paper-house', '7797870045', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, 'S', 'A+', NULL, 1, '1', 'IP', '2022-08-22 09:32:56', '2022-08-22 09:33:22', NULL),
(3, 9, 'ram', NULL, 'B.D Infotak', 'bd-infotak', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 2, NULL, 'M', 'A', NULL, 2, '1', 'IP', '2022-08-25 12:42:16', '2022-08-25 12:44:40', NULL),
(4, 1, 'Arun Kumar Gupta', NULL, 'Bina Pani Center', 'bina-pani-center', '9474744249', NULL, NULL, NULL, 'Memari station road', 'PURBA BURDWAN', '713146', NULL, 6, 1, NULL, 'L', 'A', NULL, 3, '1', 'IP', '2022-08-27 04:26:47', '2022-08-27 04:26:47', NULL),
(5, 1, 'Prabhash Bhattachariya', NULL, 'Paper House', 'paper-house', '9775395264', NULL, NULL, NULL, 'Memari new market ( near Railway Station)', 'PURBA BURDWAN', '713146', NULL, 6, 1, NULL, 'L', 'A', NULL, 4, '1', 'IP', '2022-08-27 04:32:46', '2022-08-27 04:32:46', NULL),
(6, 1, 'Ram Ratan Adhikary', NULL, 'New Paper Center', 'new-paper-center', NULL, NULL, NULL, NULL, 'Memari New Market ( near Railway Station)', 'PURBA BURDWAN', '713146', NULL, 6, 1, NULL, 'L', 'A+', NULL, 5, '1', 'IP', '2022-08-27 04:35:10', '2022-08-27 04:35:10', NULL),
(7, 1, 'Firoj Mandal', NULL, 'Paper Store', 'paper-store', '9153041676', NULL, NULL, NULL, 'Memari New Market ( near Railway Station)', 'PURBA BURDWAN', '713146', NULL, 6, 2, NULL, 'L', 'A', NULL, 6, '1', 'IP', '2022-08-27 04:37:19', '2022-08-27 04:37:19', NULL),
(8, 1, 'Pronab Kundu', NULL, 'New Upasona Paper & xerox', 'new-upasona-paper-xerox', '9333232361', NULL, NULL, NULL, 'Near G.t road CHOWRASTHA more(opposite  New Market building)', 'PURBA BURDWAN', '713146', NULL, 6, 2, NULL, 'L', 'B', NULL, 7, '1', 'IP', '2022-08-27 04:41:31', '2022-08-27 04:41:31', NULL),
(9, 1, 'Subrata Banerjee', NULL, 'New Kagoj Ghar', 'new-kagoj-ghar', '8116853866', NULL, NULL, NULL, 'Gt road CHOWRASTHA  more ( near sweet shop)', 'PURBA BURDWAN', '713146', NULL, 6, 2, NULL, 'L', 'A', NULL, 8, '1', 'IP', '2022-08-27 04:44:30', '2022-09-14 05:19:18', NULL),
(10, 6, 'Satyajit Debnath', NULL, 'Student Aquariam', 'student-aquariam', '9051812818', NULL, NULL, NULL, 'Near rabindranagar techno school', 'HOOGHLY', '712103', NULL, 12, 1, NULL, 'L', 'A+', NULL, 9, '1', 'IP', '2022-08-27 05:33:08', '2022-08-27 05:33:08', NULL),
(11, 6, 'Tanmoy Bairagi', NULL, 'Lekhapora', 'lekhapora', '9883202234', NULL, NULL, NULL, 'rabindranagar bazar', 'Hooghly', '712103', NULL, 12, 2, NULL, 'S', 'B', NULL, 10, '1', 'IP', '2022-08-27 05:48:46', '2022-08-27 05:48:46', NULL),
(12, 23, 'Ram Das', NULL, 'Kumarpara pustokloy', 'kumarpara-pustokloy', '9883202234', NULL, NULL, NULL, 'Kumar para', 'Kolkata', '712103', NULL, 26, 2, NULL, 'M', 'B', NULL, 11, '1', 'IP', '2022-08-27 07:15:18', '2022-08-27 07:15:18', NULL),
(13, 7, 'Surojit Das', NULL, 'Trapti Stores', 'trapti-stores', '9832710097', '9832710097', NULL, NULL, 'Jassore Road', 'North 24 Pargana', '743263', NULL, 27, 2, 'traptistorehabra12@gmail.com', 'M', 'B', NULL, 12, '1', 'IP', '2022-08-27 08:00:11', '2022-08-27 08:00:11', NULL),
(14, 1, 'Alok saha', NULL, 'Paper House (Nawadip)', 'paper-house-nawadip', '9333249903', NULL, NULL, NULL, 'Nodia', 'Nadia', '741301', NULL, 3, 1, NULL, 'L', 'A+', NULL, 13, '1', 'IP', '2022-08-27 08:01:13', '2022-08-27 08:01:13', NULL),
(15, 1, 'Alok chaterjee', NULL, 'Priyojoni stories', 'priyojoni-stories', '9083352098', NULL, NULL, NULL, 'Nadia', 'Nadia', '741301', NULL, 3, 1, NULL, 'L', 'A', NULL, 14, '1', 'IP', '2022-08-27 08:04:53', '2022-08-27 08:04:53', NULL),
(16, 7, 'Ashim Debnath', NULL, 'Lakhani', 'lakhani', '8637063153', '8637063153', NULL, NULL, 'Jassore Road', 'North 24 Pargana', '743263', NULL, 27, 2, 'lakhani123@gmail.com', 'M', 'A+', NULL, 15, '1', 'IP', '2022-08-27 08:04:56', '2022-08-27 08:24:24', NULL),
(17, 6, 'Deboprasad Roy', NULL, 'Student Corner', 'student-corner', '9903998833', NULL, NULL, NULL, 'Rabindranagar Bazar', 'HOOGHLY', '712103', NULL, 12, 2, NULL, 'S', 'B', NULL, 16, '1', 'IP', '2022-08-27 08:05:01', '2022-08-27 08:05:01', NULL),
(18, 6, 'Alok Sen', NULL, 'Sen\'s Store', 'sens-store', '9433262447', NULL, NULL, NULL, 'Sayra more ( near mallick kashim hut)', 'HOOGHLY', '712103', NULL, 12, 2, NULL, 'M', 'B', NULL, 17, '1', 'IP', '2022-08-27 08:06:55', '2022-08-27 08:20:59', NULL),
(19, 6, 'Pranab Dey', NULL, 'Paramounts', 'paramounts', '9831666260', NULL, NULL, NULL, 'Pipulpati', 'HOOGHLY', '712103', NULL, 12, 2, NULL, 'M', 'B', NULL, 18, '1', 'IP', '2022-08-27 08:08:36', '2022-08-27 08:19:36', NULL),
(20, 1, 'Shibu', NULL, 'Priyojoni stories (N)', 'priyojoni-stories-n', '9333210434', NULL, NULL, NULL, 'Nadia', 'Nadia', '741301', NULL, 3, 1, NULL, 'M', 'A', NULL, 19, '1', 'IP', '2022-08-27 08:10:47', '2022-08-27 08:10:47', NULL),
(21, 7, 'Suman Sur', NULL, 'Moden Stationary', 'moden-stationary', '9800120623', '9800120623', NULL, NULL, 'Jassore Road', 'North 24 Parganas', '743263', NULL, 27, 2, 'modenstore12@gmail.com', 'M', 'A+', NULL, 20, '1', 'IP', '2022-08-27 08:12:47', '2022-08-27 08:12:47', NULL),
(22, 1, 'Ujal kumar Das', NULL, 'Paper corner', 'paper-corner', '9332007534', NULL, NULL, NULL, 'Nadia', 'Nadia', '741301', NULL, 3, 1, NULL, 'L', 'A', NULL, 21, '1', 'IP', '2022-08-27 08:13:00', '2022-08-27 08:13:00', NULL),
(23, 1, 'Suranjan PAUL', NULL, 'Techno', 'techno', NULL, NULL, NULL, NULL, 'Nadia', NULL, '741301', NULL, 3, 2, NULL, 'L', 'A', NULL, 22, '1', 'IP', '2022-08-27 08:15:24', '2022-08-27 08:15:24', NULL),
(24, 1, 'Ashim', NULL, 'Nawadip paper House', 'nawadip-paper-house', '9332345273', NULL, NULL, NULL, 'Nadia', 'Nadia', '741301', NULL, 3, 2, NULL, 'M', 'A', NULL, 23, '1', 'IP', '2022-08-27 08:17:57', '2022-08-27 08:17:57', NULL),
(25, 1, 'Krishandu pramanik', NULL, 'Academy', 'academy', '8926309118', NULL, NULL, NULL, 'Nadia', 'Nadia', '741301', NULL, 3, 1, NULL, 'M', 'A', NULL, 24, '1', 'IP', '2022-08-27 08:20:05', '2022-08-27 08:20:05', NULL),
(26, 7, 'Swapan Dutto', NULL, 'Janata Paper Depo', 'janata-paper-depo', '9732840328', '9732840328', NULL, NULL, 'Jassore Road', 'North 24 Parganas', '743263', NULL, 27, 1, 'janata123@gmail.com', 'L', 'A', NULL, 25, '1', 'IP', '2022-08-27 08:22:58', '2022-08-27 08:22:58', NULL),
(27, 1, 'Jiban Krishna Nath', NULL, 'Jiban Enterprise', 'jiban-enterprise', '9233206054', NULL, NULL, NULL, 'Jirar station road', 'HOOGHLY', '712501', NULL, 20, 2, NULL, 'M', 'B', NULL, 26, '1', 'IP', '2022-08-27 08:25:06', '2022-08-27 08:25:06', NULL),
(28, 1, 'Rontu Dey', NULL, 'Pathbhavan', 'pathbhavan', '9609353709', NULL, NULL, NULL, 'Near jirat Station rail gate', 'HOOGHLY', '712501', NULL, 20, 1, NULL, 'L', 'A', NULL, 27, '1', 'IP', '2022-08-27 08:27:25', '2022-08-27 08:27:25', NULL),
(29, 7, 'Pradeep Da', NULL, 'Sikha Paper House', 'sikha-paper-house', '9933600617', '9933600617', NULL, NULL, 'Jassore Road', 'North 24 Pargana', '743263', NULL, 27, 1, 'sikha123@gmail.com', 'L', 'B-', NULL, 28, '1', 'IP', '2022-08-27 08:29:26', '2022-08-27 08:29:26', NULL),
(30, 1, 'Sankar Prasad', NULL, 'Bidyamondir', 'bidyamondir', '9734859894', NULL, NULL, NULL, 'Near Jirat station road sobzi bazar', 'HOOGHLY', '712501', NULL, 20, 1, NULL, 'L', 'A+', NULL, 29, '1', 'IP', '2022-08-27 08:30:28', '2022-08-27 08:30:28', NULL),
(31, 1, 'Tarak chandra pal', NULL, 'Priyarama Enterprise', 'priyarama-enterprise', '9733634240', NULL, NULL, NULL, 'Nadia', 'Nadia', '712501', NULL, 20, 2, NULL, 'M', 'B', NULL, 30, '1', 'IP', '2022-08-27 08:31:07', '2022-10-12 07:08:32', NULL),
(32, 1, 'Ananda Mondal', NULL, 'Mondal Book Stall & Gift House', 'mondal-book-stall-gift-house', '9933963203', NULL, NULL, NULL, 'Near jirat mio more shop, station road', 'HOOGHLY', '712501', NULL, 20, 1, NULL, 'L', 'A', NULL, 31, '1', 'IP', '2022-08-27 08:33:06', '2022-08-27 08:33:06', NULL),
(33, 7, 'Dipankar Biswas', NULL, 'Ashok Paper Conceal', 'ashok-paper-conceal', '9733810320', '9733810320', NULL, NULL, 'Jassore Road', 'North 24 Pargana', '743263', NULL, 27, 3, 'ashokpaper', 'L', 'B', 'These people make their own goods.', 32, '1', 'IP', '2022-08-27 08:35:33', '2022-08-27 08:35:33', NULL),
(34, 1, 'ASHOK DA', NULL, 'MIT GLOBAL', 'mit-global', '8777025074', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, 2, NULL, 'M', 'A+', NULL, 33, '1', 'IP', '2022-10-12 09:26:11', '2022-10-12 09:26:11', NULL);

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
(1, NULL, NULL, NULL, 'John', 'Doe', 'John Doe', 'johndoe', 'admin@admin.com', NULL, '9876543210', '$2y$10$RFGYQLaP8sI212TKj0CY0uxRR2OENt.2PsiFKxQedSbUXSmPANeQq', '', 'M', NULL, NULL, 1, NULL, NULL, 'SA', 'Y', '1', 1669289412, 'Y', '2022-05-06 07:39:45', '2022-11-24 06:00:12', NULL),
(2, NULL, NULL, NULL, 'Biswajit', 'Sardar', 'Biswajit Sardar', 'biswajit', 'biswajit.sanmarg.1@gmail.com', NULL, '7908184378', '$2y$10$E2A9DOFqnq.iuvxjbhFaZuW6gmsAPAoA8l6QR7WZnHVt1DIBOSpDq', '', 'M', NULL, NULL, NULL, NULL, NULL, 'S', 'Y', '1', 1662098487, 'N', '2022-08-22 07:57:12', '2022-09-02 06:01:27', NULL),
(3, NULL, NULL, NULL, 'Raj', 'Misra', 'Raj Misra', 'RAJ', 'rajmisra2424@gmail.com', NULL, '7003387033', '$2y$10$xeA2lJyi7B/suKK1wZrWXO0OHYEb8bIcHuZ0zvYLG6e2jNsT6Jtsa', '', 'M', NULL, NULL, NULL, NULL, NULL, 'S', 'Y', '1', 1665573032, 'N', '2022-08-22 08:02:52', '2022-10-12 11:10:32', NULL),
(4, NULL, NULL, NULL, 'Rajveer', 'Singh', 'Rajveer Singh', 'Rajveersingh', 'rajveer@gmail.com', NULL, '7278884252', '$2y$10$te6KsiAHbJtLcQ/2u1oTQekgGzKRx7bGhir/ULGOkCUhrS6sAak3m', '', 'M', NULL, NULL, NULL, NULL, NULL, 'S', 'Y', '1', 1663219979, 'N', '2022-08-22 08:05:31', '2022-09-15 05:32:59', NULL),
(5, NULL, NULL, NULL, 'Sebak', 'Roy', 'Sebak Roy', 'sebak', 'sebakroy263@gmail.com', NULL, '8918991242', '$2y$10$P1iui/OfCRdMEppV3ItsruxLaL4R9qPhYy8dtZ26lRCewWq0kAYHq', 'distributor_1661429684.jpg', 'M', NULL, NULL, NULL, NULL, NULL, 'S', 'Y', '1', 1663239003, 'N', '2022-08-22 08:12:38', '2022-09-15 10:50:03', NULL),
(6, NULL, NULL, NULL, 'Uttam', 'Sinha', 'Uttam Sinha Roy', 'uttam', 'uttamsinharay86@gmail.com', NULL, '8509951339', '$2y$10$757PSHMbS6xXvFGVzPYChuneAxKMIWHCPGjVHIpvPhD6R9cT5qryO', '', 'M', NULL, NULL, NULL, NULL, NULL, 'S', 'Y', '1', 1663239025, 'N', '2022-08-22 08:14:42', '2022-09-15 10:50:25', NULL),
(7, 'Owner', NULL, NULL, 'Dipankar', 'Saha', 'Dipankar Saha', 'dipankar', 'dipankar@gmail.com', 'Deep Enterprise', NULL, '$2y$10$3zWg9ux9r.adKD.bjafcCumH9b1C2.7n3BPemJtZNwmKuzcdQ8/Be', '', 'M', NULL, 1, NULL, NULL, NULL, 'D', 'Y', '1', 1661161508, 'N', '2022-08-22 09:38:37', '2022-08-25 11:05:27', '2022-08-25 11:05:27'),
(8, 'Owner', NULL, NULL, 'Raju', 'Roy', 'Raju Roy', 'raju', 'raju@gmail.com', 'R D Traders', '9433312992', '$2y$10$I6OswHzW26b8AqE7pgonzuryTqI1J6b3V.B5Z0/jxNyxd/peDuihG', 'distributor_1661424975.jpg', 'M', NULL, 6, NULL, NULL, NULL, 'D', 'Y', '1', 1665573365, 'N', '2022-08-25 10:56:15', '2022-10-12 11:16:05', NULL),
(9, 'Owner', NULL, NULL, 'Gobindo', 'Day', 'Gobindo Day', 'gobindo', 'gobindoday68@gmail.com', 'Day Enterprise', '9831144092', '$2y$10$Km36OLc4kzjsH7giwWufDOwcYG0OVd1/L6prO3CWEUIZZwyHYvXYW', 'distributor_1661426486.jpg', 'M', NULL, 9, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-25 10:59:14', '2022-08-25 11:21:26', NULL),
(10, 'Owner', NULL, NULL, 'Sopon', 'badro', 'Sopon badro', 'Soponbodro', 'Sopon@gmail.com', 'Sayan Enterprise', '8017973160', '$2y$10$j1DSnXoR/5.91gz1knqyL.L/Jr7l5RRqNuoijw3f6xVWtd45ghSBu', '', 'M', NULL, 8, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-25 10:59:23', '2022-08-25 11:02:09', NULL),
(11, 'Owner', NULL, NULL, 'SK', 'Abbash', 'SK Abbash Ahmed', 'skabbashahamed', 'skabbshahamed@gmail.com', 'M/S Anika Enterprise', '9933819061', '$2y$10$.2mAuBDrz4kQpIF6O8uJS.9cV1jtg3LeQCqG8otS.hlqiBx7u.Ena', '', 'M', NULL, 11, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-25 11:00:01', '2022-08-25 11:00:01', NULL),
(12, 'Owner', NULL, NULL, 'Samaddar', 'Supplyer', 'Samaddar Supplyer', 'indrajit', 'indrajit1234@gmail.com', 'Samaddar Supplyer', '9831105032', '$2y$10$k6n0I91H0HJrZtoIXASJv.EfLmlkSDzCNqvtkmFjm5sTXxQCSZc9q', '', 'M', NULL, 10, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-25 11:02:38', '2022-08-25 11:04:31', NULL),
(13, 'Owner', NULL, NULL, 'Dipankar', 'Saha', 'Dipankar Saha', 'dipankar', 'dipankar_saha@yahoo.com', 'Dip Enterprise', '9002287481', '$2y$10$mUaDi9z67iOAoxOulxN0yuFZC5N0S3lUYuexbRvD9wJrbbCu/JJMO', 'distributor_1661425824.jpg', 'M', NULL, 1, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-25 11:10:24', '2022-08-27 04:17:29', NULL),
(14, 'Owner', NULL, NULL, 'Abhijit', 'Guai', 'Abhijit Guai', 'abhijit', 'abhijitguai@gmail.com', 'Traders Choice', '9903315503', '$2y$10$3MAixfMyrl02XKx334duxeRzjF6D6/bZ8l4.Nc9ju.1.lGI5Smbpq', '', 'M', NULL, 20, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-25 11:12:19', '2022-08-25 11:57:58', NULL),
(15, 'Owner', NULL, NULL, 'Rohon', 'Dhar', 'Rohon Dhar', 'Rohon', 'Rohon@22gmail.com', 'Sayan Enterprise', '8777271379', '$2y$10$kDilqBx0zbZt4acsi1DN9.oL09sizyk22.zEne9X8ZfZexFx.Upxm', '', 'M', NULL, 7, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-25 11:17:42', '2022-08-25 11:19:36', NULL),
(16, 'Owner', NULL, NULL, 'Ravindranath', 'Bhanga', 'Ravindranath Bhanga', 'Jatindranathbhanga', 'Jatindranath@gmail.com', 'Jatindranath Enterprise', '9800358503', '$2y$10$NTlAnMtIy4unhRMPLNyF1.mpVRIqAfrGtnvD66gQASIJwV593EwZq', '', 'M', NULL, 13, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-25 11:18:52', '2022-08-25 11:19:46', NULL),
(17, 'Owner', NULL, NULL, 'Nirmalo', 'Mujumdhar', 'Nirmalo Mujumdhar', 'Nirmalo', 'Nirmalo@22gmail.com', 'Nobokumar Enterprise', '9830453780', '$2y$10$X5E3R0eWeGWnQfOJzV7RQOKShJA9P2VEHH6Lrhgdrug/pOLXkMO2.', '', 'M', NULL, 14, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-25 11:31:17', '2022-08-27 08:31:56', NULL),
(18, 'Owner', NULL, NULL, 'Arun', 'Dey', 'Arun Dey', 'sumankallyandey', 'sumankallyan@gmail.com', 'Arun Enterprise', '7059250670', '$2y$10$778Uxz85HubQEDeq4bYN7ezsVhvee.oIV747KLQar7o7K5Mi0ENt.', '', 'M', NULL, 15, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-25 11:45:40', '2022-08-25 11:45:40', NULL),
(19, 'Owner', NULL, NULL, 'Ashim', 'pal', 'Ashim pal', 'ashim', 'ashim123@gamil.com', 'A.K Enterprise', '9836358294', '$2y$10$Ou2t370TA3/ZL3QB7wCn1uiWRE9vqwLLa0Pebiwb99LWHZ65H5g7C', '', 'M', NULL, 12, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-25 11:52:57', '2022-08-25 11:55:27', NULL),
(20, 'Owner', NULL, NULL, 'Bimal', 'bonik', 'Bimal bonik', 'Bimal', 'Bimal@22gmail.com', 'Asmita Traders', '9831472754', '$2y$10$ZAORGWKAMYOPKhb2mrz9YeUPYc6tHgrqOu8Wz7hXccqCgeWUdcShS', '', 'M', NULL, 16, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-25 11:54:28', '2022-08-25 11:54:28', NULL),
(21, 'Owner', NULL, NULL, 'Inderjeet', 'Sel', 'Inderjeet Sel', 'Inderjeet', 'Inderjeet46@gmail.com', 'Shree Ganesh Udyog', '9836211342', '$2y$10$ijZ5VNta26Og23.t5eTLqu18y759EYH4KDWuRdKaq82Y.z0OqMmm.', '', 'M', NULL, 18, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-25 12:02:03', '2022-08-25 12:02:03', NULL),
(22, 'Owner', NULL, NULL, 'Goutam', 'saha', 'Goutam saha', 'Goutam', 'Gautam@gmail.com', 'Saha Traders', '9331901703', '$2y$10$UQI4CrFke5qiNbEct9RiEOGr60hONYCWKci00F10huqxjXe3FzmK.', '', 'M', NULL, 19, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-25 12:03:16', '2022-08-25 12:03:16', NULL),
(23, 'Owner', NULL, NULL, 'Deepnarayan', 'Pal', 'Deepnarayan Pal', 'Deepnarayanpal', 'deepnarayanpal@gmail.com', 'Deepnarayan Enterprise', '9830265774', '$2y$10$odGpLZMlRyFmc0ow8ajH.ObqE5RiMX6SqfJSdojwsbiRD.leBjnLe', '', 'M', NULL, 17, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-25 12:06:57', '2022-08-25 12:06:57', NULL),
(24, 'Owner', NULL, NULL, 'Partha', 'Chopra', 'Partha Chopra', 'Partha', 'partha@22gmail.com', 'Chopra Enterprise', '7003387033', '$2y$10$83wSjQDy9BBd/pSqiqnQC.KHgAaksKXnrvAJPh72RzVCSkzEpfaaC', '', 'M', NULL, 23, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-27 06:59:28', '2022-08-27 07:06:44', NULL),
(25, 'Owner', NULL, NULL, 'Sarad', 'Agarwal', 'Sarad Agarwal', 'Sarad', 'behalapaperhouse@gamil.com', 'Behala Paper House', '9836131009', '$2y$10$o8WIsTBQAOVsHCG.n7/o1uhj8MBrP0McPa1PJ9EAkU83b2GQMIHsW', '', 'M', NULL, 24, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-08-27 08:30:01', '2022-08-27 08:30:01', NULL),
(26, NULL, NULL, NULL, 'Sanjay', NULL, 'Sanjay', 'sanjay', 'sanjay@yopmail.com', NULL, '9876543210', '$2y$10$4FjQHMU9j3wB1nwnU/MI7e8YOL/DQ6Fg1r6SyNVHbw4zT.9UwLZ6.', '', 'M', NULL, NULL, NULL, NULL, NULL, 'S', 'Y', '1', 1669289449, 'N', '2022-09-23 05:02:49', '2022-11-24 06:00:49', NULL),
(27, 'Owner', NULL, NULL, 'Shyam', 'Roy', 'Shyam Roy', 'shyamroy', 'shyamroy@yopmail.com', 'S R Traders', NULL, '$2y$10$FaMQzldl7.eiKsZ0YtFKru3aagBtaKT7RzYE7wiSqlIHR8FRZbmKC', '', 'M', NULL, 6, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-10-11 12:41:55', '2022-10-11 12:41:55', NULL),
(28, NULL, NULL, NULL, 'Riju', 'Roy', 'Riju Roy', 'rijuroy', 'rijuroy@yopmail.com', NULL, NULL, '$2y$10$UEw416TfoH7gtkwYdAMd8.HebOGMLh1K8mroGZ5h6xdEEuu9/Jewq', '', 'M', NULL, NULL, NULL, NULL, NULL, 'S', 'Y', '1', 1665492277, 'N', '2022-10-11 12:44:04', '2022-10-11 12:44:37', NULL);

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
(1, 2, NULL, NULL, NULL, '7908184378', 'Haldarpara', 'Baruipur', 'South 24 pargana', 'West Bengal', '743330', NULL),
(2, 3, NULL, NULL, NULL, '9038556969', 'Ichhapur', 'Barrckpore', 'North 24 parganas', 'West Bengal', '743144', NULL),
(3, 4, NULL, NULL, NULL, '7278884252', 'Northern Park', 'Kolkata', 'North 24 Pargana', 'West Bengal', '700108', NULL),
(4, 5, NULL, NULL, NULL, '8013794768', 'ARYANAGAR', 'GUPTIPARA', 'HOOGHLY', 'WEST BENGAL', '712512', NULL),
(5, 6, NULL, NULL, NULL, '8509951339', 'Amarpur Road, Baikunthapur', 'Tarakeshwar', 'Hooghly', 'West Bengal', '712414', NULL),
(6, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 8, NULL, NULL, NULL, '9433312992', 'Beside ambika athletic club, passing by jotir more', 'MANKUNDU', 'HOOGHLY', 'WEST BENGAL', '712139', 'Password: Rajuroy@22'),
(8, 9, NULL, NULL, NULL, '9831144092', 'Banarjee Para', 'North Kolkata', 'North 24 Pargana', 'West Bengal', '700035', 'Gobindo@22'),
(9, 10, NULL, NULL, NULL, 'Do', 'Sajirhat\'apc collage', 'Sodpur', 'North 24 parganas', 'West Bengal', NULL, 'Sopon@22'),
(10, 11, NULL, NULL, '8918638104', '7797514345', NULL, 'Arambagh', 'Hooghly', 'West Bengal', NULL, 'Abbash@22'),
(11, 12, NULL, NULL, '9007337239', '9088347061', 'Rathtalla', 'Rajpur', 'South 24 pargana', 'West Bengal', '700143', 'Indrajit@22'),
(12, 13, NULL, NULL, NULL, '9002287481', 'DATANKATHI', 'AMBIKA KALNA', 'PURBA BURDWAN', 'WEST BENGAL', '713409', 'Password: Dipankar@22'),
(13, 14, NULL, NULL, '9903045503', '9903045503', 'Jhulantalla', 'North Kolkata', 'North 24 Pargana', 'West Bengal', '700035', 'Abhijit@22'),
(14, 15, NULL, NULL, 'Do', NULL, 'Hathkhola', 'Barast', 'North 24 parganas', NULL, NULL, 'Rohon@22'),
(15, 16, NULL, NULL, NULL, '9800358503', NULL, 'Ramnagar', 'Midanapur', 'West Bengal', NULL, 'Jatindranath@22'),
(16, 17, NULL, NULL, 'Do', 'Do', 'Kachrapara', 'Barrckpore', NULL, NULL, NULL, 'Nirmalo@22'),
(17, 18, NULL, 'Sumankallyan Dey', NULL, '7059250670', NULL, NULL, 'Hooghly', 'West Bengal', NULL, 'Sumankallyan@22'),
(18, 19, 'partner', 'Achinta pal', '9836033973', '98363582940', 'Dharsa', 'Howrah', 'Howrah', 'West Bengal', '711104', 'Ashim@22'),
(19, 20, NULL, NULL, 'Do', 'Do', 'Barrckpore', 'Barrckpore', 'North 24 parganas', 'West Bengal', NULL, 'Bimal@22'),
(20, 21, NULL, NULL, NULL, '9836211342', 'Darshan Dron', 'Rajarhat', 'North 24 Pargana', 'West Bengal', '700135', 'Inderjeet@22'),
(21, 22, NULL, NULL, NULL, 'Do', 'Sodpur', NULL, NULL, NULL, NULL, 'Gautam@22'),
(22, 23, NULL, 'Shankar Pal', NULL, '9830265774', NULL, 'Srirampur', 'Hooghly', 'West Bengal', NULL, 'Deepnarayan@22'),
(23, 24, NULL, 'Yash Chopra', NULL, '9038556969', 'Nagerbazar', 'Dumdum', 'Kolkata', 'West Bengal', '712103', 'Parthachopra@22'),
(24, 25, NULL, NULL, NULL, '9836131009', NULL, 'Kolkata', NULL, 'West Bengal', '700034', 'Sarad@22'),
(25, 26, NULL, NULL, NULL, '9876543210', NULL, NULL, NULL, NULL, NULL, NULL),
(26, 27, NULL, NULL, NULL, NULL, NULL, NULL, 'Hoogly', 'West bengal', '712139', 'Shyamroy@123'),
(27, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(5, 1),
(5, 6),
(6, 11),
(6, 13),
(6, 17),
(3, 7),
(3, 16),
(3, 23),
(3, 14),
(3, 1),
(3, 8),
(4, 9),
(4, 20),
(4, 7),
(4, 18),
(2, 24),
(2, 12),
(2, 10),
(2, 21),
(26, 11),
(26, 2),
(26, 9),
(26, 20),
(26, 7),
(26, 16),
(26, 24),
(26, 19),
(26, 23),
(26, 12),
(26, 14),
(26, 1),
(26, 6),
(26, 18),
(26, 15),
(26, 10),
(26, 13),
(26, 21),
(26, 8),
(26, 17),
(28, 11),
(28, 2),
(28, 9),
(28, 20),
(28, 7),
(28, 16),
(28, 24),
(28, 19),
(28, 23),
(28, 12),
(28, 14),
(28, 1),
(28, 6),
(28, 18),
(28, 15),
(28, 10),
(28, 13),
(28, 21),
(28, 8),
(28, 17);

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
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 3),
(27, 2),
(28, 3);

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
-- Indexes for table `up_single_step_orders`
--
ALTER TABLE `up_single_step_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_single_step_order_details`
--
ALTER TABLE `up_single_step_order_details`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `up_analyses_details`
--
ALTER TABLE `up_analyses_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `up_categories`
--
ALTER TABLE `up_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `up_distribution_areas`
--
ALTER TABLE `up_distribution_areas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `up_grades`
--
ALTER TABLE `up_grades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `up_migrations`
--
ALTER TABLE `up_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `up_orders`
--
ALTER TABLE `up_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `up_products`
--
ALTER TABLE `up_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `up_roles`
--
ALTER TABLE `up_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `up_role_pages`
--
ALTER TABLE `up_role_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `up_seasons`
--
ALTER TABLE `up_seasons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `up_single_step_orders`
--
ALTER TABLE `up_single_step_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `up_single_step_order_details`
--
ALTER TABLE `up_single_step_order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `up_stores`
--
ALTER TABLE `up_stores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `up_users`
--
ALTER TABLE `up_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `up_user_details`
--
ALTER TABLE `up_user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `up_website_settings`
--
ALTER TABLE `up_website_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
