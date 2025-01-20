-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2025 at 02:14 PM
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
  `FileUpload` varchar(255) NOT NULL,
  `downloads` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_informationsheet`
--

INSERT INTO `book_informationsheet` (`Book_ID`, `PublisherEmail`, `AuthorName`, `AuthorPseudonym`, `EditorName`, `PublicationTitle`, `BookEdition`, `Impression`, `Isbn`, `SetISBN`, `PublisherName`, `PublisherAddress`, `PublicationYear`, `Price`, `FictionOrNonFiction`, `Genre`, `PublicationLanguage`, `EnglishVersionTitle`, `FileUpload`, `downloads`) VALUES
(1, 'nicholus.mahlangu@nlsa.ac.za', 'Nick', 'Nick', '2341', 'Chronicles of a genuine character', '8th edition', 'Educational', 2147483647, '13 digits', 'Maphota Shiburi', 'Johannes Mogase', '2019', 291.67, 'Non-fiction', 'Academical', 'Chronicles of a genuine character', 'Chronicles of a genuine character', '6733218cdd8c3_Contact Information (Responses) - Form responses 1.pdf', 0),
(2, 'nicolasmahlangu75@gmail.com', 'Maphota Shiburi', 'Maphota Shiburi', 'Nick', 'War Room', '4th', 'Educational', 2147483647, '13 digits', 'Nick Williams', 'Johannes Mogase', '2019', 90.43, 'Fiction', 'Eduucational', 'War Room', 'War Room', '676277ecb6e9a_9th - 13th December 2024_signed.pdf', 0),
(3, 'nicolasmahlangu75@gmail.com', 'Nicholus Mahlangu', 'Nick', 'Puseletso', 'Khona manje', '4th', 'Nick', 2147483647, 'Nick', 'Busi Sibiya', 'Nick', '2024', 80.45, 'Fiction', 'Educational', 'Nick', 'Nick', '67627cb55632f_9th - 13th December 2024_signed.pdf', 0),
(4, 'nicolasmahlangu75@gmail.com', 'Nicholus Mahlangu', 'Nick', 'Puseletso', 'Khona manje', '4th', 'Nick', 2147483647, 'Nick', 'Busi Sibiya', 'Nick', '2024', 78.32, 'Fiction', 'Educational', 'Nick', 'Nick', '6762cde1e04e4_9th - 13th December 2024_signed.pdf', 0),
(5, 'nicolasmahlangu75@gmail.com', 'Nicholus Mahlangu', 'Nick', 'Puseletso', 'Khona manje', '4th', 'Nick', 2147483647, 'Nick', 'Busi Sibiya', 'Nick', '2024', 78.32, 'Fiction', 'Educational', 'Nick', 'Nick', '6762ce43def18_9th - 13th December 2024_signed.pdf', 0),
(6, 'nicolasmahlangu75@gmail.com', 'Nicholus Mahlangu', 'Nick', 'Puseletso', 'Khona manje', '4th', 'Nick', 2147483647, 'Nick', 'Busi Sibiya', 'Nick', '2024', 78.32, 'Fiction', 'Educational', 'Nick', 'Nick', '6762ce7fe30fd_9th - 13th December 2024_signed.pdf', 0),
(7, 'nicolasmahlangu75@gmail.com', 'Nicholus Mahlangu', 'Nick', 'Puseletso', 'Khona manje', '4th', 'Nick', 2147483647, 'Nick', 'Busi Sibiya', 'Nick', '2024', 78.32, 'Fiction', 'Educational', 'Nick', 'Nick', '6762ce83c1550_9th - 13th December 2024_signed.pdf', 0),
(8, 'nicolasmahlangu75@gmail.com', 'Nicholus Mahlangu', 'Nick', 'Puseletso', 'Khona manje', '4th', 'Nick', 2147483647, 'Nick', 'Busi Sibiya', 'Nick', '2024', 78.32, 'Fiction', 'Educational', 'Nick', 'Nick', '6762ceba53cb1_9th - 13th December 2024_signed.pdf', 0),
(9, 'nicolasmahlangu75@gmail.com', 'Nicholus Mahlangu', 'Nick', 'Puseletso', 'Khona manje', '4th', 'Nick', 2147483647, 'Nick', 'Busi Sibiya', 'Nick', '2024', 78.32, 'Fiction', 'Educational', 'Nick', 'Nick', '6762cf3158250_9th - 13th December 2024_signed.pdf', 0),
(10, 'nicolasmahlangu75@gmail.com', 'Nicholus Mahlangu', 'Nick', 'Puseletso', 'Khona manje', '4th', 'Nick', 2147483647, 'Nick', 'Busi Sibiya', 'Nick', '2024', 78.32, 'Fiction', 'Educational', 'Nick', 'Nick', '6762cf6f6a6b5_9th - 13th December 2024_signed.pdf', 0),
(11, 'nicolasmahlangu75@gmail.com', 'Nicholus Mahlangu', 'Nick', 'Puseletso', 'Khona manje', '4th', 'Nick', 2147483647, 'Nick', 'Busi Sibiya', 'Nick', '2024', 78.32, 'Fiction', 'Educational', 'Nick', 'Nick', '6762cf73dd99b_9th - 13th December 2024_signed.pdf', 0),
(12, 'nicolasmahlangu75@gmail.com', 'Nicholus Mahlangu', 'Nick', 'Puseletso', 'Khona manje', '4th', 'Nick', 2147483647, 'Nick', 'Busi Sibiya', 'Nick', '2024', 78.32, 'Fiction', 'Educational', 'Nick', 'Nick', '6762cfee11271_9th - 13th December 2024_signed.pdf', 0),
(13, 'nicholus@gamil.com', 'Nicholus Mahlangu', 'Nick', 'Nick', 'Jordan G', '5th', 'Innovative', 2147483647, '13 digits', 'Nick', 'Johannes Mogase', '2015', 342.94, 'Fiction', 'Gospel', 'English', 'Jordan G', '6763c4475e0bf_9th - 13th December 2024_signed.pdf', 0),
(14, 'nicholus@gamil.com', 'Nicholus Mahlangu', 'Nick', 'Nick', 'Jordan G', '5th', 'Innovative', 2147483647, '13 digits', 'Nick', 'Johannes Mogase', '2015', 342.94, 'Fiction', 'Gospel', 'English', 'Jordan G', '6763d6cfd0ba5_9th - 13th December 2024_signed.pdf', 0),
(15, 'nicholus.mahlangu@nlsa.ac.za', 'Nicholus Mahlangu', 'Nick', 'Nick', 'Eye opener', '5th', 'Educational', 2147483647, '13 digits', 'Nick Williams', 'Johannes Mogase', '2012', 140.78, 'Fiction', 'Educational', 'English', 'Eye opener', '677651214c553_16th - 20th December 2024-1.pdf', 0),
(16, 'nicholus.mahlangu@nlsa.ac.za', 'Nicholus Mahlangu', 'Nick', 'Nick', 'Eye opener', '5th', 'Educational', 2147483647, '13 digits', 'Nick Williams', 'Johannes Mogase', '2012', 140.78, 'Fiction', 'Educational', 'English', 'Eye opener', '677653f99670d_16th - 20th December 2024-1.pdf', 0),
(17, 'nicholus.mahlangu@nlsa.ac.za', 'Nicholus', 'Nick Williams', 'Eu', 'Eye opener', '5th edition', 'Diplomats', 2147483647, '13 digits', 'Nick Williams', '123 Aubrey Matlala', '2018', 12.78, 'Fiction', 'Educational', 'War Room', 'NLSA Architecture', '67765cd9d3b82_16th - 20th December 2024-1.pdf', 0),
(18, 'nicholus.mahlangu@nlsa.ac.za', 'Nicholus', 'Nick Williams', 'Eu', 'Eye opener', '5th edition', 'Diplomats', 2147483647, '13 digits', 'Nick Williams', '123 Aubrey Matlala', '2018', 12.78, 'Fiction', 'Educational', 'War Room', 'NLSA Architecture', '67765d34c7be2_16th - 20th December 2024-1.pdf', 0),
(19, 'nicholus.mahlangu@nlsa.ac.za', 'Nicholus', 'Nick Williams', 'Eu', 'Eye opener', '5th edition', 'Diplomats', 2147483647, '13 digits', 'Nick Williams', '123 Aubrey Matlala', '2018', 12.78, 'Fiction', 'Educational', 'War Room', 'NLSA Architecture', '67765e09e4c71_16th - 20th December 2024-1.pdf', 0),
(20, 'nicholus.mahlangu@nlsa.ac.za', 'Nicholus', 'Nick Williams', 'Eu', 'Eye opener', '5th edition', 'Diplomats', 2147483647, '13 digits', 'Nick Williams', '123 Aubrey Matlala', '2018', 12.78, 'Fiction', 'Educational', 'War Room', 'NLSA Architecture', '6776829f463c5_16th - 20th December 2024-1.pdf', 0),
(21, 'nicholus.mahlangu@nlsa.ac.za', 'Nicholus', 'Nick Williams', 'Eu', 'Eye opener', '5th edition', 'Diplomats', 2147483647, '13 digits', 'Nick Williams', '123 Aubrey Matlala', '2018', 12.78, 'Fiction', 'Educational', 'War Room', 'NLSA Architecture', '677687e86c593_16th - 20th December 2024-1.pdf', 0),
(22, 'nicholus.mahlangu@nlsa.ac.za', 'Nicholus', 'Nick Williams', 'Eu', 'Eye opener', '5th edition', 'Diplomats', 2147483647, '13 digits', 'Nick Williams', '123 Aubrey Matlala', '2018', 12.78, 'Fiction', 'Educational', 'War Room', 'NLSA Architecture', '6776882114130_16th - 20th December 2024-1.pdf', 0),
(23, 'nicholus.mahlangu@nlsa.ac.za', 'Nicholus', 'Nick Williams', 'Eu', 'Eye opener', '5th edition', 'Diplomats', 2147483647, '13 digits', 'Nick Williams', '123 Aubrey Matlala', '2018', 12.78, 'Fiction', 'Educational', 'War Room', 'NLSA Architecture', '67768860c0118_16th - 20th December 2024-1.pdf', 0),
(24, 'nicholus.mahlangu@nlsa.ac.za', 'Nicholus', 'Nick Williams', 'Eu', 'Eye opener', '5th edition', 'Diplomats', 2147483647, '13 digits', 'Nick Williams', '123 Aubrey Matlala', '2018', 12.78, 'Fiction', 'Educational', 'War Room', 'NLSA Architecture', '67768953dff35_16th - 20th December 2024-1.pdf', 0),
(25, 'nicholus.mahlangu@nlsa.ac.za', 'Nick Mahlangu', 'Nicholus', 'nick', 'New Book', '5th edition', 'Growth and development', 2147483647, '13 digits', 'Nick Williams', '2588 New Eerstrust', '2012', 12.96, 'Fiction', 'Wisdom', 'English', 'New book', '6777b6f8f249c_16th - 20th December 2024-1.pdf', 0),
(26, 'nicholus.mahlangu@nlsa.ac.za', 'Nick Mahlangu', 'Nicholus', 'nick', 'New Book', '5th edition', 'Growth and development', 2147483647, '13 digits', 'Nick Williams', '2588 New Eerstrust', '2012', 12.96, 'Fiction', 'Wisdom', 'English', 'New book', '6777b7c6bad24_16th - 20th December 2024-1.pdf', 0),
(27, 'nicholus.mahlangu@nlsa.ac.za', 'Nick Mahlangu', 'Nicholus', 'nick', 'New Book', '5th edition', 'Growth and development', 2147483647, '13 digits', 'Nick Williams', '2588 New Eerstrust', '2012', 12.96, 'Fiction', 'Wisdom', 'English', 'New book', '6777b86f36aa1_16th - 20th December 2024-1.pdf', 0),
(28, 'nicholus.mahlangu@nlsa.ac.za', 'Nick Mahlangu', 'Nicholus', 'nick', 'New Book', '5th edition', 'Growth and development', 2147483647, '13 digits', 'Nick Williams', '2588 New Eerstrust', '2012', 12.96, 'Fiction', 'Wisdom', 'English', 'New book', '6777b8870f509_16th - 20th December 2024-1.pdf', 0),
(29, 'nicholus.mahlangu@nlsa.ac.za', 'Nick Mahlangu', 'Nicholus', 'nick', 'New Book', '5th edition', 'Growth and development', 2147483647, '13 digits', 'Nick Williams', '2588 New Eerstrust', '2012', 12.96, 'Fiction', 'Wisdom', 'English', 'New book', '6777b896b46e2_16th - 20th December 2024-1.pdf', 0),
(30, 'nicholus.mahlangu@nlsa.ac.za', 'Nick Mahlangu', 'Nicholus', 'nick', 'New Book', '5th edition', 'Growth and development', 2147483647, '13 digits', 'Nick Williams', '2588 New Eerstrust', '2012', 12.96, 'Fiction', 'Wisdom', 'English', 'New book', '6777bce85dc06_16th - 20th December 2024-1.pdf', 0),
(31, 'nicholus.mahlangu@nlsa.ac.za', 'Nick Mahlangu', 'Nicholus', 'nick', 'New Book', '5th edition', 'Growth and development', 2147483647, '13 digits', 'Nick Williams', '2588 New Eerstrust', '2012', 12.96, 'Fiction', 'Wisdom', 'English', 'New book', '6777c58057cdd_16th - 20th December 2024-1.pdf', 0),
(32, 'nicholus.mahlangu@nlsa.ac.za', 'Nick Mahlangu', 'Nicholus', 'nick', 'New Book', '5th edition', 'Growth and development', 2147483647, '13 digits', 'Nick Williams', '2588 New Eerstrust', '2012', 12.96, 'Fiction', 'Wisdom', 'English', 'New book', '6777c876d615d_16th - 20th December 2024-1.pdf', 0),
(33, 'nicholus.mahlangu@nlsa.ac.za', 'Nicholus Mahlangu', 'Nick', 'Nick', 'Learn your language', '6th', 'Educational', 2147483647, '13 digits', 'Mpuse', 'New Eerstrust', '2018', 134.67, 'Fiction', 'educational', 'Zulu', 'Education', '677ba8c77b5c4_16th - 20th December 2024-1.pdf', 0),
(34, 'nicholus.mahlangu@nlsa.ac.za', 'Nicholus Mahlangu', 'Nick', 'Nick', 'Learn your language', '6th', 'Educational', 2147483647, '13 digits', 'Mpuse', 'New Eerstrust', '2018', 134.67, 'Fiction', 'educational', 'Zulu', 'Education', '677bad118f463_16th - 20th December 2024-1.pdf', 0),
(35, 'nicholus.mahlangu@nlsa.ac.za', 'Nicholus Mahlangu', 'Nick', 'Nick', 'Learn your language', '6th', 'Educational', 2147483647, '13 digits', 'Mpuse', 'New Eerstrust', '2018', 134.67, 'Fiction', 'educational', 'Zulu', 'Education', '677bad3d106b1_16th - 20th December 2024-1.pdf', 0),
(36, 'nicholus.mahlangu@nlsa.ac.za', 'Nicholus Mahlangu', 'Nick', 'Nick', 'Learn your language', '6th', 'Educational', 2147483647, '13 digits', 'Mpuse', 'New Eerstrust', '2018', 134.67, 'Fiction', 'educational', 'Zulu', 'Education', '677bb30f59640_16th - 20th December 2024-1.pdf', 0),
(37, 'nicholus.mahlangu@nlsa.ac.za', 'Nick', 'Nicholus', 'nic', 'Nothing but the truth', '4th', 'Educational', 2147483647, '13 digits', 'Nick', 'New Eerstrust', '2015', 156.78, 'Fiction', 'Educational', 'Zulu', 'Nothing but the truth', '677bb7217c1ab_16th - 20th December 2024-1.pdf', 0),
(38, 'nicholus.mahlangu@nlsa.ac.za', 'Nick', 'Nicholus', 'nic', 'Nothing but the truth', '4th', 'Educational', 2147483647, '13 digits', 'Nick', 'New Eerstrust', '2015', 156.78, 'Fiction', 'Educational', 'Zulu', 'Nothing but the truth', '677bb994df3f1_16th - 20th December 2024-1.pdf', 0),
(39, 'nicholus.mahlangu@nlsa.ac.za', 'Nick', 'Nicholus', 'nic', 'Nothing but the truth', '4th', 'Educational', 2147483647, '13 digits', 'Nick', 'New Eerstrust', '2015', 156.78, 'Fiction', 'Educational', 'Zulu', 'Nothing but the truth', '677bb9adab7b0_16th - 20th December 2024-1.pdf', 0),
(40, 'nicholus.mahlangu@nlsa.ac.za', 'Nick', 'Nicholus', 'nic', 'Nothing but the truth', '4th', 'Educational', 2147483647, '13 digits', 'Nick', 'New Eerstrust', '2015', 156.78, 'Fiction', 'Educational', 'Zulu', 'Nothing but the truth', '677bbb24a8d24_16th - 20th December 2024-1.pdf', 0),
(41, 'nicholus.mahlangu@nlsa.ac.za', 'Nick', 'Nicholus', 'nic', 'Nothing but the truth', '4th', 'Educational', 2147483647, '13 digits', 'Nick', 'New Eerstrust', '2015', 156.78, 'Fiction', 'Educational', 'Zulu', 'Nothing but the truth', '677bbb5b42b72_16th - 20th December 2024-1.pdf', 0),
(42, 'nicholus.mahlangu@nlsa.ac.za', 'Nick', 'Nicholus', 'nic', 'Nothing but the truth', '4th', 'Educational', 2147483647, '13 digits', 'Nick', 'New Eerstrust', '2015', 156.78, 'Fiction', 'Educational', 'Zulu', 'Nothing but the truth', '677bbea0f1434_16th - 20th December 2024-1.pdf', 0),
(43, 'nicholus.mahlangu@nlsa.ac.za', 'Nick', 'Nicholus', 'nic', 'Nothing but the truth', '4th', 'Educational', 2147483647, '13 digits', 'Nick', 'New Eerstrust', '2015', 156.78, 'Fiction', 'Educational', 'Zulu', 'Nothing but the truth', '677bbee3a0d7e_16th - 20th December 2024-1.pdf', 0);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `description`, `type`, `date`, `file_path`, `created_at`) VALUES
(1, 'New Catalogue Assigned', 'A new catalogue has been added for review.', 'catalogue', '2024-11-20', 'catalogues/file1.pdf', '2024-11-28 13:05:04'),
(2, 'Reminder to Update Records', 'Please update your records before the end of the week.', 'reminder', '2024-11-19', NULL, '2024-11-28 13:05:04'),
(3, 'System Alert', 'System maintenance is scheduled for this weekend.', 'alert', '2024-11-18', NULL, '2024-11-28 13:05:04'),
(4, 'Test Notification', 'This is a test.', 'alert', '2024-11-30', NULL, '2024-11-29 07:40:24');

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
(10, 'Nicholus Mahlangu', 'nicholus.mahlangu@nlsa.ac.za', '0766180918', '5f4dcc3b5aa765d61d8327deb882cf99');

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
  ADD PRIMARY KEY (`Book_ID`),
  ADD KEY `idx_book_id` (`Book_ID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
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
-- AUTO_INCREMENT for table `book_informationsheet`
--
ALTER TABLE `book_informationsheet`
  MODIFY `Book_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
