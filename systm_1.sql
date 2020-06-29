-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2020 at 05:12 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `systm_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_year`
--

CREATE TABLE `academic_year` (
  `aca_id` int(11) NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academic_year`
--

INSERT INTO `academic_year` (`aca_id`, `academic_year`, `value`) VALUES
(1, '2020-2021', 0),
(2, '2021-2022', 0),
(3, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_desc` longtext NOT NULL,
  `dept_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_desc`, `dept_id`, `value`) VALUES
(1, 'Bsc.CSIT', 'Bachelor in science, computer science and Information Technology', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `department_desc` longtext NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `department_name`, `department_desc`, `value`) VALUES
(2, 'Science And Technology', '    Science And Technology                    ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news_table`
--

CREATE TABLE `news_table` (
  `news_id` int(11) NOT NULL,
  `title` longtext NOT NULL,
  `content` longtext NOT NULL,
  `semester` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `file` varchar(255) DEFAULT NULL,
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news_table`
--

INSERT INTO `news_table` (`news_id`, `title`, `content`, `semester`, `date`, `file`, `value`) VALUES
(1, 'This is the first news for Third Sem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br /><br />\r\n                         tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br /><br />\r\n                         quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br /><br />\r\n                         consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br /><br />\r\n                         cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br /><br />\r\n                         proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '5th Semester', '2020-06-17 05:38:49', 'best.jpg', 1),
(2, 'Welcome to Prithvi Narayan Campus', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br /><br />\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br /><br />\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br /><br />\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br /><br />\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br /><br />\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br /><br />\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br /><br />\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br /><br />\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br /><br />\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br /><br />\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br /><br />\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br /><br />\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br /><br />\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br /><br />\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br /><br />\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br /><br />\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br /><br />\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br /><br />\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br /><br />\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2nd Semester', '2020-06-17 05:39:26', '20190202_174719.jpg', 1),
(3, 'test strln', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonproident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '4th Semester', '2020-06-15 08:50:02', 'campervan-the-great-ocean-road-australia-melbourne-backpacker.jpg', 1),
(4, 'उखु किसानको जमिन प्रमाणीकरण गरिदिन आठ जिल्लाका स्थानीय तहलाई पत्राचार', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonproident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonproident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonproident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonproident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonproident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '3rd Semester', '2020-06-16 11:26:50', 'thor-2-the-dark-world-wallpaper.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notice_table`
--

CREATE TABLE `notice_table` (
  `notice_id` int(11) NOT NULL,
  `title` longtext NOT NULL,
  `content` longtext NOT NULL,
  `semester` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `file` varchar(255) DEFAULT NULL,
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice_table`
--

INSERT INTO `notice_table` (`notice_id`, `title`, `content`, `semester`, `date`, `file`, `value`) VALUES
(1, 'This is the first Notice for Third Sem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />\r\n    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />\r\n    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />\r\n    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />\r\n    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />\r\n    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '3rd Semester', '2020-06-09 05:13:08', 'Robert T. Kiyosaki, Sharon L. Lechter - Rich Dad, Poor Dad_ What the Rich Teach Their Kids About Money--That the Poor and Middle Class Do Not!-Business Plus (2000).pdf', 1),
(2, 'Welcome to my student Management System', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />\r\n    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />\r\n    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />\r\n    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />\r\n    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />\r\n    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '3rd Semester', '2020-06-09 05:16:25', 'Richard J. Connors - Warren Buffett on Business_ Principles from the Sage of Omaha-John Wiley and Sons (2009).pdf', 1),
(3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonproident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonproident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '3rd Semester', '2020-06-15 09:15:27', 'abc.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `sem_id` int(11) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `subjects` int(11) NOT NULL,
  `students` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`sem_id`, `semester`, `subjects`, `students`, `value`) VALUES
(1, '1st Semester', 5, 35, 1),
(2, '2nd Semester', 5, 36, 1),
(3, '3rd Semester', 5, 30, 1),
(4, '4th Semester', 5, 27, 1),
(5, '5th Semester', 6, 20, 1),
(6, '6th Semester', 7, 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff_details`
--

CREATE TABLE `staff_details` (
  `staff_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(40) NOT NULL,
  `paddress` varchar(255) NOT NULL,
  `sex` varchar(45) NOT NULL,
  `dob` date NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `nationality` varchar(45) NOT NULL,
  `religion` varchar(44) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `staff_role` varchar(255) NOT NULL,
  `maritalstatus` varchar(40) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_details`
--

INSERT INTO `staff_details` (`staff_id`, `firstname`, `lastname`, `middlename`, `paddress`, `sex`, `dob`, `birthplace`, `nationality`, `religion`, `contact`, `staff_role`, `maritalstatus`, `subject`, `file`, `email`, `value`) VALUES
(1, 'shankar', 'Lamichhane', '', 'Syangja, Gandaki Pradesh Nepal', 'Male', '2001-03-17', 'Syangja, Nepal', 'Nepali', 'Hindu', '9815153866', 'Teacher', 'Single', 'Bsc.CSIT', 'me.jpg', 'shankarlmc012@gmail.com', 1),
(5, 'test', 'test', 'etst', 'tettt', 'Male', '2001-03-17', 'test', 'test', 'tetst', 'tetes', 'Administration', 'Single', 'tets', '3d.jpg', 'test@gmail.com', 1),
(6, 'test', 'test', 'etst', 'tettt', 'Male', '2001-03-17', 'test', 'test', 'tetst', 'tetes', 'Administration', 'Single', 'tets', '3d.jpg', 'test@gmail.com', 1),
(7, 'test', 'test', 'etst', 'tettt', 'Male', '2001-03-17', 'test', 'test', 'tetst', 'tetes', 'Administration', 'Single', 'tets', '3d.jpg', 'test@gmail.com', 1),
(8, 'teste', 'test', 'test', 'test', 'Female', '2001-03-17', 'test', 'teste', 'test', 'test', 'Teacher', 'Single', 'test', 'best.jpg', 'pathakagya07@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_acc`
--

CREATE TABLE `student_acc` (
  `student_id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_acc`
--

INSERT INTO `student_acc` (`student_id`, `unique_id`, `username`, `email`, `password`, `value`) VALUES
(1, 2144987720, 'Shankar', 'shankarlmc012@gmail.com', '$2y$10$50zz.mtx95oUj8zuqcbj4eSJRoEsqsnDI0eaNSRcwWkt6UB2GBiwm', 1),
(4, 1433022285, 'Agya', 'pathakagya07@gmail.com', '$2y$10$RgbsVZEukmaFecRO7CtQx.LBchwGLIo18E7n.dtuOvVduK3sLamoG', 1),
(5, 594475442, 'Sunil', 'test@gmail.com', '$2y$10$GwEnIiBpVIVlXGJOxEuB4ukXTAySxB7VILNJpAJzA994qKC7L7THm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `s_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(40) NOT NULL,
  `paddress` varchar(255) NOT NULL,
  `sex` varchar(45) NOT NULL,
  `dob` date NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `nationality` varchar(45) NOT NULL,
  `religion` varchar(44) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `maritalstatus` varchar(40) NOT NULL,
  `course_id` int(11) NOT NULL,
  `guardian_name` varchar(255) NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`s_id`, `student_id`, `email`, `semester`, `firstname`, `lastname`, `middlename`, `paddress`, `sex`, `dob`, `birthplace`, `nationality`, `religion`, `contact`, `maritalstatus`, `course_id`, `guardian_name`, `academic_year`, `value`) VALUES
(1, 1433022285, 'pathakagya07@gmail.com', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', 0, '', '', 0),
(2, 594475442, 'test@gmail.com', '1st Semester', 'Sunil', 'Chamling', '', 'Pokhara, Zero', 'Male', '1998-05-25', 'Pokhara, parsyang', 'Nepali', 'Hindu', '9815263588', 'Single', 1, 'test', '2020-2021', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` int(11) NOT NULL,
  `sub_code` varchar(30) NOT NULL,
  `sub_desc` varchar(255) NOT NULL,
  `unit` int(2) NOT NULL,
  `pre_requisite` varchar(30) NOT NULL DEFAULT 'None',
  `course_id` int(11) NOT NULL,
  `yearlevel` varchar(90) NOT NULL,
  `academic_year` varchar(90) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_acc`
--

CREATE TABLE `teacher_acc` (
  `staff_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_acc`
--

INSERT INTO `teacher_acc` (`staff_id`, `username`, `email`, `password`, `value`) VALUES
(1, 'Shankar', 'shankarlmc012@gmail.com', '$2y$10$XoLOW22PCJ.meLdKFJZrD.oF0N48GS3K8KR0421EqwMCiICfiJ0Uy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `acc_type` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`user_id`, `fname`, `lname`, `email`, `password`, `acc_type`, `value`) VALUES
(1, 'Shankar', 'lamichhane', 'shankarlmc012@gmail.com', '$2y$10$MwS.jwdEm4/xqfc51.SxnOH9iD4ZVRqfF2KuZBr7GaXtN0eY3CBna', 'Student', 1);

-- --------------------------------------------------------

--
-- Table structure for table `year_level`
--

CREATE TABLE `year_level` (
  `year_id` int(11) NOT NULL,
  `yearlevel` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `year_level`
--

INSERT INTO `year_level` (`year_id`, `yearlevel`, `value`) VALUES
(1, '1st Year', 1),
(2, '2nd Year', 1),
(3, '3rd Year', 1),
(4, '4th Year', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_year`
--
ALTER TABLE `academic_year`
  ADD PRIMARY KEY (`aca_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `news_table`
--
ALTER TABLE `news_table`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `notice_table`
--
ALTER TABLE `notice_table`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`sem_id`);

--
-- Indexes for table `staff_details`
--
ALTER TABLE `staff_details`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `student_acc`
--
ALTER TABLE `student_acc`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`s_id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD KEY `student_id_2` (`student_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `teacher_acc`
--
ALTER TABLE `teacher_acc`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `year_level`
--
ALTER TABLE `year_level`
  ADD PRIMARY KEY (`year_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_year`
--
ALTER TABLE `academic_year`
  MODIFY `aca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news_table`
--
ALTER TABLE `news_table`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notice_table`
--
ALTER TABLE `notice_table`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `sem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff_details`
--
ALTER TABLE `staff_details`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_acc`
--
ALTER TABLE `student_acc`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_acc`
--
ALTER TABLE `teacher_acc`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `year_level`
--
ALTER TABLE `year_level`
  MODIFY `year_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
