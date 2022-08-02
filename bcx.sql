-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: bcx
-- ------------------------------------------------------
-- Server version	8.0.29-0ubuntu0.21.10.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2013_07_31_041625_create_roles_table',1),(2,'2014_10_12_000000_create_users_table',1),(3,'2014_10_12_100000_create_password_resets_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2022_07_31_184917_create_permissions_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint NOT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (43,2,'users.index','2022-08-02 00:54:33','2022-08-02 00:54:33'),(44,2,'users.show','2022-08-02 00:54:33','2022-08-02 00:54:33'),(45,2,'users.edit','2022-08-02 00:54:33','2022-08-02 00:54:33'),(46,2,'profile.edit','2022-08-02 00:54:33','2022-08-02 00:54:33'),(47,2,'profile.view','2022-08-02 00:54:33','2022-08-02 00:54:33'),(48,3,'users.index','2022-08-02 00:55:20','2022-08-02 00:55:20'),(49,3,'users.create','2022-08-02 00:55:20','2022-08-02 00:55:20'),(50,3,'users.show','2022-08-02 00:55:20','2022-08-02 00:55:20'),(51,3,'profile.edit','2022-08-02 00:55:20','2022-08-02 00:55:20'),(52,3,'profile.view','2022-08-02 00:55:20','2022-08-02 00:55:20'),(53,4,'profile.edit','2022-08-02 00:55:43','2022-08-02 00:55:43'),(54,4,'profile.view','2022-08-02 00:55:43','2022-08-02 00:55:43'),(60,1,'users.index','2022-08-02 01:13:55','2022-08-02 01:13:55'),(61,1,'users.create','2022-08-02 01:13:55','2022-08-02 01:13:55'),(62,1,'users.show','2022-08-02 01:13:55','2022-08-02 01:13:55'),(63,1,'users.edit','2022-08-02 01:13:55','2022-08-02 01:13:55'),(64,1,'users.destroy','2022-08-02 01:13:55','2022-08-02 01:13:55'),(65,1,'permission.index','2022-08-02 01:13:55','2022-08-02 01:13:55'),(66,1,'permission.store','2022-08-02 01:13:55','2022-08-02 01:13:55'),(67,1,'profile.edit','2022-08-02 01:13:55','2022-08-02 01:13:55'),(68,1,'profile.view','2022-08-02 01:13:55','2022-08-02 01:13:55');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','Must have full rights','2022-07-31 11:46:39','2022-07-31 11:46:39'),(2,'Support','Must be able to view and edit users','2022-07-31 11:46:39','2022-07-31 11:46:39'),(3,'Manager','Must be able to create user and view user','2022-07-31 11:46:39','2022-07-31 11:46:39'),(4,'User','Must be able to view and edit own details','2022-07-31 11:46:39','2022-07-31 11:46:39'),(5,'Custom','Is blank must be able to do nothing','2022-07-31 11:46:39','2022-07-31 11:46:39');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cell` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Harrison','Williamson','javonte77','karine45@example.com','1-901-214-2232','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','72089 Anderson Viaduct\nPort Coty, MO 13557','Marking Machine Operator',NULL,'pUpR76jUc4','2022-07-31 11:46:36','2022-07-31 14:30:40','2022-07-31 14:30:40'),(2,'Pascale','Halvorson','jana90','zgutkowski@example.org','+1-678-914-8319','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','394 Walter Place\nZboncakberg, NM 56207-4340','Film Laboratory Technician',NULL,'HzYE04DuKI','2022-07-31 11:46:37','2022-08-01 13:38:31','2022-08-01 13:38:31'),(3,'Ezra','Davis','jsimonis','emmerich.johnathan@example.net','737-432-5186','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','7777 Towne Squares\nJaredmouth, MO 36032-7146','Social and Human Service Assistant',NULL,'Rsb0iI3kBT','2022-07-31 11:46:37','2022-07-31 14:30:49','2022-07-31 14:30:49'),(4,'Hugh','Renner','abagail76','rippin.randi@example.com','+1-865-768-4942','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','13424 Emard Mission Apt. 840\nJacobsshire, NJ 20186-6795','Industrial Production Manager',NULL,'q1RniZ1zJY','2022-07-31 11:46:37','2022-08-01 13:45:58','2022-08-01 13:45:58'),(5,'Aimee','Pollich','fausto.bednar','bettye.hahn@example.org','+1 (715) 855-8358','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','12501 Kub Key Apt. 049\nGoyettemouth, NM 79869','Cooling and Freezing Equipment Operator',NULL,'f7cYgUCULJ','2022-07-31 11:46:37','2022-08-01 13:39:47','2022-08-01 13:39:47'),(6,'Ellen','Roberts','ethyl14','krunolfsson@example.org','(959) 584-3287','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','90162 Cleta Track\nSouth Clarissaville, TX 43470','Brattice Builder',NULL,'mCaNvAqCyA','2022-07-31 11:46:37','2022-08-01 13:43:41','2022-08-01 13:43:41'),(7,'Tierra','Baumbach','amelie58','deion36@example.org','+1-878-214-6760','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','29399 Javier Valleys\nLake Garrickland, WA 11570','Poet OR Lyricist',NULL,'noPZM1smys','2022-07-31 11:46:37','2022-08-01 13:45:49','2022-08-01 13:45:49'),(8,'Casper','Keeling','isabell45','roy.ernser@example.org','1-959-202-7587','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','54184 Nolan Glen\nEast Gregory, SD 03343','License Clerk',1,'7h81B8vB9n','2022-07-31 11:46:38','2022-08-02 01:01:30','2022-08-02 01:01:30'),(9,'Olga','Pacocha','kerluke.marguerite','reid87@example.net','848-670-1732','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','103 Barrows Route Apt. 004\nNew Colten, NE 69172','Infantry',NULL,'PfSkqCPAm4','2022-07-31 11:46:38','2022-08-02 01:01:28','2022-08-02 01:01:28'),(10,'Kaitlyn','Wolf','dernser','hegmann.mariano@example.com','1-520-643-2621','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','12216 Sally Curve Apt. 015\nGriffinmouth, CO 70966-8472','Woodworking Machine Setter',NULL,'ZHNZuCCTqm','2022-07-31 11:46:38','2022-08-01 13:44:37','2022-08-01 13:44:37'),(11,'Admin Name','AdminSurname','Admin','admin@bcx.assessment','0123456789','$2y$10$mzM6QQYQBtqSzFyLwmS5r.rEAKn7alWX5EgxBC9uwvdmkbjDtIg72','123 Address Street, Pretoria','System Admin',1,'BJE4BgvyQbuKs3lab5Ma7QuVmoBUV72H7EVaX7ertn9MuybmmKSuWw7Pqb5f','2022-07-31 11:46:39','2022-08-02 00:52:52',NULL),(12,'Liberty Mutabvuri','rerer','admin@bcx.com','adultplaycener@gmail.com','675656','$2y$10$PujJ/A1mBVFUFXtGJ1UZhOCqS0DHoOOpXlgbMj.ZMcC7e.Hs6tB0a','A241 Kempton Place, 12 Pretoria Road','ererer',4,NULL,'2022-07-31 15:57:16','2022-08-02 01:01:18','2022-08-02 01:01:18'),(13,'Liberty Mutabvuri','Myutr','rererererer','adultplaycenter@gmail.com','545445453','$2y$10$DwhFbEezV.FatIBCwirBg.L91UiFtpeg0qEjplCNT6NkNuJdLlPd.','A241 Kempton Place, 12 Pretoria Road','sfsfsds',1,NULL,'2022-08-01 02:12:56','2022-08-02 01:01:22','2022-08-02 01:01:22'),(14,'Liberty Mutabvuri','fdfdfdf','dewrwradmin@bcx.com','adultplaycenter@gmail.c','asdasasas','$2y$10$SrI56z7evsZGy8U/oV2fDOJchooJ.yrlUxgJwZP3/EkQN8tgCSqba','A241 Kempton Place, 12 Pretoria Road','rtrtrtr',1,NULL,'2022-08-01 02:15:00','2022-08-02 01:01:24','2022-08-02 01:01:24'),(15,'dfffdfd','dfdfd','mutabvuri','admin@bcx.assessmen','dfdfd','$2y$10$BQtiCqLHIjiT2SuOWywaZuglvBkAe7LkGzT/vraRDK403ItxuauZW','rererer','erererer',1,NULL,'2022-08-02 01:08:44','2022-08-02 01:11:51','2022-08-02 01:11:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-02  5:53:57
