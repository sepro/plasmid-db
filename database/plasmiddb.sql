-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 03 dec 2014 om 15:08
-- Serverversie: 5.6.12-log
-- PHP-versie: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `plasmiddb`
--
CREATE DATABASE IF NOT EXISTS `plasmiddb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `plasmiddb`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inserts`
--

CREATE TABLE IF NOT EXISTS `inserts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `sequence` text NOT NULL,
  `comment` tinytext NOT NULL,
  `plasmid_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `inserts_ibfk_1` (`plasmid_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text NOT NULL,
  `building` tinytext NOT NULL,
  `room` tinytext NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(50) NOT NULL,
  `possible_value` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `plasmids`
--

CREATE TABLE IF NOT EXISTS `plasmids` (
  `plasmid_id` int(11) NOT NULL AUTO_INCREMENT,
  `vector_type` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `creator` int(11) NOT NULL,
  `description` text NOT NULL,
  `sequence` longtext NOT NULL,
  `bacterial_resistance` varchar(50) NOT NULL,
  `plant_resistance` varchar(50) NOT NULL,
  `pubmed_id` int(11) DEFAULT NULL,
  `website` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_backbone` tinyint(1) NOT NULL DEFAULT '0',
  `backbone` int(11) DEFAULT NULL,
  `genbank` longtext,
  `embl` longtext,
  PRIMARY KEY (`plasmid_id`),
  UNIQUE KEY `name` (`name`),
  KEY `plasmids_ibfk_1` (`creator`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `plasmid_location`
--

CREATE TABLE IF NOT EXISTS `plasmid_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plasmid_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `comment` varchar(50) NOT NULL,
  `storage_type` varchar(50) NOT NULL,
  `critically_low` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `plasmid_location_ibfk_1` (`location_id`),
  KEY `plasmid_location_ibfk_2` (`plasmid_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `location` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `account` enum('admin','user','guest','pending') NOT NULL DEFAULT 'guest',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reset_key` text NOT NULL,
  `reset_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_location` (`location`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `view_plasmids`
--
CREATE TABLE IF NOT EXISTS `view_plasmids` (
`plasmid_id` int(11)
,`vector_type` varchar(50)
,`name` varchar(50)
,`creator` int(11)
,`description` text
,`sequence` longtext
,`bacterial_resistance` varchar(50)
,`plant_resistance` varchar(50)
,`pubmed_id` int(11)
,`website` varchar(100)
,`created` datetime
,`backbone` int(11)
,`label` varchar(50)
,`comment` varchar(50)
,`storage_type` varchar(50)
,`critically_low` tinyint(1)
,`location_id` int(11)
,`address` text
,`building` tinytext
,`room` tinytext
,`username` varchar(20)
);
-- --------------------------------------------------------

--
-- Structuur voor de view `view_plasmids`
--
DROP TABLE IF EXISTS `view_plasmids`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_plasmids` AS select `b`.`plasmid_id` AS `plasmid_id`,`b`.`vector_type` AS `vector_type`,`b`.`name` AS `name`,`b`.`creator` AS `creator`,`b`.`description` AS `description`,`b`.`sequence` AS `sequence`,`b`.`bacterial_resistance` AS `bacterial_resistance`,`b`.`plant_resistance` AS `plant_resistance`,`b`.`pubmed_id` AS `pubmed_id`,`b`.`website` AS `website`,`b`.`created` AS `created`,`b`.`backbone` AS `backbone`,`a`.`label` AS `label`,`a`.`comment` AS `comment`,`a`.`storage_type` AS `storage_type`,`a`.`critically_low` AS `critically_low`,`c`.`location_id` AS `location_id`,`c`.`address` AS `address`,`c`.`building` AS `building`,`c`.`room` AS `room`,`d`.`username` AS `username` from (((`plasmid_location` `a` left join `plasmids` `b` on((`a`.`plasmid_id` = `b`.`plasmid_id`))) left join `locations` `c` on((`a`.`location_id` = `c`.`location_id`))) left join `users` `d` on((`b`.`creator` = `d`.`user_id`)));

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `inserts`
--
ALTER TABLE `inserts`
  ADD CONSTRAINT `inserts_ibfk_1` FOREIGN KEY (`plasmid_id`) REFERENCES `plasmids` (`plasmid_id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `plasmids`
--
ALTER TABLE `plasmids`
  ADD CONSTRAINT `plasmids_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`user_id`);

--
-- Beperkingen voor tabel `plasmid_location`
--
ALTER TABLE `plasmid_location`
  ADD CONSTRAINT `plasmid_location_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`),
  ADD CONSTRAINT `plasmid_location_ibfk_2` FOREIGN KEY (`plasmid_id`) REFERENCES `plasmids` (`plasmid_id`);

--
-- Beperkingen voor tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`location`) REFERENCES `locations` (`location_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
