-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 21, 2019 at 06:56 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Projects`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `imageurl` varchar(255) DEFAULT NULL,
  `normal` tinyint(4) DEFAULT NULL,
  `fb` tinyint(4) DEFAULT NULL,
  `google` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `imageurl`, `normal`, `fb`, `google`) VALUES
(1, 'SteveR', 'Password12', 'steven.roe@outlook.com', NULL, NULL, NULL, NULL),
(10, 'test', '$2y$10$3iBHRRvYue4pvdDn6tXZx.73L49uEfI0RUaKqtk0oKz58V.JjA1QG', 'test@test.com', NULL, 1, NULL, NULL),
(12, 'Steven', 'googleconnexion', 'verzomusic@gmail.com', 'https://lh3.googleusercontent.com/a-/AAuE7mAas4eE7gEoqSwRUEW_s4fjcgO59SBuvg8TEI9h1w=s96-c', NULL, NULL, 1),
(13, 'TesterMate', '$2y$10$vXyiYlyYjF1Licl8WUaRxuIgii0DYFjhjpDC7p.Qj9F553UIa/IeG', 'steven.roe@outlook.com', NULL, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
