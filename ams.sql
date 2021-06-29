-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 29, 2021 at 06:56 AM
-- Server version: 8.0.21
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `name` varchar(20) NOT NULL,
  `id` varchar(10) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`,`subject`,`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`name`, `id`, `subject`, `date`) VALUES
('Rowan', 's8', 'Engineering Mechanics', '2021-06-30'),
('Mikey', 's7', 'Engineering Mechanics', '2021-06-30'),
('Braun', 's6', 'Engineering Mechanics', '2021-06-30'),
('Jason', 's5', 'Engineering Mechanics', '2021-06-30'),
('kevin', 's4', 'Engineering Mechanics', '2021-06-30'),
('mark', 's3', 'Engineering Mechanics', '2021-06-30'),
('Rowan', 's8', 'Engineering Mathematics 1', '2021-06-27'),
('mark', 's3', 'Engineering Mathematics 1', '2021-06-27'),
('sam', 's2', 'Engineering Mathematics 1', '2021-06-27'),
('sam', 's2', 'Engineering Chemistry 1', '2021-06-27'),
('yocchan', 's1', 'Engineering Mathematics 1', '2021-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_login`
--

DROP TABLE IF EXISTS `faculty_login`;
CREATE TABLE IF NOT EXISTS `faculty_login` (
  `faculty_id` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`faculty_id`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `faculty_login`
--

INSERT INTO `faculty_login` (`faculty_id`, `username`, `password`) VALUES
('1', 'a1', '$2y$10$kJxO.s70rJhpwOIQlS17nOZr7RPyjei.Gbkpb3D2mAvmR4f3s3lNO');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_register`
--

DROP TABLE IF EXISTS `faculty_register`;
CREATE TABLE IF NOT EXISTS `faculty_register` (
  `faculty_id` varchar(20) NOT NULL,
  `faculty_email` varchar(50) NOT NULL,
  `is_registered` int NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `faculty_register`
--

INSERT INTO `faculty_register` (`faculty_id`, `faculty_email`, `is_registered`) VALUES
('1', 'abc@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sem1_subjects`
--

DROP TABLE IF EXISTS `sem1_subjects`;
CREATE TABLE IF NOT EXISTS `sem1_subjects` (
  `subject1` varchar(60) NOT NULL,
  `subject2` varchar(60) NOT NULL,
  `subject3` varchar(60) NOT NULL,
  `subject4` varchar(60) NOT NULL,
  `subject5` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sem1_subjects`
--

INSERT INTO `sem1_subjects` (`subject1`, `subject2`, `subject3`, `subject4`, `subject5`) VALUES
('Engineering Mathematics 1', 'Engineering Physics 1', 'Engineering Chemistry 1', 'Engineering Mechanics', 'Basic Electrical Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `sem2_subjects`
--

DROP TABLE IF EXISTS `sem2_subjects`;
CREATE TABLE IF NOT EXISTS `sem2_subjects` (
  `subject1` varchar(60) NOT NULL,
  `subject2` varchar(60) NOT NULL,
  `subject3` varchar(60) NOT NULL,
  `subject4` varchar(60) NOT NULL,
  `subject5` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sem2_subjects`
--

INSERT INTO `sem2_subjects` (`subject1`, `subject2`, `subject3`, `subject4`, `subject5`) VALUES
('Engineering Mathematics 2', 'Engineering Physics 2', 'Engineering Chemistry 2', 'Engineering Drawing', 'C Programming');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `name` varchar(40) NOT NULL,
  `id` varchar(20) NOT NULL,
  `course` varchar(50) NOT NULL,
  `sem` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`name`, `id`, `course`, `sem`) VALUES
('yocchan', 's1', 'Information Technology', 1),
('sam', 's2', 'Computer Engineering', 1),
('mark', 's3', 'Computer Engineering', 1),
('kevin', 's4', 'Computer Engineering', 1),
('Jason', 's5', 'Computer Engineering', 1),
('Braun', 's6', 'Computer Engineering', 1),
('Mikey', 's7', 'Computer Engineering', 1),
('Rowan', 's8', 'Computer Engineering', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `sem` int NOT NULL,
  `department` varchar(60) NOT NULL,
  `subject1` varchar(60) NOT NULL,
  `subject2` varchar(60) NOT NULL,
  `subject3` varchar(60) NOT NULL,
  `subject4` varchar(60) NOT NULL,
  `subject5` varchar(60) NOT NULL,
  PRIMARY KEY (`sem`,`department`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`sem`, `department`, `subject1`, `subject2`, `subject3`, `subject4`, `subject5`) VALUES
(3, 'Electronics', 'A', 'B', 'C', 'D', 'E'),
(3, 'Computer Engineering', 'AM', 'B', 'CM', 'D', 'E'),
(3, 'Information Technology', 'Engineering Maths-3', 'DSA', 'DBMS', 'PCPF', 'PCOM'),
(3, 'Electronics and Telecommunications', 'A', 'B', 'C', 'D', 'E'),
(4, 'Information Technology', 'A', 'B', 'C', 'D', 'E'),
(4, 'Computer Engineering', 'A', 'B', 'C', 'D', 'E'),
(4, 'Electronics', 'A', 'B', 'C', 'D', 'E'),
(4, 'Electronics and Telecommunications', 'A', 'B', 'C', 'D', 'E'),
(5, 'Information Technology', 'A', 'B', 'C', 'D', 'E'),
(5, 'Computer Engineering', 'A', 'B', 'C', 'D', 'E'),
(5, 'Electronics', 'A', 'B', 'C', 'D', 'E'),
(5, 'Electronics and Telecommunications', 'A', 'B', 'C', 'D', 'E'),
(6, 'Information Technology', 'A', 'B', 'C', 'D', 'E'),
(6, 'Computer Engineering', 'A', 'B', 'C', 'D', 'E'),
(6, 'Electronics', 'A', 'B', 'C', 'D', 'E'),
(6, 'Electronics and Telecommunications', 'A', 'B', 'C', 'D', 'E'),
(7, 'Information Technology', 'A', 'B', 'C', 'D', 'E'),
(7, 'Computer Engineering', 'A', 'B', 'C', 'D', 'E'),
(7, 'Electronics', 'A', 'B', 'C', 'D', 'E'),
(7, 'Electronics and Telecommunications', 'A', 'B', 'C', 'D', 'E'),
(8, 'Information Technology', 'A', 'B', 'C', 'D', 'E'),
(8, 'Computer Engineering', 'A', 'B', 'C', 'D', 'E'),
(8, 'Electronics', 'A', 'B', 'C', 'D', 'E'),
(8, 'Electronics and Telecommunications', 'A', 'B', 'C', 'D', 'E');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
