-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.27-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for dientuct
CREATE DATABASE IF NOT EXISTS `dientuct` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `dientuct`;

-- Dumping structure for table dientuct.dondathang
CREATE TABLE IF NOT EXISTS `dondathang` (
  `dh_ma` int(11) NOT NULL AUTO_INCREMENT,
  `dh_ngaygiao` datetime NOT NULL,
  `dh_trangthaithanhtoan` int(11) NOT NULL DEFAULT 0,
  `dh_noigiao` varchar(255) NOT NULL,
  `dh_ghichu` varchar(255) NOT NULL,
  `dh_thoigiantao` timestamp NOT NULL DEFAULT current_timestamp(),
  `dh_thoigiancapnhat` timestamp NOT NULL DEFAULT current_timestamp(),
  `kh_tendangnhap` varchar(50) NOT NULL,
  PRIMARY KEY (`dh_ma`),
  KEY `FK_dondathang_khachhang` (`kh_tendangnhap`),
  CONSTRAINT `FK_dondathang_khachhang` FOREIGN KEY (`kh_tendangnhap`) REFERENCES `khachhang` (`kh_tendangnhap`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dientuct.dondathang: ~9 rows (approximately)
INSERT INTO `dondathang` (`dh_ma`, `dh_ngaygiao`, `dh_trangthaithanhtoan`, `dh_noigiao`, `dh_ghichu`, `dh_thoigiantao`, `dh_thoigiancapnhat`, `kh_tendangnhap`) VALUES
	(51, '2023-04-29 18:16:00', 1, '123, CIT, Đại học Cần Thơ', '', '2023-04-15 07:17:01', '2023-04-15 07:17:01', 'admin'),
	(53, '2023-04-17 14:21:00', 1, '123, CIT, Đại học Cần Thơ', '', '2023-04-15 07:17:38', '2023-04-15 07:17:38', 'vanly'),
	(54, '2023-04-20 14:21:00', 0, '123, CIT, Đại học Cần Thơ', '', '2023-04-15 07:17:53', '2023-04-15 07:17:53', 'congphuong'),
	(55, '2023-05-06 17:18:00', 0, '123, CIT, Đại học Cần Thơ', '', '2023-04-15 07:18:15', '2023-04-15 07:18:15', 'vanhoang3'),
	(56, '2023-04-28 18:18:00', 0, '123, CIT, Đại học Cần Thơ', '', '2023-04-15 07:18:42', '2023-04-15 07:18:42', 'anhthu2'),
	(57, '2023-04-30 14:25:00', 0, '123, Đại học Đồng Tháp', '', '2023-04-15 07:25:38', '2023-04-15 07:25:38', 'anhthu'),
	(58, '2023-04-28 14:28:00', 0, '123, Đại học Bách khoa Hà Nội', 'Không', '2023-04-15 07:25:54', '2023-04-15 07:41:07', 'vantan'),
	(60, '2023-04-15 16:31:00', 1, '123, Đại học Cần Thơ', '', '2023-04-15 07:37:12', '2023-04-15 07:37:12', 'vantan'),
	(61, '0000-00-00 00:00:00', 0, '', '', '2023-04-16 13:39:19', '2023-04-16 13:39:19', 'duyanh');

-- Dumping structure for table dientuct.hinhsanpham
CREATE TABLE IF NOT EXISTS `hinhsanpham` (
  `hsp_ma` int(11) NOT NULL AUTO_INCREMENT,
  `hsp_tentaptin` varchar(255) NOT NULL,
  `sp_ma` int(11) NOT NULL,
  `hsp_thoigiantao` timestamp NOT NULL DEFAULT current_timestamp(),
  `hsp_thoigiancapnhat` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`hsp_ma`),
  KEY `FK_hinhsanpham_sanpham` (`sp_ma`),
  CONSTRAINT `FK_hinhsanpham_sanpham` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dientuct.hinhsanpham: ~137 rows (approximately)
INSERT INTO `hinhsanpham` (`hsp_ma`, `hsp_tentaptin`, `sp_ma`, `hsp_thoigiantao`, `hsp_thoigiancapnhat`) VALUES
	(1, '20230405043614_iPhone-14-Pro-Max.jpg', 1, '2023-04-05 02:36:14', '2023-04-05 02:36:14'),
	(2, '20230405043621_iPhone-14-Pro-Max1.png', 1, '2023-04-05 02:36:21', '2023-04-05 02:36:21'),
	(3, '20230405043627_iPhone-14-Pro-Max2.png', 1, '2023-04-05 02:36:27', '2023-04-05 02:36:27'),
	(4, '20230405043633_iPhone-14-Pro-Max3.png', 1, '2023-04-05 02:36:33', '2023-04-05 02:36:33'),
	(5, '20230405043642_iPhone-14-Pro-Max4.png', 1, '2023-04-05 02:36:42', '2023-04-05 02:36:42'),
	(6, '20230405043652_iPhone-14-Pro.jpg', 2, '2023-04-05 02:36:52', '2023-04-05 02:36:52'),
	(7, '20230405043700_iPhone-14-Pro1.png', 2, '2023-04-05 02:37:00', '2023-04-05 02:37:00'),
	(8, '20230405043707_iPhone-14-Pro2.png', 2, '2023-04-05 02:37:07', '2023-04-05 02:37:07'),
	(9, '20230405043714_iPhone-14-Pro3.png', 2, '2023-04-05 02:37:14', '2023-04-05 02:37:14'),
	(10, '20230405043734_iPhone-14-Pro4.png', 2, '2023-04-05 02:37:34', '2023-04-05 02:37:34'),
	(11, '20230405043748_iPhone-14.jpg', 3, '2023-04-05 02:37:48', '2023-04-05 02:37:48'),
	(12, '20230405043755_iPhone-14-1.png', 3, '2023-04-05 02:37:55', '2023-04-05 02:37:55'),
	(13, '20230405043803_iPhone-14-2.png', 3, '2023-04-05 02:38:03', '2023-04-05 02:38:03'),
	(14, '20230405043810_iPhone-14-3.png', 3, '2023-04-05 02:38:10', '2023-04-05 02:38:10'),
	(15, '20230405043817_iPhone-14-4.png', 3, '2023-04-05 02:38:17', '2023-04-05 02:38:17'),
	(16, '20230405043824_iPhone-14-5.png', 3, '2023-04-05 02:38:24', '2023-04-05 02:38:24'),
	(17, '20230405043834_iPhone-14-512.jpg', 4, '2023-04-05 02:38:34', '2023-04-05 02:38:34'),
	(18, '20230405043839_iPhone-14-512-1.png', 4, '2023-04-05 02:38:39', '2023-04-05 02:38:39'),
	(19, '20230405043846_iPhone-14-512-2.png', 4, '2023-04-05 02:38:46', '2023-04-05 02:38:46'),
	(20, '20230405043853_iPhone-14-512-3.png', 4, '2023-04-05 02:38:53', '2023-04-05 02:38:53'),
	(21, '20230405043905_iPhone-14-Plus.jpg', 5, '2023-04-05 02:39:05', '2023-04-05 02:39:05'),
	(22, '20230405043915_iPhone-14-Plus-1.png', 5, '2023-04-05 02:39:15', '2023-04-05 02:39:15'),
	(23, '20230405043922_iPhone-14-Plus-2.png', 5, '2023-04-05 02:39:22', '2023-04-05 02:39:22'),
	(24, '20230405043934_iPhone-14-Pro-Max.jpg', 6, '2023-04-05 02:39:34', '2023-04-05 02:39:34'),
	(25, '20230405043940_iPhone-14-Pro-Max-1.png', 6, '2023-04-05 02:39:40', '2023-04-05 02:39:40'),
	(26, '20230405043950_iPhone-14-Pro-Max-2.png', 6, '2023-04-05 02:39:50', '2023-04-05 02:39:50'),
	(27, '20230405043957_iPhone-14-Pro-Max-3.png', 6, '2023-04-05 02:39:57', '2023-04-05 02:39:57'),
	(28, '20230405044030_iPhone-14-Pro-Max-1TB.jpg', 7, '2023-04-05 02:40:30', '2023-04-05 02:40:30'),
	(29, '20230405044037_iPhone-14-Pro-Max-1TB-1.png', 7, '2023-04-05 02:40:37', '2023-04-05 02:40:37'),
	(30, '20230405044044_iPhone-14-Pro-Max-1TB-2.png', 7, '2023-04-05 02:40:44', '2023-04-05 02:40:44'),
	(31, '20230405044103_iPhone-14-Pro-Max-1TB-3.png', 7, '2023-04-05 02:41:03', '2023-04-05 02:41:03'),
	(32, '20230405044110_iPhone-14-Pro-Max-1TB-4.png', 7, '2023-04-05 02:41:10', '2023-04-05 02:41:10'),
	(33, '20230405044117_iPhone-14-Pro-Max-1TB-5.png', 7, '2023-04-05 02:41:17', '2023-04-05 02:41:17'),
	(34, '20230405044623_iPhone-13-Pro.png', 8, '2023-04-05 02:46:23', '2023-04-05 02:46:23'),
	(35, '20230405044630_iPhone-13-Pro-1.jpg', 8, '2023-04-05 02:46:30', '2023-04-05 02:46:30'),
	(36, '20230405044647_iPhone-13-Pro-2.jpg', 8, '2023-04-05 02:46:47', '2023-04-05 02:46:47'),
	(37, '20230405045235_Z-Fold-4-xanh.jpg', 9, '2023-04-05 02:52:35', '2023-04-05 02:52:35'),
	(38, '20230405045246_Z-Fold-4-1.jpg', 9, '2023-04-05 02:52:46', '2023-04-05 02:52:46'),
	(39, '20230405045258_Z-Fold-4-2.jpg', 9, '2023-04-05 02:52:58', '2023-04-05 02:52:58'),
	(40, '20230405045307_Z-Fold-4-3.jpg', 9, '2023-04-05 02:53:07', '2023-04-05 02:53:07'),
	(41, '20230405045314_Z-Fold-4-4.jpg', 9, '2023-04-05 02:53:14', '2023-04-05 02:53:14'),
	(42, '20230405050053_A73-trang.jpg', 10, '2023-04-05 03:00:53', '2023-04-05 03:00:53'),
	(43, '20230405050101_A73-den.jpg', 10, '2023-04-05 03:01:01', '2023-04-05 03:01:01'),
	(44, '20230405050107_A73-xanh.jpg', 10, '2023-04-05 03:01:07', '2023-04-05 03:01:07'),
	(45, '20230405050213_galaxy-s23-ultra-tim.jpg', 11, '2023-04-05 03:02:13', '2023-04-05 03:02:13'),
	(46, '20230405050221_galaxy-s23-ultra-1.jpg', 11, '2023-04-05 03:02:21', '2023-04-05 03:02:21'),
	(47, '20230405050227_galaxy-s23-ultra-2.jpg', 11, '2023-04-05 03:02:27', '2023-04-05 03:02:27'),
	(48, '20230405050234_galaxy-s23-ultra-3.jpg', 11, '2023-04-05 03:02:34', '2023-04-05 03:02:34'),
	(49, '20230405051012_mi-11t-tra-ng.png', 12, '2023-04-05 03:10:12', '2023-04-05 03:10:12'),
	(50, '20230405051023_mi11t-xanh.png', 12, '2023-04-05 03:10:23', '2023-04-05 03:10:23'),
	(51, '20230405051037_mi-11t-2.png', 12, '2023-04-05 03:10:37', '2023-04-05 03:10:37'),
	(52, '20230405051044_mi-11t-3.png', 12, '2023-04-05 03:10:44', '2023-04-05 03:10:44'),
	(53, '20230405051051_mi-11t-1.png', 12, '2023-04-05 03:10:51', '2023-04-05 03:10:51'),
	(54, '20230405051058_mi-11t.png', 12, '2023-04-05 03:10:58', '2023-04-05 03:10:58'),
	(55, '20230405051402_Xiaomi 12T Pro.jpg', 13, '2023-04-05 03:14:02', '2023-04-05 03:14:02'),
	(56, '20230405051410_Xiaomi 12T Pro-1.jpg', 13, '2023-04-05 03:14:10', '2023-04-05 03:14:10'),
	(57, '20230405052046_redmi-k60-copy.png', 14, '2023-04-05 03:20:46', '2023-04-05 03:20:46'),
	(58, '20230405052101_Redmi-K60-1.jpg', 14, '2023-04-05 03:21:01', '2023-04-05 03:21:01'),
	(59, '20230405052436_Macbook-Air-M2.jpg', 16, '2023-04-05 03:24:36', '2023-04-05 03:24:36'),
	(60, '20230405052448_Macbook-Air-M2-1.jpg', 16, '2023-04-05 03:24:48', '2023-04-05 03:24:48'),
	(61, '20230405052509_Macbook-Air-M2-2.jpg', 16, '2023-04-05 03:25:09', '2023-04-05 03:25:09'),
	(62, '20230405052520_Macbook-Air-M2-3.jpg', 16, '2023-04-05 03:25:20', '2023-04-05 03:25:20'),
	(63, '20230405052530_Macbook-Air-M2-4.png', 16, '2023-04-05 03:25:30', '2023-04-05 03:25:30'),
	(64, '20230405052539_Macbook-Air-M2-5.jpg', 16, '2023-04-05 03:25:39', '2023-04-05 03:25:39'),
	(65, '20230405053253_Thong-tin-Macbook-Pro-M2-Xam.png', 17, '2023-04-05 03:32:53', '2023-04-05 03:32:53'),
	(66, '20230405053308_Thong-tin-Macbook-Pro-M2-Xam-1.png', 17, '2023-04-05 03:33:08', '2023-04-05 03:33:08'),
	(67, '20230405053320_Thong-tin-Macbook-Pro-M2-Xam-2.png', 17, '2023-04-05 03:33:20', '2023-04-05 03:33:20'),
	(68, '20230405053328_Thong-tin-Macbook-Pro-M2-Xam-3.png', 17, '2023-04-05 03:33:28', '2023-04-05 03:33:28'),
	(69, '20230405053339_Thong-tin-Macbook-Pro-M2-Xam-4.png', 17, '2023-04-05 03:33:39', '2023-04-05 03:33:39'),
	(70, '20230405053351_Thong-tin-Macbook-Pro-M2-Xam-5.png', 17, '2023-04-05 03:33:51', '2023-04-05 03:33:51'),
	(71, '20230405053812_Macbook-Pro-M1.jpg', 18, '2023-04-05 03:38:12', '2023-04-05 03:38:12'),
	(72, '20230405053820_Macbook-Pro-M1-1.jpg', 18, '2023-04-05 03:38:21', '2023-04-05 03:38:21'),
	(73, '20230405053836_Macbook-Pro-M1-2.jpg', 18, '2023-04-05 03:38:36', '2023-04-05 03:38:36'),
	(74, '20230405053847_Macbook-Pro-M1-3.jpg', 18, '2023-04-05 03:38:47', '2023-04-05 03:38:47'),
	(75, '20230405053905_Macbook-Pro-M1-4.jpg', 18, '2023-04-05 03:39:05', '2023-04-05 03:39:05'),
	(76, '20230405053915_Macbook-Pro-M1-5.jpg', 18, '2023-04-05 03:39:15', '2023-04-05 03:39:15'),
	(77, '20230405053923_Macbook-Pro-M1-6.jpg', 18, '2023-04-05 03:39:23', '2023-04-05 03:39:23'),
	(78, '20230405054150_macbook-air-m1.jpg', 19, '2023-04-05 03:41:50', '2023-04-05 03:41:50'),
	(79, '20230405054205_macbook-air-m1-1.jpg', 19, '2023-04-05 03:42:05', '2023-04-05 03:42:05'),
	(80, '20230405054237_macbook-air-m1-2.jpg', 19, '2023-04-05 03:42:37', '2023-04-05 03:42:37'),
	(81, '20230405054251_macbook-air-m1-3.jpg', 19, '2023-04-05 03:42:51', '2023-04-05 03:42:51'),
	(82, '20230405131230_Macbook-Pro-16-inch-trang-3.jpg', 20, '2023-04-05 03:45:57', '2023-04-05 03:45:06'),
	(83, '20230405131642_Macbook-Pro-16-inch-trang-1.jpg', 20, '2023-04-05 03:46:06', '2023-04-05 11:16:42'),
	(84, '20230405131753_Macbook-Pro-16-inch-trang-2.jpg', 20, '2023-04-05 03:46:18', '2023-04-05 11:17:53'),
	(85, '20230405054639_Macbook-Pro-16-inch-trang-3.jpg', 20, '2023-04-05 03:46:39', '2023-04-05 03:46:39'),
	(86, '20230405055014_MacBook-Air-M1.png', 21, '2023-04-05 03:50:14', '2023-04-05 03:50:14'),
	(87, '20230405055028_MacBook-Air-M1-1.png', 21, '2023-04-05 03:50:28', '2023-04-05 03:50:28'),
	(88, '20230405055038_MacBook-Air-M1-2.png', 21, '2023-04-05 03:50:38', '2023-04-05 03:50:38'),
	(89, '20230405055058_MacBook-Air-M1-3.png', 21, '2023-04-05 03:50:58', '2023-04-05 03:50:58'),
	(90, '20230405104210_ipad-air-4.jpg', 22, '2023-04-05 08:42:10', '2023-04-05 08:42:10'),
	(91, '20230405104222_ipad-air-4-1.png', 22, '2023-04-05 08:42:22', '2023-04-05 08:42:22'),
	(92, '20230405104230_ipad-air-4-2.jpg', 22, '2023-04-05 08:42:30', '2023-04-05 08:42:30'),
	(93, '20230405104241_iPad-gen-10-5G.png', 23, '2023-04-05 08:42:41', '2023-04-05 08:42:41'),
	(94, '20230405104249_iPad-gen-10-5G-1.jpg', 23, '2023-04-05 08:42:49', '2023-04-05 08:42:49'),
	(95, '20230405104256_iPad-gen-10-5G-2.jpg', 23, '2023-04-05 08:42:56', '2023-04-05 08:42:56'),
	(96, '20230405104305_iPad-gen-10-5G-3.jpg', 23, '2023-04-05 08:43:05', '2023-04-05 08:43:05'),
	(97, '20230405104330_iPad-Air-5-Tim.jpg', 24, '2023-04-05 08:43:30', '2023-04-05 08:43:30'),
	(98, '20230405104338_iPad-Air-5-1.jpg', 24, '2023-04-05 08:43:38', '2023-04-05 08:43:38'),
	(99, '20230405104346_iPad-Air-5-2.jpg', 24, '2023-04-05 08:43:46', '2023-04-05 08:43:46'),
	(100, '20230405104353_iPad-Air-5-3.jpg', 24, '2023-04-05 08:43:53', '2023-04-05 08:43:53'),
	(101, '20230405104401_iPad-Air-5-4.jpg', 24, '2023-04-05 08:44:01', '2023-04-05 08:44:01'),
	(102, '20230405104415_may-tinh-bang-samsung-galaxy-tab-s8.png', 25, '2023-04-05 08:44:15', '2023-04-05 08:44:15'),
	(103, '20230405104433_may-tinh-bang-samsung-galaxy-tab-s8-1.png', 25, '2023-04-05 08:44:33', '2023-04-05 08:44:33'),
	(104, '20230405104448_may-tinh-bang-samsung-galaxy-tab-s8-plus-den.png', 26, '2023-04-05 08:44:48', '2023-04-05 08:44:48'),
	(105, '20230405104459_may-tinh-bang-samsung-galaxy-tab-s8-plus-den-1.png', 26, '2023-04-05 08:44:59', '2023-04-05 08:44:59'),
	(106, '20230405104511_samsung-galaxy-tab-s8-ultra-chinh-hang.jpg', 27, '2023-04-05 08:45:11', '2023-04-05 08:45:11'),
	(107, '20230405104838_Bwoo-dpod-max.jpg', 28, '2023-04-05 08:48:38', '2023-04-05 08:48:38'),
	(108, '20230405104847_Bwoo-dpod-max-1.jpg', 28, '2023-04-05 08:48:47', '2023-04-05 08:48:47'),
	(109, '20230405104858_Bwoo-dpod-max-2.jpg', 28, '2023-04-05 08:48:58', '2023-04-05 08:48:58'),
	(110, '20230405104916_Bwoo-dpod-max-3.jpg', 28, '2023-04-05 08:49:16', '2023-04-05 08:49:16'),
	(111, '20230405104928_AirPods-Pro Gen2.jpg', 29, '2023-04-05 08:49:28', '2023-04-05 08:49:28'),
	(112, '20230405104935_AirPods-Pro Gen2-1.jpg', 29, '2023-04-05 08:49:35', '2023-04-05 08:49:35'),
	(113, '20230405104947_AirPods-Pro Gen2-2.jpg', 29, '2023-04-05 08:49:47', '2023-04-05 08:49:47'),
	(114, '20230405104959_Xiaomi-Redmi-Buds.png', 30, '2023-04-05 08:49:59', '2023-04-05 08:49:59'),
	(115, '20230405105007_Xiaomi-Redmi-Buds-1.jpg', 30, '2023-04-05 08:50:07', '2023-04-05 08:50:07'),
	(116, '20230405105107_Apple-AirPods-3 2022.jpg', 31, '2023-04-05 08:51:07', '2023-04-05 08:51:07'),
	(117, '20230405105128_Apple-AirPods-3 2022-1.jpg', 31, '2023-04-05 08:51:28', '2023-04-05 08:51:28'),
	(118, '20230405105141_Apple-AirPods-3 2022-2.jpg', 31, '2023-04-05 08:51:41', '2023-04-05 08:51:41'),
	(119, '20230405105202_Apple-AirPods-3 2022-3.jpg', 31, '2023-04-05 08:52:02', '2023-04-05 08:52:02'),
	(120, '20230405105212_Apple-AirPods-3 2022-4.jpg', 31, '2023-04-05 08:52:12', '2023-04-05 08:52:12'),
	(121, '20230405105229_Apple Watch Series-8-GPS.jpg', 32, '2023-04-05 08:52:29', '2023-04-05 08:52:29'),
	(122, '20230405105240_Apple Watch Series-8-GPS-1.jpg', 32, '2023-04-05 08:52:40', '2023-04-05 08:52:40'),
	(123, '20230405105250_Apple Watch Series-8-GPS-2.jpg', 32, '2023-04-05 08:52:50', '2023-04-05 08:52:50'),
	(124, '20230405105310_Apple Watch Series-8-GPS-3.jpg', 32, '2023-04-05 08:53:10', '2023-04-05 08:53:10'),
	(125, '20230405105321_Apple Watch Series-8-GPS-4.jpg', 32, '2023-04-05 08:53:21', '2023-04-05 08:53:21'),
	(126, '20230405105329_Apple Watch Series-8-GPS-5.jpg', 32, '2023-04-05 08:53:29', '2023-04-05 08:53:29'),
	(127, '20230405105349_Apple Watch Series-8-GPS-41.jpg', 33, '2023-04-05 08:53:49', '2023-04-05 08:53:49'),
	(128, '20230405105400_Apple Watch Series-8-GPS-41-2.jpg', 33, '2023-04-05 08:54:00', '2023-04-05 08:54:00'),
	(129, '20230405105408_Apple Watch Series-8-GPS-41-3.jpg', 33, '2023-04-05 08:54:08', '2023-04-05 08:54:08'),
	(130, '20230405105415_Apple Watch Series-8-GPS-41-4.jpg', 33, '2023-04-05 08:54:15', '2023-04-05 08:54:15'),
	(131, '20230405105433_Apple Watch Series-6-40.png', 34, '2023-04-05 08:54:33', '2023-04-05 08:54:33'),
	(132, '20230405105444_Apple Watch Series-6-40-1.png', 34, '2023-04-05 08:54:44', '2023-04-05 08:54:44'),
	(133, '20230405105459_Apple Watch Series-6-40-3.jpg', 34, '2023-04-05 08:54:59', '2023-04-05 08:54:59'),
	(134, '20230405105536_Apple Watch Series-6-40-4.jpg', 34, '2023-04-05 08:55:36', '2023-04-05 08:55:36'),
	(135, '20230405105550_Apple Watch Series-6-40-5.jpg', 34, '2023-04-05 08:55:50', '2023-04-05 08:55:50'),
	(136, '20230405105613_apple-watch-se-40mm-trang-day-vai.png', 35, '2023-04-05 08:56:13', '2023-04-05 08:56:13'),
	(137, '20230405105620_apple-watch-se-40mm-trang-day-vai-2.png', 35, '2023-04-05 08:56:20', '2023-04-05 08:56:20');

-- Dumping structure for table dientuct.khachhang
CREATE TABLE IF NOT EXISTS `khachhang` (
  `kh_tendangnhap` varchar(50) NOT NULL,
  `kh_matkhau` varchar(255) NOT NULL,
  `kh_ten` varchar(100) NOT NULL,
  `kh_gioitinh` int(11) NOT NULL DEFAULT 0,
  `kh_diachi` varchar(255) NOT NULL DEFAULT 'VN',
  `kh_dienthoai` varchar(50) NOT NULL,
  `kh_email` varchar(100) NOT NULL DEFAULT 'anhb1700326@student.ctu.edu.vn',
  `kh_cmnd` varchar(100) NOT NULL DEFAULT '123456789',
  `kh_ngaysinh` int(11) NOT NULL DEFAULT 1,
  `kh_thangsinh` int(11) NOT NULL DEFAULT 1,
  `kh_namsinh` int(11) NOT NULL DEFAULT 1989,
  `kh_trangthai` int(11) NOT NULL DEFAULT 0,
  `kh_quanly` int(1) NOT NULL DEFAULT 0,
  `kh_binhluan` varchar(255) NOT NULL,
  `kh_thoigiantao` timestamp NOT NULL DEFAULT current_timestamp(),
  `kh_thoigiancapnhat` timestamp NOT NULL DEFAULT current_timestamp(),
  `kh_makichhoat` varchar(50) NOT NULL DEFAULT '0',
  `kh_quantri` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`kh_tendangnhap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dientuct.khachhang: ~13 rows (approximately)
INSERT INTO `khachhang` (`kh_tendangnhap`, `kh_matkhau`, `kh_ten`, `kh_gioitinh`, `kh_diachi`, `kh_dienthoai`, `kh_email`, `kh_cmnd`, `kh_ngaysinh`, `kh_thangsinh`, `kh_namsinh`, `kh_trangthai`, `kh_quanly`, `kh_binhluan`, `kh_thoigiantao`, `kh_thoigiancapnhat`, `kh_makichhoat`, `kh_quantri`) VALUES
	('admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin', 0, 'VN', '0964561306', 'ndanhdev@gmail.com', '123456789', 1, 1, 1989, 0, 0, '', '2023-04-14 12:13:04', '2023-04-14 12:13:04', '0', 0),
	('anhthu', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nguyen Anh Thu', 0, '125, CIT, Đại học Cần Thơ', '0964561306', 'ndanhdev3@gmail.com', '3625257456', 13, 6, 2000, 0, 0, '', '2023-03-20 14:53:34', '2023-03-20 15:06:16', '0', 0),
	('anhthu2', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nguyen Anh Thu', 0, 'VN', '0964561306', 'ndanhdev3@gmail.com', '123456789', 1, 1, 1989, 0, 0, '', '2023-04-10 16:25:30', '2023-04-10 16:25:30', '0', 0),
	('congphuong', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nguyễn Công Phượng', 0, 'VN', '0964561307', '1duyanhdm@gmail.com', '123456789', 1, 1, 1989, 0, 0, '', '2023-04-14 11:47:57', '2023-04-14 11:47:57', '0', 0),
	('duyanh', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nguyễn Duy Anh', 0, 'VN', '0964561306', 'aduy644@gmail.com', '123456789', 1, 1, 1989, 0, 0, 'Sản phẩm này có giá cao hơn so với các cửa hàng lân cận', '2023-04-15 10:01:15', '2023-04-16 09:23:49', '0', 0),
	('tuananh', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nguyễn Tuấn Anh', 0, 'VN', '0964561306', 'ndanhdev@gmail.com', '123456789', 1, 1, 1989, 0, 0, '', '2023-04-16 13:48:08', '2023-04-16 13:48:08', '0', 0),
	('vanhau', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nguyễn Văn Lý', 0, '125, CIT, Đại học Cần Thơ', '0964561306', 'ndanhdev3@gmail.com', '3625257456', 13, 6, 2000, 0, 0, '', '2023-04-03 02:23:03', '2023-04-03 02:23:03', '0', 0),
	('vanhoang', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nguyễn Văn Hoàng', 0, 'VN', '0964561306', 'aduy644@gmail.com', '123456789', 1, 1, 1989, 0, 0, '', '2023-04-10 13:46:37', '2023-04-10 13:46:37', '0', 0),
	('vanhoang2', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nguyễn Văn Hoàng', 0, 'VN', '0964561306', 'aduy644@gmail.com', '123456789', 1, 1, 1989, 0, 0, '', '2023-04-10 13:49:01', '2023-04-10 13:49:01', '0', 0),
	('vanhoang3', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nguyễn Duy Anh', 0, 'VN', '0964561306', 'aduy644@gmail.com', '123456789', 1, 1, 1989, 0, 0, '', '2023-04-10 14:20:09', '2023-04-10 14:20:09', '0', 0),
	('vanly', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nguyễn Văn Lý', 0, '125, CIT, Đại học Cần Thơ', '0964561306', 'ndanhdev3@gmail.com', '3625257456', 13, 6, 2000, 0, 0, '', '2023-03-20 15:07:23', '2023-04-01 15:55:37', '0', 0),
	('vantan', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nguyễn Văn Tân', 0, 'VN', '0964561306', '1duyanhdm@gmail.com', '123456789', 1, 1, 1989, 0, 0, 'Sản phẩm rất tốt', '2023-04-14 07:22:59', '2023-04-14 07:39:19', '0', 0),
	('vantu', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nguyễn Văn Tú', 0, 'VN', '0964561389', 'ndanhdev3@gmail.com', '123456789', 1, 1, 1989, 0, 0, '', '2023-04-14 17:07:53', '2023-04-14 17:07:53', '0', 0);

-- Dumping structure for table dientuct.marketing
CREATE TABLE IF NOT EXISTS `marketing` (
  `mkt_ma` int(11) NOT NULL AUTO_INCREMENT,
  `mkt_tinhtrang` varchar(255) NOT NULL,
  `mkt_bosanpham` varchar(255) NOT NULL,
  `mkt_baohanh` varchar(255) NOT NULL,
  `mkt_hieunang` varchar(255) NOT NULL,
  `mkt_hienthi` varchar(255) NOT NULL,
  `mkt_trainghiem` varchar(255) NOT NULL,
  `mkt_tinhnang` varchar(255) NOT NULL,
  `mkt_dungluong` varchar(255) NOT NULL,
  `mkt_diennang` varchar(255) NOT NULL,
  `mkt_quatang` varchar(255) NOT NULL,
  `sp_ma` int(11) NOT NULL,
  `mkt_thoigiantao` timestamp NOT NULL DEFAULT current_timestamp(),
  `mkt_thoigiancapnhat` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`mkt_ma`),
  KEY `FK_marketing_sanpham` (`sp_ma`),
  CONSTRAINT `FK_marketing_sanpham` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dientuct.marketing: ~35 rows (approximately)
INSERT INTO `marketing` (`mkt_ma`, `mkt_tinhtrang`, `mkt_bosanpham`, `mkt_baohanh`, `mkt_hieunang`, `mkt_hienthi`, `mkt_trainghiem`, `mkt_tinhnang`, `mkt_dungluong`, `mkt_diennang`, `mkt_quatang`, `sp_ma`, `mkt_thoigiantao`, `mkt_thoigiancapnhat`) VALUES
	(1, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', 'Chip Apple A16 Bionic mạnh mẽ, hỗ trợ 5G tốc độ cao cùng kết nối Wifi 6E', 'Màn hình Super Retina XDR OLED 6.7 inch, hỗ trợ công nghệ ProMotion 120 Hz, độ phân giải 1290 x 2796 pixels', 'Cụm 3 camera cải tiến gồm camera chính 48 MP, camera góc siêu rộng 12MP, camera tele 77 mm 12MP và cảm biến 3D LiDAR để đo chiều sâu - Camera selfie 12MP', 'vượt trội với kết nối vệ tinh và phát hiện va chạm', 'RAM 6GB, ROM 128GB', 'Sạc nhanh 20W, hiệu suất một lần sạc 19 tiếng', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 1, '2023-04-03 11:05:01', '2023-04-03 11:05:01'),
	(2, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', 'Chip Apple A16 Bionic mạnh mẽ, hỗ trợ 5G tốc độ cao, dự kiến có kết nối Wifi 6E', 'Màn hình Super Retina XDR OLED 6.1 inch, mật độ điểm ảnh 459 ppi và hỗ trợ công nghệ ProMotion 120 Hz, độ phân giải 2778 x 1.284 pixels', 'Cụm 3 camera cải tiến gồm camera chính 48 MP, camera góc siêu rộng, camera tele 77 mm và cảm biến 3D LiDAR để đo chiều sâu - Camera selfie 12 MP', 'vượt trội với kết nối vệ tinh và phát hiện va chạm', 'RAM 6GB, ROM 128GB', 'Sạc nhanh 23W, hiệu suất một lần sạc 22 tiếng', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 2, '2023-04-03 20:42:30', '2023-04-03 20:42:30'),
	(3, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', 'Chip Apple A15 Bionic mạnh mẽ, hỗ trợ 5G tốc độ cao cùng kết nối Wifi 6E', 'Màn hình Super Retina XDR OLED 6.1 inch, hỗ trợ công nghệ ProMotion 120 Hz, độ phân giải 1290 x 2796 pixels', 'Cụm 3 camera cải tiến gồm camera chính 48 MP, camera góc siêu rộng 12MP, camera tele 77 mm 12MP và cảm biến 3D LiDAR để đo chiều sâu - Camera selfie 12MP', 'vượt trội với kết nối vệ tinh và phát hiện va chạm', 'RAM 6GB, ROM 128GB', 'Sạc nhanh 20W, hiệu suất một lần sạc 19 tiếng', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 3, '2023-04-03 20:48:21', '2023-04-03 20:48:21'),
	(4, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', 'Chip Apple A15 Bionic mạnh mẽ, hỗ trợ 5G tốc độ cao cùng kết nối Wifi 6E', 'Màn hình Super Retina XDR OLED 6.1 inch, mật độ điểm ảnh 459 ppi và hỗ trợ công nghệ ProMotion 120 Hz, độ phân giải 2778 x 1.284 pixels', 'Cụm 3 camera cải tiến gồm camera chính 48 MP, camera góc siêu rộng, camera tele 77 mm và cảm biến 3D LiDAR để đo chiều sâu - Camera selfie 12 MP', 'vượt trội với kết nối vệ tinh và phát hiện va chạm', 'RAM 6GB, ROM 512GB', 'Sạc nhanh 20W, hiệu suất một lần sạc 19 tiếng', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 4, '2023-04-03 20:53:01', '2023-04-03 20:53:01'),
	(5, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', 'Chip Apple A15 Bionic mạnh mẽ, hỗ trợ 5G tốc độ cao cùng kết nối Wifi 6E', 'Màn hình Super Retina XDR OLED 6.7 inch, hỗ trợ công nghệ ProMotion 120 Hz, độ phân giải 1290 x 2796 pixels', 'Cụm 3 camera cải tiến gồm camera chính 48 MP, camera góc siêu rộng, camera tele 77 mm và cảm biến 3D LiDAR để đo chiều sâu - Camera selfie 12 MP', 'vượt trội với kết nối vệ tinh và phát hiện va chạm', 'RAM 6GB, ROM 256GB', 'Sạc nhanh 20W, hiệu suất một lần sạc 17 tiếng', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 5, '2023-04-03 20:57:33', '2023-04-03 20:57:33'),
	(6, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', 'Chip Apple A16 Bionic mạnh mẽ, hỗ trợ 5G tốc độ cao, dự kiến có kết nối Wifi 6E', 'Màn hình Super Retina XDR OLED 6.7 inch, hỗ trợ công nghệ ProMotion 120 Hz, độ phân giải 1290 x 2796 pixels', 'Cụm 3 camera cải tiến gồm camera chính 48 MP, camera góc siêu rộng, camera tele 77 mm và cảm biến 3D LiDAR để đo chiều sâu - Camera selfie 12 MP', 'vượt trội với kết nối vệ tinh và phát hiện va chạm', 'RAM 6GB, ROM 256GB', 'Sạc nhanh 23W, hiệu suất một lần sạc 22 tiếng', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 6, '2023-04-03 21:01:38', '2023-04-03 21:01:38'),
	(7, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', 'Chip Apple A16 Bionic mạnh mẽ, hỗ trợ 5G tốc độ cao, dự kiến có kết nối Wifi 6E', 'Màn hình Super Retina XDR OLED 6.7 inch, hỗ trợ công nghệ ProMotion 120 Hz, độ phân giải 1290 x 2796 pixels', 'Cụm 3 camera cải tiến gồm camera chính 48 MP, camera góc siêu rộng 12MP, camera tele 77 mm 12MP và cảm biến 3D LiDAR để đo chiều sâu - Camera selfie 12MP', 'Thiết lập tính năng an toàn vượt trội với kết nối vệ tinh và phát hiện va chạm', 'RAM 6GB, ROM 1TB', 'Sạc nhanh 23W, hiệu suất một lần sạc 22 tiếng', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 7, '2023-04-03 21:04:56', '2023-04-03 21:04:56'),
	(8, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', 'Chip Apple A15 Bionic mạnh mẽ, hỗ trợ 5G tốc độ cao cùng kết nối Wifi 6E', 'Màn hình OLED Super Retina XDR cùng tần số quét 120Hz', 'Chất lượng camera được cải tiến, chụp ảnh ban đêm siêu đỉnh.', 'vượt trội với kết nối vệ tinh và phát hiện va chạm', 'RAM 6GB, ROM 256GB', 'Hỗ trợ sạc nhanh 20W, sạc không dây Magsafe', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 8, '2023-04-03 21:12:54', '2023-04-03 21:12:54'),
	(9, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Samsung Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 9, '2023-04-03 21:18:12', '2023-04-03 21:18:12'),
	(10, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Samsung Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 10, '2023-04-03 21:29:44', '2023-04-03 21:29:44'),
	(11, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Samsung Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 11, '2023-04-03 21:32:58', '2023-04-03 21:32:58'),
	(12, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Xiaomi Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 12, '2023-04-03 21:35:43', '2023-04-03 21:35:43'),
	(13, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Xiaomi Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 13, '2023-04-03 21:40:19', '2023-04-03 21:40:19'),
	(14, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Xiaomi Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 14, '2023-04-03 21:45:49', '2023-04-03 21:45:49'),
	(15, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Oppo Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 15, '2023-04-03 21:52:45', '2023-04-03 21:52:45'),
	(16, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 16, '2023-04-03 21:57:54', '2023-04-03 21:57:54'),
	(17, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 17, '2023-04-03 22:11:31', '2023-04-03 22:11:31'),
	(18, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 18, '2023-04-03 22:16:39', '2023-04-03 22:16:39'),
	(19, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 19, '2023-04-03 22:19:25', '2023-04-03 22:19:25'),
	(20, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 20, '2023-04-03 22:24:23', '2023-04-03 22:24:23'),
	(21, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 21, '2023-04-03 22:35:01', '2023-04-03 22:35:01'),
	(22, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 22, '2023-04-03 22:35:36', '2023-04-03 22:35:36'),
	(23, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 23, '2023-04-03 22:42:52', '2023-04-03 22:42:52'),
	(24, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 24, '2023-04-03 22:43:21', '2023-04-03 22:43:21'),
	(25, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 25, '2023-04-03 22:50:49', '2023-04-03 22:50:49'),
	(26, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 26, '2023-04-03 22:51:16', '2023-04-03 22:51:16'),
	(27, 'Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Cable, Sách hướng dẫn, Cây lấy sim', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 27, '2023-04-03 22:51:35', '2023-04-03 22:51:35'),
	(28, 'Tai nghe mới 100% , chính hãng BWOO Việt Nam', 'Tai nghe, cáp sạc, sách hướng dẫn', 'Bảo hành chính hãng 1 đổi 1 12 tháng', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 28, '2023-04-03 22:55:56', '2023-04-03 22:55:56'),
	(29, 'Tai nghe mới 100% , chính hãng', 'Tai nghe, cáp sạc, sách hướng dẫn', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Mua kèm với iPhone cũ giá 590.000đ', 29, '2023-04-03 22:57:00', '2023-04-03 22:57:00'),
	(30, 'Tai nghe mới 100% , chính hãng', 'Tai nghe, cáp sạc, sách hướng dẫn', '12 tháng chính hãng Xiaomi Việt Nam', '', '', '', '', '', '', 'Giảm 5% tối đa 500.000đ khi thanh toán qua Kredivo', 30, '2023-04-03 23:06:57', '2023-04-03 23:06:57'),
	(31, 'Tai nghe mới 100% , chính hãng', 'Tai nghe, cáp sạc, sách hướng dẫn', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Mua kèm với iPhone cũ giá 590.000đ', 31, '2023-04-03 23:07:30', '2023-04-03 23:07:30'),
	(32, ' Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Dây đeo, Cable, Dock sạc, sách hướng dẫn', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Mua kèm với iPhone bất kỳ giảm ngay 300.000đ', 33, '2023-04-03 23:22:40', '2023-04-03 23:22:40'),
	(33, ' Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Dây đeo, Cable, Dock sạc, sách hướng dẫn', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Mua kèm với iPhone bất kỳ giảm ngay 300.000đ', 32, '2023-04-03 23:23:10', '2023-04-03 23:23:10'),
	(34, ' Mới 100%, Nguyên Seal, Chưa Kích Hoạt, Đủ Bảo Hành', 'Thân máy, Dây đeo, Cable, Dock sạc, sách hướng dẫn', '12 tháng chính hãng Apple Việt Nam', '', '', '', '', '', '', 'Mua kèm với iPhone bất kỳ giảm ngay 300.000đ', 34, '2023-04-03 23:23:57', '2023-04-03 23:23:57');

-- Dumping structure for table dientuct.sanpham
CREATE TABLE IF NOT EXISTS `sanpham` (
  `sp_ma` int(11) NOT NULL AUTO_INCREMENT,
  `sp_ten` varchar(100) NOT NULL,
  `sp_soluong` int(11) NOT NULL DEFAULT 0,
  `sp_dophangiai` varchar(100) NOT NULL,
  `sp_manhinh` varchar(100) NOT NULL,
  `sp_camera_truoc` varchar(100) NOT NULL,
  `sp_camera_sau` varchar(100) NOT NULL,
  `sp_hedieuhanh` varchar(100) NOT NULL,
  `sp_chip` varchar(100) NOT NULL,
  `sp_ram` varchar(100) NOT NULL,
  `sp_rom` varchar(100) NOT NULL,
  `sp_pin` varchar(100) NOT NULL,
  `sp_nsx` varchar(100) NOT NULL,
  `sp_lsp` varchar(100) NOT NULL,
  `sp_gia` decimal(12,2) NOT NULL,
  `sp_giacu` decimal(12,2) NOT NULL,
  `sp_km` varchar(50) NOT NULL DEFAULT 'Không',
  `sp_thoigiantao` timestamp NOT NULL DEFAULT current_timestamp(),
  `sp_thoigiancapnhat` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`sp_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dientuct.sanpham: ~36 rows (approximately)
INSERT INTO `sanpham` (`sp_ma`, `sp_ten`, `sp_soluong`, `sp_dophangiai`, `sp_manhinh`, `sp_camera_truoc`, `sp_camera_sau`, `sp_hedieuhanh`, `sp_chip`, `sp_ram`, `sp_rom`, `sp_pin`, `sp_nsx`, `sp_lsp`, `sp_gia`, `sp_giacu`, `sp_km`, `sp_thoigiantao`, `sp_thoigiancapnhat`) VALUES
	(1, 'iPhone 14 Pro Max 128GB Chính hãng VN/A', 100, '1290 x 2796 pixels', '6.7" - Tần số quét 120 Hz', '12 MP', '48MP x12MP x 12MP', 'IOS', 'Apple A16 Bionic', '6 GB', '128 GB', '4323 mAh', 'Apple', 'Điện thoại', 27300000.00, 33790000.00, 'Không', '2023-04-03 11:03:40', '2023-04-03 11:03:40'),
	(2, 'iPhone 14 Pro 128GB Chính hãng VN/A', 100, '1290 x 2796 pixels', '6.1" - Tần số quét 120 Hz', '12 MP', '48MP x12MP x 12MP', 'IOS', 'Apple A16 Bionic', '6 GB', '128 GB', '4323 mAh', 'Apple', 'Điện thoại', 24990000.00, 30990000.00, 'Không', '2023-04-03 20:37:54', '2023-04-03 20:37:54'),
	(3, 'iPhone 14 128GB chính hãng VN/A', 100, '1170 x 2532 pixels', '6.1" - Tần số quét 60 Hz', '12 MP', '48MP x12MP x 12MP', 'IOS', 'Apple A15 Bionic', '6 GB', '128 GB', '3279 mAh', 'Apple', 'Điện thoại', 19590000.00, 23990000.00, 'Không', '2023-04-03 20:47:01', '2023-04-03 20:47:01'),
	(4, 'iPhone 14 512GB chính hãng VN/A', 100, '1170 x 2532 pixels', '6.1" - Tần số quét 60 Hz', '12 MP', '48MP x12MP x 12MP', 'IOS', 'Apple A15 Bionic', '6 GB', '512 GB', '3279 mAh', 'Apple', 'Điện thoại', 24790000.00, 32990000.00, 'Không', '2023-04-03 20:51:04', '2023-04-03 20:51:04'),
	(5, 'iPhone 14 Plus 256GB Chính hãng VN/A', 100, 'Ful HD+ (2.778 x 1.284 pixel)', '6.7" - Tần số quét 60 Hz', '12 MP', '48MP x12MP x 12MP', 'IOS', 'Apple A15 Bionic', '6 GB', '512 GB', '4325mAh', 'Apple', 'Điện thoại', 25190000.00, 29990000.00, 'Không', '2023-04-03 20:55:57', '2023-04-03 20:55:57'),
	(6, 'iPhone 14 Pro Max 256GB Chính hãng VN/A', 100, '1290 x 2796 pixels', '6.7" - Tần số quét 120 Hz', '12 MP', '48MP x12MP x 12MP', 'IOS', 'Apple A16 Bionic', '6 GB', '256 GB', '4323 mAh', 'Apple', 'Điện thoại', 30990000.00, 32990000.00, 'Không', '2023-04-03 20:59:41', '2023-04-03 20:59:41'),
	(7, 'iPhone 14 Pro Max 1TB Chính hãng VN/A', 100, 'Ful HD+ (2.778 x 1.284 pixel)', '6.7" - Tần số quét 120 Hz', '12 MP', '48MP x12MP x 12MP', 'IOS', 'Apple A16 Bionic', '6 GB', '1 TB', '4323 mAh', 'Apple', 'Điện thoại', 41290000.00, 49990000.00, 'Không', '2023-04-03 21:03:35', '2023-04-03 21:03:35'),
	(8, 'iPhone 13 Pro 256GB Chính hãng VN/A', 80, '	1170 x 2532 Pixels', '6.1" - Tần số quét 120 Hz', '12 MP', '12MP x12MP x 12MP', 'IOS', 'Apple A15 Bionic', '6 GB', '256 GB', '3095 mAh', 'Apple', 'Điện thoại', 25490000.00, 26990000.00, 'Không', '2023-04-03 21:11:35', '2023-04-03 21:11:35'),
	(9, 'Samsung Galaxy Z Fold4 12GB/256GB Chính hãng', 100, 'Chính: QXGA+ (2176 x 1812 Pixels) & Phụ: HD+ (2316 x 904 Pixels)', 'Chính 7.6" & Phụ 6.2" - Tần số quét 120 Hz', '32 MP, f/2.2, 26mm (wide), 1/2.8", 0.8µm', 'Chính 50 MP & Phụ 12 MP, 10 MP', 'Android', 'Snapdragon 8+ Gen 1 8 nhân', '12 GB', '256GB', '4400 mAh', 'Samsung', 'Điện thoại', 30990000.00, 40990000.00, 'Không', '2023-04-03 21:15:51', '2023-04-03 21:15:51'),
	(10, 'Samsung Galaxy A73 5G 8GB/128GB Chính Hãng', 80, 'Full HD+ (1080 x 2400 Pixels)', '6.7" - Tần số quét 120 Hz', '12 MP', 'Chính 108 MP & Phụ 12 MP, 5 MP, 5 MP', 'Android', '	Snapdragon 8 Gen 1', '8 GB', '128 GB', '5000 mAh', 'Samsung', 'Điện thoại', 9590000.00, 11990000.00, 'Không', '2023-04-03 21:26:59', '2023-04-03 21:26:59'),
	(11, 'Samsung Galaxy S23 Ultra 5G 8GB/256GB chính hãng', 100, '1440 x 3088 pixel (mật độ ~501 ppi)', '6.8" - Tần số quét 120Hz', '12 MP', '200MP + 10MP +10MP + 12MP', 'Android', '	Snapdragon 8 Gen 2', '8 GB', '256 GB', '5000 mAh', 'Samsung', 'Điện thoại', 22990000.00, 31990000.00, 'Không', '2023-04-03 21:30:48', '2023-04-03 21:30:48'),
	(12, 'Xiaomi 11T 8/128GB Chính Hãng', 80, 'Full HD+ (1080 x 2400 Pixels)', '6.67" - Tần số quét 120 Hz', '16 MP', 'Chính 108 MP & Phụ 8 MP, 5 MP', 'Android', 'MediaTek Dimensity 1200 8 nhân', '8 GB', '128 GB', '5000 mAh', 'Xiaomi', 'Điện thoại', 9590000.00, 10990000.00, 'Không', '2023-04-03 21:34:24', '2023-04-03 21:34:24'),
	(13, 'Xiaomi 12T Pro 12GB/256GB Chính hãng', 100, '1220 x 2712 pixels, tỉ lệ 20:9', '6.67 inches', '20 MP', '200 MP x 8 MP x 2 MP', 'Android', 'Qualcomm Snapdragon 8+ Gen 1 (4 nm)', '12 GB', '256 GB', '5000 mAh', 'Xiaomi', 'Điện thoại', 16990000.00, 20990000.00, 'Không', '2023-04-03 21:38:29', '2023-04-03 21:38:29'),
	(14, 'Redmi K60 8GB/256GB Chính hãng', 80, 'HDR10+, 1440 x 3200 pixel', '6.67" - Tần số quét 120 Hz', '16MP', '64MP + 8MP + 2MP', 'Android', 'Qualcomm SM8475 Snapdragon 8+ Thế hệ 1 (4nm)', '8 GB', '256 GB', '5500mAh', 'Xiaomi', 'Điện thoại', 9190000.00, 10990000.00, 'Không', '2023-04-03 21:44:08', '2023-04-03 21:44:08'),
	(15, 'Oppo Reno6 Z 5G 8GB/128GB chính hãng', 100, 'Full HD+ (1080 x 2400 Pixels)', '6.43" - Tần số quét 60 Hz', '32MP', 'Chính 64 MP & Phụ 8 MP, 2 MP', 'Android', 'MediaTek Dimensity 800U 5G 8 nhân', '8 GB', '128 GB', '4310 mAh', 'Oppo', 'Điện thoại', 8190000.00, 9490000.00, 'Không', '2023-04-03 21:51:14', '2023-04-03 21:51:14'),
	(16, 'Macbook Air M2 8GB/256GB Chính Hãng', 50, 'Full HD+ (2560 x 1664 pixels) + màn hình tai thỏ', '13.6 inch', '', '', '	MacOS', 'Apple M2', '8 GB', '256 GB', '	Lithium polymer 52,6Wh', 'Apple', 'Laptop', 28990000.00, 30990000.00, 'Không', '2023-04-03 21:54:22', '2023-04-03 21:54:22'),
	(17, 'Macbook Pro 13" M2 8GB/256GB chính hãng', 50, 'Retina (2560 x 1600)', '13.3 inch', '', '', 'Mac OS', 'Apple M2', '8 GB', '256 GB', 'Lithium - polymer, 100Wh', 'Apple', 'Laptop', 32490000.00, 33990000.00, 'Không', '2023-04-03 22:10:02', '2023-04-03 22:10:02'),
	(18, 'MacBook Pro 16 inch M1 Pro 16GB/1TB Chính hãng', 50, '	3456 x 2234 pixels', '	16.2 inch', '', '', 'Mac OS', '	Apple M1 Pro', '16 GB', '1 TB', 'Lithium - polymer, 100Wh', 'Apple', 'Laptop', 68590000.00, 69990000.00, 'Không', '2023-04-03 22:13:26', '2023-04-03 22:13:26'),
	(19, 'MacBook Air M1 256GB 2020', 50, '	2560 X 1600 Pixel', '13.3 inch', '', '', 'Mac OS', 'Apple M1', '8 GB', '256 GB', '	Lithium polymer 52,6Wh', 'Apple', 'Laptop', 18750000.00, 27990000.00, 'Không', '2023-04-03 22:17:44', '2023-04-03 22:17:44'),
	(20, 'MacBook Pro 16 inch M1 Max 32GB/1TB Chính hãng', 50, '	3456 x 2234 pixels', '16.2 inch', '', '', 'Mac OS', '	Apple M1 Max 10 CPU', '32 GB', '1 TB', 'Lithium - polymer, 100Wh', 'Apple', 'Laptop', 89990000.00, 92990000.00, 'Không', '2023-04-03 22:22:04', '2023-04-03 22:22:04'),
	(21, 'MacBook Air M1 16GB/256GB Chính hãng', 50, '	2560 X 1600 Pixel', '13.3 inch', '', '', 'Mac OS', 'Apple M1', '16 GB', '256 GB', '	Lithium polymer 52,6Wh', 'Apple', 'Laptop', 26990000.00, 33990000.00, 'Không', '2023-04-03 22:25:27', '2023-04-03 22:25:27'),
	(22, 'iPad Air 4 10.9 64GB Wifi/4G 2020 – Chính hãng', 100, '1640 x 2360 Pixels', '10,9 inch', '7 MP', '12 MP', 'iPadOS 14', 'Apple A14 Bionic 6 nhân', '4 GB', '64 GB', '7600 mAh Li-po', 'Apple', 'Máy tính bảng', 15890000.00, 20990000.00, 'Không', '2023-04-03 22:26:59', '2023-04-03 22:26:59'),
	(23, 'iPad Gen 10 64GB 5G Chính hãng', 100, '2360 x 1640 Pixels', '10,9 inch', '7 MP', '12 MP', 'iPadOS 16', 'A14 Bionic với CPU 6 lõi, GPU 4 lõi và Neural Engine 16 lõi', '4 GB', '64 GB', '7600 mAh Li-po', 'Apple', 'Máy tính bảng', 14890000.00, 19990000.00, 'Không', '2023-04-03 22:36:22', '2023-04-03 22:36:22'),
	(24, 'iPad Air 5 256GB 5G-WIFI-M1 2022', 100, '1640 x 2360 pixels (~264 ppi density)', '10,9 inch', '12 MP, f/2.4, 122˚ (ultrawide)', '12 MP, f/1.8, (wide), 1/3", 1.22µm, dual pixel PDAF', '	iPadOS 15.3', 'Apple M1', '4 GB', '64 GB', 'Li-Ion (28.6 Wh)', 'Apple', 'Máy tính bảng', 19990000.00, 22990000.00, 'Không', '2023-04-03 22:41:17', '2023-04-03 22:41:17'),
	(25, 'Samsung Galaxy Tab S8 Chính hãng', 100, '2560 x 1600 Pixels', '11 inch - Tần số quét 120 Hz', '12 MP', 'Chính 13 MP & Phụ 6 MP', 'Android', '	Adreno 730', '8 GB', '128 GB', '8000 mAh Li-Ion', 'Samsung', 'Máy tính bảng', 18990000.00, 20990000.00, 'Không', '2023-04-03 22:44:29', '2023-04-03 22:44:29'),
	(26, 'Samsung Galaxy Tab S8 Plus Chính hãng', 100, '1752 x 2800 Pixels', '12.4 inch - Tần số quét 120 Hz', '12 MP', 'Chính 13 MP & Phụ 6 MP', 'Android', 'Adreno 730', '8 GB', '128 GB', '8000 mAh Li-Ion', 'Samsung', 'Máy tính bảng', 20990000.00, 25990000.00, 'Không', '2023-04-03 22:47:34', '2023-04-03 22:47:34'),
	(27, 'Samsung Galaxy Tab S8 Ultra 2022 Chính hãng', 100, '1848 x 2960 pixels', '14.6 inch - Tần số quét 120 Hz', '12 MP', 'Chính 13 MP & Phụ 6 MP', 'Android', 'Snapdragon 8 Gen 1 8 nhân', '8 GB', '128 GB', '11200 mAh', 'Samsung', 'Máy tính bảng', 25990000.00, 30990000.00, 'Không', '2023-04-03 22:49:02', '2023-04-03 22:49:02'),
	(28, 'Tai nghe chống ồn BWOO DPOD MAX (BW45)', 100, '', '', '', '', '', '', '', '', '', 'BWOO Việt Nam', 'Phụ kiện', 790000.00, 990000.00, 'Không', '2023-04-03 22:54:09', '2023-04-03 22:54:09'),
	(29, 'Tai nghe Bluetooth AirPods Pro Gen2 Chính hãng', 100, '', '', '', '', '', '', '', '', '', 'Apple', 'Phụ kiện', 5699000.00, 6199000.00, 'Không', '2023-04-03 22:54:55', '2023-04-03 22:54:55'),
	(30, 'Tai nghe bluetooth Xiaomi Redmi Buds 3', 100, '', '', '', '', '', '', '', '', '', 'Xiaomi', 'Phụ kiện', 739000.00, 1499000.00, 'Không', '2023-04-03 23:05:18', '2023-04-03 23:05:18'),
	(31, 'Tai Nghe Bluetooth Apple AirPods 3 - Chính Hãng', 100, '', '', '', '', '', '', '', '', '', 'Apple', 'Phụ kiện', 4190000.00, 4950000.00, 'Không', '2023-04-03 23:06:08', '2023-04-03 23:06:08'),
	(32, 'Apple Watch Series 8 GPS + Cellular 45mm Viền thép dây thép | Chính hãng VN/A', 80, '', '', '', '', '', '', '', '', '', 'Apple', 'Smartwatch', 9990000.00, 15990000.00, 'Không', '2023-04-03 23:18:12', '2023-04-03 23:18:12'),
	(33, 'Apple Watch Series 8 GPS 41mm Viền nhôm dây cao su | Chính hãng VN/A', 80, '', '', '', '', '', '', '', '', '', 'Apple', 'Smartwatch', 9690000.00, 14990000.00, 'Không', '2023-04-03 23:19:40', '2023-04-03 23:19:40'),
	(34, 'Apple Watch Series 6 40mm LTE - Viền nhôm dây cao su – Chính hãng', 80, '', '', '', '', '', '', '', '', '', 'Apple', 'Smartwatch', 6990000.00, 13990000.00, 'Không', '2023-04-03 23:20:48', '2023-04-03 23:20:48'),
	(35, 'Apple Watch SE 44mm 4G - Viền nhôm dây cao su – Chính hãng VN/A', 80, '', '', '', '', '', '', '', '', '', 'Apple', 'Smartwatch', 6690000.00, 11990000.00, 'Không', '2023-04-03 23:21:34', '2023-04-03 23:21:34');

-- Dumping structure for table dientuct.sanpham_dondathang
CREATE TABLE IF NOT EXISTS `sanpham_dondathang` (
  `dh_ma` int(11) NOT NULL,
  `sp_ma` int(11) NOT NULL,
  `sp_dh_soluong` int(11) NOT NULL,
  `sp_dh_dongia` decimal(12,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`sp_ma`,`dh_ma`),
  KEY `FK_sanpham_dondathang_dondathang` (`dh_ma`),
  CONSTRAINT `FK_sanpham_dondathang_dondathang` FOREIGN KEY (`dh_ma`) REFERENCES `dondathang` (`dh_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_sanpham_dondathang_sanpham` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dientuct.sanpham_dondathang: ~12 rows (approximately)
INSERT INTO `sanpham_dondathang` (`dh_ma`, `sp_ma`, `sp_dh_soluong`, `sp_dh_dongia`) VALUES
	(61, 1, 2, 27300000.00),
	(60, 5, 1, 25190000.00),
	(55, 10, 1, 9590000.00),
	(58, 13, 1, 16990000.00),
	(51, 14, 1, 9190000.00),
	(54, 14, 1, 9190000.00),
	(56, 14, 2, 9190000.00),
	(53, 16, 1, 28990000.00),
	(56, 16, 1, 28990000.00),
	(57, 17, 1, 32490000.00),
	(60, 19, 2, 18750000.00),
	(55, 24, 1, 19990000.00);

-- Dumping structure for view dientuct.viewdanhsachkhachhang
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `viewdanhsachkhachhang` (
	`kh_tendangnhap` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`kh_gioitinh` INT(11) NOT NULL,
	`kh_ten` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`kh_diachi` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
	`kh_dienthoai` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`kh_namsinh` INT(11) NOT NULL,
	`kh_email` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`kh_cmnd` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view dientuct.viewdanhsachsanpham
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `viewdanhsachsanpham` (
	`sp_ma` INT(11) NOT NULL,
	`sp_ten` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`sp_gia` DECIMAL(12,2) NOT NULL,
	`sp_soluong` INT(11) NOT NULL,
	`sp_nsx` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`sp_lsp` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view dientuct.viewdondathang
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `viewdondathang` (
	`dh_ma` INT(11) NOT NULL,
	`dh_thoigiantao` TIMESTAMP NOT NULL,
	`kh_tendangnhap` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view dientuct.viewdanhsachkhachhang
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `viewdanhsachkhachhang`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `viewdanhsachkhachhang` AS SELECT kh_tendangnhap, kh_gioitinh, kh_ten, kh_diachi, kh_dienthoai, kh_namsinh, kh_email, kh_cmnd
FROM khachhang ;

-- Dumping structure for view dientuct.viewdanhsachsanpham
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `viewdanhsachsanpham`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `viewdanhsachsanpham` AS SELECT sp_ma, sp_ten, sp_gia, sp_soluong, sp_nsx, sp_lsp
FROM sanpham ;

-- Dumping structure for view dientuct.viewdondathang
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `viewdondathang`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `viewdondathang` AS SELECT dh_ma, dh_thoigiantao, kh_tendangnhap
FROM dondathang ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
