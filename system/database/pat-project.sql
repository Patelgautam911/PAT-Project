-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2019 at 03:03 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pat-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `C_ID` int(11) NOT NULL,
  `Sc_ID` int(11) NOT NULL,
  `C_Class_Name` varchar(255) NOT NULL,
  `C_Teacher` varchar(255) NOT NULL,
  `Created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`C_ID`, `Sc_ID`, `C_Class_Name`, `C_Teacher`, `Created_date`) VALUES
(1, 4, 'Class B', '', '2019-11-06 12:21:44'),
(2, 5, 'Class B', '', '2019-11-06 11:14:45'),
(3, 1, 'Class A', '', '2019-11-06 11:18:07'),
(5, 2, 'Class A', '', '2019-11-06 11:18:19'),
(6, 1, 'Class B', '', '2019-11-06 12:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('1','2','3','4') NOT NULL COMMENT '1 for Admin,2 for Teacher,3 for Student,4 for Parent',
  `Created_date` datetime NOT NULL,
  `Last_login` datetime NOT NULL,
  `Ip_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `Username`, `Email`, `Password`, `Role`, `Created_date`, `Last_login`, `Ip_address`) VALUES
(1, 'Admin', 'admin@admin.com', 'e6e061838856bf47e1de730719fb2609', '1', '2019-11-05 00:00:00', '2019-11-11 13:34:45', '::1'),
(2, 'Gautam', 'sahdJ@gmail.com', '7475a482b21874492ac7a06fb30bc225', '3', '2019-11-05 13:51:02', '0000-00-00 00:00:00', NULL),
(11, 'Gautam', 'gautam@gmail.com', '5abd4b78584cdbf1ae49bdc4d39fc808', '2', '2019-11-10 12:05:35', '2019-11-11 12:50:56', '::1'),
(12, 'Test', 'ttestet@gmail.com', '5a2b27afb438193d99817cc61eaca7e6', '2', '2019-11-10 12:06:01', '0000-00-00 00:00:00', NULL),
(14, 'Testtttt', 'ttsatdeasds@gmali.com', '76c6852b686d31e61921df87507e854e', '4', '2019-11-11 07:19:54', '0000-00-00 00:00:00', NULL),
(15, 'Gautam', 'gautam911@gmail.com', 'd640b320f29997f92afd21b3961673a5', '3', '2019-11-11 08:00:53', '0000-00-00 00:00:00', NULL),
(16, 'Test', 'sdfsfs@gmail.com', '2218593716add0b0585537c1539dacab', '3', '2019-11-11 08:02:17', '2019-11-11 12:54:59', '::1'),
(17, 'findlay', 'findlay.fynnigan@iiron.us', 'dfd8eb00bfb38391ccf2877e4caa1787', '4', '2019-11-11 08:19:01', '0000-00-00 00:00:00', NULL),
(18, 'aerion', 'aerion.rigley@iiron.us', '63802f04b2461f42199d3ad50b57578e', '4', '2019-11-11 08:19:14', '2019-11-11 12:55:22', '::1'),
(19, 'Ives', 'ives.dairon@iiron.us', '73c782d8dcc70fb693c3f77c74880d9d', '4', '2019-11-11 08:19:29', '0000-00-00 00:00:00', NULL),
(20, 'Manan', 'manan.tanish@iiron.us', 'e5fdd48b6f8f324a746e41fffd4c68bd', '3', '2019-11-11 08:20:12', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `P_ID` int(11) NOT NULL,
  `P_Name` varchar(100) NOT NULL,
  `P_Email` varchar(150) NOT NULL,
  `P_Created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`P_ID`, `P_Name`, `P_Email`, `P_Created_date`) VALUES
(2, 'Testttttsd', 'ttsatdeasds@gmali.com', '2019-11-11 07:19:54'),
(3, 'findlay', 'findlay.fynnigan@iiron.us', '2019-11-11 08:19:01'),
(4, 'aerion', 'aerion.rigley@iiron.us', '2019-11-11 08:19:14'),
(5, 'Ives', 'ives.dairon@iiron.us', '2019-11-11 08:19:29');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `Sc_ID` int(11) NOT NULL,
  `Sc_Name` varchar(255) NOT NULL,
  `Created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`Sc_ID`, `Sc_Name`, `Created_date`) VALUES
(1, 'Bhagwati School', '2019-11-06 10:10:07'),
(2, 'St.Mary School', '2019-11-06 00:00:00'),
(3, 'Best High School', '2019-11-06 10:09:41'),
(4, 'Kameshwar Education Campus', '2019-11-06 10:09:56'),
(5, 'St. Anns School', '2019-11-06 10:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `S_ID` int(11) NOT NULL,
  `S_P_ID` int(11) NOT NULL,
  `S_Name` varchar(100) NOT NULL,
  `S_Email` varchar(150) NOT NULL,
  `S_Surname` varchar(100) NOT NULL,
  `S_Username` varchar(100) NOT NULL,
  `S_Device_ID` varchar(255) NOT NULL,
  `S_School` varchar(100) NOT NULL,
  `S_Class` varchar(100) NOT NULL,
  `S_Image` varchar(255) DEFAULT NULL,
  `Created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`S_ID`, `S_P_ID`, `S_Name`, `S_Email`, `S_Surname`, `S_Username`, `S_Device_ID`, `S_School`, `S_Class`, `S_Image`, `Created_date`) VALUES
(6, 0, 'Gautam', 'gautam@gmail.com', 'Patel', 'Gautam', '101', '1', '6', NULL, '2019-11-06 12:02:56'),
(7, 1, 'Gautam', 'gautam911@gmail.com', 'Barvaliya', 'Gautam', '105', '1', '3', NULL, '2019-11-11 08:00:53'),
(8, 2, 'Test', 'sdfsfs@gmail.com', 'resr', 'Test', '1015', '1', '6', NULL, '2019-11-11 08:02:17'),
(9, 3, 'Manan', 'manan.tanish@iiron.us', 'Tanish', 'Manan', '10', '5', '2', NULL, '2019-11-11 08:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `T_ID` int(11) NOT NULL,
  `T_Name` varchar(100) NOT NULL,
  `T_Username` varchar(100) NOT NULL,
  `T_Surname` varchar(100) NOT NULL,
  `T_Email` varchar(150) NOT NULL,
  `T_School` varchar(150) NOT NULL,
  `T_Class` varchar(255) DEFAULT NULL,
  `T_Image` varchar(255) DEFAULT NULL,
  `T_Created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`T_ID`, `T_Name`, `T_Username`, `T_Surname`, `T_Email`, `T_School`, `T_Class`, `T_Image`, `T_Created_date`) VALUES
(1, 'Gautam', 'Gautam', 'Patel', 'gautam@gmail.com', '1', NULL, NULL, '2019-11-10 12:05:35'),
(2, 'Test', 'Test', 'tedstet', 'ttestet@gmail.com', '4', NULL, NULL, '2019-11-10 12:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_class`
--

CREATE TABLE `teacher_class` (
  `TC_ID` int(11) NOT NULL,
  `T_ID` int(11) NOT NULL,
  `CT_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_class`
--

INSERT INTO `teacher_class` (`TC_ID`, `T_ID`, `CT_ID`) VALUES
(4, 2, 1),
(5, 1, 3),
(6, 1, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`C_ID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`P_ID`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`Sc_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`S_ID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`T_ID`);

--
-- Indexes for table `teacher_class`
--
ALTER TABLE `teacher_class`
  ADD PRIMARY KEY (`TC_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `P_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `Sc_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `S_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `T_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher_class`
--
ALTER TABLE `teacher_class`
  MODIFY `TC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
