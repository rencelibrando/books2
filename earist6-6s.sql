-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 06:45 AM
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
-- Database: `earist`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `ACTIVE` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `user_id`, `product_id`, `quantity`, `ACTIVE`, `created_at`) VALUES
(1, 1, 1, 25, 1, '2024-05-08 05:11:00'),
(15, 2, 8, 4, 1, '2024-05-14 20:38:25'),
(16, 2, 9, 52, 1, '2024-05-14 22:46:46'),
(17, 2, 9, 5, 1, '2024-05-14 23:27:14'),
(19, 1, 6, 1, 1, '2024-05-19 20:02:49'),
(21, 2, 3, 5, 1, '2024-06-04 17:19:21'),
(23, 2, 5, 12, 1, '2024-06-04 17:43:38'),
(24, 2, 4, 1, 1, '2024-06-04 17:47:44'),
(29, 2, 4, 1, 1, '2024-06-04 17:55:50'),
(30, 2, 1, 1, 1, '2024-06-04 18:05:36'),
(31, 2, 7, 3, 1, '2024-06-04 18:12:45'),
(32, 2, 9, 4, 1, '2024-06-04 18:13:38'),
(33, 2, 5, 1, 1, '2024-06-04 21:09:49'),
(34, 2, 5, 1, 1, '2024-06-04 21:56:07'),
(35, 2, 3, 1, 1, '2024-06-04 21:58:42'),
(36, 2, 3, 1, 1, '2024-06-04 22:00:54'),
(37, 2, 1, 1, 1, '2024-06-04 22:02:40'),
(38, 1, 9, 1, 1, '2024-06-04 22:07:07'),
(39, 2, 4, 1, 1, '2024-06-04 22:08:50'),
(40, 2, 6, 1, 1, '2024-06-05 18:47:07'),
(41, 2, 5, 1, 1, '2024-06-05 18:55:25'),
(42, 1, 3, 1, 1, '2024-06-05 19:04:30'),
(43, 2, 9, 1, 1, '2024-06-05 19:07:13'),
(45, 2, 9, 1, 1, '2024-06-05 22:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `payment` varchar(20) NOT NULL,
  `transac` varchar(20) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `quantity`, `status`, `payment`, `transac`, `contact`, `address`, `created_at`) VALUES
(53, 2, 9, 1, '1', 'COD', 'JNT', '12345678910', 'caloocan city', '2024-06-05 19:07:36'),
(54, 2, 9, 1, '1', 'GCash', 'Lalamove', '2', '2', '2024-06-05 22:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Pending\n'),
(2, 'Processing\n'),
(3, 'Shipped\n'),
(4, 'Out for Delivery\n'),
(5, 'Delivered\n'),
(6, 'Delayed'),
(7, 'Cancelled'),
(8, 'Returned');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `ID` int(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `stock` int(10) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`ID`, `product_id`, `name`, `stock`, `price`) VALUES
(1, 1, 'Filipino sa Iba\'t-Ibang Disiplina    ', 5000, 270),
(2, 2, 'Math in Modern World', 125, 320),
(3, 3, 'Life And Works Of Rizal ', 32, 350),
(4, 4, 'Konstekstwalisadong Komunikasyon sa Filipino', 61, 320),
(5, 5, 'Communication in the Age of Globalization', 23, 360),
(6, 6, 'Intro to Computing', 125, 320),
(7, 7, 'Data Base Management Module', 632, 350),
(8, 8, 'Art Appreciation ', 900, 330),
(9, 9, 'Mathematics for College Readiness ', 400, 330);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `student_number` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `contact_number`, `address`, `email`, `student_number`, `password`, `created_at`) VALUES
(1, 'JUAN', 'Dela cruz', 't', 't', 't@t', 't', '$2y$10$RAJCCec8rnRii7YTUTh8DOoeoiPQypjnIVhvzOO3Zp7glebGfPxp6', '2024-05-06 07:16:46'),
(2, 'Jose', 'mari chan', 'a', 'a', 'a@a', 'a', '$2y$10$cPlessakyJDjOLZ7XNDDleyaTvSnU.ESo5Y7Z7TJUtVkDSzuw4F66', '2024-05-06 07:18:11'),
(3, 'jomari', 'dela cruz', '123123123', '21421', 'jomari@t', 'astatatast', '$2y$10$AVTCFdrWopSK5nA4x/WpJOGJUtFA4fSK.AlV00zjwccyGpBxKe9Fe', '2024-05-09 07:03:03'),
(4, 'jm', 'dc', '123125', 'asaya', 'jmdc@jmdc', 'asyha6ya214', '$2y$10$98Fnm4pQs/rBAqzEiV85FO7y6FGVwL0Iqou/KtSr13eWyDU9VX/JW', '2024-05-09 07:04:37'),
(5, 'c', 'c', 'c', 'c', 'c@c', 'c', '$2y$10$LkN.yDOd3Dd.0AytFNe4X.ZDi8xcLdZasTtd1nc525MVwxNX305fu', '2024-05-20 00:52:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
