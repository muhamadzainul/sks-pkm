-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2022 at 03:46 PM
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
(88, '::1', 'zainulmustofa943@gmail.com', 4, '2022-01-13 05:16:15', 1);

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
  `active` int(11) NOT NULL,
  `tanggal_dibuat` date DEFAULT NULL,
  `tanggal_diubah` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kapus`
--

INSERT INTO `kapus` (`id_kapus`, `slug`, `nama_kapus`, `nip_kapus`, `publik_key`, `private_key`, `hash_publik_key`, `hash_private_key`, `active`, `tanggal_dibuat`, `tanggal_diubah`) VALUES
(1, '198203102009011011-dr.-DENY-SETIYAWAN', 'dr. DENY SETIYAWAN', 198203102009011011, '109.89147', 'vO58GRpTpPiWdWNzhHclfJXM0o5Fe/ZeWkuNSExqWlQjFCXSB6p7x4a3Ydfd19+VRtYijXwYKQhD4TWgseY/SNeinLCwSHYjYh0Zn9ppaLYzfz4Fu0wKE3nA1A==', '28b98d7a02dd9d0fe69654443b44fc94', 'eb1e2b7691d31d176d6e5b40556e7a3a', 1, '2021-12-05', '2022-01-01');

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
(89, 'parman', '7612853817635712-parman', 7612853817635712, NULL, '1970-06-30', 'Laki-laki', 'Dsn. Wotgaru, 03/05, Pucuk, Dawarblandong', NULL, NULL, '193.128759', 'TD/Cf24fD3gdKugdT/MygkP7LzTkakKowejeMAOe2mjm55PsL8WFA/VxrHUPxLDoWND+R5/VpW2d+3SOMnjPFfy78n4brBmSO/dfoFrffKa/DMbWljglipGZWQ0=', '', 'default-ktp.png', 'default-kk.png', '2022-01-13', '2022-01-13');

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
(1, '1-2022', 3516170308990002, 198203102009011011, NULL, '1', 179, 65, '34', '110/70', 70, 20, 'TIDAK', 'TIDAK', 'TIDAK', 'Melamar pekerjaan', 'SEHAT', '2b5977a32382f4a02ad3117509052011.png', '2022-01-13', '2022-01-13', '2022-01-15'),
(2, '2-2022', 1234123412341234, 198203102009011011, NULL, '1', 160, 53, '34', '110/70', 70, 20, 'TIDAK', 'TIDAK', 'TIDAK', 'Melamar pekerjaan', 'SEHAT', '0b52aa480ee6191aa0d75836eaa8ef04.png', '2022-01-13', '2022-01-13', '2022-01-15'),
(3, '3-2022', 2344561234561234, 198203102009011011, NULL, '1', 179, 68, '34', '110/70', 70, 20, 'TIDAK', 'TIDAK', 'TIDAK', 'Melamar pekerjaan', 'SEHAT', '88e7c81aefae75e8e950a7c127504c86.png', '2022-01-13', '2022-01-13', '2022-01-15'),
(4, '4-2022', 7653289429835482, 198203102009011011, NULL, '1', 179, 68, '34', '110/70', 70, 20, 'TIDAK', 'TIDAK', 'TIDAK', 'Melamar pekerjaan', 'SEHAT', '7c6f426b077aa0fe3df9d15dc6e03c5c.png', '2022-01-13', '2022-01-13', '2022-01-15'),
(5, '5-2022', 3516170908990002, 198203102009011011, NULL, '1', 179, 68, '34', '110/70', 70, 20, 'TIDAK', 'TIDAK', 'TIDAK', 'Melamar pekerjaan', 'SEHAT', '152100ac2dcf3f46e2398afb9c3e2f2c.png', '2022-01-13', '2022-01-13', '2022-01-15'),
(6, '6-2022', 761283012536123, 198203102009011011, NULL, '1', 170, 68, '34', '110/70', 70, 20, 'TIDAK', 'TIDAK', 'TIDAK', 'Melamar pekerjaan', 'SEHAT', '907f5b5f4cb38982077b2ecc0e640c0f.png', '2022-01-13', '2022-01-13', '2022-01-15'),
(7, '7-2022', 7612853817635712, 198203102009011011, NULL, '1', 165, 68, '34', '110/70', 70, 20, 'TIDAK', 'TIDAK', 'TIDAK', 'Melamar pekerjaan', 'SEHAT', '3e9c8bb0f5fe2bfba9dde07f93c0d14f.png', '2022-01-13', '2022-01-13', '2022-01-15'),
(8, '8-2022', 645367218613123, 198203102009011011, NULL, '1', 160, 53, '34', '110/70', 70, 20, 'TIDAK', 'TIDAK', 'TIDAK', 'Melamar pekerjaan', 'SEHAT', '9600a30932c96569f4fdf8b076874991.png', '2022-01-13', '2022-01-13', '2022-01-15'),
(9, '9-2022', 7851256381253712, 198203102009011011, NULL, '1', 170, 68, '34', '110/70', 70, 20, 'TIDAK', 'TIDAK', 'TIDAK', 'Melamar pekerjaan', 'SEHAT', 'cc06f811bcaee10edfc458756323174e.png', '2022-01-13', '2022-01-13', '2022-01-15'),
(10, '10-2022', 7862781638135156, 198203102009011011, NULL, '1', 158, 69, '34', '110/70', 70, 20, 'TIDAK', 'TIDAK', 'TIDAK', 'Melamar pekerjaan', 'SEHAT', '87fa09a596293e706e053a39893aa561.png', '2022-01-13', '2022-01-13', '2022-01-15');

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
  `waktu_enkripsi` varchar(50) DEFAULT NULL,
  `waktu_dekripsi` varchar(50) DEFAULT NULL,
  `tanggal_dibuat` date DEFAULT NULL,
  `tanggal_diubah` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_rsa`
--

INSERT INTO `surat_rsa` (`id_surat_rsa`, `nomor_surat`, `nik_pasien`, `nip_kapus`, `teks_asli`, `teks_enkripsi`, `hash_enkrip`, `kunci_pasien`, `waktu_enkripsi`, `waktu_dekripsi`, `tanggal_dibuat`, `tanggal_diubah`) VALUES
(1, '1-2022', 3516170308990002, 198203102009011011, '2b5977a32382f4a02ad3117509052011', '34892*1.32144*0.66002*85578.14037*95236.93309*95236.88459*89924.47284*0.21636*89924.8958*85530.46914*92266.26591*89924.38235.45022*92266.65335*95236.75008.23585*85530.70425*0', '02d633ccb3c9b5c5b2ece5965b722df6', 'gpeyIaJGiQ/lOxWxxhrQiV6U+gSzkd8PeJFaLnG+qBdTEkVdVimflaS44Sw15NFeQ+BnXlGubvL7qo1ukmwosB5jzeGPhYiFZn9IJjaJ9OvqqIHPBre4uQ==', '0.53302788734436', '0.085752010345459', '2022-01-13', '2022-01-13'),
(2, '2-2022', 1234123412341234, 198203102009011011, '0b52aa480ee6191aa0d75836eaa8ef04', '159*5809.43761.5894*58073.51522*25819.38183*56695.46359*58073.36504*57991.18768*58073.5894*58073.38183*56695.0_12139*58073.16398*57991.41206*58073.0_28964*57991.18491*21623.25106.0_53475*0.58221*5809', '9d65c734968664a7d89f10ebc881cab6', 'tvWXbp3vbRK68syu9jiGlMvZoA5667EgDaWa5enD8fIvpw4MTSEnFWNE+FeaNxbFCz6gA9E96AoQZUf4vrt0TetIOEljH/VsCtZ6Rgf91nAcI+hV6PSzsg==', '0.10596394538879', '0.11005902290344', '2022-01-13', '2022-01-13'),
(3, '3-2022', 2344561234561234, 198203102009011011, '88e7c81aefae75e8e950a7c127504c86', '44555*39697.48427*9752.66844*9752.66308*44184.23681*74635.48476*1.23681*74635.47881*74635.48427*9752.38399*27112.54029*44184.68815*39697.54482*9752.18362*1.47881*74635.30679*74635.36712*39697.12987*0', '75f4cc4a8c58af2df85b805cbb73464d', '83M8ZFSOdyQ2XSZwope30DtGNet5Kn2a1EFhaM/0daiuEn6SxJjqfJ12RV8afhiRnPZ4DfWwFegSTvmDWuJWi32SqYZ1JP6OFiC8Vzj3MrSEu6VrRA8wwQ==', '0.11244702339172', '0.08137583732605', '2022-01-13', '2022-01-13'),
(4, '4-2022', 7653289429835482, 198203102009011011, '7c6f426b077aa0fe3df9d15dc6e03c5c', '29049*5277.73679*80618.78806*80618.0_10999*5277.24940*5277.55313*0.44315*80618.44753*82720.44322*5277.46683*69181.30949*0.43212*82720.80122*0.18937*48801.17258*1.0_86363*80378.20591*1.82044*1', 'e7f6193cea2040a2b25600b40a82faa5', 'f449D7iYMsuNEee9grwzPwJRo+DTUTdEgOSstOkfc7+BbDtKloTi+I4W1LpQp769dUjQGNQ1y81aJu0tTAyNWMaqU/mzxdZF61zXVzVgxbUR/+YEQZX6lA==', '0.1108250617981', '0.15523600578308', '2022-01-13', '2022-01-13'),
(5, '5-2022', 3516170908990002, 198203102009011011, '152100ac2dcf3f46e2398afb9c3e2f2c', '72430*0.3718*0.69712*46586.77762*0.85588.0_49503*85107.0_50147*22956.15183*0.64678*1.0_48794*0.50942*46586.89152*46886.1263*1.89900*6491.57327.0_48794*0.15183*0.0_70395', '69c5915605bd110ce79c349be228e24a', '8WG96ceuzmHq7DMiA/U5DAkL3ETZh3URxEtZTRZSAkLKYYpYb5dl/suy+7J/lQO5lf1Gaeuuu6KvXzeea/1bLdVmNngn57xJQOXd3xwdbwCozN8r7k74oQ==', '0.10707306861877', '0.053927898406982', '2022-01-13', '2022-01-13'),
(6, '6-2022', 761283012536123, 198203102009011011, '907f5b5f4cb38982077b2ecc0e640c0f', '9541*4356.70571*69234.14150*1.76556*4356.0_27190*1.61265.25566*69234.42496.4628*4356.58661*82853.65240*69234.16869*82853.10382*1.52727*4356.68912.13514*44180.50255*4356.75633*74020', '48432ee91b8951af81e245a3d0512bb8', 'r2DtWebBbcim9WIT/FIlE7206Gj2YPfPCpxejHUtshg5Bj8T0ZvLtR8P0+JxZYf7pubuid1WO+6LH92rnwkD3LI8fv3Rm7aki9lQRMAaiodCqa6tkJ1H2A==', '0.10799193382263', '0.12196707725525', '2022-01-13', '2022-01-13'),
(7, '7-2022', 7612853817635712, 198203102009011011, '3e9c8bb0f5fe2bfba9dde07f93c0d14f', '70567*89340.120594*22027.125772*122708.68633*95597.4629*25174.94310*1.89449*22027.117816*1.5858*1.25868*22756.12322*25174.125195*1.0_120217*22027.67830*89340.102909*25174.117668*45189.2568*45189.28620*45189.29621*0', '695817089bd55e2f111a2df0e3b0b682', 'G4aKp9chRNmMWBhbN3sMO5VmTfZX9Nj8DdTv3SGgi1idlqVUYju/2Z0Rf0FVCIJOJG3nZEZY3d2Hqm+XwPkDvvUAipkM1pDff/JiQoGO7NPWCy7CAZCUHw==', '0.11052393913269', '0.14482307434082', '2022-01-13', '2022-01-13'),
(8, '8-2022', 645367218613123, 198203102009011011, '9600a30932c96569f4fdf8b076874991', '2627*54778.57079*23361.79542*10279.72588*77259.10723*1.53027.79712*54778.3885*23361.82673*0.64906*54778.35482*1.0_54599*23361.18775*0.69054*26062.54027*54778.76416*24666.12002*77259', '6567bfd89c3124fcd0796984368450fa', 'vzNF4l7RimBNML/LAJOpvKOb79PRYN0tYo/5vvpqYtwqHbheau3S8fcNJRUF8/YwYY3v572F9s/tCH93vef4J4VfpELkgdIOuFf+df4fal4mRfDpL0ooWQ==', '0.10813021659851', '0.08837890625', '2022-01-13', '2022-01-13'),
(9, '9-2022', 7851256381253712, 198203102009011011, 'cc06f811bcaee10edfc458756323174e', '1737*27290.16655*0.19168*0.11297*25490.4273*25490.982.0_35858*2672.30867*33416.22308*17600.4093*1.0_8089*13607.21597.15676*13607.36400.8448*1.18704*10628.36555*2672.9412*18459', '7c2c800235d4311ea181609401cadc06', 'hPeCT8EKEMpRK9pK/YuwDBpJhGz7YN2yGY6s1P1+O6VguuRnDrBQ9xZyK13dsH/hvETgr6Z33U8pXDjmOUUKatxnQ/IPWv7WoYHuZD8qxTZogvEKkLYV7A==', '0.10938811302185', '0.065128087997437', '2022-01-13', '2022-01-13'),
(10, '10-2022', 7862781638135156, 198203102009011011, '87fa09a596293e706e053a39893aa561', '38249*34948.84777*1.100734*40345.58145*40345.35097*9126.96835*73485.116435*49329.0_47983*0.18450*0.26889.13288*1.91627*40345.47811*73485.86588*86798.11251*86798.51414*40345.88946*0', '45e847932f70f9a37d02e9c684e70681', 'IEEvImkXAZpTQXyGdh7SYsuU6vdqC3wBAbd4sCSQt5plAxFvX/qEKEsCCW+GG2jymadZlC6ALVYwvz0nD9PQVWnxKTMVNtIbRUzUw2uz/tq9W6cWszbeGA==', '0.10946416854858', '0.1077139377594', '2022-01-13', '2022-01-13');

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
(8, 'karina87@gmail.com', 'karina', 'karina', 'default-profil.png', '$2y$10$l./ZKoE/Q5bqVGT5x6dw1.SczwFKvFbEctNU0/Ps2L0.0AHV5udse', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-12-30 09:51:23', '2021-12-30 09:51:23', NULL);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

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
  MODIFY `id_kapus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

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
  MODIFY `id_sks` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `surat_rsa`
--
ALTER TABLE `surat_rsa`
  MODIFY `id_surat_rsa` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `surat_rsaizin`
--
ALTER TABLE `surat_rsaizin`
  MODIFY `id_rsaIzin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
