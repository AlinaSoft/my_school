-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016 m. Vas 16 d. 20:08
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_school`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `training`
--

CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `training_name` varchar(150) COLLATE utf8_lithuanian_ci NOT NULL,
  `training_user_count` tinyint(2) NOT NULL,
  `training_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `training`
--

INSERT INTO `training` (`id`, `training_name`, `training_user_count`, `training_date`) VALUES
(1, 'Biologija', 20, '2016-02-26 12:10:00'),
(2, 'Informacinės technologijos', 20, '2016-02-10 09:00:00'),
(3, 'Matematika', 20, '2016-02-23 13:25:00');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `user_email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `user_phone` varchar(11) COLLATE utf8_lithuanian_ci NOT NULL,
  `user_surname` varchar(30) CHARACTER SET latin1 NOT NULL,
  `worker` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `user`
--

INSERT INTO `user` (`id`, `user_name`, `user_email`, `user_phone`, `user_surname`, `worker`) VALUES
(1, 'Katažyna', 'a@a.lt', '864748647', 'Ka', 0),
(3, 'Aurelijus', 'aurelijus@gmail.com', '37068811111', 'Au', 1),
(4, 'Gabija', 'gabija@gmail.com', '61111111', 'Ga', 0),
(5, 'Marija', 'marija@gmail.com', '37067777777', 'Ma', 0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `user_training`
--

CREATE TABLE `user_training` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `user_training`
--

INSERT INTO `user_training` (`id`, `user_id`, `training_id`) VALUES
(5, 3, 3),
(6, 5, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `user_training`
--
ALTER TABLE `user_training`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `training_id` (`training_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_training`
--
ALTER TABLE `user_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Apribojimai eksportuotom lentelėm
--

--
-- Apribojimai lentelei `user_training`
--
ALTER TABLE `user_training`
  ADD CONSTRAINT `user_training_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_training_ibfk_2` FOREIGN KEY (`training_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
