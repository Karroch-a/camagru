-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jan 12, 2021 at 06:31 PM
-- Server version: 8.0.22
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_aazeroua`
--

-- --------------------------------------------------------

--
-- Table structure for table `cmnt`
--

CREATE TABLE `cmnt` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `image_n` varchar(300) NOT NULL,
  `comment` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cmnt`
--

INSERT INTO `cmnt` (`id`, `id_user`, `image_n`, `comment`) VALUES
(248, 27, 'pic-1610459270.png', 'DDA'),
(249, 27, 'pic-1610459270.png', 'dad'),
(250, 27, 'pic-1610461459.png', 'daada'),
(251, 27, 'pic-1610461853.png', 'adad'),
(252, 27, 'pic-1610461850.png', 'adada'),
(253, 27, 'pic-1610461853.png', 'da'),
(254, 27, 'pic-1610461853.png', 'dad'),
(255, 27, 'pic-1610461853.png', 'adad'),
(256, 27, 'pic-1610461853.png', 'adad'),
(257, 27, 'pic-1610461853.png', 'dad'),
(258, 27, 'pic-1610461850.png', 'adad'),
(259, 27, 'pic-1610461459.png', 'dad'),
(260, 27, 'pic-1610461853.png', 'olo');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int NOT NULL,
  `id` int NOT NULL,
  `image_n` varchar(300) NOT NULL,
  `like_count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `id`, `image_n`, `like_count`) VALUES
(9, 27, 'pic-1610387748.png', 1),
(12, 27, 'pic-1610461850.png', 0),
(13, 27, 'pic-1610461853.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id_image` int NOT NULL,
  `image_n` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id_image`, `image_n`) VALUES
(27, 'pic-1610373266.png'),
(27, 'pic-1610373269.png'),
(28, 'pic-1610387748.png'),
(28, 'pic-1610373610.png'),
(27, 'pic-1610461459.png'),
(27, 'pic-1610459270.png'),
(27, 'pic-1610461853.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `rowcount` int NOT NULL,
  `notification` int NOT NULL,
  `token` varchar(300) NOT NULL,
  `password_token` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `rowcount`, `notification`, `token`, `password_token`) VALUES
(25, 'abdellaha', '0bc4c5273b@firemailbox.club', '446aa4de6231ff9d0c10c2c9f3c75619', 1, 0, 'NULL', 'NULL'),
(27, 'karroch', 'vokela77a53@aranelab.com', '904eb66eb259fb2e318aaf27ffc4aedb', 1, 0, 'NULL', 'NULL'),
(28, 'charaf', 'vokela7753@aranelab.com', '904eb66eb259fb2e318aaf27ffc4aedb', 1, 0, 'NULL', 'NULL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cmnt`
--
ALTER TABLE `cmnt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cmnt`
--
ALTER TABLE `cmnt`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
