-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2023 at 04:26 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dtr_qr`
--

-- --------------------------------------------------------

--
-- Table structure for table `dtr`
--

CREATE TABLE `dtr` (
  `id_dtr` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `time_in` datetime DEFAULT NULL,
  `time_out` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dtr`
--

INSERT INTO `dtr` (`id_dtr`, `employee_id`, `user_id`, `date_added`, `time_in`, `time_out`) VALUES
(1, 2, 1, '2023-02-27 16:01:46', '2023-02-27 16:00:12', '2023-02-27 16:01:46');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id_employee` int(11) NOT NULL,
  `qrcode` varchar(20) NOT NULL,
  `qrcode_file` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `datetime_added` datetime DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id_employee`, `qrcode`, `qrcode_file`, `first_name`, `last_name`, `created_by`, `datetime_added`, `datetime_updated`) VALUES
(2, 'emp-0002', 'emp-0002-qr4nu.png', 'Juan', 'dela Cruz', 1, '2023-02-26 14:21:17', '2023-02-26 14:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `history_date` datetime DEFAULT NULL,
  `history_name` varchar(30) NOT NULL,
  `history_category` varchar(70) NOT NULL,
  `history_action` varchar(30) NOT NULL,
  `history_remarks` varchar(300) DEFAULT NULL,
  `history_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='history';

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `history_date`, `history_name`, `history_category`, `history_action`, `history_remarks`, `history_user`) VALUES
(1, '2023-02-26 14:14:51', '2', 'EMPLOYEES', 'ADD', NULL, 1),
(2, '2023-02-26 14:16:56', '1', 'EMPLOYEES', 'ADD', NULL, 1),
(3, '2023-02-26 14:17:23', '1', 'EMPLOYEES', 'ADD', NULL, 1),
(4, '2023-02-26 14:21:17', '2', 'EMPLOYEES', 'ADD', NULL, 1),
(5, '2023-02-26 14:31:08', '2', 'EMPLOYEES', 'UPDATE', NULL, 1),
(6, '2023-02-26 14:31:13', '2', 'EMPLOYEES', 'UPDATE', NULL, 1),
(7, '2023-02-26 14:36:39', '3', 'EMPLOYEES', 'ADD', NULL, 1),
(8, '2023-02-26 14:37:45', '3', 'USER ACCOUNTS', 'DELETE', ' ', 1),
(9, '2023-02-26 17:54:48', '1', 'USER ACCOUNTS', 'ADD', NULL, 1),
(10, '2023-02-26 18:01:27', '1', 'USER ACCOUNTS', 'UPDATE', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `logs_id` int(11) NOT NULL,
  `logs_date` datetime NOT NULL,
  `logs_user` int(11) NOT NULL,
  `logs_action` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`logs_id`, `logs_date`, `logs_user`, `logs_action`) VALUES
(1, '2023-02-27 11:14:15', 1, 'LOGIN ATTEMPT'),
(2, '2023-02-27 11:15:17', 1, 'LOGIN ATTEMPT'),
(3, '2023-02-27 11:18:16', 1, 'LOGOUT'),
(4, '2023-02-27 11:19:02', 1, 'LOGOUT'),
(5, '2023-02-27 11:19:07', 1, 'LOGIN'),
(6, '2023-02-27 11:19:23', 1, 'LOGOUT'),
(7, '2023-02-27 11:19:28', 1, 'LOGIN'),
(8, '2023-02-27 11:20:51', 1, 'LOGOUT'),
(9, '2023-02-27 11:20:59', 1, 'LOGIN'),
(10, '2023-02-27 15:14:21', 1, 'LOGIN');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `datetime_added` datetime NOT NULL,
  `datetime_modified` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `user_name`, `user_password`, `user_type`, `created_by`, `datetime_added`, `datetime_modified`, `last_login`) VALUES
(1, 'admin11', 'c665f1710dd6a24c9e16fb9ba3d6bf8f', 1, 1, '2023-02-26 17:54:48', '2023-02-26 18:01:27', '2023-02-27 15:14:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id_user_type` int(11) NOT NULL,
  `user_type_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id_user_type`, `user_type_name`) VALUES
(1, 'Super Admin'),
(2, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dtr`
--
ALTER TABLE `dtr`
  ADD PRIMARY KEY (`id_dtr`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id_employee`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`logs_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id_user_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dtr`
--
ALTER TABLE `dtr`
  MODIFY `id_dtr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id_employee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `logs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id_user_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
