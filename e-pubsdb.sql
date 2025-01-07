-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 07:09 AM
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
-- Database: `e-pubsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `Contact` varchar(10) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `username`, `Contact`, `Password`) VALUES
(1, 'admin@nlsa.ac.za', '0711218836', 'admin'),
(2, 'admin1@nlsa.ac.za', '0711218836', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `book_informationsheet`
--

CREATE TABLE `book_informationsheet` (
  `Book_ID` int(100) NOT NULL,
  `PublisherEmail` varchar(100) NOT NULL,
  `AuthorName` varchar(100) NOT NULL,
  `AuthorPseudonym` varchar(100) NOT NULL,
  `EditorName` varchar(100) NOT NULL,
  `PublicationTitle` varchar(100) NOT NULL,
  `BookEdition` varchar(100) NOT NULL,
  `Impression` varchar(100) NOT NULL,
  `Isbn` int(13) NOT NULL,
  `SetISBN` varchar(20) NOT NULL,
  `PublisherName` varchar(50) NOT NULL,
  `PublisherAddress` varchar(100) NOT NULL,
  `PublicationYear` varchar(100) NOT NULL,
  `Price` double NOT NULL,
  `FictionOrNonFiction` varchar(50) NOT NULL,
  `Genre` varchar(100) NOT NULL,
  `PublicationLanguage` varchar(100) NOT NULL,
  `EnglishVersionTitle` varchar(100) NOT NULL,
  `FileUpload` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_informationsheet`
--

INSERT INTO `book_informationsheet` (`Book_ID`, `PublisherEmail`, `AuthorName`, `AuthorPseudonym`, `EditorName`, `PublicationTitle`, `BookEdition`, `Impression`, `Isbn`, `SetISBN`, `PublisherName`, `PublisherAddress`, `PublicationYear`, `Price`, `FictionOrNonFiction`, `Genre`, `PublicationLanguage`, `EnglishVersionTitle`, `FileUpload`) VALUES
(1, 'nicholus@nlsa.ac.za', 'Nicholus ', 'Nick updated', 'Williams', 'The new age', '1st Edition', 'Nick ', 2147483647, '542', 'Maphota Shiburi', 'Johannes Mogase', '2017', 178.9, 'Fiction', 'Academical', 'Chronicles of a genuine character', 'Chronicles of a genuine character updated', '6733218cdd8c3_Contact Information (Responses) - Form responses 1.pdf'),
(2, 'nicolasmahlangu75@gmail.com', 'Maphota Shiburi', 'Nicholus', '23yu', 'Genuine Character', '5th', 'Growth and development', 2147483647, '13 digits', 'Nick Williams', '123 Aubrey Matlala', '2016', 79.78, 'Fiction', 'Wisdom', 'English', 'Character', '673dcd176da46_30th September - 4th October 2024 Weekly Timesheet.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `EmailAddress` varchar(100) NOT NULL,
  `Contact` varchar(10) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `FullName`, `EmailAddress`, `Contact`, `Password`) VALUES
(1, 'Nicholus Mahlangu', 'nicholus.mahlangu@nlsa.ac.za', '0711218836', '5f4dcc3b5aa765d61d8327deb882cf99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `book_informationsheet`
--
ALTER TABLE `book_informationsheet`
  ADD PRIMARY KEY (`Book_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book_informationsheet`
--
ALTER TABLE `book_informationsheet`
  MODIFY `Book_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
