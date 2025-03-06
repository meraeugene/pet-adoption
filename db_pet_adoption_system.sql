-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2025 at 10:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pet_adoption_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `species` enum('Cat','Dog','Bird','Rabbit','Other') NOT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `adoption_status` enum('Available','Adopted') DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `name`, `species`, `breed`, `age`, `gender`, `color`, `adoption_status`, `created_at`) VALUES
(5, 'Chrollo', 'Dog', 'K9', 5, 'Male', 'Brown', 'Available', '2025-03-05 01:51:11'),
(6, 'Prince', 'Cat', 'Persian', 5, 'Female', 'Orange', 'Available', '2025-03-05 02:19:12'),
(7, 'Fiel', 'Dog', 'Labrador Retriever', 3, 'Male', 'Black', 'Available', '2025-03-05 07:21:18'),
(8, 'Roy', 'Dog', 'Beagle', 5, 'Female', 'Brown', 'Available', '2025-03-05 07:21:39'),
(9, 'Rex', 'Dog', 'Bulldog', 5, 'Male', 'Black', 'Available', '2025-03-05 07:22:06'),
(10, 'Jasper', 'Dog', 'Golden Retriever', 7, 'Male', 'Golden', 'Available', '2025-03-05 07:22:27'),
(11, 'Mia', 'Cat', 'Siamese', 4, 'Female', 'White', 'Available', '2025-03-05 07:22:47'),
(12, 'Lia', 'Cat', 'Maine Coon', 5, 'Female', 'Orange', 'Available', '2025-03-05 07:23:08'),
(13, 'Jia', 'Cat', 'Bengal', 2, 'Female', 'Brown', 'Available', '2025-03-05 07:23:41'),
(14, 'Yana', 'Cat', 'Ragdoll', 4, 'Male', 'Blue', 'Available', '2025-03-05 07:24:05'),
(15, 'Monk', 'Bird', 'Parrot', 2, 'Male', 'Green', 'Available', '2025-03-05 07:28:31'),
(16, 'Lux', 'Bird', 'Canary', 2, 'Male', 'Blue', 'Available', '2025-03-05 07:28:52'),
(17, 'Coke', 'Bird', 'Cockatiel', 2, 'Male', 'Orange', 'Available', '2025-03-05 07:29:09'),
(18, 'Ae', 'Bird', 'Budgerigar', 2, 'Female', 'Purple', 'Available', '2025-03-05 07:29:27');

-- --------------------------------------------------------

--
-- Table structure for table `request_adoption`
--

CREATE TABLE `request_adoption` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_adoption`
--

INSERT INTO `request_adoption` (`id`, `user_id`, `pet_id`, `status`, `request_date`) VALUES
(13, 6, 6, 'Pending', '2025-03-05 09:23:03'),
(14, 6, 7, 'Pending', '2025-03-05 09:24:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `birthday` date NOT NULL,
  `verification` int(11) NOT NULL DEFAULT 0,
  `profilePicture` longblob DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstName`, `lastName`, `email`, `password`, `phoneNumber`, `gender`, `role`, `birthday`, `verification`, `profilePicture`, `createdAt`) VALUES
(4, 'admin', 'user', 'admin@email.com', '123', '123', 'Male', 'admin', '2025-03-03', 0, NULL, '2025-03-05 03:03:10'),
(6, 'andrew', 'villalon', 'andrew@email.com', '123', '123', 'Male', 'user', '2025-03-04', 0, NULL, '2025-03-05 03:04:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_adoption`
--
ALTER TABLE `request_adoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `request_adoption`
--
ALTER TABLE `request_adoption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request_adoption`
--
ALTER TABLE `request_adoption`
  ADD CONSTRAINT `request_adoption_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `request_adoption_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
