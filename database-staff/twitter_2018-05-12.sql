# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.37)
# Database: twitter
# Generation Time: 2018-05-12 13:59:49 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table followers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `followers`;

CREATE TABLE `followers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `user_follow_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `followers_user_id_foreign` (`user_id`),
  KEY `followers_user_follow_id_foreign` (`user_follow_id`),
  CONSTRAINT `followers_user_follow_id_foreign` FOREIGN KEY (`user_follow_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `followers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2018_05_09_145016_create_tweets_table',1),
	(4,'2018_05_11_081759_create_table_user_tweet',1),
	(5,'2018_05_11_090811_create_followers_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table tweets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tweets`;

CREATE TABLE `tweets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `tweet` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_retweets` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tweets_user_id_foreign` (`user_id`),
  CONSTRAINT `tweets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table user_tweet
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_tweet`;

CREATE TABLE `user_tweet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `tweet_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_tweet_user_id_foreign` (`user_id`),
  KEY `user_tweet_tweet_id_foreign` (`tweet_id`),
  CONSTRAINT `user_tweet_tweet_id_foreign` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_tweet_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://placehold.it/800x500',
  `social_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `image`, `social_id`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'Amr El Mahdy','a.mahdy@rkanjel.com','amrelmahdy','$2y$10$P.2bjw/XhyDxqCQMOkQWAenfIWsx.76kNY/PJigPaYrUjZ663RNdu','1526133448.jpg',NULL,'IMxuSqvqKO','2018-05-12 15:56:18','2018-05-12 15:57:28'),
	(2,'Gabe Kozey','felicita63@example.org','runolfsdottir.reta','$2y$10$FJB1mmyI9fQfW3whfjNOC.VOXJ08n4Z6aLICdZ4hAcb6gbKdZ8JD.','http://placehold.it/800x500',NULL,'SzVohRUWJK','2018-05-12 15:56:18','2018-05-12 15:56:18'),
	(3,'Ludie Vandervort','ckuvalis@example.net','bpfeffer','$2y$10$4a8Bqin2Yd7TGbubzk8fpudOIWJPzVM3LgiPFVdEpUs1ridlFEXA6','http://placehold.it/800x500',NULL,'Fi0ZRxPLpv','2018-05-12 15:56:18','2018-05-12 15:56:18'),
	(4,'Laron Eichmann','sarina.cormier@example.org','weissnat.nina','$2y$10$N8uQ6496o6rR6wtRhfNif.XMsd442n94LiLDzU1yN.y4kZ5y2D78G','http://placehold.it/800x500',NULL,'vwEkWK7mcC','2018-05-12 15:56:18','2018-05-12 15:56:18'),
	(5,'Rocio Hamill','janae.rohan@example.com','roel.lynch','$2y$10$2Ce5mq1A95RQvkI8StRTneap66cD1NfTp1nHnS75QJNyd79GPq6e6','http://placehold.it/800x500',NULL,'AYNt6XLLC7','2018-05-12 15:56:18','2018-05-12 15:56:18'),
	(6,'Jeremie Metz','wilbert.hermiston@example.net','moore.morton','$2y$10$Uc1k.mCXvdOzCzsNOncvkuO1wdL8DgnXHTv4R9CCDGo/D/9QzX2/C','http://placehold.it/800x500',NULL,'fteIS3k8Jz','2018-05-12 15:56:18','2018-05-12 15:56:18'),
	(7,'Dr. Isaac Abbott','ryley05@example.com','treutel.cornell','$2y$10$yrz5SyY4Lfay8yAvTKTII.Uyw11Z7IKDHGKHt8LVkQouONQ430g2S','http://placehold.it/800x500',NULL,'AqBGei1IZh','2018-05-12 15:56:18','2018-05-12 15:56:18'),
	(8,'Mr. Giuseppe Ryan DVM','vpowlowski@example.net','jaunita27','$2y$10$8zQr0GZVHTaZif6mOLqPpemIJzX9yMmGspnsZcoZE7jayZRewqs7O','http://placehold.it/800x500',NULL,'sSj3bIuzB0','2018-05-12 15:56:18','2018-05-12 15:56:18'),
	(9,'Hollie Emmerich','sschoen@example.net','crist.colby','$2y$10$Po5ioDttn4hnYe9x42tpQelYuzZUQx1xiDWq5.z7.uNKgcsSQoBBi','http://placehold.it/800x500',NULL,'qE9UNxBk4b','2018-05-12 15:56:18','2018-05-12 15:56:18'),
	(10,'Derek Jast','wohara@example.net','hand.stanton','$2y$10$GZLRLnIteUi63wpaTI6NZOVBMSuCtxXKmaRJiJ.KzkMvpIl0TQjZG','http://placehold.it/800x500',NULL,'K0MF94zWgE','2018-05-12 15:56:18','2018-05-12 15:56:18'),
	(11,'Dr. Dylan Becker','fkunde@example.net','amaya22','$2y$10$AerMGWxYjnpBoAOR07ViCu8WRI2wdvFrGZ4mmsuHB9tRftdv2H/am','http://placehold.it/800x500',NULL,'T67QE0QicP','2018-05-12 15:56:18','2018-05-12 15:56:18');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
