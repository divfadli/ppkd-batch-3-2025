-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Agu 2025 pada 10.23
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_portofolio`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `abouts`
--

CREATE TABLE `abouts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `freelance_status` tinyint(1) NOT NULL DEFAULT 1,
  `content` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `cv` varchar(100) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `location`, `is_active`, `freelance_status`, `content`, `image`, `cv`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Passionate Developer dengan 2+ Tahun Pengalaman', 'Jakarta, Indonesia', 1, 1, '<p class=\"mb-4\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; color: rgb(31, 41, 55); font-family: Inter, sans-serif;\">Saya adalah seorang <b>Full Stack Developer</b> yang berpengalaman dalam mengembangkan aplikasi web dan mobile yang scalable dan user‑friendly. Dengan background yang kuat dalam teknologi modern, saya selalu berusaha memberikan solusi terbaik untuk setiap project.</p><p class=\"mb-4\" style=\"margin-right: 0px; margin-left: 0px; padding: 0px; color: rgb(31, 41, 55); font-family: Inter, sans‑serif;\">Perjalanan saya di dunia programming dimulai sejak 2024, dan sejak itu saya telah mengerjakan berbagai macam project mulai dari website corporate, e‑commerce platform, hingga aplikasi mobile yang kompleks.</p>', '16f2fa646e8098b27243ee9804e4af57', '4ea09a3efefc8f69ff71f9ab7d64e780.pdf', '1', '2025-08-19 00:24:52', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `certification`
--

CREATE TABLE `certification` (
  `id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `year` varchar(50) NOT NULL,
  `icon` varchar(50) DEFAULT 'fa-solid fa-certificate'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `certification`
--

INSERT INTO `certification` (`id`, `section_id`, `title`, `provider`, `year`, `icon`) VALUES
(1, 10, 'NodeJS Backend Development with Express JS', 'SanberCode', '2025', 'fab fa-node-js'),
(2, 10, 'Golang Backend Development', 'SanberCode', '2022', 'fa-brands fa-golang'),
(3, 10, 'Python - Data Science', 'SanberCode', '2025', 'fa-brands fa-python'),
(4, 10, 'Flutter - Mobile App Development', 'SanberCode', '2025', 'fa-brands fa-flutter'),
(5, 10, 'Programming FrontEnd React Js', 'SanberCode', '2025', 'fa-brands fa-react');

-- --------------------------------------------------------

--
-- Struktur dari tabel `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `start_year` varchar(10) DEFAULT NULL,
  `end_year` varchar(10) DEFAULT NULL,
  `degree` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `education`
--

INSERT INTO `education` (`id`, `section_id`, `start_year`, `end_year`, `degree`, `school`, `description`) VALUES
(1, 9, '2020', '2025', 'S1 Ilmu Komputer', 'Universitas Pertamina', 'Menempuh studi S1 Ilmu Komputer di Universitas Pertamina (2020–2025), saya mempelajari algoritma, struktur data, arsitektur komputer, pengembangan web dan mobile, serta bidang modern seperti cloud computing, jaringan, basis data, dan machine learning, membekali saya dengan pemahaman menyeluruh dan keterampilan praktis dalam membangun solusi teknologi.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `experiences`
--

CREATE TABLE `experiences` (
  `id` int(11) NOT NULL,
  `start_year` varchar(10) NOT NULL,
  `end_year` varchar(10) NOT NULL,
  `position` varchar(150) NOT NULL,
  `company` varchar(150) NOT NULL,
  `location` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `achievements` text DEFAULT NULL,
  `technologies` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `experiences`
--

INSERT INTO `experiences` (`id`, `start_year`, `end_year`, `position`, `company`, `location`, `type`, `description`, `achievements`, `technologies`) VALUES
(1, '2023', '2024', 'Backend Engineer (Intern)', 'PT Pupuk Indonesia', 'Jakarta, Indonesia', 'Internship', 'Membantu organisasi dalam mengelola dan melacak ketidakhadiran karyawan secara efektif. Sistem ini menyediakan pendekatan terstruktur untuk menangani berbagai jenis cuti, seperti cuti sakit, cuti tahunan, cuti pribadi, maupun permintaan izin lainnya.', '[{\"value\":\"Mempelajari dan menguasai framework Gin dalam 6 bulan\"},{\"value\":\"Berkontribusi dalam pengembangan Absence Management System\"},{\"value\":\"Berkolaborasi dengan tim\"}]', '[{\"value\":\"Gin\"},{\"value\":\"Gorm\"},{\"value\":\"Go\"}]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `tech` text DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `projects`
--

INSERT INTO `projects` (`id`, `section_id`, `title`, `image`, `description`, `tech`, `year`, `link`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 11, 'Sorting and Searching Visualization', 'bb6952aef4c895a8de457ecf7f0922a3', 'Sorting and Searching Visualizer adalah aplikasi web interaktif yang membantu pengguna memahami cara kerja algoritma sorting dan searching melalui visualisasi yang jelas dan menarik. Dengan tampilan berupa batang vertikal yang merepresentasikan nilai array, pengguna dapat melihat langsung bagaimana setiap algoritma bekerja langkah demi langkah.\r\n\r\nAplikasi ini dilengkapi dengan berbagai fitur seperti pemilihan algoritma sorting populer (Bubble Sort, Selection Sort, Insertion Sort, Merge Sort, Quick Sort), kontrol interaktif untuk mengatur ukuran array dan kecepatan eksekusi, serta informasi tambahan berupa waktu eksekusi dan notasi Big-O. Dengan navigasi sederhana antara tab Sorting dan Searching, aplikasi ini menjadi alat belajar yang efektif bagi pelajar, mahasiswa, maupun siapa saja yang ingin memahami algoritma secara visual dan intuitif.', '[{\"value\":\"JavaScript\"},{\"value\":\"HTML\"},{\"value\":\"CSS\"}]', '2023', 'https://sorting-and-searching-visualization.vercel.app/', 1, '2025-08-19 00:27:41', '2025-08-19 00:38:28'),
(2, 11, 'Rock-Paper-Scissor', 'c0c4678e5bb5f05dcc8b3658955ee6a2', 'Proyek Rock Paper Scissor ini dibuat menggunakan HTML, CSS, dan JavaScript untuk menghadirkan permainan sederhana gunting-batu-kertas. Pada halaman utama, terdapat tampilan skor untuk pemain dan komputer, tombol pilihan dengan ikon gambar (batu, kertas, gunting), serta area yang menampilkan riwayat pilihan terakhir dan pemenang dari setiap ronde. Dengan bantuan jQuery dan file JavaScript eksternal, logika permainan diatur sehingga komputer secara otomatis memilih gerakan secara acak, lalu hasilnya dibandingkan dengan pilihan pemain.\r\n\r\nDesain antarmuka dibuat sederhana dan interaktif, dilengkapi tombol restart agar pemain dapat memulai permainan baru dengan mudah. Struktur HTML disusun rapi dengan elemen-elemen terpisah untuk skor, pilihan, dan hasil, sementara file CSS digunakan untuk mempercantik tampilan agar permainan terasa lebih menarik dan nyaman dimainkan.', '[{\"value\":\"JavaScript\"},{\"value\":\"HTML\"},{\"value\":\"CSS\"}]', '2023', 'https://rock-paper-scissor-beta-virid.vercel.app/', 1, '2025-08-19 00:27:41', '2025-08-19 00:39:03'),
(3, 11, 'Movie Game Hub', '3437a94876f4c2a0452ca1522140cf84', 'Movie Game Hub adalah sebuah aplikasi web modern yang dirancang sebagai pusat hiburan untuk film dan game. Dikembangkan pada tahun 2025, aplikasi ini hadir dengan tampilan interaktif dan fitur yang memudahkan pengguna dalam menemukan informasi, ulasan, serta rekomendasi hiburan favorit mereka.\r\n\r\nDalam pengembangannya, Movie Game Hub memanfaatkan teknologi populer seperti React, JavaScript, Vue.js, dan Bootstrap. Kombinasi teknologi ini memungkinkan aplikasi memiliki performa cepat, desain responsif, serta pengalaman pengguna yang menyenangkan di berbagai perangkat.', '[{\"value\":\"React\"},{\"value\":\"JavaScript\"},{\"value\":\"Vue.js\"},{\"value\":\"BootStrap\"}]', '2025', 'https://moviegame.divly.tech/', 1, '2025-08-19 00:27:41', '2025-08-19 00:39:37'),
(4, 12, 'Weather App', '7a09488fc555e148e4e0c0b38a0c1f7f', 'Aplikasi Weather App berbasis Flutter ini dirancang dengan tampilan modern dan intuitif untuk memberikan informasi cuaca real-time. Data cuaca diperoleh langsung dari API OpenWeatherMap, sehingga pengguna dapat mengetahui kondisi terkini seperti suhu, kelembapan, tekanan udara, serta kecepatan angin secara akurat.\r\n\r\nUntuk mendukung keamanan dan personalisasi pengguna, aplikasi ini dilengkapi dengan sistem autentikasi menggunakan Firebase. Selain itu, pengelolaan state dilakukan dengan GetX, sehingga performa aplikasi tetap ringan, responsif, dan mudah dikembangkan lebih lanjut.', '[{\"value\":\"Dart\"},{\"value\":\"OpenWeatherMap API\"},{\"value\":\"Flutter\"},{\"value\":\"GetX\"},{\"value\":\"Firebase Auth\"},{\"value\":\"Lottie\"},{\"value\":\"Google Fonts\"},{\"value\":\"Geolocator\"},{\"value\":\"Cached Network Image\"}]', '2025', 'https://weatherapp-eta-drab.vercel.app/', 1, '2025-08-19 00:27:41', '2025-08-19 00:40:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sections`
--

INSERT INTO `sections` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'services', 'home', '2025-08-19 00:23:58', '2025-08-19 00:23:58'),
(2, 'values', 'about', '2025-08-19 00:23:58', '2025-08-19 00:23:58'),
(3, 'soft-skills', 'skills', '2025-08-19 00:23:58', '2025-08-19 00:23:58'),
(4, 'programming-language', 'prolanguage', '2025-08-19 00:23:58', '2025-08-19 00:23:58'),
(5, 'frontend', 'technology', '2025-08-19 00:23:58', '2025-08-19 00:23:58'),
(6, 'backend', 'technology', '2025-08-19 00:23:58', '2025-08-19 00:23:58'),
(7, 'database', 'technology', '2025-08-19 00:23:58', '2025-08-19 00:23:58'),
(8, 'tools', 'development', '2025-08-19 00:23:58', '2025-08-19 00:23:58'),
(9, 'Pendidikan', 'education', '2025-08-19 00:23:58', '2025-08-19 00:23:58'),
(10, 'Sertifikasi', 'certification', '2025-08-19 00:23:58', '2025-08-19 00:23:58'),
(11, 'Web Application', 'portfolio', '2025-08-19 00:23:58', '2025-08-19 00:23:58'),
(12, 'Mobile App', 'portfolio', '2025-08-19 00:23:58', '2025-08-19 00:23:58'),
(13, 'UI/UX Design', 'portfolio', '2025-08-19 00:23:58', '2025-08-19 00:23:58'),
(14, 'E-Commerce', 'portfolio', '2025-08-19 00:23:58', '2025-08-19 00:23:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `section_id` varchar(50) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id`, `section_id`, `icon`, `title`, `content`, `is_active`, `created_at`) VALUES
(4, '1', 'fas fa-laptop-code', 'Web Development', 'Pengembangan website modern dan responsif menggunakan teknologi terkini untuk memberikan pengalaman pengguna terbaik.', 1, '2025-08-19 00:28:35'),
(5, '1', 'fas fa-mobile-alt', 'Mobile App', 'Pembuatan aplikasi mobile yang user-friendly dan performant untuk platform Android dan iOS.', 1, '2025-08-19 00:28:35'),
(6, '1', 'fas fa-paint-brush', 'UI/UX Design', 'Desain interface yang menarik dan intuitif untuk meningkatkan engagement dan konversi pengguna.', 1, '2025-08-19 00:28:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `logo` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `linkedin` varchar(100) NOT NULL,
  `github` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `email`, `phone`, `address`, `logo`, `twitter`, `linkedin`, `github`, `instagram`, `created_at`, `updated_at`) VALUES
(1, 'fadlilahdivyy@gmail.com', '+6285777784565', 'Jl. Cempaka Baru Timur No.6', '0c274288c2bc2bf3f731d74331546155', 'https://x.com/FadlilahDivy', 'https://www.linkedin.com/in/fadlilah-divy/', 'https://github.com/divfadli', 'https://www.instagram.com/fadlilahdivyy_29/', '2025-08-19 00:20:54', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `skills_items`
--

CREATE TABLE `skills_items` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `percentage` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `color` varchar(20) DEFAULT '#0d6efd',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ;

--
-- Dumping data untuk tabel `skills_items`
--

INSERT INTO `skills_items` (`id`, `section_id`, `name`, `percentage`, `icon`, `color`, `created_at`, `updated_at`) VALUES
(1, 4, 'JavaScript', 75, 'fab fa-js-square', '#f7df1e', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(2, 4, 'PHP', 85, 'fab fa-php', '#777bb4', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(3, 4, 'Python', 70, 'fab fa-python', '#3776ab', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(4, 4, 'Java', 88, 'fab fa-java', '#ed8b00', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(5, 4, 'TypeScript', 80, 'fas fa-code', '#3178c6', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(6, 5, 'React.js', 85, 'fab fa-react', '#61dafb', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(7, 5, 'Vue.js', 80, 'fab fa-vuejs', '#4fc08d', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(8, 5, 'HTML5/CSS3', 90, 'fab fa-html5', '#e34f26', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(9, 5, 'Bootstrap', 80, 'fab fa-bootstrap', '#7952b3', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(10, 6, 'Node.js', 88, 'fab fa-node-js', '#339933', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(11, 6, 'Laravel', 80, 'fab fa-laravel', '#ff2d20', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(12, 6, 'Express.js', 85, 'fas fa-server', '#000000', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(13, 6, 'Go', 85, 'fa-brands fa-golang', '#512bd4', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(14, 4, 'Go', 88, 'fa-brands fa-golang', '#512bd4', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(15, 7, 'MySQL', 85, 'fas fa-database', '#F29111', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(16, 7, 'PostgreSQL', 90, 'fas fa-database', '#0064a5', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(17, 7, 'MongoDB', 85, 'fas fa-leaf', '#4DB33D', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(18, 7, 'Firebase', 80, 'fas fa-fire', '#F5820D', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(19, 8, 'Git/GitHub', 95, 'fab fa-git-alt', '#F1502F', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(20, 8, 'Docker', 80, 'fab fa-docker', '#384d54', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(21, 8, 'VS Code', 90, 'fa-solid fa-code', '#0098FF', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(22, 8, 'Postman', 95, 'fas fa-paper-plane', '#EF5B25', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(23, 4, 'dart', 75, 'fa-brands fa-dart-lang', '#01579B', '2025-08-19 00:31:16', '2025-08-19 00:31:16'),
(24, 5, 'Flutter', 75, 'fa-brands fa-flutter', '#B74093', '2025-08-19 00:31:16', '2025-08-19 02:15:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soft_skills`
--

CREATE TABLE `soft_skills` (
  `id` int(11) NOT NULL,
  `section_id` varchar(50) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `soft_skills`
--

INSERT INTO `soft_skills` (`id`, `section_id`, `icon`, `title`, `content`, `is_active`, `created_at`) VALUES
(1, '3', 'fas fa-users', 'Team Leadership', 'Kemampuan memimpin dan mengarahkan tim untuk mencapai tujuan bersama', 1, '2025-08-19 00:32:21'),
(2, '3', 'fas fa-comments', 'Communication', 'Komunikasi yang efektif dengan stakeholder dan anggota tim', 1, '2025-08-19 00:32:21'),
(3, '3', 'fas fa-lightbulb', 'Problem Solving', 'Analisis dan penyelesaian masalah dengan pendekatan yang sistematis', 1, '2025-08-19 00:32:21'),
(4, '3', 'fas fa-clock', 'Time Management', 'Manajemen waktu yang baik untuk menyelesaikan project tepat waktu', 1, '2025-08-19 00:32:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Fadlilah Divy', 'divy@mail.com', 'telkom123', '2025-08-19 07:15:12', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `values_section`
--

CREATE TABLE `values_section` (
  `id` int(11) NOT NULL,
  `section_id` varchar(50) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `values_section`
--

INSERT INTO `values_section` (`id`, `section_id`, `icon`, `title`, `content`, `is_active`, `created_at`) VALUES
(1, '2', 'fas fa-code', 'Clean Code', 'Menulis kode yang bersih, mudah dibaca, dan mudah dimaintain untuk memastikan sustainability project jangka panjang.', 1, '2025-08-19 00:33:05'),
(2, '2', 'fas fa-users', 'User-Centered', 'Selalu mengutamakan pengalaman pengguna dalam setiap desain dan development untuk menciptakan solusi yang intuitif.', 1, '2025-08-19 00:33:05'),
(3, '2', 'fas fa-rocket', 'Innovation', 'Terus belajar dan mengadopsi teknologi terbaru untuk memberikan solusi yang modern dan efisien.', 1, '2025-08-19 00:33:05'),
(4, '2', 'fas fa-clock', 'Punctuality', 'Menghargai waktu dan selalu berusaha menyelesaikan project tepat waktu sesuai dengan timeline yang disepakati.', 1, '2025-08-19 00:33:05'),
(5, '2', 'fas fa-handshake', 'Collaboration', 'Percaya bahwa hasil terbaik dicapai melalui kolaborasi yang baik dengan tim dan stakeholder.', 1, '2025-08-19 00:33:05'),
(6, '2', 'fas fa-shield-alt', 'Quality Assurance', 'Memastikan setiap deliverable telah melalui testing yang ketat untuk menjamin kualitas dan reliability.', 1, '2025-08-19 00:33:05');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `certification`
--
ALTER TABLE `certification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indeks untuk tabel `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indeks untuk tabel `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indeks untuk tabel `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `skills_items`
--
ALTER TABLE `skills_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indeks untuk tabel `soft_skills`
--
ALTER TABLE `soft_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `values_section`
--
ALTER TABLE `values_section`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `certification`
--
ALTER TABLE `certification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `skills_items`
--
ALTER TABLE `skills_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `soft_skills`
--
ALTER TABLE `soft_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `values_section`
--
ALTER TABLE `values_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `certification`
--
ALTER TABLE `certification`
  ADD CONSTRAINT `certification_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `skills_items`
--
ALTER TABLE `skills_items`
  ADD CONSTRAINT `skills_items_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
