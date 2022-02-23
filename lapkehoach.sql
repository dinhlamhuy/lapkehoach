-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 02, 2021 lúc 05:57 PM
-- Phiên bản máy phục vụ: 10.4.19-MariaDB
-- Phiên bản PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `lapkehoach`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_khcv`
--

CREATE TABLE `chitiet_khcv` (
  `id` int(11) NOT NULL,
  `khcv_ma` int(11) NOT NULL,
  `t_ma` int(11) NOT NULL,
  `ctkhcv_giahan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiet_khcv`
--

INSERT INTO `chitiet_khcv` (`id`, `khcv_ma`, `t_ma`, `ctkhcv_giahan`) VALUES
(110983, 39, 16, ''),
(110984, 39, 17, ''),
(110985, 40, 23, ''),
(110986, 40, 24, ''),
(110987, 40, 25, ''),
(110988, 40, 26, ''),
(110989, 40, 27, ''),
(110990, 40, 28, ''),
(110991, 40, 29, ''),
(110992, 40, 30, ''),
(110993, 40, 31, '1'),
(110994, 41, 30, ''),
(110995, 41, 31, ''),
(110996, 41, 32, ''),
(110997, 41, 33, ''),
(110998, 41, 34, ''),
(110999, 41, 35, ''),
(111000, 41, 36, ''),
(111001, 41, 37, ''),
(111002, 41, 38, ''),
(111003, 41, 39, ''),
(111004, 41, 40, ''),
(111005, 41, 41, ''),
(111006, 41, 42, ''),
(111007, 41, 43, ''),
(111008, 42, 20, ''),
(111009, 43, 30, ''),
(111010, 43, 31, ''),
(111011, 43, 32, ''),
(111012, 43, 33, ''),
(111013, 44, 30, ''),
(111014, 44, 31, ''),
(111015, 44, 32, ''),
(111016, 45, 30, ''),
(111017, 45, 31, ''),
(111018, 45, 32, ''),
(111019, 46, 30, ''),
(111020, 46, 31, ''),
(111021, 46, 32, ''),
(111022, 47, 30, ''),
(111023, 47, 31, ''),
(111024, 47, 32, ''),
(111025, 48, 30, ''),
(111026, 48, 31, ''),
(111027, 48, 32, ''),
(111028, 49, 29, ''),
(111029, 49, 30, ''),
(111030, 49, 31, ''),
(111031, 49, 32, ''),
(111032, 49, 33, ''),
(111033, 49, 34, ''),
(111034, 49, 35, ''),
(111035, 50, 27, ''),
(111036, 50, 28, ''),
(111037, 50, 29, ''),
(111038, 50, 30, ''),
(111039, 50, 31, '1'),
(111040, 51, 30, ''),
(111041, 51, 31, ''),
(111042, 52, 30, ''),
(111043, 52, 31, ''),
(111044, 52, 32, ''),
(111045, 52, 33, ''),
(111046, 52, 34, ''),
(111047, 53, 30, ''),
(111048, 53, 31, ''),
(111049, 53, 32, ''),
(111050, 53, 33, ''),
(111051, 54, 27, ''),
(111052, 54, 28, ''),
(111053, 54, 29, ''),
(111054, 54, 30, ''),
(111055, 54, 31, '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `duan`
--

CREATE TABLE `duan` (
  `da_ma` int(11) NOT NULL,
  `da_ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kh_ma` int(11) NOT NULL,
  `da_thoihan` date NOT NULL,
  `da_trangthai` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `duan`
--

INSERT INTO `duan` (`da_ma`, `da_ten`, `kh_ma`, `da_thoihan`, `da_trangthai`) VALUES
(1, 'EDU', 1, '2022-01-13', 'Chưa hoàn thành'),
(2, 'HIS', 2, '2021-12-04', 'Chưa hoàn thành'),
(3, 'eOffice', 9, '2021-09-05', 'Chưa hoàn thành');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kehoachcongviec`
--

CREATE TABLE `kehoachcongviec` (
  `khcv_ma` int(11) NOT NULL,
  `khcv_thuoc_ma` int(11) DEFAULT NULL,
  `khcv_noidung` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `khcv_ghichu` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `khcv_ngaybatdau` date NOT NULL,
  `khcv_thoihanhoanthanh` date NOT NULL,
  `khcv_hoanthanhcv` date DEFAULT NULL,
  `khcv_tiendo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `da_ma` int(11) NOT NULL,
  `nv_thuchien` int(11) DEFAULT NULL,
  `nv_lapkehoach` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `kehoachcongviec`
--

INSERT INTO `kehoachcongviec` (`khcv_ma`, `khcv_thuoc_ma`, `khcv_noidung`, `khcv_ghichu`, `khcv_ngaybatdau`, `khcv_thoihanhoanthanh`, `khcv_hoanthanhcv`, `khcv_tiendo`, `da_ma`, `nv_thuchien`, `nv_lapkehoach`) VALUES
(39, 0, '<p>Hỗ trợ HIS</p>', '', '2021-04-21', '2021-04-29', '2021-04-29', 'Hoàn thành', 2, 10, 1),
(40, 0, '<p>Tập huấn YTCS tại TTYT</p>', '', '2021-06-09', '2021-08-01', NULL, 'Chưa thực hiện', 2, 10, 1),
(41, 0, '<p>Tiếp nhận code HIS</p>', '', '2021-07-30', '2021-10-30', NULL, 'Chưa thực hiện', 2, 8, 1),
(42, 0, '<p>Chuẩn bị các nội dung ký Thỏa thuận Hợp tác với Sở GD.</p>', '', '2021-05-17', '2021-05-21', '2021-05-24', 'Hoàn thành', 1, 1, 1),
(43, 0, '<p>Nhập liệu cho các trường thí điểm</p>', '', '2021-07-31', '2021-08-29', NULL, 'Đang thực hiện', 1, 5, 1),
(44, 0, '<p>Gửi điểm qua tin nhắn cho các trường</p>', '', '2021-07-26', '2021-08-14', NULL, 'Chưa thực hiện', 1, 6, 4),
(45, 0, '<p>Chuẩn bị dữ liệu demo Kiểm định chất lượng GD Hậu Giang</p>', '', '2021-07-26', '2021-08-15', NULL, 'Đang thực hiện', 1, 6, 4),
(46, 45, '<p>Chuẩn bị dữ liệu demo Phổ cập giáo dục</p>', '', '2021-07-26', '2021-08-15', NULL, 'Chưa thực hiện', 1, 6, 4),
(47, 45, '<p>Giới thiệu Điểm danh vân tay cho trường THPT Vị Thanh</p>', '', '2021-07-26', '2021-08-15', NULL, 'Đang thực hiện', 1, 6, 4),
(48, 45, '<p>Demo chuyển đổi số cho phòng GD Vị Thanh</p>', '', '2021-07-26', '2021-08-15', NULL, 'Đang thực hiện', 1, 6, 4),
(49, 0, '<p>Hướng dẫn nội bộ nhập dữ liệu mẫu KĐCLGD</p>', '', '2021-07-20', '2021-09-03', NULL, 'Đang thực hiện', 1, 6, 1),
(50, 0, '<p>Code eOffice</p>', '', '2021-07-07', '2021-07-29', NULL, 'Đang thực hiện', 3, 9, 7),
(51, 50, '<p>Code task Chỉnh sửa giao diện cho đồng nhất</p>', '', '2021-07-26', '2021-08-02', NULL, 'Đang thực hiện', 3, 9, 7),
(52, 50, '<p>Code task “Chuyển xử lý nhiều văn bản trong menu VB đến trả lại”</p>', '', '2021-07-26', '2021-09-05', NULL, 'Đang thực hiện', 3, 7, 7),
(53, 0, '<p>Test quy trình site test sau khi reset site</p>', '', '2021-07-27', '2021-08-22', '2021-08-02', 'Hoàn thành', 3, 7, 7),
(54, 0, '<p>Liên hệ BQL Các khu công nghiệp hỗ trợ xử lý các vướng mắc của đơn vị</p>', '', '2021-07-07', '2021-07-27', NULL, 'Chưa thực hiện', 3, 7, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `kh_ma` int(11) NOT NULL,
  `kh_ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kh_sdt` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kh_email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kh_diachi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`kh_ma`, `kh_ten`, `kh_sdt`, `kh_email`, `kh_diachi`) VALUES
(1, 'Trường tiểu học Vị Thanh', '0336644594', 'tthvithanh123@gmail.com', 'Vị Thanh, Hậu Giang3'),
(2, 'Bệnh viện phụng hiệp', '01672614036', 'bvphunghiep@gmail.com', 'Đường Hùng Vương, Phụng Hiệp, Hậu Giang'),
(9, 'Công ty điện lực Vị Thanh', '02933504979', 'dienlucvithanh@gmail.com', '81 Võ Văn Kiệt, KV2, P5, Vị Thanh, Hậu Giang');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichsu`
--

CREATE TABLE `lichsu` (
  `ls_ma` int(11) NOT NULL,
  `ls_tieude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ls_noidung` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ls_ngay` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nv_ma` int(11) DEFAULT NULL,
  `khcv_ma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lichsu`
--

INSERT INTO `lichsu` (`ls_ma`, `ls_tieude`, `ls_noidung`, `ls_ngay`, `nv_ma`, `khcv_ma`) VALUES
(143, 'Thêm công việc mới', 'NV001 Lập công việc mới có mã CV039 cho NV010 Thực hiện từ 2021-04-21 Đến 2021-04-29', '2021-08-02 13:55:41', 1, 39),
(144, 'Thêm công việc mới', 'NV001 Lập công việc mới có mã CV040 cho NV010 Thực hiện từ 2021-06-09 Đến 2021-08-01', '2021-08-02 14:08:02', 1, 40),
(145, 'Thêm công việc mới', 'NV001 Lập công việc mới có mã CV041 cho NV008 Thực hiện từ 2021-07-30 Đến 2021-10-30', '2021-08-02 14:10:48', 1, 41),
(146, 'Thêm công việc mới', 'NV001 Lập công việc mới có mã CV042 cho NV001 Thực hiện từ 2021-05-17 Đến 2021-05-21', '2021-08-02 14:17:37', 1, 42),
(147, 'Thêm công việc mới', 'NV001 Lập công việc mới có mã CV043 cho NV005 Thực hiện từ 2021-07-31 Đến 2021-08-20', '2021-08-02 14:42:54', 1, 43),
(148, 'Thêm công việc mới', 'NV004 Lập công việc mới có mã CV044 cho NV006 Thực hiện từ 2021-07-26 Đến 2021-08-14', '2021-08-02 14:45:30', 4, 44),
(149, 'Thêm công việc mới', 'NV004 Lập công việc mới có mã CV045 cho NV006 Thực hiện từ 2021-07-26 Đến 2021-08-15', '2021-08-02 14:46:16', 4, 45),
(150, 'Thêm công việc mới', 'NV004 Lập công việc mới có mã CV046 cho NV006 Thực hiện từ 2021-07-26 Đến 2021-08-15', '2021-08-02 14:47:25', 4, 46),
(151, 'Thêm công việc mới', 'NV004 Lập công việc mới có mã CV047 cho NV006 Thực hiện từ 2021-07-26 Đến 2021-08-15', '2021-08-02 14:49:00', 4, 47),
(152, 'Thêm công việc mới', 'NV004 Lập công việc mới có mã CV048 cho NV006 Thực hiện từ 2021-07-26 Đến 2021-08-15', '2021-08-02 14:50:18', 4, 48),
(153, 'Thêm công việc mới', 'NV001 Lập công việc mới có mã CV049 cho NV006 Thực hiện từ 2021-07-20 Đến 2021-09-03', '2021-08-02 15:04:01', 1, 49),
(154, 'Thêm công việc mới', 'NV007 Lập công việc mới có mã CV050 cho NV009 Thực hiện từ 2021-07-07 Đến 2021-07-29', '2021-08-02 15:16:09', 7, 50),
(155, 'Thêm công việc mới', 'NV007 Lập công việc mới có mã CV051 cho NV009 Thực hiện từ 2021-07-26 Đến 2021-08-02', '2021-08-02 15:18:12', 7, 51),
(156, 'Thay đổi nội dung công việc', 'NV007 Đã thay đổi nội dung công việc CV050 có nội dung \"<b><p>Code task Chỉnh sửa giao diện cho đồng nhất</p></b>\" thành nội dung mới \"<b><p>Code eOffice</p></b>\"', '2021-08-02 15:20:15', 7, 50),
(157, 'Thêm công việc mới', 'NV007 Lập công việc mới có mã CV052 cho NV007 Thực hiện từ 2021-07-26 Đến 2021-08-28', '2021-08-02 15:27:59', 7, 52),
(161, 'Thay đổi nội dung công việc', 'NV007 Đã thay đổi nội dung công việc CV045 có nội dung \"<b><p>Chuẩn bị dữ liệu demo Kiểm định chất lượng GD</p></b>\" thành nội dung mới \"<b><p>Chuẩn bị dữ liệu demo Kiểm định chất lượng GD Hậu Giang</p></b>\"', '2021-08-02 15:34:17', 7, 45),
(163, 'Thay đổi nội dung công việc', 'NV007 Đã thay đổi nội dung công việc CV052 có nội dung \"<b><p>Code task “Chuyển xử lý nhiều văn bản trong menu VB đến trả lại”</p></b>\" thành nội dung mới \"<b><p>Code task “Chuyển xử lý nhiều văn bản trong menu VB đến trả lại” sad</p></b>\"', '2021-08-02 15:36:37', 7, 52),
(164, 'Thay đổi nội dung công việc', 'NV007 Đã thay đổi nội dung công việc CV052 có nội dung \"<b><p>Code task “Chuyển xử lý nhiều văn bản trong menu VB đến trả lại” sad</p></b>\" thành nội dung mới \"<b><p>Code task “Chuyển xử lý nhiều văn bản trong menu VB đến trả lại”</p></b>\"', '2021-08-02 15:36:49', 7, 52),
(166, 'Thay đổi nội dung công việc', 'NV007 Đã thay đổi nội dung công việc CV052 có nội dung \"<b><p>Code task “Chuyển xử lý nhiều văn bản trong menu VB đến trả lại”ád</p></b>\" thành nội dung mới \"<b><p>Code task “Chuyển xử lý nhiều văn bản trong menu VB đến trả lại”</p></b>\"', '2021-08-02 15:38:42', 7, 52),
(167, 'Gia hạn', 'NV007 Đã gia hạn thêm cho công việc có mã CV052 từ 2021-08-28 Đến 2021-09-05', '2021-08-02 15:40:24', 7, 52),
(168, 'Gia hạn', 'NV007 Đã gia hạn thêm cho công việc có mã CV043 từ <b>20/08/2021</b> Đến <b>29/08/2021</b>', '2021-08-02 15:40:41', 7, 43),
(169, 'Thêm công việc mới', 'NV007 Lập công việc mới có mã CV053 cho NV007 Thực hiện từ 2021-07-27 Đến 2021-08-22', '2021-08-02 15:42:22', 7, 53),
(170, 'Thêm công việc mới', 'NV001 Lập công việc mới có mã CV054 cho NV007 Thực hiện từ 2021-07-07 Đến 2021-07-27', '2021-08-02 15:48:49', 1, 54),
(171, 'Hoàn thành công việc', 'NV007 Đã hoàn thành công việc có mã CV053', '2021-08-02 15:51:19', 7, 53);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nam`
--

CREATE TABLE `nam` (
  `nam_id` int(11) NOT NULL,
  `n_nam` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nam`
--

INSERT INTO `nam` (`nam_id`, `n_nam`) VALUES
(1, 2021);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `nv_ma` int(11) NOT NULL,
  `nv_hoten` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nv_ngaysinh` date DEFAULT NULL,
  `nv_gioitinh` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nv_email` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nv_matkhau` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nv_anhdaidien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nv_sdt` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nv_diachi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nv_chucvu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pb_ma` int(11) DEFAULT NULL,
  `nv_tinhtrang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`nv_ma`, `nv_hoten`, `nv_ngaysinh`, `nv_gioitinh`, `nv_email`, `nv_matkhau`, `nv_anhdaidien`, `nv_sdt`, `nv_diachi`, `nv_chucvu`, `pb_ma`, `nv_tinhtrang`) VALUES
(1, 'Đinh Lâm Huy', '1999-12-07', 'Nữ', 'dlhuyb1706918@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021073194629.jpg', '0336644594', 'Mỹ Tú, Sóc Trăng', 'Admin', 1, 'Đang làm việc'),
(2, 'Nguyễn Văn Phi', '1999-02-19', 'Nam', 'nvphi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021071619165.jpg', '0336644594', 'Sóc Trăng', 'Phó phòng', 2, 'Đang làm việc'),
(3, 'Trần Hoàng Phúc', '1999-05-03', 'Nam', 'thphucb1706942@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021071547253.jpg', '0983882758', 'Châu Thành, An Giang', 'Nhân viên', 5, 'Đang làm việc'),
(4, 'Huỳnh Kim Phương Ngân', '1999-02-13', 'Nữ', 'hkpnganb1704677@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021080211187.jpg', '0964012396', 'Cù Lao Dung, Sóc Trăng', 'Nhân viên', 5, 'Đang làm việc'),
(5, 'Mã Văn Đức', '1996-06-01', 'Nam', 'mvduc@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien20210706568.png', '0988190665', 'Rạch Giá, Kiên Giang', 'Nhân viên', 7, 'Đang làm việc'),
(6, 'Phan Thanh Dũ', '2000-01-01', 'Nam', 'ptdu@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021070646756.png', '0976281291', 'Vị Thủy, Hậu Giang', 'Nhân viên', 7, 'Đang làm việc'),
(7, 'Lê Việt Khải', '1999-03-14', 'Nam', 'lvkhai@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021070652904.jpg', '0336433789', 'U Minh, Cà Mau', 'Nhân viên', 7, 'Đang làm việc'),
(8, 'Lâm Thanh Tuấn', '1997-06-01', 'Nam', 'lttuan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021070620040.png', '0345466762', 'Vĩnh Châu, Sóc Trăng', 'Nhân viên', 6, 'Đang làm việc'),
(9, 'Phan Nhứt Thống', '2000-01-01', 'Nam', 'pnthong@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021070680655.png', '0454323423', 'Sóc Trăng', 'Nhân viên', 6, 'Đã nghỉ việc'),
(10, 'Hà Long Hải', '1999-01-01', 'Nam', 'hlhai@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021070850259.jpg', '0432342345', 'Vị Thủy, Hậu Giang', 'Nhân viên', 7, 'Đang làm việc'),
(11, 'Đinh Tiến Phong', '2000-01-01', 'Nam', 'dtphong@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021071515175.jpg', '0253728543', 'Sóc Trăng', 'Phó phòng', 2, 'Đang làm việc'),
(12, 'Đặng Văn Nguyên', '1998-03-21', 'Nam', 'dvnguyen@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021071652698.jpg', '0332277993', 'Cù Lao Dung, Sóc Trăng', 'Thực tập sinh', 9, 'Đang làm việc'),
(13, 'Nguyễn Văn Thanh', '1999-12-15', 'Nam', 'nvthanh@gamil.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021071635232.jpg', '0332628628', 'Kiên Giang', 'Thực tập sinh', 6, 'Đang làm việc'),
(14, 'Hứa Minh Dũng', '1999-07-21', 'Nam', 'hmdung@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021073069413.jpg', '0348595243', 'Vị Thanh, Hậu Giang', 'Trưởng phòng', 3, 'Đang làm việc'),
(15, 'Hoàng Phi Hồng', '2000-01-15', 'Nữ', 'hphong@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '0362239346', 'Hòa An, Hậu Giang', 'Giám đốc', 8, 'Đang làm việc'),
(16, 'Lục Tiểu Linh Đồng', '1999-09-12', 'Nữ', 'ltldong@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021073199272.jpg', '0385911629', 'Ninh Kiều, Cần Thơ', 'Nhân viên', 4, 'Đang làm việc'),
(17, 'Phan Nhất Dương', '2000-01-01', 'Nam', 'pnduong@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021073142320.jpg', '0379254719', 'Phụng Hiệp, Hậu Giang', 'Thư ký', 8, 'Đang làm việc'),
(18, 'Tưởng Nhĩ Kỳ', '2000-01-01', 'Nữ', 'tnky@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021073166466.jpg', '0384922456', 'Cù Lao Dung, Sóc Trăng', 'Thư ký', 4, 'Đang làm việc'),
(19, 'Phan Văn Tý', '1999-05-06', 'Nam', 'pvty@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021073114510.jpg', '0328499172', 'Mỹ Tú, Sóc Trăng', 'Trưởng phòng', 5, 'Đang làm việc'),
(20, 'Lê Thị Lê', '1999-10-15', 'Nữ', 'ltle@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvien2021073131720.jpg', '0389925102', 'Huỳnh Hữu Nghĩa, Mỹ Tú, Sóc Trăng', 'Trưởng phòng', 2, 'Đang làm việc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongban`
--

CREATE TABLE `phongban` (
  `pb_ma` int(11) NOT NULL,
  `pb_ten` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phongban`
--

INSERT INTO `phongban` (`pb_ma`, `pb_ten`) VALUES
(1, 'Ban quản trị'),
(2, 'Phòng kinh doanh'),
(3, 'Phòng phân tích'),
(4, 'Phòng thiết kế'),
(5, 'Phòng lập trình'),
(6, 'Phòng hành chính'),
(7, 'Ban triển khai'),
(8, 'Phòng kế toán'),
(9, 'Ban ý tưởng'),
(10, 'Ban giám đốc'),
(11, 'Ban giáo dục');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tuan`
--

CREATE TABLE `tuan` (
  `t_ma` int(11) NOT NULL,
  `t_sotuan` int(11) NOT NULL DEFAULT 0,
  `nam_id` int(11) NOT NULL DEFAULT 0,
  `t_ngaydau` date DEFAULT NULL,
  `t_ngaycuoi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tuan`
--

INSERT INTO `tuan` (`t_ma`, `t_sotuan`, `nam_id`, `t_ngaydau`, `t_ngaycuoi`) VALUES
(1, 1, 1, '2021-01-04', '2021-01-10'),
(2, 2, 1, '2021-01-11', '2021-01-17'),
(3, 3, 1, '2021-01-18', '2021-01-24'),
(4, 4, 1, '2021-01-25', '2021-01-31'),
(5, 5, 1, '2021-02-04', '2021-02-10'),
(6, 6, 1, '2021-02-08', '2021-02-14'),
(7, 7, 1, '2021-02-15', '2021-02-21'),
(8, 8, 1, '2021-02-22', '2021-02-28'),
(9, 9, 1, '2021-03-04', '2021-03-10'),
(10, 10, 1, '2021-03-08', '2021-03-14'),
(11, 11, 1, '2021-03-15', '2021-03-21'),
(12, 12, 1, '2021-03-22', '2021-03-28'),
(13, 13, 1, '2021-03-29', '2021-04-04'),
(14, 14, 1, '2021-04-05', '2021-04-11'),
(15, 15, 1, '2021-04-12', '2021-04-18'),
(16, 16, 1, '2021-04-19', '2021-04-25'),
(17, 17, 1, '2021-04-26', '2021-05-02'),
(18, 18, 1, '2021-05-04', '2021-05-10'),
(19, 19, 1, '2021-05-10', '2021-05-16'),
(20, 20, 1, '2021-05-17', '2021-05-23'),
(21, 21, 1, '2021-05-24', '2021-05-30'),
(22, 22, 1, '2021-05-31', '2021-06-06'),
(23, 23, 1, '2021-06-07', '2021-06-13'),
(24, 24, 1, '2021-06-14', '2021-06-20'),
(25, 25, 1, '2021-06-21', '2021-06-27'),
(26, 26, 1, '2021-06-28', '2021-07-04'),
(27, 27, 1, '2021-07-05', '2021-07-11'),
(28, 28, 1, '2021-07-12', '2021-07-18'),
(29, 29, 1, '2021-07-19', '2021-07-25'),
(30, 30, 1, '2021-07-26', '2021-08-01'),
(31, 31, 1, '2021-08-04', '2021-08-10'),
(32, 32, 1, '2021-08-09', '2021-08-15'),
(33, 33, 1, '2021-08-16', '2021-08-22'),
(34, 34, 1, '2021-08-23', '2021-08-29'),
(35, 35, 1, '2021-08-30', '2021-09-05'),
(36, 36, 1, '2021-09-06', '2021-09-12'),
(37, 37, 1, '2021-09-13', '2021-09-19'),
(38, 38, 1, '2021-09-20', '2021-09-26'),
(39, 39, 1, '2021-09-27', '2021-10-03'),
(40, 40, 1, '2021-10-04', '2021-10-10'),
(41, 41, 1, '2021-10-11', '2021-10-17'),
(42, 42, 1, '2021-10-18', '2021-10-24'),
(43, 43, 1, '2021-10-25', '2021-10-31'),
(44, 44, 1, '2021-11-04', '2021-11-10'),
(45, 45, 1, '2021-11-08', '2021-11-14'),
(46, 46, 1, '2021-11-15', '2021-11-21'),
(47, 47, 1, '2021-11-22', '2021-11-28'),
(48, 48, 1, '2021-11-29', '2021-12-05'),
(49, 49, 1, '2021-12-06', '2021-12-12'),
(50, 50, 1, '2021-12-13', '2021-12-19'),
(51, 51, 1, '2021-12-20', '2021-12-26'),
(52, 52, 1, '2021-12-27', '2022-01-02');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitiet_khcv`
--
ALTER TABLE `chitiet_khcv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__kehoachcongviec` (`khcv_ma`),
  ADD KEY `FK__tuan` (`t_ma`);

--
-- Chỉ mục cho bảng `duan`
--
ALTER TABLE `duan`
  ADD PRIMARY KEY (`da_ma`),
  ADD KEY `kh_ma` (`kh_ma`);

--
-- Chỉ mục cho bảng `kehoachcongviec`
--
ALTER TABLE `kehoachcongviec`
  ADD PRIMARY KEY (`khcv_ma`),
  ADD KEY `FK_kehoachcongviec_duan` (`da_ma`),
  ADD KEY `FK_kehoachcongviec_nhanvien` (`nv_lapkehoach`),
  ADD KEY `FK_kehoachcongviec_nhanvien_2` (`nv_thuchien`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`kh_ma`);

--
-- Chỉ mục cho bảng `lichsu`
--
ALTER TABLE `lichsu`
  ADD PRIMARY KEY (`ls_ma`),
  ADD KEY `khcv_ma` (`khcv_ma`),
  ADD KEY `nv_ma` (`nv_ma`);

--
-- Chỉ mục cho bảng `nam`
--
ALTER TABLE `nam`
  ADD PRIMARY KEY (`nam_id`) USING BTREE;

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`nv_ma`),
  ADD KEY `FK_nhanvien_phongban` (`pb_ma`);

--
-- Chỉ mục cho bảng `phongban`
--
ALTER TABLE `phongban`
  ADD PRIMARY KEY (`pb_ma`);

--
-- Chỉ mục cho bảng `tuan`
--
ALTER TABLE `tuan`
  ADD PRIMARY KEY (`t_ma`),
  ADD KEY `nam_id` (`nam_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitiet_khcv`
--
ALTER TABLE `chitiet_khcv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111056;

--
-- AUTO_INCREMENT cho bảng `duan`
--
ALTER TABLE `duan`
  MODIFY `da_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `kehoachcongviec`
--
ALTER TABLE `kehoachcongviec`
  MODIFY `khcv_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `kh_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `lichsu`
--
ALTER TABLE `lichsu`
  MODIFY `ls_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT cho bảng `nam`
--
ALTER TABLE `nam`
  MODIFY `nam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `nv_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT cho bảng `phongban`
--
ALTER TABLE `phongban`
  MODIFY `pb_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `tuan`
--
ALTER TABLE `tuan`
  MODIFY `t_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiet_khcv`
--
ALTER TABLE `chitiet_khcv`
  ADD CONSTRAINT `FK__kehoachcongviec` FOREIGN KEY (`khcv_ma`) REFERENCES `kehoachcongviec` (`khcv_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK__tuan` FOREIGN KEY (`t_ma`) REFERENCES `tuan` (`t_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `duan`
--
ALTER TABLE `duan`
  ADD CONSTRAINT `FK_duan_khachhang` FOREIGN KEY (`kh_ma`) REFERENCES `khachhang` (`kh_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `kehoachcongviec`
--
ALTER TABLE `kehoachcongviec`
  ADD CONSTRAINT `FK_kehoachcongviec_duan` FOREIGN KEY (`da_ma`) REFERENCES `duan` (`da_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_kehoachcongviec_nhanvien` FOREIGN KEY (`nv_lapkehoach`) REFERENCES `nhanvien` (`nv_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_kehoachcongviec_nhanvien_2` FOREIGN KEY (`nv_thuchien`) REFERENCES `nhanvien` (`nv_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `lichsu`
--
ALTER TABLE `lichsu`
  ADD CONSTRAINT `lichsu_ibfk_1` FOREIGN KEY (`khcv_ma`) REFERENCES `kehoachcongviec` (`khcv_ma`),
  ADD CONSTRAINT `lichsu_ibfk_2` FOREIGN KEY (`nv_ma`) REFERENCES `nhanvien` (`nv_ma`);

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `FK_nhanvien_phongban` FOREIGN KEY (`pb_ma`) REFERENCES `phongban` (`pb_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tuan`
--
ALTER TABLE `tuan`
  ADD CONSTRAINT `FK_tuan_nam` FOREIGN KEY (`nam_id`) REFERENCES `nam` (`nam_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
