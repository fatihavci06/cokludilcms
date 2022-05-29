-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 29 May 2022, 11:08:21
-- Sunucu sürümü: 10.4.18-MariaDB
-- PHP Sürümü: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `cokludilcms`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blogand_categories`
--

CREATE TABLE `blogand_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `blogand_categories`
--

INSERT INTO `blogand_categories` (`id`, `blog_id`, `category_id`, `created_at`, `updated_at`) VALUES
(23, 23, 6, '2022-04-27 17:36:13', '2022-04-27 17:36:13'),
(24, 23, 7, '2022-04-27 17:36:13', '2022-04-27 17:36:13'),
(25, 24, 8, '2022-04-27 18:41:41', '2022-04-27 18:41:41');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL,
  `isAktive` int(11) NOT NULL COMMENT '0 ise pasif 1 ise aktif',
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `blogs`
--

INSERT INTO `blogs` (`id`, `language_id`, `isAktive`, `image`, `slug`, `title`, `description`, `keywords`, `content`, `date`, `created_at`, `updated_at`) VALUES
(23, 1, 1, 'images/bWMoaCWazoLTDmS3335FKJe8vQ5kUgousOczbHDS.png', 'blog-tr-1', 'Blog Tr 1', 'Blog Tr 1 açıklama', 'blogtr1', '<p>Blog Tr 1 i&ccedil;erik alanıdır</p>', '2022-12-01', '2022-04-27 17:36:13', '2022-04-27 17:36:13'),
(24, 10, 1, 'images/HYqVok4fK0FXfv83jEPcemrVqRxtjh4z7w1r9j12.png', 'en', 'en', 'en', 'e', '<p>en</p>', '2022-12-31', '2022-04-27 18:41:41', '2022-04-27 18:41:41'),
(25, 1, 1, 'images/bWMoaCWazoLTDmS3335FKJe8vQ5kUgousOczbHDS.png', 'blog-tr-1', 'Blog Tr 1', 'Blog Tr 1 açıklama', 'blogtr1', 'apça', '2022-12-01', '2022-04-27 17:36:13', '2022-04-27 17:36:13');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `language_id`, `name`, `title`, `description`, `keywords`, `slug`, `created_at`, `updated_at`) VALUES
(6, 1, 'Televiyon', 'televizyon', '<p>Televizyon a&ccedil;ıklama</p>', 'televizyon', 'televizyon', '2022-04-27 17:33:49', '2022-04-27 17:33:49'),
(7, 1, 'Bilgisayar', 'Bilgisayar', '<p>Bilgisayar a&ccedil;ıklama</p>', 'bilgisayar keywords', 'bilgisayar', '2022-04-27 17:34:20', '2022-04-27 17:34:20'),
(8, 10, 'Television', 'televizion', '<p>television desc</p>', 'television', 'televizion', '2022-04-27 17:34:39', '2022-04-27 17:34:39'),
(9, 10, 'Computer', 'Computer', '<p>Computer desc</p>', 'computer', 'computer', '2022-04-27 17:34:56', '2022-04-27 17:34:56');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `isAktive` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `blog_id`, `parent_id`, `name`, `email`, `comment`, `isAktive`, `created_at`, `updated_at`) VALUES
(1, 23, 0, 'fafass', 'fatih22@gmail.com', 'ada', 1, '2022-05-08 17:26:18', '2022-05-08 17:26:18'),
(2, 23, 1, 'adada', 'adada@sfsf', 'cada', 0, '2022-05-08 17:27:47', '2022-05-08 17:27:47'),
(3, 23, 1, 'adada', 'adada@sfsf', 'cada', 0, '2022-05-08 17:27:47', '2022-05-08 17:27:47'),
(4, 23, 1, 'adada', 'adada@sfsf', 'cada', 0, '2022-05-08 17:27:47', '2022-05-08 17:27:47'),
(5, 23, 1, 'fatih', '66fatihavci@gmail.com', 'cada', 0, '2022-05-08 17:29:21', '2022-05-08 17:29:21'),
(6, 23, 1, 'fatih', '66fatihavci@gmail.com', 'cada', 0, '2022-05-08 17:33:06', '2022-05-08 17:33:06'),
(7, 23, 1, 'fatih', 'fatih.avci@paragonteknoloji.com', 'cada', 0, '2022-05-08 17:34:13', '2022-05-08 17:34:13'),
(8, 23, 1, 'fatih', '66fatihavci@gmail.com', 'cada', 0, '2022-05-08 17:34:36', '2022-05-08 17:34:36'),
(9, 23, 1, 'Türkçe', 'fatih.avci@paragonteknoloji.com', 'cada', 0, '2022-05-01 17:34:57', '2022-05-08 17:34:57'),
(10, 23, 1, 'fatih', 'fatih.avci@paragonteknoloji.com', 'cada', 0, '2022-05-08 17:35:15', '2022-05-08 17:35:15'),
(12, 23, 0, 'fafass', 'fatih22@gmail.com', 'ada', 0, '2022-05-08 17:26:18', '2022-05-08 17:26:18'),
(13, 23, 0, 'hayrettin', 'hayrettin@test.com', 'srests', 0, '2022-05-11 08:06:31', '2022-05-11 08:06:31'),
(14, 1, 2, 'Paragon Teknoloji', 'paragonteknoloi@gmail.com', 'sadad', 0, '2022-05-11 17:21:27', '2022-05-11 17:21:27'),
(15, 1, 2, 'cevahir test', 'cevahir@test.net', 'ssa', 0, '2022-05-11 17:24:06', '2022-05-11 17:24:06'),
(16, 1, 2, 'Paragon Teknoloji', 'paragonteknoloi@gmail.com', 'saa', 0, '2022-05-11 17:24:26', '2022-05-11 17:24:26'),
(17, 1, 2, 'Paragon Teknoloji', 'paragonteknoloi@gmail.com', 'saas', 0, '2022-05-11 17:24:46', '2022-05-11 17:24:46'),
(18, 1, 2, 'fatih test', 'fatih.avci@paragonteknoloji.com', 'sa', 0, '2022-05-11 17:25:36', '2022-05-11 17:25:36'),
(19, 1, 2, 'Paragon Teknoloji', 'paragonteknoloi@gmail.com', 'adada', 0, '2022-05-11 17:36:54', '2022-05-11 17:36:54'),
(20, 23, 0, 'Fatih AVCI', 'ahmet@test.com', 'dada', 0, '2022-05-11 17:37:13', '2022-05-11 17:37:13'),
(21, 1, 2, 'fatih', '66fatihavci@gmail.com', 'sasa', 0, '2022-05-11 17:40:41', '2022-05-11 17:40:41'),
(22, 23, 20, 'fatih', '66fatihavci@gmail.com', 'dasda', 0, '2022-05-11 17:45:32', '2022-05-11 17:45:32'),
(23, 23, 20, 'cevahir test', 'cevahir@test.net', '3435', 0, '2022-05-11 17:45:45', '2022-05-11 17:45:45'),
(24, 23, 13, 'Paragon Teknoloji', 'paragonteknoloi@gmail.com', '333', 0, '2022-05-11 17:45:52', '2022-05-11 17:45:52'),
(25, 23, 0, 'Fatih AVCI2', 'fatih.avci@paragonteknoloji.com', '22222', 0, '2022-05-11 17:46:13', '2022-05-11 17:46:13'),
(26, 23, 20, 'Paragon Teknoloji', 'paragonteknoloi@gmail.com', 'sadad', 0, '2022-05-11 17:47:28', '2022-05-11 17:47:28'),
(27, 23, 25, 'Paragon Teknoloji', 'paragonteknoloi@gmail.com', 'sasa', 0, '2022-05-11 17:47:35', '2022-05-11 17:47:35'),
(28, 23, 25, 'cevahir test', 'cevahir@test.net', 'dadas', 0, '2022-05-11 17:47:44', '2022-05-11 17:47:44');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `failed_jobs`
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
-- Tablo için tablo yapısı `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Türkçe', 'tr', '2022-03-14 10:21:09', '2022-03-14 10:21:09'),
(10, 'İngilizce', 'en', '2022-03-15 07:50:46', '2022-04-03 17:18:03');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `language_contents`
--

CREATE TABLE `language_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `languageId` int(11) NOT NULL,
  `chapter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chapterSub` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_03_10_121421_create_languages_table', 2),
(6, '2022_03_10_121636_create_language_contents_table', 2),
(7, '2022_03_14_121724_create_sliders_table', 3),
(8, '2022_03_15_113929_create_slider_contents_table', 4),
(10, '2022_03_18_112656_create_services_table', 5),
(11, '2022_03_23_104332_create_blog_categories_table', 6),
(12, '2022_03_24_081543_create_blogs_table', 7),
(13, '2022_03_24_082851_blogtocategory', 8),
(14, '2022_03_24_092700_create_blogand_categories_table', 9),
(16, '2022_03_27_132456_create_pages_table', 10),
(17, '2022_03_29_183949_create_projects_table', 11),
(18, '2022_04_01_104919_create_takims_table', 12),
(19, '2022_04_02_202100_create_settings_table', 13),
(20, '2022_04_02_210650_create_setting_texts_table', 14),
(21, '2022_04_03_201912_create_referens_table', 15),
(22, '2022_05_05_092528_create_newlestters_table', 16),
(23, '2022_05_08_184256_create_comments_table', 17);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `newlestters`
--

CREATE TABLE `newlestters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `newlestters`
--

INSERT INTO `newlestters` (`id`, `email`, `created_at`, `updated_at`) VALUES
(2, 'sss22', '2022-05-06 18:02:08', '2022-05-06 18:02:08'),
(5, 's', '2022-05-06 18:05:20', '2022-05-06 18:05:20'),
(6, 'dada', '2022-05-06 18:05:41', '2022-05-06 18:05:41'),
(7, 'sfs', '2022-05-06 18:06:31', '2022-05-06 18:06:31'),
(8, '3535', '2022-05-06 18:09:20', '2022-05-06 18:09:20'),
(9, 'adad', '2022-05-06 18:11:04', '2022-05-06 18:11:04'),
(10, 'dad', '2022-05-06 18:11:07', '2022-05-06 18:11:07'),
(11, 'sss', '2022-05-06 18:12:29', '2022-05-06 18:12:29'),
(12, 'zzzz', '2022-05-06 18:15:53', '2022-05-06 18:15:53'),
(13, 'sfsfs', '2022-05-06 18:16:02', '2022-05-06 18:16:02'),
(14, 's@tes.c', '2022-05-06 18:25:07', '2022-05-06 18:25:07'),
(15, 's@s', '2022-05-06 18:25:16', '2022-05-06 18:25:16'),
(16, 'sfsfs@tes.c', '2022-05-06 18:26:53', '2022-05-06 18:26:53'),
(17, 's@tes.csdf', '2022-05-06 18:29:45', '2022-05-06 18:29:45'),
(18, 'fatih@test.com', '2022-05-06 18:30:59', '2022-05-06 18:30:59'),
(19, 'fatih@test.com', '2022-05-06 18:30:59', '2022-05-06 18:30:59'),
(20, 'fatih@test.com', '2022-05-06 18:30:59', '2022-05-06 18:30:59'),
(21, 'fatih@t.c', '2022-05-06 18:31:12', '2022-05-06 18:31:12'),
(23, 'f@t.c', '2022-05-06 18:32:31', '2022-05-06 18:32:31'),
(25, 'paragonteknoloi@gmail.com', '2022-05-11 17:48:52', '2022-05-11 17:48:52');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `isAktive` int(11) NOT NULL,
  `order_number` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pages`
--

INSERT INTO `pages` (`id`, `language_id`, `image`, `name`, `url`, `slug`, `title`, `description`, `keywords`, `content`, `isAktive`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 10, 'images/5aijct0JgtFVboBoUQ3P7hxzhDbVsSVm75R82vQz.png', 'about', NULL, 'baslik2', 'Başlık2', 'açıklama2', 'key2', '<p>İ&ccedil;erik2</p>', 1, 0, '2022-03-27 11:17:32', '2022-04-05 08:23:38'),
(4, 1, 'images/3fBui9MpJZAks4qCI4jk1NjxnK4nOI4plRfxpClr.png', 'hakkimizda', NULL, 'hakkimizda', '2', '4', '6', '<p>3</p>', 1, 1, '2022-03-27 16:57:16', '2022-04-05 08:23:38'),
(5, 1, 'images/3fBui9MpJZAks4qCI4jk1NjxnK4nOI4plRfxpClr.png', 'hakkimizda', NULL, 'sfsfljk', '2', '4', '6', '<p>3</p>', 1, 1, '2022-03-27 16:57:16', '2022-04-05 08:23:38');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `order_number` int(11) NOT NULL,
  `isAktive` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `aciklama` varchar(255) NOT NULL,
  `language_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `projects`
--

INSERT INTO `projects` (`id`, `url`, `slug`, `order_number`, `isAktive`, `image`, `name`, `aciklama`, `language_id`, `created_at`, `updated_at`) VALUES
(2, NULL, 'selam', 1, 1, 'images/XTMCoL40PXlZ1zNhy0C8wQkM33t6IVWdcihuzeAC.png', 'Selam', 'açıklamamadada', 10, '2022-03-29 16:06:59', '2022-03-29 17:04:12'),
(3, NULL, 'proje-adi-1', 0, 1, 'images/cf1nWJnP81825XNgI43M1k1GGjbpbxTicot2U8d1.jpg', 'Proje Adı 1', 'Açıklama1', 1, '2022-04-07 07:28:38', '2022-04-07 07:28:38'),
(4, NULL, 'proje-adi-2', 1, 1, 'images/1JMaH0ubws6x0YF13FZe5ukkSzPNypekS4fAH5vM.jpg', 'Proje Adı 2', 'Açıklama 2', 1, '2022-04-07 07:29:08', '2022-04-07 07:29:08'),
(5, NULL, 'selam', 1, 1, 'images/XTMCoL40PXlZ1zNhy0C8wQkM33t6IVWdcihuzeAC.png', 'Selam', 'açıklamamadada', 10, '2022-03-29 16:06:59', '2022-03-29 17:04:12'),
(6, NULL, 'proje-adi-1', 0, 1, 'images/cf1nWJnP81825XNgI43M1k1GGjbpbxTicot2U8d1.jpg', 'Proje Adı 1-EN', 'Açıklama1-EN', 10, '2022-04-07 07:28:38', '2022-04-07 07:28:38'),
(7, NULL, 'proje-adi-2', 1, 1, 'images/1JMaH0ubws6x0YF13FZe5ukkSzPNypekS4fAH5vM.jpg', 'Proje Adı 2 EN', 'Açıklama 2-EN', 10, '2022-04-07 07:29:08', '2022-04-07 07:29:08');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `referens`
--

CREATE TABLE `referens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(200) NOT NULL,
  `order_number` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `referens`
--

INSERT INTO `referens` (`id`, `image`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 'images/Xudh6v5K5I0ZSWlDlmTTjlRqaXlJzH2ASGVTsjGM.png', 0, '2022-04-03 17:44:39', '2022-04-07 15:40:36'),
(3, 'images/BSBlaV5M6g8W1FTYwWqtOEhxMNR7pMEmdkv0Wh8x.png', 0, '2022-04-03 18:00:27', '2022-04-07 15:40:56'),
(4, 'images/Xudh6v5K5I0ZSWlDlmTTjlRqaXlJzH2ASGVTsjGM.png', 0, '2022-04-03 17:44:39', '2022-04-07 15:40:36'),
(5, 'images/BSBlaV5M6g8W1FTYwWqtOEhxMNR7pMEmdkv0Wh8x.png', 0, '2022-04-03 18:00:27', '2022-04-07 15:40:56'),
(6, 'images/Xudh6v5K5I0ZSWlDlmTTjlRqaXlJzH2ASGVTsjGM.png', 0, '2022-04-03 17:44:39', '2022-04-07 15:40:36'),
(7, 'images/BSBlaV5M6g8W1FTYwWqtOEhxMNR7pMEmdkv0Wh8x.png', 0, '2022-04-03 18:00:27', '2022-04-07 15:40:56'),
(8, 'images/Xudh6v5K5I0ZSWlDlmTTjlRqaXlJzH2ASGVTsjGM.png', 0, '2022-04-03 17:44:39', '2022-04-07 15:40:36'),
(9, 'images/BSBlaV5M6g8W1FTYwWqtOEhxMNR7pMEmdkv0Wh8x.png', 0, '2022-04-03 18:00:27', '2022-04-07 15:40:56');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `order_number` int(11) NOT NULL DEFAULT 0,
  `isAktive` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `mini_image` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `mini_desc` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `services`
--

INSERT INTO `services` (`id`, `language_id`, `icon`, `order_number`, `isAktive`, `image`, `mini_image`, `title`, `mini_desc`, `description`, `created_at`, `updated_at`) VALUES
(2, 1, 'icon-search', 2, 1, 'images/x4EFBnNUi5KbAPe1OlXLQKwLEUVSVReSGEEijybd.png', 'images/5tasPCZDx3e96qbxDId4NbyuAFiOHatSz9fnLYmB.png', 'Market', 'market açıklama', '<p>fsf22</p>', '2022-03-18 15:34:01', '2022-04-05 07:59:50'),
(4, 1, 'icon-linegraph', 3, 1, 'images/7KMbxyqbtBpjPmqYs28z7z7EhC6TJUrCurM46NFn.png', 'images/UYT2SoQuyZgOOPH1Qv8MFWF9QSZoBNza4wVTdc3O.png', 'İş Büyümesi', 'İş açıklama', '<p>&ccedil;ok iyi oldu on numara</p>', '2022-03-21 06:51:51', '2022-03-21 06:52:14'),
(5, 1, 'icon-genius', 4, 1, 'images/Sy8RxReYw4zui7Itnwxc9bTKilSWDYMmBx1fTQIs.png', 'images/UYT2SoQuyZgOOPH1Qv8MFWF9QSZoBNza4wVTdc3O.png', 'Reklam Planı', 'Reklam açıklama', '<p>2</p>', '2022-03-21 06:53:04', '2022-03-21 06:53:04'),
(6, 1, 'icon-genius', 5, 1, 'images/7KMbxyqbtBpjPmqYs28z7z7EhC6TJUrCurM46NFn.png', 'images/UYT2SoQuyZgOOPH1Qv8MFWF9QSZoBNza4wVTdc3O.png', 'Satış ve Ticaret', 'Satış açıklama', '<p>&ccedil;ok iyi oldu on numara</p>', '2022-03-21 06:51:51', '2022-03-21 06:52:14'),
(7, 1, 'icon-documents', 6, 1, 'images/Sy8RxReYw4zui7Itnwxc9bTKilSWDYMmBx1fTQIs.png', 'images/UYT2SoQuyZgOOPH1Qv8MFWF9QSZoBNza4wVTdc3O.png', 'Başarılı Rapor', 'Rapor açıklama', '<p>2</p>', '2022-03-21 06:53:04', '2022-03-21 06:53:04'),
(8, 10, 'icon-bargraph', 1, 1, 'images/ovVIJzHOIvMjOXwZO0d33ID9CJsycYh18qt3dp3c.png', 'images/UYT2SoQuyZgOOPH1Qv8MFWF9QSZoBNza4wVTdc3O.png', 'Financial', 'financial desc', '<p>A&ccedil;ıklama</p>', '2022-03-18 11:04:52', '2022-04-05 07:54:47'),
(9, 10, 'icon-search', 2, 1, 'images/x4EFBnNUi5KbAPe1OlXLQKwLEUVSVReSGEEijybd.png', 'images/5tasPCZDx3e96qbxDId4NbyuAFiOHatSz9fnLYmB.png', 'Marketing', 'marketing desc', '<p>fsf22</p>', '2022-03-18 15:34:01', '2022-04-05 07:59:50'),
(10, 10, 'icon-linegraph', 3, 1, 'images/7KMbxyqbtBpjPmqYs28z7z7EhC6TJUrCurM46NFn.png', 'images/UYT2SoQuyZgOOPH1Qv8MFWF9QSZoBNza4wVTdc3O.png', 'Business', 'business desc', '<p>&ccedil;ok iyi oldu on numara</p>', '2022-03-21 06:51:51', '2022-03-21 06:52:14'),
(11, 10, 'icon-genius', 4, 1, 'images/Sy8RxReYw4zui7Itnwxc9bTKilSWDYMmBx1fTQIs.png', 'images/UYT2SoQuyZgOOPH1Qv8MFWF9QSZoBNza4wVTdc3O.png', 'Investing', 'investing desc', '<p>2</p>', '2022-03-21 06:53:04', '2022-03-21 06:53:04'),
(12, 10, 'icon-genius', 5, 1, 'images/7KMbxyqbtBpjPmqYs28z7z7EhC6TJUrCurM46NFn.png', 'images/UYT2SoQuyZgOOPH1Qv8MFWF9QSZoBNza4wVTdc3O.png', 'Sales and Trades', 'Sales desc', '<p>&ccedil;ok iyi oldu on numara</p>', '2022-03-21 06:51:51', '2022-03-21 06:52:14'),
(13, 10, 'icon-documents', 6, 1, 'images/Sy8RxReYw4zui7Itnwxc9bTKilSWDYMmBx1fTQIs.png', 'images/UYT2SoQuyZgOOPH1Qv8MFWF9QSZoBNza4wVTdc3O.png', 'Success Report', 'Success report desc', '<p>2</p>', '2022-03-21 06:53:04', '2022-03-21 06:53:04'),
(14, 1, '2', 2, 1, 'images/CA4sHwwcAj83t7rkZ6OCPXgwZXPjsrjQSkzrXi5a.jpg', 'images/rjrI6c409KeZMaVTVM2sLfgZpBTYnSXiUINKw271.jpg', '2', '2', '<p>2</p>', '2022-05-06 19:02:47', '2022-05-06 19:02:47');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `year_experience` int(11) NOT NULL DEFAULT 0,
  `year_won` int(11) NOT NULL DEFAULT 0,
  `expart_stuff` int(11) NOT NULL DEFAULT 0,
  `happy_customer` int(11) NOT NULL DEFAULT 0,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `pinterest` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `email`, `address`, `phone`, `year_experience`, `year_won`, `expart_stuff`, `happy_customer`, `facebook`, `twitter`, `instagram`, `pinterest`, `linkedin`, `youtube`, `created_at`, `updated_at`) VALUES
(1, '66fatihavci@gmail.com', 'Cengizhan Mahallesi 850.Sokak Mamak/Ankara', '+90(553)110-52-00', 32, 42, 52, 62, '72', '82', '92', '1023', '112', '122', NULL, '2022-04-02 18:05:41');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `setting_texts`
--

CREATE TABLE `setting_texts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL,
  `site_title` varchar(255) NOT NULL,
  `site_description` varchar(255) NOT NULL,
  `site_keywords` varchar(255) NOT NULL,
  `site_footer_text` varchar(255) NOT NULL,
  `banner_title` text DEFAULT NULL,
  `banner_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `setting_texts`
--

INSERT INTO `setting_texts` (`id`, `language_id`, `site_title`, `site_description`, `site_keywords`, `site_footer_text`, `banner_title`, `banner_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'tr_title22', 'tr_desc2', 'tr_keywords2', 'tr_footer_text2', 'İŞ DANIŞMANLIĞINDA 15 YILLIK TECRÜBEMİZ VAR.', 'Yönetim danışmanlığı, kuruluşların performansına, geliştirme iyileştirmesine yardımcı olma uygulamasıdır.', '2022-04-02 18:53:42', '2022-04-14 15:54:00'),
(2, 10, 'en_title', 'en_desc', 'en_keywords', 'en_footer_text', 'WE HAVE 15 YEARS OF EXPERIENCE IN BUSINESS CONSULTANCY.', 'Management consulting is the practice of helping organizations performance, the development improvement.', '2022-04-02 18:54:54', '2022-04-14 15:54:38');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider_contents`
--

CREATE TABLE `slider_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `order_number` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `slider_contents`
--

INSERT INTO `slider_contents` (`id`, `language_id`, `title`, `description`, `url`, `image`, `order_number`, `created_at`, `updated_at`) VALUES
(53, 1, '1', '2', '3', 'images/sL40OM0T80umqMWcUOMACovDuT2YGHYQoU9wOAXy.jpg', 0, '2022-04-04 17:50:39', '2022-04-04 17:50:39'),
(54, 1, '12', '22', '32', 'images/cqJmcsdOOtMa16I8tcivA3Q4jULQcXDaVwPrD6Z6.jpg', 0, '2022-04-04 17:50:56', '2022-04-04 17:50:56'),
(55, 1, '31', '32', '33', 'images/efQSqgUpZinC29fVVRjAFBAEpVLlBsqgyDbMviDl.jpg', 0, '2022-04-04 17:51:18', '2022-04-04 17:51:18'),
(56, 10, '1', '2', '3', 'images/sL40OM0T80umqMWcUOMACovDuT2YGHYQoU9wOAXy.jpg', 0, '2022-04-04 17:50:39', '2022-04-04 17:50:39'),
(57, 10, '12', '22', '32', 'images/cqJmcsdOOtMa16I8tcivA3Q4jULQcXDaVwPrD6Z6.jpg', 0, '2022-04-04 17:50:56', '2022-04-04 17:50:56'),
(58, 10, '31', '32', '33', 'images/efQSqgUpZinC29fVVRjAFBAEpVLlBsqgyDbMviDl.jpg', 0, '2022-04-04 17:51:18', '2022-04-04 17:51:18');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `takims`
--

CREATE TABLE `takims` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pozisyon` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `order_number` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `isAktive` int(11) NOT NULL DEFAULT 11 COMMENT '1:aktif,2:pasif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `takims`
--

INSERT INTO `takims` (`id`, `language_id`, `name`, `pozisyon`, `description`, `order_number`, `image`, `isAktive`, `created_at`, `updated_at`) VALUES
(4, 1, 'Ali VELİ', 'Uzman1', 'iyi adamdır iyi çalışır', 0, 'images/WlUeA0tvYeVzKcpWsRRBnzvrxwqLHqwamUTN8bxN.jpg', 1, '2022-04-07 11:11:01', '2022-04-07 11:11:01'),
(5, 1, 'Fatih AVCI', 'Mühendis', 'Fatih AVCI Açıklama TR', 1, 'images/lhsIYARYK7yEYfa8dOiqUjOuKCXyCxnmmg3iednT.jpg', 1, '2022-04-07 11:11:39', '2022-04-07 11:11:39'),
(6, 10, 'Team1', 'Pozition 1', 'desc 1', 0, 'images/pFiOoz6y6Uwfqw7W9vyJX1c9KubtE8o50jl1ongd.jpg', 1, '2022-04-07 11:13:59', '2022-04-07 11:13:59'),
(7, 10, 'Team2', 'Pozition 2', 'desc2', 1, 'images/ITRrBnUiGCBkW6JX8Ib9hTRRF26dcNjYAdfM610o.jpg', 1, '2022-04-07 11:14:23', '2022-04-07 11:14:23');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
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
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fatih', 'fatih@test.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL),
(2, 'Fatih', 'admin@test.com', NULL, '$2y$10$QFwJ7GEC5ISi5JVAnghbOe/c/gWx7RejRJmPzLtg1L7tgsKiY6sOy', NULL, NULL, NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `blogand_categories`
--
ALTER TABLE `blogand_categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Tablo için indeksler `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `language_contents`
--
ALTER TABLE `language_contents`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `newlestters`
--
ALTER TABLE `newlestters`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Tablo için indeksler `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Tablo için indeksler `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `referens`
--
ALTER TABLE `referens`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `setting_texts`
--
ALTER TABLE `setting_texts`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `slider_contents`
--
ALTER TABLE `slider_contents`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `takims`
--
ALTER TABLE `takims`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `blogand_categories`
--
ALTER TABLE `blogand_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Tablo için AUTO_INCREMENT değeri `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `language_contents`
--
ALTER TABLE `language_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Tablo için AUTO_INCREMENT değeri `newlestters`
--
ALTER TABLE `newlestters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `referens`
--
ALTER TABLE `referens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `setting_texts`
--
ALTER TABLE `setting_texts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `slider_contents`
--
ALTER TABLE `slider_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Tablo için AUTO_INCREMENT değeri `takims`
--
ALTER TABLE `takims`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
