-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2023 at 06:08 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mindtrackdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `counsellor` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `counsellor`, `status`, `date`, `time`) VALUES
(1, 1, 'Dr. Aishah Rahman', 'Pending', '2023-11-28', '9:00 AM'),
(2, 1, 'Dr. Aishah Rahman', 'Pending', '2023-11-28', '10:00 AM'),
(3, 1, 'Dr. Aishah Rahman', 'Pending', '2023-11-29', '9:00 AM'),
(4, 1, 'Dr. Aishah Rahman', 'Pending', '2023-11-29', '10:00 AM'),
(5, 1, 'Dr. Aishah Rahman', 'Pending', '2023-11-28', '11:00 AM');

-- --------------------------------------------------------

--
-- Table structure for table `log_mood`
--

CREATE TABLE `log_mood` (
  `log_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `mood` varchar(50) DEFAULT NULL,
  `description` text,
  `rating` int DEFAULT NULL,
  `logged_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_symptoms`
--

CREATE TABLE `log_symptoms` (
  `log_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `symptom` varchar(50) DEFAULT NULL,
  `description` text,
  `rating` int DEFAULT NULL,
  `logged_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ph9_question`
--

CREATE TABLE `ph9_question` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `severity` varchar(100) DEFAULT NULL,
  `question_1` int DEFAULT NULL,
  `question_2` int DEFAULT NULL,
  `question_3` int DEFAULT NULL,
  `question_4` int DEFAULT NULL,
  `question_5` int DEFAULT NULL,
  `question_6` int DEFAULT NULL,
  `question_7` int DEFAULT NULL,
  `question_8` int DEFAULT NULL,
  `question_9` int DEFAULT NULL,
  `total` int DEFAULT NULL,
  `comment` varchar(300) DEFAULT NULL,
  `logged_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `usertype` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype`, `name`, `phone`, `email`, `password`) VALUES
(1, 'user', 'saadan', '8275646766', 'usersaadan@gmail.com', '$2y$10$Ny7EAvIUclBLReDPgokEReqaGv8c8s9Bk7ffISIg8HcLJg52fSYB6'),
(3, 'user', 'saadan3', '0175647655', 'usersaadan3@gmail.com', '$2y$10$PSgDZToYxURZo/D0wVuJlOId8b7ngjILr0qNY1kWhKUh2O5C.R2Ti'),
(4, 'admin', 'admin', '0172647566', 'admin@gmail.com', '$2y$10$zWMAVLV6swwGgMtm5gBSl.5n./drDpQEagFNaznLt04bkONSVx946');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `log_mood`
--
ALTER TABLE `log_mood`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `log_symptoms`
--
ALTER TABLE `log_symptoms`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ph9_question`
--
ALTER TABLE `ph9_question`
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
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `log_mood`
--
ALTER TABLE `log_mood`
  MODIFY `log_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_symptoms`
--
ALTER TABLE `log_symptoms`
  MODIFY `log_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ph9_question`
--
ALTER TABLE `ph9_question`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `log_mood`
--
ALTER TABLE `log_mood`
  ADD CONSTRAINT `log_mood_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `log_symptoms`
--
ALTER TABLE `log_symptoms`
  ADD CONSTRAINT `log_symptoms_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ph9_question`
--
ALTER TABLE `ph9_question`
  ADD CONSTRAINT `ph9_question_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
