-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 14, 2024 at 03:25 AM
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
-- Database: `symfony_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240507183144', '2024-05-10 09:01:18', 48);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`) VALUES
(1, 'usernemail', 'name for user', 'last name for user'),
(2, 'usernemail', 'name for user', 'last name for user'),
(3, 'usernemail', 'name for user', 'last name for user'),
(4, 'usernemail', 'name for user', 'last name for user'),
(5, 'usernemail', 'name for user', 'last name for user'),
(6, 'usernemail', 'name for user', 'last name for user'),
(7, 'usernemail', 'name for user', 'last name for user'),
(8, 'usernemail', 'name for user', 'last name for user'),
(9, 'usernemail', 'name for user', 'last name for user'),
(10, 'usernemail', 'name for user', 'last name for user'),
(11, 'usernemail', 'name for user', 'last name for user'),
(12, 'usernemail', 'name for user', 'last name for user'),
(13, 'usernemail', 'name for user', 'last name for user'),
(14, 'usernemail', 'name for user', 'last name for user'),
(15, 'usernemail', 'name for user', 'last name for user'),
(16, 'usernemail', 'name for user', 'last name for user'),
(17, 'usernemail', 'name for user', 'last name for user'),
(18, 'usernemail', 'name for user', 'last name for user'),
(19, 'usernemail', 'name for user', 'last name for user'),
(20, 'usernemail', 'name for user', 'last name for user'),
(21, 'usernemail', 'name for user', 'last name for user'),
(22, 'usernemail', 'name for user', 'last name for user'),
(23, 'usernemail', 'name for user', 'last name for user'),
(24, 'usernemail', 'name for user', 'last name for user'),
(25, 'usernemail', 'name for user', 'last name for user'),
(26, 'usernemail', 'name for user', 'last name for user'),
(27, 'usernemail', 'name for user', 'last name for user'),
(28, 'usernemail', 'name for user', 'last name for user'),
(29, 'usernemail', 'name for user', 'last name for user'),
(30, 'usernemail', 'name for user', 'last name for user'),
(31, 'usernemail', 'name for user', 'last name for user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
