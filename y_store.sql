-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2024 at 04:00 PM
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
-- Database: `y_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(2, 'category 20', 'bla bla bla');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Gender` varchar(250) NOT NULL,
  `billing_address` varchar(250) NOT NULL,
  `default_shipping_address` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `upgrade` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_name`, `password`, `Email`, `Gender`, `billing_address`, `default_shipping_address`, `country`, `phone`, `image`, `upgrade`) VALUES
(6, 'admin', '698d51a19d8a121ce581499d7b701668', 'admin@gmail.com', 'male', 'admin admin', 'admin admin', 'KSA', '111111111', 'test.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(250) NOT NULL,
  `order_name` varchar(250) NOT NULL,
  `price` int(250) NOT NULL,
  `customer_id` int(250) NOT NULL,
  `quantity` int(250) NOT NULL,
  `order_address` varchar(250) NOT NULL,
  `payment_method` varchar(250) NOT NULL,
  `order_Email` varchar(250) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `order_state` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `watches`
--

CREATE TABLE `watches` (
  `ID` int(11) NOT NULL,
  `watchname` varchar(250) NOT NULL,
  `category_type` varchar(250) NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `price` int(250) NOT NULL,
  `provenance` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `watches`
--

INSERT INTO `watches` (`ID`, `watchname`, `category_type`, `category_name`, `price`, `provenance`, `description`, `image`) VALUES
(9, 'A Lange And Sohne Watch iPhone 4s Wallpapers', 'material', '500', 0, 'china', 'A Lange And Sohne Watch iPhone 4s Wallpapers', 'A Lange And Sohne Watch iPhone 4s Wallpapers.jpg'),
(10, 'Polar Unite Fitness Smartwatch', 'test', '200', 0, 'japan', 'Polar Unite Fitness Smartwatch', 'Polar Unite Fitness Smartwatch.jpg'),
(11, 'Ladies Ingersoll The Herald Watch I00405', 'test', '120', 0, 'china', 'Ladies Ingersoll The Herald Watch I00405', 'Ladies Ingersoll The Herald Watch I00405.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `watches`
--
ALTER TABLE `watches`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `watches`
--
ALTER TABLE `watches`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
