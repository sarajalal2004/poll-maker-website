-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2023 at 04:26 AM
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
-- Database: `pollmaker`
--

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `cID` int(11) NOT NULL,
  `choice` varchar(50) NOT NULL,
  `qID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`cID`, `choice`, `qID`) VALUES
(1, 'Red', 1),
(2, 'Yellow', 1),
(3, 'Orange', 1),
(4, 'Green', 1),
(5, 'Black', 1),
(6, 'Pink', 1),
(7, 'Banana', 2),
(8, 'Apple', 2),
(9, 'Orange', 2),
(10, 'Pineapple', 2),
(11, 'Excellent Grade like A, A-', 3),
(12, 'A Good grade like B+, B, B-', 3),
(13, 'A Bad Grade like C+, C', 3),
(14, 'A Fail Grade (F)', 3),
(15, 'On Next Week Wednesday!', 4),
(16, 'This Week tuesday ', 4),
(17, 'Next Weekend (on Friday)', 4),
(18, 'Not gonna join the game', 4),
(19, 'Pepperoni ', 5),
(20, 'Just cheese ', 5),
(21, 'Pineapple ', 5),
(22, 'Mushrooms Only', 5),
(23, 'Kittens ', 6),
(24, 'Puppies ', 6),
(25, 'Rabbits', 6),
(26, 'Parrots :)', 6),
(27, 'A bar of Chocolate', 7),
(28, 'Your favorite drink', 7),
(29, 'Your Smart phone', 7),
(30, 'TV Series', 7),
(31, 'I will keep Instagram', 8),
(32, 'I will keep Snapchat', 8),
(33, 'I can\'t without Twitter', 8),
(34, 'I will keep TikTok', 8),
(35, 'I can live without all of them', 8),
(36, 'Five more minutes', 9),
(37, 'On my way!', 9),
(38, ' I’m listening :-)', 9),
(39, ' I didn’t see your text ', 9),
(40, 'I have no idea', 9),
(41, 'Peanut Butter', 10),
(42, 'Fruit', 10),
(43, 'Hazelnut', 10),
(44, 'More CHOCOLATE!!!!!!', 10),
(45, 'Monkeys', 11),
(46, 'Giraffes', 11),
(47, 'Dogs', 11),
(48, 'Birds', 11),
(49, 'With a cup of coffee ', 12),
(50, 'With a nice warm shower', 12),
(51, 'With a snooze button', 12),
(52, 'Sleeep!', 12),
(53, 'Browsing the internet  ', 13),
(54, 'Cleaning the house', 13),
(55, 'Watching TV ', 13),
(56, 'Eating snacks', 13),
(57, 'Turn invisible for 0.5 seconds ever', 14),
(58, 'Create a tiny spark every time you snap', 14),
(59, 'make plants grow 1mm taller ', 14);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `qID` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `endDate` date NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qID`, `question`, `endDate`, `uid`) VALUES
(1, 'What is your favorite color?', '2000-01-02', 1),
(2, 'what is your favorite fruit?', '0000-00-00', 1),
(3, 'What grade do you expect to have in ITCS333?', '2024-01-17', 1),
(4, 'In which day we can play football ?????', '2023-12-28', 1),
(5, 'What’s the best pizza topping?', '2022-03-05', 4),
(6, 'What’s the cutest animal of this list?', '0000-00-00', 4),
(7, 'Which of these would be the hardest to live without?', '2024-07-15', 4),
(8, ' If you had to scrap all social media except one, which would you keep?', '0000-00-00', 4),
(9, 'Which lie do you tell most often?', '2024-02-29', 4),
(10, 'What pairs best with chocolate?', '2020-05-06', 4),
(11, 'If animals could talk, which species do you think would be the most annoying?', '2023-12-30', 3),
(12, 'What\'s the best way to start a day?', '2023-11-28', 3),
(13, 'What\'s your favourite way to procrastinate? ', '0000-00-00', 3),
(14, 'If you could have any superpower, but it had to be completely useless, what would it be?', '2023-12-28', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `email`, `password`) VALUES
(1, 'Fatima', 'fatima@gmail.com', '$2y$10$c6SiSDPP2CA3aLKM.LFf7uptVaPvHsmsqo0.Z//xrp.n/RZLcVSkS'),
(3, 'Mohd', 'mohd@icloud.co', '$2y$10$wrOQXLxUEPQkACoptPgYKOZZXIawgaWTJqhdIN2./wNrolDhbXor6'),
(4, 'Sara', 'sara@outlook.com', '$2y$10$CYOyqYJDIBUnY1YexQFS.uc6KCMrUpzr/iM9tqBvcjhXwq1MmbTB2'),
(5, 'Bayan', 'bayan11@email.bh', '$2y$10$re2la5z4eMVEdfqzOiq3xOMW285C16XAn68S50zdQALoxkIwiA0K2'),
(6, 'Zainab', 'zainab@uob.bh', '$2y$10$7UGhS/Upei7Z/JExoUnABenPr3xfE1eXfy0A9yiR1rOoTwC7Ethn6'),
(7, 'Ali', 'ali33@email.com', '$2y$10$QyQDFsaDZL8jOp17brUlOevG77SOc93me23arcj8/OnJ2XGN4YvkG'),
(8, 'Huda', 'huda@gmail.fr', '$2y$10$Iyl75t6Txqbmn5kcXAAFk.mTJLBgBJpfFekQsXk5arn5Ux1yFSh8S');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `vID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `qID` int(11) NOT NULL,
  `cID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`vID`, `uID`, `qID`, `cID`) VALUES
(1, 3, 14, 58),
(2, 3, 1, 3),
(3, 3, 2, 7),
(4, 3, 11, 47),
(5, 3, 12, 52),
(6, 3, 3, 13),
(7, 3, 13, 55),
(8, 3, 10, 42),
(9, 3, 4, 16),
(10, 3, 6, 23),
(11, 3, 9, 39),
(12, 3, 8, 33),
(13, 3, 5, 19),
(14, 5, 1, 3),
(15, 5, 12, 50),
(16, 5, 13, 56),
(17, 5, 2, 7),
(18, 5, 8, 32),
(19, 5, 9, 38),
(20, 5, 5, 19),
(21, 5, 14, 58),
(22, 1, 1, 2),
(23, 1, 5, 21),
(24, 1, 3, 11),
(25, 1, 10, 41),
(26, 1, 12, 52),
(27, 1, 13, 55),
(28, 1, 14, 57),
(29, 1, 2, 9),
(30, 6, 1, 2),
(31, 6, 5, 21),
(32, 6, 3, 11),
(33, 6, 2, 9),
(34, 6, 7, 27),
(35, 6, 6, 25),
(36, 6, 12, 51),
(37, 6, 13, 55),
(38, 6, 14, 59),
(39, 6, 10, 41),
(40, 6, 8, 34),
(41, 6, 11, 46),
(42, 6, 9, 37),
(43, 7, 1, 4),
(44, 7, 2, 10),
(45, 7, 3, 14),
(46, 7, 4, 17),
(47, 7, 5, 19),
(48, 7, 6, 26),
(49, 7, 8, 34),
(50, 7, 10, 42),
(51, 7, 13, 55),
(52, 7, 12, 49),
(53, 7, 11, 47),
(54, 7, 14, 59),
(55, 8, 6, 26),
(56, 8, 7, 29),
(57, 8, 13, 53),
(58, 8, 11, 45),
(59, 8, 8, 34),
(60, 8, 3, 13),
(61, 8, 9, 36);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`cID`),
  ADD KEY `qID` (`qID`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qID`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`vID`),
  ADD KEY `uID` (`uID`),
  ADD KEY `qID` (`qID`),
  ADD KEY `cID` (`cID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `choices`
--
ALTER TABLE `choices`
  MODIFY `cID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `vID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `choices`
--
ALTER TABLE `choices`
  ADD CONSTRAINT `choices_ibfk_1` FOREIGN KEY (`qID`) REFERENCES `questions` (`qID`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`uID`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`qID`) REFERENCES `questions` (`qID`),
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`cID`) REFERENCES `choices` (`cID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
