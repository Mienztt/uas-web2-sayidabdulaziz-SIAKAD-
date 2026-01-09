-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2026 at 04:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(200) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nidn` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosens`
--

CREATE TABLE `dosens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nidn` varchar(20) DEFAULT NULL,
  `nama_dosen` varchar(255) NOT NULL,
  `inisial` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dosens`
--

INSERT INTO `dosens` (`id`, `user_id`, `nidn`, `nama_dosen`, `inisial`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'Dr. Jajang Suherman, M.A.B', NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(2, NULL, NULL, 'Aji M\'uazul Mu\'minin, S.Kom., M.M', NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(3, NULL, NULL, 'Badriyatul Huda, SE, MM', NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(4, NULL, NULL, 'Ida Rapida, Dra., M.M', NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(5, NULL, NULL, 'Ir. Raden Haerudjaman', NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(6, NULL, '23232343', 'M. Fahmi Nugraha, M.Kom', 'FA', '2026-01-06 23:55:56', '2026-01-08 03:18:06'),
(7, NULL, NULL, 'M. Prslarisz, S.T., M.Kom', NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(8, NULL, '234343434', 'Utami Aryani, M.Kom', 'UA', '2026-01-06 23:55:56', '2026-01-08 03:34:52'),
(9, NULL, NULL, 'Yelly A.M.S., Dra., M.Pd.', NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(10, NULL, NULL, 'Safia Dewi, S.T., M.Kom', NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(11, NULL, NULL, 'Mimin Mintarsih, M.Ag', NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(12, 3, '242505022', 'Sayid Abdul Aziz. S.E.M.M.MBA', 'asa', '2026-01-08 03:30:56', '2026-01-08 03:31:06'),
(13, 4, '343434', 'fdfdfdf', NULL, '2026-01-08 03:35:56', '2026-01-08 03:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mk_id` bigint(20) UNSIGNED NOT NULL,
  `dosen_id` bigint(20) UNSIGNED NOT NULL,
  `ruang_id` bigint(20) UNSIGNED NOT NULL,
  `shift_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `mk_id`, `dosen_id`, `ruang_id`, `shift_id`, `kelas_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(2, 2, 2, 1, 2, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(3, 3, 3, 2, 3, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(4, 4, 4, 4, 4, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(5, 5, 5, 3, 5, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(6, 6, 6, 5, 6, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(7, 7, 7, 6, 7, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(8, 8, 8, 6, 8, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(9, 9, 8, 5, 9, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(10, 10, 9, 7, 10, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(11, 11, 10, 8, 11, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(12, 12, 11, 3, 12, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(13, 13, 2, 4, 13, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(14, 14, 8, 6, 14, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(15, 14, 8, 9, 15, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
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
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) DEFAULT NULL,
  `angkatan` varchar(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dosen_pembimbing_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `gambar_profil` varchar(255) DEFAULT NULL,
  `id_prodi` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `prodi_id`, `dosen_pembimbing_id`, `nim`, `nama`, `alamat`, `gambar_profil`, `id_prodi`, `created_at`, `updated_at`) VALUES
(2, 1, 7, '242505022', 'Sayid Abdul Aziz', 'Griya Ranca Indah 1', NULL, NULL, '2026-01-07 00:22:53', '2026-01-07 00:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_30_000000_create_prodi_table', 1),
(5, '2025_09_30_131842_create_buku_table', 1),
(6, '2025_10_01_040129_create_mahasiswa_table', 1),
(7, '2025_10_13_122947_update_mahasiswa_table', 1),
(8, '2025_10_13_123818_add_id_prodi_to_mahasiswa_table', 1),
(9, '2025_10_20_041033_add_gambar_profil_to_mahasiswa_table', 1),
(10, '2025_10_22_035027_create_dosen_table', 1),
(11, '2025_10_28_135425_create_ruangs_table', 1),
(12, '2025_10_28_135434_create_dosens_table', 1),
(13, '2025_10_28_135434_create_mks_table', 1),
(14, '2025_10_28_135800_create_shifts_table', 1),
(15, '2025_10_28_163522_create_jadwal_table', 1),
(16, '2025_11_10_011901_create_kelas_table', 1),
(17, '2025_11_10_012107_create_surat_tugas_mengajars_table', 1),
(18, '2025_11_10_035456_create_permission_tables', 1),
(19, '2025_11_20_001119_add_avatar_to_users_table', 1),
(20, '2025_12_03_041412_create_personal_access_tokens_table', 1),
(21, '2025_12_17_050159_add_dosen_pembimbing_to_mahasiswa_table', 1),
(22, '2026_01_07_073201_add_kelas_id_to_jadwal_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mks`
--

CREATE TABLE `mks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_mk` varchar(255) NOT NULL,
  `kode_mk` varchar(20) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  `semester` int(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mks`
--

INSERT INTO `mks` (`id`, `nama_mk`, `kode_mk`, `sks`, `semester`, `created_at`, `updated_at`) VALUES
(1, 'Analisa Proses Bisnis', 'APB', 3, 3, '2026-01-06 23:55:56', '2026-01-08 03:49:28'),
(2, 'Instalasi Komputer dan Jaringan', '230', 2, 3, '2026-01-06 23:55:56', '2026-01-08 03:49:45'),
(3, 'Perpajakan', NULL, NULL, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(4, 'Kewirausahaan', NULL, NULL, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(5, 'KPAM III (Etika Perkantoran)', NULL, NULL, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(6, 'Pemrograman Web', NULL, NULL, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(7, 'Pemrograman Java', NULL, NULL, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(8, 'PLSQL (Pemrog. Database)', NULL, NULL, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(9, 'Pemograman Databases (PLSQL)', NULL, NULL, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(10, 'Pendidikan Kewarganegaraan', NULL, NULL, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(11, 'Riset Teknologi Informasi', NULL, NULL, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(12, 'Pendidikan Agama Islam II', NULL, NULL, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(13, 'Manajemen Bisnis (E-Business)', NULL, NULL, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(14, 'Sistem Basis Data', NULL, NULL, NULL, '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(15, 'KORUPSI', 'MK005', 6, 3, '2026-01-08 03:50:04', '2026-01-08 03:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view jadwal_ui', 'web', '2026-01-06 23:52:23', '2026-01-06 23:52:23'),
(2, 'manage data_master', 'web', '2026-01-06 23:52:23', '2026-01-06 23:52:23'),
(3, 'manage jadwal_crud', 'web', '2026-01-06 23:52:23', '2026-01-06 23:52:23'),
(4, 'create surat_tugas', 'web', '2026-01-06 23:52:23', '2026-01-06 23:52:23'),
(5, 'do charter', 'web', '2026-01-06 23:52:23', '2026-01-06 23:52:23'),
(6, 'do barter', 'web', '2026-01-06 23:52:23', '2026-01-06 23:52:23'),
(7, 'request pindah', 'web', '2026-01-06 23:52:23', '2026-01-06 23:52:23'),
(8, 'approve pindah_jadwal', 'web', '2026-01-06 23:52:23', '2026-01-06 23:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_prodi` varchar(10) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL,
  `jenjang` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `kode_prodi`, `nama_prodi`, `jenjang`, `created_at`, `updated_at`) VALUES
(1, 'SI', 'Sistem Informasi', 'S1', '2026-01-07 00:14:07', '2026-01-07 00:14:07'),
(2, 'BD', 'Bisnis Digital', 'S1', '2026-01-07 00:14:07', '2026-01-07 00:14:07'),
(3, 'MI', 'Manajemen Informatika', 'D3', '2026-01-07 00:14:07', '2026-01-07 00:14:07'),
(4, 'KA', 'Komputerisasi Akuntansi', 'D3', '2026-01-07 00:14:07', '2026-01-07 00:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Dekan', 'web', '2026-01-06 23:52:23', '2026-01-06 23:52:23'),
(2, 'Kaprodi', 'web', '2026-01-06 23:52:23', '2026-01-06 23:52:23'),
(3, 'Sekprodi', 'web', '2026-01-06 23:52:23', '2026-01-06 23:52:23'),
(4, 'Dosen', 'web', '2026-01-06 23:52:23', '2026-01-06 23:52:23'),
(5, 'Kosma', 'web', '2026-01-06 23:52:23', '2026-01-06 23:52:23'),
(6, 'Mahasiswa', 'web', '2026-01-06 23:52:23', '2026-01-06 23:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(5, 4),
(6, 4),
(7, 4),
(8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `ruangs`
--

CREATE TABLE `ruangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_ruang` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ruangs`
--

INSERT INTO `ruangs` (`id`, `nama_ruang`, `created_at`, `updated_at`) VALUES
(1, 'Lab. Jaringan', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(2, 'A203', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(3, 'A209', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(4, 'A210', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(5, 'B303', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(6, 'B301', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(7, 'A204', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(8, 'A211', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(9, 'B302', '2026-01-06 23:55:56', '2026-01-06 23:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('aHC9aLojeo6wf7xaVFDNVLAqMo1PmXMpLmlmEpy7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidVEwMUp0c2tieG85b05qTjNlZDFuWUhqeTlMVXM4ejJxbVlUcGU0NyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767873103),
('EP8FnBwf23aOSIDteL1C5kOaEWG8nF0A6UZlTbMK', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSE5aUDFOU21xSGhXR0FGZWVRU01rbVRFRllmamVsUjI2TVhCNlEyMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1767872443),
('yMOI8JjNVcAYyoAhZAMYXaqzxyvzUZH52oAZyk9V', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic3c1VVZpUHhkRnhlcXozemxyTjEzUkNSQXNxRTFXd0JvOG5hQk91USI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9qYWR3YWwiO3M6NToicm91dGUiO3M6NjoiamFkd2FsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1767876814),
('ZJNoAYp3xChUyq2htY9nQcPWxEnwkISj3bCq5pHB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXNkNFNhY1Y0TDdMd2UwREdweGVQT294N1BZOWFscklGaXFTaHdVUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767873107);

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hari` varchar(50) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `hari`, `jam_mulai`, `jam_selesai`, `prodi`, `created_at`, `updated_at`) VALUES
(1, 'Senin', '07:30:00', '10:00:00', 'S1 SI', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(2, 'Senin', '10:10:00', '11:50:00', 'S1 SI', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(3, 'Senin', '08:30:00', '10:10:00', 'D3 KA', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(4, 'Senin', '10:10:00', '11:50:00', 'D3 KA', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(5, 'Senin', '09:10:00', '10:00:00', 'S1 BD / A', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(6, 'Senin', '07:30:00', '10:00:00', 'S1 BD / B', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(7, 'Selasa', '07:30:00', '10:00:00', 'S1 SI', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(8, 'Selasa', '12:30:00', '13:20:00', 'S1 SI', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(9, 'Selasa', '14:00:00', '15:30:00', 'D3 KA', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(10, 'Selasa', '08:20:00', '10:00:00', 'S1 BD / A', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(11, 'Selasa', '07:30:00', '10:00:00', 'S1 BD / B', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(12, 'Rabu', '07:30:00', '09:10:00', 'S1 SI', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(13, 'Rabu', '07:30:00', '10:00:00', 'D3 KA', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(14, 'Rabu', '10:10:00', '11:50:00', 'S1 BD / A', '2026-01-06 23:55:56', '2026-01-06 23:55:56'),
(15, 'Rabu', '07:30:00', '10:00:00', 'S1 BD / B', '2026-01-06 23:55:56', '2026-01-06 23:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `surat_tugas`
--

CREATE TABLE `surat_tugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_surat` varchar(100) NOT NULL,
  `dosen_id` bigint(20) UNSIGNED NOT NULL,
  `semester_aktif` varchar(20) NOT NULL,
  `tanggal_terbit` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_tugas`
--

INSERT INTO `surat_tugas` (`id`, `nomor_surat`, `dosen_id`, `semester_aktif`, `tanggal_terbit`, `created_at`, `updated_at`) VALUES
(1, 'sdsdsds', 10, '2025', '2026-01-08', '2026-01-08 05:14:46', '2026-01-08 05:14:46');

-- --------------------------------------------------------

--
-- Table structure for table `surat_tugas_mengajars`
--

CREATE TABLE `surat_tugas_mengajars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dosen_id` bigint(20) UNSIGNED NOT NULL,
  `mata_kuliah_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Nama Dekan, M.T.', 'dekan@siakad.com', NULL, NULL, '$2y$12$y1THhQ1YNZaa5oya3I4eA.LH2h28J5/3jsw8cC2PYzdUplBsHWz1C', NULL, '2026-01-06 23:52:24', '2026-01-06 23:52:24'),
(2, 'Haekal Pirous, S.T., M.A.B.', 'dekan@gmail.com', NULL, NULL, '$2y$12$JH06rbd4thm0lurTz0.9le4SJEjd9rEAqGyfBS7nqO2k/kUmTc9Gu', NULL, '2026-01-06 23:55:57', '2026-01-06 23:55:57'),
(3, 'Sayid Abdul Aziz. S.E.M.M.MBA', 'dosena@gmail.com', NULL, NULL, '$2y$12$UaZ/wqBU7UvQwDjYYIRrCugF8x8gXwS3hJQn7sYEmF.VLmX0ApVE6', NULL, '2026-01-08 03:30:56', '2026-01-08 03:30:56'),
(4, 'fdfdfdf', 'haah@gmail.com', NULL, NULL, '$2y$12$rY/ac0ld805L9e98nPM6U.WAhfqFoLS6K9iOwcUPQrRiHmI67cG5a', NULL, '2026-01-08 03:35:56', '2026-01-08 03:35:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dosen_nidn_unique` (`nidn`),
  ADD UNIQUE KEY `dosen_email_unique` (`email`);

--
-- Indexes for table `dosens`
--
ALTER TABLE `dosens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosens_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_mk_id_foreign` (`mk_id`),
  ADD KEY `jadwal_dosen_id_foreign` (`dosen_id`),
  ADD KEY `jadwal_ruang_id_foreign` (`ruang_id`),
  ADD KEY `jadwal_shift_id_foreign` (`shift_id`),
  ADD KEY `jadwal_kelas_id_foreign` (`kelas_id`);

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
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mahasiswa_nim_unique` (`nim`),
  ADD KEY `mahasiswa_prodi_id_foreign` (`prodi_id`),
  ADD KEY `mahasiswa_dosen_pembimbing_id_foreign` (`dosen_pembimbing_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mks`
--
ALTER TABLE `mks`
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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
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
-- Indexes for table `ruangs`
--
ALTER TABLE `ruangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_tugas`
--
ALTER TABLE `surat_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_tugas_mengajars`
--
ALTER TABLE `surat_tugas_mengajars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_tugas_mengajars_dosen_id_foreign` (`dosen_id`),
  ADD KEY `surat_tugas_mengajars_mata_kuliah_id_foreign` (`mata_kuliah_id`),
  ADD KEY `surat_tugas_mengajars_kelas_id_foreign` (`kelas_id`);

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
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosens`
--
ALTER TABLE `dosens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `mks`
--
ALTER TABLE `mks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ruangs`
--
ALTER TABLE `ruangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `surat_tugas`
--
ALTER TABLE `surat_tugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surat_tugas_mengajars`
--
ALTER TABLE `surat_tugas_mengajars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosens`
--
ALTER TABLE `dosens`
  ADD CONSTRAINT `dosens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosens` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_mk_id_foreign` FOREIGN KEY (`mk_id`) REFERENCES `mks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_ruang_id_foreign` FOREIGN KEY (`ruang_id`) REFERENCES `ruangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_dosen_pembimbing_id_foreign` FOREIGN KEY (`dosen_pembimbing_id`) REFERENCES `dosens` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `mahasiswa_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE SET NULL;

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `surat_tugas_mengajars`
--
ALTER TABLE `surat_tugas_mengajars`
  ADD CONSTRAINT `surat_tugas_mengajars_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `surat_tugas_mengajars_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `surat_tugas_mengajars_mata_kuliah_id_foreign` FOREIGN KEY (`mata_kuliah_id`) REFERENCES `mks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
