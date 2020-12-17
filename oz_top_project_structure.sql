-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 17, 2020 at 12:08 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `state4market`
--

-- --------------------------------------------------------

--
-- Table structure for table `oz_top_project`
--

CREATE TABLE `oz_top_project` (
  `id` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `currentUrl` varchar(255) DEFAULT NULL,
  `nextPage` varchar(255) DEFAULT NULL,
  `currentText` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correctedText` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalFound` int(11) DEFAULT NULL,
  `totalPages` int(11) DEFAULT NULL,
  `loadPages` int(11) DEFAULT '0',
  `isLoadNewProducts` tinyint(1) DEFAULT '0' COMMENT 'Загружать новые товары в отслеживание',
  `isAddToCompetitors` tinyint(1) DEFAULT '0' COMMENT 'Добавлять товары в отслеживаемые',
  `pageLimit` int(11) DEFAULT '0',
  `createDate` timestamp NULL DEFAULT NULL,
  `updateDate` timestamp NULL DEFAULT NULL,
  `updateCount` int(11) DEFAULT '0',
  `errorCount` int(11) DEFAULT '0',
  `completed` tinyint(1) DEFAULT '0',
  `processed` tinyint(1) DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oz_top_project`
--
ALTER TABLE `oz_top_project`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `oz_top_project`
--
ALTER TABLE `oz_top_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
