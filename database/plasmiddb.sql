#
# TABLE STRUCTURE FOR: inserts
#

DROP TABLE IF EXISTS inserts;

CREATE TABLE `inserts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `sequence` text NOT NULL,
  `comment` tinytext NOT NULL,
  `plasmid_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `inserts_ibfk_1` (`plasmid_id`),
  CONSTRAINT `inserts_ibfk_1` FOREIGN KEY (`plasmid_id`) REFERENCES `plasmids` (`plasmid_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;


#
# TABLE STRUCTURE FOR: locations
#

DROP TABLE IF EXISTS locations;

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text NOT NULL,
  `building` tinytext NOT NULL,
  `room` tinytext NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO locations (`location_id`, `address`, `building`, `room`) VALUES (1, 'Default Location', 'Default', 'Default');


#
# TABLE STRUCTURE FOR: options
#

DROP TABLE IF EXISTS options;

CREATE TABLE `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(50) NOT NULL,
  `possible_value` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (1, 'vector_type', 'ECO');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (2, 'vector_type', 'SCE');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (3, 'vector_type', 'PLA');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (4, 'vector_type', 'IVF');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (5, 'bacterial_resistance', 'None');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (6, 'bacterial_resistance', 'Kanamycin');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (7, 'plant_resistance', 'None');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (8, 'plant_resistance', 'Basta');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (9, 'storage_type', 'DNA');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (10, 'storage_type', 'GlycCult');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (11, 'bacterial_resistance', 'Ampicillin');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (12, 'bacterial_resistance', 'Other');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (13, 'bacterial_resistance', 'Carbenicillin');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (14, 'bacterial_resistance', 'Chloramphenicol');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (15, 'bacterial_resistance', 'Gentamycin');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (16, 'bacterial_resistance', 'Hygromycin');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (17, 'bacterial_resistance', 'Spectinomycin');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (18, 'bacterial_resistance', 'Streptomycin');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (19, 'bacterial_resistance', 'Tetracyclin');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (20, 'plant_resistance', 'Geneticin 418 (G418)');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (21, 'plant_resistance', 'Other');
INSERT INTO options (`id`, `option_name`, `possible_value`) VALUES (22, 'vector_type', 'Unknown');


#
# TABLE STRUCTURE FOR: plasmid_location
#

DROP TABLE IF EXISTS plasmid_location;

CREATE TABLE `plasmid_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plasmid_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `comment` varchar(50) NOT NULL,
  `storage_type` varchar(50) NOT NULL,
  `critically_low` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `plasmid_location_ibfk_1` (`location_id`),
  KEY `plasmid_location_ibfk_2` (`plasmid_id`),
  CONSTRAINT `plasmid_location_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`),
  CONSTRAINT `plasmid_location_ibfk_2` FOREIGN KEY (`plasmid_id`) REFERENCES `plasmids` (`plasmid_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;




#
# TABLE STRUCTURE FOR: plasmids
#

DROP TABLE IF EXISTS plasmids;

CREATE TABLE `plasmids` (
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
  KEY `plasmids_ibfk_1` (`creator`),
  CONSTRAINT `plasmids_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
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
  KEY `fk_location` (`location`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`location`) REFERENCES `locations` (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO users (`user_id`, `username`, `first_name`, `last_name`, `location`, `phone`, `email`, `password`, `account`, `created`, `reset_key`, `reset_date`) VALUES (1, 'admin', 'Admin', '', 1, '', '', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', '', '', '');


#
# TABLE STRUCTURE FOR: vectormaps
#

DROP TABLE IF EXISTS vectormaps;

CREATE TABLE `vectormaps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plasmid_id` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `image_type` text NOT NULL,
  `file_type` text NOT NULL,
  `image_data` longblob,
  `thumb_width` int(11) NOT NULL,
  `thumb_height` int(11) NOT NULL,
  `thumb_data` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;



