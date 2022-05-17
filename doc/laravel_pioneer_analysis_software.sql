-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2022 at 09:31 AM
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
(17, 'Stitch Graph', 'stitch-graph', 16, '1', '2022-05-16 07:37:32', '2022-05-16 07:49:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_distribution_areas`
--

CREATE TABLE `up_distribution_areas` (
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
-- Dumping data for table `up_distribution_areas`
--

INSERT INTO `up_distribution_areas` (`id`, `title`, `slug`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bagnan', 'bagnan', 0, '1', '2022-05-09 04:14:38', '2022-05-09 04:27:23', NULL),
(3, 'Barasat', 'barasat', 1, '1', '2022-05-09 06:33:21', '2022-05-09 06:33:21', NULL);

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
(10, '2022_05_16_125023_create_categories_table', 4);

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
(1, 'Super Admin', 'super-admin', '1', '1', '2022-05-06 07:39:45', '2022-05-06 07:39:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `up_role_pages`
--

CREATE TABLE `up_role_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `routeName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `up_role_permissions`
--

CREATE TABLE `up_role_permissions` (
  `role_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 3, 'Store Name 11', 'Store Name 2', 'Dipankar Stores', 'dipankar-stores', '987543210', '9876543211', '9876543212', '9876543213', 'M.G. Road', 'Kolkata', '700033', 'Beat name', 'dipankarstores@yopmail.com', 'L', 'A', 'Test notes.', 0, '1', '2022-05-13 04:39:17', '2022-05-16 07:34:47', NULL);

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
(1, NULL, NULL, NULL, 'John', 'Doe', 'John Doe', NULL, 'admin@admin.com', NULL, '9876543210', '$2y$10$RFGYQLaP8sI212TKj0CY0uxRR2OENt.2PsiFKxQedSbUXSmPANeQq', NULL, 'M', NULL, NULL, 1, NULL, NULL, 'SA', 'Y', '1', 1652772562, 'Y', '2022-05-06 07:39:45', '2022-05-17 01:59:22', NULL),
(3, 'Owner', NULL, NULL, 'Tibrewalla', NULL, 'Tibrewalla', NULL, 'info@lionsbbdbagbloodbank.org', 'Marwari Relief Society', '2274 5675', '$2y$10$0hd/hA0IA0zRWkIOP6gG1uaYK27jdvAnWNaf7XbMavBBah7r9Ld8y', 'distributor_1652101000.jpg', 'M', NULL, 1, NULL, NULL, NULL, 'D', 'Y', '1', NULL, 'N', '2022-05-09 06:16:32', '2022-05-09 07:28:04', NULL);

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
(1, 3, 'Job Title 2', 'Pawan', NULL, '9876543210', '225/227,  Rabindra Sarani Barabazar H.O.', 'Kolkata', 'South 24 Parganas', 'West Bengal', '700007', 'Test Notes');

-- --------------------------------------------------------

--
-- Table structure for table `up_user_roles`
--

CREATE TABLE `up_user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `up_roles`
--
ALTER TABLE `up_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `up_role_pages`
--
ALTER TABLE `up_role_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `up_stores`
--
ALTER TABLE `up_stores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `up_users`
--
ALTER TABLE `up_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `up_user_details`
--
ALTER TABLE `up_user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `up_website_settings`
--
ALTER TABLE `up_website_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
