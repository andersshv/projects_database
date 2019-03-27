-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2019 at 02:22 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projects_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `action_date` date NOT NULL,
  `action_text` text NOT NULL,
  `done` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`id`, `project_id`, `action_date`, `action_text`, `done`) VALUES
(1, 1, '0000-00-00', 'fffff', 0),
(2, 1, '0000-00-00', 'fffrrff', 0),
(3, 2, '0000-00-00', 'fffff', 0),
(678, 333, '0000-00-00', '333', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(255) NOT NULL,
  `user_id` int(64) NOT NULL,
  `project_name` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `archived` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `user_id`, `project_name`, `creation_date`, `archived`) VALUES
(1, 1, 'fff', '2019-03-27 11:04:34', 0),
(2, 1, 'fff', '2019-03-27 11:04:51', 0),
(3, 26, 'fff', '2019-03-27 11:09:19', 0),
(4, 26, 'ggg', '2019-03-27 11:35:46', 0),
(5, 26, 'ggggggg', '2019-03-27 11:43:51', 0),
(6, 26, 'ggg222', '2019-03-27 11:44:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`) VALUES
(23, 'ddd', '$2y$10$eLVG4yKTvRETYgGCvDiYkOE9KXI.h/uRk5IF64vW0eFjcsCLMf/gm'),
(24, 'AndersV', '$2y$10$KPlZAd6JGcjrxs4nYJWIfeqxiPtqtR2B/64uRLYSosvgKM5t1rLOq'),
(25, 'ttttttttttttttt', '$2y$10$A9OM279Ffs5FJEXPieQvXuxnUx5SovwrGscttzsSF77y7X.paJ0W2'),
(26, 'q', '$2y$10$ap.kr8RX1Gb5ImCJ7qku0Oa5mpURYngoC1NAziZ5BfjfTkpLesPO6'),
(27, 'wwww', '$2y$10$ISixhmnneESHowGfgM0POOUITyZ/GGeIcgkeMlnv1lvkPuZZvTUfS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
