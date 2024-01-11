-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2023 at 07:00 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned`
--

CREATE TABLE `assigned` (
  `refno` varchar(50) NOT NULL,
  `title` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `datereceived` date NOT NULL,
  `file` blob NOT NULL,
  `assign` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assigned`
--

INSERT INTO `assigned` (`refno`, `title`, `source`, `datereceived`, `file`, `assign`) VALUES
('123', 'IT', 'Wizzy', '2023-10-05', 0x446174612053747275637475726520616e6420416c676f726974686d732071756575657320616e6420737461636b732e706466, ''),
('qwerty', 'swagger dmv', 'ucla', '2023-08-24', 0x4d6f7365734f6b6f74682d43434e41763720537769746368696e672d63657274696669636174652e706466, '12345678'),
('123', 'IT', 'Wizzy', '2023-10-05', 0x446174612053747275637475726520616e6420416c676f726974686d732071756575657320616e6420737461636b732e706466, '12345678'),
('qwerty', 'swagger dmv', 'ucla', '2023-08-24', 0x4d6f7365734f6b6f74682d43434e41763720537769746368696e672d63657274696669636174652e706466, '37777777'),
('123', 'IT', 'Wizzy', '2023-10-05', 0x446174612053747275637475726520616e6420416c676f726974686d732071756575657320616e6420737461636b732e706466, '37777777'),
('123', 'IT', 'Wizzy', '2023-10-05', 0x446174612053747275637475726520616e6420416c676f726974686d732071756575657320616e6420737461636b732e706466, 'mr'),
('qwerty', 'swagger dmv', 'ucla', '2023-08-24', 0x4d6f7365734f6b6f74682d43434e41763720537769746368696e672d63657274696669636174652e706466, 'kim'),
('123', 'IT', 'Wizzy', '2023-10-05', 0x446174612053747275637475726520616e6420416c676f726974686d732071756575657320616e6420737461636b732e706466, 'kim'),
('123', 'IT', 'Wizzy', '2023-10-05', 0x446174612053747275637475726520616e6420416c676f726974686d732071756575657320616e6420737461636b732e706466, 'kim'),
('123', 'IT', 'Wizzy', '2023-10-05', 0x446174612053747275637475726520616e6420416c676f726974686d732071756575657320616e6420737461636b732e706466, 'kim'),
('qwerty1', 'kj', 'ucla', '2023-10-01', 0x5252492d4e4149524f42492d50415353504f52542d44454c49564552592d4d4f4e2d323554482d4652494441592d323954482d53455054454d4245522d323032332e706466, ''),
('qwerty1', 'kj', 'ucla', '2023-10-01', 0x5252492d4e4149524f42492d50415353504f52542d44454c49564552592d4d4f4e2d323554482d4652494441592d323954482d53455054454d4245522d323032332e706466, 'mr'),
('123', 'IT', 'Wizzy', '2023-10-05', 0x446174612053747275637475726520616e6420416c676f726974686d732071756575657320616e6420737461636b732e706466, 'kim'),
('123', 'IT', 'Wizzy', '2023-10-05', 0x446174612053747275637475726520616e6420416c676f726974686d732071756575657320616e6420737461636b732e706466, 'kim'),
('123', 'IT', 'Wizzy', '2023-10-05', 0x446174612053747275637475726520616e6420416c676f726974686d732071756575657320616e6420737461636b732e706466, 'theo'),
('qwerty', 'swagger dmv', 'ucla', '2023-08-24', 0x4d6f7365734f6b6f74682d43434e41763720537769746368696e672d63657274696669636174652e706466, 'kim'),
('qwerty', 'swagger dmv', 'ucla', '2023-08-24', 0x4d6f7365734f6b6f74682d43434e41763720537769746368696e672d63657274696669636174652e706466, 'kim'),
('123', 'IT', 'Wizzy', '2023-10-05', 0x446174612053747275637475726520616e6420416c676f726974686d732071756575657320616e6420737461636b732e706466, ''),
('123', 'IT', 'Wizzy', '2023-10-05', 0x446174612053747275637475726520616e6420416c676f726974686d732071756575657320616e6420737461636b732e706466, 'theo'),
('123', 'IT', 'Wizzy', '2023-10-05', 0x446174612053747275637475726520616e6420416c676f726974686d732071756575657320616e6420737461636b732e706466, 'kim');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `post`, `created_at`) VALUES
(1, 'clerk', 'clerk', '2023-10-17 14:08:36'),
(2, 'director', 'director', '2023-10-17 14:08:36'),
(3, 'staff', 'staff', '2023-10-17 14:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffname` text NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  `depid` varchar(10) NOT NULL,
  `post` varchar(15) NOT NULL,
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffname`, `email`, `password`, `depid`, `post`, `id`) VALUES
('jess', 'jess@gmail.com', '$2y$10$zgL', 'staff', 'Staff', 456578),
('Theo', 'theo@gmail.com', '$2y$10$U7N', 'Director', 'Director', 1234567),
('kim', 'kim@gmail.com', '$2y$10$Lg3', 'Staff', 'Staff', 12121212),
('moses', 'moses@gmail.com', '$2y$10$QZv', 'Clerical', 'Clerk', 50505050);

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `name`, `email`, `password`, `department_id`, `created_at`) VALUES
(565657, 'jess', 'jess@gmail.com', '$2y$10$udhwCAZ31UXc2vCKBQ60SeRCM6yCXgP9ZUOcep1WB1Mu574Tem74e', 3, '2023-10-17 16:35:22'),
(12345678, 'moses', 'moses@gmail.com', '$2y$10$P/KWpsTDTOsGba1ohyRp6.HkSgAjUYrgCx1G4gNKpQR0VqAOoK7BS', 3, '2023-10-17 14:13:39'),
(20202020, 'wilson', 'wilson@gmail.com', '$2y$10$9f7BhZwhRpC4veoo9nyJiuVgxknAytC.U9DoLDWZh0Q7dXssw9mj6', 1, '2023-10-17 14:22:58'),
(39976117, 'theo', 'theo@gmail.com', '$2y$10$yIzXcjo6ryAfYNs8RX170.1jgvW9650Nd6Fn/.WbcY108GowpGMCW', 2, '2023-10-17 15:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `uploaddocs`
--

CREATE TABLE `uploaddocs` (
  `refno` varchar(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `source` varchar(50) NOT NULL,
  `datereceived` date NOT NULL,
  `file` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploaddocs`
--

INSERT INTO `uploaddocs` (`refno`, `title`, `source`, `datereceived`, `file`) VALUES
('123', 'IT', 'Wizzy', '2023-10-05', 0x446174612053747275637475726520616e6420416c676f726974686d732071756575657320616e6420737461636b732e706466),
('456', 'it', 'kim', '2023-10-19', 0x494e46203232382e706466),
('hjk', 'office ', 'kim', '2023-10-13', 0x446174612053747275637475726520616e6420416c676f726974686d732071756575657320616e6420737461636b732e706466),
('qwerty', 'swagger dmv', 'ucla', '2023-08-24', 0x4d6f7365734f6b6f74682d43434e41763720537769746368696e672d63657274696669636174652e706466),
('qwerty1', 'kj', 'ucla', '2023-10-01', 0x5252492d4e4149524f42492d50415353504f52542d44454c49564552592d4d4f4e2d323554482d4652494441592d323954482d53455054454d4245522d323032332e706466);

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_docs`
--

CREATE TABLE `uploaded_docs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `source_person` varchar(255) NOT NULL,
  `received_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `staff_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploaded_docs`
--

INSERT INTO `uploaded_docs` (`id`, `title`, `file_path`, `source_person`, `received_at`, `staff_id`, `created_at`) VALUES
(1, 'jhgoufh', 'uploads/652ea61e825737.79929264.pdf', 'vouyg', '2023-10-17 16:17:14', 12345678, '2023-10-17 15:19:58'),
(2, 'med', 'uploads/652eb723853c04.13233293.pdf', 'kim', '2023-10-17 16:33:35', 12345678, '2023-10-17 16:32:35'),
(3, 'min', 'uploads/652eb8c126abe0.57491065.pdf', 'heks', '2023-10-17 16:39:57', 565657, '2023-10-17 16:39:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `uploaddocs`
--
ALTER TABLE `uploaddocs`
  ADD PRIMARY KEY (`refno`);

--
-- Indexes for table `uploaded_docs`
--
ALTER TABLE `uploaded_docs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uploaded_docs`
--
ALTER TABLE `uploaded_docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `staffs`
--
ALTER TABLE `staffs`
  ADD CONSTRAINT `staffs_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `uploaded_docs`
--
ALTER TABLE `uploaded_docs`
  ADD CONSTRAINT `uploaded_docs_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
