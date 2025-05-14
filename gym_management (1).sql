-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 05:45 PM
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
-- Database: `gym_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('SuperAdmin','Manager') DEFAULT 'Manager',
  `last_login` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `role`, `last_login`) VALUES
(1, 'admin@example.com', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'Manager', '2025-04-02 02:44:53'),
(2, 'admin@gmail.com', '$2y$10$jrw1FVZTW1zeaF5hdIo66OLhXfzz5.zQDeTKC2KQRygPG9kSI5ESy', '', '2025-05-06 11:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('Login','Logout') NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `status`, `login_time`, `logout_time`, `timestamp`) VALUES
(1, 2, 'Logout', '2025-05-14 11:49:11', '2025-05-14 11:49:27', '2025-05-14 03:49:11'),
(2, 7, 'Login', '2025-05-14 11:51:23', NULL, '2025-05-14 03:51:23'),
(3, 3, 'Logout', '2025-05-14 11:52:17', '2025-05-14 11:52:25', '2025-05-14 03:52:17'),
(4, 7, 'Logout', '2025-05-14 12:45:51', '2025-05-14 12:45:53', '2025-05-14 04:45:51'),
(5, 7, 'Login', '2025-05-14 12:46:16', NULL, '2025-05-14 04:46:16'),
(6, 1, 'Login', '2025-05-14 12:48:18', NULL, '2025-05-14 04:48:18'),
(7, 2, 'Logout', '2025-05-14 13:13:35', '2025-05-14 15:01:28', '2025-05-14 05:13:35'),
(8, 1, 'Logout', '2025-05-14 15:24:58', '2025-05-14 15:25:04', '2025-05-14 07:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_folders`
--

CREATE TABLE `attendance_folders` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `student_id` varchar(50) DEFAULT NULL,
  `course` varchar(50) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `customer_id` varchar(50) DEFAULT NULL,
  `payment_plan` varchar(50) DEFAULT NULL,
  `services` text DEFAULT NULL,
  `faculty_id` varchar(50) DEFAULT NULL,
  `faculty_dept` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `age`, `gender`, `email`, `phone`, `role`, `student_id`, `course`, `section`, `customer_id`, `payment_plan`, `services`, `faculty_id`, `faculty_dept`, `created_at`) VALUES
(1, 'Sharies', 'Esoto', 21, 'Female', 'shariesesoto@gmail.com', '09615273069', 'Faculty', NULL, NULL, NULL, NULL, '', '', '2212121', 'COT', '2025-05-07 04:52:31'),
(2, 'Yosef', 'Esoto', 5, 'Male', 'shariesesoto1@gmail.com', '09615273061', 'Student', '3221852', 'BSIT', '3B DAY', NULL, '', '', NULL, NULL, '2025-05-07 04:55:36'),
(3, 'Gerlle', 'Sabanal', 22, 'Female', 'shariesesotoq@gmail.com', '09615273065', 'Customer', NULL, NULL, NULL, '7369540', '', 'Gym Access', NULL, NULL, '2025-05-07 05:00:39'),
(4, 'Ethel', 'Esoto', 23, 'Female', 'shariesesotoaa@gmail.com', '09615273064', 'Faculty', NULL, NULL, NULL, NULL, '', '', '1111111', 'COE', '2025-05-07 05:04:46'),
(5, 'Sharies', 'sharies', 11, 'Male', 'shariesesoto111@gmail.com', '09615273111', 'Student', '3221811', 'BSIT', '3B DAY', NULL, '', '', NULL, NULL, '2025-05-07 05:15:04'),
(6, 'Sharies', 'sharies', 1111, 'Female', 'shariesesoto0@gmail.com', '09615273067', 'Faculty', NULL, NULL, NULL, NULL, '', '', '1111111', 'COT', '2025-05-07 05:16:22'),
(7, 'Juan', 'Dela Cruz', 35, 'Male', NULL, NULL, 'Faculty', NULL, NULL, NULL, NULL, NULL, NULL, 'F1234567', NULL, '2025-05-07 05:40:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `attendance_folders`
--
ALTER TABLE `attendance_folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `attendance_folders`
--
ALTER TABLE `attendance_folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance_folders`
--
ALTER TABLE `attendance_folders`
  ADD CONSTRAINT `attendance_folders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
