-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.6-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para insta
CREATE DATABASE IF NOT EXISTS `insta` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `insta`;

-- Volcando estructura para tabla insta.category_posts
CREATE TABLE IF NOT EXISTS `category_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla insta.category_posts: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `category_posts` DISABLE KEYS */;
INSERT INTO `category_posts` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'helado', '2020-10-15 11:21:37', '2020-10-15 11:21:38'),
	(2, 'pan', '2020-10-15 11:21:54', '2020-10-15 11:21:55');
/*!40000 ALTER TABLE `category_posts` ENABLE KEYS */;

-- Volcando estructura para tabla insta.love_likes
CREATE TABLE IF NOT EXISTS `love_likes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `likeable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `likeable_id` bigint(20) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `type_id` enum('LIKE','DISLIKE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'LIKE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `like_user_unique` (`likeable_id`,`likeable_type`,`user_id`),
  KEY `love_likes_likeable_type_likeable_id_index` (`likeable_type`,`likeable_id`),
  KEY `love_likes_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla insta.love_likes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `love_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `love_likes` ENABLE KEYS */;

-- Volcando estructura para tabla insta.love_like_counters
CREATE TABLE IF NOT EXISTS `love_like_counters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `likeable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `likeable_id` bigint(20) unsigned NOT NULL,
  `type_id` enum('LIKE','DISLIKE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'LIKE',
  `count` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `like_counter_unique` (`likeable_id`,`likeable_type`,`type_id`),
  KEY `love_like_counters_likeable_type_likeable_id_index` (`likeable_type`,`likeable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla insta.love_like_counters: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `love_like_counters` DISABLE KEYS */;
INSERT INTO `love_like_counters` (`id`, `likeable_type`, `likeable_id`, `type_id`, `count`, `created_at`, `updated_at`) VALUES
	(1, 'App\\Post', 1, 'LIKE', 0, '2020-10-15 16:29:44', '2020-10-15 16:43:52'),
	(2, 'App\\Post', 1, 'DISLIKE', 0, '2020-10-15 16:29:50', '2020-10-15 16:29:52'),
	(3, 'App\\Post', 2, 'LIKE', 0, '2020-10-15 16:30:44', '2020-10-15 16:43:57'),
	(4, 'App\\Post', 2, 'DISLIKE', 0, '2020-10-15 16:42:30', '2020-10-15 16:42:35');
/*!40000 ALTER TABLE `love_like_counters` ENABLE KEYS */;

-- Volcando estructura para tabla insta.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla insta.migrations: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(11, '2014_10_12_000000_create_users_table', 1),
	(12, '2014_10_12_100000_create_password_resets_table', 1),
	(13, '2016_09_02_153301_create_love_likes_table', 1),
	(14, '2016_09_02_163301_create_love_like_counters_table', 1),
	(15, '2018_08_29_132300_create_posts_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla insta.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla insta.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla insta.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `FK_posts_category_posts` FOREIGN KEY (`post_id`) REFERENCES `category_posts` (`id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla insta.posts: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `user_id`, `post_id`, `title`, `description`, `img`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 'Prueba 2', 'ggg', '1602779364.jpg', '2020-10-15 16:29:24', '2020-10-15 16:29:24'),
	(2, 2, 1, 'hola', 'ggg', '1602779435.png', '2020-10-15 16:30:35', '2020-10-15 16:30:35');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Volcando estructura para tabla insta.profiles
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT 0,
  `biography` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_profiles_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla insta.profiles: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` (`id`, `user_id`, `biography`, `img`, `created_at`, `updated_at`) VALUES
	(1, 2, 'dgfg', NULL, '2020-10-15 11:35:52', '2020-10-15 11:35:53');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;

-- Volcando estructura para tabla insta.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla insta.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Mrs. Golda Wilkinson MD', 'cfritsch@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'koaF9g6L5C', '2020-10-15 16:11:17', '2020-10-15 16:11:17'),
	(2, 'dayanna espinosa', 'dayanna@gmail.com', '$2y$10$5TsrWmYwjcYkRGbOqNtXQuUs7l4mrZ21wwf5DoWDTdy2te9y5TEtC', NULL, '2020-10-15 16:11:49', '2020-10-15 16:11:49');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
