-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2024 at 08:30 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `polltest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(4) UNSIGNED NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `nin` text NOT NULL COMMENT 'Check, nin is unique and length set to 15',
  `password` text NOT NULL,
  `status` enum('inactive','active','suspended','deactivate') NOT NULL DEFAULT 'inactive',
  `voted` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstname`, `lastname`, `username`, `email`, `nin`, `password`, `status`, `voted`) VALUES
(1, 'Njoku ', 'Okechukwu Valentine', 'bonsoirval', 'bonsoirval@gmail.com', '12345678901', 'f510f2a1fbd959d6371ad59eee832b0a7e0dc6d569acee6278d1c54e7ce90bc0607ff7b4d9daf00e8c2b98c5275414d601274d8dd411a2b62468732eb221e9e40', 'inactive', NULL),
(3, '\'NJOKU\'', '\'VALENTINE\'', '\'bonsoirval\'', '\'bonsoirval@gmail.com\'', '\'\\\'12345671111\\\'\'', '308842a5c77f2a9cb5902061e7c29ca1e1c0a58729ab67ac541c4d11c737ae7ee6299d37b2926597179c6d7103a6f53c5b6e4183cb0ac41efe74c3b6d012f5a2', 'inactive', NULL),
(4, '\'NJOKU\'', '\'NJOKU\'', '\'NJOKU\'', '\'njoku@gmail.com\'', '\'\\\'098123\\\'\'', '2d1f76aaa04a70309e6db10259ec357325ef18d0450f19264230df21e15f84e8efbaf67ad2ee5b7f098f581efd92c616970e4045b9c5a696311248e4e7a3cc54', 'inactive', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(11) UNSIGNED NOT NULL,
  `surname` varchar(100) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `theme` varchar(100) DEFAULT NULL,
  `email` text NOT NULL,
  `party_id` int(11) UNSIGNED NOT NULL,
  `election_id` int(11) UNSIGNED NOT NULL,
  `nothing` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_registered` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `surname`, `firstname`, `lastname`, `theme`, `email`, `party_id`, `election_id`, `nothing`, `date_registered`) VALUES
(1, 'Kalu', 'Orji', 'Uzo', 'cand 1 theme', 'cand1@gmail.com', 1, 1, '2023-11-03 17:49:39', '2023-11-03 00:00:00'),
(2, 'Uzodimma', 'Hope', 'Sen', 'theme 2', 'cand2@gmail.com', 2, 2, '2023-11-05 17:11:08', '2023-11-05 17:11:08'),
(3, 'Sam Daddy', 'Sammuel', 'Dady', NULL, 'test@gmail.com', 1, 1, '2023-11-11 21:50:37', NULL),
(4, 'surname 1', 'firstname 1', 'lastname 1', 'theme1', 'test2@gmail.com', 2, 2, '2023-11-12 07:15:50', NULL),
(5, 'surname', 'firstname', 'lastname', 'theme', 'bbbb@gmail.com', 1, 3, '2023-11-16 09:11:46', '2023-11-16 09:11:46');

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `region_id` int(4) UNSIGNED NOT NULL,
  `election_date` date DEFAULT NULL,
  `status` enum('upcoming','suspended','completed','ongoing') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`id`, `name`, `region_id`, `election_date`, `status`) VALUES
(1, 'imo_guber', 15, '2023-11-03', 'ongoing'),
(2, 'abia_guber', 15, '2023-11-06', 'ongoing'),
(3, 'test_election', 15, '2023-11-12', 'ongoing'),
(4, 'General Election Todays 2008', 15, '2023-12-26', 'upcoming'),
(5, 'imo guber', 2, '2024-01-04', 'upcoming'),
(6, 'Imo Gubera', 2, '2023-12-27', 'upcoming'),
(7, 'Imo Guberaa', 2, '2023-12-26', 'upcoming'),
(8, 'Imo Guberaz', 2, '2023-12-26', 'upcoming');

-- --------------------------------------------------------

--
-- Table structure for table `election_candidate`
--

CREATE TABLE `election_candidate` (
  `id` int(11) NOT NULL,
  `candidate_id` int(4) UNSIGNED NOT NULL,
  `election_id` int(11) UNSIGNED NOT NULL,
  `status` enum('completed','ongoing','suspended','post poned') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `election_candidate`
--

INSERT INTO `election_candidate` (`id`, `candidate_id`, `election_id`, `status`) VALUES
(1, 1, 1, 'ongoing'),
(2, 2, 2, 'ongoing'),
(3, 3, 1, 'ongoing'),
(4, 4, 3, 'ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `lan_id` int(100) NOT NULL,
  `fullname` varchar(10) NOT NULL,
  `about` varchar(255) NOT NULL,
  `position` varchar(20) NOT NULL,
  `votecount` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loginusers`
--

CREATE TABLE `loginusers` (
  `id` int(200) NOT NULL,
  `nin` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rank` varchar(80) NOT NULL DEFAULT 'voter',
  `status` varchar(10) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE `party` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `abbreviation` varchar(10) DEFAULT NULL,
  `slogan` varchar(50) NOT NULL,
  `ideology` text NOT NULL,
  `status` enum('deactivated','active','rejected','non') NOT NULL DEFAULT 'non',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `party`
--

INSERT INTO `party` (`id`, `name`, `abbreviation`, `slogan`, `ideology`, `status`, `date_created`) VALUES
(1, 'All Progression congress', 'p1', 'party 1 is the way', 'part 1 is the ideology', 'active', '2023-11-03 17:46:59'),
(2, 'Peoples\' Democratic Party', 'PDPs', 'Power to the people', 'Share the money', 'active', '2023-11-05 17:10:13'),
(3, 'party', 'abbreviati', 'ideology', 'slogan', 'active', '2023-12-05 18:07:51'),
(4, 'Labour Party', 'LP', 'Family', 'Productive Economy', 'deactivated', '2023-12-05 18:17:47'),
(5, 'pd\" or 0=0 or \"', 'sjlfjdsl', 'lsjfldsj', 'sljfdlsa', 'active', '2023-12-05 18:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(2) UNSIGNED NOT NULL,
  `state` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `state`) VALUES
(1, 'Abia'),
(2, 'Adamawa'),
(3, 'Anambra'),
(4, 'Bauchi'),
(5, 'Bayelsa'),
(6, 'Benue'),
(7, 'Borno'),
(8, 'Cross River'),
(9, 'Delta'),
(10, 'Ebonyi'),
(11, 'Edo'),
(12, 'Ekiti'),
(13, 'Enugu'),
(14, 'Gombe'),
(15, 'Imo'),
(16, 'Jigawa'),
(17, 'Kaduna'),
(18, 'Kano'),
(19, 'Katsina'),
(20, 'Kebbi'),
(21, 'Kogi'),
(22, 'Kwara'),
(23, 'Lagos'),
(24, 'Nasarawa'),
(25, 'Niger'),
(26, 'Ogun'),
(27, 'Ondo'),
(28, 'Osun'),
(29, 'Oyo'),
(30, 'Plateau'),
(31, 'Rivers'),
(32, 'Sokoto'),
(33, 'Taraba'),
(34, 'Yobe'),
(35, 'Zamfara'),
(36, 'Federal Capital');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(4) UNSIGNED NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `nin` text NOT NULL COMMENT 'Check, nin is unique and length set to 15',
  `password` text NOT NULL,
  `region_id` int(4) UNSIGNED NOT NULL,
  `status` enum('inactive','active','suspended','deactivate') NOT NULL DEFAULT 'inactive',
  `voted` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `firstname`, `lastname`, `username`, `email`, `nin`, `password`, `region_id`, `status`, `voted`) VALUES
(1, 'Njoku ', 'Okechukwu Valentine', 'bonsoirval', 'bonsoirval@gmail.com', '12345678901', 'f510f2a1fbd959d6371ad59eee832b0a7e0dc6d569acee6278d1c54e7ce90bc0607ff7b4d9daf00e8c2b98c5275414d601274d8dd411a2b62468732eb221e9e40', 0, 'inactive', NULL),
(3, '\'NJOKU\'', '\'VALENTINE\'', '\'bonsoirval\'', '\'bonsoirval@gmail.com\'', '\'\\\'12345671111\\\'\'', '308842a5c77f2a9cb5902061e7c29ca1e1c0a58729ab67ac541c4d11c737ae7ee6299d37b2926597179c6d7103a6f53c5b6e4183cb0ac41efe74c3b6d012f5a2', 0, 'inactive', NULL),
(4, '\'NJOKU\'', '\'NJOKU\'', '\'NJOKU\'', '\'njoku@gmail.com\'', '\'\\\'098123\\\'\'', '2d1f76aaa04a70309e6db10259ec357325ef18d0450f19264230df21e15f84e8efbaf67ad2ee5b7f098f581efd92c616970e4045b9c5a696311248e4e7a3cc54', 0, 'inactive', NULL),
(52, '\'val@val.com\'', '\'val@val.com\'', '\'val@val.com\'', '\'val@val.com\'', '\'\\\'12121\\\'\'', 'fece6166a240b1199ddfa13d13736c5b9f87cc7a9351ab780dec8158d82d2abc191950dd40dc8f065fdd38a11bb0f1225788d8c54beb11950f009c1a91884ba2', 0, 'inactive', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `voter_has_election`
--

CREATE TABLE `voter_has_election` (
  `id` int(11) NOT NULL,
  `voter_id` int(4) UNSIGNED NOT NULL,
  `election_id` int(11) UNSIGNED NOT NULL,
  `status` enum('voted','not voted') DEFAULT 'not voted'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voter_has_election`
--

INSERT INTO `voter_has_election` (`id`, `voter_id`, `election_id`, `status`) VALUES
(1, 3, 1, 'voted'),
(2, 3, 2, 'voted'),
(3, 52, 4, 'not voted'),
(4, 52, 1, 'not voted'),
(5, 52, 2, 'not voted'),
(6, 52, 3, 'not voted');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(4) UNSIGNED NOT NULL,
  `voter_id` int(4) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `election_id` int(10) UNSIGNED NOT NULL,
  `vote_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voter_id`, `candidate_id`, `election_id`, `vote_time`) VALUES
(1, 3, 2, 2, '2023-11-16 18:03:48'),
(2, 3, 3, 1, '2023-11-16 18:03:48'),
(3, 3, 5, 3, '2023-11-16 18:03:48'),
(4, 3, 2, 2, '2023-11-16 22:10:03'),
(5, 3, 1, 1, '2023-11-16 22:10:03'),
(6, 3, 5, 3, '2023-11-16 22:10:03'),
(7, 3, 2, 2, '2023-11-16 22:14:18'),
(8, 3, 1, 1, '2023-11-16 22:14:18'),
(9, 3, 5, 3, '2023-11-16 22:14:18'),
(10, 3, 2, 2, '2023-11-16 22:15:07'),
(11, 3, 1, 1, '2023-11-16 22:15:07'),
(12, 3, 5, 3, '2023-11-16 22:15:07'),
(13, 3, 2, 2, '2023-11-17 10:13:19'),
(14, 3, 1, 1, '2023-11-17 10:13:19'),
(15, 3, 5, 3, '2023-11-17 10:13:19'),
(16, 3, 2, 2, '2023-11-17 11:16:15'),
(17, 3, 1, 1, '2023-11-17 11:16:15'),
(18, 3, 5, 3, '2023-11-17 11:16:15'),
(19, 3, 2, 2, '2023-11-17 11:36:38'),
(20, 3, 1, 1, '2023-11-17 11:36:38'),
(21, 3, 5, 3, '2023-11-17 11:36:38');

-- --------------------------------------------------------

--
-- Table structure for table `vote_count`
--

CREATE TABLE `vote_count` (
  `id` int(10) UNSIGNED NOT NULL,
  `election_id` int(11) NOT NULL DEFAULT '0',
  `candidate_id` int(11) NOT NULL DEFAULT '0',
  `vote_count` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `nin_unique` (`nin`(15)),
  ADD UNIQUE KEY `email` (`email`(20));

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidate_party` (`party_id`),
  ADD KEY `candidate_election` (`election_id`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `election_candidate`
--
ALTER TABLE `election_candidate`
  ADD PRIMARY KEY (`id`,`candidate_id`,`election_id`),
  ADD KEY `fk_voters_has_election_election1_idx` (`election_id`),
  ADD KEY `fk_voters_has_election_voters1_idx` (`candidate_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`lan_id`);

--
-- Indexes for table `loginusers`
--
ALTER TABLE `loginusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `party`
--
ALTER TABLE `party`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `nin_unique` (`nin`(15)),
  ADD UNIQUE KEY `email` (`email`(20));

--
-- Indexes for table `voter_has_election`
--
ALTER TABLE `voter_has_election`
  ADD PRIMARY KEY (`id`,`voter_id`,`election_id`),
  ADD KEY `fk_voters_has_election_election1_idx` (`election_id`),
  ADD KEY `fk_voters_has_election_voters1_idx` (`voter_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote_count`
--
ALTER TABLE `vote_count`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `election_candidate`
--
ALTER TABLE `election_candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `lan_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loginusers`
--
ALTER TABLE `loginusers`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `party`
--
ALTER TABLE `party`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `voter_has_election`
--
ALTER TABLE `voter_has_election`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `vote_count`
--
ALTER TABLE `vote_count`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_election` FOREIGN KEY (`election_id`) REFERENCES `election` (`id`),
  ADD CONSTRAINT `candidate_party` FOREIGN KEY (`party_id`) REFERENCES `party` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
