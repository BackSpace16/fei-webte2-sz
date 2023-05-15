-- phpMyAdmin SQL Dump
-- version 5.2.1deb1+jammy2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 15, 2023 at 08:03 PM
-- Server version: 8.0.32-0ubuntu0.22.04.2
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zaverecnezadanie`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_slovak_ci NOT NULL,
  `password` longtext COLLATE utf8mb4_slovak_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_slovak_ci NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_slovak_ci DEFAULT NULL,
  `is_teacher` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `surname`, `is_teacher`) VALUES
(1, 'student1', '$argon2id$v=19$m=65536,t=4,p=1$R0pMTEpIekVjRVNOYnZsQQ$YX1koSMK6FNf35UtijV/PHnwcnc7SwDNGVz6H53Eb6Y', 'Študent', '1', 0),
(2, 'student2', '$argon2id$v=19$m=65536,t=4,p=1$dE9NU0VpMUlrbHRibVcxQg$9Okyts4DLXNKmbIpHl63IKH2oqKDWS2muDotQ9GQaSk', 'Študent', '2', 0),
(3, 'student3', '$argon2id$v=19$m=65536,t=4,p=1$VVkyMHBZci9rNE8zTGpXYg$IOIFGTPmCS82G+MZhJgJJT69oWJbzeIybRB3S+f66fU', 'Študent', '3', 0),
(4, 'teacher1', '$argon2id$v=19$m=65536,t=4,p=1$aGxRT05ERy8vblR1bFNJWA$FsXbSNboxNVT3bntp6Qqx5F1xoBHGsEFbst2EvObPUQ', 'Učiteľ', '1', 1),
(5, 'teacher2', '$argon2id$v=19$m=65536,t=4,p=1$LnNOVEhXNkJab29Ha2tSSw$VfF4nqCLeUj7uugix01SGF6Vm4EDnxwnlg/yxeCf3ZM', 'Učiteľ', '2', 1);

--
-- Indexes for dumped tables
--

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
