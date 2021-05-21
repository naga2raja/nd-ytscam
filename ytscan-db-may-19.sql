-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.18-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ytscan
CREATE DATABASE IF NOT EXISTS `ytscan` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `ytscan`;

-- Dumping structure for table ytscan.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ytscan.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table ytscan.flights
CREATE TABLE IF NOT EXISTS `flights` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ytscan.flights: ~0 rows (approximately)
/*!40000 ALTER TABLE `flights` DISABLE KEYS */;
/*!40000 ALTER TABLE `flights` ENABLE KEYS */;

-- Dumping structure for table ytscan.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ytscan.migrations: ~10 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2021_05_03_102249_create_youtube_api_request_table', 2),
	(6, '2021_05_04_082052_create_subscription_plans_table', 3),
	(7, '2021_05_04_101036_add_subscription_id_to_users_table', 4),
	(8, '2021_05_04_112054_create_user_subscriptions_table', 5),
	(9, '2021_05_06_045710_create_flights_table', 6),
	(10, '2021_05_11_094510_create_user_spam_words_table', 7),
	(12, '2021_05_11_125213_add_custom_spam_text_count_to_subscription_plans_table', 8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table ytscan.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ytscan.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table ytscan.subscription_plans
CREATE TABLE IF NOT EXISTS `subscription_plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `delete_comments_count` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `custom_spam_count` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ytscan.subscription_plans: ~2 rows (approximately)
/*!40000 ALTER TABLE `subscription_plans` DISABLE KEYS */;
INSERT INTO `subscription_plans` (`id`, `name`, `price`, `delete_comments_count`, `created_at`, `updated_at`, `custom_spam_count`) VALUES
	(1, 'Basic (Free)', 0.00, 2, '2021-05-04 13:56:04', '2021-05-05 11:27:22', 1),
	(2, 'Silver', 10.00, 10, '2021-05-04 13:56:23', '2021-05-11 18:33:37', 5),
	(3, 'Gold', 20.00, 20, '2021-05-04 13:56:34', '2021-05-05 10:34:55', 1);
/*!40000 ALTER TABLE `subscription_plans` ENABLE KEYS */;

-- Dumping structure for table ytscan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ytscan.users: ~5 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `google_id`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@yopmail.com', NULL, '$2y$10$9x8p.1fOHhcKfcTVcM0SQ.ch6/G.2qKGioX6SXIlP.0JEHetLkrZS', NULL, NULL, '2021-04-20 05:55:13', '2021-04-20 05:55:13'),
	(2, 'Anbu A', 'anbucabcs1@gmail.com', NULL, '$2y$10$1UOJjivyAkGgwaHMMt9x0e4JZBkbKqcWY/btGZAVbUDq9YapKgmZy', '105433826421298268083', '8CSoAlgXhISKwBDEZkw3kCe17yTYXCBOFtsTmnHCPHFyli2vpWsi2vIWVP0U', '2021-04-20 06:58:53', '2021-04-20 06:58:53'),
	(3, 'Anbu Ayyakkannu', 'anbu20may@gmail.com', NULL, '$2y$10$A2dV7wFdFMUvap9A3EgXqOgsesAxtQG3cnrohE92QyBHadTc0A1QS', '106386793788133604899', 'MjGI16tqnohSHeCJvwQvxFcQVFlkHpAxYh9zy2SF7HS7d0wVKU7Hoff252Ed', '2021-04-21 09:55:50', '2021-04-21 09:55:50'),
	(4, 'Anbu A', 'anbucabcs@gmail.com', NULL, '$2y$10$pVXbxZyULgp72eH4F7WV8.4S79lrkHmwXesJ5NBVPFvXRwkGI6yC6', '105433826421298268083', 'hYIs6wli219s05Cb84ECWM5XHSfT2WFge52FiGSPHZ58ZfB8QZjx5JGe8O5X', '2021-05-05 05:06:31', '2021-05-05 05:06:31'),
	(5, 'ND Ytscam', 'ndytscam@gmail.com', NULL, '$2y$10$218yxM15SMe1p.7z1pjuLuJCOzt8OzvBT/0ZHBq3uo5fIrZ5.uuxi', '117397797383345905512', 'kmI6GbAayckIYRZx15W9xXsurAr0CO93ZhFHVhqHroPPfYTPTztX1i1ZD0xC', '2021-05-19 12:05:29', '2021-05-19 12:05:29');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table ytscan.user_spam_words
CREATE TABLE IF NOT EXISTS `user_spam_words` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `spam_word` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ytscan.user_spam_words: ~2 rows (approximately)
/*!40000 ALTER TABLE `user_spam_words` DISABLE KEYS */;
INSERT INTO `user_spam_words` (`id`, `user_id`, `spam_word`, `status`, `created_at`, `updated_at`) VALUES
	(10, 4, 'not', 1, '2021-05-18 11:32:45', '2021-05-18 11:32:45'),
	(11, 4, 'unable', 1, '2021-05-18 11:33:05', '2021-05-18 11:33:05');
/*!40000 ALTER TABLE `user_spam_words` ENABLE KEYS */;

-- Dumping structure for table ytscan.user_subscriptions
CREATE TABLE IF NOT EXISTS `user_subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ytscan.user_subscriptions: ~39 rows (approximately)
/*!40000 ALTER TABLE `user_subscriptions` DISABLE KEYS */;
INSERT INTO `user_subscriptions` (`id`, `user_id`, `subscription_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 4, 1, 0, '2021-05-05 05:06:32', '2021-05-18 12:04:30'),
	(2, 4, 3, 0, '2021-05-05 07:01:01', '2021-05-18 12:04:30'),
	(3, 4, 1, 0, '2021-05-05 07:01:08', '2021-05-18 12:04:30'),
	(4, 4, 2, 0, '2021-05-06 04:30:46', '2021-05-18 12:04:30'),
	(5, 4, 1, 0, '2021-05-06 06:44:10', '2021-05-18 12:04:30'),
	(6, 4, 2, 0, '2021-05-06 06:46:25', '2021-05-18 12:04:30'),
	(7, 4, 1, 0, '2021-05-06 06:46:42', '2021-05-18 12:04:30'),
	(8, 4, 2, 0, '2021-05-10 10:23:11', '2021-05-18 12:04:30'),
	(9, 4, 3, 0, '2021-05-18 05:20:44', '2021-05-18 12:04:30'),
	(10, 4, 2, 0, '2021-05-18 06:37:03', '2021-05-18 12:04:30'),
	(11, 4, 3, 0, '2021-05-18 07:13:32', '2021-05-18 12:04:30'),
	(12, 4, 2, 0, '2021-05-18 07:14:02', '2021-05-18 12:04:30'),
	(13, 4, 3, 0, '2021-05-18 07:14:06', '2021-05-18 12:04:30'),
	(14, 4, 2, 0, '2021-05-18 07:18:43', '2021-05-18 12:04:30'),
	(15, 4, 2, 0, '2021-05-18 07:19:32', '2021-05-18 12:04:30'),
	(16, 4, 2, 0, '2021-05-18 07:19:51', '2021-05-18 12:04:30'),
	(17, 4, 2, 0, '2021-05-18 07:20:32', '2021-05-18 12:04:30'),
	(18, 4, 2, 0, '2021-05-18 07:21:17', '2021-05-18 12:04:30'),
	(19, 4, 2, 0, '2021-05-18 07:21:25', '2021-05-18 12:04:30'),
	(20, 4, 2, 0, '2021-05-18 07:21:56', '2021-05-18 12:04:30'),
	(21, 4, 2, 0, '2021-05-18 07:22:13', '2021-05-18 12:04:30'),
	(22, 4, 1, 0, '2021-05-18 07:22:37', '2021-05-18 12:04:30'),
	(23, 4, 2, 0, '2021-05-18 07:27:47', '2021-05-18 12:04:30'),
	(24, 4, 3, 0, '2021-05-18 07:28:58', '2021-05-18 12:04:30'),
	(25, 4, 2, 0, '2021-05-18 07:29:23', '2021-05-18 12:04:30'),
	(26, 4, 2, 0, '2021-05-18 07:29:41', '2021-05-18 12:04:30'),
	(27, 4, 1, 0, '2021-05-18 07:29:46', '2021-05-18 12:04:30'),
	(28, 4, 2, 0, '2021-05-18 07:29:50', '2021-05-18 12:04:30'),
	(29, 4, 1, 0, '2021-05-18 07:29:57', '2021-05-18 12:04:30'),
	(30, 4, 2, 0, '2021-05-18 07:30:01', '2021-05-18 12:04:30'),
	(31, 4, 3, 0, '2021-05-18 07:30:04', '2021-05-18 12:04:30'),
	(32, 4, 1, 0, '2021-05-18 08:06:34', '2021-05-18 12:04:30'),
	(33, 4, 2, 0, '2021-05-18 08:09:35', '2021-05-18 12:04:30'),
	(34, 4, 3, 0, '2021-05-18 08:09:43', '2021-05-18 12:04:30'),
	(35, 4, 2, 0, '2021-05-18 08:37:21', '2021-05-18 12:04:30'),
	(36, 4, 3, 0, '2021-05-18 08:45:08', '2021-05-18 12:04:30'),
	(37, 4, 2, 0, '2021-05-18 08:45:13', '2021-05-18 12:04:30'),
	(38, 4, 3, 1, '2021-05-18 12:04:30', '2021-05-18 12:04:30'),
	(39, 5, 1, 1, '2021-05-19 12:05:30', '2021-05-19 12:05:30');
/*!40000 ALTER TABLE `user_subscriptions` ENABLE KEYS */;

-- Dumping structure for table ytscan.youtube_api_requests
CREATE TABLE IF NOT EXISTS `youtube_api_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `api_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_cost` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ytscan.youtube_api_requests: ~23 rows (approximately)
/*!40000 ALTER TABLE `youtube_api_requests` DISABLE KEYS */;
INSERT INTO `youtube_api_requests` (`id`, `user_id`, `api_type`, `unit_cost`, `created_at`, `updated_at`) VALUES
	(1, 2, 'delete', 100, '2021-05-03 12:36:29', '2021-05-03 12:36:29'),
	(2, 2, 'delete', 50, '2021-05-03 18:16:13', '2021-05-03 18:16:13'),
	(3, 2, 'delete', 50, '2021-05-03 12:54:31', '2021-05-03 12:54:31'),
	(4, 2, 'delete', 50, '2021-05-04 03:57:56', '2021-05-04 03:57:56'),
	(5, 2, 'delete', 50, '2021-05-04 04:05:44', '2021-05-04 04:05:44'),
	(6, 2, 'delete', 50, '2021-05-04 05:50:19', '2021-05-04 05:50:19'),
	(7, 2, 'delete', 50, '2021-05-04 05:50:41', '2021-05-04 05:50:41'),
	(8, 2, 'delete', 50, '2021-05-04 05:52:06', '2021-05-04 05:52:06'),
	(9, 2, 'delete', 50, '2021-05-04 06:39:02', '2021-05-04 06:39:02'),
	(10, 2, 'delete', 50, '2021-05-04 06:39:33', '2021-05-04 06:39:33'),
	(11, 2, 'delete', 50, '2021-05-04 06:39:54', '2021-05-04 06:39:54'),
	(12, 4, 'delete', 50, '2021-05-05 06:09:29', '2021-05-05 06:09:29'),
	(13, 4, 'delete', 50, '2021-05-05 06:11:22', '2021-05-05 06:11:22'),
	(14, 4, 'delete', 50, '2021-05-06 04:31:41', '2021-05-06 04:31:41'),
	(15, 4, 'delete', 50, '2021-05-10 10:24:45', '2021-05-10 10:24:45'),
	(16, 4, 'delete', 50, '2021-05-11 03:45:47', '2021-05-11 03:45:47'),
	(17, 4, 'delete', 50, '2021-05-18 08:20:17', '2021-05-18 08:20:17'),
	(18, 4, 'delete', 50, '2021-05-18 08:21:26', '2021-05-18 08:21:26'),
	(19, 4, 'delete', 50, '2021-05-18 09:05:39', '2021-05-18 09:05:39'),
	(20, 4, 'delete', 50, '2021-05-18 09:05:55', '2021-05-18 09:05:55'),
	(21, 4, 'delete', 50, '2021-05-18 12:04:02', '2021-05-18 12:04:02'),
	(22, 4, 'delete', 50, '2021-05-19 04:08:52', '2021-05-19 04:08:52'),
	(23, 4, 'delete', 50, '2021-05-19 12:02:55', '2021-05-19 12:02:55');
/*!40000 ALTER TABLE `youtube_api_requests` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
