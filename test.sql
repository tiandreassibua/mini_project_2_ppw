-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 08:06 AM
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
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_barang`) VALUES
(4, 'Jaket Varsity', 450000),
(5, 'Guitar Nylon Update', 950000),
(6, 'Laptop Lenovo ideapad slim 3', 10100000),
(21, 'Kulkas', 4000000);

-- --------------------------------------------------------

--
-- Table structure for table `datajson`
--

CREATE TABLE `datajson` (
  `id` int(11) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `date`
--

CREATE TABLE `date` (
  `date_id` int(11) NOT NULL,
  `day` varchar(3) NOT NULL,
  `month` varchar(3) NOT NULL,
  `year` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(38, 30, 5, 2023, 'Kegiatan link', 'https://goo.gl/maps/u7EpUhXpfyB4BvEy5', 'deskripsi kegiatan link', '1', '10:00 AM - 8:00 PM'),
(40, 1, 6, 2023, 'jkbdjabe', 'kjsebkc', 'sksebius', '2', '10:00 AM - 8:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `events_dev`
--

CREATE TABLE `events_dev` (
  `id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `level` char(1) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `time` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `events_dev`
--

INSERT INTO `events_dev` (`id`, `day`, `month`, `year`, `title`, `location`, `description`, `level`, `start_time`, `end_time`, `duration`, `time`, `id_user`) VALUES
(44, 3, 6, 2023, 'Mandi kolam', 'Kolam Rahayu', 'Kt dg tmn\" salawaku mo pigi mandi kolam di maguwo', '0', 'Sat Jun 03 2023 14:30:00 GMT 0700 (Indochina Time)', 'Sat Jun 03 2023 18:30:00 GMT 0700 (Indochina Time)', '4 jam', '3 Juni - 3 Juni', 1),
(45, 3, 6, 2023, 'kegiatan akun baru', 'lokas akun baru', 'deskripsi kegiatan akun baru', '0', 'Sat Jun 03 2023 20:35:00 GMT 0700 (Indochina Time)', 'Sat Jun 10 2023 20:35:00 GMT 0700 (Indochina Time)', '7 hari 0 jam', '3 Juni - 10 Juni', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jsontodb`
--

CREATE TABLE `jsontodb` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `password`) VALUES
(1, 'Andreas', 'andreassibua', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 'Akun baru', 'akunbaru', '5f4dcc3b5aa765d61d8327deb882cf99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `datajson`
--
ALTER TABLE `datajson`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `date`
--
ALTER TABLE `date`
  ADD PRIMARY KEY (`date_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `date_id` (`date_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events_dev`
--
ALTER TABLE `events_dev`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jsontodb`
--
ALTER TABLE `jsontodb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `datajson`
--
ALTER TABLE `datajson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `date`
--
ALTER TABLE `date`
  MODIFY `date_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `events_dev`
--
ALTER TABLE `events_dev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `jsontodb`
--
ALTER TABLE `jsontodb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`date_id`) REFERENCES `date` (`date_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
