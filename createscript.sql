-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 30 okt 2024 om 22:10
-- Serverversie: 8.0.39
-- PHP-versie: 8.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `member-administration`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contributions`
--

CREATE TABLE `contributions` (
  `id` bigint UNSIGNED NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `member_type_id` bigint UNSIGNED NOT NULL,
  `fiscal_year` bigint UNSIGNED NOT NULL,
  `family_member_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `contributions`
--

INSERT INTO `contributions` (`id`, `age`, `amount`, `member_type_id`, `fiscal_year`, `family_member_id`, `created_at`, `updated_at`) VALUES
(1, '51', 45, 5, 1, 1, '2024-10-30 20:53:05', '2024-10-30 20:53:05'),
(2, '13', 25, 3, 1, 7, '2024-10-30 20:59:03', '2024-10-30 20:59:03'),
(3, '13', 25, 3, 3, 7, '2024-10-30 20:59:11', '2024-10-30 20:59:11'),
(4, '13', 25, 3, 4, 7, '2024-10-30 20:59:20', '2024-10-30 20:59:20'),
(5, '13', 25, 3, 5, 7, '2024-10-30 20:59:59', '2024-10-30 20:59:59'),
(6, '1', 50, 1, 1, 2, '2024-10-30 21:01:37', '2024-10-30 21:01:37'),
(7, '1', 50, 1, 6, 2, '2024-10-30 21:01:39', '2024-10-30 21:01:39'),
(8, '8', 40, 2, 1, 9, '2024-10-30 21:02:50', '2024-10-30 21:02:50'),
(9, '8', 40, 2, 2, 9, '2024-10-30 21:02:53', '2024-10-30 21:02:53'),
(10, '25', 100, 4, 1, 16, '2024-10-30 21:03:10', '2024-10-30 21:03:10'),
(11, '25', 100, 4, 2, 16, '2024-10-30 21:03:19', '2024-10-30 21:03:19'),
(12, '19', 100, 4, 1, 11, '2024-10-30 21:04:56', '2024-10-30 21:04:56'),
(13, '19', 100, 4, 5, 11, '2024-10-30 21:05:01', '2024-10-30 21:05:01'),
(14, '54', 45, 5, 1, 17, '2024-10-30 21:06:36', '2024-10-30 21:06:36'),
(15, '54', 45, 5, 2, 17, '2024-10-30 21:06:40', '2024-10-30 21:06:40'),
(16, '51', 45, 5, 1, 18, '2024-10-30 21:06:57', '2024-10-30 21:06:57'),
(17, '51', 45, 5, 2, 18, '2024-10-30 21:07:03', '2024-10-30 21:07:03');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `families`
--

CREATE TABLE `families` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `families`
--

INSERT INTO `families` (`id`, `name`, `adress`, `created_at`, `updated_at`) VALUES
(1, 'Daugherty', '2533 Murazik Prairie Suite 599\nPort Mattie, WV 96817-4185', '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(2, 'Bartoletti', '410 Ken Plaza\nEast Dexterview, PA 43672-0229', '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(3, 'Franecki', '835 Tianna Way\nNew Ralphshire, KY 97782-3944', '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(4, 'Mitchell', '4296 Jeff Mountains Apt. 774\nEinarborough, NJ 03074-0379', '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(5, 'Bayer', '8977 Maryse Green Suite 194\nLake Penelope, CA 51957', '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(6, 'Schultz', '73759 Streich Cove\nWest Mariahberg, VT 61221', '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(7, 'Rath', '693 Schuster Mews Apt. 799\nBorerview, IN 33699', '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(8, 'Beahan', '176 Loyce Crest Suite 654\nEast Lavonne, RI 23169-0425', '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(9, 'O\'Reilly', '6780 Charles Estate\nBoganstad, KY 17794', '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(10, 'Beier', '256 Armstrong Isle\nEast Eleazarport, AR 27438', '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(11, 'Huel', '101 Nils Square\nPort Cordelia, DE 80773-2907', '2024-10-30 20:17:48', '2024-10-30 20:17:48');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `family_members`
--

CREATE TABLE `family_members` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `family_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `family_members`
--

INSERT INTO `family_members` (`id`, `name`, `date_of_birth`, `family_role`, `family_id`, `created_at`, `updated_at`) VALUES
(1, 'Amelia', '1973-10-08', 'Father', 1, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(2, 'Willis', '2023-04-26', 'Mother', 1, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(3, 'Annamae', '2010-12-21', 'Daughter', 2, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(4, 'Callie', '2023-11-15', 'Mother', 2, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(5, 'Ellis', '1984-06-21', 'Father', 3, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(6, 'Flavie', '2011-05-23', 'Father', 3, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(7, 'Dora', '2011-03-10', 'Mother', 4, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(8, 'Florida', '1975-08-16', 'Mother', 4, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(9, 'Doris', '2016-02-13', 'Son', 5, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(10, 'Ryley', '1986-10-31', 'Son', 5, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(11, 'Carroll', '2005-04-15', 'Daughter', 6, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(12, 'Toy', '1977-10-12', 'Son', 6, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(13, 'Cruz', '2009-03-17', 'Daughter', 7, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(14, 'Roderick', '1983-04-07', 'Mother', 7, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(15, 'Trever', '1971-03-07', 'Mother', 8, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(16, 'Loyce', '1999-06-06', 'Father', 8, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(17, 'Heather', '1970-05-28', 'Son', 9, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(18, 'Lorenz', '1972-11-12', 'Son', 9, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(19, 'Rosella', '1980-05-03', 'Son', 10, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(20, 'Gregg', '2006-09-14', 'Mother', 10, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(21, 'Helena', '1972-07-08', 'Daughter', 11, '2024-10-30 20:17:48', '2024-10-30 20:17:48');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `fiscal_years`
--

CREATE TABLE `fiscal_years` (
  `id` bigint UNSIGNED NOT NULL,
  `year` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `fiscal_years`
--

INSERT INTO `fiscal_years` (`id`, `year`, `created_at`, `updated_at`) VALUES
(1, 2020, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(2, 2021, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(3, 2022, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(4, 2023, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(5, 2024, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(6, 2025, '2024-10-30 20:17:48', '2024-10-30 20:17:48');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `member_types`
--

CREATE TABLE `member_types` (
  `id` bigint UNSIGNED NOT NULL,
  `type` enum('youth','aspirant','junior','senior','elder') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `member_types`
--

INSERT INTO `member_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'youth', '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(2, 'aspirant', '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(3, 'junior', '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(4, 'senior', '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(5, 'elder', '2024-10-30 20:17:48', '2024-10-30 20:17:48');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_sessions_table', 1),
(2, '2024_10_07_195800_create_families_table', 1),
(3, '2024_10_07_200726_create_family_members_table', 1),
(4, '2024_10_07_201352_create_contributions_table', 1),
(5, '2024_10_07_201824_create_fiscal_year_table', 1),
(6, '2024_10_07_202241_create_member_types_table', 1),
(7, '2024_10_14_185325_create_roles_table', 1),
(8, '2024_10_14_185341_create_users_table', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'secretary', '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(2, 'treasurer', '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(3, 'user', '2024-10-30 20:17:48', '2024-10-30 20:17:48');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sessions`
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
-- Gegevens worden geëxporteerd voor tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('N9nS3qIFSXwJmmti7pxgfCjOkhSYghARB2J3KZTF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWG9FeklBYzgzUzdLb2RKaDR2SFdDbDNneTA3TmdMVmlCVVZvbWFmSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9tZW1iZXItYWRtaW5pc3RyYXRpb24vbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1730326155);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'secretary', 'secretary@example.com', '$2y$12$UJbs9l4G3uVp5t4TxZ.MYOlkGiO0etzA3u/dae.DonA4YrbXIiuN.', 1, NULL, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(2, 'treasurer', 'treasurer@example.com', '$2y$12$YQiphoWVcu2jOX4ejEpeVOmc1aAQ2SEbDJnfrEzdxu15vawybr9ia', 2, NULL, '2024-10-30 20:17:48', '2024-10-30 20:17:48'),
(3, 'user', 'user@example.com', '$2y$12$aiWhRpBRkcLrPOBInxu16.8faLAPz7d8gaGHwcLw8pvoM5XU.GGg6', 3, NULL, '2024-10-30 20:17:48', '2024-10-30 20:17:48');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `contributions`
--
ALTER TABLE `contributions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contributions_family_member_id_foreign` (`family_member_id`);

--
-- Indexen voor tabel `families`
--
ALTER TABLE `families`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `family_members`
--
ALTER TABLE `family_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `family_members_family_id_foreign` (`family_id`);

--
-- Indexen voor tabel `fiscal_years`
--
ALTER TABLE `fiscal_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `member_types`
--
ALTER TABLE `member_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexen voor tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `contributions`
--
ALTER TABLE `contributions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT voor een tabel `families`
--
ALTER TABLE `families`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `family_members`
--
ALTER TABLE `family_members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT voor een tabel `fiscal_years`
--
ALTER TABLE `fiscal_years`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `member_types`
--
ALTER TABLE `member_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `contributions`
--
ALTER TABLE `contributions`
  ADD CONSTRAINT `contributions_family_member_id_foreign` FOREIGN KEY (`family_member_id`) REFERENCES `family_members` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `family_members`
--
ALTER TABLE `family_members`
  ADD CONSTRAINT `family_members_family_id_foreign` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
