-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2022 at 01:03 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sks_pkm`
--
CREATE DATABASE IF NOT EXISTS `sks_pkm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sks_pkm`;

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'dapat mengakses semua layanan web'),
(2, 'petugas', 'bisa mengakses beberapa layanan web');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 4),
(1, 9),
(2, 5),
(2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'zainulmustofa943@gmail.com', 1, '2021-11-30 22:25:37', 1),
(2, '::1', 'zainulmustofa943@gmail.com', 1, '2021-11-30 22:26:08', 1),
(3, '::1', 'zainulmuhamad84@gmail.com', 2, '2021-11-30 22:30:18', 1),
(4, '::1', 'zainulmuhamad84@gmail.com', 2, '2021-11-30 22:33:46', 1),
(5, '::1', 'zainulmustofa943@gmail.com', 1, '2021-11-30 22:34:16', 1),
(6, '::1', 'zainulmustofa943@gmail.com', 3, '2021-11-30 22:35:49', 1),
(7, '::1', 'zainulmustofa943@gmail.com', 4, '2021-11-30 22:43:28', 1),
(8, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-01 01:09:28', 1),
(9, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-01 05:53:17', 1),
(10, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-01 08:10:48', 1),
(11, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-01 18:02:52', 1),
(12, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-01 22:13:28', 1),
(13, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-02 06:46:28', 1),
(14, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-02 21:03:17', 1),
(15, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-03 01:24:59', 1),
(16, '::1', 'zainulmustofa943@gmail.com', NULL, '2021-12-03 17:53:00', 0),
(17, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-03 17:53:20', 1),
(18, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-03 20:57:01', 1),
(19, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-04 00:35:41', 1),
(20, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-04 10:40:55', 1),
(21, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-05 00:31:16', 1),
(22, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-06 01:30:49', 1),
(23, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-07 23:13:24', 1),
(24, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-16 06:15:23', 1),
(25, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-16 07:25:23', 1),
(26, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-16 07:30:56', 1),
(27, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-17 02:13:17', 1),
(28, '::1', 'zainulmuhamad84@gmail.com', 5, '2021-12-17 02:13:39', 1),
(29, '::1', 'zainulmustofa943@gmail.com', NULL, '2021-12-17 02:15:11', 0),
(30, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-17 02:15:17', 1),
(31, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-17 04:26:10', 1),
(32, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-18 03:00:39', 1),
(33, '::1', 'asa@gkl.com', 6, '2021-12-18 03:06:49', 1),
(34, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-18 03:07:01', 1),
(35, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-19 02:27:21', 1),
(36, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-19 05:08:25', 1),
(37, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-19 23:06:47', 1),
(38, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-20 05:40:34', 1),
(39, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-21 02:27:13', 1),
(40, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-21 06:10:46', 1),
(41, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-22 03:58:02', 1),
(42, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-22 03:58:04', 1),
(43, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-22 08:03:54', 1),
(44, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-23 01:22:54', 1),
(45, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-23 04:16:47', 1),
(46, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-23 04:49:23', 1),
(47, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-23 04:52:46', 1),
(48, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-23 04:53:05', 1),
(49, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-23 04:53:33', 1),
(50, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-23 07:46:26', 1),
(51, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-23 08:55:02', 1),
(52, '::1', 'zainulmuhamad84@gmail.com', 5, '2021-12-23 08:55:25', 1),
(53, '::1', 'mustofa', NULL, '2021-12-23 08:55:33', 0),
(54, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-23 08:55:44', 1),
(55, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-24 00:41:40', 1),
(56, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-24 06:21:53', 1),
(57, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-25 02:56:08', 1),
(58, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-25 05:04:58', 1),
(59, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-26 05:50:49', 1),
(60, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-26 20:21:57', 1),
(61, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-26 20:23:13', 1),
(62, '::1', 'mustofa', NULL, '2021-12-28 06:30:09', 0),
(63, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-28 06:30:14', 1),
(64, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-29 08:43:17', 1),
(65, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-29 23:59:46', 1),
(66, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-30 05:11:38', 1),
(67, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-30 09:48:20', 1),
(68, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-30 09:51:28', 1),
(69, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-30 09:57:49', 1),
(70, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-30 21:20:00', 1),
(71, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-31 06:15:37', 1),
(72, '::1', 'mustofa', NULL, '2022-01-01 04:20:11', 0),
(73, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-01 04:21:07', 1),
(74, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-01 07:01:19', 1),
(75, '::1', 'zainulmuhamad84@gmail.com', 5, '2022-01-01 08:08:24', 1),
(76, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-01 08:19:07', 1),
(77, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-01 21:12:21', 1),
(78, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-02 00:42:13', 1),
(79, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-02 19:07:41', 1),
(80, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-03 05:45:48', 1),
(81, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-04 07:43:45', 1),
(82, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-05 06:05:20', 1),
(83, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-11 07:24:10', 1),
(84, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-11 21:06:41', 1),
(85, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-12 01:31:19', 1),
(86, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-12 08:46:51', 1),
(87, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-13 00:56:58', 1),
(88, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-13 05:16:15', 1),
(89, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-15 05:40:37', 1),
(90, '::1', 'skspuskesmas@gmial.com', 9, '2022-01-15 06:00:51', 1),
(91, '::1', 'skspuskesmas@gmial.com', 9, '2022-01-15 19:39:05', 1),
(92, '::1', 'skspuskesmas@gmial.com', 9, '2022-01-16 10:00:30', 1),
(93, '::1', 'skspuskesmas@gmial.com', 9, '2022-01-17 21:48:55', 1),
(94, '::1', 'skspuskesmas@gmial.com', 9, '2022-01-18 06:05:02', 1),
(95, '::1', 'skspuskesmas@gmial.com', 9, '2022-01-19 17:40:04', 1),
(96, '::1', 'skspuskesmas@gmial.com', 9, '2022-01-24 19:55:37', 1),
(97, '::1', 'skspuskesmas@gmial.com', 9, '2022-01-30 11:59:52', 1),
(98, '::1', 'skspuskesmas@gmial.com', 9, '2022-02-02 16:56:21', 1),
(99, '::1', 'skspuskesmas@gmial.com', 9, '2022-02-03 12:19:15', 1),
(100, '::1', 'skspuskesmas@gmial.com', 9, '2022-02-03 16:33:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-user', 'manage all user'),
(2, 'manage-profile', 'all user can access');

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kapus`
--

CREATE TABLE `kapus` (
  `id_kapus` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `nama_kapus` varchar(255) NOT NULL,
  `nip_kapus` bigint(20) NOT NULL,
  `publik_key` varchar(255) NOT NULL,
  `private_key` varchar(255) NOT NULL,
  `hash_publik_key` varchar(255) NOT NULL,
  `hash_private_key` varchar(255) NOT NULL,
  `active` int(2) NOT NULL,
  `menjabat` int(2) DEFAULT NULL,
  `tanggal_dibuat` date DEFAULT NULL,
  `tanggal_diubah` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kapus`
--

INSERT INTO `kapus` (`id_kapus`, `slug`, `nama_kapus`, `nip_kapus`, `publik_key`, `private_key`, `hash_publik_key`, `hash_private_key`, `active`, `menjabat`, `tanggal_dibuat`, `tanggal_diubah`) VALUES
(1, '198203102009011011-dr.-DENY-SETIYAWAN', 'dr. DENY SETIYAWAN', 198203102009011011, '109.89147', 'vO58GRpTpPiWdWNzhHclfJXM0o5Fe/ZeWkuNSExqWlQjFCXSB6p7x4a3Ydfd19+VRtYijXwYKQhD4TWgseY/SNeinLCwSHYjYh0Zn9ppaLYzfz4Fu0wKE3nA1A==', '28b98d7a02dd9d0fe69654443b44fc94', 'eb1e2b7691d31d176d6e5b40556e7a3a', 1, 1, '2021-12-05', '2022-01-15'),
(44, '198203102009008018-ninik-munawati-str-keb-mkes', 'NINIK MUNAWATI, S.Tr. Keb., M.Kes', 198203102009008018, '347.71189', 'DoapcfSUUtO4lR5UZgDYqB2Y8873ynKxF+TDb7zQDJTQ5Z6aAQLQ4YBsYQ3yX66LCsJGv4BZVnGfYb91xyI3QHc181bl+8+SRn1xEPJLgYkYXx5eDjKkdkVAHQ==', 'd1c3416b8467b8c864b7521a66bf99b1', 'cc936d39d38aa108153ffe97704e8784', 1, 0, '2022-01-15', '2022-01-15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1638332223, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` bigint(20) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `nik_pasien` bigint(20) DEFAULT NULL,
  `nip_pasien` bigint(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` bigint(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `publik_key` varchar(255) DEFAULT NULL,
  `private_key` varchar(255) DEFAULT NULL,
  `qr_code` varchar(50) NOT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `foto_kk` varchar(255) DEFAULT NULL,
  `tanggal_dibuat` date DEFAULT NULL,
  `tanggal_diubah` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `slug`, `nik_pasien`, `nip_pasien`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `no_hp`, `email`, `publik_key`, `private_key`, `qr_code`, `foto_ktp`, `foto_kk`, `tanggal_dibuat`, `tanggal_diubah`) VALUES
(42, 'Siska', '1234123412341234-siska', 1234123412341234, 12736187637812563, '1997-05-13', 'Perempuan', 'gogor', 54672354567, 'jensyn.ryuu@fineoak.org', '293.65311', '5/lsXsmlYe/GFbuirg/9yTw/CjHTf174Fl2Ww6Jk44w5e4lp6U54XC0pt2D1353XFQIt9QplC4gd+bkh/8rePfOzRQozUemWIAgBimKLLIaujc2kI4L5LM91NA==', 'rM9Yc2Nn6Lzal2j7z5HsFc8D3NKhPyB9.png', 'default-ktp.png', 'default-kk.png', '2021-10-21', '2022-01-02'),
(64, 'saman', '2344561234561234-saman', 2344561234561234, 12736187637812563, '1980-08-15', 'Laki-laki', 'gresik', NULL, NULL, '151.77057', 'GhfmcXPGj4pMxH1VPm/d4LPLtW3O+3NGvzjRuXCyXifWSd7tqyzTxYtZq7L0Pa8FoWELTpz5XRgJ+cLf0ugMBopgEqXkFuwCBL9WLmtNS6ioGKW1TX1lP6gdkA==', 'gnUB3dGDAdXBQSdazeDMB5vpx6prnmfV.png', 'default-ktp.png', 'default-kk.png', '2021-12-03', '2022-01-02'),
(70, 'Muhamad Zainul', '3516170980980981-muhamad-zainul', 3516170980980981, 12736187637812563, '1999-08-09', 'Laki-laki', 'Dsn. Brayu wetan, 03/05, Brayublandong, Dawarblandong', 1235431235, 'asa@gkl.com', '251.133907', '7Me0ECguimoUwWyDDG4NJxj3Oy8tRADJ/G3JC6HdWXjxeIJqjbY3ReKS6VY8a7nvE1GHDxQWSjhCOK7pEwQthAyuLysZKmyZrGgU/dacac9AxKJljsLzJc/Y9tA=', 'iWlvtIUclqBxr7yx6KcEai1oh7qo965C.png', 'KTP - 1639922035_7b64e90dab229500b0ad.png', 'KK - 1639922035_7b64e90dab229500b0ad.png', '2021-12-19', '2022-01-02'),
(72, 'korin', '872634756421334-korin', 872634756421334, 12736187637812563, '2002-09-10', 'Perempuan', 'Gersik', NULL, NULL, '373.82933', 'OCCzfj03MCHHVUnFXDVMg/QiyHDK80p4Q9bMm+EhaqyGrXegiP2SgXJTmhCpC55u0W5E4XYgzVtGnXv+OjOUFLprdXJjPQ21AwpphgyB9Bv614QyE6YDCg2l9g==', 'c1H5qKyFBMzHsiNCXIETr5ktxrg1xh0Q.png', 'default-ktp.png', 'default-kk.png', '2021-12-20', '2022-01-02'),
(76, 'karisma', '7653289429835482-karisma', 7653289429835482, 12736187637812563, '2000-02-19', 'Perempuan', 'Gersik', NULL, NULL, '367.86747', 'ZpVb+zm6lpEsMO7LnWfnICbhv5odTNJT1O6aqUWLkHqobj9Q2byvtY9s+qiETs8a1CJQn3HKjyU2odVTwSnYbnqkelUsCMDZxM2TEkbGMVHIMb1yiyL/Hqic0A==', 'eS9I6J39leYAXB5rVousJLo6OU0DKzpQ.png', 'default-ktp.png', 'default-kk.png', '2021-12-21', '2022-01-02'),
(77, 'muslimin', '3516170908990002-muslimin', 3516170908990002, 12736187637812563, '1999-08-09', 'Laki-laki', 'Lamongan', NULL, NULL, '277.99899', 'efqG4jM55qeu7K/uGT6Wc/afTCthhd95eXvMT2ny/XsW57pW1CWljtHbJURVfQDsJO2Fh1AohM3vHyZtCacVh0jLC3709cDMVmJfnbvUdpUQL//679vNUJDgyQ==', 'hCPhJguibBtlnVCC1m0BVtKlUwuarsL8.png', 'default-ktp.png', 'default-kk.png', '2021-12-26', '2022-01-02'),
(79, 'Khairi Ramadhan', '678324562345322-khairi-ramadhan', 678324562345322, 12736187637812563, '1998-12-12', 'Laki-laki', 'Madura', 234134214124, 'khairi@gmail.com', '127.98767', 'V99O8QON7nRNChage7e+ueCViqyC7eeUAqRkgpJr0YjSqfTK3sRCBHIwN300KQlvKhtKiNKaE+JbJ0vo7u65sPfc9XWMlTZfjG2E27AEzXn+LOU4B423hQ8pZwY=', 'AHyxkV1i69YMI2rATICpfkhZG5H34725.png', 'default-ktp.png', 'default-kk.png', '2021-12-28', '2022-01-02'),
(80, 'malikin', '7657623549876231-malikin', 7657623549876231, 12736187637812563, '1989-07-18', 'Laki-laki', 'Lamongan', NULL, NULL, '239.154433', 'gaRSFRPsadpvCo/f0BPhYOzAaEPm2zUUdb1e6GQpzqyb3M3ID+7eMVPhewhtjB9JC94JbagU4/qQuyOuo285YVTlWGO+afiHmw4dGKbA6VGHQVGfKhgmE/2jKng=', 'ic6Du37BtArshMIpr1cjiOSdYqMzQef4.png', 'default-ktp.png', 'default-kk.png', '2021-12-28', '2022-01-02'),
(81, 'mustakim', '761283012536123-mustakim', 761283012536123, 12736187637812563, '1978-08-19', 'Laki-laki', 'mojokerto', NULL, NULL, '127.82919', 'TI9J3LEhv4fwaKzs9BfQveguWngHbBBOd4aQKeXn7cG2W2JNcncVpqC8mpAda3c3f/fDjVj6hgzSJVNsvCo+bEFrdpiWtfd5ZB8rmw8uTdiZFmdGF+e4zQh8CA==', '2NKWoywPqLelBynlxPR7GZ85iwdYMlRx.png', 'default-ktp.png', 'default-kk.png', '2021-12-28', '2022-01-02'),
(82, 'salimin', '645367218613123-salimin', 645367218613123, 12736187637812563, '1998-09-17', 'Laki-laki', 'Madura', 98203748923, 'jasghd@gmail.com', '293.87953', '2ueCnh11qQexmrrvQXfBTee5WvBc7EfNZdkXUXF76ZQc/JeBIuEo4QVwkBrQk0G4VYYflmg+0GMivjB5k764ptqqHPNc/8JFHUX+R8o7avkTD4DoQq0RehYrwQ==', '9PNQRbckUg2SlVodAtYVYRHx7GaicJi7.png', 'default-ktp.png', 'default-kk.png', '2021-12-29', '2022-01-02'),
(83, 'malumah', '761523418723123123-malumah', 761523418723123123, 12736187637812563, '1998-08-19', 'Perempuan', 'Madura', NULL, NULL, '137.41707', 'UNCjTGFEPeBwEDewdfElaUUgQ1o0fqk2LmK3AaML8QAS9gEQkP2Rn0hqtLRGrpHkjKCdWVneP2jXZgx1Z/+buqR/vVdCmwW+QzMomUQksdRQuXRCYiSucTMtmg==', 'ZT44q2uE4huk8Ebv3y5XrIprhe7Ot5wW.png', 'default-ktp.png', 'default-kk.png', '2021-12-29', '2022-01-02'),
(84, 'fathullah', '312375731986235123-fathullah', 312375731986235123, 12736187637812563, '1998-07-19', 'Laki-laki', 'Dsn. Wotgaru, 03/05, Pucuk, Dawarblandong', NULL, NULL, '233.46513', 'VfqzClKBfMK2WlipwbN1hg5j3cPEtZm5Rk5HQqDL9C6Y5bKIFvStVtEBqrcmNLjJEuWxg/o8Kb7Tvgbc+JoBvLUHjCrqQU8yMagwRW9789QEsuZ7JroCY/E37Q==', '', 'default-ktp.png', 'default-kk.png', '2022-01-01', '2022-01-02'),
(85, 'Muhamad Zainul Mustofa', '3516170308990002-muhamad-zainul-mustofa', 3516170308990002, NULL, '1999-05-05', 'Laki-laki', 'Dsn. Brayu wetan, 03/05, Brayublandong, Dawarblandong', NULL, NULL, '113.96119', 'X9tAgkBe+Bi5oZ2dNmT76ULVXrYZyDyaz5ZoX56GgttZvomviMcFc93d7pvVA7j60Lf8iG2G9E6GH/2zL6IheoypL7Y59iNND8g76BwSwpBJFpO+rqPwoPW9GQ==', '', 'default-ktp.png', 'default-kk.png', '2022-01-05', '2022-01-05'),
(86, 'kairun', '3215637812636512-kairun', 3215637812636512, NULL, '1999-08-09', 'Laki-laki', 'Lamongan', NULL, NULL, '397.67519', 'NMUPxbaQQotJ7375Z/B9ZdqUsqaWPlSoijslwclxnJ5EkcgQ4SmXRquVoSphGZe39M9U9iZWU0WkEXYWO7ooh/xJhzbe8F4dFWnVJpXNxco+x9EgyksOhgtOYg==', '', 'default-ktp.png', 'default-kk.png', '2022-01-05', '2022-01-05'),
(87, 'kasji', '7851256381253712-kasji', 7851256381253712, NULL, '1987-08-17', 'Laki-laki', 'Dsn. Wotgaru, 03/05, Pucuk, Dawarblandong', NULL, NULL, '139.37127', 'A9KyDt9/g3qEyI6thCoFYwX/OvlNaVVbCT46ibruzgBoipJoYU5icCF4EPLz3B5sDwgKFw9l8GEMSnKurAu+Y6MEKVGrjXgEY0VfhaWRv2PDihdDRHWs+oFz5w==', '', 'default-ktp.png', 'default-kk.png', '2022-01-11', '2022-01-11'),
(88, 'sapri', '7862781638135156-sapri', 7862781638135156, NULL, '1988-08-08', 'Laki-laki', 'Dsn. Wotgaru, 03/05, Pucuk, Dawarblandong', NULL, NULL, '239.124261', 'JPp1pRs9ZjS5t1TTWckp5F7lixAPhqOTvFzl20LiWF1ZARDwxRoFdZRRC6+RU612XNyVB0kIfw9ONiVX8o15Aho/e3wv1ucsUExtc7t4vKFmO56F3RMQ0uDGu8E=', '', 'default-ktp.png', 'default-kk.png', '2022-01-11', '2022-01-11'),
(89, 'parman', '7612853817635712-parman', 7612853817635712, NULL, '1970-06-30', 'Laki-laki', 'Dsn. Wotgaru, 03/05, Pucuk, Dawarblandong', NULL, NULL, '193.128759', 'TD/Cf24fD3gdKugdT/MygkP7LzTkakKowejeMAOe2mjm55PsL8WFA/VxrHUPxLDoWND+R5/VpW2d+3SOMnjPFfy78n4brBmSO/dfoFrffKa/DMbWljglipGZWQ0=', '', 'default-ktp.png', 'default-kk.png', '2022-01-13', '2022-01-13'),
(91, 'Anya Geraldine', '3223432424241321-anya-geraldine', 3223432424241321, NULL, '1999-11-21', 'Perempuan', 'jakarta', NULL, NULL, '359.121411', 'CvGKqGP0rarxp2VfKgRROOV+IbB3QLNKAe4fOJG8V/qTE5l/9MoFnIILhFHXSW6kGTZbZ85baTPbnPXRDz8trOvvaR/8TyOAmwLJvyAZ0U/RytbuvZWpxgiILnw=', '', 'default-ktp.png', 'default-kk.png', '2022-01-15', '2022-01-15'),
(92, 'faiq anugerah', '1276367812937897-faiq-anugerah', 1276367812937897, NULL, '1998-08-19', 'Laki-laki', 'dsn. kesek, desa labeng', NULL, NULL, '367.42869', 'RT56H+Ta4XFpJFwtYKSAxhqYiwOIpdA274Pc/mLVsBw5EahELBgR2oYEccMKti5y56Sq5Ggogs3Le5RUFMTkFd4GO5lzpnNt9aSKWDF8zNKLpAot7kLOidMxvA==', '', 'default-ktp.png', 'default-kk.png', '2022-01-15', '2022-01-15'),
(93, 'fatimah', '7856237849186237-fatimah', 7856237849186237, NULL, '1997-08-19', 'Perempuan', 'Dsn. Wotgaru, 03/05, Pucuk, Dawarblandong', NULL, NULL, '269.136061', 'ncqt2iXhsI9GCnNM6Yw0S1y6pByR32OkXoLl8AwYupmkP8KPvT1RUOvTHsbRrkEwfkteMQnqnDRTBiYhVauYDI0T8Mu2N9ss10HuUjPCp+2rB0ezydE4t4YgZ+E=', '', 'default-ktp.png', 'default-kk.png', '2022-01-15', '2022-01-15'),
(94, 'sarpiah', '1238681523123123-sarpiah', 1238681523123123, NULL, '1979-08-10', 'Perempuan', 'Dsn. Brayu wetan, 03/05, Brayublandong, Dawarblandong', NULL, NULL, '149.61823', 'CDoZvQ8QsJFSrM43fiUHRYYlH/2213dXOruDPvlJvY1iMZkQqLp4oArvGnE7XrkxEr6AWm4s0Mcd9mwaEac2bfSCTPNFOjhGBXVXazW+wKI0EVBeXQaIpU5j1A==', '', 'default-ktp.png', 'default-kk.png', '2022-01-15', '2022-01-15'),
(95, 'farul amain', '76237840234-farul-amain', 76237840234, NULL, '1999-09-10', 'Laki-laki', 'Dsn. Wotgaru, 03/05, Pucuk, Dawarblandong', 89179263781, 'asa@gkl.com', '239.71273', 'BxKAvga2HIll3VsERmmYZflGbnIBolsozYNf2iFeiw2Hq+mI3Mm+zwBnJa35p9/+283jKfbBjUpQrrDhuFhJ0On5ka003MMXCSRYtj8b3BLLlXsv3jnVOUTb8A==', '', 'default-ktp.png', 'default-kk.png', '2022-01-15', '2022-01-15'),
(96, 'sholeh', '1782685318293701-sholeh', 1782685318293701, NULL, '1987-07-10', 'Laki-laki', 'Dsn. Brayu wetan, 03/05, Brayublandong, Dawarblandong', NULL, NULL, '367.150463', '0diI+YYUEF/B2oryz+Q2UwaMg+3x0/GPjOFMVOKIzo5xo2XpEoR4uTLZ1iXvBIS9Pyez7/tmgPZQETfBkI5B/FkH4BixJkkOen02NkQQE8ocnhTA8I+S0ZhjiLE=', '', 'default-ktp.png', 'default-kk.png', '2022-01-15', '2022-01-15'),
(97, 'kasiman', '1234567615243619-kasiman', 1234567615243619, NULL, '1987-10-28', 'Laki-laki', 'Dsn. Wotgaru, 03/05, Pucuk, Dawarblandong', NULL, NULL, '257.147431', 'u6b+Ia1LK7NID7SPoo5YUfOYGKA/2VvA7jVhZBVu8yJr6FTP8G7bj0p+dC6SLW/EWiPe31ZzXeuh62blGlKKo3XTSZL12GwjvQofLPCUCPo7wDnCBdNU8OmG6HA=', '', 'default-ktp.png', 'default-kk.png', '2022-01-15', '2022-01-15'),
(98, 'sofian', '91872698712376548-sofian', 91872698712376548, NULL, '1988-07-19', 'Laki-laki', 'Dsn. Brayu wetan, 03/05, Brayublandong, Dawarblandong', 91871872633123, 'jkqhwej@askl.co', '269.102029', 'e+NDwTme2cX5H1AsFAJ5VdbusKlPVBciCUFmtTJje7iWjfEIzPUXCylJR8wWuDZrBJYE3TgYuTqD71wwXL54oXItgT3JJFaDoJWbCds0/wEneC1ctUm7qcyEpUg=', '', 'default-ktp.png', 'default-kk.png', '2022-01-15', '2022-01-15'),
(99, 'nila', '0917827537812381-nila', 917827537812381, NULL, '1999-06-19', 'Perempuan', 'Dsn. Wotgaru, 03/05, Pucuk, Dawarblandong', NULL, NULL, '337.120983', '+J2xkMsnIvroUv4sO2yGXKCyrhruUN+v+gZm79esuSVVCIXmJVfBGllejWyndnm0j1eb+5d7xacDergRdmi5zJbpxUyI0nNZPyJ8gLWnQn+Kv/TXx2t7QyUt64yg', '', 'default-ktp.png', 'default-kk.png', '2022-01-15', '2022-01-15'),
(100, 'fita', '1197256378162312-fita', 1197256378162312, NULL, '1998-04-25', 'Perempuan', 'Dsn. Wotgaru, 03/05, Pucuk, Dawarblandong', NULL, NULL, '137.131513', 'l99ZvGNnzQMTQzxBCrECK796j4zCCKFii+e+bKI+yvxjr6kgRcSqrKB+2W58ZtDYFvQ2LiTxitUuWgzg1S+82+9UB3XGYaTI9mBGEtvNpm4VPyQ3NttTrit7awY=', '', 'default-ktp.png', 'default-kk.png', '2022-01-15', '2022-01-15'),
(101, 'jaseni', '0198263817231231-jaseni', 198263817231231, NULL, '1987-07-19', 'Perempuan', 'Dsn. Brayu wetan, 03/05, Brayublandong, Dawarblandong', NULL, NULL, '149.73147', 'ccVqSbi0eK7/B5jriCJYl3TCsC9mUmgPmUyYS+IZUHZYRDW/SFisR+H+XNkE+OqNdcsvPtzekC6EFbBSX8m/zPFSZEGajUi9sFBoctghT/i0fuH/fgeqJ3Z/qw==', '', 'default-ktp.png', 'default-kk.png', '2022-01-15', '2022-01-15'),
(102, 'pernah', '3516718238900012-pernah', 3516718238900012, NULL, '1987-08-19', 'Perempuan', 'Dsn. Brayu wetan, 03/05, Brayublandong, Dawarblandong', NULL, NULL, '257.154433', 'ytPuH8ThjPUHvOUeb24GzeTTzE1M4qQsFfLT25SmlzGJhFiuqbPYoqW9GI9l+nsQ1Zzk6QTbCUCWkgFkrISO1vvULmCFyUrATd2wtBJ/RLq8CVwEYpk95qEftpI=', '', 'default-ktp.png', 'default-kk.png', '2022-01-15', '2022-01-15'),
(103, 'hanafi', '5615243816826530-hanafi', 5615243816826530, NULL, '1998-10-28', 'Laki-laki', 'Madura', NULL, NULL, '317.148987', 'TAHz1jwC7cupOZKSWWekwVJpOeCtiUbw3m4O+zRT3pc43EIjHnL+vasbOW1EJ0AbSfg2KcKcSXZ1Nb+Yp9gwW59LIA3KTRzNWxXXniF1HARgwWPDtnfsIqW/p64=', '', 'default-ktp.png', 'default-kk.png', '2022-01-16', '2022-01-16'),
(104, 'rozy', '9786378411826378-rozy', 9786378411826378, NULL, '1997-11-29', 'Laki-laki', 'pucuk indah', NULL, NULL, '151.62449', 'XFlougBF4XMiIhW0tlTeIFUQ8TlM4+FEVa9OIRJi7yYdWQTZNPFExZVPITQ8JJG5Chce23ABWsyk0Fb7boXTBO+eX4lPlEoB7MzHVwywvHtPDBLmgTUS7cB0XQ==', '', 'default-ktp.png', 'default-kk.png', '2022-01-16', '2022-01-16'),
(105, 'pipin', '7528381628318231-pipin', 7528381628318231, NULL, '1994-08-12', 'Perempuan', 'Dsn. Wotgaru, 03/05, Pucuk, Dawarblandong', NULL, NULL, '239.37627', 'qZktlZXz0o5q4tDEy4ku4vpBmV7balJJ5VmXblBfjfu2l1+9Lp4+qqTk9/v2QimvmM/aGkgDkKBGxUyKXYCAFgrdkN9RwGEx6h/hWf/uzgjVTQvjqoWwOD8Rjg==', '', 'default-ktp.png', 'default-kk.png', '2022-01-16', '2022-01-16'),
(106, 'tarman', '7281736185230175-tarman', 7281736185230175, NULL, '1997-12-12', 'Laki-laki', 'Dsn. Wotgaru, 03/05, Pucuk, Dawarblandong', NULL, NULL, '223.96571', 'ChOmPAI4zb/a7vE7rIi7aA3iVWyFOGmnyClnPSWEAbTKDk2ddGqseoq5phRDl8ZynFlFV/cNQUzZPsQ6CX1GZC8E44TbxVhJMcW/z8YehIIXd7211KY0Lcgoyg==', '', 'default-ktp.png', 'default-kk.png', '2022-01-16', '2022-01-16'),
(107, 'sarip', '7125636817263416-sarip', 7125636817263416, NULL, '2000-08-17', 'Laki-laki', 'Dsn. Wotgaru, 03/05, Pucuk, Dawarblandong', NULL, NULL, '271.84109', 'BDSVzkYpOPUpNWyL/jt1DzwXz0/kaGRnv2PGeHf/yZu98VT74TzdKXU2ZrX1KxYVST5SngQpU8Dhl+D4HGTMtsoZjao6i6U1cnu3F1nAtXXe1IMNDV2f1PAueg==', '', 'default-ktp.png', 'default-kk.png', '2022-01-16', '2022-01-16'),
(108, 'tasiman', '1213787612312312-tasiman', 1213787612312312, NULL, '1999-08-12', 'Laki-laki', 'Dsn. Brayu wetan, 03/05, Brayublandong, Dawarblandong', NULL, NULL, '227.131513', 'JOAimyTrEN6v0VxuEshAknniSvyxqXC5deTmWFaYiyWYD+d3GjPTtUbb4eOg89h8kXxba+gMKRO7GKMS8BfyGk2QEsz8c9OhmhX8FcAZbaJOghC1sISVJ6XLoxM=', '', 'default-ktp.png', 'default-kk.png', '2022-01-16', '2022-01-16'),
(109, 'niko', '9812875356471562-niko', 9812875356471562, NULL, '1989-08-19', 'Laki-laki', 'Dsn. Wotgaru, 03/05, Pucuk, Dawarblandong', NULL, NULL, '277.67841', 'PDpbOItQ+0nZWrYXKMFnKJvwrKr6jJ5tRgd9rMUMLXiJB4NARzg+jLW52ox8TY93dPnxxtQMGyhgOT2DCwHeGXfD8BGa3IM7YSjOTW0LlC2K2GqSe8Tu3pOxfg==', '', 'default-ktp.png', 'default-kk.png', '2022-01-17', '2022-01-17'),
(110, 'anjar', '3516179008870002-anjar', 3516179008870002, NULL, '1987-08-29', 'Perempuan', 'Dsn. Brayu wetan, 03/05, Brayublandong, Dawarblandong', NULL, NULL, '137.121411', 'pkS2HHpgUY6fY6ffl0HVdDdJucmtpHEFuQL8jyOoYoOiPFl0E0HZO7+jCiEfixx8q9DimxExDm4fNEms1aUDOpdS5Uo7OR+1iXTl8hCP4hh9GaxbIPBOHFH/nlQ=', '', 'default-ktp.png', 'default-kk.png', '2022-01-18', '2022-01-18'),
(111, 'ARIPIN', '3516170505990005-aripin', 3516170505990005, NULL, '1999-05-05', 'Laki-laki', 'Dsn. Wotgaru, 03/05, Pucuk, Dawarblandong', NULL, NULL, '349.82249', 'sYQHeeTAeSxBMPAJx0rfL0D8Qm+ffTw4vaAfIuc4lQGjFrZNHq3/z2HV3z+5WsmGF8hrXFzuNLJpYVnRD53ocxDuaoAJUmNaETpK+noQqzSsrD1e+J5+lw2tuQ==', '', 'default-ktp.png', 'default-kk.png', '2022-01-18', '2022-01-18'),
(112, 'helmi', '8965291853812312-helmi', 8965291853812312, NULL, '1987-08-09', 'Laki-laki', 'Dsn. Brayu wetan, 03/05, Brayublandong, Dawarblandong', NULL, NULL, '379.76693', 'Zk8NSIL8KMxoYBHTWkc8s4EozBge8I69MuCZ3+38PVaHHn10PP41rJSoj0IjthbbINXhXMfh5uCewHsfPIQNOWeJQrACpGeI8i+G84HROHnma1rhj6buXRjQMg==', '', 'default-ktp.png', 'default-kk.png', '2022-02-03', '2022-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `satgas`
--

CREATE TABLE `satgas` (
  `id_satgas` bigint(100) NOT NULL,
  `nip_petugas` bigint(100) DEFAULT NULL,
  `nik_petugas` bigint(100) NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` bigint(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `tanggal_dibuat` date DEFAULT NULL,
  `tanggal_diubah` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satgas`
--

INSERT INTO `satgas` (`id_satgas`, `nip_petugas`, `nik_petugas`, `nama_petugas`, `slug`, `jenis_kelamin`, `alamat`, `no_hp`, `email`, `foto_profil`, `tanggal_dibuat`, `tanggal_diubah`) VALUES
(2, 120398120938120398, 1203981239081098, 'Tyan Sah', '1203981239081098-tyan-sah', 'Laki-laki', 'gresik', 9831234123, 'gakun7020@gmail.com', '1634396696_9ab4ea3a2ffbf61cd118.jpg', '2021-10-15', '2021-10-16'),
(3, 12341234124114, 12341234123412124, 'susanti ari', '12341234123412124-susanti-ari', '-- Pilih Jenis Kelamin --', 'mojokerto', 12334523345, 'iluljrdev@gmail.com', '1639729515_cd1536cd6f7912630798.png', '2021-10-21', '2021-12-17'),
(4, 2341243213412432314, 234123423412432134, 'susanti ari', '234123423412432134-susanti-ari', 'Laki-laki', 'mojokerto', 2342312343, 'zainulmuhamad84@gmail.com', NULL, '2021-12-01', '2021-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `surat_izin`
--

CREATE TABLE `surat_izin` (
  `id_suratIzin` int(11) NOT NULL,
  `nomor_surat` bigint(20) NOT NULL,
  `nik_pasien` bigint(20) NOT NULL,
  `nip_kapus` bigint(20) NOT NULL,
  `pangkat` varchar(20) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `hari` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `kepentingan` varchar(255) NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `tgl_diubah` date NOT NULL,
  `tgl_exp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_izin`
--

INSERT INTO `surat_izin` (`id_suratIzin`, `nomor_surat`, `nik_pasien`, `nip_kapus`, `pangkat`, `jabatan`, `hari`, `tanggal`, `kepentingan`, `qr_code`, `tgl_dibuat`, `tgl_diubah`, `tgl_exp`) VALUES
(3, 8, 3516170980980981, 198203102009011011, 'ruang 1', 'Admin', 'Kamis', '2022-01-01', 'izin sakit', 'd7a8c3ec9c9f5c6afef497e110941259.png', '2022-01-02', '2022-01-02', '0000-00-00'),
(4, 2, 761283012536123, 198203102009011011, 'ruang 1', 'Admin', 'Selasa', '2022-01-03', 'izin sakit', 'ba77e7ce5d33ca5a6d67cad4ce4c849f.png', '2022-01-02', '2022-01-02', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `surat_kesehatan`
--

CREATE TABLE `surat_kesehatan` (
  `id_sks` bigint(50) NOT NULL,
  `nomor_surat` varchar(255) DEFAULT NULL,
  `nik_pasien` bigint(20) NOT NULL,
  `nip_kapus` bigint(20) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `tinggi_badan` int(100) NOT NULL,
  `berat_badan` int(100) NOT NULL,
  `suhu_tubuh` varchar(225) NOT NULL,
  `tensi_darah` varchar(225) NOT NULL,
  `nadi` int(11) DEFAULT NULL,
  `respirasi` int(11) DEFAULT NULL,
  `mata_buta` varchar(20) DEFAULT NULL,
  `tubuh_tato` varchar(20) DEFAULT NULL,
  `tubuh_tindik` varchar(255) NOT NULL,
  `kepentingan` varchar(225) NOT NULL,
  `hasil_periksa` varchar(255) NOT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `tanggal_dibuat` date NOT NULL,
  `tanggal_diubah` date NOT NULL,
  `tanggal_exp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_kesehatan`
--

INSERT INTO `surat_kesehatan` (`id_sks`, `nomor_surat`, `nik_pasien`, `nip_kapus`, `slug`, `pekerjaan`, `tinggi_badan`, `berat_badan`, `suhu_tubuh`, `tensi_darah`, `nadi`, `respirasi`, `mata_buta`, `tubuh_tato`, `tubuh_tindik`, `kepentingan`, `hasil_periksa`, `qr_code`, `tanggal_dibuat`, `tanggal_diubah`, `tanggal_exp`) VALUES
(1, '1-2022', 3516170980980981, 198203102009011011, NULL, 'Swasta', 170, 68, '36', '76', 14, 20, 'TIDAK', 'TIDAK', 'TIDAK', 'Melamar pekerjaan', 'SEHAT', '6fa92630d2f74354344e816ba29b7f24.png', '2022-02-03', '2022-02-03', '2022-02-05'),
(2, '2-2022', 3516170308990002, 198203102009011011, NULL, 'Swasta', 179, 45, '36', '110/70', 70, 78, 'TIDAK', 'TIDAK', 'TIDAK', 'Melamar pekerjaan', 'SEHAT', '2b5977a32382f4a02ad3117509052011.png', '2022-02-03', '2022-02-03', '2022-02-05'),
(3, '3-2022', 8965291853812312, 198203102009011011, NULL, 'Swasta', 179, 45, '36', '110/70', 70, 78, 'TIDAK', 'TIDAK', 'TIDAK', 'Melamar pekerjaan', 'SEHAT', 'bbaf0f0098c878a1dc74bc485e1338eb.png', '2022-02-03', '2022-02-03', '2022-02-05'),
(4, '4-2022', 7653289429835482, 198203102009011011, NULL, 'Swasta', 179, 68, '34', '76', 70, 78, 'TIDAK', 'TIDAK', 'TIDAK', 'menikah', 'SEHAT', 'cd670d4b9e7797e59e1f921c13e21515.png', '2022-02-03', '2022-02-03', '2022-02-05'),
(5, '5-2022', 1276367812937897, 198203102009011011, NULL, 'Swasta', 170, 68, '34', '110/70', 70, 20, 'TIDAK', 'TIDAK', 'TIDAK', 'menikah', 'SEHAT', 'ec7df0f5deb0dbfae0e9219ceaf8bb85.png', '2022-02-03', '2022-02-03', '2022-02-05');

-- --------------------------------------------------------

--
-- Table structure for table `surat_rsa`
--

CREATE TABLE `surat_rsa` (
  `id_surat_rsa` bigint(50) NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `nik_pasien` bigint(20) NOT NULL,
  `nip_kapus` bigint(20) NOT NULL,
  `teks_asli` varchar(50) NOT NULL,
  `teks_enkripsi` varchar(300) NOT NULL,
  `hash_enkrip` varchar(255) NOT NULL,
  `kunci_pasien` varchar(500) NOT NULL,
  `panjang_rsaGanda` varchar(20) DEFAULT NULL,
  `panjang_rsa` varchar(20) DEFAULT NULL,
  `waktu_enkripsi` varchar(50) DEFAULT NULL,
  `waktu_dekripsi` varchar(50) DEFAULT NULL,
  `waktu_enkripsi_rsaBiasa` varchar(50) DEFAULT NULL,
  `waktu_dekripsi_rsaBiasa` varchar(50) DEFAULT NULL,
  `tanggal_dibuat` date DEFAULT NULL,
  `tanggal_diubah` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_rsa`
--

INSERT INTO `surat_rsa` (`id_surat_rsa`, `nomor_surat`, `nik_pasien`, `nip_kapus`, `teks_asli`, `teks_enkripsi`, `hash_enkrip`, `kunci_pasien`, `panjang_rsaGanda`, `panjang_rsa`, `waktu_enkripsi`, `waktu_dekripsi`, `waktu_enkripsi_rsaBiasa`, `waktu_dekripsi_rsaBiasa`, `tanggal_dibuat`, `tanggal_diubah`) VALUES
(1, '1-2022', 3516170980980981, 198203102009011011, '6fa92630d2f74354344e816ba29b7f24', '126378*27501.7933*1.54958*120651.46953*120651.103733*120651.33064.59148*46273.54538*0.87570*46273.66302*46273.101054*29979.104159.31222*33167.55329*5778.21893*1.5019*35946.103175*35946.96808*120651', '5ab9a8362adbd2e35efbab0e03bdc1ff', 'ac7LwX6qAgNkTCYAJELgVFNykkYVWMxiB6P8IBH/VX4rCcaKUvZJEqHuXbAtmlcpm1uDxhxEh/Dl/BZsJjo7uk32dWyQFyftL8uSGd7VhAEOh2RbzSIkTg==', '164', '88', '25.9150390625', '191.01000976562', '25.7998046875', '0.055908203125', '2022-02-03', '2022-02-03'),
(2, '2-2022', 3516170308990002, 198203102009011011, '2b5977a32382f4a02ad3117509052011', '34892*1.32144*0.66002*85578.14037*95236.93309*95236.88459*89924.47284*0.21636*89924.8958*85530.46914*92266.26591*89924.38235.45022*92266.65335*95236.75008.23585*85530.70425*0', '02d633ccb3c9b5c5b2ece5965b722df6', 'hsNMBjbkNeYmrBrnJhX7hkrKlj/7UJjAgSIRHMviU/bTyHOnhb7iJhGdBY7ANp8Dzs5sDF/lfXoxxKhOKz4UOc7iQB/YjRIPnCOrQOOa+yQ6I+bCNb0zPw==', '143', '83', '25.566162109375', '68.178955078125', '25.299072265625', '0.05615234375', '2022-02-03', '2022-02-03'),
(3, '3-2022', 8965291853812312, 198203102009011011, 'bbaf0f0098c878a1dc74bc485e1338eb', '8704*24718.37893.63315*0.0_71847*0.27722*34472.46011.73553*24718.17116*63875.59712.0_61410*24718.59918*46986.49000*76191.31315*63875.4659*63875.51921*46986.24702*63875.32198*46986.60614', 'f388d3b1af560930064c8c3e46603172', 'SekkQyO21CMvutzJwoWX5V4KHAI5YsZTvqOwToHkBiE8rovZ6zE5CcmiZ2WL9N96T3cES+b+//12MfhmnbEoz6Lo4I2yND4rdoilLvp8ZUaM0U46ojwJOg==', '158', '88', '25.764892578125', '133.6640625', '25.619140625', '0.05712890625', '2022-02-03', '2022-02-03'),
(6, '4-2022', 7653289429835482, 198203102009011011, 'cd670d4b9e7797e59e1f921c13e21515', '83168*80618.0_63474*82720.36259*80618.00_17791*26627.5004*80618.44322*5277.20556*71165.32116*82720.0_18229*71165.15406.16514*1.0_5530*26627.45536*0.50944.49243*69181.33245*26627.47690*82720.75858', '5f56849789ba552b669e155c6ae77b23', 'A9xR3hLjwcxKb7bPMibNQ7A3336SNo0cSACU4PsMdWEp77MDHyIAb1ZEc3ZCQQq+uG+hrxzOapYp7QBte8iMkxvMJvhvXaSEiNuG+v1+lR5Nt0Ad5Bax+g==', '163', '90', '-1642245456988', '132.82202148438', '24.481689453125', '0.057861328125', '2022-02-03', '2022-02-03'),
(7, '5-2022', 1276367812937897, 198203102009011011, 'ec7df0f5deb0dbfae0e9219ceaf8bb85', '32783*15720.21387*6440.00_3356*6466.10891*0.0_15107*6440.31748*1.0_6965.19170*21484.0_42022*1.0_34215*15720.20537.24092*21484.31116*6440.38073*1.25481*21484.24699*13876.0_31016*13876.13741*6440.15110*6498', '296315d481a9113432cbf94d60778ed9', 'OUhAC2NczbaquUfj2rPKBUz8jWLo7BL6cE7+DG7Sti3d0NOwy69vll55JIe3/rq4BeKw/109/t8EN9r6D2hbZYcTJKK/dpbsMRbNJPOeeo2R//dO2V+mXw==', '174', '99', '24.3203125', '74.0810546875', '23.873779296875', '0.06005859375', '2022-02-03', '2022-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `surat_rsaizin`
--

CREATE TABLE `surat_rsaizin` (
  `id_rsaIzin` int(11) NOT NULL,
  `nomor_surat` bigint(20) NOT NULL,
  `nik_pasien` bigint(20) NOT NULL,
  `nip_kapus` bigint(20) NOT NULL,
  `hash_text` varchar(255) NOT NULL,
  `enkripsi_text` varchar(500) NOT NULL,
  `hash_enkrip` varchar(128) NOT NULL,
  `kunci_pass` varchar(500) NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `tgl_diubah` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_rsaizin`
--

INSERT INTO `surat_rsaizin` (`id_rsaIzin`, `nomor_surat`, `nik_pasien`, `nip_kapus`, `hash_text`, `enkripsi_text`, `hash_enkrip`, `kunci_pass`, `tgl_dibuat`, `tgl_diubah`) VALUES
(1, 8, 3516170980980981, 198203102009011011, 'd7a8c3ec9c9f5c6afef497e110941259', '47329*46273.101198*20846.45843*5778.20672*29979.125940.125940.22989*0.10457*46273.58846*46273.0_78682*27501.28525*20846.127171*33167.5019*35946.103156*5778.56752*5778.126820*33167.96236*120651.117064*1', '5d4f5f855494251fe654b794931d5e78', 'D939DZvv8B3u3//EA8DmJrHz6ZJOMNyAYWWeOFkUMMSJa0ZkcWWnhEQjB9Cw/4bb7sElBX8z27ZLIqOWboP9mjk4/4qrN/4QLmkTEXZqTsG4S5FgeKq6ly4=', '2022-01-02', '2022-01-02'),
(2, 2, 761283012536123, 198203102009011011, 'ba77e7ce5d33ca5a6d67cad4ce4c849f', '58653*62590.58661*82853.23583*48123.81755.0_3763*82853.31542*48123.76768*48123.60561*48123.6384*62590.57475*34454.48204*69234.26352.31542*48123.41367*69234.0_44788*48123.41624*34454.38839*34454.77303*0', '12a5354e8dee515c5ba1ff57ecb28496', 'M4ixtLjoq/2vocuEKpxHIFyQ6utvDK7lMzZHOoXNUe3DKtFkj5STRqJeHJBoHbK/eksWPnHPI2nVthgsCNnhR1FyCl0XSJI3a8PMDLvmJp1k+aY+Bios9/M=', '2022-01-02', '2022-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `user_profile` varchar(255) NOT NULL DEFAULT 'default-profil.png',
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `fullname`, `user_profile`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'zainulmustofa943@gmail.com', 'mustofa', 'mustofa', 'default-profil.png', '$2y$10$nSN3AEvgPKIYL5g4iV1LKuY.sheeda5Wx5WnlpfWMSzAcOrLtxhGO', '23dade8439d21ce5bdc5485d72d7640e', NULL, '2021-12-23 05:28:08', NULL, NULL, NULL, 1, 0, '2021-11-30 22:43:16', '2021-12-23 04:28:08', NULL),
(5, 'zainulmuhamad84@gmail.com', 'zainul', 'Muhamad zainul', 'default-profil.png', '$2y$10$tTyoMiawbVO.ul30maHfmuoQnHKe/hbPDCBxOtPUlT8Ski7g/fxGG', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-12-17 02:07:52', '2021-12-17 02:07:52', NULL),
(8, 'karina87@gmail.com', 'karina', 'karina', 'default-profil.png', '$2y$10$l./ZKoE/Q5bqVGT5x6dw1.SczwFKvFbEctNU0/Ps2L0.0AHV5udse', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-12-30 09:51:23', '2021-12-30 09:51:23', NULL),
(9, 'skspuskesmas@gmial.com', 'admin', 'AdminisTrator', 'default-profil.png', '$2y$10$8IMjoZjNrbCzz8xLSd5ptuQNCEHZKRY71VFJ/BjQOhHjoaWYPiQZ2', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-01-15 05:57:00', '2022-01-15 05:57:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id` int(20) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `kapus`
--
ALTER TABLE `kapus`
  ADD PRIMARY KEY (`id_kapus`),
  ADD UNIQUE KEY `nip_kapus` (`nip_kapus`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `nik_pasien` (`nik_pasien`);

--
-- Indexes for table `satgas`
--
ALTER TABLE `satgas`
  ADD PRIMARY KEY (`id_satgas`);

--
-- Indexes for table `surat_izin`
--
ALTER TABLE `surat_izin`
  ADD PRIMARY KEY (`id_suratIzin`),
  ADD UNIQUE KEY `nomor_surat` (`nomor_surat`),
  ADD KEY `FK_nik` (`nik_pasien`),
  ADD KEY `FK_nipKp` (`nip_kapus`);

--
-- Indexes for table `surat_kesehatan`
--
ALTER TABLE `surat_kesehatan`
  ADD PRIMARY KEY (`id_sks`),
  ADD UNIQUE KEY `nomor_surat` (`nomor_surat`),
  ADD KEY `FK_sks_nik` (`nik_pasien`),
  ADD KEY `FK_sks_nip` (`nip_kapus`);

--
-- Indexes for table `surat_rsa`
--
ALTER TABLE `surat_rsa`
  ADD PRIMARY KEY (`id_surat_rsa`),
  ADD UNIQUE KEY `hash_enkrip` (`hash_enkrip`),
  ADD KEY `FK_rsa_surat` (`nomor_surat`),
  ADD KEY `FK_rsa_kapus` (`nip_kapus`),
  ADD KEY `FK_rsa_pasien` (`nik_pasien`);

--
-- Indexes for table `surat_rsaizin`
--
ALTER TABLE `surat_rsaizin`
  ADD PRIMARY KEY (`id_rsaIzin`),
  ADD KEY `FK_nomor_surat` (`nomor_surat`),
  ADD KEY `FK_nik_pas` (`nik_pasien`),
  ADD KEY `FK_nip_kap` (`nip_kapus`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kapus`
--
ALTER TABLE `kapus`
  MODIFY `id_kapus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `satgas`
--
ALTER TABLE `satgas`
  MODIFY `id_satgas` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `surat_izin`
--
ALTER TABLE `surat_izin`
  MODIFY `id_suratIzin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat_kesehatan`
--
ALTER TABLE `surat_kesehatan`
  MODIFY `id_sks` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `surat_rsa`
--
ALTER TABLE `surat_rsa`
  MODIFY `id_surat_rsa` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `surat_rsaizin`
--
ALTER TABLE `surat_rsaizin`
  MODIFY `id_rsaIzin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `surat_izin`
--
ALTER TABLE `surat_izin`
  ADD CONSTRAINT `FK_nik` FOREIGN KEY (`nik_pasien`) REFERENCES `pasien` (`nik_pasien`),
  ADD CONSTRAINT `FK_nipKp` FOREIGN KEY (`nip_kapus`) REFERENCES `kapus` (`nip_kapus`);

--
-- Constraints for table `surat_kesehatan`
--
ALTER TABLE `surat_kesehatan`
  ADD CONSTRAINT `FK_sks_nik` FOREIGN KEY (`nik_pasien`) REFERENCES `pasien` (`nik_pasien`),
  ADD CONSTRAINT `FK_sks_nip` FOREIGN KEY (`nip_kapus`) REFERENCES `kapus` (`nip_kapus`);

--
-- Constraints for table `surat_rsa`
--
ALTER TABLE `surat_rsa`
  ADD CONSTRAINT `FK_rsa_kapus` FOREIGN KEY (`nip_kapus`) REFERENCES `kapus` (`nip_kapus`),
  ADD CONSTRAINT `FK_rsa_pasien` FOREIGN KEY (`nik_pasien`) REFERENCES `pasien` (`nik_pasien`),
  ADD CONSTRAINT `FK_rsa_surat` FOREIGN KEY (`nomor_surat`) REFERENCES `surat_kesehatan` (`nomor_surat`);

--
-- Constraints for table `surat_rsaizin`
--
ALTER TABLE `surat_rsaizin`
  ADD CONSTRAINT `FK_nik_pas` FOREIGN KEY (`nik_pasien`) REFERENCES `pasien` (`nik_pasien`),
  ADD CONSTRAINT `FK_nip_kap` FOREIGN KEY (`nip_kapus`) REFERENCES `kapus` (`nip_kapus`),
  ADD CONSTRAINT `FK_nomor_surat` FOREIGN KEY (`nomor_surat`) REFERENCES `surat_izin` (`nomor_surat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
