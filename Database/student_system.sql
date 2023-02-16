-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 04:04 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `rfid_accounts`
--

CREATE TABLE `rfid_accounts` (
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `userType` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rfid_accounts`
--

INSERT INTO `rfid_accounts` (`username`, `password`, `userType`) VALUES
('admin', 'admin', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `keyCard` varchar(33) NOT NULL,
  `timeIn` varchar(50) NOT NULL,
  `timeOut` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`userId`, `firstName`, `middleName`, `lastName`, `keyCard`, `timeIn`, `timeOut`) VALUES
(7, 'exampleFN', 'exampleMN', 'exampleLN', 'A0:20:1B:32', '9:59 am, May-19-2021', '9:59 am, May-19-2021'),
(8, 'exampleFN', 'exampleMN', 'exampleLN', 'A0:20:1B:32', '9:59 am, May-19-2021', '10:01:05 am, May-19-2021'),
(9, 'exampleFN', 'exampleMN', 'exampleLN', 'A0:20:1B:32', '10:01:23 am, May-19-2021', '10:13:31 am, May-19-2021'),
(10, 'exampleFN', 'exampleMN', 'exampleLN', 'A0:20:1B:32', '10:25:23 am, May-19-2021', '10:25:29 am, May-19-2021'),
(11, 'exampleFN', 'exampleMN', 'exampleLN', 'A0:20:1B:32', '10:25:50 am, May/19/2021', '10:26:15 am, May-19-2021'),
(12, 'exampleFN', 'exampleMN', 'exampleLN', 'A0:20:1B:32', '12:50:59 pm, May-19-2021', '1:05:46 pm, May-19-2021'),
(13, 'exampleFN', 'exampleMN', 'exampleLN', 'A0:20:1B:32', '1:27:14 pm, May-19-2021', '1:27:22 pm, May-19-2021');

-- --------------------------------------------------------

--
-- Table structure for table `student_users`
--

CREATE TABLE `student_users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `keyCard` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_users`
--

INSERT INTO `student_users` (`id`, `firstName`, `middleName`, `lastName`, `keyCard`) VALUES
(3, 'exampleFN', 'exampleMN', 'exampleLN.', 'A0:20:1B:32'),
(10, 'FNExample1', 'MNExample1', 'LNExample1', '83:75:D2:40'),
(11, 'FNExample2', 'MNExample2', 'LNExample2', '93:D8:8F:40'),
(12, 'FNExample3', 'MNExample3', 'LNExample3', '90:3F:D6:32'),
(13, 'FNExample4', 'MNExample4', 'LNExample4', '80:37:84:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `student_users`
--
ALTER TABLE `student_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `student_users`
--
ALTER TABLE `student_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
