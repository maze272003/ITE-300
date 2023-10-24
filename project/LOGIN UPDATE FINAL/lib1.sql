-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2023 at 12:34 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lib1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookborrow`
--

CREATE TABLE `bookborrow` (
  `Id` int(11) NOT NULL,
  `bookId` int(11) NOT NULL,
  `borrowFrom` datetime NOT NULL,
  `borrowTo` datetime NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookborrow`
--

INSERT INTO `bookborrow` (`Id`, `bookId`, `borrowFrom`, `borrowTo`, `userId`) VALUES
(2, 1, '2023-10-24 17:35:00', '2023-10-25 17:35:00', 1),
(3, 1, '2023-10-24 17:35:00', '2023-10-25 17:35:00', 1),
(4, 1, '2023-10-24 17:35:00', '2023-10-25 17:35:00', 1),
(5, 1, '2023-10-24 17:35:00', '2023-10-25 17:35:00', 1),
(6, 1, '2023-10-27 18:03:00', '2023-10-30 18:03:00', 0),
(7, 4, '2023-11-10 18:04:00', '2023-11-09 18:04:00', 0),
(8, 4, '2023-11-10 18:04:00', '2023-11-09 18:04:00', 0),
(9, 4, '2023-11-10 18:04:00', '2023-11-09 18:04:00', 0),
(10, 1, '2023-10-25 18:06:00', '2023-10-27 18:06:00', 3),
(11, 4, '2023-10-24 18:17:00', '2023-10-26 22:00:00', 3),
(12, 3, '2023-10-25 18:27:00', '2023-10-25 18:27:00', 3),
(13, 4, '2023-10-23 18:27:00', '2023-10-26 18:27:00', 3),
(14, 4, '2023-10-23 18:27:00', '2023-10-26 18:27:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `Id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Category_Id` int(11) NOT NULL,
  `Publisher_Id` int(11) NOT NULL,
  `Availablilty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`Id`, `Title`, `Description`, `Category_Id`, `Publisher_Id`, `Availablilty`) VALUES
(1, 'Mathematics I', 'Mathematics I', 1, 1, 0),
(3, 'Science I ', 'Science I ', 2, 2, 0),
(4, 'Rocket', 'The Rocket', 4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE `borrower` (
  `Id` int(11) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Contact_Number` varchar(250) NOT NULL,
  `Status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Id` int(11) NOT NULL,
  `Name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Id`, `Name`) VALUES
(1, 'Math'),
(2, 'Science'),
(4, 'Rocket');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(10) NOT NULL,
  `role` text NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `role`, `Username`, `Password`) VALUES
(1, 'admin', 'vincent', '123123'),
(3, 'student', 'jm', '2003');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `Id` int(11) NOT NULL,
  `Name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`Id`, `Name`) VALUES
(1, 'David Hilbert'),
(2, 'Elon Musk'),
(4, 'Rocket');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookborrow`
--
ALTER TABLE `bookborrow`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `borrower`
--
ALTER TABLE `borrower`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookborrow`
--
ALTER TABLE `bookborrow`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `borrower`
--
ALTER TABLE `borrower`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
