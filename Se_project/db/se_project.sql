-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2022 at 03:09 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `se_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `incandexp`
--

CREATE TABLE `incandexp` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `incomeandexpenses`
--

CREATE TABLE `incomeandexpenses` (
  `id` int(11) NOT NULL,
  `income` int(11) NOT NULL,
  `expenses` int(11) NOT NULL,
  `month` varchar(500) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incomeandexpenses`
--

INSERT INTO `incomeandexpenses` (`id`, `income`, `expenses`, `month`, `timestamp`, `status`) VALUES
(1, 5000, 6000, 'มกรา', '2022-03-25 14:03:51', 2),
(3, 89879, 789789879, 'มกรา', '2022-03-25 14:03:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `income_expenses`
--

CREATE TABLE `income_expenses` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_reminder`
--

CREATE TABLE `payment_reminder` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `house_number` int(11) NOT NULL,
  `arrears` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_reminder`
--

INSERT INTO `payment_reminder` (`id`, `name`, `lastname`, `house_number`, `arrears`, `timestamp`, `status`) VALUES
(18, '﻿name', 'lastname', 0, 0, '2022-03-24 13:23:52', 0),
(20, 'ewqew', 'tretr', 2300, 5000, '2022-03-24 13:23:52', 1),
(21, 'qweqe', 'dsfdsf', 2301, 9999, '2022-03-25 14:07:28', 2),
(22, 'หิวข้าว', 'qwwq', 545, 555, '2022-03-25 08:52:58', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incandexp`
--
ALTER TABLE `incandexp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomeandexpenses`
--
ALTER TABLE `incomeandexpenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_expenses`
--
ALTER TABLE `income_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_reminder`
--
ALTER TABLE `payment_reminder`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incandexp`
--
ALTER TABLE `incandexp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `incomeandexpenses`
--
ALTER TABLE `incomeandexpenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `income_expenses`
--
ALTER TABLE `income_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_reminder`
--
ALTER TABLE `payment_reminder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
