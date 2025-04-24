-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 08:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mathsmaker`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email_verification_token` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `email_verification_token`, `remember_token`, `created_at`, `updated_at`) VALUES
('89f15492-dcb7-408b-8cef-4abefdf24e1a', 'John Doe', 'user@gmail.com', '2025-04-24 01:04:23', '$2y$12$j6FhQJdsurB3xynvQ6345epZrGETBtf/FeqJ/SOaaNIFVEwkGygVK', NULL, NULL, '2025-04-24 01:04:23', '2025-04-24 01:04:23'),
('9bab09b3-9b25-4bc3-9a2b-b41413ccb33a', 'Abhraham lin', 'karmakarsayan567@gmail.com', '2025-04-24 01:04:23', '$2y$12$PrPZeLSnfEBVbe4489Ub9uD4ooc0QIIXjjNNsT.4RgBtQ455c/Y4W', NULL, NULL, '2025-04-24 01:04:23', '2025-04-24 01:04:23'),
('fc4bdb75-c589-4fb9-8220-f81477bcebf5', 'saurojit', 'saurojitkarmakar947@gmail.com', '2025-04-24 01:04:22', '$2y$12$vwAxNGfF9r6gYKiSUzicUe.ylNlTUrgyMsC/MjunSw...xmn12xei', NULL, NULL, '2025-04-24 01:04:22', '2025-04-24 01:04:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
