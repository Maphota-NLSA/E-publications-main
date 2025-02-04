-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2025 at 08:26 AM
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
  `status` enum('Reviewed','Pending','Assigned') NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `book_id`, `cataloguer_id`, `assigned_by`, `status`, `assigned_at`, `completed_at`) VALUES
(4, 5, 5, NULL, 'Reviewed', '2025-01-08 06:51:27', NULL),
(5, 1, 2, NULL, 'Assigned', '2025-01-08 07:48:26', NULL),
(6, 4, 11, NULL, 'Assigned', '2025-01-08 08:45:22', NULL),
(7, 3, 7, NULL, 'Reviewed', '2025-01-08 08:48:45', NULL),
(8, 2, 12, NULL, 'Assigned', '2025-01-15 11:15:49', NULL),
(9, 1, 2, NULL, 'Assigned', '2025-01-16 09:02:24', NULL),
(11, 6, 13, NULL, 'Assigned', '2025-01-17 12:50:07', NULL),
(12, 7, 13, NULL, 'Assigned', '2025-01-17 13:17:41', NULL),
(13, 11, 13, NULL, 'Assigned', '2025-01-20 12:31:35', NULL),
(14, 10, 13, NULL, 'Assigned', '2025-01-20 13:37:17', NULL);

--
-- Triggers `assignments`
--
DELIMITER $$
CREATE TRIGGER `after_assignments_delete` AFTER DELETE ON `assignments` FOR EACH ROW BEGIN
    -- Reset the book_informationsheet status
    UPDATE book_informationsheet
    SET status = 'Unassigned'
    WHERE Book_ID = OLD.book_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_assignments_insert` AFTER INSERT ON `assignments` FOR EACH ROW BEGIN
    -- Update the book_informationsheet table
    UPDATE book_informationsheet
    SET status = 'Assigned'
    WHERE Book_ID = NEW.book_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_assignments_update` AFTER UPDATE ON `assignments` FOR EACH ROW BEGIN
    -- Update the book_informationsheet status
    IF NEW.status IN ('Assigned', 'In Progress', 'Completed') THEN
        UPDATE book_informationsheet
        SET status = NEW.status
        WHERE Book_ID = NEW.book_id;
    END IF;

    -- Set completed_at timestamp if status is 'Completed'
    IF NEW.status = 'Completed' AND OLD.status != 'Completed' THEN
        UPDATE Assignments
        SET completed_at = NOW()
        WHERE id = NEW.id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `bookName` varchar(255) NOT NULL,
  `authorFullName` varchar(255) NOT NULL,
  `authorAddress` text NOT NULL,
  `authorContact` varchar(15) NOT NULL,
  `authorEmail` varchar(255) NOT NULL,
  `publisherName` varchar(255) NOT NULL,
  `publisherAddress` text NOT NULL,
  `publisherContact` varchar(15) NOT NULL,
  `publisherEmail` varchar(255) NOT NULL,
  `format` enum('Print','Electronic','Both') NOT NULL,
  `publicationDate` date NOT NULL,
  `openAccess` enum('Yes','No') NOT NULL,
  `isbnRegistered` enum('Author') NOT NULL,
  `externalPlatforms` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `bookName`, `authorFullName`, `authorAddress`, `authorContact`, `authorEmail`, `publisherName`, `publisherAddress`, `publisherContact`, `publisherEmail`, `format`, `publicationDate`, `openAccess`, `isbnRegistered`, `externalPlatforms`, `created_at`) VALUES
(1, 'h', 'Davis', 'Skral', '1111111111', '$2y$10$UlE29zXf4MiGdiphmctGk.xtAn4fh0rB/vlpJDK3mz3tDlFqB8Xza', 'd', 'd', '1111111111', '$2y$10$EaNHPTwdsxUK2McAC3rG4.psoSZOg6bbZ9IgJCSIFLIqHM9f/3rC.', '', '0000-00-00', 'Yes', '', 'Amazon', '2025-01-15 10:24:01');

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
(1, 'nicholus.mahlangu@nlsa.ac.za', 'Nick', 'Nick', '2341', 'Chronicles of a genuine character', '8th edition', 'Educational', '2147483647', '13 digits', 'Maphota Shiburi', 'Johannes Mogase', '2019', 128, 'Fiction', 'Academical', 'Chronicles of a genuine character', 'Chronicles of a genuine character', '6733218cdd8c3_Contact Information (Responses) - Form responses 1.pdf', 6, 'Assigned'),
(2, 'maphota@nlsa.ac.za', 'dddd', 'dhbhgyhd', 'jjbjbd', 'cc', 'dhhd', 'hdgygd', '2147483647', 'gdftftd', 'Nick', 'Skral', '2017', 111, 'Nonfiction', 'fhghgf', 'hfgyf', 'fvgf', '67629cc956fda_Week four November 2024 Timesheet.pdf', 0, 'Reviewed'),
(3, 'maphota@nlsa.ac.za', 'dddd', 'dhbhgyhd', 'jjbjbd', 'cc', 'dhhd', 'hdgygd', '2147483647', 'gdftftd', 'Nick', 'Skral', '2017', 111, 'Nonfiction', 'fhghgf', 'hfgyf', 'fvgf', '6762a3518c2ac_Week four November 2024 Timesheet.pdf', 0, 'Reviewed'),
(4, 'maphota@nlsa.ac.za', 'dddd', 'dhbhgyhd', 'jjbjbd', 'cc', 'dhhd', 'hdgygd', '2147483647', 'gdftftd', 'Nick', 'Skral', '2017', 111, 'Nonfiction', 'fhghgf', 'hfgyf', 'fvgf', '6762cc9b67718_Week four November 2024 Timesheet.pdf', 0, 'Reviewed'),
(5, 'Simzo477@gmail.com', 'Maphota', 'David', 'Nicholus', 'NLSA Development', 'limited', 'impressed', '2147483647', 'ISBN set', 'Siemon', 'Pretoria', '2024', 10000, 'Fiction', 'learning', 'English', 'NA', '677d27582df1d_Week Two Dec 2024 Timesheet.pdf', 2, 'Pending'),
(6, 'Jr@gmail.com', 'jr', 'sante', 'rj', 'enock', 'limited', 'expressed', '2147483647', 'ISBN set', 'Siemon', 'Pretoria', '2024', 100000, 'Fiction', 'learning', 'English', 'Not applicable', '678a508996adc_Jan 2025 Timesheet.pdf', 0, 'Reviewed'),
(7, 'johncena@NLSA.ac.za', 'john', 'Sie', 'cena', 'wrestling', 'brock', 'impressed', '2147483647', 'set', 'john wick', 'Pretoria', '2025', 400000, 'Nonfiction', 'learning', 'English', 'applicable', '678a583ec96a6_Week one Dec 2024 Timesheet.pdf', 1, 'Reviewed'),
(8, 'NLSA@nlsa.a.za', 'NLSA', 'Siemon', 'wick', 'coder', 'brocker', 'impressed', '2147483647', 'set', 'john wick', 'Pretoria', '2025', 400000, 'Nonfiction', 'learning', 'English', 'applicable', '678e17d56b573_Week Three Dec 2024 Timesheet.pdf', 0, 'Pending'),
(9, 'Library@nlsa.a.za', 'NLSA', 'Siemon', 'wick', 'coder', 'brocker', 'impressed', '2147483647', 'set', 'john wick', 'Pretoria', '2025', 100000, 'Fiction', 'learning', 'English', 'Applicable', '678e1e201f4f6_Jan 2025 Timesheet.pdf', 0, 'Pending'),
(10, 'Libraryloop@nlsa.a.za', 'dddd', 'sante', 'jjbjbd', 'NLSA Development', 'brocker', 'impressed', '2147483647', 'set', 'john wick', 'Sosha', '2025', 100000, 'Nonfiction', 'learning', 'English', 'Not applicable', '678e313a5809d_Jan 2025 Timesheet.pdf', 1, 'Assigned'),
(11, 'Tintswalo@nlsa.ac.za', 'Asante', 'santeSana', 'jjbjbd', 'NLSA Development', 'brocker', 'impressed', '1010101010101', 'set', 'john wick', 'Sosha', '2025', 1000000, 'Nonfiction', 'learning', 'English', 'Not applicable', '678e322307b43_Week two November 2024 Timesheet.pdf', 0, 'Assigned');

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
(4, 'Test Notification', 'This is a test.', 'alert', '2024-11-30', NULL, '2024-11-29 07:40:24', NULL),
(5, 'New Task Assigned', 'A new task has been assigned for Book ID: 7.', '', NULL, NULL, '2025-01-17 13:17:41', 13),
(6, 'New Task Assigned', 'A new task has been assigned for Book ID: 11.', '', NULL, NULL, '2025-01-20 12:31:35', 13),
(7, 'New Task Assigned', 'A new task has been assigned for Book ID: 10.', '', NULL, NULL, '2025-01-20 13:37:17', 13);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `id` int(11) NOT NULL,
  `idNumber` varchar(13) NOT NULL,
  `bookName` varchar(255) NOT NULL,
  `authorFullName` varchar(255) NOT NULL,
  `authorAddress` text NOT NULL,
  `authorContact` varchar(15) NOT NULL,
  `authorEmail` varchar(255) NOT NULL,
  `publisherName` varchar(255) NOT NULL,
  `publisherAddress` text NOT NULL,
  `publisherContact` varchar(15) NOT NULL,
  `publisherEmail` varchar(255) NOT NULL,
  `format` enum('Print','Electronic','Both') NOT NULL,
  `publicationDate` date NOT NULL,
  `openAccess` enum('Yes','No') NOT NULL,
  `isbnRegistered` enum('Publisher') NOT NULL,
  `externalPlatforms` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id`, `idNumber`, `bookName`, `authorFullName`, `authorAddress`, `authorContact`, `authorEmail`, `publisherName`, `publisherAddress`, `publisherContact`, `publisherEmail`, `format`, `publicationDate`, `openAccess`, `isbnRegistered`, `externalPlatforms`, `created_at`) VALUES
(1, '', 'Sie', 'Siemon', 'Pretoria', '1234567890', '$2y$10$8oma09MaFEko8due62GH9egaksp4qdp/Wx/A3qH9C6jdfdfbAgUCO', 'Maphota', 'Sosha', '0123456789', '$2y$10$MdtiALpIrVMRvHa.2R.hjuov2/9HFmF7VQFYXJ3o8SIDOfCaLn2Tu', '', '0000-00-00', 'No', 'Publisher', 'NLSA', '2025-01-15 10:26:15'),
(2, '', 'Simon', '', '', '', '$2y$10$JljaZuXbHdKDHiKmk75qheUTQ0mPbuPgATTM3NlwV4rTRneiZyENe', '', '', '', '$2y$10$sJwoQu1C1TUY4eH1ctpB3.8LIV/xC4fKbKHzi8bdwDo9mBThTvkF2', '', '0000-00-00', '', '', '', '2025-01-17 07:45:11');

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
(11, 'Keletso Mmulutsi', 'keletso@nlsa.ac.za', '0763452617', '5f4dcc3b5aa765d61d8327deb882cf99'),
(12, 'Maphota', 'ShiburiMaphota@nlsa.ac.za', '0711111111', '5f4dcc3b5aa765d61d8327deb882cf99'),
(13, 'AsanteSie', 'Asante@nlsa.ac.za', '0888888888', '5f4dcc3b5aa765d61d8327deb882cf99');

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
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `fk_cataloguer_user` (`cataloguer_id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_informationsheet`
--
ALTER TABLE `book_informationsheet`
  MODIFY `Book_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  ADD CONSTRAINT `fk_cataloguer_user` FOREIGN KEY (`cataloguer_id`) REFERENCES `users` (`User_ID`),
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`cataloguer_id`) REFERENCES `users` (`User_ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`cataloguer_id`) REFERENCES `users` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
