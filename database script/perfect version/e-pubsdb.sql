-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 11:49 AM
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
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `cataloguer_id` int(11) DEFAULT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `status` enum('Assigned','In Progress','Completed') DEFAULT 'Assigned',
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `book_id`, `cataloguer_id`, `assigned_by`, `status`, `assigned_at`, `completed_at`) VALUES
(4, 5, 5, NULL, 'Assigned', '2025-01-08 06:51:27', NULL),
(5, 1, 2, NULL, 'Assigned', '2025-01-08 07:48:26', NULL),
(6, 4, 11, NULL, 'Assigned', '2025-01-08 08:45:22', NULL),
(7, 3, 7, NULL, 'Assigned', '2025-01-08 08:48:45', NULL);

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
  `Isbn` text NOT NULL,
  `SetISBN` varchar(20) NOT NULL,
  `PublisherName` varchar(50) NOT NULL,
  `PublisherAddress` varchar(100) NOT NULL,
  `PublicationYear` varchar(100) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `FictionOrNonFiction` varchar(50) NOT NULL,
  `Genre` varchar(100) NOT NULL,
  `PublicationLanguage` varchar(100) NOT NULL,
  `EnglishVersionTitle` varchar(100) NOT NULL,
  `FileUpload` varchar(255) NOT NULL,
  `downloads` int(11) DEFAULT 0,
  `status` enum('Pending','Assigned','Reviewed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_informationsheet`
--

INSERT INTO `book_informationsheet` (`Book_ID`, `PublisherEmail`, `AuthorName`, `AuthorPseudonym`, `EditorName`, `PublicationTitle`, `BookEdition`, `Impression`, `Isbn`, `SetISBN`, `PublisherName`, `PublisherAddress`, `PublicationYear`, `Price`, `FictionOrNonFiction`, `Genre`, `PublicationLanguage`, `EnglishVersionTitle`, `FileUpload`, `downloads`, `status`) VALUES
(1, 'nicholus.mahlangu@nlsa.ac.za', 'Nick', 'Nick', '2341', 'Chronicles of a genuine character', '8th edition', 'Educational', '2147483647', '13 digits', 'Maphota Shiburi', 'Johannes Mogase', '2019', 128, 'Fiction', 'Academical', 'Chronicles of a genuine character', 'Chronicles of a genuine character', '6733218cdd8c3_Contact Information (Responses) - Form responses 1.pdf', 0, 'Assigned'),
(2, 'maphota@nlsa.ac.za', 'dddd', 'dhbhgyhd', 'jjbjbd', 'cc', 'dhhd', 'hdgygd', '2147483647', 'gdftftd', 'Nick', 'Skral', '2017', 111, 'Nonfiction', 'fhghgf', 'hfgyf', 'fvgf', '67629cc956fda_Week four November 2024 Timesheet.pdf', 0, ''),
(3, 'maphota@nlsa.ac.za', 'dddd', 'dhbhgyhd', 'jjbjbd', 'cc', 'dhhd', 'hdgygd', '2147483647', 'gdftftd', 'Nick', 'Skral', '2017', 111, 'Nonfiction', 'fhghgf', 'hfgyf', 'fvgf', '6762a3518c2ac_Week four November 2024 Timesheet.pdf', 0, 'Assigned'),
(4, 'maphota@nlsa.ac.za', 'dddd', 'dhbhgyhd', 'jjbjbd', 'cc', 'dhhd', 'hdgygd', '2147483647', 'gdftftd', 'Nick', 'Skral', '2017', 111, 'Nonfiction', 'fhghgf', 'hfgyf', 'fvgf', '6762cc9b67718_Week four November 2024 Timesheet.pdf', 0, 'Assigned'),
(5, 'Simzo477@gmail.com', 'Maphota', 'David', 'Nicholus', 'NLSA Development', 'limited', 'impressed', '2147483647', 'ISBN set', 'Siemon', 'Pretoria', '2024', 10000, 'Fiction', 'learning', 'English', 'NA', '677d27582df1d_Week Two Dec 2024 Timesheet.pdf', 0, ''),
(6, 'nicholus.mahlangu@nlsa.ac.za', 'Nicholus Mahlangu', 'Nicholus', 'nlsa', 'Genuine Character', '5th edition', 'Educational', '2324678294632', '13 digits', 'Nicholson', 'Johannes Mogase', '2017', 133, 'Fiction', 'Eduucational', 'English', 'NLSA Architecture', '678e27aaec1c3_16th - 20th December 2024-1.pdf', 0, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `type` enum('catalogue','reminder','alert') NOT NULL,
  `date` date DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `cataloguer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `description`, `type`, `date`, `file_path`, `created_at`, `cataloguer_id`) VALUES
(1, 'New Catalogue Assigned', 'A new catalogue has been added for review.', 'catalogue', '2024-11-20', 'catalogues/file1.pdf', '2024-11-28 13:05:04', NULL),
(2, 'Reminder to Update Records', 'Please update your records before the end of the week.', 'reminder', '2024-11-19', NULL, '2024-11-28 13:05:04', NULL),
(3, 'System Alert', 'System maintenance is scheduled for this weekend.', 'alert', '2024-11-18', NULL, '2024-11-28 13:05:04', NULL),
(4, 'Test Notification', 'This is a test.', 'alert', '2024-11-30', NULL, '2024-11-29 07:40:24', NULL);

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
(1, 'Nicholus Mahlangu', 'nicholus.mahlangu@nlsa.ac.za', '0711218836', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 'simon', 'Sie@gmail.com', '0699609675', '5f4dcc3b5aa765d61d8327deb882cf99'),
(3, 'Simon', 'Sie@nlsa.ac.za', '0699609675', '5f4dcc3b5aa765d61d8327deb882cf99'),
(4, 'Simon', 'Sie@nlsa.ac.za', '0699609675', '5f4dcc3b5aa765d61d8327deb882cf99'),
(5, 'sie', 'Siemon@gmail.com', 'Sie@gmail.', '5f4dcc3b5aa765d61d8327deb882cf99'),
(6, 'simon', 'Simon@gmail.com', 'Sie@gmail.', '5f4dcc3b5aa765d61d8327deb882cf99'),
(7, 'www', 'Siemzo@gmail.com', '0699609675', '$2y$10$BVdhuHtQgzfy5ltsfDxvA.qTkmNSy4ecGY4Fow.OeO9QsJvVAaDIW'),
(8, 'Simon Shiburi', 'shiburisimon2@gmail.com', '09990909', '$2y$10$Jyoc.cSTZ1HVCOc8mNig8ujMKup62R3eQxgK2CHE05IKt9kf6973S'),
(9, 'Maphota', 'Siem@gmail.com', '0699609675', '$2y$10$3zEfDVLriWS6G3CISBpdXOEmD866x5zfv5aqPzmPEb0/FU1kfeGrS'),
(10, 'Maphota', 'maphota.shiburi@nlsa.ac.za', '099909', '5f4dcc3b5aa765d61d8327deb882cf99'),
(11, 'Keletso Mmulutsi', 'keletso@nlsa.ac.za', '0763452617', '5f4dcc3b5aa765d61d8327deb882cf99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookk_id` (`book_id`),
  ADD KEY `cataloguer_id` (`cataloguer_id`),
  ADD KEY `assigned_by` (`assigned_by`);

--
-- Indexes for table `book_informationsheet`
--
ALTER TABLE `book_informationsheet`
  ADD PRIMARY KEY (`Book_ID`),
  ADD KEY `idx_book_id` (`Book_ID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cataloguer_id` (`cataloguer_id`);

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
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `book_informationsheet`
--
ALTER TABLE `book_informationsheet`
  MODIFY `Book_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book_informationsheet` (`Book_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`cataloguer_id`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignments_ibfk_3` FOREIGN KEY (`assigned_by`) REFERENCES `admin` (`Admin_ID`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`cataloguer_id`) REFERENCES `users` (`User_ID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
