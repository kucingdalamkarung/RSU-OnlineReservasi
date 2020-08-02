-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 16, 2019 at 02:39 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rsu-muhamadiah`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

DROP TABLE IF EXISTS `dokter`;
CREATE TABLE IF NOT EXISTS `dokter` (
  `kodeDokter` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaDokter` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poli` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `dokter_kodedokter_index` (`kodeDokter`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`kodeDokter`, `namaDokter`, `poli`, `status`, `created_at`, `updated_at`) VALUES
('DK001', 'Testing 2', 'PL002', 'Tidak Tetap', '2019-11-16 02:26:59', '2019-11-16 02:27:02'),
('DK002', 'OuoUO', 'PL001', 'Tetap', '2019-11-13 05:55:39', '2019-11-13 05:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

DROP TABLE IF EXISTS `jadwal`;
CREATE TABLE IF NOT EXISTS `jadwal` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dokter` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `dokter`, `hari`, `jam`, `created_at`, `updated_at`) VALUES
(2, 'DK001', 'Senin, Rabu, Kamis', '14.00-15.00', '2019-11-14 02:41:36', '2019-11-14 02:41:36'),
(3, 'DK002', 'Jumat', '14.00-15.00', '2019-11-15 18:59:15', '2019-11-15 18:59:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_petugas_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_11_05_120107_create_poliklinik_table', 1),
(4, '2019_11_06_005338_create_dokter_table', 1),
(5, '2019_11_06_044552_create_jadwal_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

DROP TABLE IF EXISTS `petugas`;
CREATE TABLE IF NOT EXISTS `petugas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `petugas_username_unique` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '$2y$10$uwfvV7zYdgXUQBNebRV2XOc7piGw/Sf8Xm9SnpwWs6T/gyNudHbTS', 'IJuf6KUUj0HQfSUsyEXmIbuOiH8kKLHkqQI0rsTNe95vEDdpKehn4TfkKbid', '2019-11-13 04:30:00', '2019-11-13 04:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `poliklinik`
--

DROP TABLE IF EXISTS `poliklinik`;
CREATE TABLE IF NOT EXISTS `poliklinik` (
  `noPoli` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaPoli` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poliklinik`
--

INSERT INTO `poliklinik` (`noPoli`, `namaPoli`, `created_at`, `updated_at`) VALUES
('PL001', 'Anak', '2019-11-13 04:30:24', '2019-11-13 04:30:24'),
('PL002', 'Gigi', '2019-11-13 04:30:33', '2019-11-13 04:30:33');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
