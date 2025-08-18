-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: my_portofolio
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `abouts`
--

DROP TABLE IF EXISTS `abouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `abouts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `freelance_status` tinyint(1) NOT NULL DEFAULT '1',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cv` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abouts`
--

LOCK TABLES `abouts` WRITE;
/*!40000 ALTER TABLE `abouts` DISABLE KEYS */;
INSERT INTO `abouts` VALUES (1,'Passionate Developer dengan 2+ Tahun Pengalaman','Jakarta, Indonesia',1,1,'<p class=\"mb-4\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; color: rgb(31, 41, 55); font-family: Inter, sans-serif;\">Saya adalah seorang <b>Full Stack Developer</b> yang berpengalaman dalam mengembangkan aplikasi web dan mobile yang scalable dan user-friendly. Dengan background yang kuat dalam teknologi modern, saya selalu berusaha memberikan solusi terbaik untuk setiap project.</p><p class=\"mb-4\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; color: rgb(31, 41, 55); font-family: Inter, sans-serif;\">Perjalanan saya di dunia programming dimulai sejak 2024, dan sejak itu saya telah mengerjakan berbagai macam project mulai dari website corporate, e-commerce platform, hingga aplikasi mobile yang kompleks.</p>','16f2fa646e8098b27243ee9804e4af57','4ea09a3efefc8f69ff71f9ab7d64e780.pdf','9','2025-08-17 14:31:07','2025-08-18 06:38:45');
/*!40000 ALTER TABLE `abouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certification`
--

DROP TABLE IF EXISTS `certification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_id` int DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `year` varchar(50) NOT NULL,
  `icon` varchar(50) DEFAULT 'fas fa-certificate',
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `certification_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certification`
--

LOCK TABLES `certification` WRITE;
/*!40000 ALTER TABLE `certification` DISABLE KEYS */;
INSERT INTO `certification` VALUES (1,10,'NodeJS Backend Development with Express JS','SanberCode','2025','fab fa-node-js'),(2,10,'Golang Backend Development','SanberCode','2022','fa-brands fa-golang'),(3,10,'Python - Data Science','SanberCode','2025','fa-brands fa-python'),(4,10,'Flutter - Mobile App Development ','SanberCode','2025','fa-brands fa-flutter'),(5,10,'Programming FrontEnd React Js','SanberCode','2025','fa-brands fa-react');
/*!40000 ALTER TABLE `certification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `education`
--

DROP TABLE IF EXISTS `education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `education` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_id` int DEFAULT NULL,
  `start_year` varchar(10) DEFAULT NULL,
  `end_year` varchar(10) DEFAULT NULL,
  `degree` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `education_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `education`
--

LOCK TABLES `education` WRITE;
/*!40000 ALTER TABLE `education` DISABLE KEYS */;
INSERT INTO `education` VALUES (1,9,'2020','2025','S1 Ilmu Komputer','Universitas Pertamina','Menempuh studi S1 Ilmu Komputer di Universitas Pertamina (2020–2025), saya mempelajari algoritma, struktur data, arsitektur komputer, pengembangan web dan mobile, serta bidang modern seperti cloud computing, jaringan, basis data, dan machine learning, membekali saya dengan pemahaman menyeluruh dan keterampilan praktis dalam membangun solusi teknologi.');
/*!40000 ALTER TABLE `education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text,
  `tech` text,
  `year` varchar(10) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,11,'Sorting and Searching Visualization','bb6952aef4c895a8de457ecf7f0922a3','Sorting and Searching Visualizer adalah aplikasi web interaktif yang membantu pengguna memahami cara kerja algoritma sorting dan searching melalui visualisasi yang jelas dan menarik. Dengan tampilan berupa batang vertikal yang merepresentasikan nilai array, pengguna dapat melihat langsung bagaimana setiap algoritma bekerja langkah demi langkah.\r\n\r\nAplikasi ini dilengkapi dengan berbagai fitur seperti pemilihan algoritma sorting populer (Bubble Sort, Selection Sort, Insertion Sort, Merge Sort, Quick Sort), kontrol interaktif untuk mengatur ukuran array dan kecepatan eksekusi, serta informasi tambahan berupa waktu eksekusi dan notasi Big-O. Dengan navigasi sederhana antara tab Sorting dan Searching, aplikasi ini menjadi alat belajar yang efektif bagi pelajar, mahasiswa, maupun siapa saja yang ingin memahami algoritma secara visual dan intuitif.','[{\"value\":\"JavaScript\"},{\"value\":\"HTML\"},{\"value\":\"CSS\"}]','2023','https://sorting-and-searching-visualization.vercel.app/',1,'2025-08-18 16:21:27','2025-08-18 16:39:05'),(2,11,'Rock-Paper-Scissor','c0c4678e5bb5f05dcc8b3658955ee6a2','Proyek Rock Paper Scissor ini dibuat menggunakan HTML, CSS, dan JavaScript untuk menghadirkan permainan sederhana gunting-batu-kertas. Pada halaman utama, terdapat tampilan skor untuk pemain dan komputer, tombol pilihan dengan ikon gambar (batu, kertas, gunting), serta area yang menampilkan riwayat pilihan terakhir dan pemenang dari setiap ronde. Dengan bantuan jQuery dan file JavaScript eksternal, logika permainan diatur sehingga komputer secara otomatis memilih gerakan secara acak, lalu hasilnya dibandingkan dengan pilihan pemain.\r\n\r\nDesain antarmuka dibuat sederhana dan interaktif, dilengkapi tombol restart agar pemain dapat memulai permainan baru dengan mudah. Struktur HTML disusun rapi dengan elemen-elemen terpisah untuk skor, pilihan, dan hasil, sementara file CSS digunakan untuk mempercantik tampilan agar permainan terasa lebih menarik dan nyaman dimainkan.','[{\"value\":\"JavaScript\"},{\"value\":\"HTML\"},{\"value\":\"CSS\"}]','2023','https://rock-paper-scissor-beta-virid.vercel.app/',1,'2025-08-18 16:45:43','2025-08-18 16:45:43'),(3,11,'Movie Game Hub','3437a94876f4c2a0452ca1522140cf84','Movie Game Hub adalah sebuah aplikasi web modern yang dirancang sebagai pusat hiburan untuk film dan game. Dikembangkan pada tahun 2025, aplikasi ini hadir dengan tampilan interaktif dan fitur yang memudahkan pengguna dalam menemukan informasi, ulasan, serta rekomendasi hiburan favorit mereka.\r\n\r\nDalam pengembangannya, Movie Game Hub memanfaatkan teknologi populer seperti React, JavaScript, Vue.js, dan Bootstrap. Kombinasi teknologi ini memungkinkan aplikasi memiliki performa cepat, desain responsif, serta pengalaman pengguna yang menyenangkan di berbagai perangkat.','[{\"value\":\"React\"},{\"value\":\"JavaScript\"},{\"value\":\"Vue.js\"},{\"value\":\"BootStrap\"}]','2025','https://moviegame.divly.tech/',1,'2025-08-18 16:50:04','2025-08-18 17:01:08'),(4,12,'Weather App','8ea190ced47122cdbd53a4a7a5cfa61e','Aplikasi Weather App berbasis Flutter ini dirancang dengan tampilan modern dan intuitif untuk memberikan informasi cuaca real-time. Data cuaca diperoleh langsung dari API OpenWeatherMap, sehingga pengguna dapat mengetahui kondisi terkini seperti suhu, kelembapan, tekanan udara, serta kecepatan angin secara akurat.\r\n\r\nUntuk mendukung keamanan dan personalisasi pengguna, aplikasi ini dilengkapi dengan sistem autentikasi menggunakan Firebase. Selain itu, pengelolaan state dilakukan dengan GetX, sehingga performa aplikasi tetap ringan, responsif, dan mudah dikembangkan lebih lanjut.','[{\"value\":\"Dart\"},{\"value\":\"OpenWeatherMap API\"},{\"value\":\"Flutter\"},{\"value\":\"GetX\"},{\"value\":\"Firebase Auth\"},{\"value\":\"Lottie\"},{\"value\":\"Google Fonts\"},{\"value\":\"Geolocator\"},{\"value\":\"Cached Network Image\"}]','2025','https://weatherapp-eta-drab.vercel.app/',1,'2025-08-18 17:07:55','2025-08-18 17:10:22');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'services','home','2025-08-17 23:45:13','2025-08-17 23:45:13'),(2,'values','about','2025-08-17 23:45:13','2025-08-17 23:45:13'),(3,'soft-skills','skills','2025-08-17 23:45:13','2025-08-18 02:20:33'),(4,'programming-language','prolanguage','2025-08-18 02:26:27','2025-08-18 02:26:27'),(5,'frontend','technology','2025-08-18 02:26:27','2025-08-18 02:26:27'),(6,'backend','technology','2025-08-18 02:26:27','2025-08-18 02:26:27'),(7,'database','technology','2025-08-18 02:26:27','2025-08-18 02:26:27'),(8,'tools','development','2025-08-18 02:26:27','2025-08-18 02:26:59'),(9,'Pendidikan','education','2025-08-18 07:35:39','2025-08-18 07:35:39'),(10,'Sertifikasi','certification','2025-08-18 07:35:39','2025-08-18 07:35:39'),(11,'Web Application','portfolio','2025-08-18 15:22:30','2025-08-18 15:22:30'),(12,'Mobile App','portfolio','2025-08-18 15:22:30','2025-08-18 15:22:30'),(13,'UI/UX Design','portfolio','2025-08-18 15:22:30','2025-08-18 15:22:30'),(14,'E-Commerce','portfolio','2025-08-18 15:22:30','2025-08-18 15:22:30');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_id` varchar(50) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'1','fas fa-laptop-code','Web Development','Pengembangan website modern dan responsif menggunakan teknologi terkini untuk memberikan pengalaman pengguna terbaik.',1,'2025-08-17 23:49:34'),(2,'1','fas fa-mobile-alt','Mobile App','Pembuatan aplikasi mobile yang user-friendly dan performant untuk platform Android dan iOS.',1,'2025-08-17 23:49:52'),(3,'1','fas fa-paint-brush','UI/UX Design','Desain interface yang menarik dan intuitif untuk meningkatkan engagement dan konversi pengguna.',1,'2025-08-17 23:50:09');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `logo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `twitter` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `linkedin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `github` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `instagram` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (3,'fadlilahdivyy@gmail.com','+6285777784565','Jl. Cempaka Baru Timur No.6                                                                                                ','0c274288c2bc2bf3f731d74331546155','https://x.com/FadlilahDivy','https://www.linkedin.com/in/fadlilah-divy/','https://github.com/divfadli','https://www.instagram.com/fadlilahdivyy_29/','2025-08-17 06:48:06','2025-08-18 05:12:06');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills_items`
--

DROP TABLE IF EXISTS `skills_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skills_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `percentage` int NOT NULL,
  `icon` varchar(100) NOT NULL,
  `color` varchar(20) DEFAULT '#0d6efd',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `skills_items_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  CONSTRAINT `skills_items_chk_1` CHECK (((`percentage` >= 0) and (`percentage` <= 100)))
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills_items`
--

LOCK TABLES `skills_items` WRITE;
/*!40000 ALTER TABLE `skills_items` DISABLE KEYS */;
INSERT INTO `skills_items` VALUES (1,4,'JavaScript',75,'fab fa-js-square','#f7df1e','2025-08-18 04:40:48','2025-08-18 04:40:48'),(2,4,'PHP',85,'fab fa-php','#777bb4','2025-08-18 04:41:16','2025-08-18 04:43:34'),(3,4,'Python',70,'fab fa-python','#3776ab','2025-08-18 04:41:42','2025-08-18 04:41:42'),(4,4,'Java',88,'fab fa-java','#ed8b00','2025-08-18 04:42:26','2025-08-18 14:01:46'),(5,4,'TypeScript',80,'fas fa-code','#3178c6','2025-08-18 04:42:55','2025-08-18 14:01:36'),(7,5,'React.js',85,'fab fa-react','#61dafb','2025-08-18 05:02:06','2025-08-18 05:02:06'),(8,5,'Vue.js',80,'fab fa-vuejs','#4fc08d','2025-08-18 05:02:30','2025-08-18 05:02:30'),(10,5,'HTML5/CSS3',90,'fab fa-html5','#e34f26','2025-08-18 05:03:07','2025-08-18 05:03:07'),(11,5,'Bootstrap',80,'fab fa-bootstrap','#7952b3','2025-08-18 05:03:28','2025-08-18 05:03:28'),(13,6,'Node.js',88,'fab fa-node-js','#339933','2025-08-18 05:04:41','2025-08-18 05:04:41'),(14,6,'Laravel',80,'fab fa-laravel','#ff2d20','2025-08-18 05:04:57','2025-08-18 05:04:57'),(15,6,'Express.js',85,'fas fa-server','#000000','2025-08-18 05:05:16','2025-08-18 05:05:16'),(19,6,'Go',85,'fa-brands fa-golang','#512bd4','2025-08-18 05:07:03','2025-08-18 05:07:03'),(20,4,'Go',88,'fa-brands fa-golang','#512bd4','2025-08-18 05:08:40','2025-08-18 05:08:40'),(21,7,'MySQL',85,'fas fa-database','#F29111','2025-08-18 05:09:28','2025-08-18 05:40:36'),(22,7,'PostgreSQL',90,'fas fa-database','#0064a5','2025-08-18 05:09:22','2025-08-18 05:43:58'),(23,7,'MongoDB',85,'fas fa-leaf','#4DB33D','2025-08-18 05:10:18','2025-08-18 05:43:50'),(24,7,'Firebase',80,'fas fa-fire','#F5820D','2025-08-18 05:10:34','2025-08-18 05:43:45'),(25,8,'Git/GitHub',95,'fab fa-git-alt','#F1502F','2025-08-18 05:33:55','2025-08-18 05:33:55'),(26,8,'Docker',80,'fab fa-docker','#384d54','2025-08-18 05:34:28','2025-08-18 05:34:34'),(27,8,'VS Code',90,'fa-solid fa-code','#0098FF','2025-08-18 05:35:01','2025-08-18 05:39:08'),(28,8,'Postman',95,'fas fa-paper-plane','#EF5B25','2025-08-18 05:38:57','2025-08-18 05:39:28'),(29,4,'dart',75,'fa-brands fa-dart-lang','#01579B','2025-08-18 14:00:58','2025-08-18 14:01:23'),(30,5,'Flutter',75,'fa-brands fa-flutter','#B74093','2025-08-18 14:03:45','2025-08-18 14:03:45');
/*!40000 ALTER TABLE `skills_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `soft_skills`
--

DROP TABLE IF EXISTS `soft_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `soft_skills` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_id` varchar(50) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `soft_skills`
--

LOCK TABLES `soft_skills` WRITE;
/*!40000 ALTER TABLE `soft_skills` DISABLE KEYS */;
INSERT INTO `soft_skills` VALUES (1,'3','fas fa-users','Team Leadership','Kemampuan memimpin dan mengarahkan tim untuk mencapai tujuan bersama',1,'2025-08-17 23:52:36'),(2,'3','fas fa-comments','Communication','Komunikasi yang efektif dengan stakeholder dan anggota tim',1,'2025-08-17 23:52:55'),(3,'3','fas fa-lightbulb','Problem Solving','Analisis dan penyelesaian masalah dengan pendekatan yang sistematis',1,'2025-08-17 23:53:11'),(4,'3','fas fa-clock','Time Management','Manajemen waktu yang baik untuk menyelesaikan project tepat waktu',1,'2025-08-17 23:53:25');
/*!40000 ALTER TABLE `soft_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (9,'Fadlilah Divy','divy@mail.com','telkom123','2025-08-17 06:12:51','2025-08-17 15:29:39');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `values_section`
--

DROP TABLE IF EXISTS `values_section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `values_section` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_id` varchar(50) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `values_section`
--

LOCK TABLES `values_section` WRITE;
/*!40000 ALTER TABLE `values_section` DISABLE KEYS */;
INSERT INTO `values_section` VALUES (1,'2','fas fa-code','Clean Code','Menulis kode yang bersih, mudah dibaca, dan mudah dimaintain untuk memastikan sustainability project jangka panjang.',1,'2025-08-17 23:50:41'),(2,'2','fas fa-users','User-Centered','Selalu mengutamakan pengalaman pengguna dalam setiap desain dan development untuk menciptakan solusi yang intuitif.',1,'2025-08-17 23:50:57'),(3,'2','fas fa-rocket','Innovation','Terus belajar dan mengadopsi teknologi terbaru untuk memberikan solusi yang modern dan efisien.',1,'2025-08-17 23:51:14'),(4,'2','fas fa-clock','Punctuality','Menghargai waktu dan selalu berusaha menyelesaikan project tepat waktu sesuai dengan timeline yang disepakati.',1,'2025-08-17 23:51:29'),(5,'2','fas fa-handshake','Collaboration','Percaya bahwa hasil terbaik dicapai melalui kolaborasi yang baik dengan tim dan stakeholder.',1,'2025-08-17 23:51:44'),(6,'2','fas fa-shield-alt','Quality Assurance','Memastikan setiap deliverable telah melalui testing yang ketat untuk menjamin kualitas dan reliability.',1,'2025-08-17 23:52:01');
/*!40000 ALTER TABLE `values_section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'my_portofolio'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-19  0:33:58
