-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 11:47 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `person_id`, `email`, `password`) VALUES
(4, 1, 'admin.ali@company.com', 'rji8934tijegd');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `name` varchar(225) NOT NULL,
  `location` varchar(225) NOT NULL,
  `emps_number` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `manager_id`, `name`, `location`, `emps_number`) VALUES
(103, 2, 'Sales', 'Aswan', 1),
(104, 4, 'Development', 'Alex', 1),
(105, 5, 'Transport', 'Cairo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `logi_id` int(14) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `person_id`, `department_id`, `logi_id`, `password`) VALUES
(26, 114, 103, 2000, '$2y$10$CMr.p/tcPBAZqMHCpskCm.rvf7dSv4DCVwypOcO9z6B8akHaAfb/W'),
(27, 115, 104, 2001, '$2y$10$o5hBUaGLQk/r3zFTTziKrOQbuGqhI1wuBwokaTBu3NPuImr97ysHC'),
(29, 117, 105, 2005, '$2y$10$1SnkvxEXEfezYIOGLtfz3OV.La4/EHAtEaGnoDCD6lH.2Yk0Hwl.u');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `manager_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`manager_id`, `person_id`, `email`, `password`) VALUES
(2, 10, 'Sales.manager.gamil@company.com', '943thewnm,[k'),
(4, 112, 'development.new@company.com', '$2y$10$mWlz7kRmm8teiPi6Sr/7YeFojUHmCyoDvEx1UHYlhi0r/h8r7z7Ge'),
(5, 113, 'transport.manager@company.com', '$2y$10$Tkbii1Bs.J27VxHTHlooSunS.Ql0gYVnlpVm6KgdVnvE2nZtyNpNq');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `person_id` int(11) NOT NULL,
  `first_name` varchar(225) NOT NULL,
  `last_name` varchar(225) NOT NULL,
  `age` int(10) NOT NULL,
  `address` varchar(225) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `absent_times` int(10) DEFAULT NULL,
  `salary` decimal(20,0) NOT NULL,
  `job_title` varchar(225) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `role` enum('admin','employee','manager') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `first_name`, `last_name`, `age`, `address`, `phone_number`, `date_of_birth`, `absent_times`, `salary`, `job_title`, `gender`, `role`) VALUES
(1, 'Ali', 'Alaa', 40, 'Cairo', '5997403940', '1986-01-01', 3, '30000', 'root', 'male', 'admin'),
(10, 'Gamil', 'Salem', 29, 'Menoufia', '82467230903', '1995-02-04', 0, '200099', 'Directorrr', 'male', 'manager'),
(111, 'New', 'Employee', 25, 'New cairo', '39460820-', '2000-01-01', NULL, '10000', 'Software Developer', 'male', 'employee'),
(112, 'New', 'Manager', 25, 'Alexandria', '39460820-', '2000-02-03', NULL, '10000', 'Excutive director', 'male', 'manager'),
(113, 'Manager', '3rd', 25, 'Qena', '438082-0', '2002-02-02', NULL, '10000', 'Director', 'female', 'manager'),
(114, 'Alia', 'Qasem', 25, 'Menoufia', '39846028', '2000-01-01', NULL, '10000', 'Accountant', 'female', 'employee'),
(115, 'Ahmed', 'Allam', 25, 'Suez', '374082-342', '2000-02-02', NULL, '10000', 'Software Developer', 'male', 'employee'),
(117, 'New', 'Employee', 25, 'Aswan', '39460820-', '2000-02-02', NULL, '10000', 'Software Developer', 'male', 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vacations`
--

CREATE TABLE `vacations` (
  `vacation_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `causes` varchar(50) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `department_ibfk_1` (`manager_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `employee_ibfk_1` (`department_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`manager_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `tasks_ibfk_1` (`employee_id`);

--
-- Indexes for table `vacations`
--
ALTER TABLE `vacations`
  ADD PRIMARY KEY (`vacation_id`),
  ADD KEY `vacations_ibfk_1` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vacations`
--
ALTER TABLE `vacations`
  MODIFY `vacation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE SET NULL;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE;

--
-- Constraints for table `vacations`
--
ALTER TABLE `vacations`
  ADD CONSTRAINT `vacations_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
