-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2024 at 06:08 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_size` varchar(5) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `image`, `product_name`, `product_size`, `quantity`, `price`, `subtotal`, `created_at`) VALUES
(15, 25, 27, '1712508794.jpg', 'New Balance 550 White Green', '40', 1, '2999000.00', '2999000.00', '2024-06-27 04:14:57'),
(16, 25, 28, '1712508985.jpg', 'New Balance 550 Nightwatch Green', '41', 1, '2499000.00', '2499000.00', '2024-06-27 04:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` longtext NOT NULL,
  `trending` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `trending`, `status`, `created_at`) VALUES
(5, 'Adidas', 'Yeezy', 0, 0, '2024-04-06 13:32:21'),
(6, 'Nike', 'Air Jordan, Air Force, Air Max, Dunk', 0, 0, '2024-04-06 13:33:15'),
(7, 'New Balance', 'New Balance', 0, 0, '2024-04-06 13:50:53'),
(8, 'Air Jorjan', 'Jordan', 0, 0, '2024-04-06 14:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `subtotal`, `name`, `address`, `phone`, `email`, `created_at`) VALUES
(1, 25, 32, 1, '16999000.00', 'bryen', 'Jalan.H.Alim No59 RT02/02 Larangan Selatan, Larangan, Kota Tangerang kode:15154', '087785476280', 'masfebriansyah2004@gmail.com', '2024-06-24 17:11:55'),
(2, 25, 26, 1, '13499000.00', 'bryen', 'Jalan.H.Alim No59 RT02/02 Larangan Selatan, Larangan, Kota Tangerang kode:15154', '087785476280', 'masfebriansyah2004@gmail.com', '2024-06-24 17:11:55'),
(3, 25, 33, 1, '22499000.00', 'bryen', 'Jalan.H.Alim No59 RT02/02 Larangan Selatan, Larangan, Kota Tangerang kode:15154', '087785476280', 'masfebriansyah2004@gmail.com', '2024-06-24 17:11:55');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `small_description` mediumtext NOT NULL,
  `long_description` longtext NOT NULL,
  `price` varchar(191) NOT NULL,
  `offerprice` varchar(191) NOT NULL,
  `tax` varchar(191) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(191) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=show, 1=hide',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `small_description`, `long_description`, `price`, `offerprice`, `tax`, `quantity`, `image`, `status`, `created_at`) VALUES
(21, 5, 'Yeezy Boost 350 V2 Bred', '-', '100% Original Authentic\r\n100% Trusted since 2016\r\nBrand New with Tag / Box\r\n\r\nBergaransi Tukar Ukuran, selama sesuai dengan ketentuan penukaran produk.\r\n\r\nTeam ahli kami memastikan keaslian semua produk yang dijual dan sudah melalui pengecekan kondisi fisik secara detail.\r\n\r\nHappy Shopping!', '6.499.000', '-', '-', 3, '1712410537.jpg', 0, '2024-04-06 13:35:37'),
(22, 6, 'Air Force 1 Low White', '', '100% Original Authentic\r\n100% Trusted since 2016\r\nBrand New with Tag / Box\r\n\r\nBergaransi Tukar Ukuran, selama sesuai dengan ketentuan penukaran produk.\r\n\r\nTeam ahli kami memastikan keaslian semua produk yang dijual dan sudah melalui pengecekan kondisi fisik secara detail.\r\n\r\nHappy Shopping!', '2.099.000', '-', '-', 2, '1712411132.jpg', 0, '2024-04-06 13:45:32'),
(24, 8, 'Air Jordan 1 Low Multi Color Sashiko', '', '100% Original Authentic\r\n100% Trusted since 2016\r\nBrand New with Tag / Box\r\n\r\nBergaransi Tukar Ukuran, selama sesuai dengan ketentuan penukaran produk.\r\n\r\nTeam ahli kami memastikan keaslian semua produk yang dijual dan sudah melalui pengecekan kondisi fisik secara detail.\r\n\r\nHappy Shopping!', '2.499.000', '-', '-', 2, '1712414525.jpg', 0, '2024-04-06 14:42:05'),
(25, 5, 'Yeezy Boost 350 V2 Zebra', '', '100% Original Authentic\r\n100% Trusted since 2016\r\nBrand New with Tag / Box\r\n\r\nBergaransi Tukar Ukuran, selama sesuai dengan ketentuan penukaran produk.\r\n\r\nTeam ahli kami memastikan keaslian semua produk yang dijual dan sudah melalui pengecekan kondisi fisik secara detail.\r\n\r\nHappy Shopping!', '6.499.000', '-', '-', 3, '1712508190.jpg', 0, '2024-04-07 16:43:10'),
(26, 6, 'Dunk Low Sb Sean Cliver Holiday Special', '', '100% Original Authentic\r\n100% Trusted since 2016\r\nBrand New with Tag / Box\r\n\r\nBergaransi Tukar Ukuran, selama sesuai dengan ketentuan penukaran produk.\r\n\r\nTeam ahli kami memastikan keaslian semua produk yang dijual dan sudah melalui pengecekan kondisi fisik secara detail.\r\n\r\nHappy Shopping!', '13.499.000', '-', '-', 2, '1712508551.jpg', 0, '2024-04-07 16:49:11'),
(27, 7, 'New Balance 550 White Green', '', '100% Original Authentic\r\n100% Trusted since 2016\r\nBrand New with Tag / Box\r\n\r\nBergaransi Tukar Ukuran, selama sesuai dengan ketentuan penukaran produk.\r\n\r\nTeam ahli kami memastikan keaslian semua produk yang dijual dan sudah melalui pengecekan kondisi fisik secara detail.\r\n\r\nHappy Shopping!', '2.999.000', '-', '-', 2, '1712508794.jpg', 0, '2024-04-07 16:53:14'),
(28, 7, 'New Balance 550 Nightwatch Green', '', '100% Original Authentic\r\n100% Trusted since 2016\r\nBrand New with Tag / Box\r\n\r\nBergaransi Tukar Ukuran, selama sesuai dengan ketentuan penukaran produk.\r\n\r\nTeam ahli kami memastikan keaslian semua produk yang dijual dan sudah melalui pengecekan kondisi fisik secara detail.\r\n\r\nHappy Shopping!', '2.499.000', '-', '-', 1, '1712508985.jpg', 0, '2024-04-07 16:56:25'),
(29, 6, 'Air Jordan 1 Low White Wolf Grey', '', '100% Original Authentic\r\n100% Trusted since 2016\r\nBrand New with Tag / Box\r\n\r\nBergaransi Tukar Ukuran, selama sesuai dengan ketentuan penukaran produk.\r\n\r\nTeam ahli kami memastikan keaslian semua produk yang dijual dan sudah melalui pengecekan kondisi fisik secara detail.\r\n\r\nHappy Shopping!', '2.799.000', '3.099.000', '-', 2, '1712578368.jpg', 0, '2024-04-08 12:12:48'),
(30, 6, 'Airmax 97 Black Antrachite', '', '100% Original Authentic\r\n100% Trusted since 2016\r\nBrand New with Tag / Box\r\n\r\nBergaransi Tukar Ukuran, selama sesuai dengan ketentuan penukaran produk.\r\n\r\nTeam ahli kami memastikan keaslian semua produk yang dijual dan sudah melalui pengecekan kondisi fisik secara detail.\r\n\r\nHappy Shopping!', '2.799.000', '-', '-', 3, '1712578851.jpg', 0, '2024-04-08 12:20:51'),
(31, 6, 'Sb Dunk Low Yuto Horigame', '', '100% Original Authentic\r\n100% Trusted since 2016\r\nBrand New with Tag / Box\r\n\r\nBergaransi Tukar Ukuran, selama sesuai dengan ketentuan penukaran produk.\r\n\r\nTeam ahli kami memastikan keaslian semua produk yang dijual dan sudah melalui pengecekan kondisi fisik secara detail.\r\n\r\nHappy Shopping!', '5.499.000', '-', '-', 3, '1712579290.jpg', 0, '2024-04-08 12:28:10'),
(32, 8, 'Air Jordan 1 Low Golf Olive Travis Scott', '', '100% Original Authentic\r\n100% Trusted since 2016\r\nBrand New with Tag / Box\r\n\r\nBergaransi Tukar Ukuran, selama sesuai dengan ketentuan penukaran produk.\r\n\r\nTeam ahli kami memastikan keaslian semua produk yang dijual dan sudah melalui pengecekan kondisi fisik secara detail.\r\n\r\nHappy Shopping!', '16.999.000', '-', '-', 2, '1712579766.jpg', 0, '2024-04-08 12:36:06'),
(33, 8, 'Air Jordan 1 Low Travis Scott Reverse Mocha', '', '100% Original Authentic\r\n100% Trusted since 2016\r\nBrand New with Tag / Box\r\n\r\nBergaransi Tukar Ukuran, selama sesuai dengan ketentuan penukaran produk.\r\n\r\nTeam ahli kami memastikan keaslian semua produk yang dijual dan sudah melalui pengecekan kondisi fisik secara detail.\r\n\r\nHappy Shopping!', '22.499.000', '-', '-', 2, '1712580446.jpg', 0, '2024-04-08 12:47:26'),
(34, 5, 'Adidas Samba Sporty Rich White Burgundy', '', '100% Original Authentic\r\n100% Trusted since 2016\r\nBrand New with Tag / Box\r\n\r\nBergaransi Tukar Ukuran, selama sesuai dengan ketentuan penukaran produk.\r\n\r\nTeam ahli kami memastikan keaslian semua produk yang dijual dan sudah melalui pengecekan kondisi fisik secara detail.\r\n\r\nHappy Shopping!', '2.999.000', '-', '-', 3, '1712580824.jpg', 0, '2024-04-08 12:53:44'),
(35, 5, 'Adidas Sambae White Green Gum', '', '100% Original Authentic\r\n100% Trusted since 2016\r\nBrand New with Tag / Box\r\n\r\nBergaransi Tukar Ukuran, selama sesuai dengan ketentuan penukaran produk.\r\n\r\nTeam ahli kami memastikan keaslian semua produk yang dijual dan sudah melalui pengecekan kondisi fisik secara detail.\r\n\r\nHappy Shopping!', '2.699.00', '-', '-', 4, '1712580951.jpg', 0, '2024-04-08 12:55:51'),
(36, 7, 'New Balance 550 Vintage Teal', '', '100% Original Authentic\r\n100% Trusted since 2016\r\nBrand New with Tag / Box\r\n\r\nBergaransi Tukar Ukuran, selama sesuai dengan ketentuan penukaran produk.\r\n\r\nTeam ahli kami memastikan keaslian semua produk yang dijual dan sudah melalui pengecekan kondisi fisik secara detail.\r\n\r\nHappy Shopping!', '2.299.000', '-', '-', 4, '1712581076.jpg', 0, '2024-04-08 12:57:56'),
(37, 7, 'New Balance 990 V1 Teddy Santis Marblehead', '', '100% Original Authentic\r\n100% Trusted since 2016\r\nBrand New with Tag / Box\r\n\r\nBergaransi Tukar Ukuran, selama sesuai dengan ketentuan penukaran produk.\r\n\r\nTeam ahli kami memastikan keaslian semua produk yang dijual dan sudah melalui pengecekan kondisi fisik secara detail.\r\n\r\nHappy Shopping!', '4.299.000', '-', '-', 2, '1712581422.jpg', 0, '2024-04-08 13:03:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `role`, `created_at`) VALUES
(14, 'brian', '087785476280', 'admin@gmail.com', '$2y$10$84vK/bWUhD9pihoOw0HH8eUM5tBUhJ//v2RbPSoKs4coIvzBZrdAO', 'admin', NULL),
(25, 'bryan', '087785476666', 'user@gmail.com', '$2y$10$YkeBmlL7clmoWrUZdidHcO39pwIR6h0R24yktf.9DbJ.yYlP63fpm', 'user', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
