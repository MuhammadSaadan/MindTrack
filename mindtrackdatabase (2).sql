-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 17, 2023 at 08:55 PM
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
(16, 1, 4, 'Pending', '2023-12-17', '9:00 AM');

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
  `education` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `counselors`
--

INSERT INTO `counselors` (`id`, `name`, `description`, `email`, `phone_number`, `picture_path`, `specialization`, `languages`, `experience`, `education`) VALUES
(4, 'test1', 'dasdasd', 'asdasdad@gmail.com', '12312312312323', '../assets/counsellorPic/657c1c4896ada_1702632520.jpg', 'asdasda', 'asdasd', '123', 'asdad'),
(5, 'Chin', 'asasdasdas', '13123asdad@gmail.com', '123123', '../assets/counsellorPic/657c1c612da7e_1702632545.jpeg', 'asdfa', 'dsdfs', '1313', 'asdasd'),
(6, 'asdas', 'dasdad', 'adsasdad@gmail.com', '123123123', '../assets/counsellorPic/657c1dbe0a542_1702632894.jpg', 'adsad', 'asdasd', '123123', 'asdasd');

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
(1, 1, 'Happy', 'asdasd', 3, '2023-12-01 10:58:21'),
(2, 1, 'Happy', 'asdasd', 3, '2023-12-01 10:58:23'),
(3, 1, 'Happy', 'dasdasd', 3, '2023-12-01 10:58:24'),
(4, 1, 'Anxious', 'asdas', 3, '2023-12-04 18:45:09'),
(5, 1, 'Relaxed', 'asdasdas', 3, '2023-12-04 18:45:12'),
(6, 1, 'Angry', 'asdasdasds', 3, '2023-12-06 11:09:30'),
(7, 1, 'Angry', 'asdasd', 3, '2023-12-13 19:46:36');

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
(1, 1, 'Nausea', 'adsdsad', 3, '2023-12-01 10:58:28'),
(2, 1, 'Headache', 'asdadsd', 3, '2023-12-01 10:58:30'),
(3, 1, 'Anxiety', 'dfdsfsd', 3, '2023-12-06 14:48:42'),
(4, 1, 'Insomnia', 'dfdsfsd', 3, '2023-12-06 14:48:47'),
(5, 1, 'Headache', 'asdasdasds', 3, '2023-12-10 23:01:32'),
(6, 1, 'Headache', '\'\';\'l;\'l;\'l', 3, '2023-12-10 23:01:57');

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
(3, 1, 'Severe', 3, 3, 3, 3, 3, 3, 3, 3, 3, 27, 'Warrants active treatment with psychotherapy, medications, or combination', '2023-12-13 19:52:19');

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
(5, 'user', 'saadan', '0175647566', 'usersaadan1231@gmail.com', '$2y$10$lt3tZKTygzZFD9WrlTo.eu9FG1u0sAenCqEO9hKmIRTnxkRgd44ge');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `counselors`
--
ALTER TABLE `counselors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `log_mood`
--
ALTER TABLE `log_mood`
  MODIFY `log_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `log_symptoms`
--
ALTER TABLE `log_symptoms`
  MODIFY `log_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ph9_question`
--
ALTER TABLE `ph9_question`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
