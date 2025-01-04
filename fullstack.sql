-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 04, 2025 at 07:36 AM
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
-- Database: `fullstack`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievement`
--

CREATE TABLE `achievement` (
  `idachievement` int(11) NOT NULL,
  `idteam` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `achievement`
--

INSERT INTO `achievement` (`idachievement`, `idteam`, `name`, `date`, `description`) VALUES
(3, 4, 'Semi-Finalist 1', '2024-04-24', 'Made it to the semi-finals in Spring Championship'),
(4, 4, 'Quarter-Finalist', '2024-09-02', 'Reached quarter-finals in Autumn Cup'),
(5, 5, 'World Champion', '2024-11-11', 'Winner of the World Finals'),
(6, 1, 'Champion', '2024-08-11', 'Winner of the Summer Showdown'),
(7, 2, 'Finalist', '2024-12-22', 'Reached the final in Winter Clash'),
(8, 3, 'Semi-Finalist', '2024-05-10', 'Made it to the semi-finals in Spring Championship'),
(9, 4, 'Quarter-Finalist', '2024-09-15', 'Reached quarter-finals in Autumn Cup'),
(10, 5, 'World Champion', '2024-11-20', 'Winner of the World Finals'),
(11, 1, 'Champion', '2024-07-18', 'Winner of the Summer Showdown'),
(12, 2, 'Finalist', '2024-12-25', 'Reached the final in Winter Clash'),
(13, 3, 'Semi-Finalist', '2024-04-30', 'Made it to the semi-finals in Spring Championship'),
(14, 4, 'Quarter-Finalist', '2024-09-10', 'Reached quarter-finals in Autumn Cup'),
(15, 5, 'World Champion', '2024-11-15', 'Winner of the World Finals'),
(16, 1, 'Champion', '2024-08-05', 'Winner of the Summer Showdown'),
(17, 2, 'Finalist', '2024-12-18', 'Reached the final in Winter Clash'),
(18, 3, 'Semi-Finalist', '2024-05-12', 'Made it to the semi-finals in Spring Championship'),
(19, 4, 'Quarter-Finalist', '2024-09-20', 'Reached quarter-finals in Autumn Cup'),
(20, 5, 'World Champion', '2024-11-25', 'Winner of the World Finals'),
(21, 1, 'Champion', '2024-07-10', 'Winner of the Summer Showdown'),
(22, 2, 'Finalist', '2024-12-27', 'Reached the final in Winter Clash'),
(23, 3, 'Semi-Finalist', '2024-05-05', 'Made it to the semi-finals in Spring Championship'),
(24, 4, 'Quarter-Finalist', '2024-09-25', 'Reached quarter-finals in Autumn Cup'),
(25, 5, 'World Champion', '2024-11-18', 'Winner of the World Finals'),
(26, 1, 'oi', '2024-10-12', 'iu'),
(27, 1, 'iu', '2024-10-11', 'uy'),
(28, 1, 'ii', '2024-10-11', 'ii'),
(29, 1, 'kk', '2024-10-25', 'jk'),
(30, 1, 'ko', '2024-10-05', 'iu'),
(31, 1, 'jkn', '2024-10-05', 'uygi');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `idevent` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`idevent`, `name`, `date`, `description`) VALUES
(1, 'Summer Showdowns', '2024-07-10', 'A major eSports event for summers'),
(2, 'Winter Clash', '2024-12-15', 'A winter-themed eSports tournament'),
(3, 'Spring Championship', '2024-04-22', 'Annual eSports championship in spring'),
(4, 'Autumn Cup', '2024-09-01', 'A seasonal eSports cup for autumn'),
(5, 'World Finals', '2024-11-10', 'The biggest eSports competition of the year'),
(6, 'New Year Showdown', '2024-01-01', 'A special New Year eSports event'),
(7, 'Summer Invitational', '2024-06-20', 'A summer eSports invitational event'),
(8, 'Winter Brawl', '2024-12-01', 'A brawl-themed winter eSports competition'),
(9, 'Spring Showdown', '2024-04-10', 'A showdown event for spring eSports'),
(10, 'Autumn Clash', '2024-10-15', 'A clash-themed autumn eSports event'),
(11, 'Mid-Year Finals', '2024-07-15', 'A finals event at the midpoint of the year'),
(12, 'Holiday Cups', '2024-12-25', 'A special holiday-themed eSports competition'),
(13, 'Fall Fest', '2024-10-05', 'A fall festival for eSports'),
(14, 'Winter Extravaganza', '2024-12-20', 'An extravagant eSports event in winter'),
(15, 'Summer Smash', '2024-08-01', 'A smashing summer eSports competition'),
(16, 'Spring Slam', '2024-05-01', 'A slam event for eSports in the spring'),
(17, 'Autumn Throwdown', '2024-09-20', 'A throwdown event in autumn for eSports'),
(18, 'Championship Showdown', '2024-11-05', 'A major championship eSports event'),
(19, 'Winter Battle', '2024-12-30', 'A winter-themed battle eSports competition'),
(20, 'Spring Invitational', '2024-04-15', 'A spring invitational eSports event'),
(21, 'ad', '2024-10-11', 'ad');

-- --------------------------------------------------------

--
-- Table structure for table `event_teams`
--

CREATE TABLE `event_teams` (
  `idevent` int(11) NOT NULL,
  `idteam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `event_teams`
--

INSERT INTO `event_teams` (`idevent`, `idteam`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(4, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(4, 18),
(4, 19),
(4, 20),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(5, 7),
(5, 8),
(5, 9),
(5, 10),
(5, 11),
(5, 12),
(5, 13),
(5, 14),
(5, 15),
(5, 16),
(5, 17),
(5, 18),
(5, 19),
(5, 20),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 6),
(6, 7),
(6, 8),
(6, 9),
(6, 10),
(6, 11),
(6, 12),
(6, 13),
(6, 14),
(6, 15),
(6, 16),
(6, 17),
(6, 18),
(6, 19),
(6, 20),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(7, 5),
(7, 6),
(7, 7),
(7, 8),
(7, 9),
(7, 10),
(7, 11),
(7, 12),
(7, 13),
(7, 14),
(7, 15),
(7, 16),
(7, 17),
(7, 18),
(7, 19),
(7, 20),
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(8, 5),
(8, 6),
(8, 7),
(8, 8),
(8, 9),
(8, 10),
(8, 11),
(8, 12),
(8, 13),
(8, 14),
(8, 15),
(8, 16),
(8, 17),
(8, 18),
(8, 19),
(8, 20),
(9, 1),
(9, 2),
(9, 3),
(9, 4),
(9, 5),
(9, 6),
(9, 7),
(9, 8),
(9, 9),
(9, 10),
(9, 11),
(9, 12),
(9, 13),
(9, 14),
(9, 15),
(9, 16),
(9, 17),
(9, 18),
(9, 19),
(9, 20),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(10, 5),
(10, 6),
(10, 7),
(10, 8),
(10, 9),
(10, 10),
(10, 11),
(10, 12),
(10, 13),
(10, 14),
(10, 15),
(10, 16),
(10, 17),
(10, 18),
(10, 19),
(10, 20),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(11, 5),
(11, 6),
(11, 7),
(11, 8),
(11, 9),
(11, 10),
(11, 11),
(11, 12),
(11, 13),
(11, 14),
(11, 15),
(11, 16),
(11, 17),
(11, 18),
(11, 19),
(11, 20),
(12, 1),
(12, 2),
(12, 3),
(12, 4),
(12, 5),
(12, 6),
(12, 7),
(12, 8),
(12, 9),
(12, 10),
(12, 11),
(12, 12),
(12, 13),
(12, 14),
(12, 15),
(12, 16),
(12, 17),
(12, 18),
(12, 19),
(12, 20),
(13, 1),
(13, 2),
(13, 3),
(13, 4),
(13, 5),
(13, 6),
(13, 7),
(13, 8),
(13, 9),
(13, 10),
(13, 11),
(13, 12),
(13, 13),
(13, 14),
(13, 15),
(13, 16),
(13, 17),
(13, 18),
(13, 19),
(13, 20),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(14, 5),
(14, 6),
(14, 7),
(14, 8),
(14, 9),
(14, 10),
(14, 11),
(14, 12),
(14, 13),
(14, 14),
(14, 15),
(14, 16),
(14, 17),
(14, 18),
(14, 19),
(14, 20),
(15, 1),
(15, 2),
(15, 3),
(15, 4),
(15, 5),
(15, 6),
(15, 7),
(15, 8),
(15, 9),
(15, 10),
(15, 11),
(15, 12),
(15, 13),
(15, 14),
(15, 15),
(15, 16),
(15, 17),
(15, 18),
(15, 19),
(15, 20);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `idgame` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`idgame`, `name`, `description`) VALUES
(1, 'League of Legends 1', 'A multiplayer online battle arena (MOBA) game'),
(2, 'Dota 2', 'A popular MOBA game developed by Valve'),
(3, 'Counter-Strike', 'A first-person shooter (FPS) game'),
(4, 'Valorant', 'A tactical shooter developed by Riot Games'),
(5, 'Fortnite', 'A battle royale game with building mechanics'),
(6, 'Apex Legends', 'A free-to-play battle royale game developed by Respawn Entertainment'),
(7, 'PUBG', 'A battle royale game developed by PUBG Corporation'),
(8, 'Overwatch', 'A team-based shooter developed by Blizzard Entertainment'),
(9, 'Call of Duty: Warzone', 'A free-to-play battle royale game in the Call of Duty franchise'),
(10, 'Rocket League', 'A vehicular soccer game developed by Psyonix'),
(11, 'Minecraft', 'A sandbox game where players can build and explore worlds made of blocks'),
(12, 'Genshin Impact', 'An open-world action RPG developed by miHoYo'),
(13, 'FIFA 22', 'A football simulation video game developed by EA Sports'),
(14, 'Cyberpunk 2077', 'An open-world action RPG developed by CD Projekt'),
(15, 'The Witcher 3', 'An open-world RPG developed by CD Projekt'),
(16, 'Among Us', 'A multiplayer social deduction game developed by InnerSloth'),
(17, 'Rainbow Six Siege', 'A tactical shooter developed by Ubisoft'),
(18, 'Destiny 2', 'An online multiplayer first-person shooter developed by Bungie'),
(19, 'StarCraft II', 'A real-time strategy game developed by Blizzard Entertainment'),
(20, 'Hearthstone', 'A free-to-play online digital collectible card game developed by Blizzard Entertainment');

-- --------------------------------------------------------

--
-- Table structure for table `join_proposal`
--

CREATE TABLE `join_proposal` (
  `idjoin_proposal` int(11) NOT NULL,
  `idmember` int(11) NOT NULL,
  `idteam` int(11) NOT NULL,
  `description` varchar(100) DEFAULT 'role preference: support, attacker, dll',
  `status` enum('waiting','approved','rejected') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `join_proposal`
--

INSERT INTO `join_proposal` (`idjoin_proposal`, `idmember`, `idteam`, `description`, `status`) VALUES
(1, 2, 1, 'Main attacker role', 'approved'),
(2, 2, 2, 'Support role', 'approved'),
(3, 2, 3, 'Coordinator role', 'rejected'),
(4, 1, 4, 'Team leader role', 'approved'),
(5, 1, 5, 'Strategist role', 'waiting'),
(6, 3, 1, 'Main attacker role', 'approved'),
(7, 4, 2, 'Support role', 'approved'),
(8, 5, 3, 'Coordinator role', 'waiting'),
(10, 7, 5, 'Strategist role', 'approved'),
(11, 3, 1, 'Main attacker role', 'approved'),
(12, 4, 2, 'Support role', 'approved'),
(13, 5, 3, 'Coordinator role', 'approved'),
(15, 7, 5, 'Strategist role', 'rejected'),
(16, 3, 1, 'Main attacker role', 'approved'),
(17, 4, 2, 'Support role', 'approved'),
(18, 5, 3, 'Coordinator role', 'waiting'),
(20, 7, 5, 'Strategist role', 'waiting'),
(21, 23, 1, 'Leader', 'approved'),
(22, 25, 1, 'Im pro', 'approved'),
(23, 26, 1, 'halo', 'approved'),
(24, 27, 2, 'saya jago', 'approved'),
(25, 27, 1, 'saya jago', 'approved'),
(26, 29, 1, 'halo', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `idmember` int(11) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `profile` enum('admin','member') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`idmember`, `fname`, `lname`, `username`, `password`, `profile`) VALUES
(1, 'John', 'Doe', 'admin_john', 'password123', 'admin'),
(2, 'Jane', 'Smith', 'jane_smith', 'password123', 'admin'),
(3, 'June', 'Ken', 'june_ken', 'password123', 'member'),
(4, 'Alice', 'Doe', 'alice_doe', 'password123', 'member'),
(5, 'ar', 'try', 'ar', '$2y$10$H4XxNfsCF38eQL0ZmepXveehlN.mNHwaxD8B8xGHOhblvbOPXR5Nq', 'admin'),
(7, 'Alice', 'Brown', 'alice_brown', 'password123', 'member'),
(8, 'Bob', 'Green', 'bob_green', 'password123', 'member'),
(9, 'Charlie', 'Blue', 'charlie_blue', 'password123', 'member'),
(10, 'David', 'White', 'david_white', 'password123', 'member'),
(11, 'Emma', 'Black', 'emma_black', 'password123', 'member'),
(12, 'Frank', 'Red', 'frank_red', 'password123', 'member'),
(13, 'Grace', 'Yellow', 'grace_yellow', 'password123', 'member'),
(14, 'Hannah', 'Purple', 'hannah_purple', 'password123', 'member'),
(15, 'Ian', 'Orange', 'ian_orange', 'password123', 'member'),
(16, 'Jack', 'Grey', 'jack_grey', 'password123', 'admin'),
(17, 'Kelly', 'Silver', 'kelly_silver', 'password123', 'member'),
(18, 'Liam', 'Gold', 'liam_gold', '$2y$10$abcdehashedpassword', 'admin'),
(19, 'Mia', 'Bronze', 'mia_bronze', '$2y$10$abcdehashedpassword', 'member'),
(20, 'Noah', 'Platinum', 'noah_platinum', 'password123', 'member'),
(21, 'Olivia', 'Copper', 'olivia_copper', 'password123', 'admin'),
(22, 'bu', 'bu', 'bu', '$2y$10$N/R3qIgpRRrW5N.Ne.lYGeSkJ9b3Z7Qjyt/q99K49TP9vehFKnNJm', 'member'),
(23, 'nesa', 'nesa', 'nesa', '$2y$10$GVfO0rKHry3Lx2RezoCsoOJXIoPOltxQaJOfTW2l7pZFkVOCrw7lO', 'member'),
(24, 'admin', 'admin', 'admin', '$2y$10$X1CDzqpi4xrYUN4KsX4OgOLA8h9bdHeBPvZhG0OH1SZXkomAK8XGi', 'admin'),
(25, 'member', 'member', 'member', '$2y$10$bFEBsr13.Kg0oSGVz/lRneS2WVVCY896TrPa0o90RHHfc6IJxEMhC', 'member'),
(26, 'bp', 'yao', 'bryan', '$2y$10$/P8Cwcyc1kk3fjRj8jqurOwKJQmxdOwgsib4bdG4ACGBCBH5R9wpW', 'member'),
(27, 'cennia', 'lieta', 'cen', '$2y$10$hEXSrL4HrBnL7dAjNbEyreZcMNIfy7VUhlTAMFNdjkOVduJAl1yrW', 'member'),
(28, 'Bryan', 'Porayouw', 'bry', '$2y$10$arVP9QRQ5LSJaXXCdytMZusP9SDaA1r42lchH9/js4tQcOupZ7arO', 'member'),
(29, 'bp', 'a', 'b', '$2y$10$djOHdTN9W9Q4rz1lqwecO.lhm1bZR3YqyRVwNgkpqCU4vqi6UUcfS', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `idteam` int(11) NOT NULL,
  `idgame` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`idteam`, `idgame`, `name`) VALUES
(1, 2, 'Team Alpha 1'),
(2, 2, 'Team Beta'),
(3, 3, 'Team Gamma'),
(4, 4, 'Team Delta'),
(5, 5, 'Team Epsilon'),
(6, 6, 'Team Zeta'),
(7, 7, 'Team Eta'),
(8, 8, 'Team Theta'),
(9, 9, 'Team Iota'),
(10, 10, 'Team Kappa'),
(11, 11, 'Team Lambda'),
(12, 12, 'Team Mu'),
(13, 13, 'Team Nu'),
(14, 14, 'Team Xi'),
(15, 15, 'Team Omicron'),
(16, 16, 'Team Pi'),
(17, 17, 'Team Rho'),
(18, 18, 'Team Sigma'),
(19, 19, 'Team Tau'),
(20, 20, 'Team Upsilon');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `idteam` int(11) NOT NULL,
  `idmember` int(11) NOT NULL,
  `description` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`idteam`, `idmember`, `description`) VALUES
(1, 2, 'Main attacker'),
(1, 3, NULL),
(1, 23, NULL),
(1, 25, NULL),
(1, 26, NULL),
(1, 27, NULL),
(2, 2, 'Support role'),
(2, 4, NULL),
(2, 27, NULL),
(3, 2, 'Tactical coordinator'),
(4, 1, 'Team leader'),
(5, 1, 'Strategist'),
(6, 3, 'Main attacker'),
(7, 4, 'Support role'),
(8, 5, 'Tactical coordinator'),
(10, 7, 'Strategist'),
(11, 8, 'Main attacker'),
(12, 9, 'Support role'),
(13, 10, 'Tactical coordinator'),
(14, 11, 'Team leader'),
(15, 12, 'Strategist'),
(16, 13, 'Main attacker'),
(17, 14, 'Support role'),
(18, 15, 'Tactical coordinator'),
(19, 16, 'Team leader'),
(20, 17, 'Strategist');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievement`
--
ALTER TABLE `achievement`
  ADD PRIMARY KEY (`idachievement`),
  ADD KEY `fk_achievement_team1_idx` (`idteam`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`idevent`);

--
-- Indexes for table `event_teams`
--
ALTER TABLE `event_teams`
  ADD PRIMARY KEY (`idevent`,`idteam`),
  ADD KEY `fk_event_has_team_team1_idx` (`idteam`),
  ADD KEY `fk_event_has_team_event1_idx` (`idevent`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`idgame`);

--
-- Indexes for table `join_proposal`
--
ALTER TABLE `join_proposal`
  ADD PRIMARY KEY (`idjoin_proposal`),
  ADD KEY `fk_join_proposal_member1_idx` (`idmember`),
  ADD KEY `fk_join_proposal_team1_idx` (`idteam`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idmember`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`idteam`),
  ADD KEY `fk_team_game1_idx` (`idgame`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`idteam`,`idmember`),
  ADD KEY `fk_team_has_member_member1_idx` (`idmember`),
  ADD KEY `fk_team_has_member_team_idx` (`idteam`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievement`
--
ALTER TABLE `achievement`
  MODIFY `idachievement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `idevent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `idgame` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `join_proposal`
--
ALTER TABLE `join_proposal`
  MODIFY `idjoin_proposal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `idmember` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `idteam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achievement`
--
ALTER TABLE `achievement`
  ADD CONSTRAINT `fk_achievement_team1` FOREIGN KEY (`idteam`) REFERENCES `team` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_teams`
--
ALTER TABLE `event_teams`
  ADD CONSTRAINT `fk_event_has_team_event1` FOREIGN KEY (`idevent`) REFERENCES `event` (`idevent`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_event_has_team_team1` FOREIGN KEY (`idteam`) REFERENCES `team` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `join_proposal`
--
ALTER TABLE `join_proposal`
  ADD CONSTRAINT `fk_join_proposal_member1` FOREIGN KEY (`idmember`) REFERENCES `member` (`idmember`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_join_proposal_team1` FOREIGN KEY (`idteam`) REFERENCES `team` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `fk_team_game1` FOREIGN KEY (`idgame`) REFERENCES `game` (`idgame`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `team_members`
--
ALTER TABLE `team_members`
  ADD CONSTRAINT `fk_team_has_member_member1` FOREIGN KEY (`idmember`) REFERENCES `member` (`idmember`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_team_has_member_team` FOREIGN KEY (`idteam`) REFERENCES `team` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
