-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 09, 2024 at 02:01 AM
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
  `counselor_id` int DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `counselor_id`, `status`, `date`, `time`) VALUES
(17, 1, 7, 'Pending', '2024-01-05', '9:00 AM'),
(18, 1, 7, 'Completed', '2024-01-05', '10:00 AM'),
(19, 1, 8, 'Pending', '2024-01-05', '9:00 AM'),
(20, 1, 8, 'Pending', '2024-01-06', '9:00 AM'),
(21, 1, 7, 'Pending', '2024-01-05', '1:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `counselors`
--

CREATE TABLE `counselors` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `picture_path` varchar(255) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `experience` text,
  `education` text,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `counselors`
--

INSERT INTO `counselors` (`id`, `name`, `description`, `email`, `phone_number`, `picture_path`, `specialization`, `languages`, `experience`, `education`, `password`) VALUES
(7, 'Test', 'Test', 'counsellor_test@gmail.com', '123', '../assets/counsellorPic/6595bfa45b58f_1704312740.jpeg', 'test', 'test', '3', 'test', '$2y$10$D26MVWsdCXqvhtqti7Ihp.kV7ex.9k4pOFbk2.94k7d.nxHRN/5vO'),
(8, 'Test2', 'Test2', 'counsellor_test2@gmail.com', '123', '../assets/counsellorPic/65965b0cb8663_1704352524.jpg', 'test', 'test', '12', 'test', '$2y$10$R/XqLxdWgIMWp/w8ZRElFOYMzNg70oG/8oq4TxiRNlC8yT6sITBRK'),
(9, 'Test3', 'test', 'counsellor_test3@gmail.com', '123', '../assets/counsellorPic/6596757677e4d_1704359286.jpg', 'test', '12', '12', 'test', '$2y$10$5paaQgWGgcFSWRrNt/cePeyo3Es6Ai5Ae9mIYkvU1chdT1JNJiqha'),
(10, 'test4', 'tes', 'counsellor_test4@gmail.com', '123', '../assets/counsellorPic/659676947f188_1704359572.jpg', '123', '123', '123', '123', '$2y$10$EYOAQEcKfHonVSbdBnsIjegQJq3yGFL/GgolcSygYqbQfZFo0CeH.');

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
(8, 7, 'Happy', 'asdasd', 3, '2023-12-31 09:37:14'),
(9, 7, 'Angry', 'fsdfds', 3, '2023-12-31 09:37:17'),
(10, 7, 'Happy', 'fsdfsdf', 3, '2023-12-31 09:37:20'),
(11, 7, 'Relaxed', 'fsdfsdf', 3, '2023-12-31 09:37:22'),
(12, 7, 'Anxious', 'fsdfsd', 3, '2023-12-31 09:37:25'),
(13, 8, 'Happy', 'asdasd', 3, '2023-12-31 09:55:41'),
(14, 8, 'Happy', 'asdsa', 3, '2023-12-31 09:55:43'),
(15, 8, 'Happy', 'asdasd', 3, '2023-12-31 09:55:44'),
(16, 8, 'Sad', 'asd', 3, '2023-12-31 09:55:48'),
(17, 8, 'Angry', 'asd', 3, '2023-12-31 09:55:51'),
(18, 8, 'Relaxed', 'asasda', 3, '2023-12-31 09:55:54'),
(19, 8, 'Anxious', 'asdasd', 3, '2023-12-31 09:55:56'),
(20, 8, 'Anxious', 'asdasd', 3, '2023-12-31 09:55:59'),
(21, 9, 'Sad', 'I\'m feeling sad ', 5, '2024-01-07 07:59:00'),
(29, 1, 'Anxious', 'dfdsfsd', 3, '2024-01-07 20:23:00'),
(30, 1, 'Anxious', 'asdasdasds', 3, '2024-01-07 20:23:05');

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

--
-- Dumping data for table `log_symptoms`
--

INSERT INTO `log_symptoms` (`log_id`, `user_id`, `symptom`, `description`, `rating`, `logged_at`) VALUES
(2, 1, 'Anxiety', 'asdadsd', 3, '2023-12-01 10:58:30'),
(3, 1, 'Fatigue', 'dfdsfsd', 2, '2023-12-06 14:48:42'),
(4, 1, 'Insomnia', 'dfdsfsd', 3, '2023-12-06 14:48:47'),
(5, 1, 'Headache', 'asdasdasds', 3, '2023-12-10 23:01:32'),
(6, 1, 'Headache', '\'\';\'l;\'l;\'l', 3, '2023-12-10 23:01:57'),
(7, 7, 'Fatigue', 'sdfsdfsdfsd', 3, '2023-12-31 09:37:29'),
(8, 7, 'Anxiety', 'sdfsdf', 3, '2023-12-31 09:37:31'),
(9, 7, 'Insomnia', 'sdfsdfds', 3, '2023-12-31 09:37:35'),
(10, 7, 'Insomnia', 'fsdfsdf', 3, '2023-12-31 09:37:37'),
(11, 7, 'Headache', 'fsdfdsf', 3, '2023-12-31 09:37:41'),
(12, 8, 'Fatigue', 'asdsadas', 3, '2023-12-31 09:56:08'),
(13, 8, 'Fatigue', 'asdasd', 3, '2023-12-31 09:56:10'),
(14, 8, 'Nausea', 'asdasd', 3, '2023-12-31 09:56:13'),
(15, 8, 'Anxiety', 'asdasd', 3, '2023-12-31 09:56:15'),
(16, 8, 'Insomnia', 'asdasasd', 3, '2023-12-31 09:56:18'),
(17, 8, 'Headache', 'adsdas', 3, '2023-12-31 09:56:21'),
(18, 8, 'Headache', 'asdasd', 3, '2023-12-31 09:56:23'),
(19, 8, 'Nausea', 'asdasd', 3, '2023-12-31 09:56:25'),
(20, 1, 'Headache', 'gnbvb', 3, '2024-01-07 08:22:58'),
(21, 1, 'Anxiety', 'bfgb', 3, '2024-01-07 08:23:01');

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
(1, 1, 'Moderately severe', 3, 1, 2, 3, 0, 0, 2, 2, 2, 15, 'Warrants active treatment with psychotherapy, medications, or combination', '2023-12-06 14:55:05'),
(2, 1, 'Mild', 3, 1, 1, 0, 0, 0, 0, 0, 0, 5, 'Use clinical judgment (symptom duration, functional impairment) to determine necessity of treatment', '2023-12-11 02:02:48'),
(3, 1, 'Severe', 3, 3, 3, 3, 3, 3, 3, 3, 3, 27, 'Warrants active treatment with psychotherapy, medications, or combination', '2023-12-13 19:52:19'),
(4, 1, 'Moderately severe', 2, 1, 0, 1, 1, 3, 3, 3, 3, 17, 'Warrants active treatment with psychotherapy, medications, or combination', '2023-12-27 09:15:55'),
(5, 1, 'Severe', 3, 2, 3, 2, 2, 2, 2, 2, 2, 20, 'Warrants active treatment with psychotherapy, medications, or combination', '2023-12-31 09:23:42'),
(6, 7, 'Severe', 3, 3, 3, 3, 3, 3, 3, 3, 3, 27, 'Warrants active treatment with psychotherapy, medications, or combination', '2023-12-31 09:37:56'),
(7, 7, 'Minimal or none', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Monitor; may not require treatment', '2023-12-31 09:38:14'),
(8, 7, 'Mild', 1, 0, 1, 0, 0, 1, 1, 0, 1, 5, 'Use clinical judgment (symptom duration, functional impairment) to determine necessity of treatment', '2023-12-31 09:38:31'),
(9, 8, 'Severe', 3, 3, 3, 3, 3, 3, 3, 3, 3, 27, 'Warrants active treatment with psychotherapy, medications, or combination', '2023-12-31 09:56:36'),
(10, 8, 'Severe', 3, 3, 3, 3, 3, 3, 3, 3, 3, 27, 'Warrants active treatment with psychotherapy, medications, or combination', '2023-12-31 09:56:57'),
(11, 8, 'Minimal or none', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Monitor; may not require treatment', '2023-12-31 09:57:11'),
(12, 8, 'Minimal or none', 1, 1, 0, 0, 0, 0, 0, 0, 2, 4, 'Monitor; may not require treatment', '2023-12-31 09:58:43'),
(13, 8, 'Moderately severe', 2, 2, 2, 2, 2, 2, 2, 0, 1, 15, 'Warrants active treatment with psychotherapy, medications, or combination', '2023-12-31 09:59:01'),
(14, 1, 'Moderate', 1, 1, 3, 2, 2, 1, 2, 1, 1, 14, 'Use clinical judgment (symptom duration, functional impairment) to determine necessity of treatment', '2024-01-07 21:07:31');

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
(1, 'user', 'saadan12345', '8275646766', 'usersaadan@gmail.com', '$2y$10$Ny7EAvIUclBLReDPgokEReqaGv8c8s9Bk7ffISIg8HcLJg52fSYB6'),
(4, 'admin', 'admin', '0172647566', 'admin@gmail.com', '$2y$10$zWMAVLV6swwGgMtm5gBSl.5n./drDpQEagFNaznLt04bkONSVx946'),
(5, 'user', 'saadan', '0175647566', 'usersaadan1231@gmail.com', '$2y$10$lt3tZKTygzZFD9WrlTo.eu9FG1u0sAenCqEO9hKmIRTnxkRgd44ge'),
(7, 'user', 'saadan', '0182758722', 'usersaadan5@gmail.com', '$2y$10$4Ca1DD7G.5NqpmHiaIlQweOj.k12g1C5slCrQNe.yW8bTJAILkycK'),
(8, 'user', 'Test Account', '0175647653', 'testaccount@gmail.com', '$2y$10$gXaUUsUYYx4vhh5LRMpl6.9P0TCpcBR5P1dr7NPWMqdlQDcDjdm/2'),
(9, 'user', 'usersaadan3@gmail.com', '0172647655', 'usersaadan3@gmail.com', '$2y$10$.n0YK8LnZPcW5VsGKAXgV.HZEfMNZbJb25i.QNaaLkfH9T22lTuYW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `counselor_id` (`counselor_id`);

--
-- Indexes for table `counselors`
--
ALTER TABLE `counselors`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `counselors`
--
ALTER TABLE `counselors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `log_mood`
--
ALTER TABLE `log_mood`
  MODIFY `log_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `log_symptoms`
--
ALTER TABLE `log_symptoms`
  MODIFY `log_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ph9_question`
--
ALTER TABLE `ph9_question`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`counselor_id`) REFERENCES `counselors` (`id`) ON DELETE CASCADE;

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
