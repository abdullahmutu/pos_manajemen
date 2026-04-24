-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 24 Apr 2026 pada 15.37
-- Versi server: 8.0.30
-- Versi PHP: 8.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_ku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksis`
--

CREATE TABLE `detail_transaksis` (
  `id` bigint UNSIGNED NOT NULL,
  `transaksi_id` bigint UNSIGNED NOT NULL,
  `produk_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_transaksis`
--

INSERT INTO `detail_transaksis` (`id`, `transaksi_id`, `produk_id`, `jumlah`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 68000.00, 68000.00, '2026-04-23 23:18:31', '2026-04-23 23:18:31'),
(2, 1, 5, 1, 3500.00, 3500.00, '2026-04-23 23:18:31', '2026-04-23 23:18:31'),
(3, 2, 3, 1, 68000.00, 68000.00, '2026-04-24 05:03:27', '2026-04-24 05:03:27'),
(4, 2, 5, 1, 3500.00, 3500.00, '2026-04-24 05:03:27', '2026-04-24 05:03:27'),
(5, 3, 3, 1, 68000.00, 68000.00, '2026-04-24 05:17:53', '2026-04-24 05:17:53'),
(6, 3, 5, 1, 3500.00, 3500.00, '2026-04-24 05:17:53', '2026-04-24 05:17:53'),
(7, 3, 7, 1, 10000.00, 10000.00, '2026-04-24 05:17:53', '2026-04-24 05:17:53'),
(8, 4, 1, 1, 15000.00, 15000.00, '2026-04-24 07:46:41', '2026-04-24 07:46:41'),
(9, 4, 3, 1, 68000.00, 68000.00, '2026-04-24 07:46:41', '2026-04-24 07:46:41'),
(10, 4, 5, 1, 3500.00, 3500.00, '2026-04-24 07:46:41', '2026-04-24 07:46:41'),
(11, 5, 3, 1, 68000.00, 68000.00, '2026-04-24 07:47:04', '2026-04-24 07:47:04'),
(12, 5, 5, 1, 3500.00, 3500.00, '2026-04-24 07:47:04', '2026-04-24 07:47:04'),
(13, 6, 3, 1, 68000.00, 68000.00, '2026-04-24 07:49:17', '2026-04-24 07:49:17'),
(14, 6, 5, 2, 3500.00, 7000.00, '2026-04-24 07:49:17', '2026-04-24 07:49:17'),
(15, 7, 3, 1, 68000.00, 68000.00, '2026-04-24 07:49:18', '2026-04-24 07:49:18'),
(16, 7, 5, 2, 3500.00, 7000.00, '2026-04-24 07:49:18', '2026-04-24 07:49:18'),
(17, 8, 3, 1, 68000.00, 68000.00, '2026-04-24 07:49:18', '2026-04-24 07:49:18'),
(18, 8, 5, 2, 3500.00, 7000.00, '2026-04-24 07:49:18', '2026-04-24 07:49:18'),
(19, 9, 3, 1, 68000.00, 68000.00, '2026-04-24 07:49:19', '2026-04-24 07:49:19'),
(20, 9, 5, 2, 3500.00, 7000.00, '2026-04-24 07:49:19', '2026-04-24 07:49:19'),
(21, 10, 3, 1, 68000.00, 68000.00, '2026-04-24 07:49:19', '2026-04-24 07:49:19'),
(22, 10, 5, 2, 3500.00, 7000.00, '2026-04-24 07:49:19', '2026-04-24 07:49:19'),
(23, 11, 3, 1, 68000.00, 68000.00, '2026-04-24 07:49:19', '2026-04-24 07:49:19'),
(24, 11, 5, 2, 3500.00, 7000.00, '2026-04-24 07:49:19', '2026-04-24 07:49:19'),
(25, 12, 3, 1, 68000.00, 68000.00, '2026-04-24 07:49:19', '2026-04-24 07:49:19'),
(26, 12, 5, 2, 3500.00, 7000.00, '2026-04-24 07:49:19', '2026-04-24 07:49:19'),
(27, 13, 3, 1, 68000.00, 68000.00, '2026-04-24 07:52:08', '2026-04-24 07:52:08'),
(28, 13, 5, 2, 3500.00, 7000.00, '2026-04-24 07:52:08', '2026-04-24 07:52:08'),
(29, 14, 3, 1, 68000.00, 68000.00, '2026-04-24 07:56:18', '2026-04-24 07:56:18'),
(30, 14, 5, 1, 3500.00, 3500.00, '2026-04-24 07:56:18', '2026-04-24 07:56:18'),
(31, 14, 7, 1, 10000.00, 10000.00, '2026-04-24 07:56:18', '2026-04-24 07:56:18'),
(32, 15, 3, 1, 68000.00, 68000.00, '2026-04-24 07:58:14', '2026-04-24 07:58:14'),
(33, 15, 5, 1, 3500.00, 3500.00, '2026-04-24 07:58:14', '2026-04-24 07:58:14'),
(34, 15, 7, 1, 10000.00, 10000.00, '2026-04-24 07:58:14', '2026-04-24 07:58:14'),
(35, 16, 3, 1, 68000.00, 68000.00, '2026-04-24 08:05:03', '2026-04-24 08:05:03'),
(36, 16, 5, 1, 3500.00, 3500.00, '2026-04-24 08:05:03', '2026-04-24 08:05:03'),
(37, 17, 3, 1, 68000.00, 68000.00, '2026-04-24 08:05:19', '2026-04-24 08:05:19'),
(38, 17, 5, 1, 3500.00, 3500.00, '2026-04-24 08:05:19', '2026-04-24 08:05:19'),
(39, 17, 7, 1, 10000.00, 10000.00, '2026-04-24 08:05:19', '2026-04-24 08:05:19'),
(40, 18, 3, 1, 68000.00, 68000.00, '2026-04-24 08:11:56', '2026-04-24 08:11:56'),
(41, 18, 5, 1, 3500.00, 3500.00, '2026-04-24 08:11:56', '2026-04-24 08:11:56'),
(42, 18, 7, 1, 10000.00, 10000.00, '2026-04-24 08:11:56', '2026-04-24 08:11:56'),
(43, 19, 3, 1, 68000.00, 68000.00, '2026-04-24 08:13:08', '2026-04-24 08:13:08'),
(44, 19, 5, 1, 3500.00, 3500.00, '2026-04-24 08:13:08', '2026-04-24 08:13:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

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
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_24_023304_create_produks_table', 1),
(5, '2026_04_24_023333_create_transaksis_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produks`
--

CREATE TABLE `produks` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` decimal(15,2) NOT NULL DEFAULT '0.00',
  `harga_jual` decimal(15,2) NOT NULL DEFAULT '0.00',
  `stok` int NOT NULL DEFAULT '0',
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pcs',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produks`
--

INSERT INTO `produks` (`id`, `nama_produk`, `kategori`, `harga_beli`, `harga_jual`, `stok`, `satuan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Gula Pasir 1kg', 'Sembako', 13000.00, 15000.00, 49, 'kg', NULL, '2026-04-23 19:55:41', '2026-04-24 07:46:41'),
(2, 'Minyak Goreng 1L', 'Sembako', 14000.00, 16000.00, 30, 'liter', NULL, '2026-04-23 19:55:41', '2026-04-23 19:55:41'),
(3, 'Beras Premium 5kg', 'Sembako', 60000.00, 68000.00, 1, 'kg', NULL, '2026-04-23 19:55:41', '2026-04-24 08:13:08'),
(4, 'Indomie Goreng', 'Sembako', 3000.00, 3500.00, 100, 'pcs', NULL, '2026-04-23 19:55:41', '2026-04-23 19:55:41'),
(5, 'Aqua 600ml', 'Minuman', 2500.00, 3500.00, 25, 'pcs', NULL, '2026-04-23 19:55:41', '2026-04-24 08:13:08'),
(6, 'Teh Botol Sosro', 'Minuman', 4000.00, 5000.00, 48, 'pcs', NULL, '2026-04-23 19:55:41', '2026-04-23 19:55:41'),
(7, 'Chitato 68gr', 'Snack', 8000.00, 10000.00, 19, 'pcs', NULL, '2026-04-23 19:55:41', '2026-04-24 08:11:56'),
(8, 'Sabun Lifebuoy', 'Kebersihan', 4000.00, 5500.00, 36, 'pcs', NULL, '2026-04-23 19:55:41', '2026-04-23 19:55:41'),
(9, 'Pasta Gigi Pepsodent', 'Kebersihan', 9000.00, 12000.00, 5, 'pcs', NULL, '2026-04-23 19:55:41', '2026-04-23 19:55:41'),
(10, 'Kopi Kapal Api', 'Minuman', 1500.00, 2000.00, 3, 'pcs', NULL, '2026-04-23 19:55:41', '2026-04-23 19:55:41'),
(11, 'Win Filter 20', 'Rokok', 28500.00, 30000.00, 20, 'pcs', NULL, '2026-04-23 20:02:59', '2026-04-23 20:02:59'),
(12, 'Win Click', 'Rokok', 24000.00, 25000.00, 34, 'pcs', NULL, '2026-04-24 05:37:04', '2026-04-24 05:37:04'),
(13, 'Tepung Beras', 'Tepung', 20000.00, 22000.00, 21, 'kg', NULL, '2026-04-24 07:00:37', '2026-04-24 07:00:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pBtvhiV3GQLLyE9jCmVvuY7YiGQ6mFi6S0pEf6Fs', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'eyJfdG9rZW4iOiJ6elFSM25xektqeFlNUU9zS2VqMWNORVhHaGxDaDl4Tjc2MVpuUGVzIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDEiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=', 1777044989);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `no_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_harga` decimal(15,2) NOT NULL DEFAULT '0.00',
  `bayar` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kembalian` decimal(15,2) NOT NULL DEFAULT '0.00',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksis`
--

INSERT INTO `transaksis` (`id`, `user_id`, `no_transaksi`, `total_harga`, `bayar`, `kembalian`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 1, 'TRX-20260424-0001', 71500.00, 100000.00, 28500.00, NULL, '2026-04-23 23:18:31', '2026-04-23 23:18:31'),
(2, 1, 'TRX-20260424-0002', 71500.00, 100000.00, 28500.00, NULL, '2026-04-24 05:03:27', '2026-04-24 05:03:27'),
(3, 1, 'TRX-20260424-0003', 81500.00, 100000.00, 18500.00, NULL, '2026-04-24 05:17:53', '2026-04-24 05:17:53'),
(4, 1, 'TRX-20260424-0004', 86500.00, 200000.00, 113500.00, NULL, '2026-04-24 07:46:41', '2026-04-24 07:46:41'),
(5, 1, 'TRX-20260424-0005', 71500.00, 100000.00, 28500.00, NULL, '2026-04-24 07:47:04', '2026-04-24 07:47:04'),
(6, 1, 'TRX-20260424-0006', 75000.00, 150000.00, 75000.00, NULL, '2026-04-24 07:49:17', '2026-04-24 07:49:17'),
(7, 1, 'TRX-20260424-0007', 75000.00, 150000.00, 75000.00, NULL, '2026-04-24 07:49:18', '2026-04-24 07:49:18'),
(8, 1, 'TRX-20260424-0008', 75000.00, 150000.00, 75000.00, NULL, '2026-04-24 07:49:18', '2026-04-24 07:49:18'),
(9, 1, 'TRX-20260424-0009', 75000.00, 150000.00, 75000.00, NULL, '2026-04-24 07:49:19', '2026-04-24 07:49:19'),
(10, 1, 'TRX-20260424-0010', 75000.00, 150000.00, 75000.00, NULL, '2026-04-24 07:49:19', '2026-04-24 07:49:19'),
(11, 1, 'TRX-20260424-0011', 75000.00, 150000.00, 75000.00, NULL, '2026-04-24 07:49:19', '2026-04-24 07:49:19'),
(12, 1, 'TRX-20260424-0012', 75000.00, 150000.00, 75000.00, NULL, '2026-04-24 07:49:19', '2026-04-24 07:49:19'),
(13, 1, 'TRX-20260424-0013', 75000.00, 100000.00, 25000.00, NULL, '2026-04-24 07:52:08', '2026-04-24 07:52:08'),
(14, 1, 'TRX-20260424-0014', 81500.00, 100000.00, 18500.00, NULL, '2026-04-24 07:56:18', '2026-04-24 07:56:18'),
(15, 1, 'TRX-20260424-0015', 81500.00, 100000.00, 18500.00, NULL, '2026-04-24 07:58:14', '2026-04-24 07:58:14'),
(16, 1, 'TRX-20260424-0016', 71500.00, 100000.00, 28500.00, NULL, '2026-04-24 08:05:03', '2026-04-24 08:05:03'),
(17, 1, 'TRX-20260424-0017', 81500.00, 100000.00, 18500.00, NULL, '2026-04-24 08:05:19', '2026-04-24 08:05:19'),
(18, 1, 'TRX-20260424-0018', 81500.00, 100000.00, 18500.00, NULL, '2026-04-24 08:11:56', '2026-04-24 08:11:56'),
(19, 2, 'TRX-20260424-0019', 71500.00, 100000.00, 28500.00, NULL, '2026-04-24 08:13:08', '2026-04-24 08:13:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','kasir') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'kasir',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@toko.com', NULL, '$2y$12$oUeeZS/kvEqnpszB84Wbk.0gQlfed0dXMZAJcj0yjKUlWeLqFt9im', 'admin', NULL, '2026-04-23 19:55:40', '2026-04-23 19:55:40'),
(2, 'Kasir', 'kasir@toko.com', NULL, '$2y$12$oG/mPL9CnzhfUp87gzY.VODpL4tlk8OhAloSNxaCrv.1jm9I7jLNW', 'kasir', NULL, '2026-04-23 19:55:41', '2026-04-23 19:55:41');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_transaksis_transaksi_id_foreign` (`transaksi_id`),
  ADD KEY `detail_transaksis_produk_id_foreign` (`produk_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksis_no_transaksi_unique` (`no_transaksi`),
  ADD KEY `transaksis_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  ADD CONSTRAINT `detail_transaksis_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_transaksis_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
