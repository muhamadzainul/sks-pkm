-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 04:37 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

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
(3, 'admin', 'site administrtor'),
(4, 'petugas', 'site petugas');

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
(3, 1),
(3, 2),
(4, 2);

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
(3, 4);

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
(23, '::1', 'zainulmustofa943@gmail.com', 4, '2021-12-07 23:13:24', 1);

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
  `hash_kapus` varchar(255) NOT NULL,
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

INSERT INTO `kapus` (`id_kapus`, `slug`, `nama_kapus`, `nip_kapus`, `hash_kapus`, `publik_key`, `private_key`, `hash_publik_key`, `hash_private_key`, `active`, `tanggal_dibuat`, `tanggal_diubah`) VALUES
(1, '198203102009011011-dr.-DENY-SETIYAWAN', 'dr. DENY SETIYAWAN', 198203102009011011, '', '', '', '', '', 1, '2021-12-05', '2021-12-05'),
(29, '128736851238781623-krisna-jata', 'krisna jata', 128736851238781623, '', '', '', '', '', 0, NULL, NULL);

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
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` bigint(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `foto_kk` varchar(255) DEFAULT NULL,
  `tanggal_dibuat` date DEFAULT NULL,
  `tanggal_diubah` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `slug`, `nik_pasien`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `no_hp`, `email`, `foto_ktp`, `foto_kk`, `tanggal_dibuat`, `tanggal_diubah`) VALUES
(40, 'Muhamad Zainul Mustofa', '3516170305990002-muhamad-zainul-mustofa', 3516170305990002, NULL, 'Laki-laki', 'mojokerto', 81217626875, 'zainulmustofa943@gmail.com', 'KTP - 1634769812_c426b180e379adb4e9e9.jpg', 'KK - 1634769812_c426b180e379adb4e9e9.jpg', '2021-10-20', '2021-10-20'),
(41, 'Faiq Anugerah', '1231232342342341-faiq-anugerah', 1231232342342341, NULL, 'Laki-laki', 'kutorejo', 123123123123, 'zalan.lucah@fineoak.org', 'KTP - 1634796986_9dd19ecb8167b6f15a4f.jpeg', NULL, '2021-10-21', '2021-10-21'),
(42, 'Siska', '1234123412341234-siska', 1234123412341234, NULL, 'Perempuan', 'gogor', 54672354567, 'jensyn.ryuu@fineoak.org', NULL, NULL, '2021-10-21', '2021-10-21'),
(43, 'asdasd', '6574562345673455-asdasd', 6574562345673455, NULL, 'Perempuan', 'mojokerto', 52352355674, 'gakun7020@gmail.com', NULL, NULL, '2021-10-21', '2021-10-21'),
(44, 'James', '235212345745673-james', 235212345745673, NULL, 'Laki-laki', 'Jakarta', 32251231657, 'jensyn.ryuu@fineoak.org', NULL, NULL, '2021-10-21', '2021-10-21'),
(45, 'fadhlil asd', '23125467412346-fadhlil-asd', 23125467412346, NULL, 'Laki-laki', 'gresik', 34254547672, 'zalan.lucah@fineoak.org', NULL, NULL, '2021-10-21', '2021-10-21'),
(46, 'Siska', '124123124-siska', 124123124, NULL, 'Laki-laki', 'Jakarta', 34563123434, 'jensyn.ryuu@fineoak.org', 'KTP - 1635648526_5b61dbe4644018151773.jpg', 'KK - 1635648526_5b61dbe4644018151773.jpg', '2021-10-28', '2021-10-30'),
(51, 'fahri', '3526160907990002-fahri', 3526160907990002, '1998-09-13', 'Laki-laki', 'gresik', NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'James', '3425678324150004-james', 3425678324150004, '1980-04-12', 'Laki-laki', 'kutorejo', NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'jali', '3561812763182987-jali', 3561812763182987, '1998-05-12', 'Laki-laki', 'gresikasdsa', NULL, NULL, NULL, NULL, NULL, NULL),
(64, 'saman', '2344561234561234-saman', 2344561234561234, '1980-08-15', 'Laki-laki', 'gresik', NULL, NULL, NULL, NULL, '2021-12-03', '2021-12-03'),
(68, 'kasih', '345876209100002-kasih', 345876209100002, NULL, 'Perempuan', 'gresikasdsa', NULL, NULL, NULL, NULL, '2021-12-03', '2021-12-03');

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
(3, 12341234124114, 12341234123412124, 'susanti ari', '12341234123412124-susanti-ari', 'Perempuan', 'mojokerto', 12334523345, 'iluljrdev@gmail.com', NULL, '2021-10-21', '2021-10-21'),
(4, 2341243213412432314, 234123423412432134, 'susanti ari', '234123423412432134-susanti-ari', 'Laki-laki', 'mojokerto', 2342312343, 'zainulmuhamad84@gmail.com', NULL, '2021-12-01', '2021-12-01');

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
  `riwayat_penyakit` varchar(225) DEFAULT NULL,
  `suhu_tubuh` varchar(225) NOT NULL,
  `tensi_darah` varchar(225) NOT NULL,
  `nadi` int(11) DEFAULT NULL,
  `respirasi` int(11) DEFAULT NULL,
  `mata_buta` varchar(20) DEFAULT NULL,
  `tubuh_tato` varchar(20) DEFAULT NULL,
  `tubuh_tindik` varchar(255) NOT NULL,
  `kepentingan` varchar(225) NOT NULL,
  `hasil_periksa` varchar(255) NOT NULL,
  `tanggal_dibuat` date NOT NULL,
  `tanggal_diubah` date NOT NULL,
  `tanggal_exp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_kesehatan`
--

INSERT INTO `surat_kesehatan` (`id_sks`, `nomor_surat`, `nik_pasien`, `nip_kapus`, `slug`, `pekerjaan`, `tinggi_badan`, `berat_badan`, `riwayat_penyakit`, `suhu_tubuh`, `tensi_darah`, `nadi`, `respirasi`, `mata_buta`, `tubuh_tato`, `tubuh_tindik`, `kepentingan`, `hasil_periksa`, `tanggal_dibuat`, `tanggal_diubah`, `tanggal_exp`) VALUES
(11, '678', 3561812763182987, 198203102009011011, NULL, 'Wiraswasta', 168, 56, NULL, '67', '80', 13, 54, 'YA', 'tidak', 'tidak', 'Melamar pekerjaan', 'SEHAT', '2021-12-03', '2021-12-03', '0000-00-00'),
(12, '112', 2344561234561234, 198203102009011011, NULL, 'Wiraswasta', 168, 56, NULL, '67', '80', 13, 54, 'TIDAK', 'tidak', 'tidak', 'Melamar pekerjaan', 'SEHAT', '2021-12-03', '2021-12-03', '0000-00-00'),
(13, '134', 345876209100002, 198203102009011011, NULL, 'Wiraswasta', 168, 56, NULL, '67', '80', 13, 54, 'YA', 'tidak', 'tidak', 'Melamar pekerjaan', 'TIDAK SEHAT', '2021-12-03', '2021-12-03', '0000-00-00'),
(14, '678', 3561812763182987, 198203102009011011, NULL, 'Wiraswasta', 168, 56, NULL, '67', '80', 13, 54, 'TIDAK', 'tidak', 'tidak', 'Melamar pekerjaan', 'SEHAT', '2021-12-03', '2021-12-03', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
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

INSERT INTO `users` (`id`, `email`, `fullname`, `user_profile`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'zainulmustofa943@gmail.com', 'mustofa', 'default-profil.png', '$2y$10$nSN3AEvgPKIYL5g4iV1LKuY.sheeda5Wx5WnlpfWMSzAcOrLtxhGO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-11-30 22:43:16', '2021-11-30 22:43:16', NULL);

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
-- Indexes for table `surat_kesehatan`
--
ALTER TABLE `surat_kesehatan`
  ADD PRIMARY KEY (`id_sks`),
  ADD KEY `FK_sks_nik` (`nik_pasien`),
  ADD KEY `FK_sks_nip` (`nip_kapus`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kapus`
--
ALTER TABLE `kapus`
  MODIFY `id_kapus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `satgas`
--
ALTER TABLE `satgas`
  MODIFY `id_satgas` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `surat_kesehatan`
--
ALTER TABLE `surat_kesehatan`
  MODIFY `id_sks` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Constraints for table `surat_kesehatan`
--
ALTER TABLE `surat_kesehatan`
  ADD CONSTRAINT `FK_sks_nik` FOREIGN KEY (`nik_pasien`) REFERENCES `pasien` (`nik_pasien`),
  ADD CONSTRAINT `FK_sks_nip` FOREIGN KEY (`nip_kapus`) REFERENCES `kapus` (`nip_kapus`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
