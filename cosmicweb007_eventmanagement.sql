-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 30, 2025 at 06:59 AM
-- Server version: 8.0.33
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cosmicweb007_eventmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_12_02_114902_create_tbl_auth_table', 1),
(7, '2025_01_21_111509_create_tbl_events', 3),
(8, '2025_01_21_111919_create_tbl_sub_events', 4),
(9, '2025_02_04_065117_create_tbl_task_list', 5),
(10, '2025_02_04_065237_create_tbl_event_task', 6),
(11, '2024_12_03_050922_create_tbl_vendors_table', 7),
(12, '2025_02_04_110112_create_tbl_users', 8),
(13, '2025_03_11_044802_create_tbl_states', 9),
(14, '2025_03_11_064647_create_tbl_district', 10),
(15, '2025_03_11_082438_create_tbl_subdistrict', 11);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auth`
--

CREATE TABLE `tbl_auth` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fcm_token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_auth`
--

INSERT INTO `tbl_auth` (`id`, `name`, `username`, `password`, `fcm_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '$2y$10$45ihGStaPRHYnz3aLG6/QOCljuCL4e3GXBKs3sCvNOcblRBRbBJwW', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `id` bigint UNSIGNED NOT NULL,
  `district_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`id`, `district_title`, `state_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ABC', 1, 1, NULL, NULL),
(2, 'Ujjain', 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `event_title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_datetime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`id`, `user_id`, `event_title`, `event_datetime`, `event_address`, `status`, `created_at`, `updated_at`) VALUES
(7, 48, 'new event', '2025-03-27 18:30', NULL, 1, '2025-04-28 10:56:50', '2025-04-28 10:56:50'),
(9, 48, 'second', '2025-03-28 18:34', NULL, 1, '2025-04-28 10:56:50', '2025-04-28 10:56:50'),
(10, 48, 'third', '2025-03-28 18:35', NULL, 1, '2025-04-28 10:56:50', '2025-04-28 10:56:50'),
(11, 44, 'new event', '2025-03-21 18:11', NULL, 1, '2025-04-28 10:56:50', '2025-04-28 10:56:50'),
(12, 50, 'happy birthday', '2025-03-29 18:16', NULL, 1, '2025-04-28 10:56:50', '2025-04-28 10:56:50'),
(13, 67, 'new event', '2025-03-30 00:24', NULL, 1, '2025-04-28 10:56:50', '2025-04-28 10:56:50'),
(14, 59, 'rutuja', '2025-03-31 18:26', NULL, 1, '2025-04-28 10:56:50', '2025-04-28 10:56:50'),
(15, 59, 'rutuja', '2025-03-31 18:26', NULL, 1, '2025-04-28 10:56:50', '2025-04-28 10:56:50'),
(16, 81, 'Sagar\'s Birthday party', '2025-04-25 11:14:54am', NULL, 1, '2025-04-28 10:56:50', '2025-04-28 10:56:50'),
(51, 58, 'dsasa', '', 'dsa', 1, '2025-04-26 15:07:28', '2025-04-26 15:07:28'),
(52, 1, 'sda', '', 'dsa', 1, '2025-04-27 03:46:02', NULL),
(53, 1, 'hagaj', '', 'buaba', 1, '2025-04-27 15:23:48', NULL),
(54, 16, 'Sanjay ki Shadi ', '', 'रामतलाई ', 1, '2025-04-27 15:35:02', NULL),
(55, 58, 'jsna', '', 'bsja', 1, '2025-04-28 14:56:21', NULL),
(56, 58, 'dsa', '', 'dsa', 1, '2025-04-29 07:13:08', NULL),
(57, 58, 'dsa', '', 'dsa', 1, '2025-04-29 16:46:15', '2025-04-29 16:46:15'),
(58, 1, 'Rohit\'s Birthday party One1', '2025-03-25 17:00', 'vasai', 1, '2025-04-29 07:31:42', '2025-04-29 07:31:42'),
(59, 1, 'Mohit\'s Birthday party1', '2025-03-25 17:00', 'vasai', 1, '2025-04-30 06:53:29', '2025-04-30 06:53:29'),
(60, 16, 'ugiggugigi', '', 'fufhghgjgjgj', 1, '2025-04-29 13:50:02', NULL),
(61, 16, 'vjvjvjgjgjh', '', 'cjvjgugugi', 1, '2025-04-29 13:50:15', NULL),
(62, 1, 'Sanjay ki Shadi ', '', 'रामतलाई तह. खाचरोद ', 1, '2025-04-29 15:16:12', NULL),
(63, 58, 'ds', '', 'ds', 1, '2025-04-30 06:15:56', '2025-04-30 06:15:56'),
(64, 58, 'sds', '', 'dsa', 1, '2025-04-30 06:55:52', '2025-04-30 06:55:52'),
(66, 66, 'ds', '', 'as', 1, '2025-04-30 03:02:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_task`
--

CREATE TABLE `tbl_event_task` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `task_id` int DEFAULT NULL,
  `event_task_title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_status` int DEFAULT '1' COMMENT '1=pending, 2=complte',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_event_task`
--

INSERT INTO `tbl_event_task` (`id`, `event_id`, `user_id`, `task_id`, `event_task_title`, `task_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'Meetup at 5 pm', 1, NULL, NULL),
(2, 1, 1, NULL, 'Cake Order', 2, NULL, NULL),
(4, 3, 1, NULL, 'taskfumvg', 2, NULL, NULL),
(5, 3, 1, NULL, 'dugs', 1, NULL, NULL),
(6, 3, 1, NULL, 'bring vegetable', 2, NULL, NULL),
(7, 3, 1, NULL, 'get drunsg', 1, NULL, NULL),
(8, 3, 1, NULL, 'dss', 1, NULL, NULL),
(9, 6, 1, NULL, 'ff', 1, NULL, NULL),
(10, 2, 1, NULL, 'newly task added', 1, NULL, NULL),
(11, 2, 1, NULL, 'newly task added', 1, NULL, NULL),
(12, 8, 48, NULL, 'new task', 2, NULL, NULL),
(13, 10, 48, NULL, 'new', 1, NULL, NULL),
(14, 10, 48, NULL, 'new', 1, NULL, NULL),
(15, 12, 50, NULL, 'cake order', 1, NULL, NULL),
(16, 10, 48, NULL, 'new added', 1, NULL, NULL),
(17, 10, 48, NULL, 'new added', 1, NULL, NULL),
(18, 12, 50, NULL, 'cake order', 1, NULL, NULL),
(19, 12, 50, NULL, 'bouche', 1, NULL, NULL),
(20, 12, 50, NULL, 'couch', 1, NULL, NULL),
(21, 12, 50, NULL, 'brown', 1, NULL, NULL),
(22, 12, 50, NULL, 'dd', 1, NULL, NULL),
(23, 12, 50, NULL, 'see', 1, NULL, NULL),
(24, 12, 50, NULL, 'asff', 1, NULL, NULL),
(25, 9, 48, NULL, 'rugb', 1, NULL, NULL),
(26, 9, 48, NULL, 'rugb', 1, NULL, NULL),
(27, 8, 48, NULL, 'rc', 1, NULL, NULL),
(28, 8, 48, NULL, 'rc', 1, NULL, NULL),
(29, 13, 67, NULL, 'yess', 2, NULL, NULL),
(30, 13, 67, NULL, 'yess', 2, NULL, NULL),
(31, 15, 59, NULL, 'new task', 1, NULL, NULL),
(32, 15, 59, NULL, 'new task', 1, NULL, NULL),
(33, 1, 81, NULL, 'Meetup at 5 pm', 1, NULL, NULL),
(34, 1, 81, NULL, 'Cake Order', 2, NULL, NULL),
(35, 1, 81, NULL, 'Cake Cutting', 1, NULL, NULL),
(38, 1, 1, NULL, 'oadas', 1, NULL, NULL),
(39, 1, 1, NULL, 'sdsa', 1, NULL, NULL),
(40, 1, 1, NULL, 'jkj', 1, NULL, NULL),
(43, 1, 1, NULL, 'dsa', 1, NULL, NULL),
(47, 53, 1, NULL, 'sdsa', 1, NULL, NULL),
(54, 51, 58, NULL, 'hzba', 1, NULL, NULL),
(55, 51, 58, NULL, 'hsbs', 1, NULL, NULL),
(56, 55, 58, NULL, 'dg', 1, NULL, NULL),
(68, 57, 58, NULL, 'shiva', 1, NULL, NULL),
(69, 57, 58, NULL, 'dfd', 1, NULL, NULL),
(81, 57, 58, NULL, 'Pandits', 1, NULL, NULL),
(82, 57, 58, NULL, 'shiva', 1, NULL, NULL),
(84, 57, 58, NULL, 'wrgrwgw', 2, NULL, NULL),
(85, 57, 58, NULL, 'hsja', 2, NULL, NULL),
(86, 57, 58, NULL, 'orange', 2, NULL, NULL),
(87, 57, 58, NULL, 'Pandit', 2, NULL, NULL),
(96, 57, 58, NULL, 'kavaj', 1, NULL, NULL),
(97, 57, 58, NULL, 'wrgrwgw', 1, NULL, NULL),
(98, 57, 58, NULL, 'Pandit', 1, NULL, NULL),
(99, 54, 16, NULL, '', 1, NULL, NULL),
(100, 59, 1, NULL, 'Pandit nsjsjskek', 2, NULL, NULL),
(102, 59, 1, NULL, 'जनाजा  sjskskss जिसके', 1, NULL, NULL),
(103, 59, 1, NULL, 'bsjskakksks snskks', 1, NULL, NULL),
(104, 63, 58, NULL, 'wrgrwgw', 1, NULL, NULL),
(105, 63, 58, NULL, 'Pandit', 2, NULL, NULL),
(106, 66, 66, NULL, 'Pandit', 1, NULL, NULL),
(107, 66, 66, NULL, 'wrgrwgw', 2, NULL, NULL),
(108, 66, 66, NULL, 'dfs', 2, NULL, NULL),
(109, 64, 58, NULL, 'bdb', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guest`
--

CREATE TABLE `tbl_guest` (
  `id` bigint UNSIGNED NOT NULL,
  `prefix_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `category_id` int DEFAULT NULL,
  `special_tag` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `event_id` int DEFAULT NULL,
  `subevent_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_guest`
--

INSERT INTO `tbl_guest` (`id`, `prefix_name`, `name`, `mobile`, `address`, `category_id`, `special_tag`, `user_id`, `event_id`, `subevent_id`, `created_at`, `updated_at`) VALUES
(1, '1', 'zeyan', '913774546', 'ajsjdhj', 1, '', 1, 4, NULL, NULL, NULL),
(2, '1', 'uej', '6666666', 'bb', 1, '', 1, 4, NULL, NULL, NULL),
(3, '1', 'Mithilesh prajapati', '9823499796', 'Unnamed Road, Samarth Krupa Nagar, Vasai East, Vasai-Virar, Navghar-Manikpur, Maharashtra 401208, India', 1, '', 48, 8, NULL, NULL, NULL),
(4, '1', 'Mithilesh prajapati', '215346978757', 'Unnamed Road, Samarth Krupa Nagar, Vasai East, Vasai-Virar, Navghar-Manikpur, Maharashtra 401208, India', 1, '', 48, 7, NULL, NULL, NULL),
(5, '1', 'Mithilesh prajapati', '13194845458', 'Unnamed Road, Samarth Krupa Nagar, Vasai East, Vasai-Virar, Navghar-Manikpur, Maharashtra 401208, India', 1, '', 48, 7, NULL, NULL, NULL),
(6, '1', 'zeyan', '9137757957', 'hshaha', 1, '', 44, 11, NULL, NULL, NULL),
(7, '1', 'zeyanansari', '91377579734', 'hsjajsjs', 1, '', 50, 12, NULL, NULL, NULL),
(8, '1', 'good', '2580369147', 'ryhbjn', 1, '', 67, 13, NULL, NULL, NULL),
(9, '1', 'hello', '3164972580', 'etebshsij', 1, '', 59, 15, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guest_invite`
--

CREATE TABLE `tbl_guest_invite` (
  `id` bigint UNSIGNED NOT NULL,
  `guest_id` int NOT NULL,
  `subevent_id` int NOT NULL,
  `person_count` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_guest_invite`
--

INSERT INTO `tbl_guest_invite` (`id`, `guest_id`, `subevent_id`, `person_count`, `created_at`, `updated_at`) VALUES
(7, 1, 9, '5', NULL, NULL),
(8, 1, 10, '5', NULL, NULL),
(9, 2, 9, '1', NULL, NULL),
(10, 2, 10, '6', NULL, NULL),
(11, 3, 15, '9', NULL, NULL),
(12, 4, 14, '2', NULL, NULL),
(13, 5, 14, '5', NULL, NULL),
(14, 6, 18, '3', NULL, NULL),
(15, 6, 19, '3', NULL, NULL),
(16, 7, 20, '2', NULL, NULL),
(17, 8, 21, '3', NULL, NULL),
(18, 9, 23, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guest_type`
--

CREATE TABLE `tbl_guest_type` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_guest_type`
--

INSERT INTO `tbl_guest_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Family', NULL, NULL),
(2, 'Friend', NULL, NULL),
(3, 'Vendor', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prefix`
--

CREATE TABLE `tbl_prefix` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_prefix`
--

INSERT INTO `tbl_prefix` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Mr', 1, NULL, NULL),
(3, 'श्रीमान', 1, NULL, NULL),
(4, 'श्रीमान प. सा.', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_states`
--

CREATE TABLE `tbl_states` (
  `id` bigint UNSIGNED NOT NULL,
  `state_title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_states`
--

INSERT INTO `tbl_states` (`id`, `state_title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Andhra Pradesh', 1, '2025-02-27 12:48:42', '2025-02-27 12:48:42'),
(2, 'Arunachal Pradesh', 1, '2025-02-27 12:48:42', '2025-02-27 12:48:42'),
(4, 'Madhya Pradesh', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subdistrict`
--

CREATE TABLE `tbl_subdistrict` (
  `id` bigint UNSIGNED NOT NULL,
  `subdistrict_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_id` int DEFAULT NULL,
  `state_id` int DEFAULT NULL,
  `status` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_subdistrict`
--

INSERT INTO `tbl_subdistrict` (`id`, `subdistrict_title`, `district_id`, `state_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 'XYZ', 1, 1, 1, NULL, NULL),
(4, 'Khachrod', 2, 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_events`
--

CREATE TABLE `tbl_sub_events` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` int NOT NULL,
  `sub_event_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_time` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_sub_events`
--

INSERT INTO `tbl_sub_events` (`id`, `event_id`, `sub_event_title`, `event_date`, `event_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Meetup', '2025-03-28', '17:00', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(2, 1, 'Cake Cutting', '2025-03-28', '16:00', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(3, 2, 'haldi', '2025-3-22', '14:39', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(4, 2, 'mehndi', '2025-3-12', '14:39', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(6, 2, 'pani', '2025-3-22', '17:39', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(7, 3, 'sub abc 1', '2025-02-04', '12:39', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(8, 3, 'sub abc 2', '2025-02-04', '12:39', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(9, 4, 'Meetup', '2025-03-25', '17:00', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(10, 4, 'Cake Cutting', '2025-03-25', '16:00', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(11, 5, 'Meetup', '2025-03-28', '17:00', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(12, 5, 'Cake Cutting', '2025-03-28', '16:00', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(13, 6, 'je', '2025-03-23', '15:57', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(14, 7, 'new sub', '2025-03-28', '18:31', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(15, 8, 'new sub', '2025-03-28', '18:31', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(16, 9, 'ydsj', '2025-03-28', '18:34', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(17, 10, 'rtuu', '2025-03-28', '18:35', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(18, 11, 'jeje', '2025-03-27', '18:11', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(19, 11, 'jdjs', '2025-03-29', '18:11', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(20, 12, 'cake cutting', '2025-03-29', '18:16', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(21, 13, 'sub event', '2025-03-31', '06:24', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(22, 14, 'new evenet', '2025-03-31', '18:26', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(23, 15, 'new evenet', '2025-03-31', '18:26', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(24, 5, 'sub abc', '2025-02-04', '12:39', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(25, 81, 'Meetup', '2025-03-28', '17:00', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(26, 81, 'Cake Cutting', '2025-03-28', '16:00', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(27, 17, 'sda', '2025-04-24', '17:52:00.000', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(28, 18, 'sda', '2025-04-24', '17:52:00.000', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(29, 19, 'sdsd', '2025-04-24', '17:56:00.000', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(30, 20, 'dsdads', '2025-04-24', '17:59:00.000', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(31, 21, 'dsas', '2025-04-30', '17:00:00.000', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(32, 21, 'dsassdasda', '2025-04-30', '17:00:00.000', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(33, 21, 'dsadasdadada', '2025-04-30', '23:00:00.000', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(34, 22, 'ghj', '2025-04-25', '10:01:00.000', 1, '2025-03-26 09:03:44', '2025-03-26 09:03:44'),
(35, 23, 'testtest', '2025-04-30', '11:22:00.000', 1, '2025-04-25 05:52:51', NULL),
(36, 24, 'testtet', '2025-04-30', '05:26:00.000', 1, '2025-04-25 05:57:04', NULL),
(37, 25, 'rwar', '2025-04-30', '05:28:00.000', 1, '2025-04-25 05:59:16', NULL),
(38, 26, 'dsas', '2025-04-30', '05:32:00.000', 1, '2025-04-25 06:02:51', NULL),
(39, 27, 'Meetup', '2025-03-25', '17:00', 1, '2025-04-25 06:08:12', NULL),
(40, 27, 'Cake Cutting', '2025-03-25', '16:00', 1, '2025-04-25 06:08:12', NULL),
(41, 28, 'Meetup 123', '2025-03-25', '17:00', 1, '2025-04-25 09:53:22', NULL),
(42, 28, 'Cake Cutting 123', '2025-03-25', '16:00', 1, '2025-04-25 09:53:22', NULL),
(43, 29, 'asds', '2025-04-27', '17:28:00.000', 1, '2025-04-25 09:58:48', NULL),
(44, 30, 'cake cutting', '2025-04-30', '15:29:00.000', 1, '2025-04-25 10:00:34', NULL),
(45, 31, 'dsas', '2025-04-30', '17:00:00.000', 1, '2025-04-25 10:31:16', NULL),
(46, 32, 'sdasd', '2025-04-30', '18:13:00.000', 1, '2025-04-25 16:44:03', NULL),
(47, 33, 'dsas', '2025-04-30', '0000-00-00 17:22:00.000', 1, '2025-04-25 16:52:44', NULL),
(48, 34, 'dsadsa', '2025-04-29', '0000-00-00 18:29:00.000', 1, '2025-04-25 16:59:57', NULL),
(49, 34, 'dsa', '2025-04-25', '0000-00-00 22:29:00.000', 1, '2025-04-25 16:59:57', NULL),
(50, 35, 'dsadsa', '2025-04-29 00:00', '0001-11-30 18:29', 1, '2025-04-25 17:01:40', NULL),
(51, 35, 'dsa', '2025-04-25 00:00', '0001-01-01 18:29', 1, '2025-04-25 17:01:40', NULL),
(52, 36, 'dsadsa', '2025-04-29 00:00', '0001-11-30 18:29', 1, '2025-04-25 17:02:41', NULL),
(53, 36, 'dsa', '2025-04-25 00:00', '0001-01-01 01:29', 1, '2025-04-25 17:02:41', NULL),
(54, 37, 'dsadsa', '2025-04-29 00:00', '0001-01-01 14:29', 1, '2025-04-25 17:03:04', NULL),
(55, 37, 'dsa', '2025-04-25 00:00', '0001-01-01 01:29', 1, '2025-04-25 17:03:04', NULL),
(56, 38, 'dsadsa', '2025-04-29 00:00', '0001-01-01 14:29', 1, '2025-04-25 17:03:31', NULL),
(57, 38, 'dsa', '2025-04-25 00:00', '0001-01-01 01:29', 1, '2025-04-25 17:03:31', NULL),
(58, 39, 'dsad', '2025-04-30', '0000-00-00 18:34:00.000', 1, '2025-04-25 17:04:32', NULL),
(59, 39, 'dsa', '2025-04-30', '0000-00-00 18:34:00.000', 1, '2025-04-25 17:04:32', NULL),
(60, 40, 'dsad', '2025-04-30 00:00', '0001-11-30 18:34', 1, '2025-04-25 17:05:37', '2025-04-26 03:25:48'),
(61, 40, 'dsasds', '2025-04-30 00:00', '0001-11-30 18:34', 1, '2025-04-25 17:05:37', NULL),
(62, 45, 'dsasd22112', '2025-04-30 00:00', '0001-01-01 10:25', 1, '2025-04-26 03:55:28', '2025-04-26 04:15:00'),
(63, 46, 'hdjehbzman', '2025-04-30 00:00', '0001-11-30 09:47', 1, '2025-04-26 04:18:03', '2025-04-26 04:18:27'),
(64, 47, 'orange', '2025-04-26 00:00', '0001-11-30 04:49', 1, '2025-04-26 04:19:48', '2025-04-26 04:20:10'),
(65, 48, 'dsa orange ', '2025-04-30 00:00', '0001-11-30 06:59', 1, '2025-04-26 04:30:01', '2025-04-26 14:34:49'),
(69, 49, 'nskan', '2025-04-29 00:00', '0001-11-30 10:16', 1, '2025-04-26 04:46:46', '2025-04-26 14:49:24'),
(72, 51, 'asd', '2025-04-29 00:00', '0001-11-30 17:28', 1, '2025-04-26 14:58:16', '2025-04-26 15:07:27'),
(73, 52, 'asd', '2025-04-30', '0000-00-00 09:15:00.000', 1, '2025-04-27 03:46:02', NULL),
(74, 53, 'zjs ', '2025-04-27', '0000-00-00 20:53:00.000', 1, '2025-04-27 15:23:48', NULL),
(75, 54, 'मंडप ', '2025-04-27', '0000-00-00 21:04:00.000', 1, '2025-04-27 15:35:02', NULL),
(76, 54, 'हल्दी', '2025-04-27', '0000-00-00 21:04:00.000', 1, '2025-04-27 15:35:02', NULL),
(77, 55, 'msss', '2025-04-30', '0000-00-00 20:26:00.000', 1, '2025-04-28 14:56:21', NULL),
(78, 56, 'dshja', '2025-04-29', '0000-00-00 17:42:00.000', 1, '2025-04-29 07:13:08', NULL),
(81, 81, 'Meetup One1', '2025-03-25', '17:00', 1, '2025-04-29 07:24:59', NULL),
(82, 82, 'Cake Cutting One', '2025-03-25', '16:00', 1, '2025-04-29 07:24:59', NULL),
(89, 60, 'yfhfugugjgj', '2025-04-29', '0000-00-00 19:19:00.000', 1, '2025-04-29 13:50:02', NULL),
(90, 61, 'utugigjvjvjvjv', '2025-04-29', '0000-00-00 19:19:00.000', 1, '2025-04-29 13:50:15', NULL),
(91, 62, 'मेहंदी ', '2025-04-30', '0000-00-00 19:44:00.000', 1, '2025-04-29 15:16:12', NULL),
(92, 57, 'Orange', '2025-04-30 00:00', '0001-01-01 17:07', 1, NULL, NULL),
(93, 57, 'treee', '2025-04-29 00:00', '0001-01-01 22:07', 1, NULL, NULL),
(94, 57, 'dsasd', '2025-04-30 00:00', '0001-01-01 17:08', 1, NULL, NULL),
(95, 63, 'dsa', '2025-04-30 00:00', '0001-11-30 17:09', 1, '2025-04-29 16:39:40', NULL),
(96, 63, 'shiva', '2025-04-29 00:00', '0001-11-30 22:09', 1, '2025-04-29 16:39:40', NULL),
(100, 65, 'ds', '2025-04-29 00:00', '0001-01-01 22:15', 1, '2025-04-29 16:45:56', NULL),
(101, 66, 'ds', '2025-04-30 00:00', '0001-01-01 08:32', 1, '2025-04-30 03:02:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_list`
--

CREATE TABLE `tbl_task_list` (
  `id` bigint UNSIGNED NOT NULL,
  `task_title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int DEFAULT '1',
  `states_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_task_list`
--

INSERT INTO `tbl_task_list` (`id`, `task_title`, `status`, `states_id`, `created_at`, `updated_at`) VALUES
(7, 'wrgrwgw', 1, '[\"1\"]', NULL, NULL),
(8, 'Pandit', 1, '[\"2\"]', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_otp_verifiy` int DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subdistrict_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `email`, `mobile`, `otp`, `is_otp_verifiy`, `profile`, `latitude`, `longitude`, `state_id`, `district_id`, `subdistrict_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'shubham', 'shubham@gmail.com', '8830516259', '1111', 1, NULL, '884858885555', '884858885555', '1', '2', '3', 1, NULL, NULL),
(16, 'Narayan Popandiya', NULL, '9575143275', '1111', 1, NULL, '834848466', '946494816', '64849', '6464664', '84646', 1, NULL, NULL),
(58, 'shiba', NULL, '7008682347', '1111', 1, NULL, '884858885555', '884858884444', '1', '2', '3', 1, NULL, NULL),
(59, NULL, NULL, '8600927283', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(60, 'rutuja', NULL, '8600927283', '1111', 1, NULL, '19.12345', '72.98765', '1', '2', '3', 1, NULL, NULL),
(61, 'rutuja', NULL, '8600927283', '1111', 1, NULL, '19.12345', '72.98765', '1', '2', '3', 1, NULL, NULL),
(62, 'rutuja', NULL, '8600927283', '1111', 1, NULL, '19.12345', '72.98765', '1', '2', '3', 1, NULL, NULL),
(63, NULL, NULL, '1235689074', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(64, 'ryutyhf', NULL, '1235689074', NULL, 1, NULL, '19.12345', '72.98765', '1', '2', '3', 1, NULL, NULL),
(65, NULL, NULL, '8830716259', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(66, 'spk', NULL, '9137757935', '1111', 1, NULL, '23.42322', '75.28185', 'Madhya Pradesh', 'Ujjain Division', 'Khachrod', 1, NULL, NULL),
(67, NULL, NULL, '1234567980', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(68, 'rheth', NULL, '1234567980', NULL, 1, NULL, '19.12345', '72.98765', '1', '2', '3', 1, NULL, NULL),
(69, 'rutuja', NULL, '8600927283', NULL, 1, NULL, '19.12345', '72.98765', '1', '2', '3', 1, NULL, NULL),
(70, 'abc', NULL, '9764281201', '1111', 1, NULL, '19.3825118', '72.8334767', 'Maharashtra', 'Konkan Division', 'Navghar-Manikpur', 1, NULL, NULL),
(71, NULL, NULL, '7567945646', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(72, NULL, NULL, '8559885555', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(73, NULL, NULL, '8464646431', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(74, NULL, NULL, '7008682347', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(75, NULL, NULL, '8830516255', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(76, 'newno1234', NULL, '7008682347', '1111', 1, NULL, '884858885555', '884858884444', '1', '2', '3', 1, NULL, NULL),
(77, NULL, NULL, '8830516258', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(78, NULL, NULL, '7008682342', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(79, NULL, NULL, '7008682341', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(80, NULL, NULL, '8852458787', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(81, NULL, NULL, '7008682344', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(82, 'shiba', NULL, '7008682347', '1111', 1, NULL, '884858885555', '884858884444', '1', '2', '3', 1, NULL, NULL),
(83, NULL, NULL, '7008682385', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(84, NULL, NULL, '7008682378', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(85, 'orange', NULL, '1111111111', '1111', 1, NULL, '23.42322', '75.28185', 'Madhya Pradesh', 'Ujjain Division', 'Khachrod', 1, NULL, NULL),
(86, 'sd', NULL, '7008682323', '1111', 1, NULL, '23.42322', '75.28185', 'Madhya Pradesh', 'Ujjain Division', 'Khachrod', 1, NULL, NULL),
(87, 'orange', NULL, '7008682349', '1111', 1, NULL, '23.42322', '75.28185', 'Madhya Pradesh', 'Ujjain Division', 'Khachrod', 1, NULL, NULL),
(88, 'tree', NULL, '7008682340', '1111', 1, NULL, '19.8143564', '72.7290207', 'Maharashtra', 'Konkan Division', 'Palghar', 1, NULL, NULL),
(89, 'mithilesh', NULL, '9545097341', '1111', 1, NULL, '19.4021914', '72.8363327', 'Maharashtra', 'Konkan Division', 'Vasai-Virar', 1, NULL, NULL),
(90, 'shiva', NULL, '7008682111', '1111', 1, NULL, '19.8149279', '72.7288371', 'Maharashtra', 'Konkan Division', 'Pasthal', 1, NULL, NULL),
(91, NULL, NULL, '6838338388', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(92, NULL, NULL, '2926626623', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(93, 'bshs', NULL, '7777777777', '1111', 1, NULL, '19.8147761', '72.7289454', 'Maharashtra', 'Konkan Division', 'Pasthal', 1, NULL, NULL),
(94, 'sds', NULL, '9999999999', '1111', 1, NULL, '23.42322', '75.28185', 'Madhya Pradesh', 'Ujjain Division', 'Khachrod', 1, NULL, NULL),
(95, NULL, NULL, '5434946767', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(96, NULL, NULL, '7828972828', '1111', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(97, 'test account', NULL, '3333333333', '1111', 1, NULL, '23.42322', '75.28185', 'Madhya Pradesh', 'Ujjain Division', 'Khachrod', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendors`
--

CREATE TABLE `tbl_vendors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` int NOT NULL,
  `sub_event_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advance_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` int DEFAULT NULL,
  `district_id` int DEFAULT NULL,
  `sub_district_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_vendors`
--

INSERT INTO `tbl_vendors` (`id`, `name`, `mobile`, `event_id`, `sub_event_id`, `task_id`, `amount`, `advance_amount`, `state_id`, `district_id`, `sub_district_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Dj', '880515412', 1, '2', '1', '5000', '2000', 1, 2, 3, 1, '1', NULL, NULL),
(5, 'caterer', '880515413', 1, '3', '1', '5000', '2000', 1, 2, 3, 1, '1', NULL, NULL),
(6, 'caterer', '880515413', 1, '3', '1', '5000', '2000', 1, 2, 3, 1, '1', NULL, NULL),
(7, 'ff', '222222222222', 6, '13', '9', '55', '0', 1, 2, 3, 1, '1', NULL, NULL),
(8, 'caterer', '880515413', 1, '3', '1', '5000', '2000', 1, 2, 3, 1, '1', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tbl_auth`
--
ALTER TABLE `tbl_auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_event_task`
--
ALTER TABLE `tbl_event_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_guest`
--
ALTER TABLE `tbl_guest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_guest_invite`
--
ALTER TABLE `tbl_guest_invite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_guest_type`
--
ALTER TABLE `tbl_guest_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_prefix`
--
ALTER TABLE `tbl_prefix`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_states`
--
ALTER TABLE `tbl_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subdistrict`
--
ALTER TABLE `tbl_subdistrict`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sub_events`
--
ALTER TABLE `tbl_sub_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_task_list`
--
ALTER TABLE `tbl_task_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vendors`
--
ALTER TABLE `tbl_vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_auth`
--
ALTER TABLE `tbl_auth`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tbl_event_task`
--
ALTER TABLE `tbl_event_task`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `tbl_guest`
--
ALTER TABLE `tbl_guest`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_guest_invite`
--
ALTER TABLE `tbl_guest_invite`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_guest_type`
--
ALTER TABLE `tbl_guest_type`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_prefix`
--
ALTER TABLE `tbl_prefix`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_states`
--
ALTER TABLE `tbl_states`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_subdistrict`
--
ALTER TABLE `tbl_subdistrict`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_sub_events`
--
ALTER TABLE `tbl_sub_events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `tbl_task_list`
--
ALTER TABLE `tbl_task_list`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `tbl_vendors`
--
ALTER TABLE `tbl_vendors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
