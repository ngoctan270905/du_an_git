-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2025 at 11:56 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agile`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(1, 'admin1', 'hashed_password_1', 'admin1@example.com', '2025-03-26 15:35:12', '2025-03-26 15:35:12'),
(2, 'admin2', 'hashed_password_2', 'admin2@example.com', '2025-03-26 15:35:12', '2025-03-26 15:35:12'),
(3, 'admin', '$2y$10$WAKH2eG1z5Y5z5Y5z5Y5z5uWAKH2eG1z5Y5z5Y5z5Y5z5uWAKH2eG1z', 'admin@example.com', '2025-03-26 16:07:24', '2025-03-26 16:07:24'),
(4, 'admin5', '$2y$10$hJlBCGoeKYtv5JVXbgBmTeegFS.WPFlUS/ceeMulChYbNRUbxssV.', 'admin5@example.com', '2025-03-26 16:11:46', '2025-03-26 16:11:46');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Điện thoại', 'Danh mục sản phẩm điện thoại', '2025-03-26 15:35:12', '2025-03-26 15:35:12'),
(2, 'Laptop', 'Danh mục sản phẩm laptop', '2025-03-26 15:35:12', '2025-03-26 15:35:12'),
(3, 'Phụ kiện', 'Danh mục phụ kiện công nghệ', '2025-03-26 15:35:12', '2025-03-26 15:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `username`, `password`, `email`, `full_name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'client1', 'hashed_password_3', 'client1@example.com', 'Nguyen Van A', '0123456789', '123 Đường ABC, TP HCM', '2025-03-26 15:35:12', '2025-03-26 15:35:12'),
(2, 'client2', 'hashed_password_4', 'client2@example.com', 'Tran Thi B', '0987654321', '456 Đường XYZ, Hà Nội', '2025-03-26 15:35:12', '2025-03-26 15:35:12'),
(3, 'client3', 'hashed_password_5', 'client3@example.com', 'Le Van C', '0912345678', '789 Đường DEF, Đà Nẵng', '2025-03-26 15:35:12', '2025-03-26 15:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `import_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `discount_price`, `image`, `category_id`, `import_date`, `created_at`, `updated_at`) VALUES
(1, 'iPhone 14', 'Điện thoại mới nhất từ Apple', '999.99', '899.99', NULL, 2, '2025-03-01', '2025-03-26 15:35:12', '2025-03-26 16:16:04'),
(2, 'Samsung S23', 'Điện thoại cao cấp từ Samsung', '899.99', NULL, NULL, 1, '2025-03-10', '2025-03-26 15:35:12', '2025-03-26 15:35:12'),
(3, 'MacBook Pro', 'Laptop cao cấp từ Apple', '1499.99', '1299.99', NULL, 2, '2025-03-15', '2025-03-26 15:35:12', '2025-03-26 15:35:12'),
(4, 'Tai nghe AirPods', 'Tai nghe không dây từ Apple', '199.99', '179.99', NULL, 3, '2025-03-20', '2025-03-26 15:35:12', '2025-03-26 15:35:12'),
(5, 'Xiaomi 15', 'hhh', '1111.00', '111.00', 'uploads/1743076517g.jpg', 1, '2025-03-27', '2025-03-27 11:55:17', '2025-03-27 11:55:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
