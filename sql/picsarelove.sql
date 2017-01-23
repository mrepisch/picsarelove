-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 23. Jan 2017 um 08:26
-- Server-Version: 10.1.19-MariaDB
-- PHP-Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `picsarelove`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`) VALUES
(1, 'Lustig'),
(2, 'Cool'),
(3, 'Tiere'),
(4, 'Games'),
(5, 'Sport');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `f_picID` int(11) NOT NULL,
  `f_userID` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `comments`
--

INSERT INTO `comments` (`commentID`, `f_picID`, `f_userID`, `text`) VALUES
(1, 26, 4, 'sad');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pictures`
--

CREATE TABLE `pictures` (
  `picID` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `f_userID` int(11) NOT NULL,
  `f_categoryID` int(11) NOT NULL,
  `imagePath` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `pictures`
--

INSERT INTO `pictures` (`picID`, `title`, `f_userID`, `f_categoryID`, `imagePath`) VALUES
(26, 'Tulpen', 4, 2, 'pictures/587ce16677df0.jpg'),
(27, 'Pingu', 4, 3, 'pictures/587ce174e5995.jpg'),
(28, '1', 7, 4, 'pictures/5885acd13e4c3.jpg'),
(29, '2', 7, 3, 'pictures/5885acd8cfc82.jpg'),
(30, '3', 7, 3, 'pictures/5885ace0b6ac1.jpg'),
(31, '5', 7, 2, 'pictures/5885ace8b28a6.jpg'),
(32, 'serfds', 7, 2, 'pictures/5885afe27f624.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `privileges` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`userID`, `userName`, `password`, `privileges`) VALUES
(1, 'petar.barisic2002@gmail.com', '$2y$10$hzeEOdlnaUScSlsWMsWsu.8qLJRfFwEdYm/OqpooEr2.37gxtYXye', 1),
(4, 'petar@gmail.com', '$2y$10$mbqQgc9kbuiGbBEDlp55su.UbdyJOaoWi1hyY7940m8eOCXP5HVC6', 1),
(5, 'hallo@gmail.com', '$2y$10$4IJcQxtNYdCmKb4iOX17qenmwRuNrBTPIISbQBe6qQzbDTmKemw52', 1),
(6, 'hullu@gmail.com', '$2y$10$5bgoSYxPtlBBHlHcJZYIbOqa4CqfSSNZ6lPcBHHiICFVU9MH/IOmC', 1),
(7, 'putru@gmeil.com', '$2y$10$kRKDhlSj1AEAUNTkXRITqeDGo6X.SuKSmlGNxefjLoAs23soA802K', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indizes für die Tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `userID` (`f_userID`);

--
-- Indizes für die Tabelle `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`picID`),
  ADD UNIQUE KEY `picID` (`picID`),
  ADD UNIQUE KEY `picID_2` (`picID`),
  ADD KEY `categoryID` (`f_categoryID`),
  ADD KEY `p_userID` (`f_userID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT für Tabelle `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `pictures`
--
ALTER TABLE `pictures`
  MODIFY `picID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `userID` FOREIGN KEY (`f_userID`) REFERENCES `user` (`userID`);

--
-- Constraints der Tabelle `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `categoryID` FOREIGN KEY (`f_categoryID`) REFERENCES `categories` (`categoryID`),
  ADD CONSTRAINT `p_userID` FOREIGN KEY (`f_userID`) REFERENCES `user` (`userID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
