-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2014 at 04:28 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `plasmiddb`
--
CREATE DATABASE IF NOT EXISTS `plasmiddb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `plasmiddb`;

-- --------------------------------------------------------

--
-- Table structure for table `inserts`
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

--
-- Dumping data for table `inserts`
--

INSERT INTO `inserts` (`id`, `name`, `sequence`, `comment`, `plasmid_id`) VALUES
(8, 'First insert 2', 'Test ', 'sdf', 48);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text NOT NULL,
  `building` tinytext NOT NULL,
  `room` tinytext NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `address`, `building`, `room`) VALUES
(1, 'Am Mühlenberg 1\r\n14476 Potsdam\r\nGermany\r\n', 'Max-Planck-Institute for Molecular Plant Physiology', '1.111'),
(2, 'Am Mühlenberg 1\r\n14476 Potsdam\r\nGerman', 'Max-Planck-Institute for Molecular Plant Physiology', '0.257'),
(3, 'Am Mühlenberg 1\r\n14476 Potsdam\r\nGermany', 'Max-Planck-Institute for Molecular Plant Physiology', 'Big Office 1.0G'),
(4, 'Am Mühlenberg 1\r\n14476 Potsdam\r\nGermany', 'Max-Planck-Institute for Molecular Plant Physiology', 'Big Office EG'),
(5, 'Am Mühlenberg 1\r\n14476 Potsdam\r\nGermany', 'Max-Planck-Institute for Molecular Plant Physiology', '0.231'),
(6, 'Am Mühlenberg 1\r\n14476 Potsdam\r\nGermany', 'Max-Planck-Institute for Molecular Plant Physiology', '0.238'),
(7, 'Am Mühlenberg 1\r\n14476 Potsdam\r\nGermany', 'Max-Planck-Institute for Molecular Plant Physiology', '0.240');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(50) NOT NULL,
  `possible_value` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_name`, `possible_value`) VALUES
(1, 'vector_type', 'ECO'),
(2, 'vector_type', 'SCE'),
(3, 'vector_type', 'PLA'),
(4, 'vector_type', 'IVF'),
(5, 'bacterial_resistance', 'None'),
(6, 'bacterial_resistance', 'Kanamycin'),
(7, 'plant_resistance', 'None'),
(8, 'plant_resistance', 'Basta'),
(9, 'storage_type', 'DNA'),
(10, 'storage_type', 'GlycCult'),
(11, 'bacterial_resistance', 'Ampicillin'),
(12, 'bacterial_resistance', 'Other'),
(13, 'bacterial_resistance', 'Carbenicillin'),
(14, 'bacterial_resistance', 'Chloramphenicol'),
(15, 'bacterial_resistance', 'Gentamycin'),
(16, 'bacterial_resistance', 'Hygromycin'),
(17, 'bacterial_resistance', 'Spectinomycin'),
(18, 'bacterial_resistance', 'Streptomycin'),
(19, 'bacterial_resistance', 'Tetracyclin'),
(20, 'plant_resistance', 'Geneticin 418 (G418)'),
(21, 'plant_resistance', 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `plasmids`
--

CREATE TABLE IF NOT EXISTS `plasmids` (
  `plasmid_id` int(11) NOT NULL AUTO_INCREMENT,
  `vector_type` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `creator` int(11) NOT NULL,
  `description` text NOT NULL,
  `sequence` text NOT NULL,
  `bacterial_resistance` varchar(50) NOT NULL,
  `plant_resistance` varchar(50) NOT NULL,
  `pubmed_id` int(11) DEFAULT NULL,
  `website` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_backbone` tinyint(1) NOT NULL DEFAULT '0',
  `backbone` int(11) DEFAULT NULL,
  PRIMARY KEY (`plasmid_id`),
  UNIQUE KEY `name` (`name`),
  KEY `plasmids_ibfk_1` (`creator`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `plasmids`
--

INSERT INTO `plasmids` (`plasmid_id`, `vector_type`, `name`, `creator`, `description`, `sequence`, `bacterial_resistance`, `plant_resistance`, `pubmed_id`, `website`, `created`, `is_backbone`, `backbone`) VALUES
(1, 'ECO', 'pDEST24', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ante nunc, viverra at purus sit amet, aliquet tristique magna. Sed non tempor lacus. Integer ac dolor at quam bibendum suscipit. Vivamus sed dolor tincidunt, adipiscing eros non, condimentum velit. Maecenas aliquet mi ut enim pulvinar, et euismod nulla porttitor. Suspendisse at erat scelerisque, iaculis risus in, rhoncus nunc. Cras id lacus ac urna sollicitudin tempus in in est. Ut tincidunt dolor leo, vitae porttitor quam lobortis in.\r\n\r\nMaecenas id massa non diam luctus facilisis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque non venenatis risus. Morbi blandit dui ligula, ut vehicula nulla sodales vel. Nulla augue purus, pellentesque at velit sed, adipiscing iaculis sapien. Praesent enim sapien, venenatis nec luctus ac, sodales in odio. Pellentesque commodo justo nec tellus molestie elementum. Suspendisse suscipit ultricies dui, eget porta tortor condimentum et. Vestibulum vel accumsan diam. Sed eget massa consectetur, vehicula velit ut, cursus enim. Nullam facilisis, mi nec condimentum viverra, nunc neque pellentesque quam, vel ornare nisl tortor at lacus. Vestibulum a lorem enim. Duis rhoncus elementum dui nec euismod. ', 'ATCGAGATCTCGATCCCGCGAAATTAATACGACTCACTATAGGGAGACCACAACGGTTTCCCTCTAGATCACAAGTTTGT\r\nACAAAAAAGCTGAACGAGAAACGTAAAATGATATAAATATCAATATATTAAATTAGATTTTGCATAAAAAACAGACTACA\r\nTAATACTGTAAAACACAACATATCCAGTCACTATGGCGGCCGCATTAGGCACCCCAGGCTTTACACTTTATGCTTCCGGC\r\nTCGTATAATGTGTGGATTTTGAGTTAGGATCCGGCGAGATTTTCAGGAGCTAAGGAAGCTAAAATGGAGAAAAAAATCAC\r\nTGGATATACCACCGTTGATATATCCCAATGGCATCGTAAAGAACATTTTGAGGCATTTCAGTCAGTTGCTCAATGTACCT\r\nATAACCAGACCGTTCAGCTGGATATTACGGCCTTTTTAAAGACCGTAAAGAAAAATAAGCACAAGTTTTATCCGGCCTTT\r\nATTCACATTCTTGCCCGCCTGATGAATGCTCATCCGGAATTCCGTATGGCAATGAAAGACGGTGAGCTGGTGATATGGGA\r\nTAGTGTTCACCCTTGTTACACCGTTTTCCATGAGCAAACTGAAACGTTTTCATCGCTCTGGAGTGAATACCACGACGATT\r\nTCCGGCAGTTTCTACACATATATTCGCAAGATGTGGCGTGTTACGGTGAAAACCTGGCCTATTTCCCTAAAGGGTTTATT\r\nGAGAATATGTTTTTCGTCTCAGCCAATCCCTGGGTGAGTTTCACCAGTTTTGATTTAAACGTGGCCAATATGGACAACTT\r\nCTTCGCCCCCGTTTTCACCATGGGCAAATATTATACGCAAGGCGACAAGGTGCTGATGCCGCTGGCGATTCAGGTTCATC\r\nATGCCGTCTGTGATGGCTTCCATGTCGGCAGAATGCTTAATGAATTACAACAGTACTGCGATGAGTGGCAGGGCGGGGCG\r\nTAAACGCGTGGATCCGGCTTACTAAAAGCCAGATAACAGTATGCGTATTTGCGCGCTGATTTTTGCGGTATAAGAATATA\r\nTACTGATATGTATACCCGAAGTATGTCAAAAAGAGGTGTGCTATGAAGCAGCGTATTACAGTGACAGTTGACAGCGACAG\r\nCTATCAGTTGCTCAAGGCATATATGATGTCAATATCTCCGGTCTGGTAAGCACAACCATGCAGAATGAAGCCCGTCGTCT\r\nGCGTGCCGAACGCTGGAAAGCGGAAAATCAGGAAGGGATGGCTGAGGTCGCCCGGTTTATTGAAATGAACGGCTCTTTTG\r\nCTGACGAGAACAGGGACTGGTGAAATGCAGTTTAAGGTTTACACCTATAAAAGAGAGAGCCGTTATCGTCTGTTTGTGGA\r\nTGTACAGAGTGATATTATTGACACGCCCGGGCGACGGATGGTGATCCCCCTGGCCAGTGCACGTCTGCTGTCAGATAAAG\r\nTCTCCCGTGAACTTTACCCGGTGGTGCATATCGGGGATGAAAGCTGGCGCATGATGACCACCGATATGGCCAGTGTGCCG\r\nGTCTCCGTTATCGGGGAAGAAGTGGCTGATCTCAGCCACCGCGAAAATGACATCAAAAACGCCATTAACCTGATGTTCTG\r\nGGGAATATAAATGTCAGGCTCCCTTATACACAGCCAGTCTGCAGGTCGACCATAGTGACTGGATATGTTGTGTTTTACAG\r\nTATTATGTAGTCTGTTTTTTATGCAAAATCTAATTTAATATATTGATATTTATATCATTTTACGTTTCTCGTTCAGCTTT\r\nCTTGTACAAAGTGGTGATTATGTCCCCTATACTAGGTTATTGGAAAATTAAGGGCCTTGTGCAACCCACTCGACTTCTTT\r\nTGGAATATCTTGAAGAAAAATATGAAGAGCATTTGTATGAGCGCGATGAAGGTGATAAATGGCGAAACAAAAAGTTTGAA\r\nTTGGGTTTGGAGTTTCCCAATCTTCCTTATTATATTGATGGTGATGTTAAATTAACACAGTCTATGGCCATCATACGTTA\r\nTATAGCTGACAAGCACAACATGTTGGGTGGTTGTCCAAAAGAGCGTGCAGAGATTTCAATGCTTGAAGGAGCGGTTTTGG\r\nATATTAGATACGGTGTTTCGAGAATTGCATATAGTAAAGACTTTGAAACTCTCAAAGTTGATTTTCTTAGCAAGCTACCT\r\nGAAATGCTGAAAATGTTCGAAGATCGTTTATGTCATAAAACATATTTAAATGGTGATCATGTAACCCATCCTGACTTCAT\r\nGTTGTATGACGCTCTTGATGTTGTTTTATACATGGACCCAATGTGCCTGGATGCGTTCCCAAAATTAGTTTGTTTTAAAA\r\nAACGTATTGAAGCTATCCCACAAATTGATAAGTACTTGAAATCCAGCAAGTATATAGCATGGCCTTTGCAGGGCTGGCAA\r\nGCCACGTTTGGTGGTGGCGACCATCCTCCAAAATCGGATCTGGTTCCGCGTCCATGGGGATCCGGCTGCTAACAAAGCCC\r\nGAAAGGAAGCTGAGTTGGCTGCTGCCACCGCTGAGCAATAACTAGCATAACCCCTTGGGGCCTCTAAACGGGTCTTGAGG\r\nGGTTTTTTGCTGAAAGGAGGAACTATATCCGGATATCCACAGGACGGGTGTGGTCGCCATGATCGCGTAGTCGATAGTGG\r\nCTCCAAGTAGCGAAGCGAGCAGGACTGGGCGGCGGCCAAAGCGGTCGGACAGTGCTCCGAGAACGGGTGCGCATAGAAAT\r\nTGCATCAACGCATATAGCGCTAGCAGCACGCCATAGTGACTGGCGATGCTGTCGGAATGGACGATATCCCGCAAGAGGCC\r\nCGGCAGTACCGGCATAACCAAGCCTATGCCTACAGCATCCAGGGTGACGGTGCCGAGGATGACGATGAGCGCATTGTTAG\r\nATTTCATACACGGTGCCTGACTGCGTTAGCAATTTAACTGTGATAAACTACCGCATTAAAGCTTATCGATGATAAGCTGT\r\nCAAACATGAGAATTCTTGAAGACGAAAGGGCCTCGTGATACGCCTATTTTTATAGGTTAATGTCATGATAATAATGGTTT\r\nCTTAGACGTCAGGTGGCACTTTTCGGGGAAATGTGCGCGGAACCCCTATTTGTTTATTTTTCTAAATACATTCAAATATG\r\nTATCCGCTCATGAGACAATAACCCTGATAAATGCTTCAATAATATTGAAAAAGGAAGAGTATGAGTATTCAACATTTCCG\r\nTGTCGCCCTTATTCCCTTTTTTGCGGCATTTTGCCTTCCTGTTTTTGCTCACCCAGAAACGCTGGTGAAAGTAAAAGATG\r\nCTGAAGATCAGTTGGGTGCACGAGTGGGTTACATCGAACTGGATCTCAACAGCGGTAAGATCCTTGAGAGTTTTCGCCCC\r\nGAAGAACGTTTTCCAATGATGAGCACTTTTAAAGTTCTGCTATGTGGCGCGGTATTATCCCGTGTTGACGCCGGGCAAGA\r\nGCAACTCGGTCGCCGCATACACTATTCTCAGAATGACTTGGTTGAGTACTCACCAGTCACAGAAAAGCATCTTACGGATG\r\nGCATGACAGTAAGAGAATTATGCAGTGCTGCCATAACCATGAGTGATAACACTGCGGCCAACTTACTTCTGACAACGATC\r\nGGAGGACCGAAGGAGCTAACCGCTTTTTTGCACAACATGGGGGATCATGTAACTCGCCTTGATCGTTGGGAACCGGAGCT\r\nGAATGAAGCCATACCAAACGACGAGCGTGACACCACGATGCCTGCAGCAATGGCAACAACGTTGCGCAAACTATTAACTG\r\nGCGAACTACTTACTCTAGCTTCCCGGCAACAATTAATAGACTGGATGGAGGCGGATAAAGTTGCAGGACCACTTCTGCGC\r\nTCGGCCCTTCCGGCTGGCTGGTTTATTGCTGATAAATCTGGAGCCGGTGAGCGTGGGTCTCGCGGTATCATTGCAGCACT\r\nGGGGCCAGATGGTAAGCCCTCCCGTATCGTAGTTATCTACACGACGGGGAGTCAGGCAACTATGGATGAACGAAATAGAC\r\nAGATCGCTGAGATAGGTGCCTCACTGATTAAGCATTGGTAACTGTCAGACCAAGTTTACTCATATATACTTTAGATTGAT\r\nTTAAAACTTCATTTTTAATTTAAAAGGATCTAGGTGAAGATCCTTTTTGATAATCTCATGACCAAAATCCCTTAACGTGA\r\nGTTTTCGTTCCACTGAGCGTCAGACCCCGTAGAAAAGATCAAAGGATCTTCTTGAGATCCTTTTTTTCTGCGCGTAATCT\r\nGCTGCTTGCAAACAAAAAAACCACCGCTACCAGCGGTGGTTTGTTTGCCGGATCAAGAGCTACCAACTCTTTTTCCGAAG\r\nGTAACTGGCTTCAGCAGAGCGCAGATACCAAATACTGTCCTTCTAGTGTAGCCGTAGTTAGGCCACCACTTCAAGAACTC\r\nTGTAGCACCGCCTACATACCTCGCTCTGCTAATCCTGTTACCAGTGGCTGCTGCCAGTGGCGATAAGTCGTGTCTTACCG\r\nGGTTGGACTCAAGACGATAGTTACCGGATAAGGCGCAGCGGTCGGGCTGAACGGGGGGTTCGTGCACACAGCCCAGCTTG\r\nGAGCGAACGACCTACACCGAACTGAGATACCTACAGCGTGAGCTATGAGAAAGCGCCACGCTTCCCGAAGGGAGAAAGGC\r\nGGACAGGTATCCGGTAAGCGGCAGGGTCGGAACAGGAGAGCGCACGAGGGAGCTTCCAGGGGGAAACGCCTGGTATCTTT\r\nATAGTCCTGTCGGGTTTCGCCACCTCTGACTTGAGCGTCGATTTTTGTGATGCTCGTCAGGGGGGCGGAGCCTATGGAAA\r\nAACGCCAGCAACGCGGCCTTTTTACGGTTCCTGGCCTTTTGCTGGCCTTTTGCTCACATGTTCTTTCCTGCGTTATCCCC\r\nTGATTCTGTGGATAACCGTATTACCGCCTTTGAGTGAGCTGATACCGCTCGCCGCAGCCGAACGACCGAGCGCAGCGAGT\r\nCAGTGAGCGAGGAAGCGGAAGAGCGCCTGATGCGGTATTTTCTCCTTACGCATCTGTGCGGTATTTCACACCGCATATAT\r\nGGTGCACTCTCAGTACAATCTGCTCTGATGCCGCATAGTTAAGCCAGTATACACTCCGCTATCGCTACGTGACTGGGTCA\r\nTGGCTGCGCCCCGACACCCGCCAACACCCGCTGACGCGCCCTGACGGGCTTGTCTGCTCCCGGCATCCGCTTACAGACAA\r\nGCTGTGACCGTCTCCGGGAGCTGCATGTGTCAGAGGTTTTCACCGTCATCACCGAAACGCGCGAGGCAGCTGCGGTAAAG\r\nCTCATCAGCGTGGTCGTGAAGCGATTCACAGATGTCTGCCTGTTCATCCGCGTCCAGCTCGTTGAGTTTCTCCAGAAGCG\r\nTTAATGTCTGGCTTCTGATAAAGCGGGCCATGTTAAGGGCGGTTTTTTCCTGTTTGGTCACTGATGCCTCCGTGTAAGGG\r\nGGATTTCTGTTCATGGGGGTAATGATACCGATGAAACGAGAGAGGATGCTCACGATACGGGTTACTGATGATGAACATGC\r\nCCGGTTACTGGAACGTTGTGAGGGTAAACAACTGGCGGTATGGATGCGGCGGGACCAGAGAAAAATCACTCAGGGTCAAT\r\nGCCAGCGCTTCGTTAATACAGATGTAGGTGTTCCACAGGGTAGCCAGCAGCATCCTGCGATGCAGATCCGGAACATAATG\r\nGTGCAGGGCGCTGACTTCCGCGTTTCCAGACTTTACGAAACACGGAAACCGAAGACCATTCATGTTGTTGCTCAGGTCGC\r\nAGACGTTTTGCAGCAGCAGTCGCTTCACGTTCGCTCGCGTATCGGTGATTCATTCTGCTAACCAGTAAGGCAACCCCGCC\r\nAGCCTAGCCGGGTCCTCAACGACAGGAGCACGATCATGCGCACCCGTGGCCAGGACCCAACGCTGCCCGAGATGCGCCGC\r\nGTGCGGCTGCTGGAGATGGCGGACGCGATGGATATGTTCTGCCAAGGGTTGGTTTGCGCATTCACAGTTCTCCGCAAGAA\r\nTTGATTGGCTCCAATTCTTGGAGTGGTGAATCCGTTAGCGAGGTGCCGCCGGCTTCCATTCAGGTCGAGGTGGCCCGGCT\r\nCCATGCACCGCGACGCAACGCGGGGAGGCAGACAAGGTATAGGGCGGCGCCTACAATCCATGCCAACCCGTTCCATGTGC\r\nTCGCCGAGGCGGCATAAATCGCCGTGACGATCAGCGGTCCAGTGATCGAAGTTAGGCTGGTAAGAGCCGCGAGCGATCCT\r\nTGAAGCTGTCCCTGATGGTCGTCATCTACCTGCCTGGACAGCATGGCCTGCAACGCGGGCATCCCGATGCCGCCGGAAGC\r\nGAGAAGAATCATAATGGGGAAGGCCATCCAGCCTCGCGTCGCGAACGCCAGCAAGACGTAGCCCAGCGCGTCGGCCGCCA\r\nTGCCGGCGATAATGGCCTGCTTCTCGCCGAAACGTTTGGTGGCGGGACCAGTGACGAAGGCTTGAGCGAGGGCGTGCAAG\r\nATTCCGAATACCGCAAGCGACAGGCCGATCATCGTCGCGCTCCAGCGAAAGCGGTCCTCGCCGAAAATGACCCAGAGCGC\r\nTGCCGGCACCTGTCCTACGAGTTGCATGATAAAGAAGACAGTCATAAGTGCGGCGACGATAGTCATGCCCCGCGCCCACC\r\nGGAAGGAGCTGACTGGGTTGAAGGCTCTCAAGGGCATCGGTCGATCGACGCTCTCCCTTATGCGACTCCTGCATTAGGAA\r\nGCAGCCCAGTAGTAGGTTGAGGCCGTTGAGCACCGCCGCCGCAAGGAATGGTGCATGCAAGGAGATGGCGCCCAACAGTC\r\nCCCCGGCCACGGGGCCTGCCACCATACCCACGCCGAAACAAGCGCTCATGAGCCCGAAGTGGCGAGCCCGATCTTCCCCA\r\nTCGGTGATGTCGGCGATATAGGCGCCAGCAACCGCACCTGTGGCGCCGGTGATGCCGGCCACGATGCGTCCGGCGTAGAG\r\nG', 'ampicillin', 'none', 22198273, 'http://www.sebastianproost.be', '2014-01-30 10:09:17', 1, 0),
(15, 'ECO', 'pIRON', 2, 'better description', '', 'kanamycin', 'none', 0, '', '2014-01-31 13:42:34', 1, 0),
(48, 'IVF', 'pSecret', 1, 'cannot be disclosed2222', 'atcg', 'None', 'None', 0, 'www.invitrogen.com', '2014-02-05 13:55:33', 0, 49),
(49, 'ECO', 'pHello', 1, 'asdfasdf', '', 'Ampicillin', 'Basta', 0, '', '2014-02-05 15:14:49', 1, 0),
(51, 'ECO', 'asdasda', 1, 'asdasd', '', 'none', 'none', 0, '', '2014-02-11 15:43:33', 0, 15),
(55, 'ECO', 'pCrash', 1, 'sdfsdf', '', 'None', 'None', 0, '', '2014-02-12 13:41:27', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `plasmid_location`
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

--
-- Dumping data for table `plasmid_location`
--

INSERT INTO `plasmid_location` (`id`, `plasmid_id`, `location_id`, `label`, `comment`, `storage_type`, `critically_low`) VALUES
(1, 1, 1, 'flask label', 'Invitrogen Stock', 'DNA', 0),
(15, 15, 1, 'flask 1', '', 'DNA', 0),
(18, 51, 1, '51', '', 'DNA', 0),
(22, 55, 1, '55', '', 'DNA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_location` (`location`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `location`, `phone`, `email`, `password`, `account`, `created`) VALUES
(1, 'sepro', 'Sebastian', 'Proost', 1, '+49 (0) 331 5678109', 'proost@mpimp-golm.mpg.de', 'b71c38092d5484f5d35ef895b3e255baa45109da', 'admin', '2014-01-29 11:17:48'),
(2, 'ironman', 'Tony', 'Stark', 1, '+49 (0) 331 5678109', 'proost@mpimp-golm.mpg.de', 'b71c38092d5484f5d35ef895b3e255baa45109da', 'user', '2014-01-29 11:17:48'),
(3, 'batman', 'Bruce', 'Wayne', 1, '+49 (0) 331 5678109', 'proost@mpimp-golm.mpg.de', 'b71c38092d5484f5d35ef895b3e255baa45109da', 'guest', '2014-01-29 11:17:48'),
(6, 'hulk', 'Bruce', 'Banner', 1, '+49 (0) 331 5678109', 'proost@mpimp-golm.mpg.de', 'b71c38092d5484f5d35ef895b3e255baa45109da', 'admin', '2014-01-29 11:17:48'),
(11, 'superman', 'Clark', 'Kent', 1, '0', 'proost@mpimp-golm.mpg.de', 'b71c38092d5484f5d35ef895b3e255baa45109da', 'pending', '2014-02-03 16:45:19');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_plasmids`
--
CREATE TABLE IF NOT EXISTS `view_plasmids` (
`plasmid_id` int(11)
,`vector_type` varchar(50)
,`name` varchar(50)
,`creator` int(11)
,`description` text
,`sequence` text
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
-- Structure for view `view_plasmids`
--
DROP TABLE IF EXISTS `view_plasmids`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_plasmids` AS select `b`.`plasmid_id` AS `plasmid_id`,`b`.`vector_type` AS `vector_type`,`b`.`name` AS `name`,`b`.`creator` AS `creator`,`b`.`description` AS `description`,`b`.`sequence` AS `sequence`,`b`.`bacterial_resistance` AS `bacterial_resistance`,`b`.`plant_resistance` AS `plant_resistance`,`b`.`pubmed_id` AS `pubmed_id`,`b`.`website` AS `website`,`b`.`created` AS `created`,`b`.`backbone` AS `backbone`,`a`.`label` AS `label`,`a`.`comment` AS `comment`,`a`.`storage_type` AS `storage_type`,`a`.`critically_low` AS `critically_low`,`c`.`location_id` AS `location_id`,`c`.`address` AS `address`,`c`.`building` AS `building`,`c`.`room` AS `room`,`d`.`username` AS `username` from (((`plasmid_location` `a` left join `plasmids` `b` on((`a`.`plasmid_id` = `b`.`plasmid_id`))) left join `locations` `c` on((`a`.`location_id` = `c`.`location_id`))) left join `users` `d` on((`b`.`creator` = `d`.`user_id`)));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inserts`
--
ALTER TABLE `inserts`
  ADD CONSTRAINT `inserts_ibfk_1` FOREIGN KEY (`plasmid_id`) REFERENCES `plasmids` (`plasmid_id`) ON DELETE CASCADE;

--
-- Constraints for table `plasmids`
--
ALTER TABLE `plasmids`
  ADD CONSTRAINT `plasmids_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `plasmid_location`
--
ALTER TABLE `plasmid_location`
  ADD CONSTRAINT `plasmid_location_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`),
  ADD CONSTRAINT `plasmid_location_ibfk_2` FOREIGN KEY (`plasmid_id`) REFERENCES `plasmids` (`plasmid_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`location`) REFERENCES `locations` (`location_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
