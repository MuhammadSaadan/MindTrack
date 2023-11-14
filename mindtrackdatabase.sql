-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 14, 2023 at 07:12 PM
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
  `name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `counsellor` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `name`, `phone_number`, `counsellor`, `status`, `date`, `time`) VALUES
(23, 50, 'asdas', 'dsadasdsa', 'Dr.Aishah Rahman', 'Pending', '2023-11-14', '10:00 AM'),
(24, 50, 'saadan123333', 'adsdads', 'Dr.Aishah Rahman', 'Pending', '2023-11-15', '10:00 AM'),
(25, 50, 'saadan123333', 'adsdads', 'Dr.Aishah Rahman', 'Pending', '2023-11-15', '10:00 AM'),
(26, 50, 'saadan123333', 'adsdads', 'Dr.Aishah Rahman', 'Pending', '2023-11-15', '10:00 AM'),
(27, 50, 'dasdasd', 'asdsa', 'Dr.Aishah Rahman', 'Pending', '2023-11-15', '10:00 AM'),
(28, 50, 'dasdasd', 'asdsa', 'Dr.Aishah Rahman', 'Pending', '2023-11-15', '10:00 AM');

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

--
-- Dumping data for table `log_mood`
--

INSERT INTO `log_mood` (`log_id`, `user_id`, `mood`, `description`, `rating`, `logged_at`) VALUES
(4, 50, 'Angry', 'dfdsfdsfd', 3, '2023-11-13 17:46:29'),
(5, 50, 'Anxious', 'adsdsad', 3, '2023-11-14 07:16:31'),
(6, 50, 'Sad', 'a', 3, '2023-11-14 08:07:40');

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

--
-- Dumping data for table `ph9_question`
--

INSERT INTO `ph9_question` (`id`, `user_id`, `severity`, `question_1`, `question_2`, `question_3`, `question_4`, `question_5`, `question_6`, `question_7`, `question_8`, `question_9`, `total`, `comment`, `logged_at`) VALUES
(1, 50, 'Moderate', 3, 3, 2, 2, 3, 0, 0, 0, 0, 13, 'Use clinical judgment (symptom duration, functional impairment) to determine necessity of treatment', '2023-11-14 08:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype`, `name`, `email`, `password`) VALUES
(50, 'user', 'saadan', 'usersaadan@gmail.com', '$2y$10$b3lJZ4qtdntBZId0gNvV/.SwhX6z1Uqgat6C/m7fj/CMimoWFNaSm');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `log_mood`
--
ALTER TABLE `log_mood`
  MODIFY `log_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `log_symptoms`
--
ALTER TABLE `log_symptoms`
  MODIFY `log_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ph9_question`
--
ALTER TABLE `ph9_question`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
