-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 10:07 PM
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
-- Database: `notes-1`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `sno` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `bgcolor` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `user_id` int(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`sno`, `title`, `description`, `bgcolor`, `category`, `user_id`, `position`) VALUES
(83, 'Trust bank', ' This is Trust bank', 'rgb(158, 231, 245)', 'Bank', 1, 3),
(89, 'Trust bank', 'Trust Bank is an army bank', 'rgb(206, 234, 79)', 'Army Bank', 6, 1),
(90, 'AUST', 'AUST is a University', 'rgb(243, 165, 249)', 'University', 6, 3),
(91, 'BAUET', 'BAUET is a private engineering university', 'rgb(245, 173, 148)', 'University', 6, 2),
(92, 'BAUET', 'Bangladesh Army University of Engineering & Technology is a Government and UGC approved private university operated by the Bangladesh Army. It was established in accordance with the Private University Act 2010. The university is situated in Qadirabad Cantonment, Natore District, Rajshahi Division, Bangladesh.Bangladesh Army University of Engineering & Technology is a Government and UGC approved private university operated by the Bangladesh Army. It was established in accordance with the Private University Act 2010. The university is situated in Qadirabad Cantonment, Natore District, Rajshahi Division, Bangladesh.Bangladesh Army University of Engineering & Technology is a Government and UGC approved private university operated by the Bangladesh Army. It was established in accordance with the Private University Act 2010. The university is situated in Qadirabad Cantonment, Natore District, Rajshahi Division, Bangladesh.', 'rgb(180, 249, 165)', 'University', 6, 4),
(112, 'Prime Bank', ' This is a normal Bank', 'rgb(158, 231, 245)', 'Bank', 1, 4),
(125, 'BAUET', ' BAUET is an Army University', 'rgb(243, 165, 249)', 'University', 1, 6),
(127, 'AUST', ' AUST is an university', 'rgb(243, 165, 249)', 'University', 1, 5),
(137, 'Brac bank', ' Brack  Bank', 'rgb(158, 231, 245)', 'Bank', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(252) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `FullName`, `email`, `password`) VALUES
(1, 'Syeda Fairooz Nawal', 'syedafairooznawal@gmail.com', '$2y$10$ZMCeyNzubbY5f0aPF6MY9.uaDyR4nz21mb1OWyioXplO5jeVULJra'),
(6, 'Yousuf Raihan ', 'raihan@gmail.com', '$2y$10$sXC6tFrJRWyAep5tCAhukeojKZlEjMFX.kABDXH2eycQcVfVnAmaq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(252) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
