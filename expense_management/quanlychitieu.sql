-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 06, 2025 lúc 04:42 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlychitieu`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `spendingtype_id` int(11) DEFAULT NULL,
  `amount` bigint(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `budget`
--

INSERT INTO `budget` (`id`, `spendingtype_id`, `amount`, `start_date`, `end_date`, `user_id`) VALUES
(7, 4, 1000000, '2025-11-01', '2025-12-01', 1),
(8, 4, 500000, '2025-10-01', '2025-11-01', 1),
(9, 4, 400000, '2025-09-01', '2025-10-01', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `incometype_id` int(11) DEFAULT NULL,
  `amount` bigint(11) DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `income`
--

INSERT INTO `income` (`id`, `name`, `incometype_id`, `amount`, `note`, `date`, `time`, `user_id`) VALUES
(1, 'Lương tháng 6', 1, 12000000, '', '2025-06-01', '08:00:00', 1),
(2, 'Lãi đầu tư', 2, 800000, '', '2025-06-10', '09:00:00', 1),
(3, 'Kinh doanh nhỏ', 3, 650000, '', '2025-06-21', '14:00:00', 1),
(4, 'Lương tháng 7', 1, 12000000, '', '2025-07-01', '08:00:00', 1),
(5, 'Lãi đầu tư', 2, 850000, '', '2025-07-13', '09:00:00', 1),
(6, 'Buôn bán online', 4, 700000, '', '2025-07-25', '16:00:00', 1),
(7, 'Lương tháng 8', 1, 12000000, '', '2025-08-01', '08:00:00', 1),
(8, 'Kinh doanh', 3, 750000, '', '2025-08-12', '11:00:00', 1),
(9, 'Lãi đầu tư', 2, 900000, '', '2025-08-23', '10:00:00', 1),
(10, 'Lương tháng 9', 1, 12000000, '', '2025-09-01', '08:00:00', 1),
(11, 'Buôn bán online', 4, 800000, '', '2025-09-14', '12:00:00', 1),
(12, 'Kinh doanh nhỏ', 3, 700000, '', '2025-09-27', '15:00:00', 1),
(13, 'Lương tháng 10', 1, 12000000, '', '2025-10-01', '08:00:00', 1),
(14, 'Lãi đầu tư', 2, 850000, '', '2025-10-10', '10:00:00', 1),
(15, 'Kinh doanh', 3, 720000, '', '2025-10-22', '13:00:00', 1),
(16, 'Lương tháng 11', 1, 12000000, '', '2025-11-01', '08:00:00', 1),
(17, 'Kinh doanh', 3, 700000, '', '2025-11-12', '14:00:00', 1),
(18, 'Buôn bán online', 4, 750000, '', '2025-11-24', '17:00:00', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `incometype`
--

CREATE TABLE `incometype` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `incometype`
--

INSERT INTO `incometype` (`id`, `name`, `user_id`) VALUES
(1, 'Lương', 1),
(2, 'Đầu tư', 1),
(3, 'Kinh doanh', 1),
(4, 'Buôn bán', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `saving`
--

CREATE TABLE `saving` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `amount` bigint(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `completione_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `saving`
--

INSERT INTO `saving` (`id`, `name`, `amount`, `start_date`, `completione_date`, `user_id`) VALUES
(4, 'Mua Laptop mới', 20000000, '2025-06-01', '2025-10-01', 1),
(5, 'Mua xe máy', 50000000, '2025-10-02', '2026-05-01', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `spending`
--

CREATE TABLE `spending` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `spendingtype_id` int(11) DEFAULT NULL,
  `amount` bigint(11) DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `spending`
--

INSERT INTO `spending` (`id`, `name`, `spendingtype_id`, `amount`, `note`, `date`, `time`, `user_id`) VALUES
(1, 'Bữa sáng', 2, 45000, '', '2025-06-02', '08:00:00', 1),
(2, 'Xăng xe', 3, 55000, '', '2025-06-04', '10:00:00', 1),
(3, 'Ăn tối', 2, 90000, '', '2025-06-06', '19:00:00', 1),
(4, 'Cà phê', 4, 35000, '', '2025-06-09', '15:00:00', 1),
(5, 'Điện nước', 1, 820000, '', '2025-06-12', '09:00:00', 1),
(6, 'Ăn trưa', 2, 55000, '', '2025-06-15', '11:30:00', 1),
(7, 'Xăng xe', 3, 60000, '', '2025-06-18', '09:00:00', 1),
(8, 'Mua đồ dùng nhà', 1, 250000, '', '2025-06-21', '14:00:00', 1),
(9, 'Cà phê', 4, 35000, '', '2025-06-24', '15:00:00', 1),
(10, 'Liên hoan bạn bè', 4, 450000, '', '2025-06-28', '20:00:00', 1),
(11, 'Ăn sáng', 2, 45000, '', '2025-07-02', '08:00:00', 1),
(12, 'Xăng xe', 3, 55000, '', '2025-07-05', '10:00:00', 1),
(13, 'Ăn uống', 2, 120000, '', '2025-07-07', '19:00:00', 1),
(14, 'Cà phê', 4, 30000, '', '2025-07-10', '15:00:00', 1),
(15, 'Điện nước', 1, 810000, '', '2025-07-13', '09:00:00', 1),
(16, 'Mua nhu yếu phẩm', 1, 200000, '', '2025-07-17', '14:00:00', 1),
(17, 'Xăng xe', 3, 60000, '', '2025-07-20', '09:00:00', 1),
(18, 'Ăn uống', 2, 60000, '', '2025-07-24', '12:00:00', 1),
(19, 'Cà phê', 4, 35000, '', '2025-07-27', '16:00:00', 1),
(20, 'Đi chơi bạn bè', 4, 420000, '', '2025-07-30', '20:00:00', 1),
(21, 'Bữa sáng', 2, 45000, '', '2025-08-01', '08:00:00', 1),
(22, 'Xăng xe', 3, 60000, '', '2025-08-04', '09:00:00', 1),
(23, 'Ăn tối', 2, 110000, '', '2025-08-06', '19:00:00', 1),
(24, 'Cà phê', 4, 30000, '', '2025-08-08', '15:00:00', 1),
(25, 'Điện nước', 1, 820000, '', '2025-08-12', '09:00:00', 1),
(26, 'Mua đồ gia dụng', 1, 230000, '', '2025-08-15', '14:00:00', 1),
(27, 'Ăn trưa', 2, 55000, '', '2025-08-18', '11:30:00', 1),
(28, 'Cà phê', 4, 35000, '', '2025-08-21', '16:00:00', 1),
(29, 'Xăng xe', 3, 55000, '', '2025-08-25', '10:00:00', 1),
(30, 'Đi chơi', 4, 380000, '', '2025-08-29', '20:00:00', 1),
(31, 'Ăn sáng', 2, 45000, '', '2025-09-02', '08:00:00', 1),
(32, 'Xăng xe', 3, 60000, '', '2025-09-04', '10:00:00', 1),
(33, 'Ăn tối', 2, 120000, '', '2025-09-07', '19:00:00', 1),
(34, 'Cà phê', 4, 30000, '', '2025-09-10', '15:00:00', 1),
(35, 'Điện nước', 1, 815000, '', '2025-09-14', '09:00:00', 1),
(36, 'Mua nhu yếu phẩm', 1, 210000, '', '2025-09-17', '12:00:00', 1),
(37, 'Ăn uống', 2, 60000, '', '2025-09-20', '12:30:00', 1),
(38, 'Cà phê', 4, 35000, '', '2025-09-23', '16:00:00', 1),
(39, 'Xăng xe', 3, 55000, '', '2025-09-26', '10:00:00', 1),
(40, 'Đi chơi', 4, 400000, '', '2025-09-29', '20:00:00', 1),
(41, 'Ăn sáng', 2, 45000, '', '2025-10-01', '08:00:00', 1),
(42, 'Xăng xe', 3, 60000, '', '2025-10-04', '10:00:00', 1),
(43, 'Ăn uống', 2, 110000, '', '2025-10-06', '19:00:00', 1),
(44, 'Cà phê', 4, 30000, '', '2025-10-09', '15:00:00', 1),
(45, 'Điện nước', 1, 820000, '', '2025-10-13', '09:00:00', 1),
(46, 'Mua đồ dùng gia đình', 1, 240000, '', '2025-10-16', '14:00:00', 1),
(47, 'Ăn trưa', 2, 55000, '', '2025-10-19', '11:30:00', 1),
(48, 'Cà phê', 4, 35000, '', '2025-10-22', '16:00:00', 1),
(49, 'Xăng xe', 3, 60000, '', '2025-10-25', '10:00:00', 1),
(50, 'Đi chơi', 4, 410000, '', '2025-10-29', '20:00:00', 1),
(51, 'Ăn sáng', 2, 45000, '', '2025-11-02', '08:00:00', 1),
(52, 'Xăng xe', 3, 55000, '', '2025-11-04', '10:00:00', 1),
(53, 'Ăn tối', 2, 120000, '', '2025-11-07', '19:00:00', 1),
(54, 'Cà phê', 4, 35000, '', '2025-11-10', '15:00:00', 1),
(55, 'Điện nước', 1, 830000, '', '2025-11-14', '09:00:00', 1),
(56, 'Mua nhu yếu phẩm', 1, 230000, '', '2025-11-17', '14:00:00', 1),
(57, 'Ăn trưa', 2, 55000, '', '2025-11-20', '11:30:00', 1),
(58, 'Cà phê', 4, 35000, '', '2025-11-23', '16:00:00', 1),
(59, 'Xăng xe', 3, 60000, '', '2025-11-26', '10:00:00', 1),
(60, 'Đi chơi', 4, 420000, '', '2025-11-29', '20:00:00', 1),
(61, 'Mua Laptop', 5, 20000000, '', '2025-10-01', '00:00:00', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `spendingtype`
--

CREATE TABLE `spendingtype` (
  `id` int(11) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `spendingtype`
--

INSERT INTO `spendingtype` (`id`, `name`, `user_id`) VALUES
(1, 'Nhà cửa', 1),
(2, 'Ăn uống', 1),
(3, 'Di chuyển', 1),
(4, 'Giải trí', 1),
(5, 'Công việc', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tokens`
--

CREATE TABLE `tokens` (
  `user_id` int(11) NOT NULL,
  `token` varchar(32) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `phone_number`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Nguyên', 'nguyennn1701@gmail.com', NULL, 'b0baee9d279d34fa1dfd71aadb908c3f', '2025-12-06 21:47:50', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `expensetype_id` (`spendingtype_id`);

--
-- Chỉ mục cho bảng `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `incometype_id` (`incometype_id`);

--
-- Chỉ mục cho bảng `incometype`
--
ALTER TABLE `incometype`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `saving`
--
ALTER TABLE `saving`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `spending`
--
ALTER TABLE `spending`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `expensetype_id` (`spendingtype_id`);

--
-- Chỉ mục cho bảng `spendingtype`
--
ALTER TABLE `spendingtype`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`user_id`,`token`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `incometype`
--
ALTER TABLE `incometype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `saving`
--
ALTER TABLE `saving`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `spending`
--
ALTER TABLE `spending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `spendingtype`
--
ALTER TABLE `spendingtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `budget_ibfk_2` FOREIGN KEY (`spendingtype_id`) REFERENCES `spendingtype` (`id`);

--
-- Các ràng buộc cho bảng `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `income_ibfk_2` FOREIGN KEY (`incometype_id`) REFERENCES `incometype` (`id`);

--
-- Các ràng buộc cho bảng `incometype`
--
ALTER TABLE `incometype`
  ADD CONSTRAINT `incometype_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `saving`
--
ALTER TABLE `saving`
  ADD CONSTRAINT `saving_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `spending`
--
ALTER TABLE `spending`
  ADD CONSTRAINT `spending_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `spending_ibfk_2` FOREIGN KEY (`spendingtype_id`) REFERENCES `spendingtype` (`id`);

--
-- Các ràng buộc cho bảng `spendingtype`
--
ALTER TABLE `spendingtype`
  ADD CONSTRAINT `spendingtype_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
