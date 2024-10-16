-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 09:12 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rn_8164`
--

-- --------------------------------------------------------

--
-- Table structure for table `rn_category`
--

CREATE TABLE `rn_category` (
  `category` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rn_category`
--

INSERT INTO `rn_category` (`category`, `id`) VALUES
('Biotechnology and Life Sciences', 10),
('Clean Energy and Sustainability', 6),
('E-commerce and Retail', 2),
('Education Technology (EdTech)', 7),
('Entertainment and Media', 12),
('Fintech', 4),
('Food and Beverage', 5),
('Healthtech and Medtech', 3),
('Internet of Things (IoT)', 9),
('Social Impact and Sustainability', 11),
('Technology and Software', 1),
('Travel and Hospitality', 8);

-- --------------------------------------------------------

--
-- Table structure for table `rn_login`
--

CREATE TABLE `rn_login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rn_login`
--

INSERT INTO `rn_login` (`id`, `username`, `password`, `account_type`) VALUES
(36, 'kamlesh', '1234', 'user'),
(61, 'paperboat', '1234', 'startup'),
(63, 'rapido1', '121212', 'startup'),
(64, 'Ola', '1234', 'startup'),
(65, 'gillete', 'gillete1234', 'startup'),
(66, 'raj', 'raj1234', 'user'),
(67, 'balaji_snacks', '1234', 'startup'),
(68, 'ptron1', '1234', 'startup');

-- --------------------------------------------------------

--
-- Table structure for table `rn_raise`
--

CREATE TABLE `rn_raise` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `equity` decimal(10,2) DEFAULT 0.00,
  `valuation` decimal(12,2) DEFAULT NULL,
  `description` text DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rn_raise`
--

INSERT INTO `rn_raise` (`id`, `username`, `equity`, `valuation`, `description`, `created_at`) VALUES
(1, 'Ola', 3.00, 121.00, 'gajvvjvsjmvs jgasjvasvas', '2023-05-23 05:17:42'),
(2, 'paperboat', 3.00, 40.00, '', '2023-05-23 05:18:07'),
(3, 'rapido1', 0.00, 0.00, '', '2023-05-23 05:18:17'),
(4, 'gillete', 4.00, 2000.00, 'we are mancare brand', '2023-05-23 06:59:04'),
(5, 'balaji_snacks', 0.00, NULL, '', '2023-05-30 04:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `rn_startup`
--

CREATE TABLE `rn_startup` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(10) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `reg_id` varchar(50) NOT NULL,
  `web` varchar(255) NOT NULL,
  `file_path` text NOT NULL,
  `file_type` text NOT NULL,
  `image_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rn_startup`
--

INSERT INTO `rn_startup` (`id`, `name`, `username`, `email`, `mobile`, `category`, `reg_id`, `web`, `file_path`, `file_type`, `image_path`) VALUES
(12, 'Paperboat', 'paperboat', 'paperboat@gmail.com', 2147483647, 'Food and Beverage', '77621', 'www.paperboat.in', 'startupfile/paperboat.pdf', 'application/pdf', 'startupimage/paperboat.jpg'),
(13, 'Rapido', 'rapido1', 'cgftewrQ', 452524242, 'Travel and Hospitality', 'sdfngew', 'sfdh', 'startupfile/rapido.pdf', 'application/pdf', 'startupimage/rapido.jpg'),
(14, 'Ola Taxi', 'Ola', 'kuakhsa@g.com', 828282, '', 'aka221', 'uigsaiusa', 'startupfile/ola.pdf', 'application/pdf', 'startupimage/ola.jpg'),
(15, 'Gillete', 'gillete', 'gillete@hotmail.com', 657877678, 'Healthtech and Medtech', '65fd5', 'www.gillete.com', 'startupfile/gillete.jpg', 'image/jpeg', 'startupimage/gillete.jpg'),
(16, 'Balaji Snacks', 'balaji_snacks', 'balaji_snacks@gmail.com', 7589392, 'Food and Beverage', 'yah82b', 'https://www.balajiwafers.com/products/', 'startupfile/balajisnacks.pdf', 'application/pdf', 'startupimage/balajisnacks.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rn_user`
--

CREATE TABLE `rn_user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `pan_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rn_user`
--

INSERT INTO `rn_user` (`id`, `name`, `username`, `dob`, `email`, `mobile`, `gender`, `pan_id`) VALUES
(0, 'kamlesh', 'kamlesh', '2023-05-30', 'kamlesh616@gmail', '128', 'Male', 'sas'),
(0, 'Raj Roshan Nandale', 'raj', '2005-02-09', 'mail6164@duck.com', '7588238163', 'Male', 'CJNPN0865J');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rn_category`
--
ALTER TABLE `rn_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Category` (`category`);

--
-- Indexes for table `rn_login`
--
ALTER TABLE `rn_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `rn_raise`
--
ALTER TABLE `rn_raise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `rn_startup`
--
ALTER TABLE `rn_startup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `rn_user`
--
ALTER TABLE `rn_user`
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rn_category`
--
ALTER TABLE `rn_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rn_login`
--
ALTER TABLE `rn_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `rn_raise`
--
ALTER TABLE `rn_raise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rn_startup`
--
ALTER TABLE `rn_startup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rn_raise`
--
ALTER TABLE `rn_raise`
  ADD CONSTRAINT `rn_raise_ibfk_1` FOREIGN KEY (`username`) REFERENCES `rn_startup` (`username`);

--
-- Constraints for table `rn_startup`
--
ALTER TABLE `rn_startup`
  ADD CONSTRAINT `rn_startup_ibfk_1` FOREIGN KEY (`username`) REFERENCES `rn_login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rn_user`
--
ALTER TABLE `rn_user`
  ADD CONSTRAINT `rn_user_ibfk_1` FOREIGN KEY (`username`) REFERENCES `rn_login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
