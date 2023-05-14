-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2023 at 03:22 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_description` text DEFAULT NULL,
  `course_instructor` varchar(255) DEFAULT NULL,
  `course_start_date` date DEFAULT NULL,
  `course_end_date` date DEFAULT NULL,
  `course_capacity` int(11) DEFAULT NULL,
  `semester_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_name`, `course_description`, `course_instructor`, `course_start_date`, `course_end_date`, `course_capacity`, `semester_id`) VALUES
(1, 'CS 110', 'Computer Science Principles', 'An introduction to the fundamental concepts of computer science.', 'John Smith', '2023-06-01', '2023-08-31', 50, 1),
(2, 'CS 120', 'Programming and Problem Solving I', 'Introduction to programming with an emphasis on problem solving and algorithm development.', 'Jane Doe', '2023-09-01', '2023-12-31', 50, 1),
(3, 'CS 121', 'Programming and Problem Solving II', 'Continuation of programming with an emphasis on more complex data structures and algorithms.', 'John Smith', '2024-01-01', '2024-04-30', 50, 3),
(4, 'CS 220', 'Data Structures and Algorithms', 'Study of algorithms and data structures used in computer programming.', 'Jane Doe', '2024-01-01', '2024-04-30', 50, 3),
(5, 'CS 230', 'Discrete Mathematics for Computer Science', 'Introduction to discrete mathematics with a focus on its applications in computer science.', 'John Smith', '2024-06-01', '2024-08-31', 50, 2),
(6, 'CS 240', 'Introduction to Computer Organization and Architecture', 'Introduction to the hardware components and the instruction set architecture of a computer system.', 'Jane Doe', '2024-09-01', '2024-12-31', 50, 2),
(7, 'CS 330', 'Database Systems', 'Design and implementation of database systems.', 'John Smith', '2025-01-01', '2025-04-30', 50, 3),
(8, 'CS 345', 'Operating Systems', 'Introduction to the principles of operating systems.', 'Jane Doe', '2025-01-01', '2025-04-30', 50, 3),
(9, 'CS 410', 'Software Engineering', 'Study of software engineering concepts and techniques for designing, implementing, and testing software systems.', 'John Smith', '2025-06-01', '2025-08-31', 50, 2),
(10, 'CS 460', 'Computer Networks', 'Introduction to computer networks and their protocols, architecture, and algorithms.', 'Jane Doe', '2025-09-01', '2025-12-31', 50, 2);

-- --------------------------------------------------------

--
-- Table structure for table `course_offerings`
--

CREATE TABLE `course_offerings` (
  `id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_offerings`
--

INSERT INTO `course_offerings` (`id`, `semester_id`, `course_id`, `capacity`) VALUES
(1, 1, 1, 50),
(2, 1, 2, 40),
(3, 1, 3, 30),
(4, 2, 4, 50),
(5, 2, 5, 40),
(6, 2, 6, 30),
(7, 3, 7, 50),
(8, 3, 8, 40),
(9, 3, 9, 30),
(10, 3, 10, 20);

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_waitlisted` tinyint(1) NOT NULL DEFAULT 0,
  `waitlist_position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `student_id`, `class_id`, `registration_date`, `is_waitlisted`, `waitlist_position`) VALUES
(6, 1, 9, '2023-05-12 06:31:26', 0, NULL),
(7, 1, 7, '2023-05-12 06:31:35', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `semester_code` varchar(15) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semester_code`, `start_date`, `end_date`) VALUES
(1, 'Summer 2023', '2023-06-01', '2023-08-31'),
(2, 'Fall 2023', '2023-09-01', '2023-12-31'),
(3, 'Spring 2024', '2024-01-01', '2024-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `phone`, `email`, `registration_date`, `role`) VALUES
(1, 'Kendric Garmon', '$2y$10$KFMpkMAhi4UI1sUhTz9xD.Z6aierVBAtjTokLZ56pi2tIhYr924hi', '', '', 'kendric.c.garmon@gmail.com', '2023-05-12 03:15:33', '');

-- --------------------------------------------------------

--
-- Table structure for table `waiting_list`
--

CREATE TABLE `waiting_list` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `waitlist_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_offerings`
--
ALTER TABLE `course_offerings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waiting_list`
--
ALTER TABLE `waiting_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class_id_2` (`class_id`,`student_id`,`waitlist_date`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course_offerings`
--
ALTER TABLE `course_offerings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `waiting_list`
--
ALTER TABLE `waiting_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_offerings`
--
ALTER TABLE `course_offerings`
  ADD CONSTRAINT `course_offerings_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `course_offerings_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `waiting_list`
--
ALTER TABLE `waiting_list`
  ADD CONSTRAINT `waiting_list_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `waiting_list_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `courses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
