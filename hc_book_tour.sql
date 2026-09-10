-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: hc_book_tour
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `tour_id` bigint unsigned NOT NULL,
  `booking_date` date NOT NULL,
  `adults` int NOT NULL,
  `children` int DEFAULT '0',
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','completed','cancelled','refunded') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `payment_status` enum('unpaid','paid','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_user_id_foreign` (`user_id`),
  KEY `bookings_tour_id_foreign` (`tour_id`),
  CONSTRAINT `bookings_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`),
  CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (2,1,2,'2025-10-02',10,3,28750.00,'pending','unpaid',NULL,NULL,NULL,NULL,'Có người già say sóng',0.00,'2024-11-23 08:37:33','2024-11-23 08:37:33'),(3,1,2,'2025-10-02',10,3,28750.00,'pending','unpaid',NULL,NULL,NULL,NULL,'Có người già say sóng',0.00,'2024-11-23 08:38:54','2024-11-23 08:38:54'),(4,1,2,'2025-10-01',30,10,87500.00,'confirmed','paid','fake_payment',NULL,'FAKE_1732377068','2024-11-23 08:51:08','Có người già say sóng',0.00,'2024-11-23 08:48:53','2024-11-23 08:51:08'),(5,1,1,'2025-10-01',10,10,18000.00,'pending','unpaid','bank',NULL,NULL,NULL,'Ổn',0.00,'2024-11-23 09:31:32','2024-11-23 09:31:32'),(6,1,1,'2025-10-01',10,10,18000.00,'pending','unpaid','bank',NULL,NULL,NULL,'Ổn',0.00,'2024-11-23 09:32:51','2024-11-23 09:32:51'),(7,1,1,'2025-10-01',10,10,18000.00,'pending','unpaid','bank',NULL,NULL,NULL,'Ổn',0.00,'2024-11-23 09:33:03','2024-11-23 09:33:03'),(8,1,1,'2025-10-01',10,2,13200.00,'pending','unpaid','bank',NULL,NULL,NULL,'Không',0.00,'2024-11-23 10:35:58','2024-11-23 10:35:58'),(9,1,2,'2025-10-01',10,3,28750.00,'pending','unpaid','bank',NULL,NULL,NULL,'Không',0.00,'2024-11-23 10:47:41','2024-11-23 10:47:41'),(10,1,4,'2024-11-24',1,0,1800.00,'cancelled','unpaid',NULL,NULL,NULL,NULL,'dwfewfw',1800.00,'2024-11-23 12:17:56','2024-11-26 07:04:14'),(11,1,2,'2024-11-24',1,0,2500.00,'confirmed','paid','cash','TXN_67422c2d5afb3',NULL,NULL,NULL,2500.00,'2024-11-23 12:25:29','2024-11-23 12:25:33'),(12,1,2,'2024-11-24',4,3,13750.00,'confirmed','paid','transfer','TXN_67422ddd61c34',NULL,NULL,'ưetryi6y5trer',13750.00,'2024-11-23 12:32:33','2024-11-23 12:32:45'),(13,1,2,'2024-11-24',2,3,8750.00,'confirmed','paid','cash','TXN_674231b07c33b',NULL,NULL,'vui vẻ',8750.00,'2024-11-23 12:48:53','2024-11-23 12:49:04'),(14,1,4,'2024-11-24',3,4,9000.00,'confirmed','paid','cash','TXN_674232d0f4176',NULL,NULL,'test gmail',9000.00,'2024-11-23 12:53:16','2024-11-23 12:53:52'),(15,1,1,'2024-11-25',3,2,4800.00,'confirmed','paid','cash','TXN_6742c8fee07d7',NULL,NULL,'Ổn nha',4800.00,'2024-11-23 23:34:26','2024-11-23 23:34:38'),(16,1,3,'2025-10-01',3,1,5250.00,'confirmed','paid','transfer','TXN_67440524e0a99',NULL,NULL,'Ổn',5250.00,'2024-11-24 22:02:38','2024-11-24 22:03:32'),(17,1,1,'2024-11-27',3,5,6600.00,'confirmed','paid','transfer','TXN_6745d1e55e35b',NULL,NULL,'Có 2 người say sóng',6600.00,'2024-11-26 06:39:28','2024-11-26 06:49:25'),(18,4,2,'2024-11-27',3,2,10000.00,'confirmed','paid','transfer','TXN_6745fe4a9b9c7',NULL,NULL,NULL,10000.00,'2024-11-26 09:58:40','2024-11-26 09:58:50'),(20,1,1,'2024-11-29',1,3,3000.00,'confirmed','paid','cash','TXN_6748163e71ec5',NULL,NULL,NULL,3000.00,'2024-11-28 00:05:15','2024-11-28 00:05:34'),(21,1,1,'2028-11-29',3,1,4200.00,'confirmed','paid','transfer','TXN_67485ac7dc615',NULL,NULL,NULL,4200.00,'2024-11-28 04:40:12','2024-11-28 04:57:59'),(22,1,1,'2024-11-30',2,2,3600.00,'pending','unpaid',NULL,NULL,NULL,NULL,NULL,3600.00,'2024-11-29 11:22:10','2024-11-29 11:22:10');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('da4b9237bacccdf19c0760cab7aec4a8359010b0','i:2;',1732909365),('da4b9237bacccdf19c0760cab7aec4a8359010b0:timer','i:1732909365;',1732909365);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Kinh Nghiệm Du Lịch','kinh-nghiem-du-lich',NULL,NULL),(2,'Điểm Đến Hấp Dẫn','diem-den-hap-dan',NULL,NULL),(3,'Khám Phá Văn Hóa','kham-pha-van-hoa',NULL,NULL),(4,'Ẩm Thực Du Lịch','am-thuc-du-lich',NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','read','replied') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'Lê Văn Cảm','camlv.23itb@vku.udn.vn','0344573050','Liên hệ cung cấp tour','Tôi đại diện cho khu du lịch Phong Nha-Kẽ Bàng-Quảng Bình, muốn hợp tác với bạn để đăng tour của mình lên','pending','2024-11-27 03:34:45','2024-11-27 03:34:45');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `destinations`
--

DROP TABLE IF EXISTS `destinations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `destinations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `destinations_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destinations`
--

LOCK TABLES `destinations` WRITE;
/*!40000 ALTER TABLE `destinations` DISABLE KEYS */;
INSERT INTO `destinations` VALUES (1,'Hạ Long','ha-long','Di sản thiên nhiên thế giới với hàng nghìn hòn đảo đá vôi, hang động kỳ vĩ và văn hóa làng chài độc đáo','halong.jpg','active','2024-11-18 14:43:53','2024-11-18 14:43:53'),(2,'Phú Quốc','phu-quoc','Đảo ngọc với bãi biển cát trắng, nước biển trong xanh, thiên đường nghỉ dưỡng và ẩm thực hải sản','phuquoc.jpg','active','2024-11-18 14:43:53','2024-11-18 14:43:53'),(3,'Đà Nẵng','da-nang','Thành phố đáng sống với cầu Rồng, Bà Nà Hills, biển Mỹ Khê và ẩm thực phong phú','danang.jpg','active','2024-11-18 14:43:53','2024-11-18 14:43:53'),(4,'Sapa','sapa','Thị trấn trong mây với ruộng bậc thang, văn hóa dân tộc và đỉnh Fansipan hùng vĩ','sapa.jpg','active','2024-11-18 14:43:53','2024-11-18 14:43:53'),(5,'Nha Trang','nha-trang','Thành phố biển xinh đẹp với vịnh biển, các đảo hoang sơ và khu du lịch giải trí sôi động','nhatrang.jpg','active','2024-11-18 14:43:53','2024-11-18 14:43:53'),(6,'Đà Lạt','da-lat','Thành phố ngàn hoa với khí hậu mát mẻ, kiến trúc Pháp và những khu vườn hoa tuyệt đẹp','dalat.jpg','active','2024-11-18 14:43:53','2024-11-18 14:43:53'),(22,'Hà Nội','ha-noi','Thủ đô ngàn năm văn hiến với nhiều di tích lịch sử như Văn Miếu - Quốc Tử Giám, Lăng Chủ tịch Hồ Chí Minh, và Hồ Hoàn Kiếm. Thành phố còn hấp dẫn du khách bởi ẩm thực đường phố phong phú và các khu phố cổ kính.','hanoi.jpg','active','2024-12-19 13:55:36','2024-12-19 13:55:36'),(23,'Hồ Chí Minh','ho-chi-minh','Thành phố Hồ Chí Minh, trung tâm kinh tế lớn nhất Việt Nam, là nơi giao thoa giữa văn hóa truyền thống và hiện đại. Du khách có thể tham quan Dinh Độc Lập, Nhà thờ Đức Bà, và chợ Bến Thành, cũng như thưởng thức ẩm thực đa dạng.','hochiminh.jpg','active','2024-12-19 13:55:36','2024-12-19 13:55:36'),(24,'Huế','hue','Huế, cố đô của Việt Nam, nổi tiếng với quần thể di tích Cố đô Huế được UNESCO công nhận là di sản thế giới. Du khách có thể khám phá Đại Nội, các lăng tẩm của các vị vua triều Nguyễn, và thưởng thức nhã nhạc cung đình Huế.','hue.jpg','active','2024-12-19 13:55:36','2024-12-19 13:55:36'),(25,'Hội An','hoi-an','Hội An, phố cổ được UNESCO công nhận là di sản văn hóa thế giới, nổi bật với kiến trúc cổ kính và những chiếc đèn lồng rực rỡ. Du khách có thể dạo bước trên những con phố nhỏ, thưởng thức ẩm thực địa phương và tham gia các hoạt động văn hóa.','hoian.jpg','active','2024-12-19 13:55:36','2024-12-19 13:55:36'),(26,'Ninh Bình','ninh-binh','Ninh Bình, được mệnh danh là \"Hạ Long trên cạn\", nổi tiếng với cảnh quan thiên nhiên hùng vĩ của Tràng An, Tam Cốc - Bích Động, và chùa Bái Đính. Đây là điểm đến lý tưởng cho những ai yêu thích khám phá thiên nhiên và văn hóa.','ninhbinh.jpg','active','2024-12-19 13:55:36','2024-12-19 13:55:36'),(27,'Quảng Bình','quang-binh','Quảng Bình, nơi có Phong Nha-Kẻ Bàng, di sản thiên nhiên thế giới, nổi tiếng với hệ thống hang động kỳ vĩ và đa dạng sinh học. Du khách có thể tham gia các tour khám phá hang động và trải nghiệm cuộc sống địa phương.','quangbinh.jpg','active','2024-12-19 13:55:36','2024-12-19 13:55:36'),(28,'Cần Thơ','can-tho','Cần Thơ, thủ phủ miền Tây, nổi tiếng với chợ nổi Cái Răng, vườn trái cây và các làng nghề truyền thống. Du khách có thể tham gia các tour du lịch sinh thái, khám phá văn hóa sông nước và thưởng thức ẩm thực miền Tây.','cantho.jpg','active','2024-12-19 13:55:36','2024-12-19 13:55:36'),(29,'Vũng Tàu','vung-tau','Vũng Tàu, thành phố biển gần Sài Gòn, nổi tiếng với bãi biển đẹp, hải sản tươi ngon và các điểm tham quan như tượng Chúa Kitô Vua, ngọn hải đăng và Bạch Dinh.','vungtau.jpg','active','2024-12-19 13:55:36','2024-12-19 13:55:36'),(30,'Quy Nhơn','quy-nhon','Quy Nhơn, thành phố biển với bãi biển hoang sơ, ẩm thực phong phú và các di tích lịch sử như tháp Chăm, đầm Thị Nại và Ghềnh Ráng.','quynhon.jpg','active','2024-12-19 13:55:36','2024-12-19 13:55:36');
/*!40000 ALTER TABLE `destinations` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000001_create_cache_table',1),(2,'0001_01_01_000002_create_jobs_table',1),(3,'2024_11_17_191237_create_users_table',1),(4,'2024_11_17_191245_create_destinations_table',1),(5,'2024_11_17_191252_create_tours_table',1),(6,'2024_11_17_191256_create_bookings_table',1),(7,'2024_11_17_191302_create_payments_table',1),(8,'2024_11_17_191315_create_reviews_table',1),(10,'2024_11_18_181654_create_schedules_table',2),(11,'2024_11_20_083840_modify_role_enum_in_users_table',3),(12,'2024_11_20_111534_create_password_reset_tokens_table',4),(13,'2024_11_20_112935_create_permission_tables',5),(14,'2024_11_20_185204_create_posts_table',6),(15,'2024_11_20_185253_create_categories_table',6),(16,'2024_11_20_185333_create_tags_table',6),(17,'2024_11_20_185415_create_post_tag_table',6),(18,'2024_11_21_022240_create_categories_table',7),(19,'2024_11_21_022247_create_posts_table',7),(20,'2024_11_21_022427_create_tag_table',7),(21,'2024_11_21_022444_create_post_tag_table',7),(22,'2024_11_21_041049_add_payment_fields_to_bookings_table',8),(23,'2024_11_21_054406_update_bookings_table',9),(24,'2024_11_21_140902_add_gallery_to_tours_table',10),(25,'2024_11_23_105157_add_approval_and_foreign_key_to_tours',11),(26,'2024_11_23_165533_create_pending_bookings_table',12),(27,'2024_11_23_170255_create_payments_table',12),(28,'2024_11_23_191314_add_total_amount_to_bookings_table',13),(29,'2024_11_23_192316_add_transaction_id_to_bookings_table',14),(30,'2024_11_23_124247_add_user_id_to_tours',15),(31,'2024_11_26_203402_add_avatar_url_to_users_table',16),(32,'2024_11_27_102714_create_contacts_table',17);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES ('camlv.23itb@vku.udn.vn','$2y$12$IrYeDDjcIj4KucKis02G4.iXGCOZ4XFwlD7E5SwOMh/SJGU63y182','2024-12-19 18:57:49');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','completed','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `payment_data` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_booking_id_foreign` (`booking_id`),
  CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pending_bookings`
--

DROP TABLE IF EXISTS `pending_bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pending_bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `tour_id` bigint unsigned NOT NULL,
  `booking_date` date NOT NULL,
  `adults` int NOT NULL,
  `children` int NOT NULL DEFAULT '0',
  `total_amount` decimal(10,2) NOT NULL,
  `reference_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','completed','expired','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `expires_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pending_bookings_reference_code_unique` (`reference_code`),
  KEY `pending_bookings_user_id_foreign` (`user_id`),
  KEY `pending_bookings_tour_id_foreign` (`tour_id`),
  CONSTRAINT `pending_bookings_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`),
  CONSTRAINT `pending_bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pending_bookings`
--

LOCK TABLES `pending_bookings` WRITE;
/*!40000 ALTER TABLE `pending_bookings` DISABLE KEYS */;
INSERT INTO `pending_bookings` VALUES (1,1,2,'2025-01-01',10,3,28750.00,'BKWQT4CD4B','pending','Không','2024-11-24 11:12:09','2024-11-23 11:12:09','2024-11-23 11:12:09'),(2,1,4,'2025-01-01',10,3,20700.00,'BK04EEOTXY','pending','Không','2024-11-24 11:15:45','2024-11-23 11:15:45','2024-11-23 11:15:45'),(3,1,2,'2025-01-01',10,3,28750.00,'BKFVQWP1Q1','pending','Không','2024-11-24 11:18:45','2024-11-23 11:18:45','2024-11-23 11:18:45'),(4,1,2,'2025-01-01',10,3,28750.00,'BKBCNGXQXB','pending','Không','2024-11-24 11:20:44','2024-11-23 11:20:44','2024-11-23 11:20:44'),(5,1,2,'2025-01-01',10,3,28750.00,'BKNR7UIB5S','pending','Không','2024-11-24 11:23:16','2024-11-23 11:23:16','2024-11-23 11:23:16');
/*!40000 ALTER TABLE `pending_bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tag`
--

DROP TABLE IF EXISTS `post_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_tag` (
  `post_id` bigint unsigned NOT NULL,
  `tag_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `post_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tag`
--

LOCK TABLES `post_tag` WRITE;
/*!40000 ALTER TABLE `post_tag` DISABLE KEYS */;
INSERT INTO `post_tag` VALUES (2,1),(6,1),(1,2),(3,2),(4,2),(5,3),(1,4),(5,4),(6,4),(2,5),(4,6),(3,7);
/*!40000 ALTER TABLE `post_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_category_id_foreign` (`category_id`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Top 10 Địa Điểm Du Lịch Đà Nẵng Không Thể Bỏ Qua','top-10-dia-diem-du-lich-da-nang','Đà Nẵng - thành phố của những cây cầu, với Cầu Rồng biểu tượng phun lửa và phun nước vào cuối tuần. Bãi biển Mỹ Khê trải dài với cát trắng mịn, nước biển trong xanh. Bà Nà Hills với Cầu Vàng nổi tiếng thế giới...','img/blog/post/1.jpg',2,1,'2024-11-21 03:22:19','2024-11-21 03:22:19'),(2,'Kinh Nghiệm Du Lịch Sapa Tự Túc 2024','kinh-nghiem-du-lich-sapa-tu-tuc','Hướng dẫn chi tiết cách đi Sapa tự túc, từ việc chọn phương tiện di chuyển, khách sạn giá tốt, đến các địa điểm tham quan hấp dẫn như Fansipan, bản Cát Cát...','img/blog/post/2.jpg',1,1,'2024-11-21 03:22:19','2024-11-21 03:22:19'),(3,'Khám Phá Ẩm Thực Đường Phố Hội An','kham-pha-am-thuc-duong-pho-hoi-an','Hội An không chỉ nổi tiếng với phố cổ mà còn có nền ẩm thực đường phố đặc sắc. Từ Cao lầu, Mì Quảng đến Hoành thánh, mỗi món ăn đều mang đậm bản sắc văn hóa...','img/blog/post/3.jpg',4,1,'2024-11-21 03:22:19','2024-11-21 03:22:19'),(4,'Trải Nghiệm Văn Hóa Tây Nguyên: Tour Buôn Ma Thuột','trai-nghiem-van-hoa-tay-nguyen','Khám phá vùng đất Tây Nguyên với những buôn làng đồng bào dân tộc, thưởng thức café nguyên chất, tham quan thác Dray Nur hùng vĩ...','img/blog/post/4.jpg',3,1,'2024-11-21 03:22:19','2024-11-21 03:22:19'),(5,'Hướng Dẫn Du Lịch Phú Quốc Tiết Kiệm','huong-dan-du-lich-phu-quoc','Bí quyết du lịch Phú Quốc với ngân sách hợp lý. Từ cách đặt vé máy bay giá rẻ, chọn homestay đẹp đến lịch trình khám phá đảo ngọc...','img/blog/post/5.jpg',1,1,'2024-11-21 03:22:19','2024-11-21 03:22:19'),(6,'Những Trải Nghiệm Không Thể Bỏ Lỡ Ở Hạ Long','trai-nghiem-khong-the-bo-lo-o-ha-long','Khám phá vịnh Hạ Long - Di sản thiên nhiên thế giới với những hang động kỳ bí, các làng chài thú vị và hoạt động thể thao trên biển...','img/blog/post/6.jpg',2,1,'2024-11-21 03:22:19','2024-11-21 03:22:19');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `tour_id` bigint unsigned NOT NULL,
  `rating` int NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  KEY `reviews_tour_id_foreign` (`tour_id`),
  CONSTRAINT `reviews_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`),
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,1,1,5,'Chuyến đi vừa qua thật sự là một trải nghiệm đáng nhớ đối với tôi và gia đình. Phong cảnh tại điểm đến vô cùng tuyệt đẹp, được tổ chức chu đáo và chuyên nghiệp. Đặc biệt, hướng dẫn viên không chỉ thân thiện mà còn rất hiểu biết, giải thích từng chi tiết lịch sử và văn hóa một cách rất thú vị. Dịch vụ ăn uống và nghỉ ngơi cũng rất tốt, đáp ứng mọi nhu cầu của đoàn. Chắc chắn tôi sẽ giới thiệu tour này đến bạn bè và quay lại lần sau!','approved',NULL,NULL),(2,2,2,5,'Chuyến đi này đã vượt xa sự mong đợi của tôi. Tất cả mọi thứ, từ chất lượng dịch vụ, phong cách làm việc chuyên nghiệp đến sự quan tâm từng chi tiết nhỏ, đều rất tuyệt vời. Phong cảnh tại các địa điểm thăm quan đẹp đến ngỡ ngàng, khiến tôi cảm thấy thật sự thư giãn và yêu đời hơn. Tôi cũng rất ấn tượng với cách mà công ty tổ chức các hoạt động tương tác trong đoàn, giúp mọi người kết nối và tạo ra những kỷ niệm đáng nhớ. Một trải nghiệm không thể tuyệt vời hơn!','approved',NULL,NULL),(3,1,2,4,'Tôi đã tham gia rất nhiều tour trước đây nhưng phải nói rằng đây là một trong những tour du lịch để lại ấn tượng nhất. Từ khâu chuẩn bị, đón tiếp đến từng hoạt động trong chuyến đi, tất cả đều được tổ chức một cách bài bản và chuyên nghiệp. Lịch trình hợp lý, không quá gấp gáp, giúp mọi người có thời gian tận hưởng trọn vẹn phong cảnh thiên nhiên. Điểm cộng lớn nhất là đội ngũ hướng dẫn viên rất nhiệt tình, luôn tạo không khí vui vẻ cho cả đoàn. Rất đáng để trải nghiệm!','approved',NULL,NULL);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tour_id` bigint unsigned NOT NULL,
  `day` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedules_tour_id_foreign` (`tour_id`),
  CONSTRAINT `schedules_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES (1,1,1,'Ngày 1 - Đến nơi','Đến địa điểm và nhận phòng khách sạn.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(2,1,2,'Ngày 2 - Tham quan vịnh Hạ Long','Tham quan vịnh Hạ Long bằng du thuyền.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(3,1,3,'Ngày 3 - Khám phá hang động','Thăm các hang động nổi tiếng trong vịnh.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(4,1,4,'Ngày 4 - Khởi hành về','Trả phòng khách sạn và về nhà.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(5,2,1,'Ngày 1 - Đến nơi','Đến Phú Quốc và nhận phòng khách sạn.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(6,2,2,'Ngày 2 - Tham quan đảo','Tham quan các đảo xung quanh Phú Quốc.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(7,2,3,'Ngày 3 - Nghỉ ngơi và vui chơi','Thưởng thức các dịch vụ tại resort.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(8,2,4,'Ngày 4 - Khởi hành về','Trả phòng khách sạn và về nhà.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(9,3,1,'Ngày 1 - Đến nơi','Đến Đà Nẵng và nhận phòng khách sạn.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(10,3,2,'Ngày 2 - Tham quan Bà Nà Hills','Khám phá Bà Nà Hills và các trò chơi.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(11,3,3,'Ngày 3 - Thăm phố cổ Hội An','Dạo quanh phố cổ Hội An, thưởng thức ẩm thực.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(12,3,4,'Ngày 4 - Tham quan bảo tàng','Thăm bảo tàng và các di tích lịch sử.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(13,4,1,'Ngày 1 - Đến nơi','Đến Sapa và nhận phòng khách sạn.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(14,4,2,'Ngày 2 - Chinh phục Fansipan','Tham gia leo núi Fansipan.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(15,4,3,'Ngày 3 - Thăm bản làng','Khám phá văn hóa và cuộc sống của người dân bản địa.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(16,4,4,'Ngày 4 - Khởi hành về','Trả phòng khách sạn và về nhà.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(17,5,1,'Ngày 1 - Đến nơi','Đến Nha Trang và nhận phòng khách sạn.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(18,5,2,'Ngày 2 - Tham quan Vinpearl Land','Tham quan Vinpearl Land và các trò chơi.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(19,5,3,'Ngày 3 - Thăm các đảo','Tham quan các đảo và thưởng thức hải sản.','2024-11-20 18:21:03','2024-11-20 18:21:03'),(20,5,4,'Ngày 4 - Khởi hành về','Trả phòng khách sạn và về nhà.','2024-11-20 18:21:03','2024-11-20 18:21:03');
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'Miền Bắc','mien-bac',NULL,NULL),(2,'Miền Trung','mien-trung',NULL,NULL),(3,'Miền Nam','mien-nam',NULL,NULL),(4,'Du Lịch Biển','du-lich-bien',NULL,NULL),(5,'Phượt','phuot',NULL,NULL),(6,'Văn Hóa','van-hoa',NULL,NULL),(7,'Ẩm Thực','am-thuc',NULL,NULL);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tours`
--

DROP TABLE IF EXISTS `tours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tours` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `destination_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` int NOT NULL,
  `max_people` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery` json DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `status_approval` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tours_slug_unique` (`slug`),
  KEY `tours_destination_id_foreign` (`destination_id`),
  KEY `tours_user_id_foreign` (`user_id`),
  CONSTRAINT `tours_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`),
  CONSTRAINT `tours_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tours`
--

LOCK TABLES `tours` WRITE;
/*!40000 ALTER TABLE `tours` DISABLE KEYS */;
INSERT INTO `tours` VALUES (1,1,2,'Tour Hạ Long 3N2Đ','tour-ha-long-3n2d','Khám phá vịnh Hạ Long với du thuyền 5 sao, hang động tuyệt đẹp và làng chài truyền thống',1200.00,5,15,'1.jpg','[\"1.jpg\", \"2.jpg\", \"3.jpg\"]','active','pending','2024-11-18 14:44:29','2024-11-18 14:44:29'),(2,2,2,'Tour Phú Quốc 4N3Đ','tour-phu-quoc-4n3d','Tận hưởng thiên đường biển đảo với bãi sao, vinpearl land và các điểm tham quan nổi tiếng',2500.00,7,10,'2.jpg','[\"2.jpg\", \"22.jpg\", \"3.jpg\"]','active','pending','2024-11-18 14:44:29','2024-11-18 14:44:29'),(3,3,2,'Tour Đà Nẵng - Hội An 5N4Đ','tour-da-nang-hoi-an-5n4d','Khám phá Bà Nà Hills, Phố cổ Hội An, Cù Lao Chàm và nhiều điểm đến hấp dẫn',1500.00,6,12,'3.jpg','[\"3.jpg\", \"33.jpg\", \"4.jpg\"]','active','pending','2024-11-18 14:44:29','2024-11-18 14:44:29'),(4,4,2,'Tour Sapa - Fansipan 3N2Đ','tour-sapa-fansipan-3n2d','Chinh phục đỉnh Fansipan, thăm bản Cat Cat và trải nghiệm văn hóa dân tộc Tây Bắc',1800.00,5,15,'4.jpg','[\"4.jpg\", \"44.jpg\", \"5.jpg\"]','active','pending','2024-11-18 14:44:29','2024-11-18 14:44:29'),(5,5,2,'Tour Nha Trang 4N3Đ','tour-nha-trang-4n3d','Tham quan Vinpearl Land, 4 đảo, tắm bùn và thưởng thức hải sản tươi ngon',2200.00,6,10,'5.jpg','[\"5.jpg\", \"11.jpg\", \"6.jpg\"]','active','pending','2024-11-18 14:44:29','2024-11-18 14:44:29'),(6,6,2,'Tour Đà Lạt 3N2Đ','tour-da-lat-3n2d','Thành phố ngàn hoa với vườn hoa, thác nước, và khí hậu mát mẻ quanh năm',2000.00,7,12,'6.jpg','[\"6.jpg\", \"1.jpg\", \"2.jpg\"]','active','pending','2024-11-18 14:44:29','2024-11-18 14:44:29');
/*!40000 ALTER TABLE `tours` ENABLE KEYS */;
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
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user','spadmin') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Cảm đâyy','camlv.23itb@vku.udn.vn','$2y$12$gSWRGc4K7jhRDfdiVGI0PuDV9foOXEmu4ff.a0qYkMdHkKFHymFiG',NULL,NULL,'user','active','DxlJmaxFY4A8x57IYtVhOA0J0Pvas7uYWYxFkqYDe9Dgt2Rs5udVISCjK17r','2024-11-19 17:36:49','2024-12-18 14:40:42','assets/images/users/1732713020_1.jpg'),(2,'Huy gia','huypmg.23itb@gmail.com','$2y$12$MfVXDOcRva4cQsgSJJIwnOLhPQv2Nw8Wxtx4akbx4O9wnBu5xf.V2','0353455074',NULL,'admin','active',NULL,'2024-11-19 23:09:40','2024-11-19 23:09:40','assets/images/users/user-5.jpg'),(3,'Admin','lvcama2k25@gmail.com','$2y$12$TiyyXLcz.XHNHPPvz/JI/ODSyV51AV012In3tBk26yIjnLmO8NC1m',NULL,NULL,'spadmin','active',NULL,'2024-11-20 01:40:52','2024-11-20 01:40:52',NULL),(4,'Cảm lee','camdz1209@gmail.com','$2y$12$WvWWez5RnK4xdWlo7.4y9eyKbnimgTY1ysMXPuFx2mnqWVT8Rdtnm','0344574050',NULL,'user','active',NULL,'2024-11-24 11:08:47','2024-11-26 12:22:25',NULL);
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

-- Dump completed on 2024-12-20 16:15:09
