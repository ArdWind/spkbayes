-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Des 2025 pada 17.48
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
-- Database: `db_spk_ekskul`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `evaluation_results`
--

CREATE TABLE `evaluation_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ekskul_name` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `input_criteria` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`input_criteria`)),
  `predicted_class` varchar(255) NOT NULL,
  `p_sangat_efektif` double NOT NULL,
  `p_efektif` double NOT NULL,
  `p_perlu_evaluasi` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `historical_data`
--

CREATE TABLE `historical_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ekskul_name` varchar(255) NOT NULL,
  `ta_semester` varchar(255) NOT NULL,
  `x1_anggota` varchar(255) NOT NULL,
  `x2_absensi` varchar(255) NOT NULL,
  `x3_prestasi` varchar(255) NOT NULL,
  `x4_kepuasan` varchar(255) NOT NULL,
  `x5_pembina` varchar(255) NOT NULL,
  `class_label` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `historical_data`
--

INSERT INTO `historical_data` (`id`, `ekskul_name`, `ta_semester`, `x1_anggota`, `x2_absensi`, `x3_prestasi`, `x4_kepuasan`, `x5_pembina`, `class_label`, `created_at`, `updated_at`) VALUES
(1, 'PASKIBRA', '2020-1', 'T', 'T', 'TAP', 'SP', 'BS', 'E', NULL, NULL),
(2, 'PRAMUKA', '2020-1', 'S', 'S', 'TAP', 'P', 'GS', 'E', NULL, NULL),
(3, 'KARATE', '2020-1', 'R', 'R', 'TAP', 'TP', 'A', 'PE', NULL, NULL),
(4, 'FUTSAL', '2020-1', 'T', 'T', 'AP', 'P', 'GS', 'SE', NULL, NULL),
(5, 'VOLLEY', '2020-1', 'S', 'T', 'TAP', 'SP', 'BS', 'E', NULL, NULL),
(6, 'PASKIBRA', '2020-2', 'S', 'S', 'TAP', 'P', 'BS', 'E', NULL, NULL),
(7, 'PRAMUKA', '2020-2', 'R', 'S', 'TAP', 'P', 'GS', 'E', NULL, NULL),
(8, 'KARATE', '2020-2', 'R', 'R', 'TAP', 'TP', 'A', 'PE', NULL, NULL),
(9, 'FUTSAL', '2020-2', 'T', 'T', 'AP', 'SP', 'GS', 'SE', NULL, NULL),
(10, 'VOLLEY', '2020-2', 'S', 'S', 'TAP', 'P', 'BS', 'E', NULL, NULL),
(11, 'PASKIBRA', '2021-1', 'T', 'T', 'AP', 'SP', 'BS', 'SE', NULL, NULL),
(12, 'PRAMUKA', '2021-1', 'R', 'R', 'TAP', 'P', 'GS', 'PE', NULL, NULL),
(13, 'KARATE', '2021-1', 'S', 'T', 'TAP', 'SP', 'GS', 'E', NULL, NULL),
(14, 'FUTSAL', '2021-1', 'T', 'T', 'TAP', 'SP', 'BS', 'E', NULL, NULL),
(15, 'VOLLEY', '2021-1', 'T', 'S', 'TAP', 'P', 'GS', 'E', NULL, NULL),
(16, 'PASKIBRA', '2021-2', 'T', 'T', 'AP', 'SP', 'BS', 'SE', NULL, NULL),
(17, 'PRAMUKA', '2021-2', 'R', 'R', 'TAP', 'TP', 'A', 'PE', NULL, NULL),
(18, 'KARATE', '2021-2', 'T', 'S', 'AP', 'P', 'GS', 'SE', NULL, NULL),
(19, 'FUTSAL', '2021-2', 'S', 'R', 'AP', 'P', 'BS', 'PE', NULL, NULL),
(20, 'VOLLEY', '2021-2', 'S', 'T', 'TAP', 'SP', 'BS', 'E', NULL, NULL),
(21, 'PASKIBRA', '2022-1', 'T', 'T', 'TAP', 'SP', 'GS', 'E', NULL, NULL),
(22, 'PRAMUKA', '2022-1', 'R', 'S', 'TAP', 'P', 'GS', 'E', NULL, NULL),
(23, 'KARATE', '2022-1', 'T', 'T', 'AP', 'SP', 'BS', 'SE', NULL, NULL),
(24, 'FUTSAL', '2022-1', 'S', 'S', 'TAP', 'P', 'GS', 'E', NULL, NULL),
(25, 'VOLLEY', '2022-1', 'T', 'T', 'AP', 'SP', 'BS', 'SE', NULL, NULL),
(26, 'PASKIBRA', '2022-2', 'S', 'S', 'TAP', 'P', 'GS', 'E', NULL, NULL),
(27, 'PRAMUKA', '2022-2', 'S', 'T', 'TAP', 'P', 'GS', 'E', NULL, NULL),
(28, 'KARATE', '2022-2', 'T', 'S', 'TAP', 'SP', 'BS', 'E', NULL, NULL),
(29, 'FUTSAL', '2022-2', 'T', 'T', 'AP', 'SP', 'BS', 'SE', NULL, NULL),
(30, 'VOLLEY', '2022-2', 'R', 'S', 'TAP', 'TP', 'A', 'PE', NULL, NULL),
(31, 'PASKIBRA', '2023-1', 'T', 'T', 'AP', 'SP', 'BS', 'SE', NULL, NULL),
(32, 'PRAMUKA', '2023-1', 'T', 'T', 'AP', 'P', 'BS', 'SE', NULL, NULL),
(33, 'KARATE', '2023-1', 'T', 'S', 'AP', 'P', 'BS', 'E', NULL, NULL),
(34, 'FUTSAL', '2023-1', 'T', 'R', 'AP', 'SP', 'GS', 'PE', NULL, NULL),
(35, 'VOLLEY', '2023-1', 'T', 'T', 'TAP', 'SP', 'GS', 'E', NULL, NULL),
(36, 'PASKIBRA', '2023-2', 'T', 'S', 'AP', 'SP', 'BS', 'E', NULL, NULL),
(37, 'PRAMUKA', '2023-2', 'S', 'S', 'TAP', 'P', 'GS', 'E', NULL, NULL),
(38, 'KARATE', '2023-2', 'T', 'T', 'TAP', 'SP', 'BS', 'E', NULL, NULL),
(39, 'FUTSAL', '2023-2', 'T', 'R', 'AP', 'P', 'GS', 'PE', NULL, NULL),
(40, 'VOLLEY', '2023-2', 'S', 'S', 'TAP', 'P', 'GS', 'E', NULL, NULL),
(41, 'PASKIBRA', '2024-1', 'T', 'T', 'AP', 'SP', 'BS', 'SE', NULL, NULL),
(42, 'PRAMUKA', '2024-1', 'T', 'T', 'TAP', 'SP', 'BS', 'E', NULL, NULL),
(43, 'KARATE', '2024-1', 'R', 'R', 'TAP', 'TP', 'A', 'PE', NULL, NULL),
(44, 'FUTSAL', '2024-1', 'S', 'S', 'TAP', 'P', 'GS', 'E', NULL, NULL),
(45, 'VOLLEY', '2024-1', 'T', 'T', 'AP', 'SP', 'BS', 'SE', NULL, NULL),
(46, 'PASKIBRA', '2024-2', 'T', 'T', 'TAP', 'P', 'BS', 'E', NULL, NULL),
(47, 'PRAMUKA', '2024-2', 'S', 'S', 'TAP', 'P', 'GS', 'E', NULL, NULL),
(48, 'KARATE', '2024-2', 'R', 'R', 'TAP', 'TP', 'A', 'PE', NULL, NULL),
(49, 'FUTSAL', '2024-2', 'T', 'T', 'AP', 'SP', 'BS', 'SE', NULL, NULL),
(50, 'VOLLEY', '2024-2', 'T', 'T', 'TAP', 'SP', 'BS', 'E', NULL, NULL),
(51, 'PASKIBRA', '2025-1', 'T', 'T', 'AP', 'SP', 'BS', 'SE', NULL, NULL),
(52, 'PRAMUKA', '2025-1', 'T', 'T', 'AP', 'SP', 'GS', 'SE', NULL, NULL),
(53, 'KARATE', '2025-1', 'S', 'T', 'TAP', 'P', 'GS', 'E', NULL, NULL),
(54, 'FUTSAL', '2025-1', 'T', 'T', 'AP', 'SP', 'BS', 'SE', NULL, NULL),
(55, 'VOLLEY', '2025-1', 'S', 'T', 'TAP', 'SP', 'GS', 'E', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `evaluation_results`
--
ALTER TABLE `evaluation_results`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `historical_data`
--
ALTER TABLE `historical_data`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `evaluation_results`
--
ALTER TABLE `evaluation_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `historical_data`
--
ALTER TABLE `historical_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
