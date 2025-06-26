-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for petfood_store
CREATE DATABASE IF NOT EXISTS `petfood_store` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `petfood_store`;

-- Dumping structure for table petfood_store.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petfood_store.cache: ~0 rows (approximately)

-- Dumping structure for table petfood_store.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petfood_store.cache_locks: ~0 rows (approximately)

-- Dumping structure for table petfood_store.failed_jobs
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

-- Dumping data for table petfood_store.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table petfood_store.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petfood_store.jobs: ~0 rows (approximately)

-- Dumping structure for table petfood_store.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petfood_store.job_batches: ~0 rows (approximately)

-- Dumping structure for table petfood_store.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petfood_store.migrations: ~10 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_06_14_085831_create_products_table', 1),
	(5, '2025_06_16_071119_create_orders_table', 1),
	(6, '2025_06_16_071201_create_order_items_table', 1),
	(7, '2025_06_25_150228_add_note_to_orders_table', 2),
	(8, '2025_06_25_151746_add_is_admin_to_users_table', 3),
	(9, '2025_06_25_153200_add_soft_deletes_to_products_table', 4),
	(10, '2025_06_25_153358_add_user_id_status_total_to_orders_table', 4);

-- Dumping structure for table petfood_store.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petfood_store.orders: ~1 rows (approximately)
INSERT INTO `orders` (`id`, `name`, `address`, `phone`, `note`, `created_at`, `updated_at`, `user_id`, `status`, `total_amount`) VALUES
	(1, 'Test User', 'tet', '0111111111111', 'tet', '2025-06-25 08:59:06', '2025-06-25 08:59:06', 1, 'pending', 500000.00),
	(2, 'Nguyễn Văn Test', '123 Đường ABC, Quận 1, TP.HCM', '0123456789', NULL, '2025-06-12 09:05:38', '2025-06-25 09:05:38', 1, 'delivered', 1790000.00),
	(3, 'Nguyễn Văn Test', '123 Đường ABC, Quận 2, TP.HCM', '0123456789', 'Giao hàng giờ hành chính', '2025-06-22 09:05:38', '2025-06-25 09:05:38', 1, 'delivered', 1360000.00),
	(4, 'Nguyễn Văn Test', '123 Đường ABC, Quận 3, TP.HCM', '0123456789', NULL, '2025-06-22 09:05:38', '2025-06-25 09:05:38', 1, 'shipped', 1360000.00),
	(5, 'Nguyễn Văn Test', '123 Đường ABC, Quận 4, TP.HCM', '0123456789', 'Giao hàng giờ hành chính', '2025-05-30 09:05:38', '2025-06-25 09:05:38', 1, 'processing', 500000.00),
	(6, 'Nguyễn Văn Test', '123 Đường ABC, Quận 5, TP.HCM', '0123456789', NULL, '2025-06-18 09:05:38', '2025-06-25 09:05:38', 1, 'shipped', 1180000.00);

-- Dumping structure for table petfood_store.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petfood_store.order_items: ~14 rows (approximately)
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 2, 250000.00, '2025-06-25 08:59:06', '2025-06-25 08:59:06'),
	(2, 2, 1, 3, 250000.00, '2025-06-25 09:05:38', '2025-06-25 09:05:38'),
	(3, 2, 2, 3, 180000.00, '2025-06-25 09:05:38', '2025-06-25 09:05:38'),
	(4, 2, 3, 2, 250000.00, '2025-06-25 09:05:38', '2025-06-25 09:05:38'),
	(5, 3, 1, 2, 250000.00, '2025-06-25 09:05:38', '2025-06-25 09:05:38'),
	(6, 3, 2, 2, 180000.00, '2025-06-25 09:05:38', '2025-06-25 09:05:38'),
	(7, 3, 3, 2, 250000.00, '2025-06-25 09:05:38', '2025-06-25 09:05:38'),
	(8, 4, 1, 2, 250000.00, '2025-06-25 09:05:38', '2025-06-25 09:05:38'),
	(9, 4, 2, 2, 180000.00, '2025-06-25 09:05:38', '2025-06-25 09:05:38'),
	(10, 4, 3, 2, 250000.00, '2025-06-25 09:05:38', '2025-06-25 09:05:38'),
	(11, 5, 3, 2, 250000.00, '2025-06-25 09:05:38', '2025-06-25 09:05:38'),
	(12, 6, 1, 1, 250000.00, '2025-06-25 09:05:38', '2025-06-25 09:05:38'),
	(13, 6, 2, 1, 180000.00, '2025-06-25 09:05:38', '2025-06-25 09:05:38'),
	(14, 6, 3, 3, 250000.00, '2025-06-25 09:05:38', '2025-06-25 09:05:38');

-- Dumping structure for table petfood_store.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petfood_store.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table petfood_store.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petfood_store.products: ~5 rows (approximately)
INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Thức ăn cho chó Pedigree 3kg', 'Thức ăn khô dinh dưỡng cao cho chó trưởng thành.', 250000.00, 'pedigree.jpg', '2025-06-25 07:49:30', '2025-06-25 07:49:30', NULL),
	(2, 'Thức ăn cho mèo Whiskas 1.5kg', 'Dành cho mèo lớn từ 1 tuổi trở lên.', 180000.00, 'whiskas.jpg', '2025-06-25 07:49:30', '2025-06-25 07:49:30', NULL),
	(3, 'Thức ăn cho chó Pedigree 13kg', 'Thức ăn khô dinh dưỡng cao cho chó trưởng thành.', 250000.00, 'pedigree.jpg', '2025-06-25 07:51:56', '2025-06-25 09:16:31', NULL),
	(4, 'Thức ăn cho mèo Whiskas 1.5kg', 'Dành cho mèo lớn từ 1 tuổi trở lên.', 180000.00, 'whiskas.jpg', '2025-06-25 07:51:56', '2025-06-25 07:51:56', NULL),
	(5, 'ntv', 'tet', 1111.00, NULL, '2025-06-25 09:18:14', '2025-06-25 09:18:30', '2025-06-25 09:18:30');

-- Dumping structure for table petfood_store.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petfood_store.sessions: ~0 rows (approximately)

-- Dumping structure for table petfood_store.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table petfood_store.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `is_admin`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Test User', 'test@example.com', NULL, 0, '$2y$10$ourKPtXiO/RiBKDEs3HxZOh53XBPtLfaCZVZfS.scQAU9m6ojtyaC', NULL, '2025-06-25 07:53:53', '2025-06-25 07:53:53'),
	(2, 'Admin User', 'admin@petfood.com', NULL, 1, '$2y$12$uyA.mj/27rRJrR2MTU3x.OIpSGqW4gd/NWvQJeSiUQuUin802SjkW', NULL, '2025-06-25 08:19:34', '2025-06-25 09:12:41');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
