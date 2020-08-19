-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 21, 2019 at 06:55 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Projects`
--

-- --------------------------------------------------------

--
-- Table structure for table `Movie`
--

CREATE TABLE `Movie` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `poster` varchar(255) NOT NULL,
  `director` varchar(255) NOT NULL,
  `actors` text NOT NULL,
  `release_date` varchar(255) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ranking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Movie`
--

INSERT INTO `Movie` (`id`, `title`, `poster`, `director`, `actors`, `release_date`, `movie_id`, `user_id`, `ranking`) VALUES
(30, 'Drive', 'http://image.tmdb.org/t/p/w185//nu7XIa67cXc2t7frXCE5voXUJcN.jpg', 'Nicolas Winding Refn', 'Ryan Gosling Carey Mulligan Bryan Cranston', '2011-08-06', 64690, 12, 1),
(31, 'The Avengers', 'http://image.tmdb.org/t/p/w185//cezWGskPY5x7GaglTTRN4Fugfb8.jpg', 'Joss Whedon', 'Robert Downey Jr. Chris Evans Chris Hemsworth', '2012-04-25', 24428, 12, 1),
(32, 'Rush Hour', 'http://image.tmdb.org/t/p/w185//jdfxpW5LF36sHsHjyH8CMBEG4TF.jpg', 'Brett Ratner', 'Jackie Chan Chris Tucker Ken Leung', '1998-09-18', 2109, 12, 1),
(34, 'Jumanji: The Next Level', 'http://image.tmdb.org/t/p/w185//9Vp8MKqrwRAtvACF7PBwbvdG4dq.jpg', 'Jake Kasdan', 'Dwayne Johnson Jack Black Kevin Hart', '2019-12-04', 512200, 12, 1),
(35, 'Rush Hour 2', 'http://image.tmdb.org/t/p/w185//kFeK17ZSogSxRxuupTxZ6PGklbj.jpg', 'Brett Ratner', 'Chris Tucker Jackie Chan Zhang Ziyi', '2001-08-03', 5175, 12, 1),
(36, 'Fast & Furious Presents: Hobbs & Shaw', 'http://image.tmdb.org/t/p/w185//kvpNZAQow5es1tSY6XW2jAZuPPG.jpg', 'David Leitch', 'Dwayne Johnson Jason Statham Idris Elba', '2019-08-01', 384018, 12, 1),
(37, 'Love Actually', 'http://image.tmdb.org/t/p/w185//kfX8Ctin3fSZbdnjh6CXSNZUOVP.jpg', 'Richard Curtis', 'Hugh Grant Colin Firth Lúcia Moniz', '2003-09-07', 508, 12, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Movie`
--
ALTER TABLE `Movie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Movie`
--
ALTER TABLE `Movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
