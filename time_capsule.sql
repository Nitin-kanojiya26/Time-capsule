-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 11:16 AM
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
-- Database: `time_capsule`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `reveal_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sent` tinyint(1) DEFAULT 0,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `content`, `reveal_date`, `created_at`, `sent`, `message`) VALUES
(1, 1, 'hello', '2025-04-14', '2025-04-13 16:03:52', 1, ''),
(2, 1, 'hello', '2025-04-14', '2025-04-13 19:00:17', 1, ''),
(3, 1, NULL, '2025-04-14', '2025-04-13 19:08:15', 1, 'This is your Time Capsule message!'),
(4, 1, 'hello', '2025-04-14', '2025-04-13 19:10:13', 1, ''),
(5, 1, '123', '2025-04-14', '2025-04-13 19:40:07', 1, ''),
(6, 1, '//', '2025-04-14', '2025-04-14 14:42:44', 1, ''),
(7, 2, 'hello', '2025-04-14', '2025-04-14 15:15:50', 1, ''),
(8, 1, '??', '2025-04-14', '2025-04-14 15:17:02', 1, ''),
(9, 1, '123', '2025-04-15', '2025-04-15 03:19:30', 1, ''),
(10, 3, '123', '2025-04-15', '2025-04-15 03:23:49', 1, ''),
(11, 1, 'today', '2025-04-15', '2025-04-15 10:33:42', 1, ''),
(12, 6, 'hello', '2025-04-15', '2025-04-15 10:39:51', 1, ''),
(13, 6, 'hello guys', '2025-04-16', '2025-04-15 10:41:15', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Nitin', 'kanojiyanitin870@gmail.com', '$2y$10$jaDy5Mc1labl3G.z.NuT.uBFgV05wEZqdfyhPuDJFL2OaUWi/7rra'),
(2, 'punita', 'kanojiyapunita0@gmail.com', '$2y$10$VMCABhIoJsvLskoYe2glO.IcgNsFfHATFrMUusBR.55Q.LCXJfOb6'),
(3, 'chaitanya', 'chavdachaitany55@gmail.com', '$2y$10$5NsyFl8tNBvIwQqMJ9EGWutEJJNMSbYQ/XqrFjoFnbBSvMwXGjno2'),
(6, 'rudra', 'rudy26078@gmail.com', '$2y$10$uu4dSirZnID5uUV5Ejupme6ZLFNooAaItp1oeJmClcQKHz.rK8uui');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
