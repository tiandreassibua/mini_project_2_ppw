-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 06:43 AM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `level` char(1) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `day`, `month`, `year`, `title`, `location`, `description`, `level`, `time`) VALUES
(22, 24, 5, 2023, 'Tarian Gomatere', 'XT Square', 'Kapitan Pattimura lahir sebagai Thomas Matulessy pada 8 Juni 1783 di Saparua. Leluhur keluarga Matulessy berasal dari Pulau Seram.', '2', '6:00 PM - 10:00 PM'),
(30, 24, 5, 2023, 'Apa apa', 'lokasi apa ajaa', 'deskripsi apa ajaa', '1', '10:00 AM - 8:00 PM'),
(31, 24, 5, 2023, 'sonob', 'ISBIEU', 'dniudvb', '0', '12:00 PM - 8:00 PM'),
(32, 29, 5, 2023, 'kegiatan yang dah lewat', 'ini lokasi kegiatan yang dah lewat', 'ini deskripsi kegiatan yang dah lewat', '1', '10:00 AM - 8:00 PM'),
(34, 30, 5, 2023, 'Tarian Gomatere', 'XT Square', 'Kapitan Pattimura lahir sebagai Thomas Matulessy pada 8 Juni 1783 di Saparua. Leluhur keluarga Matulessy berasal dari Pulau Seram.', '2', '6:00 PM - 11:00 PM'),
(38, 30, 5, 2023, 'Kegiatan link', 'https://goo.gl/maps/u7EpUhXpfyB4BvEy5', 'deskripsi kegiatan link', '1', '10:00 AM - 8:00 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
