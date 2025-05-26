-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 06:17 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simlitabmas_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota_penelitian`
--

CREATE TABLE `anggota_penelitian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_proposal` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `anggota_penelitian_mahasiswa`
--

CREATE TABLE `anggota_penelitian_mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_proposal` bigint(20) UNSIGNED NOT NULL,
  `npm_nama_mahasiswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `final_reports`
--

CREATE TABLE `final_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penelitian_id` bigint(20) UNSIGNED NOT NULL,
  `final_article` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `final_report` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `final_budget` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `informasi_user`
--

CREATE TABLE `informasi_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nidn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenjang_pendidikan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan_akademik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bidang_ilmu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sinta_score_overall` decimal(8,2) DEFAULT NULL,
  `sinta_score_3_years` decimal(8,2) DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ttl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web_personal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_24_120606_create_proposals_table', 2),
(5, '2025_02_24_120625_create_reviews_table', 2),
(6, '2025_02_24_122347_create_permission_tables', 3),
(9, '2025_03_04_044643_create_pengajuan_penelitian_table', 4),
(15, '2025_03_04_050327_create_program_studi_table', 5),
(16, '2025_03_05_062116_add_user_id_to_pengajuan_penelitian_table', 6),
(17, '2025_03_11_044028_create_reviewer_status_table', 7),
(18, '2025_03_12_075509_create_reviewer_assignments_table', 8),
(19, '2025_03_17_194156_create_penelitian_table', 9),
(20, '2025_03_17_194813_create_progress_penelitian_table', 10),
(21, '2025_03_17_195116_create_progress_comments_table', 11),
(22, '2025_03_17_195221_create_final_reports_table', 12),
(23, '2025_03_24_134053_create_notifications_table', 13),
(24, '2025_04_13_142051_add_tahun_penelitian_to_pengajuan_penelitian_table', 14),
(25, '2025_04_13_194358_add_judul_penelitian_to_pengajuan_penelitian_table', 15),
(26, '2025_04_15_125530_add_komentar_review_to_pengajuan_penelitian_table', 16),
(27, '2025_04_16_073845_create_anggota_penelitian_table', 17),
(28, '2025_04_18_072052_create_anggota_penelitian_mahasiswa_table', 18),
(29, '2025_04_20_043213_create_informasi_user_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(5, 'App\\Models\\User', 2),
(5, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penelitian`
--

CREATE TABLE `penelitian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proposal_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ongoing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_penelitian`
--

CREATE TABLE `pengajuan_penelitian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun_penelitian` year(4) NOT NULL,
  `judul_penelitian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nidn_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_wa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skema_usulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_proposal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `komentar_review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaProdi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`id`, `namaProdi`, `created_at`, `updated_at`) VALUES
(3, 'Administrasi Keuangan (AKE) - DIII', '2025-03-04 23:52:10', '2025-03-04 23:52:10'),
(4, 'Komputerisasi Akuntansi (KAT) - DIV', '2025-03-04 23:52:30', '2025-03-04 23:52:30'),
(5, 'Bisnis Digital (BDI) - DIV', '2025-03-04 23:52:36', '2025-03-04 23:52:36'),
(6, 'Manajemen Informatika (MIF) - DIII', '2025-03-04 23:52:47', '2025-03-04 23:52:47'),
(7, 'Teknik Komputer (TIK) - DIII', '2025-03-04 23:52:52', '2025-03-04 23:52:52'),
(8, 'Produksi Media (PME) - DIV', '2025-03-04 23:52:58', '2025-03-04 23:52:58'),
(9, 'Manajemen Informatika (MIF) - DIV', '2025-03-04 23:53:04', '2025-03-04 23:53:04'),
(10, 'Analis Kesehatan (AKS) - DIII', '2025-03-04 23:53:11', '2025-03-04 23:53:11'),
(11, 'Farmasi (FAR) - DIII', '2025-03-04 23:53:23', '2025-03-04 23:53:23'),
(12, 'Fisioterapi (FIS) - DIII', '2025-03-04 23:53:28', '2025-03-04 23:53:28'),
(13, 'Manajemen Pelayanan Rumah Sakit (MPRS) - DIII', '2025-03-04 23:53:34', '2025-03-04 23:53:34'),
(14, 'Rekam Medis dan Informasi Kesehatan (RMIK) - DIII', '2025-03-04 23:53:39', '2025-03-04 23:53:39'),
(15, 'Manajemen Informasi Kesehatan (MIK) - DIV', '2025-03-04 23:53:43', '2025-03-04 23:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `progress_comments`
--

CREATE TABLE `progress_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `progress_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progress_penelitian`
--

CREATE TABLE `progress_penelitian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penelitian_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_progress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviewer_assignments`
--

CREATE TABLE `reviewer_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proposal_id` bigint(20) UNSIGNED NOT NULL,
  `reviewer_id` bigint(20) UNSIGNED NOT NULL,
  `assignment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'assigned',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviewer_status`
--

CREATE TABLE `reviewer_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-02-24 07:51:09', '2025-02-24 07:51:09'),
(2, 'user', 'web', '2025-02-24 07:51:19', '2025-02-24 07:51:19'),
(3, 'staff', 'web', '2025-02-24 07:53:40', '2025-02-24 07:53:40'),
(4, 'dosen', 'web', '2025-02-24 07:53:50', '2025-02-24 07:53:50'),
(5, 'reviewer', 'web', '2025-03-07 01:47:59', '2025-03-07 01:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `col1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Master Admin', 'admin@simlitabmas.com', NULL, '$2y$12$bY1Ixr37ysnQVPdkfBi.MO5vobl3lFMr9.uy3bOoIZ9IRYRCMFwpi', NULL, '2025-02-24 06:10:38', '2025-02-24 06:10:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota_penelitian`
--
ALTER TABLE `anggota_penelitian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anggota_penelitian_id_proposal_foreign` (`id_proposal`),
  ADD KEY `anggota_penelitian_id_user_foreign` (`id_user`);

--
-- Indexes for table `anggota_penelitian_mahasiswa`
--
ALTER TABLE `anggota_penelitian_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anggota_penelitian_mahasiswa_id_proposal_foreign` (`id_proposal`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `final_reports`
--
ALTER TABLE `final_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `final_reports_penelitian_id_foreign` (`penelitian_id`);

--
-- Indexes for table `informasi_user`
--
ALTER TABLE `informasi_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `informasi_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penelitian`
--
ALTER TABLE `penelitian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penelitian_user_id_foreign` (`user_id`),
  ADD KEY `penelitian_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `pengajuan_penelitian`
--
ALTER TABLE `pengajuan_penelitian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_penelitian_user_id_foreign` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progress_comments`
--
ALTER TABLE `progress_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `progress_comments_progress_id_foreign` (`progress_id`),
  ADD KEY `progress_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `progress_penelitian`
--
ALTER TABLE `progress_penelitian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `progress_penelitian_penelitian_id_foreign` (`penelitian_id`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviewer_assignments`
--
ALTER TABLE `reviewer_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviewer_assignments_proposal_id_foreign` (`proposal_id`),
  ADD KEY `reviewer_assignments_reviewer_id_foreign` (`reviewer_id`);

--
-- Indexes for table `reviewer_status`
--
ALTER TABLE `reviewer_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviewer_status_user_id_foreign` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota_penelitian`
--
ALTER TABLE `anggota_penelitian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `anggota_penelitian_mahasiswa`
--
ALTER TABLE `anggota_penelitian_mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `final_reports`
--
ALTER TABLE `final_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `informasi_user`
--
ALTER TABLE `informasi_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `penelitian`
--
ALTER TABLE `penelitian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pengajuan_penelitian`
--
ALTER TABLE `pengajuan_penelitian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `progress_comments`
--
ALTER TABLE `progress_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `progress_penelitian`
--
ALTER TABLE `progress_penelitian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviewer_assignments`
--
ALTER TABLE `reviewer_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reviewer_status`
--
ALTER TABLE `reviewer_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota_penelitian`
--
ALTER TABLE `anggota_penelitian`
  ADD CONSTRAINT `anggota_penelitian_id_proposal_foreign` FOREIGN KEY (`id_proposal`) REFERENCES `pengajuan_penelitian` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `anggota_penelitian_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `anggota_penelitian_mahasiswa`
--
ALTER TABLE `anggota_penelitian_mahasiswa`
  ADD CONSTRAINT `anggota_penelitian_mahasiswa_id_proposal_foreign` FOREIGN KEY (`id_proposal`) REFERENCES `pengajuan_penelitian` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `final_reports`
--
ALTER TABLE `final_reports`
  ADD CONSTRAINT `final_reports_penelitian_id_foreign` FOREIGN KEY (`penelitian_id`) REFERENCES `penelitian` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `informasi_user`
--
ALTER TABLE `informasi_user`
  ADD CONSTRAINT `informasi_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penelitian`
--
ALTER TABLE `penelitian`
  ADD CONSTRAINT `penelitian_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pengajuan_penelitian` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penelitian_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengajuan_penelitian`
--
ALTER TABLE `pengajuan_penelitian`
  ADD CONSTRAINT `pengajuan_penelitian_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `progress_comments`
--
ALTER TABLE `progress_comments`
  ADD CONSTRAINT `progress_comments_progress_id_foreign` FOREIGN KEY (`progress_id`) REFERENCES `progress_penelitian` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `progress_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `progress_penelitian`
--
ALTER TABLE `progress_penelitian`
  ADD CONSTRAINT `progress_penelitian_penelitian_id_foreign` FOREIGN KEY (`penelitian_id`) REFERENCES `penelitian` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviewer_assignments`
--
ALTER TABLE `reviewer_assignments`
  ADD CONSTRAINT `reviewer_assignments_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pengajuan_penelitian` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviewer_assignments_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviewer_status`
--
ALTER TABLE `reviewer_status`
  ADD CONSTRAINT `reviewer_status_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
