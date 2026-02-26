-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2023 at 12:43 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tequilaspos-fbag`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','In-active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'In-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `updated_by` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`id`, `name`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 'floor1', 'In-active', '2023-09-05 12:13:35', '2023-09-05 12:13:35', 1, NULL, NULL),
(2, 'floor2', 'In-active', '2023-09-05 12:14:03', '2023-09-06 07:36:17', 1, 1, NULL),
(3, 'Floor 3', 'In-active', '2023-09-06 07:36:25', '2023-09-06 07:36:25', 1, NULL, NULL),
(4, 'Floor 4', 'In-active', '2023-09-06 07:36:28', '2023-09-06 07:36:28', 1, NULL, NULL),
(5, 'Floor 5', 'In-active', '2023-09-06 07:36:31', '2023-09-06 07:36:31', 1, NULL, NULL),
(6, 'Floor 6', 'In-active', '2023-09-06 07:36:33', '2023-09-06 07:36:33', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menucategory`
--

CREATE TABLE `menucategory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','In-active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'In-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_18_124930_create_permission_tables', 2),
(6, '2023_08_18_131210_create_products_table', 3),
(7, '2023_08_28_163330_create_user_type', 4),
(8, '2023_08_23_113401_create_restaurants_table', 5),
(9, '2023_08_29_172749_create_user_restaurant_table', 6),
(10, '2023_08_23_144231_create_floors_table', 7),
(11, '2023_08_24_094911_create_restaurant_floor_table', 8),
(12, '2023_09_01_140710_create_taxmasters_table', 9),
(13, '2023_09_01_140725_create_taxpercents_table', 10),
(14, '2023_09_02_093128_create_menucategory_table', 11),
(15, '2023_09_01_135438_create_tables_table', 12),
(16, '2023_09_02_114540_add_customer_type__table', 13),
(17, '2023_09_06_092219_create_modifiers_table', 14),
(18, '2023_09_12_103554_update_users_table_add_phone', 15);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 18),
(5, 'App\\Models\\User', 29),
(6, 'App\\Models\\User', 17),
(6, 'App\\Models\\User', 21),
(7, 'App\\Models\\User', 14),
(14, 'App\\Models\\User', 22);

-- --------------------------------------------------------

--
-- Table structure for table `modifiers`
--

CREATE TABLE `modifiers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `modifer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modifier_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','In-active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'In-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `updated_by` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('chetu@chetu.com', '$2y$10$NLuojNBmAtb8tMbFMek0YO46N2Ftq/fgs86XVcz3.K9Xq7fVCvO7.', '2023-09-02 05:05:34'),
('kajalsingh2391994@gmail.com', '$2y$10$8HbMHcuc7.aTi9l4HQPsROaml7s4mHibPPcQoKP743l7kTl9e1Quy', '2023-09-02 05:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `group_name`, `name`, `guard_name`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(5, 'Role Management', 'role-list', 'web', '2023-08-19 08:45:44', '2023-08-19 08:45:44', NULL, NULL),
(6, 'Role Management', 'role-create', 'web', '2023-08-19 08:45:54', '2023-08-19 08:45:54', NULL, NULL),
(7, 'Role Management', 'role-edit', 'web', '2023-08-19 08:46:00', '2023-08-19 08:46:00', NULL, NULL),
(8, 'Role Management', 'role-delete', 'web', '2023-08-19 08:46:05', '2023-08-19 08:46:05', NULL, NULL),
(13, 'User/Staff Management', 'user-list', 'web', '2023-08-19 08:46:44', '2023-08-19 08:46:44', NULL, NULL),
(14, 'User/Staff Management', 'user-create', 'web', '2023-08-19 08:46:50', '2023-08-19 08:46:50', NULL, NULL),
(15, 'User/Staff Management', 'user-edit', 'web', '2023-08-19 08:46:55', '2023-08-19 08:46:55', NULL, NULL),
(16, 'User/Staff Management', 'user-delete', 'web', '2023-08-19 08:47:08', '2023-08-19 08:47:08', NULL, NULL),
(17, 'Restaurant Management', 'restaurant-create', 'web', '2023-08-21 04:09:02', '2023-09-04 05:06:17', NULL, NULL),
(30, 'Restaurant Management', 'restaurant-list', 'web', '2023-09-04 05:06:38', '2023-09-04 05:06:38', NULL, NULL),
(31, 'Restaurant Management', 'restaurant-edit', 'web', '2023-09-04 05:06:43', '2023-09-04 05:06:43', NULL, NULL),
(32, 'Restaurant Management', 'restaurant-delete', 'web', '2023-09-04 05:06:48', '2023-09-04 05:06:48', NULL, NULL),
(33, 'Floor management', 'floor-list', 'web', '2023-09-05 12:17:09', '2023-09-05 12:17:09', NULL, NULL),
(34, 'Floor management', 'floor-create', 'web', '2023-09-05 12:17:28', '2023-09-05 12:17:28', NULL, NULL),
(35, 'Floor management', 'floor-edit', 'web', '2023-09-05 12:17:36', '2023-09-05 12:17:36', NULL, NULL),
(36, 'Floor management', 'floor-delete', 'web', '2023-09-05 12:17:39', '2023-09-05 12:17:39', NULL, NULL),
(41, 'Role Permission Management', 'role-permission-view', 'web', '2023-09-14 10:59:41', '2023-09-14 10:59:41', 1, NULL),
(42, 'Role Permission Management', 'role-permission-store', 'web', '2023-09-14 10:59:46', '2023-09-14 10:59:46', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 4, 'MyApp', 'fe5d3c39ca705327180ca0e425791b7d5e6ef706c2f559d6418aba929f6913db', '[\"*\"]', NULL, NULL, '2023-08-21 07:29:32', '2023-08-21 07:29:32'),
(2, 'App\\Models\\User', 4, 'MyApp', '22a42d6b0d0d50c83dd42eca77f9fbd626498dc634c66d31911471714ca7ace4', '[\"*\"]', '2023-08-21 07:48:04', NULL, '2023-08-21 07:30:45', '2023-08-21 07:48:04'),
(3, 'App\\Models\\User', 5, 'MyApp', '563fea7fca34476225a4024f569c82cd512268a748cfb80717ad281bbad4db50', '[\"*\"]', NULL, NULL, '2023-08-21 12:13:33', '2023-08-21 12:13:33'),
(4, 'App\\Models\\User', 5, 'MyApp', '56097364796b81fa80c6d18a9658af7cbabad1f1493b4481118cf7592f381de7', '[\"*\"]', '2023-08-21 12:15:34', NULL, '2023-08-21 12:14:57', '2023-08-21 12:15:34'),
(5, 'App\\Models\\User', 7, 'MyApp', '6f3422b31fecc37aa8552734b3defc75888cce6ec94a33a9c222f82748f89a12', '[\"*\"]', '2023-08-23 07:12:08', NULL, '2023-08-23 06:19:55', '2023-08-23 07:12:08'),
(10, 'App\\Models\\User', 8, 'authToken', '608706738cc7ef353560f09165ad702690661906daecd8c73370ecb33f7c37d1', '[\"*\"]', '2023-08-25 03:52:39', NULL, '2023-08-25 03:52:31', '2023-08-25 03:52:39'),
(11, 'App\\Models\\User', 9, 'authToken', '44be47e6eee43055e7a9053129004895478731cc618bf9f5a3bfb35bb29e79e8', '[\"*\"]', '2023-08-28 04:24:25', NULL, '2023-08-28 04:24:07', '2023-08-28 04:24:25'),
(20, 'App\\Models\\User', 14, 'authToken', '1818815c3751963d2ce6af5372f52c5ee63bb08fd8f2cdc40fbe17e86aa729b3', '[\"*\"]', NULL, NULL, '2023-08-31 12:25:57', '2023-08-31 12:25:57'),
(21, 'App\\Models\\User', 14, 'authToken', '88196835b5be9148e40de9ec75db115c94134bc9a45e730d6263f41873a137e6', '[\"*\"]', NULL, NULL, '2023-09-01 03:56:52', '2023-09-01 03:56:52'),
(22, 'App\\Models\\User', 14, 'authToken', 'f10a11840d0df248f3d8ae9acfd5e5e2f301e04d5eaa697676e3353df89310ee', '[\"*\"]', NULL, NULL, '2023-09-02 06:26:14', '2023-09-02 06:26:14'),
(23, 'App\\Models\\User', 14, 'authToken', '85854d6a70cdf4f928fe0db2ca0a0a851fe1bd68154eea96cc69dd6ae6c7b72b', '[\"*\"]', NULL, NULL, '2023-09-02 06:42:53', '2023-09-02 06:42:53'),
(24, 'App\\Models\\User', 14, 'authToken', 'ae733c311114d20461527c3515c9169fe230b85ee3e0cfadd1132d6ee294103a', '[\"*\"]', NULL, NULL, '2023-09-02 06:43:11', '2023-09-02 06:43:11'),
(25, 'App\\Models\\User', 14, 'authToken', '3e22d78fe3d1f9d4e17b93dab645dfea1b111aa88cf60f97424ec416e1de2445', '[\"*\"]', NULL, NULL, '2023-09-02 06:43:29', '2023-09-02 06:43:29'),
(26, 'App\\Models\\User', 14, 'authToken', 'fcad9948ce41b264024e89d3e97bf9b08bcd4df35dac0b709d36451b46ad1c84', '[\"*\"]', NULL, NULL, '2023-09-02 06:44:27', '2023-09-02 06:44:27'),
(27, 'App\\Models\\User', 14, 'authToken', '1a9f1587d4c995df4e8002c0e0af0947ad92debcc676372b88db737eb1987382', '[\"*\"]', NULL, NULL, '2023-09-02 06:45:53', '2023-09-02 06:45:53'),
(28, 'App\\Models\\User', 14, 'authToken', 'a964f16def8d5d69c15a46e27310bea06767dfb1c0fd335fe9b152be5d69ad86', '[\"*\"]', NULL, NULL, '2023-09-02 06:46:51', '2023-09-02 06:46:51'),
(29, 'App\\Models\\User', 14, 'authToken', '495e33244b18108710385e04e21bac135630bd0f62a6be478cd417999e8efb4d', '[\"*\"]', NULL, NULL, '2023-09-02 06:47:14', '2023-09-02 06:47:14'),
(30, 'App\\Models\\User', 14, 'authToken', 'c608f7256807b3b32dc5145614c908959163ddbdcbebba6e94b133779a5498d3', '[\"*\"]', NULL, NULL, '2023-09-02 06:48:46', '2023-09-02 06:48:46'),
(31, 'App\\Models\\User', 14, 'authToken', '9ccae82c93b3db091891416f3c380df47a80aca7fa1344f6a731111f6c7c68e0', '[\"*\"]', NULL, NULL, '2023-09-02 06:51:12', '2023-09-02 06:51:12'),
(32, 'App\\Models\\User', 14, 'authToken', '6db9e363b1cf3b351ea15745bba2240ff705a65ce7b37267b4a691908df2015f', '[\"*\"]', NULL, NULL, '2023-09-02 07:00:39', '2023-09-02 07:00:39'),
(33, 'App\\Models\\User', 14, 'authToken', '9626b07b9c9f18dc87db2a9bde35608f2c48ee1bf633ca842f4aaa8c9bf97507', '[\"*\"]', NULL, NULL, '2023-09-02 07:06:51', '2023-09-02 07:06:51');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `detail`, `created_at`, `updated_at`) VALUES
(2, 'Coldrinkkk', 'Orange cooldrinkkkkk', '2023-08-18 08:36:49', '2023-08-21 12:17:09');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `close_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gst_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','In-active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'In-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `updated_by` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `address`, `phone`, `email`, `open_time`, `close_time`, `gst_no`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 'Pet pooja Restaurant', 'S-74 , Block P, Noida Sector 12', '898778909000', 'petpooja@yopmail.com', '00:05', '23:05', '89897888900000000', '', '2023-08-10 17:03:06', '2023-09-04 12:05:14', 1, NULL, NULL),
(2, 'My New Restaurant', 'S-74 , Block P, Noida Sector 12', '7878989988', 'mynewres@yopmail.com', '10:00 AM', '10:00 PM', '4hj4jk90klio90k', 'Active', '2023-08-10 17:03:06', NULL, 1, NULL, NULL),
(5, 'Haldiram Restaurant', 'GIP Sector 18', '8789897867', 'as@gmail.com', '23:10', '12:14', '78789767877878', 'In-active', '2023-09-04 12:15:41', '2023-09-04 12:20:37', NULL, NULL, '2023-09-04 12:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_floor`
--

CREATE TABLE `restaurant_floor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) DEFAULT NULL,
  `floor_id` bigint(20) DEFAULT NULL,
  `status` enum('Active','In-active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'In-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_floor`
--

INSERT INTO `restaurant_floor` (`id`, `restaurant_id`, `floor_id`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 2, 1, 'Active', '2023-09-06 07:54:40', '2023-09-06 07:54:40', 1, NULL, NULL),
(2, 2, 2, 'In-active', '2023-09-06 07:54:40', '2023-09-06 07:54:40', NULL, NULL, NULL),
(3, 2, 3, 'In-active', '2023-09-06 07:54:40', '2023-09-06 07:54:40', NULL, NULL, NULL),
(4, 2, 4, 'In-active', NULL, NULL, 1, NULL, NULL),
(5, 1, 1, 'In-active', NULL, NULL, 1, NULL, NULL),
(6, 1, 2, 'In-active', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','In-active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'In-active',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_type` enum('Chef','Waiter','Cashier') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deletable` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `customer_type`, `is_deletable`) VALUES
(1, 'SuperAdmin', 'web', 'Active', 1, 1, '2023-08-19 08:43:10', '2023-09-11 08:06:51', NULL, 'N'),
(3, 'Admin', 'web', 'Active', 1, 1, '2023-08-21 12:23:33', '2023-09-08 07:59:46', NULL, 'N'),
(5, 'Waiter', 'web', 'Active', 1, NULL, '2023-08-29 12:28:24', '2023-08-29 12:28:24', 'Waiter', 'N'),
(6, 'Chef', 'web', 'Active', 1, NULL, '2023-08-29 12:28:36', '2023-08-29 12:28:36', 'Chef', 'N'),
(7, 'Cashier', 'web', 'Active', 1, 1, '2023-08-29 12:28:40', '2023-09-18 08:55:25', 'Cashier', 'N'),
(14, 'Manager', 'web', 'Active', 1, 1, '2023-09-16 06:28:14', '2023-09-18 08:56:02', NULL, 'N'),
(20, 'test role', 'web', 'Active', 1, NULL, '2023-09-18 08:57:14', '2023-09-18 08:57:14', NULL, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(5, 3),
(5, 5),
(6, 3),
(6, 5),
(7, 3),
(8, 3),
(13, 3),
(13, 5),
(13, 7),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(30, 3),
(31, 3),
(33, 6),
(36, 6),
(41, 3),
(42, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) DEFAULT NULL,
  `floor_id` bigint(20) DEFAULT NULL,
  `status` enum('Active','In-active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'In-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxmasters`
--

CREATE TABLE `taxmasters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tax_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','In-active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'In-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxpercents`
--

CREATE TABLE `taxpercents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tax_master_id` bigint(20) DEFAULT NULL,
  `tax_percent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','In-active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'In-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `updated_by` tinyint(4) DEFAULT NULL,
  `status` enum('Active','In-active') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `mobile`, `phone_verified_at`, `created_by`, `updated_by`, `status`, `deleted_at`) VALUES
(1, 'kajal singh', 'kajals2@chetu.com', NULL, '$2y$10$n5hHmhm7jDrG0WSFaAl2r.meyxaFZrUixPQfVksq4bqcxV1GEijQK', 'F29JnuItJTZzdugwlHDIn81Fi98MPYxAKyTfJXLIUNJ1P51Rfs8uYmSBcpoJ', '2023-08-19 08:43:10', '2023-09-14 07:35:43', '12345677888', NULL, NULL, NULL, 'Active', NULL),
(18, 'test admin', 'admin@chetu.com', NULL, '$2y$10$6UgVQzwG9oR6PxVnZaL10O99US1zK0n6WALhEDWda8LuZH9dYRhcS', NULL, '2023-09-05 08:37:18', '2023-09-18 09:02:35', '(123) 456-78899', NULL, NULL, 1, 'Active', NULL),
(19, 'Cashier', 'cashier@chetu.com', NULL, '$2y$10$wcPUhXx2D7t2vK4qQJAtM.nbHi03zb54MgqVLpUwoG24FHZBO6LlG', NULL, '2023-09-06 07:48:46', '2023-09-12 06:17:33', NULL, NULL, NULL, NULL, 'Active', '2023-09-12 06:17:33'),
(21, 'chef', 'chef2@gmail.com', NULL, '$2y$10$tY/1CmcnyIkTyQlNzkBMSeuzbETqlt/2Htc6lJvmRyWDklmrjCyc6', NULL, '2023-09-12 05:36:52', '2023-09-18 09:02:40', '(676) 898-9898', NULL, NULL, 1, 'Active', NULL),
(22, 'testmanager', 'testmanager@gmail.com', NULL, '$2y$10$jHGKdBOH2npfuqYOXLApO.QU4Rpp.YhC5ZBXcBc3gGCkZ1mNM8Miy', NULL, '2023-09-12 07:32:20', '2023-09-18 09:02:27', '(787) 898-9898', NULL, NULL, 1, 'Active', NULL),
(23, 'kk', 'kk@chetu.com', NULL, '$2y$10$OBB1E9yiswqbFdWrU8Em3utS63oNzP1ZfTiVt98LjZXL5Tmq88kZC', NULL, '2023-09-12 07:39:55', '2023-09-14 04:33:32', '12345677888', NULL, NULL, NULL, 'Active', '2023-09-14 04:33:32'),
(24, 'test admin', 'testadmin@chetu.com', NULL, '$2y$10$vRe1JOpgHZX/ata8VZ0BoezHPSyA9iph11y2GpF.7Rt4iGTLA3l3G', NULL, '2023-09-15 10:54:21', '2023-09-15 11:46:15', '345678787', NULL, NULL, NULL, 'Active', '2023-09-15 11:46:15'),
(25, 'admin12', 'admin@yopmail.com', NULL, '$2y$10$e2gIZN1XrcpJSScILlEaEuFvt22eCgq74NL1GiTDtlsJDhvfF1zk.', NULL, '2023-09-15 11:57:18', '2023-09-15 11:57:48', '123456789', NULL, NULL, NULL, 'Active', '2023-09-15 11:57:48'),
(26, 'kanishk gupta', 'kanikg@chetu.com', NULL, '$2y$10$YaTUfXC13H8eIkc2qsT7tuAC57t.fKh4JISRVPPBJB6JqdurQFKeG', NULL, '2023-09-15 12:09:44', '2023-09-18 05:59:21', '98767887787', NULL, 18, 1, 'In-active', '2023-09-18 05:59:21'),
(27, 'kajals11', 'admiwwaqwn@yopmail.com', NULL, '$2y$10$/EABpAe/WPvJVtWCUJCEoeEq9qOVQKLvw/I1LjNsDr.UAwKdcfPL2', NULL, '2023-09-15 12:15:16', '2023-09-18 07:49:10', '2222222222', NULL, 1, NULL, 'In-active', '2023-09-18 07:49:10'),
(28, 'kanishk5', 'kg@gmail.com', NULL, '$2y$10$AFw4IRpuQ98HY.7ZhOcw4eTJByviK1x66rZLVH1rBuwnpZbw1jAdW', NULL, '2023-09-16 08:04:42', '2023-09-16 08:05:10', '1234567888', NULL, 1, 1, 'In-active', '2023-09-16 08:05:10'),
(29, 'testuser', 'testuser@gmail.com', NULL, '$2y$10$aWvXl4FzHPe1ARwvAjQsfelTdUQ5fPC5OE6rQI3U9MwSlEjdSaP/i', NULL, '2023-09-18 06:36:54', '2023-09-18 09:11:35', '(124) 566-6588', NULL, 1, 18, 'Active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_restaurant`
--

CREATE TABLE `user_restaurant` (
  `user_id` bigint(20) DEFAULT NULL,
  `restaurant_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_restaurant`
--

INSERT INTO `user_restaurant` (`user_id`, `restaurant_id`) VALUES
(18, 1),
(18, 1),
(18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'Waiter', '2023-08-28 11:55:32', '2023-08-28 11:55:32'),
(2, 'Chef', '2023-08-28 11:55:32', '2023-08-28 11:55:32'),
(3, 'Cashier', '2023-08-28 11:55:32', '2023-08-28 11:55:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `menucategory`
--
ALTER TABLE `menucategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `modifiers`
--
ALTER TABLE `modifiers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modifiers_modifer_name_unique` (`modifer_name`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `restaurant_floor`
--
ALTER TABLE `restaurant_floor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxmasters`
--
ALTER TABLE `taxmasters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxpercents`
--
ALTER TABLE `taxpercents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menucategory`
--
ALTER TABLE `menucategory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `modifiers`
--
ALTER TABLE `modifiers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `restaurant_floor`
--
ALTER TABLE `restaurant_floor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxmasters`
--
ALTER TABLE `taxmasters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxpercents`
--
ALTER TABLE `taxpercents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
