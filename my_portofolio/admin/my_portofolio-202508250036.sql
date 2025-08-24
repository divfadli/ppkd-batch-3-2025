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
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `freelance_status` tinyint(1) NOT NULL DEFAULT '1',
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `cv` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abouts`
--

LOCK TABLES `abouts` WRITE;
/*!40000 ALTER TABLE `abouts` DISABLE KEYS */;
INSERT INTO `abouts` VALUES (1,'Passionate Developer dengan 1+ Tahun Pengalaman','Jakarta, Indonesia',1,1,'<p class=\"mb-4\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px;\"><span style=\"font-size: 16px;\">Saya adalah seorang </span><b><span style=\"font-size: 16px;\">Full Stack Developer</span></b><span style=\"font-size: 16px;\"> yang berpengalaman dalam mengembangkan aplikasi web dan mobile yang scalable dan user‑friendly. Dengan background yang kuat dalam teknologi modern, saya selalu berusaha memberikan solusi terbaik untuk setiap project.</span></p><p class=\"mb-4\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px;\"><span style=\"font-size: 16px;\">Perjalanan saya di dunia programming dimulai sejak 2024, dan sejak itu saya telah mengerjakan berbagai macam project mulai dari website corporate, e‑commerce platform, hingga aplikasi mobile yang kompleks.</span></p>','16f2fa646e8098b27243ee9804e4af57','4ea09a3efefc8f69ff71f9ab7d64e780.pdf','1','2025-08-19 00:24:52','2025-08-24 04:08:24','<p class=\"\"><span style=\"font-size: 20px;\">Saya adalah seorang developer berpengalaman dengan passion dalam menciptakan solusi digital yang inovatif dan user-friendly. Spesialisasi dalam pengembangan </span><b><span style=\"font-size: 20px;\">web modern</span></b><span style=\"font-size: 20px;\"> dan </span><b><span style=\"font-size: 20px;\">aplikasi mobile</span></b><span style=\"font-size: 20px;\"> yang mengutamakan performa dan pengalaman pengguna.</span></p>');
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
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `year` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'fa-solid fa-certificate',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `certification_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certification`
--

LOCK TABLES `certification` WRITE;
/*!40000 ALTER TABLE `certification` DISABLE KEYS */;
INSERT INTO `certification` VALUES (1,10,'NodeJS Backend Development with Express JS','SanberCode','2025','fab fa-node-js','2025-08-23 21:21:20',NULL),(2,10,'Golang Backend Development','SanberCode','2022','fa-brands fa-golang','2025-08-23 21:21:20',NULL),(3,10,'Python - Data Science','SanberCode','2025','fa-brands fa-python','2025-08-23 21:21:20',NULL),(4,10,'Flutter - Mobile App Development','SanberCode','2025','fa-brands fa-flutter','2025-08-23 21:21:20',NULL),(5,10,'Programming FrontEnd React Js','SanberCode','2025','fa-brands fa-react','2025-08-23 21:21:20',NULL);
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
  `start_year` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `end_year` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `degree` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `school` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `education_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `education`
--

LOCK TABLES `education` WRITE;
/*!40000 ALTER TABLE `education` DISABLE KEYS */;
INSERT INTO `education` VALUES (1,9,'2020','2025','S1 Ilmu Komputer','Universitas Pertamina','<span style=\"font-size: 16px;\">Menempuh studi S1 Ilmu Komputer Universitas Pertamina (2020–2025) dengan pengalaman belajar algoritma, struktur data, pengembangan web & mobile, cloud computing, jaringan, basis data, serta machine learning, membangun pemahaman komprehensif dan keterampilan praktis di bidang teknologi.</span>','2025-08-23 21:21:25','2025-08-24 13:13:01');
/*!40000 ALTER TABLE `education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experiences`
--

DROP TABLE IF EXISTS `experiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `experiences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `start_year` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `end_year` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `position` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `company` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `achievements` text COLLATE utf8mb4_general_ci,
  `technologies` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiences`
--

LOCK TABLES `experiences` WRITE;
/*!40000 ALTER TABLE `experiences` DISABLE KEYS */;
INSERT INTO `experiences` VALUES (1,'2023','2024','Backend Engineer (Intern)','PT Pupuk Indonesia','Jakarta, Indonesia','Internship','Membantu organisasi dalam mengelola dan melacak ketidakhadiran karyawan secara efektif. Sistem ini menyediakan pendekatan terstruktur untuk menangani berbagai jenis cuti, seperti cuti sakit, cuti tahunan, cuti pribadi, maupun permintaan izin lainnya.','[{\"value\":\"Mempelajari dan menguasai framework Gin dalam 6 bulan\"},{\"value\":\"Berkontribusi dalam pengembangan Absence Management System\"},{\"value\":\"Berkolaborasi dengan tim\"}]','[{\"value\":\"Gin\"},{\"value\":\"Gorm\"},{\"value\":\"Go\"}]','2025-08-23 21:21:34',NULL);
/*!40000 ALTER TABLE `experiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `answer` text COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (6,'Berapa lama waktu pengerjaan project?','Waktu pengerjaan bervariasi tergantung kompleksitas project. Website sederhana biasanya 2-4 minggu, aplikasi web kompleks 2-3 bulan, dan aplikasi mobile 3-6 bulan. Saya akan memberikan timeline yang detail setelah diskusi requirement.',1,'2025-08-24 15:40:25','2025-08-24 15:45:00'),(7,'Apakah menyediakan maintenance setelah project selesai?','Ya, saya menyediakan layanan maintenance dan support. Termasuk bug fixes, security updates, dan minor improvements. Paket maintenance dapat disesuaikan dengan kebutuhan dan budget Anda.',1,'2025-08-24 15:45:39',NULL),(8,'Bagaimana sistem pembayaran?','Sistem pembayaran fleksibel: 50% di awal sebagai down payment, 50% setelah project selesai. Untuk project besar, bisa dibagi dalam beberapa milestone. Pembayaran dapat melalui transfer bank atau e-wallet.',1,'2025-08-24 15:46:01',NULL),(9,'Apakah bisa bekerja remote?','Tentu saja! Saya berpengalaman bekerja remote dengan klien dari berbagai kota. Komunikasi dilakukan melalui video call, chat, dan project management tools. Progress report diberikan secara berkala.',1,'2025-08-24 15:47:31',NULL),(10,'Teknologi apa saja yang dikuasai?','Saya menguasai berbagai teknologi modern: Frontend (React, Vue, Angular), Backend (Node.js, PHP, Laravel), Database (MySQL, MongoDB), Mobile (React Native, Flutter), dan Cloud (AWS, Google Cloud). Lihat halaman Skills untuk detail lengkap.',1,'2025-08-24 15:48:01',NULL);
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `floating_card`
--

DROP TABLE IF EXISTS `floating_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `floating_card` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `floating_card`
--

LOCK TABLES `floating_card` WRITE;
/*!40000 ALTER TABLE `floating_card` DISABLE KEYS */;
INSERT INTO `floating_card` VALUES (7,'19','fas fa-code','Clean Code','Best Practices',1,'2025-08-24 03:45:05',NULL),(8,'19','fas fa-mobile-alt','Responsive','All Devices',1,'2025-08-24 03:45:23',NULL),(9,'19','fas fa-rocket','Fast Loading','Optimized',1,'2025-08-24 03:45:37',NULL);
/*!40000 ALTER TABLE `floating_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (5,'Siti Rahma','siti.rahma@example.com','Mobile App Development','Apakah Anda bisa membuat aplikasi Android untuk e-commerce?','2025-08-24 16:08:12',NULL),(6,'Andi Pratama','andi.pratama@example.com','UI/UX Design','Saya butuh redesign landing page agar lebih menarik.','2025-08-24 16:08:58',NULL),(7,'Maria Putri','maria.putri@example.com','Consultation','Bisakah kita jadwalkan konsultasi terkait sistem ERP?','2025-08-24 16:09:20',NULL),(8,'Dewi Lestari','dewi.lestari@example.com','Partnership','Saya tertarik bekerja sama untuk beberapa project digital.','2025-08-24 16:09:42',NULL),(9,'Rizky Hidayat','rizky.hidayat@example.com','Other','Apakah Anda juga menerima jasa maintenance website?','2025-08-24 16:10:03',NULL);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
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
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `tech` text COLLATE utf8mb4_general_ci,
  `year` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,11,'Sorting and Searching Visualization','bb6952aef4c895a8de457ecf7f0922a3','Sorting and Searching Visualizer adalah aplikasi web interaktif yang membantu pengguna memahami cara kerja algoritma sorting dan searching melalui visualisasi yang jelas dan menarik. Dengan tampilan berupa batang vertikal yang merepresentasikan nilai array, pengguna dapat melihat langsung bagaimana setiap algoritma bekerja langkah demi langkah.\r\n\r\nAplikasi ini dilengkapi dengan berbagai fitur seperti pemilihan algoritma sorting populer (Bubble Sort, Selection Sort, Insertion Sort, Merge Sort, Quick Sort), kontrol interaktif untuk mengatur ukuran array dan kecepatan eksekusi, serta informasi tambahan berupa waktu eksekusi dan notasi Big-O. Dengan navigasi sederhana antara tab Sorting dan Searching, aplikasi ini menjadi alat belajar yang efektif bagi pelajar, mahasiswa, maupun siapa saja yang ingin memahami algoritma secara visual dan intuitif.','[{\"value\":\"JavaScript\"},{\"value\":\"HTML\"},{\"value\":\"CSS\"}]','2023','https://sorting-and-searching-visualization.vercel.app/',1,'2025-08-19 00:27:41','2025-08-19 00:38:28'),(2,11,'Rock-Paper-Scissor','c0c4678e5bb5f05dcc8b3658955ee6a2','Proyek Rock Paper Scissor ini dibuat menggunakan HTML, CSS, dan JavaScript untuk menghadirkan permainan sederhana gunting-batu-kertas. Pada halaman utama, terdapat tampilan skor untuk pemain dan komputer, tombol pilihan dengan ikon gambar (batu, kertas, gunting), serta area yang menampilkan riwayat pilihan terakhir dan pemenang dari setiap ronde. Dengan bantuan jQuery dan file JavaScript eksternal, logika permainan diatur sehingga komputer secara otomatis memilih gerakan secara acak, lalu hasilnya dibandingkan dengan pilihan pemain.\r\n\r\nDesain antarmuka dibuat sederhana dan interaktif, dilengkapi tombol restart agar pemain dapat memulai permainan baru dengan mudah. Struktur HTML disusun rapi dengan elemen-elemen terpisah untuk skor, pilihan, dan hasil, sementara file CSS digunakan untuk mempercantik tampilan agar permainan terasa lebih menarik dan nyaman dimainkan.','[{\"value\":\"JavaScript\"},{\"value\":\"HTML\"},{\"value\":\"CSS\"}]','2023','https://rock-paper-scissor-beta-virid.vercel.app/',1,'2025-08-19 00:27:41','2025-08-19 00:39:03'),(3,11,'Movie Game Hub','3437a94876f4c2a0452ca1522140cf84','Movie Game Hub adalah sebuah aplikasi web modern yang dirancang sebagai pusat hiburan untuk film dan game. Dikembangkan pada tahun 2025, aplikasi ini hadir dengan tampilan interaktif dan fitur yang memudahkan pengguna dalam menemukan informasi, ulasan, serta rekomendasi hiburan favorit mereka.\r\n\r\nDalam pengembangannya, Movie Game Hub memanfaatkan teknologi populer seperti React, JavaScript, Vue.js, dan Bootstrap. Kombinasi teknologi ini memungkinkan aplikasi memiliki performa cepat, desain responsif, serta pengalaman pengguna yang menyenangkan di berbagai perangkat.','[{\"value\":\"React\"},{\"value\":\"JavaScript\"},{\"value\":\"Vue.js\"},{\"value\":\"BootStrap\"}]','2025','https://moviegame.divly.tech/',1,'2025-08-19 00:27:41','2025-08-19 00:39:37'),(4,12,'Weather App','7a09488fc555e148e4e0c0b38a0c1f7f','Aplikasi Weather App berbasis Flutter ini dirancang dengan tampilan modern dan intuitif untuk memberikan informasi cuaca real-time. Data cuaca diperoleh langsung dari API OpenWeatherMap, sehingga pengguna dapat mengetahui kondisi terkini seperti suhu, kelembapan, tekanan udara, serta kecepatan angin secara akurat.\r\n\r\nUntuk mendukung keamanan dan personalisasi pengguna, aplikasi ini dilengkapi dengan sistem autentikasi menggunakan Firebase. Selain itu, pengelolaan state dilakukan dengan GetX, sehingga performa aplikasi tetap ringan, responsif, dan mudah dikembangkan lebih lanjut.','[{\"value\":\"Dart\"},{\"value\":\"OpenWeatherMap API\"},{\"value\":\"Flutter\"},{\"value\":\"GetX\"},{\"value\":\"Firebase Auth\"},{\"value\":\"Lottie\"},{\"value\":\"Google Fonts\"},{\"value\":\"Geolocator\"},{\"value\":\"Cached Network Image\"}]','2025','https://weatherapp-eta-drab.vercel.app/',1,'2025-08-19 00:27:41','2025-08-19 00:40:06');
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
  `name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'services','home','2025-08-19 00:23:58','2025-08-19 00:23:58'),(2,'values_section','about','2025-08-19 00:23:58','2025-08-24 12:57:07'),(3,'soft_skills','skills','2025-08-19 00:23:58','2025-08-24 12:57:15'),(4,'Programming Language','prolanguage','2025-08-19 00:23:58','2025-08-23 21:42:49'),(5,'Frontend Technologies','technology','2025-08-19 00:23:58','2025-08-23 21:42:49'),(6,'Backend Technologies','technology','2025-08-19 00:23:58','2025-08-23 21:42:49'),(7,'Database Technologies','technology','2025-08-19 00:23:58','2025-08-23 21:42:49'),(8,'Development Tools','development','2025-08-19 00:23:58','2025-08-23 21:42:49'),(9,'Pendidikan','education','2025-08-19 00:23:58','2025-08-19 00:23:58'),(10,'Sertifikasi','certification','2025-08-19 00:23:58','2025-08-19 00:23:58'),(11,'Web Application','portfolio','2025-08-19 00:23:58','2025-08-19 00:23:58'),(12,'Mobile App','portfolio','2025-08-19 00:23:58','2025-08-19 00:23:58'),(13,'UI/UX Design','portfolio','2025-08-19 00:23:58','2025-08-19 00:23:58'),(14,'E-Commerce','portfolio','2025-08-19 00:23:58','2025-08-19 00:23:58'),(15,'Full Stack Developer','typing-text','2025-08-24 03:08:54','2025-08-24 03:09:41'),(16,'Web Developer','typing-text','2025-08-24 03:09:10','2025-08-24 03:09:45'),(17,'Mobile Developer','typing-text','2025-08-24 03:09:21','2025-08-24 03:09:48'),(18,'UI/UX Designer','typing-text','2025-08-24 03:09:32','2025-08-24 03:09:50'),(19,'floating_card','home','2025-08-24 03:22:16','2025-08-24 03:44:46');
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
  `section_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (4,'1','fas fa-laptop-code','Web Development','Pengembangan website modern dan responsif menggunakan teknologi terkini untuk memberikan pengalaman pengguna terbaik.',1,'2025-08-19 00:28:35',NULL),(5,'1','fas fa-mobile-alt','Mobile App','Pembuatan aplikasi mobile yang user-friendly dan performant untuk platform Android dan iOS.',1,'2025-08-19 00:28:35',NULL),(6,'1','fas fa-paint-brush','UI/UX Design','Desain interface yang menarik dan intuitif untuk meningkatkan engagement dan konversi pengguna.',1,'2025-08-19 00:28:35','2025-08-24 11:02:55');
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
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `twitter` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `linkedin` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `github` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `instagram` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'fadlilahdivyy@gmail.com','+6285777784565','Jl. Cempaka Baru Timur No.6','eb0436216471cca3cd5e566d9e2d21ef','https://x.com/FadlilahDivy','https://www.linkedin.com/in/fadlilah-divy/','https://github.com/divfadli','https://www.instagram.com/fadlilahdivyy_29/','2025-08-19 00:20:54','2025-08-24 10:40:13');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill_growth`
--

DROP TABLE IF EXISTS `skill_growth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skill_growth` (
  `id` int NOT NULL AUTO_INCREMENT,
  `start_year` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `end_year` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `skills` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill_growth`
--

LOCK TABLES `skill_growth` WRITE;
/*!40000 ALTER TABLE `skill_growth` DISABLE KEYS */;
INSERT INTO `skill_growth` VALUES (2,'2021','2022','Fondation','[{\"value\":\"HTML5\"},{\"value\":\"CSS\"},{\"value\":\"JavaScript\"},{\"value\":\"PHP\"},{\"value\":\"MySQL\"}]','2025-08-24 13:40:14','2025-08-24 15:05:42'),(3,'2022','2023','Frontend Focus','[{\"value\":\"CodeIgniter4\"},{\"value\":\"PHP\"},{\"value\":\"Git\"},{\"value\":\"Bootstrap\"}]','2025-08-24 14:06:22','2025-08-24 15:06:28'),(4,'2023','2025','Full Stack','[{\"value\":\"Laravel\"},{\"value\":\"Node.js\"},{\"value\":\"Flutter\"},{\"value\":\"REST API\"},{\"value\":\"MongoDB\"}]','2025-08-24 14:10:51','2025-08-24 15:07:08'),(5,'2025','Present','Advanced & Leadership','[{\"value\":\"Docker\"},{\"value\":\"Microservices\"}]','2025-08-24 14:11:19','2025-08-24 15:07:21');
/*!40000 ALTER TABLE `skill_growth` ENABLE KEYS */;
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `skills_items_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills_items`
--

LOCK TABLES `skills_items` WRITE;
/*!40000 ALTER TABLE `skills_items` DISABLE KEYS */;
INSERT INTO `skills_items` VALUES (1,4,'JavaScript',75,'fab fa-js-square','#f7df1e','2025-08-19 00:31:16','2025-08-19 00:31:16'),(2,4,'PHP',85,'fab fa-php','#777bb4','2025-08-19 00:31:16','2025-08-19 00:31:16'),(3,4,'Python',70,'fab fa-python','#3776ab','2025-08-19 00:31:16','2025-08-19 00:31:16'),(4,4,'Java',88,'fab fa-java','#ed8b00','2025-08-19 00:31:16','2025-08-19 00:31:16'),(5,4,'TypeScript',80,'fas fa-code','#3178c6','2025-08-19 00:31:16','2025-08-19 00:31:16'),(6,5,'React.js',85,'fab fa-react','#61dafb','2025-08-19 00:31:16','2025-08-19 00:31:16'),(7,5,'Vue.js',80,'fab fa-vuejs','#4fc08d','2025-08-19 00:31:16','2025-08-19 00:31:16'),(8,5,'HTML5/CSS3',90,'fab fa-html5','#e34f26','2025-08-19 00:31:16','2025-08-19 00:31:16'),(9,5,'Bootstrap',80,'fab fa-bootstrap','#7952b3','2025-08-19 00:31:16','2025-08-19 00:31:16'),(10,6,'Node.js',88,'fab fa-node-js','#339933','2025-08-19 00:31:16','2025-08-19 00:31:16'),(11,6,'Laravel',80,'fab fa-laravel','#ff2d20','2025-08-19 00:31:16','2025-08-19 00:31:16'),(12,6,'Express.js',85,'fas fa-server','#000000','2025-08-19 00:31:16','2025-08-19 00:31:16'),(13,6,'Go',85,'fa-brands fa-golang','#512bd4','2025-08-19 00:31:16','2025-08-19 00:31:16'),(14,4,'Go',88,'fa-brands fa-golang','#512bd4','2025-08-19 00:31:16','2025-08-19 00:31:16'),(15,7,'MySQL',85,'fas fa-database','#F29111','2025-08-19 00:31:16','2025-08-19 00:31:16'),(16,7,'PostgreSQL',90,'fas fa-database','#0064a5','2025-08-19 00:31:16','2025-08-19 00:31:16'),(17,7,'MongoDB',85,'fas fa-leaf','#4DB33D','2025-08-19 00:31:16','2025-08-19 00:31:16'),(18,7,'Firebase',80,'fas fa-fire','#F5820D','2025-08-19 00:31:16','2025-08-19 00:31:16'),(19,8,'Git/GitHub',95,'fab fa-git-alt','#F1502F','2025-08-19 00:31:16','2025-08-19 00:31:16'),(20,8,'Docker',80,'fab fa-docker','#384d54','2025-08-19 00:31:16','2025-08-19 00:31:16'),(21,8,'VS Code',90,'fa-solid fa-code','#0098FF','2025-08-19 00:31:16','2025-08-19 00:31:16'),(22,8,'Postman',95,'fas fa-paper-plane','#EF5B25','2025-08-19 00:31:16','2025-08-19 00:31:16'),(23,4,'dart',75,'fa-brands fa-dart-lang','#01579B','2025-08-19 00:31:16','2025-08-19 00:31:16'),(24,5,'Flutter',75,'fa-brands fa-flutter','#B74093','2025-08-19 00:31:16','2025-08-19 02:15:56');
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
  `section_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `soft_skills`
--

LOCK TABLES `soft_skills` WRITE;
/*!40000 ALTER TABLE `soft_skills` DISABLE KEYS */;
INSERT INTO `soft_skills` VALUES (1,'3','fas fa-users','Team Leadership','Kemampuan memimpin dan mengarahkan tim untuk mencapai tujuan bersama',1,'2025-08-19 00:32:21',NULL),(2,'3','fas fa-comments','Communication','Komunikasi yang efektif dengan stakeholder dan anggota tim',1,'2025-08-19 00:32:21',NULL),(3,'3','fas fa-lightbulb','Problem Solving','Analisis dan penyelesaian masalah dengan pendekatan yang sistematis',1,'2025-08-19 00:32:21',NULL),(4,'3','fas fa-clock','Time Management','Manajemen waktu yang baik untuk menyelesaikan project tepat waktu',1,'2025-08-19 00:32:21',NULL);
/*!40000 ALTER TABLE `soft_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (2,'Divy adalah developer yang sangat kompeten dan reliable. Kemampuan problem solving-nya luar biasa.','https://images.pexels.com/photos/3785079/pexels-photo-3785079.jpeg','Sarah Johnson','Project Manager - Tech Solutions Inc.','2025-08-24 14:23:52','2025-08-24 14:26:16'),(3,'Bekerja dengan Divy sangat menyenangkan. Dia skilled secara teknis, komunikatif, dan team player sejati.','https://images.pexels.com/photos/3785081/pexels-photo-3785081.jpeg','Mike Chen','Senior Developer - Digital Agency Pro','2025-08-24 14:31:32','2025-08-24 14:38:09'),(4,'Divy berhasil mengembangkan website kami dengan hasil yang melebihi ekspektasi. Profesional & tepat waktu.','https://images.pexels.com/photos/3785083/pexels-photo-3785083.jpeg','Lisa Wong','CEO - StartUp Innovate','2025-08-24 14:32:06',NULL),(5,'Aplikasi ini sangat membantu produktivitas kerja saya sehari-hari. Mudah digunakan dan tampilannya modern.','https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e','Siti Nurhaliza','UI/UX Designer','2025-08-24 14:33:11',NULL),(6,'Tim supportnya cepat merespon dan ramah. Sangat direkomendasikan!','https://images.unsplash.com/photo-1544723795-3fb6469f5b39','Budi Santoso','Freelancer','2025-08-24 14:33:35',NULL),(7,'Sejak menggunakan layanan ini, omzet bisnis saya meningkat drastis. Terima kasih!','https://images.unsplash.com/photo-1535713875002-d1d0cf377fde','Rina Kartika','Entrepreneur','2025-08-24 14:34:01',NULL),(8,'Sangat user-friendly dan stabil. Cocok untuk siapa saja, baik pemula maupun profesional.','https://images.unsplash.com/photo-1607746882042-944635dfe10e','Michael Wijaya','Software Engineer','2025-08-24 14:34:51',NULL);
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Fadlilah Divy','divy@mail.com','telkom123','2025-08-19 07:15:12',NULL);
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
  `section_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `values_section`
--

LOCK TABLES `values_section` WRITE;
/*!40000 ALTER TABLE `values_section` DISABLE KEYS */;
INSERT INTO `values_section` VALUES (1,'2','fas fa-code','Clean Code','Menulis kode yang bersih, mudah dibaca, dan mudah dimaintain untuk memastikan sustainability project jangka panjang.',1,'2025-08-19 00:33:05',NULL),(2,'2','fas fa-users','User-Centered','Selalu mengutamakan pengalaman pengguna dalam setiap desain dan development untuk menciptakan solusi yang intuitif.',1,'2025-08-19 00:33:05',NULL),(3,'2','fas fa-rocket','Innovation','Terus belajar dan mengadopsi teknologi terbaru untuk memberikan solusi yang modern dan efisien.',1,'2025-08-19 00:33:05',NULL),(4,'2','fas fa-clock','Punctuality','Menghargai waktu dan selalu berusaha menyelesaikan project tepat waktu sesuai dengan timeline yang disepakati.',1,'2025-08-19 00:33:05',NULL),(5,'2','fas fa-handshake','Collaboration','Percaya bahwa hasil terbaik dicapai melalui kolaborasi yang baik dengan tim dan stakeholder.',1,'2025-08-19 00:33:05',NULL),(6,'2','fas fa-shield-alt','Quality Assurance','Memastikan setiap deliverable telah melalui testing yang ketat untuk menjamin kualitas dan reliability.',1,'2025-08-19 00:33:05','2025-08-24 12:57:32');
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

-- Dump completed on 2025-08-25  0:36:31
