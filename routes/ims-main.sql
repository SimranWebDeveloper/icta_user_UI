-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 05 Nis 2024, 12:40:48
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ims`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `branches`
--

INSERT INTO `branches` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Şöbə yoxdur', 1, '2024-04-05 06:13:19', '2024-04-05 06:13:19'),
(2, '2.1. Elektron kommunikasiya şöbəsi', 1, '2024-04-05 06:13:19', '2024-04-05 06:13:19'),
(3, '2.2. Texniki tənzimləmə şöbəsi', 1, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(4, '2.3. Poçt rabitəsi şöbəsi', 1, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(5, '2.4. Radiospektr idarəçiliyi şöbəsi', 1, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(6, '3.1. Xidmət bazarlarına nəzarət şöbəsi', 1, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(7, '3.2.  İstehlakçı hüquqları şöbəsi', 1, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(8, '4.1. Rəqəmsal təminat və inkişaf şöbəsi', 1, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(9, '4.2. Şəbəkə inzibatçılığı və texniki dəstək şöbəsi', 1, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(10, 'Şöbə yoxdur', 1, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(11, '5.1. Hüquq şöbəsi', 1, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(12, '5.2. Sənədlərlə iş şöbəsi', 1, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(13, 'VI. İnsan resursları şöbəsi', 1, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(14, 'VI. Maliyyə şöbəsi', 1, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(15, 'VIII. Satınalma və təsərrüfat şöbəsi', 1, '2024-04-05 06:13:21', '2024-04-05 06:13:21');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kateqoriya 1', 1, '2024-04-05 06:13:22', '2024-04-05 06:13:22');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'I. İdarə Heyəti', 1, '2024-04-05 06:13:19', '2024-04-05 06:13:19'),
(2, 'II. Tənzimləmə departamenti', 1, '2024-04-05 06:13:19', '2024-04-05 06:13:19'),
(3, 'III. Xidmət bazarlarına nəzarət və istehlakçı hüquqları departamenti', 1, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(4, 'IV.  İnformasiya texnologiyaları departamenti', 1, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(5, 'V. Hüquq və sənədlərlə iş departamenti', 1, '2024-04-05 06:13:21', '2024-04-05 06:13:21');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `failed_jobs`
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
-- Tablo için tablo yapısı `appointments`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `products_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendors_id` bigint(20) UNSIGNED NOT NULL,
  `e_invoice_number` varchar(50) NOT NULL,
  `total_amount` double(8,2) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `jobs`
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
-- Tablo için tablo yapısı `job_batches`
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
-- Tablo için tablo yapısı `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `logs`
--

INSERT INTO `logs` (`id`, `type`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Sistemə giriş', 'Şıxıyev Cavid Çapar oğlu sistemə giriş etdi.', '2024-04-05 06:16:26', '2024-04-05 06:16:26');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_04_02_123622_create_departments_table', 1),
(7, '2024_04_02_124004_create_branches_table', 1),
(8, '2024_04_02_124035_create_rooms_table', 1),
(9, '2024_04_02_124130_create_categories_table', 1),
(10, '2024_04_02_124215_create_vendors_table', 1),
(11, '2024_04_02_124239_create_users_table', 1),
(12, '2024_04_03_055510_create_logs_table', 1),
(13, '2024_04_04_073143_create_invoices_table', 1),
(14, '2024_04_04_124238_create_products_table', 1),
(15, '2024_04_04_130208_create_transactions_table', 1),
(16, '2024_04_05_065847_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoices_id` bigint(20) UNSIGNED NOT NULL,
  `categories_id` bigint(20) UNSIGNED NOT NULL,
  `material_type` varchar(15) NOT NULL,
  `avr_code` varchar(15) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` double(8,2) NOT NULL,
  `size` varchar(15) NOT NULL,
  `purchase_count` int(11) NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL DEFAULT 0,
  `inventory_cost` double(8,2) NOT NULL,
  `activity_status` int(11) NOT NULL DEFAULT 1,
  `status` varchar(255) NOT NULL DEFAULT 'Yeni',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `room` varchar(255) DEFAULT NULL,
  `position` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `department`, `branch`, `room`, `position`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'I. İdarə Heyəti', 'Şöbə yoxdur', NULL, 'İdarə Heyətinin sədr müavini', 'Mərdanov Nail Teyyub oğlu', NULL, NULL, '$2y$10$GIKK4TDnA45wpjG2oqqG5uT3DRrw3x8SWg0AzvjK4mUWOzzPZAmOe', NULL, '2024-04-05 06:13:19', '2024-04-05 06:13:19'),
(2, 'I. İdarə Heyəti', 'Şöbə yoxdur', NULL, 'Media ilə iş üzrə baş mütəxəssis', 'İbadlı Tural Qabil oğlu', NULL, NULL, '$2y$10$AGvwfo6QEnvJpF/nl2x9.egnR3Ftkw/0RHJb7XWJzsnhQ9VVIAbfC', NULL, '2024-04-05 06:13:19', '2024-04-05 06:13:19'),
(3, 'I. İdarə Heyəti', 'Şöbə yoxdur', NULL, 'Beynəlxalq əməkdaşlıq üzrə baş mütəxəssis', 'İsgəndərov Ravil Məmməd oğlu', NULL, NULL, '$2y$10$mfllLXv134DzpztYfai12e2kWUbxZ49nk2Iogd//ytA68Frl7UWx.', NULL, '2024-04-05 06:13:19', '2024-04-05 06:13:19'),
(4, 'I. İdarə Heyəti', 'Şöbə yoxdur', NULL, 'Kiçik mütəxəssis', 'Əliyev Elvir Vüqar oğlu', NULL, NULL, '$2y$10$oXVkcEJ5fo4rFoIjTcgyleDqEGV2w5xoDPDbg9wCVJmGi1nL3PO7.', NULL, '2024-04-05 06:13:19', '2024-04-05 06:13:19'),
(5, 'II. Tənzimləmə departamenti', '2.1. Elektron kommunikasiya şöbəsi', NULL, 'Şöbə müdiri', 'Zərbəliyev Tural Süleyman oğlu', NULL, NULL, '$2y$10$Sz5m3X73PbG2P4u1x9c/qObJmwZiFsvJMazgLhpKGLf0YatkGZzqO', NULL, '2024-04-05 06:13:19', '2024-04-05 06:13:19'),
(6, 'II. Tənzimləmə departamenti', '2.1. Elektron kommunikasiya şöbəsi', NULL, 'Baş mütəxəssis', 'Əliyev Aydın Məhəmmədəli oğlu', NULL, NULL, '$2y$10$4xjcoFtnyhMfTqyawuxkU.85f7DQe5K.gWrOuBJzs79SuLsbLWHNi', NULL, '2024-04-05 06:13:19', '2024-04-05 06:13:19'),
(7, 'II. Tənzimləmə departamenti', '2.1. Elektron kommunikasiya şöbəsi', NULL, 'Aparıcı mütəxəssis', 'Abbasov Elvin Şirulla oğlu', NULL, NULL, '$2y$10$GpvjAlKxnPwRaZfQxOV/deFBfZtGw0enA0F7m5bCFnIqfRjhphQhy', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(8, 'II. Tənzimləmə departamenti', '2.1. Elektron kommunikasiya şöbəsi', NULL, 'Aparıcı mütəxəssis', ' İsmayılov İlqar Müzəffər oğlu', NULL, NULL, '$2y$10$jnuFmAUoAWwnQxunUmUrLublXmDEfHXQtNT8KyPtTkraG5vxG65gu', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(9, 'II. Tənzimləmə departamenti', '2.1. Elektron kommunikasiya şöbəsi', NULL, 'Aparıcı mütəxəssis', 'Quliyev Murad Tofiq oğlu', NULL, NULL, '$2y$10$cHSidyzgm8y/etJsoS8V.OEQhukYblNpGcJXECHhQydnslKBcNX.6', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(10, 'II. Tənzimləmə departamenti', '2.1. Elektron kommunikasiya şöbəsi', NULL, 'Mütəxəssis', 'Əhmədova Dərya Qoşqar qızı', NULL, NULL, '$2y$10$mOSwq9gN6P/p7dFJeRcRl.PaWOHXeApcq.8Ojv6k32jzs0iiDEKo2', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(11, 'II. Tənzimləmə departamenti', '2.1. Elektron kommunikasiya şöbəsi', NULL, 'Mütəxəssis', 'Quliyeva Röya Elmir qızı', NULL, NULL, '$2y$10$cedtMafadD6gs5cxnkDHUeLToCkbX/Go1B.671qf1K41oY6/gfrAO', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(12, 'II. Tənzimləmə departamenti', '2.2. Texniki tənzimləmə şöbəsi', NULL, 'Baş mütəxəssis', 'Quluyev Müşfiq Balacan oğlu', NULL, NULL, '$2y$10$RdM/JuoDZejUQWGUYv/y5eltPcI0MqC1mSZ.BWPZKKimUecQpMehq', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(13, 'II. Tənzimləmə departamenti', '2.2. Texniki tənzimləmə şöbəsi', NULL, 'Aparıcı mütəxəssis', 'Ağababayev Rahib Rəsul oğlu', NULL, NULL, '$2y$10$Hyxe.0kbucVu1r6/1m/uk.EYhkkIovLzXmFFq2CTVff8VvELCApfi', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(14, 'II. Tənzimləmə departamenti', '2.3. Poçt rabitəsi şöbəsi', NULL, 'Aparıcı mütəxəssis', 'Səmədov Vüqar Oktay oğlu', NULL, NULL, '$2y$10$KdMtv5Js0/dOpi.W1EfyveBymrZKLDSr9n9VVKuyf3tVXdlvqubmK', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(15, 'II. Tənzimləmə departamenti', '2.3. Poçt rabitəsi şöbəsi', NULL, 'Aparıcı mütəxəssis', 'Nəsibova Şəhla Firuddin qızı', NULL, NULL, '$2y$10$jaYy5o6SF2AZQiHs54ISt.ha0.cO2ogMbX8XQ0s662/5bSAmiBYQW', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(16, 'II. Tənzimləmə departamenti', '2.3. Poçt rabitəsi şöbəsi', NULL, 'Mütəxəssis', 'Rəhimli Vüsal Elşən oğlu', NULL, NULL, '$2y$10$m9mLwwCqhe8y68t0zvmoHuSq6vYvLgCja04Ks53Dvw.iaJJcr14zu', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(17, 'II. Tənzimləmə departamenti', '2.4. Radiospektr idarəçiliyi şöbəsi', NULL, 'Şöbə müdiri', 'Süleymanov Vüsal Fərman oğlu', NULL, NULL, '$2y$10$jN5Q4R/yQkwyilKStecUse2kdIRRVefByRQPI9kaYrp29Xj.9tkfC', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(18, 'II. Tənzimləmə departamenti', '2.4. Radiospektr idarəçiliyi şöbəsi', NULL, 'Aparıcı mütəxəssis', 'Muradzadə Elvin İlqar oğlu', NULL, NULL, '$2y$10$hav5Lyd3j37jz7EHcEVSKe0qPVULtfiV2F6FndZYDaw.tGVXfrUQK', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(19, 'II. Tənzimləmə departamenti', '2.4. Radiospektr idarəçiliyi şöbəsi', NULL, 'Aparıcı mütəxəssis', 'Hüseynov Salman Bəhram oğlu', NULL, NULL, '$2y$10$WscL/pEQunlhicyZEQGrgOyHyRORegEfZ1XDdg5GXHRCUXoEcW8mC', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(20, 'II. Tənzimləmə departamenti', '2.4. Radiospektr idarəçiliyi şöbəsi', NULL, 'Mütəxəssis', 'Dadaşova Aypara Hicran qızı', NULL, NULL, '$2y$10$hVDFyy3G/zijGTQAcAW3ju2amldLvEm6dJPOdYYf3b.A/JVnkIcVu', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(21, 'II. Tənzimləmə departamenti', '2.4. Radiospektr idarəçiliyi şöbəsi', NULL, 'Mütəxəssis', 'Şıxıyeva Könül Əlibala qızı', NULL, NULL, '$2y$10$IQaooWXa8B7UJt1dEBjIUO6t2pGdHgsS7/0NLF0tKoU//i6PDop9q', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(22, 'III. Xidmət bazarlarına nəzarət və istehlakçı hüquqları departamenti', '3.1. Xidmət bazarlarına nəzarət şöbəsi', NULL, 'Şöbə müdiri', 'İsmayılov Nail Mirzə Musa oğlu', NULL, NULL, '$2y$10$yB5QEgDe4HhnncmwCc8WsetN/m/nRJTFf78OnRvkkz7w4PaNKcIve', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(23, 'III. Xidmət bazarlarına nəzarət və istehlakçı hüquqları departamenti', '3.1. Xidmət bazarlarına nəzarət şöbəsi', NULL, 'Baş mütəxəssis', 'Kərimova Xumar Elşad oğlu', NULL, NULL, '$2y$10$M5yQZjYETbBcADv3WXpO0elzeb5bNjjLRnhDWEDgbF2nH.P9zFrDi', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(24, 'III. Xidmət bazarlarına nəzarət və istehlakçı hüquqları departamenti', '3.1. Xidmət bazarlarına nəzarət şöbəsi', NULL, 'Aparıcı mütəxəssis', 'Bayramlı Şahmar Faiq oğlu', NULL, NULL, '$2y$10$eJ0X6WdlmHCwOiJPd59MxuZYQGNBznJ9nLTwmOVEyBeo5.iJWztN6', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(25, 'III. Xidmət bazarlarına nəzarət və istehlakçı hüquqları departamenti', '3.1. Xidmət bazarlarına nəzarət şöbəsi', NULL, 'Aparıcı mütəxəssis', 'Məcidova Xəyalə Arif qızı', NULL, NULL, '$2y$10$9IrTEDKJChYhQ4Nfo.a2KOVOcuyVKUOoYMexrWxn4CUvsCYRkI9YG', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(26, 'III. Xidmət bazarlarına nəzarət və istehlakçı hüquqları departamenti', '3.1. Xidmət bazarlarına nəzarət şöbəsi', NULL, 'Aparıcı mütəxəssis', 'Nağıyev Kənan Vüqar oğlu', NULL, NULL, '$2y$10$nD7NwJEzZm1bU1YyxV46o.0GIQJBm1O8m7NzGrVCoFtma4lLKpREm', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(27, 'III. Xidmət bazarlarına nəzarət və istehlakçı hüquqları departamenti', '3.1. Xidmət bazarlarına nəzarət şöbəsi', NULL, 'Aparıcı mütəxəssis', 'Qurbanov Muxtar Talış oğlu', NULL, NULL, '$2y$10$kJd2bFZVbIRv/kESeg5qdOjnO7lWazolsx90SJlGgcrtbPKI0.b/O', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(28, 'III. Xidmət bazarlarına nəzarət və istehlakçı hüquqları departamenti', '3.2.  İstehlakçı hüquqları şöbəsi', NULL, 'Şöbə müdiri', 'Mikayılov Xalid Vahid oğlu', NULL, NULL, '$2y$10$zAaxZkDeV8hcCtL9Z3k2/eyIzOSnJw34.uy9rTwsTdRGznyf0C28e', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(29, 'III. Xidmət bazarlarına nəzarət və istehlakçı hüquqları departamenti', '3.2.  İstehlakçı hüquqları şöbəsi', NULL, 'Baş mütəxəssis', 'Yusifova Nigar İsmayıl qızı', NULL, NULL, '$2y$10$s82u.8Uvw8La2PRGxonZl.zDesgdcpc..bVlPnE2CW5nO63Xk7ZkW', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(30, 'III. Xidmət bazarlarına nəzarət və istehlakçı hüquqları departamenti', '3.2.  İstehlakçı hüquqları şöbəsi', NULL, 'Aparıcı mütəxəssis', 'Hüseynova Səkinə Nağı qızı', NULL, NULL, '$2y$10$Im6DMRtrx2AotbXaJFEgse6Y1ENwsUNTt5yXM0gv4pFqMaLPVyMrW', NULL, '2024-04-05 06:13:20', '2024-04-05 06:13:20'),
(31, 'III. Xidmət bazarlarına nəzarət və istehlakçı hüquqları departamenti', '3.2.  İstehlakçı hüquqları şöbəsi', NULL, 'Aparıcı mütəxəssis', 'Ələkbərov Seyhun Əndəhət oğlu', NULL, NULL, '$2y$10$K1kfFl4ZftOeq857zST68Om71cuYOCI0SBkQ5Joq4bZqCs21mKFLm', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(32, 'III. Xidmət bazarlarına nəzarət və istehlakçı hüquqları departamenti', '3.2.  İstehlakçı hüquqları şöbəsi', NULL, 'Aparıcı mütəxəssis', 'Ağayev İmran Xanbaba oğlu', NULL, NULL, '$2y$10$mKc/AOYNxHwRLPr.KuxOuOowhSDK.6Ssq2SjsMlHXJDzuZCsVjPnO', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(33, 'III. Xidmət bazarlarına nəzarət və istehlakçı hüquqları departamenti', '3.2.  İstehlakçı hüquqları şöbəsi', NULL, 'Mütəxəssis', 'Qurbanov Fariz Əbülhəsən oğlu', NULL, NULL, '$2y$10$WeRupcTYkWXC3IQIwLdngu../KCFS2JhiJnpRj4FcpkqCU3u5/b5S', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(34, 'III. Xidmət bazarlarına nəzarət və istehlakçı hüquqları departamenti', '3.2.  İstehlakçı hüquqları şöbəsi', NULL, 'Mütəxəssis', 'Bəşirova Nərmin Arzu qızı', NULL, NULL, '$2y$10$Oe3EbT1uSBZJRqedhhI4P.friSpBIcvq2JWbrQZ2xT6MhmyixUW/m', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(35, 'III. Xidmət bazarlarına nəzarət və istehlakçı hüquqları departamenti', '3.2.  İstehlakçı hüquqları şöbəsi', NULL, 'Mütəxəssis', 'Maqsudova Nailə Elxan qızı', NULL, NULL, '$2y$10$.Fl.3FQLpcW/mRtWPiOBBu3gySe98UvAVcOr8Ssyj/gchhgZC4dQq', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(36, 'IV.  İnformasiya texnologiyaları departamenti', '4.1. Rəqəmsal təminat və inkişaf şöbəsi', NULL, 'Şöbə müdiri -Data analitika üzrə mütəxəssis', 'Bağırzadə İslam Aydın oğlu', NULL, NULL, '$2y$10$a6CKuQU8eAiPWl4CLDQfQ.2t5sUd6Iavh4a0tWxQZsApTpMpzva02', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(37, 'IV.  İnformasiya texnologiyaları departamenti', '4.1. Rəqəmsal təminat və inkişaf şöbəsi', NULL, 'Proqramlaşma üzrə inzibatçı', 'Şıxəliyev Emin Nadir oğlu', NULL, NULL, '$2y$10$0JS.fg95khzYvhrPD1kmBeqrmWhL5DBQ2mckX1GytO.2ExQJS/xtK', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(38, 'IV.  İnformasiya texnologiyaları departamenti', '4.1. Rəqəmsal təminat və inkişaf şöbəsi', NULL, 'Proqramçı mühəndis', 'Cəfərli Eşqin İman oğlu', NULL, NULL, '$2y$10$pEw.kBt7PAYDAkvWhonLGugQEKrIOt2/jQNh.sRF2LjV4xcp2KgM2', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(39, 'IV.  İnformasiya texnologiyaları departamenti', '4.1. Rəqəmsal təminat və inkişaf şöbəsi', NULL, 'Proqramçı mühəndis', 'Həzərxanlı Məhəmməd Şaiq oğlu', NULL, NULL, '$2y$10$aY3VGyXxwKdOmI1bLCMAW.jYY1CnKRRn47.NsOIT5MRfHHghWSKQS', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(40, 'IV.  İnformasiya texnologiyaları departamenti', '4.2. Şəbəkə inzibatçılığı və texniki dəstək şöbəsi', NULL, 'Şöbə müdiri - Şəbəkə inzibatçısı', 'Namazov Asim Tahir oğlu', NULL, NULL, '$2y$10$lrEiOUO1A/Arcsb5lXevLOCTReiFOAhS0NoWpah2s2aSC9UrZQ6Ze', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(41, 'IV.  İnformasiya texnologiyaları departamenti', '4.2. Şəbəkə inzibatçılığı və texniki dəstək şöbəsi', NULL, 'Verilənlər bazasını idarə edən inzibatçı', 'İsmayıl Cavid Ramiz oğlu', NULL, NULL, '$2y$10$UXqG7hjILsP6dVpWiJomQeDI/bMnUDz4UvHsvKIUpPvg.mGlQ9XdC', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(42, 'IV.  İnformasiya texnologiyaları departamenti', '4.2. Şəbəkə inzibatçılığı və texniki dəstək şöbəsi', NULL, 'Texniki dəstək mütəxəssisi', 'Həsənli Cavid Rəfael oğlu', NULL, NULL, '$2y$10$l1ao4TmgjbbkLy/IFOkkGeWzqKNpc36mVCzQ2E80SVNRjbwUTv7Ya', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(43, 'IV.  İnformasiya texnologiyaları departamenti', '4.2. Şəbəkə inzibatçılığı və texniki dəstək şöbəsi', NULL, 'Texniki dəstək mütəxəssisi', 'Şıxıyev Cavid Çapar oğlu', 'admin@gmail.com', NULL, '$2y$10$yq7uI134WO1sbXoEYvTM8O5tCdvPXXAW7ZR5wRYWbZzrTxokbvbRe', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(44, 'V. Hüquq və sənədlərlə iş departamenti', 'Şöbə yoxdur', NULL, 'Departament direktoru', 'Məhərrəmov Oktay Əvəz oğlu', NULL, NULL, '$2y$10$H116brB4Vw8rPr6Mxb5Mzuzw054tarorGO.AGGE13oSwm0bkaR7ka', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(45, 'V. Hüquq və sənədlərlə iş departamenti', '5.1. Hüquq şöbəsi', NULL, 'Aparıcı hüquqşünas', 'Süleymanlı Sənan Şahbaz oğlu', NULL, NULL, '$2y$10$p22CtpAAbvsFhmoFdxi44OuKLPUy80UDNO13OCIYVSB5yw9WfstFS', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(46, 'V. Hüquq və sənədlərlə iş departamenti', '5.1. Hüquq şöbəsi', NULL, 'Aparıcı hüquqşünas', 'Qarayeva Aysel İntiqam qızı', NULL, NULL, '$2y$10$o8ZigmjMK7hXTL/Pw4obku0Bw8sl7PrDWM.e45LcoGJga8Gg6XDZS', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(47, 'V. Hüquq və sənədlərlə iş departamenti', '5.1. Hüquq şöbəsi', NULL, 'Hüquqşünas', 'Kələntərova Əminə İntiqam qızı', NULL, NULL, '$2y$10$t8BVT18GmRIDOdag5qtywO9bwNElx4hhCC/BNGcHek.Ufmxrm4KcS', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(48, 'V. Hüquq və sənədlərlə iş departamenti', '5.2. Sənədlərlə iş şöbəsi', NULL, 'Şöbə müdiri', 'Qədirov Elman Ağahüseyn oğlu', NULL, NULL, '$2y$10$WCKHURSCGPUTSWW2Asp64.e2YJ944gRPOldWo8oMbSAR4Y0Dhgdk2', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(49, 'V. Hüquq və sənədlərlə iş departamenti', '5.2. Sənədlərlə iş şöbəsi', NULL, 'Mütəxəssis', 'Cavdzadə Aynurə Əbülfəz qızı', NULL, NULL, '$2y$10$E0GodNt.pmlXqsGhFyfUSu4ltSZ0RmJKiJm6NL5ojbxF1SUPS.xzO', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(50, 'V. Hüquq və sənədlərlə iş departamenti', 'VI. İnsan resursları şöbəsi', NULL, 'Şöbə müdiri', 'Qədimova-Vəliyeva Güllər Həsənəli qızı', NULL, NULL, '$2y$10$IwlsgqjrcXhIpDvBZm/x0uBmlD1hTZucpcNJV4Ab7DKPlFooZN8TG', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(51, 'V. Hüquq və sənədlərlə iş departamenti', 'VI. İnsan resursları şöbəsi', NULL, 'Mütəxəssis', 'Bayramova Fəridə Elxan qızı', NULL, NULL, '$2y$10$tBj/tvt7Z6Bg/u9/RdRqa.zsLIbwv378igMJeOUlzDvDR3nTGzmrO', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(52, 'V. Hüquq və sənədlərlə iş departamenti', 'VI. Maliyyə şöbəsi', NULL, 'Baş mühasib', 'Bayramzadə Emin Salman oğlu', NULL, NULL, '$2y$10$9nXNbxJrXEWMq3yg5L6oRO0cdSG4ukPGfpKiXL17nrHqxUAXA6z6i', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(53, 'V. Hüquq və sənədlərlə iş departamenti', 'VI. Maliyyə şöbəsi', NULL, 'Baş mütəxəssis', 'Həsənov Rəşad Asəf oğlu', NULL, NULL, '$2y$10$KrBJEl589e3L/616RqjU.eL387GgUgWMXHH8I.W57mzblIU52JhR6', NULL, '2024-04-05 06:13:21', '2024-04-05 06:13:21'),
(54, 'V. Hüquq və sənədlərlə iş departamenti', 'VIII. Satınalma və təsərrüfat şöbəsi', NULL, 'Aparıcı mütəxəssis', 'Məmmədov Asim Rasim oğlu', NULL, NULL, '$2y$10$pOrs/B86uu4NPEaFRg4QWePWmMbjey3.bhlxuxDUOIh.Sk966Jszy', NULL, '2024-04-05 06:13:22', '2024-04-05 06:13:22'),
(55, 'V. Hüquq və sənədlərlə iş departamenti', 'VIII. Satınalma və təsərrüfat şöbəsi', NULL, 'Aparıcı mütəxəssis', 'Ənvərli Elman Kərim oğlu', NULL, NULL, '$2y$10$Dv/F//W4NKu5wqqLCKskLuo1x3vA5xL3eNt509os0.2r9ObdI4ace', NULL, '2024-04-05 06:13:22', '2024-04-05 06:13:22'),
(56, 'V. Hüquq və sənədlərlə iş departamenti', 'VIII. Satınalma və təsərrüfat şöbəsi', NULL, 'Xadimə', 'Abbaslı Nigar Vilayət qızı', NULL, NULL, '$2y$10$gKj0WQaSX4rS1NMRrZvAbORwaJ.5Bs4uYXuUKvHOpBAvD/fkrU.DO', NULL, '2024-04-05 06:13:22', '2024-04-05 06:13:22'),
(57, 'V. Hüquq və sənədlərlə iş departamenti', 'VIII. Satınalma və təsərrüfat şöbəsi', NULL, 'Xadimə', 'Rüstəmova Solmaz Məsim qızı', NULL, NULL, '$2y$10$OCJUFZppWwuAuAa921P3HuP34Mq6uPIqoajqRxa7CXrZFnKI9KIAK', NULL, '2024-04-05 06:13:22', '2024-04-05 06:13:22'),
(58, 'V. Hüquq və sənədlərlə iş departamenti', 'VIII. Satınalma və təsərrüfat şöbəsi', NULL, 'Sürücü', 'Əhmədov Elnur Gəray oğlu', NULL, NULL, '$2y$10$SDdzxDB4STU1Ke2hnMV.0u.whiO/zOHJG9wuTnScHt0ksmJFxdmUG', NULL, '2024-04-05 06:13:22', '2024-04-05 06:13:22');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `relevant_person` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `email`, `relevant_person`, `phone_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rabitə və Yüksək Texnologiyalar Nazirliyi', NULL, NULL, NULL, 1, '2024-04-05 06:13:22', '2024-04-05 06:39:56');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Tablo için indeksler `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Tablo için indeksler `appointments`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_user_id_foreign` (`user_id`),
  ADD KEY `inventories_products_id_foreign` (`products_id`);

--
-- Tablo için indeksler `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_vendors_id_foreign` (`vendors_id`);

--
-- Tablo için indeksler `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Tablo için indeksler `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Tablo için indeksler `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Tablo için indeksler `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Tablo için indeksler `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Tablo için indeksler `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Tablo için indeksler `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_invoices_id_foreign` (`invoices_id`),
  ADD KEY `products_categories_id_foreign` (`categories_id`);

--
-- Tablo için indeksler `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Tablo için indeksler `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Tablo için indeksler `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Tablo için indeksler `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `appointments`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Tablo için AUTO_INCREMENT değeri `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `appointments`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_products_id_foreign` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_vendors_id_foreign` FOREIGN KEY (`vendors_id`) REFERENCES `vendors` (`id`) ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_categories_id_foreign` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_invoices_id_foreign` FOREIGN KEY (`invoices_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
