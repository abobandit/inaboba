-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 04, 2024 at 11:33 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inaboba`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Общий альбом',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Новый альбом', 4, '2024-05-30 22:42:23', '2024-05-30 22:42:23'),
(2, 'Новый альбом', 4, '2024-05-30 22:48:02', '2024-05-30 22:48:02'),
(3, 'Новый альбом', 4, '2024-05-30 22:49:33', '2024-05-30 22:49:33'),
(4, 'Новый альбом', 4, '2024-05-30 22:49:58', '2024-05-30 22:49:58'),
(5, 'Новый альбом', 4, '2024-05-30 22:51:46', '2024-05-30 22:51:46'),
(6, 'Новый альбом', 4, '2024-05-30 22:51:49', '2024-05-30 22:51:49'),
(7, 'Новый альбом', 4, '2024-05-30 22:53:55', '2024-05-30 22:53:55'),
(8, 'Новый альбом', 4, '2024-05-30 22:53:59', '2024-05-30 22:53:59'),
(9, 'Новый альбом', 4, '2024-05-30 23:25:24', '2024-05-30 23:25:24'),
(10, 'Новый альбом', 4, '2024-05-30 23:25:25', '2024-05-30 23:25:25'),
(11, 'Новый альбом', 4, '2024-05-30 23:25:27', '2024-05-30 23:25:27'),
(12, 'Новый альбом', 4, '2024-05-31 03:13:28', '2024-05-31 03:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isPrivate` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `title`, `isPrivate`, `created_at`, `updated_at`) VALUES
(1, '', 1, '2023-10-12 11:49:48', '2023-10-12 11:49:48'),
(2, '', 1, '2023-11-22 04:47:23', '2023-11-22 04:47:23'),
(3, '', 1, '2023-11-22 05:00:29', '2023-11-22 05:00:29');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `friend_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','accepted','declined') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'accepted', '2023-12-06 00:29:53', '2023-12-06 01:07:44'),
(2, 2, 4, 'accepted', '2023-12-06 00:30:44', '2023-12-06 01:09:43'),
(3, 2, 1, 'accepted', '2023-12-06 00:30:47', '2023-12-06 01:09:04'),
(4, 2, 4, 'pending', '2023-12-06 01:11:38', '2023-12-06 01:11:38'),
(5, 2, 4, 'pending', '2023-12-06 01:11:43', '2023-12-06 01:11:43'),
(6, 4, 1, 'accepted', '2024-05-10 21:19:06', '2024-05-10 21:19:45'),
(7, 4, 3, 'pending', '2024-05-10 21:19:22', '2024-05-10 21:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `album_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `path`, `title`, `description`, `album_id`, `created_at`, `updated_at`) VALUES
(1, 'test/szvRiMOuFOwgPCx5OOvVXd8SjP03v3p6LQZaZ7gf.png', '123as1', 'description', 4, '2024-05-31 02:51:20', '2024-05-31 02:51:20'),
(2, 'test/wXTn3xDWpUDQPgHcBcEeE5NgaQJOtHxZqmhNla3f.png', '123as1', 'description', 4, '2024-05-31 02:55:57', '2024-05-31 02:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `user_chat_id` bigint UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_chat_id`, `text`, `created_at`, `updated_at`) VALUES
(1, 1, 'САЛАМАЛАКУМ', '2023-10-12 11:50:05', '2023-10-12 11:50:05'),
(2, 1, 'САЛАМАЛАКУМ', '2023-10-12 11:56:20', '2023-10-12 11:56:20'),
(3, 1, 'САЛАМАЛАКУМ', '2023-10-12 11:57:29', '2023-10-12 11:57:29'),
(4, 1, 'САЛАМАЛАКУМ', '2023-10-12 12:01:44', '2023-10-12 12:01:44'),
(5, 1, 'САЛАМАЛАКУМ', '2023-10-12 12:07:21', '2023-10-12 12:07:21'),
(6, 1, 'САЛАМАЛАКУМ', '2023-10-12 12:10:34', '2023-10-12 12:10:34'),
(7, 1, 'САЛАМАЛАКУМ', '2023-10-12 12:12:02', '2023-10-12 12:12:02'),
(8, 1, 'САЛАМАЛАКУМ', '2023-10-12 12:49:14', '2023-10-12 12:49:14'),
(9, 1, 'САЛАМАЛАКУМ', '2023-10-12 12:49:39', '2023-10-12 12:49:39'),
(10, 1, 'САЛАМАЛАКУМ', '2023-10-12 12:50:48', '2023-10-12 12:50:48'),
(11, 1, 'САЛАМАЛАКУМ', '2023-10-12 12:57:00', '2023-10-12 12:57:00'),
(12, 1, 'САЛАМАЛАКУМ', '2023-10-12 13:04:42', '2023-10-12 13:04:42'),
(13, 1, 'САЛАМАЛАКУМ', '2023-10-12 13:07:13', '2023-10-12 13:07:13'),
(14, 1, 'САЛАМАЛАКУМ', '2023-10-12 13:10:17', '2023-10-12 13:10:17'),
(15, 1, 'САЛАМАЛАКУМ', '2023-10-12 13:14:33', '2023-10-12 13:14:33'),
(16, 1, 'САЛАМАЛАКУМ', '2023-10-12 13:23:56', '2023-10-12 13:23:56'),
(17, 1, 'САЛАМАЛАКУМ', '2023-10-12 13:26:19', '2023-10-12 13:26:19'),
(18, 1, 'САЛАМАЛАКУМ', '2023-10-12 13:28:56', '2023-10-12 13:28:56'),
(19, 1, 'САЛАМАЛАКУМ', '2023-10-12 13:35:03', '2023-10-12 13:35:03'),
(20, 1, 'САЛАМАЛАКУМ', '2023-10-12 13:35:32', '2023-10-12 13:35:32'),
(21, 4, 'САЛАМАЛАКУМ1232', '2023-11-22 04:48:43', '2023-11-22 04:48:43'),
(22, 5, 'САЛАМАЛАКУМ12321', '2023-11-22 05:01:09', '2023-11-22 05:01:09'),
(23, 1, 'sdfadfsdfadfa', '2023-12-03 13:35:32', '2023-10-12 13:35:32'),
(24, 5, 'adfsdfsdfsdfs', '2023-12-03 05:01:09', '2023-11-22 05:01:09'),
(25, 5, 'adfsdfsdfsdfs', '2023-12-03 05:01:09', '2023-11-22 05:01:09'),
(26, 2, '<p>dasfasd</p>', '2023-12-05 10:40:44', '2023-12-05 10:40:44'),
(27, 2, '<p>dasfasd</p>', '2023-12-05 10:45:39', '2023-12-05 10:45:39'),
(28, 2, '<p>dasfasd</p>', '2023-12-05 10:45:59', '2023-12-05 10:45:59'),
(29, 2, '<p>dasfasd</p>', '2023-12-05 10:46:07', '2023-12-05 10:46:07'),
(30, 2, '<p>dasfasd</p>', '2023-12-05 10:47:56', '2023-12-05 10:47:56'),
(31, 2, '<p>dvaasd</p>', '2023-12-05 10:49:15', '2023-12-05 10:49:15'),
(32, 2, '<p>asdfas</p>', '2023-12-05 11:02:22', '2023-12-05 11:02:22'),
(33, 2, '<p>asdfas</p>', '2023-12-05 11:02:23', '2023-12-05 11:02:23'),
(34, 2, '<p>dadasda</p>', '2023-12-05 11:42:08', '2023-12-05 11:42:08'),
(35, 2, '<p>dadasdaaeqeaeq</p>', '2023-12-05 11:42:41', '2023-12-05 11:42:41'),
(36, 2, '<p>dadasdaaeqeaeq123</p>', '2023-12-05 11:42:52', '2023-12-05 11:42:52'),
(37, 5, '<p>asdfasda</p>', '2023-12-05 12:02:21', '2023-12-05 12:02:21'),
(38, 5, '<p>asdfasda</p>', '2023-12-05 12:20:02', '2023-12-05 12:20:02'),
(39, 5, '<p>SSIpaosjaODJK`1</p>', '2023-12-05 12:20:54', '2023-12-05 12:20:54'),
(40, 5, '<p>edfada</p>', '2023-12-05 12:26:34', '2023-12-05 12:26:34'),
(41, 5, '<p>adsada</p>', '2023-12-05 12:28:54', '2023-12-05 12:28:54'),
(42, 5, '<p>dsaf</p>', '2023-12-05 12:45:10', '2023-12-05 12:45:10'),
(43, 5, '<p>asda</p>', '2023-12-05 12:51:32', '2023-12-05 12:51:32'),
(44, 5, '<p>asdasdas</p>', '2023-12-05 12:52:34', '2023-12-05 12:52:34'),
(45, 5, '<p>safsdfa</p>', '2023-12-05 12:54:15', '2023-12-05 12:54:15'),
(46, 5, '<p>safsdfa</p>', '2023-12-05 12:55:03', '2023-12-05 12:55:03'),
(47, 5, '<p>safsdfa1231</p>', '2023-12-05 12:55:07', '2023-12-05 12:55:07'),
(48, 5, '<p>iuy987ui</p>', '2023-12-05 12:55:21', '2023-12-05 12:55:21'),
(49, 5, '<p>iuy987ui</p>', '2023-12-05 12:56:31', '2023-12-05 12:56:31'),
(50, 5, '<p>2wrera</p>', '2023-12-05 12:58:25', '2023-12-05 12:58:25'),
(51, 5, '<p>2wrera</p>', '2023-12-05 12:58:37', '2023-12-05 12:58:37'),
(52, 5, '<p>2wrera</p>', '2023-12-05 12:59:27', '2023-12-05 12:59:27'),
(53, 5, '<p>nbhjb </p>', '2023-12-05 12:59:46', '2023-12-05 12:59:46'),
(54, 5, '<p>nbhjb </p>', '2023-12-05 13:00:21', '2023-12-05 13:00:21'),
(55, 5, '<p>hgkjhbkn</p>', '2023-12-05 13:00:42', '2023-12-05 13:00:42'),
(56, 5, '<p>hiluhihjk</p>', '2023-12-05 13:02:21', '2023-12-05 13:02:21'),
(57, 2, '<p>dasdaxxz</p>', '2023-12-05 13:06:31', '2023-12-05 13:06:31'),
(58, 2, '<p>dasdaxxz2131231</p>', '2023-12-05 13:06:36', '2023-12-05 13:06:36'),
(59, 2, '<p>fsfs</p>', '2023-12-05 13:12:53', '2023-12-05 13:12:53'),
(60, 2, '<p>dasdadadca</p>', '2023-12-05 18:00:43', '2023-12-05 18:00:43'),
(61, 2, '<p>dasdadadca123</p>', '2023-12-05 18:00:53', '2023-12-05 18:00:53'),
(62, 2, '<p>fasdfasfas</p>', '2023-12-05 18:02:07', '2023-12-05 18:02:07'),
(63, 2, '<p>asdfasdfsa</p>', '2023-12-05 18:07:46', '2023-12-05 18:07:46'),
(64, 2, '<p>asdfasdfsaa</p>', '2023-12-05 18:08:00', '2023-12-05 18:08:00'),
(65, 2, '<p>check</p>', '2023-12-05 18:08:13', '2023-12-05 18:08:13'),
(66, 2, '<p>check\'</p>', '2023-12-05 18:11:27', '2023-12-05 18:11:27'),
(67, 2, '<p>check\'</p>', '2023-12-05 18:11:27', '2023-12-05 18:11:27'),
(68, 2, '<p>вфывфыв</p>', '2023-12-05 18:17:12', '2023-12-05 18:17:12'),
(69, 2, '<p>вфывфывы</p>', '2023-12-05 18:17:30', '2023-12-05 18:17:30'),
(70, 2, '<p>вфывфывыч</p>', '2023-12-05 18:17:41', '2023-12-05 18:17:41'),
(71, 2, '<p>вфывфывычй</p>', '2023-12-05 18:17:48', '2023-12-05 18:17:48'),
(72, 2, '<p>ыф</p>', '2023-12-05 18:18:32', '2023-12-05 18:18:32'),
(73, 2, '<p>ыффыф</p>', '2023-12-05 18:18:43', '2023-12-05 18:18:43'),
(74, 2, '<p>ыффыффыафыа</p>', '2023-12-05 18:18:52', '2023-12-05 18:18:52'),
(75, 2, '<p>фывфы</p>', '2023-12-05 18:20:15', '2023-12-05 18:20:15'),
(76, 2, '<p>asdad</p>', '2023-12-05 18:21:46', '2023-12-05 18:21:46'),
(77, 2, '<p>uoihjok</p>', '2023-12-05 18:22:38', '2023-12-05 18:22:38'),
(78, 2, '<p>dasdas</p>', '2023-12-05 18:25:05', '2023-12-05 18:25:05'),
(79, 2, '<p>fsdafdsfas</p>', '2023-12-05 18:25:37', '2023-12-05 18:25:37'),
(80, 2, '<p>fsdafdsfass</p>', '2023-12-05 18:25:43', '2023-12-05 18:25:43'),
(81, 2, '<p>asdfasdfasdf</p>', '2023-12-05 18:27:35', '2023-12-05 18:27:35'),
(82, 2, '<p>dfsds</p>', '2023-12-05 18:30:25', '2023-12-05 18:30:25'),
(83, 2, '<p>dfsdsx</p>', '2023-12-05 18:30:29', '2023-12-05 18:30:29'),
(84, 2, '<p>xcvxz</p>', '2023-12-05 18:30:34', '2023-12-05 18:30:34'),
(85, 6, '<p>asdadasd</p>', '2023-12-05 18:32:40', '2023-12-05 18:32:40'),
(86, 6, '<p>asdadsada</p>', '2023-12-05 18:37:27', '2023-12-05 18:37:27'),
(87, 5, '<p>asdasda</p>', '2023-12-05 18:37:31', '2023-12-05 18:37:31'),
(88, 6, '<p>ASDASDA</p>', '2023-12-06 02:38:10', '2023-12-06 02:38:10'),
(89, 2, '<p>ASDASD</p>', '2023-12-06 02:38:22', '2023-12-06 02:38:22'),
(90, 2, '<p>ASDASD21</p>', '2023-12-06 02:38:48', '2023-12-06 02:38:48'),
(91, 5, '<p>123</p>', '2024-01-31 08:12:00', '2024-01-31 08:12:00'),
(92, 6, '<p>sadas</p>', '2024-01-31 08:14:56', '2024-01-31 08:14:56'),
(93, 5, '<p>dsfsd</p>', '2024-01-31 08:15:10', '2024-01-31 08:15:10'),
(94, 4, '<p>cfz</p><p></p>', '2024-02-04 04:07:45', '2024-02-04 04:07:45'),
(95, 6, '<p>asdad</p>', '2024-02-21 07:27:19', '2024-02-21 07:27:19'),
(96, 6, '<p>asdadxzxzx</p>', '2024-02-21 07:27:35', '2024-02-21 07:27:35'),
(97, 6, '<p>asdasd</p>', '2024-05-29 06:27:13', '2024-05-29 06:27:13'),
(98, 4, '<p>dsffa</p>', '2024-05-30 23:43:04', '2024-05-30 23:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_00_00_000000_create_websockets_statistics_entries_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_11_140052_create_trends_table', 1),
(6, '2023_09_07_153742_create_friends_table', 1),
(7, '2023_09_07_161358_create_chats_table', 1),
(8, '2023_09_07_181524_create_user_chats_table', 1),
(9, '2023_09_07_182315_create_posts_table', 1),
(10, '2023_09_07_182316_create_comments_table', 1),
(11, '2023_09_07_183048_create_albums_table', 1),
(12, '2023_09_07_183049_create_medias_table', 1),
(13, '2023_09_07_183606_create_messages_table', 1),
(14, '2023_10_11_142924_create_reposts_table', 1),
(15, '2023_10_11_144056_create_post_media_table', 1),
(16, '2023_10_12_144725_create_failed_jobs_table', 1),
(17, '2023_10_12_144813_create_jobs_table', 1),
(18, '2024_05_30_231305_creat_likes_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(25, 'App\\Models\\User', 3, 'api', '0190385839a34b529ee41b58e2c69f75cb5c02288fac7492dd2d31deeae68899', '[\"*\"]', '2023-11-08 05:10:21', NULL, '2023-11-08 05:09:19', '2023-11-08 05:10:21'),
(46, 'App\\Models\\User', 1, 'api', 'e024f0297ec6e8c56761ad65399d12d6a22a98f4d6319916eabede89b7ee415b', '[\"*\"]', '2023-12-20 07:33:12', NULL, '2023-12-20 06:11:50', '2023-12-20 07:33:12'),
(51, 'App\\Models\\User', 2, 'api', 'acb9c91223aa07f21640529531cec04d78bedf424e2b4aeb8bf01ca654c5c330', '[\"*\"]', '2024-02-21 07:25:48', NULL, '2024-02-21 07:25:17', '2024-02-21 07:25:48'),
(54, 'App\\Models\\User', 4, 'api', '5983f8e26b68d0b29ce2f0aff163df0d7a998dada7ca6cbcaba5cb1992448970', '[\"*\"]', '2024-05-31 03:39:57', NULL, '2024-05-30 19:33:28', '2024-05-31 03:39:57'),
(56, 'App\\Models\\User', 6, 'api', '2f59d1466d96cf3f7bcc688020b19ee162c931b603b34a80bd2fe143ad7ebb41', '[\"*\"]', '2024-05-31 02:59:22', NULL, '2024-05-31 02:50:30', '2024-05-31 02:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `trend_id` bigint UNSIGNED DEFAULT NULL,
  `visibility` enum('public','friend','private') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `content`, `user_id`, `trend_id`, `visibility`, `created_at`, `updated_at`) VALUES
(1, '<p>afdasfasdfas</p>', 2, NULL, 'public', '2023-12-05 18:48:56', '2023-12-05 18:48:56'),
(2, '<p>afdasfasdfas</p>', 2, NULL, 'public', '2023-12-05 18:51:04', '2023-12-05 18:51:04'),
(3, '<p>vbc</p>', 2, NULL, 'public', '2023-12-06 00:20:01', '2023-12-06 00:20:01'),
(4, '<p>asdas</p>', 2, NULL, 'public', '2023-12-06 00:20:42', '2023-12-06 00:20:42'),
(5, '<p>asda</p>', 2, NULL, 'public', '2023-12-06 01:11:51', '2023-12-06 01:11:51'),
(6, '<p>QWEQA</p>', 2, NULL, 'public', '2023-12-06 02:37:22', '2023-12-06 02:37:22'),
(7, '<p>szcfa</p>', 4, NULL, 'public', '2024-05-29 05:49:07', '2024-05-29 05:49:07'),
(8, '<p>szcfa</p>', 4, NULL, 'public', '2024-05-29 05:49:17', '2024-05-29 05:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `post_media`
--

CREATE TABLE `post_media` (
  `id` bigint UNSIGNED NOT NULL,
  `media_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reposts`
--

CREATE TABLE `reposts` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `user_reposted_id` bigint UNSIGNED NOT NULL,
  `visibility` enum('private','public','friends') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trends`
--

CREATE TABLE `trends` (
  `id` bigint UNSIGNED NOT NULL,
  `hashtag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user','moderator') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
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

INSERT INTO `users` (`id`, `first_name`, `last_name`, `login`, `profile_pic`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '123', '152', 'test', NULL, 'user', 'jamal1@jamal.com', NULL, '$2y$10$yPokmhMX6idtmZHaN5kNV.4zFjo9fkfWOvxPujA5h7mNkA6MTEgTW', NULL, '2023-10-12 11:49:16', '2023-12-20 05:49:17'),
(2, 'test', 'test', 'test', NULL, 'user', 'jamal@jamal.com', NULL, '$2y$10$c8UQ3kh7lcNE5UuMsYUmk.39pwLgH2qBaI8VwU5o6rLuJxnTv68/W', NULL, '2023-10-12 11:49:26', '2023-10-12 11:49:26'),
(3, '123', '123', '12', NULL, 'user', 'jamal123@123.com', NULL, '$2y$10$WUvdVYtOnFKzpSwql57oHej4t7QNEKM/mz6V1vX7emWbhRkpLmJpC', NULL, '2023-11-08 05:08:55', '2023-11-08 05:08:55'),
(4, 'test', 'test', 'test', NULL, 'user', 'jamal123@jamal.com', NULL, '$2y$10$cM2gD06wNSqxARp4fLqt8ec0Mi0V0Q4hXLoql3eA8tSKmmSPLT2Ky', NULL, '2023-11-22 04:47:03', '2023-11-22 04:47:03'),
(5, 'jamal', 'jamal', 'jamal', NULL, 'user', 'jamal123123@jamal.com', NULL, '$2y$10$8X3ClGuoMd75YeeXKTPMRel26aJfwqLrsh/QbHPq.uni.cXmSBmw6', NULL, '2023-12-20 05:24:57', '2023-12-20 05:24:57'),
(6, 'test', 'test', 'test', NULL, 'user', 'jamalomba@jamal.com', NULL, '$2y$10$Qd/xrZf/Gp8LmKjoizHuju.9aAl9gANjAwIefnTIlpGmfrK5AcS9y', NULL, '2024-05-31 02:38:17', '2024-05-31 02:38:17'),
(7, 'test', 'test', 'test', NULL, 'user', 'jamalomba@jamal.com1', NULL, '$2y$10$orOHdhobfmOy5HmHkzWVEOnkgVFcNF1MySq9QacOQejuCceIWPJ5O', NULL, '2024-05-31 02:42:47', '2024-05-31 02:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `user_chat`
--

CREATE TABLE `user_chat` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `chat_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_chat`
--

INSERT INTO `user_chat` (`id`, `user_id`, `chat_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 2),
(4, 4, 2),
(5, 2, 3),
(6, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int UNSIGNED NOT NULL,
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int NOT NULL,
  `websocket_message_count` int NOT NULL,
  `api_message_count` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albums_user_id_foreign` (`user_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friends_user_id_foreign` (`user_id`),
  ADD KEY `friends_friend_id_foreign` (`friend_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_post_id_foreign` (`post_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_album_id_foreign` (`album_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_chat_id_foreign` (`user_chat_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_trend_id_foreign` (`trend_id`);

--
-- Indexes for table `post_media`
--
ALTER TABLE `post_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_media_media_id_foreign` (`media_id`),
  ADD KEY `post_media_post_id_foreign` (`post_id`);

--
-- Indexes for table `reposts`
--
ALTER TABLE `reposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reposts_post_id_foreign` (`post_id`),
  ADD KEY `reposts_user_reposted_id_foreign` (`user_reposted_id`);

--
-- Indexes for table `trends`
--
ALTER TABLE `trends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_chat`
--
ALTER TABLE `user_chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_chat_user_id_foreign` (`user_id`),
  ADD KEY `user_chat_chat_id_foreign` (`chat_id`);

--
-- Indexes for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `post_media`
--
ALTER TABLE `post_media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reposts`
--
ALTER TABLE `reposts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trends`
--
ALTER TABLE `trends`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_chat`
--
ALTER TABLE `user_chat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_friend_id_foreign` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friends_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_user_chat_id_foreign` FOREIGN KEY (`user_chat_id`) REFERENCES `user_chat` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_trend_id_foreign` FOREIGN KEY (`trend_id`) REFERENCES `trends` (`id`),
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post_media`
--
ALTER TABLE `post_media`
  ADD CONSTRAINT `post_media_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`),
  ADD CONSTRAINT `post_media_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `reposts`
--
ALTER TABLE `reposts`
  ADD CONSTRAINT `reposts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `reposts_user_reposted_id_foreign` FOREIGN KEY (`user_reposted_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_chat`
--
ALTER TABLE `user_chat`
  ADD CONSTRAINT `user_chat_chat_id_foreign` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`id`),
  ADD CONSTRAINT `user_chat_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
