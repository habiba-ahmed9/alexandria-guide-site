-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 06:26 PM
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
-- Database: `alexandria_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `submitted_at`) VALUES
(1, 'habiba ahmed gomaa', 'sh@gmail.com', 'alex', 'i need to travel again', '2026-05-05 16:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `tour_plans`
--

CREATE TABLE `tour_plans` (
  `id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `attractions` text NOT NULL,
  `tour_date` date NOT NULL,
  `travelers` int(11) DEFAULT 1,
  `accommodation` varchar(100) DEFAULT NULL,
  `transport` varchar(100) DEFAULT NULL,
  `total_cost` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_plans`
--

INSERT INTO `tour_plans` (`id`, `user_email`, `attractions`, `tour_date`, `travelers`, `accommodation`, `transport`, `total_cost`, `created_at`) VALUES
(1, 'sh@gmail.com', '[\"Qaitbay Citadel\",\"Montazah Gardens\"]', '2026-05-07', 4, 'Standard Hotel ($100/night)', 'Taxi - $20/day', 0, '2026-05-05 16:13:56'),
(2, 'sh@gmail.com', '[\"Bibliotheca Alexandrina\"]', '2026-05-21', 2, 'Budget Hotel ($50/night)', 'Private Driver - $50/day', 0, '2026-05-05 16:16:12'),
(3, 'sh@gmail.com', '[\"Montazah Gardens\"]', '2026-04-29', 2, 'Budget Hotel ($50/night)', 'Private Driver - $50/day', 0, '2026-05-05 16:30:28'),
(4, 'sh@gmail.com', '[\"Bibliotheca Alexandrina\",\"Qaitbay Citadel\"]', '2026-04-28', 2, 'Budget Hotel ($50/night)', 'Public Bus - $5/day', 0, '2026-05-05 17:06:22'),
(5, 'sh@gmail.com', '[\"Bibliotheca Alexandrina\",\"Qaitbay Citadel\",\"Alexandria Corniche\"]', '2026-04-29', 4, '50', '5', 0, '2026-05-05 17:11:23'),
(6, 'sh@gmail.com', '[\"Bibliotheca Alexandrina\",\"Qaitbay Citadel\",\"Alexandria Corniche\"]', '2026-04-29', 4, '50', '5', 0, '2026-05-05 17:11:33'),
(7, 'sh@gmail.com', '[\"Bibliotheca Alexandrina\",\"Montazah Gardens\"]', '2026-04-29', 3, '50', '5', 0, '2026-05-05 17:26:57'),
(8, 'sh@gmail.com', '[\"Montazah Gardens\"]', '2026-05-12', 4, '50', '5', 0, '2026-05-05 18:00:31'),
(9, 'zein@gmail.com', '[\"Bibliotheca Alexandrina\",\"Montazah Gardens\"]', '2026-05-07', 3, '250', '50', 0, '2026-05-05 20:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `created_at`) VALUES
(1, 'Test User', 'test@example.com', 'password123', '2026-05-05 15:48:06'),
(2, 'Habiba Ahmed ', 'h.ahmed@gmail.com', '$2y$10$op9Ak.e.z93tc94ngtNPquS/rpaO6jaB6TsulYN6iAl819taXe/OC', '2026-05-05 16:00:17'),
(5, 'Habiba Ahmed ', 'sh@gmail.com', '$2y$10$yU1Pvq6KOu9nrgHkPGPkhuyitU./gr70Lmlnw4bqrnPs/.f8gmLoi', '2026-05-05 16:13:09'),
(8, 'Habiba Ahmed ', 'ah@gmail.com', '$2y$10$2kEoF4B.mQ4p502ZS8h6eeZzZGbQTP79bzCYSXp.QkodFhg/NLjdq', '2026-05-05 16:49:55'),
(10, 'Zein ', 'zein@gmail.com', '$2y$10$6Hgoiz5tis.C6yV4yrFzY.MGU3ol5lEitllSrZftVWb60DZuSpCEq', '2026-05-05 20:21:59'),
(11, 'cc', 'e@gmail.com', '$2y$10$jvUOo2TQbN0bQOEnsgZQmeQ8ZJRnxuEvRe8eIMldcz5EqEKptitla', '2026-05-18 16:22:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_plans`
--
ALTER TABLE `tour_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`user_email`);

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
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tour_plans`
--
ALTER TABLE `tour_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tour_plans`
--
ALTER TABLE `tour_plans`
  ADD CONSTRAINT `tour_plans_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
