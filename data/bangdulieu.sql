-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 30, 2023 lúc 02:33 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `pj09qlhtk`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `id_kh` int(50) NOT NULL,
  `ten_kh` varchar(20) NOT NULL,
  `email_kh` varchar(255) NOT NULL,
  `sdt_kh` varchar(15) NOT NULL,
  `dia_chi_kh` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`id_kh`, `ten_kh`, `email_kh`, `sdt_kh`, `dia_chi_kh`) VALUES
(1, 'Nam', 'nam@gmail.com', '68668', 'HN'),
(2, 'Nam', 'nam@gmail.com', '68669', 'HN'),
(5, 'oppo', 'oppo2@gmail.com', '02222345', 'Trung Quốc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `id_loai_sp` int(11) NOT NULL,
  `ten_loai_sp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisanpham`
--

INSERT INTO `loaisanpham` (`id_loai_sp`, `ten_loai_sp`) VALUES
(1, 'Điện thoại'),
(2, 'Laptop'),
(3, 'Đồng hồ'),
(6, 'quần'),
(7, 'Hữu Nghĩa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `id_nha_cc` int(50) NOT NULL,
  `ten_nha_cc` varchar(20) NOT NULL,
  `email_nha_cc` varchar(20) NOT NULL,
  `sdt_nha_cc` varchar(255) NOT NULL,
  `dia_chi_nha_cc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`id_nha_cc`, `ten_nha_cc`, `email_nha_cc`, `sdt_nha_cc`, `dia_chi_nha_cc`) VALUES
(1, 'Apple', 'apple@gmail.com', '9999', 'Mỹ'),
(2, 'Xiaomi', 'xiaomi@gmail.com', '88886', 'Trung Quốc'),
(3, 'Bphone', 'bphone@', '5554', 'VN'),
(4, 'Samsung', 'ss@gmail.com', '09678', 'Hàn Quốc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieunhap`
--

CREATE TABLE `phieunhap` (
  `id` int(11) NOT NULL,
  `ngay_nhap` date NOT NULL,
  `nha_cung_cap_sp` varchar(255) NOT NULL,
  `ten_sp` varchar(255) NOT NULL,
  `anh_sp` varchar(255) NOT NULL,
  `mota_sp` varchar(255) NOT NULL,
  `loai_sp` varchar(255) NOT NULL,
  `gia_nhap_sp` int(255) NOT NULL,
  `so_luong` int(255) NOT NULL,
  `tong_tien_hang` bigint(255) NOT NULL,
  `nguoi_nhap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieunhap`
--

INSERT INTO `phieunhap` (`id`, `ngay_nhap`, `nha_cung_cap_sp`, `ten_sp`, `anh_sp`, `mota_sp`, `loai_sp`, `gia_nhap_sp`, `so_luong`, `tong_tien_hang`, `nguoi_nhap`) VALUES
(1, '2023-10-21', 'Apple', 'iPhone Xs Max', '600_600_xs_max_white_800x800_3_bebd9519a1814f99ae954bc598ef9bd5_1024x1024.webp', '256GB', 'Điện thoại', 10, 100, 1000, 'Hữu Nghĩa'),
(2, '2023-10-07', 'Apple', 'iPhone Xs Max', '600_xs_max_gold_800x800_5.jpg', '256GB', 'Điện thoại', 7, 100, 700, 'Văn Tú'),
(6, '2023-10-17', 'Apple', 'ip15', 'iPhone-15-pink1.jpg', '512Gb', 'Điện thoại', 45, 20, 900, 'Hữu Nghĩa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieuxuat`
--

CREATE TABLE `phieuxuat` (
  `id_phieu_xuat` int(11) NOT NULL,
  `ngay_xuat` date NOT NULL,
  `nha_cung_cap_sp` varchar(50) NOT NULL,
  `ten_sp` varchar(100) NOT NULL,
  `anh_sp` varchar(255) NOT NULL,
  `mota_sp` varchar(255) NOT NULL,
  `loai_sp` varchar(255) NOT NULL,
  `gia_ban_sp` bigint(255) NOT NULL,
  `so_luong_xuat` int(255) NOT NULL,
  `tong_tien_hang_xuat` bigint(255) NOT NULL,
  `nguoi_xuat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieuxuat`
--

INSERT INTO `phieuxuat` (`id_phieu_xuat`, `ngay_xuat`, `nha_cung_cap_sp`, `ten_sp`, `anh_sp`, `mota_sp`, `loai_sp`, `gia_ban_sp`, `so_luong_xuat`, `tong_tien_hang_xuat`, `nguoi_xuat`) VALUES
(1, '2023-10-01', 'Samsung', 'Samsung S23 ultral', '', '8GB', 'Điện thoại', 22, 4, 88, 'Huu Nghia'),
(2, '2023-10-01', 'Samsung', 'Samsung S23 ultral', '', '8GB', 'Điện thoại', 22, 10, 220, 'Huu Nghia'),
(5, '2023-10-11', 'Apple', 'ipXsmax', '600_600_xs_max_white_800x800_3_bebd9519a1814f99ae954bc598ef9bd5_1024x1024.webp', '256Gb', 'Điện thoại', 9, 7, 63, 'Huu Nghia');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id_sp` int(11) NOT NULL,
  `ten_sp` varchar(255) NOT NULL,
  `anh_sp` varchar(255) NOT NULL,
  `mota_sp` varchar(255) NOT NULL,
  `loai_sp` varchar(255) NOT NULL,
  `gia_ban_sp` int(255) NOT NULL,
  `gia_nhap_sp` int(255) NOT NULL,
  `nha_cung_cap_sp` varchar(255) NOT NULL,
  `sl_ton` int(255) NOT NULL,
  `sl_ton_toithieu` int(255) NOT NULL,
  `ngay_nhap` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id_sp`, `ten_sp`, `anh_sp`, `mota_sp`, `loai_sp`, `gia_ban_sp`, `gia_nhap_sp`, `nha_cung_cap_sp`, `sl_ton`, `sl_ton_toithieu`, `ngay_nhap`) VALUES
(2, 'iPhone  15 Pro Max', '15-Pro-21042049221.jpg', '256Gb', 'Điện Thoại', 35000000, 34000000, 'Apple', 50, 10, '2023-09-26'),
(3, 'Iphone 15 Pro', '15-Pro-nar1170930957.jpg', '128GB', 'Điện Thoại', 28000000, 27000000, 'Apple', 80, 10, '2023-09-26'),
(5, 'iPhone 15 ', 'iPhone-15-ble1.jpg', '128GB', 'Điện Thoại', 22000000, 21000000, 'Apple', 69, 10, '2023-09-26'),
(6, 'Apple Watch Series 9 GPS  Sport Band S/M', '962047102.jpeg', '41mm', 'Đồng hồ', 9990000, 9000000, 'Apple', 90, 10, '2023-09-26'),
(44, 'iPhone XsMax', '600_600_xs_max_white_800x800_3_bebd9519a1814f99ae954bc598ef9bd5_1024x1024.webp', '256Gb', 'Điện thoại', 5, 30, 'Apple', 40, 49, '2023-10-26'),
(48, 'macbook', '1686124909371-mbair2023-15-m2-20.jpg', '512Gb', 'Laptop', 25, 23, 'Apple', 20, 5, '2023-10-10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhvien`
--

CREATE TABLE `thanhvien` (
  `id_tk` int(6) UNSIGNED NOT NULL,
  `taikhoan` varchar(30) NOT NULL,
  `matkhau` varchar(30) NOT NULL,
  `level` int(6) DEFAULT NULL,
  `anh_tv` varchar(255) NOT NULL,
  `hoten` varchar(50) NOT NULL,
  `namsinh` int(10) NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `diachi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thanhvien`
--

INSERT INTO `thanhvien` (`id_tk`, `taikhoan`, `matkhau`, `level`, `anh_tv`, `hoten`, `namsinh`, `sdt`, `diachi`) VALUES
(1, 'huunghia', '123456', 1, '', 'Nguyễn Hữu Nghĩa', 2003, '0992606203', 'Hà Nội'),
(2, 'vantu', '123456', 1, '', 'Nguyễn Văn Tú', 2003, '099999999', 'Nam Định'),
(3, 'tranthanh', '123456', 1, '', 'Trần Văn Thành', 2003, '09888888', 'Hà Nội'),
(4, 'admin', '123456', 1, '', 'ADMIN', 2023, '010101010', 'VN'),
(9, 'nhn566', '123456', 1, '', 'Nghĩa', 2006, '789789789', 'HT');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id_kh`);

--
-- Chỉ mục cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`id_loai_sp`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`id_nha_cc`);

--
-- Chỉ mục cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phieuxuat`
--
ALTER TABLE `phieuxuat`
  ADD PRIMARY KEY (`id_phieu_xuat`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id_sp`),
  ADD KEY `id_sp` (`id_sp`);

--
-- Chỉ mục cho bảng `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD PRIMARY KEY (`id_tk`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id_kh` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `id_loai_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `id_nha_cc` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `phieuxuat`
--
ALTER TABLE `phieuxuat`
  MODIFY `id_phieu_xuat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `thanhvien`
--
ALTER TABLE `thanhvien`
  MODIFY `id_tk` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
