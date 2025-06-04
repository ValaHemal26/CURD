-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2025 at 12:27 PM
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
-- Database: `curd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_mst`
--

--
-- Dumping data for table `admin_mst`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `gender` varchar(10) NOT NULL,
  `hobbies` text NOT NULL,
  `education` varchar(50) NOT NULL,
  `privacy_policy` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `dob`, `email`, `password`, `mobile`, `address`, `gender`, `hobbies`, `education`, `privacy_policy`, `created_at`, `updated_at`) VALUES
(11, 'Nirav', 'chhodavadiya', '2005-02-20', 'nirav.chhodavadiya@aksharsoftsolutions.com', '8d51f9f1ba0f9d2ca0b86dcd8ce1a378', '9912321894', 'bhayli road near krishna apartment ', 'Male', 'Reading,Sports', 'BCA', 1, '2025-06-03 15:19:45', '2025-06-04 13:00:30'),
(14, 'John', 'Doe', '1990-01-15', 'john.doe@example.com', 'password123', '1234567890', '123 Main St, NY', 'Male', 'Reading', 'BSC', 1, '2025-06-03 17:15:22', '2025-06-04 12:30:54'),
(15, 'Jane', 'Smith', '1992-05-23', 'jane.smith@example.com', '5844a15e76563fedd11840fd6f40ea7b', '2345678901', '456 Elm St, CA', 'Female', '', 'MCA', 1, '2025-06-03 17:15:22', '2025-06-03 19:12:28'),
(16, 'Robert', 'Brown', '1988-09-10', 'robert.brown@example.com', '684c851af59965b680086b7b4896ff98', '3456789012', '789 Oak St, TX', 'Male', '', 'M TECH', 1, '2025-06-03 17:15:22', '2025-06-03 19:12:49'),
(17, 'Emily', 'Davis', '1995-03-30', 'emily.davis@example.com', 'abc123', '4567890123', '135 Pine St, FL', 'Female', '', 'BCA', 1, '2025-06-03 17:15:22', '2025-06-04 12:22:57'),
(18, 'Michael', 'Wilson', '1991-11-19', 'michael.wilson@example.com', 'pass789', '5678901234', '246 Birch St, IL', 'Male', 'Photography,Sports', 'M TECH', 1, '2025-06-03 17:15:22', '2025-06-03 18:57:52'),
(19, 'Sarah', 'Johnson', '1987-07-02', 'sarah.johnson@example.com', 'letmein', '6789012345', '357 Maple St, WA', 'Female', 'Yoga,Drawing', 'MSC', 1, '2025-06-03 17:15:22', '2025-06-03 18:57:43'),
(20, 'David', 'Miller', '1993-12-14', 'david.miller@example.com', 'mypassword', '7890123456', '468 Cedar St, OH', 'Male', 'Blogging,Gardening', 'BCA', 1, '2025-06-03 17:15:22', '2025-06-03 18:57:37'),
(21, 'Laura', 'Anderson', '1990-08-25', 'laura.anderson@example.com', '123456', '8901234567', '579 Walnut St, NJ', 'Female', 'Crafts,Coding', 'M.Tech', 1, '2025-06-03 17:15:22', '2025-06-03 17:15:22'),
(22, 'James', 'Taylor', '1994-02-17', 'james.taylor@example.com', 'testpass', '9012345678', '680 Spruce St, GA', 'Male', 'Cycling,Hiking', 'MSC', 1, '2025-06-03 17:15:22', '2025-06-03 18:57:28'),
(23, 'Olivia', 'Martin', '1996-10-05', 'olivia.martin@example.com', 'bb77d0d3b3f239fa5db73bdf27b8d29a', '0123456789', '791 Ash St, MI', 'Female', '', 'BCA', 1, '2025-06-03 17:15:22', '2025-06-03 19:09:58'),
(24, 'rahul', 'baraiya', '2020-03-20', 'rb@gmail.com', '25d55ad283aa400af464c76d713c07ad', '8921523549', 'Raghav nagar', 'Male', 'Reading,Music', 'BCA', 1, '2025-06-03 17:20:46', '2025-06-03 17:20:46'),
(25, 'kavit', 'sondagar', '2005-01-20', 'amit@gmail.com', '77ed6be9e63c8d2295380de2c4f3e350', '5246852226', 'kansara bazar near vallabha bhaug', 'Male', 'Reading,Music', 'BCA', 1, '2025-06-03 18:30:55', '2025-06-03 18:30:55'),
(26, 'kanha', 'pandey', '2007-01-20', 'kanha@gmail.com', '1f3c3c86ccc82acb02c1e71503b18deb', '9601654316', 'ramesh fjgnfj fdjngfmgjvjn', 'Male', 'Reading', 'BCA', 1, '2025-06-03 18:41:31', '2025-06-03 18:41:31'),
(27, 'madhav', 'mandaviya', '2005-03-20', 'mm@gmail.com', 'c15222297f394d7269a9c6b1c0c79db2', '6988512265', 'bhayli road vadodara', 'Male', 'Reading', 'BCA', 1, '2025-06-04 10:54:09', '2025-06-04 10:54:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_mst`
--
--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_mst`
--
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
