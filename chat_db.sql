-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for chat_room_db
CREATE DATABASE IF NOT EXISTS `chat_room_db` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `chat_room_db`;

-- Dumping structure for table chat_room_db.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat_room_db.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table chat_room_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat_room_db.migrations: ~7 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(27, '2014_10_12_000000_create_users_table', 1),
	(28, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(29, '2014_10_12_100000_create_password_resets_table', 1),
	(30, '2019_08_19_000000_create_failed_jobs_table', 1),
	(31, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(32, '2024_01_31_125912_create_rooms_table', 1),
	(35, '2024_03_06_072037_create_room_user_table', 2);

-- Dumping structure for table chat_room_db.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat_room_db.password_resets: ~0 rows (approximately)

-- Dumping structure for table chat_room_db.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat_room_db.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table chat_room_db.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat_room_db.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table chat_room_db.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rooms_owner_id_foreign` (`owner_id`),
  CONSTRAINT `rooms_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat_room_db.rooms: ~7 rows (approximately)
INSERT INTO `rooms` (`id`, `name`, `icon`, `description`, `owner_id`, `created_at`, `updated_at`) VALUES
	(1, 'Room 1', '/images/avatar.jpg', 'Chat for all', 1, '2024-02-26 03:54:59', '2024-02-26 03:54:59'),
	(2, 'Room 2', '/images/avatar.jpg', 'Chat for all', 2, '2024-02-26 03:54:59', '2024-02-26 03:54:59'),
	(3, 'Room 3', '/images/avatar.jpg', 'Chat for all', 3, '2024-02-26 03:54:59', '2024-02-26 03:54:59'),
	(4, 'Room 4', '/images/avatar.jpg', 'Chat for all', 4, '2024-02-26 03:54:59', '2024-02-26 03:54:59'),
	(5, 'Room 5', '/images/avatar.jpg', 'Chat for all', 5, '2024-02-26 03:54:59', '2024-02-26 03:54:59'),
	(6, 'Room 6', '/images/avatar.jpg', 'Chat for all', 1, '2024-02-26 03:54:59', '2024-02-26 03:54:59'),
	(23, 'test1', NULL, NULL, 1, '2024-03-06 06:11:40', '2024-03-06 06:11:40');

-- Dumping structure for table chat_room_db.room_user
CREATE TABLE IF NOT EXISTS `room_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `room_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `room_user_room_id_foreign` (`room_id`),
  KEY `room_user_user_id_foreign` (`user_id`),
  CONSTRAINT `room_user_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `room_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat_room_db.room_user: ~1 rows (approximately)
INSERT INTO `room_user` (`id`, `room_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(15, 2, 1, NULL, NULL),
	(16, 3, 1, NULL, NULL);

-- Dumping structure for table chat_room_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat_room_db.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'User 1', 'user1@gmail.com', NULL, '$2y$12$tsoDNVncV4.o0jp5869VtuqMbhJzCfXf4smwhFtb5vrIk9q0zgE6y', NULL, '2024-02-26 03:54:58', '2024-02-26 03:54:58'),
	(2, 'User 2', 'user2@gmail.com', NULL, '$2y$12$o09tYrjlub79QB1Oaax.je0WvBI0clbh7R8eM17Ep.AaXUa1eYvau', NULL, '2024-02-26 03:54:58', '2024-02-26 03:54:58'),
	(3, 'User 3', 'user3@gmail.com', NULL, '$2y$12$Pgurgpd.zUridvVp6onEAu/L0bTq/4vLLPRzJdgssffb5GVYkwEaG', NULL, '2024-02-26 03:54:58', '2024-02-26 03:54:58'),
	(4, 'User 4', 'user4@gmail.com', NULL, '$2y$12$o2ozt5t1PpNfP2CwcHqGt.wPn9bjzEHPc1IVJXU9Q2ksRntuAzI/2', NULL, '2024-02-26 03:54:59', '2024-02-26 03:54:59'),
	(5, 'User 5', 'user5@gmail.com', NULL, '$2y$12$jOYpiBc71SCbbr3oTwOTWuuztswUPbWQ9aH7YA/qTdhChZeNsrJPe', NULL, '2024-02-26 03:54:59', '2024-02-26 03:54:59');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
