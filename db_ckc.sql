-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 07:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ckc`
--

-- --------------------------------------------------------

--
-- Table structure for table `bien_ban_shcn`
--

CREATE TABLE `bien_ban_shcn` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_lop` bigint(20) UNSIGNED NOT NULL,
  `id_sv` bigint(20) UNSIGNED NOT NULL,
  `id_gvcn` bigint(20) UNSIGNED NOT NULL,
  `id_tuan` bigint(20) UNSIGNED NOT NULL,
  `tieu_de` varchar(255) NOT NULL,
  `noi_dung` longtext NOT NULL,
  `thoi_gian_bat_dau` datetime NOT NULL,
  `thoi_gian_ket_thuc` datetime NOT NULL,
  `so_luong_sinh_vien` int(11) NOT NULL DEFAULT 0,
  `vang_mat` int(11) NOT NULL DEFAULT 0,
  `trang_thai` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bien_ban_shcn`
--

INSERT INTO `bien_ban_shcn` (`id`, `id_lop`, `id_sv`, `id_gvcn`, `id_tuan`, `tieu_de`, `noi_dung`, `thoi_gian_bat_dau`, `thoi_gian_ket_thuc`, `so_luong_sinh_vien`, `vang_mat`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'Biên bản sinh hoạt chủ nhiệm lớp Tuần 1', 'Nội dung sinh hoạt chủ nhiệm lớp Tuần 1', '2025-06-06 12:00:00', '2025-06-06 12:30:00', 30, 5, 1, '2025-07-10 22:33:54', NULL),
(2, 1, 1, 1, 1, 'Biên bản sinh hoạt chủ nhiệm lớp Tuần 2', 'Nội dung sinh hoạt chủ nhiệm lớp Tuần 2', '2025-06-06 12:00:00', '2025-06-06 12:30:00', 30, 5, 1, '2025-07-10 22:33:54', NULL),
(3, 1, 1, 1, 1, 'Biên bản sinh hoạt chủ nhiệm lớp Tuần 3', 'Nội dung sinh hoạt chủ nhiệm lớp Tuần 3', '2025-06-06 12:00:00', '2025-06-06 12:30:00', 30, 5, 1, '2025-07-10 22:33:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `binh_luan`
--

CREATE TABLE `binh_luan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nguoi_binh_luan_type` varchar(255) DEFAULT NULL,
  `nguoi_binh_luan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `id_thong_bao` bigint(20) UNSIGNED NOT NULL,
  `noi_dung` longtext NOT NULL,
  `id_binh_luan_cha` bigint(20) UNSIGNED DEFAULT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `binh_luan`
--

INSERT INTO `binh_luan` (`id`, `nguoi_binh_luan_type`, `nguoi_binh_luan_id`, `id_thong_bao`, `noi_dung`, `id_binh_luan_cha`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 1, 'Bình luận của user admin', NULL, 1, '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(2, 'App\\Models\\SinhVien', 1, 1, 'Bình luận của sinh viên', NULL, 1, '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(3, 'App\\Models\\User', 1, 1, 'Phản hồi của admin cho sinh viên', 2, 1, '2025-07-10 22:33:54', '2025-07-10 22:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `bo_mon`
--

CREATE TABLE `bo_mon` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_chuyen_nganh` bigint(20) UNSIGNED NOT NULL,
  `ten_bo_mon` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bo_mon`
--

INSERT INTO `bo_mon` (`id`, `id_chuyen_nganh`, `ten_bo_mon`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tin Học Phần Cứng', NULL, NULL),
(2, 1, 'Tin Học Phần Mềm', NULL, NULL),
(3, 2, 'CNKT Điện công nghiệp', NULL, NULL),
(4, 2, 'CNKT Điện tử công nghiệp', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:54:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:13:\"gán vai trò\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:31:\"xem menu bảng điều khiển\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:19:\"danh sách vai trò\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:14:\"tạo vai trò\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:22:\"chỉnh sửa vai trò\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"xóa vai trò\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:18:\"danh sách quyền\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:13:\"tạo quyền\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:21:\"chỉnh sửa quyền\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:12:\"xóa quyền\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:12:\"gán quyền\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:38:\"danh sách chương trình đào tạo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:22:\"danh sách biên bản\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:15:\"xem biên bản\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:17:\"tạo biên bản\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:25:\"chỉnh sửa biên bản\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:16:\"xóa biên bản\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:17:\"gửi biên bản\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:22:\"xoá sinh viên vắng\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:57:\"danh sách sinh viên liên hệ cấp lại mật khẩu\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:59:\"cập nhật sinh viên liên hệ cấp lại mật khẩu\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:10:\"xem tuần\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:12:\"tạo tuần\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:29:\"danh sách điểm môn học\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:32:\"chỉnh sửa điểm môn học\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:24:\"danh sách giảng viên\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:16:\"xem lịch dạy\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:51:\"danh sách sinh viên đăng ký giấy xác nhận\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:53:\"cập nhật sinh viên đăng ký giấy xác nhận\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:16:\"xem lịch học\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:23:\"danh sách lịch học\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:18:\"tạo lịch học\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:26:\"chỉnh sửa lịch học\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:17:\"xóa lịch học\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:16:\"sao chép tuần\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:10:\"lịch thi\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:16:\"tạo lịch thi\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:15:\"xem lớp học\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:33:\"danh sách sinh viên lớp học\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:27:\"nhập điểm rèn luyện\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:15:\"Sổ lên lớp\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:21:\"Tạo sổ lên lớp\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:23:\"danh sách phòng học\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:18:\"tạo phòng học\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:26:\"chỉnh sửa phòng học\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:21:\"danh sách sinh viên\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:3;i:2;i:5;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:36:\"chỉnh sửa chức vụ sinh viên\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:22:\"danh sách thông báo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:15:\"xem thông báo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:17:\"tạo thông báo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:25:\"chỉnh sửa thông báo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:16:\"xóa thông báo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:17:\"gửi thông báo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:26:\"thư ký tạo biên bản\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:6:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:28:\"trưởng phòng đào tạo\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:27:\"giảng viên chủ nhiệm\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:40:\"trưởng phòng công tác chính trị\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:23:\"giảng viên bộ môn\";s:1:\"c\";s:3:\"web\";}i:5;a:3:{s:1:\"a\";i:6;s:1:\"b\";s:14:\"trưởng khoa\";s:1:\"c\";s:3:\"web\";}}}', 1752545302);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_bien_ban_shcn`
--

CREATE TABLE `chi_tiet_bien_ban_shcn` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_bien_ban_shcn` bigint(20) UNSIGNED NOT NULL,
  `id_sinh_vien` bigint(20) UNSIGNED NOT NULL,
  `ly_do` varchar(255) DEFAULT NULL,
  `loai` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_ctdt`
--

CREATE TABLE `chi_tiet_ctdt` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_chuong_trinh_dao_tao` bigint(20) UNSIGNED NOT NULL,
  `id_mon_hoc` bigint(20) UNSIGNED NOT NULL,
  `id_hoc_ky` bigint(20) UNSIGNED NOT NULL,
  `so_tiet` int(11) DEFAULT 0,
  `so_tin_chi` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chi_tiet_ctdt`
--

INSERT INTO `chi_tiet_ctdt` (`id`, `id_chuong_trinh_dao_tao`, `id_mon_hoc`, `id_hoc_ky`, `so_tiet`, `so_tin_chi`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 75, 5, NULL, NULL),
(2, 1, 2, 1, 30, 1, NULL, NULL),
(3, 1, 3, 1, 30, 2, NULL, NULL),
(4, 1, 4, 1, 45, 3, NULL, NULL),
(5, 1, 5, 1, 45, 3, NULL, NULL),
(6, 1, 6, 1, 45, 3, NULL, NULL),
(7, 1, 7, 1, 75, 5, NULL, NULL),
(8, 1, 8, 1, 45, 3, NULL, NULL),
(9, 1, 9, 1, 45, 2, NULL, NULL),
(10, 1, 10, 1, 90, 2, NULL, NULL),
(11, 1, 11, 2, 75, 5, NULL, NULL),
(12, 1, 12, 2, 30, 1, NULL, NULL),
(13, 1, 13, 2, 60, 4, NULL, NULL),
(14, 1, 14, 2, 75, 5, NULL, NULL),
(15, 1, 15, 2, 45, 3, NULL, NULL),
(16, 1, 16, 2, 45, 3, NULL, NULL),
(17, 1, 17, 2, 45, 3, NULL, NULL),
(18, 1, 18, 2, 45, 2, NULL, NULL),
(19, 1, 19, 2, 45, 2, NULL, NULL),
(20, 1, 20, 2, 45, 2, NULL, NULL),
(21, 1, 21, 3, 135, 2, NULL, NULL),
(22, 1, 22, 3, 45, 3, NULL, NULL),
(23, 1, 23, 3, 75, 5, NULL, NULL),
(24, 1, 24, 3, 30, 2, NULL, NULL),
(25, 1, 25, 3, 45, 3, NULL, NULL),
(26, 1, 26, 3, 45, 3, NULL, NULL),
(27, 1, 27, 3, 45, 3, NULL, NULL),
(28, 1, 28, 3, 45, 2, NULL, NULL),
(29, 1, 29, 3, 45, 2, NULL, NULL),
(30, 1, 30, 3, 45, 2, NULL, NULL),
(31, 2, 31, 4, 45, 3, NULL, NULL),
(32, 2, 32, 4, 45, 3, NULL, NULL),
(33, 2, 33, 4, 75, 5, NULL, NULL),
(34, 2, 34, 4, 45, 3, NULL, NULL),
(35, 2, 35, 4, 60, 4, NULL, NULL),
(36, 2, 36, 4, 45, 3, NULL, NULL),
(37, 2, 37, 4, 45, 3, NULL, NULL),
(38, 2, 38, 4, 45, 2, NULL, NULL),
(39, 2, 42, 5, 45, 3, NULL, NULL),
(40, 2, 43, 5, 60, 4, NULL, NULL),
(41, 2, 44, 5, 60, 4, NULL, NULL),
(42, 2, 45, 5, 90, 6, NULL, NULL),
(43, 2, 46, 5, 90, 6, NULL, NULL),
(44, 2, 47, 5, 75, 5, NULL, NULL),
(45, 2, 48, 5, 75, 5, NULL, NULL),
(46, 2, 58, 6, 30, 2, NULL, NULL),
(47, 2, 59, 6, NULL, 4, NULL, NULL),
(48, 2, 60, 6, NULL, 4, NULL, NULL),
(49, 2, 61, 6, NULL, NULL, NULL, NULL),
(50, 3, 31, 4, 45, 3, NULL, NULL),
(51, 3, 32, 4, 45, 3, NULL, NULL),
(52, 3, 33, 4, 75, 5, NULL, NULL),
(53, 3, 34, 4, 45, 3, NULL, NULL),
(54, 3, 35, 4, 60, 4, NULL, NULL),
(55, 3, 36, 4, 45, 3, NULL, NULL),
(56, 3, 37, 4, 45, 3, NULL, NULL),
(57, 3, 38, 4, 45, 2, NULL, NULL),
(58, 3, 42, 5, 45, 3, NULL, NULL),
(59, 3, 43, 5, 60, 4, NULL, NULL),
(60, 3, 44, 5, 60, 4, NULL, NULL),
(61, 3, 49, 5, 90, 6, NULL, NULL),
(62, 3, 50, 5, 75, 5, NULL, NULL),
(63, 3, 51, 5, 90, 6, NULL, NULL),
(64, 3, 48, 5, 75, 5, NULL, NULL),
(65, 3, 62, 6, 30, 2, NULL, NULL),
(66, 3, 59, 6, NULL, 4, NULL, NULL),
(67, 3, 60, 6, NULL, 4, NULL, NULL),
(68, 3, 61, 6, NULL, NULL, NULL, NULL),
(69, 4, 31, 4, 45, 3, NULL, NULL),
(70, 4, 32, 4, 45, 3, NULL, NULL),
(71, 4, 33, 4, 75, 5, NULL, NULL),
(72, 4, 39, 4, 45, 3, NULL, NULL),
(73, 4, 40, 4, 75, 5, NULL, NULL),
(74, 4, 41, 4, 90, 6, NULL, NULL),
(75, 4, 38, 4, 45, 2, NULL, NULL),
(76, 4, 34, 5, 45, 3, NULL, NULL),
(77, 4, 52, 5, 75, 5, NULL, NULL),
(78, 4, 53, 5, 45, 3, NULL, NULL),
(79, 4, 54, 5, 30, 2, NULL, NULL),
(80, 4, 55, 5, 45, 3, NULL, NULL),
(81, 4, 56, 5, 75, 5, NULL, NULL),
(82, 4, 57, 5, 90, 6, NULL, NULL),
(83, 4, 48, 5, 75, 5, NULL, NULL),
(84, 4, 63, 6, 30, 2, NULL, NULL),
(85, 4, 59, 6, NULL, 4, NULL, NULL),
(86, 4, 60, 6, NULL, 4, NULL, NULL),
(87, 4, 61, 6, NULL, NULL, NULL, NULL),
(88, 1, 1, 7, 75, 5, NULL, NULL),
(89, 1, 2, 7, 30, 1, NULL, NULL),
(90, 1, 3, 7, 30, 2, NULL, NULL),
(91, 1, 4, 7, 45, 3, NULL, NULL),
(92, 1, 5, 7, 45, 3, NULL, NULL),
(93, 1, 6, 7, 45, 3, NULL, NULL),
(94, 1, 7, 7, 75, 5, NULL, NULL),
(95, 1, 8, 7, 45, 3, NULL, NULL),
(96, 1, 9, 7, 45, 2, NULL, NULL),
(97, 1, 10, 7, 90, 2, NULL, NULL),
(98, 1, 11, 8, 75, 5, NULL, NULL),
(99, 1, 12, 8, 30, 1, NULL, NULL),
(100, 1, 13, 8, 60, 4, NULL, NULL),
(101, 1, 14, 8, 75, 5, NULL, NULL),
(102, 1, 15, 8, 45, 3, NULL, NULL),
(103, 1, 16, 8, 45, 3, NULL, NULL),
(104, 1, 17, 8, 45, 3, NULL, NULL),
(105, 1, 18, 8, 45, 2, NULL, NULL),
(106, 1, 19, 8, 45, 2, NULL, NULL),
(107, 1, 20, 8, 45, 2, NULL, NULL),
(108, 1, 21, 9, 135, 2, NULL, NULL),
(109, 1, 22, 9, 45, 3, NULL, NULL),
(110, 1, 23, 9, 75, 5, NULL, NULL),
(111, 1, 24, 9, 30, 2, NULL, NULL),
(112, 1, 25, 9, 45, 3, NULL, NULL),
(113, 1, 26, 9, 45, 3, NULL, NULL),
(114, 1, 27, 9, 45, 3, NULL, NULL),
(115, 1, 28, 9, 45, 2, NULL, NULL),
(116, 1, 29, 9, 45, 2, NULL, NULL),
(117, 1, 30, 9, 45, 2, NULL, NULL),
(118, 2, 31, 10, 45, 3, NULL, NULL),
(119, 2, 32, 10, 45, 3, NULL, NULL),
(120, 2, 33, 10, 75, 5, NULL, NULL),
(121, 2, 34, 10, 45, 3, NULL, NULL),
(122, 2, 35, 10, 60, 4, NULL, NULL),
(123, 2, 36, 10, 45, 3, NULL, NULL),
(124, 2, 37, 10, 45, 3, NULL, NULL),
(125, 2, 38, 10, 45, 2, NULL, NULL),
(126, 2, 42, 11, 45, 3, NULL, NULL),
(127, 2, 43, 11, 60, 4, NULL, NULL),
(128, 2, 44, 11, 60, 4, NULL, NULL),
(129, 2, 45, 11, 90, 6, NULL, NULL),
(130, 2, 46, 11, 90, 6, NULL, NULL),
(131, 2, 47, 11, 75, 5, NULL, NULL),
(132, 2, 48, 11, 75, 5, NULL, NULL),
(133, 2, 58, 12, 30, 2, NULL, NULL),
(134, 2, 59, 12, NULL, 4, NULL, NULL),
(135, 2, 60, 12, NULL, 4, NULL, NULL),
(136, 2, 61, 12, NULL, NULL, NULL, NULL),
(137, 3, 31, 10, 45, 3, NULL, NULL),
(138, 3, 32, 10, 45, 3, NULL, NULL),
(139, 3, 33, 10, 75, 5, NULL, NULL),
(140, 3, 34, 10, 45, 3, NULL, NULL),
(141, 3, 35, 10, 60, 4, NULL, NULL),
(142, 3, 36, 10, 45, 3, NULL, NULL),
(143, 3, 37, 10, 45, 3, NULL, NULL),
(144, 3, 38, 10, 45, 2, NULL, NULL),
(145, 3, 42, 11, 45, 3, NULL, NULL),
(146, 3, 43, 11, 60, 4, NULL, NULL),
(147, 3, 44, 11, 60, 4, NULL, NULL),
(148, 3, 49, 11, 90, 6, NULL, NULL),
(149, 3, 50, 11, 75, 5, NULL, NULL),
(150, 3, 51, 11, 90, 6, NULL, NULL),
(151, 3, 48, 11, 75, 5, NULL, NULL),
(152, 3, 62, 12, 30, 2, NULL, NULL),
(153, 3, 59, 12, NULL, 4, NULL, NULL),
(154, 3, 60, 12, NULL, 4, NULL, NULL),
(155, 3, 61, 12, NULL, NULL, NULL, NULL),
(156, 4, 31, 10, 45, 3, NULL, NULL),
(157, 4, 32, 10, 45, 3, NULL, NULL),
(158, 4, 33, 10, 75, 5, NULL, NULL),
(159, 4, 39, 10, 45, 3, NULL, NULL),
(160, 4, 40, 10, 75, 5, NULL, NULL),
(161, 4, 41, 10, 90, 6, NULL, NULL),
(162, 4, 38, 10, 45, 2, NULL, NULL),
(163, 4, 34, 11, 45, 3, NULL, NULL),
(164, 4, 52, 11, 75, 5, NULL, NULL),
(165, 4, 53, 11, 45, 3, NULL, NULL),
(166, 4, 54, 11, 30, 2, NULL, NULL),
(167, 4, 55, 11, 45, 3, NULL, NULL),
(168, 4, 56, 11, 75, 5, NULL, NULL),
(169, 4, 57, 11, 90, 6, NULL, NULL),
(170, 4, 48, 11, 75, 5, NULL, NULL),
(171, 4, 63, 12, 30, 2, NULL, NULL),
(172, 4, 59, 12, NULL, 4, NULL, NULL),
(173, 4, 60, 12, NULL, 4, NULL, NULL),
(174, 4, 61, 12, NULL, NULL, NULL, NULL),
(175, 1, 1, 13, 75, 5, NULL, NULL),
(176, 1, 2, 13, 30, 1, NULL, NULL),
(177, 1, 3, 13, 30, 2, NULL, NULL),
(178, 1, 4, 13, 45, 3, NULL, NULL),
(179, 1, 5, 13, 45, 3, NULL, NULL),
(180, 1, 6, 13, 45, 3, NULL, NULL),
(181, 1, 7, 13, 75, 5, NULL, NULL),
(182, 1, 8, 13, 45, 3, NULL, NULL),
(183, 1, 9, 13, 45, 2, NULL, NULL),
(184, 1, 10, 13, 90, 2, NULL, NULL),
(185, 1, 11, 14, 75, 5, NULL, NULL),
(186, 1, 12, 14, 30, 1, NULL, NULL),
(187, 1, 13, 14, 60, 4, NULL, NULL),
(188, 1, 14, 14, 75, 5, NULL, NULL),
(189, 1, 15, 14, 45, 3, NULL, NULL),
(190, 1, 16, 14, 45, 3, NULL, NULL),
(191, 1, 17, 14, 45, 3, NULL, NULL),
(192, 1, 18, 14, 45, 2, NULL, NULL),
(193, 1, 19, 14, 45, 2, NULL, NULL),
(194, 1, 20, 14, 45, 2, NULL, NULL),
(195, 1, 21, 15, 135, 2, NULL, NULL),
(196, 1, 22, 15, 45, 3, NULL, NULL),
(197, 1, 23, 15, 75, 5, NULL, NULL),
(198, 1, 24, 15, 30, 2, NULL, NULL),
(199, 1, 25, 15, 45, 3, NULL, NULL),
(200, 1, 26, 15, 45, 3, NULL, NULL),
(201, 1, 27, 15, 45, 3, NULL, NULL),
(202, 1, 28, 15, 45, 2, NULL, NULL),
(203, 1, 29, 15, 45, 2, NULL, NULL),
(204, 1, 30, 15, 45, 2, NULL, NULL),
(205, 2, 31, 16, 45, 3, NULL, NULL),
(206, 2, 32, 16, 45, 3, NULL, NULL),
(207, 2, 33, 16, 75, 5, NULL, NULL),
(208, 2, 34, 16, 45, 3, NULL, NULL),
(209, 2, 35, 16, 60, 4, NULL, NULL),
(210, 2, 36, 16, 45, 3, NULL, NULL),
(211, 2, 37, 16, 45, 3, NULL, NULL),
(212, 2, 38, 16, 45, 2, NULL, NULL),
(213, 2, 42, 17, 45, 3, NULL, NULL),
(214, 2, 43, 17, 60, 4, NULL, NULL),
(215, 2, 44, 17, 60, 4, NULL, NULL),
(216, 2, 45, 17, 90, 6, NULL, NULL),
(217, 2, 46, 17, 90, 6, NULL, NULL),
(218, 2, 47, 17, 75, 5, NULL, NULL),
(219, 2, 48, 17, 75, 5, NULL, NULL),
(220, 2, 58, 18, 30, 2, NULL, NULL),
(221, 2, 59, 18, NULL, 4, NULL, NULL),
(222, 2, 60, 18, NULL, 4, NULL, NULL),
(223, 2, 61, 18, NULL, NULL, NULL, NULL),
(224, 3, 31, 16, 45, 3, NULL, NULL),
(225, 3, 32, 16, 45, 3, NULL, NULL),
(226, 3, 33, 16, 75, 5, NULL, NULL),
(227, 3, 34, 16, 45, 3, NULL, NULL),
(228, 3, 35, 16, 60, 4, NULL, NULL),
(229, 3, 36, 16, 45, 3, NULL, NULL),
(230, 3, 37, 16, 45, 3, NULL, NULL),
(231, 3, 38, 16, 45, 2, NULL, NULL),
(232, 3, 42, 17, 45, 3, NULL, NULL),
(233, 3, 43, 17, 60, 4, NULL, NULL),
(234, 3, 44, 17, 60, 4, NULL, NULL),
(235, 3, 49, 17, 90, 6, NULL, NULL),
(236, 3, 50, 17, 75, 5, NULL, NULL),
(237, 3, 51, 17, 90, 6, NULL, NULL),
(238, 3, 48, 17, 75, 5, NULL, NULL),
(239, 3, 62, 18, 30, 2, NULL, NULL),
(240, 3, 59, 18, NULL, 4, NULL, NULL),
(241, 3, 60, 18, NULL, 4, NULL, NULL),
(242, 3, 61, 18, NULL, NULL, NULL, NULL),
(243, 4, 31, 16, 45, 3, NULL, NULL),
(244, 4, 32, 16, 45, 3, NULL, NULL),
(245, 4, 33, 16, 75, 5, NULL, NULL),
(246, 4, 39, 16, 45, 3, NULL, NULL),
(247, 4, 40, 16, 75, 5, NULL, NULL),
(248, 4, 41, 16, 90, 6, NULL, NULL),
(249, 4, 38, 16, 45, 2, NULL, NULL),
(250, 4, 34, 17, 45, 3, NULL, NULL),
(251, 4, 52, 17, 75, 5, NULL, NULL),
(252, 4, 53, 17, 45, 3, NULL, NULL),
(253, 4, 54, 17, 30, 2, NULL, NULL),
(254, 4, 55, 17, 45, 3, NULL, NULL),
(255, 4, 56, 17, 75, 5, NULL, NULL),
(256, 4, 57, 17, 90, 6, NULL, NULL),
(257, 4, 48, 17, 75, 5, NULL, NULL),
(258, 4, 63, 18, 30, 2, NULL, NULL),
(259, 4, 59, 18, NULL, 4, NULL, NULL),
(260, 4, 60, 18, NULL, 4, NULL, NULL),
(261, 4, 61, 18, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_thong_bao`
--

CREATE TABLE `chi_tiet_thong_bao` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_thong_bao` bigint(20) UNSIGNED NOT NULL,
  `id_sinh_vien` bigint(20) UNSIGNED NOT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chuong_trinh_dao_tao`
--

CREATE TABLE `chuong_trinh_dao_tao` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_chuyen_nganh` bigint(20) UNSIGNED NOT NULL,
  `ten_chuong_trinh_dao_tao` varchar(100) NOT NULL,
  `tong_tin_chi` int(11) NOT NULL DEFAULT 0,
  `trang_thai` int(11) NOT NULL DEFAULT 0,
  `thoi_gian` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chuong_trinh_dao_tao`
--

INSERT INTO `chuong_trinh_dao_tao` (`id`, `id_chuyen_nganh`, `ten_chuong_trinh_dao_tao`, `tong_tin_chi`, `trang_thai`, `thoi_gian`, `created_at`, `updated_at`) VALUES
(1, 1, 'Công nghệ thông tin', 153, 0, 3, NULL, NULL),
(2, 2, 'Chương trình đào tạo Lập trình Website', 153, 0, 3, NULL, NULL),
(3, 3, 'Chương trình đào tạo Lập trình Di động', 150, 0, 3, NULL, NULL),
(4, 4, 'Chương trình đào tạo Mạng máy tính', 160, 0, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chuyen_nganh`
--

CREATE TABLE `chuyen_nganh` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten_chuyen_nganh` varchar(100) NOT NULL,
  `id_khoa` bigint(20) UNSIGNED NOT NULL,
  `id_chuyen_nganh_cha` bigint(20) UNSIGNED DEFAULT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chuyen_nganh`
--

INSERT INTO `chuyen_nganh` (`id`, `ten_chuyen_nganh`, `id_khoa`, `id_chuyen_nganh_cha`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, 'Công nghệ thông tin', 1, NULL, 0, NULL, NULL),
(2, 'Lập trình Website', 1, 1, 0, NULL, NULL),
(3, 'Lập trình Di động', 1, 1, 0, NULL, NULL),
(4, 'Mạng máy tính', 1, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dang_ky_giay`
--

CREATE TABLE `dang_ky_giay` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_sinh_vien` bigint(20) UNSIGNED NOT NULL,
  `id_giang_vien` bigint(20) UNSIGNED DEFAULT NULL,
  `id_loai_giay` bigint(20) UNSIGNED NOT NULL,
  `ngay_dang_ky` date NOT NULL,
  `ngay_nhan` date DEFAULT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dang_ky_giay`
--

INSERT INTO `dang_ky_giay` (`id`, `id_sinh_vien`, `id_giang_vien`, `id_loai_giay`, `ngay_dang_ky`, `ngay_nhan`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2025-07-11', '2025-06-10', 1, NULL, NULL),
(2, 1, NULL, 1, '2025-07-11', '2025-06-10', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dang_ky_hg_tl`
--

CREATE TABLE `dang_ky_hg_tl` (
  `id_sinh_vien` bigint(20) UNSIGNED NOT NULL,
  `id_lop_hoc_phan` bigint(20) UNSIGNED NOT NULL,
  `so_tien` double NOT NULL DEFAULT 0,
  `loai_dong` int(11) NOT NULL DEFAULT 0,
  `trang_thai` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dang_ky_hg_tl`
--

INSERT INTO `dang_ky_hg_tl` (`id_sinh_vien`, `id_lop_hoc_phan`, `so_tien`, `loai_dong`, `trang_thai`, `created_at`, `updated_at`) VALUES
(17, 3, 50000, 1, 1, '2025-07-11 21:54:50', '2025-07-11 21:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `danh_sach_hoc_phan`
--

CREATE TABLE `danh_sach_hoc_phan` (
  `id_sinh_vien` bigint(20) UNSIGNED NOT NULL,
  `id_lop_hoc_phan` bigint(20) UNSIGNED NOT NULL,
  `diem_md_thuc_hanh` double DEFAULT NULL,
  `diem_md_ly_thuyet` double DEFAULT NULL,
  `diem_chuyen_can` double DEFAULT NULL,
  `diem_qua_trinh` double DEFAULT NULL,
  `diem_thi_lan_1` double DEFAULT NULL,
  `diem_thi_lan_2` double DEFAULT NULL,
  `diem_tong_ket` double DEFAULT NULL,
  `loai_hoc` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `danh_sach_hoc_phan`
--

INSERT INTO `danh_sach_hoc_phan` (`id_sinh_vien`, `id_lop_hoc_phan`, `diem_md_thuc_hanh`, `diem_md_ly_thuyet`, `diem_chuyen_can`, `diem_qua_trinh`, `diem_thi_lan_1`, `diem_thi_lan_2`, `diem_tong_ket`, `loai_hoc`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 8, 1.6, 2.4, 6.1, 17.3, 0, NULL, NULL),
(2, 1, NULL, NULL, 8, 2.3, 6.7, NULL, 17.7, 0, NULL, NULL),
(3, 1, NULL, NULL, 9, 6.9, 2.3, 7.9, 11.7, 0, NULL, NULL),
(4, 1, NULL, NULL, 8, 6.8, 1.6, 4.6, 18.2, 0, NULL, NULL),
(5, 1, NULL, NULL, 10, 8.4, 7.1, NULL, 14, 0, NULL, NULL),
(17, 3, NULL, NULL, 10, 5.8, 9.3, NULL, 7.6, 0, '2025-07-11 21:21:36', '2025-07-11 21:23:02'),
(18, 3, NULL, NULL, 7, 4.8, 9.8, NULL, 6.1, 0, '2025-07-11 21:21:36', '2025-07-11 21:23:02'),
(23, 3, NULL, NULL, 9, 3.4, 4.8, 3.7, 17.5, 0, '2025-07-11 21:21:36', '2025-07-11 21:23:02'),
(24, 3, NULL, NULL, 7, 3.2, 5.9, NULL, 13.1, 0, '2025-07-11 21:21:36', '2025-07-11 21:23:02'),
(31, 4, NULL, NULL, 7, 4.5, 9.1, NULL, 13, 0, '2025-07-12 18:47:58', '2025-07-12 18:47:58'),
(32, 4, NULL, NULL, 8, 2.1, 5.8, NULL, 11.6, 0, '2025-07-12 18:47:58', '2025-07-12 18:47:58'),
(33, 4, NULL, NULL, 8, 7.9, 1.2, 8.2, 17.3, 0, '2025-07-12 18:47:58', '2025-07-12 18:47:58'),
(34, 4, NULL, NULL, 10, 3.5, 6.4, NULL, 16.7, 0, '2025-07-12 18:47:58', '2025-07-12 18:47:58'),
(35, 4, NULL, NULL, 7, 1, 5.8, NULL, 17.6, 0, '2025-07-12 18:47:58', '2025-07-12 18:47:58'),
(36, 4, NULL, NULL, 9, 6.8, 3.4, 4.6, 21.1, 0, '2025-07-12 18:47:58', '2025-07-12 18:47:58'),
(19, 5, NULL, NULL, 7, 8.4, 5.4, NULL, 6.76, 0, '2025-07-13 19:11:46', '2025-07-13 20:54:02'),
(20, 5, NULL, NULL, 10, 4.8, 2.8, NULL, 6.57, 0, '2025-07-13 19:11:46', '2025-07-13 20:54:02'),
(21, 5, NULL, NULL, 10, 5.6, 7.9, NULL, 7.19, 0, '2025-07-13 19:11:46', '2025-07-13 20:54:02'),
(22, 5, NULL, NULL, 8, 2.8, 2, 9.7, 6.77, 0, '2025-07-13 19:11:46', '2025-07-13 20:54:02'),
(23, 5, NULL, NULL, 8, 5.4, 1.2, 6.6, 6.26, 0, '2025-07-13 19:11:46', '2025-07-13 20:54:02'),
(24, 5, NULL, NULL, 7, 4.3, 7.3, NULL, 6.07, 0, '2025-07-13 19:11:46', '2025-07-13 20:54:02'),
(19, 6, NULL, NULL, 8, 8.2, 8.8, NULL, 8.48, 0, '2025-07-13 19:17:32', '2025-07-13 20:54:16'),
(20, 6, NULL, NULL, 10, 2.1, 8, NULL, 5.84, 0, '2025-07-13 19:17:32', '2025-07-13 20:54:16'),
(21, 6, NULL, NULL, 9, 3.6, 8.9, NULL, 6.79, 0, '2025-07-13 19:17:32', '2025-07-13 20:54:16'),
(22, 6, NULL, NULL, 9, 9.1, 9.8, NULL, 9.44, 0, '2025-07-13 19:17:32', '2025-07-13 20:54:16'),
(23, 6, NULL, NULL, 7, 9.8, 4.2, 8.5, 8.87, 0, '2025-07-13 19:17:32', '2025-07-13 20:54:16'),
(24, 6, NULL, NULL, 7, 9.8, 6.4, NULL, 7.82, 0, '2025-07-13 19:17:32', '2025-07-13 20:54:16'),
(19, 7, NULL, NULL, 7, 6.1, 6.4, NULL, 6.34, 0, '2025-07-13 19:18:04', '2025-07-13 20:52:09'),
(20, 7, NULL, NULL, 8, 6.9, 4.9, NULL, 6.01, 0, '2025-07-13 19:18:04', '2025-07-13 20:52:09'),
(21, 7, NULL, NULL, 9, 7.5, 6.8, NULL, 7.3, 0, '2025-07-13 19:18:04', '2025-07-13 20:52:09'),
(22, 7, NULL, NULL, 7, 3.1, 1.5, 6.1, 4.99, 0, '2025-07-13 19:18:04', '2025-07-13 20:52:09'),
(23, 7, NULL, NULL, 9, 7.7, 6.7, NULL, 7.33, 0, '2025-07-13 19:18:04', '2025-07-13 20:52:09'),
(24, 7, NULL, NULL, 10, 8.2, 2.6, 5.5, 7.03, 0, '2025-07-13 19:18:04', '2025-07-13 20:52:09'),
(19, 8, NULL, NULL, 10, 4.4, 9.7, NULL, 7.61, 0, '2025-07-13 19:18:25', '2025-07-13 20:52:59'),
(20, 8, NULL, NULL, 9, 5.8, 6.3, NULL, 6.37, 0, '2025-07-13 19:18:25', '2025-07-13 20:52:59'),
(21, 8, NULL, NULL, 8, 9.7, 8.1, NULL, 8.73, 0, '2025-07-13 19:18:25', '2025-07-13 20:52:59'),
(22, 8, NULL, NULL, 7, 8.1, 8.8, NULL, 8.34, 0, '2025-07-13 19:18:25', '2025-07-13 20:52:59'),
(23, 8, NULL, NULL, 10, 2.9, 2.7, 3.8, 4.06, 0, '2025-07-13 19:18:25', '2025-07-13 20:52:59'),
(24, 8, NULL, NULL, 10, 9, 5.8, NULL, 7.5, 0, '2025-07-13 19:18:25', '2025-07-13 20:52:59'),
(19, 9, NULL, NULL, 7, 5.8, 6.1, NULL, 6.07, 0, '2025-07-13 19:18:41', '2025-07-13 20:54:35'),
(20, 9, NULL, NULL, 8, 6.1, 1.5, NULL, 6.39, 0, '2025-07-13 19:18:41', '2025-07-13 20:54:35'),
(21, 9, NULL, NULL, 10, 1.3, 9, NULL, 6.02, 0, '2025-07-13 19:18:41', '2025-07-13 20:54:35'),
(22, 9, NULL, NULL, 8, 2.3, 6.7, NULL, 5.07, 0, '2025-07-13 19:18:41', '2025-07-13 20:54:35'),
(23, 9, NULL, NULL, 9, 8.3, 8.5, NULL, 8.47, 0, '2025-07-13 19:18:41', '2025-07-13 20:54:35'),
(24, 9, NULL, NULL, 9, 1.7, 3.4, 1.6, 3.28, 0, '2025-07-13 19:18:41', '2025-07-13 20:54:35'),
(19, 10, NULL, NULL, 9, 5.4, 8.6, NULL, 7.36, 0, '2025-07-13 19:19:07', '2025-07-13 20:54:48'),
(20, 10, NULL, NULL, 10, 3.4, 1.3, NULL, 4.61, 0, '2025-07-13 19:19:07', '2025-07-13 20:54:48'),
(21, 10, NULL, NULL, 10, 9.5, 3.2, 4.7, 7.15, 0, '2025-07-13 19:19:07', '2025-07-13 20:54:48'),
(22, 10, NULL, NULL, 8, 4, 7.7, NULL, 6.25, 0, '2025-07-13 19:19:07', '2025-07-13 20:54:48'),
(23, 10, NULL, NULL, 9, 3.6, 4.2, 9.1, 6.89, 0, '2025-07-13 19:19:07', '2025-07-13 20:54:48'),
(24, 10, NULL, NULL, 8, 4.3, 6.4, NULL, 5.72, 0, '2025-07-13 19:19:07', '2025-07-13 20:54:48'),
(19, 11, NULL, NULL, 10, 6.6, 5.4, NULL, 6.34, 0, '2025-07-13 19:20:03', '2025-07-13 20:55:01'),
(20, 11, NULL, NULL, 9, 4, 1.1, NULL, 3.05, 0, '2025-07-13 19:20:03', '2025-07-13 20:55:01'),
(21, 11, NULL, NULL, 7, 3.3, 1.7, 6.8, 5.42, 0, '2025-07-13 19:20:03', '2025-07-13 20:55:01'),
(22, 11, NULL, NULL, 10, 9, 6.1, NULL, 7.65, 0, '2025-07-13 19:20:03', '2025-07-13 20:55:01'),
(23, 11, NULL, NULL, 7, 2, 1.5, 9.4, 6.2, 0, '2025-07-13 19:20:03', '2025-07-13 20:55:01'),
(24, 11, NULL, NULL, 9, 8.4, 5.7, NULL, 7.11, 0, '2025-07-13 19:20:03', '2025-07-13 20:55:01'),
(19, 12, NULL, NULL, 7, 3.3, 8, NULL, 6.02, 0, '2025-07-13 19:20:37', '2025-07-13 20:55:15'),
(20, 12, NULL, NULL, 7, 4.4, 5.2, NULL, 5.06, 0, '2025-07-13 19:20:37', '2025-07-13 20:55:15'),
(21, 12, NULL, NULL, 7, 6.5, 4.9, 4, 5.75, 0, '2025-07-13 19:20:37', '2025-07-13 20:55:15'),
(22, 12, NULL, NULL, 8, 9.4, 5.4, NULL, 7.26, 0, '2025-07-13 19:20:37', '2025-07-13 20:55:15'),
(23, 12, NULL, NULL, 9, 8.2, 1.2, 7.4, 7.88, 0, '2025-07-13 19:20:37', '2025-07-13 20:55:15'),
(24, 12, NULL, NULL, 8, 3.7, 1.5, 4.3, 4.43, 0, '2025-07-13 19:20:37', '2025-07-13 20:55:15'),
(19, 13, NULL, NULL, 9, 3.4, 3.8, 7.9, 6.21, 0, '2025-07-13 19:20:58', '2025-07-13 20:55:28'),
(20, 13, NULL, NULL, 10, 3.2, 5.5, NULL, 5.03, 0, '2025-07-13 19:20:58', '2025-07-13 20:55:28'),
(21, 13, NULL, NULL, 10, 4.1, 4.5, 9.4, 7.34, 0, '2025-07-13 19:20:58', '2025-07-13 20:55:28'),
(22, 13, NULL, NULL, 8, 6.7, 7.4, NULL, 7.18, 0, '2025-07-13 19:20:58', '2025-07-13 20:55:28'),
(23, 13, NULL, NULL, 9, 1.8, 5.7, NULL, 4.47, 0, '2025-07-13 19:20:58', '2025-07-13 20:55:28'),
(24, 13, NULL, NULL, 8, 1.9, 5.6, NULL, 4.36, 0, '2025-07-13 19:20:58', '2025-07-13 20:55:28'),
(19, 14, NULL, NULL, 7, 7.2, 7.4, NULL, 7.28, 0, '2025-07-13 19:25:39', '2025-07-13 20:55:39'),
(20, 14, NULL, NULL, 8, 3.2, 8, NULL, 6.08, 0, '2025-07-13 19:25:39', '2025-07-13 20:55:39'),
(21, 14, NULL, NULL, 7, 6.1, 3.7, 8, 7.14, 0, '2025-07-13 19:25:39', '2025-07-13 20:55:39'),
(22, 14, NULL, NULL, 10, 6.8, 3.1, 3.3, 5.37, 0, '2025-07-13 19:25:39', '2025-07-13 20:55:39'),
(23, 14, NULL, NULL, 9, 2.2, 9.2, NULL, 6.38, 0, '2025-07-13 19:25:39', '2025-07-13 20:55:39'),
(24, 14, NULL, NULL, 7, 1.1, 6.7, NULL, 4.49, 0, '2025-07-13 19:25:39', '2025-07-13 20:55:39'),
(19, 15, NULL, NULL, 7, 7, 9.9, NULL, 8.45, 0, '2025-07-13 19:27:08', '2025-07-13 21:05:27'),
(20, 15, NULL, NULL, 10, 8.2, 2.4, NULL, 5.48, 0, '2025-07-13 19:27:08', '2025-07-13 21:05:27'),
(21, 15, NULL, NULL, 8, 5.2, 4.9, 7.9, 6.83, 0, '2025-07-13 19:27:08', '2025-07-13 21:05:27'),
(22, 15, NULL, NULL, 9, 4.1, 2.1, 6.1, 5.59, 0, '2025-07-13 19:27:08', '2025-07-13 21:05:27'),
(23, 15, NULL, NULL, 8, 7.2, 1.2, 1.2, 4.28, 0, '2025-07-13 19:27:08', '2025-07-13 21:05:27'),
(24, 15, NULL, NULL, 7, 2.7, 8.1, NULL, 5.83, 0, '2025-07-13 19:27:08', '2025-07-13 21:05:27'),
(19, 16, NULL, NULL, 8, 5.6, 5, NULL, 5.54, 0, '2025-07-13 19:27:56', '2025-07-13 20:55:59'),
(20, 16, NULL, NULL, 9, 9.8, 9.2, NULL, 9.42, 0, '2025-07-13 19:27:56', '2025-07-13 20:55:59'),
(21, 16, NULL, NULL, 9, 4.7, 2.3, 5.5, 5.53, 0, '2025-07-13 19:27:56', '2025-07-13 20:55:59'),
(22, 16, NULL, NULL, 7, 7.7, 6.4, NULL, 6.98, 0, '2025-07-13 19:27:56', '2025-07-13 20:55:59'),
(23, 16, NULL, NULL, 10, 1.6, 9.9, NULL, 6.59, 0, '2025-07-13 19:27:56', '2025-07-13 20:55:59'),
(24, 16, NULL, NULL, 10, 8.5, 9.1, NULL, 8.95, 0, '2025-07-13 19:27:56', '2025-07-13 20:55:59'),
(19, 17, NULL, NULL, 10, 2.3, 8.6, NULL, 6.22, 0, '2025-07-13 19:28:41', '2025-07-13 20:58:32'),
(20, 17, NULL, NULL, 10, 4.2, 5, NULL, 5.18, 0, '2025-07-13 19:28:41', '2025-07-13 20:58:32'),
(21, 17, NULL, NULL, 7, 4.2, 4.6, 9.1, 6.93, 0, '2025-07-13 19:28:41', '2025-07-13 20:58:32'),
(22, 17, NULL, NULL, 8, 7.7, 9, NULL, 8.38, 0, '2025-07-13 19:28:41', '2025-07-13 20:58:32'),
(23, 17, NULL, NULL, 7, 3.6, 8.7, NULL, 6.49, 0, '2025-07-13 19:28:41', '2025-07-13 20:58:32'),
(24, 17, NULL, NULL, 8, 6.7, 8.5, NULL, 7.73, 0, '2025-07-13 19:28:41', '2025-07-13 20:58:32'),
(19, 18, NULL, NULL, 8, 8.7, 5.3, NULL, 6.93, 0, '2025-07-13 19:29:23', '2025-07-13 20:58:42'),
(20, 18, NULL, NULL, 10, 6.8, 8.2, NULL, 7.82, 0, '2025-07-13 19:29:23', '2025-07-13 20:58:42'),
(21, 18, NULL, NULL, 7, 7.7, 7, NULL, 7.28, 0, '2025-07-13 19:29:23', '2025-07-13 20:58:42'),
(22, 18, NULL, NULL, 7, 4.8, 8.7, NULL, 6.97, 0, '2025-07-13 19:29:23', '2025-07-13 20:58:42'),
(23, 18, NULL, NULL, 10, 4.9, 2.7, 6.7, 6.31, 0, '2025-07-13 19:29:23', '2025-07-13 20:58:42'),
(24, 18, NULL, NULL, 9, 2.7, 1.8, 8.7, 6.33, 0, '2025-07-13 19:29:23', '2025-07-13 20:58:42'),
(19, 19, NULL, NULL, 7, 5.3, 4.2, 4.1, 4.92, 0, '2025-07-13 19:30:25', '2025-07-13 21:05:16'),
(20, 19, NULL, NULL, 9, 4.4, 8.3, NULL, 6.81, 0, '2025-07-13 19:30:25', '2025-07-13 21:05:16'),
(21, 19, NULL, NULL, 10, 3.4, 5.5, NULL, 5.11, 0, '2025-07-13 19:30:25', '2025-07-13 21:05:16'),
(22, 19, NULL, NULL, 9, 10, 9, NULL, 9.4, 0, '2025-07-13 19:30:25', '2025-07-13 21:05:16'),
(23, 19, NULL, NULL, 8, 5.9, 4.6, 4.2, 5.46, 0, '2025-07-13 19:30:25', '2025-07-13 21:05:16'),
(24, 19, NULL, NULL, 9, 9.1, 7.5, NULL, 8.29, 0, '2025-07-13 19:30:25', '2025-07-13 21:05:16'),
(19, 20, NULL, NULL, 10, 3.7, 5, NULL, 4.98, 0, '2025-07-13 19:30:43', '2025-07-13 21:04:50'),
(20, 20, NULL, NULL, 7, 3.7, 1.6, NULL, 2.98, 0, '2025-07-13 19:30:43', '2025-07-13 21:04:50'),
(21, 20, NULL, NULL, 10, 5.8, 7.8, NULL, 7.22, 0, '2025-07-13 19:30:43', '2025-07-13 21:04:50'),
(22, 20, NULL, NULL, 7, 7.1, 8.4, NULL, 7.74, 0, '2025-07-13 19:30:43', '2025-07-13 21:04:50'),
(23, 20, NULL, NULL, 7, 9.6, 5.7, NULL, 7.39, 0, '2025-07-13 19:30:43', '2025-07-13 21:04:50'),
(24, 20, NULL, NULL, 9, 1.6, 2.6, NULL, 2.84, 0, '2025-07-13 19:30:43', '2025-07-13 21:04:50'),
(19, 21, NULL, NULL, 10, 8.5, 8.9, NULL, 8.85, 0, '2025-07-13 19:31:24', '2025-07-13 20:57:42'),
(20, 21, NULL, NULL, 10, 9.4, 9.2, NULL, 9.36, 0, '2025-07-13 19:31:24', '2025-07-13 20:57:42'),
(21, 21, NULL, NULL, 10, 1.7, 2, 3.9, 3.63, 0, '2025-07-13 19:31:24', '2025-07-13 20:57:42'),
(22, 21, NULL, NULL, 8, 4.2, 1.1, 9.7, 7.33, 0, '2025-07-13 19:31:24', '2025-07-13 20:57:42'),
(23, 21, NULL, NULL, 10, 1.4, 8.8, NULL, 5.96, 0, '2025-07-13 19:31:24', '2025-07-13 20:57:42'),
(24, 21, NULL, NULL, 7, 4.5, 4.3, 7.1, 6.05, 0, '2025-07-13 19:31:24', '2025-07-13 20:57:42'),
(19, 22, NULL, NULL, 8, 4.2, 9.6, NULL, 7.28, 0, '2025-07-13 19:35:34', '2025-07-13 20:57:36'),
(20, 22, NULL, NULL, 9, 6.9, 2.5, NULL, 8.01, 0, '2025-07-13 19:35:34', '2025-07-13 20:57:36'),
(21, 22, NULL, NULL, 10, 3.9, 3.7, 5.6, 5.36, 0, '2025-07-13 19:35:34', '2025-07-13 20:57:36'),
(22, 22, NULL, NULL, 9, 7.9, 8.7, NULL, 8.41, 0, '2025-07-13 19:35:34', '2025-07-13 20:57:36'),
(23, 22, NULL, NULL, 10, 3, 3.3, 6.6, 5.5, 0, '2025-07-13 19:35:34', '2025-07-13 20:57:36'),
(24, 22, NULL, NULL, 8, 8, 9.1, NULL, 8.55, 0, '2025-07-13 19:35:34', '2025-07-13 20:57:36'),
(19, 23, NULL, NULL, 7, 3, 5.8, NULL, 4.8, 0, '2025-07-13 19:35:57', '2025-07-13 20:57:32'),
(20, 23, NULL, NULL, 7, 5.5, 5.1, NULL, 5.45, 0, '2025-07-13 19:35:57', '2025-07-13 20:57:32'),
(21, 23, NULL, NULL, 10, 5.7, 3.3, 7.3, 6.93, 0, '2025-07-13 19:35:57', '2025-07-13 20:57:32'),
(22, 23, NULL, NULL, 10, 7.7, 4.6, 7.8, 7.98, 0, '2025-07-13 19:35:57', '2025-07-13 20:57:32'),
(23, 23, NULL, NULL, 9, 6.2, 2.7, 2.9, 4.83, 0, '2025-07-13 19:35:57', '2025-07-13 20:57:32'),
(24, 23, NULL, NULL, 8, 7.9, 4.6, 7.4, 7.66, 0, '2025-07-13 19:35:57', '2025-07-13 20:57:32'),
(19, 24, NULL, NULL, 8, 6.8, 2.2, 7.7, 7.37, 0, '2025-07-13 19:36:18', '2025-07-13 20:57:27'),
(20, 24, NULL, NULL, 8, 4.5, 9.6, NULL, 7.4, 0, '2025-07-13 19:36:18', '2025-07-13 20:57:27'),
(21, 24, NULL, NULL, 9, 2.6, 1.8, 9.1, 6.49, 0, '2025-07-13 19:36:18', '2025-07-13 20:57:27'),
(22, 24, NULL, NULL, 7, 5.8, 9.3, NULL, 7.67, 0, '2025-07-13 19:36:18', '2025-07-13 20:57:27'),
(23, 24, NULL, NULL, 10, 2.7, 9.8, NULL, 6.98, 0, '2025-07-13 19:36:18', '2025-07-13 20:57:27'),
(24, 24, NULL, NULL, 8, 7, 4.3, 8.4, 7.8, 0, '2025-07-13 19:36:18', '2025-07-13 20:57:27'),
(19, 25, NULL, NULL, 7, 6.1, 8.2, NULL, 7.24, 0, '2025-07-13 19:37:15', '2025-07-13 20:57:23'),
(20, 25, NULL, NULL, 8, 3.1, 2.7, NULL, 3.59, 0, '2025-07-13 19:37:15', '2025-07-13 20:57:23'),
(21, 25, NULL, NULL, 9, 3.6, 6.7, NULL, 5.69, 0, '2025-07-13 19:37:15', '2025-07-13 20:57:23'),
(22, 25, NULL, NULL, 8, 7.5, 6.7, NULL, 7.15, 0, '2025-07-13 19:37:15', '2025-07-13 20:57:23'),
(23, 25, NULL, NULL, 10, 1.1, 2.1, 6.1, 4.49, 0, '2025-07-13 19:37:15', '2025-07-13 20:57:23'),
(24, 25, NULL, NULL, 8, 7.1, 9.6, NULL, 8.44, 0, '2025-07-13 19:37:15', '2025-07-13 20:57:23'),
(19, 26, NULL, NULL, 10, 9.7, 5.7, NULL, 7.73, 0, '2025-07-13 19:37:43', '2025-07-13 20:57:18'),
(20, 26, NULL, NULL, 9, 1.5, 2, NULL, 3.65, 0, '2025-07-13 19:37:43', '2025-07-13 20:57:18'),
(21, 26, NULL, NULL, 9, 5.9, 2, 9.2, 7.86, 0, '2025-07-13 19:37:43', '2025-07-13 20:57:18'),
(22, 26, NULL, NULL, 7, 5, 5.4, NULL, 5.4, 0, '2025-07-13 19:37:43', '2025-07-13 20:57:18'),
(23, 26, NULL, NULL, 7, 3.5, 9.4, NULL, 6.8, 0, '2025-07-13 19:37:43', '2025-07-13 20:57:18'),
(24, 26, NULL, NULL, 10, 4.2, 3.6, 4.6, 4.98, 0, '2025-07-13 19:37:43', '2025-07-13 20:57:18'),
(19, 27, NULL, NULL, 7, 3.6, 2.4, 9, 6.64, 0, '2025-07-13 19:38:48', '2025-07-13 20:57:13'),
(20, 27, NULL, NULL, 7, 4.4, 8.8, NULL, 6.86, 0, '2025-07-13 19:38:48', '2025-07-13 20:57:13'),
(21, 27, NULL, NULL, 7, 3.7, 9.8, NULL, 7.08, 0, '2025-07-13 19:38:48', '2025-07-13 20:57:13'),
(22, 27, NULL, NULL, 10, 9.2, 6.7, NULL, 8.03, 0, '2025-07-13 19:38:48', '2025-07-13 20:57:13'),
(23, 27, NULL, NULL, 8, 5, 8.2, NULL, 6.9, 0, '2025-07-13 19:38:48', '2025-07-13 20:57:13'),
(24, 27, NULL, NULL, 9, 9.5, 7.3, NULL, 8.35, 0, '2025-07-13 19:38:48', '2025-07-13 20:57:13'),
(19, 28, NULL, NULL, 9, 4.1, 7, NULL, 6.04, 0, '2025-07-13 19:39:04', '2025-07-13 20:57:07'),
(20, 28, NULL, NULL, 8, 4.8, 3.1, NULL, 7.42, 0, '2025-07-13 19:39:04', '2025-07-13 20:57:07'),
(21, 28, NULL, NULL, 10, 1.4, 4, 5.5, 4.31, 0, '2025-07-13 19:39:04', '2025-07-13 20:57:07'),
(22, 28, NULL, NULL, 9, 2, 10, NULL, 6.7, 0, '2025-07-13 19:39:04', '2025-07-13 20:57:07'),
(23, 28, NULL, NULL, 9, 3.1, 3.3, 6, 5.14, 0, '2025-07-13 19:39:04', '2025-07-13 20:57:07'),
(24, 28, NULL, NULL, 7, 4.8, 1.4, 9.6, 7.42, 0, '2025-07-13 19:39:04', '2025-07-13 20:57:07'),
(13, 29, NULL, NULL, 9, 4.3, 9.1, NULL, 7.17, 0, '2025-07-13 19:40:40', '2025-07-13 20:57:02'),
(14, 29, NULL, NULL, 8, 3.2, 1.4, 5.3, 4.73, 0, '2025-07-13 19:40:40', '2025-07-13 20:57:02'),
(19, 29, NULL, NULL, 8, 9.7, 9.8, NULL, 9.58, 0, '2025-07-13 19:40:40', '2025-07-13 20:57:02'),
(20, 29, NULL, NULL, 10, 9.9, 1.1, NULL, 5.81, 0, '2025-07-13 19:40:40', '2025-07-13 20:57:02'),
(13, 30, NULL, NULL, 8, 5.2, 3.7, 2.2, 4.73, 0, '2025-07-13 19:40:59', '2025-07-13 20:56:55'),
(14, 30, NULL, NULL, 10, 4.9, 8.9, NULL, 7.41, 0, '2025-07-13 19:40:59', '2025-07-13 20:56:55'),
(19, 30, NULL, NULL, 7, 7.1, 3.1, 1.8, 5.09, 0, '2025-07-13 19:40:59', '2025-07-13 20:56:55'),
(20, 30, NULL, NULL, 10, 6.7, 8.2, NULL, 7.78, 0, '2025-07-13 19:40:59', '2025-07-13 20:56:55'),
(13, 31, NULL, NULL, 7, 2.7, 6.1, NULL, 4.83, 0, '2025-07-13 19:41:26', '2025-07-13 21:04:16'),
(14, 31, NULL, NULL, 8, 7.2, 6.7, NULL, 7.03, 0, '2025-07-13 19:41:26', '2025-07-13 21:04:16'),
(19, 31, NULL, NULL, 7, 6.1, 6, NULL, 6.14, 0, '2025-07-13 19:41:26', '2025-07-13 21:04:16'),
(20, 31, NULL, NULL, 7, 7, 2.4, NULL, 4.7, 0, '2025-07-13 19:41:26', '2025-07-13 21:04:16'),
(13, 32, NULL, NULL, 8, 3, 3.2, 5.8, 4.9, 0, '2025-07-13 19:41:40', '2025-07-13 20:56:05'),
(14, 32, NULL, NULL, 10, 1.1, 3.5, 4.4, 3.64, 0, '2025-07-13 19:41:40', '2025-07-13 20:56:05'),
(19, 32, NULL, NULL, 7, 2.1, 5.2, NULL, 4.14, 0, '2025-07-13 19:41:40', '2025-07-13 20:56:05'),
(20, 32, NULL, NULL, 10, 4.7, 2.3, NULL, 5.68, 0, '2025-07-13 19:41:40', '2025-07-13 20:56:05'),
(13, 33, NULL, NULL, 7, 9.9, 6.8, NULL, 8.06, 0, '2025-07-13 19:42:01', '2025-07-13 20:56:11'),
(14, 33, NULL, NULL, 8, 3.9, 8.8, NULL, 6.76, 0, '2025-07-13 19:42:01', '2025-07-13 20:56:11'),
(19, 33, NULL, NULL, 8, 2.3, 7.2, NULL, 5.32, 0, '2025-07-13 19:42:01', '2025-07-13 20:56:11'),
(20, 33, NULL, NULL, 10, 8.8, 4.4, NULL, 6.72, 0, '2025-07-13 19:42:01', '2025-07-13 20:56:11'),
(13, 34, NULL, NULL, 8, 7.5, 6.7, NULL, 7.15, 0, '2025-07-13 19:42:14', '2025-07-13 20:56:51'),
(14, 34, NULL, NULL, 7, 3, 1.5, 6.2, 5, 0, '2025-07-13 19:42:14', '2025-07-13 20:56:51'),
(19, 34, NULL, NULL, 9, 9.5, 5.8, NULL, 7.6, 0, '2025-07-13 19:42:14', '2025-07-13 20:56:51'),
(20, 34, NULL, NULL, 10, 6.4, 5.3, NULL, 6.21, 0, '2025-07-13 19:42:14', '2025-07-13 20:56:51'),
(13, 35, NULL, NULL, 9, 5.9, 9.4, NULL, 7.96, 0, '2025-07-13 19:42:30', '2025-07-13 20:56:37'),
(14, 35, NULL, NULL, 7, 3.5, 4.1, 9, 6.6, 0, '2025-07-13 19:42:30', '2025-07-13 20:56:37'),
(19, 35, NULL, NULL, 8, 3.9, 4.8, 2.5, 4.76, 0, '2025-07-13 19:42:30', '2025-07-13 20:56:37'),
(20, 35, NULL, NULL, 9, 2.5, 3.3, NULL, 5.85, 0, '2025-07-13 19:42:30', '2025-07-13 20:56:37'),
(13, 36, NULL, NULL, 7, 9.8, 7.4, NULL, 8.32, 0, '2025-07-13 19:42:42', '2025-07-13 20:56:15'),
(14, 36, NULL, NULL, 9, 9.6, 9.5, NULL, 9.49, 0, '2025-07-13 19:42:42', '2025-07-13 20:56:15'),
(19, 36, NULL, NULL, 10, 4.7, 5.6, NULL, 5.68, 0, '2025-07-13 19:42:42', '2025-07-13 20:56:15'),
(20, 36, NULL, NULL, 8, 1.3, 3.2, NULL, 2.92, 0, '2025-07-13 19:42:42', '2025-07-13 20:56:15'),
(13, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-07-13 21:21:12', '2025-07-13 21:21:12'),
(14, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-07-13 21:21:12', '2025-07-13 21:21:12'),
(19, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-07-13 21:21:12', '2025-07-13 21:21:12'),
(20, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-07-13 21:21:12', '2025-07-13 21:21:12'),
(25, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-07-13 22:08:21', '2025-07-13 22:08:21'),
(26, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-07-13 22:08:21', '2025-07-13 22:08:21'),
(27, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-07-13 22:08:21', '2025-07-13 22:08:21'),
(28, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-07-13 22:08:21', '2025-07-13 22:08:21'),
(29, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-07-13 22:08:21', '2025-07-13 22:08:21'),
(30, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-07-13 22:08:21', '2025-07-13 22:08:21'),
(25, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-07-13 22:09:45', '2025-07-13 22:09:45'),
(26, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-07-13 22:09:45', '2025-07-13 22:09:45'),
(27, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-07-13 22:09:45', '2025-07-13 22:09:45'),
(28, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-07-13 22:09:45', '2025-07-13 22:09:45'),
(29, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-07-13 22:09:45', '2025-07-13 22:09:45'),
(30, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-07-13 22:09:45', '2025-07-13 22:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `danh_sach_sinh_vien`
--

CREATE TABLE `danh_sach_sinh_vien` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_lop` bigint(20) UNSIGNED NOT NULL,
  `id_sinh_vien` bigint(20) UNSIGNED NOT NULL,
  `chuc_vu` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `danh_sach_sinh_vien`
--

INSERT INTO `danh_sach_sinh_vien` (`id`, `id_lop`, `id_sinh_vien`, `chuc_vu`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL),
(2, 1, 2, 0, NULL, NULL),
(3, 1, 3, 0, NULL, NULL),
(4, 1, 4, 0, NULL, NULL),
(5, 1, 5, 0, NULL, NULL),
(6, 1, 6, 0, NULL, NULL),
(7, 2, 7, 1, NULL, NULL),
(8, 2, 8, 0, NULL, NULL),
(9, 2, 9, 0, NULL, NULL),
(10, 2, 10, 0, NULL, NULL),
(11, 2, 11, 0, NULL, NULL),
(12, 2, 12, 0, NULL, NULL),
(13, 3, 13, 1, NULL, NULL),
(14, 3, 14, 0, NULL, NULL),
(15, 3, 15, 0, NULL, NULL),
(16, 3, 16, 0, NULL, NULL),
(17, 3, 17, 0, NULL, NULL),
(18, 3, 18, 0, NULL, NULL),
(19, 4, 19, 1, NULL, NULL),
(20, 4, 20, 0, NULL, NULL),
(21, 4, 21, 0, NULL, NULL),
(22, 4, 22, 0, NULL, NULL),
(23, 4, 23, 0, NULL, NULL),
(24, 4, 24, 0, NULL, NULL),
(25, 5, 25, 1, NULL, NULL),
(26, 5, 26, 0, NULL, NULL),
(27, 5, 27, 0, NULL, NULL),
(28, 5, 28, 0, NULL, NULL),
(29, 5, 29, 0, NULL, NULL),
(30, 5, 30, 0, NULL, NULL),
(31, 6, 31, 1, NULL, NULL),
(32, 6, 32, 0, NULL, NULL),
(33, 6, 33, 0, NULL, NULL),
(34, 6, 34, 0, NULL, NULL),
(35, 6, 35, 0, NULL, NULL),
(36, 6, 36, 0, NULL, NULL),
(37, 7, 1, 1, NULL, NULL),
(38, 7, 2, 0, NULL, NULL),
(39, 7, 7, 0, NULL, NULL),
(40, 7, 8, 0, NULL, NULL),
(41, 8, 3, 1, NULL, NULL),
(42, 8, 4, 0, NULL, NULL),
(43, 8, 9, 0, NULL, NULL),
(44, 8, 10, 0, NULL, NULL),
(45, 9, 5, 1, NULL, NULL),
(46, 9, 6, 0, NULL, NULL),
(47, 9, 11, 0, NULL, NULL),
(48, 9, 12, 0, NULL, NULL),
(49, 10, 13, 1, NULL, NULL),
(50, 10, 14, 0, NULL, NULL),
(51, 10, 19, 0, NULL, NULL),
(52, 10, 20, 0, NULL, NULL),
(53, 11, 15, 1, NULL, NULL),
(54, 11, 16, 0, NULL, NULL),
(55, 11, 21, 0, NULL, NULL),
(56, 11, 22, 0, NULL, NULL),
(57, 12, 17, 1, NULL, NULL),
(58, 12, 18, 0, NULL, NULL),
(59, 12, 23, 0, NULL, NULL),
(60, 12, 24, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diem_ren_luyen`
--

CREATE TABLE `diem_ren_luyen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_gvcn` bigint(20) UNSIGNED DEFAULT NULL,
  `id_sinh_vien` bigint(20) UNSIGNED NOT NULL,
  `id_nam` bigint(20) UNSIGNED NOT NULL,
  `xep_loai` int(11) NOT NULL DEFAULT 0,
  `thoi_gian` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diem_ren_luyen`
--

INSERT INTO `diem_ren_luyen` (`id`, `id_gvcn`, `id_sinh_vien`, `id_nam`, `xep_loai`, `thoi_gian`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 1, 1, NULL, NULL),
(2, 1, 1, 3, 1, 2, NULL, NULL),
(3, 1, 1, 3, 1, 3, NULL, NULL),
(4, 1, 1, 3, 1, 4, NULL, NULL),
(5, 1, 1, 3, 1, 5, NULL, NULL),
(14, 1, 19, 4, 1, 5, '2025-07-13 18:46:35', '2025-07-13 18:46:35'),
(15, 1, 20, 4, 1, 5, '2025-07-13 18:46:35', '2025-07-13 18:46:35'),
(16, 1, 21, 4, 1, 5, '2025-07-13 18:46:35', '2025-07-13 18:46:35'),
(17, 1, 22, 4, 1, 5, '2025-07-13 18:46:35', '2025-07-13 18:46:35'),
(18, 1, 23, 4, 1, 5, '2025-07-13 18:46:35', '2025-07-13 18:46:35'),
(19, 1, 24, 4, 1, 5, '2025-07-13 18:46:35', '2025-07-13 18:46:35'),
(20, 1, 19, 4, 2, 4, '2025-07-13 18:46:40', '2025-07-13 18:47:05'),
(21, 1, 20, 4, 1, 4, '2025-07-13 18:46:40', '2025-07-13 18:46:40'),
(22, 1, 21, 4, 2, 4, '2025-07-13 18:46:40', '2025-07-13 18:47:03'),
(23, 1, 22, 4, 1, 4, '2025-07-13 18:46:40', '2025-07-13 18:46:40'),
(24, 1, 23, 4, 1, 4, '2025-07-13 18:46:40', '2025-07-13 18:46:40'),
(25, 1, 24, 4, 1, 4, '2025-07-13 18:46:40', '2025-07-13 18:46:40'),
(26, 1, 19, 4, 1, 3, '2025-07-13 18:46:46', '2025-07-13 18:46:46'),
(27, 1, 20, 4, 1, 3, '2025-07-13 18:46:46', '2025-07-13 18:46:46'),
(28, 1, 21, 4, 1, 3, '2025-07-13 18:46:46', '2025-07-13 18:46:46'),
(29, 1, 22, 4, 1, 3, '2025-07-13 18:46:46', '2025-07-13 18:46:46'),
(30, 1, 23, 4, 1, 3, '2025-07-13 18:46:46', '2025-07-13 18:46:46'),
(31, 1, 24, 4, 1, 3, '2025-07-13 18:46:46', '2025-07-13 18:46:46'),
(32, 1, 19, 4, 1, 2, '2025-07-13 18:46:53', '2025-07-13 18:46:53'),
(33, 1, 20, 4, 1, 2, '2025-07-13 18:46:53', '2025-07-13 18:46:53'),
(34, 1, 21, 4, 3, 2, '2025-07-13 18:46:53', '2025-07-13 18:46:55'),
(35, 1, 22, 4, 1, 2, '2025-07-13 18:46:53', '2025-07-13 18:46:53'),
(36, 1, 23, 4, 2, 2, '2025-07-13 18:46:53', '2025-07-13 18:46:59'),
(37, 1, 24, 4, 1, 2, '2025-07-13 18:46:53', '2025-07-13 18:46:53'),
(38, 1, 19, 4, 1, 1, '2025-07-13 18:47:16', '2025-07-13 18:47:16'),
(39, 1, 20, 4, 1, 1, '2025-07-13 18:47:16', '2025-07-13 18:47:16'),
(40, 1, 21, 4, 1, 1, '2025-07-13 18:47:16', '2025-07-13 18:47:16'),
(41, 1, 22, 4, 1, 1, '2025-07-13 18:47:16', '2025-07-13 18:47:16'),
(42, 1, 23, 4, 1, 1, '2025-07-13 18:47:16', '2025-07-13 18:47:16'),
(43, 1, 24, 4, 1, 1, '2025-07-13 18:47:16', '2025-07-13 18:47:16'),
(44, 1, 19, 3, 1, 12, '2025-07-13 18:47:27', '2025-07-13 18:47:27'),
(45, 1, 20, 3, 1, 12, '2025-07-13 18:47:27', '2025-07-13 18:47:27'),
(46, 1, 21, 3, 1, 12, '2025-07-13 18:47:27', '2025-07-13 18:47:27'),
(47, 1, 22, 3, 1, 12, '2025-07-13 18:47:27', '2025-07-13 18:47:27'),
(48, 1, 23, 3, 1, 12, '2025-07-13 18:47:27', '2025-07-13 18:47:27'),
(49, 1, 24, 3, 1, 12, '2025-07-13 18:47:27', '2025-07-13 18:47:27'),
(50, 1, 19, 3, 1, 11, '2025-07-13 18:47:32', '2025-07-13 18:47:32'),
(51, 1, 20, 3, 1, 11, '2025-07-13 18:47:32', '2025-07-13 18:47:32'),
(52, 1, 21, 3, 1, 11, '2025-07-13 18:47:32', '2025-07-13 18:47:32'),
(53, 1, 22, 3, 1, 11, '2025-07-13 18:47:32', '2025-07-13 18:47:32'),
(54, 1, 23, 3, 1, 11, '2025-07-13 18:47:32', '2025-07-13 18:47:32'),
(55, 1, 24, 3, 1, 11, '2025-07-13 18:47:32', '2025-07-13 18:47:32'),
(56, 1, 19, 3, 1, 10, '2025-07-13 18:47:40', '2025-07-13 18:47:40'),
(57, 1, 20, 3, 1, 10, '2025-07-13 18:47:40', '2025-07-13 18:47:40'),
(58, 1, 21, 3, 1, 10, '2025-07-13 18:47:40', '2025-07-13 18:47:40'),
(59, 1, 22, 3, 1, 10, '2025-07-13 18:47:40', '2025-07-13 18:47:40'),
(60, 1, 23, 3, 1, 10, '2025-07-13 18:47:40', '2025-07-13 18:47:40'),
(61, 1, 24, 3, 1, 10, '2025-07-13 18:47:40', '2025-07-13 18:47:40'),
(62, 1, 19, 3, 1, 9, '2025-07-13 18:47:47', '2025-07-13 18:47:47'),
(63, 1, 20, 3, 1, 9, '2025-07-13 18:47:47', '2025-07-13 18:47:47'),
(64, 1, 21, 3, 1, 9, '2025-07-13 18:47:47', '2025-07-13 18:47:47'),
(65, 1, 22, 3, 1, 9, '2025-07-13 18:47:47', '2025-07-13 18:47:47'),
(66, 1, 23, 3, 1, 9, '2025-07-13 18:47:47', '2025-07-13 18:47:47'),
(67, 1, 24, 3, 1, 9, '2025-07-13 18:47:47', '2025-07-13 18:47:47'),
(68, 1, 19, 3, 1, 8, '2025-07-13 18:47:52', '2025-07-13 18:47:52'),
(69, 1, 20, 3, 1, 8, '2025-07-13 18:47:52', '2025-07-13 18:47:52'),
(70, 1, 21, 3, 1, 8, '2025-07-13 18:47:52', '2025-07-13 18:47:52'),
(71, 1, 22, 3, 1, 8, '2025-07-13 18:47:52', '2025-07-13 18:47:52'),
(72, 1, 23, 3, 1, 8, '2025-07-13 18:47:52', '2025-07-13 18:47:52'),
(73, 1, 24, 3, 1, 8, '2025-07-13 18:47:52', '2025-07-13 18:47:52'),
(86, 1, 19, 3, 2, 5, '2025-07-13 18:49:17', '2025-07-13 18:49:17'),
(87, 1, 20, 3, 2, 5, '2025-07-13 18:49:17', '2025-07-13 18:49:17'),
(88, 1, 21, 3, 2, 5, '2025-07-13 18:49:17', '2025-07-13 18:49:17'),
(89, 1, 22, 3, 2, 5, '2025-07-13 18:49:17', '2025-07-13 18:49:17'),
(90, 1, 23, 3, 2, 5, '2025-07-13 18:49:17', '2025-07-13 18:49:17'),
(91, 1, 24, 3, 2, 5, '2025-07-13 18:49:17', '2025-07-13 18:49:17'),
(92, 1, 19, 3, 1, 3, '2025-07-13 18:49:25', '2025-07-13 18:49:25'),
(93, 1, 20, 3, 1, 3, '2025-07-13 18:49:25', '2025-07-13 18:49:25'),
(94, 1, 21, 3, 1, 3, '2025-07-13 18:49:25', '2025-07-13 18:49:25'),
(95, 1, 22, 3, 1, 3, '2025-07-13 18:49:25', '2025-07-13 18:49:25'),
(96, 1, 23, 3, 1, 3, '2025-07-13 18:49:25', '2025-07-13 18:49:25'),
(97, 1, 24, 3, 1, 3, '2025-07-13 18:49:25', '2025-07-13 18:49:25'),
(98, 1, 19, 3, 1, 1, '2025-07-13 18:49:38', '2025-07-13 18:49:38'),
(99, 1, 20, 3, 1, 1, '2025-07-13 18:49:38', '2025-07-13 18:49:38'),
(100, 1, 21, 3, 1, 1, '2025-07-13 18:49:38', '2025-07-13 18:49:38'),
(101, 1, 22, 3, 1, 1, '2025-07-13 18:49:38', '2025-07-13 18:49:38'),
(102, 1, 23, 3, 1, 1, '2025-07-13 18:49:38', '2025-07-13 18:49:38'),
(103, 1, 24, 3, 1, 1, '2025-07-13 18:49:38', '2025-07-13 18:49:38'),
(104, 1, 19, 3, 1, 2, '2025-07-13 18:49:45', '2025-07-13 18:49:50'),
(105, 1, 20, 3, 1, 2, '2025-07-13 18:49:45', '2025-07-13 18:49:50'),
(106, 1, 21, 3, 1, 2, '2025-07-13 18:49:45', '2025-07-13 18:49:50'),
(107, 1, 22, 3, 1, 2, '2025-07-13 18:49:45', '2025-07-13 18:49:50'),
(108, 1, 23, 3, 1, 2, '2025-07-13 18:49:45', '2025-07-13 18:49:50'),
(109, 1, 24, 3, 1, 2, '2025-07-13 18:49:45', '2025-07-13 18:49:50'),
(110, 1, 19, 2, 1, 12, '2025-07-13 18:50:15', '2025-07-13 18:50:15'),
(111, 1, 20, 2, 1, 12, '2025-07-13 18:50:15', '2025-07-13 18:50:15'),
(112, 1, 21, 2, 1, 12, '2025-07-13 18:50:15', '2025-07-13 18:50:15'),
(113, 1, 22, 2, 1, 12, '2025-07-13 18:50:15', '2025-07-13 18:50:15'),
(114, 1, 23, 2, 1, 12, '2025-07-13 18:50:15', '2025-07-13 18:50:15'),
(115, 1, 24, 2, 1, 12, '2025-07-13 18:50:15', '2025-07-13 18:50:15'),
(116, 1, 19, 2, 1, 11, '2025-07-13 18:50:21', '2025-07-13 18:50:21'),
(117, 1, 20, 2, 1, 11, '2025-07-13 18:50:21', '2025-07-13 18:50:21'),
(118, 1, 21, 2, 1, 11, '2025-07-13 18:50:21', '2025-07-13 18:50:21'),
(119, 1, 22, 2, 1, 11, '2025-07-13 18:50:21', '2025-07-13 18:50:21'),
(120, 1, 23, 2, 1, 11, '2025-07-13 18:50:21', '2025-07-13 18:50:21'),
(121, 1, 24, 2, 1, 11, '2025-07-13 18:50:21', '2025-07-13 18:50:21'),
(122, 1, 19, 2, 1, 10, '2025-07-13 18:50:27', '2025-07-13 18:50:27'),
(123, 1, 20, 2, 1, 10, '2025-07-13 18:50:27', '2025-07-13 18:50:27'),
(124, 1, 21, 2, 1, 10, '2025-07-13 18:50:27', '2025-07-13 18:50:27'),
(125, 1, 22, 2, 1, 10, '2025-07-13 18:50:27', '2025-07-13 18:50:27'),
(126, 1, 23, 2, 1, 10, '2025-07-13 18:50:27', '2025-07-13 18:50:27'),
(127, 1, 24, 2, 1, 10, '2025-07-13 18:50:27', '2025-07-13 18:50:27'),
(128, 1, 19, 2, 1, 9, '2025-07-13 18:50:34', '2025-07-13 18:50:34'),
(129, 1, 20, 2, 1, 9, '2025-07-13 18:50:34', '2025-07-13 18:50:34'),
(130, 1, 21, 2, 1, 9, '2025-07-13 18:50:34', '2025-07-13 18:50:34'),
(131, 1, 22, 2, 1, 9, '2025-07-13 18:50:34', '2025-07-13 18:50:34'),
(132, 1, 23, 2, 1, 9, '2025-07-13 18:50:34', '2025-07-13 18:50:34'),
(133, 1, 24, 2, 1, 9, '2025-07-13 18:50:34', '2025-07-13 18:50:34'),
(134, 1, 19, 2, 1, 8, '2025-07-13 18:50:40', '2025-07-13 18:50:40'),
(135, 1, 20, 2, 1, 8, '2025-07-13 18:50:40', '2025-07-13 18:50:40'),
(136, 1, 21, 2, 1, 8, '2025-07-13 18:50:40', '2025-07-13 18:50:40'),
(137, 1, 22, 2, 1, 8, '2025-07-13 18:50:40', '2025-07-13 18:50:40'),
(138, 1, 23, 2, 1, 8, '2025-07-13 18:50:40', '2025-07-13 18:50:40'),
(139, 1, 24, 2, 1, 8, '2025-07-13 18:50:40', '2025-07-13 18:50:40'),
(146, 1, 19, 3, 1, 4, '2025-07-13 18:52:12', '2025-07-13 18:52:12'),
(147, 1, 20, 3, 1, 4, '2025-07-13 18:52:12', '2025-07-13 18:52:12'),
(148, 1, 21, 3, 1, 4, '2025-07-13 18:52:12', '2025-07-13 18:52:12'),
(149, 1, 22, 3, 1, 4, '2025-07-13 18:52:12', '2025-07-13 18:52:12'),
(150, 1, 23, 3, 1, 4, '2025-07-13 18:52:12', '2025-07-13 18:52:12'),
(151, 1, 24, 3, 1, 4, '2025-07-13 18:52:12', '2025-07-13 18:52:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_thong_bao` bigint(20) UNSIGNED NOT NULL,
  `ten_file` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoc_ky`
--

CREATE TABLE `hoc_ky` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_nien_khoa` bigint(20) UNSIGNED NOT NULL,
  `ten_hoc_ky` varchar(100) NOT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hoc_ky`
--

INSERT INTO `hoc_ky` (`id`, `id_nien_khoa`, `ten_hoc_ky`, `ngay_bat_dau`, `ngay_ket_thuc`, `created_at`, `updated_at`) VALUES
(1, 1, 'Học kỳ 1', '2022-08-05', '2022-12-31', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(2, 1, 'Học kỳ 2', '2023-01-12', '2023-06-30', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(3, 1, 'Học kỳ 3', '2023-08-05', '2023-12-31', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(4, 1, 'Học kỳ 4', '2024-01-12', '2024-06-30', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(5, 1, 'Học kỳ 5', '2024-08-05', '2024-12-31', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(6, 1, 'Học kỳ 6', '2025-01-12', '2025-06-30', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(7, 2, 'Học kỳ 1', '2023-08-05', '2023-12-31', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(8, 2, 'Học kỳ 2', '2024-01-12', '2024-06-30', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(9, 2, 'Học kỳ 3', '2024-08-05', '2024-12-31', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(10, 2, 'Học kỳ 4', '2025-01-12', '2025-06-30', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(11, 2, 'Học kỳ 5', '2025-08-05', '2025-12-31', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(12, 2, 'Học kỳ 6', '2026-01-12', '2026-06-30', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(13, 3, 'Học kỳ 1', '2024-08-05', '2024-12-31', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(14, 3, 'Học kỳ 2', '2025-01-12', '2025-06-30', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(15, 3, 'Học kỳ 3', '2025-08-05', '2025-12-31', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(16, 3, 'Học kỳ 4', '2026-01-12', '2026-06-30', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(17, 3, 'Học kỳ 5', '2026-08-05', '2026-12-31', '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(18, 3, 'Học kỳ 6', '2027-01-12', '2027-06-30', '2025-07-10 22:33:46', '2025-07-10 22:33:46');

-- --------------------------------------------------------

--
-- Table structure for table `hoc_phi`
--

CREATE TABLE `hoc_phi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_hoc_ky` bigint(20) UNSIGNED NOT NULL,
  `id_sinh_vien` bigint(20) UNSIGNED NOT NULL,
  `tong_tien` decimal(10,2) NOT NULL DEFAULT 0.00,
  `trang_thai` int(11) NOT NULL DEFAULT 0,
  `ngay_dong` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hoc_phi`
--

INSERT INTO `hoc_phi` (`id`, `id_hoc_ky`, `id_sinh_vien`, `tong_tien`, `trang_thai`, `ngay_dong`, `created_at`, `updated_at`) VALUES
(1, 7, 19, 7700000.00, 0, NULL, '2025-07-13 22:10:03', '2025-07-13 22:10:03'),
(2, 8, 19, 7700000.00, 0, NULL, '2025-07-13 22:10:03', '2025-07-13 22:10:03'),
(3, 9, 19, 7700000.00, 0, NULL, '2025-07-13 22:10:03', '2025-07-13 22:10:03'),
(4, 10, 19, 7700000.00, 0, NULL, '2025-07-13 22:10:03', '2025-07-13 22:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `ho_so`
--

CREATE TABLE `ho_so` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(15) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `gioi_tinh` enum('Nam','Nữ','Khác') NOT NULL,
  `cccd` varchar(20) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `anh` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ho_so`
--

INSERT INTO `ho_so` (`id`, `ho_ten`, `email`, `password`, `so_dien_thoai`, `ngay_sinh`, `gioi_tinh`, `cccd`, `dia_chi`, `anh`, `created_at`, `updated_at`) VALUES
(1, 'Bùi Đức Khánh', 'lvkt0177@gmail.com', '$2y$12$Z9PxZfpun.9Mf5aSho4fj.OAX1ZAgTWTEA6YpwF7PEbE7hM6WTK2O', '0900000001', '1992-11-24', 'Nam', '001100000001', '2878 Phố Trác Trọng Ly, Phường Khương, Huyện Dã Đường\nBình Phước', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(2, 'Vũ Thanh Hiếu', 'lvkt0178@gmail.com', '$2y$12$cp8.ngvXsePYNZEMM2xIgebL3iQTuI8HLfsQAbbPPT6hgnmh8OO0a', '0900000002', '1993-01-14', 'Nam', '001100000002', '20, Ấp 5, Phường Tuệ Diễm, Quận Đái Duy\nKiên Giang', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(3, 'Vũ Đức Phong', 'minhanhle969@gmail.com', '$2y$12$6Y0xS3/3ECQ4pxknfr0.WO2JjF8n5aHz8g1hFexy62ZubdSg2uOqK', '0900000003', '1971-09-28', 'Nam', '001100000003', '49 Phố Khoa, Phường Sâm, Quận Nhâm Cảnh\nQuảng Ngãi', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(4, 'Lê Minh Hiếu', 'lvkt0180@gmail.com', '$2y$12$g3IAR0tojsKbRnjTtC6L/Oyg6nnkgGBK/c4/yXQ40ShPk9ZHwYqo.', '0900000004', '1985-08-11', 'Nam', '001100000004', '32, Ấp Duyên Hán, Phường 02, Quận 1\nAn Giang', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(5, 'Vũ Văn Hưng', 'lvkt0181@gmail.com', '$2y$12$QiLAaSXSyAobVdy.waRKN.FJPPQxswY/RmdcblDKEYRXXT/J.pHmG', '0900000005', '1979-08-25', 'Nam', '001100000005', '328, Ấp 0, Phường 31, Quận 8\nCà Mau', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(6, 'Đặng Thanh Sơn', 'lvkt0182@gmail.com', '$2y$12$.FbAFPjR8mWil7BNpXrcouAhmMex2VIlBC.PNVszful.nXRqidSue', '0900000006', '1989-11-08', 'Nam', '001100000006', '31 Phố Đoàn, Xã 6, Quận Đàm Huệ\nHà Nội', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(7, 'Bùi Thanh Khánh', 'lvkt0183@gmail.com', '$2y$12$FRbbNTjf7k3/eLRyvKzzieD2VnAAXy0hcSMMWKEkdEIuOsDORoQCO', '0900000007', '1990-10-14', 'Nam', '001100000007', '456 Phố Hành, Ấp Biện Khải, Huyện Tống Trúc\nHà Nội', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(8, 'Trần Đức Phong', 'lvkt0184@gmail.com', '$2y$12$gefPSvV6SWfoYCxPAHXDveHQab1rNeJvDDd1Q93VI8/pUkXYgVk46', '0900000008', '1975-03-13', 'Nam', '001100000008', '680 Phố Phó Xuân Hương, Thôn Bạch Thúc, Quận Khê\nTrà Vinh', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(9, 'Vũ Xuân Long', 'lvkt0185@gmail.com', '$2y$12$nVYDeNBW2LSflE0.ajQvwuOma9uaVm50CRjokvGKetS8g3DPsLxUe', '0900000009', '1996-04-29', 'Nam', '001100000009', '716, Thôn Chương, Ấp Thịnh Phượng, Huyện Dinh Lan\nLai Châu', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(10, 'Phan Xuân Sơn', 'lvkt0186@gmail.com', '$2y$12$7087CjMlWqHyKrPZ9YbB9uFlLPRkx8JrPLx.Bor5luc3oe7mEQSpe', '0900000010', '1989-03-15', 'Nam', '001100000010', '3, Thôn Tòng Nữ, Thôn Sinh Huấn, Quận Du Hiền\nHòa Bình', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(11, 'Bùi Thanh Long', 'lvkt0187@gmail.com', '$2y$12$0B4zecK4MkCDd3koHpWxieACMmCsB0fIguv/kl/dTusTCBkCJ.fVi', '0900000011', '2006-11-21', 'Nam', '001100000011', '395 Phố Văn, Phường Sử, Huyện Kha Mỹ\nHồ Chí Minh', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(12, 'Phan Minh Phong', 'lvkt0188@gmail.com', '$2y$12$IdaIUHyiD.XfLsakadjJreXHMKWESnz1/2bc4HljrDSZ6tLvBg5pK', '0900000012', '1974-09-18', 'Nam', '001100000012', '26 Phố Hiền, Phường Hùng Ý Hà, Quận Đôn\nHưng Yên', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(13, 'Phan Minh Dũng', 'lvkt0189@gmail.com', '$2y$12$ee21IfDx23v3AAunHVs3Pen3n3.ydJqgDXHdQc3sFCeH2dzGAi4v.', '0900000013', '1970-08-15', 'Nam', '001100000013', '9 Phố Mạch Kỷ Lâm, Xã 1, Huyện 5\nPhú Yên', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(14, 'Bùi Văn Long', 'lvkt0190@gmail.com', '$2y$12$hWWszvGWa.vaIp1FusZ4quiEaLmNKeuD8xewIULfpvbjS5vm.gJF2', '0900000014', '1988-09-27', 'Nam', '001100000014', '1651 Phố Từ, Xã Dư, Huyện Đôn Khuất\nHà Nội', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(15, 'Nguyễn Xuân Dũng', 'lvkt0191@gmail.com', '$2y$12$OonWRNxWNSVnDY.P6YNUKuT2cnl3vz82lIuEjvsSMJ2AbwgWt9902', '0900000015', '1984-09-02', 'Nam', '001100000015', '6829, Thôn An, Phường Dân Khu, Huyện 86\nHậu Giang', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(16, 'Trần Công Tú', 'lvkt0192@gmail.com', '$2y$12$8oigv7NrR8Vj6mYtyzYFiOQeuW/hpVg53kXriNWzcQz9l7RC1LS0i', '0900000016', '1989-02-10', 'Nam', '001100000016', '6, Thôn Chế Chinh Thuận, Xã Thạch, Quận 89\nTrà Vinh', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(17, 'Nguyễn Thanh Khánh', 'lvkt0193@gmail.com', '$2y$12$.2jXskz9aOuvTgMv.IMw6uhq086pkkBtg2JbtaWAax4y8d7aTf982', '0900000017', '1979-01-12', 'Nam', '001100000017', '188 Phố Tôn Luật Quyền, Thôn Bì Nhân, Quận Đạo\nĐiện Biên', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(18, 'Đỗ Công Hải', 'lvkt0194@gmail.com', '$2y$12$i5Vp7vTIQlvaJDfYcyutY.xYp4WdaKNL3Ux9aWgZrM/JulKIgqoVa', '0900000018', '1986-11-28', 'Nam', '001100000018', '581 Phố Tiếp, Phường Xuân Lâm, Quận Lỡ Quân\nThừa Thiên Huế', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(19, 'Đặng Xuân Long', 'lvkt0195@gmail.com', '$2y$12$JYikJjaKEmbus966Qpz1wuC8eeEaw0pEGL2UuL7u49RbUWI/zZl9G', '0900000019', '1986-12-30', 'Nam', '001100000019', '564 Phố Cầm Hải Lai, Thôn Mâu Hoàn, Quận Hồng\nHải Phòng', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(20, 'Nguyễn Đức Hiếu', 'lvkt0196@gmail.com', '$2y$12$d20Xsp9myl83vcwenVAVsO0CaL9iG7OviOJLfx0LTZsI1DlmYlLpG', '0900000020', '1975-05-22', 'Nam', '001100000020', '52 Phố Vừ, Phường Thục Kim, Huyện 5\nHồ Chí Minh', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(21, 'Phan Xuân Long', 'lvkt0197@gmail.com', '$2y$12$3kNO90XsBFCeMOXCjoSBf.mp.Oxrlu.z5sTjDMVzJqPt7outwvoyW', '0900000021', '1980-12-26', 'Nam', '001100000021', '4999 Phố Tú, Xã Dã Đào Uy, Huyện Sơn Thể Võ\nCần Thơ', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(22, 'Trần Thanh Dũng', 'lvkt0198@gmail.com', '$2y$12$bChB3iWLNI/NVXjDvf1r7e7wdcIGvwT1UkqzZFvieIyQXftdhQbA.', '0900000022', '1989-11-02', 'Nam', '001100000022', '2 Phố Thiên, Phường 82, Quận Vĩ Bảo\nĐà Nẵng', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(23, 'Đỗ Thanh Dũng', 'lvkt0199@gmail.com', '$2y$12$kWlUnWSZI.1WKidGe6RRGOF39/6qCHt75eYTOt2sfUhahd6B2hiji', '0900000023', '1982-11-22', 'Nam', '001100000023', '3 Phố Hy Ty Nữ, Xã Sinh Mẫn, Huyện Du Khải\nHà Nội', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(24, 'Hoàng Công Sơn', 'lvkt0200@gmail.com', '$2y$12$Dz/bP5BEIMbeUDLq/ZnFHeZ46EtjMeCsjxu1OYvpZ0jP.JAS57UHG', '0900000024', '2002-09-18', 'Nam', '001100000024', '545 Phố Tú, Xã Quân Quyên, Huyện Mẫn Sỹ\nHà Nội', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(25, 'Lê Xuân Sơn', 'lvkt0201@gmail.com', '$2y$12$a4jG/m2eDbE0ndjPuoP86u8GPojZHFHrsFjDaTIuMklCuYkDV61Fi', '0900000025', '2005-08-31', 'Nam', '001100000025', '53 Phố Tống Tiên Bằng, Phường Mỹ, Quận Cát Khoát\nCần Thơ', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(26, 'Bùi Ngọc Hiếu', 'lvkt0202@gmail.com', '$2y$12$oN/JQYALkwLJx5zItQRpjeD.CdpP4wTe/Pv/zCN3CCZi0QI8p.F8u', '0900000026', '1973-08-17', 'Nam', '001100000026', '605 Phố Quản, Ấp Đan Lực, Quận Phương Đạo Ngân\nCần Thơ', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(27, 'Hoàng Minh Tú', 'lvkt0203@gmail.com', '$2y$12$KyPHyWfTctm1uVdxEFcvuuEjlYZPRFMwnbUygTQvhY3nes5Kngd6e', '0900000027', '2001-01-13', 'Nam', '001100000027', '625 Phố Đào Nhật Vĩ, Ấp Thịnh Tuyết, Quận Giả\nGia Lai', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(28, 'Lê Văn Hiếu', 'lvkt0204@gmail.com', '$2y$12$ojy88GY71Z3H8atvvIjeUO10cNWYGZluW6QIpOW/2wKg08pelC5U2', '0900000028', '1971-04-15', 'Nam', '001100000028', '16 Phố Hiệp, Phường Đào, Quận Nhân Bàng\nHà Nội', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(29, 'Lê Thanh Phong', 'lvkt0205@gmail.com', '$2y$12$CrTlP2gkicMWJMwOjpKtr.9yZPDSqWijCsqaw3t7fNZy4uWEl1YsS', '0900000029', '1977-05-04', 'Nam', '001100000029', '7 Phố Ong Thái Quỳnh, Phường Hùng Hoa, Huyện 1\nĐà Nẵng', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(30, 'Trần Công Tú', 'lvkt0206@gmail.com', '$2y$12$h2tlFjUn58aSvTJbU14b8eYTNcZXr00/oHJJJnmLdjuYuZybIHtC6', '0900000030', '1975-12-11', 'Nam', '001100000030', '860 Phố Ninh Kính Xuyến, Xã Ý Thuần, Quận Biện Xuyến Ngân\nHồ Chí Minh', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(31, 'Bùi Minh Tú', 'lvkt0207@gmail.com', '$2y$12$ynglzTuOx8UZJypqvbPFkuJ52I24UZjRl8/zesYTNZbuHg5lzfs.6', '0900000031', '2001-08-17', 'Nam', '001100000031', '8581, Ấp Cung Trúc, Xã Trọng, Huyện 90\nAn Giang', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(32, 'Đỗ Công Sơn', 'lvkt0208@gmail.com', '$2y$12$2Zr9F2u2NbnGurCaJLUcguYpbTRCGhm6J2Z3pNNGvFevLxkRogKqy', '0900000032', '1990-03-25', 'Nam', '001100000032', '8151 Phố Hoài, Xã 4, Huyện Hương Doãn\nKiên Giang', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(33, 'Nguyễn Văn Nam', 'lvkt0209@gmail.com', '$2y$12$AjV1PYg3a56.UxF0CM5ew.3XrMYqD.ehVChF0oORe7Foncl37FtfS', '0900000033', '1996-11-15', 'Nam', '001100000033', '7 Phố Văn Huyền Chiến, Thôn Phúc Thường, Huyện Dương Cát\nHà Nội', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(34, 'Lê Đức Hưng', 'lvkt0210@gmail.com', '$2y$12$G3rjkTf9nPrAUPc6qxwNTuoPURCFWcC5VojQr9TaAq/arVFf112Ka', '0900000034', '2002-09-22', 'Nam', '001100000034', '49 Phố La Dao Mạnh, Phường Tạ, Huyện Nông Quốc Thuận\nHải Phòng', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(35, 'Phan Xuân Hiếu', 'lvkt0211@gmail.com', '$2y$12$DHhHpIv/EFEnKbcjjtP0XOlNuN8a6RN8k5qpH8jq1yAUqKSq.s7xe', '0900000035', '1999-01-06', 'Nam', '001100000035', '7096, Thôn Hải Hy, Xã Vọng Bình, Quận Lò\nThái Bình', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(36, 'Phạm Hữu Dũng', 'lvkt0212@gmail.com', '$2y$12$NpBdkD.SLQ/hY5dJrhNxW.rG4GJ7MbI.06ANmwFJE9qewZQjOyvL2', '0900000036', '2001-02-24', 'Nam', '001100000036', '33 Phố Điền, Thôn Vọng Quốc, Quận Tòng Ty Huyền\nBắc Giang', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(37, 'Le Van Khanh Thinh', 'lethinh3988@gmail.com', '$2y$12$4.juzHl.H5Z5xp.wqcOineV/JZCA/CfRdqF2IXqNt0K.MFZV9hoNi', '0857853419', '2000-01-01', 'Nam', '0621456789', '123 Nguyen Van Cu, Hanoi', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(38, 'Nguyen Thi Mai', 'ntm@fe.edu.vn', '$2y$12$ez./BKAg/oWA64JSqNs0dumNntqrnEvDxExhLsYlrOZvVLaP/zMnW', '0987654321', '2000-01-01', 'Nữ', '0684567890', '24 Ly Thuong Kiet, Hanoi', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(39, 'Tran Van An', 'tva@fe.edu.vn', '$2y$12$6lqTon0tQIUREUJsjdM0U.WN.YBQ7gpGhDOmLJJbS7rwRHDxFI1L6', '0123456789', '2000-01-01', 'Nam', '0690123456', '999 Vo Nguyen Giap, Hanoi', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(40, 'Pham Minh Duc', 'pmd@fe.edu.vn', '$2y$12$tzkI9Bq9sy6MZihmQWzR6up1KMpc4meECold8SqQ0xfJUK60gC4QG', '0912345678', '1999-09-09', 'Nam', '0612345678', '15 Tran Hung Dao, Hanoi', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(41, 'Dang Thi Huong', 'dth@fe.edu.vn', '$2y$12$2sven0XNbn45b0ZI5mFLTeYsjiU1boDZqmywPaVPy9uop0BGL4pTu', '0968123456', '2001-03-21', 'Nữ', '0678945612', '85 Le Duan, Hanoi', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(42, 'Le Tuan Kiet', 'ltk@fe.edu.vn', '$2y$12$OIHToxwNPNthFGqPkeuX6OlI2pMFnRLgIsEtaqU66G3WVQ6d.04D6', '0933456789', '2000-07-15', 'Nam', '0634567890', '36 Phan Dinh Phung, Hanoi', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(43, 'Nguyen Bao Tram', 'nbt@fe.edu.vn', '$2y$12$JQThUWqFmCsDQBbBbWSvjeJcp6731yztzdMCLys21JFC3yTj3TTly', '0909876543', '2002-05-30', 'Nữ', '0609876543', '120 Kim Ma, Hanoi', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(44, 'Vo Quoc Khanh', 'vqk@fe.edu.vn', '$2y$12$gvRo2kZsLf2to8bxSA0x5.70REqbtnyOtUS8IHH3ylaiNctdRlj.S', '0977543210', '1998-12-12', 'Nam', '0665432109', '42 Lang Ha, Hanoi', 'assets/admin/images/ho_so/user_image.jpg', NULL, NULL),
(45, 'Nguyen The Anh', 'an.nguyen@gmail.com', '$2y$10$eImiTXuWVxfM37uY4JANjQ==', '0912345678', '1999-03-21', 'Nam', '0012345678', '12 Tran Hung Dao, Ha Noi', 'assets/admin/images/ho_so/user_image.jpg', '2025-07-14 02:02:52', '2025-07-14 02:02:52'),
(46, 'Tran Thi Bich', 'bich.tran@gmail.com', '$2y$10$eImiTXuWVxfM37uY4JANjQ==', '0987654321', '2001-07-15', 'Nữ', '0023456789', '45 Le Loi, Da Nang', 'assets/admin/images/ho_so/user_image.jpg', '2025-07-14 02:02:52', '2025-07-14 02:02:52'),
(47, 'Le Minh Hoang', 'hoang.le@gmail.com', '$2y$10$eImiTXuWVxfM37uY4JANjQ==', '0909123456', '2000-11-05', 'Nam', '0034567890', '78 Cach Mang Thang 8, Ho Chi Minh', 'assets/admin/images/ho_so/user_image.jpg', '2025-07-14 02:02:52', '2025-07-14 02:02:52'),
(48, 'Pham Thi Binh', 'mai.pham@gmail.com', '$2y$10$eImiTXuWVxfM37uY4JANjQ==', '0934567890', '1998-05-30', 'Nữ', '0045678901', '23 Vo Van Tan, Can Tho', 'assets/admin/images/ho_so/user_image.jpg', '2025-07-14 02:02:52', '2025-07-14 02:02:52'),
(49, 'Dang Van Son', 'son.dang@gmail.com', '$2y$10$eImiTXuWVxfM37uY4JANjQ==', '0978123456', '2002-09-09', 'Nam', '0056789012', '99 Phan Chu Trinh, Hue', 'assets/admin/images/ho_so/user_image.jpg', '2025-07-14 02:02:52', '2025-07-14 02:02:52');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten_khoa` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`id`, `ten_khoa`, `created_at`, `updated_at`) VALUES
(1, 'Công Nghệ Thông Tin', NULL, NULL),
(2, 'Công Nghệ Nhiệt Lạnh', NULL, NULL),
(3, 'Cơ Khí', NULL, NULL),
(4, 'Cơ Khí Động Lực', NULL, NULL),
(5, 'Điện - Điện Tử', NULL, NULL),
(6, 'Kinh Tế', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lich_thi`
--

CREATE TABLE `lich_thi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_lop_hoc_phan` bigint(20) UNSIGNED NOT NULL,
  `id_giam_thi_1` bigint(20) UNSIGNED DEFAULT NULL,
  `id_giam_thi_2` bigint(20) UNSIGNED DEFAULT NULL,
  `id_tuan` bigint(20) UNSIGNED NOT NULL,
  `ngay_thi` date NOT NULL,
  `gio_bat_dau` time NOT NULL,
  `thoi_gian_thi` int(11) NOT NULL,
  `id_phong_thi` bigint(20) UNSIGNED DEFAULT NULL,
  `lan_thi` int(11) NOT NULL DEFAULT 1,
  `trang_thai` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lich_thi`
--

INSERT INTO `lich_thi` (`id`, `id_lop_hoc_phan`, `id_giam_thi_1`, `id_giam_thi_2`, `id_tuan`, `ngay_thi`, `gio_bat_dau`, `thoi_gian_thi`, `id_phong_thi`, `lan_thi`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 3, 174, '2025-11-30', '08:00:00', 45, 1, 1, 0, '2025-07-11 21:43:00', '2025-07-11 21:43:00'),
(2, 3, 3, 2, 175, '2025-12-08', '08:00:00', 60, 4, 2, 0, '2025-07-11 21:43:25', '2025-07-11 21:43:25'),
(5, 30, 10, 9, 145, '2025-05-11', '09:00:00', 45, 1, 1, 0, '2025-07-13 19:58:16', '2025-07-13 19:58:16'),
(6, 31, 11, 12, 145, '2025-05-13', '08:00:00', 60, 1, 1, 0, '2025-07-13 19:58:47', '2025-07-13 19:58:47'),
(7, 32, 11, 6, 145, '2025-05-13', '09:00:00', 45, 1, 1, 0, '2025-07-13 19:59:07', '2025-07-13 19:59:07'),
(8, 33, 12, 10, 145, '2025-05-11', '08:00:00', 45, 1, 1, 0, '2025-07-13 20:00:25', '2025-07-13 20:00:25'),
(9, 29, 11, 12, 145, '2025-05-17', '09:00:00', 60, 1, 1, 0, '2025-07-13 20:00:46', '2025-07-13 20:00:46'),
(10, 34, 12, 6, 145, '2025-05-15', '08:00:00', 45, 1, 1, 0, '2025-07-13 20:01:16', '2025-07-13 20:01:16'),
(12, 29, 12, 4, 147, '2025-05-25', '08:00:00', 60, 2, 2, 0, '2025-07-13 20:06:42', '2025-07-13 20:06:42'),
(13, 30, 10, 8, 147, '2025-05-26', '09:00:00', 45, 1, 2, 0, '2025-07-13 20:12:29', '2025-07-13 20:12:29'),
(14, 31, 9, 5, 147, '2025-05-28', '07:00:00', 45, 1, 2, 0, '2025-07-13 20:12:55', '2025-07-13 20:12:55'),
(15, 34, 9, 5, 147, '2025-05-30', '07:09:00', 45, 1, 2, 0, '2025-07-13 20:13:23', '2025-07-13 20:13:23'),
(16, 32, 8, 11, 146, '2025-05-18', '13:00:00', 45, 2, 2, 0, '2025-07-13 21:10:19', '2025-07-13 21:10:19'),
(17, 37, 11, 12, 176, '2025-12-14', '08:09:00', 45, 17, 1, 0, '2025-07-13 21:21:38', '2025-07-13 21:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `loai_giay`
--

CREATE TABLE `loai_giay` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten_giay` varchar(255) NOT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loai_giay`
--

INSERT INTO `loai_giay` (`id`, `ten_giay`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, '📋 Giấy tạm hoãn nghĩa vụ quân sự', 0, NULL, NULL),
(2, '🎓 Giấy bổ túc hồ sơ thuế thu nhập cá nhân', 0, NULL, NULL),
(3, '🚌 Giấy đi xe buýt tháng (do chưa có thẻ SV)', 0, NULL, NULL),
(4, '💳 Giấy vay vốn học sinh sinh viên', 0, NULL, NULL),
(5, '🏠 Giấy bổ túc hồ sơ tạm trú, tạm vắng', 0, NULL, NULL),
(6, '💰 Giấy bổ túc hồ sơ xin học bỗng', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE `lop` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten_lop` varchar(100) NOT NULL,
  `id_nien_khoa` bigint(20) UNSIGNED NOT NULL,
  `id_gvcn` bigint(20) UNSIGNED NOT NULL,
  `id_chuyen_nganh` bigint(20) UNSIGNED DEFAULT NULL,
  `si_so` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`id`, `ten_lop`, `id_nien_khoa`, `id_gvcn`, `id_chuyen_nganh`, `si_so`, `created_at`, `updated_at`) VALUES
(1, 'CD TH 22A', 1, 1, 1, 0, NULL, NULL),
(2, 'CD TH 22B', 1, 3, 1, 0, NULL, NULL),
(3, 'CD TH 23A', 2, 4, 1, 0, NULL, NULL),
(4, 'CD TH 23B', 2, 1, 1, 0, NULL, NULL),
(5, 'CD TH 24A', 3, 1, 1, 0, NULL, NULL),
(6, 'CD TH 24B', 3, 4, 1, 0, NULL, NULL),
(7, 'CD TH 22 WebC', 1, 3, 2, 0, NULL, NULL),
(8, 'CD TH 22 MMTA', 1, 3, 4, 0, NULL, NULL),
(9, 'CD TH 22 DĐB', 1, 3, 3, 0, NULL, NULL),
(10, 'CDTH 23 WebA', 2, 3, 2, 0, NULL, NULL),
(11, 'CDTH 23 MMTA', 2, 3, 4, 0, NULL, NULL),
(12, 'CDTH 23 DĐE', 2, 3, 3, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lop_hoc_phan`
--

CREATE TABLE `lop_hoc_phan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten_hoc_phan` varchar(100) NOT NULL,
  `id_giang_vien` bigint(20) UNSIGNED DEFAULT NULL,
  `id_chuong_trinh_dao_tao` bigint(20) UNSIGNED DEFAULT NULL,
  `id_lop` bigint(20) UNSIGNED DEFAULT NULL,
  `loai_lop_hoc_phan` int(11) NOT NULL DEFAULT 0,
  `so_luong_sinh_vien` int(11) NOT NULL DEFAULT 0,
  `gioi_han_dang_ky` int(11) DEFAULT 20,
  `loai_mon` int(11) NOT NULL DEFAULT 0,
  `trang_thai` int(11) NOT NULL DEFAULT 0,
  `trang_thai_nop_bang_diem` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lop_hoc_phan`
--

INSERT INTO `lop_hoc_phan` (`id`, `ten_hoc_phan`, `id_giang_vien`, `id_chuong_trinh_dao_tao`, `id_lop`, `loai_lop_hoc_phan`, `so_luong_sinh_vien`, `gioi_han_dang_ky`, `loai_mon`, `trang_thai`, `trang_thai_nop_bang_diem`, `created_at`, `updated_at`) VALUES
(1, 'Pháp luật', 1, 1, 1, 0, 100, 20, 0, 0, 3, NULL, NULL),
(2, 'Pháp luật', 1, 1, 2, 0, 100, 20, 0, 0, 3, NULL, NULL),
(3, 'Công nghệ phần mềm', 2, 2, 12, 0, 4, 20, 0, 1, 3, '2025-07-11 21:21:36', '2025-07-11 22:42:34'),
(4, 'Phương pháp lập trình hướng đối tượng', 2, 1, 6, 0, 6, 20, 0, 1, 3, '2025-07-12 18:47:58', '2025-08-10 22:44:22'),
(5, 'Giáo dục thể chất 1', 9, 1, 4, 0, 6, 20, 1, 0, 3, '2025-07-13 19:11:46', '2025-07-13 20:54:08'),
(6, 'Pháp luật', 10, 1, 4, 0, 6, 20, 2, 0, 3, '2025-07-13 19:17:32', '2025-07-13 20:54:19'),
(7, 'Toán cao cấp', 4, 1, 4, 0, 6, 20, 2, 0, 3, '2025-07-13 19:18:04', '2025-07-13 20:52:49'),
(8, 'Toán rời rạc và Lý thuyết đồ thị', 8, 1, 4, 0, 6, 20, 2, 0, 3, '2025-07-13 19:18:25', '2025-07-13 20:53:07'),
(9, 'Phần cứng máy tính', 3, 1, 4, 0, 6, 20, 0, 0, 3, '2025-07-13 19:18:41', '2025-07-13 20:54:39'),
(10, 'Nhập môn lập trình', 5, 1, 4, 0, 6, 20, 0, 0, 3, '2025-07-13 19:19:07', '2025-07-13 20:54:55'),
(11, 'Tin học ứng dụng', 2, 1, 4, 0, 6, 20, 0, 0, 3, '2025-07-13 19:20:03', '2025-07-13 20:55:05'),
(12, 'TT Nhập môn lập trình', 2, 1, 4, 0, 6, 20, 1, 0, 3, '2025-07-13 19:20:37', '2025-07-13 20:55:15'),
(13, 'TT Phần cứng máy tính', 3, 1, 4, 0, 6, 20, 1, 0, 3, '2025-07-13 19:20:58', '2025-07-13 20:55:28'),
(14, 'Giáo dục thể chất 2', NULL, 1, 4, 0, 6, 20, 1, 0, 3, '2025-07-13 19:25:39', '2025-07-13 20:55:39'),
(15, 'Vật lý đại cương', NULL, 1, 4, 0, 6, 20, 2, 0, 3, '2025-07-13 19:27:08', '2025-07-13 21:05:31'),
(16, 'Cơ sở dữ liệu', NULL, 1, 4, 0, 6, 20, 0, 0, 3, '2025-07-13 19:27:56', '2025-07-13 20:55:59'),
(17, 'Cấu trúc dữ liệu và giải thuật', NULL, 1, 4, 0, 6, 20, 0, 0, 3, '2025-07-13 19:28:41', '2025-07-13 20:58:32'),
(18, 'Mạng máy tính', NULL, 1, 4, 0, 6, 20, 0, 0, 3, '2025-07-13 19:29:23', '2025-07-13 20:58:42'),
(19, 'TT Thiết kế Web', NULL, 1, 4, 0, 6, 20, 1, 0, 3, '2025-07-13 19:30:25', '2025-07-13 21:05:20'),
(20, 'TT Cấu trúc dữ liệu và giải thuật', NULL, 1, 4, 0, 6, 20, 1, 0, 3, '2025-07-13 19:30:43', '2025-07-13 21:05:04'),
(21, 'TT Mạng máy tính', NULL, 1, 4, 0, 6, 20, 1, 0, 3, '2025-07-13 19:31:24', '2025-07-13 20:57:42'),
(22, 'Giáo dục chính trị 1', NULL, 1, 4, 0, 6, 20, 2, 0, 3, '2025-07-13 19:35:34', '2025-07-13 20:57:36'),
(23, 'Hệ quản trị cơ sở dữ liệu', NULL, 1, 4, 0, 6, 20, 0, 0, 3, '2025-07-13 19:35:57', '2025-07-13 20:57:32'),
(24, 'Quản trị hệ thống mạng Windows', NULL, 1, 4, 0, 6, 20, 0, 0, 3, '2025-07-13 19:36:18', '2025-07-13 20:57:27'),
(25, 'Phương pháp lập trình hướng đối tượng', NULL, 1, 4, 0, 6, 20, 0, 0, 3, '2025-07-13 19:37:15', '2025-07-13 20:57:23'),
(26, 'LT Web PHP cơ bản', NULL, 1, 4, 0, 6, 20, 0, 0, 3, '2025-07-13 19:37:43', '2025-07-13 20:57:18'),
(27, 'TT Hệ quản trị cơ sở dữ liệu', NULL, 1, 4, 0, 6, 20, 1, 0, 3, '2025-07-13 19:38:48', '2025-07-13 20:57:13'),
(28, 'TT Quản trị hệ thống mạng Windows', NULL, 1, 4, 0, 6, 20, 1, 0, 3, '2025-07-13 19:39:04', '2025-07-13 20:57:07'),
(29, 'Giáo dục chính trị 2', NULL, 2, 10, 0, 4, 20, 2, 0, 3, '2025-07-13 19:40:40', '2025-07-13 20:57:02'),
(30, 'Tiếng Anh chuyên ngành CNTT', NULL, 2, 10, 0, 4, 20, 0, 0, 3, '2025-07-13 19:40:59', '2025-07-13 20:56:55'),
(31, 'Lập trình Windows + ĐAMH', NULL, 2, 10, 0, 4, 20, 0, 0, 3, '2025-07-13 19:41:26', '2025-07-13 21:04:21'),
(32, 'Lập trình Python', NULL, 2, 10, 0, 4, 20, 0, 0, 2, '2025-07-13 19:41:40', '2025-07-13 20:56:05'),
(33, 'Phân tích thiết kế hệ thống thông tin', NULL, 2, 10, 0, 4, 20, 0, 0, 3, '2025-07-13 19:42:01', '2025-07-13 20:56:11'),
(34, 'Ngôn ngữ lập trình Java', NULL, 2, 10, 0, 4, 20, 0, 0, 3, '2025-07-13 19:42:14', '2025-07-13 20:56:51'),
(35, 'Nodejs Platform', NULL, 2, 10, 0, 4, 20, 0, 0, 3, '2025-07-13 19:42:30', '2025-07-13 20:56:37'),
(36, 'TT Lập trình Windows', NULL, 2, 10, 0, 4, 20, 1, 0, 3, '2025-07-13 19:42:42', '2025-07-13 20:56:15'),
(37, 'Công nghệ phần mềm', NULL, 2, 10, 0, 4, 20, 0, 1, 0, '2025-07-13 21:21:12', '2025-07-13 21:21:12'),
(38, 'Quản trị hệ thống mạng Windows', NULL, 1, 5, 0, 6, 20, 0, 1, 0, '2025-07-13 22:08:21', '2025-07-13 22:08:21'),
(39, 'Hệ quản trị cơ sở dữ liệu', NULL, 1, 5, 0, 6, 20, 0, 1, 0, '2025-07-13 22:09:45', '2025-07-13 22:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_00_00_000000_create_nam_table', 1),
(2, '0000_00_00_000003_create_tuan_table', 1),
(3, '0000_05_26_040005_create_khoa_table', 1),
(4, '0000_05_26_040006_create_chuyen_nganh_table', 1),
(5, '0000_05_26_040008_create_bo_mon_table', 1),
(6, '0000_05_26_051718_create_hoso_table', 1),
(7, '0001_01_01_000000_create_users_table', 1),
(8, '0001_01_01_000001_create_cache_table', 1),
(9, '0001_01_01_000002_create_jobs_table', 1),
(10, '2025_05_22_072119_create_permission_tables', 1),
(11, '2025_05_26_040001_create_phong_table', 1),
(12, '2025_05_26_040002_create_mon_hoc_table', 1),
(13, '2025_05_26_043744_create_nien_khoa_table', 1),
(14, '2025_05_26_061633_create_lop_table', 1),
(15, '2025_05_26_073609_create_sinhvien_table', 1),
(16, '2025_05_26_073610_create_diem_ren_luyen_table', 1),
(17, '2025_05_26_073940_create_chuong_trinh_dao_tao_table', 1),
(18, '2025_05_26_074052_create_hoc_ky_table', 1),
(19, '2025_05_26_075048_create_chi_tiet__ctdt_table', 1),
(20, '2025_05_26_075049_create_lop_hoc_phan_table', 1),
(21, '2025_05_26_075357_create_thoi_khoa_bieu_table', 1),
(22, '2025_05_26_075815_create_danh_sach_hoc_phan_table', 1),
(23, '2025_05_26_080332_create_dang_ky_hg_tl_table', 1),
(24, '2025_05_26_082130_create_hoc_phi_table', 1),
(25, '2025_05_26_082456_create_lich_thi_table', 1),
(26, '2025_05_26_082938_create_loai_giay_table', 1),
(27, '2025_05_26_083043_create_dang_ky_giay_table', 1),
(28, '2025_05_26_083617_create_bien_ban_shcn_table', 1),
(29, '2025_05_26_084131_create_chi_tiet_bien_ban_shcn_table', 1),
(30, '2025_05_26_084701_create_thong_bao_table', 1),
(31, '2025_05_26_084703_create_files_table', 1),
(32, '2025_05_26_084934_create_chi_tiet_thong_bao_table', 1),
(33, '2025_05_26_085052_create_binh_luan_table', 1),
(34, '2025_05_26_085252_create_tham_so_table', 1),
(35, '2025_05_30_043109_create_phieu_len_lop_table', 1),
(36, '2025_06_02_143300_create_personal_access_tokens_table', 1),
(37, '2025_06_13_021647_create_yeu_cau_cap_lai_mat_khau_table', 1),
(38, '2025_07_04_055439_create_danh_sach_sinh_vien_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 13),
(4, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 8),
(4, 'App\\Models\\User', 9),
(4, 'App\\Models\\User', 10),
(5, 'App\\Models\\User', 7),
(5, 'App\\Models\\User', 11);

-- --------------------------------------------------------

--
-- Table structure for table `mon_hoc`
--

CREATE TABLE `mon_hoc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten_mon` varchar(255) NOT NULL,
  `loai_mon_hoc` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mon_hoc`
--

INSERT INTO `mon_hoc` (`id`, `ten_mon`, `loai_mon_hoc`, `created_at`, `updated_at`) VALUES
(1, 'Tiếng Anh 1', 5, NULL, NULL),
(2, 'Giáo dục thể chất 1', 1, NULL, NULL),
(3, 'Pháp luật', 2, NULL, NULL),
(4, 'Toán cao cấp', 2, NULL, NULL),
(5, 'Toán rời rạc và Lý thuyết đồ thị', 2, NULL, NULL),
(6, 'Phần cứng máy tính', 0, NULL, NULL),
(7, 'Nhập môn lập trình', 0, NULL, NULL),
(8, 'Tin học ứng dụng', 0, NULL, NULL),
(9, 'TT Phần cứng máy tính', 1, NULL, NULL),
(10, 'TT Nhập môn lập trình', 1, NULL, NULL),
(11, 'Tiếng Anh 2', 5, NULL, NULL),
(12, 'Giáo dục thể chất 2', 1, NULL, NULL),
(13, 'Vật lý đại cương', 2, NULL, NULL),
(14, 'Cơ sở dữ liệu', 0, NULL, NULL),
(15, 'Cấu trúc dữ liệu và giải thuật', 0, NULL, NULL),
(16, 'Mạng máy tính', 0, NULL, NULL),
(17, 'Thiết kế Web', 0, NULL, NULL),
(18, 'TT Thiết kế Web', 1, NULL, NULL),
(19, 'TT Cấu trúc dữ liệu và giải thuật', 1, NULL, NULL),
(20, 'TT Mạng máy tính', 1, NULL, NULL),
(21, 'Giáo dục quốc phòng và an ninh', 5, NULL, NULL),
(22, 'Giáo dục chính trị 1', 2, NULL, NULL),
(23, 'Tiếng Anh 3', 5, NULL, NULL),
(24, 'Hệ quản trị cơ sở dữ liệu', 0, NULL, NULL),
(25, 'Quản trị hệ thống mạng Windows', 0, NULL, NULL),
(26, 'Phương pháp lập trình hướng đối tượng', 0, NULL, NULL),
(27, 'LT Web PHP cơ bản', 0, NULL, NULL),
(28, 'TT Hệ quản trị cơ sở dữ liệu', 1, NULL, NULL),
(29, 'TT Quản trị hệ thống mạng Windows', 1, NULL, NULL),
(30, 'TT Phương pháp lập trình hướng đối tượng', 1, NULL, NULL),
(31, 'Giáo dục chính trị 2', 2, NULL, NULL),
(32, 'Tiếng Anh chuyên ngành CNTT', 0, NULL, NULL),
(33, 'Lập trình Windows + ĐAMH', 0, NULL, NULL),
(34, 'Lập trình Python', 0, NULL, NULL),
(35, 'Phân tích thiết kế hệ thống thông tin', 0, NULL, NULL),
(36, 'Ngôn ngữ lập trình Java', 0, NULL, NULL),
(37, 'Nodejs Platform', 0, NULL, NULL),
(38, 'TT Lập trình Windows', 1, NULL, NULL),
(39, 'Hệ điều hành Linux', 0, NULL, NULL),
(40, 'Dịch vụ mạng', 0, NULL, NULL),
(41, 'Cấu hình và quản trị thiết bị mạng Cisco', 0, NULL, NULL),
(42, 'Công nghệ phần mềm', 0, NULL, NULL),
(43, 'Kiểm thử phần mềm', 0, NULL, NULL),
(44, 'Công cụ và môi trường phát triển phần mềm', 0, NULL, NULL),
(45, 'Lập trình ASP.NET Core', 0, NULL, NULL),
(46, 'Lập trình Web PHP nâng cao', 0, NULL, NULL),
(47, 'Lập trình Front End', 0, NULL, NULL),
(48, 'Tiếng Anh 2/6', 5, NULL, NULL),
(49, 'Lập trình di động', 0, NULL, NULL),
(50, 'Lập trình nhúng', 0, NULL, NULL),
(51, 'Công nghệ lập trình đa nền tảng', 0, NULL, NULL),
(52, 'Thiết kế hệ thống mạng', 0, NULL, NULL),
(53, 'Bảo mật thiết bị mạng Cisco', 0, NULL, NULL),
(54, 'Đồ án Bảo mật thiết bị mạng Cisco', 0, NULL, NULL),
(55, 'Quản lý hệ thống Web và Mail Server', 0, NULL, NULL),
(56, 'An ninh mạng', 0, NULL, NULL),
(57, 'Quản trị mạng Linux', 0, NULL, NULL),
(58, 'Đồ án lập trình Web', 0, NULL, NULL),
(59, 'Thực tập Tốt nghiệp', 0, NULL, NULL),
(60, 'Đồ án Tốt nghiệp', 0, NULL, NULL),
(61, 'Thi Tốt nghiệp Chính trị', 0, NULL, NULL),
(62, 'Đồ án lập trình di động', 0, NULL, NULL),
(63, 'Đồ án Quản trị hệ thống mạng', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nam`
--

CREATE TABLE `nam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nam_bat_dau` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nam`
--

INSERT INTO `nam` (`id`, `nam_bat_dau`, `created_at`, `updated_at`) VALUES
(1, 2022, NULL, NULL),
(2, 2023, NULL, NULL),
(3, 2024, NULL, NULL),
(4, 2025, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nien_khoa`
--

CREATE TABLE `nien_khoa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten_nien_khoa` varchar(50) NOT NULL,
  `nam_bat_dau` year(4) NOT NULL,
  `nam_ket_thuc` year(4) NOT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nien_khoa`
--

INSERT INTO `nien_khoa` (`id`, `ten_nien_khoa`, `nam_bat_dau`, `nam_ket_thuc`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, '2022 - 2025', '2022', '2025', 1, '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(2, '2023 - 2026', '2023', '2026', 1, '2025-07-10 22:33:46', '2025-07-10 22:33:46'),
(3, '2024 - 2027', '2024', '2027', 1, '2025-07-10 22:33:46', '2025-07-10 22:33:46');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'gán vai trò', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(2, 'xem menu bảng điều khiển', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(3, 'danh sách vai trò', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(4, 'tạo vai trò', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(5, 'chỉnh sửa vai trò', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(6, 'xóa vai trò', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(7, 'danh sách quyền', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(8, 'tạo quyền', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(9, 'chỉnh sửa quyền', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(10, 'xóa quyền', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(11, 'gán quyền', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(12, 'danh sách chương trình đào tạo', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(13, 'danh sách biên bản', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(14, 'xem biên bản', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(15, 'tạo biên bản', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(16, 'chỉnh sửa biên bản', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(17, 'xóa biên bản', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(18, 'gửi biên bản', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(19, 'xoá sinh viên vắng', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(20, 'danh sách sinh viên liên hệ cấp lại mật khẩu', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(21, 'cập nhật sinh viên liên hệ cấp lại mật khẩu', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(22, 'xem tuần', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(23, 'tạo tuần', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(24, 'danh sách điểm môn học', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(25, 'chỉnh sửa điểm môn học', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(26, 'danh sách giảng viên', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(27, 'xem lịch dạy', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(28, 'danh sách sinh viên đăng ký giấy xác nhận', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(29, 'cập nhật sinh viên đăng ký giấy xác nhận', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(30, 'xem lịch học', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(31, 'danh sách lịch học', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(32, 'tạo lịch học', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(33, 'chỉnh sửa lịch học', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(34, 'xóa lịch học', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(35, 'sao chép tuần', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(36, 'lịch thi', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(37, 'tạo lịch thi', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(38, 'xem lớp học', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(39, 'danh sách sinh viên lớp học', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(40, 'nhập điểm rèn luyện', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(41, 'Sổ lên lớp', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(42, 'Tạo sổ lên lớp', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(43, 'danh sách phòng học', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(44, 'tạo phòng học', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(45, 'chỉnh sửa phòng học', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(46, 'danh sách sinh viên', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(47, 'chỉnh sửa chức vụ sinh viên', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(48, 'danh sách thông báo', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(49, 'xem thông báo', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(50, 'tạo thông báo', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(51, 'chỉnh sửa thông báo', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(52, 'xóa thông báo', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(53, 'gửi thông báo', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(54, 'thư ký tạo biên bản', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `phieu_len_lop`
--

CREATE TABLE `phieu_len_lop` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_lop_hoc_phan` bigint(20) UNSIGNED NOT NULL,
  `id_phong` bigint(20) UNSIGNED NOT NULL,
  `id_tuan` bigint(20) UNSIGNED NOT NULL,
  `tiet_bat_dau` int(11) NOT NULL DEFAULT 0,
  `so_tiet` int(11) NOT NULL DEFAULT 0,
  `ngay` date NOT NULL,
  `si_so` int(11) NOT NULL DEFAULT 0,
  `hien_dien` int(11) NOT NULL DEFAULT 0,
  `noi_dung` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phieu_len_lop`
--

INSERT INTO `phieu_len_lop` (`id`, `id_lop_hoc_phan`, `id_phong`, `id_tuan`, `tiet_bat_dau`, `so_tiet`, `ngay`, `si_so`, `hien_dien`, `noi_dung`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 3, '2025-06-02', 100, 100, 'Luật Lao Động', NULL, NULL),
(2, 2, 2, 1, 4, 3, '2025-06-02', 100, 100, 'Luật Lao Động', NULL, NULL),
(3, 2, 2, 1, 4, 3, '2025-06-05', 100, 100, 'Luật Lao Động', NULL, NULL),
(4, 2, 2, 1, 7, 3, '2025-06-05', 100, 100, 'Luật Lao Động', NULL, NULL),
(5, 2, 2, 1, 13, 2, '2025-06-06', 100, 100, 'Luật Lao Động', NULL, NULL),
(7, 3, 1, 158, 1, 3, '2025-08-11', 0, 4, 'a', '2025-08-10 22:17:45', '2025-08-10 22:17:45'),
(8, 4, 5, 158, 1, 3, '2025-08-12', 0, 6, 'aaaa', '2025-08-11 22:45:59', '2025-08-11 22:45:59');

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten` varchar(255) NOT NULL,
  `so_luong` int(11) NOT NULL DEFAULT 0,
  `loai_phong` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phong`
--

INSERT INTO `phong` (`id`, `ten`, `so_luong`, `loai_phong`, `created_at`, `updated_at`) VALUES
(1, 'F7.1', 50, 1, NULL, NULL),
(2, 'F7.2', 120, 1, NULL, NULL),
(3, 'F7.3', 70, 1, NULL, NULL),
(4, 'F7.4', 80, 1, NULL, NULL),
(5, 'F7.5', 90, 1, NULL, NULL),
(6, 'F7.6', 40, 1, NULL, NULL),
(7, 'Nhà thi đấu Phú Thọ', 200, 1, '2025-07-13 19:11:26', '2025-07-13 19:11:26'),
(8, 'F7.7', 100, 1, '2025-07-13 19:12:14', '2025-07-13 19:13:02'),
(9, 'F7.8', 100, 1, '2025-07-13 19:12:32', '2025-07-13 19:12:32'),
(10, 'F7.9', 50, 1, '2025-07-13 19:12:43', '2025-07-13 19:12:43'),
(11, 'F7.10', 50, 1, '2025-07-13 19:12:55', '2025-07-13 19:12:55'),
(12, 'F7.11', 100, 0, '2025-07-13 19:13:18', '2025-07-13 19:13:18'),
(13, 'F7.12', 100, 1, '2025-07-13 19:13:28', '2025-07-13 19:13:28'),
(14, 'F7.13', 200, 0, '2025-07-13 19:13:51', '2025-07-13 19:13:51'),
(15, 'F7.14', 100, 0, '2025-07-13 19:14:02', '2025-07-13 19:14:02'),
(16, 'F7.15', 100, 0, '2025-07-13 19:14:12', '2025-07-13 19:14:12'),
(17, 'F7.16', 100, 0, '2025-07-13 19:14:24', '2025-07-13 19:14:24'),
(18, 'Online', 1000, 2, '2025-07-13 19:15:03', '2025-07-13 19:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(2, 'trưởng phòng đào tạo', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(3, 'trưởng phòng công tác chính trị', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(4, 'giảng viên bộ môn', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(5, 'giảng viên chủ nhiệm', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54'),
(6, 'trưởng khoa', 'web', '2025-07-10 22:33:54', '2025-07-10 22:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(12, 2),
(13, 1),
(13, 5),
(14, 1),
(14, 5),
(15, 1),
(15, 5),
(16, 1),
(16, 5),
(17, 1),
(17, 5),
(18, 1),
(18, 5),
(19, 1),
(19, 5),
(20, 1),
(20, 3),
(21, 1),
(21, 3),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 4),
(25, 1),
(25, 4),
(26, 1),
(26, 3),
(27, 1),
(27, 4),
(28, 1),
(28, 3),
(29, 1),
(29, 3),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(36, 1),
(36, 2),
(37, 1),
(37, 2),
(38, 1),
(38, 5),
(39, 1),
(39, 5),
(40, 1),
(40, 5),
(41, 1),
(41, 4),
(42, 1),
(42, 4),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(46, 1),
(46, 3),
(46, 5),
(47, 1),
(47, 5),
(48, 1),
(48, 2),
(48, 3),
(48, 6),
(49, 1),
(49, 2),
(49, 3),
(49, 6),
(50, 1),
(50, 2),
(50, 3),
(50, 6),
(51, 1),
(51, 2),
(51, 3),
(51, 6),
(52, 1),
(52, 2),
(52, 3),
(52, 6),
(53, 1),
(53, 2),
(53, 3),
(53, 6),
(54, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0Yf8WNuX5D39xCJzDx9wsMkLXtgwoyomTPsyd48A', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieGdNM2VZbHJVNzhzcWl6Sm1la1hia0tEd201VkZIaVJ4eXNkN3E4ZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaW5odmllbi9saWNodGhpIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1NDoibG9naW5fc3R1ZGVudF81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE5O30=', 1744779105),
('3WwJsT3ciTWwZ0ULGnipN9fyXR5tweLGbJpTU5DZ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM2JENmdpN1pNU2RSMUlTN0FUNm9sRmFSZEttWDhQc2hYVkEyekFKeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9naWFuZ3ZpZW4vcGhpZXVsZW5sb3AvcXVhbmx5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1754891549),
('58y4V7Yt3KKVrHuzqAPB0zfFS8CZY2UZAAP5Knwy', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVmdYcEJVMUE2a3BhdkpWNjI3M3RIRVBkblV2UDVvenhxRENEYmRWQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1754977533),
('CpZ1SYsz838Efj2qI3mtpGZh1oUDPgkDVk6yjk7H', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieFFydjhNMWFqQjdEN2hlTzMxcE5pSW5OYmtkeGFlYUNBYURudnJRbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9naWFuZ3ZpZW4vcGhpZXVsZW5sb3AiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1754891536),
('EzkuBlZkY4D9Jpc9AcarZXAkoCj1HF2KV1ycFiGI', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTVhjODZoYzRtWDloQzZUeHBkZ1U5UmJKSnZ6SUhDaXFoaHZ1b1dkciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9naWFuZ3ZpZW4vdGFvLWxpY2gtaG9jLzUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1752469786),
('ItbdxCxiWjH92HgJ4sBYvphtgoIXPOrhk1q6nTsd', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSkJJUTQ0R3lZOHpKdHNReDFMV3N3UEVEcXlIZDZXbnRpc2JtWVB2cSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaW5odmllbi9kYW5nLWt5LWhvYy1naGVwL2xvcC1ob2MtZ2hlcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTQ6ImxvZ2luX3N0dWRlbnRfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxOTt9', 1752469807),
('ojEyq7BPVr3BmgfKYe8tvXl1RtbZpxjtP8seDY0j', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRGJWSjdZZmUzYThqTHoyckRJbnhSYmhpQXEwQlZNSkM4NjRkSUtQQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9naWFuZ3ZpZW4vcGhpZXVsZW5sb3AvZGV0YWlsczIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1754892911),
('PJbg939pw3maLtIRLnrQ5YMPVfqxDEI9iJpNMP9M', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGNCaXQ0RG1QMXk0NjZLamhOazRyeHdSMjBFcDR2aEpjRThNZEF6byI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1752469446),
('VlXCq38iClXAFmlw4g0q52wfpT3x5cmpZFDT6gpM', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSkQ5WmZOcmhBTXduOFBuQ29oclZwNU9FRW40VkxUT3QyaWRDRzJuMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9naWFuZ3ZpZW4vcGhpZXVsZW5sb3AiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1754977507);

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ma_sv` varchar(20) NOT NULL,
  `id_ho_so` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`id`, `ma_sv`, `id_ho_so`, `password`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, '03062201', 1, '$2y$12$wTa7nk2niGuBb0GQ/EVVW.vBU5irnRuOivw/RKqqp1swSPYgF2ngm', 0, NULL, NULL),
(2, '03062202', 2, '$2y$12$jMYjyOtsJA3KFWF80VQ40udX2pRkjcgK1dtM7z2O2n8Vcuo3oybEe', 0, NULL, NULL),
(3, '03062203', 3, '$2y$12$6QKM6G/.JL2TO.H2JZeUZuBXkHO2XnThwB54ph25DonLxUh1y88um', 0, NULL, NULL),
(4, '03062204', 4, '$2y$12$XEiaWG0AkT.PjQ9qH0dg9.hpp6welfJaeAjGbdxESf/ttFys06cHy', 0, NULL, NULL),
(5, '03062205', 5, '$2y$12$ezXGEcPGSkiVOYYOn.tmKuEzvK8D7utunInhgfWTd2DAcSWHuBDxS', 0, NULL, NULL),
(6, '03062206', 6, '$2y$12$MqdFLPhxss70u7z1XXOOJOmPDprhKYolJuNtTf7xu99nxeEOoQdnW', 0, NULL, NULL),
(7, '03062207', 7, '$2y$12$4ihmF6Z40xST4UFQLeNLiubVPKEQJx9BGRchwfMMJcB6NeZ91rEuW', 0, NULL, NULL),
(8, '03062208', 8, '$2y$12$5s.orrNiqvsHV4TA1yPqdefzx56cVTy/vaAguk5BQTx1QFGmO8e66', 0, NULL, NULL),
(9, '03062209', 9, '$2y$12$9N5qVS.hK6nsyIMCeTIj7.VCtgzZBW7T4U.IFxjCw0gBHOIdj3DYG', 0, NULL, NULL),
(10, '03062210', 10, '$2y$12$N22cQgP4Oplibg7oIrdrzuzUOXLFEaQsN6o.oLcvPX4ChlLk2VJYm', 0, NULL, NULL),
(11, '03062211', 11, '$2y$12$ugMbn6BZ3g6uL1KyGj0GGeGawGjRFMtdB3IxsXonthav/w4EbRira', 0, NULL, NULL),
(12, '03062212', 12, '$2y$12$Ku1R9A7VPL4.4UeTRVV81eKJ9QGQ1OjvuP9oWFGpZSSLRkoscaS36', 0, NULL, NULL),
(13, '03062301', 13, '$2y$12$DCm/L5CncBpz8znyFWM6iu4A3yZ2wJKDhIy4275jsGzSX.Lc32Rn6', 0, NULL, NULL),
(14, '03062302', 14, '$2y$12$7pa/9V1Dy8DJIVCl7OFY7ew2N2sRlXeiKEv2xhf64t9eH5usZWu4C', 0, NULL, NULL),
(15, '03062303', 15, '$2y$12$vlqS8OGD5bSiLJCpRIVCcu7OXO7H2B8cS/V72x23cltZ7bA8/nNTy', 0, NULL, NULL),
(16, '03062304', 16, '$2y$12$I8aQM5qh6AEyWR/UnKbWlOk2mKeoTRnTQURLFZRnquU3/eNa4jnmK', 0, NULL, NULL),
(17, '03062305', 17, '$2y$12$HzqX9.EKCvPUCcAM2.dFc.Lt1oQbYu2nAUFZUMa/v2dUZZHdU6I4C', 0, NULL, NULL),
(18, '03062306', 18, '$2y$12$3YtQi1iIKEfMdbK40ujKmOEdseM9kNy4eZn1t1oV9RoACXHEloIu2', 0, NULL, NULL),
(19, '03062307', 19, '$2y$12$hHJotEJ/YmqqBla4hVL8GemZeETAwlho8PzNhmJ3MisDmc4N4MIgy', 0, NULL, NULL),
(20, '03062308', 20, '$2y$12$DfEw3e0.HHdNFMOGOUeI9uCmvMmod0zVafXWdWgEG6Y41vqsI9JKi', 0, NULL, NULL),
(21, '03062309', 21, '$2y$12$ggJI8tSyWEuXOhd17JXTM.82hYqWSVN9BddxrSoyW9kRojlRWrvWC', 0, NULL, NULL),
(22, '03062310', 22, '$2y$12$VxoZq4gbunSuaT7ywDRao.mxq3JaDQQLNNkDM7DPZd3J76abAH9d2', 0, NULL, NULL),
(23, '03062311', 23, '$2y$12$PxxhrNFUvpLeqzRl/Ewir.hbYh6u3AsQ2U4tpQfzQa1YpYLoolb/y', 0, NULL, NULL),
(24, '03062312', 24, '$2y$12$ch.j//807LcgEcyV5qT5AeluYpKurHEU5tO68kIYSD7UMF1eAoEMi', 0, NULL, NULL),
(25, '03062401', 25, '$2y$12$Z9zYkuyGucFJ82unoTBe..1x2R5Ox8XCL8v24YFT4SjHS9O6EWdoe', 0, NULL, NULL),
(26, '03062402', 26, '$2y$12$YgEvvGU4iPqISYgtH/UGveGLYlQ3VwYPdVezUmxhOjr1ArDJKmuPa', 0, NULL, NULL),
(27, '03062403', 27, '$2y$12$5G2f0p0oraLmA6/WS3Pii.B9oydZQJBvch9z1wtdOIb5ZYIuDxioO', 0, NULL, NULL),
(28, '03062404', 28, '$2y$12$2zQrzHr7lVwJpla2mN0Kxe90M3Uwg2r3j3HaQ912sDGb5CF/jZhJ6', 0, NULL, NULL),
(29, '03062405', 29, '$2y$12$TkYqEVXVgieyH2XxZV6Zgu/f.ugcfN3lqh/o0oZrVuGCX74jqPxYq', 0, NULL, NULL),
(30, '03062406', 30, '$2y$12$DeeRN1kFr9F0P6WME/kz6.d6rzlVG07wVlVPr4wtQKvNyQj/uUZce', 0, NULL, NULL),
(31, '03062407', 31, '$2y$12$SYGhEdNIgYYYBx1ipcgGkeVuLDi9AMPAsJH7iXYc599Tq1onxEr2y', 0, NULL, NULL),
(32, '03062408', 32, '$2y$12$M0LZqHfeZZvzYGtfE6K5V.z5b6cgIo.mXRH3Nt8SmYmbFeZvuVeWK', 0, NULL, NULL),
(33, '03062409', 33, '$2y$12$/Hhpg753tfqJxqxm8En9ne8lsD8XZXgK17aOOLDBLZ6dARjHbooWq', 0, NULL, NULL),
(34, '03062410', 34, '$2y$12$nJBnmpmcPvE62s8x60mb9.DApmxde0kOI007R.QfvPtQHEvCSzXTO', 0, NULL, NULL),
(35, '03062411', 35, '$2y$12$pXiGfVQWev6GQIUgcBWAI.mtQXhGilJTdqTn1enA9SEGKmVZkV.9O', 0, NULL, NULL),
(36, '03062412', 36, '$2y$12$0w.Ra3OIwoSy/SQsHWR3I.P2aWqKxBefCf8gM/D.K/AlfDhMkNkGi', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tham_so`
--

CREATE TABLE `tham_so` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten_tham_so` varchar(100) NOT NULL,
  `gia_tri` varchar(255) NOT NULL,
  `mo_ta` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thoi_khoa_bieu`
--

CREATE TABLE `thoi_khoa_bieu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tuan` bigint(20) UNSIGNED NOT NULL,
  `id_lop_hoc_phan` bigint(20) UNSIGNED NOT NULL,
  `id_phong` bigint(20) UNSIGNED NOT NULL,
  `tiet_bat_dau` int(11) NOT NULL,
  `tiet_ket_thuc` int(11) NOT NULL,
  `ngay` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thoi_khoa_bieu`
--

INSERT INTO `thoi_khoa_bieu` (`id`, `id_tuan`, `id_lop_hoc_phan`, `id_phong`, `tiet_bat_dau`, `tiet_ket_thuc`, `ngay`, `created_at`, `updated_at`) VALUES
(2, 158, 4, 5, 1, 3, '2025-08-12', '2025-07-12 18:47:58', '2025-08-10 22:44:12'),
(3, 54, 5, 7, 2, 4, '2023-08-11', '2025-07-13 19:11:46', '2025-07-13 19:11:46'),
(4, 54, 6, 16, 7, 8, '2023-08-07', '2025-07-13 19:17:32', '2025-07-13 19:17:32'),
(5, 54, 7, 17, 9, 11, '2023-08-07', '2025-07-13 19:18:04', '2025-07-13 19:18:04'),
(6, 54, 8, 17, 7, 9, '2023-08-08', '2025-07-13 19:18:25', '2025-07-13 19:18:25'),
(7, 54, 9, 17, 10, 12, '2023-08-08', '2025-07-13 19:18:41', '2025-07-13 19:18:41'),
(9, 54, 10, 17, 7, 11, '2023-08-09', '2025-07-13 19:19:42', '2025-07-13 19:19:42'),
(10, 54, 11, 2, 7, 9, '2023-08-10', '2025-07-13 19:20:03', '2025-07-13 19:20:03'),
(11, 54, 12, 2, 10, 11, '2023-08-10', '2025-07-13 19:20:37', '2025-07-13 19:20:37'),
(12, 54, 13, 9, 1, 2, '2023-08-07', '2025-07-13 19:20:58', '2025-07-13 19:20:58'),
(13, 55, 5, 7, 2, 4, '2023-08-18', '2025-07-13 19:23:43', '2025-07-13 19:23:43'),
(14, 55, 6, 16, 7, 8, '2023-08-14', '2025-07-13 19:23:43', '2025-07-13 19:23:43'),
(15, 55, 7, 17, 9, 11, '2023-08-14', '2025-07-13 19:23:43', '2025-07-13 19:23:43'),
(16, 55, 8, 17, 7, 9, '2023-08-15', '2025-07-13 19:23:43', '2025-07-13 19:23:43'),
(17, 55, 9, 17, 10, 12, '2023-08-15', '2025-07-13 19:23:43', '2025-07-13 19:23:43'),
(18, 55, 10, 17, 7, 11, '2023-08-16', '2025-07-13 19:23:43', '2025-07-13 19:23:43'),
(19, 55, 11, 2, 7, 9, '2023-08-17', '2025-07-13 19:23:43', '2025-07-13 19:23:43'),
(20, 55, 12, 2, 10, 11, '2023-08-17', '2025-07-13 19:23:43', '2025-07-13 19:23:43'),
(21, 55, 13, 9, 1, 2, '2023-08-14', '2025-07-13 19:23:43', '2025-07-13 19:23:43'),
(22, 56, 5, 7, 2, 4, '2023-08-25', '2025-07-13 19:23:49', '2025-07-13 19:23:49'),
(23, 56, 6, 16, 7, 8, '2023-08-21', '2025-07-13 19:23:49', '2025-07-13 19:23:49'),
(24, 56, 7, 17, 9, 11, '2023-08-21', '2025-07-13 19:23:49', '2025-07-13 19:23:49'),
(25, 56, 8, 17, 7, 9, '2023-08-22', '2025-07-13 19:23:49', '2025-07-13 19:23:49'),
(26, 56, 9, 17, 10, 12, '2023-08-22', '2025-07-13 19:23:49', '2025-07-13 19:23:49'),
(27, 56, 10, 17, 7, 11, '2023-08-23', '2025-07-13 19:23:49', '2025-07-13 19:23:49'),
(28, 56, 11, 2, 7, 9, '2023-08-24', '2025-07-13 19:23:49', '2025-07-13 19:23:49'),
(29, 56, 12, 2, 10, 11, '2023-08-24', '2025-07-13 19:23:49', '2025-07-13 19:23:49'),
(30, 56, 13, 9, 1, 2, '2023-08-21', '2025-07-13 19:23:49', '2025-07-13 19:23:49'),
(31, 57, 5, 7, 2, 4, '2023-09-01', '2025-07-13 19:23:53', '2025-07-13 19:23:53'),
(32, 57, 6, 16, 7, 8, '2023-08-28', '2025-07-13 19:23:53', '2025-07-13 19:23:53'),
(33, 57, 7, 17, 9, 11, '2023-08-28', '2025-07-13 19:23:53', '2025-07-13 19:23:53'),
(34, 57, 8, 17, 7, 9, '2023-08-29', '2025-07-13 19:23:53', '2025-07-13 19:23:53'),
(35, 57, 9, 17, 10, 12, '2023-08-29', '2025-07-13 19:23:53', '2025-07-13 19:23:53'),
(36, 57, 10, 17, 7, 11, '2023-08-30', '2025-07-13 19:23:53', '2025-07-13 19:23:53'),
(37, 57, 11, 2, 7, 9, '2023-08-31', '2025-07-13 19:23:53', '2025-07-13 19:23:53'),
(38, 57, 12, 2, 10, 11, '2023-08-31', '2025-07-13 19:23:53', '2025-07-13 19:23:53'),
(39, 57, 13, 9, 1, 2, '2023-08-28', '2025-07-13 19:23:53', '2025-07-13 19:23:53'),
(40, 58, 5, 7, 2, 4, '2023-09-08', '2025-07-13 19:23:57', '2025-07-13 19:23:57'),
(41, 58, 6, 16, 7, 8, '2023-09-04', '2025-07-13 19:23:57', '2025-07-13 19:23:57'),
(42, 58, 7, 17, 9, 11, '2023-09-04', '2025-07-13 19:23:57', '2025-07-13 19:23:57'),
(43, 58, 8, 17, 7, 9, '2023-09-05', '2025-07-13 19:23:57', '2025-07-13 19:23:57'),
(44, 58, 9, 17, 10, 12, '2023-09-05', '2025-07-13 19:23:57', '2025-07-13 19:23:57'),
(45, 58, 10, 17, 7, 11, '2023-09-06', '2025-07-13 19:23:57', '2025-07-13 19:23:57'),
(46, 58, 11, 2, 7, 9, '2023-09-07', '2025-07-13 19:23:57', '2025-07-13 19:23:57'),
(47, 58, 12, 2, 10, 11, '2023-09-07', '2025-07-13 19:23:57', '2025-07-13 19:23:57'),
(48, 58, 13, 9, 1, 2, '2023-09-04', '2025-07-13 19:23:57', '2025-07-13 19:23:57'),
(49, 59, 5, 7, 2, 4, '2023-09-15', '2025-07-13 19:24:02', '2025-07-13 19:24:02'),
(50, 59, 6, 16, 7, 8, '2023-09-11', '2025-07-13 19:24:02', '2025-07-13 19:24:02'),
(51, 59, 7, 17, 9, 11, '2023-09-11', '2025-07-13 19:24:02', '2025-07-13 19:24:02'),
(52, 59, 8, 17, 7, 9, '2023-09-12', '2025-07-13 19:24:02', '2025-07-13 19:24:02'),
(53, 59, 9, 17, 10, 12, '2023-09-12', '2025-07-13 19:24:02', '2025-07-13 19:24:02'),
(54, 59, 10, 17, 7, 11, '2023-09-13', '2025-07-13 19:24:02', '2025-07-13 19:24:02'),
(55, 59, 11, 2, 7, 9, '2023-09-14', '2025-07-13 19:24:02', '2025-07-13 19:24:02'),
(56, 59, 12, 2, 10, 11, '2023-09-14', '2025-07-13 19:24:02', '2025-07-13 19:24:02'),
(57, 59, 13, 9, 1, 2, '2023-09-11', '2025-07-13 19:24:02', '2025-07-13 19:24:02'),
(58, 60, 5, 7, 2, 4, '2023-09-22', '2025-07-13 19:24:06', '2025-07-13 19:24:06'),
(59, 60, 6, 16, 7, 8, '2023-09-18', '2025-07-13 19:24:06', '2025-07-13 19:24:06'),
(60, 60, 7, 17, 9, 11, '2023-09-18', '2025-07-13 19:24:06', '2025-07-13 19:24:06'),
(61, 60, 8, 17, 7, 9, '2023-09-19', '2025-07-13 19:24:06', '2025-07-13 19:24:06'),
(62, 60, 9, 17, 10, 12, '2023-09-19', '2025-07-13 19:24:06', '2025-07-13 19:24:06'),
(63, 60, 10, 17, 7, 11, '2023-09-20', '2025-07-13 19:24:06', '2025-07-13 19:24:06'),
(64, 60, 11, 2, 7, 9, '2023-09-21', '2025-07-13 19:24:06', '2025-07-13 19:24:06'),
(65, 60, 12, 2, 10, 11, '2023-09-21', '2025-07-13 19:24:06', '2025-07-13 19:24:06'),
(66, 60, 13, 9, 1, 2, '2023-09-18', '2025-07-13 19:24:06', '2025-07-13 19:24:06'),
(67, 61, 5, 7, 2, 4, '2023-09-29', '2025-07-13 19:24:11', '2025-07-13 19:24:11'),
(68, 61, 6, 16, 7, 8, '2023-09-25', '2025-07-13 19:24:11', '2025-07-13 19:24:11'),
(69, 61, 7, 17, 9, 11, '2023-09-25', '2025-07-13 19:24:11', '2025-07-13 19:24:11'),
(70, 61, 8, 17, 7, 9, '2023-09-26', '2025-07-13 19:24:11', '2025-07-13 19:24:11'),
(71, 61, 9, 17, 10, 12, '2023-09-26', '2025-07-13 19:24:11', '2025-07-13 19:24:11'),
(72, 61, 10, 17, 7, 11, '2023-09-27', '2025-07-13 19:24:11', '2025-07-13 19:24:11'),
(73, 61, 11, 2, 7, 9, '2023-09-28', '2025-07-13 19:24:11', '2025-07-13 19:24:11'),
(74, 61, 12, 2, 10, 11, '2023-09-28', '2025-07-13 19:24:11', '2025-07-13 19:24:11'),
(75, 61, 13, 9, 1, 2, '2023-09-25', '2025-07-13 19:24:11', '2025-07-13 19:24:11'),
(76, 62, 5, 7, 2, 4, '2023-10-06', '2025-07-13 19:24:15', '2025-07-13 19:24:15'),
(77, 62, 6, 16, 7, 8, '2023-10-02', '2025-07-13 19:24:15', '2025-07-13 19:24:15'),
(78, 62, 7, 17, 9, 11, '2023-10-02', '2025-07-13 19:24:15', '2025-07-13 19:24:15'),
(79, 62, 8, 17, 7, 9, '2023-10-03', '2025-07-13 19:24:15', '2025-07-13 19:24:15'),
(80, 62, 9, 17, 10, 12, '2023-10-03', '2025-07-13 19:24:15', '2025-07-13 19:24:15'),
(81, 62, 10, 17, 7, 11, '2023-10-04', '2025-07-13 19:24:15', '2025-07-13 19:24:15'),
(82, 62, 11, 2, 7, 9, '2023-10-05', '2025-07-13 19:24:15', '2025-07-13 19:24:15'),
(83, 62, 12, 2, 10, 11, '2023-10-05', '2025-07-13 19:24:15', '2025-07-13 19:24:15'),
(84, 62, 13, 9, 1, 2, '2023-10-02', '2025-07-13 19:24:15', '2025-07-13 19:24:15'),
(85, 63, 5, 7, 2, 4, '2023-10-13', '2025-07-13 19:24:19', '2025-07-13 19:24:19'),
(86, 63, 6, 16, 7, 8, '2023-10-09', '2025-07-13 19:24:19', '2025-07-13 19:24:19'),
(87, 63, 7, 17, 9, 11, '2023-10-09', '2025-07-13 19:24:19', '2025-07-13 19:24:19'),
(88, 63, 8, 17, 7, 9, '2023-10-10', '2025-07-13 19:24:19', '2025-07-13 19:24:19'),
(89, 63, 9, 17, 10, 12, '2023-10-10', '2025-07-13 19:24:19', '2025-07-13 19:24:19'),
(90, 63, 10, 17, 7, 11, '2023-10-11', '2025-07-13 19:24:19', '2025-07-13 19:24:19'),
(91, 63, 11, 2, 7, 9, '2023-10-12', '2025-07-13 19:24:19', '2025-07-13 19:24:19'),
(92, 63, 12, 2, 10, 11, '2023-10-12', '2025-07-13 19:24:19', '2025-07-13 19:24:19'),
(93, 63, 13, 9, 1, 2, '2023-10-09', '2025-07-13 19:24:19', '2025-07-13 19:24:19'),
(94, 64, 5, 7, 2, 4, '2023-10-20', '2025-07-13 19:24:24', '2025-07-13 19:24:24'),
(95, 64, 6, 16, 7, 8, '2023-10-16', '2025-07-13 19:24:24', '2025-07-13 19:24:24'),
(96, 64, 7, 17, 9, 11, '2023-10-16', '2025-07-13 19:24:24', '2025-07-13 19:24:24'),
(97, 64, 8, 17, 7, 9, '2023-10-17', '2025-07-13 19:24:24', '2025-07-13 19:24:24'),
(98, 64, 9, 17, 10, 12, '2023-10-17', '2025-07-13 19:24:24', '2025-07-13 19:24:24'),
(99, 64, 10, 17, 7, 11, '2023-10-18', '2025-07-13 19:24:24', '2025-07-13 19:24:24'),
(100, 64, 11, 2, 7, 9, '2023-10-19', '2025-07-13 19:24:24', '2025-07-13 19:24:24'),
(101, 64, 12, 2, 10, 11, '2023-10-19', '2025-07-13 19:24:24', '2025-07-13 19:24:24'),
(102, 64, 13, 9, 1, 2, '2023-10-16', '2025-07-13 19:24:24', '2025-07-13 19:24:24'),
(103, 65, 5, 7, 2, 4, '2023-10-27', '2025-07-13 19:24:28', '2025-07-13 19:24:28'),
(104, 65, 6, 16, 7, 8, '2023-10-23', '2025-07-13 19:24:28', '2025-07-13 19:24:28'),
(105, 65, 7, 17, 9, 11, '2023-10-23', '2025-07-13 19:24:28', '2025-07-13 19:24:28'),
(106, 65, 8, 17, 7, 9, '2023-10-24', '2025-07-13 19:24:28', '2025-07-13 19:24:28'),
(107, 65, 9, 17, 10, 12, '2023-10-24', '2025-07-13 19:24:28', '2025-07-13 19:24:28'),
(108, 65, 10, 17, 7, 11, '2023-10-25', '2025-07-13 19:24:28', '2025-07-13 19:24:28'),
(109, 65, 11, 2, 7, 9, '2023-10-26', '2025-07-13 19:24:28', '2025-07-13 19:24:28'),
(110, 65, 12, 2, 10, 11, '2023-10-26', '2025-07-13 19:24:28', '2025-07-13 19:24:28'),
(111, 65, 13, 9, 1, 2, '2023-10-23', '2025-07-13 19:24:28', '2025-07-13 19:24:28'),
(112, 66, 5, 7, 2, 4, '2023-11-03', '2025-07-13 19:24:35', '2025-07-13 19:24:35'),
(113, 66, 6, 16, 7, 8, '2023-10-30', '2025-07-13 19:24:35', '2025-07-13 19:24:35'),
(114, 66, 7, 17, 9, 11, '2023-10-30', '2025-07-13 19:24:35', '2025-07-13 19:24:35'),
(115, 66, 8, 17, 7, 9, '2023-10-31', '2025-07-13 19:24:35', '2025-07-13 19:24:35'),
(116, 66, 9, 17, 10, 12, '2023-10-31', '2025-07-13 19:24:35', '2025-07-13 19:24:35'),
(117, 66, 10, 17, 7, 11, '2023-11-01', '2025-07-13 19:24:35', '2025-07-13 19:24:35'),
(118, 66, 11, 2, 7, 9, '2023-11-02', '2025-07-13 19:24:35', '2025-07-13 19:24:35'),
(119, 66, 12, 2, 10, 11, '2023-11-02', '2025-07-13 19:24:35', '2025-07-13 19:24:35'),
(120, 66, 13, 9, 1, 2, '2023-10-30', '2025-07-13 19:24:35', '2025-07-13 19:24:35'),
(121, 67, 5, 7, 2, 4, '2023-11-10', '2025-07-13 19:24:39', '2025-07-13 19:24:39'),
(122, 67, 6, 16, 7, 8, '2023-11-06', '2025-07-13 19:24:39', '2025-07-13 19:24:39'),
(123, 67, 7, 17, 9, 11, '2023-11-06', '2025-07-13 19:24:39', '2025-07-13 19:24:39'),
(124, 67, 8, 17, 7, 9, '2023-11-07', '2025-07-13 19:24:39', '2025-07-13 19:24:39'),
(125, 67, 9, 17, 10, 12, '2023-11-07', '2025-07-13 19:24:39', '2025-07-13 19:24:39'),
(126, 67, 10, 17, 7, 11, '2023-11-08', '2025-07-13 19:24:39', '2025-07-13 19:24:39'),
(127, 67, 11, 2, 7, 9, '2023-11-09', '2025-07-13 19:24:39', '2025-07-13 19:24:39'),
(128, 67, 12, 2, 10, 11, '2023-11-09', '2025-07-13 19:24:39', '2025-07-13 19:24:39'),
(129, 67, 13, 9, 1, 2, '2023-11-06', '2025-07-13 19:24:39', '2025-07-13 19:24:39'),
(131, 68, 6, 16, 7, 8, '2023-11-13', '2025-07-13 19:24:43', '2025-07-13 19:24:43'),
(132, 68, 7, 17, 9, 11, '2023-11-13', '2025-07-13 19:24:43', '2025-07-13 19:24:43'),
(133, 68, 8, 17, 7, 9, '2023-11-14', '2025-07-13 19:24:43', '2025-07-13 19:24:43'),
(134, 68, 9, 17, 10, 12, '2023-11-14', '2025-07-13 19:24:43', '2025-07-13 19:24:43'),
(135, 68, 10, 17, 7, 11, '2023-11-15', '2025-07-13 19:24:43', '2025-07-13 19:24:43'),
(136, 68, 11, 2, 7, 9, '2023-11-16', '2025-07-13 19:24:43', '2025-07-13 19:24:43'),
(137, 68, 12, 2, 10, 11, '2023-11-16', '2025-07-13 19:24:43', '2025-07-13 19:24:43'),
(138, 68, 13, 9, 1, 2, '2023-11-13', '2025-07-13 19:24:43', '2025-07-13 19:24:43'),
(139, 77, 14, 7, 2, 4, '2024-01-20', '2025-07-13 19:25:39', '2025-07-13 19:25:39'),
(140, 77, 15, 17, 7, 8, '2024-01-15', '2025-07-13 19:27:08', '2025-07-13 19:27:08'),
(141, 77, 16, 17, 9, 11, '2024-01-15', '2025-07-13 19:27:56', '2025-07-13 19:27:56'),
(142, 77, 17, 3, 7, 9, '2024-01-16', '2025-07-13 19:28:41', '2025-07-13 19:28:41'),
(143, 77, 15, 16, 10, 11, '2024-01-16', '2025-07-13 19:28:56', '2025-07-13 19:28:56'),
(144, 77, 18, 11, 7, 9, '2024-01-17', '2025-07-13 19:29:23', '2025-07-13 19:29:23'),
(145, 77, 16, 17, 10, 11, '2024-01-17', '2025-07-13 19:29:42', '2025-07-13 19:29:42'),
(146, 77, 19, 16, 7, 9, '2024-01-18', '2025-07-13 19:30:25', '2025-07-13 19:30:25'),
(147, 77, 20, 3, 10, 11, '2024-01-18', '2025-07-13 19:30:43', '2025-07-13 19:30:43'),
(148, 77, 20, 3, 7, 8, '2024-01-19', '2025-07-13 19:31:06', '2025-07-13 19:31:06'),
(149, 77, 21, 10, 9, 10, '2024-01-19', '2025-07-13 19:31:24', '2025-07-13 19:31:24'),
(150, 78, 14, 7, 2, 4, '2024-01-27', '2025-07-13 19:31:38', '2025-07-13 19:31:38'),
(151, 78, 15, 17, 7, 8, '2024-01-22', '2025-07-13 19:31:38', '2025-07-13 19:31:38'),
(152, 78, 16, 17, 9, 11, '2024-01-22', '2025-07-13 19:31:38', '2025-07-13 19:31:38'),
(153, 78, 17, 3, 7, 9, '2024-01-23', '2025-07-13 19:31:38', '2025-07-13 19:31:38'),
(154, 78, 15, 16, 10, 11, '2024-01-23', '2025-07-13 19:31:38', '2025-07-13 19:31:38'),
(155, 78, 18, 11, 7, 9, '2024-01-24', '2025-07-13 19:31:38', '2025-07-13 19:31:38'),
(156, 78, 16, 17, 10, 11, '2024-01-24', '2025-07-13 19:31:38', '2025-07-13 19:31:38'),
(157, 78, 19, 16, 7, 9, '2024-01-25', '2025-07-13 19:31:38', '2025-07-13 19:31:38'),
(158, 78, 20, 3, 10, 11, '2024-01-25', '2025-07-13 19:31:38', '2025-07-13 19:31:38'),
(159, 78, 20, 3, 7, 8, '2024-01-26', '2025-07-13 19:31:38', '2025-07-13 19:31:38'),
(160, 78, 21, 10, 9, 10, '2024-01-26', '2025-07-13 19:31:38', '2025-07-13 19:31:38'),
(161, 79, 14, 7, 2, 4, '2024-02-03', '2025-07-13 19:34:11', '2025-07-13 19:34:11'),
(162, 79, 15, 17, 7, 8, '2024-01-29', '2025-07-13 19:34:11', '2025-07-13 19:34:11'),
(163, 79, 16, 17, 9, 11, '2024-01-29', '2025-07-13 19:34:11', '2025-07-13 19:34:11'),
(164, 79, 17, 3, 7, 9, '2024-01-30', '2025-07-13 19:34:11', '2025-07-13 19:34:11'),
(165, 79, 15, 16, 10, 11, '2024-01-30', '2025-07-13 19:34:11', '2025-07-13 19:34:11'),
(166, 79, 18, 11, 7, 9, '2024-01-31', '2025-07-13 19:34:11', '2025-07-13 19:34:11'),
(167, 79, 16, 17, 10, 11, '2024-01-31', '2025-07-13 19:34:11', '2025-07-13 19:34:11'),
(168, 79, 19, 16, 7, 9, '2024-02-01', '2025-07-13 19:34:11', '2025-07-13 19:34:11'),
(169, 79, 20, 3, 10, 11, '2024-02-01', '2025-07-13 19:34:11', '2025-07-13 19:34:11'),
(170, 79, 20, 3, 7, 8, '2024-02-02', '2025-07-13 19:34:11', '2025-07-13 19:34:11'),
(171, 79, 21, 10, 9, 10, '2024-02-02', '2025-07-13 19:34:11', '2025-07-13 19:34:11'),
(172, 80, 14, 7, 2, 4, '2024-02-10', '2025-07-13 19:34:15', '2025-07-13 19:34:15'),
(173, 80, 15, 17, 7, 8, '2024-02-05', '2025-07-13 19:34:15', '2025-07-13 19:34:15'),
(174, 80, 16, 17, 9, 11, '2024-02-05', '2025-07-13 19:34:15', '2025-07-13 19:34:15'),
(175, 80, 17, 3, 7, 9, '2024-02-06', '2025-07-13 19:34:15', '2025-07-13 19:34:15'),
(176, 80, 15, 16, 10, 11, '2024-02-06', '2025-07-13 19:34:15', '2025-07-13 19:34:15'),
(177, 80, 18, 11, 7, 9, '2024-02-07', '2025-07-13 19:34:15', '2025-07-13 19:34:15'),
(178, 80, 16, 17, 10, 11, '2024-02-07', '2025-07-13 19:34:15', '2025-07-13 19:34:15'),
(179, 80, 19, 16, 7, 9, '2024-02-08', '2025-07-13 19:34:15', '2025-07-13 19:34:15'),
(180, 80, 20, 3, 10, 11, '2024-02-08', '2025-07-13 19:34:15', '2025-07-13 19:34:15'),
(181, 80, 20, 3, 7, 8, '2024-02-09', '2025-07-13 19:34:15', '2025-07-13 19:34:15'),
(182, 80, 21, 10, 9, 10, '2024-02-09', '2025-07-13 19:34:15', '2025-07-13 19:34:15'),
(183, 81, 14, 7, 2, 4, '2024-02-17', '2025-07-13 19:34:19', '2025-07-13 19:34:19'),
(184, 81, 15, 17, 7, 8, '2024-02-12', '2025-07-13 19:34:19', '2025-07-13 19:34:19'),
(185, 81, 16, 17, 9, 11, '2024-02-12', '2025-07-13 19:34:19', '2025-07-13 19:34:19'),
(186, 81, 17, 3, 7, 9, '2024-02-13', '2025-07-13 19:34:19', '2025-07-13 19:34:19'),
(187, 81, 15, 16, 10, 11, '2024-02-13', '2025-07-13 19:34:19', '2025-07-13 19:34:19'),
(188, 81, 18, 11, 7, 9, '2024-02-14', '2025-07-13 19:34:19', '2025-07-13 19:34:19'),
(189, 81, 16, 17, 10, 11, '2024-02-14', '2025-07-13 19:34:19', '2025-07-13 19:34:19'),
(190, 81, 19, 16, 7, 9, '2024-02-15', '2025-07-13 19:34:19', '2025-07-13 19:34:19'),
(191, 81, 20, 3, 10, 11, '2024-02-15', '2025-07-13 19:34:19', '2025-07-13 19:34:19'),
(192, 81, 20, 3, 7, 8, '2024-02-16', '2025-07-13 19:34:19', '2025-07-13 19:34:19'),
(193, 81, 21, 10, 9, 10, '2024-02-16', '2025-07-13 19:34:19', '2025-07-13 19:34:19'),
(194, 82, 14, 7, 2, 4, '2024-02-24', '2025-07-13 19:34:23', '2025-07-13 19:34:23'),
(195, 82, 15, 17, 7, 8, '2024-02-19', '2025-07-13 19:34:23', '2025-07-13 19:34:23'),
(196, 82, 16, 17, 9, 11, '2024-02-19', '2025-07-13 19:34:23', '2025-07-13 19:34:23'),
(197, 82, 17, 3, 7, 9, '2024-02-20', '2025-07-13 19:34:23', '2025-07-13 19:34:23'),
(198, 82, 15, 16, 10, 11, '2024-02-20', '2025-07-13 19:34:23', '2025-07-13 19:34:23'),
(199, 82, 18, 11, 7, 9, '2024-02-21', '2025-07-13 19:34:23', '2025-07-13 19:34:23'),
(200, 82, 16, 17, 10, 11, '2024-02-21', '2025-07-13 19:34:23', '2025-07-13 19:34:23'),
(201, 82, 19, 16, 7, 9, '2024-02-22', '2025-07-13 19:34:23', '2025-07-13 19:34:23'),
(202, 82, 20, 3, 10, 11, '2024-02-22', '2025-07-13 19:34:23', '2025-07-13 19:34:23'),
(203, 82, 20, 3, 7, 8, '2024-02-23', '2025-07-13 19:34:23', '2025-07-13 19:34:23'),
(204, 82, 21, 10, 9, 10, '2024-02-23', '2025-07-13 19:34:23', '2025-07-13 19:34:23'),
(205, 83, 14, 7, 2, 4, '2024-03-02', '2025-07-13 19:34:26', '2025-07-13 19:34:26'),
(206, 83, 15, 17, 7, 8, '2024-02-26', '2025-07-13 19:34:26', '2025-07-13 19:34:26'),
(207, 83, 16, 17, 9, 11, '2024-02-26', '2025-07-13 19:34:26', '2025-07-13 19:34:26'),
(208, 83, 17, 3, 7, 9, '2024-02-27', '2025-07-13 19:34:26', '2025-07-13 19:34:26'),
(209, 83, 15, 16, 10, 11, '2024-02-27', '2025-07-13 19:34:26', '2025-07-13 19:34:26'),
(210, 83, 18, 11, 7, 9, '2024-02-28', '2025-07-13 19:34:26', '2025-07-13 19:34:26'),
(211, 83, 16, 17, 10, 11, '2024-02-28', '2025-07-13 19:34:26', '2025-07-13 19:34:26'),
(212, 83, 19, 16, 7, 9, '2024-02-29', '2025-07-13 19:34:26', '2025-07-13 19:34:26'),
(213, 83, 20, 3, 10, 11, '2024-02-29', '2025-07-13 19:34:26', '2025-07-13 19:34:26'),
(214, 83, 20, 3, 7, 8, '2024-03-01', '2025-07-13 19:34:26', '2025-07-13 19:34:26'),
(215, 83, 21, 10, 9, 10, '2024-03-01', '2025-07-13 19:34:26', '2025-07-13 19:34:26'),
(216, 84, 14, 7, 2, 4, '2024-03-09', '2025-07-13 19:34:31', '2025-07-13 19:34:31'),
(217, 84, 15, 17, 7, 8, '2024-03-04', '2025-07-13 19:34:31', '2025-07-13 19:34:31'),
(218, 84, 16, 17, 9, 11, '2024-03-04', '2025-07-13 19:34:31', '2025-07-13 19:34:31'),
(219, 84, 17, 3, 7, 9, '2024-03-05', '2025-07-13 19:34:31', '2025-07-13 19:34:31'),
(220, 84, 15, 16, 10, 11, '2024-03-05', '2025-07-13 19:34:31', '2025-07-13 19:34:31'),
(221, 84, 18, 11, 7, 9, '2024-03-06', '2025-07-13 19:34:31', '2025-07-13 19:34:31'),
(222, 84, 16, 17, 10, 11, '2024-03-06', '2025-07-13 19:34:31', '2025-07-13 19:34:31'),
(223, 84, 19, 16, 7, 9, '2024-03-07', '2025-07-13 19:34:31', '2025-07-13 19:34:31'),
(224, 84, 20, 3, 10, 11, '2024-03-07', '2025-07-13 19:34:31', '2025-07-13 19:34:31'),
(225, 84, 20, 3, 7, 8, '2024-03-08', '2025-07-13 19:34:31', '2025-07-13 19:34:31'),
(226, 84, 21, 10, 9, 10, '2024-03-08', '2025-07-13 19:34:31', '2025-07-13 19:34:31'),
(227, 85, 14, 7, 2, 4, '2024-03-16', '2025-07-13 19:34:34', '2025-07-13 19:34:34'),
(228, 85, 15, 17, 7, 8, '2024-03-11', '2025-07-13 19:34:34', '2025-07-13 19:34:34'),
(229, 85, 16, 17, 9, 11, '2024-03-11', '2025-07-13 19:34:34', '2025-07-13 19:34:34'),
(230, 85, 17, 3, 7, 9, '2024-03-12', '2025-07-13 19:34:34', '2025-07-13 19:34:34'),
(231, 85, 15, 16, 10, 11, '2024-03-12', '2025-07-13 19:34:34', '2025-07-13 19:34:34'),
(232, 85, 18, 11, 7, 9, '2024-03-13', '2025-07-13 19:34:34', '2025-07-13 19:34:34'),
(233, 85, 16, 17, 10, 11, '2024-03-13', '2025-07-13 19:34:34', '2025-07-13 19:34:34'),
(234, 85, 19, 16, 7, 9, '2024-03-14', '2025-07-13 19:34:34', '2025-07-13 19:34:34'),
(235, 85, 20, 3, 10, 11, '2024-03-14', '2025-07-13 19:34:34', '2025-07-13 19:34:34'),
(236, 85, 20, 3, 7, 8, '2024-03-15', '2025-07-13 19:34:34', '2025-07-13 19:34:34'),
(237, 85, 21, 10, 9, 10, '2024-03-15', '2025-07-13 19:34:34', '2025-07-13 19:34:34'),
(238, 86, 14, 7, 2, 4, '2024-03-23', '2025-07-13 19:34:41', '2025-07-13 19:34:41'),
(239, 86, 15, 17, 7, 8, '2024-03-18', '2025-07-13 19:34:41', '2025-07-13 19:34:41'),
(240, 86, 16, 17, 9, 11, '2024-03-18', '2025-07-13 19:34:41', '2025-07-13 19:34:41'),
(241, 86, 17, 3, 7, 9, '2024-03-19', '2025-07-13 19:34:41', '2025-07-13 19:34:41'),
(242, 86, 15, 16, 10, 11, '2024-03-19', '2025-07-13 19:34:41', '2025-07-13 19:34:41'),
(243, 86, 18, 11, 7, 9, '2024-03-20', '2025-07-13 19:34:41', '2025-07-13 19:34:41'),
(244, 86, 16, 17, 10, 11, '2024-03-20', '2025-07-13 19:34:41', '2025-07-13 19:34:41'),
(245, 86, 19, 16, 7, 9, '2024-03-21', '2025-07-13 19:34:41', '2025-07-13 19:34:41'),
(246, 86, 20, 3, 10, 11, '2024-03-21', '2025-07-13 19:34:41', '2025-07-13 19:34:41'),
(247, 86, 20, 3, 7, 8, '2024-03-22', '2025-07-13 19:34:41', '2025-07-13 19:34:41'),
(248, 86, 21, 10, 9, 10, '2024-03-22', '2025-07-13 19:34:41', '2025-07-13 19:34:41'),
(249, 87, 14, 7, 2, 4, '2024-03-30', '2025-07-13 19:34:46', '2025-07-13 19:34:46'),
(250, 87, 15, 17, 7, 8, '2024-03-25', '2025-07-13 19:34:46', '2025-07-13 19:34:46'),
(251, 87, 16, 17, 9, 11, '2024-03-25', '2025-07-13 19:34:46', '2025-07-13 19:34:46'),
(252, 87, 17, 3, 7, 9, '2024-03-26', '2025-07-13 19:34:46', '2025-07-13 19:34:46'),
(253, 87, 15, 16, 10, 11, '2024-03-26', '2025-07-13 19:34:46', '2025-07-13 19:34:46'),
(254, 87, 18, 11, 7, 9, '2024-03-27', '2025-07-13 19:34:46', '2025-07-13 19:34:46'),
(255, 87, 16, 17, 10, 11, '2024-03-27', '2025-07-13 19:34:46', '2025-07-13 19:34:46'),
(256, 87, 19, 16, 7, 9, '2024-03-28', '2025-07-13 19:34:46', '2025-07-13 19:34:46'),
(257, 87, 20, 3, 10, 11, '2024-03-28', '2025-07-13 19:34:46', '2025-07-13 19:34:46'),
(258, 87, 20, 3, 7, 8, '2024-03-29', '2025-07-13 19:34:46', '2025-07-13 19:34:46'),
(259, 87, 21, 10, 9, 10, '2024-03-29', '2025-07-13 19:34:46', '2025-07-13 19:34:46'),
(260, 88, 14, 7, 2, 4, '2024-04-06', '2025-07-13 19:34:49', '2025-07-13 19:34:49'),
(261, 88, 15, 17, 7, 8, '2024-04-01', '2025-07-13 19:34:49', '2025-07-13 19:34:49'),
(262, 88, 16, 17, 9, 11, '2024-04-01', '2025-07-13 19:34:49', '2025-07-13 19:34:49'),
(263, 88, 17, 3, 7, 9, '2024-04-02', '2025-07-13 19:34:49', '2025-07-13 19:34:49'),
(264, 88, 15, 16, 10, 11, '2024-04-02', '2025-07-13 19:34:49', '2025-07-13 19:34:49'),
(265, 88, 18, 11, 7, 9, '2024-04-03', '2025-07-13 19:34:49', '2025-07-13 19:34:49'),
(266, 88, 16, 17, 10, 11, '2024-04-03', '2025-07-13 19:34:49', '2025-07-13 19:34:49'),
(267, 88, 19, 16, 7, 9, '2024-04-04', '2025-07-13 19:34:49', '2025-07-13 19:34:49'),
(268, 88, 20, 3, 10, 11, '2024-04-04', '2025-07-13 19:34:49', '2025-07-13 19:34:49'),
(269, 88, 20, 3, 7, 8, '2024-04-05', '2025-07-13 19:34:49', '2025-07-13 19:34:49'),
(270, 88, 21, 10, 9, 10, '2024-04-05', '2025-07-13 19:34:49', '2025-07-13 19:34:49'),
(271, 89, 14, 7, 2, 4, '2024-04-13', '2025-07-13 19:34:56', '2025-07-13 19:34:56'),
(272, 89, 15, 17, 7, 8, '2024-04-08', '2025-07-13 19:34:56', '2025-07-13 19:34:56'),
(273, 89, 16, 17, 9, 11, '2024-04-08', '2025-07-13 19:34:56', '2025-07-13 19:34:56'),
(274, 89, 17, 3, 7, 9, '2024-04-09', '2025-07-13 19:34:56', '2025-07-13 19:34:56'),
(275, 89, 15, 16, 10, 11, '2024-04-09', '2025-07-13 19:34:56', '2025-07-13 19:34:56'),
(276, 89, 18, 11, 7, 9, '2024-04-10', '2025-07-13 19:34:56', '2025-07-13 19:34:56'),
(277, 89, 16, 17, 10, 11, '2024-04-10', '2025-07-13 19:34:56', '2025-07-13 19:34:56'),
(278, 89, 19, 16, 7, 9, '2024-04-11', '2025-07-13 19:34:56', '2025-07-13 19:34:56'),
(279, 89, 20, 3, 10, 11, '2024-04-11', '2025-07-13 19:34:56', '2025-07-13 19:34:56'),
(280, 89, 20, 3, 7, 8, '2024-04-12', '2025-07-13 19:34:56', '2025-07-13 19:34:56'),
(281, 89, 21, 10, 9, 10, '2024-04-12', '2025-07-13 19:34:56', '2025-07-13 19:34:56'),
(282, 90, 14, 7, 2, 4, '2024-04-20', '2025-07-13 19:35:00', '2025-07-13 19:35:00'),
(283, 90, 15, 17, 7, 8, '2024-04-15', '2025-07-13 19:35:00', '2025-07-13 19:35:00'),
(284, 90, 16, 17, 9, 11, '2024-04-15', '2025-07-13 19:35:00', '2025-07-13 19:35:00'),
(285, 90, 17, 3, 7, 9, '2024-04-16', '2025-07-13 19:35:00', '2025-07-13 19:35:00'),
(286, 90, 15, 16, 10, 11, '2024-04-16', '2025-07-13 19:35:00', '2025-07-13 19:35:00'),
(287, 90, 18, 11, 7, 9, '2024-04-17', '2025-07-13 19:35:00', '2025-07-13 19:35:00'),
(288, 90, 16, 17, 10, 11, '2024-04-17', '2025-07-13 19:35:00', '2025-07-13 19:35:00'),
(289, 90, 19, 16, 7, 9, '2024-04-18', '2025-07-13 19:35:00', '2025-07-13 19:35:00'),
(290, 90, 20, 3, 10, 11, '2024-04-18', '2025-07-13 19:35:00', '2025-07-13 19:35:00'),
(291, 90, 20, 3, 7, 8, '2024-04-19', '2025-07-13 19:35:00', '2025-07-13 19:35:00'),
(292, 90, 21, 10, 9, 10, '2024-04-19', '2025-07-13 19:35:00', '2025-07-13 19:35:00'),
(294, 91, 15, 17, 7, 8, '2024-04-22', '2025-07-13 19:35:04', '2025-07-13 19:35:04'),
(295, 91, 16, 17, 9, 11, '2024-04-22', '2025-07-13 19:35:04', '2025-07-13 19:35:04'),
(296, 91, 17, 3, 7, 9, '2024-04-23', '2025-07-13 19:35:04', '2025-07-13 19:35:04'),
(297, 91, 15, 16, 10, 11, '2024-04-23', '2025-07-13 19:35:04', '2025-07-13 19:35:04'),
(298, 91, 18, 11, 7, 9, '2024-04-24', '2025-07-13 19:35:04', '2025-07-13 19:35:04'),
(299, 91, 16, 17, 10, 11, '2024-04-24', '2025-07-13 19:35:04', '2025-07-13 19:35:04'),
(300, 91, 19, 16, 7, 9, '2024-04-25', '2025-07-13 19:35:04', '2025-07-13 19:35:04'),
(301, 91, 20, 3, 10, 11, '2024-04-25', '2025-07-13 19:35:04', '2025-07-13 19:35:04'),
(302, 91, 20, 3, 7, 8, '2024-04-26', '2025-07-13 19:35:04', '2025-07-13 19:35:04'),
(303, 91, 21, 10, 9, 10, '2024-04-26', '2025-07-13 19:35:04', '2025-07-13 19:35:04'),
(304, 105, 22, 17, 7, 9, '2024-08-05', '2025-07-13 19:35:34', '2025-07-13 19:35:34'),
(305, 105, 23, 17, 10, 11, '2024-08-05', '2025-07-13 19:35:57', '2025-07-13 19:35:57'),
(306, 105, 24, 17, 7, 9, '2024-08-06', '2025-07-13 19:36:18', '2025-07-13 19:36:18'),
(307, 105, 25, 17, 10, 12, '2024-08-06', '2025-07-13 19:37:15', '2025-07-13 19:37:15'),
(308, 105, 26, 2, 7, 9, '2024-08-07', '2025-07-13 19:37:43', '2025-07-13 19:37:43'),
(309, 105, 27, 16, 10, 12, '2024-08-07', '2025-07-13 19:38:48', '2025-07-13 19:38:48'),
(310, 105, 28, 2, 7, 9, '2024-08-08', '2025-07-13 19:39:04', '2025-07-13 19:39:04'),
(311, 128, 29, 17, 7, 9, '2025-01-13', '2025-07-13 19:40:40', '2025-07-13 19:40:40'),
(312, 128, 30, 17, 10, 12, '2025-01-13', '2025-07-13 19:40:59', '2025-07-13 19:40:59'),
(313, 128, 31, 1, 7, 11, '2025-01-14', '2025-07-13 19:41:26', '2025-07-13 19:41:26'),
(314, 128, 32, 3, 7, 9, '2025-01-15', '2025-07-13 19:41:40', '2025-07-13 19:41:40'),
(315, 128, 33, 2, 10, 12, '2025-01-15', '2025-07-13 19:42:01', '2025-07-13 19:42:01'),
(316, 128, 34, 2, 7, 9, '2025-01-16', '2025-07-13 19:42:14', '2025-07-13 19:42:14'),
(317, 128, 35, 3, 10, 12, '2025-01-16', '2025-07-13 19:42:30', '2025-07-13 19:42:30'),
(318, 128, 36, 1, 7, 9, '2025-01-17', '2025-07-13 19:42:42', '2025-07-13 19:42:42'),
(319, 106, 22, 17, 7, 9, '2024-08-12', '2025-07-13 19:43:24', '2025-07-13 19:43:24'),
(320, 106, 23, 17, 10, 11, '2024-08-12', '2025-07-13 19:43:24', '2025-07-13 19:43:24'),
(321, 106, 24, 17, 7, 9, '2024-08-13', '2025-07-13 19:43:24', '2025-07-13 19:43:24'),
(322, 106, 25, 17, 10, 12, '2024-08-13', '2025-07-13 19:43:24', '2025-07-13 19:43:24'),
(323, 106, 26, 2, 7, 9, '2024-08-14', '2025-07-13 19:43:24', '2025-07-13 19:43:24'),
(324, 106, 27, 16, 10, 12, '2024-08-14', '2025-07-13 19:43:24', '2025-07-13 19:43:24'),
(325, 106, 28, 2, 7, 9, '2024-08-15', '2025-07-13 19:43:24', '2025-07-13 19:43:24'),
(326, 107, 22, 17, 7, 9, '2024-08-19', '2025-07-13 19:43:28', '2025-07-13 19:43:28'),
(327, 107, 23, 17, 10, 11, '2024-08-19', '2025-07-13 19:43:28', '2025-07-13 19:43:28'),
(328, 107, 24, 17, 7, 9, '2024-08-20', '2025-07-13 19:43:28', '2025-07-13 19:43:28'),
(329, 107, 25, 17, 10, 12, '2024-08-20', '2025-07-13 19:43:28', '2025-07-13 19:43:28'),
(330, 107, 26, 2, 7, 9, '2024-08-21', '2025-07-13 19:43:28', '2025-07-13 19:43:28'),
(331, 107, 27, 16, 10, 12, '2024-08-21', '2025-07-13 19:43:28', '2025-07-13 19:43:28'),
(332, 107, 28, 2, 7, 9, '2024-08-22', '2025-07-13 19:43:28', '2025-07-13 19:43:28'),
(333, 108, 22, 17, 7, 9, '2024-08-26', '2025-07-13 19:43:32', '2025-07-13 19:43:32'),
(334, 108, 23, 17, 10, 11, '2024-08-26', '2025-07-13 19:43:32', '2025-07-13 19:43:32'),
(335, 108, 24, 17, 7, 9, '2024-08-27', '2025-07-13 19:43:32', '2025-07-13 19:43:32'),
(336, 108, 25, 17, 10, 12, '2024-08-27', '2025-07-13 19:43:32', '2025-07-13 19:43:32'),
(337, 108, 26, 2, 7, 9, '2024-08-28', '2025-07-13 19:43:32', '2025-07-13 19:43:32'),
(338, 108, 27, 16, 10, 12, '2024-08-28', '2025-07-13 19:43:32', '2025-07-13 19:43:32'),
(339, 108, 28, 2, 7, 9, '2024-08-29', '2025-07-13 19:43:32', '2025-07-13 19:43:32'),
(340, 109, 22, 17, 7, 9, '2024-09-02', '2025-07-13 19:43:35', '2025-07-13 19:43:35'),
(341, 109, 23, 17, 10, 11, '2024-09-02', '2025-07-13 19:43:35', '2025-07-13 19:43:35'),
(342, 109, 24, 17, 7, 9, '2024-09-03', '2025-07-13 19:43:35', '2025-07-13 19:43:35'),
(343, 109, 25, 17, 10, 12, '2024-09-03', '2025-07-13 19:43:35', '2025-07-13 19:43:35'),
(344, 109, 26, 2, 7, 9, '2024-09-04', '2025-07-13 19:43:35', '2025-07-13 19:43:35'),
(345, 109, 27, 16, 10, 12, '2024-09-04', '2025-07-13 19:43:35', '2025-07-13 19:43:35'),
(346, 109, 28, 2, 7, 9, '2024-09-05', '2025-07-13 19:43:36', '2025-07-13 19:43:36'),
(347, 110, 22, 17, 7, 9, '2024-09-09', '2025-07-13 19:44:40', '2025-07-13 19:44:40'),
(348, 110, 23, 17, 10, 11, '2024-09-09', '2025-07-13 19:44:40', '2025-07-13 19:44:40'),
(349, 110, 24, 17, 7, 9, '2024-09-10', '2025-07-13 19:44:40', '2025-07-13 19:44:40'),
(350, 110, 25, 17, 10, 12, '2024-09-10', '2025-07-13 19:44:40', '2025-07-13 19:44:40'),
(351, 110, 26, 2, 7, 9, '2024-09-11', '2025-07-13 19:44:41', '2025-07-13 19:44:41'),
(352, 110, 27, 16, 10, 12, '2024-09-11', '2025-07-13 19:44:41', '2025-07-13 19:44:41'),
(353, 110, 28, 2, 7, 9, '2024-09-12', '2025-07-13 19:44:41', '2025-07-13 19:44:41'),
(354, 129, 29, 17, 7, 9, '2025-01-20', '2025-07-13 19:46:19', '2025-07-13 19:46:19'),
(355, 129, 30, 17, 10, 12, '2025-01-20', '2025-07-13 19:46:19', '2025-07-13 19:46:19'),
(356, 129, 31, 1, 7, 11, '2025-01-21', '2025-07-13 19:46:19', '2025-07-13 19:46:19'),
(357, 129, 32, 3, 7, 9, '2025-01-22', '2025-07-13 19:46:19', '2025-07-13 19:46:19'),
(358, 129, 33, 2, 10, 12, '2025-01-22', '2025-07-13 19:46:19', '2025-07-13 19:46:19'),
(359, 129, 34, 2, 7, 9, '2025-01-23', '2025-07-13 19:46:19', '2025-07-13 19:46:19'),
(360, 129, 35, 3, 10, 12, '2025-01-23', '2025-07-13 19:46:19', '2025-07-13 19:46:19'),
(361, 129, 36, 1, 7, 9, '2025-01-24', '2025-07-13 19:46:19', '2025-07-13 19:46:19'),
(362, 130, 29, 17, 7, 9, '2025-01-27', '2025-07-13 19:46:22', '2025-07-13 19:46:22'),
(363, 130, 30, 17, 10, 12, '2025-01-27', '2025-07-13 19:46:22', '2025-07-13 19:46:22'),
(364, 130, 31, 1, 7, 11, '2025-01-28', '2025-07-13 19:46:22', '2025-07-13 19:46:22'),
(365, 130, 32, 3, 7, 9, '2025-01-29', '2025-07-13 19:46:22', '2025-07-13 19:46:22'),
(366, 130, 33, 2, 10, 12, '2025-01-29', '2025-07-13 19:46:22', '2025-07-13 19:46:22'),
(367, 130, 34, 2, 7, 9, '2025-01-30', '2025-07-13 19:46:22', '2025-07-13 19:46:22'),
(368, 130, 35, 3, 10, 12, '2025-01-30', '2025-07-13 19:46:22', '2025-07-13 19:46:22'),
(369, 130, 36, 1, 7, 9, '2025-01-31', '2025-07-13 19:46:22', '2025-07-13 19:46:22'),
(370, 131, 29, 17, 7, 9, '2025-02-03', '2025-07-13 19:46:26', '2025-07-13 19:46:26'),
(371, 131, 30, 17, 10, 12, '2025-02-03', '2025-07-13 19:46:26', '2025-07-13 19:46:26'),
(372, 131, 31, 1, 7, 11, '2025-02-04', '2025-07-13 19:46:26', '2025-07-13 19:46:26'),
(373, 131, 32, 3, 7, 9, '2025-02-05', '2025-07-13 19:46:26', '2025-07-13 19:46:26'),
(374, 131, 33, 2, 10, 12, '2025-02-05', '2025-07-13 19:46:26', '2025-07-13 19:46:26'),
(375, 131, 34, 2, 7, 9, '2025-02-06', '2025-07-13 19:46:26', '2025-07-13 19:46:26'),
(376, 131, 35, 3, 10, 12, '2025-02-06', '2025-07-13 19:46:26', '2025-07-13 19:46:26'),
(377, 131, 36, 1, 7, 9, '2025-02-07', '2025-07-13 19:46:26', '2025-07-13 19:46:26'),
(378, 132, 29, 17, 7, 9, '2025-02-10', '2025-07-13 19:46:29', '2025-07-13 19:46:29'),
(379, 132, 30, 17, 10, 12, '2025-02-10', '2025-07-13 19:46:29', '2025-07-13 19:46:29'),
(380, 132, 31, 1, 7, 11, '2025-02-11', '2025-07-13 19:46:29', '2025-07-13 19:46:29'),
(381, 132, 32, 3, 7, 9, '2025-02-12', '2025-07-13 19:46:29', '2025-07-13 19:46:29'),
(382, 132, 33, 2, 10, 12, '2025-02-12', '2025-07-13 19:46:29', '2025-07-13 19:46:29'),
(383, 132, 34, 2, 7, 9, '2025-02-13', '2025-07-13 19:46:29', '2025-07-13 19:46:29'),
(384, 132, 35, 3, 10, 12, '2025-02-13', '2025-07-13 19:46:29', '2025-07-13 19:46:29'),
(385, 132, 36, 1, 7, 9, '2025-02-14', '2025-07-13 19:46:29', '2025-07-13 19:46:29'),
(386, 133, 29, 17, 7, 9, '2025-02-17', '2025-07-13 19:46:33', '2025-07-13 19:46:33'),
(387, 133, 30, 17, 10, 12, '2025-02-17', '2025-07-13 19:46:33', '2025-07-13 19:46:33'),
(388, 133, 31, 1, 7, 11, '2025-02-18', '2025-07-13 19:46:33', '2025-07-13 19:46:33'),
(389, 133, 32, 3, 7, 9, '2025-02-19', '2025-07-13 19:46:33', '2025-07-13 19:46:33'),
(390, 133, 33, 2, 10, 12, '2025-02-19', '2025-07-13 19:46:33', '2025-07-13 19:46:33'),
(391, 133, 34, 2, 7, 9, '2025-02-20', '2025-07-13 19:46:33', '2025-07-13 19:46:33'),
(392, 133, 35, 3, 10, 12, '2025-02-20', '2025-07-13 19:46:33', '2025-07-13 19:46:33'),
(393, 133, 36, 1, 7, 9, '2025-02-21', '2025-07-13 19:46:33', '2025-07-13 19:46:33'),
(394, 134, 29, 17, 7, 9, '2025-02-24', '2025-07-13 19:46:37', '2025-07-13 19:46:37'),
(395, 134, 30, 17, 10, 12, '2025-02-24', '2025-07-13 19:46:37', '2025-07-13 19:46:37'),
(396, 134, 31, 1, 7, 11, '2025-02-25', '2025-07-13 19:46:37', '2025-07-13 19:46:37'),
(397, 134, 32, 3, 7, 9, '2025-02-26', '2025-07-13 19:46:37', '2025-07-13 19:46:37'),
(398, 134, 33, 2, 10, 12, '2025-02-26', '2025-07-13 19:46:37', '2025-07-13 19:46:37'),
(399, 134, 34, 2, 7, 9, '2025-02-27', '2025-07-13 19:46:37', '2025-07-13 19:46:37'),
(400, 134, 35, 3, 10, 12, '2025-02-27', '2025-07-13 19:46:37', '2025-07-13 19:46:37'),
(401, 134, 36, 1, 7, 9, '2025-02-28', '2025-07-13 19:46:37', '2025-07-13 19:46:37'),
(402, 135, 29, 17, 7, 9, '2025-03-03', '2025-07-13 19:46:41', '2025-07-13 19:46:41'),
(403, 135, 30, 17, 10, 12, '2025-03-03', '2025-07-13 19:46:41', '2025-07-13 19:46:41'),
(404, 135, 31, 1, 7, 11, '2025-03-04', '2025-07-13 19:46:41', '2025-07-13 19:46:41'),
(405, 135, 32, 3, 7, 9, '2025-03-05', '2025-07-13 19:46:41', '2025-07-13 19:46:41'),
(406, 135, 33, 2, 10, 12, '2025-03-05', '2025-07-13 19:46:41', '2025-07-13 19:46:41'),
(407, 135, 34, 2, 7, 9, '2025-03-06', '2025-07-13 19:46:41', '2025-07-13 19:46:41'),
(408, 135, 35, 3, 10, 12, '2025-03-06', '2025-07-13 19:46:41', '2025-07-13 19:46:41'),
(409, 135, 36, 1, 7, 9, '2025-03-07', '2025-07-13 19:46:41', '2025-07-13 19:46:41'),
(410, 136, 29, 17, 7, 9, '2025-03-10', '2025-07-13 19:46:47', '2025-07-13 19:46:47'),
(411, 136, 30, 17, 10, 12, '2025-03-10', '2025-07-13 19:46:47', '2025-07-13 19:46:47'),
(412, 136, 31, 1, 7, 11, '2025-03-11', '2025-07-13 19:46:47', '2025-07-13 19:46:47'),
(413, 136, 32, 3, 7, 9, '2025-03-12', '2025-07-13 19:46:47', '2025-07-13 19:46:47'),
(414, 136, 33, 2, 10, 12, '2025-03-12', '2025-07-13 19:46:47', '2025-07-13 19:46:47'),
(415, 136, 34, 2, 7, 9, '2025-03-13', '2025-07-13 19:46:47', '2025-07-13 19:46:47'),
(416, 136, 35, 3, 10, 12, '2025-03-13', '2025-07-13 19:46:47', '2025-07-13 19:46:47'),
(417, 136, 36, 1, 7, 9, '2025-03-14', '2025-07-13 19:46:47', '2025-07-13 19:46:47'),
(418, 137, 29, 17, 7, 9, '2025-03-17', '2025-07-13 19:46:51', '2025-07-13 19:46:51'),
(419, 137, 30, 17, 10, 12, '2025-03-17', '2025-07-13 19:46:51', '2025-07-13 19:46:51'),
(420, 137, 31, 1, 7, 11, '2025-03-18', '2025-07-13 19:46:51', '2025-07-13 19:46:51'),
(421, 137, 32, 3, 7, 9, '2025-03-19', '2025-07-13 19:46:51', '2025-07-13 19:46:51'),
(422, 137, 33, 2, 10, 12, '2025-03-19', '2025-07-13 19:46:51', '2025-07-13 19:46:51'),
(423, 137, 34, 2, 7, 9, '2025-03-20', '2025-07-13 19:46:51', '2025-07-13 19:46:51'),
(424, 137, 35, 3, 10, 12, '2025-03-20', '2025-07-13 19:46:51', '2025-07-13 19:46:51'),
(425, 137, 36, 1, 7, 9, '2025-03-21', '2025-07-13 19:46:51', '2025-07-13 19:46:51'),
(426, 138, 29, 17, 7, 9, '2025-03-24', '2025-07-13 19:46:56', '2025-07-13 19:46:56'),
(427, 138, 30, 17, 10, 12, '2025-03-24', '2025-07-13 19:46:56', '2025-07-13 19:46:56'),
(428, 138, 31, 1, 7, 11, '2025-03-25', '2025-07-13 19:46:56', '2025-07-13 19:46:56'),
(429, 138, 32, 3, 7, 9, '2025-03-26', '2025-07-13 19:46:56', '2025-07-13 19:46:56'),
(430, 138, 33, 2, 10, 12, '2025-03-26', '2025-07-13 19:46:56', '2025-07-13 19:46:56'),
(431, 138, 34, 2, 7, 9, '2025-03-27', '2025-07-13 19:46:56', '2025-07-13 19:46:56'),
(432, 138, 35, 3, 10, 12, '2025-03-27', '2025-07-13 19:46:56', '2025-07-13 19:46:56'),
(433, 138, 36, 1, 7, 9, '2025-03-28', '2025-07-13 19:46:56', '2025-07-13 19:46:56'),
(434, 139, 29, 17, 7, 9, '2025-03-31', '2025-07-13 19:47:03', '2025-07-13 19:47:03'),
(435, 139, 30, 17, 10, 12, '2025-03-31', '2025-07-13 19:47:03', '2025-07-13 19:47:03'),
(436, 139, 31, 1, 7, 11, '2025-04-01', '2025-07-13 19:47:03', '2025-07-13 19:47:03'),
(437, 139, 32, 3, 7, 9, '2025-04-02', '2025-07-13 19:47:03', '2025-07-13 19:47:03'),
(438, 139, 33, 2, 10, 12, '2025-04-02', '2025-07-13 19:47:03', '2025-07-13 19:47:03'),
(439, 139, 34, 2, 7, 9, '2025-04-03', '2025-07-13 19:47:03', '2025-07-13 19:47:03'),
(440, 139, 35, 3, 10, 12, '2025-04-03', '2025-07-13 19:47:03', '2025-07-13 19:47:03'),
(441, 139, 36, 1, 7, 9, '2025-04-04', '2025-07-13 19:47:03', '2025-07-13 19:47:03'),
(442, 140, 29, 17, 7, 9, '2025-04-07', '2025-07-13 19:47:08', '2025-07-13 19:47:08'),
(443, 140, 30, 17, 10, 12, '2025-04-07', '2025-07-13 19:47:08', '2025-07-13 19:47:08'),
(444, 140, 31, 1, 7, 11, '2025-04-08', '2025-07-13 19:47:08', '2025-07-13 19:47:08'),
(445, 140, 32, 3, 7, 9, '2025-04-09', '2025-07-13 19:47:08', '2025-07-13 19:47:08'),
(446, 140, 33, 2, 10, 12, '2025-04-09', '2025-07-13 19:47:08', '2025-07-13 19:47:08'),
(447, 140, 34, 2, 7, 9, '2025-04-10', '2025-07-13 19:47:08', '2025-07-13 19:47:08'),
(448, 140, 35, 3, 10, 12, '2025-04-10', '2025-07-13 19:47:08', '2025-07-13 19:47:08'),
(449, 140, 36, 1, 7, 9, '2025-04-11', '2025-07-13 19:47:08', '2025-07-13 19:47:08'),
(450, 141, 29, 17, 7, 9, '2025-04-14', '2025-07-13 19:47:12', '2025-07-13 19:47:12'),
(451, 141, 30, 17, 10, 12, '2025-04-14', '2025-07-13 19:47:12', '2025-07-13 19:47:12'),
(452, 141, 31, 1, 7, 11, '2025-04-15', '2025-07-13 19:47:12', '2025-07-13 19:47:12'),
(453, 141, 32, 3, 7, 9, '2025-04-16', '2025-07-13 19:47:12', '2025-07-13 19:47:12'),
(454, 141, 33, 2, 10, 12, '2025-04-16', '2025-07-13 19:47:12', '2025-07-13 19:47:12'),
(455, 141, 34, 2, 7, 9, '2025-04-17', '2025-07-13 19:47:12', '2025-07-13 19:47:12'),
(456, 141, 35, 3, 10, 12, '2025-04-17', '2025-07-13 19:47:12', '2025-07-13 19:47:12'),
(457, 141, 36, 1, 7, 9, '2025-04-18', '2025-07-13 19:47:12', '2025-07-13 19:47:12'),
(458, 142, 29, 17, 7, 9, '2025-04-21', '2025-07-13 19:47:16', '2025-07-13 19:47:16'),
(459, 142, 30, 17, 10, 12, '2025-04-21', '2025-07-13 19:47:16', '2025-07-13 19:47:16'),
(460, 142, 31, 1, 7, 11, '2025-04-22', '2025-07-13 19:47:16', '2025-07-13 19:47:16'),
(461, 142, 32, 3, 7, 9, '2025-04-23', '2025-07-13 19:47:16', '2025-07-13 19:47:16'),
(462, 142, 33, 2, 10, 12, '2025-04-23', '2025-07-13 19:47:16', '2025-07-13 19:47:16'),
(463, 142, 34, 2, 7, 9, '2025-04-24', '2025-07-13 19:47:16', '2025-07-13 19:47:16'),
(464, 142, 35, 3, 10, 12, '2025-04-24', '2025-07-13 19:47:16', '2025-07-13 19:47:16'),
(465, 142, 36, 1, 7, 9, '2025-04-25', '2025-07-13 19:47:16', '2025-07-13 19:47:16'),
(466, 158, 37, 1, 1, 3, '2025-08-11', '2025-07-13 21:21:12', '2025-07-13 21:21:12'),
(467, 158, 38, 1, 13, 15, '2025-08-12', '2025-07-13 22:08:21', '2025-07-13 22:08:21'),
(468, 158, 39, 1, 4, 6, '2025-08-13', '2025-07-13 22:09:45', '2025-07-13 22:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `thong_bao`
--

CREATE TABLE `thong_bao` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_gv` bigint(20) UNSIGNED NOT NULL,
  `tu_ai` text NOT NULL,
  `ngay_gui` date NOT NULL,
  `tieu_de` varchar(255) NOT NULL,
  `noi_dung` longtext NOT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thong_bao`
--

INSERT INTO `thong_bao` (`id`, `id_gv`, `tu_ai`, `ngay_gui`, `tieu_de`, `noi_dung`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, 1, 'khoa', '2025-07-09', 'Thông báo 1', 'Nội dung thông báo 1', 0, NULL, NULL),
(2, 2, 'khoa', '2025-07-07', 'Thông báo 2', 'Nội dung thông báo 2', 0, NULL, NULL),
(3, 3, 'khoa', '2025-07-05', 'Thông báo 3', 'Nội dung thông báo 3', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tuan`
--

CREATE TABLE `tuan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_nam` bigint(20) UNSIGNED NOT NULL,
  `tuan` int(11) NOT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tuan`
--

INSERT INTO `tuan` (`id`, `id_nam`, `tuan`, `ngay_bat_dau`, `ngay_ket_thuc`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-08-01', '2022-08-07', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(2, 1, 2, '2022-08-08', '2022-08-14', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(3, 1, 3, '2022-08-15', '2022-08-21', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(4, 1, 4, '2022-08-22', '2022-08-28', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(5, 1, 5, '2022-08-29', '2022-09-04', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(6, 1, 6, '2022-09-05', '2022-09-11', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(7, 1, 7, '2022-09-12', '2022-09-18', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(8, 1, 8, '2022-09-19', '2022-09-25', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(9, 1, 9, '2022-09-26', '2022-10-02', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(10, 1, 10, '2022-10-03', '2022-10-09', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(11, 1, 11, '2022-10-10', '2022-10-16', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(12, 1, 12, '2022-10-17', '2022-10-23', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(13, 1, 13, '2022-10-24', '2022-10-30', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(14, 1, 14, '2022-10-31', '2022-11-06', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(15, 1, 15, '2022-11-07', '2022-11-13', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(16, 1, 16, '2022-11-14', '2022-11-20', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(17, 1, 17, '2022-11-21', '2022-11-27', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(18, 1, 18, '2022-11-28', '2022-12-04', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(19, 1, 19, '2022-12-05', '2022-12-11', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(20, 1, 20, '2022-12-12', '2022-12-18', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(21, 1, 21, '2022-12-19', '2022-12-25', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(22, 1, 22, '2022-12-26', '2023-01-01', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(23, 1, 23, '2023-01-02', '2023-01-08', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(24, 1, 24, '2023-01-09', '2023-01-15', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(25, 1, 25, '2023-01-16', '2023-01-22', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(26, 1, 26, '2023-01-23', '2023-01-29', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(27, 1, 27, '2023-01-30', '2023-02-05', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(28, 1, 28, '2023-02-06', '2023-02-12', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(29, 1, 29, '2023-02-13', '2023-02-19', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(30, 1, 30, '2023-02-20', '2023-02-26', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(31, 1, 31, '2023-02-27', '2023-03-05', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(32, 1, 32, '2023-03-06', '2023-03-12', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(33, 1, 33, '2023-03-13', '2023-03-19', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(34, 1, 34, '2023-03-20', '2023-03-26', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(35, 1, 35, '2023-03-27', '2023-04-02', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(36, 1, 36, '2023-04-03', '2023-04-09', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(37, 1, 37, '2023-04-10', '2023-04-16', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(38, 1, 38, '2023-04-17', '2023-04-23', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(39, 1, 39, '2023-04-24', '2023-04-30', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(40, 1, 40, '2023-05-01', '2023-05-07', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(41, 1, 41, '2023-05-08', '2023-05-14', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(42, 1, 42, '2023-05-15', '2023-05-21', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(43, 1, 43, '2023-05-22', '2023-05-28', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(44, 1, 44, '2023-05-29', '2023-06-04', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(45, 1, 45, '2023-06-05', '2023-06-11', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(46, 1, 46, '2023-06-12', '2023-06-18', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(47, 1, 47, '2023-06-19', '2023-06-25', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(48, 1, 48, '2023-06-26', '2023-07-02', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(49, 1, 49, '2023-07-03', '2023-07-09', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(50, 1, 50, '2023-07-10', '2023-07-16', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(51, 1, 51, '2023-07-17', '2023-07-23', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(52, 1, 52, '2023-07-24', '2023-07-30', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(53, 2, 1, '2023-07-31', '2023-08-06', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(54, 2, 2, '2023-08-07', '2023-08-13', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(55, 2, 3, '2023-08-14', '2023-08-20', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(56, 2, 4, '2023-08-21', '2023-08-27', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(57, 2, 5, '2023-08-28', '2023-09-03', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(58, 2, 6, '2023-09-04', '2023-09-10', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(59, 2, 7, '2023-09-11', '2023-09-17', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(60, 2, 8, '2023-09-18', '2023-09-24', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(61, 2, 9, '2023-09-25', '2023-10-01', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(62, 2, 10, '2023-10-02', '2023-10-08', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(63, 2, 11, '2023-10-09', '2023-10-15', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(64, 2, 12, '2023-10-16', '2023-10-22', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(65, 2, 13, '2023-10-23', '2023-10-29', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(66, 2, 14, '2023-10-30', '2023-11-05', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(67, 2, 15, '2023-11-06', '2023-11-12', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(68, 2, 16, '2023-11-13', '2023-11-19', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(69, 2, 17, '2023-11-20', '2023-11-26', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(70, 2, 18, '2023-11-27', '2023-12-03', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(71, 2, 19, '2023-12-04', '2023-12-10', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(72, 2, 20, '2023-12-11', '2023-12-17', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(73, 2, 21, '2023-12-18', '2023-12-24', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(74, 2, 22, '2023-12-25', '2023-12-31', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(75, 2, 23, '2024-01-01', '2024-01-07', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(76, 2, 24, '2024-01-08', '2024-01-14', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(77, 2, 25, '2024-01-15', '2024-01-21', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(78, 2, 26, '2024-01-22', '2024-01-28', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(79, 2, 27, '2024-01-29', '2024-02-04', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(80, 2, 28, '2024-02-05', '2024-02-11', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(81, 2, 29, '2024-02-12', '2024-02-18', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(82, 2, 30, '2024-02-19', '2024-02-25', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(83, 2, 31, '2024-02-26', '2024-03-03', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(84, 2, 32, '2024-03-04', '2024-03-10', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(85, 2, 33, '2024-03-11', '2024-03-17', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(86, 2, 34, '2024-03-18', '2024-03-24', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(87, 2, 35, '2024-03-25', '2024-03-31', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(88, 2, 36, '2024-04-01', '2024-04-07', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(89, 2, 37, '2024-04-08', '2024-04-14', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(90, 2, 38, '2024-04-15', '2024-04-21', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(91, 2, 39, '2024-04-22', '2024-04-28', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(92, 2, 40, '2024-04-29', '2024-05-05', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(93, 2, 41, '2024-05-06', '2024-05-12', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(94, 2, 42, '2024-05-13', '2024-05-19', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(95, 2, 43, '2024-05-20', '2024-05-26', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(96, 2, 44, '2024-05-27', '2024-06-02', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(97, 2, 45, '2024-06-03', '2024-06-09', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(98, 2, 46, '2024-06-10', '2024-06-16', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(99, 2, 47, '2024-06-17', '2024-06-23', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(100, 2, 48, '2024-06-24', '2024-06-30', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(101, 2, 49, '2024-07-01', '2024-07-07', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(102, 2, 50, '2024-07-08', '2024-07-14', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(103, 2, 51, '2024-07-15', '2024-07-21', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(104, 2, 52, '2024-07-22', '2024-07-28', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(105, 3, 1, '2024-08-05', '2024-08-11', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(106, 3, 2, '2024-08-12', '2024-08-18', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(107, 3, 3, '2024-08-19', '2024-08-25', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(108, 3, 4, '2024-08-26', '2024-09-01', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(109, 3, 5, '2024-09-02', '2024-09-08', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(110, 3, 6, '2024-09-09', '2024-09-15', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(111, 3, 7, '2024-09-16', '2024-09-22', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(112, 3, 8, '2024-09-23', '2024-09-29', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(113, 3, 9, '2024-09-30', '2024-10-06', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(114, 3, 10, '2024-10-07', '2024-10-13', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(115, 3, 11, '2024-10-14', '2024-10-20', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(116, 3, 12, '2024-10-21', '2024-10-27', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(117, 3, 13, '2024-10-28', '2024-11-03', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(118, 3, 14, '2024-11-04', '2024-11-10', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(119, 3, 15, '2024-11-11', '2024-11-17', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(120, 3, 16, '2024-11-18', '2024-11-24', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(121, 3, 17, '2024-11-25', '2024-12-01', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(122, 3, 18, '2024-12-02', '2024-12-08', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(123, 3, 19, '2024-12-09', '2024-12-15', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(124, 3, 20, '2024-12-16', '2024-12-22', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(125, 3, 21, '2024-12-23', '2024-12-29', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(126, 3, 22, '2024-12-30', '2025-01-05', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(127, 3, 23, '2025-01-06', '2025-01-12', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(128, 3, 24, '2025-01-13', '2025-01-19', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(129, 3, 25, '2025-01-20', '2025-01-26', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(130, 3, 26, '2025-01-27', '2025-02-02', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(131, 3, 27, '2025-02-03', '2025-02-09', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(132, 3, 28, '2025-02-10', '2025-02-16', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(133, 3, 29, '2025-02-17', '2025-02-23', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(134, 3, 30, '2025-02-24', '2025-03-02', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(135, 3, 31, '2025-03-03', '2025-03-09', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(136, 3, 32, '2025-03-10', '2025-03-16', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(137, 3, 33, '2025-03-17', '2025-03-23', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(138, 3, 34, '2025-03-24', '2025-03-30', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(139, 3, 35, '2025-03-31', '2025-04-06', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(140, 3, 36, '2025-04-07', '2025-04-13', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(141, 3, 37, '2025-04-14', '2025-04-20', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(142, 3, 38, '2025-04-21', '2025-04-27', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(143, 3, 39, '2025-04-28', '2025-05-04', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(144, 3, 40, '2025-05-05', '2025-05-11', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(145, 3, 41, '2025-05-12', '2025-05-18', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(146, 3, 42, '2025-05-19', '2025-05-25', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(147, 3, 43, '2025-05-26', '2025-06-01', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(148, 3, 44, '2025-06-02', '2025-06-08', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(149, 3, 45, '2025-06-09', '2025-06-15', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(150, 3, 46, '2025-06-16', '2025-06-22', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(151, 3, 47, '2025-06-23', '2025-06-29', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(152, 3, 48, '2025-06-30', '2025-07-06', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(153, 3, 49, '2025-07-07', '2025-07-13', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(154, 3, 50, '2025-07-14', '2025-07-20', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(155, 3, 51, '2025-07-21', '2025-07-27', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(156, 3, 52, '2025-07-28', '2025-08-03', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(157, 4, 1, '2025-08-04', '2025-08-10', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(158, 4, 2, '2025-08-11', '2025-08-17', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(159, 4, 3, '2025-08-18', '2025-08-24', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(160, 4, 4, '2025-08-25', '2025-08-31', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(161, 4, 5, '2025-09-01', '2025-09-07', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(162, 4, 6, '2025-09-08', '2025-09-14', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(163, 4, 7, '2025-09-15', '2025-09-21', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(164, 4, 8, '2025-09-22', '2025-09-28', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(165, 4, 9, '2025-09-29', '2025-10-05', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(166, 4, 10, '2025-10-06', '2025-10-12', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(167, 4, 11, '2025-10-13', '2025-10-19', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(168, 4, 12, '2025-10-20', '2025-10-26', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(169, 4, 13, '2025-10-27', '2025-11-02', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(170, 4, 14, '2025-11-03', '2025-11-09', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(171, 4, 15, '2025-11-10', '2025-11-16', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(172, 4, 16, '2025-11-17', '2025-11-23', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(173, 4, 17, '2025-11-24', '2025-11-30', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(174, 4, 18, '2025-12-01', '2025-12-07', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(175, 4, 19, '2025-12-08', '2025-12-14', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(176, 4, 20, '2025-12-15', '2025-12-21', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(177, 4, 21, '2025-12-22', '2025-12-28', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(178, 4, 22, '2025-12-29', '2026-01-04', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(179, 4, 23, '2026-01-05', '2026-01-11', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(180, 4, 24, '2026-01-12', '2026-01-18', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(181, 4, 25, '2026-01-19', '2026-01-25', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(182, 4, 26, '2026-01-26', '2026-02-01', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(183, 4, 27, '2026-02-02', '2026-02-08', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(184, 4, 28, '2026-02-09', '2026-02-15', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(185, 4, 29, '2026-02-16', '2026-02-22', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(186, 4, 30, '2026-02-23', '2026-03-01', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(187, 4, 31, '2026-03-02', '2026-03-08', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(188, 4, 32, '2026-03-09', '2026-03-15', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(189, 4, 33, '2026-03-16', '2026-03-22', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(190, 4, 34, '2026-03-23', '2026-03-29', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(191, 4, 35, '2026-03-30', '2026-04-05', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(192, 4, 36, '2026-04-06', '2026-04-12', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(193, 4, 37, '2026-04-13', '2026-04-19', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(194, 4, 38, '2026-04-20', '2026-04-26', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(195, 4, 39, '2026-04-27', '2026-05-03', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(196, 4, 40, '2026-05-04', '2026-05-10', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(197, 4, 41, '2026-05-11', '2026-05-17', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(198, 4, 42, '2026-05-18', '2026-05-24', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(199, 4, 43, '2026-05-25', '2026-05-31', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(200, 4, 44, '2026-06-01', '2026-06-07', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(201, 4, 45, '2026-06-08', '2026-06-14', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(202, 4, 46, '2026-06-15', '2026-06-21', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(203, 4, 47, '2026-06-22', '2026-06-28', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(204, 4, 48, '2026-06-29', '2026-07-05', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(205, 4, 49, '2026-07-06', '2026-07-12', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(206, 4, 50, '2026-07-13', '2026-07-19', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(207, 4, 51, '2026-07-20', '2026-07-26', '2025-07-10 22:33:36', '2025-07-10 22:33:36'),
(208, 4, 52, '2026-07-27', '2026-08-02', '2025-07-10 22:33:36', '2025-07-10 22:33:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_ho_so` bigint(20) UNSIGNED DEFAULT NULL,
  `id_bo_mon` bigint(20) UNSIGNED DEFAULT NULL,
  `tai_khoan` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_ho_so`, `id_bo_mon`, `tai_khoan`, `password`, `trang_thai`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 37, 1, 'lvkt0177', '$2y$12$QEl97TjjHPVdbZCGvuC9O.dZ9btMzm9.WPKfYr/ypl11FTIcFvvw6', 1, NULL, NULL, NULL),
(2, 38, 2, 'mdt0177', '$2y$12$qUx.US/Qz6wsgGQAEacKtO.xaTsKT.Ykl4gnop/4MZUs2SUeyfswC', 1, NULL, NULL, NULL),
(3, 39, 2, 'nv1', '$2y$12$etRVqlpODQpHyDTW.ejKWuw.AMtOx0FEKZzqujlj.3ctjwFVPTQ/C', 1, NULL, NULL, NULL),
(4, 40, 2, 'gv3', '$2y$12$INPaWeVf5ZZgKoNTYNyDKuKB590iVMlwign1xJVOpY62CQNEYkkYe', 1, NULL, NULL, NULL),
(5, 41, 1, 'user41', '$2y$10$oiKAvGHgztEYH7prZUnyieHth/RyHe5KqNR7uAfNEQlLfokFzNMQy', 1, 'token41', '2025-07-14 01:58:21', '2025-07-14 01:58:21'),
(6, 42, 1, 'user42', '$2y$10$oiKAvGHgztEYH7prZUnyieHth/RyHe5KqNR7uAfNEQlLfokFzNMQy', 1, 'token42', '2025-07-14 01:58:21', '2025-07-14 01:58:21'),
(7, 43, 1, 'user43', '$2y$10$oiKAvGHgztEYH7prZUnyieHth/RyHe5KqNR7uAfNEQlLfokFzNMQy', 1, 'token43', '2025-07-14 01:58:21', '2025-07-14 01:58:21'),
(8, 44, 1, 'user44', '$2y$10$oiKAvGHgztEYH7prZUnyieHth/RyHe5KqNR7uAfNEQlLfokFzNMQy', 1, 'token44', '2025-07-14 01:58:21', '2025-07-14 01:58:21'),
(9, 45, 1, 'user45', '$2y$10$oiKAvGHgztEYH7prZUnyieHth/RyHe5KqNR7uAfNEQlLfokFzNMQy', 1, 'token45', '2025-07-14 02:03:46', '2025-07-14 02:03:46'),
(10, 46, 1, 'user46', '$2y$10$oiKAvGHgztEYH7prZUnyieHth/RyHe5KqNR7uAfNEQlLfokFzNMQy', 1, 'token46', '2025-07-14 02:03:46', '2025-07-14 02:03:46'),
(11, 47, 1, 'user47', '$2y$10$oiKAvGHgztEYH7prZUnyieHth/RyHe5KqNR7uAfNEQlLfokFzNMQy', 1, 'token47', '2025-07-14 02:03:46', '2025-07-14 02:03:46'),
(12, 48, 1, 'user48', '$2y$10$oiKAvGHgztEYH7prZUnyieHth/RyHe5KqNR7uAfNEQlLfokFzNMQy', 1, 'token48', '2025-07-14 02:03:46', '2025-07-14 02:03:46'),
(13, 49, 1, 'user49', '$2y$10$oiKAvGHgztEYH7prZUnyieHth/RyHe5KqNR7uAfNEQlLfokFzNMQy', 1, 'token48', '2025-07-14 02:03:46', '2025-07-14 02:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `yeu_cau_cap_lai_mat_khau`
--

CREATE TABLE `yeu_cau_cap_lai_mat_khau` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_sinh_vien` bigint(20) UNSIGNED NOT NULL,
  `id_giang_vien` bigint(20) UNSIGNED DEFAULT NULL,
  `loai` int(11) NOT NULL DEFAULT 0,
  `trang_thai` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bien_ban_shcn`
--
ALTER TABLE `bien_ban_shcn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bien_ban_shcn_id_lop_foreign` (`id_lop`),
  ADD KEY `bien_ban_shcn_id_sv_foreign` (`id_sv`),
  ADD KEY `bien_ban_shcn_id_gvcn_foreign` (`id_gvcn`),
  ADD KEY `bien_ban_shcn_id_tuan_foreign` (`id_tuan`);

--
-- Indexes for table `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `binh_luan_nguoi_binh_luan_type_nguoi_binh_luan_id_index` (`nguoi_binh_luan_type`,`nguoi_binh_luan_id`),
  ADD KEY `binh_luan_id_thong_bao_foreign` (`id_thong_bao`),
  ADD KEY `binh_luan_id_binh_luan_cha_foreign` (`id_binh_luan_cha`);

--
-- Indexes for table `bo_mon`
--
ALTER TABLE `bo_mon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bo_mon_ten_bo_mon_unique` (`ten_bo_mon`),
  ADD KEY `bo_mon_id_chuyen_nganh_foreign` (`id_chuyen_nganh`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `chi_tiet_bien_ban_shcn`
--
ALTER TABLE `chi_tiet_bien_ban_shcn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_bien_ban_shcn_id_bien_ban_shcn_foreign` (`id_bien_ban_shcn`),
  ADD KEY `chi_tiet_bien_ban_shcn_id_sinh_vien_foreign` (`id_sinh_vien`);

--
-- Indexes for table `chi_tiet_ctdt`
--
ALTER TABLE `chi_tiet_ctdt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_ctdt_id_chuong_trinh_dao_tao_foreign` (`id_chuong_trinh_dao_tao`),
  ADD KEY `chi_tiet_ctdt_id_mon_hoc_foreign` (`id_mon_hoc`),
  ADD KEY `chi_tiet_ctdt_id_hoc_ky_foreign` (`id_hoc_ky`);

--
-- Indexes for table `chi_tiet_thong_bao`
--
ALTER TABLE `chi_tiet_thong_bao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_thong_bao_id_thong_bao_foreign` (`id_thong_bao`),
  ADD KEY `chi_tiet_thong_bao_id_sinh_vien_foreign` (`id_sinh_vien`);

--
-- Indexes for table `chuong_trinh_dao_tao`
--
ALTER TABLE `chuong_trinh_dao_tao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chuong_trinh_dao_tao_id_chuyen_nganh_foreign` (`id_chuyen_nganh`);

--
-- Indexes for table `chuyen_nganh`
--
ALTER TABLE `chuyen_nganh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chuyen_nganh_id_khoa_foreign` (`id_khoa`),
  ADD KEY `chuyen_nganh_id_chuyen_nganh_cha_foreign` (`id_chuyen_nganh_cha`);

--
-- Indexes for table `dang_ky_giay`
--
ALTER TABLE `dang_ky_giay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dang_ky_giay_id_sinh_vien_foreign` (`id_sinh_vien`),
  ADD KEY `dang_ky_giay_id_giang_vien_foreign` (`id_giang_vien`),
  ADD KEY `dang_ky_giay_id_loai_giay_foreign` (`id_loai_giay`);

--
-- Indexes for table `dang_ky_hg_tl`
--
ALTER TABLE `dang_ky_hg_tl`
  ADD KEY `dang_ky_hg_tl_id_sinh_vien_foreign` (`id_sinh_vien`),
  ADD KEY `dang_ky_hg_tl_id_lop_hoc_phan_foreign` (`id_lop_hoc_phan`);

--
-- Indexes for table `danh_sach_hoc_phan`
--
ALTER TABLE `danh_sach_hoc_phan`
  ADD KEY `danh_sach_hoc_phan_id_sinh_vien_foreign` (`id_sinh_vien`),
  ADD KEY `danh_sach_hoc_phan_id_lop_hoc_phan_foreign` (`id_lop_hoc_phan`);

--
-- Indexes for table `danh_sach_sinh_vien`
--
ALTER TABLE `danh_sach_sinh_vien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `danh_sach_sinh_vien_id_lop_foreign` (`id_lop`),
  ADD KEY `danh_sach_sinh_vien_id_sinh_vien_foreign` (`id_sinh_vien`);

--
-- Indexes for table `diem_ren_luyen`
--
ALTER TABLE `diem_ren_luyen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diem_ren_luyen_id_gvcn_foreign` (`id_gvcn`),
  ADD KEY `diem_ren_luyen_id_sinh_vien_foreign` (`id_sinh_vien`),
  ADD KEY `diem_ren_luyen_id_nam_foreign` (`id_nam`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_id_thong_bao_foreign` (`id_thong_bao`);

--
-- Indexes for table `hoc_ky`
--
ALTER TABLE `hoc_ky`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hoc_ky_id_nien_khoa_foreign` (`id_nien_khoa`);

--
-- Indexes for table `hoc_phi`
--
ALTER TABLE `hoc_phi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hoc_phi_id_hoc_ky_foreign` (`id_hoc_ky`),
  ADD KEY `hoc_phi_id_sinh_vien_foreign` (`id_sinh_vien`);

--
-- Indexes for table `ho_so`
--
ALTER TABLE `ho_so`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ho_so_email_unique` (`email`),
  ADD UNIQUE KEY `ho_so_cccd_unique` (`cccd`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `khoa_ten_khoa_unique` (`ten_khoa`);

--
-- Indexes for table `lich_thi`
--
ALTER TABLE `lich_thi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lich_thi_id_giam_thi_1_foreign` (`id_giam_thi_1`),
  ADD KEY `lich_thi_id_giam_thi_2_foreign` (`id_giam_thi_2`),
  ADD KEY `lich_thi_id_tuan_foreign` (`id_tuan`),
  ADD KEY `lich_thi_id_phong_thi_foreign` (`id_phong_thi`),
  ADD KEY `lich_thi_id_lop_hoc_phan_index` (`id_lop_hoc_phan`);

--
-- Indexes for table `loai_giay`
--
ALTER TABLE `loai_giay`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loai_giay_ten_giay_unique` (`ten_giay`);

--
-- Indexes for table `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lop_id_nien_khoa_foreign` (`id_nien_khoa`),
  ADD KEY `lop_id_gvcn_foreign` (`id_gvcn`),
  ADD KEY `lop_id_chuyen_nganh_foreign` (`id_chuyen_nganh`);

--
-- Indexes for table `lop_hoc_phan`
--
ALTER TABLE `lop_hoc_phan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lop_hoc_phan_id_giang_vien_foreign` (`id_giang_vien`),
  ADD KEY `lop_hoc_phan_id_chuong_trinh_dao_tao_foreign` (`id_chuong_trinh_dao_tao`),
  ADD KEY `lop_hoc_phan_id_lop_foreign` (`id_lop`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `mon_hoc`
--
ALTER TABLE `mon_hoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nam`
--
ALTER TABLE `nam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nien_khoa`
--
ALTER TABLE `nien_khoa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nien_khoa_ten_nien_khoa_unique` (`ten_nien_khoa`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `phieu_len_lop`
--
ALTER TABLE `phieu_len_lop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phieu_len_lop_id_lop_hoc_phan_foreign` (`id_lop_hoc_phan`),
  ADD KEY `phieu_len_lop_id_phong_foreign` (`id_phong`),
  ADD KEY `phieu_len_lop_id_tuan_foreign` (`id_tuan`);

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phong_ten_unique` (`ten`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sinhvien_ma_sv_unique` (`ma_sv`),
  ADD KEY `sinhvien_id_ho_so_foreign` (`id_ho_so`);

--
-- Indexes for table `tham_so`
--
ALTER TABLE `tham_so`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tham_so_ten_tham_so_unique` (`ten_tham_so`);

--
-- Indexes for table `thoi_khoa_bieu`
--
ALTER TABLE `thoi_khoa_bieu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thoi_khoa_bieu_id_tuan_foreign` (`id_tuan`),
  ADD KEY `thoi_khoa_bieu_id_lop_hoc_phan_foreign` (`id_lop_hoc_phan`),
  ADD KEY `thoi_khoa_bieu_id_phong_foreign` (`id_phong`);

--
-- Indexes for table `thong_bao`
--
ALTER TABLE `thong_bao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thong_bao_id_gv_foreign` (`id_gv`);

--
-- Indexes for table `tuan`
--
ALTER TABLE `tuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tuan_id_nam_foreign` (`id_nam`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_tai_khoan_unique` (`tai_khoan`),
  ADD KEY `users_id_ho_so_foreign` (`id_ho_so`),
  ADD KEY `users_id_bo_mon_foreign` (`id_bo_mon`);

--
-- Indexes for table `yeu_cau_cap_lai_mat_khau`
--
ALTER TABLE `yeu_cau_cap_lai_mat_khau`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yeu_cau_cap_lai_mat_khau_id_sinh_vien_foreign` (`id_sinh_vien`),
  ADD KEY `yeu_cau_cap_lai_mat_khau_id_giang_vien_foreign` (`id_giang_vien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bien_ban_shcn`
--
ALTER TABLE `bien_ban_shcn`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `binh_luan`
--
ALTER TABLE `binh_luan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bo_mon`
--
ALTER TABLE `bo_mon`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chi_tiet_bien_ban_shcn`
--
ALTER TABLE `chi_tiet_bien_ban_shcn`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chi_tiet_ctdt`
--
ALTER TABLE `chi_tiet_ctdt`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `chi_tiet_thong_bao`
--
ALTER TABLE `chi_tiet_thong_bao`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chuong_trinh_dao_tao`
--
ALTER TABLE `chuong_trinh_dao_tao`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chuyen_nganh`
--
ALTER TABLE `chuyen_nganh`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dang_ky_giay`
--
ALTER TABLE `dang_ky_giay`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `danh_sach_sinh_vien`
--
ALTER TABLE `danh_sach_sinh_vien`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `diem_ren_luyen`
--
ALTER TABLE `diem_ren_luyen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoc_ky`
--
ALTER TABLE `hoc_ky`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `hoc_phi`
--
ALTER TABLE `hoc_phi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ho_so`
--
ALTER TABLE `ho_so`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khoa`
--
ALTER TABLE `khoa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lich_thi`
--
ALTER TABLE `lich_thi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `loai_giay`
--
ALTER TABLE `loai_giay`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lop`
--
ALTER TABLE `lop`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lop_hoc_phan`
--
ALTER TABLE `lop_hoc_phan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `mon_hoc`
--
ALTER TABLE `mon_hoc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `nam`
--
ALTER TABLE `nam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nien_khoa`
--
ALTER TABLE `nien_khoa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phieu_len_lop`
--
ALTER TABLE `phieu_len_lop`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `phong`
--
ALTER TABLE `phong`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tham_so`
--
ALTER TABLE `tham_so`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thoi_khoa_bieu`
--
ALTER TABLE `thoi_khoa_bieu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=469;

--
-- AUTO_INCREMENT for table `thong_bao`
--
ALTER TABLE `thong_bao`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tuan`
--
ALTER TABLE `tuan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `yeu_cau_cap_lai_mat_khau`
--
ALTER TABLE `yeu_cau_cap_lai_mat_khau`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bien_ban_shcn`
--
ALTER TABLE `bien_ban_shcn`
  ADD CONSTRAINT `bien_ban_shcn_id_gvcn_foreign` FOREIGN KEY (`id_gvcn`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bien_ban_shcn_id_lop_foreign` FOREIGN KEY (`id_lop`) REFERENCES `lop` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bien_ban_shcn_id_sv_foreign` FOREIGN KEY (`id_sv`) REFERENCES `sinhvien` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bien_ban_shcn_id_tuan_foreign` FOREIGN KEY (`id_tuan`) REFERENCES `tuan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD CONSTRAINT `binh_luan_id_binh_luan_cha_foreign` FOREIGN KEY (`id_binh_luan_cha`) REFERENCES `binh_luan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `binh_luan_id_thong_bao_foreign` FOREIGN KEY (`id_thong_bao`) REFERENCES `thong_bao` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bo_mon`
--
ALTER TABLE `bo_mon`
  ADD CONSTRAINT `bo_mon_id_chuyen_nganh_foreign` FOREIGN KEY (`id_chuyen_nganh`) REFERENCES `chuyen_nganh` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chi_tiet_bien_ban_shcn`
--
ALTER TABLE `chi_tiet_bien_ban_shcn`
  ADD CONSTRAINT `chi_tiet_bien_ban_shcn_id_bien_ban_shcn_foreign` FOREIGN KEY (`id_bien_ban_shcn`) REFERENCES `bien_ban_shcn` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_bien_ban_shcn_id_sinh_vien_foreign` FOREIGN KEY (`id_sinh_vien`) REFERENCES `sinhvien` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chi_tiet_ctdt`
--
ALTER TABLE `chi_tiet_ctdt`
  ADD CONSTRAINT `chi_tiet_ctdt_id_chuong_trinh_dao_tao_foreign` FOREIGN KEY (`id_chuong_trinh_dao_tao`) REFERENCES `chuong_trinh_dao_tao` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_ctdt_id_hoc_ky_foreign` FOREIGN KEY (`id_hoc_ky`) REFERENCES `hoc_ky` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_ctdt_id_mon_hoc_foreign` FOREIGN KEY (`id_mon_hoc`) REFERENCES `mon_hoc` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chi_tiet_thong_bao`
--
ALTER TABLE `chi_tiet_thong_bao`
  ADD CONSTRAINT `chi_tiet_thong_bao_id_sinh_vien_foreign` FOREIGN KEY (`id_sinh_vien`) REFERENCES `sinhvien` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_thong_bao_id_thong_bao_foreign` FOREIGN KEY (`id_thong_bao`) REFERENCES `thong_bao` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chuong_trinh_dao_tao`
--
ALTER TABLE `chuong_trinh_dao_tao`
  ADD CONSTRAINT `chuong_trinh_dao_tao_id_chuyen_nganh_foreign` FOREIGN KEY (`id_chuyen_nganh`) REFERENCES `chuyen_nganh` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chuyen_nganh`
--
ALTER TABLE `chuyen_nganh`
  ADD CONSTRAINT `chuyen_nganh_id_chuyen_nganh_cha_foreign` FOREIGN KEY (`id_chuyen_nganh_cha`) REFERENCES `chuyen_nganh` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chuyen_nganh_id_khoa_foreign` FOREIGN KEY (`id_khoa`) REFERENCES `khoa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dang_ky_giay`
--
ALTER TABLE `dang_ky_giay`
  ADD CONSTRAINT `dang_ky_giay_id_giang_vien_foreign` FOREIGN KEY (`id_giang_vien`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dang_ky_giay_id_loai_giay_foreign` FOREIGN KEY (`id_loai_giay`) REFERENCES `loai_giay` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dang_ky_giay_id_sinh_vien_foreign` FOREIGN KEY (`id_sinh_vien`) REFERENCES `sinhvien` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dang_ky_hg_tl`
--
ALTER TABLE `dang_ky_hg_tl`
  ADD CONSTRAINT `dang_ky_hg_tl_id_lop_hoc_phan_foreign` FOREIGN KEY (`id_lop_hoc_phan`) REFERENCES `lop_hoc_phan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dang_ky_hg_tl_id_sinh_vien_foreign` FOREIGN KEY (`id_sinh_vien`) REFERENCES `sinhvien` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `danh_sach_hoc_phan`
--
ALTER TABLE `danh_sach_hoc_phan`
  ADD CONSTRAINT `danh_sach_hoc_phan_id_lop_hoc_phan_foreign` FOREIGN KEY (`id_lop_hoc_phan`) REFERENCES `lop_hoc_phan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `danh_sach_hoc_phan_id_sinh_vien_foreign` FOREIGN KEY (`id_sinh_vien`) REFERENCES `sinhvien` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `danh_sach_sinh_vien`
--
ALTER TABLE `danh_sach_sinh_vien`
  ADD CONSTRAINT `danh_sach_sinh_vien_id_lop_foreign` FOREIGN KEY (`id_lop`) REFERENCES `lop` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `danh_sach_sinh_vien_id_sinh_vien_foreign` FOREIGN KEY (`id_sinh_vien`) REFERENCES `sinhvien` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `diem_ren_luyen`
--
ALTER TABLE `diem_ren_luyen`
  ADD CONSTRAINT `diem_ren_luyen_id_gvcn_foreign` FOREIGN KEY (`id_gvcn`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `diem_ren_luyen_id_nam_foreign` FOREIGN KEY (`id_nam`) REFERENCES `nam` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `diem_ren_luyen_id_sinh_vien_foreign` FOREIGN KEY (`id_sinh_vien`) REFERENCES `sinhvien` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_id_thong_bao_foreign` FOREIGN KEY (`id_thong_bao`) REFERENCES `thong_bao` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hoc_ky`
--
ALTER TABLE `hoc_ky`
  ADD CONSTRAINT `hoc_ky_id_nien_khoa_foreign` FOREIGN KEY (`id_nien_khoa`) REFERENCES `nien_khoa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hoc_phi`
--
ALTER TABLE `hoc_phi`
  ADD CONSTRAINT `hoc_phi_id_hoc_ky_foreign` FOREIGN KEY (`id_hoc_ky`) REFERENCES `hoc_ky` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hoc_phi_id_sinh_vien_foreign` FOREIGN KEY (`id_sinh_vien`) REFERENCES `sinhvien` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lich_thi`
--
ALTER TABLE `lich_thi`
  ADD CONSTRAINT `lich_thi_id_giam_thi_1_foreign` FOREIGN KEY (`id_giam_thi_1`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lich_thi_id_giam_thi_2_foreign` FOREIGN KEY (`id_giam_thi_2`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lich_thi_id_phong_thi_foreign` FOREIGN KEY (`id_phong_thi`) REFERENCES `phong` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lich_thi_id_tuan_foreign` FOREIGN KEY (`id_tuan`) REFERENCES `tuan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `lop_id_chuyen_nganh_foreign` FOREIGN KEY (`id_chuyen_nganh`) REFERENCES `chuyen_nganh` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lop_id_gvcn_foreign` FOREIGN KEY (`id_gvcn`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lop_id_nien_khoa_foreign` FOREIGN KEY (`id_nien_khoa`) REFERENCES `nien_khoa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lop_hoc_phan`
--
ALTER TABLE `lop_hoc_phan`
  ADD CONSTRAINT `lop_hoc_phan_id_chuong_trinh_dao_tao_foreign` FOREIGN KEY (`id_chuong_trinh_dao_tao`) REFERENCES `chuong_trinh_dao_tao` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lop_hoc_phan_id_giang_vien_foreign` FOREIGN KEY (`id_giang_vien`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lop_hoc_phan_id_lop_foreign` FOREIGN KEY (`id_lop`) REFERENCES `lop` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `phieu_len_lop`
--
ALTER TABLE `phieu_len_lop`
  ADD CONSTRAINT `phieu_len_lop_id_lop_hoc_phan_foreign` FOREIGN KEY (`id_lop_hoc_phan`) REFERENCES `lop_hoc_phan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `phieu_len_lop_id_phong_foreign` FOREIGN KEY (`id_phong`) REFERENCES `phong` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `phieu_len_lop_id_tuan_foreign` FOREIGN KEY (`id_tuan`) REFERENCES `tuan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_id_ho_so_foreign` FOREIGN KEY (`id_ho_so`) REFERENCES `ho_so` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `thoi_khoa_bieu`
--
ALTER TABLE `thoi_khoa_bieu`
  ADD CONSTRAINT `thoi_khoa_bieu_id_lop_hoc_phan_foreign` FOREIGN KEY (`id_lop_hoc_phan`) REFERENCES `lop_hoc_phan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `thoi_khoa_bieu_id_phong_foreign` FOREIGN KEY (`id_phong`) REFERENCES `phong` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `thoi_khoa_bieu_id_tuan_foreign` FOREIGN KEY (`id_tuan`) REFERENCES `tuan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `thong_bao`
--
ALTER TABLE `thong_bao`
  ADD CONSTRAINT `thong_bao_id_gv_foreign` FOREIGN KEY (`id_gv`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tuan`
--
ALTER TABLE `tuan`
  ADD CONSTRAINT `tuan_id_nam_foreign` FOREIGN KEY (`id_nam`) REFERENCES `nam` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_bo_mon_foreign` FOREIGN KEY (`id_bo_mon`) REFERENCES `bo_mon` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_id_ho_so_foreign` FOREIGN KEY (`id_ho_so`) REFERENCES `ho_so` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `yeu_cau_cap_lai_mat_khau`
--
ALTER TABLE `yeu_cau_cap_lai_mat_khau`
  ADD CONSTRAINT `yeu_cau_cap_lai_mat_khau_id_giang_vien_foreign` FOREIGN KEY (`id_giang_vien`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `yeu_cau_cap_lai_mat_khau_id_sinh_vien_foreign` FOREIGN KEY (`id_sinh_vien`) REFERENCES `sinhvien` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
